<?php
    $env = "prod";  // Change this to 'prod' for production environment or 'dev' from dev env
    
    $conf['dev'] = array("root"=>"/simple.dev", 
                        "host"=>"dharristours.dev.sscsf.com",
                        "db"=>"SS_DHarrisTours");

    $conf['prod'] = array("root"=>"/simple",
                         "host"=>"dharristours.simpsf.com",
                         "db"=>"SS_DHarrisTours");
    
    require($conf[$env]["root"] . "/lib/boss_class.php");
    
    $in = $_REQUEST;
    $boss = new boss("dharristours.simpsf.com");
    
    $records = $boss->get("Request", $in['id']);
    $cnt = count($records);

    for ($i=0; $i<$cnt; $i++) {
      $obj = $records[$i];

      if ($obj->BusinessID) {
         $bus = $boss->get("Business", $obj->BusinessID);
         $obj->Business = $bus[0]->Business;
      }
     
    $oneway = ($obj->RoundTrip == 1) ? "display:none;" : "";
   
    $obj->QuoteTable = '<tr><th style="text-align:center;">Bus #</th><th>Bus Size</th><th style="'.$oneway.'">One Way</th><th>Overtime/hr</th><th>1<sup>st</sup> 4 hours</th></tr>';
      if ($obj->RatesIDs) {
        $total = 0;
        $totpax = 0;
        $totot = 0;
        $totow = 0;
        $rids = preg_split("/\,/", $obj->RatesIDs);
        foreach ($rids as $idx=>$rid) {
            $rate = $boss->getObject("Rates", $rid);
// <th>Bus #</th><th>Bus Size</th><th>1st 4hr</th><th>Overtime/hr</th><th>One Way</th>
            $obj->QuoteTable .= "<tr><td style='text-align:center;background:#fff;border-bottom:1px solid #ccc;border-right:1px solid #ccc;'>".($idx + 1)."</td><td style='text-align:center;background:#fff;border-bottom:1px solid #ccc;border-right:1px solid #ccc;'>".$rate->Pax." Passengers</td><td style='text-align:center;background:#fff;border-bottom:1px solid #ccc;border-right:1px solid #ccc;{$oneway}'>$".$rate->OneWay."</td><td style='text-align:center;background:#fff;border-bottom:1px solid #ccc;border-right:1px solid #ccc;'>$".$rate->Overtime."</td><td style='text-align:center;background:#fff;border-bottom:1px solid #ccc;border-right:1px solid #ccc;'>$".$rate->FirstFour."</td></tr>";
            $totpax += $rate->Pax;
            $totot += $rate->Overtime;
            $total += $rate->FirstFour;
            $totow += $rate->OneWay;
        }
        $obj->QuoteTable .= "<tr><td style='text-align:center;background:#fff;color:#000;border-top:2px solid #000;border-bottom:1px solid #ccc;border-right:1px solid #ccc;'>Total</td><td style='border-top:2px solid #000;text-align:center;background:#fff;border-bottom:1px solid #ccc;border-right:1px solid #ccc;'>".$totpax." Capacity</td><td style='border-top:2px solid #000;text-align:center;background:#fff;border-bottom:1px solid #ccc;border-right:1px solid #ccc;{$oneway}'>$".$totow."</td><td style='border-top:2px solid #000;text-align:center;background:#fff;border-bottom:1px solid #ccc;border-right:1px solid #ccc;'>$".$totot."/hr</td><td style='border-top:2px solid #000;text-align:center;background:#fff;border-bottom:1px solid #ccc;border-right:1px solid #ccc;'>$".$total."</td></tr>";
    $obj->OvertimeTotal = $totot;
    }
    $dh = ($obj->DriverHours - 4);
    $obj->HoursEstimate = $dh + 4;
    $obj->DriverHoursTotal = $dh * $totot;
     $tpl = "quote.html";

     if (array_key_exists('t', $in)) {
          $tpl = $in['t'];
     } 
     if (isset($argv)) {
          $exe = array_shift($argv);

          if (count($argv)) {
                $tpl = array_shift($argv);
          }
     }

     $msg = file_get_contents($tpl);
     $obj->zquery = base64_encode("id=".$obj->RequestID);

     
     $msg = preg_replace_callback("/\{\{([^\}]+)\}\}/", function ($matches) use ($obj) {
          if (($matches[1] == "Start") || ($matches[1] == "End")) {
                $obj->{$matches[1]} = date("H:ia", strtotime($obj->{$matches[1]}));
          }

          if (($matches[1] == "Pickup") || ($matches[1] == "Destination")) {
                $obj->{"Split" . $matches[1]} = preg_replace("/\|/", "<br>\n", $obj->{$matches[1]});
          }
          
          if ($match = preg_match("/(RoundTrip|ADA|Shuttle|Text)/", $matches[1])) {
                if ($obj->{$matches[1]}) {
                     $obj->{$matches[1]} = "Yes";
                } else {
                     $obj->{$matches[1]} = "No";
                }
          }
          if ($matches[1] == "Date") {
               $obj->{$matches[1]} = date("m/d/Y", strtotime($obj->{$matches[1]}));
          }
          return (string)$obj->{$matches[1]};
     }, $msg);

     print $msg;
}
?>
