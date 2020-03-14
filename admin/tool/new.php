<?php
   include($_SERVER['DOCUMENT_ROOT'].'/lib/boss_class.php');
   $boss = new boss();
   $in = $_REQUEST;
   
   $sys = new obj('SS_System', 'pimp', 'pimpin', 'localhost');

   if ($in['x']=='newapp') {
      if ($in['appname'] && $in['appname']!="null" && $in['appname']!="undefined") {
         $appname = preg_replace("/\W/", '', $in['appname']);
         $dnsname = strtolower($appname);
         $ids = array();
         if ($in['Client']) {
            $out['Client'] = $in['Client'];
            $sys->addResource('Client');
            $ids = $sys->Client->update_multi($out);
         }
         $sys->addResource('App');
         $sys->App->get($n['DB'], 'DB');

         $new['App']['new1'] = array();
         $n =& $new['App']['new1'];
         $n['Active'] = "1";
         $n['ClientID'] = $ids[0];
         $n['App'] = $in['appname'];
         $n['Assets'] = "/clients/".$dnsname;
         $n['CSS'] = "main.css";
         $n['DBHost'] = "localhost";
         $n['DBPwd'] = "pimpin";
         $n['DBUser'] = "pimp";
         $n['DB'] = "SS_".ucfirst(preg_replace("/\W([a-z])?/", strtoupper("$1"), $in['appname']));
         $n['Domain'] = "dev.sscsf.com";
         $n['Host'] = $dnsname;
         $n['LoginCount'] = "50";
         $n['Logo'] = "img/logo.png";
         
         $ids = $sys->App->update_multi($new['App']);
         
         if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/clients/'.$dnsname)) {
            file_put_contents("/www/.sysupdate/simple.ns", $appname."\n", FILE_APPEND);
         }
         $out .= "<script type='text/javascript'>setTimeout(function() {window.open('http://$dnsname.dev.sscsf.com/', '$appname');},2000);";
         $out .= "updateStatus('Created new application at http://$dnsname.dev.sscsf.com/');</script>";
      }
   } else if (($rsc == "App") && (($in['x']=='new') || ($in['x']=='save'))) {
      $sys->addResource($in['rsc']);
      $ids = $sys->{$in['rsc']}->update_multi($in[$in['rsc']]);
      $app = preg_replace("/\W/", '', $in['App']['new1']['App']);
      if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/clients/'.$app)) {
         file_put_contents("/www/.sysupdate/simple.ns", $app."\n", FILE_APPEND);
         $out .= "<script type='text/javascript'>updateStatus('Created new application at http://$dnsname.dev.sscsf.com/');</script>";
      }
   } else if (($in['x'] == "save") || ($in['x'] == "new")) {
      // $boss->storeObject($_POST);
      // print_r($in);
      
      $sys->addResource($in['rsc']);
      $ids = $sys->{$in['rsc']}->update_multi($in[$in['rsc']]);
      $out .= "<script type='text/javascript'>updateStatus('Record ID ".$in['id']." updated in ".$in['rsc']."');</script>";
   } else if ($in['x'] = 'delete') {
      if ($in['id'] && $in['rsc']) {
         $sys->addResource($in['rsc']);
         $sys->{$in['rsc']}->get($in['id']);
         $bak = $sys->{$in['rsc']}->{$in['rsc']}[0];
         // $bak = $sys->db->getObject($in['rsc'], $in['id']);
         $sys->{$in['rsc']}->remove($in['id'], $in['rsc']);
         file_put_contents("/tmp/simpledb_deleted.log", "--\n<".$_SESSION['Email']."> Removed record ID ".$in['id']." from resource ".$in['rsc'].":\n".json_encode($bak)."\n--\n", FILE_APPEND);
         $out .= "<script type='text/javascript'>updateStatus('Record ID ".$in['id']." removed from ".$in['rsc']."');</script>";
      }
   }

   print $out;

?>
