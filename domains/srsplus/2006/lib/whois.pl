sub lookupWhoisContacts {
        my $domain = shift @_;

        my ($name, $ext) = split(/\./, $domain, 2);

        my $results = fetchWhois($domain, $ext);
        my @results = split(/\n/, $results);
   
        my $adminflag = 0;
        my $email = '';

        foreach my $r (@results) {
                if ($r =~ /admin/i) {
                        $adminflag = 1;
                }
                if (($r =~ /([\w\-\+\#\$\%\^\&\(\)\<\>]+\@\S+\.\S+)/) && ($adminflag)) {
                        print "Admin Contact Email for $domain: $1\n" if $debug;
                        $email = $1;
                        last;
                }
        }
        return $email || 'UNKNOWN';
}

sub fetchWhois {
        use Net::Telnet;
        my $domain = shift @_;
   my $ext = shift @_;
        my $whoisserver = shift @_;
        
        if (!$whoisserver) {
                my $whoisServer = whoisServers() if (!$whoisServer);
                $whoisserver = ($whoisServer->{$ext}) ? $whoisServer->{$ext} : 'whois.internic.net';
        }

        
        my $whois = new Net::Telnet (Telnetmode => 0);
        $whois->open(   Host => $whoisserver,
                                                Port => 43);
        $whois->print($domain."\n");
        
        my $out = '';

        while (my $line = $whois->getline()) {
                $out .= $line;
                if ($line =~ /Whois\sServer\:\s(.*)/) {
                        $newserver = $1;
                        $whois->close();
                        $out = fetchWhois($domain, $ext, $newserver);
                        last;
                }
                        
        }
        return $out;
}

sub whoisServers {
        my $whoisServers = {
                 'al'  => 'whois.ripe.net',      'am'  => 'whois.ripe.net',       
                 'at'  => 'whois.ripe.net',      'au'  => 'whois.aunic.net',      
                 'az'  => 'whois.ripe.net',       
                 'ba'  => 'whois.ripe.net',      'be'  => 'whois.ripe.net',       
                 'bg'  => 'whois.ripe.net',      'by'  => 'whois.ripe.net',
                 'ca'  => 'whois.cdnnet.ca',     'ch'  => 'whois.nic.ch',          
                 'com' => 'whois.internic.net',
                 'cy'  => 'whois.ripe.net',      'cz'  => 'whois.ripe.net',
                 'de'  => 'whois.denic.de',      'dk'  => 'whois.dk-hostmaster.dk',
                 'dz'  => 'whois.ripe.net', 
                 'edu' => 'whois.internic.net',  'ee'  => 'whois.ripe.net',
                 'eg'  => 'whois.ripe.net',      'es'  => 'whois.ripe.net',
                 'fi'  => 'whois.ripe.net',      'fo'  => 'whois.ripe.net',
                 'fr'  => 'whois.nic.fr',
                 'gb'  => 'whois.ripe.net',      'ge'  => 'whois.ripe.net',
                 'gov' => 'whois.nic.gov',       'gr'  => 'whois.ripe.net',
                 'hr'  => 'whois.ripe.net',      'hu'  => 'whois.ripe.net',
                 'ie'  => 'whois.ripe.net',      'il'  => 'whois.ripe.net',
                 'is'  => 'whois.ripe.net',      'it'  => 'whois.ripe.net',
                 'jp'  => 'whois.nic.ad.jp',
                 'kr'  => 'whois.krnic.net',
                 'li'  => 'whois.ripe.net',      'lt'  => 'whois.ripe.net',
                 'lu'  => 'whois.ripe.net',      'lv'  => 'whois.ripe.net',
                 'ma'  => 'whois.ripe.net',      'md'  => 'whois.ripe.net',
                 'mil' => 'whois.nic.mil',       'mk'  => 'whois.ripe.net',
                 'mt'  => 'whois.ripe.net',      'mx'  => 'whois.nic.mx',
                 'net' => 'whois.internic.net',  'nl'  => 'whois.ripe.net',
                 'no'  => 'whois.norid.no',      'nz'  => 'whois.domainz.net.nz',
                 'org' => 'whois.publicinterestregistry.org',
                 'pl'  => 'whois.ripe.net',      'pt'  => 'whois.ripe.net',
                 'ro'  => 'whois.ripe.net',      'ru'  => 'whois.ripe.net',
                 'se'  => 'whois.ripe.net',      'sg'  => 'whois.nic.net.sg',
                 'si'  => 'whois.ripe.net',      'sk'  => 'whois.ripe.net',
                 'sm'  => 'whois.ripe.net',      'su'  => 'whois.ripe.net',
                 'tn'  => 'whois.ripe.net',      'tr'  => 'whois.ripe.net',
                 'tw'  => 'whois.twnic.net',
                 'ua'  => 'whois.ripe.net',      

                 'uk'     => 'whois.nic.uk',     
                 'gov.uk' => 'whois.ja.net',
                 'ac.uk'  => 'whois.ja.net', 
                 'eu.com' => 'whois.centralnic.com',
                 'uk.com' => 'whois.centralnic.com',
                 'uk.net' => 'whois.centralnic.com',
                 'gb.com' => 'whois.centralnic.com',
                 'gb.net' => 'whois.centralnic.com',

                 'us'  => 'whois.isi.edu',
                 'va'    => 'whois.ripe.net',
                 'yu'  => 'whois.ripe.net' 
        };
        return $whoisServers;
}

1;
