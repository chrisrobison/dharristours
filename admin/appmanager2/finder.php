<?php
   session_start();
   
   if (!isset($_SESSION["Valid"])) {
      header ("Location: /login.php?url=".urlencode($_SERVER['REQUEST_URI']));
      return;
   }
?>
<html>
<head>
   <title>BPM Browser</title>
   <script language='JavaScript' type='text/javascript' src='finder.js'> </script>
   <link rel='stylesheet' type='text/css' href='finder.css' />
</head>
<body>
   <div id='finder'>
      <span id='Module' class='panel'><iframe name='ModuleFrame' id='ModuleFrame' src='browse.php?rsc=Module' class='framed'> </iframe></span>
      <span id='Process' style='width:300px;' class='panel'><iframe name='ProcessFrame' id='ProcessFrame' src='blank.html' class='framed'> </iframe></span>
      <span id='ProcessResource' style='display:none;' class='panel'><iframe name='ProcessResourceFrame' id='ProcessResourceFrame' src='blank.html' class='framed'> </iframe></span>
      <span id='Edit' class='panel'><iframe name='EditFrame' id='EditFrame' src='edit.php?rsc=Module' class='framed'> </iframe></span>
      </div>
   </body>
</html>
