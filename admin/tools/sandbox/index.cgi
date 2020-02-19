#!/usr/bin/perl
#
#
open(STDERR, ">>/tmp/sandbox_error.log");                       # Redirect all errors to standard output
$| = 1; print "Content-type: text/html\n\n";    # Unbuffer STDOUT and send client our default header

use DBI;
use CDR::Input;

$user = "mail";  $passwd = "activate";
$host = "localhost";  $dbdrv = "mysql";  $db = "dns";
$driver = "dbi:$dbdrv:host=$host:database=$db";
$table = "client"; $port = 3306;

# Connect to our db server 
$dns = DBI->connect($driver, $user, $passwd) or die "Error connecting to $driver DB server on '$host' as '$user' - $!";
$dbh = DBI->connect('dbi:mysql:host=localhost:database=domain', 'mail', 'activate') or die "Error connecting to sys db on dev";
$ibh = DBI->connect('dbi:mysql:host=www.interactivate.com:database=dns', 'mail', 'activate') or die "Error connecting to dns db on icg";

# Collect any form input passed in 
*in = getInput();  
%dat = %in;	# Duplicate passed in data into our output hash

$in{'server_root'} = "/www".$in{'server_root'} if ($in{'server_root'} =~ /^\/home/);
@fields = ('client_code', 'domain', 'hostname', 'user', 'docroot', 'type', 'IP', 'port', 'cgidir', 'active', 'access_log', 'error_log', 'log_type', 'server_root', 'ServerAdmin','cvs');

