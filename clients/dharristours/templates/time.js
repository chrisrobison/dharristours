$(function () {
$("#NoBilling").click(function(e) {
  $("#BusinessID").val("366");
  $("#NoInvoice").prop('checked', true);
  $("#QuoteAmount").val("0");
//  $("#SaveButton").removeClass("disabled");
//  $("#SaveButton").removeAttr("disabled");
  $("#SaveButton").addClass("modified");
//  $("#SaveButton").addClass("modified");
//  $("#SaveButton").addAttr("modified");
//  $('#mygrid').setCell(simpleConfig.rowid, "Job", $("#Job").val(), 'modified'); //added
  $('#mygrid').setCell(simpleConfig.rowid, "Job", $('#Job').val(), 'modified'); //added
  return true;
});

$("#estPrice").html("");
    $( "#estPrice" ).draggable({
  helper: "clone"
  });
  $( "#QuoteAmount" ).droppable({
    accept:".ui-widget-content", 
    drop: function( event, ui ) {
      var estp = ui.draggable.text(); //clone();
      $(this)
      .append(estp)
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
//      alert(ui.draggable.text());
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
//      alert(ui.draggable.text());
var schooladdr = ui.draggable.text(); //clone();
$(this).append(schooladdr)
//         .addClass( "ui-state-highlight" )
.html(schooladdr)
.val(schooladdr);
doModify($(this));
}
});


$(".calcDistance").click(function (e) {
    //doDistance();
    });

$("#SaveButton").click(function(e) {

    });

$('input[type="checkbox"]').change(function(){
    this.value = (Number(this.checked));
    });

$("#EmployeeID").change(function (e) {
    var emp = getEmployee($(this).val(), updateNotifyPhone, e.isTrigger);
    });
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

function add_years(dt,n)
 {
 if (Object.prototype.toString.call(dt) === "[object Date]") {
  // it is a date
  if (! (isNaN(dt))) { // d.getTime() or d.valueOf() will also work
    // date object is valid
      var newDate =  new Date(dt.setFullYear(dt.getFullYear() + n));
      $("#JobDate").val(newDate.toISOString().split('T')[0]);
      return;
    }
  }
}

$("#doNotify").click(function(e) {
    if ($(this).is(":checked")) {
    doSave();
    $("#DriverNotification > div").show();
    createNotify();
    } else {
    $("#DriverNotification > div").hide();
    if (simpleConfig.current['related_Notify'] && simpleConfig.current['related_Notify'].length) {
    var nrec = simpleConfig.current['related_Notify'].shift();
    deleteNotify(nrec.NotifyID);
    }
    }
    });

//$(".jobstatus").on("change", "#JobCancelled", function () {
$("#JobCancelled").click(function(e) {
    if ($(this).is(":checked")) {
//      var jobDate = $("#JobDate").val();
//      jobDate.setFullYear(jobDate.getFullYear() + 100);
        this.checked = confirm('Are you sure you want to CANCEL and no charge is applied?');
        if (this.checked)
        {
          var jobDate = new Date(document.getElementById('JobDate').value);
          add_years(jobDate, 100);
          var str1 = " CANCELLED ";
          $("#BusID").val("22");
          $("#" + simpleConfig.rowid).addClass('cancelled');
          var reasonCancelled = prompt("Reason for cancellation? 3 words or less");
          $("#Job").val(reasonCancelled + str1 + $("#Job").val());
          $("#BusinessLocation").val("Cancelled! $" + $('#QuoteAmount').val());
          $("#QuoteAmount").val("0");
          $("#EmployeeID").val("38");
    //         $("#NumberOfItems").val("0");
          $('#mygrid').setCell(simpleConfig.rowid, "Stat", 'Cancelled', 'modified'); //added
        }
        else {
        //$("#" + simpleConfig.rowid).removeClass('cancelled');
        //$("#JobLocation").val(" ");
            e.preventDefault();
        } 
    }
  }
);

$("#dropoffToggle").on('click', function() {
    var pu;
    pu = $("#PickupLocation").val();
    if ($("#FinalDropOffLocation").val() != pu)
    {
    $("#FinalDropOffLocation").val(pu);
    // 		$('#mygrid').setCell(simpleConfig.rowid,  "FinalDropOffLocation", $("#FinalDropOffLocation").val(), 'modified');
    $("#FinalDropOffLocation").prop( "disabled", true ); 
    $("#SaveButton").addClass("modified");
    }
    });

});

