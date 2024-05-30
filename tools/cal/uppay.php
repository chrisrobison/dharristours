#!/usr/local/bin/php
<?php

include('/simple/.env');
$link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");

$sql = "SELECT * from Invoice where CheckNum!=''";

$query = mysqli_query($link, $sql);

while ($row = mysqli_fetch_object($query)) {
    $out = [];
    
    $out["Payment"] = "$".sprintf("%.02f", $row->PaidAmt). " received for Invoice #" . $row->InvoiceID;
    $out["Amount"] = $row->PaidAmt;
    $out["CheckNum"] = $row->CheckNum;
    $out["InvoiceID"] = $row->InvoiceID;
    $out["BusinessID"] = $row->BusinessID;
    $out["CheckDate"] = $row->CheckDate;

    $keys = array_keys($out);
    $vals = array_values($out);

    $new = "INSERT INTO Payment (`".join("`,`", $keys)."`) VALUES ('" . join("','", $vals)."');";
    print $new."\n";
}
