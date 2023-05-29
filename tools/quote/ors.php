<?php
    $in = $_REQUEST;

    if (array_key_exists("coordinates", $in)) {
        $coord = $in['coordinates'];
        print_r($coord);
        // $results = `curl -X POST 'https://api.openrouteservice.org/v2/directions/driving-car/geojson' -H 'Content-Type: application/json; charset=utf-8' -H 'Accept: application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8' -H 'Authorization: 5b3ce3597851110001cf62481189071ea9104ad6a88e51717cb62e65' -d '{"coordinates":[$coord]}'
    }
?>
