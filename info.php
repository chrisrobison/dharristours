<?php
require("lib/auth.php");
session_start();
print "<a href='info.php?key1=val1&key2=val2&arr[new1][key1]=val3'>Check referrers and arguments</a>";
print "<h1>_SESSION</h1><pre>";
print_r($_SESSION);
print "<h1>_REQUEST</h1><pre>";
print_r($_REQUEST);
print "<h1>_COOKIE</h1><pre>";
print_r($_COOKIE);
print "<h1>_App</h1><pre>";
print_r($boss);
print "</pre><h1>_SERVER</h1><pre>";
print_r($_SERVER);
print "</pre>";
phpinfo();
?>
