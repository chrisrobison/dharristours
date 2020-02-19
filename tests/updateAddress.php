<?php
   include_once("lib/auth.php");

   $results = $boss->getObject("Business");
   
   foreach ($results->Business as $key=>$item) {
      $newname = $boss->utility->titlecase($item->Business); 
      $item->CityStateZip = preg_replace("/[\"\']/", '', $item->CityStateZip);
      list($city, $state, $zip) = preg_split("/[\s,]\s/", $item->CityStateZip);
      $sql = "update Business set Business='".mysql_real_escape_string($newname)."', City='$city', State='$state', Zip='$zip' where BusinessID=".$item->BusinessID.';';
      print $sql."\n";
        $boss->db->dbobj->execute($sql);
   }
?>



