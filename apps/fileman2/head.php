<?php
   session_start();
   
   $in =& $_REQUEST;
   
   $base = $_SERVER['DOCUMENT_ROOT'];   // Replace with real account homedir once authentication is setup
   if ($in['path']) $base .= $in['path']; 
   if ($in['up']) {
      $in['up'] = preg_replace("/^node/", '', $in['up']); 
      $base .= $in['up']; 
   }
   $base = preg_replace("/\.\.\//", '', $base);

   function mime_content_type($file) {
      $f = escapeshellarg($file);
      return trim( `file -bi $f` );
   }
?>
