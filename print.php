<?php
   require_once($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');
   
   if ($process) {
      $current = (array)$boss->getObject($process->Resource, $in['id']);
      
      if ($process->PrintTemplate) {
         $tmpl = $boss->getPath($process->PrintTemplate);
         $page = file_get_contents($tmpl);

         if ($page) {
            $page = preg_replace("/\#(.+?)\#/e", "\$current[$1]", $page);
         }      
      } else {
         $tmpl = $boss->getPath($process->Form);
         $page = file_get_contents($tmpl);
         
         if ($page) {
            $page = preg_replace("/\#(.+?)\#/e", "\$current[$1]", $page);
         }      
      }

      if ($print) {
         print $print;
      } else {
         print "<h1>Error printing record ".$in['id']." from ".$process->Resource."</h1>";
      }
   }
?>
