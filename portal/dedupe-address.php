#!/usr/local/bin/php
<?php
    
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/.env');

    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");

    $sql = "select * from Address";
    $results = mysqli_query($link, $sql);
    $seen = array();
    
    $actions = array();
    while ($row = mysqli_fetch_assoc($results)) {
        if (array_key_exists($row['Nickname'].$row['Address'].$row['City'], $seen)) {
            $sql = "DELETE from Address where AddressID=".$row['AddressID'];
            $actions[] = $sql;
        }

        $seen[$row['Nickname'].$row['Address'].$row['City']] = $row;
    }

//    print_r($actions);
print join(";\n", $actions)."\n";
?>
