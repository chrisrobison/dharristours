<?php 
   // require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
   /* START NOAUTH SECTION */
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/boss_class.php");
   session_start();

   $srvName = ($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : "admin.dev.sscsf.com";
   $boss = new boss($srvName);
   $boss->docroot = $_SERVER['DOCUMENT_ROOT'] . '/' . $boss->app->Assets;

   $in = $_REQUEST;
   
   if ($in['z']) {
      $qs = base64_decode($in['z']);

      $parts = explode('&', $qs);
      $cnt = count($parts);

      for ($i=0; $i < $cnt; $i++) {
          list($key, $val) = preg_split("/=/", $parts[$i]);
          $in[urldecode($key)] = urldecode($val);
      }
   }
   /* END NOAUTH SECTION */

   $in['Resource'] = "Job";
//   print_r($in);
   $job = $boss->getObject($in['Resource'], $in['ID']);
   $business = $boss->getObject('Business',$job->BusinessID);
$current = $boss->getObjectRelated($in['Resource'], $in['ID'],false);
$bus = $boss->getObject('Bus',$job->BusID);
$driver = $boss->getObjectRelated('Employee',$current->EmployeeID,false);
//$driver = $boss->getObject('Employee',$job->EmployeeID);
//   print "var data = ".json_encode($job).";\n";
//print_r($job);
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <style type="text/css">
   body { 
      /* background-color: filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f0f0f0', endColorstr='#b0b0b0'); background: -webkit-gradient(linear, left top, left bottom, from(#f0f0f0), to(#b0b0b0)); background: -moz-linear-gradient(top,  #f0f0f0,  #b0b0b0); */
      font-size:20px;color:black;font-family:"Helvetica Neue",Verdana,sans-serif; 
      background-color:#fff;
   }
   IMG { margin:0 0 -4px 0; }
   DIV[class="Part"] { margin:0;text-indent:0; width:100%; position:relative; font-size:1em }
   H1 { text-align:justify; margin:0;text-indent:0px; }
   P { text-align:justify; margin:0 28px 0 0; text-indent:0px; line-height:20px }
   TABLE { border-width:thin; border-collapse:collapse; padding:3px; text-align:left; vertical-align:top; margin:0; width:auto; height:auto; display:table; float:none }
   TR { vertical-align:top; height:auto }
   TH { text-align:left; vertical-align:top }
   TD { text-align:left; vertical-align:bottom }
   :link { color: blue }
   :visited { color: purple }
   :active { color: fushia }
   span.tidy-5 {font-size:1em; color:#000000}
   span.tidy-3 {color:#000000}
   #top_header { height:2em; width:5in; padding:.25em 0;font-size:.9em; position:relative;white-space:nowrap;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;border: 0px solid #000000; margin-top:.25em; }
   #top_header div { float:left; width:2.25in; height:.75in; padding:.006in .05in;}
   #top_header>:first-child { border-right:0px solid #000;}
   #header { width:5in; border-top:0px solid #000; }
   #header td { white-space:nowrap; font-size:.8em; }
   #top_overview { position:absolute;right:.5in;width:2in;height:1.35in;border:solid 1px #000000;text-align:right;padding:.08in .125in; border-radius:5px;-webkit-border-radius:5px;-moz-border-radius:5px;border-bottom:2px solid #000;}
   #top_overview .desc { font-weight:bold; }
   #top_overview span { font-size:1em; }
   #main { background:none repeat scroll 0 0 #FFFFFF; height:11in; margin:1px auto; padding:.5in; position:relative; width:8.5in; border:1px solid #0006;}
   .shadow { -moz-box-shadow:0px -2px 7px rgba(0,0,0,.5);}
   #forprint { margin:.5in; width:8.0in;height:11in; position:relative;}
   #ticket {border:solid 1px #000000;height:6in;width:100%;padding:.125in;position:relative; border-radius:15px;-webkit-border-radius:15px;-moz-border-radius:15px;}
   h2{margin:0px; font-size:1.5em; font-weight:bold;}
   .big {font-size:1.5em;}
   div.date {font-size:1em;font-weight:bold;}
   .center {text-align:center;}
   #sigs { width:100%; border: solid 1px #000000; }
   #sigs th {text-align:center;border:solid 1px #000000;font-weight:normal;font-size:1em;padding:4px;}
   #sigs td {border:solid 1px #000000;padding:4px;}
   #stats {margin-bottom:14px;width:7.5in;position:relative;border:solid 1px #000000;}
   #stats td { border: 1px solid #000000;height:.25in; }
   #stats th { font-weight:bold;text-align:center;border: 1px solid #000000;height:.25in; }
   #return_table {text-align:center; position:relative;width:7.5in;}
   #return_table td { border: 1px solid #000000;height:.25in; }
   #return_table th { font-weight:bold;text-align:center;border: 1px solid #000000;height:.25in; }
   #ticket_table { margin: 0px 1em; }
   #ticket_table, .table { width:100%; }
   #ticket_table td, .table td { padding:2px 5px; vertical-align:top; }
   .nowrap { white-space:nowrap; }
   td.field { text-align:right; }
   .tdheading { text-align:center; font-weight:bold; background-color:#ddd; }
   .table.pu { border:1px solid #ccc; margin-top:.5em; }
   .foot { position:absolute; bottom:1em; font-size:.7em;}
   .table th { text-align:right; font-weight:bold; background-color:#ddd; padding:.25em;}
   .table td { border-bottom:1px solid #ccc; padding:.25em; font-size:.9em;}
   </style>
   <link rel="stylesheet" type="text/css" media="print" href="print.css" />

   <title>Confirmation</title>
</head>
<body>
   <div id="main">
   <div id='top_overview'>
      <span class='date'><?php print date("m/d/Y", strtotime($job->JobDate)); ?></span><br />
      <span class='time'><?php print ($job->PickupTime ? date("h:ia", strtotime($job->PickupTime)) : 'Time NOT SET'); ?></span><br />
      <span class='desc'><?php print substr($business->Business, 0, 25); ?></span><br />
      <span class='pass'>Pax: <?php print $job->NumberOfItems; ?></span><br />
      <span class='pass'>Bus: <?php print (count($bus->Bus) > 1) ? "Unknown" : $bus->Bus; ?></span>
   </div>
   <div id='top_header'>
       <div>Job ID: <?php print $job->JobID; ?><br />Passengers: <?php print $job->NumberOfItems; ?></div>
       <div>Date: <?php print date("m/d/Y", strtotime($job->JobDate)); ?><br />Start: <?php print ($job->PickupTime ? date("h:ia", strtotime($job->PickupTime)) : 'Time NOT SET'); ?></div>
   </div>
   <div class="Part">
      <table id="header" style='clear:left'>
         <tr>
            <td colspan='3'><h2>D HARRIS TOURS Inc.</h2></td>
	 </tr>
	 <tr>
	    <td>juanaharrisdht@att.net</td>
	 </tr>
         <tr>
            <td>415-902-8542</td><td>PO Box 5961</td><td>TCP 017270-B</td>
         </tr>
         <tr>
            <td>800-853-4006 FAX</td><td>Vallejo CA 94591</td><td>CA 273437</td>
         </tr>
      </table>
      <div id='ticket' style='padding:0px;margin-top:1em;'>
         <div style="padding:.25em;background-color:#ddd;border-radius:1em 1em 0 0;">
            <div style='float:right' class="date center"><?php print date("m/d/Y", strtotime($job->JobDate)); ?></div>
            <h2 class='left'><?php ($job->QuoteOnly) ? print "QUOTE"  : print "CONFIRMATION"; ?></h2>
         </div>
         <div style='padding:0px 0px'>
            <div style='padding:.25em 1em'>
               <div class='big'><?php print $job->Job; ?></div>
               <div ><?php print $job->Description; ?></div>
            </div>
            <hr />
            <table id='ticket_table'>
               <tr>
                  <td class='field'>Customer:</td>
                  <td class='value'><?php print $business->Business; ?></td>
                  <td class='field'>Bus:</td>
                  <td class='value'><?php print $bus->Bus; ?></td>
               </tr>
               <tr>
                  <td class='field'></td>
                  <td class='value'><?php print $business->AttnTo; ?><br /><?php print $business->Address1; ?>, <?php print $business->Address2; ?><br /><?php print $business->City; ?>, <?php print $business->State; ?> <?php print $business->Zip; ?></td>
                  <td class='field'>Ph:</td>
                  <td class='nowrap value'><?php print $business->Phone; ?></td>
               </tr>
            </table>
            <table class='table pu'>
               <tr>
                  <th colspan='2' style='text-align:center' class='tdheading'>Pickup</th>
                  <th colspan='2' style='text-align:center' class='tdheading'>Dropoff</th>
               </tr>
               <tr>
                  <th class='field'>Time</th>
                  <td class='value'><?php print ($job->PickupTime ? date("h:ia", strtotime($job->PickupTime)) : 'Time NOT SET'); ?></td>
                  <td class='field' style='border-left:1px solid #ccc;'></td>
                  <td class='value'><?php ($job->RoundTrip) ? print date("h:ia", strtotime($job->DropOffTime)) : print "One Way Xfer"; ?></td>
               </tr>
            </table>
            <table class='table pu'>
               <tr>
                  <th class='field'>Spot: </th>
                  <td class='value' colspan='2'><?php print $job->PickupLocation; ?></td>
               </tr>
               <tr>
                  <th class='field'>1st Stop: </th>
                  <td class='value' colspan='2'><?php print $job->DropOffLocation; ?></td>
               </tr>
               <tr>
                  <th class='field'>2nd Stop: </th>
                  <td class='value' colspan='2'><?php print $job->FinalDropOffLocation; ?></td>
               </tr>
<!--               <tr><td colspan='3'><br /></td></tr>
               <tr>
                  <td class='field'>Pick Up Time:</td>
                  <td class='value'><?php print date("h:ia", strtotime($job->PickupTime)); ?></td>
                  <td class='field'>Drop Off Time:</td>
                  <td class='value'><?php print date("h:ia", strtotime($job->DropOffTime)); ?></td>
               </tr>
               <tr>
                  <td class='field'>P/U Location:</td>
                  <td colspan='3' class='value'><?php print $job->PickupLocation; ?></td>
               </tr>
               <tr>
                  <td class='field'>D/O Location:</td>
                  <td colspan='3' class='value'><?php print $job->DropOffLocation; ?></td>
               </tr>
      -->
               <tr><td colspan="4"></td></tr>
               <tr>
                  <td class='field'>Total Hours:</td>
                  <td class='value' colspan='3'><?php print $job->Hours; ?><span style="float:right;"><?php if (is_array($driver->Employee)) { print ""; } else { print "Driver: ";  print $driver->Employee; print  " "; print $driver->Phone; }; ?></span></td>
               </tr>
               <tr>
                  <td class='field'>Amount:</td>
                  <td class='value' colspan='3'>$<?php print sprintf("%.02f", $job->QuoteAmount); ?><br /><br /></td>
               </tr>
            </table>
         </div>
      </div>
   <table id='sigs' style='margin-top:1em'>
      <tr>
         <th>Customer Name</th>
         <th>Customer Signature</th>
      </tr>
      <tr>
         <td><br /></td>
         <td><br /></td>
      </tr>
   </table>
   <table id='sigs' style='margin-top:1em'>
      <tr>
         <td style="font-size:.8rem;">Cancellation Policy: a charge of $400 if service not cancelled 72 hours prior to spot time. Full charge for on the spot cancellation. No charge for cancellation due to weather if notified by 4pm the day prior to the trip.  Thank you for your business!</tr>
      </tr>

   </table>
   
   </div>
   </div>
</body>
</html>
