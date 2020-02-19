#!/usr/bin/perl
#
#
open(STDERR, ">&STDOUT");                       # Redirect all errors to standard output
$| = 1; print "Content-type: text/html\n\n";    # Unbuffer STDOUT and send client our default header

use DBI;
use CDR::Input;

# Collect any form input passed in 
*in = getInput();  
$in{'dbserver'} = 'ns2' if (!$in{'dbserver'});
$default_ip = '66.181.7.12';

open(X, ">>/tmp/dns.log");
   print X "_"x78,"\n";
   print X "_"x78,"\n";
   foreach $x (keys %ENV) {
      print X "$x: $ENV{$x}\n";
   }
   print X "_"x78,"\n";
   foreach $x (keys %in) {
      print X "$x: $in{$x}\n";
   }   
close X;


if ($in{'exec'} eq "change_server") {
   $in{'recordID'} = $in{'NAME'} = $in{'TTL'} = $in{'RDATA'} = $in{'RDTYPE'} = $in{'zone'} = $in{'domain'} = $in{'tablename'} = $in{'created'} = $in{'modified'} = $in{'dbhost'} = $in{'dbdb'} = $in{'dbuser'} = $in{'dbpass'} = $in{'client'} = undef;
}
$in{'zone'} = 1 if (!$in{'zone'});

%dat = %in;	# Duplicate passed in data into our output hash

%hosts = (  
            'ns'       => '66.181.7.2',
            'ns2'      => '66.181.7.12',
            'www'      => '66.181.7.12',
            'db'       => '66.181.7.3',
            'netoasis' => '66.121.153.2',
            'hamster'  => '216.120.59.226',
            'maila'    => '65.212.133.182',
            'dev'      => '65.212.133.190',
         );

$dat{'default_dbhost'} = $hosts{$dat{'dbserver'}} || $hosts{$in{'dbserver'}};

$user = "pimp";  $passwd = "pimpin"; $dbdrv = "mysql";  $db = "dns";
$host = $dat{'default_dbhost'};
$driver = "dbi:$dbdrv:database=$db:host=";

# Connect to our db server 
$dbh = DBI->connect($driver.$hosts{'ns2'}, $user, $passwd) or die "Error connecting to ${driver}ns2 DB server on '$host' as '$user' - $!";
$nbh = DBI->connect($driver.$hosts{'ns'}, $user, $passwd) or die "Error connecting to ${driver}ns DB server on '$host' as '$user' - $!";
#$obh = DBI->connect($driver.$hosts{'netoasis'}, $user, $passwd) or die "Error connecting to ${driver}oasis.netoasis.net DB server on '$host' as '$user' - $!";

new_zone() if ($in{'exec'} eq "new_zone");
save_zone() if ($in{'exec'} eq "save_zone");
delete_zone() if ($in{'exec'} eq "delete_zone");

if (!$dat{'error'}) {
   %zone = get_zone($in{'zone'}) if ($in{'zone'});

   new_record() if ($in{'exec'} eq "new_record");
   save_record() if ($in{'exec'} eq "save_record");
   delete_record() if ($in{'exec'} eq "delete_record");
}

$tth = $dbh->prepare("select * from zones where active='1' order by domain");
$tth->execute();

while ($zone = $tth->fetchrow_hashref) {
   my $s = ''; 
   if ($in{'zone'} eq $zone->{'zoneID'}) {
      $s = " SELECTED";
      $zonetable = $zone->{'tablename'};
      $zone->{'active'} = " CHECKED" if ($zone->{'active'} eq "1");
      %dat = (%dat, %{$zone});
   }   

   $dat{'zones'} .= "<option value='$zone->{'zoneID'}'$s>$zone->{'domain'}</option>";
}
$dat{'NAME'} = $dat{'TTL'} = $dat{'RDTYPE'} = $dat{'RDATA'} = undef;

if (($zonetable) && (!$dat{'error'})) {
   $sth = $dbh->prepare("select * from $zonetable order by RDTYPE desc, NAME asc");
   $sth->execute();

   while ($rec = $sth->fetchrow_hashref) {
      $val = "'$rec->{'ID'}!$rec->{'NAME'}!$rec->{'TTL'}!$rec->{'RDTYPE'}!$rec->{'RDATA'}'";
      $s = '';
     if ($in{'recordID'} eq $rec->{'ID'}) {
        $s = ' SELECTED';
	     %dat = (%dat, %{$rec});
     }	
     $dat{'rrs'} .= "<option value=${val}$s>$rec->{'RDTYPE'} - $rec->{'NAME'}</option>";
   }   
}

