<?php 
  // require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
   /* START NOAUTH SECTION */
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/boss_class.php");
   session_start();

   $srvName = ($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : "admin.dev.sscsf.com";
   $boss = new boss($srvName);
   $boss->docroot = $_SERVER['DOCUMENT_ROOT'] . '/' . $boss->app->Assets;

   $in = $_REQUEST;
   
   if (isset($in['z'])) {
      $qs = base64_decode($in['z']);

      $parts = explode('&', $qs);
      $cnt = count($parts);

      for ($i=0; $i < $cnt; $i++) {
          list($key, $val) = preg_split("/=/", $parts[$i]);
          $in[urldecode($key)] = preg_replace("/\#.*/", '', urldecode($val));
      }
   }
   if (isset($in['id'])) $in['ID'] = $in['id'];

   /* END NOAUTH SECTION */
   $in['Resource'] = "Invoice";

   if (!isset($in['ID'])) {
      print "<h1>No Invoice.</h1>";
      exit;
   }
   $current = $boss->getObject($in['Resource'], $in['ID']);
   if ($current && $current->JobID) {
      $job = $boss->getObjectRelated('Job',$current->JobID,false);
   }
   $trip = $boss->getObjectRelated('Trip','JobID = '.$current->JobID.' ',false);
   if ($job && $job->BusinessID) {
      $business = $boss->getObjectRelated('Business',$job->BusinessID,false);
   }
   if ($job && $job->BusID) {
      $bus = $boss->getObjectRelated('Bus',$job->BusID,false);
   }
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
    body {
        background-color: #666;
        font-size: 12pt;
        color: black;
        font-family: "Roboto", sans-serif;
        padding: 0;
        margin: 0;
    }

    .due {
        padding: 0.25rem 1rem;
        border: 0.5rem solid #c00;
        color: #c00;
        border-style: double;
        transform: rotate(-22deg) scale(1.5);
        font-size: 32px;
        left: 10vw;
        bottom: 10rem;
        text-align: center;
        font-weight: 900;
        display: inline-block;
        position: absolute;
        opacity: 0.8;
        border-radius: 1rem;
        filter: url("#spatter");
    }

    .paid {
        padding: 0.25rem 1rem;
        border: 0.5rem solid #c00;
        color: #039;
        border-style: double;
        transform: rotate(-22deg) scale(1.5);
        font-size: 32px;
        left: 10vw;
        bottom: 10rem;
        text-align: center;
        font-weight: 900;
        display: inline-block;
        position: absolute;
        opacity: 0.8;
        border-radius: 1rem;
        filter: url("#spatter");
    }

    IMG {
        margin: 0 0 -4px 0;
    }

    DIV[class="Part"] {
        margin: 0;
        text-indent: 0;
    }

    H1 {
        text-align: justify;
        margin: 0;
        text-indent: 0px;
    }

    H2 {
        font-weight: 900;
        font-family: "Helvetica Neue", "Helvetica", "Arial", sans-serif;
        font-weight: 700;
    }

    P {
        text-align: justify;
        margin: 0 28px 0 0;
        text-indent: 0px;
        line-height: 20px
    }

    TABLE {
        border-width: thin;
        border-collapse: collapse;
        padding: 3px;
        text-align: left;
        vertical-align: top;
        margin: 0;
        width: auto;
        height: auto;
        display: table;
        float: none
    }

    TR {
        vertical-align: top;
        height: auto
    }

    TH {
        text-align: left;
        vertical-align: top
    }

    TD {
        text-align: left;
        vertical-align: bottom
    }

    :link {
        color: blue
    }

    :visited {
        color: purple
    }

    :active {
        color: fushia
    }

    span.tidy-5 {
        font-size: 10pt;
        color: #000000
    }

    span.tidy-3 {
        color: #000000
    }

    #top_header {
        width: 5in;
        height: .5in;
        position: relative;
        white-space: nowrap;
        border-radius: 12px;
        -webkit-border-radius: 12px;
        -moz-border-radius: 12px;
        border: 4px solid #000000;
    }

    #top_header div {
        float: left;
        width: 2.25in;
        height: .5in;
        padding: .006in .05in;
    }

    #top_header>:first-child {
        border-right: 4px solid #000;
    }

    #header {
        width: 5in;
        height: .6in;
    }

    #top_overview {
        position: absolute;
        right: .5in;
        height: .83in;
        white-space: nowrap;
        text-align: right;
        padding: .08in .125in;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
    }

    #top_overview .desc {
        font-weight: bold;
    }

    #top_overview span {
        font-size: .9em;
    }

    #main {
        background: none repeat scroll 0 0 #FFFFFF;
        height: 11in;
        margin: 1px auto;
        padding: .5in;
        position: relative;
        width: 7.75in;
    }

    .shadow {
        -moz-box-shadow: 0px -2px 7px rgba(0, 0, 0, .5);
    }

    #forprint {
        margin: .5in;
        width: 8.0in;
        height: 11in;
        position: relative;
    }

    #ticket {
        border: solid 1px #000000;
        height: 9in;
        width: 7.5in;
        padding: .125in;
        position: relative;
        border-radius: 15px;
        -webkit-border-radius: 15px;
        -moz-border-radius: 15px;
    }

    h2 {
        margin: 0px;
        font-size: 20pt;
        font-weight: bold;
    }

    td {
        vertical-align: top;
    }

    .big {
        font-size: 18pt;
    }

    div.date {
        font-size: 10pt;
    }

    .center {
        text-align: center;
    }

    #sigs {
        width: 7.5in;
        border: solid 1px #000000;
    }

    #sigs th {
        text-align: center;
        border: solid 1px #000000;
        font-weight: bold;
        font-size: 1.1em;
        padding: 4px;
    }

    #sigs td {
        border: solid 1px #000000;
        padding: 4px;
    }

    #stats {
        margin-bottom: 14px;
        width: 7.5in;
        position: relative;
        border: solid 1px #000000;
    }

    #stats td {
        border: 1px solid #000000;
        height: .25in;
    }

    #stats th {
        font-weight: bold;
        text-align: center;
        border: 1px solid #000000;
        height: .25in;
    }

    #return_table {
        text-align: center;
        position: relative;
        width: 7.5in;
    }

    #return_table td {
        border: 1px solid #000000;
        height: .25in;
    }

    #return_table th {
        font-weight: bold;
        text-align: center;
        border: 1px solid #000000;
        height: .25in;
    }

    #ticket_table,
    .trips {
        width: 7.5in;
        font-size: 1.2em;
    }

    #ticket_table td {
        padding: 2px 5px;
        vertical-align: top
    }

    td.field {
        text-align: right;
        color: #666;
        vertical-align: top;
    }

    .header {
        font-size: .9em;
    }

    .header td.right {
        padding-right: .5em;
    }

    .right {
        text-align: right;
    }

    h3 {
        padding: 0px;
        margin: 0px;
    }

    .trips td {
        padding: .25em;
    }

    ul.disclaimer li>b {
        white-space: nowrap;
        text-align: right;
    }

    ul.disclaimer li {
        display: flex;
    }

    ul.disclaimer {
        display: flex;
        flex-direction: column;
    }

    ul.disclaimer>li>b {
        display: inline-block;
        width: 12rem;
        text-align: right;
    }

    @media print {
        body {
            background-color: #fff;
        }

        .paid {
            display: none;
        }

        .due {
            display: none;
        }

    }

    /*]]>*/
    </style>
    <title>D Harris Tours - Payment Receipt for <?=$in['id']?></title>
