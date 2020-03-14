<?php
   include($_SERVER['DOCUMENT_ROOT'].'/lib/boss_class.php');
   $boss = new boss();
   $in = $_REQUEST;

   $sys = new obj('SS_System', 'pimp', 'pimpin', 'admin.simpsf.com');
   $local = new obj('SS_System', 'pimp', 'pimpin', 'localhost');
   $results = "";

   if ($in['x']=='deploy') {
      if ($in['AppID'] && $in['AppID']!="null" && $in['AppID']!="undefined") {
         $boss->db->dbobj->execute("use SS_System");
         $boss->db->dbobj->db = 'SS_System';

         $app = $boss->getObject("App", $in['AppID']);

         // This creates the actual App entry in the production SS_System db
         $results .= `./deploy-app {$in['AppID']} >> /tmp/simple-deploy.log 2>&1`;
         
         // Save our current directory for later
         $cwd = getcwd();
         
         // Change directory to clients and execute deploy-files there
         chdir("/simple.dev/clients");
         $dir = preg_replace("/^.+?clients\//", '', $app->Assets);

         $results .= `./deploy-files {$dir} >> /tmp/simple-deploy.log 2>&1`;
         
         // Switch back to our original directory and execute data deployment script
         chdir($cwd);
         $results .= `./deploy-data {$app->DB} >> /tmp/simple-deploy.log 2>&1`;
            
         $upd = array("App"=>array($in['AppID']=>array()));
         $upd['App'][$in['AppID']]['Deployed'] = 1;
         $upd['App'][$in['AppID']]['LastDeployed'] = date("Y-m-d h:i:s");
         $upd['App'][$in['AppID']]['SourceIP'] = $_SERVER["REMOTE_ADDR"];
   
         $boss->storeObject($upd);

         $date = date('r');
         $welcome = <<<EOT
Date: $date
To: {$app->Name} <{$app->Email}>
From: Simple Software System <simple@simplesoftwaresf.com>
Subject: Your '{$app->App}' Simple Web Application

Your new Simple Software Web Application has been setup and is ready for 
you to login and begin using immediately.  Your application is located at:

https://{$app->Host}.simpsf.com/

To login, use your email address [{$app->Email}] as the username   
and enter the password you chose when you signed up and press enter
or click the 'Login' button.  Your Simple Workspace will load and 
is ready to use.

Explore your Simple Workspace and fire up some of the components 
included.  Try creating new data stores and forms with the DB Tool.
Manage or create data using the auto-generated custom application
that has been tailored for your needs. Transform your data into 
information by relating it to other data.  And be sure to tell 
everyone how "Simple" data management can be! 

Please contact us at support@simplesoftwaresf.com if you have any 
questions or comments.  


The Simple Software Team

--
Simple Software, Inc.
1232 Market Street, Suite 120
San Francisco, CA  94102
(415) 484-EASY [3279]
info@simplesoftwaresf.com

EOT;
         if (!$in['nomail']) {
            $fh = file_put_contents("/tmp/simple_welcome.log", "\n".date("Y-m-d H:i:s")."\n".$welcome, FILE_APPEND);
            $ph = popen("/usr/local/sbin/exim -t", 'w');
            fwrite($ph, $welcome);
            fclose($ph);
         }
         if ($in['noclient']) {
            $out = "Deployed AppID {$in['AppID']} to https://{$app->Host}.simpsf.com/"; 
         } else {
            $out .= "<script type='text/javascript'>";
            // $out .= "setTimeout(function() {window.open('http://$dnsname.{$n['Domain']}/', '$appname');},4000);";
            $out .= "window.open('https://{$app->Host}.simpsf.com/', '{$app->Host}Win');";
            $out .= "</script>";
         }
      }
   } else if (($in['x'] == 'deploy-data') && ($in['rel'])) {
      $boss->db->dbobj->execute("use SS_System");
      $app = $boss->getObject("App", $in['AppID']);
      
      $result = `./deploy-data {$in['rel']}`;
      
      $now = date("Y-m-d H:i:s");
      $update['App'][$app->AppID]['LastDeployed'] = $now;
      $boss->storeObject($update);

      $out = "<script>top.updateStatus('Data deploy process completed.  Results: \\n".preg_replace("/\r?\n/", "\\n", $result)."');</script>";
   } else if (($in['x'] == 'deploy-files') && ($in['rel'])) {
      $boss->db->dbobj->execute("use SS_System");
      $app = $boss->getObject("App", $in['AppID']);
      print "<script>top.updateStatus('File deploy process started for {$in['rel']}...');</script>";
      
      $result = `./deploy-files {$in['rel']}`;
      
      $now = date("Y-m-d H:i:s");
      $update['App'][$app->AppID]['LastDeployed'] = $now;
      $boss->storeObject($update);

      $out = "<script>top.updateStatus('File deploy process executed.  Results: \\n".preg_replace("/\r?\n/", "\\n", $result)."');</script>";
   } else if (($rsc == "App") && (($in['x']=='new') || ($in['x']=='save'))) {
      $sys->addResource($in['rsc']);
      $ids = $sys->{$in['rsc']}->update_multi($in[$in['rsc']]);
      $app = preg_replace("/\W/", '', $in['App']['new1']['App']);
      if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/clients/'.$app)) {
         file_put_contents("/www/.sysupdate/simple.ns", $app."\n", FILE_APPEND);
         $out .= "<script type='text/javascript'>top.updateStatus('Created new application at http://$dnsname.{$_SERVER['HTTP_HOST']}/');</script>";
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
   } else if ($in['x'] == 'sync') {
      $results = `./sync-data`;
      $results = `./sync-files`;

   } else if ($in['x'] == 'sync-data') {
      $results = `./sync-data`;
   } else if ($in['x'] == 'sync-files') {
      $results = `./sync-files`;
   }

   print $out;

?>
