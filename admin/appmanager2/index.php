<?php
   session_start();
   
   if (!isset($_SESSION["Valid"])) {
      header ("Location: /admin/login.php?url=".urlencode($_SERVER['REQUEST_URI']));
      return;
   }
?>
<html>
<head>
   <title>Navigation Editor</title>
   <script language='JavaScript' type='text/javascript' src='finder.js'> </script>
   <link rel='stylesheet' type='text/css' href='finder.css' />
</head>
<body>
   <div id='finder'>
      <div id='Nav' class='panel'><iframe name='NavFrame' id='NavFrame' src='browse.php?ParentID=0' class='framed'> </iframe></div>
      <div id='Process' class='panel'><iframe name='ProcessFrame' id='ProcessFrame' src='blank.html' class='framed'> </iframe></div>
      <div id='ProcessResource' style='display:none;' class='panel'><iframe name='ProcessResourceFrame' id='ProcessResourceFrame' src='blank.html' class='framed'> </iframe></div>
      <div id='Edit' class='panel'><iframe name='EditFrame' id='EditFrame' src='edit.php?rsc=Nav' class='framed'> </iframe></div>
      </div>
   </body>
</html>
