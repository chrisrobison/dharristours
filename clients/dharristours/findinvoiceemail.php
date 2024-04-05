<?php
//include("/simple/lib/auth.php");

$in = $_REQUEST;
if (isset($in['id'])) {
    $in['id'] = escapeshellarg($in['id']);
    $results = `egrep -R -s -l {$in['id']} /simple/clients/dharristours/incoming/*`;
    
    $files = preg_split("/\n/", $results);
    $ids = array();
    $out = array();
    $found = array();
    foreach ($files as $file) {
        if (preg_match("/\/(\d+)\D/", $file, $m)) {
            $ids[$m[1]] = 1;
        }
        $found[] = $file;
    }
    $keys = array_keys($ids);

foreach ($found as $msg) {
    if (preg_match("/\d\.json$/", $msg)) {
        if (preg_match("/\/(\d+)\D/", $msg, $m)) {
            $id = $m[1];
        }
        $obj = json_decode(file_get_contents($msg));
        $obj->body = "";
        $obj->msgid = $id;
        $out[] = $obj;
    }
}
    header("Content-Type: application/json");
    print json_encode($out);

}
