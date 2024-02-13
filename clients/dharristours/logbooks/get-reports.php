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
    if (!file_exists("TripReport_{$yr}-{$mo}.csv")) {
        $content = file_get_contents("https://csv.webfleet.com/extern?account=harris-tours&username=cdr&password=Simple1%21&apikey=2b6c8db8-071f-44c0-988f-d82718b1be29&lang=en&action=createReport&reportname=Trip%20report%20(detailed%20with%20downtime)&format=csv&year=$yr&month=$mo");
        file_put_contents("TripReport_".$yr."-".$mo.".csv", $content);
    } else {
        $content = file_get_contents("TripReport_{$yr}-{$mo}.csv");
    }

    $tripreports = preg_split("/\r?\n/", $content);
    $fields = str_getcsv(array_shift($tripreports));
    $fields[] = "Created";
    $fields[] = "CreatedBy";

    $fieldcnt = count($fields);

    for ($i=0;$i<$fieldcnt;$i++) {
        $fields[$i] = preg_replace("/[^a-zA-Z0-9\s]/", "", $fields[$i]);
        $fields[$i] = preg_replace_callback("/\s(\w)/", function($matches) { return strtoupper($matches[1]); }, $fields[$i]);
    }

    $trips = array();
    $sql = array();
    function quote(&$item, $key) {
        $item = "'".preg_replace("/\'/","\\'", $item)."'";
    }
    foreach ($tripreports as $tripline) {
        $vals = str_getcsv($tripline);
        $trip = [];

        $dparts = preg_split("/\W/", $vals[1]);
        $thismo = array_pop($dparts);
        $thisday = array_pop($dparts);
        $vals[1] = $yr . "-" . $thismo . '-' . $thisday;
        $vals[] = date("Y-m-d h:i:s");
        $vals[] = 'cdr@netoasis.net';

        array_walk($vals, "quote");

        if (count($vals)) {
           $sql[] = "INSERT INTO TripReport (`".implode('`,`', $fields)."`) VALUES (".implode(",", $vals).");";

           for ($i=0; $i<$fieldcnt; $i++) {
                $trip[$fields[$i]] = $vals[$i];
           }
           $trips[] = $trip;
        }
    }
    array_pop($sql);
print implode("\n", $sql);
?>
