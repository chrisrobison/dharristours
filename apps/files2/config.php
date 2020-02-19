<?php
// Database config & class
$db_config = array(
	"servername"=> "localhost",
	"username"	=> "pimp",
	"password"	=> "pimpin",
	"database"	=> "tree"
);
if(extension_loaded("mysqli")) require_once("_inc/class._database_i.php"); 
else require_once("_inc/class._database.php"); 

// Tree class
require_once("_inc/class.tree.php"); 
?>
