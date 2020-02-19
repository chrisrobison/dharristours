<?php
$css = <<<EOT
/* CSS Sprite Icon Definition */
.simpleIcon16 {
   height:16px;
   width:16px;
   background-image:url(/lib/css/sm-icons.png);
   display:inline-block;
   margin:4px;
   background-color: transparent;
}
span:hover { background-color:#ffffdd; }
EOT;

   $top = 34; $left = 30;
   for ($y=0; $y<13; $y++) {
      for ($x=0; $x<20; $x++) {
         $css .= ".sm_icon-".$x.'_'.$y." { background-position: -".(($x * 31)+$left)."px -".(($y * 16)+($y*25)+$top)."px; }\n";
         $html .= "<span class='simpleIcon16 sm_icon-{$x}_{$y}'> </span>";
      }
      $html .="<br>\n";
   }
   
   $file = file_get_contents("tmp.html");
   $file = preg_replace("/#content#/m", $html, $file);
  file_put_contents("css.html", $file);
  file_put_contents("css.css", $css);

?>
