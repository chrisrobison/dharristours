<?php
   $lines = file("icons32.css");

   $out = array();
   $cnt = count($lines);
   for ($i=0; $i<$cnt; $i++) {
      
      $lines[$i] = rtrim($lines[$i]);

      if (preg_match("/^([^\s]*)\s\{\sbackground-position:\s([^\s]*)\s([^;]*);/", $lines[$i], $match)) {
         $x = preg_replace("/\D/", '', $match[2]);
         $y = preg_replace("/\D/", '', $match[3]);
         $x = ($x / 48) * -32;
         $y = ($y / 48) * -32;

         
         $out[] = $match[1]." { background-position: {$x}px {$y}px; }";
      } else {
         $out[] = $lines[$i];
      }
   }
   print implode("\n", $out);

?>
