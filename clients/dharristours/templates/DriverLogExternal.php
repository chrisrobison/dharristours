<?php 
   // require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
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
   
   $in['Resource'] = "Job";
//   print_r($in);
   $job = $boss->getObject($in['Resource'], $in['ID']);
   $business = $boss->getObject('Business',$job->BusinessID);
   $bus = $boss->getObject('Bus',$job->BusID);
   $driver = $boss->getObject('Employee',$job->EmployeeID);
//   print "var data = ".json_encode($current).";\n";
//print_r($current);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <style type="text/css">
/*<![CDATA[*/
   body { background-color: filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f0f0f0', endColorstr='#b0b0b0'); background: -webkit-gradient(linear, left top, left bottom, from(#f0f0f0), to(#b0b0b0)); background: -moz-linear-gradient(top,  #f0f0f0,  #b0b0b0);font-size:20px;color:black;font-family:"Helvetica Neue",Verdana,sans-serif; }
   IMG { margin:0 0 -4px 0; }
   DIV[class="Part"] { margin:0;text-indent:0; font-size:1em }
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
   #top_header div { float:left;width:2.25in;height:.75in;padding:.006in .05in;}
   #top_header>:first-child { border-right:0px solid #000;}
   #header { width:5in; border-top:0px solid #000; }
   #header td { white-space:nowrap; font-size:.8em; }
   #top_overview { position:absolute;right:.5in;width:2in;height:1.35in;border:solid 1px #000000;text-align:right;padding:.08in .125in; border-radius:5px;-webkit-border-radius:5px;-moz-border-radius:5px;border-bottom:2px solid #000;}
   #top_overview .desc { font-weight:bold; }
   #top_overview span { font-size:1em; }
   #main { background:none repeat scroll 0 0 #FFFFFF; height:10in; margin:1px auto; padding:.5in; position:relative; width:7.5in; }
   .shadow { -moz-box-shadow:0px -2px 7px rgba(0,0,0,.5);}
   #forprint { margin:.5in; width:8.0in;height:11in; position:relative;}
   #ticket {border:solid 1px #000000;height:7in;width:7.5in;padding:.125in;position:relative; border-radius:15px;-webkit-border-radius:15px;-moz-border-radius:15px;}
   h2{margin:0px; font-size:1.5em; font-weight:bold;}
   .big {font-size:1.5em;}
   div.date {font-size:1.5em;font-weight:bold;}
   .center {text-align:center;}
   #sigs { width:7.5in; border: solid 1px #000000; }
   #sigs th {text-align:center;border:solid 1px #000000;font-weight:normal;font-size:1em;padding:4px;}
   #sigs td {border:solid 1px #000000;padding:4px;}
   #stats {margin-bottom:14px;width:7.5in;position:relative;border:solid 1px #000000;}
   #stats td { border: 1px solid #000000;height:.25in; }
   #stats th { font-weight:bold;text-align:center;border: 1px solid #000000;height:.25in; }
   #return_table {text-align:center; position:relative;width:7.5in;}
   #return_table td { border: 1px solid #000000;height:.25in; }
   #return_table th { font-weight:bold;text-align:center;border: 1px solid #000000;height:.25in; }
   #ticket_table { margin: 0px 1em; }
   #ticket_table, .table { width:7.5in; }
   #ticket_table td, .table td { padding:2px 5px; vertical-align:top; }
   .nowrap { white-space:nowrap; }
   td.field { text-align:right; }
   .tdheading { text-align:center; font-weight:bold; background-color:#ddd; }
   .table.pu { border:1px solid #ccc; margin-top:.5em; }
   .foot { position:absolute; bottom:1em; font-size:.7em; }
   .table th { text-align:right; font-weight:bold; background-color:#ddd; padding:.25em; }
   .table td { border-bottom:1px solid #ccc; padding:.25em; font-size:.9em; }
   /*]]>*/
   </style>
   <link rel="stylesheet" type="text/css" media="print" href="print.css" />

   <title>Driver Log Sheet</title>
</head>
<body>
   <div id="main" class='shadow'>
   <div id='top_overview'>
      <span class='date'><?php print date("m/d/Y", strtotime($job->JobDate)); ?></span><br />
      <span class='time'><?php print date("h:ia", strtotime($job->PickupTime)); ?></span><br />
      <span class='pass'>Pax: <?php print $job->NumberOfItems; ?></span><br />
      <span class='pass'>Bus: <?php print $bus->Bus; ?></span>
   </div>
    <div id='top_header'>
       <div>Driver Name: <b><?php print $driver->Employee; ?></b><br />Job Number: <b> <?php print $job->JobID; ?></b></div>
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
      <div id='ticket'style='padding:0px;margin-top:1em;' >
         <div style="padding:.25em;background-color:#ddd;border-radius:1em 1em 0 0;">
            <div style='float:right' class="date center"><?php print date("m/d/Y", strtotime($job->JobDate)); ?></div>
            <h2 class='left'>DRIVER TRIP</h2>
         </div>
         <div style='padding:0px 0px;'>
            <div style='padding:.25em 1em'>
            <div>Job Number: <?php print $job->JobID; ?></div>
            <div >Hours: <?php print $job->Hours; ?></div>
         </div>
         <hr />
         <table class='table pu'>
            <tr>
               <td colspan='2' class='tdheading'>Requested</td>
               <td colspan='2' class='tdheading'>Actual Time</td>
               <td colspan='2' class='tdheading'>Mileage</td>
            </tr>
            <tr>
               <th class='field'>Departure Time:</th>
               <td class='value'><?php print date("h:ia", strtotime($job->PickupTime)); ?></td>
               <td class='field' style='border-left:1px solid #ccc;'></td>
               <td class='value'></td>
               <td class='field' style='border-left:1px solid #ccc;'></td>
               <td class='value'></td>
            </tr>
            <tr>
               <th class='field'>Spot:</th>
               <td class='value'><?php print $job->PickupLocation; ?></td>
               <td class='field' style='border-left:1px solid #ccc;'></td>
               <td class='value'></td>
               <td class='field' style='border-left:1px solid #ccc;'></td>
               <td class='value'></td>
            </tr>
            <tr>
               <th class='field'>1st Stop:</th>
               <td class='value'><?php print $job->DropOffLocation; ?></td>
               <td class='field' style='border-left:1px solid #ccc;'></td>
               <td class='value'></td>
               <td class='field' style='border-left:1px solid #ccc;'></td>
               <td class='value'></td>
            </tr>
            <tr>
               <th class='field'>2nd Stop:</th>
               <td class='value'><?php print $job->FinalDropOffLocation; ?></td>
               <td class='field' style='border-left:1px solid #ccc;'></td>
               <td class='field'></td>
               <td class='field' style='border-left:1px solid #ccc;'></td>
               <td class='value'></td>
            </tr>
            <tr>
               <th class='field'>End Time:</th>
               <td class='value'><?php print date("h:ia", strtotime($job->DropOffTime)); ?></td>
               <td class='field' style='border-left:1px solid #ccc;'></td>
               <td class='value'></td>
               <td class='field' style='border-left:1px solid #ccc;'></td>
               <td class='value'></td>
            </tr>
            <tr>
               <td class='field'>Instructions:</td>
               <td class='value' colspan='5'><?php print $job->SpecialInstructions; ?><br /><br /></td>
            </tr>
         </table>
      </div>
   <table id="sigs">
      <tr>
         <th>Yard Departure Time</th>
         <th>Starting Mileage</th>
         <th>Yard Return Time</th>
         <th>Ending Mileage</th>
         <th>Total Hours Worked</th>
      </tr>
      <tr>
         <td><br /><br /></td>
         <td><br /><br /></td>
         <td><br /><br /></td>
         <td><br /><br /></td>
         <td><br /><br /></td>
      </tr>
   </table>
   <br />
   <table id='sigs'>
      <tr>
         <th class='tdheading'>Customer Name</th>
         <th class='tdheading'>Customer Signature</th>
         <th class='tdheading'>Date</th>
      </tr>
      <tr>
         <td><br /><br /></td>
         <td><br /><br /></td>
         <td><br /><br /></td>
   </table>
   </div>
   </div>
</body>
</html>
