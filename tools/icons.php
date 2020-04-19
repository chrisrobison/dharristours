<html>
<head> <link rel='stylesheet' type='text/css' href='/lib/css/icons.css' /></head>
<body>
<?php
   $file = file($_SERVER['DOCUMENT_ROOT']."/lib/css/icons.txt");
   
   $row = 0; $col = 0;
   foreach ($file as $icon) {
      preg_match("/\d*-(.+?)\.png/", $icon, $match);

      print "<span class='simpleIcon icon-".$match[1]."' title='".$match[1]."'></span>";
      ++$col;
      if ($col==10) {
         print "<br/>\n";
         ++$row; $col = 0;
      }
   }
?>
</body></html>
