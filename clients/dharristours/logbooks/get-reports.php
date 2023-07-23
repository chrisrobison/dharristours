#!/usr/local/bin/php -q
<?php
    $yr = date("Y");
    $mo = date("m");
    $content = file_get_contents("https://csv.webfleet.com/extern?account=harris-tours&username=cdr&password=Simple1%21&apikey=2b6c8db8-071f-44c0-988f-d82718b1be29&lang=en&action=createReport&reportname=Trip%20report%20(detailed%20with%20downtime)&format=csv&year=$yr&month=$mo");
    $tripreports = preg_split("/\r?\n/", $content);
    $fields = str_getcsv(array_shift($tripreports));
    $fieldcnt = count($fields);

    for ($i=0;$i<$fieldcnt;$i++) {
        $fields[$i] = preg_replace("/[^a-zA-Z0-9\s]/", "", $fields[$i]);
        $fields[$i] = preg_replace_callback("/\s(\w)/", function($matches) { return strtoupper($matches[1]); }, $fields[$i]);
    }

    $trips = array();
    $sql = array();

    foreach ($tripreports as $tripline) {
        $vals = str_getcsv($tripline);
        $trip = [];

        if (count($vals)) {
           $sql[] = "INSERT INTO TripReport (`".implode('`,`', $fields)."`) VALUES ('".implode("','", $vals)."');";

           for ($i=0; $i<$fieldcnt; $i++) {
                $trip[$fields[$i]] = $vals[$i];
           }
           $trips[] = $trip;
        }
    }
print implode("\n", $sql);
?>
