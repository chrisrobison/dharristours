<?php
   require_once($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');
   
   if ($in['pid']) {
      $process = $boss->getObject("Process", $in['pid']);
      $in['Resource'] = $process->Resource;
      $in['type'] = "Process";
      $in['ProcessID'] = $in['pid'];
   }
   $rsc = (isset($in['Resource']) && ($in['Resource'] != 'undefined') && ($in['Resource'] != '')) ? $in['Resource'] : "Module";
   
   $obj = new boss();
   $util = $obj->utility;
   $user = $_SESSION['Login'];
   
   if ($in['ProcessID']) $obj->addProcess(null, $in['ProcessID']);
   if ($in['ModuleID']) $obj->addModule(null, $in['ModuleID']);

   if (isset($in['Resource']) && ($in['Resource'] != 'undefined')) {
      $obj->db->addResource($rsc);
      if (($in['ID']) && (!preg_match("/Module|Process/", $rsc))) {
         $in[$rsc.'ID'] = $in['ID'];
      }
      $in['ID'] = $in[$rsc.'ID'];
      if (($in['searchID']) && (!preg_match("/\D/", $in['searchID']))) {
         if ($in['searchField'] == $rsc.'ID') {
            $in['ID'] = $in[$rsc.'ID'] = $in['searchID'];
         } else {
            $obj->db->$rsc->get($in['searchID'], $in['searchField']);
            $in['ID'] = $in[$rsc.'ID'] = $obj->db->$rsc->$rsc[0]->{$rsc.'ID'};
         }
      }
      
      $current = $obj->getObject($rsc, $in[$rsc.'ID']);
      // print_r($current);
   }

   if ($obj->Process->Processes[0]->URL) {
      header("Location: ".$obj->Process->Processes[0]->URL);
      exit;
   }

   if (!$in['x'] && $in['ProcessID']) {
      $obj->Process->prepare();
   } else {
      switch ($in['x']) {
         case 'search':
            /*
            $results = $obj->searchObject($rsc, $in);
            $search = array();

            foreach ($results as $result) {
               $search[$result] = $obj->getObject('Purchase', $result);
            }
            */
            break;
         case 'get':
            $obj->db->{$rsc}->get($in[$rsc.'ID'], $rsc.'ID');
            $current = $obj->db->$rsc->{$rsc}[0];
            
            break;
         case 'getlist':
            $obj->db->{$rsc}->getlist($in['Query']);
            
            break;
         case 'new':
            if ($_SESSION['ProcessAccess'] & $obj->Process->Processes[0]->Access) {
               $in = $obj->prepareSearch($in);
               $id = $in[$rsc."ID"] = $obj->db->{$rsc}->add($in[$rsc][$in[$rsc.'ID']]);
               $obj->db->{$rsc}->get($in[$rsc.'ID'], $rsc.'ID');
               $obj->Process->complete();
               $obj->Process->prepare();
               $util->trackTime($obj, $_REQUEST['Track']); 
               if ($_SESSION['Login']->Alerts==1) $jsalert = "alert('A new $rsc record [$id] has been created.');";
               unset($current);
 //              unset($in[$rsc.'ID']);
         }
            break;
         case 'update':
            if ($_SESSION['ProcessAccess'] & $obj->Process->Processes[0]->Access) {
               $obj->db->{$rsc}->update($in[$rsc.'ID'], $in[$rsc][$in[$rsc.'ID']]);
               $obj->db->{$rsc}->get($in[$rsc.'ID'], $rsc.'ID');
               $obj->Process->complete();
               if ($_SESSION['Login']->Alerts==1) $jsalert = "alert('Your changes have been saved.');";
               $util->trackTime($obj, $_REQUEST['Track']); 
            }
            
            break;
         case 'update_multi':
           if ($_SESSION['ProcessAccess'] & $obj->Process->Processes[0]->Access) {
               // $out[$rsc] = $obj->prepareSearch($_REQUEST[$rsc]);
               $out[$rsc] = $_REQUEST[$rsc];
               $newids = $obj->storeRecord($out, $rsc);
               $keys = array_keys($newids);
               $id = $in[$rsc.'ID'] = $newids[$keys[0]];
               $obj->db->{$rsc}->get($in[$rsc.'ID'], $rsc.'ID');
               $obj->Process->complete();
               if ($rsc == 'Login') {
                  $login = $obj->getObject('Login', $in['LoginID']);
                  $_SESSION['Login'] = $login;
               }
               if ($_SESSION['Login']->Alerts == 1) $jsalert = "alert('Your changes have been saved to record\\n".$in[$rsc.'ID']." in the $rsc resource.');";
               $util->trackTime($obj, $_REQUEST['Track']); 
            }
            break;
         case 'remove':
            if ($_SESSION['ProcessAccess'] & $obj->Process->Processes[0]->Access) {
               $obj->db->{$rsc}->remove($in[$rsc.'ID']);
               if ($_SESSION['Login']->Alerts==1) $jsalert = "alert('Record ".$in[$rsc.'ID']." in $rsc resource has been deleted.');";
               unset($in[$rsc.'ID']);
               unset($in[$rsc][$in[$rsc.'ID']]);
               unset($obj->db->{$rsc});
            } 
            break;
      }
      $util->logTransaction($obj);
   }

   $jsout = "";
   if ($obj->Process->JS) $jsout .= $obj->Process->JS;
   if ($obj->Module->JS) $jsout .= $obj->Module->JS;
   if ($jsout) print "<script type='text/javascript'>$jsout</script>";

   if ($in[$rsc.'ID'] || $in['ID']) {
      $current = $obj->getObject($rsc, $in[$rsc.'ID']?$in[$rsc.'ID']:$in['ID']);
   }


?>
