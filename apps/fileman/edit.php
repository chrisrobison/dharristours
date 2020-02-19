<?php
   require_once("/lib/auth.php");
   $in =& $_REQUEST;
   $base = $_SERVER['DOCUMENT_ROOT'];
   
   if ($in['up']) {
      $base .= $in['up'];
      $fh = fopen($base, 'r');
      $contents = fread($fh, filesize($base));
      fclose($fh);

      print "<pre>".$contents."</pre>";
   }
?>
