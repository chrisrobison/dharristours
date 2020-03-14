<?php
   include($_SERVER['DOCUMENT_ROOT'].'/lib/boss_class.php');
   $boss = new boss();
   $in = $_REQUEST;

   $sys = new obj('SS_System', 'pimp', 'pimpin', 'admin.simpsf.com');
   $local = new obj('SS_System', 'pimp', 'pimpin', 'localhost');

   if ($in['x']=='newapp') {
   if ($in['AppID'] && $in['AppID']!="null" && $in['AppID']!="undefined") {
         $local->addResource('App');
         $local->App->get($in['AppID']);
         $app = $local->App->App[0];

         $sys->addResource('App');
         $sys->App->get($app->DB, 'DB');

         $new['App']['new1'] = array();
         $n =& $new['App']['new1'];
         $n['Active'] = "1";
         $n['ClientID'] = $app->ClientID;
         $n['App'] = $app->App;
         $n['Assets'] = $app->Assets;
         $n['CSS'] = $app->CSS;
         $n['DBHost'] = $app->DBHost;
         $n['DBPwd'] = $app->DBPwd;
         $n['DBUser'] = $app->DBUser;
         $n['DB'] = $app->DB;
         $n['Domain'] = "simpsf.com";
         $n['Host'] = $app->Host;
         $n['LoginCount'] = "50";
         $n['Logo'] = $app->Logo;
         $n['Name'] = $app->Name;
         $n['Email'] = $app->Email;
         $n['Phone'] = $app->Phone;
         $n['Passwd'] = $app->Passwd;

         $ids = $sys->App->update_multi($new['App']);
         
         $date = date('r');
         $welcome = <<<EOT
Date: $date
To: {$in['Name']} <{$in['Email']}>
From: Simple Software System <simple@simplesoftwaresf.com>
Subject: Your '{$appname}' Simple Web Application

Your new Simple Software Web Application has been setup and is ready for 
you to login and begin using immediately.  Your application is located at:

   http://{$app->Host}.{$app->Domain}/

To login, use your email address [{$in['Email']}] as the username   
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


The Simple Software Co. of SF Team

--
Simple Software, Inc.
1232 Market Street, Suite 120
San Francisco, CA  94102
(415) 484-EASY [3279]
info@simplesoftwaresf.com
.
EOT;
         $fh = file_put_contents("/tmp/simple_welcome.log", $welcome, FILE_APPEND);
         $ph = popen("/usr/local/sbin/exim -t", 'w');
         fwrite($ph, $welcome);
         fclose($ph);
   
         $out .= "<script type='text/javascript'>";
         // $out .= "setTimeout(function() {window.open('http://$dnsname.{$n['Domain']}/', '$appname');},4000);";
         $out .= "$('.validateTips').hide();</script>";
         $out .= "<h2>Setup Success!</h2><p>Your new application has been setup at <a style='color:#0000aa;text-decoration:underline;' href='http://$dnsname.{$n['Domain']}/' class='link' target='_blank'>http://$dnsname.{$n['Domain']}/</a><br/>Your Login information is as follows:</p><div style='width:75%;margin:0 auto;background-color:#ffffff;-moz-border-radius:1em;-webkit-border-radius:1em;border-radius:1em;border:1px solid black;padding:1em;'>Login: <strong>{$in['Email']}</strong><br/>Password: <strong>".preg_replace("/^(.)(.+?)(.)$/", "$1**********$3", $in['Password'])."</strong></div>";
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
