<?php
   $in = $_REQUEST;
   
   $in['rsc'] = "Bus";

   include($_SERVER['DOCUMENT_ROOT'] . "/.env");
   $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, $env->db->db);

   /* check connection */
   if (mysqli_connect_errno()) {
       printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
   }

   if ($in['rsc']) {
      $sql = "select {$in['rsc']}ID, {$in['rsc']} from {$in['rsc']} where active order by {$in['rsc']}";
      $result = mysqli_query($link, $sql);

      $out = "<select><option value=''>All</option>";

      while ($row = mysqli_fetch_assoc($result)) {
         $out .= "<option>".$row[$in['rsc']]."</option>";
      }
      $out .= "</select>";
      print $out;
   } 

?>
