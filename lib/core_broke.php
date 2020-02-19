<?php
   if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
	
   //include("security/sessionbox.php");
   session_start();
   
   if (!$_SESSION['Email']) {
      header("Location: /login.php");
      exit;
   }
   $in =& $_REQUEST;
   $boss = new boss();
   $util = $boss->utility;

   $rsc = (isset($in['Resource']) && ($in['Resource'] != 'undefined') && ($in['Resource'] != '')) ? $in['Resource'] : "Module";
   
   /** 
    *  This chunk of code needs to be rethought.  It grabs the user's login record
    *  and compares the access values against those stored in the session variable.
    *  If they are different the session variables are set to the new value[s] 
    *  allowing immediate changes to the access a user has.  The problem is with the
    *  navigation that is displayed to the user is not updated even though the server has.
    *  You must currently logout and log back in for the changes to access to take place.
    **/
   $boss->db->addResource('Login');
   $boss->db->Login->get($_SESSION['Email'], 'Email');
   $loginID = $boss->db->Login->Login[0]->LoginID;
   $user = $boss->getObject('Login', $loginID);

   $boss->db->addResource($rsc);
   if (($in['ID']) && (!preg_match("/Module|Process/", $rsc))) {
      $in[$rsc.'ID'] = $in['ID'];
   }
   $in['ID'] = $in[$rsc.'ID'];
   if (($in['searchID']) && (!preg_match("/\D/", $in['searchID']))) {
      if ($in['searchField'] == $rsc.'ID') {
         $in['ID'] = $in[$rsc.'ID'] = $in['searchID'];
      } else {
         $boss->db->$rsc->get($in['searchID'], $in['searchField']);
         $in['ID'] = $in[$rsc.'ID'] = $boss->db->$rsc->$rsc[0]->{$rsc.'ID'};
      }
   }
   
   if ($in['ProcessID']) $boss->addProcess(null, $in['ProcessID']);
   if ($in['ModuleID']) $boss->addModule(null, $in['ModuleID']);
   $current = $boss->getObject($rsc, $in[$rsc.'ID']);

   if ($boss->Process->Processes[0]->URL) {
      header("Location: ".$boss->Process->Processes[0]->URL);
      exit;
   }
   
   if (!$in['x'] && $in['ProcessID']) {
      // $boss->Process->prepare();
   } else {
      switch ($in['x']) {
         
         case 'search':
            /*
            $results = $boss->searchObject($rsc, $in);
            $search = array();

            foreach ($results as $result) {
               $search[$result] = $boss->getObject('Purchase', $result, $recurse);
            }
            */
            break;
         case 'get':
            $boss->db->{$rsc}->get($in[$rsc.'ID'], $rsc.'ID');
            $current = $boss->db->$rsc->{$rsc}[0];
            
            break;
         case 'getlist':
            $boss->db->{$rsc}->getlist($in['Query']);
            
            break;
         case 'new':
            if ($_SESSION['ProcessAccess'] & ($boss->Process->Access)) {
               $in[$rsc."ID"] = $boss->db->{$rsc}->add($in[$rsc][$in[$rsc.'ID']]);
               $boss->db->{$rsc}->get($in[$rsc.'ID'], $rsc.'ID');
               $boss->Process->complete();
               $boss->Process->prepare();
               $util->trackTime($boss, $_REQUEST['Track']); 
               unset($current);
               unset($in[$rsc.'ID']);
            }
            break;
         case 'update':
            if ($_SESSION['ProcessAccess'] & ($boss->Process->Access)) {
               $boss->db->{$rsc}->update($in[$rsc.'ID'], $in[$rsc][$in[$rsc.'ID']]);
               $boss->db->{$rsc}->get($in[$rsc.'ID'], $rsc.'ID');
               $boss->Process->complete();
               $util->trackTime($boss, $_REQUEST['Track']); 
            }
            
            break;
         case 'update_multi':
            if ($_SESSION['ProcessAccess'] & ($boss->Process->Access)) {
               $boss->storeRecord($in);
               $boss->db->{$rsc}->get($in[$rsc.'ID'], $rsc.'ID');
               $boss->Process->complete();
               $jsalert = "alert('Your changes have been saved.');";
               $util->trackTime($boss, $_REQUEST['Track']); 
            }
            break;
         case 'remove':
            $boss->db->{$rsc}->remove($in[$rsc.'ID']);
            unset($in[$rsc.'ID']);
            unset($in[$rsc][$in[$rsc.'ID']]);
            unset($boss->db->{$rsc});
            
            break;
      }
      $util->logTransaction($boss);
   }



   if ($boss->Process->JS) print "<script type='text/javascript'>\n".$boss->Process->JS."</script>\n";
   if ($boss->Module->JS) print "<script type='text/javascript'>\n".$boss->Module->JS."</script>\n";
   
   if ($in[$rsc.'ID']) {
      $current = $boss->getObject($rsc, $in[$rsc.'ID']);
   }


?>
