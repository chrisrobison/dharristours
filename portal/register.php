<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/.env');

    $in = $_REQUEST;
    $out = array();
    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");
    
    //session_start();

    /* check connection */
    if (mysqli_connect_errno()) {
         printf("Connect failed: %s\n", mysqli_connect_error());
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

        file_put_contents("/tmp/calapi.log", date("Y-m-d H:i:s") . ":" . $in['type'] . ": " . json_encode($in) . " : " .json_encode($out)."\n", FILE_APPEND);
        
        header("Content-type: application/json; charset=utf-8");
        print json_encode($out);
    }

    function registerCustomer($link, $in) {
        $out = new stdClass();
        $out->status = "ok";


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

        array_push($keys, 'Login');
        array_push($vals, mysqli_real_escape_string($link, $in['data']['Login']['new1']['Email']));
        array_push($keys, 'InitialProcess');
        array_push($vals, 216);
        array_push($keys, 'Access');
        array_push($vals, 8);
        array_push($keys, 'ProcessAccess');
        array_push($vals, 1);


        $sql = "INSERT INTO Login (`" . implode('`,`', $keys)."`) values ('".join("','", $vals)."');";
        $results = mysqli_query($link, $sql);
        if(!$results){
            $out->status = "error";
            $out->e = mysqli_error($link);

        }
        return $out;
    }

    function isValidEmail($link, $in) {
        $email = mysqli_real_escape_string($link, $in['Login']['new1']['Email']);

        if($email == ''){
            print 'false';
            exit();
        }

        $sql = "SELECT * FROM Login WHERE Email = '" . $email . "';";
        $results = mysqli_query($link, $sql);

        if(!$results){
            print 'false';
            exit();
        }

        if(mysqli_num_rows($results) > 0) print 'false';
        else print 'true';

        exit();
    }

    function quote($str, $link) {
        return "'" . mysqli_real_escape_string($link, $str) . "'";
    }
?>
