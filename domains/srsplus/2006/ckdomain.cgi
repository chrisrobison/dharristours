#!/usr/bin/perl

open(STDERR, ">>/tmp/srsplus-err.log");
use DBI;
use CDR::Input;
use DotSRS_Client;

# Setup client headers and input if we are in HTTP environment
$| = 1; print "Content-type: text/html\n\n" if ($ENV{'HTTP_HOST'});

# Collect any form input passed in
*in = getInput() if (($ENV{'HTTP_HOST'}) || (@ARGV));
%dat = %in;

my $debug = 0;
my $domain;
my $results;
$quote = "&#39;";

if ($in{'DomainName'} =~ /\w/) {
   if ($in{'DomainName'} =~ /[^a-z0-9\-]/) {
      $dat{'error'} = "Invalid domain name specified ($in{'DomainName'}).\\nDomain names may only have the characters a to z, 0 to 9, and $quote&#45;$quote.\\n\\nPlease choose a different domain name.";
      $dat{'signal'} = "/img/status_working_ani.gif";
   } else {   
      $domain = $in{'DomainName'}.$in{'tld'};
      
      print "Checking $in{'DomainName'}$in{'tld'}<br><pre>" if $debug;
      
      $results = checkDomain($in{'DomainName'}, $in{'tld'});
      
      if ($debug) {
         use Data::Dumper;
         print Dumper($results)."</pre>";
      }
      if (($results->{'DOMAIN STATUS'} =~ /UNAVAILABLE/) || (!$results->{'DOMAIN STATUS'})) {
         $dat{'signal'} = "/img/status_red_ani.gif";
      } else {
         $dat{'signal'} = "/img/status_green.png";
      }
   }
}   

$dat{'signal'} = "/img/status_dim.png" if (!$dat{'signal'});
$dat{'alert'} = "alert('$dat{'error'}');" if ($dat{'error'});

open(HTML, "pages/CheckDomain.html") or die "Error opening pages/CheckDomain.html for reading: $!";
   while ($html = <HTML>) {
      $html =~ s/\#(\w+)\#/$dat{$1}/gi;
      print $html;
   }
close HTML;

exit 0;



sub checkDomain {
   my $domain = shift @_;
   my $tld = shift @_;

   ($domain, $tld) = split(/\./, $domain) if ($domain =~ /\./);
   $tld =~ s/^\.//;

   my $srs_client = new DotSRS_Client;
   
   my $ref = $srs_client->domain_info($domain, $tld);
   
   return $ref;
}

__END__