if ($in{'exec'} =~ /new/i) {
   if ((!$in{'hostname'}) || (!$in{'server_root'}) || ($in{'access_log'} =~ /HOSTNAME/i)) {
      $in{'exec'} = 'lookup';
   } else {
      $cth = $dbh->prepare("select * from domain where hostname='$in{'hostname'}'");
      $cth->execute();
      if ($cth->rows) {
         $dat{'alert'} = "alert('Hostname \\'$in{'hostname'}\\' already exists. \\nNot creating new host.');";
      } else {   
         $insert = "insert into domain (".join(", ", @fields).") values ('$in{'client_code'}', 'interactivate.com', '$in{'hostname'}', '$in{'user'}', '$in{'docroot'}', 'standard', '192.168.1.7', '80', '$in{'cgidir'}', '1', '$in{'access_log'}', '$in{'error_log'}', 'combined', '$in{'server_root'}', 'hostmaster\@interactivate.com', '$in{'client_code'}')";
         $dbh->do($insert);
         $in{'ID'} = $dbh->{'mysql_insertid'};

         # Add alias for just the hostname
         $dbh->do("insert into server_alias (domainID, alias) values ($in{'ID'}, '$in{'hostname'}')");

         if ($in{'dns'}) {
            $dth = $dns->prepare("select * from interactivate_com where NAME='$in{'hostname'}.interactivate.com'");
            $dth->execute();

   	    if ($dth->rows) {
	       $dnsrec = %{$dth->fetchrow_hashref};
   	       $dat{'alert'} = "alert('Hostname \\'$in{'hostname'}\\' already exists in DNS. \\nNot creating new DNS record host.\\n\\nExisting host record is:\\n\\n$dnsrec{'NAME'}\t$dnsrec{'RDTYPE'}\t$dnsrec{'RDATA'}');";
	    } else {   
               addHost("$in{'hostname'}.interactivate.com", $in{'user'});
	    }   
         }
         open(FLAG, ">/www/templates/status/httpd.update"); close FLAG;
         @t = localtime();
         $upwhen = ((60 - $t[0]) * 1000) + 5000;
         $dat{'refresh'} = "setTimeout('document.forms[0].submit();', $upwhen);";
      }
   }   
} elsif ($in{'exec'} =~ /update/) {
   $in{'cvs'} = $in{'client_code'} if ($in{'cvs'});
   $sth = $dbh->prepare("select * from domain where ID=$in{'ID'}");
   $sth->execute();
   %domain = %{$sth->fetchrow_hashref};
   @vals = ();
   foreach $field (@fields) {
      if (($domain{$field} ne $in{$field}) && ($in{$field} =~ /\w/)) {
         push(@vals, "$field=".$dbh->quote($in{$field}));
      }
   }
   
   if (@vals) {
      $dbh->do("update domain set ".join(", ", @vals)." where ID=$in{'ID'}");
      $dat{'alert'} = "alert('Updated record for \\'$in{'hostname'}\\' with the following details:\\n\\n\\t".join("\\n\\t", @vals)."\\n');";
      print "<h2>Updating domain with: ".join(", ", @vals)."</h2>";
      open(FLAG, ">/www/templates/status/httpd.update"); close FLAG;
   }

   if (!$in{'dns'}) {
      $dns->do("delete from interactivate_com where NAME='$in{'hostname'}.interactivate.com'");
      $ibh->do("delete from interactivate_com where NAME='$in{'hostname'}.interactivate.com'");
      updateSerial("interactivate_com");
      updateSerialInternal("interactivate_com");
   } else {
      addHost("$in{'hostname'}.interactivate.com", $in{'user'});
   } 
   @t = localtime();
   $upwhen = ((60 - $t[0]) * 1000) + 5000;
   $dat{'refresh'} = "setTimeout('document.forms[0].submit();', $upwhen);";
} elsif ($in{'exec'} =~ /delete/) {
   if ($in{'ID'}) {
      $sth = $dbh->prepare("select * from domain where ID=$in{'ID'}");
      $sth->execute();
      $fields = $sth->{NAME};
      $vals = $sth->fetchrow_arrayref;
      open(SAVE, ">archive/$in{'hostname'}-$in{'ID'}");
         print SAVE join("\t", @{$fields})."\n";
         print SAVE join("\t", @{$vals})."\n";
      close SAVE;
      $dbh->do("delete from domain where ID=$in{'ID'}");
      open(FLAG, ">/www/templates/status/httpd.update"); close FLAG;
   }

   if ($in{'hostname'}) {
      $dns->do("delete from interactivate_com where NAME='$in{'hostname'}.interactivate.com'");
      $ibh->do("delete from interactivate_com where NAME='$in{'hostname'}.interactivate.com'");
      updateSerial("interactivate_com");
      updateSerialInternal("interactivate_com");
   }   
   $dat{'alert'} = "alert('Deleted httpd and dns records for \\'$in{'hostname'}\\'.\\n\\nYour source files have NOT been removed.\\n\\n  You need to remove them yourself if you are done with them.');";
   @t = localtime();
   $upwhen = ((60 - $t[0]) * 1000) + 5000;
   $dat{'refresh'} = "setTimeout('document.forms[0].submit();', $upwhen);";
   $in{'ID'} = $dat{'hostname'} = $dat{'ID'} = $dat{'server_root'} = $dat{'docroot'} = $dat{'cgidir'} = $dat{'access_log'} = $dat{'error_log'} = undef;
}

$dat{'REMOTE_USER'} = $ENV{'REMOTE_USER'} if (!$dat{'REMOTE_USER'});

($name,$passwd,$uid,$gid,$quota,$comment,$gcos,$dat{'USER_HOME'},$shell,$expire) = getpwnam($dat{'REMOTE_USER'});
$where = '';
$in{'view'} = $dat{'REMOTE_USER'} if (!$in{'view'});

if ($in{'view'} ne "all") {
   $where = " where user='$in{'view'}'";
}
$sth = $dbh->prepare("select * from domain$where order by hostname");
$sth->execute();

while (%rec = %{$sth->fetchrow_hashref}) {
   $in{'ID'} = $rec{'ID'} if (!$in{'ID'});
   if ($rec{'ID'} eq $in{'ID'}) {
      %dat = (%dat, %rec);
      $selected = " SELECTED";
      if (-e $rec{'server_root'}."/".$rec{'docroot'}) {
         $dat{'status'} = "<span style='font-size:12px; font-weight:bold; color:#00aa00;'>Available</span>";
      } else {
         $dat{'status'} = "<span style='font-size:12px; font-weight:bold; color:#aa0000;'>Pending</span>";
      }
   } else {
      $selected = "";
   }
   $dat{'hosts'} .= "<option value='$rec{'ID'}'$selected>$rec{'hostname'}</option>";
}

