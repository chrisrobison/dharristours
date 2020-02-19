<?php 
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
   $in['Resource'] = "Job";
//   print_r($in);
   $current = $boss->getObject($in['Resource'], $in['ID']);
   $business = $boss->getObject('Business',$current->BusinessID);
   $driver = $boss->getObject('Employee',$current->EmployeeID);
//   print "var data = ".json_encode($current).";\n";
//print_r($current);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <style type="text/css">
/*<![CDATA[*/
   body { background-color: filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f0f0f0', endColorstr='#b0b0b0'); background: -webkit-gradient(linear, left top, left bottom, from(#f0f0f0), to(#b0b0b0)); background: -moz-linear-gradient(top,  #f0f0f0,  #b0b0b0);font-size:14pt;color:black;font-family:"Helvetica Neue",Verdana,sans-serif; }
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
   #top_header div { float:left;width:2.25in;height:.5in;padding:.006in .05in;font-size:12pt;}
   #top_header>:first-child { border-right:4px solid #000;}
   #header { width:4.5in;height:.6in; }
   #top_overview { position:absolute;right:.5in;width:2in;height:.83in;border:solid 1px #000000;text-align:right;padding:.08in .125in; border-radius:5px;-webkit-border-radius:5px;-moz-border-radius:5px;}
   #top_overview .desc { font-weight:bold; }
   #top_overview span { font-size:1.5em; }
   #main { background:none repeat scroll 0 0 #FFFFFF; height:10in; margin:1px auto; padding:.5in; position:relative; width:7.5in; }
   .shadow { -moz-box-shadow:0px -2px 7px rgba(0,0,0,.5);}
   #forprint { margin:.5in; width:8.0in;height:11in; position:relative;}
   #ticket {border:solid 1px #000000;height:4in;width:7.0in;padding:.125in;position:relative; border-radius:15px;-webkit-border-radius:15px;-moz-border-radius:15px;}
   h2{margin:0px; font-size:22pt; font-weight:bold;}
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
   #ticket_table td { padding:2px 5px; vertical-align:top }
   td.field { text-align:right; }
   td.value { text-align:left;font-weight:bold;font-size:10pt; }
   /*]]>*/
   </style>
   <link rel="stylesheet" type="text/css" media="print" href="print.css" />

   <title>Driver Log Sheet</title>
</head>
<body>
   <div id="main" class='shadow'>
   <div id='top_overview'>
      <span class='date'><?php print $current->JobDate; ?></span><br />
      <span class='time'><?php print $current->PickupTime; ?></span><br />
      <span class='desc'><?php print $business->Business; ?></span><br />
      <span class='pass'><?php print $current->NumberOfItems; ?></span>
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
            <h2 class='center'>DRIVER LOG SHEET</h2>
            <div class="date center"><?php print $current->JobDate; ?></div>
         </div>
         <div class='big'><?php print $current->Job; ?></div>
         <div class='big'><?php print $current->ContactName; ?></div>
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
               <td class='value'><?php print $current->BusinessLocation; ?></td>
               <td class='field'></td>
               <td class='value'></td>
            </tr>
            <tr><td colspan='3'><br /></td></tr>
            <tr>
               <td class='field'>Pick Up Time:</td>
               <td class='value'><?php print $current->PickupTime; ?></td>
               <td class='field'>Drop Off Time:</td>
               <td class='value'><?php print $current->DropOffTime; ?></td>
            </tr>
            <tr>
               <td class='field'>P/U Location:</td>
               <td class='value'><?php print $current->PickupLocation; ?></td>
            </tr>
            <tr>
               <td class='field'>D/O Location:</td>
               <td class='value'><?php print $current->DropOffLocation; ?></td>
            </tr>
            <tr>
               <td class='field'>Final Drop:</td>
               <td class='value'><?php print $current->FinalDropOffLocation; ?></td>
               <td class='field'></td>
               <td class='value'></td>
            </tr>
            <tr><td colspan="3"><br /></td></tr>
            <tr>
               <td class='field'>Instructions:</td>
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
      <tr>
         <th>Customer Name</th>
         <th>Customer Signature</th>
         <th>Driver Signature</th>
         <th>Driver</th> 
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
         <th>Yard Departure Time</th>
         <th>Starting Mileage</th>
         <th>Yard Return Time</th>
         <th>Ending Mileage</th>
         <th>Total Hours Worked</th>
      </tr>
      <tr>
         <td></td>
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
