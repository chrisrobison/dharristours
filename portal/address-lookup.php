<?php
    require("/simple/.env");

    $in = $_REQUEST;
    $out = array();
    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");

    /* check connection */
    if (mysqli_connect_errno()) {
         printf("Connect failed: %s\n", mysqli_connect_error());
         exit();
    }
    
    $sql = "SELECT * FROM Address";

    $results = mysqli_query($link, $sql);
    $all = array();

    $replace = array("/Road/"=>"Rd", "/Street/"=>"St", "/Boulevard/"=>"Blvd", "/Drive/"=>"Dr", "/Avenue/"=>"Ave", "/Parkway/"=>"Pkwy");

    while ($obj = mysqli_fetch_object($results)) {
        $addr = preg_replace(array_keys($replace), array_values($replace), $obj->Address);
        $addr = preg_replace("/\"/", '', $addr);

        $key = $addr . ", ".$obj->City;
        if (!array_key_exists($key, $all)) {
                
            $new = new stdClass();
            $new->Address = $addr;
            $new->City = $obj->City;
            $new->State = $obj->State;
            $new->Zip = $obj->Zip;
            $all[$key] = $new;
        } else {
            if ($addr && !$all[$key]->Address) {
                $all[$key]->Address = $addr;
            }
            if ($obj->Zip && !$all[$key]->Zip) {
                $all[$key]->Zip = $obj->Zip;
            }
            if ($obj->City && !$all[$key]->City) {
                $all[$key]->City = $obj->City;
            }
        }
    }
    print json_encode(array_values($all));
?>