$dat{"dbserver_$in{'dbserver'}"} = " SELECTED";
$dat{"RDTYPE_$dat{'RDTYPE'}"} = " SELECTED";
$dat{'alert'} = "alert('".$dat{'alert'}."');" if ($dat{'alert'});
$dat{'alert'} .= "alert(".$dbh->quote($dat{'error'}).");" if ($dat{'error'});

open(HTML, "dns.html") or die "Error opening dns.html for reading: $!";
   while ($html = <HTML>) {
      $html =~ s/\#([\w\.]+)\#/$dat{$1}/gi;
      print $html;
   }
close HTML;

exit 0;

sub new_zone {
#   print "<h2>Creating new zone: $in{'domain'}</h2>\n";   
   # Perform sanity checks and ensure we have a proper tablename and domainname
   if ((!defined $in{'tablename'}) || ($in{'tablename'} =~ /\W/)) {
      $dat{'error'} = "No table name defined or bad table name. Please try again.\n(Table names may only contain alphanumber characters only [a-zA-Z0-9_])"; 
      return 0;
   } 
   if ((!defined $in{'domain'}) || ($in{'domain'} !~ /[\w\.]+/)) {
      $dat{'error'} = "No domain name defined or bad domain name. Please try again.\n(Domain names may only contain alphanumber characters or a '-' only [a-z0-9-.])"; 
      return 0;
   }

   # Drop any existing table *** Fix this to archive table before dumping or just delete existing records or leave records
   #                             and check for existance of default required records before inserting them ***
   #
   my $drop = "drop table if exists $in{'tablename'}";
   dbExec($drop);

   # Create table which will contain all zone information for this domain
   my $create = "CREATE TABLE $in{'tablename'} ( ID int(12) NOT NULL auto_increment, NAME varchar(200) NOT NULL default '', TTL int(11) NOT NULL default '28800', RDTYPE varchar(50) NOT NULL default '', RDATA varchar(200) NOT NULL default '', CREATED timestamp(14) NOT NULL, PRIMARY KEY  (ID), KEY NAME (NAME), KEY RDTYPE (RDTYPE), KEY RDATA (RDATA), KEY NAME_2 (NAME,RDTYPE,RDATA)) TYPE=MyISAM";
   dbExec($create);
#   $dbh->do($create);

   # Add an entry for this zone into the zones table which contains table->domain name mappings and other useful data
   my $insert = "insert into zones (domain, tablename, client, created, dbhost, dbdb, dbuser, dbpass) values (".$dbh->quote($in{'domain'}).", ".$dbh->quote($in{'tablename'}).", ".$dbh->quote($in{'client'}).", now(), ".$dbh->quote($hosts{$in{'dbserver'}}).",".$dbh->quote($in{'dbdb'}).", ".$dbh->quote($in{'dbuser'}).", ".$dbh->quote($in{'dbpass'}).")";
   dbExec($insert);
#   $dbh->do($insert);
   $in{'zone'} = $dat{'zone'} = $dbh->{mysql_insertid};
   $in{'recordID'} = $dat{'recordID'} = undef;
   
   my $newzone = $dbh->selectrow_hashref("select * from zones where domain='$in{'domain'}'");
   $in{'zone'} = $dat{'zone'} = $newzone->{'zoneID'};

   #
   # Insert required records with default values
   #
   my $serial = get_serial();

   my @inserts = ( 
         "insert into $in{'tablename'} (NAME, TTL, RDTYPE, RDATA) VALUES ('$in{'domain'}', '28800', 'SOA', 'ns.pimp.net. hostmaster.pimp.net. $serial 14400 3600 604800 28800')",
         "insert into $in{'tablename'} (NAME, TTL, RDTYPE, RDATA) VALUES ('$in{'domain'}', '28800', 'NS', 'ns.pimp.net.')",
         "insert into $in{'tablename'} (NAME, TTL, RDTYPE, RDATA) VALUES ('$in{'domain'}', '28800', 'NS', 'ns2.pimp.net.')",
         "insert into $in{'tablename'} (NAME, TTL, RDTYPE, RDATA) VALUES ('$in{'domain'}', '28800', 'NS', 'ns.netoasis.net.')",
         "insert into $in{'tablename'} (NAME, TTL, RDTYPE, RDATA) VALUES ('$in{'domain'}', '28800', 'MX', '10 mail.$in{'domain'}.')",
         "insert into $in{'tablename'} (NAME, TTL, RDTYPE, RDATA) VALUES ('$in{'domain'}', '28800', 'A', '$default_ip')",
         "insert into $in{'tablename'} (NAME, TTL, RDTYPE, RDATA) VALUES ('www.$in{'domain'}', '28800', 'A', '$default_ip')",
         "insert into $in{'tablename'} (NAME, TTL, RDTYPE, RDATA) VALUES ('mail.$in{'domain'}', '28800', 'A', '$default_ip')",
         "insert into $in{'tablename'} (NAME, TTL, RDTYPE, RDATA) VALUES ('imap.$in{'domain'}', '28800', 'CNAME', 'mail.$in{'domain'}.')",
         "insert into $in{'tablename'} (NAME, TTL, RDTYPE, RDATA) VALUES ('pop.$in{'domain'}', '28800', 'CNAME', 'mail.$in{'domain'}.')",
         "insert into $in{'tablename'} (NAME, TTL, RDTYPE, RDATA) VALUES ('smtp.$in{'domain'}', '28800', 'CNAME', 'mail.$in{'domain'}.')"
      );

   foreach my $insert (@inserts) {
      dbExec($insert);
   }   

   # and we're done.
   $dat{'alert'} .= "New zone created for domain $in{'domain'} \\[ID: $in{'zone'}\\]\\n\\n";

   return 1;
}

