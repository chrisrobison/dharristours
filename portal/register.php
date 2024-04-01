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

    $sql = "SELECT * FROM Login WHERE Email='". $in['data']['Login']['new1']['Email']."'";
    $results = mysqli_query($link, $sql);
    
    if ($results && mysqli_num_rows($results)) {
        
        $rec = mysqli_fetch_assoc($results);
        print "<p>Login already exists. <a href='/login.php?url=/portal/'>Login here</a> or use a different email address.</p>";
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


        $sql = "INSERT INTO Login (`" . implode('`,`', $keys)."`) values ('".join("','", $vals)."');";
        $results = mysqli_query($link, $sql);
        
        if (!$results){
            $out->status = "error";
            $out->error = mysqli_error($link);
        }

        $new = new stdClass();
        $new->Business = $in['data']['Login']['new1']['Business'];
        $new->Individual = 1;
        $new->Contact = $in['data']['Login']['new1']['LastName'].', '.$in['data']['Login']['new1']['FirstName'];
        $new->Phone = $in['data']['Login']['new1']['Phone'];
        $new->Email = $in['data']['Login']['new1']['Email'];
        $obj = new stdClass();
        $obj->Business = ['new1'=>$new];

        $business_ids = $boss->storeObject($obj);

        $new = new stdClass();
        $new->FirstName = $in['data']['Login']['new1']['FirstName'];
        $new->LastName = $in['data']['Login']['new1']['LastName'];
        $new->Phone = $in['data']['Login']['new1']['Phone'];
        $new->Email = $in['data']['Login']['new1']['Email'];

        $obj = new stdClass();
        $obj->Person = ['new1'=>$new];

        $person_ids = $boss->storeObject($obj);
        
        if (isset($business_ids[0]) && isset($person_ids[0])) {

        }
        $out->status = 'ok';

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
?>
