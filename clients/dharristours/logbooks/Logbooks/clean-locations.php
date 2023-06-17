#!/usr/local/bin/php -q
<?php
    $exe = array_shift($argv);
    $fields = 'Day,StartDate,EndDate,StartTime,EndTime,Duration,FullAddress,AddNo,Vehicle,Latitude,Longitude,Odometer,Driver';
    $seen = array();
    while ($file = array_shift($argv)) {
        //$newfile = preg_replace("/\..*/", ".csv", $file);
        //$results = `ssconvert $file $newfile`;
        $contents = file_get_contents($file);
        $lines = preg_split("/\n/", $contents);

        $fieldsline = array_shift($lines);
        $fieldsline = trim($fields);
        $ourfields = preg_split("/,/", $fieldsline);
        
        foreach ($lines as $line) {
            $line = preg_replace("/\s\|\s/", "\",\"", $line);
            $parts = preg_split("/,[^\s]/", $line);
            $parts = explode(",", $line);
            
            $firstparts = array_splice($parts, 0, 6);
            $lastparts = array_splice($parts, -6, 6);
            $addr = join(",", $parts);
            
            $addr = preg_replace("/\"/", "", $addr);
            $aparts = preg_split("/\,/", $addr);
            array_pop($aparts);
            $obj = new stdClass();
            $obj->Address = "";
            foreach ($aparts as $apart) {
                if (preg_match("/(.+?)\sCA\s(\d+)/", trim($apart), $matches)) {
                    $obj->City = $matches[1];
                    $obj->State = "CA";
                    $obj->Zip = $matches[2];
                } else if (preg_match("/(\w+)\s(\d\d\d\d\d)/", trim($apart), $matches)) {
                    $obj->City = $matches[1];
                    $obj->Zip = $matches[2];
                    $obj->State = 'CA';
                } else {
                    $obj->Address .= $apart . ',';
                }
            }
            $obj->Address = preg_replace("/\,$/", "", $obj->Address);
            $firstparts[] = $addr;
            $newparts = array_merge($firstparts , $lastparts);
            
            for ($i=0; $i<count($newparts); $i++) {
                $obj->{$ourfields[$i]} = preg_replace("/\"$/", "", preg_replace("/^\"/", "", $newparts[$i]));
            }
            if (preg_match("/(.+?)\,\s?(.*)/", $obj->Address, $matches)) {
                $obj->Location = $matches[1];
                $obj->Address = $matches[2];
            } else {
                $obj->Location = $obj->Address;
            }

            $obj->Longitude = sprintf("%0.6f", $obj->Longitude / 1000000);
            $obj->Latitude = sprintf("%0.6f", $obj->Latitude / 1000000);
            $lat = sprintf("%0.2f", $obj->Latitude);
            $lon = sprintf("%0.2f", $obj->Longitude);
            $seenkey = $lat . ':' . $lon;

            if ((!array_key_exists($seenkey, $seen)) && (preg_match("/^\d+/", $obj->Address))) {
                print_r($obj);
                $seen[$seenkey] = $obj;
                $out[] = $obj;
            } else {
                print "Skipping.\n";
        }
        
    }
    $realfields = array('Location', 'Address','City','State','ZipCode','Latitude','Longitude');
    foreach ($out as $rec) {
        $f = array();
        $d = array();
        foreach ($realfields as $rf) {
            $key = $rf;
            $val = $rec->{$rf};
            $f[] = '`'.$key.'`';
            $d[] = "'" . preg_replace("/\'/", "\\'", $val) . "'";
        }
        $sql = "INSERT INTO Location (" . implode(",", $f) . ") VALUES (" . implode(",", $d) .");";
        print $sql."\n";
    }
?>
