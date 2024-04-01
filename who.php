#!/usr/local/bin/php
<?php
session_start();

$out = new stdClass();
$out->email = $_SESSION['Email'];
$out->name = $_SESSION['LastName'].', '.$_SESSION['FirstName'];

$who = json_encode($out);

header("Content-Type: text/plain");
print $who;

