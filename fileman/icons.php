<?php
   require_once("common.php");
   
   $in['x'] = (!$in['x']) ? 50 : $in['x'];
   $in['y'] = (!$in['y']) ? 50 : $in['y'];

   $files = getFiles($base, 0, $base);
   $jsobj = js_serialize($files);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
   <head>
      <title>CDRFileman: <?php print $base; ?></title>
      <script language="JavaScript" type='text/javascript' src='lib/fileman.js'>  </script>
      <link rel='stylesheet' type='text/css' href='lib/default.css' />
   </head>
   <body onload="init();" style="overflow: auto;">
      <div id='icons'>
         <?php 
            foreach ($files as $key=>$val) {
               print "<div class='icon' style='float:left;margin:8px;'>";
               print "<a href='$val' target='_blank'>";
               
               if (!is_dir($val)) {
                  $arr = split("/\//", $val);
                  $show = array_pop($arr);
                  if (is_string($val)) {
                     if (preg_match("/\.png|\.gif|\.jpg/i", $val)) {
                        print "<img src='thumb.php?x=125&y=125&img=".$in['up'].'/'.$val."' border='0' />";
                     } else {
                        print "<img src='img/icons/i-regular.png' border='0' height='48' width='48' />";
                     }
                  }
                  print "<div class='iconFile'>$show</div>";
               } else {
                  print "";
               }
               print "</a></div>\n";

            }
         ?>
      </div>
   </body>
</html>
