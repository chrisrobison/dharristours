<?php
   require($_SERVER['DOCUMENT_ROOT'] . '/lib/auth.php');

   $type = $in['ct'] ? $in['ct'] : "application/octet-stream";
   $file = $in['file'] ? $in['file'] : "export.txt";

   header("Cache-Control: public");
   header("Content-Description: File Transfer");
   header("Content-Disposition: attachment; filename=$file");
   header("Content-Type: $type");
   header("Content-Transfer-Encoding: binary");

   print $in['data'];

?>
