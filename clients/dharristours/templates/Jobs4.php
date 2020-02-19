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
//	$('#mygrid').trigger('reloadGrid');
      doSelect(id,handleEndTime);
      var stimes = getTimes(simpleConfig.record["PickupTime"]);
      $("#Pickup_hour").val(stimes[0]);
      $("#Pickup_minute").val(stimes[1]);
      $("#Pickup_meridian").val(stimes[2]);

      var etimes = getTimes(simpleConfig.record["DropOffTime"]);
      $("#DropOff_hour").val(etimes[0]);
      $("#DropOff_minute").val(etimes[1]);
      $("#DropOff_meridian").val(etimes[2]);
      doDistance();
   }
//  {Select: function(id) { upAll(id); }, "New": function() { myNew(); }} 
   function myNew() {
      doNew();
      doDistance();
      handleEndTime();
      
      $("#Pickup_hour").val("");
      $("#Pickup_minute").val("");
      $("#Pickup_meridian").val("");

      $("#DropOff_hour").val("");
      $("#DropOff_minute").val("");
      $("#DropOff_meridian").val("");
      
   }

   function getTimes(mytime) {
       var stimes = mytime.split(/:/);
       stimes[0] = stimes[0].replace(/^0/, '');
       stimes[1] = stimes[1].replace(/^0/, '');

       if (stimes[0] > 12) {
           stimes[0] = parseInt(stimes[0]) - 12;
           stimes[2] = 12;
       } else {
           stimes[2] = "00";
       }
       //         if (stimes[0] < 10) stimes[0] = '0'+stimes[0];
       //         if (stimes[1] < 10) stimes[1] = '0'+stimes[1];
       return stimes;
   }

   function updateTime(who, doend) {
      var hr12 = $("#" + who + "_hour").val(),
           mins = $("#" + who + "_minute").val(),
          merid = $("#" + who + "_meridian").val(),
           hr24 = parseInt(hr12) + parseInt(merid),
         mytime = hr24 + ':' + mins + ':00';
       
      $("#" + who + "Time").val(mytime);
 	   simpleConfig.record[who + "Time"] = mytime;
      $('#mygrid').setCell(simpleConfig.rowid, who + "Time", $("#" + who + "Time").val(), 'modified');
      
      if (doend) {
         if ($("#RoundTrip").val()==1) {
            updateEndTime(hr12, mins, merid);
	      }
      }
      updateTimeDiffinHours(who, mytime);
   }

   function updateEndTime(hour, min, xd) {
      var who = 'DropOff',
          mer = xd,
      ehour24 = parseInt(hour) + 4 + parseInt(mer),
        ehour12 = ehour24;

      if (parseInt(ehour12) > 23) {
         mer = '00';
         ehour12 -= 24;
	      ehour24 -= 24;
      }
      if (parseInt(ehour12) > 11) {
         mer = '12';
         ehour12 -= 12;
      }

      if (parseInt(ehour12 == 12)) {
         ehour12 = '0';
      }
      jQuery("#" + who + '_hour').val(ehour12);
      jQuery("#" + who + '_minute').val(min);
      jQuery("#" + who + '_meridian').val(mer);

      var mytime = ehour24 + ':' + min + ':00';
      $("#" + who + "Time").val(mytime);
 	   simpleConfig.record[who + "Time"] = mytime;
      $('#mygrid').setCell(simpleConfig.rowid, who + "Time", $("#" + who + "Time").val(), 'modified');
   }
   
   function getTime(who) {
       var out = {
                  "hour": jQuery("#" + who + "_hour").val(),
                  "minute": jQuery("#" + who + "_minute").val(),
                  "meridian": jQuery("#" + who + "_meridian").val()
               };
       return out;
   }

   function updateTimeDiffinHours(who, mytime) {
       var starthr = jQuery("#Pickup_hour").val();
       var startmer = jQuery("#Pickup_meridian").val();
       var startmin = jQuery("#Pickup_minute").val();
       
       var endhr = jQuery("#DropOff_hour").val();
       var endmin = jQuery("#DropOff_minute").val();
       var endmer = jQuery("#DropOff_meridian").val();

       starthr = parseInt(starthr) + parseInt(startmer);
       var starthrmin = starthr * 60 + parseInt(startmin);
       endhr = parseInt(endhr) + parseInt(endmer);
       var endhrmin = endhr * 60 + parseInt(endmin);

       if ((parseInt(endhrmin) - parseInt(starthrmin)) < 240) {
           jQuery("#Hours").val(4);
       } else {
           jQuery("#Hours").val((parseInt(endhrmin) - parseInt(starthrmin)) / 60);
       }

      $('#mygrid').setCell(simpleConfig.rowid, "Hours", $("#Hours").val(), 'modified');
   }

   function handleEndTime() {

         $("#endspan").show();
      if ( $("#RoundTrip").val() == 0) {
         $("#endspan").hide();
      } else {
         $("#endspan").show();
      }
   }

   function ToggleEndTime() {
	if ($("#RoundTrip").val()==0) {
	   $("#endspan").hide("slow");
	   $("#DropOffTime").val('00:00:00');
	   $("#FinalDropOffLocation").val('One Way Xfer');
	} else {
	   $("#endspan").show(2000);
	   updateTime('Pickup',true);
	}
   }
