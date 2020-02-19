<?php
   $file = file("icons.txt");
   
   $row = 0; $col = 0;
   foreach ($file as $icon) {
      preg_match("/\d*-(.+?)\.png/", $icon, $match);

      print "<span class='.sIcon .icon-".$match[1]."'> </span>";
      ++$col;
      if ($col==10) {
         print "\n";
         ++$row; $col = 0;
      }
   }
?>
