<?php
/**
 * Client Utility class
 *
 **/

require_once($_SERVER['DOCUMENT_ROOT'].'/lib/utility_class.php');

class ClientUtility extends utility {
   function ClientUtility() {

   }

   function filterBusiness($tbl=true) {
      $boss = new boss();
      $job = $boss->getObject('Job','BusinessID in (select BusinessID from Business where LoginID='.$_SESSION['LoginID'].')');
      for ($i=0; $i<count($job->Job['_ids']); $i++) {
         unset($job->Job[$i]->Notes);
         unset($job->Job[$i]->Employee);
         unset($job->Job[$i]->EmployeeID);
         unset($job->Job[$i]->Business);
      }
      return ($tbl) ? $this->buildTable($job->Job, $_REQUEST['ProcessID'], $_REQUEST['Resource'], array_keys((array)$job->Job[0])) : $job->Job;
   }
   function filterQuote($tbl=true) {
      $boss = new boss();
      $quote = $boss->getObject('Quote','BusinessID in (select BusinessID from Business where LoginID='.$_SESSION['LoginID'].')');
      return ($tbl) ? $this->buildTable($quote->Quote, $_REQUEST['ProcessID'], $_REQUEST['Resource'], array_keys((array)$quote->Quote[0])) : $quote->Quote;
   }
   function filterInvoice($tbl=true) {
      $boss = new boss();
      $inv = $boss->getObject('Invoice','JobID in (select JobID from Job where BusinessID in (select BusinessID from Business where LoginID='.$_SESSION['LoginID'].'))');
      return ($tbl) ? $this->buildTable($inv->Invoice, $_REQUEST['ProcessID'], $_REQUEST['Resource'], array_keys((array)$inv->Invoice[0])) : $inv->Invoice;
   }
   function filterBusiness2() {
      $boss = new boss();
     // $search['Job']['Business']['LoginID'] = $_SESSION['LoginID'];
     // $newobj = $boss->getObject('Job', $search);

//print_r($newobj);
      $bus = $boss->getObject('Business', 'LoginID='.$_SESSION['LoginID']);
      $jobs = $boss->getObject('Job', 'BusinessID='.$bus->Business[0]->BusinessID);
      return $this->buildTable($jobs->Job, $_REQUEST['ProcessID'], $_REQUEST['Resource'], array_keys((array)$jobs->Job[0]));
   }
   function filterInvoice2() {
      $boss = new boss();
//      $inv = $boss->getObject('Invoice','JobID in (select JobID from Job where BusinessID in (select BusinessID from Business where LoginID='.$_SESSION['LoginID']).'))');
//      return $this->buildTable($inv->Invoice, $_REQUEST['ProcessID'], $_REQUEST['Resource'], array_keys((array)$inv->Invoice[0]));
   }

}
?>
