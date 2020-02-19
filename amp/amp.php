<?php
   
	file_put_contents("posted.log", var_export($_REQUEST,true));
   
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
      
		header("Content-type: application/json");
		$js = file_get_contents("response.json");
		print $js;
	}
?>
