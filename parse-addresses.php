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
         if (preg_match("/(\d\d\d\d\d)/", $key, $zips)) {
            if (preg_match("/^9/", $zips[1])) {
               $zipobj = lookupZip($zips[1]);
               $newfilt[$newkey]->zip = $zips[1];
               $newfilt[$newkey]->city = $zipobj['City'];
               $newfilt[$newkey]->state = 'CA';
            }
         }
         array_push($newfilt[$newkey]->items, $key);
      }
   }

   $cities = array('/South San Francisco/i', '/San Francisco/i', '/San Rafael/i', '/Vallejo/i', '/San Ramon/i', '/Castro Valley/i', '/Loma Mar/i', '/Alameda/i', '/Oakland/i', '/Sausalito/i', '/Elk Grove/i', '/Walnut Creek/i', '/Berkeley/i', '/Rocklin/i', '/Atherton/i', '/Brentwood/i', '/Folsom/i', '/Pacifica/i', '/Morgan Hill/i', '/Burlingame/i', '/Lagunita/i', '/El Cerrito/i', '/Richmond/i', '/Monterey/i', '/Montara/i', '/Concord/i', '/Pleasanton/i', '/Windsor/i', '/Corte Madera/i', '/Oakville/i', '/Mill Valley/i', '/Daly City/i', '/Vacaville/i', '/Union City/i', '/Merced/i', '/San Mateo/i', '/Palo Alto/i', '/Hayward/i', '/Livermore/i', '/Santa Clara/i', '/Sunnyvale/i', '/San Carlos/i', '/Redwood City/i', '/San Leandro/i', '/Pleasant Hill/i', '/Hercules/i', '/Eureka/i', '/Marin City/i', '/Danville/i', '/Alviso/i', '/Pittsburgh/i', '/Rohnert Park/i', '/San Lorenzo/i', '/Half Moon Bay/i', '/San Pablo/i', '/Dublin/i', '/Larkspur/i', '/Davis/i', '/Sacramento/i', '/Lafayette/i', '/Ross/i', '/Pittsburg/i', '/Menlo Park/i', '/Novato/i', '/Arbuckle/i', '/Kentfield/i', '/San Jose/i', '/Fremont/i', '/Piedmont/i', '/Boulder Creek/i', '/Healdsburg/i', '/Fairfax/i', '/Milpitas/i', '/Martinez/i', '/Aptos/i', '/Fairfield/i', '/Orinda/i', '/Antioch/i', '/Oakley/i', '/Pinole/i', '/Clayton/i', '/Greenbrae/i', '/Lotus/i', '/Dixon/i', '/Stockton/i', '/Albany/i', '/Emeryville/i', '/Cazadoro/i', '/El Sobrante/i', '/Oakhurst/i', '/Stanford/i', '/Nicasio/i', '/Suisun City/i', '/Napa/i', '/Tomales/i', '/Newark/i', '/Modesto/i', '/Santa Rosa/i', '/Turlock/i', '/Pescadero/i', '/Santa Cruz/i', '/Groveland/i', '/Tiburon/i', '/Crockett/i', '/Sonoma/i', '/Brisbane/i', '/Mountain House/i', '/Mt House/i', '/Tracy/i', '/Moraga/i', '/Los Altos/i', '/Fresno/i', '/San Bruno/i', '/Petaluma/i', '/Benecia/i', '/Gilroy/i', '/Sausilito/i', '/Stinson Beach/i', '/Felton/i', '/San Gregorio/i', '/Mountain View/i', '/Mt View/i', '/Mt. View/i', '/Millbrae/i', '/Milbrae/i', '/Rodeo/i', '/Clarksberg/i', '/Alamo/i', '/Marysville/i', '/Yuba City/i', '/Belmont/i', '/Inverness/i' );
   $city = [];
   $newaddresses = [];
   foreach ($newfilt as $key=>$obj) {
      if (!$newfilt[$key]->city) {
         $newfilt[$key]->city = guessCity($obj);
      }
      $newfilt[$key]->address = preg_replace("/,.*/", '', $obj->items[0]);
      $newfilt[$key]->address = preg_replace($cities, '', $newfilt[$key]->address);
      
      $city[$newfilt[$key]->city][] = $newfilt[$key];
      $newaddr = new stdClass();
      $newaddr->city = $newfilt[$key]->city;
      $newaddr->address = $newfilt[$key]->address;
      $newaddr->state = "CA";
      if ($newfilt[$key]->zip) { 
         $newaddr->zip = $newfilt[$key]->zip;
      }
      $newaddresses[] = $newaddr;
   }

