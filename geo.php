<?php
   $js = file_get_contents("//maps.googleapis.com/maps/api/distancematrix/json?origins=621%20Holloway%20Ave,%20SF%20CA&destinations=Lake%20Tahoe,%20CA&mode=driving&language=en-US&sensor=false&units=imperial");
   print $js;
?>
<!DOCTYPE html> 
<html>
   <head>
      <meta charset="utf-8">
      <title></title>
      <link href='//fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
      <style>
         body { margin:0;padding:0;font-size:14px;font-family:Georgia, Times, serif; }
         h1, h2, h3, h4, h5 { font-family: Quicksand, "Helvetica Neue", Optima, Verdana, sans-serif; }
         a { text-decoration:none;color:#00c; }
         a:hover { text-decoration:underline; }
         a:visited { color:#006; }
         a:active { color:#e00;display:inline-block;top:2px; }
         #main { margin:1em; }
      </style>
  </head>
   <body>
      <div id='main'>
         
      </div>
   </body>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type='text/javascript'>
      $(document).ready(function() {
         
      });
   </script>
</html>
