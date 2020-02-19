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
   $in['Resource'] = "Invoice";
//   print_r($in);
   $current = $boss->getObjectRelated($in['Resource'], $in['ID'],false);
   $job = $boss->getObjectRelated('Job',$current->JobID,false);
   $trip = $boss->getObjectRelated('Trip','JobID = '.$current->JobID.' ',false);
   $business = $boss->getObjectRelated('Business',$job->BusinessID,false);
   $bus = $boss->getObjectRelated('Bus',$job->BusID,false);
//   print "var data = ".json_encode($current).";\n";
//print_r($trip->Trip[0]->TripID);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<link type="text/css" href="https://fonts.googleapis.com/css?family=Quicksand:400,700" rel="stylesheet" />
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <style type="text/css">
/*<![CDATA[*/
   body { background-color: filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f0f0f0', endColorstr='#b0b0b0'); background: -webkit-gradient(linear, left top, left bottom, from(#f0f0f0), to(#b0b0b0)); background: -moz-linear-gradient(top,  #f0f0f0,  #b0b0b0);font-size:14pt;color:black;font-family:"Quicksand",Verdana,sans-serif; }
   IMG { margin:0 0 -4px 0; }
   DIV[class="Part"] { margin:0;text-indent:0; }
   H1 { text-align:justify; margin:0;text-indent:0px; }
   P { text-align:justify; margin:0 28px 0 0; text-indent:0px; line-height:20px }
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
   #top_header div { float:left;width:2.25in;height:.5in;padding:.006in .05in;}
   #top_header>:first-child { border-right:4px solid #000;}
   #header { width:4.5in;height:.6in; }
   #top_overview { position:absolute;right:1.5in;width:2in;height:.83in;white-space:nowrap;text-align:right;padding:.08in .125in; border-radius:5px;-webkit-border-radius:5px;-moz-border-radius:5px;}
   #top_overview .desc { font-weight:bold; }
   #top_overview span { font-size:.9em; }
   #main { background:none repeat scroll 0 0 #FFFFFF; height:10in; margin:1px auto; padding:.5in; position:relative; width:7.5in; }
   .shadow { -moz-box-shadow:0px -2px 7px rgba(0,0,0,.5);}
   #forprint { margin:.5in; width:8.0in;height:11in; position:relative;}
   #ticket {border:solid 1px #000000;height:7in;width:7.0in;padding:.125in;position:relative; border-radius:15px;-webkit-border-radius:15px;-moz-border-radius:15px;}
   h2{margin:0px; font-size:20pt; font-weight:bold;}
   .big {font-size:18pt;}
   div.date {font-size:10pt;}
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

   <title>Invoice</title>
</head>
<body>
   <div id="main" class='shadow'>
   <div id='top_overview'>
      <table>
      <tr>
      	<td> 
      	 <h3>Invoice:</h3>
	</td>
	<td>&nbsp;</td>
	<td>
		<h3><?php print $current->InvoiceID; ?></h3>
	</td>
      </tr>
      <tr>
      	<td>
	Date:
      </td>
	<td>&nbsp;</td>
      <td>
	<?php if ($current->InvoiceDate==0) {print $current->LastModified;} print $current->InvoiceDate; ?>
      </td>
      </tr>
      
      <tr><td>TCP: </td>
      <td>&nbsp;</td>
	<td> 017270-B</td></tr>

      <tr><td>CA </td>
      <td>&nbsp;</td>
   <td>273437</td></tr>

   </table>
   </div>
   <div class="Part">
      <table id="header">
         <tr>
            <td colspan='3'><h2>D HARRIS TOURS Inc.</h2></td>
         </tr>
         <tr><td></td></tr>
         <tr>
            <td>415-902-8542</td>
         </tr>
         <tr>
            <td>800-853-4006 FAX</td>
         </tr>
         <tr>
            <td>PO Box 5961</td>
         </tr>
         <tr>
            <td>Vallejo CA 94591</td>
         </tr> 
         <tr>
            <td>juanaharrisdht@att.net</td>
         </tr> 
   </table>
    <br />
       <div class='date'>
      <div id='ticket' >
         <div style="padding:4px;">
            <h2 class='center'><?php print $business->Business; ?></h2>
            <div class="date center"><input type="text" value="<?php print $business->AttnTo; ?>" style='width:30em; text-align:center; border: none;'/></div>
            <div class="date center"><input type="text" value="<?php print $business->Address1; ?>" style='width:30em; text-align:center; border: none;'/></div>
            <div class="date center"><input type="text" value="<?php print $business->Address2; ?>" style='width:30em; text-align:center; border: none;'/></div>
            <div class="date center"><input type="text" value="<?php print $business->City; ?>, <?php print $business->State; ?>. <?php print $business->Zip; ?>" style='width:30em; text-align:center; border: none;'/></div>
            <div class="date center"><input type="text" value="<?php print $business->Phone; ?>, fax: <?php print $business->Fax; ?>" style='width:30em; text-align:center; border: none;'/></div>
         </div>
         <br />
       <table id='ticket_table'>
            <tr>
               <td class='field'>Job ID: </td>
	       <td class='value' style='max-width: 55%; width:45%;'><?php print $job->JobID; ?></td>
               <td class='field'>Job Date: </td>
               <td class='value'><?php print $job->JobDate; ?></td>
            </tr>
            <tr>
               <td class='field'>Job: </td>
	       <td class='value'><?php print $job->Job; ?></td>
               <td class='field'>Pax:</td>
               <td class='value'><?php print $job->NumberOfItems; ?></td>
            <tr>
               <td class='field'>PO: </td>
               <td class='value'><?php print $job->BusinessLocation; ?></td>
               <td class='field'>Bus: </td>
               <td class='value'><?php print $bus->Bus; ?></td>
	    </tr>
            <tr>
               <td class='field'></td>
               <td class='value'></td>
               <td></td>
               <td></td>
            </tr>
            <tr><td colspan='3'><br /></td></tr>
            <tr>
               <td class='field'>From:</td>
               <td class='value'><?php print $job->PickupLocation; ?></td>
               <td class='field'></td>
               <td class='value'></td>
            </tr>
            <tr><td colspan='3'><br /></td></tr>
            <tr>
               <td class='field'>To:</td>
               <td class='value'><?php print $job->DropOffLocation; ?></td>
               <td class='field'></td>
               <td class='value'></td>
            </tr>
            <tr><td colspan='3'><br /></td></tr>
            <tr>
               <td class='field'>Final:</td>
               <td class='value'><?php print $job->FinalDropOffLocation; ?></td>
               <td class='field'></td>
               <td class='value'></td>
            </tr>
            <tr><td colspan="3"><br /></td></tr>
            <tr>
               <td class='field' >Recorded: </td>
               <td class='value'><?php if ($trip->Trip[0]->JobStartTime==0) {print $job->PickupTime;} print $trip->Trip[0]->JobStartTime; ?></td>
               <td class='field'>Requested:</td>
               <td class='value'><?php print $job->PickupTime; ?></td>
            </tr>
            <tr>
               <td class='field'>Dropoff: </td>
               <td class='value'><?php if ($trip->Trip[0]->JobEndTime==0) {print $job->DropOffTime;} print $trip->Trip[0]->JobEndTime; ?></td>
               <td class='field'></td>
               <td class='value'><?php print $job->DropOffTime; ?></td>
            </tr>
	    <tr>
               <td class='field'>Hours:</td>
               <td class='value'><?php if ($current->BillableHours==0) {print $job->Hours;} print $current->BillableHours; ?></td>
               <td class='field'>Hours:</td>
               <td class='value'><?php print $job->Hours; ?></td>
	    </tr>
	    <tr>
               <td class='field'>Over:</td>
               <td class='value'><?php if ($current->BillableHours<=$job->Hours) {print 0;} print $current->BillableHours-$job->Hours; ?></td>
               <td class='field'>Quote:</td>
               <td class='value'>$<?php print $job->QuoteAmount; ?></td>
            </tr>
            <tr><td colspan="3"><br /><td></tr>
            <tr>
               <td></td>
               <td class='field'>OT Charge:</td>
               <td class='value'><?php if ($current->InvoiceAmt==$job->QuoteAmount) {print 0;} print $current->InvoiceAmt-$job->QuoteAmount-$current->Gas-$current->MiscCost; ?></td>
               <td></td>
	    </tr>
            <tr>
               <td></td>
               <td class='field'>Gas:</td>
               <td class='value' colspan='3'><?php print $current->Gas; ?></td>
               <td></td>
            </tr>
            <tr>
               <td></td>
               <td class='field'>Misc Cost:</td>
               <td class='value' colspan='3'><?php print $current->MiscCost; ?></td>
               <td></td>
            </tr>
            <tr>
               <td></td>
               <td class='field' style='font-weight: bold; font-size:12pt'>Invoice Amount:</td>
               <td class='value' colspan='3'  style='font-weight: bold; font-size:12pt'>$<?php if ($current->InvoiceAmt==0) {print $job->QuoteAmount;} print $current->InvoiceAmt; ?></td>
            </tr>
            <tr>
               <td class='field'>Desc: </td>
               <td class='value' colspan='3'><?php print $current->Description; ?></td>
            </tr>
         </table>
         </div>
      </div>
      </div>
Thank you for your business!
   <br />
   <p style="font-size:.8rem"><span class="bold">Cancellation Policy: </span> a charge of $400 if service not cancelled 72 hours prior to spot time. Full charge for on the spot cancellation. 
<span class="bold">Late Payment: </span> 10% monthly fee will be added to any invoice 30 days past due.</p>
   </div>
</body>
</html>
