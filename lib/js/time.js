(function () {
   $(".calcDistance").click(function (e) {
      doDistance();
   });

   $("#EmployeeID").change(function (e) {
      var emp = getEmployee($(this).val(), updateNotify);
   });

   $(".jobstatus").on("change", "#JobCancelled", function () {
      if ($(this).is(":checked")) {
         $("#" + simpleConfig.rowid).addClass('cancelled');
         $("#QuoteAmount").val("0");
         $("#BusinessLocation").val("Job Cancelled!");
         $("#NumberOfItems").val("0");
         $('#mygrid').setCell(simpleConfig.rowid, "Stat", 'Cancelled', 'modified'); //added
      } else {
         $("#" + simpleConfig.rowid).removeClass('cancelled');
         $("#JobLocation").val(" ");
      }
   });

   function getEmployee(id, callback) {
      var emp, now = new Date();
      $.get("ctl.php?_cache=" + now.getTime(), {
         x: "related",
         id: id,
         rsc: "Employee"
      }, function (data) {
         console.dir(data);
         if (data && callback) {
            callback.call(this, data);
         }
      });
      return emp;
   }
});

function updateNotify(data) {
   if (data) {
      if (data.Employee) $("#Notify-Name").val(data.Employee);
      if (data.Phone) $("#Notify-Phone").val(data.Phone);
      $("#Notify-Choice").val("1=Yes I accept,2=No I decline");
      $("#Notify-Notify").val("You are scheduled for a job tomorrow at " + $("#PickupTime").val() + " with a pickup location from " + $("#PickupLocation").val() + " ");
      setTime("When", "08:00:00");
   }
}

function doDistance(obj) {
   $("#travelTime").html("");
   if (simpleConfig.action != "new") {
      var url;
      if (!obj) {
         url = "/tools/distance.php?origin=" + encodeURI($('#PickupLocation').val()) + "&dest=" + encodeURI($("#DropOffLocation").val()) + "&mode=driving&language=en-US&sensor=false";
      } else {
         url = "/tools/distance.php?origin=" + encodeURI(simpleConfig.current.PickupLocation) + "&dest=" + encodeURI(simpleConfig.current.DropOffLocation) + "&mode=driving&language=en-US&sensor=false";
      }

      $.getJSON(url,

      function (data) {
         try {
            if (data && data.rows && data.rows[0] && data.rows[0]['elements'] && data.rows[0]['elements'][0].distance) {
               $("#travelTime").html(
               data.rows[0]['elements'][0].distance.text + " / " + data.rows[0]['elements'][0].duration.text);
            }
         } catch (err) {}
      });
      return false;
   }
}

