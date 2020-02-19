<?php
   include_once("lib/auth.php");

   $boss = new boss('admin.dev.sscsf.com');
   
   $core = $boss->get("Employee", 1);
   
   $out = new stdClass;
   $out->id = $core[0]->EmployeeID;
   $out->name = $core[0]->Employee;
   $out->children = array();
   $out->data = $core[0];

   $reports = $boss->get("Employee", "Supervisor_EmployeeID=" . $core[0]->EmployeeID);
   $out->children = getReports($reports, 1);

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

            $child = $boss->get("Employee", "Supervisor_EmployeeID=".$emp->EmployeeID);

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



