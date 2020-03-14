<?php
   
   include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/auth.php');
   
   $_COOKIE['process'] = $in['pid'];

   $prot = ($_SERVER['SERVER_PORT']=="443") ? "https://" : "http://";

   if (!$in['pid']) {
      include($boss->getPath("templates/noaccess.php"));
      exit;
   } else {
      if ($process->URL) {
         $url = $process->URL;

         if (preg_match("/^\//", $url)) {
            $url = $prot . $_SERVER['SERVER_NAME'] . $url;
         }
         header("Location: " . $url);
         exit;
      } else {
         $url = $prot . $_SERVER['SERVER_NAME'];
         header("Location: " . $url . "/grid/index.php?" . $_SERVER['QUERY_STRING']);
      } 
   }
?>
