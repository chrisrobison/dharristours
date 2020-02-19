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
   #top_overview { position:absolute;right:22px;width:2in;height:1.4in;border:solid 1px #000000;text-align:right;padding:.08in .125in; border-radius:5px;-webkit-border-radius:5px;-moz-border-radius:5px;}
   #top_overview .desc { font-weight:bold; }
   #top_overview span { font-size:1.1em; }
   #main { background:none repeat scroll 0 0 #FFFFFF; height:10in; margin:1px auto; padding:22px; position:relative; width:7.5in; }
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
      <span class='time'><?php if (is_null($current->OnSpotTime)  or $current->OnSpotTime =='') {print $current->PickupTime;} print $current->OnSpotTime; ?></span><br />
      <span><?php print $business->Business; ?></span><br />
      <span class='pass'>Pax: <?php print $current->NumberOfItems; ?><br /></span>
      <span class='pass'>Bus: <?php print $bus->Bus; ?></span>
   </div>
    <div id='top_header'>
       <div>Driver Name: <b><?php print $driver->Employee; ?></b><br />Job Number: <b> <?php print $current->JobID; ?></b></div>
       <div>Date: <b><?php print $current->JobDate; ?></b><br />Start: <b><?php  if (is_null($current->OnSpotTime)  or $current->OnSpotTime =='') {print $current->PickupTime;} print $current->OnSpotTime;  ?></b></div>
   </div>
   <div class="Part">
      <table id="header">
         <tr>
            <td colspan='4'><h2>D HARRIS TOURS Inc.</h2></td>
         </tr>
	 <tr>
	   <td>juanaharrisdht@att.net</td><td>TCP 017270-B</td> <td>CA 273437</td>
	 </tr>
         <tr>
            <td>415-902-8542</td><td>PO Box 5961</td></tr>
         <tr>
            <td>800-853-4006 FAX</td><td>Vallejo CA 94591</td>
	 </tr>
      </table>
      <br />
      <div id='ticket' >
         <div style="padding:4px; position:relative;">
            <h2 class='center'>DRIVER TRIP</h2>
            <div class="date center"><?php print $current->JobDate; ?> at </div>
            <div class="date center"><?php  if (is_null($current->OnSpotTime) or $current->OnSpotTime =='') {print $current->PickupTime;} print $current->OnSpotTime; ?></div>
         </div>
         <table id='ticket_table'>
            <tr>
               <td class='field' style="width:10%;">Job:</td>
               <td class='value' style="width:90%;"><?php print $current->Job; ?></td>
            </tr>
            <tr>
               <td class='field' >Spot:</td>
               <td class='value'>15 minutes prior to start</td>
               <td class='field' >Contact:</td>
               <td class='value'><?php print $current->ContactName; ?> <?php print $current->ContactPhone; ?> </td>
            </tr>

            <tr>
               <td class='field'>Start:</td>
               <td class='value'><?php  if (is_null($current->OnSpotTime) or $current->OnSpotTime =='') {print $current->PickupTime;} print $current->OnSpotTime; ?></td>
            </tr>
            <tr>
               <td class='field'>End Time:</td>
               <td class='value'><?php print $current->DropOffTime; ?></td>
            </tr>

            <tr>
               <td class='field'>1st Stop:</td>
               <td class='value'><?php print $current->PickupLocation; ?><br /></td>
            </tr>
            <tr><td colspan="3"><br /></td></tr>
            <tr>
               <td class='field'>2nd Stop:</td>
               <td class='value'><?php print $current->DropOffLocation; ?><br /></td>
            </tr>
            <tr><td colspan="3"><br /></td></tr>
            <tr>
               <td class='field'>3rd Stop:</td>
               <td class='value'><?php print $current->FinalDropOffLocation; ?></td>
            </tr>
            <tr><td colspan="3"><br /></td></tr>
            <tr>
               <td class='field'>Additional:</td>
               <td class='value' colspan='3'><?php print $current->SpecialInstructions; ?><br /><br /></td>
            </tr>
	    <tr><td>&nbsp;</td></tr>
         </table>
      </div>
  <p>FUEL DURING DOWNTIME at Flyers https://www.flyersenergy.com/locations/</p>
   <table id="stats">
      <tr>
         <th><span class="tidy-5"></span></th>
         <th><span class="tidy-5">Arrive Time</span></th>
         <th><span class="tidy-5">Start Time</span></th>
         <th><span class="tidy-5">Start Miles</span></th>
         <th><span class="tidy-5">End Time</span></th>
         <th><span class="tidy-5">End Miles</span></th>
         <th><span class="tidy-5">Pax</span></th>
      </tr>
     <tr><br /></tr>
      <tr>
         <td>Yard</td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
      </tr>
      <tr>
         <td>1 Stop</td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
      </tr>
       <tr>
         <td>2 Stop</td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
      </tr>
        <tr>
         <td>3 Stop</td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
      </tr>
        <tr>
         <td>4 Stop</td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
      </tr>
  </table>
   <table id='sigs'>
  <tr><div style="text-align:center">For driver to get credit, overtime <b>MUST BE SIGNED</B> by: <p><?php print $business->Business; ?></p></tr>
      <tr>
         <th width=25%>Date</th>
         <th width=25%>Start Time</th>
         <th width=25%>End Time</th>
         <th width=25%>Signature</th> 
      </tr>
      <tr>
         <td><br /><br /></td>
         <td><br /><br /></td>
         <td><br /><br /></td>
         <td><br /><br /></td>
     </tr>
   </table>
   <table width="100%">
    <tr>    
       <td width=20%></td>
       <th width=80/5% style="text-align:center"> Poor</th>
       <th width=80/5% style="text-align:center"> Fair</th>
       <th width=80/5% style="text-align:center"> Good</th>
       <th width=80/5% style="text-align:center"> Very Good</th>
       <th width=80/5% style="text-align:center">Excellent</th>
   </tr>   
   <tr>    
       <td width=20% style="text-align:right">Driver Safety:</td>
       <th width=80/5% style="text-align:center"> 1</th>
       <th width=80/5% style="text-align:center"> 2</th>
       <th width=80/5% style="text-align:center"> 3</th>
       <th width=80/5% style="text-align:center"> 4</th>
       <th width=80/5% style="text-align:center"> 5</th>
   </tr>   
   <tr>    
       <td width=20% style="text-align:right">Clean Vehicle:</td>
       <th width=80/5% style="text-align:center"> 1</th>
       <th width=80/5% style="text-align:center"> 2</th>
       <th width=80/5% style="text-align:center"> 3</th>
       <th width=80/5% style="text-align:center"> 4</th>
       <th width=80/5% style="text-align:center"> 5</th>
    </tr>   
   </table>
</div>
   </div>
</body>
</html>
