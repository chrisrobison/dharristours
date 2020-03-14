<?php
   require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/auth.php");
   require("fileutil.php");

   $in = $_REQUEST;
   $in['path'] = preg_replace("/\/$/", '', $in['path']);
   $in['oempath'] = $in['path'];
   $in['relpath'] = $boss->app->Assets . $in['path'];
   $file = $in['path'] = $_SERVER['DOCUMENT_ROOT'] . $boss->app->Assets . '/share' . $in['file'];
   $cvsfile = 'sites/base' . $boss->app->Assets . $in['file'];

   if (is_dir($file)) {
      header("Location: detail.php?path=".$in['file']);
      exit;
   } else {
      $tmpname = $file;

      if ($in['rev']) {
         $tmpname = tempnam("/tmp", "SS");
         $out = "/usr/bin/cvs co -p -r ".$in['rev']." ".$cvsfile." > $tmpname";
         system($out);
      } 
      
      if (file_exists($tmpname)) {
         header('Content-Description: File Transfer');
         header('Content-Type: application/octet-stream');
         header('Content-Disposition: attachment; filename='.basename($file));
         header('Content-Transfer-Encoding: binary');
         header('Expires: 0');
         header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
         header('Pragma: public');
         header('Content-Length: ' . filesize($tmpname));
         ob_clean();
         flush();
         readfile($tmpname);
      }
      if (preg_match("/^\/tmp/", $tmpname)) {
         unlink($tmpname);
      }
      exit;
   }
?>