function resetNotification(action) {
   var sv = $("#SaveButton").hasClass("modified");
   var eid = $("#EmployeeID").val();
   var ceid = simpleConfig.current["EmployeeID"];
   if( $("#DriverNotified").is(":checked") && (eid != ceid || action == "save" || sv)) 
   {       
	$("#DriverNotified").next("span").css("background-color", "yellow");
   }       
   else    
   {       
	$("#DriverNotified").next("span").css({'background-color' : ''}); 
   }       
}
function mySave() {
console.dir("here we go");
console.dir(simpleConfig.current);
   if (simpleConfig.current['JobDate'] &&  simpleConfig.current['EmployeeID'] && simpleConfig.current['PickupLocation'] && simpleConfig.current['PickupTime'] && simpleConfig.current['BusID']) {
      $("#doNotify").removeAttr("disabled");
      $("#notifyToggle").removeClass("disabled");
   } else {
      $("#doNotify").attr("disabled", true);
      $("#notifyToggle").addClass("disabled");
   }  
   doSave();
}
function getEmployee(id, callback, isTrigger) {
    var emp, now = new Date();
    $.get("ctl.php?_cache=" + now.getTime(), {
       x: "related",
       id: id,
       rsc: "Employee"
    }, function (data) {
       simpleConfig.current['related_Employee'] = [data];
       //console.dir(data);
       if (data && callback) {
          if (!isTrigger) callback.call(this, data);
       }
    });
    return emp;
 }

//function removeBilling() {

