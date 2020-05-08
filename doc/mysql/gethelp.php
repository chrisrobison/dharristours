<?php
   $out = getHelp();

   header("Content-type: application/javascript");
   print json_encode($out);
   
   exit;

   function getHelp() {
      $link = mysqli_connect("localhost", "root", ")wsN5WNL%=nNd\$U6", "mysql");
     
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

