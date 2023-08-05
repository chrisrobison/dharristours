#!/usr/local/bin/php
<?php
    
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/.env');

    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");

    $sql = "select * from Request ";
    $results = mysqli_query($link, $sql);
    $updates = array();

    while ($row = mysqli_fetch_object($results)) {
        $sql = "UPDATE Request set Instructions='".preg_replace("/\'/","\'", $row->Notes)."' where RequestID={$row->RequestID};";
        array_push($updates, $sql);
    }

    print join("\n", $updates)."\n";
?>
