<?php
$s = $_SERVER;
$prot = ($s['SERVER_PORT']=="443") ? "https://" : "http://";
//header("Location: ".$prot.$s['SERVER_NAME']."/apps/index.php");
$dest = ( isset($_COOKIE['StartURL']) && ($_COOKIE['StartURL'] != "")) ? $_COOKIE['StartURL'] : "/apps/index.php"; 
header("Location: https://".$s['SERVER_NAME'].$dest);
?>
