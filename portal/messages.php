<?php
include($_SERVER['DOCUMENT_ROOT'] . '/.env');
include($_SERVER['DOCUMENT_ROOT'] . '/lib/auth.php');

session_start();

$in = $_REQUEST;
$out = array();

$link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");//ss_dharris_tours

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

if ($in['type']) {
    switch($in['type']) {
        case "post":
            $out = postMessage($link, $in);
            break;
        case "get":
            $out = getMessages($link, $in);
            break;
    }

    //file_put_contents("/tmp/calapi.log", date("Y-m-d H:i:s") . ":" . $in['type'] . ": " . json_encode($in) . " : " .json_encode($out)."\n", FILE_APPEND);

    header("Content-type: application/json; charset=utf-8");
    print json_encode($out);
}

function getMessages($link, $in) {
    $out = new stdClass();
    $out->status = "ok";


    $keys = array("resource_id","resource_type");
    $vals = array();

    foreach ($keys as $key) {
        $val = $in['data'][$key];
        $val = mysqli_real_escape_string($link, $val);
        array_push($vals, $val);
    }

    $sql = "SELECT m.id, m.content, m.created_at, l.FirstName, l.LastName, l.Login, l.Email, l.Picture 
        FROM messagethread m 
        LEFT JOIN Login l ON m.user_id = l.LoginID 
        WHERE m.resource_id = '".$vals[0]."' AND m.resource_type = '".$vals[1]."'";

    $results = mysqli_query($link, $sql);
    if(!$results){
        $out->status = "error";
        $out->e = mysqli_error($link);
    }
    if($results) $out->data= $results->fetch_all(MYSQLI_ASSOC);
    return $out;
}

function postMessage($link, $in) {
    $out = new stdClass();
    $out->status = "ok";


    $keys = array("content","resource_id","resource_type");
    $vals = array();

    foreach ($keys as $key) {
        $val = $in['data'][$key];
        $val = mysqli_real_escape_string($link, $val);
        array_push($vals, $val);
    }
    array_push($keys, 'user_id');
    array_push($vals, $_SESSION['Login']->LoginID);

    $sql = "INSERT INTO messagethread (`" . implode('`,`', $keys)."`) values ('".join("','", $vals)."');";
    $results = mysqli_query($link, $sql);
    if(!$results){
        $out->status = "error";
        $out->e = mysqli_error($link);

    }
    return $out;
}