function upAll(id) {
   // $('#mygrid').trigger('reloadGrid');
   //       doSelect(id);
   //$("#mygrid").setSelection(simpleConfig.rowid,true);
   var stimes = getTimes(simpleConfig.record["PickupTime"]);
   $("#Pickup_hour").val(stimes[0]);
   $("#Pickup_minute").val(stimes[1]);
   $("#Pickup_meridian").val(stimes[2]);

   var etimes = getTimes(simpleConfig.record["DropOffTime"]);
   $("#DropOff_hour").val(etimes[0]);
   $("#DropOff_minute").val(etimes[1]);
   $("#DropOff_meridian").val(etimes[2]);
   doDistance(true);
   handleEndTime();

}
//  {Select: function(id) { upAll(id); }, "New": function() { myNew(); }} 
function myNew() {
   doNew();
   $("#travelTime").val("");
   $("#RoundTrip").prop("checked", true);
   $("#JobCompleted").prop("checked", false);
   $("#JobCancelled").prop("checked", false);
   $("#Confirmed").prop("checked", false);
   $("#WheelChair").prop("checked", false);
   $("#SPAB").prop("checked", true);
   $("#endspan").show();
   $("#Hours").val("");
   $("#PickupTime").val("");
   $("#PickupLocation").val("");
   $("#DropOffTime").val("");
   $("#DropOffLocation").val("");
   $("#FinalDropOffLocation").val("");

   $("#Notify-When").val("");
   $("#Notify").val("");
   $("#Notify").val("");
   $("#Notify").val("");
   $("#Pickup_hour").val("");
   $("#Pickup_minute").val("");
   $("#Pickup_meridian").val("");

   $("#DropOff_hour").val("");
   $("#DropOff_minute").val("");
   $("#DropOff_meridian").val("");
   showEnd(true);
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

function setTime(who, time) {
   var times = getTimes(time);
   $("#" + who + "_hour").val(times[0]);
   $("#" + who + "_minute").val(times[1]);
   $("#" + who + "_meridian").val(times[2]);

   return true;
}

function doTime(who) {
   var hr12 = $("#" + who + "_hour").val().replace(/^0/, ''),
      mins = $("#" + who + "_minute").val(),
      merid = $("#" + who + "_meridian").val(),
      hr24 = parseInt(hr12) + parseInt(merid);
   hr24 = (hr24 < 10) ? '0' + hr24 : hr24;
   hr12 = (hr12 < 10) ? '0' + hr12 : hr12;
   var mytime = hr24 + ':' + mins + ':00';

   $("#" + who + "Time").val(mytime);
   $("#" + who + "ShowTime").val(mytime);
}

function updateTime(who, doend) {
   doTime(who)

   try {
      simpleConfig.current[who + "Time"] = mytime;
   } catch (e) {
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
   } catch (e) {
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
      jQuery("#Hours").val(1.25); //added
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
      updateTime('Pickup', true);
   } else {
      $("#endspan").hide("slow");
      $("#DropOffTime").val('00:00:00');
      $("#FinalDropOffLocation").val('One Way Xfer');
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
   if (yes) {
      $('#endspan').show();
      $("#RoundTrip").val("1");
      var pu = $("#PickupLocation").val();
      $("#FinalDropOffLocation").val(pu); //added
      $('#mygrid').setCell(simpleConfig.rowid, "FinalDropOffLocation", $("#FinalDropOffLocation").val(), 'modified'); //added
      $('#mygrid').setCell(simpleConfig.rowid, "RoundTrip", $("#RoundTrip").val(), 'modified'); //added
      //         updateEndTime($("#Pickup_hour").val(),$("#Pickup_minute").val(),$("#Pickup_meridian").val());
      updateTime('Pickup', true);
   } else {
      $('#endspan').hide();
      $("#DropOff_hour").val("");
      $("#DropOff_minute").val("");
      $("#DropOff_meridian").val("");
      //         $("#RoundTrip").prop("checked", false); //added
      $("#RoundTrip").val("0"); //added
      $('#mygrid').setCell(simpleConfig.rowid, "RoundTrip", $("#RoundTrip").val(), 'modified'); //added
      $("#Hours").val('1.25'); //added
      $('#mygrid').setCell(simpleConfig.rowid, "Hours", $("#Hours").val(), 'modified'); //added
      $("#DropOffTime").val("NULL"); //added
      $("#FinalDropOffLocation").val('One Way Xfer'); //added
      $('#mygrid').setCell(simpleConfig.rowid, "FinalDropOffLocation", $("#FinalDropOffLocation").val(), 'modified'); //added
      $('#mygrid').setCell(simpleConfig.rowid, "DropOffTime", 'null', 'modified'); //added
   }


   return true;
}

function doNotify(whom, why) {
   var who, phone, why, choice, message, r, out;
   var until = new Date()
   until.setDate(until.getDate() + 5);
   var untilMessage = ("We will attempt to deliver until: " + until)

   if (whom == "business") {
      who = prompt("Contact Name", $('#ContactName').val());
      if (who) {
         phone = prompt("Phone Number", $('#ContactPhone').val());
      } else {
         alert("Contact name required.  Notification cancelled.");
         return false;
      }
   } else {
      who = prompt("Driver Name", $('#EmployeeID').val());
      if (who) {
         phone = prompt("Phone Number", $('#ContactPhone').val());
      } else {
         alert("Contact name required.  Notification cancelled.");
         return false;
      }
   }

   if ((phone) && (who)) {
      why = prompt("Reason", "Please be specific");
   } else {
      alert("A phone number is required.  Notification cancelled.");
      return false;
   }

   if ((phone) && (who) && (why)) {
      choice = prompt("Response Options (leave blank to not log a response)", "1=Yes I Accept,2=No I Decline");
      var bigid = simpleConfig.id.match(/(.)/g);
      message = ("Phone Message", "Please note. There has been a change to job ID " + bigid.join(" ") + ". The change is: " + why);
      r = confirm("Message to " + who + ", phone: " + phone + "\n" + message + "\n\n\n" + untilMessage + "\nPlease Confirm!!! (a $.50 charge will apply)");
   }
   if (r) {

      //            obj. = {"Voice": phone,
      //       "Name": who,
      //        "Notify": message, "Choice": choice, "Until": until };
      var obj = new Object();
      //     obj.NotifyID = "new1";
      obj.Notify = message;
      obj.Voice = phone;
      obj.Name = who;
      obj.CallerName = "D Harris Tours";
      obj.Choice = choice;
      obj.Until = $('#JobDate').val();
      obj.ProcessID = simpleConfig.pid;
      obj.Remote = "Job";
      obj.RemoteID = simpleConfig.id;
      obj.CreatedBy = userEmail;
      var out = {};
      out["Notify"] = {
         "new1": obj
      };
      // console.dir(out);
      var storeID = simpleConfig.id;
      //            $.post("ctl.php?x=save&rsc=Notify", out, function(data) { // cdr original hit
      $.post("../apps/notify/makecall.php", out, function (data) {
         $("body").append(data);
         var notifyID = simpleConfig.id;
         simpleConfig.id = storeID;
         // put call to makecall here: $.get("makecall.php?id="+notifyID);
         //    console.dir(data);
         //               $.post("../apps/notify/makecall.php?id="+notifyID);
         simpleConfig.id = storeID;
      });
      //call makecall 
      x = "You pressed OK!";
   } else {
      x = "Notification cancelled.";
      return false;
   }
}
