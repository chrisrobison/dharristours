<?php 
$job = $boss->getObjectRelated('Job',$current->JobID,false);
   $trip = $boss->getObjectRelated('Trip','JobID = '.$current->JobID.' ',false);
      $business = $boss->getObjectRelated('Business',$job->BusinessID,false);
?>
<script language='Javascript' type='text/javascript'>

$('input[type="text"]').keypress(function (e) {
    if (e.which !== 0 && e.charCode !== 0) { // only characters
        var c = String.fromCharCode(e.keyCode | e.charCode);
        $span = $(this).siblings('span').first();
        $span.text($(this).val() + c); // the hidden span takes 
        // the value of the input
        $inputSize = $span.width();
        $(this).css("width", $inputSize); // apply width of the span to the input
    }
});

   function insertRow(id, data, elm) {
      debugger;
      if (data['JobCancelled']) {
         $(elm).addClass("cancelled");
      }
   }
   $(function() {
      $(".calcDistance").click(function(e) {
         doDistance();
      });
      $(".jobstatus").on("change", "#JobCancelled", function() {
         if ($(this).is(":checked")) {
            var str1 = "CANCELLED!! ";
	    $("#" + simpleConfig.rowid).addClass('cancelled');
           // $("#QuoteAmount").val("0");
            $("#BusinessLocation").val(str1 + $("#BusinessLocation").val());
            $("#Job").val(str1 + $("#Job").val());
            $("#SpecialInstructions").val("Job Cancelled!");
//            $("#NumberOfItems").val("0");
//            $("#BusID").val("22");
//            $("#EmployeeID").val("90");
            $('#mygrid').setCell(simpleConfig.rowid, "Stat", 'Cancelled', 'modified'); //added
         } else {
            $("#" + simpleConfig.rowid).removeClass('cancelled');
         $("#JobLocation").val(" ");
         }
      });

    $( "#estPrice" ).draggable({
	helper: "clone"
	});

    $( "#QuoteAmount" ).droppable({
     accept:".ui-widget-content", 
     drop: function( event, ui ) {
//	alert(ui.draggable.text());
      var estp = ui.draggable.text(); //clone();
        $(this)
	  .append(estp)
 //         .addClass( "ui-state-highlight" )
	  .html(estp)
          .val(estp)
      	  doModify($(this));
	}
    });

    $( "#schoolAddress" ).draggable({
	helper: "clone"
	});

    $( "#PickupLocation" ).droppable({
     accept:".ui-widget-content", 
     drop: function( event, ui ) {
//	alert(ui.draggable.text());
      var schooladdr = ui.draggable.text(); //clone();
        $(this)
	  .append(schooladdr)
 //         .addClass( "ui-state-highlight" )
	  .html(schooladdr)
          .val(schooladdr)
      	  doModify($(this));
	}
    });
    $( "#DropOffLocation" ).droppable({
     accept:".ui-widget-content", 
     drop: function( event, ui ) {
//	alert(ui.draggable.text());
      var schooladdr = ui.draggable.text(); //clone();
        $(this).append(schooladdr)
 //         .addClass( "ui-state-highlight" )
	  .html(schooladdr)
          .val(schooladdr);
      	  doModify($(this));
	}
    });
    $( "#FinalDropOffLocation" ).droppable({
     accept:".ui-widget-content", 
     drop: function( event, ui ) {
//	alert(ui.draggable.text());
      var schooladdr = ui.draggable.text(); //clone();
        $(this).append(schooladdr)
 //         .addClass( "ui-state-highlight" )
	  .html(schooladdr)
          .val(schooladdr);
      	  doModify($(this));
	}
    });
  });

   function doDistance(obj) {
      $("#travelTime").html("");
      if (simpleConfig.action != "new" && $("#PickupLocation").val() != "" && $("#DropOffLocation").val() != "") {
         var url;
         if (!obj) {
            url = "/tools/distance.php?origin=" + encodeURI($("#PickupLocation").val()) + "&dest=" + encodeURI($("#DropOffLocation").val()) + "&mode=driving&language=en-US&sensor=false";
         } else {
            url = "/tools/distance.php?origin=" + encodeURI(simpleConfig.current.PickupLocation) + "&dest=" + encodeURI(simpleConfig.current.DropOffLocation) + "&mode=driving&language=en-US&sensor=false";
         }

         $.getJSON(url, 
            function(data) {
               try {
                  if (data && data.rows && data.rows[0] && data.rows[0]['elements'] && data.rows[0]['elements'][0].distance) {
                     $("#travelTime").html( 
                        data.rows[0]['elements'][0].distance.text + " / " + 
                        data.rows[0]['elements'][0].duration.text
                     );
                  }
               } catch(err) { }
            }
         );
         return false;
      }
   }

   var userEmail = '<?php print htmlspecialchars($_SESSION['Email'], ENT_QUOTES); ?>';

   function doSchoolAddress(obj) {
      $("#schoolAddress").html("");
      var id = $("#SchoolID").val();
      if (id != 0) {
         var url;
         if (!obj) {
            url = "/grid/ctl.php?x=related&Resource=School&id=" + encodeURI(id) ;
         } else {
            url = "/grid/ctl.php?x=related&Resource=School&id=" + encodeURI($("#SchoolID").val()) ;
         }

         $.getJSON(url, 
            function(data) {
               try {
                  if (data) {
//data = $.parseJSON(data); 
                     $("#schoolAddress").html( 
      //                  data.rows[0]['elements'][0].Street.text + ", " + 
      //                  data.rows[0]['elements'][0].City.text
			data["StreetAbr"] + ", " + data["City"] + ", " + data["State"] + ", " + data["School"] 
                      );
                  }
               } catch(err) { }
            }
         );
         return false;
      }
 }
 

  function getEstPrice(obj) {
      $("#estPrice").html("");
      var id = $("#BusinessID").val();
      var pax = $("#NumberOfItems").val();
      var hrs = ($("#Hours").val()<4) ? 2.75 : $("#Hours").val();
      if (id != 0) {
         var url;
         if (!obj) {
            url = "/grid/ctl.php?x=related&Resource=Business&id=" + encodeURI(id) ;
         } else {
            url = "/grid/ctl.php?x=related&Resource=Business&id=" + encodeURI($("#BusinessID").val()) ;
         }

         $.getJSON(url, 
            function(data) {
               try {
                  if (data) {
//data = $.parseJSON(data); 
      //                  data.rows[0]['elements'][0].Street.text + ", " + 
      //                  data.rows[0]['elements'][0].City.text
		   if (pax == 0 || pax == null) {
			var est4p = "0"; 
			var est1p = "0";
		   } else if (pax > 0 && pax < 29) {
			var est4p = data["Cost28FirstFour"];
			var est1p = data["Cost28OT"];
		    } else if (pax > 28 && pax < 33) {
			var est4p = data["Cost32FirstFour"];
			var est1p = data["Cost32OT"];
		    } else if (pax > 32 && pax < 39) {
			var est4p = data["Cost38FirstFour"];
			var est1p = data["Cost38OT"];
		    } else if (pax > 38 && pax < 46) {
			var est4p = data["Cost45FirstFour"];
			var est1p = data["Cost45OT"];
		    } else if (pax > 45 && pax < 56) {
			var est4p = data["Cost55FirstFour"];
			var est1p = data["Cost55OT"];
		   }
		    var estp = (parseFloat(est4p) + (parseFloat(est1p)*(parseFloat(hrs)-4.0)));
                     $("#estPrice").html(parseFloat(estp).toFixed(2));
                  }
               } catch(err) { }
            }
         );
         return false;
      }
 }
   

