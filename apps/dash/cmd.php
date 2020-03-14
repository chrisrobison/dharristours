<?php
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
   
   $in = $_REQUEST;
   $out = array(); 
   
   $who = $_SESSION['Email'];
   $safe['who'] = escapeshellarg($who);
   $safe['inpath'] = escapeshellarg($in['path']);
   
   if ($in['x'] == "mkdir") {
      $path = preg_replace("/\.\.\//", '', $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets.'/'.$in['name']);
      $success = mkdir($path, 0775, true);
      $showpath = $in['name'];
      $safe['path'] = escapeshellarg($path);

      $cvs = `/usr/bin/cvs add {$safe['path']}`;
      $cvs = `/usr/bin/cvs ci -m '{$safe['who']} added {$safe['inpath']}' {$safe['path']}`;

      if ($success) {
         $out['result'] = "Directory successfully created: ".preg_replace("|\\/|", '/', $showpath);
      } else { 
         $out['error'] = $out['result'] = "Error creating directory: ".$showpath;
      }
   } else if ($in['x'] == "save") {
      $path = preg_replace("/\.\.\//", '', $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets.$in['path']);
      $safe['path'] = escapeshellarg($path);
      if (file_exists($path)) {
         $cvs = `/usr/bin/cvs update $path`;
         if (preg_match("/^\?/m", $cvs)) {
            $cvs = `/usr/bin/cvs add {$safe['path']}`;
            $cvs = `/usr/bin/cvs ci -m '{$safe['who']} added {$safe['inpath']}' {$safe['path']}`;
         }
         file_put_contents($path, $in['content']);
         $cvs = `/usr/bin/cvs ci -m '{$safe['inpath']} updated by {$safe['who']}' {$safe['path']}`;
         $out['result'] = "Saved {$in['path']}";
      } else {
         file_put_contents($path, $in['content']);
         $cvs = `/usr/bin/cvs add {$safe['path']}`;
         $cvs = `/usr/bin/cvs ci -m '{$safe['inpath']} created by {$safe['who']}' {$safe['path']}`;
         $out['result'] = "Created new file {$in['path']}";
      }
   } else if ($in['x'] == "delete") {
      $path = preg_replace("/\.\.\//", '', $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets.$in['name']);
      $showpath = $in['name'];
      if (is_dir($path)) {
         if (rmdir($path)) {
            $cvs = `/usr/bin/cvs delete $path`;
            $cvs = `/usr/bin/cvs ci -m 'Removed $path' $path`;
            $out['result'] = "Successfully removed $showpath";
         } else {
            $out['result'] = $out['error'] = "Error removing $showpath: (Directory must be empty and permissions allow removal)";
         }
      } else if (file_exists($path)) {
         $cvs = `/usr/bin/cvs delete -f "$path"`;
         $cvs .= `/usr/bin/cvs ci -m 'Removed {$in['path']}' "$path"`;
         if (file_exists($path)) $cvs .= `/bin/rm "$path"`;

         if (!file_exists($path)) {
            $out['result'] = "Successfully removed {$in['path']}";
         } else {
            $out['result'] = "Error removing '{$in['path']}': $cvs";
         }
      } else {
         $out['result'] = $out['error'] = "Error removing {$in['path']}";
      }

   
   }
   if ($out) {
      print json_encode($out);
   }
?>

