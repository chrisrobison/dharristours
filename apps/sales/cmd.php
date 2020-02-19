<?php 
   require_once("../../lib/boss_class.php");
   $boss = new boss();
   $start = $boss->utility->stopwatch();
   session_start();
   if (!$_SESSION['sales']) $_SESSION['sales'] = array();
   $in = $_GET + $_POST;

   if ($in['js']) {
      header("Content-type: application/x-javascript");
   } else {
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
   <head>
      <title>GSC: Gene Bank Order Administation</title>
      <script language="JavaScript">
<?php  
   }
   /**
    * Array for testing that simulates data structure returned by web input
    *
    */
   $in['Resource'] = 'Purchase'; 
   $in['x'] = 'add';
   $in['Purchase'] = array('new1'=>
                        array('Contact'=>array('new1'=>
                           array(
                              'FirstName'=>'chris'
                              //'Address'=>array('search'=>
                              //      array('City'=>'San Francisco')
                              //   )
                              )
                           )
                        )
                     );
   
    /* */
    
   // $resource = "Purchase"; // (!isset($in['Resource'])) ? 'Purchase' : $in['Resource'];
   $resource = (!isset($in['Resource'])) ? 'Purchase' : $in['Resource'];
   
   if (!isset($in['ID']) && !isset($in['x']) && (!isset($in[$resource][$resource.'ID']) || !isset($in[$resource]['search'][$resource.'ID']))) {
      $in['x'] = 'search';
      $in['Purchase'] = array('StatusID'=>'<4');
   }
   
   $recurse = array('Purchase'=>array('Contact'=>array('Phone'=>1),'Vet'=>array('Phone'=>1),'Animal'=>1));
   $in = $boss->prepareSearch($in, '');
   $util = $boss->utility;

   // Clean up array derived from form submission and eliminate any items without values
 print "/*\n";
 print_r($_SESSION);  
 print_r($in);  
 print "\n*/\n";
   // Alias dbobj to $obj for legacy code below
   $obj = $boss->db;
   $obj->addResource($resource);
   
   if (($in['x'] == 'add') || ($in['x'] == 'update')) {
      $updated = $boss->storeRecord($in, 'Purchase');
      $ukeys = array_keys($updated);
      $in['ID'] = $updated[$ukeys[0]];
      $in['PurchaseID'] = $updated[$ukeys[0]];
      if ($in['x'] == 'add') {
         $data = $boss->getObject('Purchase', $in['ID'], $recurse);
         if ($data && $data->PurchaseID) {
            $resultdata[$in['ID']] = buildRecordRow($data);
         }
         print "var resultdata = ".$boss->utility->js_serialize($resultdata, 1).";\n";
         $clear = 0;
         if ($in['js']) {
            print "\tupdateGrid(resultdata, $clear, 1);\n";
         } else {
            print "if (window.parent && window.parent.updateGrid) {\n";
            print "\twindow.parent.updateGrid(resultdata, $clear, 1);\n";
            print "} else if (window.opener && window.opener.updateGrid) {\n";
            print "\twindow.opener.updateGrid(resultdata, $clear, 1);\n";
            print "}\n";
         }
      } 
   }

   if (($in['x'] == 'search') || ($in['x'] == 'get')) {
      if ($in['x'] == 'get') {
         $results = $boss->utility->getPurchases($boss, $in['SearchResource'], $in[$in['SearchResource'].'ID']);
      }
      if ($in['x'] == 'search') {
         $in = $boss->prepareSearch($in, '', 1);
//         print_r($in);
         if (!$in['y']) {
            if (!$in['Purchase']['search']['PurchaseID']) {
               $results = $boss->searchObject('Purchase', $in, 'Purchase', '', '');
            } else {
               $results = array($in['Purchase']['search']['PurchaseID']);
            }
            arsort($results);
            $_SESSION['sales']['resultset'] = $results;
            $_SESSION['sales']['current'] = 0;
            $_SESSION['sales']['search'] = $in;
         } else {
            $results = $_SESSION['sales']['resultset'];
         }
      }
      if ($results) {
         $keys = array_keys($results);
         $in['ID'] = $results[$keys[0]];
         $in[$resource]['search'][$resource.'ID'] = $results[$keys[0]];
         $in[$resource][$resource.'ID'] = $results[$keys[0]];
         
         $resultdata = array();
         $cnt = 0;
         $cursor = 0;
         
         $in['start'] = (!$in['start']) ? 0 : $in['start'];
         $in['count'] = (!$in['count']) ? ((count($results)>50) ? 50 : count($results)) : $in['count'];
         $rkeys = array_keys($results);
         $gridcount = count($results);

         for ($x=$in['start']; $x<($in['count'] + $in['start']); $x++) {
            $idx = $x;
            $key = $results[$rkeys[$x]];

            $data = $boss->getObject('Purchase', $key, $recurse);
            if ($data && $data->PurchaseID) {
               $resultdata[$key] = buildRecordRow($data);
            }
         }
      }

      if ($resultdata) {
         $clear = ($in['start']) ? 0 : 1;
         $gridcount = ($gridcount) ? $gridcount : 0;
         $out = $boss->prepareSearch($resultdata, true);
         print "var resultdata = ".$boss->utility->js_serialize($out, 1).";\n";

         if ($in['js']) {
            print "\tupdateGrid(resultdata, $clear, $gridcount);\n";
         } else {
            print "if (window.parent && window.parent.updateGrid) {\n";
            print "\twindow.parent.updateGrid(resultdata, $clear, $gridcount);\n";
            print "} else if (window.opener && window.opener.updateGrid) {\n";
            print "\twindow.opener.updateGrid(resultdata, $clear, $gridcount);\n";
            print "}\n";
         }
      }

      $results = $boss->prepareSearch($results, true);
      if ($in['y'] != 'more') print "var resultset = ".$boss->utility->js_serialize($results, 1).";\n";
      
      if ($in['js']) {
         print "\tupdateResults(resultset);\n";
      } else if ($in['y'] != 'more') {
         print "if (window.parent && window.parent.updateResults) {\n";
         print "\twindow.parent.updateResults(resultset);\n";
         print "} else if (window.opener && window.opener.updateResults) {\n";
         print "\twindow.opener.updateResults(resultset);\n";
         print "}\n";
      }
   }
   if ($in['x'] == 'view') {
      $in[$resource][$resource.'ID'] = $in[$resource.'ID'];
   }
   
   if ($in['y'] != 'more') {
      if (!isset($in['ID'])) {
         if ($in[$resource]['search'][$resource.'ID'] && !$in['ID']) {
            $in['ID'] = $in[$resource]['search'][$resource.'ID'];
         } elseif ($in[$resource][$resource.'ID'] && !$in['ID']) {
            $in['ID'] = $in[$resource][$resource.'ID'];
         }
      }

      $recurse = array('Purchase'=>array('Contact'=>array('Address'=>1,'Phone'=>1),'Vet'=>array('Address'=>1,'Phone'=>1),'Animal'=>1, 'Sample'=>array('Vial'=>1)));
      $data = $boss->getObject('Purchase', $in['ID'], $recurse);
      $out = $boss->prepareSearch($data, true);
      print "var data = ".$boss->utility->js_serialize($data, 1).";\n";
      
      $elapsed = $boss->utility->stopwatch();
      print "if (window.parent && window.parent.updateData) {\n";
      print "\twindow.parent.updateData('$resource', data);\n";
      print "\twindow.parent.updateTime('$elapsed');\n";
//      if ($updated) print "alert('Updates stored successfully');\n";
      print "} else if (window.opener && window.opener.updateData) {\n";
      print "\twindow.opener.updateData('$resource', data);\n";
      print "\twindow.opener.updateTime('$elapsed');\n";
//      if ($updated) print "alert('Updates stored successfully');\n";
      print "}\n";
   }
