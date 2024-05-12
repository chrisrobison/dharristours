<?php
include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/.env');

$link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");

$sql = "Select distinct(`From`) as `From` from Email ";
$out = [];
$results = mysqli_query($link, $sql);
$seen = [];
while ($row = mysqli_fetch_object($results)) {
    $new = "INSERT INTO Person ";
    $keys = [];
    $vals = [];

    if (preg_match("/^([^<]*)<([^>]*)>/", $row->From, $matches)) {
        if (!isset($seen[$matches[2]])) {
            $keys[] = "Person";
            $name = preg_replace("/\"/", '', preg_replace("/\'/", "\\'", $matches[1]));
            $vals[] = $name;
            $keys[] = "Email";
            $vals[] = $matches[2];

            $parts = preg_split("/\s/", $name, 2);
            $keys[] = "FirstName";
            $vals[] = $parts[0];
            $keys[] = "LastName";
            $vals[] = $parts[1];
            $seen[$matches[2]] = 1;

            $new .= "(`".join("`,`", $keys)."`) VALUES ('".join("','", $vals)."');";
            print $new."\n";
        }
    }
    /*
    $obj = new stdClass();
    $obj->EmailID = $row->EmailID;
    $headers = json_decode($row->Headers);
    $obj->Headers = $headers->headers;
    $obj->Subject = $row->Subject;
    $obj->To = $row->To;
    $obj->From = $row->From;
    $obj->Date = $row->Date;
    $out[] = $obj;
    */
}

//header("Content-Type: application/json");
//print json_encode($out);

exit;