sub get_zone {
   my $tth = $dbh->prepare("select * from zones where zoneID='$in{'zone'}'");
   $tth->execute();

   my %zone = %{$tth->fetchrow_hashref};
 
   return \%zone;
}

sub save_zone {
   *orig = get_zone($in{'zone'});
   my @upd = ();
   foreach $k (keys %orig) {
      if (($orig{$k} ne $in{$k}) && ($in{$k} =~ /\w/)) {
         push(@upd, "$k=".$dbh->quote($in{$k}));
      } elsif (($orig{$k} ne $in{$k}) && ($in{$k} !~ /\w/) && ($orig{$k} eq "1")) {
         push(@upd, "$k=''");
      }	 
   }
   if (@upd) {
      my $update = "update zones set ".join(", ", @upd)." where zoneID='$in{'zone'}'";
      dbExec($update);
#      $dbh->do($update);
      updateSerial($orig{'tablename'});
      $dat{'alert'} .= "Updated zone record for $in{'domain'} with:\\n\t".join("\\n\t", @upd)."\\n\\n";
   }
   
   return 1;
}

sub delete_zone {
   system("/usr/bin/mysqldump -h$in{'dbserver'} -umail -pactivate dns $in{'tablename'} > archive/$in{'tablename'}.sql");
#   $dbh->do("delete from zones where domain='$in{'domain'}'");
#   $dbh->do("drop table $in{'tablename'}");

   my $query = "delete from zones where domain='$in{'domain'}'";
   my $drop = "drop table $in{'tablename'}";
   dbExec($query);
   dbExec($drop);
   
   $dat{'alert'} .= "Deleted zone $in{'domain'}.  \\n\\nArchive of $in{'tablename'} available in:\\n\\n http://$ENV{'SERVER_NAME'}/admin/dns/archive/$in{'tablename'}.sql\\n\\n";
   $in{'zone'} = $dat{'zone'} = $dat{'domain'} = $dat{'tablename'} = $dat{'created'} = $dat{'modified'} = $dat{'dbhost'} = $dat{'dbdb'} = $dat{'dbuser'} = $dat{'dbpass'} = $dat{'client'} = undef;
   
   return 1;
}

