<?php
// select Employee as `Employee[Employee]`, EmployeeID as `Employee[EmployeeID]` from Employee;
require("lib/auth.php");

print "<h1>Received Data:</h1><pre>";
$obj = json_decode($in['json']);
print_r($_GET);
print "</pre>";
$boss->db->dbobj->execute("select Employee as `Employee[Employee]`, EmployeeID as `Employee[EmployeeID]` from Employee");

$out = array();
while ($row = $boss->db->dbobj->fetch_object()) {
   $out[] = $row;
}


$emp = $boss->getObject("Employee",1, true );
$json = json_encode($emp);

print_r($emp);
?>
<script>
   var obj = <?php print $json; ?>;
   debugger
</script>
<form>
   My Data: <textarea name="Employee[0][Login][1][LoginID]" rows='10' cols='80'><?=$json?></textarea><br/>
   <input type='submit' />
</form>