</script>
<div class='tableGroup'>
   <div class='formHeading'>
      Job ID: <?php print $current->JobID; ?>
   </div>
   <div id="customButtons">
      <div id='mbtnWrap'><a id='MoreButton' rel='More' title='Tools to interact with your data' class='simpleButton buttonMenu'><span class='ui-icon ui-icon-plusthick'> </span>More...<span class='menuButton ui-icon ui-icon-triangle-1-s'> </span></a>
         <div id="MoreMenu" class='menu toolsMenu'>
            <ul>
               <li class='calcDistance disabled' onclick='doDistance();'><span class='ui-icon ui-icon-calculator'></span> Calculate Trip</li>
               <li class='disabled' onclick='getDirections();'><span class='ui-icon ui-icon-calculator'></span> Get Directions</li>
               <li class='divider'><hr /></li>
               <li id='createInvoiceButton' class='disabled' onclick='return openWin("<?php print $boss->app->Assets; ?>/templates/JobToInvoice.php?ID="+simpleConfig.id, "btnInvWin")'><span class='ui-icon ui-icon-document'></span> Create Invoice</li>
               <li class='divider'><hr /></li>
               <li id='driverLogButton' class='disabled' onclick='return openWin("<?php print $boss->app->Assets; ?>/templates/DriverLog.php?ID="+simpleConfig.id, "_blank","height=750,width=840,modal=yes,alwaysRaised=yes,toolbar=no,status=no,location=no")'><span class='ui-icon ui-icon-clipboard'></span> Print Driver Log</li>
               <li id='confirmButton' class='disabled' onclick='return openWin("<?php print $boss->app->Assets; ?>/templates/Confirmation.php?ID="+simpleConfig.id, "btnConfWin")'><span class='ui-icon ui-icon-print'></span> Print Confirmation</li>
               <li id='subLog' class='disabled' onclick='openWin("<?php print $boss->app->Assets; ?>/templates/DriverLogExternal.php?ID="+simpleConfig.id, "btnLogWin")'><span class='ui-icon ui-icon-document-b'></span> Print Sub Log</li>
            </ul>
         </div>
      </div>
   </div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Job: </span><input type='text' name='Job[<?php print $current->JobID; ?>][Job]' id='Job' value='<?php print $current->Job; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Date: </span><input type='text' name='Job[<?php print $current->JobID; ?>][JobDate]' id='JobDate' value='<?php print $current->JobDate; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><span class='fieldLabel'>Business: </span><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist();print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "Job[".$current->JobID."][BusinessID]");?></div>
         <div class='contentField'><span class='fieldLabel'>Cust PO: </span><input type='text' name='Job[<?php print $current->JobID; ?>][BusinessLocation]' id='BusinessLocation' value='<?php print $current->BusinessLocation; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Description: </span><input type='text' name='Job[<?php print $current->JobID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Num Pax: </span><input type='text' name='Job[<?php print $current->JobID; ?>][NumberOfItems]' id='NumberOfItems' value='<?php print $current->NumberOfItems; ?>' size='11' class='boxValue' /></div>
         <div class='contentField'><label>SPAB: </label><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][SPAB]' id='SPAB' default=1><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Wheel Chair: </label><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][WheelChair]' id='WheelChair' default=0><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Round Trip: </label><select dbtype='tinyint(1)' onchange="ToggleEndTime()" name='Job[<?php print $current->JobID; ?>][RoundTrip]' id='RoundTrip' default=1><option value='0'>No</option><option value='1'>Yes</option></select></div>
	 <div class='contentField'><label>Start Time: </label>
	 <select id='Pickup_hour' onchange="updateTime('Pickup', true);">
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
               <select id='Pickup_minute' onchange="updateTime('Pickup', true);">
                  <option>00</option>
                  <option>15</option>
                  <option>30</option>
                  <option>45</option>
               </select>
               <select id='Pickup_meridian' onchange="updateTime('Pickup', true);">
                  <option value='00'>am</option>
                  <option value='12'>pm</option>
               </select>
               <input type="hidden" rel="data" onchange='doModify($(this))' id='PickupTime' name='Job[<?php print $current->JobID; ?>][PickupTime]' value='<?php print $current->PickupTime; ?>'></input>
            </div>
	 <span class='contentField' id='endspan'><label>End Time: </label>
	 <select id='DropOff_hour' onchange="updateTime('DropOff');">
                  <option value=''></option>
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
               <select id='DropOff_minute' onchange="updateTime('DropOff');">
                  <option value=''></option>
                  <option>00</option>
                  <option>15</option>
                  <option>30</option>
                  <option>45</option>
               </select>
               <select id='DropOff_meridian' onchange="updateTime('DropOff');">
                  <option value=''></option>
                  <option value='00'>am</option>
                  <option value='12'>pm</option>
               </select>
               <input type="hidden" rel="data" onchange='doModify($(this))' id='DropOffTime' name='Job[<?php print $current->JobID; ?>][DropOffTime]' value='<?php print $current->DropOffTime; ?>'></input>
            </span>

         <div class='contentField'><span class='fieldLabel'>Hours: </span><input type='text' name='Job[<?php print $current->JobID; ?>][Hours]' id='Hours' value='<?php print $current->Hours; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Quote Amount: $</span><input type='text' name='Job[<?php print $current->JobID; ?>][QuoteAmount]' id='QuoteAmount' value='<?php print $current->QuoteAmount; ?>' size='25' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Travel Time 1-way: </span><span id='travelTime'></span></div>
         <div class='contentField'><span class='fieldLabel'>Pickup <img src='/img/map_icon.png' width='28' height='28' class='simpleButton mapButton' style='float:right;' onclick="return showMap($('#PickupLocation').val(), 'Pickup Address');" /> </span><input type='text' name='Job[<?php print $current->JobID; ?>][PickupLocation]' id='PickupLocation' value='<?php print $current->PickupLocation; ?>' size='50' class='boxValue' onchange='' /></div>
         <div class='contentField'><span class='fieldLabel'>Drop <img src='/img/map_icon.png' width='28' height='28' class='simpleButton mapButton' style='float:right;' onclick="return showMap($('#DropOffLocation').val(), 'Drop Off Address');" /></span><input type='text' name='Job[<?php print $current->JobID; ?>][DropOffLocation]' id='DropOffLocation' value='<?php print $current->DropOffLocation; ?>' size='50' class='boxValue' onchange='' /></div>
         <div class='contentField'><span class='fieldLabel'>Final Drop: </span><input type='text' name='Job[<?php print $current->JobID; ?>][FinalDropOffLocation]' id='FinalDropOffLocation' value='<?php print $current->FinalDropOffLocation; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Employee: </span><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist("Active=1");print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "Job[$current->JobID][EmployeeID]");?></div>
         <div class='contentField'><span class='fieldLabel'>Bus: </span><?php $boss->db->addResource("Bus");$arr = $boss->db->Bus->getlist();print $boss->utility->buildSelect($arr, $current->BusID, "BusID", "Bus", "Job[".$current->JobID."][BusID]");?></div>
         <div class='contentField'><span class='fieldLabel'>Driver Instructions: </span><input type='text' name='Job[<?php print $current->JobID; ?>][SpecialInstructions]' id='SpecialInstructions' value='<?php print $current->SpecialInstructions; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Contact: </span><input type='text' name='Job[<?php print $current->JobID; ?>][ContactName]' id='ContactName' value='<?php print $current->ContactName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Phone</span><input type='text' name='Job[<?php print $current->JobID; ?>][ContactPhone]' id='ContactPhone' value='<?php print $current->ContactPhone; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Email(Notify): </span><input type='text' name='Job[<?php print $current->JobID; ?>][ContactEmail]' id='ContactEmail' value='<?php print $current->ContactEmail; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Quote ID: </span><input type='text'  name='Job[<?php print $current->JobID; ?>][QuoteID]' id='QuoteID' value='<?php print $current->QuoteID; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Confirmed: </label><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][Confirmed]' id='Confirmed'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Trip Completed: </label><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][JobCompleted]' id='JobCompleted'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Job Cancelled: </label><select dbtype='tinyint(4)' name='Job[<?php print $current->JobID; ?>][JobCancelled]' id='JobCancelled'><option value='0'>No</option><option value='1'>Yes</option></select></div>
      </span>
      <div class='contentField'><span class='fieldLabel'>Private Notes: </span><textarea name='Job[<?php print $current->JobID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
   </div>
</div>
