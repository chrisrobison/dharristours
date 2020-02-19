<?php
   require($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');
   
   if ($in['rsc'] && $in['id']) {
      $current = $boss->getObject($in['rsc'], $in['id']);
   }
?>
<!DOCTYPE html> 
<html>
   <head>
      <meta charset="utf-8">
      <title></title>
      <link href='//fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
      <link href='/lib/css/core.css' rel='stylesheet' type='text/css'>
      <link href="<?php print $boss->app->Assets . "/" . $boss->app->CSS; ?>" rel="stylesheet" type="text/css" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script defer="true" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
      <style>
         input { border:0px; }
      </style>
  </head>
   <body>
      <div id='main'>
         <?php 
            // $boss->showForm($process); 
            include($boss->getPath($process->Form));
         ?>
      </div>
   </body>
   <script type='text/javascript'>
      (function() {
         var current = <?php print json_encode($current); ?>;

         
      })();
   </script>
</html>
