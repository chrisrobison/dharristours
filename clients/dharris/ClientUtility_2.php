<?php
/**
 * Client Utility class
 *
 **/

require_once($_SERVER['DOCUMENT_ROOT'].'/lib/utility_class.php');

class ClientUtility extends utility {
   function ClientUtility() {

   }

   function filterBusiness() {
      $boss = new boss();
     // $search['Job']['Business']['LoginID'] = $_SESSION['LoginID'];
     // $newobj = $boss->getObject('Job', $search);

//print_r($newobj);
      $bus = $boss->getObject('Business', 'LoginID='.$_SESSION['LoginID']);
      $jobs = $boss->getObject('Job', 'BusinessID='.$bus->Business[0]->BusinessID);
      return $this->buildTable($jobs->Job, $_REQUEST['ProcessID'], $_REQUEST['Resource'], array_keys((array)$jobs->Job[0]));
   }
   function filterInvoice() {
      $boss = new boss();
      $inv = $boss->getObject('Invoice','JobID in (select JobID from Job where BusinessID in (select BusinessID from Business where LoginID='.$_SESSION['LoginID']).'))');
      return $this->buildTable($inv->Invoice, $_REQUEST['ProcessID'], $_REQUEST['Resource'], array_keys((array)$inv->Invoice[0]));
   }
}

?>
