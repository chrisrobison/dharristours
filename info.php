<?php
require("lib/auth.php");
session_start();
print "<h1>_SESSION</h1><pre>";
print_r($_SESSION);
print "<h1>_REQUEST</h1><pre>";
print_r($_REQUEST);
print "</pre><h1>_SERVER</h1><pre>";
print_r($_SERVER);
print "</pre>";
phpinfo();
?>
