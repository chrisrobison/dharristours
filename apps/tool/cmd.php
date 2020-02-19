<?php
   include($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');

   $rsc = ($in['rsc']) ? $in['rsc'] : 'Login';
   
   $count = $in['rows']; 
   $start = (($in['page'] - 1) * $in['rows']);
   
   $boss->db->addResource($rsc);
   
   $q = "select SQL_CALC_FOUND_ROWS * from `".mysql_real_escape_string($rsc)."` where 1=1 order by `".mysql_real_escape_string($in['sidx'])."` ".mysql_real_escape_string($in['sord'])." limit $start, $count";
   $dbh = $boss->db->{$rsc}->execute($q);
   while ($row = mysql_fetch_object($dbh)) { $rows[] = $row; }
   
   $dbr = $boss->db->{$rsc}->execute("select FOUND_ROWS() as total");
   $row = mysql_fetch_object($dbr);
   $total = $row->total;
   $out = '{"page":"'.$in['page'].'","total":"'.ceil($total/$count).'","records":"'.$total.'","rows":';
   $out .= json_encode($rows);
   $out .= "}";
   
   header('Cache-Control: no-cache, must-revalidate');
   header('Expires: Thu, 15 Oct 1970 05:00:00 GMT');
   header('Content-type: application/json');

   print $out;

?>
