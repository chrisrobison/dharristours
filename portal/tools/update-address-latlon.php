#!/usr/local/bin/php
<?php
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/.env');

    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");

    $sql = "select * from Address where Latitude='';";
    $results = mysqli_query($link, $sql);
    
    $records = array();

    while ($row = mysqli_fetch_object($results)) {
        $records[] = $row;
    }

foreach ($records as $key=>$addr) {
    $qs = $addr->Nickname.", ".$addr->Address . ", ".$addr->City.", ".$addr->State.", ".$addr->Zip;
    print "\n==================\n";
    print $qs."\n";

    $nameparts = array();
    if ($addr->Nickname) { $nameparts[] = $addr->Nickname; }
    if ($addr->Address) { $nameparts[] = $addr->Address; }
    if ($addr->City) { $nameparts[] = $addr->City; }
    if ($addr->State) { $nameparts[] = $addr->State; }
    if ($addr->Zip) { $nameparts[] = $addr->Zip; }

    $q = urlencode(join(', ', $nameparts));

    $www = `curl -s 'https://nominatim.openstreetmap.org/search?q=$q&format=geojson' \
  -H 'authority: nominatim.openstreetmap.org' \
  -H 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,* /*;q=0.8,application/signed-exchange;v=b3;q=0.7' \
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

/*    $www = `curl -s --include \
     --header "Content-Type: application/json; charset=utf-8" \
     --header "Accept: application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8" \
  'https://api.openrouteservice.org/geocode/search?api_key=5b3ce3597851110001cf62481189071ea9104ad6a88e51717cb62e65&text=$q&boundary.country=US'`;
*/
//print $www;

//$pwww = preg_split("/\r\n\r\n/", $www, 2);

    //$obj = json_decode($pwww[1]);
    $obj = json_decode($www);
    print_r($obj);
    $geo = $obj->features[0];
//print "Current nickname: ".$addr->Nickname."\nCurrent Address: ".$addr->Address."\n";
    $upd = array();
    if ($geo && $geo->properties && $geo->properties->display_name) {
        $name = $geo->properties->display_name = preg_replace("/CAL Fire (Northern|Southern) Region, /", '', $obj->features[0]->properties->display_name);
    }

    $parts = preg_split("/\,/", $name);
    $pname = "";
    //print $name."\n".count($parts)."\n";

     if (!preg_match("/^\d+/", $parts[0])) {
        $pname = $parts[0];
        //print "Potential new name: {$pname}\n";
    }

    if ($name != $addr->FullAddress) {
        //print "Old fulladdress: ".$addr->FullAddress."\n";
        $nameparts = array();
        if ($addr->Nickname) { $nameparts[] = preg_replace("/\'/", "\'", $addr->Nickname); }
        if ($addr->Address) { $nameparts[] = preg_replace("/\'/", "\'", $addr->Address); }
        if ($addr->City) { $nameparts[] = $addr->City; }
        if ($addr->State) { $nameparts[] = $addr->State; }
        if ($addr->Zip) { $nameparts[] = $addr->Zip; }

        $newname = "FullAddress='".join(", ", $nameparts)."'";
        //print "New fulladdress: ".$newname."\n";
        array_push($upd, $newname);
    }
print_r($geo);
    if ($geo->geometry->type == "Point") {
        $coord = $geo->geometry->coordinates;
        $lon = "Longitude='{$coord[0]}'";
        $lat = "Latitude='{$coord[1]}'";
        array_push($upd, $lat);
        array_push($upd, $lon);;
    }

    if (count($upd)) {
        
        $sql = "UPDATE Address set ".join(",", $upd) ." WHERE AddressID=".$addr->AddressID;
        print $sql."\n";
        $upres = mysqli_query($link, $sql);

    }

    sleep(1);
}

?>
