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
      global $boss;
      $sql = 'BusinessID in (select BusinessID from Business where LoginID='.$_SESSION['LoginID'].')';

      $searchQuery = $boss->utility->buildGridSearch();
      if ($searchQuery) $sql .= " AND " . $searchQuery;

      $now = date("Y-m-d h:i:s");
      file_put_contents("/tmp/simpledb.log", $now . "\t" . $sql."\n", FILE_APPEND);

      $business = $boss->getObjectRelated('Business', $sql,false);
      for ($i=0; $i<count($business->Business['_ids']); $i++) {
         unset($business->Business[$i]->Notes);
         unset($business->Business[$i]->Active);
      }
      $business->Business['_rows'] = $business->rows;
      return ($tbl) ? $this->buildTable($business->Business, $_REQUEST['ProcessID'], $_REQUEST['Resource'], array_keys((array)$business->Business[0])) : $business->Business;
   }

   function filterBusinessJob($tbl=true) {
      global $boss;
      $sql = 'BusinessID in (select BusinessID from Business where LoginID='.$_SESSION['LoginID'].')';

      $searchQuery = $boss->utility->buildGridSearch();
      if ($searchQuery) $sql .= " AND " . $searchQuery;

      $now = date("Y-m-d h:i:s");
      file_put_contents("/tmp/simpledb.log", $now . "\t" . $sql."\n", FILE_APPEND);

      $job = $boss->getObjectRelated('Job', $sql);
      for ($i=0; $i<count($job->Job['_ids']); $i++) {
         unset($job->Job[$i]->Notes);
         unset($job->Job[$i]->Employee);
         unset($job->Job[$i]->EmployeeID);
         unset($job->Job[$i]->Business);
      }
      $job->Job['_rows'] = $job->rows;
      return ($tbl) ? $this->buildTable($job->Job, $_REQUEST['ProcessID'], $_REQUEST['Resource'], array_keys((array)$job->Job[0])) : $job->Job;
   }
   
   function filterEmployeeJob($tbl=true) {
      global $boss;
      $sql = 'EmployeeID in (select EmployeeID from Employee where Email='.$boss->q($_SESSION['Email']).')';
      $searchQuery = $boss->utility->buildGridSearch();
      if ($searchQuery) $sql .= " AND " . $searchQuery;

      $now = date("Y-m-d h:i:s");
      file_put_contents("/tmp/simpledb.log", $now . "\t" . $sql."\n", FILE_APPEND);

      $job = $boss->getObjectRelated('Job', $sql,false);
      for ($i=0; $i<count($job->Job['_ids']); $i++) {
         unset($job->Job[$i]->Notes);
         unset($job->Job[$i]->QuoteAmount);
         unset($job->Job[$i]->Description);
         unset($job->Job[$i]->LastModified);
         unset($job->Job[$i]->LastModifiedBy);
         unset($job->Job[$i]->Created);
         unset($job->Job[$i]->CreatedBy);
         unset($job->Job[$i]->Employee);
         unset($job->Job[$i]->Business);
         unset($job->Job[$i]->Bus);
      }
      $job->Job['_rows'] = $job->rows;
      return ($tbl) ? $this->buildTable($job->Job, $_REQUEST['ProcessID'], $_REQUEST['Resource'], array_keys((array)$job->Job[0])) : $job->Job;
   }

   function filterEmployeeTrip($tbl=true) {
      global $boss;
      $sql = 'EmployeeID in (select EmployeeID from Employee where Email='.$boss->q($_SESSION['Email']).')';
//      print_r($sql);
      $searchQuery = $boss->utility->buildGridSearch();
      if ($searchQuery) $sql .= " AND " . $searchQuery;

      $now = date("Y-m-d h:i:s");
      file_put_contents("/tmp/simpledb.log", $now . "\t" . $sql."\n", FILE_APPEND);

      $trip = $boss->getObjectRelated('Trip', $sql,false);
      for ($i=0; $i<count($trip->Trip['_ids']); $i++) {
         unset($trip->Trip[$i]->Notes);
      }
      $trip->Trip['_rows'] = $trip->rows;
      return ($tbl) ? $this->buildTable($trip->Trip, $_REQUEST['ProcessID'], $_REQUEST['Resource'], array_keys((array)$trip->Trip[0])) : $trip->Trip;
   }

   function filterBusinessInvoice($tbl=true) {
      global $boss;
 
      $sql = ' JobID in (select JobID from Job where BusinessID in (select BusinessID from Business where LoginID='.$_SESSION['LoginID'].'))';
      
      $searchQuery = $boss->utility->buildGridSearch();
      if ($searchQuery) $sql .= " AND " . $searchQuery;
      
      $now = date("Y-m-d h:i:s");
      file_put_contents("/tmp/simpledb.log", $now . "\t" . $sql."\n", FILE_APPEND);
      
      $inv = $boss->getObjectRelated('Invoice',$sql);
      for ($i=0; $i<count($inv->Invoice['_ids']); $i++) {
         unset($inv->Invoice[$i]->Notes);
         unset($inv->Invoice[$i]->Created);
         unset($inv->Invoice[$i]->CreatedBy);
         unset($inv->Invoice[$i]->LastModified);
         unset($inv->Invoice[$i]->LastModifiedBy);
      }
      $inv->Invoice['_rows'] = $inv->rows;
      return ($tbl) ? $this->buildTable($inv->Invoice, $_REQUEST['ProcessID'], $_REQUEST['Resource'], array_keys((array)$inv->Invoice[0])) : $inv->Invoice;
   }
   function filterBusinessQuote($tbl=true) {
      global $boss;
 
      $sql = 'BusinessID in (select BusinessID from Business where LoginID='.$_SESSION['LoginID'].')';
      
      $searchQuery = $boss->utility->buildGridSearch();
      if ($searchQuery) $sql .= " AND " . $searchQuery;
      
      $qte = $boss->getObjectRelated('Quote',$sql);
      for ($i=0; $i<count($qte->Quote['_ids']); $i++) {
         unset($qte->Quote[$i]->Notes);
      }
      $qte->Quote['_rows'] = $qte->rows;
      return ($tbl) ? $this->buildTable($qte->Quote, $_REQUEST['ProcessID'], $_REQUEST['Resource'], array_keys((array)$qte->Quote[0])) : $qte->Quote;
   }
   function filterBusinessNewQuote($tbl=true) {
      global $boss;
 
      $sql = 'BusinessID in (select BusinessID from Business where LoginID='.$_SESSION['LoginID'].')';
      
      $searchQuery = $boss->utility->buildGridSearch();
      $now = date("Y-m-d h:i:s");
      file_put_contents("/tmp/simpledb.log", $now . "\t" . $sql."\n", FILE_APPEND);
      
      if ($searchQuery) $sql .= " AND " . $searchQuery;
      
      $qte = $boss->getObjectRelated('Quote', $sql);
      // print_r($qte);
      for ($i=0; $i<count($qte->Quote['_ids']); $i++) {
         unset($qte->Quote[$i]->Notes);
      }
      $qte->Quote['_rows'] = $qte->rows;
      return ($tbl) ? $this->buildTable($qte->Quote, $_REQUEST['ProcessID'], $_REQUEST['Resource'], array_keys((array)$qte->Quote[0])) : $qte->Quote;
   }
}
?>
