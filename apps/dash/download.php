<?php
   require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/auth.php");
   require("fileutil.php");

   $in = $_REQUEST;
   $in['path'] = preg_replace("/\/$/", '', $in['path']);
   $in['oempath'] = $in['path'];
   $in['relpath'] = $boss->app->Assets . $in['path'];
   $in['realpath'] = $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets.$in['file'];
   $cvsfile = $file = $in['path'] = preg_replace("/^\//", '', $boss->app->Assets . $in['file']);
   // $cvsfile = 'sites/base' . $boss->app->Assets . $in['file'];
chdir($_SERVER['DOCUMENT_ROOT']);
   if (is_dir($file)) {
      header("Location: ".($_SERVER['SERVER_PORT']=='443')?'https://':'http://'.$_SERVER['SERVER_NAME']."/detail.php?path=".$in['file']);
      exit;
   } else {
      $tmpname = $file;

      if ($in['rev']) {
         $tmpname = tempnam("/tmp", "SS");
         $out = "/usr/bin/cvs co -p -r ".$in['rev']." ".$file;
         // $content2 = cvs('co', '-p -r '.$in['rev']." ".$cvsfile);
         $content = `$out`;
         
         header('Content-Description: File Transfer');
         header('Content-Type: application/octet-stream');
         header('Content-Disposition: attachment; filename='.basename($file));
         header('Content-Transfer-Encoding: binary');
         header('Expires: 0');
         header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
         header('Pragma: public');
      } 
      if (!$content && (file_exists($in['realpath']))) {
         // $content = file_get_contents($in['realpath']);
      }

      header('Content-Length: ' . strlen($content));
      print $content;

      if (preg_match("/^\/tmp/", $tmpname)) {
         unlink($tmpname);
      }
      exit;
   }
?>
