<script src='/files/templates/time.js?ver=1.38' type='text/javascript' > </script>
<script type='text/javascript'>
   var userEmail = '<?php print htmlspecialchars($_SESSION['Email'], ENT_QUOTES); ?>';

   var jobdateset = false;

   setTimeout(checkJobDate, 3000);

   function checkJobDate() {
      if (jobdateset) { return true; }
      var jobdate = $("#gs_JobDate");
      var grid = $("#mygrid");
      if (grid && jobdate && jobdate[0]) {
         jobdate[0].value = new Date().toISOString().substr(0,10);
         setTimeout(function() {
            $("#mygrid")[0].triggerToolbar();
         }, 4000);
         jobdateset = true;
         return true;
      } else {
         setTimeout(checkJobDate, 4000);

      }
   }
   function makeChild() {
      var parentID = simpleConfig.id;
      doCopy(simpleConfig.id);

      document.querySelector("#NoInvoice").checked = true;
      document.querySelector("#AdditionalBus").checked = true;
      document.querySelector("#DriverNotified").checked = false;
      document.querySelector("#QuoteAmount").value = 0;
      document.querySelector("#BusID").selectedIndex = 0;
      document.querySelector("#EmployeeID").selectedIndex = 0;
      document.querySelector("#ParentID").value = parentID;
      let jobtitle = document.querySelector("#Job").value;   
      document.querySelector("#Job").value = "Bus for "+jobtitle + " ["+parentID+"]";
      document.querySelector("#ParentTitle").innerHTML = "Bus for "+jobtitle + " ["+parentID+"]";
   return false;
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
               <li id='myReportButton' class='enabled' onclick='$(".menu").slideUp(75); openWin("/apps/report.php?ReportID=20");return false'><span class='ui-icon ui-icon-clipboard'></span> Today Jobs</li>
		<li id='myReportButton' onclick='$(".menu").slideUp(75); openWin("/apps/report.php?ReportID=18"); return false;'><span class='ui-icon ui-icon-clipboard'></span> 2 Days</li>
		<li id='myReportButton' onclick='$(".menu").slideUp(75); openWin("/apps/report.php?ReportID=19"); return false;'><span class='ui-icon ui-icon-clipboard'></span> 3 Days</li>
		<li id='myReportButton' onclick='$(".menu").slideUp(75); openWin("/apps/report.php?ReportID=9"); return false;'><span class='ui-icon ui-icon-clipboard'></span> 2 Weeks</li>
		<li class='divider'><hr /></li>
		<li id='createInvoiceButton' class='disabled' onclick='$(".menu").slideUp(75); openWin("<?php print $boss->app->Assets; ?>/templates/JobToPrint.php?ID="+simpleConfig.id+"#InvoiceReport", "btnInvWin"); return false;'><span class='ui-icon ui-icon-document'></span> Invoice</li>
               <li class='divider'><hr /></li>
               <li id='driverLogButton' class='disabled' onclick='$(".menu").slideUp(75); openWin("<?php print $boss->app->Assets; ?>/templates/JobToPrint.php?ID="+simpleConfig.id+"#DriverLog", "btnDrvLog"); return false;'><span class='ui-icon ui-icon-clipboard'></span> Print Driver Log</li>
               <li id='confirmButton' class='disabled' onclick='$(".menu").slideUp(75); openWin("<?php print $boss->app->Assets; ?>/templates/JobToPrint.php?ID="+simpleConfig.id+"#Confirmation", "btnConfWin"); return false;'><span class='ui-icon ui-icon-print'></span> Print Confirmation</li>
               <li id='subLog' class='disabled' onclick='$(".menu").slideUp(75); openWin("<?php print $boss->app->Assets; ?>/templates/JobToPrint.php?ID="+simpleConfig.id+"#DriverLogExternal", "btnLogWin"); return false;'><span class='ui-icon ui-icon-document-b'></span> Print Sub Log</li>
		         <li class='divider'><hr /></li>
               <li id='subLog' onclick='$(".menu").slideUp(75); makeChild(); return false;'><span class='ui-icon ui-icon-document-b'></span> Add Bus</li>
            </ul>
         </div>
      </div>
   </div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
	<fieldset class='jobstatus' title="Tracking">
            <legend>Customer Request</legend>
               <div class='contentField'>
                  <input type='checkbox' id='QuoteOnly' name='Job[<?php print $current->JobID; ?>][QuoteOnly]' dbtype='tinyint(4)' value='1'<?php if ($current->QuoteOnly) { print " CHECKED"; } ?>>
                  <span>Quote</span>
                  <input type='checkbox' id='SPAB' name='Job[<?php print $current->JobID; ?>][SPAB]' dbtype='tinyint(4)' value='1'<?php if ($current->SPAB) { print " CHECKED"; } ?>>
                  <span>SPAB</span>
               
                  <input type='checkbox' id='WheelChair' name='Job[<?php print $current->JobID; ?>][WheelChair]' dbtype='tinyint(4)' value='1'<?php if ($current->WheelChair) { print " CHECKED"; } ?>>
                  <span>Wheel Chair</span>

                  <input type='checkbox' id='Cargo' name='Job[<?php print $current->JobID; ?>][Cargo]' dbtype='tinyint(4)' value='1'<?php if ($current->Cargo) { print " CHECKED"; } ?>>
                  <span>Cargo</span>

                  <input type='checkbox' id='Shuttle' name='Job[<?php print $current->JobID; ?>][Shuttle]' dbtype='tinyint(4)' value='0'<?php if ($current->Shuttle) { print " CHECKED"; } ?>>
                  <span>Shuttle</span>
               </div>
               <div class='contentField'>
		  <label>Job</label>
                  <input type='text' placeholder="Customer/District | School | Team | (Dest) | Misc" name='Job[<?php print $current->JobID; ?>][Job]' id='Job' value='<?php print $current->Job; ?>' size='100' style='width:25em;' class='boxValue' /> 
               </div>
               <div class='contentField'>
                  <label>Parent</label>
                  <span id="ParentTitle"></span>
                  <input type='hidden' name='Job[<?php print $current->JobID; ?>][ParentID]' id='ParentID' value='<?php print $current->ParentID; ?>' size='100' style='width:25em;' class='boxValue' /> 
               </div>
            <div class='contentField'>
	         	       	  <a href="#"  onclick="getEstPrice()" class='simpleButton'><span class="ui-icon ui-icon-calculator"></span>Estimate Price</a><span id='estPrice' class="ui-widget-content"></span>
                          <span id='priceChart' class="ui-widget-content"></span>
	         	   <a href="#" id='NoBilling' name='NoBilling' class='simpleButton'>No Billing</a>
	       </div>
	       <div class='contentField'>
                  <label>* Date</label>
                  <input type='text' name='Job[<?php print $current->JobID; ?>][JobDate]' id='JobDate' value='<?php print $current->JobDate; ?>' size='25' style='width:8em;' class='boxValue date' />
                  <label>Price</label>
                  $<input type='text' name='Job[<?php print $current->JobID; ?>][QuoteAmount]' id='QuoteAmount' value='<?php print $current->QuoteAmount; ?>' size='25' style='width:5em;'class='boxValue' />
               </div>
            <div class='contentField'><label>*Start Time</label>
               <select id='Pickup_hour' onchange="updateTime('Pickup');">
                  <option value='00'>12</option>
                  <option value='01'>01</option>
                  <option value='02'>02</option>
                  <option value='03'>03</option>
                  <option value='04'>04</option>
                  <option value='05'>05</option>
                  <option value='06'>06</option>
                  <option value='07'>07</option>
                  <option value='08'>08</option>
                  <option value='09'>09</option>
                  <option value='10'>10</option>
                  <option value='11'>11</option>
               </select> :
               <select id='Pickup_minute' onchange="updateTime('Pickup');">
                  <option value='00'>00</option>
                  <option value='15'>15</option>
                  <option value='30'>30</option>
                  <option value='45'>45</option>
               </select>
               <select id='Pickup_meridian' onchange="updateTime('Pickup');">
                  <option value='0'>am</option>
                  <option value='12'>pm</option>
               </select>
               <input type="hidden" rel="data" onchange='doModify($(this))' id='PickupTime' name='Job[<?php print $current->JobID; ?>][PickupTime]' value='<?php print $current->PickupTime; ?>'></input>
               <span>Round Trip</span>
		<select id='RoundTrip' name='Job[<?php print $current->JobID; ?>][RoundTrip]' dbtype='tinyint(1)' rel='RoundTrip' onchange="return showEnd(this.value)" >
                <option value="1" selected>Yes</option>
		                <option value="0">No</option>
				                </select>
            </div>
               <span class='contentField' id='endspan'><label>End Time</label>
               <select id='DropOff_hour' onchange="updateTime('DropOff');">
                  <option value='00'>12</option>
                  <option value='01'>01</option>
                  <option value='02'>02</option>
                  <option value='03'>03</option>
                  <option value='04'>04</option>
                  <option value='05'>05</option>
                  <option value='06'>06</option>
                  <option value='07'>07</option>
                  <option value='08'>08</option>
                  <option value='09'>09</option>
                  <option value='10'>10</option>
                  <option value='11'>11</option>
               </select> :
               <select id='DropOff_minute' onchange="updateTime('DropOff');">
                  <option value='00'>00</option>
                  <option value='15'>15</option>
                  <option value='30'>30</option>
                  <option value='45'>45</option>
               </select>
               <select id='DropOff_meridian' onchange="updateTime('DropOff');">
                  <option value='0'>am</option>
                  <option value='12'>pm</option>
               </select>
                  <input type="hidden" rel="data" onchange='doModify($(this))' id='DropOffTime' name='Job[<?php print $current->JobID; ?>][DropOffTime]' value='<?php print $current->DropOffTime; ?>'></input>
               </span>
               <div class='contentField'>
                  <label>Num Pax</label><input type='text' name='Job[<?php print $current->JobID; ?>][NumberOfItems]' id='NumberOfItems' value='<?php print $current->NumberOfItems; ?>' size='11' class='boxValue' style='width:6em' />
                  <label style='width:6.5em'>Est. Hours</label><input type='text' name='Job[<?php print $current->JobID; ?>][EstDuration]' id='EstDuration' value='<?php print $current->EstDuration; ?>' size='25' class='boxValue' style='width:6em;' />
               <label>Est. Miles</label><input type='text' name='Job[<?php print $current->JobID; ?>][EstDistance]' id='EstDistance' value='<?php print $current->EstDistance; ?>' size='11' class='boxValue' style='width:6em' />
               </div>
               <div class='contentField'>
                  <label>Actual Pax</label><input type='text' name='Job[<?php print $current->JobID; ?>][ActualPax]' id='ActualPax' value='<?php print $current->ActualPax; ?>' size='11' class='boxValue' style='width:6em' />
                  <label style='width:6.5em'>Actual Hours</label><input type='text' name='Job[<?php print $current->JobID; ?>][Hours]' id='Hours' value='<?php print $current->Hours; ?>' size='25' class='boxValue' style='width:6em;' />
               <label>Actual Miles</label><input type='text' name='Job[<?php print $current->JobID; ?>][TotalMileage]' id='TotalMileage' value='<?php print $current->TotalMileage; ?>' size='11' class='boxValue' style='width:6em' />
               </div>
                <div class='contentField'>
                  <label>Business</label>
                  <?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist();print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "Job[".$current->JobID."][BusinessID]");?>
    <input type='checkbox' id='Confirmed' name='Job[<?php print $current->JobID; ?>][Confirmed]' dbtype='tinyint(4)' value='1'>
    <span>Customer Confirmed</span>
               </div>
               <div class='contentField'>
                  <label>Description</label>
                  <input type='text' name='Job[<?php print $current->JobID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' style='width:15em;' class='boxValue' />
               </div>
               <div class='contentField'>
                  <label>Cust PO</label><input type='text' name='Job[<?php print $current->JobID; ?>][BusinessLocation]' id='BusinessLocation' value='<?php print $current->BusinessLocation; ?>' size='25' class='boxValue' style='width:8em;' />
                  <label>Color</label><input type='color' default='#00ee33' name='Job[<?php print $current->JobID; ?>][Color]' id='Color' value='<?php print $current->Color; ?>' />
               </div>
         </fieldset>
         <div style='margin-left:4em' class='contentField disabled'>
               <div id='NotifyCustomer'  class='disabled' onclick='doNotify_old("business");'><span class='ui-icon ui-icon-contact'></span> Notify Immediately of Change</div>
         </div>

        <fieldset id='DriverNotification' class='jobstatus' title="DriverNotification" style="display:none;">
            <legend>Driver Notification</legend>
            <div class='contentField'><label>Notification ID</label>
               <span id='Notify-NotifyID'></span> [ <a id='editNotify' href='#' onclick="top.loadUrl('/grid/?pid=316&id='+$('#Notify-NotifyID').val(), 'Notify');return false;">edit</a> ]
            </div>
            <div class='contentField'><label>Notify at</label>
                  <!--
                  <select id='Notify-When_hour' onchange="updateTime('Notify-When');">
                     <option value='00'>12</option>
                     <option value='01'>01</option>
                     <option value='02'>02</option>
                     <option value='03'>03</option>
                     <option value='04'>04</option>
                     <option value='05'>05</option>
                     <option value='06'>06</option>
                     <option value='07'>07</option>
                     <option value='08'>08</option>
                     <option value='09'>09</option>
                     <option value='10'>10</option>
                     <option value='11'>11</option>
                  </select> :
                  <select id='Notify-When_minute' onchange="updateTime('Notify-When');">
                     <option value='01'>00</option>
                     <option value='15'>15</option>
                     <option value='30'>30</option>
                     <option value='45'>45</option>
                  </select>
                  <select id='Notify-When_meridian' onchange="updateTime('Notify-When');">
                     <option value='0'>am</option>
                     <option value='12'>pm</option>
                  </select>
                  -->
                  <span id="Notify-When"></span>
                  <!--input type="hidden" rel="data" onchange='doModify($(this))' id='Notify-When' name='Job[<?php print $current->JobID; ?>][Notify][new1][When]' value='08:00:00'></input-->
                  <!--input type="hidden" rel="data" onchange='doModify($(this))' id='Notify-NotifyID' name='Job[<?php print $current->JobID; ?>][Notify][new1][NotifyID]' value=''></input-->
               </div>
               <div class='contentField'><label>Recipient</label>
                  <span id='Notify-Name'></span>
                  <!--input type='text' id='Notify-Name' name='Job[<?php print $current->JobID; ?>][Notify][new1][Name]' class='boxValue'-->
               </div>
               <div class='contentField'><label>Phone Number</label>
                  <!--input type='text' id='Notify-Phone' name='Job[<?php print $current->JobID; ?>][Notify][new1][Phone]' class='boxValue'-->
                  <span id='Notify-Phone'></span>
               </div>
               <div class='contentField'><label>Options</label>
                  <span id='Notify-Choice'></span>
                  <!--input type='text' id='Notify-Choice' name='Job[<?php print $current->JobID; ?>][Notify][new1][Choice]' class='boxValue'-->
               </div>
               <div class='contentField'><label>Message</label>
                  <span id='Notify-Notify' style='display:inline-block;white-space:normal;max-width:20em;'></span>
                  <!--textarea id='Notify-Notify' name='Job[<?php print $current->JobID; ?>][Notify][new1][Notify]' class='boxValue' style='width:25em; height:5em;'></textarea-->
               </div>
               <div class='contentField'><label>Response</label>
                  <span id='Notify-Response' style='display:inline-block;white-space:normal;max-width:20em;'></span>
                  <!--textarea id='Notify-Notify' name='Job[<?php print $current->JobID; ?>][Notify][new1][Notify]' class='boxValue' style='width:25em; height:5em;'></textarea-->
               </div>
         </fieldset>
   <fieldset class='jobstatus' title="Status">
    <legend>Request Status</legend>
                  <input type='checkbox' id='JobCompleted' name='Job[<?php print $current->JobID; ?>][JobCompleted]' dbtype='tinyint(4)' value='1'<?php if ($current->JobCompleted) { print " CHECKED"; } ?>>
    <span>Driver Completed Trip</span>
    <input type='checkbox' id='JobCancelled' name='Job[<?php print $current->JobID; ?>][JobCancelled]' dbtype='tinyint(4)' value='1'<?php if ($current->JobCancelled) { print " CHECKED"; } ?>>
    <span>Job Cancelled</span>
