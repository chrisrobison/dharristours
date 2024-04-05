<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/.env');
    include($_SERVER['DOCUMENT_ROOT'] . '/lib/boss_class.php');

    $in = $_REQUEST;
    $out = array();
    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");
    $boss = new boss("dharristours.simpsf.com");

    //session_start();

    /* check connection */
    if (mysqli_connect_errno()) {
         printf("Connect failed: %s\n", mysqli_connect_error());
         exit();
    }

    // First, check if email already exists in Login table
    $sql = "SELECT * FROM Login WHERE Email='". $in['data']['Login']['new1']['Email']."'";
    $results = mysqli_query($link, $sql);
    
    // Exit with message if exists
    if ($results && mysqli_num_rows($results)) {
        $rec = mysqli_fetch_assoc($results);
        header("Content-Type: application/json");
        $out = new stdClass();
        $out->status = "error";
        $out->msg = "<p>Login already exists. <a href='/login.php?url=/portal/'>Login here</a> or use a different email address.</p>";

        print json_encode($out);

        exit();
    }

    if ($in['type']) {
        switch($in['type']) {
            case "register":
                $out = registerCustomer($link, $in);
                break;
            case "checkEmail":
                $out = isValidEmail($link, $in);
                break;


        }

        file_put_contents("/simple/log/register.log", date("Y-m-d H:i:s") . ":" . $in['type'] . ": " . json_encode($in) . " : " .json_encode($out)."\n", FILE_APPEND);
        
        header("Content-type: application/json; charset=utf-8");
        print json_encode($out);
    }

    function registerCustomer($link, $in) {
        global $boss;
        $out = new stdClass();
        $out->status = "ok";
        
        $info = $in['data']['Login']['new1'];
       
        $new = new stdClass();
        $new->Business = $info['Business'];
        $new->Individual = 1;
        $new->Contact = $info['LastName'].', '.$info['FirstName'];
        $new->Phone = $info['Phone'];
        $new->Email = $info['Email'];
        $obj = new stdClass();
        $obj->Business = ['new1'=>$new];

        $business_ids = $boss->storeObject($obj);

        $new = new stdClass();
        $new->FirstName = $info['FirstName'];
        $new->LastName = $info['LastName'];
        $new->Phone = $info['Phone'];
        $new->Email = $info['Email'];

        $obj = new stdClass();
        $obj->Person = ['new1'=>$new];

        $person_ids = $boss->storeObject($obj);
        
        if (isset($person_ids)) {
            $p = array_values($person_ids);
            $person_id = $p[0];
            $out->PersonID = $person_id;
        }
        
        if (isset($business_ids)) {
            $b = array_values($business_ids);
            $business_id = $b[0];
            $out->BusinessID = $business_id;
        }
        $shortlogin = mysqli_real_escape_string($link, preg_replace("/\@.*/", '', $in['data']['Login']['new1']['Email']));

        $keys = array("Email","FirstName","LastName","Passwd","Phone");
        $vals = array();

        foreach ($keys as $key) {
            $val = $in['data']['Login']['new1'][$key];
            if($key == "Passwd") {
                $val = sha1($val);
            }else{
                $val = mysqli_real_escape_string($link, $val);
            }
            array_push($vals, $val);
        }
        array_push($keys, "Login");
        array_push($vals, $shortlogin);
        array_push($keys, 'InitialProcess');
        array_push($vals, 216);
        array_push($keys, 'Access');
        array_push($vals, 8);
        array_push($keys, 'ProcessAccess');
        array_push($vals, 1);
        array_push($keys, "BusinessID");
        array_push($vals, $business_id);
        array_push($keys, "BusinessIDs");
        array_push($vals, $business_id);
        array_push($keys, "PersonID");
        array_push($vals, $person_id);
        array_push($keys, "StartURL");
        array_push($vals, "/portal/");

        $sql = "INSERT INTO Login (`" . implode('`,`', $keys)."`) values ('".join("','", $vals)."');";
        $results = mysqli_query($link, $sql);
        
        if (!$results){
            $out->status = "error";
            $out->error = mysqli_error($link);
        }
        
       
        $out->status = 'ok';
        $out->LoginID = mysqli_insert_id($link);
        
        $boss->clampRecord("Login", $out->LoginID, "Person", $out->PersonID, true, "default", 0);
        
        if (isset($out->BusinessID)) {
            $boss->clampRecord("Login", $out->LoginID, "Business", $out->BusinessID, true, "default", 0);
            if (isset($out->PersonID)) {
                $boss->clampRecord("Person", $out->PersonID, "Business", $out->BusinessID, true, "default", 0);
                mysqli_query($link, "UPDATE Business set LoginID='{$out->LoginID}' WHERE BusinessID='{$out->BusinessID}'");
            }
        }

        $out->results = [];
        $out->results["Login"] = $boss->getObjectRelated("Login", $out->LoginID);
        $out->results["Business"] = $boss->getObjectRelated("Business", $out->BusinessID);
        $out->results["Person"] = $boss->getObjectRelated("Person", $out->PersonID);

        return $out;
    }

    function isValidEmail($link, $in) {
        $email = mysqli_real_escape_string($link, $in['Login']['new1']['Email']);

        if($email == ''){
            return false;
        }

        $sql = "SELECT * FROM Login WHERE Email = '" . $email . "';";
        $results = mysqli_query($link, $sql);
        $out = false;
        if(!$results){
            $out = false;
        } 

        if(mysqli_num_rows($results) > 0) print 'false';
        else $out = true;

        return $out;
    }

    function quote($str, $link) {
        return "'" . mysqli_real_escape_string($link, $str) . "'";
    }
