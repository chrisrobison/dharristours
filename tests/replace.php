#!/usr/local/bin/php
<?php
   $txt = "This is my #replaceable# content with hash #keys#";

   $vals['replaceable'] = "static";
   $vals['keys'] = "values";
   print preg_replace("/\#(.+?)\#/e", "\$vals[$1]", $txt); 
?>
