<?php
   include_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");   
   $in =& $_REQUEST;

   if ($in['up']) {
      $base = $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets;   // Replace with real account homedir once authentication is setup
      if ($in['path']) $base .= $in['path']; 
      if ($in['up']) {
         $in['up'] = preg_replace("/^node/", '', $in['up']); 
         $base .= $in['up']; 
      }
      $base = preg_replace("/\.\.\//", '', $base);

      $fh = fopen($base, 'r');
      $content = fread($fh, filesize($base));
      fclose($fh);

      $type = mime_content_type($base);

      if (preg_match("/jpeg|png|gif|xbm/i", $type)) {
         header("Content-type: $type\n\n");
         print $content;
      } elseif (preg_match("/(\.cgi|\.php|\.pl)$/i", $base) || (preg_match("/application|text/", $type))) {
         header("Location: editor.php?up=".$in['up']."\n\n");
         exit;
      } else {
         print "<a href='".$in['up']."' target='_blank'>".$base." [$type]</a>";
      }
   }

   function mime_content_type($file) {
      $f = escapeshellarg($file);
      return trim( `file -bi $f` );
   }
?>
