#!/usr/local/bin/php
<?php
   include("checkout_class.php");
   $orders = array();
   array_shift($argv);

   if (!count($argv)) {
      array_push($argv, "../log/google/new-order-notification.log");
   }
   while ($file = array_shift($argv)) {
      print $file."\n";
      $lines = file($file);

      foreach ($lines as $line) {
         $parts = preg_split("/\d\d:\s/", $line, 2);
         $obj = json_decode($parts[1]);
//         print_r($obj);
         $newobj = parseCheckout($obj, 1);
        print_r($newobj); 

         $orders[] = $newobj;
      }
      
      print json_encode($orders);
      print_r($orders); 
   }
   function parseCheckout2($obj, $level=1) {
      if ($obj) {
         if (is_array($obj)) {
            $newobj = array();
            $type = 'array';
         } else {
            $newobj = new stdClass();
            $type = 'object';
         }
         
         foreach ($obj as $key=>$val) {
            $key = preg_replace("/Id$/", 'ID', preg_replace("/\-([a-z])/e", "strtoupper($1)", preg_replace("/^([a-z])/e", "strtoupper($1)", $key)));
               if (is_string($val)) {
                  if ($type == 'array') {
                     $newobj[$key] = $val;
                  } else { 
                     $newobj->$key = $val;
                  }
               } else if (isset($val->VALUE)) {
                  if ($type == 'array') {
                     $newobj[$key] = $val->VALUE;
                  } else {
                     $newobj->$key = $val->VALUE;
                  }
               /*}  else if (isset($val['VALUE'])) {
                  if ($type == 'array') {
                     $newobj[$key] = $val['VALUE'];
                  } else {
                     $newobj->$key = $val['VALUE'];
                  }
                     */
               } else {
                  if ($type == 'array') {
                     $newobj[$key] = parseCheckout($val, $level++);
                  } else {
                     $newobj->$key = parseCheckout($val, $level++);
                  }
               }
            }
         }
      return $newobj;
   }


?>