</head>

<body>
    <div id="main" class='shadow'>
        <div id='top_overview'>
            <table>
                <tr>
                    <td>
                        <h3>Invoice</h3>
                    </td>
                    <td>
                        <h3><?php print $current->InvoiceID; ?></h3>
                    </td>
                </tr>
                <tr class='header'>
                    <td colspan='2'>
                        <?php if ($current->InvoiceDate==0) {print $current->LastModified;} print date("F j, Y", strtotime($current->InvoiceDate)); ?>
                    </td>
                </tr>

            </table>
        </div>
        <div class="Part">
            <table id="header">
                <tr>
                    <td rowspan='4'><img width='100' src='/clients/dharristours/img/bus-logo.png'></td>
                    <td colspan='3'>
                        <h2>D HARRIS TOURS Inc.</h2>
                    </td>
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
                <div id='ticket'>
                    <div style="padding:4px;font-size:1.5em;display:flex;">
                        <div>
                            <h2 class=''><?php print $business->Business; ?></h2>
                            <div class="date"><input type="text" value="<?php print $business->AttnTo; ?>" style='width:30em; border: none;font-size:1.2em;' /></div>
                        </div>
                        <div>
                            <div class="date"><input type="text" value="<?php 
                                $addr = "";
                                if (isset($business->Address1) && preg_match("/\W/", $business->Address1)) {
                                    $addr = $business->Address1 . ', ';
                                }
                                $city = " ";
                                if (isset($business->City)) {
                                    $city = $business->City .' ';
                                }
                                print $addr . $city . $business->State . ' ' . $business->Zip; ?>" style='width:30em; border: none;font-size:1.2em;' /></div>
                            <div class="date"><input type="text" value="Voice: <?php print $business->Phone; ?> <?php print $business->Fax ? 'Fax: ' .$business->Fax : ''; ?>" style='width:30em; border: none;font-size:1.2em;' /></div>
                        </div>
                    </div>
                    <br />
                    <table id='ticket_table'>
                        <tr>
                            <td class='field'>Job ID: </td>
                            <td class='value' style='max-width: 55%; width:45%;'><?php print $job->JobID; ?></td>
                            <td class='field'>Job Date: </td>
                            <td class='value'><?php print date("m/d/Y", strtotime($job->JobDate)); ?></td>
                        </tr>
                        <tr>
                            <td class='field'>Job: </td>
                            <td class='value'><?php print $job->Job; ?></td>
                            <td class='field'>Passengers:</td>
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
                            <td><br></td>
                            <td></td>
                        </tr>
                    </table>
                    <div style='font-size:2em;padding-left:1em;'>Trip Details</div>
                    <hr style="height:1px;margin:1em 2em;border:0;background:#0006;" />
                    <table class='trips' style="margin-top:.5em;margin-left:auto;margin-right:auto;">
                        <tr>
                            <td class='field'>From:</td>
                            <td colspan='3' class='value'>
                                <?php print preg_replace("/\(?\d\d\d\)?\s*\d\d\d\-\d\d\d\d/", '', $job->PickupLocation); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class='field'>To:</td>
                            <td colspan='3' class='value'>
                                <?php print preg_replace("/\(?\d\d\d\)?\s*\d\d\d\-\d\d\d\d/", '', $job->DropOffLocation); ?>
                            </td>
                        </tr>
                        <?php 
               if (preg_match("/\w/", $job->FinalDropOffLocation)) {
            ?><tr>
                            <td class='field'>Final:</td>
                            <td colspan='3' class='value'>
                                <?php print preg_replace("/\(?\d\d\d\)?\s*\d\d\d\-\d\d\d\d/", '', $job->FinalDropOffLocation); ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                    <br>
                    <div style='font-size:2em;padding-left:1em;'>Payment Details</div>
                    <hr style="height:1px;margin:1em 2em;border:0;background:#0006;" />
                    <table class='trips' style='width:6in;margin-top:.5em;'>
                        <tr>
                            <td></td>
                            <td class='field' style='border-bottom:1px solid #ccc;text-align:center;'>Requested</td>
                            <td></td>
                            <td class='field' style='text-align:center; border-bottom:1px solid #ccc;'>Recorded</td>
                            <td rowspan='10'>&nbsp;&nbsp;</td>
                        </tr>
                        <tr>
                            <td class='field' style='width:10em;'>Pickup: </td>
                            <td class='value'><?php 
               print date("g:ia", strtotime($job->PickupTime));
               ?></td>
                            <td class='field'></td>
                            <td class='value'><?php 
                  if ($job->JobStartTime) {
                     print date("g:ia", strtotime($trip->Trip[0]->JobStartTime)); 
                  } else {
                     print date("g:ia", strtotime($current->StartTime)); 
                  }
                  ?></td>
                        </tr>
                        <tr>
                            <td class='field'>Dropoff: </td>
                            <td class='value'><?php 
                     print date("g:ia", strtotime($job->DropOffTime));
               ?></td>
                            <td class='field'></td>
                            <td class='value'><?php 
                  if ($job->JobEndTime) {
                     print date("g:ia", strtotime($trip->Trip[0]->JobEndTime));
                  } else {
                     print date("g:ia", strtotime($current->EndTime)); 
                  } 
               ?></td>
                        </tr>
                        <tr>
                            <td class='field'>Hours:</td>
                            <td class='value' style='border-top:1px solid #ccc;'>
                                <?php print sprintf("%.01f", $job->Hours); ?></td>
                            <td class='field'></td>
                            <td class='value' style='border-top:1px solid #ccc;'>
                                <?php if ($current->BillableHours==0) { print $job->Hours;} else { print sprintf("%.01f", $current->BillableHours); } ?>
                            </td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>
                    </table>
                    <table class='trips' style='width:6in;'>
                        <tr>
                            <td class='field'>Quote:</td>
                            <td class='value'>$<?php print $job->QuoteAmount; ?></td>
                            <td class='field'>Additional hours:</td>
                            <td class='value'>
                                <?php if ($current->BillableHours<=$job->Hours) {print "0.0";} else { print $current->BillableHours-$job->Hours; }?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"><br />
                            <td>
                        </tr>
                    </table>
                    <table class='trips'>
                        <tr>
                            <td class='field' style='border-right:0px solid #333;width:4.5em;' rowspan='6'>Notes</td>
                            <td rowspan='6'
                                style='vertical-align:top;width:22em;border:1px solid #eee;border-radius:2em;height:fit-content;overflow:visible;'
                                class='value'><textarea
                                    style='width:4in;height:fit-content;border:0px;'><?php print preg_replace("/\-\-.*/", "", preg_replace("/[,]/", "<br>\n", $current->Description)); ?></textarea>
                                <?php 
                                if ($current->Balance == 0) { 
                                    print "<div class='paid'>PAID</div>"; 
                                } else {
                                    print "<div class='due'> - DUE - </div>";
                                } 
                                ?>
                            </td>
                            <td class='field'>Overtime Charge:</td>
                            <td class='value right'>
                                $<?php if ($current->InvoiceAmt<=$job->QuoteAmount) {print "0.00";} else { print $current->InvoiceAmt-$job->QuoteAmount-$current->Gas-$current->MiscCost;} ?>
                            </td>
                        </tr>
                        <tr>
                            <td class='field'>Gas:</td>
                            <td class='value right'>$<?php printf("%.02f", $current->Gas); ?></td>
                        </tr>
                        <tr>
                            <td class='field'>Misc Cost:</td>
                            <td class='value right'>$<?php printf("%.02f", $current->MiscCost); ?></td>
                        </tr>
                        <tr>
                            <td class='field' style='white-space:nowrap;font-weight: bold; font-size:12pt'>Invoice
                                Amount:</td>
                            <td class='value right' style='font-weight: bold; font-size:12pt'>
                                $<?php if ($current->InvoiceAmt==0) { print number_format($job->QuoteAmount, 2);} else { print number_format($current->InvoiceAmt, 2); }?>
                            </td>
                        </tr>
                        <tr>
                            <td class='field' style='white-space:nowrap;font-weight: bold; font-size:12pt'>Paid Amount:
                            </td>
                            <td class='value right' style='font-weight: bold; font-size:12pt'>
                                $<?php print number_format($current->PaidAmt, 2); ?></td>
                        </tr>
                        <tr>
                            <td class='field' style='white-space:nowrap;font-weight: bold; font-size:12pt'>Balance DUE:
                            </td>
                            <td class='value right' style='font-weight: bold; font-size:12pt'>
                                $<?php print number_format($current->Balance, 2); ?></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <hr>
                                <table class="disclaimer" style="font-size:10px;width:100%;border-collapse:collapse;">
                                    <tr>
                                        <td style="vertical-align:top;white-space:nowrap;"><b>Cancellation Policy</b>
                                        </td>
                                        <td><span>There is a cancellation charge of $650 per bus if your confirmed
                                                reservation is not cancelled 7 days prior to spot time. Full charge if
                                                not cancelled 72 hours prior except for sports tournaments. There is no
                                                charge for cancellation due to weather if notified by 4pm the day prior
                                                to the confirmed trip.</span></td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:top;"><b>Late Payment</b></td>
                                        <td><span>10% monthly fee will be added to any invoice 30 days past due.</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                <h2 style='text-align:center;margin-top:1rem;'>Thank you for your business!</h2>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"
        integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <svg xmlns="http://www.w3.org/2000/svg">
        <filter style="color-interpolation-filters:sRGB;" id="spatter" x="-20%" y="-20%" width="140%" height="140%"
            filterUnits="objectBoundingBox" primitiveUnits="userSpaceOnUse">
            <feTurbulence type="fractalNoise" baseFrequency="24.1722 18.2119" numOctaves="5" seed="60"
                result="turbulence" id="feTurbulence111"></feTurbulence>
            <feComposite in="SourceGraphic" in2="turbulence" operator="in" result="composite1" id="feComposite111">
            </feComposite>
            <feColorMatrix values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 0 0 0 3.86 -1 " result="color" id="feColorMatrix111"
                in="composite1"></feColorMatrix>
            <feFlood flood-color="rgb(255,255,255)" result="flood" id="feFlood111" style="flood-opacity: 0;"></feFlood>
            <feMerge result="merge" id="feMerge112">
                <feMergeNode in="flood" id="feMergeNode111"></feMergeNode>
                <feMergeNode in="color" id="feMergeNode112"></feMergeNode>
            </feMerge>
            <feComposite in2="SourceGraphic" operator="in" result="composite2" id="feComposite112" in="merge">
            </feComposite>
        </filter>
    </svg>
</body>

</html>