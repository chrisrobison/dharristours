<?php
   require($_SERVER['DOCUMENT_ROOT'] . '/lib/boss_class.php');
   $boss = new boss();
   $in = $_REQUEST;

   $in['Url'] = ($in['u']) ? $in['u'] : $in['Url'];
   $in['To'] = ($in['t']) ? $in['t'] : $in['To'];
   $in['Subject'] = ($in['s']) ? $in['s'] : $in['Subject'];
   $in['From'] = ($in['f']) ? $in['f'] : $in['From'];
   $in['Name'] = ($in['n']) ? $in['n'] : $in['Name'];
   $in['Date'] = date('r');

   if (!$in['Url']) $in['Url'] = "https://dharristours.simpsf.com/clients/dharristours/invoices/.html";
   if (!$in['To']) $in['To'] = "sales@dharristours.com,cdr@cdr2.com";
   if (!$in['Subject']) $in['Subject'] = $url;
   if (!$in['From']) $in['From'] = "support@simpsf.com";
   if (!$in['Name']) $in['Name'] = "Simple Software System";

   $tmpl = file_get_contents('apps/templates/emails/htmlmime.eml');

   $in['Content'] = file_get_contents($in['Url']);

   $email = preg_replace("/#(\w+)#/e", "\$in[$1]", $tmpl);
   $url = $in['Url'];
   $url = preg_replace("/.+?files\//", '', $url);
   $url = "clients/dharristours/invoices/{$in['InvoiceID']}.pdf";
file_put_contents("/tmp/test", $url);
   
   $cmd = "echo 'Your latest D Harris Tours invoice is attached.' | mail -a ".escapeshellarg($url)." -s 'D Harris Tours Invoice #{$in['InvoiceID']}' -r 'D Harris Tours <support@dharristours.com>' -b sales@dharristours.com {$in['To']}";
    $result = `$cmd`;

   // $boss->utility->sendMail($email, $in['From'], $in['Name']);
?>
