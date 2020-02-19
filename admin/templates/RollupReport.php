<?php
   $obj = new boss();
   $util = new utility();
   
   $obj->db->addResource('Report');
   $rsc = $obj->db->Report;
   
   $report = array();
   $rsc->get($in['ReportID'], 'ReportID');
   if ($rsc->Report[0]) {
      $query = $obj->db->dbobj->execute($rsc->Report[0]->Query);
      while ($row = $obj->db->dbobj->fetch_object()) {
         $report[] = $row;
      }
   }
   print $util->buildTable($report, '9999999');
?>
