<?php
   include($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');

   $rsc = ($in['rsc']) ? $in['rsc'] : 'Process';
   
   if ($in['rows']) {
      $count = $in['rows']; 
      $start = (($in['page'] - 1) * $in['rows']);
      
      $boss->db->addResource($rsc);
      
      if ($in['_search']=="true") {
         $cmp = array('eq'=>'=','ne'=>'!=','lt'=>'<','le'=>'<=','gt'=>'>','ge'=>'>=','bw'=>'like','bn'=>'not like','in'=>'like','ni'=>'not like','ew'=>'like','en'=>'not like','cn'=>'like','nc'=>'not like');
         if (preg_match("/bw|bn/", $in['searchOper'])) $in['searchString'] = $in['searchString'] .'%';
         if (preg_match("/ew|en/", $in['searchOper'])) $in['searchString'] = '%'.$in['searchString'];
         if (preg_match("/in|ni|cn|nc/", $in['searchOper'])) $in['searchString'] = '%'.$in['searchString'].'%';
            
         $searchQuery = $in['searchField'] . " " . $cmp[$in['searchOper']] . " '" . mysql_real_escape_string($in['searchString'])."'";
      }
      
      if (!preg_match("/\w/", $searchQuery)) $searchQuery = '1=1';
      $q = "select SQL_CALC_FOUND_ROWS * from `".mysql_real_escape_string($rsc)."` where ".$searchQuery." order by `".mysql_real_escape_string($in['sidx'])."` ".mysql_real_escape_string($in['sord'])." limit $start, $count";
      file_put_contents("/tmp/simpledb.log", $q."\n", FILE_APPEND);
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
   } 

   if ($in['x'] == "save") {
      $boss->storeObject($_POST);
      print_r($_POST);
      $out = "Record updated";
   }

   print $out;

?>
