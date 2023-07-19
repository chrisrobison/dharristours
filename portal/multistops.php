<?php
    // Call over http[s] with the following query string parameters:
    //    ?json={"coordinates":[[lat,lon],[lat,lon],...]}

    $in = $_REQUEST;
    $coord = array();
    if (array_key_exists("json", $in)) {
        $coord = json_decode($in['json']);
    }

    $out = json_encode($coord);

    $cmd = "curl -X POST  'https://api.openrouteservice.org/v2/directions/driving-car/geojson' -H 'Content-Type: application/json; charset=utf-8' -H 'Accept: application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8' -H 'Authorization: 5b3ce3597851110001cf62481189071ea9104ad6a88e51717cb62e65' -d '{$out}'";
    
    $results = `$cmd`;
    $parts = preg_split("/\r?\n\r?\n/", $results);
    header("Content-Type: application/json");
   print $results; 

?>
