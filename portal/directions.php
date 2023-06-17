<?php
    // Call over http[s] with the following query string parameters:
    //    start=-122.459936,37.721725&end=-122.459936,37.72

    $in = $_REQUEST;
    
    $results = `curl --include --header "Content-Type: application/json; charset=utf-8" --header "Accept: application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8" 'https://api.openrouteservice.org/v2/directions/driving-car?api_key=5b3ce3597851110001cf62481189071ea9104ad6a88e51717cb62e65&start={$in['start']}&end={$in['end']}'`;
    $parts = preg_split("/\r?\n\r?\n/", $results);
    
    header("Content-Type: application/json");
  print $parts[1];

?>
