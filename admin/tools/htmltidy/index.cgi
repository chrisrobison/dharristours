#!/usr/bin/perl

use CDR::Input;

*in = getInput();
%dat = %in;

if ($in{'URL'} =~ /^http/) {
   $in{'html'} = $dat{'html'} = getURL($in{'URL'});
} elsif ($in{'URL'} =~ /^\//) {
   if (-e $in{'URL'}) {
      open(HTML, $in{'URL'});
         my @html = <HTML>;
      close HTML;
      $in{'html'} = $dat{'html'} = join("", @html);
   }
}

open(TMP, ">/tmp/tidy.tmp");
   print TMP $in{'html'};
close TMP;

open(TIDY, "/usr/local/bin/tidy $opt < /tmp/tidy.tmp |");
   @tidy = <TIDY>;
close TIDY;

$dat{'tidy'} = join("", @tidy);

open(HTML, "tidy.html");
   while ($html = <HTML>) {
      $html =~ s/\#(\w+)\#/$dat{$1}/gi;
      print $html;
   }
close HTML;



sub getURL {
   use LWP;
   my $url = shift @_;

   # Create a user agent object
   my $ua = LWP::UserAgent->new;
   $ua->timeout(5);
   $ua->agent("CDR_Monitor/1.1 ");

   # Create a request
   my $req = HTTP::Request->new(GET => $in{'URL'});

   # Pass request to the user agent and get a response back
   my $res = $ua->request($req);

   # Check the outcome of the response
   if ($res->is_success) {
      my $html = $rec->content;
   } else {
      print "<h2 style='color:red;'>Error retrieving $in{'URL'}</h2>\n";
   }
   
   return $html;
}   

