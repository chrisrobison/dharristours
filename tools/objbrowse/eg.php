<?php
   // Include gsc class (glue class for dbobj)
   require_once("pol/pol_class.php");

   // Instantiate new gsc object
   $obj = new pol();
   
   // Attache the 'Ord' DB table
   $obj->addResource('users');

   // In addition to 'Ord', retrieve associated ('linked') data from 
   // 'Client' and 'ClientPet' tables ('resources')
   $obj->users->linkResource('orders', 'uid', 'uid');

   // Fetch our object using '1155' as our OrdID
   $obj->users->get('1');

   print_r($obj);

