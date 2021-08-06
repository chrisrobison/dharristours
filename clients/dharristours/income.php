<?php
   include('/simple/.env');
   $in = $_REQUEST;
   $out = array();
   $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");

   /* check connection */
   if (mysqli_connect_errno()) {
       printf("Connect failed: %s\n", mysqli_connect_error());
       exit();
   }
   $sql = "select year(InvoiceDate) as Year, month(InvoiceDate) as Month, concat('$', format(sum(InvoiceAmt), 2)) as Income from Invoice where year(InvoiceDate) > 2010 group by Year, Month with rollup";
   print $sql."\n";
   $results = mysqli_query($link, $sql);
   $out = new stdClass();
   $out->cols = array();
   $out->rows = array();
   $needfields = 1;
   
   if ($results) {
      $records = array();
      $fields = array();

      while ($row = $results->fetch_assoc()) {
         $r = new stdClass();
         $c = array();
         
         foreach ($row as $key=>$val) {
            if ($needfields) {
               $fld = new stdClass();
               $fld->id = $key;
               $fields[] = $key;
               $fld->label = preg_replace("/([a-z])([A-Z])/", "$1 $2", $key);
               $fld->type = "string";
               $out->cols[] = $fld;
            }
            $r->$key = $val;

            $v = new stdClass();
            $v->v = $val;
            $c[] = $v;
         }
         
         $records[] = $r;
         
         $needfields = 0;
         
//         $r->c = $c;
         $out->rows[] = $r;
      }
      outTable($fields, $records);
   }

function outJSON($out) {
   header("Content-type: application/json; charset=utf-8");
   print json_encode($out);
}

function outTable($fields, $out) {

   print implode("\t", $fields)."\n";
   foreach ($out as $idx=>$row) {
      $tmp = array();
      foreach ($fields as $field) {
         $tmp[] = $row->$field;
      }
      print implode("\t", $tmp)."\n";
   }
   

}
?>
