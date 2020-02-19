<?php
   require_once($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');
?>
<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title>Code Viewer</title>
  </head>
   <body>
      <div id='main'>
         <?php
            $path = $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets.$in['path'];
            $code = file_get_contents($path);
            if ($code) {
               highlight_string($code);
            }
         ?>
      </div>
   </body>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type='text/javascript'>
      $(document).ready(function() {
         
      });
   </script>
</html>
