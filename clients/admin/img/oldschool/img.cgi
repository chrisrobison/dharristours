#!/usr/bin/perl
#
#
$| = 1; print "Content-type: text/html\n\n";
use Image::Size;
chomp($pwd = `pwd`);

opendir(D, "./");
   while ($file = readdir D) {
      next if ($file =~ /^\./);
      if (-d $file) {
         push(@dirs, $file);
	 next;
      }
      next if ($file eq "tmp.gif");
      next if ($file !~ /(gif|jpg|png|xbm|jpeg)$/i);
      push(@imgs, $file);
      $size = (-s $file);
      $size{$file} = $size;
      ($width{$file}, $height{$file}) = imgsize($file);
   }
closedir D;
@imgs = sort(@imgs);
$cols = 5;
$count = 0;
$table = "<tr>";

foreach $d (@dirs) {
   $table .= "<td valign=top width=32 height=32 align=center><a href=\"$d\"><img src=\"/icons/folder.gif\" height=32 width=32 vspace=0 hspace=0 border=0><br><b>$d</b></a></td>";
   $count++;
   if ($count > $cols) {
      $table .= "</tr><tr>";
      $count = 0;
   }
}

foreach $i (@imgs) {
   $width = $width{$i} || 50;
   $height = $height{$i} || 50;
   $colors = $colors{$i} || "unknown";
   
   $size = $size{$i};
   $size = $size / 1024;
   $size = sprintf("%0.1f", $size);
   
   if (($width > 32) && ($height > 50)) {
      while (($width > 32) && ($height > 50)) {
         $width = $width / 2;
	 $height = $height / 2;
      }
   }
   if ($width > 50) {
      while ($width > 50) {
         $width = $width / 2;
	 $height = $height / 2;
      }
   }

   $table .= "<td valign=top width=$width align=left NOWRAP><a href=\"$i\"><center><img src=\"$i\" height=$height width=$width vspace=0 hspace=0 border=0></center><br>$i<br>${size}k </a></td>";
   $count++;
   if ($count > $cols) {
      $table .= "</tr><tr>";
      $count = 0;
   }
}
$table .= "</tr></table>";
print <<EOT;
<html><head><title>Thumbnails for $pwd</title></head>
<body>
<table border=2 cellpadding=2 cellspacing=1 cols=$cols>$table</table>
</body></html>
EOT

