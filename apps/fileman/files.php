<?php
   require_once("js.php");
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");

   $in =& $_REQUEST;

   $base = $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets;   // Replace with real account homedir once authentication is setup
   if ($in['path']) $base .= $in['path']; 
   if ($in['up']) {
      $in['up'] = preg_replace("/^node/", '', $in['up']); 
      $base .= $in['up']; 
   }

   $files = getFiles($base, 0);
   $jsobj = js_serialize($files);

   function getFiles($base, $recurse=0) {
      $dir = array();
      $base = preg_replace("/\/*$/", '', $base);
      $base .= '/';

      if (is_dir($base)) {
         if ($dh = opendir($base)) {
            while (($file = readdir($dh)) !== false) {
               if (!preg_match("/^\./", $file)) {
                  if (filetype($base.$file) == 'dir') {
                     $dir[$file] = ($recurse) ? getFiles($base.$file, ($recurse - 1)) : array();
                  } else {
                     $dir[$file] = $file;
                  }
               }
            }
         closedir($dh);
         }
      }
      ksort($dir);
      reset($dir);
      return $dir;
   }
?>
<script language='JavaScript' type='text/javascript'>
   var files = <?php print $jsobj; ?>;
   <?php 
   if ($in['up']) {
      print "top.updateTree('".$in['up']."', files, '".$in['up']."');\n";
   }
   ?>
</script>