</fieldset>
<fieldset class='jobstatus' title="Invoice Status">
    <legend>Billing Status</legend>
    	<input type='checkbox' id='NoInvoice' name='Job[<?php print $current->JobID; ?>][NoInvoice]' dbtype='tinyint(4)' value='1'<?php if ($current->NoInvoice) { print " CHECKED"; } ?>>
    	<span>No Invoice</span>

    	<input type='checkbox' id='AdditionalBus' name='Job[<?php print $current->JobID; ?>][AdditionalBus]' dbtype='tinyint(4)' value='1'<?php if ($current->AdditionalBus) { print " CHECKED"; } ?> >
    	<span>Bus X of Many</span>
    <div class='contentField'>
    	<input type='checkbox' id='InvoiceSatisfied' name='Job[<?php print $current->JobID; ?>][InvoiceSatisfied]' dbtype='tinyint(4)' value='1'<?php if ($current->InvoiceSatisfied) { print " CHECKED"; } ?>>
    	<span>Invoice Satisfied</span>

    	<input type='checkbox' id='InvoiceOutstanding' name='Job[<?php print $current->JobID; ?>][InvoiceOutstanding]' dbtype='tinyint(4)' value='1'<?php if ($current->InvoiceOutstanding) { print " CHECKED"; } ?>>
    	<span>Invoice Outstanding</span>

    </div>
