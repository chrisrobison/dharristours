#!/usr/local/bin/php -q
<?php
    $exe = array_shift($argv);
    if (count($argv)) {
        $time = strtotime(array_shift($argv));
        $yr = date("Y", $time);
        $mo = date("m", $time);
    } else {
        $yr = date("Y");
        $mo = date("m");
    }
    if (!file_exists("WebfleetAddress{$yr}-{$mo}.csv")) {
        $content = file_get_contents("https://csv.webfleet.com/extern?account=harris-tours&username=cdr&password=Simple1%21&apikey=2b6c8db8-071f-44c0-988f-d82718b1be29&lang=en&action=createReport&reportname=cdr-address&format=csv&year=$yr&month=$mo");
        file_put_contents("WebfleetAddress".$yr."-".$mo.".csv", $content);
    } else {
        $content = file_get_contents("WebfleetAddress{$yr}-{$mo}.csv");
    }
    
    $json = json_decode(file_get_contents("buses.json"));
    $buses = [];
    foreach ($json as $bus) {
        if ($bus->InService && $bus->BusNumber) {
            $buses[$bus->BusNumber] = $bus->BusID;
        }
    }
    $tripreports = preg_split("/\r?\n/", $content);
    $fields = str_getcsv(array_shift($tripreports));
    $fields[] = "Created";
    $fields[] = "CreatedBy";
    $fields[] = "WebfleetAddress";
    $fields[] = "BusID";
    $fields[] = "BusNumber";

    $fieldcnt = count($fields);

    for ($i=0;$i<$fieldcnt;$i++) {
        $fields[$i] = preg_replace("/[^a-zA-Z0-9\s]/", "", $fields[$i]);
        $fields[$i] = preg_replace_callback("/\s(\w)/", function($matches) { return strtoupper($matches[1]); }, $fields[$i]);
    }
// Day,StartDate,EndDate,StartTime,EndTime,Duration,Location,AddressNo,Vehicle,Latitude,Longitude,Odometer
//  0      1        2        3        4       5         6       7         8       9        10       11
    $trips = array();
    $sql = array();
    function quote(&$item, $key) {
        $item = "'".preg_replace("/\'/","\\'", $item)."'";
    }
    foreach ($tripreports as $tripline) {
        $vals = str_getcsv($tripline);
        $trip = [];

        $dparts = preg_split("/\W/", $vals[0]);
        $thismo = array_pop($dparts);
        $thisday = array_pop($dparts);
        $vals[0] = $yr . "-" . $thismo . '-' . $thisday;
        $vals[1] = date("Y-m-d H:i:s", $vals[1] / 1000);
        $vals[2] = date("Y-m-d H:i:s", $vals[2] / 1000);
        $vals[3] = makeTime($vals[3]);
        $vals[4] = makeTime($vals[4]);

        $vals[] = date("Y-m-d h:i:s");
        $vals[] = 'cdr@netoasis.net';
        $vals[] = $vals[6];
        $bus = preg_replace("/\s.*/", "", $vals[8]);
        $vals[] = (isset($buses[$bus])) ? $buses[$bus] : "";
        $vals[] = $bus;

        array_walk($vals, "quote");

        if (count($vals)) {
           $sql[] = "INSERT INTO WebfleetAddress (`".implode('`,`', $fields)."`) VALUES (".implode(",", $vals).");";

           for ($i=0; $i<$fieldcnt; $i++) {
                $trip[$fields[$i]] = $vals[$i];
           }
           $trips[] = $trip;
        }
    }
    array_pop($sql);
print implode("\n", $sql);

function makeTime($ms) {
    $sec = floor($ms / 1000);
    $min = floor($sec / 60);
    $sec = sprintf("%02d", $sec - ($min * 60));
    $hr = sprintf("%02d", floor($min / 60));
    $min = sprintf("%02d", floor($min - ($hr * 60)));
    return $hr.":".$min.":".$sec;
}
?>
