<?php 
  // require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
   /* START NOAUTH SECTION */
   require_once("/simple/lib/boss_class.php");
   session_start();

   $srvName = ($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : "dharristours.simpsf.com";
   $boss = new boss($srvName);
   $boss->docroot = $_SERVER['DOCUMENT_ROOT'] . '/' . $boss->app->Assets;

   $in = $_REQUEST;
   if (isset($in['id'])) $in['ID'] = $in['id'];
   if ($in['z']) {
      $qs = base64_decode($in['z']);

      $parts = explode('&', $qs);
      $cnt = count($parts);

      for ($i=0; $i < $cnt; $i++) {
          list($key, $val) = preg_split("/=/", $parts[$i]);
          $in[urldecode($key)] = preg_replace("/\#.*/", '', urldecode($val));
      }
   }
   /* END NOAUTH SECTION */
   $in['Resource'] = "InvoiceParent";
   $master = $current = $boss->getObjectRelated($in['Resource'], $in['ID']);
   $invs = preg_split("/\,/", $master->InvoiceIDs); 

    $business = $boss->getObject("Business", $master->BusinessID);
//   print "var data = ".json_encode($current).";\n";
//print_r($trip->Trip[0]->TripID);
?>
<!DOCTYPE html>
<html>
<head>
<link type="text/css" href="https://fonts.googleapis.com/css?family=Quicksand:400,700" rel="stylesheet" />
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <style type="text/css">
/*<![CDATA[*/
   @import url('https://fonts.googleapis.com/css?family=Montserrat:700|Roboto:100,400,700,900|Source+Sans+Pro&display=swap');
   body { font-size:14pt;color:black;font-family:"Roboto",sans-serif; padding:0; margin:0;}
   IMG { margin:0 0 -4px 0; }
   DIV[class="Part"] { margin:0;text-indent:0; }
   H1 { text-align:justify; margin:0;text-indent:0px; }
   H2 { font-weight:900;font-family:"Montserrat"; font-weight:700;  }
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
   #header { width:5in;height:.6in; }
   #top_overview { position:absolute;right:.5in;height:.83in;white-space:nowrap;text-align:right;padding:.08in .125in; border-radius:5px;-webkit-border-radius:5px;-moz-border-radius:5px; }
   #top_overview .desc { font-weight:bold; }
   #top_overview span { font-size:.9em; }
   #main { background:none repeat scroll 0 0 #FFFFFF; height:11in; margin:1px auto; padding:.5in; position:relative; width:7.75in; }
   .shadow { -moz-box-shadow:0px -2px 7px rgba(0,0,0,.5);}
   #forprint { margin:.5in; width:8.0in;height:11in; position:relative;}
   #ticket {border:solid 1px #000000;height:9in;width:7.5in;padding:.125in;position:relative; border-radius:15px;-webkit-border-radius:15px;-moz-border-radius:15px;}
   h2{margin:0px; font-size:20pt; font-weight:bold;}
   td {vertical-align:top; }
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
   #ticket_table,.trips { width:7.5in; font-size:1.2em; }
   #ticket_table td { padding:2px 5px; vertical-align:top }
   td.field { text-align:right; color:#666;vertical-align:top; }
   .header { font-size:.9em; }
   .header td.right { padding-right:.5em; }
   .right { text-align:right; }
   h3 { padding:0px; margin:0px; }
   .trips td { padding:.25em; }
   .currency { text-align:right; width: 3rem;}
   th { text-align: center;}
    .details {
        line-height: 2;
        border: 1px solid #0006;
    }
    .details thead th {
    background-color:#333;
    color:#fff;
    }
    .details tbody td {
        border-right: 1px solid #0006;
        padding: 0 0.5rem; 
    }
    .details tbody tr:nth-child(even) td {
        background-color:#ccc;
    }
    main { height: 100%; }
    .date class { height: 100%; }
    #ticket { height: 100%; }
   /*]]>*/
   </style>
   <link rel="stylesheet" type="text/css" media="print" href="print.css" />

   <title>Invoice</title>
</head>
<body>
   <div id="main" class='shadow'>
   <div id='top_overview'>
      <table>
      <tr> <td><h3>Invoice# </h3> </td> <td> <h3><?php print $current->BusinessID . '-'. date('ymd') . '-' . $current->InvoiceParentID; ?></h3></td> </tr>
      <tr class='header'>
         <td colspan='2' style='text-align:right;'><?php print date("m/d/Y"); ?></td>
      </tr>

   </table>
   </div>
   <div class="Part">
      <table id="header">
         <tr>
            <td rowspan='4'><img width='100' src='/clients/dharristours/img/bus-logo.png'></td>
            <td colspan='3'><h2>D HARRIS TOURS Inc.</h2></td>
         </tr>
         <tr>
            <td class='header' colspan='3'>Voice: (415) 902-8542 / Fax: (800) 853-4006</td>
         </tr>
         <tr>
            <td class='header' colspan='2'>PO Box 5961, Vallejo, CA 94591</td>
            <td class='header'>TCP 017270-B</td>
         </tr>
         <tr>
            <td class='header' colspan='2'>juanaharrisdht@att.net</td>
            <td class='header'>CA 273437</td>
         </tr> 
         <tr>
         </tr>
   </table>
    <br />
       <div class='date'>
      <div id='ticket' >
         <div style="padding:4px;font-size:1.5em">
            <h2 class=''><?php print $business->Business; ?></h2>
            <?php
               if (($business->AttnTo != ".") && ($business->AttnTo!="")) {
            ?>
            <?php
               }
               if (($business->Address1 != ".") && ($business->Address1!="")) {
            ?>
            <!--div class="date"><input type="text" value="<?php print $business->Address1; ?>" style='width:30em; text-align:center; border: none;font-size:1.2em;'/></div-->
            <?php
               }
               if (($business->Address2 != ".") && ($business->Address2!="")) {
            ?>
            <!--div class="date"><input type="text" value="<?php print $business->Address2; ?>" style='width:30em; text-align:center; border: none;font-size:1.2em;'/></div-->
            <?php
               }
            ?>
            <div contenteditable class="date" style='width:30em; border: none;font-size:18px;'><?php print $business->Address1 . "<br>" . $business->Address2 . "<br>" . $business->City; ?>, <?php print $business->State; ?>. <?php print $business->Zip; ?></div>
            <div class="date"><input type="text" value="Voice: <?php print $business->Phone; ?> <?php print $business->Fax ? 'Fax: ' .$business->Fax : ''; ?>" style='width:30em; border: none;font-size:1.2em;'/></div>
         </div>
         <br />
       <table id='ticket_table'>
            <tr>
               <td class='field'></td>
               <td class='value'></td>
               <td><br></td>
               <td></td>
            </tr>
         </table>
         <div style='font-size:2em;'>Trip Invoices</div>
         <table class='details' style="width:7.5in;">
            <thead>
                <tr>
                    <th>Inv ID</th>
                    <th style='display:none;'>Job ID</th>
                    <th>Trip</th>
                    <th>Date</th>
                    <th>Cost</th>
                    <th>Paid</th>
                    <th>Due</th>
                </tr>
            </thead>
            <tbody>
            <!--

         <?php 
            $tot = 0;
print_r($invs);
print "-->\n";
            foreach ($invs as $inv_id) {
                $inv = $boss->getObject("Invoice", $inv_id);
                $job = $boss->getObject("Job", $inv->JobID);
                $date = date("m/d/Y", strtotime($job->JobDate));
                $paidamt = ($inv->PaidAmt) ? $inv->PaidAmt : '0';
                $invamt = sprintf("%.02f", $inv->InvoiceAmt);
                $bal = number_format($inv->Balance, 2);
                $paidamt = number_format($paidamt, 2);
                print <<<EOT
<tr><td>{$inv->InvoiceID}</td><td style='display:none;'>{$job->JobID}</td><td>{$job->Job}</td><td>{$date}</td><td class='currency'>\${$invamt}</td><td class='currency'>\${$paidamt}</td><td class='currency'>\${$bal}</td></tr>
EOT;
                $tot += $inv->InvoiceAmt;
                $paid += $inv->PaidAmt;
                $balance += $inv->Balance;
            }
            $balance = number_format($balance, 2);
            $paid = number_format($paid, 2);
            $tot = number_format($tot, 2);
         ?>
            </tbody>
        </table>
        <br>
         <table style='width:7.5in;'>
            <tr>
               <td class='field' style='border-right:1px solid #0006; color: #000; white-space:nowrap;font-weight: bold; font-size:12pt'>Invoices Total:</td>
               <td class='value right' style='width:5rem;font-weight: bold; font-size:12pt'>$<?php print $tot; ?></td>
            </tr>
            <tr>
               <td class='field' style='border-right:1px solid #0006; color: #000; white-space:nowrap;font-weight: bold; font-size:12pt'>Paid Amount:</td>
               <td class='value right' style='width:5rem;font-weight: bold; font-size:12pt'>$<?php print $paid; ?></td>
            </tr>
            <tr>
               <td class='field' style='border-right:1px solid #0006; color: #000; white-space:nowrap;font-weight: bold; font-size:12pt'>Balance DUE:</td>
               <td class='value right' style='width:5rem;font-weight: bold; font-size:12pt'>$<?php print $balance; ?></td> 
            </tr>

         </table>
         </div>
      </div>
      </div>
   <p style="text-align:center;padding-top:.5em;font-size:.8rem"><span class="bold">Cancellation Policy: </span> a charge of $400 if service not cancelled 72 hours prior to spot time. <br>Full charge for on the spot cancellation. 
<span class="bold">Late Payment: </span> 10% monthly fee will be added to any invoice 30 days past due.</p>
<h2 style='text-align:center'>Thank you for your business!</h2><br>
   </div>
</body>
</html>