function upAll(id) {
//	$('#mygrid').trigger('reloadGrid');
//       doSelect(id);
//$("#mygrid").setSelection(simpleConfig.rowid,true);
      $("#estPrice").html("");
      $("#estPrice").val("");
      var stimes = getTimes(simpleConfig.record["PickupTime"]);
      $("#Pickup_hour").val(stimes[0]);
      $("#Pickup_minute").val(stimes[1]);
      $("#Pickup_meridian").val(stimes[2]);

      var etimes = getTimes(simpleConfig.record["DropOffTime"]);
      $("#DropOff_hour").val(etimes[0]);
      $("#DropOff_minute").val(etimes[1]);
      $("#DropOff_meridian").val(etimes[2]);
      //doDistance(true);
//      doSchoolAddress(true);
      handleEndTime();
      
   }
//  {Select: function(id) { upAll(id); }, "New": function() { myNew(); }} 
   function myNew() {
      doNew();
 	$('#mygrid').trigger('reloadGrid');
      $("#travelTime").val("");
      $("#travelTime").html("");
      $("#estPrice").html("");
      $("#estPrice").val("");
      $("#schoolAddress").html("");
      $("#schoolAddress").val("");
      $("#PickupLocation").removeClass( "ui-state-highlight" );
      $("#DropOffLocation").removeClass( "ui-state-highlight" );
      $("#FinalDropOffLocation").removeClass( "ui-state-highlight" );
      $("#RoundTrip").val("1");
      $("#NumberOfItems").val("");
      $("#JobCompleted").prop("checked", false);
      $("#JobCancelled").prop("checked", false);
      $("#Confirmed").prop("checked", false);
      $("#WheelChair").prop("checked", false);
      $("#SPAB").prop("checked", false); //pp
      $("#endspan").show();
      $("#Hours").val("");
      $("#PickupTime").val("");
      $("#PickupLocation").val("");
      $("#DropOffTime").val("");
      $("#DropOffLocation").val("");
      $("#FinalDropOffLocation").val("One Way Xfer");
      
      $("#Pickup_hour").val("");
      $("#Pickup_minute").val("");
      $("#Pickup_meridian").val("");

      $("#DropOff_hour").val("");
      $("#DropOff_minute").val("");
      $("#DropOff_meridian").val("");
      showEnd("1");
      $("#Job").focus();
   }

   function getTimes(mytime) {
       var stimes = mytime.split(/:/);
       stimes[0] = stimes[0].replace(/^0(\d)/, '$1');
       stimes[2] = 0;
       
       if (stimes[0] == 24) {
          stimes[0] = 12;
       }
       if (stimes[0] >= 12) {
           stimes[0] = parseInt(stimes[0]) - 12;
           stimes[2] = 12;
       } else {
           stimes[2] = 0;
       }
       
       if (stimes[0] < 10) stimes[0] = '0' + stimes[0];
       
       return stimes;
   }

   function updateTime(who, doend) {
      var hr12 = $("#" + who + "_hour").val().replace(/^0/,''),
          mins = $("#" + who + "_minute").val(),
          merid = $("#" + who + "_meridian").val(),
          hr24 = parseInt(hr12) + parseInt(merid);
          hr24 = (hr24 < 10) ? '0' + hr24 : hr24;
          hr12 = (hr12 < 10) ? '0' + hr12 : hr12;
          var mytime = hr24 + ':' + mins + ':00';
       
      $("#" + who + "Time").val(mytime);
 	   
      try {
         simpleConfig.current[who + "Time"] = mytime;
      } catch(e) { 
         console.log("simpleConfig.current does not exist");
         console.dir(simpleConfig);
      }

      $('#mygrid').setCell(simpleConfig.rowid, who + "Time", $("#" + who + "Time").val(), 'modified');
      
      if (doend) {
            updateEndTime(hr12, mins, merid);
      }
      updateTimeDiffinHours(who, mytime);
   }

   function updateEndTime(hour, min, xd) {
      hour = hour.replace(/^0/, '');
      var who = 'DropOff',
          mer = xd,
          ehour24 = parseInt(hour) + 4 + parseInt(mer),
          ehour12 = ehour24;

      if (parseInt(ehour12) > 23) {
         mer = '0';
         ehour12 -= 24;
     ehour24 -= 24;
      }
      if (parseInt(ehour12) > 11) {
         mer = '12';
         ehour12 -= 12;
      }

      if (parseInt(ehour12) == 12) {
         ehour12 = '0';
      }
      
      ehour12 = (ehour12 < 10) ? '0' + ehour12 : ehour12;
      jQuery("#" + who + '_hour').val(ehour12);
      jQuery("#" + who + '_minute').val(min);
      jQuery("#" + who + '_meridian').val(mer);
      
      ehour24 = (ehour24 < 10) ? '0' + ehour24 : ehour24;

      var mytime = ehour24 + ':' + min + ':00';
      $("#" + who + "Time").val(mytime);
 	   try {
         simpleConfig.current[who + "Time"] = mytime;
      } catch(e) {
         console.log("simpleConfig.current does not exist");
         console.dir(simpleConfig);
      }
      $('#mygrid').setCell(simpleConfig.rowid, who + "Time", mytime, 'modified');
   }
   
   function getTime(who) {
       var out = {
                  "hour": jQuery("#" + who + "_hour").val().replace(/^0/, ''),
                  "minute": jQuery("#" + who + "_minute").val().replace(/^0/, ''),
                  "meridian": jQuery("#" + who + "_meridian").val()
               };
       return out;
   }

   function updateTimeDiffinHours(who, mytime) {
      var pickup = getTime("Pickup"),
          dropoff = getTime("DropOff");


       var starthr = jQuery("#Pickup_hour").val().replace(/^0/, '');
       var startmin = jQuery("#Pickup_minute").val().replace(/^0/, '');
       var startmer = jQuery("#Pickup_meridian").val();
       
       var endhr = jQuery("#DropOff_hour").val().replace(/^0/, '');
       var endmin = jQuery("#DropOff_minute").val().replace(/^0/, '');
       var endmer = jQuery("#DropOff_meridian").val();

       starthr = parseInt(starthr) + parseInt(startmer);
       var starthrmin = starthr * 60 + parseInt(startmin);
       endhr = parseInt(endhr) + parseInt(endmer);
       var endhrmin = endhr * 60 + parseInt(endmin);


      var rt = $("#RoundTrip").val(); //added
      if (((rt == "0") || (rt == "false"))) //added && (jQuery("#Hours").val() == "4" )
      { //added
	  if ((parseInt(endhrmin) - parseInt(starthrmin)) < 160) {
	       jQuery("#Hours").val(2.75); //added
	 } else { 
       	      jQuery("#Hours").val((parseInt(endhrmin) - parseInt(starthrmin)) / 60);
	 } 
	} else { //added
	  if ((parseInt(endhrmin) - parseInt(starthrmin)) < 240) {
           	jQuery("#Hours").val(4);
	  } else {
       	 jQuery("#Hours").val((parseInt(endhrmin) - parseInt(starthrmin)) / 60);
	  }
	}
      $('#mygrid').setCell(simpleConfig.rowid, "Hours", $("#Hours").val(), 'modified');
   }

   function handleEndTime() {
      var rt = simpleConfig.record["RoundTrip"];
      if ((rt == "1") || (rt == "true")) {
         $("#endspan").show();
      } else {
         $("#endspan").hide();
      }
   }

   function ToggleEndTime() {
      var rt = simpleConfig.current.RoundTrip;
      if ((rt == "1") || (rt == "true")) {
         $("#endspan").show(2000);
         updateTime('Pickup',true);
      } else {
         $("#endspan").hide("slow");
         $("#DropOffTime").val('00:00:00');
         //pp$("#FinalDropOffLocation").val('One Way Xfer');
      }
   }
   function cancelJob(yes) {
      if (yes) { 
         $("#QuoteAmount").val("0");
         $("#JobLocation").val("Job Cancelled!");
         $("#NumberOfItems").val("0");
	  }
    return true;
   }

   function showEnd(yes) {
      if (yes=="1") { 
         $('#endspan').show(); 
         $("#RoundTrip").val("1");
         var pu = $("#PickupLocation").val();
         $("#FinalDropOffLocation").val(pu);//added
         $('#mygrid').setCell(simpleConfig.rowid, "FinalDropOffLocation", $("#FinalDropOffLocation").val(), 'modified'); //added
         $('#mygrid').setCell(simpleConfig.rowid, "RoundTrip", $("#RoundTrip").val(), 'modified'); //added
//         updateEndTime($("#Pickup_hour").val(),$("#Pickup_minute").val(),$("#Pickup_meridian").val());
	updateTime('Pickup');
      } else {
         $('#endspan').hide();
        //pp $("#DropOff_hour").val("");
        //pp $("#DropOff_minute").val("");
        //pp $("#DropOff_meridian").val("");
//         $("#RoundTrip").prop("checked", false); //added
         $("#RoundTrip").val("0"); //added
         $('#mygrid').setCell(simpleConfig.rowid, "RoundTrip", $("#RoundTrip").val(), 'modified'); //added
        // $("#Hours").val('2.75'); //added
	updateTime('Pickup');
         $('#mygrid').setCell(simpleConfig.rowid, "Hours", $("#Hours").val(), 'modified'); //added
         // $("#DropOffTime").val("NULL"); //added
         $("#FinalDropOffLocation").val('One Way Xfer');//added
         $('#mygrid').setCell(simpleConfig.rowid, "FinalDropOffLocation", $("#FinalDropOffLocation").val(), 'modified'); //added
         //$('#mygrid').setCell(simpleConfig.rowid, "DropOffTime", 'null', 'modified'); //added
      }
      

      return true;
   }
