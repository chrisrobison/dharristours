<?php
   require($_SERVER['DOCUMENT_ROOT'] . "/lib/auth.php");
?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <title>Employee Organization Tree</title>

      <!-- CSS Files -->
      <link type="text/css" href="css/base.css" rel="stylesheet" />
      <link type="text/css" href="css/hypertree.css" rel="stylesheet" />

      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
      <!--[if IE]><script language="javascript" type="text/javascript" src="excanvas.js"></script><![endif]-->
      <script language="javascript" type="text/javascript" src="jit-yc.js"></script>
      <script language="javascript" type="text/javascript" src="orgchart.js"></script>
   </head>

   <body onload="init(<?php print $in['id'] ? $in['id'] : 1; ?>);">
      <div id="container">
         <div id="left-container"> </div>
         
         <div id="center-container">
             <div id="infovis"></div>    
         </div>

         <div id="right-container">
            <div id="inner-details"></div>
         </div>

         <div id="log"></div>
      </div>
   </body>
</html>
