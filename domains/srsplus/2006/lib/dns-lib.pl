
sub new_zone {
   my $rec = shift @_;
#   print "<h2>Creating new zone: $in{'domain'}</h2>\n";   
   # Perform sanity checks and ensure we have a proper tablename and domainname
   $in{'dbhost'} = 'localhost' if (!$in{'dbhost'});
   $in{'dbdb'} = 'dns' if (!$in{'dbdb'});
   $in{'dbuser'} = 'pimp' if (!$in{'dbuser'});
   $in{'dbpass'} = 'pimpin' if (!$in{'dbpass'});
   $in{'client'} = $rec->{'User'} || $rec->{'NewUser'};
   $in{'domain'} = $rec->{'Domain'}.$rec->{'TLD'};
   ($in{'tablename'} = $in{'domain'}) =~ s/[^a-z0-9\-]/_/gi;

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
   my $drop = "drop table if exists dns.$in{'tablename'}";
   dbExec($drop);

   # Create table which will contain all zone information for this domain
   my $create = "CREATE TABLE dns.$in{'tablename'} ( ID int(12) NOT NULL auto_increment, NAME varchar(200) NOT NULL default '', TTL int(11) NOT NULL default '28800', RDTYPE varchar(50) NOT NULL default '', RDATA varchar(200) NOT NULL default '', CREATED timestamp(14) NOT NULL, PRIMARY KEY  (ID), KEY NAME (NAME), KEY RDTYPE (RDTYPE), KEY RDATA (RDATA), KEY NAME_2 (NAME,RDTYPE,RDATA)) TYPE=MyISAM";
   dbExec($create);
#   $dbh->do($create);

   # Add an entry for this zone into the zones table which contains table->domain name mappings and other useful data
   my $insert = "insert into dns.zones (domain, tablename, client, created, dbhost, dbdb, dbuser, dbpass) values (".$dbh->quote($in{'domain'}).", ".$dbh->quote($in{'tablename'}).", ".$dbh->quote($in{'client'}).", now(), ".$dbh->quote($in{'dbhost'}).",".$dbh->quote($in{'dbdb'}).", ".$dbh->quote($in{'dbuser'}).", ".$dbh->quote($in{'dbpass'}).")";
   dbExec($insert);
#   $dbh->do($insert);
#   $in{'zone'} = $dat{'zone'} = $dbh->{mysql_insertid};
   $in{'recordID'} = $dat{'recordID'} = undef;
   
   my $newzone = $dbh->selectrow_hashref("select * from dns.zones where domain='$in{'domain'}'");
   $in{'zone'} = $dat{'zone'} = $newzone->{'zoneID'};

   #
   # Insert required records with default values
   #
   my $serial = get_serial();

   my @inserts = ( 
         "insert into dns.$in{'tablename'} (NAME, TTL, RDTYPE, RDATA) VALUES ('$in{'domain'}', '28800', 'SOA', 'ns.pimp.net. hostmaster.pimp.net. $serial 14400 3600 604800 28800')",
         "insert into dns.$in{'tablename'} (NAME, TTL, RDTYPE, RDATA) VALUES ('$in{'domain'}', '28800', 'NS', 'ns.pimp.net.')",
         "insert into dns.$in{'tablename'} (NAME, TTL, RDTYPE, RDATA) VALUES ('$in{'domain'}', '28800', 'NS', 'ns2.pimp.net.')",
         "insert into dns.$in{'tablename'} (NAME, TTL, RDTYPE, RDATA) VALUES ('$in{'domain'}', '28800', 'NS', 'ns.netoasis.net.')",
         "insert into dns.$in{'tablename'} (NAME, TTL, RDTYPE, RDATA) VALUES ('$in{'domain'}', '28800', 'MX', '10 mail.$in{'domain'}.')",
         "insert into dns.$in{'tablename'} (NAME, TTL, RDTYPE, RDATA) VALUES ('$in{'domain'}', '28800', 'A', '$default_ip')",
         "insert into dns.$in{'tablename'} (NAME, TTL, RDTYPE, RDATA) VALUES ('www.$in{'domain'}', '28800', 'A', '$default_ip')",
         "insert into dns.$in{'tablename'} (NAME, TTL, RDTYPE, RDATA) VALUES ('mail.$in{'domain'}', '28800', 'A', '$mail_ip')",
         "insert into dns.$in{'tablename'} (NAME, TTL, RDTYPE, RDATA) VALUES ('imap.$in{'domain'}', '28800', 'CNAME', 'mail.$in{'domain'}.')",
         "insert into dns.$in{'tablename'} (NAME, TTL, RDTYPE, RDATA) VALUES ('pop.$in{'domain'}', '28800', 'CNAME', 'mail.$in{'domain'}.')",
         "insert into dns.$in{'tablename'} (NAME, TTL, RDTYPE, RDATA) VALUES ('smtp.$in{'domain'}', '28800', 'CNAME', 'mail.$in{'domain'}.')"
      );

   foreach my $insert (@inserts) {
      dbExec($insert);
   }   

   # and we're done.
   $dat{'alert'} .= "New zone created for domain $in{'domain'} \\[ID: $in{'zone'}\\]\\n\\n";

   return 1;
}

sub get_zone {
   my $tth = $dbh->prepare("select * from dns.zones where zoneID='$in{'zone'}'");
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
      my $update = "update dns.zones set ".join(", ", @upd)." where zoneID='$in{'zone'}'";
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

   my $query = "delete from dns.zones where domain='$in{'domain'}'";
   my $drop = "drop table dns.$in{'tablename'}";
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
   my $insert = "insert into dns.$in{'tablename'} (NAME, TTL, RDTYPE, RDATA) values (".$dbh->quote($in{'NAME'}).", ".$dbh->quote($in{'TTL'}).", ".$dbh->quote($in{'RDTYPE'}).", ".$dbh->quote($in{'RDATA'}).")";
   dbExec($insert);
   
   $in{'recordID'} = $dat{'recordID'} = $dbh->{mysql_insertid};

   updateSerial($zone{'tablename'});
   $dat{'alert'} .= "Added new record: \\n\\n$in{'NAME'}->$in{'RDTYPE'}->$in{'RDATA'} \[ID: $in{'recordID'}\]\\n\\n";

   return 1;
}

sub save_record {
   return 0 if ((!$in{'recordID'}) || (!$in{'zone'}));

   *zone = get_zone($in{'zone'}) if (!defined $zone{'tablename'});
   my $select = "select * from dns.$zone{'tablename'} where ID='$in{'recordID'}'";
   
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
      my $update = "update dns.$zone{'tablename'} set ".join(", ", @upd)." where ID='$in{'recordID'}'";
#      $dbh->do($update);
      dbExec($update);

      updateSerial($zone{'tablename'});
      $dat{'alert'} .= "Updated $zone{'domain'} with: \\n\t".join("\\n\t", @show)."\\n\\n";

   }

   return 1;
}

sub delete_record {
   *zone = get_zone($in{'zone'}) if (!$zone{'tablename'});
   
   my $tth = $dbh->prepare("select * from dns.$zone{'tablename'} where ID='$in{'recordID'}'");
   $tth->execute();
   
   if ($tth->rows) {
      my $query = "delete from dns.$zone{'tablename'} where ID='$in{'recordID'}'";
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

1;

