<script language='Javascript' type='text/javascript'>
   $(function() {
      $(".calcDistance").click(function(e) {
         doDistance();
      });
   });

   function doDistance() {
      $("#travelTime").html("");
      $.getJSON("/tools/distance.php?origin=" + encodeURI(simpleConfig.record['PickupLocation']) + "&dest=" + encodeURI(simpleConfig.record["DropOffLocation"]) + "&mode=driving&language=en-US&sensor=false", 
         function(data) {
            $("#travelTime").html( 
               data.rows[0]['elements'][0].distance.text + " / " + 
               data.rows[0]['elements'][0].duration.text
            );
         }
      );
      return false;
   }

   var userEmail = '<?php print htmlspecialchars($_SESSION['Email'], ENT_QUOTES); ?>';

   function upAll(id) {
      doSelect(id,handleDropOffTime);
	   var stimes = getTimes(simpleConfig.record["PickupTime"]);
      $("#Start_hour").val(stimes[0]);
      $("#Start_minute").val(stimes[1]);
      $("#Start_meridian").val(stimes[2]);

      var etimes = getTimes(simpleConfig.record["DropOffTime"]);
      $("#End_hour").val(etimes[0]);
      $("#End_minute").val(etimes[1]);
      $("#End_meridian").val(etimes[2]);
      doDistance();
   }

   function getTimes(mytime) {
       var stimes = mytime.split(/:/);
       stimes[0] = stimes[0].replace(/^0/, '');
       stimes[1] = stimes[1].replace(/^0/, '');

       if (stimes[0] > 12) {
           stimes[0] = parseInt(stimes[0]) - 12;
           stimes[2] = 12;
       } else {
           stimes[2] = 00;
       }
       //         if (stimes[0] < 10) stimes[0] = '0'+stimes[0];
       //         if (stimes[1] < 10) stimes[1] = '0'+stimes[1];
       return stimes;
   }

   function updateTime(who, doend) {
       var hr12 = $("#" + who + "_hour").val();
       hr12 = hr12.replace(/^0/, '');
       var merid = $("#" + who + "_meridian").val();
       hr12 = parseInt(hr12) + parseInt(merid);
       var mytime = hr12 + ':' + jQuery("#" + who + "_minute").val() + ':00';
       if (who == "Start") {
	       $("#PickupTime").val(mytime);
       } else {
	       $("#DropOffTime").val(mytime);
       }

       if (doend) {
         if ($("#"+"RoundTrip").val()==1) {
           updateDropOffTime(jQuery("#" + who + "_hour").val(), jQuery("#" + who + "_minute").val(), jQuery("#" + who + "_meridian").val());
	 }
       }
       updateTimeDiffinHours(who, mytime);
   }

   function updateDropOffTime(hour, min, xd) {
       var who = 'End';
       var mer = xd;
       var ehour = parseInt(hour) + 4 + parseInt(mer);
       if (parseInt(ehour) > 23) {
           mer = '00';
           ehour -= 24;
       }
       if (parseInt(ehour) > 11) {
           mer = '12';
           ehour -= 12;
       }
       hour = ehour;
       if (parseInt(ehour == 12)) {
           ehour = '00';
       }
       jQuery("#" + who + '_hour').val(ehour);
       jQuery("#" + who + '_minute').val(min);
       jQuery("#" + who + '_meridian').val(mer);
       //jQuery("#Description").val(ehour);
       var mytime = hour + ':' + jQuery("#" + who + "_minute").val() + ':00';
       if (who == "start") {
	       $("#PickupTime").val(mytime);
       } else {
	       $("#DropOffTime").val(mytime);
       }
   }

   function updateTimeDiffinHours(who, mytime) {
       var starthr = jQuery("#Start_hour").val();
       var endhr = jQuery("#End_hour").val();
       var startmer = jQuery("#Start_meridian").val();
       var endmer = jQuery("#End_meridian").val();
       var startmin = jQuery("#Start_minute").val();
       var endmin = jQuery("#End_minute").val();

       starthr = parseInt(starthr) + parseInt(startmer);
       var starthrmin = starthr * 60 + parseInt(startmin);
       endhr = parseInt(endhr) + parseInt(endmer);
       var endhrmin = endhr * 60 + parseInt(endmin);

       if ((parseInt(endhrmin) - parseInt(starthrmin)) < 240) {
           jQuery("#Hours").val(4);
       } else {
           jQuery("#Hours").val((parseInt(endhrmin) - parseInt(starthrmin)) / 60);
       }

   }

   function handleDropOffTime() {
      if ( $("#RoundTrip").val() == 0) {
         $("#endspan").hide();
      } else {
         $("#endspan").show();
      }
   }

   function ToggleDropOffTime() {
	if ($("#RoundTrip").val()==0) {
	   $("#endspan").hide("slow");
	   $("#DropOffTime").val('00:00:00');
	} else {
	   $("#endspan").show(2000);
	   updateTime('Start',true);
	}
   }

