<?php
   // This code needs to be refactored.  It has grown organically and has become very clunky 
   include($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');
   
   if ($in['pid'] || $in['ProcessID']) {
      $in['pid'] = ($in['pid'])?$in['pid']:($in['ProcessID']?$in['ProcessID']:0);
      if ($in['pid']) $process = $boss->getObject("Process", $in['pid']);
      if (!$in['rsc'] && $process->Resource) $in['rsc'] = $process->Resource;
   }
   
   $rsc = $in['rsc'] = ($in['rsc']) ? $in['rsc'] : $in['Resource'];
   $sys = $boss->db;
   $boss->db->dbobj->execute("use SS_System");

   if (($in['x'] == "save") || ($in['x'] == "new")) {
      $form = ($_POST['data']) ? $_POST['data'] : $_POST;
      $result = $boss->storeObject($boss->cleanObject($form, true));
      $newids = array_values($result);
      $newid = array_pop($newids);
      
      if (count($_FILES)) {
         foreach ($_FILES as $file) {
            if ($file['size'] && $file['tmp_name']) {
               $udir = $boss->app->Assets.'/downloads/' . $in['rsc'];
               if (!file_exists($_SERVER['DOCUMENT_ROOT'].$udir)) { mkdir($_SERVER['DOCUMENT_ROOT'].$udir, 0755, true); }
               $ufile = $udir.'/'.$newid.'_'.basename($file['name']);
               move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'].$ufile);

               $upd[$in['rsc']][$newid]['ScreenShot'] = $ufile;
               $boss->storeObject($upd);
            }
         }
      }
      $current = $boss->getObject($in['rsc'], $newid);

      $out = "<script type='text/javascript'>";
      if ($in['x'] == 'new') $out .= "$('#mygrid').trigger('reloadGrid');";
      $out .= "simpleConfig.id='{$newid}';fillForm($('#simpleForm'),'{$newid}',".json_encode($current).");top.updateStatus('Saved ".$in['rsc']." ID $newid');</script>";
   } else if ($in['x'] == 'chpass') {
      if ($in['oldPass'] && (($_SESSION['Login']->Passwd == sha1($in['oldPass'])) || ($_SESSION['Login']->Passwd == $in['oldPass']))) {
         if ($in['newPass'] == $in['confirmPass']) {
            $out['Login'][$_SESSION['LoginID']]['Passwd'] = sha1($in['newPass']);
            $result = $boss->storeObject($out);
         } else {
            // emit error to be displayed in browser here
         }
      }
   } else if ($in['x'] == 'delete') {
      if ($in['id'] && $in['rsc']) {
         $sys->addResource($in['rsc']);
         $sys->{$in['rsc']}->get($in['id']);
         $bak = $sys->{$in['rsc']}->{$in['rsc']}[0];
         // $bak = $sys->db->getObject($in['rsc'], $in['id']);
         $sys->{$in['rsc']}->remove($in['id']);
         $msg = "Record ID ".$in['id']." removed from ".$in['rsc']." at ".date("Y-m-d h:ia");
         file_put_contents("/tmp/simpledb_deleted.log", "--\n<".$_SESSION['Email']."> $msg:\n".json_encode($bak)."\n--\n", FILE_APPEND);
         $out .= "<script type='text/javascript'>$('#mygrid').trigger('reloadGrid');top.updateStatus('Record Deleted: ".$msg."');</script>";
      }
   } else if ($in['x'] == 'unclamp') {
      $sys->addResource('Clamp');
      //$sql = "delete from Clamp where (Local=".$boss->_quote($in['rsc'])." and LocalID=".$boss->_quote($in['id'])." and Remote=".$boss->_quote($in['remote']).")";
      $sql = "delete from Clamp where (Local=".$boss->_quote($in['rsc'])." and LocalID=".$boss->_quote($in['id'])." and Remote=".$boss->_quote($in['remote']).($in['rid']?" and RemoteID=".$boss->_quote($in['rid']):"").")";
      $sys->Clamp->execute($sql);
      $sql = "delete from Clamp where (Remote=".$boss->_quote($in['rsc'])." and RemoteID=".$boss->_quote($in['id'])." and Local=".$boss->_quote($in['remote']).($in['rid']?" and LocalID=".$boss->_quote($in['rid']):"").")";
      $sys->Clamp->execute($sql);
      $out .= "<script>loadRecord('{$in['rsc']}','{$in['id']}');top.updateStatus('Removed all associations between {$in['rsc']} ID {$in['id']} and {$in['remote']}');</script>";
   } else if ($in['x'] == 'clamp') {
      $cnt = 1;
      $sys->addResource('Clamp');
      foreach ($in['data'] as $idx=>$rec) {
         if (!$rec['Remote'] && $rec['pid']) {
            $rproc = $boss->getObject('Process', $rec['pid']);
            $in['data'][$idx]['ProcessID'] = $rec['pid'];
            $in['data'][$idx]['Remote'] = $rec['Remote'] = $rproc->Resource;
         }
         // if ($rec['Remote']) $sys->Clamp->execute("delete from Clamp where (Local=".$boss->_quote($rec['Local'])." and LocalID=".$boss->_quote($rec['LocalID'])." and Remote=".$boss->_quote($rec['Remote']));
         $clamp['Clamp']['new'.$cnt] = $rec;
         ++$cnt;
      }
      $result = $boss->storeObject($clamp);
      $newids = array_values($result);
      $out .= "<script>loadRecord('{$in['rsc']}','{$in['id']}');top.updateStatus('Associated {$in['data'][0]['Local']} ID {$in['data'][0]['LocalID']} to {$in['data'][0]['Remote']} ID {$in['data'][0]['RemoteID']}.  New Relation ID".(($cnt>1)?"s":'').": ".join(", ", $result)."');</script>";

   } else if (($in['x'] == 'related') && $rsc) {      // Return all records of data related to current resource and id
      $enchilada = $boss->getObjectRelated($rsc, $in['id']);
      $out .= json_encode($enchilada);
      $boss->headers('json');
      print $out;
      exit;
   } else if ($in['x'] == 'clamped') {
      $id = ($in['id']) ? $in['id'] : 0;
      $clamps = $boss->getObject("Clamp", "Local='".$in['local']."' AND LocalID=$id");
      $out .= json_encode($clamps);
      $boss->headers('json');
      print $out;
      exit;
   } else if ($in['x'] == "storeConfig") {
      $oldmod = $boss->getObject("Model", "LoginID=".$boss->q($_SESSION['LoginID'])."' AND ProcessID=".$boss->q($in['pid']));

      $mid = ($oldmod->Model[0]) ? $oldmod->Model[0]->ModelID : 'new1';
      
      $mod['Model'][$mid]['ModelID'] = $mid;
      $mod['Model'][$mid]['Config'] = $in['data']['config'];
      $mod['Model'][$mid]['ProcessID'] = $in['pid'];
      $mod['Model'][$mid]['Resource'] = $in['rsc'];
      $mod['Model'][$mid]['LoginID'] = $_SESSION['LoginID'];
      $boss->storeObject($mod);
   }

   if ($in['sendEmail']) {
      $util = $boss->utility;

      $msgfile = $boss->getFilePath($in['rsc'].'Email_'.$in['pid'].'_'.$in['sendEmail'].'.txt');
      if (!file_exists($msgfile)) $msgfile = $boss->getFilePath('emails/'.$in['rsc'].'Email_'.$in['pid'].'_'.$in['sendEmail'].'.txt');
      if (!file_exists($msgfile)) $msgfile = $boss->getFilePath($in['rsc'].'Email_'.$in['sendEmail'].'.txt');
      if (!file_exists($msgfile)) $msgfile = $boss->getFilePath('emails/'.$in['rsc'].'Email_'.$in['sendEmail'].'.txt');
      if (file_exists($msgfile)) {
         $msg = file_get_contents($msgfile);
         $mail = (array)$current;
         $mail['RFCDate'] = date('r');
         $mail['Host'] = $_SERVER['HTTP_HOST'];
         $mail['pid'] = $in['pid']; $mail['rsc'] = $in['rsc']; $mail['id'] = $in[$in['rsc'].'ID'];
         $mail['URL'] = "http://".$_SERVER['HTTP_HOST']."/apps/?pid=".$in['pid']."&rsc=".$in['rsc']."&id=".$in[$in['rsc'].'ID'];
         $rep = "\$mail[\$1]";
         $msg = preg_replace("/\#(\w+)\#/e", $rep, $msg);
         file_put_contents("/tmp/send_email.log", $msg, FILE_APPEND);
         $util->sendMail($msg);
      }
   }
   
   if ($rsc && !$out) {
      $oemrows = $in['rows'];
      $count = $in['rows'] ? $in['rows'] : 100; 
      $start = ($in['page']) ? (($in['page'] - 1) * $in['rows']) : 1;
      
      $sys->addResource($rsc);
      
      if ($in['_search']=="true") {
         $cmp = array('eq'=>'=','ne'=>'!=','lt'=>'<','le'=>'<=','gt'=>'>','ge'=>'>=','bw'=>'like','bn'=>'not like','in'=>'like','ni'=>'not like','ew'=>'like','en'=>'not like','cn'=>'like','nc'=>'not like');
         if (!$in['searchString']) {
            if (!$in['searchOper']) $in['searchOper'] = 'cn';
            
            if ($process->OverviewQuery) {
               $dbh = $sys->{$rsc}->execute($process->OverviewQuery . " LIMIT 1");
               $row = mysql_fetch_object($dbh);
               $fields = array_keys((array)$row);
            } else {
               $fields = $sys->dbobj->fetch_fields($in['rsc']);
            }
            
            foreach ($fields as $field) {
               if ($in[$field] && ($field != $rsc."ID")) {
                  $searchArr[] = $field." like '%".$boss->_quote($in[$field], '')."%'";
                  $in['searchField'] = $field;
                  $in['searchString'] = $in[$field];
               } else if ($in[$field] && ($field == $rsc."ID")) {
                  $searchArr[] = $rsc.'.'.$field." like '%".$boss->_quote($in[$field], '')."%'";
               }
            }
            if (count($searchArr)) {
               $searchQuery = implode(" AND ", $searchArr);
            }
         }
 
         if (!$searchQuery) {
            if (preg_match("/bw|bn/", $in['searchOper'])) $in['searchString'] = $in['searchString'] .'%';
            if (preg_match("/ew|en/", $in['searchOper'])) $in['searchString'] = '%'.$in['searchString'];
            if (preg_match("/in|ni|cn|nc/", $in['searchOper'])) $in['searchString'] = '%'.$in['searchString'].'%';
               
            $searchQuery = $in['searchField'] . " " . $cmp[$in['searchOper']] . " " . $boss->_quote($in['searchString']);
         }
      } else {
         $searchQuery = '1=1';
      }
      
      if ($in['pid']) {
         if (!$process) $process = $boss->getObject('Process', $in['pid']);
         if ($process->OverviewQuery) {
            $q = preg_replace("/^select/i", 'select SQL_CALC_FOUND_ROWS ', $process->OverviewQuery); 
         } else {
         $q = "select SQL_CALC_FOUND_ROWS * from ".$boss->_quote($process->Resource, '`');
         }
      } else {
         $q = "select SQL_CALC_FOUND_ROWS * from ".$boss->_quote($rsc, '`');
      }
      if ($process && $process->OverviewFunction) {
         $data = $boss->utility->{$process->OverviewFunction}(false);
         $count = $in['rows'] ? $in['rows'] : 100;
         $total = $data->_rows;

         if ($in['x'] == "export") {
            $boss->headers('text/csv', true, array('Content-Disposition'=>'attachment; filename="'.preg_replace("/\W/", '', $process->Process).'.txt"'));
            $data = $boss->utility->{$process->OverviewFunction}(false);
            print join("\t", array_keys((array)$data[0]))."\r\n";
            foreach ($data as $i=>$rec) { 
               if (!preg_match("/^_/", $i)) {
                  print preg_replace("/\r?\n/", "\\n", join("\t", (array)$rec))."\r\n"; 
               }
            }
            exit;
         } 
      } else {

         if (!preg_match("/where/i", $q)) {
            $q .= " WHERE ".$searchQuery;
         } else {
            $q .= " AND ".$searchQuery;
         }

         if ($in['id']) $q .= " AND $rsc.{$rsc}ID=".$boss->_quote($in['id']);
         if ($in['ids']) {
            $ids = preg_split("/\D/", $in['ids']);
            $rids = array();
            for ($i=0;$i<count($ids);$i++) {
               $rids[] = "{$rsc}ID=".$boss->_quote($ids[$i]);
            }
            $q .= " AND (".join(" OR ", $rids).")";
         }
         if ($in['sidx']) $q .= " order by ".$boss->_quote($in['sidx'], '`');
         if ($in['sidx'] && $in['sord']) $q .= " ".$boss->_quote($in['sord'], '');
         if ($count && $in['x']!='export') $q .= " limit $start, $count";
         file_put_contents("/tmp/simpledb.log", $q."\n", FILE_APPEND);
         
         if (($in['x'] == 'export') && (!$in['data'])) { $q = preg_replace("/limit.*/i", '', $_SESSION['lastQuery']); }
         
         $_SESSION['lastQuery'] = $q;

        // print $q;
         $dbh = $sys->{$rsc}->execute($q);
      }

      if ($in['x'] == 'export') {
         $boss->headers('text/csv', true, array('Content-Disposition'=>'attachment; filename="'.$rsc.'.txt"'));
         // header('Content-type: text/csv');
         // header('Content-Disposition: attachment; filename="'.$rsc.'.txt"');

         if ($in['data']) {
            $import = json_decode($in['data']);
            print join("\t", array_keys((array)$import[0]))."\r\n";
            foreach ($import as $i=>$row) {
               print preg_replace("/\r?\n/m", "\\n", join("\t", array_values((array)$row)))."\r\n";
            }
         } else {
            //print "Query: $q\n";
            while ($row = mysql_fetch_object($dbh)) {
               if (!$header) {
                  print join("\t", array_keys((array)$row))."\r\n";
                  $header = 1;
               }
               print preg_replace("/\r?\n/m", "\\n", join("\t", (array)$row))."\r\n";
            }
         }
         exit;
      } 

      if ($in['x'] == 'import') {
         $uploads = $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets.'/imports';
         if (!file_exists($uploads)) mkdir($uploads, 0775);
         list($fname, $ftype) = preg_split("/\./", $_FILES['importFile']['name']);
         
         $upload = $uploads.'/'.$in['rsc'].'_'.date("Ymdhi").'.txt';
         if ($in['importText']) {
            $in['data'] = $in['importText'];
         } else if ($_FILES['importFile']['size']) {
            $in['data'] = file_get_contents($_FILES['importFile']['tmp_name']);
         }
         file_put_contents($upload, $in['data']);
         $importObj = $boss->parseImport($in['rsc'], $in['data']);
         
         $ids = $boss->storeObject($importObj);
         $out .= "<script type='text/javascript'>parent.$('#mygrid').trigger('reloadGrid');if (top.updateStatus) top.updateStatus('".count($ids)." records imported or updated.');</script>";
      }

      // If $data has content then serialize, output and exit.
      // Otherwise, iterate over query waiting to be read
      if ($data) {
         
         $total = $count = count($data);
         $rows = array();
         foreach ($data as $key=>$val) {
            if (!preg_match("/^_/", $key)) {
               $rows[] = $val;
            }
         }
         $out .= '{"page":"'.$in['page'].'","total":"'.ceil($total/$count).'","records":"'.$total.'","rows":'.json_encode($rows).'}';

         $boss->headers('json');
         print $out;
         exit;
      } else if ($in['rows']) {
         if ($dbh) {
            while ($row = mysql_fetch_object($dbh)) { $rows[] = $row; }
         }
         $dbr = $sys->{$rsc}->execute("select FOUND_ROWS() as total");
         $row = mysql_fetch_object($dbr);
         $total = $row->total;
         $out .= '{"page":"'.$in['page'].'","total":"'.ceil($total/$count).'","records":"'.$total.'","rows":'.json_encode($rows).'}';
         
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
