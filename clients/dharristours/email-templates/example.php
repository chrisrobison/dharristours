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
    $boss = new boss($conf[$env]["host"]);
    
    $records = $boss->get("Request", $in['id']);
    $cnt = count($records);

    for ($i=0; $i<$cnt; $i++) {
      $obj = $records[$i];

      if ($obj->BusinessID) {
         $bus = $boss->get("Business", $obj->BusinessID);
         $obj->Business = $bus[0]->Business;
      }

      if ($obj->RateID) {
         $bus = $boss->get("Rate", $obj->RateID);
         $obj->Rate = $bus[0]->Rate;
         $rates = $boss->getObject("Rates", "RateID={$obj->RateID}");
         print_r($rates);
      }

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
