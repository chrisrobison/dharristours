#!/usr/local/bin/php -q
<?php
    $exe = array_shift($argv);
    $fields = '"Trip mode","Start time | End time","Departure | Arrival","OdometerDeparture | OdometerArrival",Distance,Driver,Vehicle,Purpose,Contact," "';
    while ($file = array_shift($argv)) {
        $contents = file_get_contents($file);
        $lines = preg_split("/\n/", $contents);

        $fieldsline = array_shift($lines);
        $fieldsline = trim($fields);
        $fieldsline = preg_replace("/\s\|\s/", "\",\"", $fieldsline);
        $fieldsline = preg_replace_callback("/\s([a-z])/", function($matches) { return strtoupper($matches[1]); }, $fieldsline);
        $fieldsline = preg_replace("/\"/", "", $fieldsline);

        $fields = preg_split("/,/", $fieldsline);
        array_pop($fields);
        
        foreach ($lines as $line) {
            $line = preg_replace("/\s\|\s/", "\",\"", $line);
            $parts = preg_split("/,[^\s\d]/", $line);
            array_pop($parts);
            $obj = new stdClass();

            for ($i=0; $i<count($parts); $i++) {
                $obj->{$fields[$i]} = preg_replace("/\"$/", "", $parts[$i]);
           }
           $obj->StartTime = date("Y-m-d H:i:s", strtotime($obj->StartTime));
           $obj->EndTime  = date("Y-m-d H:i:s", strtotime($obj->EndTime));
           
           $obj->Arrival = preg_replace("/^Arrival:\s/", '', $obj->Arrival);
           $obj->Departure = preg_replace("/^Departure:\s/", '', $obj->Departure);
           $obj->Vehicle = trim(preg_replace("/\–.*/", '', $obj->Vehicle));
           $obj->Driver = '';
           $obj->Purpose = '';
           $obj->Contact = '';
           $out[] = $obj;
        }
        
    }

    foreach ($out as $rec) {
        $f = array();
        $d = array();
        foreach ($rec as $key=>$val) {
            $f[] = '`'.$key.'`';
            $d[] = "'" . preg_replace("/\'/", "\\'", $val) . "'";
        }
        $sql = "INSERT INTO LogBook (" . implode(",", $f) . ") VALUES (" . implode(",", $d) .");";
        print $sql."\n";
    }
?>
