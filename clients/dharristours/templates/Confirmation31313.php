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
   $bus = $boss->getObject('Bus',$job->BusID);
   $driver = $boss->getObject('Employee',$job->EmployeeID);
//   print "var data = ".json_encode($job).";\n";
//print_r($job);
?>
<!DOCTYPE html>
<html>
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
   #top_header { width:5in; height:.5in;position:relative;white-space:nowrap;border-radius:12px;-webkit-border-radius:12px;-moz-border-radius:12px;border: 4px solid #000000; }
   #top_header div { float:left;width:2.25in;height:.5in;padding:.006in .05in;}
   #top_header>:first-child { border-right:4px solid #000;}
   #header { width:5in;height:.6in; }
   #header td { white-space:nowrap; }
   #top_overview { position:absolute;right:.5in;width:2in;height:1.35in;border:solid 1px #000000;text-align:right;padding:.08in .125in; border-radius:5px;-webkit-border-radius:5px;-moz-border-radius:5px;}
   #top_overview .desc { font-weight:bold; }
   #top_overview span { font-size:1em; }
   #main { background:none repeat scroll 0 0 #FFFFFF; height:10in; margin:1px auto; padding:.5in; position:relative; width:7.5in; }
   .shadow { -moz-box-shadow:0px -2px 7px rgba(0,0,0,.5);}
   #forprint { margin:.5in; width:8.0in;height:11in; position:relative;}
   #ticket {border:solid 1px #000000;height:7in;width:7.0in;padding:.125in;position:relative; border-radius:15px;-webkit-border-radius:15px;-moz-border-radius:15px;}
   h2{margin:0px; font-size:1.3em; font-weight:bold;}
   .big {font-size:1.5em;}
   div.date {font-size:1em;font-weight:bold;}
   .center {text-align:center;}
   #sigs { width:7.5in; border: solid 1px #000000; }
   #sigs th {text-align:center;border:solid 1px #000000;font-weight:bold;font-size:1.1em;padding:4px;}
   #sigs td {border:solid 1px #000000;padding:4px;}
   #stats {margin-bottom:14px;width:7.5in;position:relative;border:solid 1px #000000;}
   #stats td { border: 1px solid #000000;height:.25in; }
   #stats th { font-weight:bold;text-align:center;border: 1px solid #000000;height:.25in; }
   #return_table {text-align:center; position:relative;width:7.5in;}
   #return_table td { border: 1px solid #000000;height:.25in; }
   #return_table th { font-weight:bold;text-align:center;border: 1px solid #000000;height:.25in; }
   #ticket_table { width:7in; }
   #ticket_table td { padding:2px 5px; vertical-align:top }
   td.field { text-align:right; }
   /*]]>*/
   </style>
   <link rel="stylesheet" type="text/css" media="print" href="print.css" />

   <title>Confirmation</title>
</head>
<body>
   <div id="main" class='shadow'>
   <div id='top_overview'>
      <span class='date'><?php print $job->JobDate; ?></span><br />
      <span class='time'><?php print $job->PickupTime; ?></span><br />
      <span class='desc'><?php print $business->Business; ?></span><br />
      <span class='pass'>Pax: <?php print $job->NumberOfItems; ?></span><br />
      <span class='pass'>Bus: <?php print $bus->Bus; ?></span>
   </div>
    <div id='top_header'>
       <div>Num Pass: <b><?php print $job->NumberOfItems; ?></b><br />Job ID: <b><?php print $job->JobID; ?></b><br /></div>
       <div>Date: <b><?php print $job->JobDate; ?></b><br />Start: <b><?php print $job->PickupTime; ?></b></div>
   </div>
   <div class="Part">
      <table id="header">
         <tr>
            <td colspan='3'><h2>D HARRIS TOURS Inc.</h2></td>
         </tr>
         <tr>
            <td>415-902-8542</td><td>PO Box 5961</td><td>TCP 017270-B</td>
         </tr>
         <tr>
            <td>800-853-4006 FAX</td><td>Vallejo CA 94591</td><td>CA 273437</td>
         </tr>
      </table>
      <br />
      <div id='ticket' >
         <div style="padding:4px;">
            <h2 class='center'>CONFIRMATION</h2>
            <div class="date center"><?php print $job->JobDate; ?></div>
         </div>
         <div class='big'><?php print $job->Job; ?></div>
         <div class='big'><?php print $job->Description; ?></div>
         <br />
         <table id='ticket_table'>
            <tr>
               <td class='field'>Customer:</td>
               <td class='value'><?php print $business->Business; ?></td>
               <td class='field'>Fax:</td>
               <td class='value'><?php print $business->Fax; ?></td>
            </tr>
            <tr>
               <td class='field'></td>
               <td class='value'><?php print $business->Address1; ?></td>
               <td class='field'>Phone:</td>
               <td class='value'><?php print $business->Phone; ?></td>
            </tr>
            <tr>
               <td class='field'></td>
               <td class='value'><?php print $job->BusinessLocation; ?></td>
               <td class='field'>Bus:</td>
               <td class='value'><?php print $bus->Bus; ?></td>
            </tr>
            <tr><td colspan='3'><br /></td></tr>
            <tr>
               <td class='field'>Pick Up Time:</td>
               <td class='value'><?php print $job->PickupTime; ?></td>
               <td class='field'>Drop Off Time:</td>
               <td class='value'><?php print $job->DropOffTime; ?></td>
            </tr>
            <tr>
               <td class='field'>P/U Location:</td>
               <td class='value'><?php print $job->PickupLocation; ?></td>
            </tr>
            <tr>
               <td class='field'>D/O Location:</td>
               <td class='value'><?php print $job->DropOffLocation; ?></td>
            </tr>
            <tr>
               <td class='field'>Final Drop:</td>
               <td class='value'><?php print $job->FinalDropOffLocation; ?></td>
               <td class='field'></td>
               <td class='value'></td>
            </tr>
            <tr><td colspan="3"><br /></td></tr>
            <tr>
               <td class='field'>Total Hours:</td>
               <td class='value' colspan='3'><?php print $job->Hours; ?><br /><br /></td>
            </tr>
            <tr>
               <td class='field'>Quote Amount:</td>
               <td class='value' colspan='3'><?php print $job->QuoteAmount; ?><br /><br /></td>
            </tr>
         </table>
<br /><br /><br /><br /><p><span class="bold">Cancellation Policy: </span> a charge of $400 if service not cancelled 72 hours prior to spot time. Full charge for on the spot cancellation. Thank you for your business!</p>
      </div>
   <table id='sigs'>
      <tr>
         <th>Customer Name</th>
         <th>Customer Signature</th>
      </tr>
         <td><br /><br /></td>
         <td><br /><br /></td>
   </table>
   
   <br />
   </div>
   </div>
</body>
</html>
