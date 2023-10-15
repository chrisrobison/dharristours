<?php
/*
if ($_SERVER['SERVER_PORT'] != 443) {
   header("Location: https://".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
   exit;
}
*/
require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/boss_class.php");

$in = $_POST;
$boss = new boss();

if (array_key_exists("url", $_POST)) {
    $url = $_POST['url'];
} 

if (array_key_exists("url2", $_POST)) {
    $url = $_POST['url2'];
} 

if (!$url || $url=='%2F') $url = "/portal/index.php";

if (isset($_COOKIE['email'])) {
    unset($_COOKIE['email']);
    unset($_SESSION['email']);
    setcookie('email', null, -1, '/');
}

if (isset($_POST['check']) && isset($in['email']) && isset($in['password'])) {
        if ($boss->utility->login2($boss, $_REQUEST)) {
            echo 'true';
        } else {
            echo 'false';
        }
        exit;
}

if ($_REQUEST['logout']) {	
   $boss->utility->logout($boss);
   // header("Location: /index.php");
   print "<script type='text/javascript'>\ntop.location.href='/portal/login.html?url=/portal/';\n</script>\n";
   exit;
}

if (isset($_REQUEST['redirect']) && $in['email'] && $in['password']) {
        if ($boss->utility->login2($boss, $_REQUEST)) {
            setcookie("email", $in['email']);
            setcookie("name", $_SESSION['FirstName'] . ' ' . $_SESSION['LastName']);
            header("Location: {$url}");
            exit;
        } else {
            $msg = "<div class='formError' style='padding:5px 5px 5px 5px'>Log in failed. Invalid username and/or password.</div>";
            print $msg;
        }

}


