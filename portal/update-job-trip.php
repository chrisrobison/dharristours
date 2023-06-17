#!/usr/local/bin/php
<?php
    include('/simple/.env');

    $in = $_REQUEST;
    $out = array();
    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");

 /* check connection */
    if (mysqli_connect_errno()) {
         printf("Connect failed: %s\n", mysqli_connect_error());
         exit();
    }

    $sql = "select JobID, PickupLocation, DropOffLocation, FinalDropOffLocation from Job where JobCancelled!=1 and Confirmed=1 and EstDistance='0.0' order by JobID desc";
    $results = mysqli_query($link, $sql);
    $seen = array();
    $coords = array();
    while ($job = mysqli_fetch_object($results)) {
        $waypoints = array($job->PickupLocation);

        if (preg_match("/Stop\s\d\)/i", $job->DropOffLocation, $matches)) {
            $stops = preg_split("/Stop\s\d\)/i", $job->DropOffLocation);
            foreach ($stops as $stop) {
                $stop = preg_replace("/(\d+|\d+\:\d\d)[ap]m\s\-\s/", "", $stop);
                $stop = preg_replace("/\(.+?\)/", "", $stop);
                $stop = preg_replace("/<br>/", "", $stop);
                $waypoints[] = $stop;
            }
        } else {
            $waypoints[] = $job->DropOffLocation;
        }
        $waypoints[] = $job->FinalDropOffLocation;
        $coord = array();
        
        foreach ($waypoints as $waypoint) {
            $waypoint = preg_replace("/\(\d.*/", '', $waypoint);
            
            $newwaypoint = urlencode($waypoint);
            if (!array_key_exists($waypoint, $seen)) {
                //$www = `curl -s --include --header "Content-Type: application/json; charset=utf-8" --header "Accept: application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8" 'https://api.openrouteservice.org/geocode/search?api_key=5b3ce3597851110001cf62481189071ea9104ad6a88e51717cb62e65&text={$waypoint}'`;
                $www = `curl -s --include --header "Content-Type: application/json; charset=utf-8" --header "Accept: application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8" 'https://api.openrouteservice.org/geocode/search?api_key=5b3ce3597851110001cf62481189071ea9104ad6a88e51717cb62e65&text={$newwaypoint}&boundary.rect.min_lon=-122.748&boundary.rect.min_lat=37.350&boundary.rect.max_lon=-121.064&boundary.rect.max_lat=38.266'`;
                $parts = preg_split("/\r?\n\r?\n/s", $www);
                $geo = json_decode($parts[1]);
                
                $seen[$waypoint] = $geo;
                $coord[] = $geo->features[0]->geometry->coordinates;
            } else {
                $coord[] = $seen[$waypoint]->features[0]->geometry->coordinates;
            }
        }
        $json = json_encode($coord);
        $cmd = "curl -s -X POST 'https://api.openrouteservice.org/v2/directions/driving-car' -H 'Content-Type: application/json; charset=utf-8' -H 'Accept: application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8' -H 'Authorization: 5b3ce3597851110001cf62481189071ea9104ad6a88e51717cb62e65' -d '{\"coordinates\":{$json}}'";
        $www = `$cmd`;
        
        $info = json_decode($www);
        
        $distance = sprintf("%0.1f", $info->routes[0]->summary->distance / 1609.344);
        $duration = sprintf("%0.1f", $info->routes[0]->summary->duration / 60 / 60);
        $sql = "UPDATE Job set EstDistance='$distance', EstDuration='$duration' WHERE JobID={$job->JobID};";
        print $sql."\n";
    }
?>
