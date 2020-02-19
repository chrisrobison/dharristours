<?php
   include_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");

   $boss = new boss();
   
   $id = ($in['id']) ? $in['id'] : 1;
   $core = $boss->get("Employee", "EmployeeID=$id");
   
   $org = new stdClass;
   
   $org->id = "top";
   $org->name = "The Company";
   $org->children = array();
   $org->data = $boss->app;

   foreach ($core as $idx=>$emp) {
      $out = new stdClass;
      $out->id = $emp->EmployeeID;
      $out->name = $emp->Employee;
      $out->children = array();
      $out->data = $emp;
      
      $reports = $boss->get("Employee", "Supervisor_EmployeeID=" . $emp->EmployeeID . " AND Active=1");
      $out->children = getReports($reports, $emp->EmployeeID);
      $org->children[] = $out;
   }


   print json_encode($out);
   
   exit;

   
   function getReports($reports, $id) {
      global $boss, $seen;
      
      foreach ($reports as $emp) {
         if ($emp->EmployeeID != $id) {
            $newemp = new stdClass;
            $newemp->id = $emp->EmployeeID;
            $newemp->name = $emp->Employee;
            $newemp->data = $emp;
            $newemp->children = array();

            $child = $boss->get("Employee", "Supervisor_EmployeeID=".$emp->EmployeeID . " AND Active=1");

            if (count($child) && !$seen[$emp->EmployeeID]) {
               $newemp->children = getReports($child, $emp->EmployeeID);
               $seen[$emp->EmployeeID] = 1;
            }
            $children[] = $newemp;
         }
      }
      return $children;
   }
?>



