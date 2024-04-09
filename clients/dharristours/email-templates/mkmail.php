<?php
include("/simple/lib/auth.php");
$in = $_REQUEST;

$tpl = (isset($in['tpl'])) ? $in['tpl'] : "notify.html";
$obj = $boss->getObjectRelated($in['rsc'], $in['id']);

$html = file_get_content($tpl);
$html = preg_replace_callback("/\{\{(.+?)\}\}/", function($m) {
    if (isset($obj->{$m[1]})) {
        return $obj->{$m[1]};
    } else {
        return "";
    }
}, $html);


