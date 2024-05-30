#!/usr/local/bin/php
<?php
/**
 * uppay.php    -   Update Payment table with historic data available from Invoice
 *
 *                  This script looks for any Invoice records that have a value in CheckNum
 *                  and no existing Payment record and adds a new Payment record for that PAID Invoice.
 *                  
 *                  This should only be run once unless you know what you're doing.
 **/

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
