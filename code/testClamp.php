<?php
   include("boss_class.php");

   $boss = new boss();

   $emp['Employee'][1]['Login']['new1']['Login'] = "Patrick";
   $emp['Employee'][1]['Login']['new1']['Email'] = "Patrick@email.com";
   $emp['Employee'][1]['Login']['new1']['Password'] = "whatever";

   $boss->storeObject($emp);

   // looks better with JSON:
   $js = '{"Employee": {"1": {"Login": {"new1": {"Login": "Chris","Email": "cdr@cdr2.com","Passwd": "qwerty"}}}}}';
   $json = json_decode($js);
   print_r($json);

   $boss->storeObject(json_decode($js));

   $recurse = array(
      'Employee'=>array(
         'Login'=>1
      )
   );

   $enchilada = $boss->getObject('Employee', 1, $recurse);

   print_r($enchilada);
   
   // <input type="text" id="Employee[1][Login][new1][Login]" value="mylogin" />

?>
