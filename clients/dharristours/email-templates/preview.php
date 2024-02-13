<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Email Preview</title>
    <style>
        body { 
            background-color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;

        }
    </style>
</head>
<body>
<?php
    $env = "prod";  // Change this to 'prod' for production environment or 'dev' from dev env
    
    $conf['dev'] = array("root"=>"/simple.dev", 
                        "host"=>"dharristours.dev.sscsf.com",
                        "db"=>"SS_DHarrisTours");

    $conf['prod'] = array("root"=>"/simple",
                         "host"=>"dharristours.simpsf.com",
                         "db"=>"SS_DHarrisTours");
    
    require("/simple/lib/boss_class.php");
    
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
    $oneway = ($obj->RoundTrip) ? "display:none;" : "";
    
    $obj->QuoteTable = '<tr><th style="text-align:center;">Bus #</th><th>Bus Size</th><th style="'.$oneway.'">One Way</th><th>Overtime/hr</th><th>1<sup>st</sup> 4 hours</th></tr>';
      if ($obj->RatesIDs) {
        $total = 0;
        $totpax = 0;
        $totot = 0;
        $totow = 0;
        $rids = preg_split("/\,/", $obj->RatesIDs);
        $buscnt = 0;
        foreach ($rids as $idx=>$rid) {
            $rate = $boss->getObject("Rates", $rid);
            if ($rate->RatesID) {
                $buscnt++;
    // <th>Bus #</th><th>Bus Size</th><th>1st 4hr</th><th>Overtime/hr</th><th>One Way</th>
                $obj->QuoteTable .= "<tr><td style='text-align:center;background:#fff;border-bottom:1px solid #ccc;border-right:1px solid #ccc;'>".($buscnt)."</td><td style='text-align:center;background:#fff;border-bottom:1px solid #ccc;border-right:1px solid #ccc;'>".$rate->Pax." Passengers</td><td style='text-align:center;background:#fff;border-bottom:1px solid #ccc;border-right:1px solid #ccc;{$oneway}'>$".$rate->OneWay."</td><td style='text-align:center;background:#fff;border-bottom:1px solid #ccc;border-right:1px solid #ccc;'>$".$rate->Overtime."</td><td style='text-align:center;background:#fff;border-bottom:1px solid #ccc;border-right:1px solid #ccc;'>$".$rate->FirstFour."</td></tr>";
                $totpax += $rate->Pax;
                $totot += $rate->Overtime;
                $total += $rate->FirstFour;
                $totow += $rate->OneWay;
            }
        }
        $obj->QuoteTable .= "<tr><td style='text-align:center;background:#fff;color:#000;border-top:2px solid #000;border-bottom:1px solid #ccc;border-right:1px solid #ccc;'>Total</td><td style='border-top:2px solid #000;text-align:center;background:#fff;border-bottom:1px solid #ccc;border-right:1px solid #ccc;'>".$totpax." Capacity</td><td style='border-top:2px solid #000;text-align:center;background:#fff;border-bottom:1px solid #ccc;border-right:1px solid #ccc;{$oneway}'>$".$totow."</td><td style='border-top:2px solid #000;text-align:center;background:#fff;border-bottom:1px solid #ccc;border-right:1px solid #ccc;'>$".preg_replace("/(\d)(?=(\d{3})+$)/", "$1,",$totot)."/hr</td><td style='border-top:2px solid #000;text-align:center;background:#fff;border-bottom:1px solid #ccc;border-right:1px solid #ccc;'>$".preg_replace("/(\d)(?=(\d{3})+$)/", "$1,",$total)."</td></tr>";
        $obj->OvertimeTotal = $totot;
    
    }
    $dh = (($obj->DriverHours - 4) > 0) ? $obj->DriverHours - 4 : 0;
    
    $obj->DriverHoursTotal = $dh * $totot;
    $obj->HoursEstimate = $dh + 4 . "hrs";
    $obj->DriverHours = $dh;
    $obj->OvertimeBreakdown  = "";

    if ($dh >  0) {
        $obj->OvertimeBreakdown = '<label style="display:inline-block;width:8rem;">Overtime: </label><span style="display:inline-block;width:10rem;">'.$dh . 'hrs OT x $'.$totot.'=$'.$obj->DriverHoursTotal.'</span><br>';

    }
    $obj->QuoteTotal = preg_replace("/(\d)(?=(\d{3})+$)/", "$1,", $obj->QuoteTotal);
    /* $obj = new stdClass();

     $obj->Business = "ABC School District";
     $obj->Name = "Jane Customer";
     $obj->Email = "jcustomer@example.com";
     $obj->Phone = "(415) 555-1212";
     $obj->Pax = "32";
     $obj->Date = "06/15/2023";
     $obj->Start = "09:00:00";
     $obj->End = "12:00:00";
     $obj->Pickup = "El Dorado Elementary|70 Delta Street|San Francisco, CA 94134";
     $obj->Destination = "Six Flags Discovery Kingdom|1001 Fairgrounds Dr|Vallejo, CA 94589";
     $obj->RoundTrip = 1;
     $obj->ADA = 1;
     $obj->Shuttle = 1;
     $obj->Text = 1;
     $obj->RequestID = 1234;
     $obj->Price = "1200.00";
     */
     if (array_key_exists('tpl', $in)) {
        $tpl = $in['tpl'];
     } else {
        $tpl = "quote.html";
     }

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
?>
<table style="width:40rem;margin:0 auto;background:#ddd;border: 2px solid #bbb;padding:1rem 0 1rem 1rem;">
<tr><td style="">Date: </td><td style="padding:0.25rem;background:#fff;border-right:1px solid #333;"><?php print date("r"); ?></td></tr>
<tr><td style="">To:</td><td style="padding:0.25rem;background:#fff;border-right:1px solid #333;"><?php print $obj->Name . ' &lt;'.$obj->Email.'&gt;'; ?></td></tr>
<tr><td style="">From:</td><td style="padding:0.25rem;background:#fff;border-right:1px solid #333;">D Harris Tours &lt;noreply@dharristours.com&gt;</td></tr>
<tr><td style="">Subject:</td><td style="padding:0.25rem;background:#fff;border-right:1px solid #333;">Quote for trip on <?php print $obj->Date;  ?></td></tr>
</table>
<?php
     print $msg;
}
?>
</body>
</html>
