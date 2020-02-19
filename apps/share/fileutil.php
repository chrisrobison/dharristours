<?php 

//$log = listFiles('/home/cdr/domains/dev.sscsf.com/base/clients/sanrio');
//print_r($log);

function listFiles($path) {
   $dirs = array();
   $files = array();

   foreach (glob($path.'/*') as $file) {
      if (!preg_match("/^\.|CVS|.svn/", $file)) {
         if (is_dir($file)) {
            $dirs[$file]['stats'] = filestats($file);
         } else {
            $files[$file]['stats'] = filestats($file);
            $revs = cvslog($file);
            $files[$file]['version'] = $revs[$file];
         }
      }
   }
   $out = array_merge($dirs, $files);
   
   return $out;
}

function cvs($cmd, $args) {
   $cmd = escapeshellcmd($cmd);
   if (is_array($args)) {
      $argsArr = $args;
      $args = join(' ', $argsArr);
   }
   escapeshellcmd($args);

   $ccmd = "/usr/bin/cvs " . $cmd . " " . $args;
   $pcvs = popen($ccmd, "r");
   $contents = '';
   while (!feof($pcvs)) {
     $contents .= fread($pcvs, 8192);
     }
   pclose($pcvs);

   return $contents;
}

function cvslog($files) {
   if (!is_array($files)) {
      $file = $files;
      $files = array($file);
   }

   $out = array();

   foreach ($files as $file) {
      $log = cvs('log -l', $file);
      $meta = parselog($log);
      $out[$file] = $meta;
   }

   return $out;
}

function parselog($log) {
   $lines = preg_split("/\n/", $log);
   $out = array('revisions'=>array());
   $mflag = 0;
   for ($i=0; $i<count($lines); $i++) {
      $line = $lines[$i];
      if ($line == "") { next; }
      if (!$mflag) {
         if (preg_match("/^-------/", $line)) {
            $mflag = 1;
            next;
         } else {
            $line = preg_replace("/;.*/", '', $line);
            $vals = preg_split("/\:/", $line, 2);
            if ($vals[0] && $vals[1]) { $out[$vals[0]] = $vals[1]; }
         }
      } else {
         if (preg_match("/^revision\s(.*)/", $line, $matches)) {
            $msg = "";
            $tmp = array();
            $tmp["revision"] = $matches[1];

            $ex = preg_split("/\;\s*/", $lines[$i+1]);

            if (count($ex)) {
               foreach ($ex as $keyval) {
                  $vals = preg_split("/\:\s?/", $keyval, 2);
                  if ($vals[0] && $vals[1]) {
                     $tmp[$vals[0]] = $vals[1];
                  }
               }
            }
            $i++;
         } else if (preg_match("/^-------/", $line)) {
            $tmp['message'] = $msg;
            $out['revisions'][] = $tmp;
         } else {
            if (preg_match("/(\w+):\s*(\w+)/", $line, $match)) {
               $tmp[$match[1]] = $match[2];
            }
            $msg .= $line . "\n";
         }
      }
   }

   return $out;
}

function parsePerms($perms) {
   if (($perms & 0xC000) == 0xC000) {
       // Socket
       $info = 's';
   } elseif (($perms & 0xA000) == 0xA000) {
       // Symbolic Link
       $info = 'l';
   } elseif (($perms & 0x8000) == 0x8000) {
       // Regular
       $info = '-';
   } elseif (($perms & 0x6000) == 0x6000) {
       // Block special
       $info = 'b';
   } elseif (($perms & 0x4000) == 0x4000) {
       // Directory
       $info = 'd';
   } elseif (($perms & 0x2000) == 0x2000) {
       // Character special
       $info = 'c';
   } elseif (($perms & 0x1000) == 0x1000) {
       // FIFO pipe
       $info = 'p';
   } else {
       // Unknown
       $info = 'u';
   }

   // Owner
   $info .= (($perms & 0x0100) ? 'r' : '-');
   $info .= (($perms & 0x0080) ? 'w' : '-');
   $info .= (($perms & 0x0040) ?
               (($perms & 0x0800) ? 's' : 'x' ) :
               (($perms & 0x0800) ? 'S' : '-'));

   // Group
   $info .= (($perms & 0x0020) ? 'r' : '-');
   $info .= (($perms & 0x0010) ? 'w' : '-');
   $info .= (($perms & 0x0008) ?
               (($perms & 0x0400) ? 's' : 'x' ) :
               (($perms & 0x0400) ? 'S' : '-'));

   // World
   $info .= (($perms & 0x0004) ? 'r' : '-');
   $info .= (($perms & 0x0002) ? 'w' : '-');
   $info .= (($perms & 0x0001) ?
               (($perms & 0x0200) ? 't' : 'x' ) :
               (($perms & 0x0200) ? 'T' : '-'));

   return $info;
}

function filestats($file) {
   $out = array();
   
   $stats = stat($file);
   $out['atime'] = $stats['atime'];
   $out['mtime'] = $stats['mtime'];
   $out['ctime'] = $stats['ctime'];
   $out['size'] = $stats['size'];
   $out['isdir'] = is_dir($file);
   $out['mode'] = substr(sprintf('%o', $stats['mode']), -4);
   $out['perms'] = parsePerms($stats['mode']);
   
   return $out;
}
?>
