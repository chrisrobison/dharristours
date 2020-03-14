<?php
   require_once($_SERVER['DOCUMENT_ROOT'] ."/lib/auth.php");
   
   if ($_FILES['userfile']) {
      $path = $boss->docroot."/share" . $in['path'];
      
      $file = $path . '/' . $_FILES['userfile']['name'];
      $file = preg_replace("/\/\//", "/", $file);
      move_uploaded_file($_FILES['userfile']['tmp_name'], $file);

      system("/usr/bin/cvs add ".$file." > /dev/null 2>&1");
      system("/usr/bin/cvs ci -m 'Author: ".$_SESSION['FirstName'].' '.$_SESSION['LastName']."' $file > /dev/null 2>&1");
   }
?>
