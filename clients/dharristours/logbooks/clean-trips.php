#!/usr/local/bin/php -q
<?php
    $exe = array_shift($argv);
    while ($file = array_shift($argv)) {
        //$newfile = preg_replace("/\..*/", ".csv", $file);
        //$results = `ssconvert $file $newfile`;
        $contents = file_get_contents($file);
        $lines = preg_split("/\n/", $contents);

        $fieldsline = array_shift($lines);
        $fieldsline = trim($fieldsline);
        $fieldsline = preg_replace("/\s\|\s/", "\",\"", $fieldsline);
        $fieldsline = preg_replace("/[\+\-\/\(\)]/", "", $fieldsline);
        $fieldsline = preg_replace("/,\s*/", ",", $fieldsline);
        $fieldsline = preg_replace_callback("/\s([a-z])/", function($matches) { return strtoupper($matches[1]); }, $fieldsline);
        $fieldsline = preg_replace("/\"/", "", $fieldsline);

        $ourfields = str_getcsv($fieldsline);
       
        //array_pop($ourfields);
       /*
Vehicle,Day,Start time,End time,Downtime,Duration,Standstill,Start odometer,End odometer,Distance,Driver,Start location,End location,Fuel consumption,Average fuel consumption,+/- Reference (absolute),+/- Refere
nce (relative)
2302  - 2302,Sat 2/5/22,55608000,56379000,438540000,780000,600000,148,148,0,,"DHarris Tours, 2207 Vista Del Rio St, Vallejo 94525, US","DHarris Tours, 2207 Vista Del Rio St, Vallejo 94525, US",,0,0,0

Vehicle
Day
StartTime
EndTime
Downtime
Duration
Standstill
StartOdometer
EndOdometer
Distance
StartLocation
EndLocation
FuelConsumption
AverageFuelConsumption
ReferenceAbsolute
ReferenceRelative
*/
//    $ourfields = array( "Vehicle", "Day", "StartTime", "EndTime", "Downtime", "Duration", "Standstill", "StartOdometer", "EndOdometer", "Distance", "StartLocation", "EndLocation", "FuelConsumption", "AverageFuelConsumption", "ReferenceAbsolute", "ReferenceRelative");

        foreach ($lines as $line) {
            $newparts = str_getcsv($line);
            print_r($newparts);
            /*
            $parts = preg_split("/,/", $line);
            $tail = array_splice($parts, -4, 4);
            $head = array_splice($parts, 0, 10);
            $mid = join(',', $parts);
            $mids = preg_split("/\",\"/", $mid);
            $newparts = array_merge($head, $mids, $tail);
            $newparts[10] = preg_replace("/,\"/", "", $newparts[10]);
            $newparts[11] = preg_replace("/\"/", "", $newparts[11]);
            */

            $obj = new stdClass();
            for ($i=0; $i<count($newparts); $i++) {
                $obj->{$ourfields[$i]} = preg_replace("/\"$/", "", $newparts[$i]);
           }
           $obj->StartLocation = $newparts[10];
           $obj->EndLocation = $newparts[11];
           $obj->Vehicle = trim(preg_replace("/\–.*/", '', $obj->Vehicle));
           $obj->Day = date("Y-m-d", strtotime($obj->Day));
           if ($obj->Vehicle !="") $out[] = $obj;
        }
    }
    
    foreach ($out as $rec) {
        $f = array();
        $d = array();
        foreach ($rec as $key=>$val) {
            $f[] = '`'.$key.'`';
            $d[] = "'" . preg_replace("/\'/", "\\'", $val) . "'";
        }
        $sql = "REPLACE INTO TripReport (" . implode(",", $f) . ") VALUES (" . implode(",", $d) .");";
        print $sql."\n";
    }


    function explodeTime($msec) {
        $sec = $msec / 1000;

        $min = $sec / 60;
        $hr = $min / 60;
        $days = $hr / 24;

        $day = floor($days);
        $hr = floor($hr - ($day * 24));
        $min = $min - floor($hr * 60) - (($day * 24)*60);

        if ($day > 0) {
            $out = $day."d ".$hr."h ".$min."m";
        } else if ($hr > 0) {
            $out = $hr."h ".$min."m";
        } else {
            $out = $min."m";
        }
        return $out;
    }
?>
