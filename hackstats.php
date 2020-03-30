<?php
   $date = strtotime("Mar 28 21:04:02");

   $lines = file("/var/log/all.log");
   
   function filter_refuse($val) {
      if (is_string($val)) {
         if (preg_match("/refuse/i", $val)) {
            return true;
         } else {
            return false;
         }
      } else {
         return false;
      }
   }

   function filter_fail($val) {
      if (is_string($val)) {
         if (preg_match("/fail/i", $val)) {
            if (!preg_match("/hulk/i", $val)) {
               return true;
            } else {
               return false;
            }
         } else {
            return false;
         }
      } else {
         return false;
      }
   }

   function filter_invalid($val) {
      if (is_string($val)) {
         if (preg_match("/invalid/i", $val)) {
            return true;
         } else {
            return false;
         }
      } else {
         return false;
      }
   }

   $line = array();

   $lines['refuse'] = array_filter($lines, "filter_refuse");
   $lines['fail'] = array_filter($lines, "filter_fail");
   $lines['invalid'] = array_filter($lines, "filter_invalid");

   $counts = array();
   $counts['refuse'] = count($lines['refuse']);
   $counts['fail'] = count($lines['fail']);
   $counts['invalid'] = count($lines['invalid']);

   $keys = array('refuse','fail','invalid');
   $out = array();
   
   foreach ($keys as $idx=>$key) {
      $out[$key] = array();
      foreach ($lines[$key] as $i=>$val) {
         if (preg_match("/(\d+\.\d+\.\d+\.\d+)/", $lines[$key][$i], $matches)) {
            $ip = $matches[1];
         }
         $parts = preg_split("/\s/", $lines[$key][$i]);
         $day = strtotime($parts[0].' '.$parts[1]);
         $date = date("Y-m-d", $day);
         
         if (!$out[$key][$date]) {
            $out[$key][$date] = 1;
         } else {
            $out[$key][$date]++;
         }
      }
   }

   $newout = array(array('Date', 'Refuse', 'Fail', 'Invalid'));

   foreach ($keys as $idx=>$key) {
      ksort($out[$key]);
   }

   foreach ($out['refuse'] as $idx=>$val) {
      $newout[] = array($idx, $out['refuse'][$idx], $out['fail'][$idx], $out['invalid'][$idx]);
   }

   if ($newout) {
      header("Content-type: application/json");
      print json_encode($newout);
   }

?>
