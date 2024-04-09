<?php
    
    $in = $_POST;
    $json = file_get_contents('php://input');
    $obj = json_decode($json);

    file_put_contents("/tmp/sms-replies.log", json_encode($obj)."\n", FILE_APPEND);

?>
