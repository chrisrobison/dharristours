#!/usr/local/bin/php
<?php
$exe = array_shift($argv);

while ($arg = array_shift($argv)) {
    if (file_exists($arg)) {
        $contents = file_get_contents($arg);
        $b64 = base64_encode($contents);
        $out = preg_replace("/(.{76})/", "$1\n", $b64);
        print $out;       
    }
}
?>
