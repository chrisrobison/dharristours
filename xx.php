<?php
   $x = "This is my #replace# #type#";
   $in['replace'] = "awesome";
   $in['type'] = "string";

   $out = preg_replace("/\#([^\#]*)\#/e", "\$in[$1]", $x);

   print $out;
?>
