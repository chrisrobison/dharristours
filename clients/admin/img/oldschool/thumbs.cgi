#!/usr/bin/perl
#
#
#

$| = 1; print "Content-type: text/html\n\n";


opendir(D, ".");
   while ($file = readdir D) {
      next if ($file !~ /(jpeg|jpg|gif|png)/i);
      print "<a href=\"$file\"><img src=\"$file\" height=50 width=50></a>";
      ++$cnt;
      if ($cnt > 18) {
         print "<br>";
	 $cnt = 0;
      }	 
   }   
closedir D;

