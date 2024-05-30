<?php
   require($_SERVER['DOCUMENT_ROOT'] . '/lib/boss_class.php');
   $boss = new boss("dharristours.simpsf.com");
   $in = $_REQUEST;

   $in['Url'] = ($in['u']) ? $in['u'] : $in['Url'];
   $in['To'] = ($in['t']) ? $in['t'] : $in['To'];
   $in['Subject'] = ($in['s']) ? $in['s'] : $in['Subject'];
   $in['From'] = ($in['f']) ? $in['f'] : $in['From'];
   $in['Name'] = ($in['n']) ? $in['n'] : $in['Name'];
   $in['Date'] = date('r');

   if (!$in['Url']) $in['Url'] = "https://dharristours.simpsf.com/clients/dharristours/invoices/.html";
   if (!$in['To']) $in['To'] = "patrick@dharristoursmail.com,cdr@cdr2.com";
   if (!$in['Subject']) $in['Subject'] = $url;
   if (!$in['From']) $in['From'] = "support@dharristours.com";
   if (!$in['Name']) $in['Name'] = "D Harris Tours";
   $in['Bcc'] = "dharristoursrelay@gmail.com,patrick@dharristoursmail.com,cdr@cdr2.com";

   $tmpl = file_get_contents('apps/templates/emails/htmlmime.eml');

   $in['Content'] = file_get_contents($in['Url']);

   $email = preg_replace("/#(\w+)#/e", "\$in[$1]", $tmpl);

   $boss->utility->sendMail($email, $in['From'], $in['Name']);

    $save = new stdClass();
    $save->Sent = new stdClass();
    $save->Sent->new1 = new stdClass();
    
    $new = $save->Sent->new1;
    $new->Sender = "support@dharristours.com";
    $new->Message = $email;
    $new->To = $in['To'];
    $new->Subject = $in['Subject'];
    $new->Url = $in['Url'];
    
    $boss->storeObject($save);

?>
