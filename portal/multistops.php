<?php
    // Call over http[s] with the following query string parameters:
    //    ?json={"coordinates":[[lat,lon],[lat,lon],...]}

    $in = $_REQUEST;
    $coord = new stdClass();
    if (array_key_exists("json", $in)) {
        $coord = json_decode(rawurldecode($in['json']));
    }
    
    
    $coord->radiuses = [-1];
    //$coord->instructions = true;
    //$coord->instructions_format = "html";
    $coord->language = "en-us";
    //$coord->maneuvers = true;
    $out = json_encode($coord);
   
    $cmd = "curl --include -X POST  'https://api.openrouteservice.org/v2/directions/driving-car/geojson' -H 'Content-Type: application/json; charset=utf-8' -H 'Accept: application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8' -H 'Authorization: 5b3ce3597851110001cf62481189071ea9104ad6a88e51717cb62e65' -d '{$out}'";
    
    $results = `$cmd`;
file_put_contents("/tmp/geocode.log", $cmd."\n".$results."\n".$in['json']."\n=============\n", FILE_APPEND);

    $parts = preg_split("/\r?\n\r?\n/", $results);
    header("Content-Type: application/json");
   print $parts[1]; 

?>
