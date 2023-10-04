<?php
    $in = $_REQUEST;

    if (array_key_exists('q', $in)) {
        $in['q'] = urlencode($in['q']);

        $json = `curl -s --include --header "Content-Type: application/json; charset=utf-8" --header "Accept: application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8" 'https://api.openrouteservice.org/geocode/search?api_key=5b3ce3597851110001cf62481189071ea9104ad6a88e51717cb62e65&text={$in['q']}&boundary.rect.min_lon=-124.011&boundary.rect.min_lat=37.1666&boundary.rect.max_lon=-120&boundary.rect.max_lat=39.12'`;
        $results = json_decode($json);
       
        $out = [];
        
        if ($results && $results->features && count($results->features)) {
            foreach ($results->features as $obj) {
                $item = new stdClass();
                $item->name = $obj->properties->name;
                $item->address = $obj->properties->housenumber . ' ' . $obj->properties->street;
                $item->city = $obj->properties->locality;
                $item->state = $obj->properties->region_a;
                $item->zip = $obj->properties->name;
                $item->coordinates = $obj->geometry->coordinates;
                array_push($out, $item);
            }   
        }
        print json_encode($out);

    }
?>