$jth = $dns->prepare("select * from interactivate_com where NAME='$dat{'hostname'}.interactivate.com'");
$jth->execute();

if ($jth->rows) {
   $dat{'dns'} = " CHECKED";
}

$dat{'modules'} = buildModuleList();
$s = ' SELECTED' if ($dat{'modules'} !~ /SELECTED/igs);
$dat{'modules'} = "<option value=''$s>None</option>\n".$dat{'modules'};
$dat{'cvs'} = " CHECKED" if ($dat{'cvs'});

$dat{"view_all"} = " SELECTED" if ($in{'view'} eq "all");
$dat{"view_my"} = " SELECTED" if ($in{'view'} ne "all");

$in{'page'} = "sites.html" if (!$in{'page'});

open(HTML, "$in{'page'}") or die "Error opening $in{'page'} for reading: $!";
   while ($html = <HTML>) {
      $html =~ s/\#([\w\.]+)\#/$dat{$1}/gi;
      print $html;
   }
close HTML;

exit 0;

sub updateSerial {
   my $table = shift @_;
   
   my $oth = $ibh->prepare("select * from $table where RDTYPE='SOA'");
   $oth->execute();
   
   if ($oth->rows) {
      my %soa = %{$oth->fetchrow_hashref};
      my @soa = split(/\s/, $soa{'RDATA'});
      $soa[2]++;

#      $dns2->do("update $table set RDATA='".join(" ", @soa)."' where RDTYPE='SOA'");
      $ibh->do("update $table set RDATA='".join(" ", @soa)."' where RDTYPE='SOA'");
      return 1;
   } else {
      return 0;
   } 
}

sub updateSerialInternal {
   my $table = shift @_;
   
   my $oth = $dns->prepare("select * from $table where RDTYPE='SOA'");
   $oth->execute();
   
   if ($oth->rows) {
      my %soa = %{$oth->fetchrow_hashref};
      my @soa = split(/\s/, $soa{'RDATA'});
      $soa[2]++;

      $dns->do("update $table set RDATA='".join(" ", @soa)."' where ID='$soa{'ID'}'");
      return 1;
   } else {
      return 0;
   } 
}

sub addHost {
   my $hostname = shift @_;
   my $username = shift @_;

   my $insert = "insert into interactivate_com (NAME, TTL, RDTYPE, RDATA, OWNER) values ('$hostname', '28800', 'CNAME', 'dev.interactivate.com.', '$username')";

   my $rec = $dns->selectrow_hashref("select * from interactivate_com where NAME='$hostname'");
   
   return 0 if ($rec->{'ID'});
   $dns->do($insert);
      
   my $int = $ibh->selectrow_hashref("select * from interactivate_com where NAME='$hostname'");

   return 0 if ($int->{'ID'});
   $ibh->do($insert);
   
   updateSerial("interactivate_com");
   updateSerialInternal("interactivate_com");
   return 1;
}

sub buildModuleList {
   my %modmap = ();
   my %module = ();

   open(CVS, "/usr/bin/cvs -d /cvsroot co -c |");
      my @mods = sort(<CVS>);
   close CVS;
   chomp(@mods);

   while (my $mod = shift @mods) {
      chomp $mod;
      if ($mod =~ /([\w\.\-]+)\s+\-a\s(.*)/) {
         $modmap{$2} = $1;
      } else {
         my($modnm, $modloc) = split(/\s+/, $mod);
         $module{$modnm} = $modloc;
      }  
   }

   foreach my $mod (sort(keys(%module))) {
      $s = '';  $s = ' SELECTED' if ($dat{'client_code'} =~ /$mod/i);
      $dat{'modules'} .= "<option value='$mod'$s>\[$mod\] $modmap{$mod}</option>\n";
      $done{$mod} = 1;
   }

   foreach my $mod (sort(keys(%module))) {
      next if (defined $done{$mod});
      $s = '';  $s = ' SELECTED' if ($dat{'client_code'} =~ /$mod/i);
      $dat{'modules'} .= "<option value='$mod'$s>$mod</option>\n";
   }


   return $dat{'modules'};
}

1;
