<?php
   require($_SERVER['DOCUMENT_ROOT'] . '/lib/boss_class.php');
   $boss = new boss();
   $in = $_REQUEST;

   $in['Url'] = (isset($in['u'])) ? $in['u'] : $in['Url'];
   $in['To'] = (isset($in['t'])) ? $in['t'] : $in['To'];
   $in['Subject'] = (isset($in['s'])) ? $in['s'] : $in['Subject'];
   $in['From'] = (isset($in['f'])) ? $in['f'] : $in['From'];
   $in['Name'] = (isset($in['n'])) ? $in['n'] : $in['Name'];
   $in['Date'] = date('r');
   $in['Template'] = (isset($in['tpl'])) ? $in['tpl'] : "InvoiceReport";
   
   if (!$in['Url']) $in['Url'] = "https://dharristours.simpsf.com/clients/dharristours/invoices/.html";
   if (!$in['To']) $in['To'] = "sales@dharristours.com,cdr@cdr2.com";
//   if (!$in['Subject']) $in['Subject'] = $url;
   if (!$in['From']) $in['From'] = "support@dharristours.com";
   if (!$in['Name']) $in['Name'] = "D Harris Tours";

   $tmpl = file_get_contents('apps/templates/emails/htmlmime.eml');

   $in['Content'] = file_get_contents($in['Url']);
   $email = preg_replace("/#(\w+)#/e", "\$in[$1]", $tmpl);
   
   $url = $in['Url'];
   $url = preg_replace("/.+?files\//", '', $url);
    
   $cwd = getcwd();
   
   if (isset($in['what'])) {
       switch ($in['what']) {
           case "MasterInvoice":
               $email = makeMasterInvoiceEmail();
               $outfile = $in['InvoiceParentID'] . "M" . ".eml";
               break;
           case "InvoiceReport":
               $email = makeInvoiceEmail();
               $outfile = $in['InvoiceID'] . ".eml";
               break;
           case "Confirmation":
                $outfile = $in['ID'] . "C" . ".eml";
                break;
           case "DriverLog": 
                $outfile = $in['ID'] . "DL" . ".eml";
                break;
           default:
                $outfile = $in['ID'] . ".eml";

       }
   }

if ($email) {
    $uid = uniqid();
    file_put_contents("/simple/clients/dharristours/sent-invoices/{$outfile}", $email);    
    file_put_contents("/simple/spool/{$uid}.eml", $email);
    
    $out = new stdClass();
    $out->result = $result;
    $out->status = $status ? "ok" : "error";
    if (isset($in['what']) && ($in['what'] == "MasterInvoice")) {
        $out->InvoiceParentID = $in['InvoiceParentID'];
    }
    if (isset($in['what']) && ($in['what'] == "InvoiceReport")) {
        $out->InvoiceID = $in['InvoiceID'];
    }
    $out->email = $email;
} else {
    $out = new stdClass();
    $out->status = "error";
    $out->msg = "Something went wrong. no email generated.";
}

header("Content-Type: application/javascript");
print json_encode($out);

exit;

function initMessage($url) {
    $uid = uniqid();
    global $in;

    file_put_contents("/simple/log/emailpdf.log", date("Y-m-d H:i:s").": Sending $url to {$in['To']}\n", FILE_APPEND);

    mkdir("/tmp/$uid");
    chdir("/tmp/$uid");
    
    return $uid;
}

