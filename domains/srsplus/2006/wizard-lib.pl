
sub parsePage {
   my $page = shift @_;
   my $html = '';
   my $out = '';

   open(HTML, $page) or die "Error opening $page for reading: $!";
      while ($html = <HTML>) {
         $html =~ s/\#(\w+)\#/$dat{$1}/gi;
         $html =~ s/\#(\w+)\#/$dat{$1}/gi;
         $out .= $html;
      }
   close HTML;

   return $out; 
}

sub checkDomain {
   my $domain = shift @_;
   my $tld = shift @_;

   ($domain, $tld) = split(/\./, $domain) if ($domain =~ /\./);
   $tld =~ s/^\.//;

   my $srs_client = new DotSRS_Client;
   
   my $ref = $srs_client->domain_info($domain, $tld);
   
   return $ref;
}

sub process {
   my $code = shift @_;

   eval {
      if (-e $code) {
         require($code);
      } else {
         eval($code);
      }
   };

   if ($@) {
      $data->{'error'} = $@;
      return 0;
   } else {   
      return 1;
   }
}
sub getMultiDomains {
   my $domain = shift @_;
   my $results;
   my $domchk = {};
   my $isodate = isodate();
   my $cnt = 0;

   my $tlds = $dbh->selectcol_arrayref("select TLD from TLD where AutoCheck!=0 order by AutoCheck, Priority");
   my $sth = $dbh->prepare("select * from Cache where Domain='$domain'");
   $sth->execute();

   while (my $cache = $sth->fetchrow_hashref) {
      if (($isodate - $cache->{'Lookup'}) > 5000) {
         $dbh->do("delete from Cache where CacheID='$cache->{'CacheID'}'");
         next;
      }
      
      foreach my $tld (@{$tlds}) {
         $tld =~ s/^\.//;
         next if ($tld eq $cache->{'TLD'});
         ++$cnt;
         $domchk->{"DOMAIN $cnt"} = $cache->{'Domain'};
         $domchk->{"TLD $cnt"} = $tld;
      }
   }

   my $srs_client = new DotSRS_Client;
   my $ref = $srs_client->multidomain_info($domchk);

   foreach my $c (0..$cnt) {
      $results = {'Domain'    => $ref->{'DOMAIN '.$c},
                  'TLD'       => $ref->{'TLD '.$c},
                  'Status'    => $ref->{'DOMAIN STATUS '.$c},
                  'Price'     => $ref->{'PRICE '.$c},
                  'Cost'      => $ref->{'EFFECTIVE PRICE '.$c}
                 };
      $dbh->do("insert into Cache (CacheID, Domain, TLD, Price, Cost, Status, Lookup) values (null, '$results->{'Domain'}', '$results->{'TLD'}', '$results->{'Price'}', '$results->{'Cost'}', '$results->{'Status'}', null)") or die "Error inserting domain cache: ".$dbh->errstr;
      
   }
}

sub isodate {
   my @t = localtime;
   ++$t[4]; $t[5] += 1900;

   return(sprintf('%04d%02d%02d%02d%02d%02d', reverse(splice(@t, 0, 6))));
}
sub getInfo {
   use Net::Telnet ();
   my $domain = shift @_;
   my $tld = shift @_;
   my @results = ();

   eval {
      my $whois = $dbh->selectrow_hashref("select * from TLD where TLD like '\%$tld'");
      die "No whois server known for extension $tld" if ($whois->{'WhoisServer'} !~ /\w/);

      my $session = new Net::Telnet (Timeout => 20, Port => 43); 
      $session->open($whois->{'WhoisServer'});
      
      die "Error opening connection to port 43 on $whois->{'WhoisServer'}" if (!$session);
      
      @results = $session->cmd("$domain.$tld");
   };

   if ($@) {
      return($@);
   } else {
      return(@results);
   }
}
