<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
   <head>
      <title>mpc</title>
      <script language='Javascript' type='text/javascript' src='lib/js/default.js'> </script>
      <script language='Javascript' type='text/javascript'>
         <?php print $out; ?>
      </script>
      <link rel='stylesheet' type='text/css' href='lib/css/default.css' />
      <link rel='stylesheet' type='text/css' href='lib/css/ui.css' />
   </head>
   <body>
   <div id='content' style='margin:2em;'>
   <h1>Recent CVS Activity</h1>
   <?php 
      if (!preg_match("/mpc/", $_SERVER['HTTP_HOST'])) {
         $fh = popen("./cvsreport ".$_SERVER['HTTP_HOST'], 'r');
         while ($buffer = fread($fh, 32768)) {
            print $buffer;
         }
         pclose($fh);
      } else {
         include("activity.html");
      }
   ?>
   </div>
   </body>
</html>
