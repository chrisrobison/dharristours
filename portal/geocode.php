<?php
    $in = $_REQUEST;
    $in['addr'] = urlencode($in['addr']);

   $results = `curl -s --include --header "Content-Type: application/json; charset=utf-8" --header "Accept: application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8" 'https://api.openrouteservice.org/geocode/search?api_key=5b3ce3597851110001cf62481189071ea9104ad6a88e51717cb62e65&text={$in['addr']}'`;
  $parts = preg_split("/\r?\n\r?\n/s", $results);
  header("Content-Type: application/json");

  print $parts[1];

?>
