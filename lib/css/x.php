<?php
   $out = array();

   for ($row=20; $row<79; $row++) {
      $y = $row * -24;
      for ($col=0; $col<10; $col++) {
         $x = $col * -24;

         $out[] = ".icon-r{$row}c{$col} { background-position: {$x}px {$y}px; }";

      }
   }
   print implode("\n", $out);

?>
