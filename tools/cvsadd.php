#!/usr/local/bin/php
<?php
  
   if (count($argv)==1) {
      $files = array(".");
   } else {
      array_shift($argv);
      $files = $argv;
   }
   foreach ($files as $file) {
      cvsup($file);
   }
   $dh = popen('/usr/bin/cvs ci -m "Automated checkin" '.implode(' ', $files).' 2>&1', 'r');
      while (($buffer = fgets($dh, 1024)) !== false) {
         print $buffer;
      }
   pclose($dh);

   function cvsup($dir) {
      $slashes = preg_replace("/[^\/]*/", '', $dir);
      $lvl = strlen($slashes);
      print str_repeat("\t", $lvl)."Updating $dir...\n";
      $dh = popen("/usr/bin/cvs up '$dir' 2>&1", 'r');
      while (($buffer = fgets($dh, 2048)) !== false) {
         if (preg_match("/^\?/", $buffer)) {
            $tmp = rtrim(preg_replace("/^\?\s/", '', $buffer));
            print str_repeat("\t", $lvl)."Adding '$tmp'\n";
            if (!preg_match("/(\.swp|\.bak|\.tmp)$/i", $tmp)) {
               system("/usr/bin/cvs add '$tmp'");
            }
            if (is_dir($tmp)) {
               print str_repeat("\t", $lvl)."Recursing into '$tmp'...\n";
               cvsup($tmp, $lvl++);
            }
            
         } 
         /*
         else {
            if (preg_match("/^([A-Z])\s(.*)/", $buffer, $match)) {
               print "***CONFLICT in $buffer\n";
               $conflicts[] = $buffer;
            }
         }
         */
      }
      pclose($dh);
   }
?>
