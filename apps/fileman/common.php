<?php
   require_once("js.php");
   
   $in =& $_REQUEST;

   $base = $_SERVER['DOCUMENT_ROOT'].'/';   // Replace with real account homedir once authentication is setup
   if ($in['path']) $base .= $in['path']; 
   if ($in['up']) {
      $in['up'] = preg_replace("/^node/", '', $in['up']); 
      $base .= $in['up']; 
   }
   $base = preg_replace("/\/\.+/", '', $base);
   
   if (!function_exists('mime_content_type')) {
      function mime_content_type($f) {
          $f = escapeshellarg($f);
          return trim( `/usr/local/bin/file -bi $f` );
      }
   }
   
   function getFiles($base, $recurse=0, $replace) {
      $dir = array();
      $base = preg_replace("/\/*$/", '', $base);
      $base .= '/';

      if (is_dir($base)) {
         if ($dh = opendir($base)) {
            while (($file = readdir($dh)) !== false) {
               if (!preg_match("/^\./", $file)) {
                  if (filetype($base.$file) == 'dir') {
                     $dir[$file] = ($recurse) ? getFiles($base.$file, ($recurse - 1), $replace) : array();
                  } else {
                     $dir[$file] = $file;
                  }
               }
            }
         closedir($dh);
         }
      }
      ksort($dir);
      reset($dir);
      return $dir;
   }
?>
