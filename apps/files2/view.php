<?php
   require($_SERVER['DOCUMENT_ROOT'] . "/lib/auth.php");

   if ($_REQUEST['file']) {
      $file = $_SERVER['DOCUMENT_ROOT'] . '/' . $boss->app->Assets . $_REQUEST['file'];

      if (file_exists($file)) {
         header("Location: " . $boss->app->Assets . $_REQUEST['file']);
      }
   }
?>