function getEstPrice(obj) {
  if ($("#NoInvoice").is(":checked") == false) {
  $("#estPrice").html("");
  $("#estPrice").css({'background-color': 'none'});
  $("#priceChart").html("");
	var id = $("#BusinessID").val();
	var paxTotal = $("#NumberOfItems").val();
  var extraBusCount = Math.floor(paxTotal/45);
  var pax = (paxTotal % 45);

	var roundtrip =$("#RoundTrip").val(); // === 0) ? -50 : 0 ; // $50 discount for One Way
	var shuttle = $("#Shuttle").is(":checked") * 100 * (extraBusCount + 1) ;
  var discount = 0;
	var wheelchair = $("#WheelChair").is(":checked") * 100 ;
	var cargo = $("#Cargo").is(":checked") * 100 * (extraBusCount + 1) ;
  const priceSheetFourHr = [ 675, 800, 850, 900, 1250 ];
  const priceSheetAddHr = [ 100, 110, 110, 120, 150 ];
	// var roundtrip =   $("#RoundTrip").is(":checked");
	var hrs = ($("#Hours").val()<4) ? 4 : $("#Hours").val();
  var overrideCost;
  var cssColor = {'background-color': 'white'};
  var msg = "";
 	var url;
  let defaultRecord;
  var estp; //+ (parseFloat(est1p)*(parseFloat(hrs)-4.0)));
  var descText;
if (id != 0) 
  {
	  if (!obj) 
    {
	    url = "/grid/ctl.php?x=related&Resource=Business&id=" + encodeURI(id) ;
  	} 
    else 
    {
	    url = "/grid/ctl.php?x=related&Resource=Business&id=" + encodeURI($("#BusinessID").val()) ;
	  }
	  $.getJSON(url,
	    function(data) {
        try {
          if (data) 
          {
            overrideCost = data["CostOverrideDefault"];
            if (roundtrip == 0 && extraBusCount == 0) { discount = 50; }
            if (overrideCost == 1) {
              priceSheetFourHr[0] = data["Cost28FirstFour"]
                ,  priceSheetFourHr[1] = data["Cost32FirstFour"]
                ,  priceSheetFourHr[2] = data["Cost38FirstFour"]
                ,  priceSheetFourHr[3] = data["Cost45FirstFour"]
                ,  priceSheetFourHr[4] = data["Cost55FirstFour"] ;
              priceSheetAddHr[0] = data["Cost28OT"]
                , priceSheetAddHr[1] = data["Cost32OT"]
                , priceSheetAddHr[2] = data["Cost38OT"]
                , priceSheetAddHr[3] = data["Cost45OT"]
                , priceSheetAddHr[4] = data["Cost55OT"] ;
              cssColor = {'background-color': 'yellow'};
              msg = "_OVERRIDE";

            }
     /*       else {
              defaultRecord = getDefaultSystemPrices();
              if (defaultRecord) {
              priceSheetFourHr[0] = defaultRecord[0]["Cost28FirstFour"]
                ,  priceSheetFourHr[1] = defaultRecord[1]["Cost32FirstFour"]
                ,  priceSheetFourHr[2] = defaultRecord[2]["Cost38FirstFour"]
                ,  priceSheetFourHr[3] = defaultRecord[3]["Cost45FirstFour"]
                ,  priceSheetFourHr[4] = defaultRecord[4]["Cost55FirstFour"] 
                ,  priceSheetAddHr[0] = defaultRecord[5]["Cost28OT"]
                ,  priceSheetAddHr[1] = defaultRecord[6]["Cost32OT"]
                ,  priceSheetAddHr[2] = defaultRecord[7]["Cost38OT"]
                ,  priceSheetAddHr[3] = defaultRecord[8]["Cost45OT"]
                ,  priceSheetAddHr[4] = defaultRecord[9]["Cost55OT"] ;
  
              }
            }
       */
              $("#estPrice").css(cssColor);
                   
            estp = parseFloat(-discount); //+ (parseFloat(est1p)*(parseFloat(hrs)-4.0)));

            descText = hrs + " hr: ";
            // add the cost for each 45 pax bus
            for (let i = 0; i < extraBusCount; i++) {
                estp += getEstPricePerBus(4, hrs, priceSheetFourHr, priceSheetAddHr); 
     
            }
            if (extraBusCount > 0) {

                descText += extraBusCount + " * 44 pax $" + priceSheetFourHr[3] + "/$" + priceSheetAddHr[3] + " = $" + estp + " ";
            }
            var pax_idx = 0;
            if (pax >= 1 && pax <=28) { pax_idx = 1; }
            if (pax >= 29 && pax <=36) { pax_idx = 2; }
            if (pax >= 37 && pax <=39) { pax_idx = 3; }
            if (pax >= 40 && pax <=45) { pax_idx = 4; }
            if (pax >= 46 && pax <=70) { pax_idx = 5; }
//            console.log(pax_idx);
//            console.log(priceSheetFourHr[0]);
//            console.log(pax_idx);
            switch(pax_idx) {
              case null:
                return;
              case 0:
                $("#estPrice").html(parseFloat(estp+shuttle+cargo+wheelchair).toFixed(2));
                $("#priceChart").text(descText); 
                break;
              case 1:
                 estp += (parseFloat(priceSheetFourHr[0] ) + (parseFloat(priceSheetAddHr[0])*(parseFloat(hrs)-4.0)));
                $("#estPrice").html(parseFloat(estp+shuttle+cargo+wheelchair).toFixed(2));
                $("#priceChart").text(descText + pax + " pax =  $" + priceSheetFourHr[0] + "/$" + priceSheetAddHr[0]); 
                break;
              case 2:
                 estp += (parseFloat(priceSheetFourHr[1] ) + (parseFloat(priceSheetAddHr[1])*(parseFloat(hrs)-4.0)));
                $("#estPrice").html(parseFloat(estp+shuttle+cargo+wheelchair).toFixed(2));
                $("#priceChart").text(descText + pax + " pax =  $" + priceSheetFourHr[1] + "/$" + priceSheetAddHr[1]); 
                break;
              case 3:
                 estp += (parseFloat(priceSheetFourHr[2] ) + (parseFloat(priceSheetAddHr[2])*(parseFloat(hrs)-4.0)));
                $("#estPrice").html(parseFloat(estp+shuttle+cargo+wheelchair).toFixed(2));
                $("#priceChart").text(descText + pax + " pax =  $" + priceSheetFourHr[2] + "/$" + priceSheetAddHr[2]); 
                break;
              case 4:
                 estp += (parseFloat(priceSheetFourHr[3] ) + (parseFloat(priceSheetAddHr[3])*(parseFloat(hrs)-4.0)));
                $("#estPrice").html(parseFloat(estp+shuttle+cargo+wheelchair).toFixed(2));
                $("#priceChart").text(descText + pax + " pax =  $" + priceSheetFourHr[3] + "/$" + priceSheetAddHr[3]); 
                break;
              case 5:
                 estp += (parseFloat(priceSheetFourHr[4] ) + (parseFloat(priceSheetAddHr[4])*(parseFloat(hrs)-4.0)));
                $("#estPrice").html(parseFloat(estp+shuttle+cargo+wheelchair).toFixed(2));
                $("#priceChart").text(descText + pax + " pax =  $" + priceSheetFourHr[4] + "/$" + priceSheetAddHr[4]); 
                break;
              default:
                $("#estPrice").html(parseFloat(0).toFixed(2));
                $("#priceChart").text("Calculate Manually");
            }
          }
        } catch(err) { }
      }
	  );       

     
	return false;
	}
  }
}
function getDefaultSystemPrices(){
    const aPriceSheet= [ 0, 0, 0, 0, 0,  0, 0, 0, 0, 0 ];
    var url  = "/grid/ctl.php?x=related&Resource=Business&id=332" ;
	  $.getJSON(url,
	    function(data2) {
          if (data2) 
          {    
              
              aPriceSheet[0] = data2["Cost28FirstFour"];
              aPriceSheet[1] = data2["Cost32FirstFour"];
              aPriceSheet[2] = data2["Cost38FirstFour"];
              aPriceSheet[3] = data2["Cost45FirstFour"];
              aPriceSheet[4] = data2["Cost55FirstFour"];
              aPriceSheet[5] = data2["Cost28OT"];
              aPriceSheet[6] = data2["Cost32OT"];
              aPriceSheet[7] = data2["Cost38OT"];
              aPriceSheet[8] = data2["Cost45OT"];
              aPriceSheet[9] = data2["Cost55OT"];
          }
      }
	  );
  return aPriceSheet;
}

