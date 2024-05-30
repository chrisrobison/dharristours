<?php
include(".env");
$in = $_REQUEST;

if (!isset($in['x'])) $in['x'] = "fetchQueueMessages";

switch ($in['x']) {
    case "fetchQueueMessages":
        $out = fetchQueueMessages();
        break;
    case "getReportList":
        $out = getReportList();
        break;
    case "getReport":
        $out = getReport();
        break;
    case "showTripReport":
        $out = showTripReportExtern();
        break;
    case "showTripDetailReport":
        $out = getTripDetailReport();
        break;
    case "showVehicleReport":
        $out = showVehicleReportExtern();
        break;
    default:
        $out = [];
}
header("Content-Type: application/json");
print json_encode($out);
 
function cacheJSON($service, $url, $data) {
    $now = date("Ymdhis"); 
    file_put_contents("/simple/clients/dharristours/webfleet/cache/$service-$now.json", "// $url\n" . $data);   
}

function fetchQueueMessages() {    
    $obj = new stdClass();
    $obj->action = "popQueueMessagesExtern";
    $obj->msgclass = 0;
    $url = makeUrl($obj);

    $results = file_get_contents($url);
    $out = json_decode($results);

    // Webfleet 'popQueueMessagesExtern' doen't really 'pop' the messages, just lists them.
    // Without acknowledging them, the queue will just keep sending the same messages over and over.
    // So we cache the results locally and hit the 'ackQueueMessagesExtern' service so we can get the 
    // next set of messages in the queue (limit is 500 per request)
    cacheJSON("fetchQueueMessages", $url, $results);
    
    $obj = new stdClass();
    $obj->action = "ackQueueMessagesExtern";
    $obj->msgclass = 0;
    $url = makeUrl($obj);

    $ack = file_get_contents($url);
    $out2 = json_decode($ack);  // <--Should we do something with the returned json?

    return $out;
}

function showTripReportExtern($range="d-1") {
    global $in;
    $obj = new stdClass();
    $obj->action = "showTripReportExtern";
    $obj->range_pattern = $range;
    
    $url = makeUrl($obj);
    $results = file_get_contents($url);
    $obj = json_decode($results);
    
    cacheJSON("fetchQueueMessages", $url, $results);
    
    return $obj;
}

function showVehicleReportExtern() {
    global $in;
    $obj = new stdClass();
    $obj->action = "showVehicleReportExtern";
    $obj->range_pattern = $range;
    
    $url = makeUrl($obj);
    $results = file_get_contents($url);
    $obj = json_decode($results);
    
    cacheJSON("fetchQueueMessages", $url, $results);
    
    return $obj;
}

function showTracks($object="") {
    global $in;
    global $env;
    $obj = new stdClass();
    $obj->action = "showTripReportExtern";
    $obj->range_pattern = $range;
    
    $url = makeUrl($obj);
    $oldurl = "https://csv.webfleet.com/extern?account={$env->account}&username={$env->username}&password={$env->password}&apikey={$env->apikey}&lang={$env->lang}&action=showTripReportExtern&range_pattern={$range}&outputformat=json";
    print $url."<br>\n".$oldurl."<br>\n";
    $results = file_get_contents($url);
    $obj = json_decode($results);
    
    cacheJSON("fetchQueueMessages", $url, $results);
    
    return $obj;
}


function getReport() {
    global $in;

    $obj = new stdClass();
    $obj->action = "createReport";
    $obj->reportname = (isset($in['report'])) ? $in['report'] : 'cdr-address';
    $obj->format = "csv";
    
    if (isset($in['range'])) {
        $obj->range_pattern = $in['range'];
    }
    $url = makeUrl($obj);
    
    if (isset($in['type'])) {
        $url .= '&reporttype='.$in['type'];
    }
    $results = file_get_contents($url);
    $out = json_decode($results);
    print $url;
    return $out;
}
 function getTripDetailReport($range="") {
    global $in;

    $obj = new stdClass();
    $obj->action = "createReport";
    $obj->reportname = "cdr-trip-report";
    $obj->format = "csv";

    $url = makeUrl($obj);
    
    if (isset($in['type'])) {
        $url .= '&reporttype='.$in['type'];
    }
    $results = file_get_contents($url);
    $out = json_decode($results);
    return $out;
}
    
function getReportList() {
    global $in;
    
    $obj = new stdClass();
    $obj->action = "getReportList";

    $url = makeUrl($obj);
    
    if (isset($in['type'])) {
        $url .= '&reporttype='.$in['type'];
    }
    $results = file_get_contents($url);
    $out = json_decode($results);
    return $out;
}

function makeUrl($args) {
    global $in;
    global $env;
    $out = [];
    foreach ($env as $key=>$val) {
        if (!preg_match("/^_/", $key)) {
            $arg = $key . "=" . urlencode($val);
            $out[] = $arg;
        }
    }

    foreach ($args as $key=>$val) {
        $arg = $key . "=" . urlencode($val);
        $out[] = $arg;
    }
    return $env->_webfleet_api . implode("&", $out);
}

?>

