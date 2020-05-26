<?php
   $in = $_REQUEST;
   
   $mode = $in['mode'] ? $in['mode'] : 'driving';
   $lang = $in['lang'] ? $in['lang'] : 'en-US';
   $unit = $in['unit'] ? $in['unit'] : 'imperial';
   $origin = urlencode($in['origin']);
   $dest = urlencode($in['dest']);

   //$js = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$dest}&mode={$mode}&language={$lang}&sensor=false&travel_model=pessimistic&units={$unit}");
   $url = "https://www.google.com/maps/dir/$origin/$dest";
   $js = file_get_contents("https://www.google.com/maps/dir/$origin/$dest");
   // header("Content-type: application/javascript");

   print "<base href='".$url."'>\n";
   print $js;

?>
