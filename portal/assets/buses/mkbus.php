#!/usr/local/bin/php
<?php
    $exe = array_shift($argv);
    while ($bus = array_shift($argv)) {
        $svg = file_get_contents("bus-template.svg");
        $svg = preg_replace("/\{\{BUSNUM\}\}/", $bus, $svg);

        file_put_contents("$bus.svg", $svg);
        print "Wrote $bus.svg [".strlen($svh)." bytes]\n";
   }
?>
