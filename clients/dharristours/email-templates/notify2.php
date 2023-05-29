#!/usr/local/bin/php
<?php
   
   $env = "prod";  // Change this to 'prod' for production environment or 'dev' from dev env
   
   $conf['dev'] = array("root"=>"/simple.dev", 
                        "host"=>"dharristours.dev.sscsf.com",
                        "db"=>"SS_DHarrisTours");

   $conf['prod'] = array("root"=>"/simple",
                         "host"=>"dharristours.simpsf.com",
                         "db"=>"SS_DHarrisTours");
   
   require($conf[$env]["root"] . "/lib/boss_class.php");
   
   chdir("/simple/clients/dharristours/email-templates");

   $boss = new boss($conf[$env]["host"]);

   $records = $boss->get("DailyJobMail");
   $cnt = count($records);

   for ($i=0; $i<$cnt; $i++) {
      $job = $records[$i];
      $job->BCC .= ",cdr@netoasis.net";

      if ($job->Email == "juana") {
         $job->Email = "juanaharrisdht@att.net";
      }
      $subject = escapeshellarg($job->Subject);
      $content = `./htmlmail.sh -s '{$job->Subject}' -t '{$job->Email}' -f 'Simple Software Notification <notify@simpsf.com>' https://dharristours.simpsf.com/files/email-templates/genemail.php?idx=$i`;
      // $content = `./htmlmail.sh -s {$subject} -t 'cdr@netoasis.net' -f 'Simple Software Notification <notify@simpsf.com>' https://dharristours.simpsf.com/files/email-templates/genemail.php?idx=$i`;
      
      $msgDate = date("D, d M Y H:i:s O");

      $email = "Date: $msgDate\n" . $content;

      $emails[] = $email;
      if (preg_match("/(.+)<(.+)>/", $job->ReplyTo, $match)) {
         $from = $match[2];
         $FROM = $match[1];
      } else {
         $FROM = $from = $job->ReplyTo;
      }

      $cmd = "/usr/sbin/sendmail -t -f$from -F".escapeshellarg($FROM);
      // $sm = popen($cmd, 'w');
      
      file_put_contents($conf[$env]["root"]."/spool/".uniqid().".eml", $email);

      if ($sm) {
         fputs($sm, $email);
         pclose($sm);
      }
      print $cmd."\n".$email."\n\n----\n";
      file_put_contents($conf[$env]["root"] . "/log/notify.log", $cmd."\n".$email."\n", FILE_APPEND);
   }
?>
