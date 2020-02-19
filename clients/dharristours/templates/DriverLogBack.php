<?php 
   // require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
   /* START NEW SECTION */
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

   /* END NEW SECTION */

      $in['Resource'] = "Job";
//   print_r($in);
   $current = $boss->getObjectRelated($in['Resource'], $in['ID'],false);
   $business = $boss->getObjectRelated('Business',$current->BusinessID,false);
   $driver = $boss->getObjectRelated('Employee',$current->EmployeeID,false);
   $bus = $boss->getObjectRelated('Bus',$current->BusID,false);
//   print "var data = ".json_encode($current).";\n";
//print_r($current);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<link type="text/css" href="https://fonts.googleapis.com/css?family=Quicksand:400,700" rel="stylesheet" />
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <style type="text/css">
/*<![CDATA[*/
   body { background-color: filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f0f0f0', endColorstr='#b0b0b0'); background: -webkit-gradient(linear, left top, left bottom, from(#f0f0f0), to(#b0b0b0)); background: -moz-linear-gradient(top,  #f0f0f0,  #b0b0b0);font-size:12pt;color:black;font-family:"Helvetica Neue",Verdana,sans-serif; }
   IMG { margin:0 0 -4px 0; }
   DIV[class="Part"] { margin:0;text-indent:0; }
   H1 { text-align:justify; margin:0;text-indent:0px; }
   P { text-align:justify; margin:0 28px 0 0; text-indent:0px; line-
   :20px }
   TABLE { border-width:thin; border-collapse:collapse; padding:3px; text-align:left; vertical-align:top; margin:0; width:auto; height:auto; display:table; float:none }
   TR { vertical-align:top; height:auto }
   TH { text-align:left; vertical-align:top }
   TD { text-align:left; vertical-align:bottom }
   :link { color: blue }
   :visited { color: purple }
   :active { color: fushia }
   span.tidy-5 {font-size:10pt; color:#000000}
   span.tidy-3 {color:#000000}
   #top_header { width:5in; height:.5in;position:relative;white-space:nowrap;border-radius:12px;-webkit-border-radius:12px;-moz-border-radius:12px;border: 4px solid #000000; }
   #top_header div { float:left;width:2.25in;height:.5in;padding:.006in .05in;font-size:12pt;}
   #top_header>:first-child { border-right:4px solid #000;}
   #header { width:4.5in;height:.6in; }
   #top_overview { position:absolute;right:.5in;width:2in;height:1.4in;border:solid 1px #000000;text-align:right;padding:.08in .125in; border-radius:5px;-webkit-border-radius:5px;-moz-border-radius:5px;}
   #top_overview .desc { font-weight:bold; }
   #top_overview span { font-size:1.1em; }
   #main { background:none repeat scroll 0 0 #FFFFFF; height:10in; margin:1px auto; padding:.5in; position:relative; width:7.5in; }
   .shadow { -moz-box-shadow:0px -2px 7px rgba(0,0,0,.5);}
   #forprint { margin:.5in; width:8.0in;height:11in; position:relative;}
   #ticket {border:solid 1px #000000; /* height:4in;*/ width:7.0in;padding:.125in;position:relative; border-radius:15px;-webkit-border-radius:15px;-moz-border-radius:15px;}
   h2{margin:0px; font-size:18pt; font-weight:bold;}
   .big {font-size:18pt;}
   div.date {font-size:12pt;font-weight:bold;}
   .center {text-align:center;}
   #sigs { width:7.5in; border: solid 1px #000000; }
   #sigs th {text-align:center;border:solid 1px #000000;font-weight:bold;font-size:1.5em;padding:4px;}
   #sigs td {border:solid 1px #000000;padding:4px;}
   #stats {margin-bottom:14px;width:7.5in;position:relative;border:solid 1px #000000;}
   #stats td { border: 1px solid #000000;height:.25in; }
   #stats th { font-weight:bold;text-align:center;border: 1px solid #000000;height:.25in; }
   #return_table {text-align:center; position:relative;width:7.5in;}
   #return_table td { border: 1px solid #000000;height:.25in; }
   #return_table th { font-weight:bold;text-align:center;border: 1px solid #000000;height:.25in; }
   #ticket_table { width:7in; }
   #ticket_table td { padding:0px 5px; vertical-align:top }
   td.field { text-align:right;font-weight:bold;font-size:9.5pt; }
   td.value { text-align:left;font-weight:normal;font-size:10pt; }
   /*]]>*/
   </style>
   <title>Driver Trip Sheet</title>
</head>
<body>
   <div id="main" class='shadow'>
   <div id='top_overview'>
      <span class='date'><?php print $current->JobDate; ?></span><br />
      <span class='time'><?php print $current->PickupTime; ?></span><br />
      <span><?php print $business->Business; ?></span><br />
      <span class='pass'>Pax: <?php print $current->NumberOfItems; ?><br /></span>
      <span class='pass'>Bus: <?php print $bus->Bus; ?></span>
   </div>
    <div id='top_header'>
       <div>Driver Name: <b><?php print $driver->Employee; ?></b><br />Job Number: <b> <?php print $current->JobID; ?></b></div>
       <div>Date: <b><?php print $current->JobDate; ?></b><br />Start: <b><?php print $current->PickupTime; ?></b></div>
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
            <h2 class='center'>DRIVER TRIP</h2>
            <div class="date center"><?php print $current->JobDate; ?> at </div>
            <div class="date center"><?php print $current->PickupTime; ?></div>
         </div>
         <table id='ticket_table'>
            <tr>
               <td class='field' >Depart Yard:</td>
               <td class='value'><input type='text' value='<?php print strftime('%H:%M',strtotime($current->PickupTime) - 3600); ?> '/></td>
            </tr>

            <tr>
               <td class='field'>Start Time:</td>
               <td class='value'><?php print $current->PickupTime; ?></td>
            </tr>
            <tr>
               <td class='field'>End Time:</td>
               <td class='value'><?php print $current->DropOffTime; ?></td>
            </tr>

            <tr>
            	<td class='field'>Contact: </td>
            	<td class='value'><?php print $current->ContactName; ?>-<?php print $current->ContactPhone; ?></td>
            </tr>
            <tr>
               <td class='field'>1st Location:</td>
               <td class='value'><?php print $current->PickupLocation; ?><br /></td>
            </tr>
            <tr><td colspan="3"><br /></td></tr>
            <tr>
               <td class='field'>2nd Location:</td>
               <td class='value'><?php print $current->DropOffLocation; ?><br /></td>
            </tr>
            <tr><td colspan="3"><br /></td></tr>
            <tr>
               <td class='field'>3rd Location:</td>
               <td class='value'><?php print $current->FinalDropOffLocation; ?></td>
            </tr>
            <tr><td colspan="3"><br /></td></tr>
            <tr>
               <td class='field'>Additional:</td>
               <td class='value' colspan='3'><?php print $current->SpecialInstructions; ?><br /><br /></td>
            </tr>
         </table>
      </div>
   <br /><br />
   <table id="stats">
      <tr>
         <th><span class="tidy-5">City</span></th>
         <th><span class="tidy-5">Arrive Time</span></th>
         <th><span class="tidy-5">Start Time</span></th>
         <th><span class="tidy-5">Start Miles</span></th>
         <th><span class="tidy-5">End Time</span></th>
         <th><span class="tidy-5">End Miles</span></th>
         <th><span class="tidy-5">Passengers</span></th>
      </tr>
      <tr>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
      </tr>
      <tr>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
      </tr>
      <tr>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
      </tr>
      <tr>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
      </tr>
   </table>
   <br />
   <table id='sigs'>
     <tr>Customer Acceptance</tr>
      <tr>
         <th>Date</th>
         <th>Start Time</th>
         <th>End Time</th>
         <th>Signature</th> 
      </tr>
      <tr>
         <td><br /><br /></td>
         <td><br /><br /></td>
         <td><br /><br /></td>
         <td><br /><br /></td>
   </table>
   <br />
   <p>Driver <span class="bold">MUST</span> complete and submit before the end of each work day.</p>
   <br />
   <table id="return_table">
      <tr>
         <th>Pre-Trip</th>
         <th>Yard Depart Time</th>
         <th>Starting Mileage</th>
         <th>Yard Return Time</th>
         <th>Ending Mileage</th>
         <th>Total Hours Worked</th>
      </tr>
      <tr>
         <td><input type='text'/></td>
         <td><input type='text'/></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
      </tr>
   </table>
   </div>
   </div>
</body>
</html>
