<?php

require($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');

if (isset($in['pid'])) {
    $process = $boss->getObject('Process', $in['pid']);
    $in['rsc'] = $process->Resource;
}

if (isset($in['rel']) && isset($in['rsc']) && isset($in['id']) && ($in['id'] !== "0")) {
    $cond = $in['id'];
    if (isset($in['key'])) {
        $key = $in['key'];
        if ($in['rsc'].'ID' == $key) {
            $cond = $in['id'];
        } else {
            $cond = $in['key'] ."='".$in['id']."'";
        }
    } 
    $results = $boss->getObjectRelated($in['rsc'], $cond);
    $clamp = $boss->db->{$in['rsc']}->getClamped($in['rsc'], $in['id']);
    $results->clamped = $clamp;
} else if (isset($in['rsc'])) {
    $results = $boss->getObject($in['rsc'], $in['id']);
}

if ($results) {
    header("Content-type: application/json; charset=utf-8");
    print json_encode($results);
}
