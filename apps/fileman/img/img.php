<?php
if (!function_exists('mime_content_type')) {
   function mime_content_type($f) {
      $f = escapeshellarg($f);
      return trim( `file -bi $f` );
   }
}
   $dh = opendir('.');

   while ($file = readdir($dh)) {
      if (preg_match("/image/i", mime_content_type($file))) {
         print "<span title='$file'><img src='$file'></span>";
      }
   }

?>
