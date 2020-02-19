<?php
   require_once("js.php");
   require_once("head.php");
      
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
      print "parent.updateTree('".$in['up']."', files, '".$in['up']."');\n";
   }
   ?>
</script>

