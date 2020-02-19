<?php
   require_once('head.php');
   //print $base;
   if ($base) {
      if (!is_dir($base)) {
         if ($fh = fopen($base, 'r')) {
            if (filesize($base)) {
               $content = fread($fh, filesize($base));
            }
            fclose($fh);

            $type = mime_content_type($base);
            
            if (preg_match("/jpeg|png|gif|xbm|svg|jpg/i", $type)) {
               header("Content-type: $type");
               // header("Content-type: image/png");
               print $content;
               exit;
            } elseif (preg_match("/(\.cgi|\.php|\.pl)$/i", $base) || (preg_match("/text/", $type))) {
               header("Location: editor.php?up=".$in['up']);
               exit;
            } elseif (preg_match("/application/", $type)) {
               header("Content-type: ".$type);
               print $content;
            } else {
               print "<a href='".$in['up']."' target='_blank'>".$base." [$type]</a>";
            }
         }
      } else {
         $dh = opendir($base);
         while ($file = readdir($dh)) {
         }
      }
   }
?>
