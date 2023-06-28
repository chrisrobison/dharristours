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

        }

        file_put_contents("/tmp/calapi.log", date("Y-m-d H:i:s") . ":" . $in['type'] . ": " . json_encode($in) . " : " .json_encode($out)."\n", FILE_APPEND);
        
        header("Content-type: application/json; charset=utf-8");
        print json_encode($out);
    }

    function registerCustomer($link, $in) {
        $keys = array("Email","FirstName","LastName","Login","Passwd","Phone");
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
        $sql = "INSERT INTO Login (`" . implode('`,`', $keys)."`) values ('".join("','", $vals)."');";
        $results = mysqli_query($link, $sql);
        $out = new stdClass();
        $out->status = "ok";
        if(!$results){ $out->e = mysqli_error($link); }
        return $out;
    }

    function quote($str, $link) {
        return "'" . mysqli_real_escape_string($link, $str) . "'";
    }
?>
