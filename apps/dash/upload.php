<?php
   require_once($_SERVER['DOCUMENT_ROOT'] ."/lib/auth.php");
   
   $boss = new boss();
//   print_r($_FILES);

   if ($_FILES['userfile']) {
      $path = $_SERVER['DOCUMENT_ROOT'] . $boss->app->Assets . $_COOKIE['path'];
//print "\nPath:$path\n";
      $file = $path . '/' . $_FILES['userfile']['name'];
      $file = preg_replace("/\/\//", "/", $file);
      $dirname = dirname($file);
      chdir($dirname);
      if ($_GET['dnr'] && file_exists($file)) {
         $cnt = 0;
         while (file_exists($file)) {
            $parts = preg_split("/\./", $file);
            $cnt++;
            $ext = array_pop($parts);
            $file = implode('.', $parts).$cnt.'.'.$ext;
         }
         move_uploaded_file($_FILES['userfile']['tmp_name'], $file);
      } else { 
         move_uploaded_file($_FILES['userfile']['tmp_name'], $file);
         system("/usr/bin/cvs add ".escapeshellarg($file)." > /dev/null 2>&1");
      }
      system("/usr/bin/cvs ci -m 'Author: {$_SESSION['FirstName']} {$_SESSION['LastName']} <{$_SESSION['Email']}>' ".escapeshellarg($file)." > /dev/null 2>&1");
      
      if (preg_match("/\.zip$/", $file)) {
         $result = `/usr/local/bin/unzip $file`;
      }
      if (preg_match("/\.(tar.gz|tgz)$/", $file)) {
         $result = `/usr/bin/tar -zxvf $file`;
      }
      

      // "<li class='file ext_$ext'><a href='#{$fullpath}' type='$type' rel=\"" . $fullpath . "\">" . htmlentities($file) . "</a></li>";
   }
?>