</script>
<div class='tableGroup'>
   <div class='formHeading'>
      Job ID: <?php print $current->JobID; ?>
   </div>
   <div class='fieldcontainer'>



   <span class='fieldcolumn fieldfloater'>
     <fieldset title='HardSet'>
         <legend>Set</legend>
         <div class='contentField'><label>Job Date</label>
	 	<input type='text' disabled='disabled' name='Job[<?php print $current->JobID; ?>][JobDate]' id='JobDate' value='<?php print $current->JobDate; ?>' size='50' class='boxValue' /></div> 
	<div class='contentField'><label>Business</label><h4><?php print $business->Business; ?></h4></div>
	<div class='contentField' onchange='getEstPrice()'><label>Business</label><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist();print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "Job[".$current->JobID."][BusinessID]");?></div>
	<div class='contentField'><label>Pickup Time</label>
	 	<input type='text' disabled='disabled' name='Job[<?php print $current->JobID; ?>][PickupTime]' id='PickupTime' value='<?php print $current->PickupTime; ?>' size='50' class='boxValue' /></div> 
         <div class='contentField'><label>Dropoff Time</label>
	 	<input type='text' disabled='disabled' name='Job[<?php print $current->JobID; ?>][DropOffTime]' id='DropOffTime' value='<?php print $current->DropOffTime; ?>' size='50' class='boxValue' /></div> 
         <div class='contentField'><label>Number PAX</label>
	 	<input type='text' disabled='disabled' name='Job[<?php print $current->JobID; ?>][NumberOfItems]' id='NumberOfItems' value='<?php print $current->NumberOfItems; ?>' size='50' class='boxValue' /></div> 
	</fieldset>