</fieldset>

     </span>
      <span class='fieldcolumn'>
         <fieldset class='jobstatus' title="JobInfo">
            <legend>Job Details</legend>
	    <div class='contentField' onchange='doSchoolAddress()'><label>School</label><?php $boss->db->addResource("School");$arr = $boss->db->School->getlist();print $boss->utility->buildSelect($arr, $current->SchoolID, "SchoolID", "School", "Job[".$current->JobID."][SchoolID]");?></div>
	    <div class='contentField'><label>School Address</label><span id='schoolAddress' class="ui-widget-content"></span></div>
	       <div class='contentField'>
	          <label>From Yard</label>
		  <select id='EmployeeYard' rel='data'  >
	       	     <option value='2294 Vista del Rio St, Crockett, CA' selected>Crockett</option>
		     <option value='153 Utah Ave., South San Francisco'>South San Francisco</option>
	          </select>
	       </div>
	<div class='contentField'>
               <label>Directions</label><a id='directionsPU' name='directionsPU' target='_blank'>View Full Route</a>

               <span id='travelStartTime'></span> 
        </div>
	    <div class='contentField'><label>* Pickup </label><input type='text' name='Job[<?php print $current->JobID; ?>][PickupLocation]' id='PickupLocation' value='<?php print $current->PickupLocation; ?>' size='50' class='boxValue'  /></div>
            <div class='contentField'><label>Drop</label><input type='text' name='Job[<?php print $current->JobID; ?>][DropOffLocation]' id='DropOffLocation' value='<?php print $current->DropOffLocation; ?>' size='50' class='boxValue'  /></div>
              <div class='contentField'>
	         <label>Final Drop</label>
	         <input type='text' name='Job[<?php print $current->JobID; ?>][FinalDropOffLocation]' id='FinalDropOffLocation' value='<?php print $current->FinalDropOffLocation; ?>' size='50' class='boxValue' />
	         <input type='button' id='dropoffToggle' value='same'>
	      </div>
           </fieldset>
            <fieldset title='Options'>
               <legend>Trip Options</legend>
               <div class='contentField'>
                  <input type='checkbox' id='DriverTraining' name='Job[<?php print $current->JobID; ?>][DriverTraining]' dbtype='tinyint(4)' value='1'>
                  <span>Driver Training</span>
               
                  <input type='checkbox' id='DriverTimeOff' name='Job[<?php print $current->JobID; ?>][DriverTimeOff]' dbtype='tinyint(4)' value='1'>
                  <span>Time OFF Request</span>
                     <input type='checkbox' id='DriverNotified' name='Job[<?php print $current->JobID; ?>][DriverNotified]' dbtype='tinyint(4)' value='1'>
                  <span>Driver Confirmed</span>
               </div>
         <div id='notifyToggle' style='display:inline;' class='contentField'>
            <input type='checkbox' id='doNotify' value='1'>
            <span>Email Driver 1 Day Prior (*)</span>
         </div>        
               <div class='contentField'>
                  <label>* Driver</label>
                  <?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist("Active=1");print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "Job[$current->JobID][EmployeeID]"); ?> 
               </div>
               <div class='contentField'>
               <label>Response</label>
                  <span id='Notify-Response' style='display:inline-block;white-space:normal;max-width:2em;'></span>
               </div>
               <div class='contentField'>
                  <label>Bus</label>
                  <?php $boss->db->addResource("Bus");$arr = $boss->db->Bus->getlist();print $boss->utility->buildSelect($arr, $current->BusID, "BusID", "Bus", "Job[".$current->JobID."][BusID]");?>
               </div>
       <div class='contentField'><label>Depart Yard Time</label><input type='text' name='Job[<?php print $current->JobID; ?>][DepartYardTime]' id='DepartYardTime' value='<?php print $current->DepartYardTime; ?>' size='50' class='boxValue' /></div>
	       <!--div class='contentField'><label>On Spot Time</label><input type='text' name='Job[<?php print $current->JobID; ?>][OnSpotTime]' id='OnSpotTime' value='<?php print $current->OnSpotTime; ?>' size='50' class='boxValue' /></div-->
               <div class='contentField'><label>Instructions</label><textarea name='Job[<?php print $current->JobID; ?>][SpecialInstructions]' id='SpecialInstructions' class='textBox' style='width:21em;'><?php print $current->SpecialInstructions; ?></textarea></div>
               <div class='contentField'>
                  <label>Contact</label>
                  <input type='text' name='Job[<?php print $current->JobID; ?>][ContactName]' id='ContactName' value='<?php print $current->ContactName; ?>' size='50' class='boxValue' />
               </div>
               <div class='contentField'>
                  <label>Phone</label>
                  <input type='text' name='Job[<?php print $current->JobID; ?>][ContactPhone]' id='ContactPhone' value='<?php print $current->ContactPhone; ?>' size='25' class='boxValue' />
               </div>
               <div class='contentField'>
                  <label>Email</label>
                  <input type='text' name='Job[<?php print $current->JobID; ?>][ContactEmail]' id='ContactEmail' value='<?php print $current->ContactEmail; ?>' size='50' class='boxValue' />
               </div>
         </fieldset>
     </span>
      <div class='contentField'><label>Private Notes</label><textarea name='Job[<?php print $current->JobID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
   </div>
</div>
