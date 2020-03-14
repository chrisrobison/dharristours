<?php
   require_once("head.php");

   if ($in['up']) {
      $base .= $in['up'];
      $fh = fopen($base, 'r');
      $contents = fread($fh, filesize($base));
      fclose($fh);

      print "<pre>".$contents."</pre>";
   }
?>
