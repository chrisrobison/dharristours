<?php

$in = $_GET;

preg_match("/\.(\w\w\w)/", $in['img'], $matches);

$type = $matches[1];

header("Content-type: image/".$type);

$fh = fopen($in['img'], 'r');
$content = fread($fh, filesize($in['img']));
fclose($fh);

print $content;

?>
