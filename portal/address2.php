<?php
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/.env');

    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");
    
    $in = $_REQUEST;
    $out = "";

    if (array_key_exists('q', $in)) {
        $sql = "select * from Address where FullAddress like '%{$in['q']}%';";
        $results = mysqli_query($link, $sql);
        $records = array();

        while ($row = mysqli_fetch_object($results)) {
            $out .= '<li role="option" data-autocomplete-value="'.$row->FullAddress.'" data-coord="['.$row->Longitude.','.$row->Latitude.']">'.$row->FullAddress.'</li>';
        }
        print $out;
    }
?>
