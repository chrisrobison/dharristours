<?php
   require($_SERVER['DOCUMENT_ROOT'] . '/lib/auth.php');
?>
<!DOCTYPE html> 
<html>
   <head>
      <meta charset="utf-8">
      <title></title>
      <link href='//fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
      <link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
      <style>
         body { margin:0;padding:0;font-size:14px;font-family:"Open Sans", "Helvetica Neue", Optima, Verdana, sans-serif; }
         h1, h2, h3, h4, h5 { font-family: Quicksand, "Helvetica Neue", Optima, Verdana, sans-serif; }
         a { text-decoration:none;color:#00c; }
         a:hover { text-decoration:underline; }
         a:visited { color:#006; }
         a:active { color:#e00;display:inline-block;top:2px; }
         #main { margin:0px; cursor: default; position:absolute; top:0px; bottom:0px; left:0px; right:0px; overflow:hidden;}
         .closed { display:none; }
         #browse { position:absolute; top:0px;bottom:0px;width:18%; border-right:2px inset #ccc; left:0px; height:100%; }
         #query { position:absolute; top:0px;bottom:0px; left:18%; border-left:2px outset #ccc; right:0px; height:100%; width:81%;}
      </style>
  </head>
   <body>
      <div id='main'>
         <iframe id='browse' src='/files/browse/'></iframe>
         <iframe id='query' src='/files/query/'></iframe>
      </div>
   </body>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type='text/javascript'>
      $(document).ready(function() {
      });
   </script>
</html>
