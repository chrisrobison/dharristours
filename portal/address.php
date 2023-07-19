<?php
    $in = $_REQUEST;
    $out = "";

    if (array_key_exists('q', $in)) {
        $in['q'] = urlencode($in['q']);
        $url = 'curl -s --include --header "Content-Type: application/json; charset=utf-8" --header "Accept: application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8" "https://api.openrouteservice.org/geocode/autocomplete?api_key=5b3ce3597851110001cf62481189071ea9104ad6a88e51717cb62e65&text='.$in['q'].'&boundary.rect.min_lon=-124.011&boundary.rect.min_lat=37.166&boundary.rect.max_lon=-120&boundary.rect.max_lat=39.12"';

        $www = `$url`;
        
        $parts = preg_split("/\r?\n\r?\n/s", $www);
       
        $obj = json_decode($parts[1]);

        if ($obj->features) {
            foreach ($obj->features as $hit) {
                $coord = json_encode($hit->geometry->coordinates);
                $out .= "<li role=\"option\" data-autocomplete-value=\"" . $hit->properties->name .', '.$hit->properties->locality.' '.$hit->properties->region_a .'  '.$hit->properties->postalcode ."\" data-coord='{$coord}'>" . $hit->properties->name .', '.$hit->properties->locality.' '.$hit->properties->region_a .'  '.$hit->properties->postalcode."</li>";
            }
            print $out;
        }
        

    }
?>
