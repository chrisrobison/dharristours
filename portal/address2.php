<?php
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/.env');

    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");
    
    $in = $_REQUEST;
    $out = "";


    if (array_key_exists('q', $in)) {
        $sql = "select * from Address where FullAddress like '%{$in['q']}%' LIMIT 10;";
        $results = mysqli_query($link, $sql);
        $records = array();
        $seen = array();

        while ($row = mysqli_fetch_object($results)) {
            if (!isset($seen[$row->FullAddress])) {
                $out .= '<li role="option" data-autocomplete-value="'.$row->FullAddress.'" data-coord="['.$row->Longitude.','.$row->Latitude.']">'.$row->FullAddress.'</li>';
            }
            $seen[$row->FullAddress] = $row->Longitude.':'.$row->Latitude;
        }
        print $out;
        
        $out = "";
        $sql = "select * from School where FullAddress like '%{$in['q']}%' LIMIT 10;";
        $results = mysqli_query($link, $sql);
        $records = array();

        while ($row = mysqli_fetch_object($results)) {
            if (!isset($seen[$row->FullAddress])) {
                $out .= '<li role="option" data-autocomplete-value="'.$row->FullAddress.'" data-coord="['.$row->Longitude.','.$row->Latitude.']">'.$row->FullAddress.'</li>';
            }
            $seen[$row->FullAddress] = $row->Longitude.':'.$row->Latitude;
        }
        print $out;
        


        $query = urlencode($in['q']);
        $json = `curl -s --header "Content-Type: application/json; charset=utf-8" --header "Accept: application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8" 'https://api.openrouteservice.org/geocode/search?api_key=5b3ce3597851110001cf62481189071ea9104ad6a88e51717cb62e65&text={$query}&boundary.rect.min_lon=-123.122168&boundary.rect.min_lat=36.951885&boundary.rect.max_lon=-120.362573&boundary.rect.max_lat=38.381473'`;
        $out = "";

        if ($json) {
            $results = json_decode($json);
            
            if ($results->features) {
                foreach ($results->features as $match) {
                    if (property_exists($match, "properties")) {
                        $p = $match->properties;
                        
                        if (property_exists($p, 'street') && property_exists($p, 'housenumber')) {
                            $addr = ($p->name && ($p->name != $p->housenumber.' '.$p->street)) ? $p->name . ', ' : "";
                            $addr .= $p->housenumber . ' ' . $p->street . ', ' . $p->locality . ', ' . $p->region_a;
                        } else {
                            $addr = $p->label;
                        }
                        $out .= "<li role=\"option\" data-autocomplete-value=\"{$addr}\" data-coord=\"[{$match->geometry->coordinates[0]},{$match->geometry->coordinates[1]}]\">{$addr}</li>";

                    }
                }
            }
        }
        print $out;
    }
?>