<div class='contentField'><label>Job</label><input type='text'  name='Job[<?php print $current->JobID; ?>][Job]' id='Job' value='<?php print $current->Job; ?>' size='50' class='boxValue' /></div> 
         <div class='contentField'><label>Job Description</label>
	 	<input type='text' name='Job[<?php print $current->JobID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div> 
         <div class='contentField'><label>Business Location</label>
	 	<input type='text' name='Job[<?php print $current->JobID; ?>][BusinessLocation]' id='BusinessLocation' value='<?php print $current->BusinessLocation; ?>' size='50' class='boxValue' /></div> 
      <fieldset title='Options'>
         <legend>Options</legend>
            <div class='contentField'>
                  <input type='checkbox' id='SPAB' name='Job[<?php print $current->JobID; ?>][SPAB]' dbtype='tinyint(4)' value='1'>
                 <span>SPAB</span>
                 <input type='checkbox' id='WheelChair' name='Job[<?php print $current->JobID; ?>][WheelChair]' dbtype='tinyint(4)' value="1">
                <span>Wheel Chair</span>
		<select id='RoundTrip' name='Job[<?php print $current->JobID; ?>][RoundTrip]' dbtype='tinyint(1)' rel='RoundTrip' onclick="return showEnd(this.value)" >
			<option value="1">Yes</option>
			<option value="0">No</option>
		</select><span>Round Trip</span>
	</div>
       </fieldset>
       <fieldset class='jobstatus' title="Status">
         <legend>Status</legend>
	   	<input type='checkbox' id='Confirmed' name='Job[<?php print $current->JobID; ?>][Confirmed]' dbtype='tinyint(4)' value='1'>
	   <span>Confirmed</span>
	   	<input type='checkbox' id='JobCompleted' name='Job[<?php print $current->JobID; ?>][JobCompleted]' dbtype='tinyint(4)' value='1'><span>Trip Completed</span>
	   	<input type='checkbox' id='JobCancelled' name='Job[<?php print $current->JobID; ?>][JobCancelled]' dbtype='tinyint(4)' value='1' >
	<span>Job Cancelled</span>
	</fieldset> 
