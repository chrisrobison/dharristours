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
<!DOCTYPE html>
<html>
<head>
    <link type="text/css" href="https://fonts.googleapis.com/css?family=Quicksand:400,700" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,700;1,400&display=swap" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        /*<![CDATA[*/
        body {
            background-color: filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f0f0f0', endColorstr='#b0b0b0');
            background: -webkit-gradient(linear, left top, left bottom, from(#f0f0f0), to(#b0b0b0));
            background: -moz-linear-gradient(top, #f0f0f0, #b0b0b0);
            font-size: 12pt;
            color: black;
            font-family: "Open Sans", "Helvetica Neue", Verdana, sans-serif;
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

        P {
            text-align: justify;
            margin: 0 28px 0 0;
            text-indent: 0px;
            line-: 20px
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
            font-size: 12pt;
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
            right: 22px;
            width: 2in;
            height: 1.4in;
            border: solid 1px #000000;
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
            font-size: 1.1em;
        }

        #main {
            background: none repeat scroll 0 0 #FFFFFF;
            height: 10in;
            margin: 1px auto;
            padding: 22px 22px 0px 22px;
            position: relative;
            width: 7.5in;
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
            /* height:4in;*/
            width: 7.0in;
            padding: .125in;
            position: relative;
            border-radius: 15px;
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
        }

        h2 {
            margin: 0px;
            font-size: 18pt;
            font-weight: bold;
        }

        .big {
            font-size: 18pt;
        }

        div.date {
            font-size: 1.2em;
            display: inline-block;
            font-weight: bold;
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
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
        }

        #stats td {
            border: 0px solid #000000;
            padding-bottom: 0.5em;
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

        #ticket_table {
            width: 7in;
        }

        #ticket_table td {
            padding: 0px 5px;
            vertical-align: top
        }

        td.field {
            text-align: right;
            font-weight: bold;
        }

        td.value {
            text-align: left;
            font-weight: normal;
        }

        .line {
            display: inline-block;
            width: 3em;
            border-bottom: 1px solid #000;
            height: 1.5em;
            margin-left: .25em;
            margin-right: .25em;
        }

        .pax {
            width: 2em;
        }

        .miles {
            width: 9em;
        }

        .checkbox {
            display: inline-block;
            height: 1.2em;
            width: 1.2em;
            border: 1px solid #000;
        }

        .checklist {
            margin: .5em auto .5em auto;
            padding-top: .5em;
            padding-bottom: .5em;
        }

        .checklist td {
            padding-top: .25em;
            padding-bottom: .25em;
            vertical-align: top;
        }

        hr {
            border: 1px solid #000;
        }

        .other {
            display: inline-block;
            height: 5em;
            width: 5em;
            border: 1px solid #000;
        }

        table tr {
            line-height: 1.5em;
        }

        @media print {
            .pagebreak {
                page-break-before: always;
            }

            /* page-break-after works, as well */
        }

        /*]]>*/
   .alertText {
       background: rgb(153, 0, 0);
       color: rgb(255, 255, 255);
    }
    </style>
    <title>
   Drivers Trip Sheet</title>
</head>

<body>
    <div id="main" class='shadow'>
        <div id='top_overview'>
            <span class='date'>
                <?php print $current->JobDate; ?></span><br />
            <span class='time'>
                <?php 
      if (is_null($current->OnSpotTime)  || $current->OnSpotTime =='') {
         print date("g:ia", strtotime($current->PickupTime));
      } else {
         print $current->OnSpotTime; 
      }
      ?></span><br />
            <span>
                <?php print $business->Business; ?></span><br />
            <span class='pass'>Pax:
                <?php print $current->NumberOfItems; ?><br /></span>
            <span class='pass'>Bus:
                <?php print $bus->Bus; ?></span>
        </div>
        <div id='top_header'>
            <div>Driver Name: <b>
                    <?php print $driver->Employee; ?></b><br />Job Number: <b>
                    <?php print $current->JobID; ?></b></div>
            <div>Date: <b>
                    <?php print $current->JobDate; ?></b><br />Start: <b>
                    <?php  if (is_null($current->OnSpotTime)  or $current->OnSpotTime =='') {print $current->PickupTime;} print $current->OnSpotTime;  ?></b></div>
        </div>
        <div class="Part">
            <table id="header">
                <tr>
                    <td colspan='4'>
                        <h2>D Harris Tours, Inc.</h2>
                    </td>
                </tr>
                <tr>
                    <td>P.O. Box 5961, Vallejo, CA 94591</td>
                    <td>TCP 017270-B</td>
                </tr>
                <tr>
                    <td>(415) 902-8542</td>
                    <td>CA 273437</td>
                </tr>
                <tr>
                    <td>juanaharrisdht@att.net</td>
                </tr>
                <!--tr>
            <td>https://dharristours.com/</td>
         </tr-->
                <!--tr>
	   <td>juanaharrisdht@att.net</td><td>TCP 017270-B</td> <td>CA 273437</td>
	 </tr>
         <tr>
            <td>415-902-8542</td><td>PO Box 5961</td></tr>
         <tr>
            <td>800-853-4006 FAX</td><td>Vallejo CA 94591</td>
	 </tr-->
            </table>
            <br />
            <div id='ticket'>
                <div style="padding:4px; position:relative;text-align:center;">
                  <h2 class='center'>
                     DRIVER TRIP
                     <?php ($current->WheelChair == 1) ? print "<span class='alertText'>WHEELCHAIR!</span>"  : print ""; ?>
                     <?php ($current->Shuttle) ? print "<span class='alertText'>SHUTTLE</span>"  : print ""; ?>
                  </h2>
                    <div class="date center">
                        <?php print date("n/j/Y", strtotime($current->JobDate)); ?> at </div>
                    <div class="date center">
                        <?php  
               if (is_null($current->OnSpotTime) || $current->OnSpotTime =='') {
                  print date("g:ia", strtotime($current->PickupTime));
               } else {
                  print date("g:ia", strtotime($current->OnSpotTime)); 
               }
            ?>
                    </div>
                </div>
                <table id='ticket_table'>
                    <tr>
                        <td class='field' style="width:10%;">Job:</td>
                        <td class='value' style="width:90%;">
                            <?php print $current->Job; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class='field'>Spot:</td>
                        <td class='value'>15 minutes prior to start</td>

                     </tr>
                     <tr>
                        <td class='field'>Contact:</td>
                        <td class='value'>
                            <?php print $current->ContactName; ?>
                            <?php print $current->ContactPhone; ?>
                        </td>
                    </tr>

                    <tr>
                        <td class='field'>Start:</td>
                        <td class='value'>
                            <?php  if (is_null($current->OnSpotTime) || $current->OnSpotTime =='') {print date("g:ia", strtotime($current->PickupTime));} else { print date("g:ia", strtotime($current->OnSpotTime)); } ?>
                        </td>
                    </tr>
                    <tr>
                        <td class='field'>End Time:</td>
                        <td class='value'>
                            <?php print date("g:ia", strtotime($current->DropOffTime)); ?>
                        </td>
                    </tr>

                    <tr>
                        <td class='field'>1st Stop:</td>
                        <td class='value'>
                            <?php print $current->PickupLocation; ?><br /></td>
                    </tr>
                    <tr>
                        <td colspan="3"><br /></td>
                    </tr>
                    <tr>
                        <td class='field'>2nd Stop:</td>
                        <td class='value'>
                            <?php print $current->DropOffLocation; ?><br /></td>
                    </tr>
                    <tr>
                        <td colspan="3"><br /></td>
                    </tr>
                    <tr>
                        <td class='field'>3rd Stop:</td>
                        <td class='value'>
                            <?php print $current->FinalDropOffLocation; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><br /></td>
                    </tr>
                    <tr>
                        <td class='field'>Additional:</td>
                        <td class='value' colspan='3'>
                            <?php print $current->SpecialInstructions; ?><br /><br /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </div>
            <br />
            <table width="100%">
                <tr>
                    <th width=70%>Driver: <b>
                            <?php print $driver->Employee; ?></b>
                    </th>
                </tr>
            </table>
            <table>
                <tr>
                    <td>On Spot <span class='line'></span>:<span class='line'></span></td>
                    <td>Mileage: <span class='line miles'></span></td>
                    <td>PAX <span class='line pax'></span></td>
                    <td>Depart <span class='line'></span>:<span class='line'></span></td>
                </tr>
                <tr>
                    <td>Stop 1 <span class='line'></span>:<span class='line'></span></td>
                    <td>Mileage: <span class='line miles'></span></td>
                    <td>PAX <span class='line pax'></span></td>
                    <td>Depart <span class='line'></span>:<span class='line'></span></td>
                </tr>
                <tr>
                    <td>Stop 2 <span class='line'></span>:<span class='line'></span></td>
                    <td>Mileage: <span class='line miles'></span></td>
                    <td>PAX <span class='line pax'></span></td>
                    <td>Depart <span class='line'></span>:<span class='line'></span></td>
                </tr>
            </table>
            <br />
            <table width="100%">
                <tr>
                    <th width=70%><b>
                            <?php print $business->Business; ?></b>
                    </th>
                </tr>
            </table>
            <table id='sigs'>
                <tr>
                    <th width=25%>Chaperone Name</th>
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
        </div>
    </div>
    <div class='pagebreak'></div>
    <br>
    <div class='printonly'>
        <div id='main' class='shadow'>
            <div id='top_header'>
                <div>Driver Name: <b>
                        <?php print $driver->Employee; ?></b><br />Job Number: <b>
                        <?php print $current->JobID; ?></b></div>
                <div>Date: <b>
                        <?php print $current->JobDate; ?></b><br />Start: <b>
                        <?php  
            print date("g:ia", strtotime($current->PickupTime));
         ?></b></div>
            </div>
            <h3>Trip Log</h3>
            <hr>
            <table>
                <tr>
                    <td>Pre-trip Start Time: </td>
                    <td><span class='line'></span>:<span class='line'></span></td>
                    <td>Depart Yard Time: </td>
                    <td><span class='line'></span>:<span class='line'></span></td>
                    <td>Mileage: </td>
                    <td><span class='line miles'></span></td>
                </tr>
                <tr>
                  <td colspan="5"><b>CLOCK IN</b> USING PAYCHEX APP AFTER YOU COMPLETE THE PRETRIP</td>
               </tr>
            </table>
            <!-- insert dvir form here -->
            <hr>
            <h4 style='margin:0;float:right;font-weight:normal;margin-right:2em;'>Check ONLY if problems exists</h4>
            <h3 style="margin:0;">Vehicle Issue Report</h3>
            <table class='checklist'>
                <tr>
                    <td><span class='checkbox' id='air_compressor'></span> Air Compressor</td>
                    <td><span class='checkbox' id='front_axle'></span> Front Axle</td>
                    <td><span class='checkbox' id='safety_equip'></span> Safety Equipment</td>
                </tr>
                <tr>
                    <td><span class='checkbox' id='air_lines'></span> Air Lines</td>
                    <td><span class='checkbox' id='fuel_tanks'></span> Fuel Tanks</td>
                    <td class='indent'><span class='checkbox' id='fire_extinguisher'></span> Fire Extinguisher</td>
                </tr>
                <tr>
                    <td><span class='checkbox' id='battery'></span> Battery</td>
                    <td><span class='checkbox' id='horn'></span> Horn</td>
                    <td class='indent'><span class='checkbox' id='flasg_flares_fuses'></span> Flags/Flares/Fuses</td>
                </tr>
                <tr>
                    <td><span class='checkbox' id='belts_hoses'></span> Belts and Hoses</td>
                    <td><span class='checkbox' id='lights'></span> Lights</td>
                    <td class='indent'><span class='checkbox' id='reflective_triangles'></span> Reflective Triangles</td>
                </tr>
                <tr>
                    <td><span class='checkbox' id='body'></span> Body</td>
                    <td class='indent'><span class='checkbox' id='head_stop'></span> Head/Stop</td>
                    <td class='indent'><span class='checkbox' id='spare_bulb_fuses'></span> Spare Bulb and Fuses</td>
                </tr>
                <tr>
                    <td><span class='checkbox' id='brake_accessories'></span> Brake Accessories</td>
                    <td class='indent'><span class='checkbox' id='tail_dash'></span> Tail / Dash</td>
                    <td class='indent'><span class='checkbox' id='spare_seal_beam'></span> Spare Seal Beam</td>
                </tr>
                <tr>
                    <td><span class='checkbox' id='brakes_parking'></span> Brakes, Parking</td>
                    <td class='indent'><span class='checkbox' id='turn_indicators'></span> Turn Indicators</td>
                    <td><span class='checkbox' id='starter'></span> Starter</td>
                </tr>
                <tr>
                    <td><span class='checkbox' id='brakes_service'></span> Brakes, Service</td>
                    <td class='indent'><span class='checkbox' id='clearance_marker'></span> Clearance / Marker</td>
                    <td><span class='checkbox' id='steering'></span> Steering</td>
                </tr>
                <tr>
                    <td><span class='checkbox' id='clutch'></span> Clutch</td>
                    <td><span class='checkbox' id='mirrors'></span> Mirrors</td>
                    <td><span class='checkbox' id='suspension_system'></span> Suspension System</td>
                </tr>
                <tr>
                    <td><span class='checkbox' id='defroster_heater'></span> Defroster / Heater</td>
                    <td><span class='checkbox' id='muffler'></span> Muffler</td>
                    <td><span class='checkbox' id='tires'></span> Tires</td>
                </tr>
                <tr>
                    <td><span class='checkbox' id='drive_line'></span> Drive Line</td>
                    <td><span class='checkbox' id='oil_pressure'></span> Oil Pressure</td>
                    <td><span class='checkbox' id='transmission'></span> Transmission</td>
                </tr>

                <tr>
                    <td><span class='checkbox' id='engine'></span> Engine</td>
                    <td><span class='checkbox' id='radiator'></span> Radiator</td>
                    <td><span class='checkbox' id='rear_end'></span> Rear End</td>
                </tr>

                <tr>
                    <td><span class='checkbox' id='exhaust'></span> Exhaust</td>
                    <td><span class='checkbox' id='reflectors'></span> Reflectors</td>
                    <td><span class='checkbox' id='wheels_rims'></span> Wheels &amp; Rims</td>
                </tr>

                <tr>
                    <td><span class='checkbox' id='fluid_levels'></span> Fluid Levels</td>
                    <td><span class='checkbox' id='windows'></span> Windows</td>
                    <td><span class='checkbox' id='windshield_wipers'></span> Windshield Wipers</td>
                </tr>

                <tr>
                    <td><span class='checkbox' id='frame_assembly'></span> Frame &amp; Assembly</td>
                    <td></td>
                    <td><span class='checkbox' id='other'></span> Other (please describe): </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <br>
            <hr>
            <table style='width:100%;'>
                <tr>
                    <td style='text-align:right;'>Return to Yard Time: <b>CLOCK OUT</b> </td>
                    <td><span class='line'></span>:<span class='line'></span></td>
                    <td style='text-align:right;'>Mileage: </td>
                    <td><span style='width:10em;' class='line miles'></span></td>
                </tr>
                <tr>
                  <td></td>
                    <td><span class='checkbox'></span> Fuel</td>
                    <td style='text-align:right;'>Gallons:</td>
                    <td><span class='line'></span> 
                    Total: <span class='line'></span> </td>
                </tr>
                <tr><td colspan=4><hr></td></tr>
                <tr>
                    <td style='padding-left:2em;'>Comments:</td>
                    <td colspan=3></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>