function makeMasterInvoiceEmail() {
    global $in;
    $path = "/simple/clients/dharristours/invoices/";
    $base = "https://dharristours.simpsf.com/files/";

    $url = "{$path}{$in['InvoiceParentID']}M.pdf";
    if (!file_exists($url)) {
        if (file_exists("{$path}M{$in['InvoiceParentID']}.html")) {
            $cmd = "wkhtmltopdf -s Letter {$base}invoices/M{$in['InvoiceParentID']}.html {$url}";
            $results = `$cmd`;
        } else {
            $results = `curl -s -o {$path}M{$in['InvoiceParentID']}.html {$base}templates/InvoiceMaster.php?id={$in['InvoiceParentID']}`;
            $results = `wkhtmltopdf -s Letter '{$base}templates/InvoiceMaster.php?ID={$in['InvoiceParentID']}' {$url}`;
        }
    }

    $uid = initMessage($url);

    $cmd = "echo 'Your latest D Harris Tours consolidated invoice is attached.' | mail -F -a ".escapeshellarg($url)." -s 'D Harris Tours Master Invoice #{$in['InvoiceParentID']}' -r 'D Harris Tours <support@dharristours.com>' -b 'sales@dharristours.com' {$in['To']}";
    $result = `$cmd`;
    
    $files = glob("*");
    
    $email = file_get_contents($files[0]);
    
    cleanup($uid);
    return $email;
}

function cleanup($uid) {
    global $cwd;

    chdir($cwd);
    if ($uid && file_exists("/tmp/{$uid}") && is_dir("/tmp/{$uid}")) {
        $results = `rm -Rf /tmp/$uid`;
    }
}

function makeInvoiceEmail() {
    global $in;
    
    $path = "/simple/clients/dharristours/invoices/";
    $base = "https://dharristours.simpsf.com/files/";
    
    $url = "{$path}{$in['InvoiceID']}.pdf";
    if (!file_exists($url)) {
        if (file_exists("{$path}{$in['InvoiceID']}.html")) {
            //print $url."\n";
            //print "Invoice HTML exists. making PDF.\n";
            $cmd = "wkhtmltopdf -s Letter {$base}invoices/{$in['InvoiceID']}.html {$url}";
            $results = `$cmd`;
        } else {
            $results = `curl -s -o {$path}{$in['InvoiceID']}.html {$base}templates/InvoiceReport.php?ID={$in['InvoiceID']}`;
            $results = `wkhtmltopdf -s Letter '{$base}templates/InvoiceReport.php?ID={$in['InvoiceID']}' {$url}`;
        }
    }

    $uid = initMessage($url);

    $cmd = "echo 'Your latest D Harris Tours invoice is attached.' | mail -F -a ".escapeshellarg($url)." -s 'D Harris Tours Invoice #{$in['InvoiceID']}' -r 'D Harris Tours <support@dharristours.com>' -b 'sales@dharristours.com' {$in['To']}";
    $result = `$cmd`;
    
    $files = glob("*");
    
    $email = file_get_contents($files[0]);
    
    cleanup($uid);
    return $email;
}

function makeDriverLogEmail() {
    global $in;
    
    $path = "/simple/clients/dharristours/invoices/";
    $base = "https://dharristours.simpsf.com/files/";
    
    $url = "{$path}{$in['InvoiceID']}.pdf";
    if (!file_exists($url)) {
        if (file_exists("{$path}{$in['InvoiceID']}.html")) {
            //print $url."\n";
            //print "Invoice HTML exists. making PDF.\n";
            $cmd = "wkhtmltopdf -s Letter {$base}invoices/{$in['InvoiceID']}.html {$url}";
            $results = `$cmd`;
        } else {
            $results = `curl -s -o {$path}{$in['InvoiceID']}.html {$base}templates/InvoiceReport.php?ID={$in['InvoiceID']}`;
            $results = `wkhtmltopdf -s Letter '{$base}templates/InvoiceReport.php?ID={$in['InvoiceID']}' {$url}`;
        }
    }

    $uid = initMessage($url);

    $cmd = "echo 'Your latest D Harris Tours invoice is attached.' | mail -F -a ".escapeshellarg($url)." -s 'D Harris Tours Invoice #{$in['InvoiceID']}' -r 'D Harris Tours <support@dharristours.com>' -b 'sales@dharristours.com' {$in['To']}";
    $result = `$cmd`;
    
    $files = glob("*");
    
    $email = file_get_contents($files[0]);
    
    cleanup($uid);
    return $email;
}

// $boss->utility->sendMail($email, $in['From'], $in['Name']);