function getEstPricePerBus(pax_idx, hrs, priceSheetFourHr, priceSheetAddHr) {
            switch(pax_idx) {
              case null:
                return 0;
              case 0:
                return 0;
              case 1:
                 return (parseFloat(priceSheetFourHr[0] ) + (parseFloat(priceSheetAddHr[0])*(parseFloat(hrs)-4.0)));
//                $("#estPrice").html(parseFloat(estp+shuttle+cargo+wheelchair).toFixed(2));
//                $("#priceChart").text("Cost: $" + priceSheetFourHr[0] + " / $" + priceSheetAddHr[0] + " (-$50 if One Way) for hours: " + hrs); 
                break;
              case 2:
                 return (parseFloat(priceSheetFourHr[1] ) + (parseFloat(priceSheetAddHr[1])*(parseFloat(hrs)-4.0)));
//                $("#estPrice").html(parseFloat(estp+shuttle+cargo+wheelchair).toFixed(2));
//                $("#priceChart").text("Cost: $" + priceSheetFourHr[1] + " / $" + priceSheetAddHr[1] + " (-$50 if One Way) for hours: " + hrs); 
                break;
              case 3:
                 return (parseFloat(priceSheetFourHr[2] ) + (parseFloat(priceSheetAddHr[2])*(parseFloat(hrs)-4.0)));
//                $("#estPrice").html(parseFloat(estp+shuttle+cargo+wheelchair).toFixed(2));
//                $("#priceChart").text("Cost: $" + priceSheetFourHr[2] + " / $" + priceSheetAddHr[2] + " (-$50 if One Way) for hours: " + hrs); 
                break;
              case 4:
                 return (parseFloat(priceSheetFourHr[3] ) + (parseFloat(priceSheetAddHr[3])*(parseFloat(hrs)-4.0)));
//                $("#estPrice").html(parseFloat(estp+shuttle+cargo+wheelchair).toFixed(2));
//                $("#priceChart").text("Cost: $" + priceSheetFourHr[3] + " / $" + priceSheetAddHr[3] + " (-$50 if One Way) for hours: " + hrs); 
                break;
              case 5:
                 return (parseFloat(priceSheetFourHr[4] ) + (parseFloat(priceSheetAddHr[4])*(parseFloat(hrs)-4.0)));
//                $("#estPrice").html(parseFloat(estp+shuttle+cargo+wheelchair).toFixed(2));
//                $("#priceChart").text("Cost: $" + priceSheetFourHr[4] + " / $" + priceSheetAddHr[4] + " (-$50 if One Way) for hours: " + hrs); 
                break;
              default:
                  return 0;
//                $("#estPrice").html(parseFloat(0).toFixed(2));
//                $("#priceChart").text("Calculate Manually");
            }


}

function formatTime(t) {
   var parts = t.split(/:/), out = {};
   
   if (parts.length > 1) {
      out['hour'] = parts[0].replace(/^0/,'');
      out['meridian'] = 'am';
      if (out['hour'] > 12) {
         out['meridian'] = "pm";
         out['hour'] = out['hour'] - 12;
      } else if (out['hour'] == 12) {
         out['meridian'] = "noon";
      } else if (out['hour'] == 0) {
         out['hour'] = 12;
      }

      out['minute'] = parts[1];
      out['time'] = out['hour'] + ':' + out['minute'] + out['meridian'];

      return out['time'];
   } else {
      return t;
   }
}