function sendEmail() {
   	$("#sendEmail").val("Updated");
      $.get("/grid/ctl.php?pid="+simpleConfig.pid+"&id="+simpleConfig.id+"&sendEmail=Updated", function(data) {});
   }

</script>
<div class='tableGroup'>
   <div class='formHeading'>
      Job ID: <?php print $current->JobID; ?>
   </div>
   <span id="customButtons">
      <a name='calculateDistance' class='calcDistance simpleButton disabled' onclick='doDistance();'><span class='ui-icon ui-icon-wrench'></span>Calculate Trip</a>
      <a name='createInvoiceButton' class='simpleButton disabled' onclick='return openWin("<?php print $boss->app->Assets; ?>/templates/JobToInvoice.php?ID="+simpleConfig.id, "btnInvWin")'><span class='ui-icon ui-icon-print'></span> Create Invoice</a>
      <a name='driverLogButton' class='simpleButton disabled' onclick='return openWin("<?php print $boss->app->Assets; ?>/templates/DriverLog.php?ID="+simpleConfig.id, "btnJobWin")'><span class='ui-icon ui-icon-print'></span> Print Driver Log</a>
      <a name='confirmButton' class='simpleButton disabled' onclick='return openWin("<?php print $boss->app->Assets; ?>/templates/Confirmation.php?ID="+simpleConfig.id, "btnConfWin")'><span class='ui-icon ui-icon-print'></span> Print Confirmation</a>
      <a name='subLog' class='simpleButton disabled' onclick='openWin("<?php print $boss->app->Assets; ?>/templates/DriverLogExternal.php?ID="+simpleConfig.id, "btnLogWin")'><span class='ui-icon ui-icon-print'></span> Print Sub Log</a>
   </span>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Job: </span><input type='text' name='Job[<?php print $current->JobID; ?>][Job]' id='Job' value='<?php print $current->Job; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Job Date: </span><input type='text' name='Job[<?php print $current->JobID; ?>][JobDate]' id='JobDate' value='<?php print $current->JobDate; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><span class='fieldLabel'>Business: </span><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist();print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "Job[".$current->JobID."][BusinessID]");?></div>
         <div class='contentField'><span class='fieldLabel'>Business Location: </span><input type='text' name='Job[<?php print $current->JobID; ?>][BusinessLocation]' id='BusinessLocation' value='<?php print $current->BusinessLocation; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Contact: </span><input type='text' name='Job[<?php print $current->JobID; ?>][ContactName]' id='ContactName' value='<?php print $current->ContactName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Phone</span><input type='text' name='Job[<?php print $current->JobID; ?>][ContactPhone]' id='ContactPhone' value='<?php print $current->ContactPhone; ?>' size='25' class='boxValue' /></div>
	 <div class='contentField'><label>Start Time: </label>
	 <select id='Start_hour' onchange="updateTime('Start', true);">
                  <option value='1'>01</option>
                  <option value='2'>02</option>
                  <option value='3'>03</option>
                  <option value='4'>04</option>
                  <option value='5'>05</option>
                  <option value='6'>06</option>
                  <option value='7'>07</option>
                  <option value='8'>08</option>
                  <option value='9'>09</option>
                  <option value='10'>10</option>
                  <option value='11'>11</option>
                  <option value='0'>12</option>
               </select> :
               <select id='Start_minute' onchange="updateTime('Start', true);">
                  <option>00</option>
                  <option>15</option>
                  <option>30</option>
                  <option>45</option>
               </select>
               <select id='Start_meridian' onchange="updateTime('Start', true);">
                  <option value='00'>am</option>
                  <option value='12'>pm</option>
               </select>
               <input type="hidden" id='PickupTime' name='Job[<?php print $current->JobID; ?>][PickupTime]' value='<?php print $current->PickupTime; ?>'></input>
            </div>

	 <span class='contentField' id='endspan'><label>End Time: </label>
	 <select id='End_hour' onchange="updateTime('End');">
                  <option value='1'>01</option>
                  <option value='2'>02</option>
                  <option value='3'>03</option>
                  <option value='4'>04</option>
                  <option value='5'>05</option>
                  <option value='6'>06</option>
                  <option value='7'>07</option>
                  <option value='8'>08</option>
                  <option value='9'>09</option>
                  <option value='10'>10</option>
                  <option value='11'>11</option>
                  <option value='0'>12</option>
               </select> :
               <select id='End_minute' onchange="updateTime('End');">
                  <option>00</option>
                  <option>15</option>
                  <option>30</option>
                  <option>45</option>
               </select>
               <select id='End_meridian' onchange="updateTime('End');">
                  <option value='00'>am</option>
                  <option value='12'>pm</option>
               </select>
               <input type="hidden" id='DropOffTime' name='Job[<?php print $current->JobID; ?>][DropOffTime]' value='<?php print $current->DropOffTime; ?>'></input>
            </span>

         <div class='contentField'><span class='fieldLabel'>Hours: </span><input type='text' name='Job[<?php print $current->JobID; ?>][Hours]' id='Hours' value='<?php print $current->Hours; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Num Pax: </span><input type='text' name='Job[<?php print $current->JobID; ?>][NumberOfItems]' id='NumberOfItems' value='<?php print $current->NumberOfItems; ?>' size='11' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><label>Round Trip: </label><select dbtype='tinyint(1)' onchange="ToggleDropOffTime()" name='Job[<?php print $current->JobID; ?>][RoundTrip]' id='RoundTrip' default=1><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><span class='fieldLabel'>Pickup <img src='/img/map_icon.png' width='28' height='28' class='simpleButton mapButton' style='float:right;' onclick="return showMap($('#PickupLocation').val(), 'Pickup Address');" /> </span><input type='text' name='Job[<?php print $current->JobID; ?>][PickupLocation]' id='PickupLocation' value='<?php print $current->PickupLocation; ?>' size='50' class='boxValue' onchange='' /></div>
         <div class='contentField'><span class='fieldLabel'>Drop <img src='/img/map_icon.png' width='28' height='28' class='simpleButton mapButton' style='float:right;' onclick="return showMap($('#DropOffLocation').val(), 'Drop Off Address');" /></span><input type='text' name='Job[<?php print $current->JobID; ?>][DropOffLocation]' id='DropOffLocation' value='<?php print $current->DropOffLocation; ?>' size='50' class='boxValue' onchange='' /></div>
         <div class='contentField'><span class='fieldLabel' id='travellabel'>One way: </span><span id='travelTime' ></span></div>
         <div class='contentField'><span class='fieldLabel'>Final Drop: </span><input type='text' name='Job[<?php print $current->JobID; ?>][FinalDropOffLocation]' id='FinalDropOffLocation' value='<?php print $current->FinalDropOffLocation; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Bus: </span><?php $boss->db->addResource("Bus");$arr = $boss->db->Bus->getlist();print $boss->utility->buildSelect($arr, $current->BusID, "BusID", "Bus", "Job[".$current->JobID."][BusID]");?></div>
         <div class='contentField'><span class='fieldLabel'>Description: </span><input type='text' name='Job[<?php print $current->JobID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Special Instructions: </span><input type='text' name='Job[<?php print $current->JobID; ?>][SpecialInstructions]' id='SpecialInstructions' value='<?php print $current->SpecialInstructions; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Quote ID: </span><input type='text'  name='Job[<?php print $current->JobID; ?>][QuoteID]' id='QuoteID' value='<?php print $current->QuoteID; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Quote Amount: $</span><input type='text' name='Job[<?php print $current->JobID; ?>][QuoteAmount]' id='QuoteAmount' value='<?php print $current->QuoteAmount; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>SPAB: </label><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][SPAB]' id='SPAB'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Confirmed: </label><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][Confirmed]' id='Confirmed'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Trip Completed: </label><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][JobCompleted]' id='JobCompleted'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Job Cancelled: </label><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][JobCancelled]' id='JobCancelled'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><span class='fieldLabel'>Employee: </span><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist("Active=1");print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "Job[$current->JobID][EmployeeID]");?></div>
      </span>
      <div class='contentField'><span class='fieldLabel'>Private Notes: </span><textarea name='Job[<?php print $current->JobID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
   </div>
</div>
