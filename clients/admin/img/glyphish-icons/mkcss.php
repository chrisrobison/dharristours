/* CSS Sprite Icon Definition */
.simpleIcon {
   height:48px;
   width:48px;
   background-image:url(/lib/css/icons-black.png);
   display:inline-block;
   margin:4px;
   outline: 2px dotted #333;
   background-color: transparent;
}
span:hover { background-color:#ffffdd; }
<?php
   $file = file("lib/css/icons.txt");
   
   $row = 0; $col = 0;
   foreach ($file as $icon) {
      preg_match("/\d*-(.+?)\.png/", $icon, $match);

      print ".icon-".$match[1]." { background-position: -".($col * 48)."px -".($row * 48)."px; }\n";
      ++$col;
      if ($col==10) {
         ++$row; $col = 0;
      }
   }
?>