function formatDate(str) {
   var out = str;
   if (str && str.match) {
      var parts = str.match(/(\d\d\d\d)\-(\d\d)\-(\d\d)\s(\d\d):(\d\d):(\d\d)/);
      if (parts) {
         var year = parts[1], month = parts[2], day = parts[3], hour = parseInt(parts[4]), minute = parts[5], meridian = 'am';

         if (hour > 12) {
            hour -= 12;
            meridian = 'pm';
         }

         if (hour == 12) {
            meridian = 'noon';
         }

         if (hour == 0) {
            meridian = 'am';
            hour = 12;
         }

         out = day + '/' + month + '/' + year + ' ' + hour + ':' + minute + meridian;
      }
   } 

   return out;
}

function updateNotifyPhone(data) {
   $("#doNotify")[0].checked = false;
   $("#DriverNotification > div").hide();
   if (simpleConfig.current['related_Notify'] && simpleConfig.current['related_Notify'].length) {
      var nrec = simpleConfig.current['related_Notify'].shift();
      deleteNotify(nrec.NotifyID);
   }
} 
//  data.JobDate && data.PickupLocation && data.PickupTime && data.BusID
function updateNotify(data) {
   if (data && data != {}) {
      // showNotify(true);
      $("#Notify-Name").html(data.Name || data.FirstName + " " + data.LastName);
      $("#Notify-Phone").html(data.Voice || data.Phone);
      $("#Notify-Choice").html("1=Yes I accept,2=No I decline");
      $("#Notify-When").html(formatDate(data.When));
      $("#Notify-NotifyID").html(data.NotifyID);
      var teetime = formatTime($("#PickupTime").val());
      $("#editNotify").show().attr('onclick', "return top.loadUrl('/grid/?pid=316&id=" + data.NotifyID);
//      $("#Notify-Notify").html("You are scheduled for a job tomorrow beginning at " + teetime + " with a pickup location from " + $("#PickupLocation").val() + " ");
      $("#Notify-Notify").html(data.Notify);
      // $("#DriverNotification > div").show(150);
      //$("#Notify-When_display").html(simpleConfig.current.JobDate + " 08:00:00");
      //setTime("When", "08:00:00");
   } else {
      $("#Notify-NotifyID").html("");
      $("#Notify-Name").html("");
      $("#Notify-Phone").html("");
      $("#Notify-Choice").html("");
      $("#Notify-When").html("");
      $("#Notify-Notify").html("");
      $("#editNotify").hide();
      // $("#DriverNotification > div").hide(150);
      // showNotify(false);
   }
}

function doDistance(obj) {
   var url = "https://www.google.com/maps/dir/" + encodeURI($('#PickupLocation').val()) + "/" + encodeURI($('#DropOffLocation').val());
   $('#directionsPU').attr('href',url);

}

function doDistanceNo(obj) {
   $("#travelTime").html("");
   $("#totalmeters").html("");
   if (simpleConfig.action != "new") {
      var url;
      var dist = 0;
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
	       dist = (data.rows[0]['elements'][0].distance.value / 1609).toFixed(1);
	       	dist = dist * 2; 
               	$("#totalmeters").html(dist);
		if(dist > 80) 
		{
               		$("#totalmeters").html(dist + " Add Gas $" + (dist*1.1).toFixed(0));
		}
		$("#totalmiles").val(dist);
	    }
         } catch (err) {}
      });
   }

   obj = ($("#EmployeeYard").val());
   $("#travelStartTime").html("");
   $("#travelStartTimeCost").html("");
   if (simpleConfig.action != "new") {
      var url;
      var yarddist = 0;
      if (!obj) {
         url = "/tools/distance.php?origin=" + encodeURI("2294 Vista del Rio St, Crockett, CA") + "&dest=" + encodeURI($("#PickupLocation").val()) + "&mode=driving&language=en-US&sensor=false";
      } else {
         url = "/tools/distance.php?origin=" + encodeURI(obj) + "&dest=" + encodeURI(simpleConfig.current.PickupLocation) + "&mode=driving&language=en-US&sensor=false";
      }

      setTimeout(function() {
        $.getJSON(url,
        function (data) {
         try {
            if (data && data.rows && data.rows[0] && data.rows[0]['elements'] && data.rows[0]['elements'][0].distance) {
               $("#travelStartTime").html(
               data.rows[0]['elements'][0].distance.text + " / " + data.rows[0]['elements'][0].duration.text);
		tripdist = dist; 
		yarddist = (data.rows[0]['elements'][0].distance.value / 1609).toFixed(1);
               $("#travelStartTimeCost").html(
               (((yarddist * 2) + tripdist)).toFixed(1) + " mi, " + (((yarddist * 2) + tripdist) / 6).toFixed(1) + " gal = $" + ((((yarddist * 2) + tripdist) / 6).toFixed(1) * 4) + " / Driver Pay = $" + (($('#Hours').val() * 30) + 60 ) 
	       );
	    }
         } catch (err) {}
        });
	},2500);
      return false;
   }
}

