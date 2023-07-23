<?php
    $in = $_REQUEST;

    $svg = file_get_contents("bus-template.svg");
    $svg = preg_replace("/\{\{BUSNUM\}\}/", (array_key_exists("bus", $in)) ? $in['bus'] : '2302', $svg);

    header("Content-type: image/svg+xml");
    print $svg;
?>
