<?php
    $in = $_REQUEST;

    if ((array_key_exists('p', $in)) && array_key_exists('m', $in)) {
        $txt = escapeshellarg($in['m']);
        $phone = escapeshellarg($in['p']);
        $cmd = "curl -X POST https://textbelt.com/text  --data-urlencode phone={$phone} --data-urlencode message={$txt} -d replyWebhookUrl='https://dharristours.simpsf.com/files/smsreply.php' -d key=7edde7a9dbe4d92de0b4a9fb222809ea35a706a7PLtg05whqZpekC4KXTYCg6lxz";
        $results = `$cmd`;
        print $results; 
    }
?>
