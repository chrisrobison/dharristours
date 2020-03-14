<?php
//require_once("../lib/localobj_class.php");
//require_once("../lib/utility_class.php");

//example of building table
/*$db = new localObj("data");
$db->addResource('Surgery');
$db->Surgery->getlist();
$surgeries = ""; 
$x = 1;

$util = new Utility();
$arr = array('Name'=>'Name', 'Sex'=>'Sex', 'Age'=>'Age', 'Condition'=>'Condition', 'BirthDate'=>'DOB');

$surgeries = $util->buildTable($db->Surgery->Surgery, $arr);*/

function getSurgeries($status) {
   $outStr = "";
	$temp = new obj('mpc','dbuser','newdler');
	$temp->addResource("Surgery");
	$temp->Surgery->getlist("Status = '$status'");
	foreach ($temp->Surgery->Surgery as $key=>$rec) {
	   $outStr .= "<option value='" . $rec->SurgeryID . "'>" . $rec->SurgeryID . "</option>";
	}
	return $outStr;
}

$requestedSurgeries = getSurgeries('Requested');
$scheduledSurgeries = getSurgeries('Scheduled');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
   <head>
      <title>mpc</title>
                <script language='Javascript' type="text/javascript"><?php echo $objJS; ?></script>
      <script language='Javascript' type='text/javascript' src='/lib/js/default.js'> </script>
      <link rel='stylesheet' type='text/css' href='/lib/css/default.css' />
   </head>
   <body>
		<form id='selectform' action='/content.php' name='selectform' method='post' onsubmit="return Form_Validator(this, this.FILE1.value)" >
			<input type="hidden" name="type" value="Action">
			<input type="hidden" name="Resource" value="Surgery">
			<input type="hidden" name="ActionID" value="23">
			<input type="hidden" name="Status" value="" id="Status">
			Requested Surgeries - 
			<select name="SurgeryID"><?php echo $requestedSurgeries; ?></select>
			<input type="submit" value="Edit/Schedule">
			<?php //<input type="submit" value="Complete" onclick="document.getElementById('Status').value='Completed';return true"> ?>
		</form>
		<br /><br /><br />
		<form id='selectform' action='/content.php' name='selectform' method='post' onsubmit="return Form_Validator(this, this.FILE1.value)">
		   Scheduled Surgeries - 
			<input type="hidden" name="type" value="Action">
			<input type="hidden" name="Resource" value="Surgery">
			<input type="hidden" name="ActionID" value="23">
			<input type="hidden" name="Status" value="" id="Status2">
			<select name="SurgeryID"><?php echo $scheduledSurgeries; ?></select>
			<input type="submit" value="Edit">
			<input type="submit" value="Complete" onclick="document.getElementById('Status2').value='Completed';return true">
		</form>	   
   </body>
</html>

