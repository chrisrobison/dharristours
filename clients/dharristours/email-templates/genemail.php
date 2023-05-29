<?php
    $env = "prod";  // Change this to 'prod' for production environment or 'dev' from dev env
    
    $conf['dev'] = array("root"=>"/simple.dev", 
                        "host"=>"dharristours.dev.sscsf.com",
                        "db"=>"SS_DHarrisTours");

    $conf['prod'] = array("root"=>"/simple",
                         "host"=>"dharristours.simpsf.com",
                         "db"=>"SS_DHarrisTours");
    
    require($conf[$env]["root"] . "/lib/boss_class.php");

    $boss = new boss($conf[$env]["host"]);
    $in = $_REQUEST;
    
    $records = $boss->get("DailyJobMail");
    $idx = 0;
    if (array_key_exists('idx', $in)) {
        $idx = $in['idx'];
    }
    // for ($i=0; $i<$cnt; $i++) {
        $obj = $records[$idx];
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

     $tpl = "notify.html";

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
     if ((!$obj->ContactName) && (preg_match("/\(([^\)]+)\)/", $obj->Business, $matches))) {
        $obj->ContactName = $matches[1];
        $obj->Business = preg_replace("/\(.*/", "", $obj->Business);
     }
     $msg = preg_replace_callback("/\{\{([^\}]+)\}\}/", function ($matches) use ($obj) {
        if ($matches[1] == "JobDate") {
            $now = strtotime($obj->{$matches[1]});
            $obj->JobDate = date("m/d/Y", $now);
        }
          if (($matches[1] == "PickupTime") || ($matches[1] == "DropOffTime")) {
                $obj->{$matches[1]} = date("g:ia", strtotime($obj->{$matches[1]}));
          }

          if (($matches[1] == "PickupLocation") || ($matches[1] == "DropOffLocation")) {
            if ((!$obj->ContactPhone) && ($matches[1] == "PickupLocation") && (preg_match("/\\(?(\d{3})[\)\-\.]\s*(\d{3})[\.\-](\d{4})/", $obj->PickupLocation, $m))) {
                $obj->ContactPhone = "(".$m[1].") ".$m[2]."-".$m[3]; 
            }
            $parts = preg_split("/\,/", $obj->{$matches[1]}, 2);
            $obj->{"Split" . $matches[1]} = implode("<br>\n", $parts);
            //$obj->{"Split" . $matches[1]} = preg_replace("/\,/", "<br>\n", $obj->{$matches[1]});
          }
          
          if ($match = preg_match("/(SPAB|WheelChair|RoundTrip|ADA|Shuttle|Text)/", $matches[1])) {
                if ($obj->{$matches[1]}) {
                     $obj->{$matches[1]} = "Yes";
                } else {
                     $obj->{$matches[1]} = "No";
                }
          }
          return (string)$obj->{$matches[1]};
     }, $msg);

     $msgs[] = $msg;
//}

print $msg;
?>
