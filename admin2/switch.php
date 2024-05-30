<?php  
    if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php"); 

    $in = $_GET;

    if (array_key_exists("email", $in)) {
        $boss->utility->switchUser($boss, $in);
    }

    header("Content-type: application/json");
    $out = new stdClass;
    $out->status = "ok";
    $out->Login = $boss->getObject("Login", "Email='{$in['email']}'");

    print json_encode($out);
?>

