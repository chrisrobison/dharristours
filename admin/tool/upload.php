<?php
   require_once($_SERVER['DOCUMENT_ROOT'] ."/lib/auth.php");
   
   $boss = new boss();
//   print_r($_FILES);

   if ($_FILES['userfile']) {
      $path = $_SERVER['DOCUMENT_ROOT'] . $boss->app->Assets . $_COOKIE['path'];
//print "\nPath:$path\n";
      $file = $path . '/' . $_FILES['userfile']['name'];
      $file = preg_replace("/\/\//", "/", $file);
      if (file_exists($file)) {
         move_uploaded_file($_FILES['userfile']['tmp_name'], $file);
      } else { 
         move_uploaded_file($_FILES['userfile']['tmp_name'], $file);
         system("/usr/bin/cvs add ".escapeshellarg($file)." > /dev/null 2>&1");
      }
      system("/usr/bin/cvs ci -m 'Author: {$_SESSION['FirstName']} {$_SESSION['LastName']} <{$_SESSION['Email']}>' ".escapeshellarg($file)." > /dev/null 2>&1");
   }
?>
