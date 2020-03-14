<?php
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
   
   $in = $_REQUEST;
   $path = preg_replace("/\.\.\//", '', '/share/'.$in['name']);
//print_r($in);
//print "<h1>".$path."</h1>";
   if ($in['x'] == "mkdir") {
      $success = mkdir($path, 0775, true);

      if ($success) {
         print "Directory successfully created: ".$path;
      } else { 
         print "Error creating directory: ".$path;
      }
   } else if ($in['x'] == "delete") {
      if (is_dir($path)) {
         if (rmdir($path)) {
            print "Successfully removed $path";
         } else {
            print "Error removing $path: (Directory must be empty and permissions allow removal)";
         }
      } else {
         if (file_exists($path)) {
            if (unlink($path)) {
               print "Successfully removed $path";
            } else {
               print "Error removing $path";
            }
         }
      }
   }
?>

