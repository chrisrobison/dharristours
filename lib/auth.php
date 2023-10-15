<?php
   require_once("boss_class.php");
   session_start();

   if ($_SERVER['SERVER_NAME'] && !$_SESSION['UserID']) {
      $s = $_SERVER;
      $prot = ($s['SERVER_PORT']=='443') ? "https://" : "http://";
      header("Location: https://".$s['SERVER_NAME']."/login.php?url=".urlencode($_SERVER['REQUEST_URI']));
      exit;
   }
   
   $srvName = ($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : "admin.dev.sscsf.com";
   $boss = new boss($srvName);
   $boss->docroot = $_SERVER['DOCUMENT_ROOT'] . '/' . $boss->app->Assets;

   $in = $_REQUEST;
   
   if ($in['z']) {
      $qs = base64_decode($in['z']);

      $parts = explode('&', $qs);
      $cnt = count($parts);

      for ($i=0; $i < $cnt; $i++) {
          list($key, $val) = preg_split("/=/", $parts[$i]);
          $in[urldecode($key)] = urldecode($val);
      }
   }


   $pid = $in['ProcessID'] = $in['pid'] = ($in['pid']) ? $in['pid'] : $in['ProcessID'];
   if ($pid) {
      $process = $boss->getObject("Process", $pid);
      if ($process->Resource) {
         if (!$in['rsc']) $rsc = $in['rsc'] = $in['Resource'] = $process->Resource;
         if (!$in['Mid']) $mid = $in['Mid'] = $in['ModuleID'] = $process->ModuleID;
      }
   }
   
   if (!$in['rsc']) $rsc = $in['Resource'] = $in['rsc'] = (isset($in['Resource']) && ($in['Resource'] != 'undefined') && ($in['Resource'] != '')) ? $in['Resource'] : $process->Resource;

   if ($process && (!preg_match("/appmanager/", $_SERVER['REQUEST_URI']))) {
      if (!((int)$_SESSION['ProcessAccess'] & (int)$process->Access)) {
         include($boss->getPath("templates/noaccess.php"));
         exit;
      }
   }
?>
