<?php
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");

   $base = $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets;
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
