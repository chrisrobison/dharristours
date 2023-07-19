<?php
/*
if ($_SERVER['SERVER_PORT'] != 443) {
   header("Location: https://".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
   exit;
}
*/
require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/boss_class.php");
session_start();


$in = $_REQUEST;
$boss = new boss();

$url = $_REQUEST['url'];
if (!$url || $url=='%2F') $url = "/portal/index.php";



if (isset($_COOKIE['email'])) {
    unset($_COOKIE['email']);
    unset($_SESSION['email']);
    setcookie('email', null, -1, '/');
}

if (isset($_REQUEST['check']) && $in['email'] && $in['password']) {
        if ($boss->utility->login($boss, $_REQUEST)) {
            echo 'true';
        } else {
            echo 'false';
        }
        exit;
}

if (isset($_REQUEST['redirect']) && $in['email'] && $in['password']) {
        if ($boss->utility->login($boss, $_REQUEST)) {
            setcookie("email", $in['email']);
            setcookie("name", $_SESSION['FirstName'] . ' ' . $_SESSION['LastName']);
            header("Location: $url");
            exit;
        } else {
            $msg = "<div class='formError' style='padding:5px 5px 5px 5px'>Log in failed. Invalid username and/or password.</div>";
        }
}