//   print_r($newfilt);
$unknown = array();
foreach ($newfilt as $key=>$obj) {
   if (!$obj->city) {
      $unknown[] = $obj;
   }
}
//print count($unknown) . " out of ".count($newfilt). " missing city.\n";;
//print_r($out);
//print_r($addresses);
//print_r($newaddresses);
$cleaned = array();
print "Address\tCity\tState\tZip\n";
foreach ($newaddresses as $idx=>$obj) {
   $row = array($obj->address, $obj->city, $obj->state, $obj->zip);
   $full = $obj->address . ', ' . $obj->city . ' ' . $obj->state . ' ' . $obj->zip;
   $newaddr = file("https://dharristours.simpsf.com/where/getaddress.php?q=".urlencode($full))[0];
   $cleaned[] = $newaddr;
   //print $newaddr."\n";
   print implode("\t", $row)."\n";
}
   //print json_encode($newfilt);

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
      $cities = array('South San Francisco', 'San Francisco', 'San Rafael', 'Vallejo', 'San Ramon', 'Castro Valley', 'Loma Mar', 'Alameda', 'Oakland', 'Sausalito', 'Elk Grove', 'Walnut Creek', 'Berkeley', 'Rocklin', 'Atherton', 'Brentwood', 'Folsom', 'Pacifica', 'Morgan Hill', 'Burlingame', 'Lagunita', 'El Cerrito', 'Richmond', 'Monterey', 'Montara', 'Concord', 'Pleasanton', 'Windsor', 'Corte Madera', 'Oakville', 'Mill Valley', 'Daly City', 'Vacaville', 'Union City', 'Merced', 'San Mateo', 'Palo Alto', 'Hayward', 'Livermore', 'Santa Clara', 'Sunnyvale', 'San Carlos', 'Redwood City', 'San Leandro', 'Pleasant Hill', 'Hercules', 'Eureka', 'Marin City', 'Danville', 'Alviso', 'Pittsburgh', 'Rohnert Park', 'San Lorenzo', 'Half Moon Bay', 'San Pablo', 'Dublin', 'Larkspur', 'Davis', 'Sacramento', 'Lafayette', 'Ross', 'Pittsburg', 'Menlo Park', 'Novato', 'Arbuckle', 'San Jose', 'Kentfield', 'Fremont', 'Piedmont', 'Boulder Creek', 'Healdsburg', 'Fairfax', 'Milpitas', 'Martinez', 'Aptos', 'Fairfield', 'Orinda', 'Antioch', 'Oakley', 'Pinole', 'Clayton', 'Greenbrae', 'Lotus', 'Dixon', 'Stockton', 'Albany', 'Emeryville', 'Cazadoro', 'El Sobrante', 'Oakhurst', 'Stanford', 'Nicasio', 'Suisun City', 'Napa', 'Tomales', 'Newark', 'Modesto', 'Santa Rosa', 'Turlock', 'Pescadero', 'Santa Cruz', 'Groveland', 'Tiburon', 'Crockett', 'Sonoma', 'Brisbane', 'Mountain House', 'Mt House', 'Tracy', 'Moraga', 'Los Altos', 'Fresno', 'San Bruno', 'Petaluma', 'Benecia', 'Gilroy', 'Sausilito', 'Stinson Beach', 'Felton', 'San Gregorio', 'Mountain View', 'Mt View', 'Mt. View', 'Millbrae', 'Milbrae', 'Rodeo', 'Clarksberg', 'Alamo', 'Marysville', 'Yuba City', 'Belmont', 'Inverness');

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
            
            if (preg_match("/(\d\d\d\d\d)/", $val, $zip)) {
               if (preg_match("/^9/", $zip[1])) {
                  $row['Zip'] = $zip[1];
                  $zipobj = lookupZip($zip[1]);
                  if ($zipobj['City']) {
                     $row['City'] = $zipobj['City'];
                  }
               }
            }
            $row[$keys[$i].'s'] = preg_split("/,\s+?/", $val);

            if (preg_match("/\((.+?)\)?\s*$/", $val, $m)) {
               $val = preg_replace("/\((.+?)\)?\s*$/", '', $val);
               $row[$keys[$i].'s'] = preg_split("/,\s*?/", $val);
               $row[$keys[$i].'s'][] = $m[1];
            }
            $key = $row[$keys[$i].'s'][0].", ".$row[$keys[$i].'s'][1];
            $key = preg_replace("/^\s*/", "", $key);
            $key = preg_replace("/\./", "", $key);
            
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
      mysqli_close($link);
      return array($out, $addresses, $filtered);
   }

   function guessCity($obj) {
      $cities = array('South San Francisco', 'San Francisco', 'San Rafael', 'Vallejo', 'San Ramon', 'Castro Valley', 'Loma Mar', 'Alameda', 'Oakland', 'Sausalito', 'Elk Grove', 'Walnut Creek', 'Berkeley', 'Rocklin', 'Atherton', 'Brentwood', 'Folsom', 'Pacifica', 'Morgan Hill', 'Burlingame', 'Lagunita', 'El Cerrito', 'Richmond', 'Monterey', 'Montara', 'Concord', 'Pleasanton', 'Windsor', 'Corte Madera', 'Oakville', 'Mill Valley', 'Daly City', 'Vacaville', 'Union City', 'Merced', 'San Mateo', 'Palo Alto', 'Hayward', 'Livermore', 'Santa Clara', 'Sunnyvale', 'San Carlos', 'Redwood City', 'San Leandro', 'Pleasant Hill', 'Hercules', 'Eureka', 'Marin City', 'Danville', 'Alviso', 'Pittsburgh', 'Rohnert Park', 'San Lorenzo', 'Half Moon Bay', 'San Pablo', 'Dublin', 'Larkspur', 'Davis', 'Sacramento', 'Lafayette', 'Ross', 'Pittsburg', 'Menlo Park', 'Novato', 'Arbuckle', 'San Jose', 'Kentfield', 'Fremont', 'Piedmont', 'Boulder Creek', 'Healdsburg', 'Fairfax', 'Milpitas', 'Martinez', 'Aptos', 'Fairfield', 'Orinda', 'Antioch', 'Oakley', 'Pinole', 'Clayton', 'Greenbrae', 'Lotus', 'Dixon', 'Stockton', 'Albany', 'Emeryville', 'Cazadoro', 'El Sobrante', 'Oakhurst', 'Stanford', 'Nicasio', 'Suisun City', 'Napa', 'Tomales', 'Newark', 'Modesto', 'Santa Rosa', 'Turlock', 'Pescadero', 'Santa Cruz', 'Groveland', 'Tiburon', 'Crockett', 'Sonoma', 'Brisbane', 'Mountain House', 'Mt House', 'Tracy', 'Moraga', 'Los Altos', 'Fresno', 'San Bruno', 'Petaluma', 'Benecia', 'Gilroy', 'Sausilito', 'Stinson Beach', 'Felton', 'San Gregorio', 'Mountain View', 'Mt View', 'Mt. View', 'Millbrae', 'Milbrae', 'Rodeo', 'Clarksberg', 'Alamo', 'Marysville', 'Yuba City', 'Belmont', 'Inverness');

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

   function lookupZip($zip) {
      $link = mysqli_connect("localhost", "root", ")wsN5WNL%=nNd\$U6", "SS_DHarrisTours");
      /* check connection */
      if (mysqli_connect_errno()) {
          printf("Connect failed: %s\n", mysqli_connect_error());
          exit();
      }
      
      $results = mysqli_query($link, "SELECT * from ZipCode where ZipCode='".$zip."'");
      
      $row = $results->fetch_assoc();

      return $row;
   }
?>
