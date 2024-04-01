<?php
   include($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');
   
   if ($in['pid'] || $in['ProcessID']) {
      $in['pid'] = ($in['pid'])?$in['pid']:($in['ProcessID']?$in['ProcessID']:0);
      if ($in['pid']) $process = $boss->getObject("Process", $in['pid']);
      if (!$in['rsc'] && $process->Resource) $in['rsc'] = $process->Resource;
   }
   
   $rsc = $in['rsc'] = ($in['rsc']) ? $in['rsc'] : $in['Resource'];
   $sys = $boss->db;
   
   if (($in['x'] == "save") || ($in['x'] == "new")) {
      $result = $boss->storeObject($boss->cleanObject($_POST));
      $newids = array_values($result);
      $newid = array_pop($newids);
      $current = $boss->getObject($in['rsc'], $newid);
      $out = "<script type='text/javascript'>";
      if ($in['x'] == 'new') $out .= "$('#mygrid').trigger('reloadGrid');";
      $out .= "top.updateStatus('Saved ".$in['rsc']." ID $newid');simpleConfig.id={$newid};fillForm($('#simpleForm'),'{$newid}',".json_encode($current).");</script>";
   } else if ($in['x'] == 'move') {
      $sys->addResource($in['rsc']);
      $sys->{$in['rsc']}->fetch_fields($in['rsc']);
      $fields = $sys->{$in['rsc']}->fields;
      $sql = "";
      foreach ($fields as $field) {
         if ($field->Field == $in['field']) {
            $type = $field->Type;
            $null = ($field->Null=="NO") ? "NOT NULL" : "";
            $default = $field->Default;
            $sql = "alter table `".$in['rsc']."` modify ".$boss->_quote($in['field'],'')." ".$type." ".$null." ".$default." AFTER ".$in['after'];
            break;
         }
      }
      $sys->{$in['rsc']}->execute($sql);
      $out .= "<script>top.updateStatus('Moved field ".$in['field']." after field ".$in['after']." in ".$in['rsc']." table.');</script>";
   } else if ($in['x'] == 'delete') {
      if ($in['id'] && $in['rsc']) {
         $sys->addResource($in['rsc']);
         $sys->{$in['rsc']}->get($in['id']);
         $bak = $sys->{$in['rsc']}->{$in['rsc']}[0];
         // $bak = $sys->db->getObject($in['rsc'], $in['id']);
         $sys->{$in['rsc']}->remove($in['id']);
         $msg = "Record ID ".$in['id']." removed from ".$in['rsc']." at ".date("Y-m-d h:ia");
         file_put_contents("/tmp/simpledb_deleted.log", "--\n<".$_SESSION['Email']."> $msg:\n".json_encode($bak)."\n--\n", FILE_APPEND);
         $out = "<script type='text/javascript'>$('#mygrid').trigger('reloadGrid');top.updateStatus('Record Deleted: ".$msg."');</script>";
      }
   } else if ($in['x'] == 'unclamp') {
      $sys->addResource('Clamp');
      $sql = "delete from Clamp where (Local=".$boss->_quote($in['rsc'])." and LocalID=".$boss->_quote($in['id'])." and Remote=".$boss->_quote($in['remote']).")";
      print $sql;
      $sys->Clamp->execute($sql);
      $out = "<script>loadRecord('{$in['rsc']}','{$in['id']}');top.updateStatus('Removed all associations between {$in['rsc']} ID {$in['id']} and {$in['remote']}');</script>";
   } else if ($in['x'] == 'clamp') {
      $cnt = 1;
      $sys->addResource('Clamp');
      foreach ($in['data'] as $idx=>$rec) {
         if (!$rec['Remote'] && $rec['pid']) {
            $rproc = $boss->getObject('Process', $rec['pid']);
            $in['data'][$idx]['Remote'] = $rec['Remote'] = $rproc->Resource;
         }
         if ($rec['Remote']) {
            $sys->Clamp->execute("delete from Clamp where (Local=".$boss->_quote($rec['Local'])." and LocalID=".$boss->_quote($rec['LocalID'])." and Remote=".$boss->_quote($rec['Remote']));
         }
         $clamp['Clamp']['new'.$cnt] = $rec;
         ++$cnt;
      }
      $result = $boss->storeObject($clamp);
      $newids = array_values($result);
      $out = "<script>loadRecord('{$in['rsc']}','{$in['id']}');top.updateStatus('Associated {$in['data'][0]['Local']} ID {$in['data'][0]['LocalID']} to {$in['data'][0]['Remote']} ID {$in['data'][0]['RemoteID']}.  New Relation ID".(($cnt>1)?"s":'').": ".join(", ", $result)."');</script>";

   } else if (($in['x'] == 'related') && $rsc) {      // Return all records of data related to current resource and id
      $related = $boss->getRelated($rsc, $in['id']);
      $enchilada = $boss->getObjectRelated($rsc, $in['id'], "all");
      $out = json_encode($enchilada);
      $boss->headers('json');
      print $out;
      exit;
   } else if ($in['x'] == 'import') {
      // $in['debug'] = 1;
      $uploads = $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets.'/imports';
      if (!file_exists($uploads)) mkdir($uploads, 0775);
      list($fname, $ftype) = preg_split("/\./", $_FILES['importFile']['name']);
      if (!$in['rsc']) $in['rsc'] = $fname;      
      $upload = $uploads.'/'.$in['rsc'].'_'.date("Ymdhi").'.txt';
      if ($in['importText']) {
         $in['data'] = $in['importText'];
      } else if ($_FILES['importFile']['size']) {
         $in['data'] = file_get_contents($_FILES['importFile']['tmp_name']);
      }
      file_put_contents($upload, $in['data']);
      $importObj = $boss->parseImport($in['rsc'], $in['data']);
      print_r($importObj);
      $ids = $boss->storeObject($importObj);
      $out = "<script type='text/javascript'>if (parent && parent.$) { parent.$('#mygrid').trigger('reloadGrid'); } top.updateStatus('".count($ids)." records imported or updated.');</script>";
   }

   if ($in['sendEmail']) {
      $util = $boss->utility;

      $msgfile = $boss->getFilePath($in['rsc'].'Email_'.$in['sendEmail'].'.txt');
      if (file_exists($msgfile)) {
         $msg = file_get_contents($msgfile);
         $mail = (array)$current;
         $mail['RFCDate'] = date('r');
         $mail['URL'] = "//".$_SERVER['HTTP_HOST']."/apps/?pid=".$in['pid']."&rsc=".$in['rsc']."&id=".$in[$in['rsc'].'ID'];
         $rep = "\$mail[\$1]";
         $msg = preg_replace("/\#(\w+)\#/e", $rep, $msg);
         file_put_contents("/tmp/send_email.log", $msg, FILE_APPEND);
         $util->sendMail($msg);
      }
   }
   if ($rsc && !$out) {
      $count = $in['rows'] ? $in['rows'] : 0; 
      $start = ($in['page']) ? (($in['page'] - 1) * $in['rows']) : 0;
      
      $sys->addResource($rsc);
      
      if ($in['_search']=="true") {
         $cmp = array('eq'=>'=','ne'=>'!=','lt'=>'<','le'=>'<=','gt'=>'>','ge'=>'>=','bw'=>'like','bn'=>'not like','in'=>'like','ni'=>'not like','ew'=>'like','en'=>'not like','cn'=>'like','nc'=>'not like');
         if (preg_match("/bw|bn/", $in['searchOper'])) $in['searchString'] = $in['searchString'] .'%';
         if (preg_match("/ew|en/", $in['searchOper'])) $in['searchString'] = '%'.$in['searchString'];
         if (preg_match("/in|ni|cn|nc/", $in['searchOper'])) $in['searchString'] = '%'.$in['searchString'].'%';
            
         $searchQuery = $in['searchField'] . " " . $cmp[$in['searchOper']] . " '" . mysql_real_escape_string($in['searchString'])."'";
      }
      if (!preg_match("/\w/", $searchQuery)) $searchQuery = '1=1';
      
      if ($in['pid']) {
         $process = $boss->getObject('Process', $in['pid']);
         if ($process->OverviewQuery) {
            $q = preg_replace("/^select/i", 'select SQL_CALC_FOUND_ROWS ', $process->OverviewQuery); 
         } else {
            $q = "select SQL_CALC_FOUND_ROWS * from `".mysql_real_escape_string($process->Resource)."`";
         }
      } else {
         $q = "select SQL_CALC_FOUND_ROWS * from `".mysql_real_escape_string($rsc)."`";
      }
      if ($process && $process->OverviewFunction && ($in['x'] == "export")) {
         $boss->headers('text/csv', true, array('Content-Disposition'=>'attachment; filename="'.preg_replace("/\W/", '', $process->Process).'.txt"'));
         $data = $boss->utility->{$process->OverviewFunction}(false);
         print join("\t", array_keys((array)$data[0]))."\r\n";
         foreach ($data as $rec) { print join("\t", (array)$rec)."\r\n"; }
         exit;
      }
      if (!preg_match("/where/i", $q)) $q .= " where ".$searchQuery;
      if ($in['sidx']) $q .= " order by `".mysql_real_escape_string($in['sidx'])."`";
      if ($in['sidx'] && $in['sord']) $q .= " ".mysql_real_escape_string($in['sord']);
      if ($count) $q .= " limit $start, $count";
      $_SESSION['lastQuery'] = $q;
      file_put_contents("/tmp/simpledb.log", $q."\n", FILE_APPEND);
      
      $dbh = $sys->{$rsc}->execute($q);

      if ($in['x'] == 'export') {
         $boss->headers('text/csv', true, array('Content-Disposition'=>'attachment; filename="'.$rsc.'.txt"'));
         // header('Content-type: text/csv');
         // header('Content-Disposition: attachment; filename="'.$rsc.'.txt"');
         // print_r($in);

         if ($in['data']) {
            $import = json_decode($in['data']);
            print join("\t", array_keys((array)$import[0]))."\r\n";
            foreach ($import as $i=>$row) {
               print join("\t", array_values((array)$row))."\r\n";
            }
         } else {
            // print "Query: $q\n";
            while ($row = mysql_fetch_object($dbh)) {
               if (!$header) {
                  print join("\t", array_keys((array)$row))."\r\n";
                  $header = 1;
               }
               print join("\t", (array)$row)."\r\n";
            }
         }
         exit;
      } 
      if ($in['rows']) {
         while ($row = mysql_fetch_object($dbh)) { $rows[] = $row; }
         $dbr = $sys->{$rsc}->execute("select FOUND_ROWS() as total");
         $row = mysql_fetch_object($dbr);
         $total = $row->total;
         $out = '{"page":"'.$in['page'].'","total":"'.ceil($total/$count).'","records":"'.$total.'","rows":'.json_encode($rows).'}';
         
         $boss->headers('json');
         print $out;
         exit;
      }
   } 
   
   if ($out) {
      $boss->headers('html');
      print $out;
   }

?>
