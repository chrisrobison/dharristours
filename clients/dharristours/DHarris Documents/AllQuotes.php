<script language='Javascript' type='text/javascript'>
   $(function() {
      $(".calcDistance").click(function(e) {
         doDistance();
      });
   });

   function doDistance() {
      $("#travelTime").html("");
      $.getJSON("/tools/distance.php?origin=" + encodeURI($("#Pickup").val()) + "&dest=" + encodeURI($("#DropOff").val()) + "&mode=driving&language=en-US&sensor=false", 
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
      doSelect(id,handleEndTime);
	   var stimes = getTimes(simpleConfig.record["StartTime"]);
      $("#Start_hour").val(stimes[0]);
      $("#Start_minute").val(stimes[1]);
      $("#Start_meridian").val(stimes[2]);

      var etimes = getTimes(simpleConfig.record["EndTime"]);
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
       $("#" + who + "Time").val(mytime);

       if (doend) {
         if ($("#"+"RoundTrip").val()==1) {
           updateEndTime(jQuery("#" + who + "_hour").val(), jQuery("#" + who + "_minute").val(), jQuery("#" + who + "_meridian").val());
	 }
       }
       updateTimeDiffinHours(who, mytime);
   }

   function updateEndTime(hour, min, xd) {
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
       $("#" + who + "Time").val(mytime);
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

   function checkStatus() {
	if ($("#Status").val() == 'Job Created') {
   	   $("#Status").attr('disabled',true);
        } else
      	{
   	   $("#Status").attr('disabled',false);
   	}
   }

   function handleEndTime() {
      if ( $("#RoundTrip").val() == 0) {
         $("#endspan").hide();
      } else {
         $("#endspan").show();
      }
   }

   function ToggleEndTime() {
	if ($("#RoundTrip").val()==0) {
	   $("#endspan").hide("slow");
	   $("#EndTime").val('00:00:00');
	} else {
	   $("#endspan").show(2000);
	   updateTime('Start',true);
	}
   }

</script>

<div class='tableGroup'>
   <div class='formHeading'> Quote ID: <?php print $current->QuoteID; ?></div>
   <div class='fieldcontainer'>
   <button name='driverLogButton' style='float:right' onclick='window.open("<?php print $boss->app->Assets; ?>/templates/QuoteToJob.php?ID="+simpleConfig.id, "btnJobWin", "height=800,width=600,resizable=yes,scrollbars=yes,status=yes,toolbar=yes,menubar=yes,location=no,personalbar=no");return false;'>Create Job</button>
      <input type='hidden' name='sendEmail' id='sendEmail' value='Updated' default='Updated' />
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Quote Amount: $</span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][Quote]' id='Quote' value='<?php print $current->Quote; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Business: </span><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist();print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "Quote[".$current->QuoteID."][BusinessID]");?></div>
 	 <div class='contentField'><label>Status: </label><span name='Quote[][Status]' id='Status'></span></div>
         <div class='contentField'><span class='fieldLabel'>Date: </span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][Date]' id='Date' value='<?php print $current->Date; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Round Trip: </label><select dbtype='tinyint(1)' onchange="ToggleEndTime()" name='Quote[<?php print $current->QuoteID; ?>][RoundTrip]' id='RoundTrip' default=1><option value='0'>No</option><option value='1'>Yes</option></select></div>
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
               <input type="hidden" id='StartTime' name='Quote[<?php print $current->QuoteID; ?>][StartTime]' value='<?php print $current->StartTime; ?>'></input>
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
               <input type="hidden" id='EndTime' name='Quote[<?php print $current->QuoteID; ?>][EndTime]' value='<?php print $current->EndTime; ?>'></input>
            </span>

	         <div class='contentField'><span class='fieldLabel'>Estimated Hours: </span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][Hours]' id='Hours' value='<?php print $current->Hours; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Num of Pax:</span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][NumberOfPassengers]' id='NumberOfPassengers' value='<?php print $current->NumberOfPassengers; ?>' size='25' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Pickup Address: </span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][Pickup]' id='Pickup' value='<?php print $current->Pickup; ?>' size='50' class='boxValue' onchange='' /></div>
         <div class='contentField'><span class='fieldLabel'>Drop Off Address: </span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][DropOff]' id='DropOff' value='<?php print $current->DropOff; ?>' size='50' class='boxValue' onchange='' /></div>
         <div class='contentField'><span class='fieldLabel'>Estimated Travel Time: </span>
         <span id='travelTime'></span><a href="#" style='float:right;padding-top:4px;position:relative;top:-6px;height:16px;' class='calcDistance simpleButton'>Calculate</a></div>
         <div class='contentField'><span class='fieldLabel'>Contact Name: </span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][ContactName]' id='ContactName' value='<?php print $current->ContactName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Contact Phone: </span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][ContactPhone]' id='ContactPhone' value='<?php print $current->ContactPhone; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Contact Email: </span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][ContactEmail]' id='ContactEmail' value='<?php print $current->ContactEmail; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Budget Amount: </span><input type='text' name='Quote[<?php print $current->QuoteID; ?>][BudgetAmount]' id='BudgetAmount' value='<?php print $current->BudgetAmount; ?>' size='25' class='boxValue' /></div>
      </div>
      <div style="clear:left" class='contentField'><span class='fieldLabel'>Special Instructions - </span><textarea name='Quote[<?php print $current->QuoteID; ?>][SpecialInstructions]' id='SpecialInstructions' class='textBox' style='width:45em;height:5em;'><?php print $current->SpecialInstructions; ?></textarea></div>
      <div style="clear:left" class='contentField'><span class='fieldLabel'>Notes - </span><textarea name='Quote[<?php print $current->QuoteID; ?>][Notes]' id='Notes' class='textBox' style='width:45em;height:5em;'><?php print $current->Notes; ?></textarea></div>
   </div>
</div>

