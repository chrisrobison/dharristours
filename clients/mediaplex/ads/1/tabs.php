<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title></title>
      <link rel="stylesheet" type="text/css" href="tabs.css" />
  </head>
   <body>
      <div id="mojo_container">
     </div>
   </body>
   <script type="text/javascript" src="mojo2.js"></script>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
   <script type='text/javascript'>
      $(document).ready(function() {
         $.getJSON("/clients/mediaplex/genad.php?out=json&ID=<?php print $_REQUEST['ID']; ?>", function(data) {
            mojoAd = mojo2(data);
         });
      });
   </script>
</html>