sub new_record {
   return 0 if (!$in{'zone'});

   %zone = get_zone($in{'zone'}) if (!$zone{'tablename'});

   if (($in{'NAME'} !~ /$zone{'domain'}/) && ($in{'NAME'} !~ /\.$/)) {
      $in{'NAME'} = $dat{'NAME'} = $in{'NAME'}.".".$zone{'domain'};
   }   
   my $insert = "insert into $in{'tablename'} (NAME, TTL, RDTYPE, RDATA) values (".$dbh->quote($in{'NAME'}).", ".$dbh->quote($in{'TTL'}).", ".$dbh->quote($in{'RDTYPE'}).", ".$dbh->quote($in{'RDATA'}).")";
   dbExec($insert);
   
   $in{'recordID'} = $dat{'recordID'} = $dbh->{mysql_insertid};

   updateSerial($zone{'tablename'});
   $dat{'alert'} .= "Added new record: \\n\\n$in{'NAME'}->$in{'RDTYPE'}->$in{'RDATA'} \[ID: $in{'recordID'}\]\\n\\n";

   return 1;
}

sub save_record {
   return 0 if ((!$in{'recordID'}) || (!$in{'zone'}));

   *zone = get_zone($in{'zone'}) if (!defined $zone{'tablename'});
   my $select = "select * from $zone{'tablename'} where ID='$in{'recordID'}'";
   
   my $tth = $dbh->prepare($select);
   $tth->execute();
   my %orig = %{$tth->fetchrow_hashref};
   
   my @upd = ();
   foreach $k (keys %orig) {
      if (($orig{$k} ne $in{$k}) && ($in{$k} =~ /\w/)) {
         my $tmp = $dbh->quote($in{$k});
         push(@upd, "$k=".$tmp);
         $tmp =~ s/(['"])/\\$1/g;
         push(@show, "$k=".$tmp);
      } 
   }
   if (@upd) {
      my $update = "update $zone{'tablename'} set ".join(", ", @upd)." where ID='$in{'recordID'}'";
#      $dbh->do($update);
      dbExec($update);

      updateSerial($zone{'tablename'});
      $dat{'alert'} .= "Updated $zone{'domain'} with: \\n\t".join("\\n\t", @show)."\\n\\n";

   }

   return 1;
}

sub delete_record {
   *zone = get_zone($in{'zone'}) if (!$zone{'tablename'});
   
   my $tth = $dbh->prepare("select * from $zone{'tablename'} where ID='$in{'recordID'}'");
   $tth->execute();
   
   if ($tth->rows) {
      my $query = "delete from $zone{'tablename'} where ID='$in{'recordID'}'";
#      $dbh->do("delete from $zone{'tablename'} where ID='$in{'recordID'}'");
      dbExec($query);

      $in{'recordID'} = $dat{'recordID'} = undef;
      updateSerial($zone{'tablename'});
      $dat{'alert'} .= "Deleted record $in{'NAME'}->$in{'RDTYPE'}->$in{'RDATA'} from \\ndomain  $zone{'domain'}\\n\\n";
   }

   return 1;
}

sub get_serial {
   my @t = localtime();
   ++$t[4]; $t[5] += 1900;
   my $serial = sprintf("%04d%02d%02d%02d", $t[5], $t[4], $t[3], '1');

   return $serial;
}

sub updateSerial {
   my $table = shift @_;
   if (!$table) {
      *zone = get_zone($in{'zone'}) if (!defined $zone{'tablename'});
      $table = $zone{'tablename'};
   }   
   
   if ($table) {
      my $oth = $dbh->prepare("select * from $table where RDTYPE='SOA'");
      $oth->execute();
   
      if ($oth->rows) {
         my %soa = %{$oth->fetchrow_hashref};
         my @soa = split(/\s/, $soa{'RDATA'});
         $soa[2]++;
         
         my $upd = "update $table set RDATA='".join(" ", @soa)."' where RDTYPE='SOA'";
#         $dbh->do($upd);
         dbExec($upd);

     	   $dat{'alert'} .= "\\nUpdated SOA serial for $zone{'domain'} to $soa[2]\\n\\n";
         return 1;
      } else {
         return 0;
      }
   }   
}

sub dbExec {
   my $querystr = shift @_;

   $dbh->do($querystr) if $dbh;
   $nbh->do($querystr) if $nbh;
#   $obh->do($querystr) if $obh;
   
   return 1;
}   