?>
      </script>
   </head>
   <body>

   </body>
</html>
<?php
   function buildRecordRow($data) {
      $cobj = $data->Contact[0];
      $vobj = $data->Vet[0];
      $aobj = $data->Animal[0];

      $contact = $cobj->LastName.', '.$cobj->FirstName . (($cobj->Phone[0]->Phone) ? ' - '.$cobj->Phone[0]->Phone : '') . (($cobj->Email) ? ' - <' . $cobj->Email . '>' : '');
      $vet = (($vobj->LastName) ? $vobj->LastName.', ' : '') . (($vobj->FirstName) ? $vobj->FirstName : ''). (($vobj->Phone[0]->Phone) ? ' - '.$vobj->Phone[0]->Phone : '') . (($vobj->Email) ? ' - <' . $vobj->Email . '>' : '');
      $animal = $aobj->Name . (($aobj->Species) ? ' - ' . $aobj->Species : ''  ) . (($aobj->Breed) ? ' - ' . $aobj->Breed : ''  );
      $paid = ($data->Paid) ? 'PAID' : 'NO';

      if (!preg_match("/\w/", $contact)) $contact = '';
      if (!preg_match("/\w/", $vet)) $vet = '';
      if (!preg_match("/\w/", $animal)) $animal = '';

      $tmp = array(
                     'PurchaseID'=>$data->PurchaseID,
                     'ServiceType'=>(($data->ServiceType) ? $data->ServiceType : ''),
                     'Status'=>(($data->Status) ? $data->Status : ''),
                     'Contact'=>(($contact) ? $contact : ''),
                     'Vet'=>(($vet) ? $vet : ''),
                     'Animal'=>(($animal) ? $animal : ''),
                     'Paid'=>$paid
                   );
      return $tmp;
   }
