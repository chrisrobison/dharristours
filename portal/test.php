<?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    if (!$root) {
        $root = "..";
    }

    if (!$boss) require_once($root."/lib/auth.php"); 

    $bus = $boss->get("Business", "LoginID is not null");

    $out = array();


    foreach ($bus as $item) {
        $up['LoginID'][$item->LoginID]['BusinessID'] = $item->BusinessID;;
        $outitem = new stdClass();
        foreach ($item as $key=>$val) {
            if ($val) {
                $outitem->{$key} = $val;
            }
        }
        $out[] = $outitem;
    }
    $results = $boss->storeObject($up);
print json_encode($up);
//    print json_encode($out);

?>

