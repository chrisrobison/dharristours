<?php
    include('/simple/.env');
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/lib/auth.php');

    $in = $_REQUEST;
    $out = array();
    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");

    session_start();

    /* check connection */
    if (mysqli_connect_errno()) {
         printf("Connect failed: %s\n", mysqli_connect_error());
         exit();
    }
    
    $busID = (array_key_exists('busID', $in)) ? $in['busID'] : $_SESSION['Login']->BusinessID;

    if (array_key_exists("BusinessID", $_SESSION)) {
        $busID = $_SESSION['BusinessID'];
    }

    if ($in['type']) {
        switch($in['type']) {
            case "switch":
                $out = switchBusiness($link, $in);
                break;
            case "businesses":
                $out = getBusinesses($link, $in);
                break;
            case "business":
                $out = getBusiness($link, $in);
                break;
            case "login":
                $out = doLogin($link, $in);
                break;
            case "events":
                $out = getEvents($link, $in);
                break;
            case "event":
                $out = getEvent($link, $in['id']);
                break;
            case "drivers":
                $out = getDrivers($link);
                break;
            case "buses":
                $out = getBuses($link, $in);
                break;
            case "jobs":
                $out = getJobs($link, $in);
                break;
            case "resources":
                $out = getResources($link);
                break;
            case "suggestion":
                $out = getSuggestions($link, $in);
                break;
            case "reserve":
                $out = makeReservation($link, $in);
                break;
            case "update":
                $out = updateData($link, $in);
                break;
            case "updateColor":
                $out = updateColor($link, $in);
                break;
            case "saveRouteMap":
                $out = saveRouteMap($link, $in);
                break;
            case "register":
                $out = registerCustomer($link, $in);
                break;
            case "makeRequest":
                $out = makeRequest($link, $in);
                break;
            case "saveProfile":
                $out = saveProfile($link, $in, $busID);
                break;
            case "saveLogin":
                $out = saveLogin($link, $in);
                break;
            // sumInvoices expects an InvoiceParentID and returns a summary of that Master invoice 
            // and its children
            case "sumInvoices":
                $out = sumInvoices($link, $in);
                break;
            case "getJob":
                $out = getJob($link, $in);
                break;
            case "getMasterInvoice":
                $out = getMasterInvoice($link, $in);
                break;
            case "getInvoices":
                $out = getInvoices($link, $in);
                break;
            case "undo":
                $out = doUndo();
                break;
            case "redo":
                $out = doRedo();
                break;
            case "listJobs":
                $out = listJobs($link, $in);
                break;
            case "getBusinessJobs":
                $out = getBusinessJobs($link, $in);
                break;
            case "makePayment":
                $json = file_get_contents('php://input');
                $data = json_decode($json, true);
                $out = makePayment($link, $data);
            }

        file_put_contents("/tmp/portal-api.log", date("Y-m-d H:i:s") . ":" . $in['type'] . ": " . json_encode($in) . " : " .json_encode($out)."\n", FILE_APPEND);
        
        header("Content-type: application/json; charset=utf-8");
        print json_encode($out);
    }
    
    function getJob($link, $in) {
        $cond = array();
        if (isset($in['cond'])) {
            $cond[] = $in['cond'];
        }
        if (isset($in['id'])) {
            $cond[] = "JobID='".$in['id']."'";
        }
        $where = (count($cond)) ? " WHERE " .join(" AND ", $cond) : '';
        $sql = "SELECT * from Job $where";
        $results = mysqli_query($link, $sql);
        
        if ($results) {
            $out = $results->fetch_assoc();
        }
        
        return $out;
    }

    function getMasterInvoice($link, $in) {
        global $boss;
        $out = [];
        if (isset($in['id'])) {
            $out = $boss->getObject("InvoiceParent", $in['id']);
        }
       
        return $out;
    }

    function getInvoices($link, $in) {
        $cond = (array_key_exists('cond', $in)) ? 'AND ' . $in['cond'] : '';
            
        $sql = "SELECT * from Invoice where InvoiceDate>'2023-01-01' $cond";
        $results = mysqli_query($link, $sql);
        
        if ($results) {
            while ($row = $results->fetch_assoc()) {
                $out[] = $row;
            }
        }
        
        return $out;
    }

    function sumInvoices($link, $in) {
        $out = new stdClass();
        $sql = "SELECT * from Invoice WHERE InvoiceParentID='{$in['pid']}'";
        $results = mysqli_query($link, $sql);
        $invoices = [];
        $unpaid = [];
        while ($row = mysqli_fetch_object($results)) {
            $invoices[] = $row;
            if ($row->Balance > 0) {
                $unpaid[] = $row;
            }
        }
        mysqli_free_result($results);

        $sql = "SELECT InvoiceParent.Date AS date, COUNT(InvoiceID) AS count, SUM(Invoice.Balance) AS total, SUM(Invoice.InvoiceSent) AS Sent, InvoiceParent.InvoiceSent as InvoiceSent FROM InvoiceParent, Invoice WHERE Invoice.InvoiceParentID=InvoiceParent.InvoiceParentID AND InvoiceParent.InvoiceParentID=".$in['pid'];
        $results = mysqli_query($link, $sql);

        if ($results) {
            $out = $results->fetch_object();
            if (!isset($out->date)) $out->date = date("Y-m-d");
            if (!isset($out->total)) $out->total = 0;
            if (!isset($out->Sent)) $out->Sent = 0;
            if (!isset($out->InvoiceSent)) $out->InvoiceSent = 0;
            $out->outstanding = count($unpaid);
            $out->paid = count($invoices) - count($unpaid);
        } 
        return $out;
    }

    function saveProfile($link, $in, $busID) {
        $upd = array();
        $json = json_decode($in['profile']);
        
        foreach ($json as $key=>$val) {
            $upd[] = $key."='".preg_replace("/\'/","\'", $val)."'";
        }
        $sql = "UPDATE Business set ".join(", ", $upd)." WHERE BusinessID='$busID'";
        file_put_contents("/tmp/geocode.log", $sql."\n", FILE_APPEND);
        $results = mysqli_query($link, $sql);
        $out = new stdClass();
        if (mysqli_affected_rows($link)) {
            $out->status = "ok";
        } else {
            $out->status = "error";
        }
        return $out;
    }

    function saveLogin($link, $in) {
        global $boss;
        $before = $boss->getObject("Login", $_SESSION['LoginID']);
        $upd = array();
        
        foreach ($in['profile'] as $key=>$val) {
            $upd[] = $key."='".preg_replace("/\'/","\'", $val)."'";
        }

        $sql = "UPDATE Login set ".join(", ", $upd)." WHERE LoginID='{$_SESSION['LoginID']}';";
print $sql;
        file_put_contents("/tmp/geocode.log", $sql."\n", FILE_APPEND);
        $results = mysqli_query($link, $sql);
        
        $out = new stdClass();
        if (mysqli_affected_rows($link)) {
            $out->status = "ok";
        } else {
            $out->status = "error";
        }
        return $out;
    }

    function makeRequest($link, $in) {
        global $_REQUEST;
        
        $posted = file_get_contents("php://input");
        $in = json_decode($posted);
        $result = "";
        $new = new stdClass();

        if (isset($in->data)) {
            $out = new stdClass();
            $keys = array();
            $vals = array();
            $in->data->RequestDate = date("Y-m-d h:i:s");

            foreach ($in->data as $key=>$val) {
                $out->{$key} = $val;
                $keys[] = $key;
                $vals[] = $val;
            }

            $sql = "INSERT INTO Request (`" . implode("`,`", $keys)."`) VALUES ('" . implode("','", $vals). "');";

            $result = mysqli_query($link, $sql);
        } else {
            $new->status = "error";
            $new->error = "Invalid request data.";
            return $new;
        }
        if ($result) {
            $newid = mysqli_insert_id($link);
            $new->status = "ok";
            $new->newid = $newid;
        } else {
            $new->status = "error";
            $new->error = "Error creating request";
        }
        
        return $new;
    }

    function doLogin($link, $in, $url="/apps/") {
        global $_REQUEST;
        global $boss;

        if (array_key_exists("email", $in) && array_key_exists("passwd", $in)) {
           if (isset($_REQUEST['submitted'])) {
                if ($in['email'] && $in['password']) {
                    if ($boss->utility->login($boss, $_REQUEST)) {
                     setcookie("email", $in['email']);
                     setcookie("name", $_SESSION['FirstName'] . ' ' . $_SESSION['LastName']);
                     header("Location: $url");
                        exit;
                    } else {
                       $msg = "<div class='formError' style='padding:5px 5px 5px 5px'>Log in failed. Invalid username and/or password.</div>";
                    }
                }
            }
 
        }
        return $_SESSION['Login'];
    }

    function saveRouteMap($link, $in) {
        $out = new stdClass();
        if ((array_key_exists("routeMap", $in)) && (array_key_exists("JobID", $in))) {
            $sql = "UPDATE Job set RouteMap='".mysqli_real_escape_string($link, $in['routeMap'])."' WHERE JobID='".mysqli_real_escape_string($link, $in['JobID'])."'";
            $results = mysqli_query($link, $sql);
            if ($results) {
                $out->status = "ok";
            }
        } else {
            $out->status = "error";
            $out->error_msg = "Missing JobID or routeMap query parameters. Unable to save route map.";
        }
        return $out;
    }

    function switchBusiness($link, $in) {
          global $boss;
          if (array_key_exists("bid", $in)) {
                $bus = $boss->getObject("Business", $in['bid']);
                $business = $bus->Business;
                $_SESSION['Business'] = $bus;
                $_SESSION['BusinessID'] = $bus->BusinessID;
          }
          return $bus;
    }

    function updateData($link, $in) {
        $fields = array('newStart', 'newEnd', 'newColor', 'newResource');
        $realFields = array('newStart'=>'PickupTime', 'newEnd'=>'DropoffTime', 'newResource'=>'BusID');

        if ($in['newResource']) {
            $sql = "SELECT BusID from Bus where BusNumber='{$in['newResource']}'";
            $results = mysqli_query($link, $sql);
            
            if ($results) {
                while ($row = $results->fetch_assoc()) {
                    $in['newResource'] = $row['BusID'];
                }
            }
            file_put_contents("/tmp/calapi.log", date("Y-m-d H:i:s") . " new Resource - {$in['newResource']} \n$sql\n\n", FILE_APPEND);
        }
        if ($in['id']) {
            $upd = array();
            foreach ($fields as $field) {
                if ($in[$field]) {
                    array_push($upd, $realFields[$field] . "='" . mysqli_real_escape_string($link, $in[$field]) ."'");
                }
            }

            if (count($upd)) {
                $sql = "UPDATE Job SET ";
                $sql .= implode($upd, ", ") . " WHERE JobID='" . mysqli_real_escape_string($link, $in['id']) . "'";
                
                file_put_contents("/tmp/calapi.log", date("Y-m-d H:i:s") . ": Updating Job[{$in['id']}] with " . implode($upd, ", ") . "\n$sql\n", FILE_APPEND);
                
                $results = mysqli_query($link, $sql);
                if ($results) {
                    $out["status"] = "ok";
                }
            }
        }
        return $out;
    }

    function updateColor($link, $in) {
        $out = [];
        if ($in['color'] && $in['id']) {
            $sql = "UPDATE Job SET Color='" . mysqli_real_escape_string($link, $in['color']) . "' where JobID='" . mysqli_real_escape_string($link, $in['id']) . "'";
            $results = mysqli_query($link, $sql); 
            if ($results) {
                $out["status"] = "ok";
            }
            return $out;
        }
    }

    function getEvents($link, $in) {
        $colors = array('#e6194b', '#3cb44b', '#ffe119', '#4363d8', '#f58231', '#911eb4', '#46f0f0', '#f032e6', '#bcf60c', '#fabebe', '#008080', '#e6beff', '#9a6324', '#fffac8', '#800000', '#aaffc3', '#808000', '#ffd8b1', '#000075', '#808080', '#ffffff', '#000000');
        
        $out = array(); $cnt = 0;
    
        if ($in['jobdate']) {
            $now = date("Y-m-d", strtotime($in['jobdate']));
        } else {
            $now = date("Y-m-d");
        }

//         $in = $_REQUEST;
        $threedays = date("Y-m-d", strtotime("+3 days"));
        $yesterday = date("Y-m-d", strtotime($in['start']));

        if ($in['start']) {
            $first = date("Y-m-d", strtotime($in['start']));
        } else {
            $first = date("Y-m-d", strtotime('last week'));
        }
        if ($in['end']) {
            $last = date("Y-m-d", strtotime($in['end']));
        } else {
            $last = date("Y-m-d", strtotime('next week'));
        }
        
        // Grab list of buses
        $buses = array();
        
        $sql = "SELECT BusID, Bus, BusNumber, InService from Bus where InService ORDER BY BusNumber";
        $results = mysqli_query($link, $sql);
        if ($results) {
            while ($row = $results->fetch_assoc()) {
                $buses[$row['BusID']] = $row['BusNumber'];
            }
        }
        
        // Grab events for date range
        $sql = "SELECT JobID, Job.Color as JobColor, Business.Color as BusinessColor, Job.Job as Job, Job.JobDate as JobDate, PickupTime, DropOffTime, PickupLocation, DropOffLocation, NumberOfItems, Job.BusID as BusID, SpecialInstructions, Job.EmployeeID as EmployeeID, JobCancelled, Business.Business as Business FROM Job, Business where JobDate>='{$first}' AND JobDate<='{$last}' AND Business.BusinessID=Job.BusinessID";

        $results = mysqli_query($link, $sql);
        
        if ($results) {
            while ($row = $results->fetch_assoc()) {
                $obj = new stdClass();
                $obj->id = $row['JobID'];
                $obj->title = $row['Job'];
                $obj->start = date("c", strtotime($row['JobDate'].' '.$row['PickupTime']));
                $obj->end = date("c", strtotime($row['JobDate'].' '.$row['DropOffTime']));
                $obj->date = date("m/d", strtotime($row['JobDate']));
                $obj->resourceId = $buses[$row['BusID']];
                
                // Set color from business name unless a color is set for either the business or job
                $obj->color = '#' . stringToColorCode($row['Business']); // $row['Color'];
                
                if ($row['BusinessColor'] != '#cccccc') {
                    $obj->color = $row['BusinessColor'];
                }
                
                if ($row['JobColor'] != '#00ee33') {
                    $obj->color = $row['JobColor'];
                } 
                
                if ($row['JobCancelled']==1) {
                    $obj->color = "#222222";
                }
            //    $obj->url = "/grid/view.php?rsc=Job&pid=335&id={$row['JobID']}";
                $obj->url = "javascript:handleClick('{$row['JobID']}')";
                $obj->extendedProps = new stdClass;
                $obj->extendedProps->EmployeeID = $row['EmployeeID'];
                $obj->extendedProps->Employee = getDriver($link, $row['EmployeeID']);

                $cnt++;
                if ($cnt > count($colors)) {
                    $cnt = 0;
                }
                array_push($out, $obj);
            }
        }

        return $out;
    }
    function stringToColorCode($str) {
        $code = dechex(crc32($str));
        $code = substr($code, 0, 6);
        return $code;
    }

    function getBusinesses($link, $in) {
        $sql = "SELECT * from Business where LoginID is not null";

        $results = mysqli_query($link, $sql);
        $out = array();

        if ($results) {
          while ($row = mysqli_fetch_object($results)) {
                $out[] = $row;
          }
        }

        return $out;
    }
        
    function getBusiness($link, $id) {
        $sql = "SELECT * from Job where JobID='".$id."'";

        $results = mysqli_query($link, $sql);
        
        if ($results) {
            $out = $results->fetch_assoc();
            $out['PickupTime'] = date("g:ia", strtotime($out['PickupTime']));
            $out['DropOffTime'] = date("g:ia", strtotime($out['DropOffTime']));
            
        }

        return $out;
    }
     function getEvent($link, $id) {
        $sql = "SELECT * from Job where JobID='".$id."'";

        $results = mysqli_query($link, $sql);
        
        if ($results) {
            $out = $results->fetch_assoc();
            $out['PickupTime'] = date("g:ia", strtotime($out['PickupTime']));
            $out['DropOffTime'] = date("g:ia", strtotime($out['DropOffTime']));
            
        }

        return $out;
    }
    
    function getBuses($link, $in) {
        $sql = "SELECT BusID, Bus, Capacity, BusNumber, Capacity, InService from Bus";

        if ($in['BusID']) {
            $sql .= " WHERE BusID={$in['BusID']}";
        }
        $results = mysqli_query($link, $sql);
        $out = array();
        while ($row = mysqli_fetch_assoc($results)) {
            $out[] = $row;
        }
        return $out;
    }

    function listJobs($link, $in) {
        global $boss;
        $sql = "SELECT JobID, Job, JobDate, QuoteAmount, InvoiceID, JobCancelled, Status, NoInvoice, InvoiceSatisfied, BusinessID, ContactName, ContactPhone, ContactEmail, EmployeeID, BusID FROM Job";
        if (isset($in['cond'])) {
            $sql .= " WHERE " . $in['cond'];
        } else {
            $start = date("Y-m-d", strtotime("2 weeks ago"));
            $end = date("Y-m-d", strtotime("2 weeks") );
            $sql .= " WHERE JobDate>'$start' AND JobDate<'$end'";
        }
        $results = mysqli_query($link, $sql);

        $out = array();
        if ($results) {
            while ($row = mysqli_fetch_object($results)) {
                $hack = $boss->getObjectRelated("Job", $row->JobID);
                if (isset($hack->related_Invoice)){
                    $row->related_Invoice = $hack->related_Invoice;
                }
                $out[] = $row;
            }
        }
        return $out;
    }
    function getJobs($link, $in) {
        $out = array(); $cnt = 0;
    
        if ($in['jobdate']) {
            $now = date("Y-m-d", strtotime($in['jobdate']));
        } else {
            $now = date("Y-m-d");
        }
        $in = $_REQUEST;
        $threedays = date("Y-m-d", strtotime("+3 days"));
        $yesterday = date("Y-m-d", strtotime($in['start']));
        $first = date("Y-m-d", strtotime($in['start']));
        $last = date("Y-m-d", strtotime($in['end']));

        $bid = ($_SESSION['BusinessID']) ? $_SESSION['BusinessID'] : $_SESSION['Login']->BusinessID;
     
        if (array_key_exists("bid", $in)) {
          $bid = $in['bid'];
        }
        $sql = "SELECT JobID, Job.Job as Job, Job.JobDate as JobDate, PickupTime, DropOffTime, PickupLocation, DropOffLocation, NumberOfItems, Job.BusID as BusID, SpecialInstructions FROM Job where JobDate>='{$first}' AND JobDate<='{$last}' AND JobCancelled=0 AND BusinessID={$bid}";
        $results = mysqli_query($link, $sql);
        
        while ($row = $results->fetch_assoc()) {
            $obj = new stdClass();
            $obj->id = $row['JobID'];
            $obj->title = $row['Job'];
            $obj->start = date("c", strtotime($row['JobDate'].' '.$row['PickupTime']));
            $obj->end = date("c", strtotime($row['JobDate'].' '.$row['DropOffTime']));
            $obj->resourceId = $row['BusNumber'];

            $obj->url = "/grid/view.php?rsc=Job&pid=335&id={$row['JobID']}";
            $cnt++;
            array_push($out, $obj);
        }

        return $out;
    }

    function getResources($link) {
        
        $out = array(); $cnt = 0;
        $results = mysqli_query($link, "SELECT * FROM Bus WHERE Active=1 order by BusNumber");
        
        while ($row = $results->fetch_assoc()) {
            $obj = new stdClass();
            if ($row['BusNumber']) {
                $obj->id = $row['BusNumber'];
                $obj->busID = $row['BusID'];
                $obj->title = '#' . $row['BusNumber'];
            } else {
                $obj->id = $row['Bus'];
                $obj->busID = $row['BusID'];
                $obj->title = $row['Bus'];
            }
            $obj->capacity = $row['Capacity'];

            if (!$obj->capacity || $obj->capacity == "null") {
                $obj->capacity = $row['BusNumber'] ? substr($row['BusNumber'], 0, 2) : 0;
            }
            
            array_push($out, $obj);
        }

        return $out;
    }
    
    function getDriver($link, $id) {
        $out = array(); $cnt = 0;
        $id = mysqli_real_escape_string($link, $id);
        $results = mysqli_query($link, "SELECT EmployeeID, concat(FirstName, ' ', LastName) as Driver, Email, Phone FROM Employee WHERE Active=1 and Driver=1 AND EmployeeID='$id'");
        
        if (mysqli_num_rows($results)) {
            $out = $results->fetch_assoc();
        }

        return $out;
    }

    function getDrivers($link) {
        $out = array(); $cnt = 0;
        $results = mysqli_query($link, "SELECT EmployeeID, concat(FirstName, ' ', LastName) as Driver, Email, Phone FROM Employee WHERE Active=1 and Driver=1");
        
        while ($row = $results->fetch_assoc()) {
            array_push($out, $row);
        }

        return $out;
    }
    
    function getSuggestions($link, $in) {
        $out = new stdClass();
        $out->results = array();
        
        $rsc = $in['rsc'];
        if ($rsc == 'customer') {
            $rsc = 'Business';
            
            $results = mysqli_query($link, "SELECT distinct(Business) from Business where Business like '" . mysqli_real_escape_string($link, $in['q']) . "%' order by Business limit 10");
            while ($row = $results->fetch_assoc()) {
                $match = preg_replace("/(".$in['q'].")/i", "<b>$1</b>", $row['Business']);
                $out->results[] = $match;
                // $out->results[] = $row['Business'];
            }
            
            if (count($out->results) < 10) {
                $results = mysqli_query($link, "SELECT distinct(Business) from Business where Business like '%" . mysqli_real_escape_string($link, $in['q']) . "%' order by Business limit 20");
                while ($row = $results->fetch_assoc()) {
                    $match = preg_replace("/(".$in['q'].")/i", "<b>$1</b>", $row['Business']);
                    if (!in_array($match, $out->results)) {
                        $out->results[] = $match;
                        //$out->results[] = $row['Business'];
                    }
                }
            }

        } else if (($rsc == 'pickup') || ($rsc == 'dropoff')) {
            $rsc = 'Address';

            $results = mysqli_query($link, "SELECT * from Address where Nickname like '%" . $in['q'] . "%' order by Nickname limit 10");
            while ($row = $results->fetch_assoc()) {
                $match = preg_replace("/(".$in['q'].")/i", "<b>$1</b>", $row['Nickname'] . ' - ' . $row['Address'] . ', ' . $row['City']);
                $out->results[] = $match;
                //$out->results[] = $row['Address'] . ', ' . $row['City'];
            }

            if (count($out->results) < 15) {
                $results = mysqli_query($link, "SELECT * from Address where Address like '" . $in['q'] . "%' or city like '" . $in['q'] . "%' order by Address limit " . (10 - count($out->results)));
                while ($row = $results->fetch_assoc()) {
                    $match = preg_replace("/(".$in['q'].")/i", "<b>$1</b>", $row['Address'] . ', ' . $row['City']);
                    if (!in_array($match, $out->results)) {
                        $out->results[] = $match;
                    }
                }
            }

            if (count($out->results) < 15) {
                $results = mysqli_query($link, "SELECT * from Address where Address like '%" . $in['q'] . "%' or city like '%" . $in['q'] . "%' order by Address limit " . (10 - count($out->results)));
                while ($row = $results->fetch_assoc()) {
                    $match = preg_replace("/(".$in['q'].")/i", "<b>$1</b>", $row['Address'] . ', ' . $row['City']);
                    if (!in_array($match, $out->results)) {
                        $out->results[] = $match;
                    }
                }
            }
        }

        return $out;
    }

    function getBusinessID($link , $str) {
        $results = mysqli_query($link, "SELECT * FROM Business where Business='$str'");
        $row = $results->fetch_assoc();

        if ($row) {
            return $row['BusinessID'];
        }
    }

    function makeReservation($link, $in) {
        $obj = json_decode(urldecode($in['data']));

        if ($obj) {
            $sql = "INSERT INTO Job (Job, BusinessID, ContactName, ContactPhone, ContactEmail, JobDate, PickupTime, DropOffTime, PickupLocation, DropOffLocation)  VALUES (";
            $sql .= quote($obj->customer . ' trip to ' . $obj->dropoff, $link) . ", ";
            $sql .= quote(getBusinessID($link, $obj->customer), $link) . ", ";
            $sql .= quote($obj->cn, $link) . ", ";
            $sql .= quote($obj->cp, $link) . ", ";
            $sql .= quote($obj->ce, $link) . ", ";

            $start = date('H:i:s', strtotime($obj->from));
            $end = date('H:i:s', strtotime($obj->to));
            $date = date('Y-m-d', strtotime($obj->date));

            $sql .= quote($date, $link) . ", ";
            $sql .= quote($start, $link) . ", ";
            $sql .= quote($end, $link) . ", ";
            $sql .= quote($obj->pickup, $link) . ", ";
            $sql .= quote($obj->dropoff, $link) . ")";

            $results = mysqli_query($link, $sql);
            $out = new stdClass();
            $out->sql = $sql;
            $out->status = 'success';
            return $out;
        }


    }
    function quote($str, $link) {
        return "'" . mysqli_real_escape_string($link, $str) . "'";
    }
    function registerCustomer($link, $in) {
        $keys = array("Email","FirstName","LastName","Login","Passwd","Phone");
        $vals = array();

        foreach ($keys as $key) {
            array_push($vals, $in['data']['Login']['new1'][$key]);
        }
        $sql = "INSERT INTO (`" . implode('`,`', $keys)."`) values ('".join("','", $vals)."');";
        $results = mysqli_query($link, $sql);
        $out = new stdClass();
        $out->status = "ok";
        if(!$results){ $out->e = 1; }
        return $out;
    }   
    function doUndo() {
        global $in;
        global $link;
        global $boss;

        $out = new stdClass();
        
        if (isset($in['id'])) {
            $rec = $boss->getObject("History", $in['id']);

            if (isset($rec) && isset($rec->Undo)) {
                
                $results = mysqli_query($link, $rec->Undo);
                
                $out->status = ($results) ? "ok" : "error";
                $out->sql = $rec->Undo;
                $out->error = mysqli_error($link);
            }
        } else {
            $out->status = "error";
            $out->error = "Missing id for History record";
        }
        
        return $out;

    }

    function doRedo() {
        global $in;
        global $link;
        global $boss;

        $out = new stdClass();
        if (isset($in['id'])) {
            $rec = $boss->getObject("History", $in['id']);

            if (isset($rec) && isset($rec->Redo)) {
                
                $results = mysqli_query($link, $rec->Redo);
                
                $out->status = ($results) ? "ok" : "error";
            }
        }
        return $out;

    }

    function getBusinessJobs($link, $in) {

        global $boss;
        $cond = ['NoInvoice=0'];
        if (isset($in['bid'])) {
            $cond[] = "BusinessID='{$in['bid']}'";
        }
        if (isset($in['start'])) {
            $cond[] = "JobDate>'{$in['start']}'";
        }
        if (isset($in['end'])) {
            $cond[] = "JobDate<'{$in['end']}'";
        }
        $sql = implode(" AND ", $cond);

        $obj = $boss->getObjectRelated("Job", implode(" AND ", $cond));
        $out = [];
        foreach ($obj->Job as $k => $v) {
            if ($k != "_ids") {
                $new = new stdClass();
                $new->JobID = $v->JobID;
                $new->Job = $v->Job;
                $new->BusinessID = $v->BusinessID;
                $new->InvoiceID = $v->InvoiceID;
                $new->QuoteAmount = $v->QuoteAmount;
                $new->EmployeeID = $v->EmployeeID;
                $new->JobDate = $v->JobDate;
                $new->ContactName = $v->ContactName;
                $new->ContactPhone = $v->ContactPhone;
                $new->ContactEmail = $v->ContactEmail;
                $new->related_Invoice = $v->related_Invoice;
                $out[] = $new;
            }
        }
        return $out;
    }
    function makePayment($link, $data) {
        global $in;
        global $boss;

        $results = $boss->storeObject($data);
        $payids = array_values($results);
        $payid = $payids[0];

        if (isset($data->Payment->new1->InvoiceIDs)) {
            $ids = preg_split("/\,/", $data->Payment->new1->InvoiceIDs);
            if ($ids) {
                foreach ($ids as $id) {
                    $boss->clampRecord('Payment', $payid, 'Invoice', $id);
                }
            }
        }
        
        if (isset($data->Payment->new1->JobIDs)) {
            $ids = preg_split("/\,/", $data->Payment->new1->JobIDs);
            if ($ids) {
                foreach ($ids as $id) {
                    $boss->clampRecord('Payment', $payid, 'Job', $id);
                }
            }
        }

        if (isset($data->Payment->new1->BusinessID)) {
            $boss->clampRecord('Payment', $payid, 'Business', $data->Payment->new1->BusinessID);
        }

        $out = new stdClass();
        $out->results = $results;
        return $out;
    }
