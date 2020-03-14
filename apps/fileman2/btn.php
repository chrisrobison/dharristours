<?php
   session_start();
   
   $in =& $_REQUEST;
   $maillogin = $in['user_id'] = 'netoasis.net';
   $pass = $_SESSION['pass'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
   <head>
      <title>CDRMail Outliner</title>
      <link rel='stylesheet' type='text/css' href='default.css' />
      <script language='JavaScript' type='text/javascript' src='lib/ui.js'> </script>
   </head>
   <body>
      <div onmousedown="dragStart(event, 'buttons')" id='buttons'><div class='btn'><img src='img/icons/stock_save-16.png' class='icon'></div>
   </body>
</html>
