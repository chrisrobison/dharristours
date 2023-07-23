#!/usr/local/bin/php
<?php
    
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/.env');

    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");

    $sql = "select * from Address where FullAddress like ', %';";
    $results = mysqli_query($link, $sql);
    $updates = array();

    while ($row = mysqli_fetch_object($results)) {
        $newaddr = preg_replace("/,\s$/", "", preg_replace("/^,\s/", "", $row->FullAddress));
        $sql = "UPDATE Address SET FullAddress='".preg_replace("/\'/","\'", $newaddr)."' WHERE AddressID={$row->AddressID};";
        $updates[] = $sql;
    }

    print join("\n", $updates)."\n";
?>
