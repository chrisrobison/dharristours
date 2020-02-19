#!/usr/bin/perl 

use DotSRS_Client; 

if (@ARGV) { 
    $srs_client = new DotSRS_Client; 

    while ($dom = shift @ARGV) {
      @parts = split(/\./, $dom, 2);
      ($ref) = $srs_client->whois( $parts[0], $parts[1]); 
      print $dom . "\n===================\n";  
      foreach $key (keys %{ $ref }) { 
         print "$key : ", $ref->{$key},"\n"; 
      }
   }
} else { 
   print "Usage: whois <domain>\n"; 
} 
