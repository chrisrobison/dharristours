#!/usr/local/bin/php
<?php
    include('/simple/.env');
    $in = $_REQUEST;
    $out = array();
    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");

    /* check connection */
    if (mysqli_connect_errno()) {
         printf("Connect failed: %s\n", mysqli_connect_error());
         exit();
    }

    $sql = "SELECT * FROM SpecialRates";

    $results = mysqli_query($link, $sql);
    $sizes = array(28, 32, 38, 45, 55);

    if ($results) {
        while ($row = $results->fetch_assoc()) {
            $sql = "";
            foreach ($sizes as $size) {
                // insert into Rates (Rate, FirstFour, Overtime, OneWay, Pax) values ('Parks', 825, 125, 1150, 45);
                $firstfour = $row['Cost'.$size.'FirstFour'] ? $row['Cost'.$size.'FirstFour'] : 0 ;
                $ot = $row['Cost'.$size.'OT'] ? $row['Cost'.$size.'OT'] : 0 ;
                $oneway = $row['Cost'.$size.'OneWay'] ? $row['Cost'.$size.'OneWay'] : 0 ;
                if (!$oneway) {
                    $oneway = "0";
                }
                $sql = "INSERT INTO Rates (Rate, FirstFour, Overtime, OneWay, Pax) VALUES ('{$row['SpecialRates']}', $firstfour, $ot, $oneway, $size);";
                print $sql."\n";
            }
        }
    }
?>