function resetNotify() {
   var nflds = ['When','NotifyID','Name','Phone','Choice','Notify'];

   for (var i=0; i < nflds.length; i++) {
      $("#Notify-" + nflds[i]).val("").attr("name", "Job[" + simpleConfig.id + "][Notify][new1][" + nflds[i] + "]");
   }
}

function showNotify(state) {
   return false;
   if (simpleConfig.current["related_Notify"] && simpleConfig.current["related_Notify"][0]) {
      state = true;
   }
   // $("#doNotify")[0].checked = state;
   if (state) {
      $("#DriverNotification > div").show(150);
   } else {
      $("#DriverNotification > div").hide(150);
   }
}

function upAll(id) {
   return doSelect(id, realUpAll);
}
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
      fetch(url).then(resp=>resp.json()).then(data=>{ 
        try {
            if (data) {
               $("#schoolAddress").html( data["StreetAbr"] + ", " + data["City"] + ", " + data["School"] + " " + data["Phone"]);
            }
         } catch(err) { 
            console.log(`Error [doSchoolAddress]: ${err}`);
         }
      });
      return false;
   }
}

function realUpAll(id) {
   if (id) {
      //$('#mygrid').trigger('reloadGrid');
      //doSelect(id);
      //$("#mygrid").setSelection(simpleConfig.rowid,true);
   }
   if (simpleConfig.current['JobDate'] && simpleConfig.current['EmployeeID'] && simpleConfig.current['PickupLocation'] && simpleConfig.current['PickupTime']) {
     $("#doNotify").removeAttr("disabled");
     $("#notifyToggle").removeClass("disabled");
   } else {
     $("#doNotify").attr("disabled", true);
     $("#notifyToggle").addClass("disabled");
   }
   if (!simpleConfig.current['related_Notify']) {
      $("#doNotify")[0].checked = false;
      updateNotify({});
      $("#DriverNotification > div").hide(150);
   } else {
      $("#doNotify")[0].checked = true;
      updateNotify(simpleConfig.current['related_Notify'][0]);
      $("#DriverNotification > div").show(150);
      $("#notifyToggle").removeClass("disabled");
      $("#doNotify").removeAttr("disabled");
   }
   $("#FinalDropOffLocation").removeAttr("disabled");
   $("#dropoffToggle").prop("checked", false);
   $("#dropoffToggle").removeAttr('checked');
   $("#priceChart").html("");
   $("#estPrice").html("");
   $("#estPrice").val("");
   $("#estPrice").css("background-color: none");

   if (simpleConfig.record && simpleConfig.record.PickupTime) {
      var stimes = getTimes(simpleConfig.record["PickupTime"]);
      $("#Pickup_hour").val(stimes[0]);
      $("#Pickup_minute").val(stimes[1]);
      $("#Pickup_meridian").val(stimes[2]);
   }

   if (simpleConfig.record && simpleConfig.record.DropOffTime) {
      var etimes = getTimes(simpleConfig.record["DropOffTime"]);
      $("#DropOff_hour").val(etimes[0]);
      $("#DropOff_minute").val(etimes[1]);
      $("#DropOff_meridian").val(etimes[2]);
   }

   handleEndTime();
   if (simpleConfig.current['JobDate'] && simpleConfig.current['EmployeeID'] && simpleConfig.current['PickupLocation'] && simpleConfig.current['PickupTime'] && simpleConfig.current['BusID']) {
      $("#doNotify").removeAttr("disabled");
      $("#notifyToggle").removeClass("disabled");
   } else {
      $("#doNotify").attr("disabled", true);
      $("#notifyToggle").addClass("disabled");
   }  
   doDistance(true); 
   $(function() {
      $('textarea').each(function() {
            $(this).height(70);
            $(this).height($(this).prop('scrollHeight'));
      });
   });
}
//  {Select: function(id) { upAll(id); }, "New": function() { myNew(); }} 
function myNew() {
   $("#notifyToggle").removeClass("disabled");
   $("#doNotify").removeAttr("disabled");
   doNew();
//   $('#mygrid').trigger('reloadGrid');
   $("#travelTime").val("");
   $("#DriverNotified").next("span").css({'background-color' : ''});
   $("#DriverNotified").val("0");
   $("#travelTime").html("");
   $("#estPrice").html("");
   $("#estPrice").val("");
   $("#estPrice").css({'background-color': 'none'});
   $("#schoolAddress").html("");
   $("#schoolAddress").val("");
   $("#PickupLocation").removeClass( "ui-state-highlight" );
   $("#DropOffLocation").removeClass( "ui-state-highlight" );
   $("#FinalDropOffLocation").removeClass( "ui-state-highlight" );
   $("#RoundTrip").val("1");
   $("#NumberOfItems").val("");
   $("#JobCompleted").prop("checked", false);
   $("#Cargo").prop("checked", false);
   $("#DriverNotified").prop("checked", false);
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
   $("#Notify-CallerName").val("D Harris Tours");
   $("#Notify-Caller").val("415-902-8542");
   $("#Notify-Name").val("");
   $("#Notify-Phone").val("");

   $("#Pickup_hour").val("");
   $("#Pickup_minute").val("");
   $("#Pickup_meridian").val("");

   $("#DropOff_hour").val("");
   $("#DropOff_minute").val("");
   $("#DropOff_meridian").val("");
   showEnd("1");
   $("#Job").focus();
   
   document.getElementById("formContainer").style.overflow = "scroll";
//   $("formContainer").css('overflow','auto');
   $("#GetPriceButton").addClass( "simpleButton" );
}

