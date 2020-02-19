#!/usr/bin/perl
#
#
#

$| = 1; print "Content-type: text/html\n\n";


opendir(D, ".");
   while ($file = readdir D) {
      next if ($file =~ /^\./);
      if (-d $file) {
         push(@dirs, $file);
	 next;
      }	 
      next if ($file !~ /(jpeg|jpg|gif|png|xbm)/i);
      push(@files, $file);
   }   
closedir D;


print "<html><head><title>Images for `pwd`</title></head><body><table width=100% border=1 cellpadding=0 cellspacing=0><tr>";
$cnt = 0;
$nextrow = "<tr>";

foreach $dir (@dirs) {
    print "<td><a href=\"$dir\"><img src=\"/img/folder.gif\" height=50 width=50 border=0 hspace=0 vspace=0 alt=\"$dir\"></a></td>";
    $nextrow .= "<td align=center><a href=\"$dir\">$dir</a></td>";
    ++$cnt;

    if ($cnt > 10) {
       $cnt = 0;
       print "</tr>$nextrow</tr>";
       $nextrow = "<tr>";
    }
}   

foreach $f (@files) {
    print "<td><a href=\"$f\"><img src=\"$f\" height=50 width=50 border=0 hspace=0 vspace=0 alt=\"$f\"></a></td>";
    $nextrow .= "<td align=center><a href=\"$f\">$f</a></td>";
    ++$cnt;

    if ($cnt > 10) {
       $cnt = 0;
       print "</tr>$nextrow</tr>";
       $nextrow = "<tr>";
    }
}   


print "</tr>$nextrow</tr></table></body></html>";

