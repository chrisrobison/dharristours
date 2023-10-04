<?php

    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/.env');

    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");
    $in = $_REQUEST;
    
    $abbrevMatch = array('/Street/', '/Avenue/', '/Road/', '/Highway/', '/Boulevard/', '/Court/', '/Circle/');
    $abbrevReplace = array('St', 'Ave', 'Rd', 'Hwy', 'Blvd', 'Ct', 'Cir');
    $in['addr'] = preg_replace($abbrevMatch, $abbrevReplace, $in['addr']);
    $in['addr'] = preg_replace("/\s/", '%', $in['addr']);
    
    $parts = preg_split("/\,/", $in['addr']);
    
    $search = array();
    foreach ($parts as $idx=>$part) {
        $search[] = "'%{$part}%'";
    }
    $searchStr = join(" AND FullAddress like ", $search);
    $sql = "select * from Address where FullAddress like $searchStr;";
    
    if ($results = mysqli_query($link, $sql)) {
        if (mysqli_num_rows($results)) {
            $row = mysqli_fetch_object($results);
            $out = new stdClass();
            $out->id = $row->AddressID;
            $out->name = $row->Name;
            $out->address = $row->Address;
            $out->city = $row->City;
            $out->state = $row->State;
            $out->zip = $row->Zip;
            $out->lat = $row->Latitude;
            $out->lon = $row->Longitude;
            $out->full = $row->FullAddress;

            $out->features = array();
            $out->features[0] = new stdClass();
            $out->features[0]->geometry = new stdClass();
            $out->features[0]->geometry->type = "Point";
            $out->features[0]->geometry->coordinates = array($row->Longitude, $row->Latitude);
            header("Content-Type: application/json");
            print json_encode($out);
            exit;
        };
    
    }
    $in['addr'] = urlencode($in['addr']);

    $results = `
curl --include 'https://nominatim.openstreetmap.org/search?q={$in['addr']}&format=geojson&boundary.rect.min_lon=-124.011&boundary.rect.min_lat=37.166&boundary.rect.max_lon=-120&boundary.rect.max_lat=39.12' \
  -H 'authority: nominatim.openstreetmap.org' \
  -H 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7' \
  -H 'accept-language: en-US,en;q=0.9' \
  -H 'cache-control: no-cache' \
  -H 'pragma: no-cache' \
  -H 'sec-ch-ua: "Not.A/Brand";v="8", "Chromium";v="114", "Google Chrome";v="114"' \
  -H 'sec-ch-ua-mobile: ?0' \
  -H 'sec-ch-ua-platform: "macOS"' \
  -H 'sec-fetch-dest: document' \
  -H 'sec-fetch-mode: navigate' \
  -H 'sec-fetch-site: none' \
  -H 'sec-fetch-user: ?1' \
  -H 'upgrade-insecure-requests: 1' \
  -H 'user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36' \
  --compressed`;

    
//    $results = `curl --include --header "Content-Type: application/json; charset=utf-8" --header "Accept: application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8" 'https://api.openrouteservice.org/geocode/search?api_key=5b3ce3597851110001cf62481189071ea9104ad6a88e51717cb62e65&text={$in['addr']}&boundary.rect.min_lon=-124.011812&boundary.rect.min_lat=37.166942&boundary.rect.max_lon=-119.945604&boundary.rect.max_lat=39.120750&boundary.country=US'`;

   // $results = `curl -s --include --header "Content-Type: application/json; charset=utf-8" --header "Accept: application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8" 'https://api.openrouteservice.org/geocode/search?api_key=5b3ce3597851110001cf62481189071ea9104ad6a88e51717cb62e65&text={$in['addr']}'`;
  $parts = preg_split("/\r?\n\r?\n/s", $results);
  header("Content-Type: application/json");

  print $parts[1];

$json = json_decode($parts[1]);
$fullname = $json->features[0]->properties->display_name;
$p = preg_split("/\,\s*/", $fullname);
$new = array();

array_pop($p);                  // discarding country
$new['Zip'] = array_pop($p);
$new['State'] = array_pop($p);
$new['State'] = 'CA';           // forcing to CA here.  needs to be a lookup of two letter state abbrev from full state name provided

array_pop($p);  // discarding CAL Fire * Region
$new['County'] = (preg_match("/county/i", $p[count($p)-1])) ? array_pop($p) : "";
$new['City'] = array_pop($p);
$new['Name'] = (preg_match("/^\d+$/", $p[0])) ? "" : array_shift($p);
$new['Latitude'] = $json->features[0]->geometry->coordinates[1];
$new['Longitude'] = $json->features[0]->geometry->coordinates[0];

if (preg_match("/^\d+$/", $p[0])) {
    $num = array_shift($p);
    $street = array_shift($p);
    $new['Address'] = preg_replace($abbrevMatch, $abbrevReplace, $num .' '. $street);
}

$name = ($new['Name']) ? $new['Name'] .', ' : '';
$new['FullAddress'] = $name.$new['Address'].', '.$new['City'].', CA '.$new['Zip'];

if (count($p)) {
   $new['Neighborhood'] = array_pop($p); 
}
$keys = array_keys($new);
$vals = array_values($new);

$sql = "INSERT INTO Address (`".join("`,`", $keys)."`) VALUES ('".join("','", $vals)."');";

file_put_contents("/tmp/geocode.log", $sql."\n", FILE_APPEND);

$result = mysqli_query($link, $sql);

?>