function getTimes(mytime) {
   if (mytime) {
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
   } catch (e) {
      console.log("simpleConfig.current does not exist");
      console.dir(simpleConfig);
   }

   $('#mygrid').setCell(simpleConfig.rowid, who + "Time", $("#" + who + "Time").val(), 'modified');

   if (doend) {
    var dhr12 = $("#DropOff_hour").val().replace(/^0/,''),
    dmins = $("#DropOff_minute").val(),
    dmerid = $("#DropOff_meridian").val();
     updateEndTime(dhr12, dmins, dmerid);
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
   if (simpleConfig.record && simpleConfig.record.RoundTrip) {
      var rt = simpleConfig.record["RoundTrip"]; //added
      if ((rt == "1") || (rt == "true")) {
         $("#endspan").show();
      } else {
         $("#endspan").hide();
      }
   }
}

function ToggleEndTime() {
   var rt = simpleConfig.current.RoundTrip;; //added
   if ((rt == "1") || (rt == "true")) {
      $("#endspan").show(2000);
      updateTime('Pickup', true);
   } else {
      $("#endspan").hide("slow");
//      $("#DropOffTime").val('00:00:00');
      $("#FinalDropOffLocation").val('One Way Xfer');
   }
}

function cancelJob(yes) {
   if (yes) {
      $("#QuoteAmount").val("0");
      $("#JobLocation").val("Job Cancelled!");
//      $("#NumberOfItems").val("0");
   }
   return true;
}

function showEnd(yes) {
   if (yes=="1") {
      $('#endspan').show();
      $("#RoundTrip").val("1");
      var pu = $("#PickupLocation").val();
      $("#FinalDropOffLocation").val(pu); //added
      $('#mygrid').setCell(simpleConfig.rowid, "FinalDropOffLocation", $("#FinalDropOffLocation").val(), 'modified'); //added
      $('#mygrid').setCell(simpleConfig.rowid, "RoundTrip", $("#RoundTrip").val(), 'modified'); //added
      //         updateEndTime($("#Pickup_hour").val(),$("#Pickup_minute").val(),$("#Pickup_meridian").val());
      updateTime('Pickup');
   } else {
      $('#endspan').hide();
      //$("#DropOff_hour").val("");
      //$("#DropOff_minute").val("");
      //$("#DropOff_meridian").val("");
      //         $("#RoundTrip").prop("checked", false); //added
      $("#RoundTrip").val("0");
      $('#mygrid').setCell(simpleConfig.rowid, "RoundTrip", $("#RoundTrip").val(), 'modified'); //added
      $("#Hours").val('1.25'); //added
      updateTime('Pickup');
      $('#mygrid').setCell(simpleConfig.rowid, "Hours", $("#Hours").val(), 'modified'); //added
      //$("#DropOffTime").val("NULL"); //added
      $("#FinalDropOffLocation").val('One Way Xfer'); //added
      $('#mygrid').setCell(simpleConfig.rowid, "FinalDropOffLocation", $("#FinalDropOffLocation").val(), 'modified'); //added
      //$('#mygrid').setCell(simpleConfig.rowid, "DropOffTime", 'null', 'modified'); //added
   }


   return true;
}

function doNotify_old(whom, why) {
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
   // make call day before job from 8a to 6p
   var date = new Date($("#JobDate").val()),
     locale = "en-us",
     month = date.toLocaleString(locale, { month: "long" });
   console.log(date);
   var days = parseInt(-1);
   var stime = new Date(date.setHours(8));//" 08:00:00";
   var etime = new Date(date.setHours(18));//" 17:59:59";
   var when = stime.setDate(stime.getDate() + days);
   console.log(when);
       var obj = new Object();
      //     obj.NotifyID = "new1";
      obj.Notify = message;
      obj.Voice = phone;
      obj.Name = who;
      obj.Caller = "415-902-8542";
      obj.CallerName = "D Harris Tours";
      obj.Choice = choice;
      obj.When = $("#JobDate").val() + " 08:00:00";
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
function createNotify() {
  // pmp should we test for this?     if (simpleConfig.current['related_Notify'] && simpleConfig.current['related_Notify'].length) {
   var teetime = formatTime($("#PickupTime").val()), obj = {}, emp;
   if (simpleConfig.current["related_Notify"] && simpleConfig.current["related_Notify"][0]) {
      return false;
   } else {
   if (!simpleConfig.current['related_Employee']) {
      getEmployee(simpleConfig.current['EmployeeID'], createNotify, false);
      return false;
   } else {
      emp = simpleConfig.current['related_Employee'][0];
   }
   // make call day before job from 8a to 6p
   var date = new Date($("#JobDate").val()),
     locale = "en-us",
     month = date.toLocaleString(locale, { month: "long" });
     dd = new Date($("#JobDate").val() + " 09:00:00");
     var newdate = new Date(date);
     newdate.setDate(newdate.getDate() - 1);
     var nd = new Date(newdate);
   var stime = " 09:00:00";
   var etime = " 17:59:59";
   var when = new Date(nd);
   obj.Notify = "You are scheduled for a job " + month + " " + dd.getDate() + " beginning at " + teetime + " with a pickup location from " + $("#PickupLocation").val();
   if(!emp.Cell)
   { 
   	obj.Voice = emp.Phone; 
   }
   else
   {
   	obj.Voice = emp.Cell;
   }
   obj.MaxAttempts = 3;
   obj.Name = emp.FirstName + ' ' + emp.LastName;
   obj.Caller = "415-902-8542";
   obj.CallerName = "D Harris Tours";
   obj.Choice = "1=Yes I accept,2=No I decline";
   obj.When = when.toISOString().split('T')[0] + stime; 
   obj.Until = when.toISOString().split('T')[0] +etime;
   obj.ProcessID = simpleConfig.pid;
   obj.Remote = "Job";
   obj.RemoteID = simpleConfig.id;
   obj.CreatedBy = simpleConfig.userEmail;
   var out = {'Notify': {'new1': obj } }, newnotify = {};
   
   console.dir(out);
   
   // First create Notify record
   var storeID = simpleConfig.id;
   var rowID = simpleConfig.rowid;
   $.post("ctl.php?x=save&rsc=Notify", out, function(data) { 
      $("body").append(data);
      var notifyID = simpleConfig.id;
      simpleConfig.id = storeID;
      newnotify = out.Notify.new1;
      newnotify.NotifyID = notifyID;
      
      console.log("Calling updateNotify from createNotify with: ");
      console.dir(newnotify);
      updateNotify(newnotify);
      out = {};

      // Now clamp Job and Notify together
      out = {data: [
         {ProcessID: simpleConfig.pid, Remote: 'Notify', RemoteID: notifyID, Local: 'Job', LocalID: simpleConfig.id},
         {ProcessID: simpleConfig.pid, Remote: 'Job', RemoteID: simpleConfig.id, Local: 'Notify', LocalID: notifyID}
      ]};
      $.post("ctl.php?x=clamp", out, function(data) {
         console.log(data);
      });
   });
  }
  simpleConfig.id = storeID;
  simpleConfig.rowid = rowID;
doSelect(storeID);
}

function deleteNotify(nid) {
   $.post("ctl.php?x=delete&rsc=Notify&id="+nid);
   $.post("ctl.php?x=unclamp&rsc=Notify&id=" + nid + "&remote=Job&rid=" + simpleConfig.current.JobID);
   alert('Call Notification will NOT occur. Notification removed.');
}
