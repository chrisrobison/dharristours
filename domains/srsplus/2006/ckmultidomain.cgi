#!/usr/bin/perl

use CDR::Input;
use DotSRS_Client;
use Data::Dumper;

# Setup client headers and input if we are in HTTP environment
$| = 1; print "Content-type: text/html\n\n" if ($ENV{'HTTP_HOST'});

# Collect any form input passed in
*in = getInput() if (($ENV{'HTTP_HOST'}) || (@ARGV));
%dat = %in;

my $debug = 0;
my $domain;
my $results;
my $domref = {};
$q = "&#39;";


if ($#ARGV > 0) {
   @tlds = ('com','net','org','biz','info','cc','tv','ws','us');
   $cnt = 0;

   while ($domain = shift @ARGV) {
      ($domain, $tld) = split(/\./, $domain);
      
      foreach $t (@tlds) {
         ++$cnt;
         $domref->{"DOMAIN $cnt"} = $domain;
         $domref->{"TLD $cnt"} = $t;
      }
   }

   print Dumper($domref);
   $results = checkMultiDomain($domref);

   print Dumper($results);
} else {

}

exit 0;



sub checkMultiDomain {
   my $domref = shift @_;

   my $srs_client = new DotSRS_Client;
   my $ref = $srs_client->multidomain_info($domref);
   
   return $ref;
}

__END__
sub checkDomain {
   my $domain = shift @_;
   my $tld = shift @_;

   ($domain, $tld) = split(/\./, $domain) if ($domain =~ /\./);
   $tld =~ s/^\.//;

   my $srs_client = new DotSRS_Client;
   
   my $ref = $srs_client->domain_info($domain, $tld);
   
   return $ref;
}

