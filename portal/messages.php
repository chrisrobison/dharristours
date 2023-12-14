<?php
include($_SERVER['DOCUMENT_ROOT'] . '/.env');
include($_SERVER['DOCUMENT_ROOT'] . '/lib/auth.php');

session_start();

 /*
  * For testing purposes
 //include($_SERVER['DOCUMENT_ROOT'] . '/lib/auth.php');
 $_SESSION = array(
    'Login' => new stdClass()
);
$_SESSION['Login']->LoginID = 5;
 */


$in = $_REQUEST;
$out = array();

$link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");// testdb = ss_dharris_tours

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
        case "getNotifications":
            $out = getNotifications($link);
            break;
        case "clearNotification":
            $out = clearNotification($link, $in);
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

    $loggedInUser = $_SESSION['Login']->LoginID;

    $sql = "SELECT m.id, m.content, m.created_at, l.FirstName, l.LastName, l.Login, l.Email, l.Picture,
        CASE WHEN m.read = 0 AND m.user_id != '".$loggedInUser."' THEN 1 ELSE 0 END AS unread
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
    $resource_id = $vals[1];
    $resource_type = $vals[2];
    $loginID = $_SESSION['Login']->LoginID;
    array_push($keys, 'user_id');
    array_push($vals, $loginID);

    $sql = "INSERT INTO messagethread (`" . implode('`,`', $keys)."`) values ('".join("','", $vals)."');";
    $results = mysqli_query($link, $sql);

    if(!$results){
        $out->status = "error";
        $out->e = mysqli_error($link);
    }

    if($results){
        $out->data = updateNotifications($link, $resource_id, $resource_type, $loginID);
    }

    return $out;
}


function updateNotifications($link, $resource_id, $resource_type, $loginID) {
    $sql = "SELECT Subscriber from MessageThreadSubscribers WHERE ResourceID = '$resource_id' AND ResourceType = '$resource_type'";
    $isAdmin = $_SESSION['Login']->Admin == 1;
    $ADMIN_SUBSCRIBER_ID = 0;
    $isAdminSubscribed = false;


    $results = mysqli_query($link, $sql);
    if(!$results){
        return mysqli_error($link);
    }

    $subscribers = $results->fetch_all(MYSQLI_ASSOC);
    $isSubscriber = false;

    $responses = array();
    foreach($subscribers as $subscriber) {
        $subscriberID = $subscriber['Subscriber'];
        if($subscriberID == $ADMIN_SUBSCRIBER_ID ) $isAdminSubscribed = true;
    }
    if(!$isAdminSubscribed){
        $responses[]= addSubscriber($link, $resource_id, $resource_type, $ADMIN_SUBSCRIBER_ID);
    }
    if(!$isAdmin && !$isAdminSubscribed){
        $subscribers[] = array('Subscriber' => $ADMIN_SUBSCRIBER_ID);
    }

    foreach($subscribers as $subscriber) {
        $subscriberID = $subscriber['Subscriber'];

        if($subscriberID == $ADMIN_SUBSCRIBER_ID && $isAdmin) continue;

        if($subscriberID == $loginID) $isSubscriber = true;

        if($subscriberID != $loginID) {
            mysqli_begin_transaction($link);

            $sql = "SELECT NewMessageCount FROM MessageThreadNotification WHERE Recipient=$loginID AND ResourceID=$resource_id AND ResourceType = '$resource_type' FOR UPDATE;";
            mysqli_query($link, $sql);
            $sql = "INSERT INTO MessageThreadNotification (Recipient, ResourceID, ResourceType, NewMessageCount) VALUES ('$subscriberID', '$resource_id', '$resource_type', 1) ON DUPLICATE KEY UPDATE NewMessageCount = NewMessageCount + 1;";
            mysqli_query($link, $sql);

            $results = mysqli_commit($link);
            if(!$results) {
                $responses[] = mysqli_error($link);
            }
        }


    }
    if(!$isSubscriber){
        $responses[]= addSubscriber($link, $resource_id, $resource_type, $loginID);
    }

    return join(',',$responses);

}

function getNotifications($link){
    $out = new stdClass();
    $out->status = "ok";

    $loginID = $_SESSION['Login']->LoginID;

    $sql = "SELECT NewMessageCount, ResourceID, ResourceType  FROM MessageThreadNotification WHERE Recipient = '".$loginID."' AND NewMessageCount > 0 ORDER BY LastModified DESC";

    $results = mysqli_query($link, $sql);
    if(!$results){
        $out->status = "error";
        $out->e = mysqli_error($link);
    }

    if($results) $out->data= $results->fetch_all(MYSQLI_ASSOC);
    return $out;
}

function clearNotification($link, $in){
    $out = new stdClass();
    $out->status = "ok";

    $loginID = $_SESSION['Login']->LoginID;
    $isAdmin = $_SESSION['Login']->Admin == 1;
    $ADMIN_SUBSCRIBER_ID = 0;

    $resource_id = mysqli_real_escape_string($link, $in['data']['resource_id']);
    $resource_type = mysqli_real_escape_string($link, $in['data']['resource_type']);

    $where = " WHERE Recipient = '".$loginID."' ";
    if($isAdmin) $where = " WHERE Recipient IN ('".$loginID."','".$ADMIN_SUBSCRIBER_ID."') ";

    $sql = "UPDATE MessageThreadNotification SET NewMessageCount = 0 ".$where." AND ResourceID = '".$resource_id."' AND ResourceType = '".$resource_type."'";

    $results = mysqli_query($link, $sql);
    if(!$results){
        $out->status = "error";
        $out->e = mysqli_error($link);
    }
    return $out;
}

function addSubscriber($link, $resource_id, $resource_type, $loginID) {
    $sql = "INSERT INTO MessageThreadSubscribers (ResourceID, ResourceType, Subscriber) VALUES ('".$resource_id."', '".$resource_type."', '".$loginID."')";
    $results = mysqli_query($link, $sql);
    if(!$results){
        return mysqli_error($link);
    }
    return "";
}

function markMessageRead($link, $in) {
    $out = new stdClass();
    $out->status = "ok";


    $id = mysqli_real_escape_string($link, $in['data']['id']);
    $sql = "UPDATE messagethread SET `read` = 1 WHERE id = '".$id."'";

    $result = mysqli_query($link, $sql);
    if(!$result){
        $out->status = "error";
        $out->e = mysqli_error($link);
    }
    return $out;
}
