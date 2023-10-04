#!/usr/local/bin/php
<?php
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/.env');
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/lib/boss_class.php');

    $in = $_REQUEST;
    $out = array();
    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");

    $boss = new boss("dharristours.simpsf.com");

    $sql = "select * from Invoice where JobID!=0";
    $results = mysqli_query($link, $sql);
    
    $records = array();
    $updates = array();

    while ($row = mysqli_fetch_object($results)) {
       $records[] = $row; 

    }

    foreach ($records as $row) {
        $job = $boss->getObject("Job", $row->JobID);
        if ($job && $job->BusinessID) {
            $sql =  "UPDATE Job set InvoiceID='" . $row->InvoiceID . "' WHERE JobID=" . $row->JobID .";";
            $updates[] = $sql;
            print $sql."\n";
        }
    }
