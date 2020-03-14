<?php
   require_once("../../lib/boss_class.php");
   
   $boss = new boss();

   if ($_FILES['myFile']) {
      $path = $_SERVER['DOCUMENT_ROOT'] . '/' . $boss->app->Assets . '/';
      print_r($_FILES);
      print_r($boss);
      print_r($_SERVER);
      //move_uploaded_file($_FILES['myFile']['tmp_name'], $boss->app->Assets . '/' . $_FILES['myFile']['filename']);
   }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
     <title></title>
     <link href="/lib/css/main.css" rel="stylesheet" type="text/css" />
   </head>
   <body class='bodytext' style='padding:1em;'>
        <div>
           <form enctype="multipart/form-data" method="POST">
             <span>File:</span> 
             <input type="file" name="myFile" />
             <input type="submit" value="Upload" />
           </form>
        </div>
   </body>
</html>
