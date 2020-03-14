<?php
   require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/auth.php");
   require("fileutil.php");

   $in = $_REQUEST;
   $in['path'] = preg_replace("/\/$/", '', $in['path']);
   $in['oempath'] = $in['path'];
   $in['relpath'] = $boss->app->Assets . $in['path'];
   $in['realpath'] = $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets.$in['file'];
   $file = $in['path'] = preg_replace("/^\//", '', $boss->app->Assets . $in['file']);
   $cvsfile = 'sites/base' . $boss->app->Assets . $in['file'];

   if (is_dir($file)) {
      header("Location: ".($_SERVER['SERVER_PORT']=='443')?'https://':'http://'.$_SERVER['SERVER_NAME']."/detail.php?path=".$in['file']);
      exit;
   } else {
      $tmpname = $file;

      if ($in['rev']) {
         $tmpname = tempnam("/tmp", "SS");
         $out = "/usr/bin/cvs co -p -r ".$in['rev']." ".$file." > $tmpname";
         $content = cvs('co', '-p -r '.$in['rev']." ".$cvsfile);

         header('Content-Description: File Transfer');
         header('Content-Type: application/octet-stream');
         header('Content-Disposition: attachment; filename='.basename($file));
         header('Content-Transfer-Encoding: binary');
         header('Expires: 0');
         header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
         header('Pragma: public');
         // system($out);
      } 
      if ((file_exists($in['realpath'])) && (!$content)) {
         $content = file_get_contents($in['realpath']);
      }

      header('Content-Length: ' . strlen($content));
      print $content;

      if (preg_match("/^\/tmp/", $tmpname)) {
         unlink($tmpname);
      }
      exit;
   }
?>
