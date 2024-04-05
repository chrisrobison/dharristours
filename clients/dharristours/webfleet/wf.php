<?php
$in = $_REQUEST;

if (!isset($in['x'])) $in['x'] = "fetchQueueMessages";

switch ($in['x']) {
    case "fetchQueueMessages":
        $out = fetchQueueMessages();
        break;
    case "getReportList":
        $out = getReportList();
        break;
    case "showTripReport":
        $out = showTripReportExtern();
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
    $url = "https://csv.webfleet.com/extern?account=harris-tours&username=cdr&password=Simple1%21&apikey=2b6c8db8-071f-44c0-988f-d82718b1be29&lang=en&action=popQueueMessagesExtern&msgclass=0&outputformat=json";
    $results = file_get_contents($url);
    $obj = json_decode($results);

    // Webfleet 'popQueueMessagesExtern' doen't really 'pop' the messages, just lists them.
    // Without acknowledging them, the queue will just keep sending the same messages over and over.
    // So we cache the results locally and hit the 'ackQueueMessagesExtern' service so we can get the 
    // next set of messages in the queue (limit is 500 per request)
    cacheJSON("fetchQueueMessages", $url, $results);

    $url = "https://csv.webfleet.com/extern?account=harris-tours&username=cdr&password=Simple1%21&apikey=2b6c8db8-071f-44c0-988f-d82718b1be29&lang=en&action=ackQueueMessagesExtern&msgclass=0&outputformat=json";
    $ack = file_get_contents($url);
    
    return $obj;
}

function showTripReportExtern($range="d-1") {
    global $in;
    $url = "https://csv.webfleet.com/extern?account=harris-tours&username=cdr&password=Simple1%21&apikey=2b6c8db8-071f-44c0-988f-d82718b1be29&lang=en&action=showTripReportExtern&range_pattern={$range}&outputformat=json";
    $results = file_get_contents($url);
    $obj = json_decode($results);
    
    cacheJSON("fetchQueueMessages", $url, $results);
    
    return $obj;
}

function getReportList() {
    global $in;
    $url = "https://csv.webfleet.com/extern?account=harris-tours&username=cdr&password=Simple1%21&apikey=2b6c8db8-071f-44c0-988f-d82718b1be29&lang=en&action=getReportList&outputformat=json";
    if (isset($in['type'])) {
        $url .= '&reporttype='.$in['type'];
    }
    $results = file_get_contents($url);
    $out = json_decode($results);
    return $out;
}
?>