</span>
   <span class='fieldcolumn'>
   <button name='driverLogButton' style='float:middle' onclick='window.open("<?php print $boss->app->Assets; ?>/templates/DriverLog.php?printbtn=yes&ID="+simpleConfig.id, "btnJobWin", "height=800,width=600,resizable=yes,scrollbars=yes,status=yes,toolbar=yes,menubar=yes,location=no,personalbar=no");return false;'>Print Driver Log</button>
     <fieldset title='School'>
         <legend>School Address Lookup</legend>
          <div class='contentField' onchange='doSchoolAddress()'><label>School</label><?php $boss->db->addResource("School");$arr = $boss->db->School->getlist();print $boss->utility->buildSelect($arr, $current->SchoolID, "SchoolID", "School", "Job[".$current->JobID."][SchoolID]");?></div>
	  <div class='contentField'><label>School Address</label><span id='schoolAddress' class="ui-widget-content"></span></div>
</fieldset>
        <div class='contentField'><label>Travel Time</label><span id='travelTime'></span> <span style='color:#aaa;font-weight:200'>[One-way]</span></div>
         <div class='contentField'><label>Pickup <img src='/img/map_icon.png' width='28' height='28' class='simpleButton mapButton' style='float:right;' onclick="return showMap($('#PickupLocation').val(), 'Pickup Address');" /> </label><input type='text' name='Job[<?php print $current->JobID; ?>][PickupLocation]' id='PickupLocation' value='' size='50' class='boxValue' onchange='doDistance()' /></div>
         <div class='contentField'><label>Drop <img src='/img/map_icon.png' width='28' height='28' class='simpleButton mapButton' style='float:right;' onclick="return showMap($('#DropOffLocation').val(), 'Drop Off Address');" /></label><input type='text' name='Job[<?php print $current->JobID; ?>][DropOffLocation]' id='DropOffLocation' value='<?php print $current->DropOffLocation; ?>' size='50' class='boxValue' onchange='doDistance()' /></div>
         <div class='contentField'><label>Final Drop</label><input type='text' name='Job[<?php print $current->JobID; ?>][FinalDropOffLocation]' id='FinalDropOffLocation' value='<?php print $current->FinalDropOffLocation; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Employee</label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist("Active=1");print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "Job[$current->JobID][EmployeeID]");?></div>
         <div class='contentField'><label>Bus</label><?php $boss->db->addResource("Bus");$arr = $boss->db->Bus->getlist();print $boss->utility->buildSelect($arr, $current->BusID, "BusID", "Bus", "Job[".$current->JobID."][BusID]");?></div>
         <div class='contentField'><label>Driver Instructions</label><textarea name='Job[<?php print $current->JobID; ?>][SpecialInstructions]' id='SpecialInstructions' class='textBox' style='width:41em;height:5em;'><?php print $current->SpecialInstructions; ?></textarea></div>
         <div class='contentField'><label>Contact</label><input type='text' name='Job[<?php print $current->JobID; ?>][ContactName]' id='ContactName' value='<?php print $current->ContactName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Phone</label><input type='text' name='Job[<?php print $current->JobID; ?>][ContactPhone]' id='ContactPhone' value='<?php print $current->ContactPhone; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Email(Notify)</label><input type='text' name='Job[<?php print $current->JobID; ?>][ContactEmail]' id='ContactEmail' value='<?php print $current->ContactEmail; ?>' size='50' class='boxValue' /></div>
      </span>
      <div class='contentField'><label>Private Notes</label><textarea name='Job[<?php print $current->JobID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
   </div>
</div>
