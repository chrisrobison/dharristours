<?php
   list($out, $addresses, $filtered) = getAddresses();
   header("Content-type: application/json");

   $last = "";
   $newfilt = array();
   foreach ($addresses as $key=>$obj) {
      $parts = preg_split("/\s+|\,/", $key);
      $newkey = $parts[0].$parts[1];
            
      if (!$newfilt[$newkey]) {
         $newfilt[$newkey] = new stdClass();
         $newfilt[$newkey]->items = array($key);
      } else {
         array_push($newfilt[$newkey]->items, $key);
      }
   }

   foreach ($newfilt as $key=>$obj) {
      $newfilt[$key]->city = guessCity($obj);
      $newfilt[$key]->address = preg_replace("/,.*/", '', $obj->items[0]);
   }

   print_r($newfilt);

//print_r($out);
//print_r($addresses);

//   print json_encode($out);

   function getAddresses() {
      $link = mysqli_connect("localhost", "root", ")wsN5WNL%=nNd\$U6", "SS_DHarrisTours");
      /* check connection */
      if (mysqli_connect_errno()) {
          printf("Connect failed: %s\n", mysqli_connect_error());
          exit();
      }
      $addresses = array(); $filtered = array();
      $out = array(); $cnt = 0;
      $results = mysqli_query($link, "SELECT PickupLocation, DropOffLocation, FinalDropOffLocation FROM Job WHERE JobDate>'2017-01-01'");
      $keys = array('PickupLocation', 'DropOffLocation', 'FinalDropOffLocation');
      $cities = array('South San Francisco', 'San Francisco', 'San Rafael', 'Vallejo', 'San Ramon', 'Castro Valley', 'Loma Mar', 'Alameda', 'Oakland', 'Sausalito', 'Elk Grove', 'Walnut Creek', 'Berkeley', 'Rocklin', 'Atherton', 'Brentwood', 'Folsom', 'Pacifica', 'Morgan Hill', 'Burlingame', 'Lagunita', 'El Cerrito', 'Richmod', 'Monterey', 'Montara', 'Concord', 'Pleasanton', 'Windsor', 'Corte Madera', 'Oakville', 'Mill Valley', 'Daly City', 'Vacaville', 'Union City', 'Merced', 'San Mateo', 'Palo Alto', 'Hayward', 'Livermore', 'Santa Clara', 'Sunnyvale', 'San Carlos', 'Redwood City', 'San Leandro', 'Pleasant Hill', 'Hercules', 'Eureka', 'Marin City', 'Danville', 'Alviso', 'Pittsburgh', 'Rohnert Park', 'San Lorenzo', 'Half Moon Bay', 'San Pablo', 'Dublin');

      while ($row = $results->fetch_assoc()) {
         for ($i = 0; $i < 3; $i++) {
            $val = $row[$keys[$i]];

            $val = preg_replace("/(\d\d\d\-\d\d\d\-\d\d\d\d|\(\d\d\d\)\s?\d\d\d\-\d\d\d\d)/", '', $val);
            $val = preg_replace("/^\s*/", '', $val);
            $val = preg_replace("/HS/", 'High School', $val);
            $val = preg_replace("/ES/", 'Elementary School', $val);
            $val = preg_replace("/MS/", 'Middle School', $val);

            $val = preg_replace("/fco/i", 'Francisco', $val);
            if (preg_match("/SF|Sfc|SFO|San Francisco/i", $val, $matches)) {
               $val = preg_replace("/SF|Sfc|SFO/i", 'San Francisco', $val);
            }
            $val = preg_replace("/[^,]\s(San|Pinole)/", ", $1", $val);
            $row[$keys[$i].'s'] = preg_split("/,\s+?/", $val);

            if (preg_match("/\((.+?)\)?\s*$/", $val, $m)) {
               $val = preg_replace("/\((.+?)\)?\s*$/", '', $val);
               $row[$keys[$i].'s'] = preg_split("/,\s*?/", $val);
               $row[$keys[$i].'s'][] = $m[1];
            }
            $key = $row[$keys[$i].'s'][0].", ".$row[$keys[$i].'s'][1];
            $key = preg_replace("/^\s*/", "", $key);

            if (preg_match("/^\d+\s\w+/", $key)) { $addresses[$key] = ($addresses[$key]) ? $addresses[$key] + 1 : 1; }
      
            $parts = preg_split("/\s+|\,/", $key);
            $newkey = $parts[0].$parts[1];
            
            if (!$filtered[$newkey]) {
               $filtered[$newkey] = new stdClass();
               $filtered[$newkey]->items = array($key);
            } else {
               array_push($filtered[$newkey]->items, $key);
            }

         }
         //array_push($addresses, $row);
      }
      ksort($addresses);
      return array($out, $addresses, $filtered);
   }

   function guessCity($obj) {
      $cities = array('San Francisco', 'San Rafael', 'Vallejo', 'San Ramon', 'Castro Valley', 'Loma Mar', 'Alameda', 'Oakland', 'Sausalito', 'Elk Grove', 'Walnut Creek', 'Berkeley', 'Rocklin', 'Atherton', 'Brentwood', 'Folsom', 'Pacifica', 'Morgan Hill', 'Burlingame', 'Lagunita', 'El Cerrito', 'Richmond', 'Monterey', 'Montara', 'Concord', 'Pleasanton', 'Windsor', 'Corte Madera', 'Oakville', 'Mill Valley', 'Daly City', 'Vacaville', 'Union City', 'Merced', 'San Mateo', 'Palo Alto', 'Hayward', 'Livermore', 'South San Francisco', 'Santa Clara', 'Sunnyvale', 'San Carlos', 'Redwood City', 'San Leandro', 'Pleasant Hill', 'Hercules', 'Eureka', 'Marin City', 'Danville', 'Alviso', 'Pittsburgh', 'Rohnert Park', 'San Lorenzo', 'Half Moon Bay', 'San Pablo');
      $ccnt = count($cities);
      $city = "";
      if ($obj && $obj->items) {
         $n = count($obj->items);
         for ($i=0; $i<$n; $i++) {
            for ($c=0; $c<$ccnt; $c++) {
               $matched = preg_grep("/".$cities[$c]."/i", $obj->items);
               if (count($matched) > 0) {
                  $obj->city = $cities[$c];
                  $city = $cities[$c];
                  //print "Found city '".$cities[$c]."'\n";
                  $c = $ccnt + 1;
                  $i = $n + 1;
               }
            }
         }
      }

      return $city;
   }
?>
