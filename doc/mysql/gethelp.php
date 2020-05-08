<?php
   $out = getHelp();

   header("Content-type: application/javascript");
   print json_encode($out);
   
   exit;

   function getHelp() {
      include($_SERVER['DOCUMENT_ROOT'] . "/.env");
      $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, $env->db->db);

     
      if (mysqli_connect_errno()) {
         printf("Connect failed: %s\n", mysqli_connect_error());
         exit();
      }
      $sql = "SELECT * from help_topic";
      $result = mysqli_query($link, $sql);
      $out = array();

      while ($row = mysqli_fetch_assoc($result)) {
         $out[] = $row;
      }
   
      /* close connection */
      mysqli_close($link);
      return($out);
  }
?>

