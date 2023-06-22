<?php  
    if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
    if ($in['rsc'] && $in['id']) {
        $current = $boss->getObject($in['rsc'], $in['id']);
    }
?>
<!DOCTYPE html>
<html lang='en'>
<head>
<title>Reservations &amp; Schedules</title>
<meta charset='utf-8' />
<link href='style.css' rel='stylesheet' />
<link href='fc/lib/main.css' rel='stylesheet' />
<link href='/lib/css/tiny-date-picker.css' rel='stylesheet' />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" integrity="sha384-wESLQ85D6gbsF459vf1CiZ2+rr+CsxRY0RpiF1tLlQpDnAgg6rwdsUF1+Ics2bni" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
      <script type="text/javascript" src="/lib/js/ui.multiselect.js"></script>
      <script type="text/javascript" src="/lib/js/json2.js"></script>
      <script type="text/javascript" src="/lib/js/store.js"></script>

<script src='/lib/js/tiny-date-picker.min.js'></script>
<script>
    window._NOGRID = true;
</script>
<script src='/lib/js/grid.js'></script>
<script src='fc/lib/main.js'></script>
<style>
.center {
   text-align: center;
}
.dlgtitle {
   font-size:1.5em; 
   background-color:#333;
   color:#eee;
   margin:0;
   padding:.5em;
}
.overlay {
   position:absolute;
   z-index:9999;
   background-color:#00000066;
   top:0px;
   left:0px;
   right:0px;
   bottom:0px;
}
.suggestion:hover {
   background-color:#333;
   color:#eee;
   cursor:pointer;
}
.suggestion a:hover {
   color:#fff;
   font-weight:bold;

}
#dialog {
   position:absolute;
   width:35rem;
   background-color:#ffffff;
   border:1px solid #000;
   box-shadow: 3px 3px 3px #000000cc;
   left:30%;
   top:10rem;
   padding:0px;
}
.dlgform {
   padding:1rem;
}
.form-group {
   position:relative;
}
.suggestions {
   position:absolute;
   left:8em; 
   width:75%;
   height:0rem;
   transition: height 200ms;
   background-color:#fff;
   border:0px solid #3330;
   padding:0px;
   z-index:99999;
   overflow-y:scroll; 
}
.suggestion a {
   padding:.5rem;
   text-decoration:none;
   color:#333; 
}
#dialog label {
   display:inline-block;
   width:8em;
   text-align:right;
}
.form-control {
   width:22rem;
   display:inline-block;
}
.form-time {
   width:5em;
   display:inline-block;
}
.alignright {
   text-align:right;
}
div.dropdown-open {
   display:block;
}
div.dropdown-menu {
   box-shadow: 3px 3px 3px #0009;
   transition: all 200ms linear;
}
main {
   display: flex;
}
#filler {
   flex-grow:1;
   border:1px solid #900;
   height:auto;
   width:100%;
}
.left {
  height: 100vh;
  display: flex;
  flex-direction: column;
}
.right {
   /* display: flex; */
   flex-direction: column;
   height:100vh;
}
#joblist table {
   border-collapse: collapse;
   padding:0px;

}
#joblist table th {
   z-index:999;
}
#calendar div.fc-timeline-slots td:nth-child(2n-1) {
   border-left: 1px solid #ccc; 
}
#calendar div.fc-timeline-slots td:nth-child(2n-0) {
   border-left: 1px solid #bbb; 
}
#calendar div.fc-timeline-slots td:nth-child(4n-0), 
#calendar div.fc-timeline-slots td:nth-child(4n-1) {
   background-color:#ddd4;
}
#calendar table.fc-scrollgrid-sync-table tr:nth-child(2n) {
   background-color:#fafafa;
}
#calendar {
   overflow:scroll;
   height: 40vh;
}
#calendar2 {
   overflow:scroll;
   height: 40vh;
}
#calendar3 {
  overflow:scroll; 
}
#buses, #drivers {
    height: 32vh;
    overflow: scroll;
}
#details {
   flex: 50%;
}
#detail {
    height: 62vh;
}
#loaderWrap {
   position:absolute;
   top:0px;
   left:0px;
   right:0px;
   bottom:0px;
   background-color:#0005;
   z-index:9999;
   display:flex;
   align-items: center;
   justify-content: center;
}
#loader {

}
.loader,
.loader:before,
.loader:after {
  background: #1c76c4;
  animation: load1 1s infinite ease-in-out;
  width: 1em;
  height: 4em;
}
.loader {
  color: #1c76c4;
  text-indent: -9999em;
  margin: 88px auto;
  position: relative;
  font-size: 11px;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-animation-delay: -0.16s;
  animation-delay: -0.16s;
}
.loader:before,
.loader:after {
  position: absolute;
  top: 0;
  content: '';
}
.loader:before {
  left: -1.5em;
  -webkit-animation-delay: -0.32s;
  animation-delay: -0.32s;
}
.loader:after {
  left: 1.5em;
}
@keyframes load1 {
  0%, 80%, 100% {
    box-shadow: 0 0;
    height: 4em;
  }
  40% {
    box-shadow: 0 -2em;
    height: 5em;
  }
}
#viewer {
    height: 100%;
    width: 100%;
}
#details {
    border-top:2px inset #333;
}
#tabbar {
   height: 3em;
   background:#eee;
}
.resizing {
    cursor: ns-resize;
}
#resizer {
    height: 7px;
    border-top: 2px outset #fff;
    border-bottom: 2px outset #ccc;
    cursor: ns-resize;
    margin-bottom: 1px;
    background-color:#ddd;
}
</style>
</head>
<body>
<main>
   <div class='left'>
      <div id='tinycal'></div>
      <div id='calendar3'></div>
   </div>
<script>
   var dp = TinyDatePicker('#tinycal', { 
      format(date) {
         return date.toLocaleDateString();
      },
      parse(str) {
          var date = new Date(str);
          return isNaN(date) ? new Date() : date;
      },
      mode: 'dp-permanent' 
   });

   dp.on('select', (_, dp) => {
         console.log("SELECTED", dp.state.selectedDate);
         calendar.gotoDate(dp.state.selectedDate);
         calendar2.gotoDate(dp.state.selectedDate);
         calendar3.gotoDate(dp.state.selectedDate);
      }
   );

   dp.on('statechange', (_, picker) => { 
      console.log("statechange");
   } );
   var calendar, calendar2, calendar3, calendarEl, calendarEl2, calendarEl3;;

   function doCalendar(buses) {
      calendarEl = document.getElementById('buses');
      
      calendar = new FullCalendar.Calendar(calendarEl, {
         initialView: 'resourceTimelineDay',
         scrollTime: '08:00',
         nowIndicator: true,
         editable: true,
         height: "auto",
         selectable: true,
         headerToolbar: {
           left: 'prev,next today',
           center: 'title',
           right: 'resourceTimelineDay,resourceTimelineTwoDay,resourceTimelineWeek,resourceTimelineMonth,resourceTimelineYear'
         },
         lazyFetching: false,
         //eventMaxStack: 1,
         expandRows: true,
         views: {
           resourceTimelineDay: {
             type: 'resourceTimeline',
             duration: { days: 1 },
             buttonText: '1 day',
           },
            resourceTimelineTwoDay: {
             type: 'resourceTimeline',
             duration: { days: 2 },
             buttonText: '2 days',
           },
           resourceTimelineWeek: {
             type: 'resourceTimeline',
             duration: { days: 7 },
             buttonText: 'Week'
           }
         },
         resourceAreaWidth: "15em",
         resourceGroupLabelContent: function(arg) {
            console.log("resourceGroupLabelContent")
            console.dir(arg);
         },
         resourceAreaColumns: [
            {
               headerContent: "Resource",
               field: "title"
            },
            {
               headerContent: "Capacity",
               field: "capacity"
            }
         ],
         eventMaxStack: 2,
         timeZone: "local",
         schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
         //// uncomment this line to hide the all-day slot
         allDaySlot: false,
         // resourceAreaHeaderContent: 'Buses',
         resourceAreaHeaderClassNames: [ 'center' ],
         resources: (buses) ? buses : "api.php?type=resources",
         events: {
            url: "api.php?type=events"
         },
         refetchResourcesOnNavigate: true,
         eventSourceSuccess: function(content, xhr) {
           console.log("eventSourceSuccess");
           console.dir(content);
           
           setupUI();
           let html = `<table class='jobs'><thead><tr><th>Job</th><th>Date</th><th>Start</th><th>End</th><th>Link</th></tr></thead><tbody>`;
           let sel = calendar.getDate(), rowclass='';
           
           let selStart = calendar.view.currentStart.getTime(); // (new Date(calendar.getDate().toISOString().substr(0,10)).getTime()); 
           let selEnd = calendar.view.currentEnd.getTime(); 
/*
           for (let i in content) { 
              id = (new Date(content[i].start).getTime());
              if ((id > selStart) && (id < selEnd)) {
                  rowclass = "";
                  if (content[i].title.match(/CANCELLED/i)) {
                     content[i].title = content[i].title.replace(/\s*CANCELLED\s+/, '');
                     rowclass = "cancelled";
                  } else {
                     rowclass = "";
                  }
                  html += `<tr>
                     <td class='${rowclass}'>${content[i].title}</td><td class='${rowclass}'>${content[i].date}</td><td class='${rowclass}'>${cleanTime(content[i].start)}</td><td class='${rowclass}'>${cleanTime(content[i].end)}</td><td><a target='_blank' href="${content[i].url}">&#128279;</a></td></tr>`;
              }
           }
           html += "</tbody></table><div id='filler'></div>";
           const jobs = document.querySelector("#buses");
           jobs.innerHTML = html;
           console.log(html);
*/

           selectTab(document.querySelector("a[href='#buses']")); 
            return content.eventArray;
         },
         loading: function( isLoading ) {
            /*
            if (!isLoading) {
               let topCal = document.querySelector("#buses > div.fc-view-harness.fc-view-harness-passive > div > table > tbody > tr > td:nth-child(3) > div > div");
               let btmCal = document.querySelector("#drivers > div > div > table > tbody > tr > td:nth-child(3) > div > div");
               topCal.onscroll = function(evt) {
                  btmCal.scrollLeft = this.scrollLeft;
               };
            }
            */
         },
         select: function(arg) {
           console.log(
             'select',
             arg.startStr,
             arg.endStr,
             arg.resource ? arg.resource.id : '(no resource)'
           );
           modal(arg.start, arg.end, arg.resource);
         },
         dateClick: function(arg) {
           console.log(
             'dateClick',
             arg.date,
             arg.resource ? arg.resource.id : '(no resource)'
           );
         },
         datesRender: function(arg) {
            dp.setState({"selectedDate": new Date(arg.view.currentStart.getTime())})
            console.log("datesRender");
            console.dir(arg);
         }
    });

    calendar.render();

   }
   function doCalendar2(drivers) {
      
      calendar2 = new FullCalendar.Calendar(document.querySelector("#drivers"), {
         initialView: 'resourceTimelineDay',
         scrollTime: '08:00',
         nowIndicator: true,
         editable: false,
         refetchResourcesOnNavigate: true,
         height: "auto",
         selectable: true,
         headerToolbar: false,
         lazyFetching: false,
         //eventMaxStack: 1,
         expandRows: true,
         views: {
           resourceTimelineDay: {
             type: 'resourceTimeline',
             duration: { days: 1 },
             buttonText: '1 day',
           },
            resourceTimelineTwoDay: {
             type: 'resourceTimeline',
             duration: { days: 2 },
             buttonText: '2 days',
           },
           resourceTimelineWeek: {
             type: 'resourceTimeline',
             duration: { days: 7 },
             buttonText: 'Week'
           }
         },
         resourceAreaWidth: "15em",
         resourceAreaColumns: [
            {
               headerContent: "Driver",
               field: "title"
            }
         ],
         resourceOrder: "title",
         eventMaxStack: 2,
         timeZone: "local",
         schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
         //// uncomment this line to hide the all-day slot
         allDaySlot: false,
         // resourceAreaHeaderContent: 'Buses',
         resourceAreaHeaderClassNames: [ 'center' ],
         resources: (drivers) ? drivers : "api.php?type=driverresources",
         events: {
            url: "api.php?type=events&driver=1"
         },
         eventSourceSuccess: function(content, xhr) {
           console.log("eventSourceSuccess");
           console.dir(content);
           
           setupUI();
           return content.eventArray;
         },
         select: function(arg) {
           console.log(
             'select',
             arg.startStr,
             arg.endStr,
             arg.resource ? arg.resource.id : '(no resource)'
           );
           modal(arg.start, arg.end, arg.resource);
         },
         dateClick: function(arg) {
           console.log(
             'dateClick',
             arg.date,
             arg.resource ? arg.resource.id : '(no resource)'
           );
         },
         datesRender: function(arg) {
            dp.setState({"selectedDate": new Date(arg.view.currentStart.getTime())})
            console.log("datesRender");
            console.dir(arg);
         }
    });

    calendar2.render();

   }

   function doCalendar3(jobs) {
      
      calendar3 = new FullCalendar.Calendar(document.querySelector("#calendar3"), {
         initialView: 'listDay',
         height: "auto",
         selectable: true,
        customButtons: {
            addJob: {
                text: "+",
                click: function() {
                    modal(new Date(), new Date(), '');
                }
            }
        },
        headerToolbar: {
            start: 'title',
            center: '',
            end: 'addJob'
        },
         lazyFetching: false,
         //eventMaxStack: 1,
         expandRows: true,
         titleFormat: {
            month: 'long',
            day: 'numeric',
            year: 'numeric'
        },
         listDayFormat: {
            weekday: 'long'
         },
         views: {
           listDay: {
             type: 'listDay',
             duration: { days: 1 },
             buttonText: '1 day',
           },
            listWeek: {
             type: 'listWeek',
             duration: { days: 7 },
             buttonText: 'Week',
           },
           listMonth: {
             type: 'listMonth',
             duration: { days: 31 },
             buttonText: 'Month'
           }
         },
         eventMaxStack: 2,
         timeZone: "local",
         schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
         //// uncomment this line to hide the all-day slot
         allDaySlot: false,
         // resourceAreaHeaderContent: 'Buses',
         events: {
            url: "api.php?type=events&start=" + formatDate(new Date()) + "&end=" + formatDate(new Date())
         },
         eventSourceSuccess: function(content, xhr) {
           console.log("eventSourceSuccess");
           console.dir(content);
           setupUI();
           return content.eventArray;
         },
         select: function(arg) {
           console.log(
             'select',
             arg.startStr,
             arg.endStr,
             arg.resource ? arg.resource.id : '(no resource)'
           );
           modal(arg.start, arg.end, arg.resource);
         },
         dateClick: function(arg) {
           console.log(
             'dateClick',
             arg.date,
             arg.resource ? arg.resource.id : '(no resource)'
           );
         },
         datesRender: function(arg) {
            dp.setState({"selectedDate": new Date(arg.view.currentStart.getTime())})
            console.log("datesRender");
            console.dir(arg);
         },
         eventDidMount: function(info) {
            
         }
    });

    calendar3.render();

   }
   function stringToColor(str, saturation = 100, lightness = 75)  {
      let hash = 0;
      for (let i = 0; i < str.length; i++) {
         hash = str.charCodeAt(i) + ((hash << 5) - hash);
         hash = hash & hash;
      }
      return `hsl(${(hash % 360)}, ${saturation}%, ${lightness}%)`;
   }

   function formatDate(date) {
      let m = date.getMonth() + 1;
      if (m < 10) {
         m = "0" + m.toString();
      }
      let d = date.getDate();
      if (d < 10) {
         d = "0" + d.toString();
      }
      let yr = date.getFullYear();
      return `${yr}-${m}-${d}`;
   }

   function cleanTime(date) {
      var mydate = new Date(date);
      var hr = mydate.getHours();
      var xm = (hr < 12) ? "am" : "pm";
      hr = (hr > 12) ? hr - 12 : hr;
      if (hr == 0) {
         hr = 12;
      }
      var min = mydate.getMinutes();
      min = (min < 10) ? "0" + min : min;

      var mytime = hr+':'+min+xm;

      if (mytime == "12:00am") {
         mytime = "-";
      }
      return mytime;
   }

   function handleClick(who) { 
      document.querySelector("#viewer").src = "/grid/view.php?pid=335&id=" + who + "&rsc=Job";

      makeRequest('GET', 'api.php?type=event&id='+who, function (err, datums) {
        myevent = JSON.parse(datums);
        console.dir(myevent);
        
        /*
        var out = `<table id='jobdetail'>
         <tr>
            <th>Job ID</th><td>${myevent.JobID}</td>
            <th>Passengers</th><td>${((myevent.NumberOfItems) ? myevent.NumberOfItems : "?")}</td>
         </tr>
         <tr><th>Job</th><td colspan='3'>${myevent.Job}</td></tr>
         <tr><th>Bus</th><td colspan='3'>${mybuses[myevent.BusID].title}</td></tr>`;
        
        var driver = (myevent && myevent.EmployeeID && mydrivers && mydrivers[myevent.EmployeeID]) ? mydrivers[myevent.EmployeeID].Driver + " - " + mydrivers[myevent.EmployeeID].Phone : "Unassigned";
      
        out += `
         <tr><th>Driver</th><td colspan='3'>${driver}</td></tr>
         <tr><th>Pickup</th><td colspan='2'>${((myevent.PickupLocation) ? myevent.PickupLocation : "")}</td><td>${myevent.PickupTime}</td></tr>
         <tr><th>Dropoff</th><td colspan='2'>${((myevent.DropOffLocation) ? myevent.DropOffLocation : "")}</td><td>${myevent.DropOffTime}</td></tr>`;
        
        if (myevent.finalDropOffLocation) {
         out += `<tr><th>Final</th><td colspan='2'>${myevent.FinalDropOffLocation}</td></tr>`;
        }

        out += `<tr><th>Color</th><td colspan='2'><input type='color' value='${myevent.Color}' id='color' onchange='updateColor(this.value, ${myevent.JobID})'></td></tr>`;
        out += `</table>`;

        //document.querySelector("#detail").innerHTML = out;
        //selectTab("#detail");
        if (err) { throw err; }
        console.log(datums);
        */
      }); 
   } 
   function updateColor(newcolor, id) {
      console.log(`updateColor: ${newcolor} [${id}] `);
      if (color && id) {
         let url = `api.php?id=${id}&type=updateColor&color=${encodeURIComponent(newcolor)}`;
         console.log(url);
         fetch(url).then(response=>response.json()).then(data=>{
            console.dir(data);

         });
      }
   }

   function makeRequest (method, url, done) {
     var xhr = new XMLHttpRequest();
     xhr.open(method, url);
     xhr.onload = function () {
       done(null, xhr.response);
     };
     xhr.onerror = function () {
       done(xhr.response);
     };
     xhr.send();
   }
   function cleanTabs(selector) {
      var tab_lists_anchors = document.querySelectorAll(selector + " li a");
      var divs = document.querySelector(selector).getElementsByTagName("div");
      
      document.querySelector("#drivers").style.display = "none";
      document.querySelector("#buses").style.display = "none";
      document.querySelectorAll(".active").forEach(el=>el.classList.remove('active'));

      for (i = 0; i < divs.length; i++) {
          divs[i].style.display = "none";
      }

      for (i = 0; i < tab_lists_anchors.length; i++) {
          tab_lists_anchors[i].classList.remove("active");
      }
 
   }
   function selectTab(who) {
      cleanTabs(".tabs");
      if (typeof who === "string") {
         who = document.querySelector("a[href=\""+who+"\"]");
      }
      who.classList.add('active');
      div_to_show = who.getAttribute('href');
      let rid = who.getAttribute('href').replace(/^\#/, '');
      console.log(`selected tab ${div_to_show} with real id of '${rid}'`);
      document.querySelector(div_to_show).style.display = "block";

   }
function makeTabs(selector) {
    tab_lists_anchors = document.querySelectorAll(selector + " li a");
    divs = document.querySelector(selector).getElementsByTagName("div");
    
    for (var i = 0; i < tab_lists_anchors.length; i++) {
        if (tab_lists_anchors[i].classList.contains('active')) {
            if (divs[i]) divs[i].style.display = "block";
        }
 
    }
 
    for (i = 0; i < tab_lists_anchors.length; i++) {
        document.querySelectorAll(".tabs li a")[i].addEventListener('click', function(e) {
 
            cleanTabs(selector);
 
            clicked_tab = e.target || e.srcElement;
            selectTab(clicked_tab); 
        });
    }
}
function makeSettingsDropdown(resources) {
    var toolbar = document.querySelector(".fc-right .fc-button-group");

    if (toolbar) {
       var el = document.createElement('button');
       el.className = "dropdown fc-button-primary";
       el.style = "margin-left:.25rem;";      
       var btn = "<button id='settingButton' class='fc-button fc-button-primary dropdown-toggle' data-toggle='dropdown'>Buses</button>";
       var list = document.createElement('div');
       var html = "<div class='dropdown-menu dropdown-menu-right'>";

       for (var i in resources) {
           html += "<a class='dropdown-item' href='#'><input type='checkbox' class='showbus_checkbox' id='showbus_" + resources[i].id + "' checked='true'> " + resources[i].title + "</a>\n";
       }
       html += "</div>";
       el.innerHTML = btn + html;
       console.log("makeSettingsDropdown");
       console.log(el.innerHTML);
       console.dir(el);
       toolbar.appendChild(el);
       document.querySelector("#settingButton")?.addEventListener('click', function(e) {
         console.log("settingButton", e);
         document.querySelector(".dropdown-menu").classList.toggle('dropdown-open');
       });
       document.querySelector(".showbus_checkbox")?.addEventListener('click', function(e) {
          if (this.checked) {
             
          }
       });
    }

}

function setupUI() {
    let vsize = local_data.get("vsize");
    console.log(`setupUI`);
    console.dir(vsize);
        console.log(`Setting cal height to ${(vsize["vsize"] - 50) + 'px'}`);
    if (vsize && vsize["vsize"]) {
        console.log(`Setting cal height to ${(vsize["vsize"] - 50) + 'px'}`);
        document.querySelector(".active-viewer").style.height = (vsize.vsize - 50) + 'px';
        document.querySelector("#buses").style.height = (vsize.vsize - 50) + 'px';
        document.querySelector("#drivers").style.height = (vsize.vsize - 50) + 'px';
    }
}

var buses, myevent, drivers, mybuses = [], mydrivers = [], myjobs = [];
function init() {
    calendarEl2 = document.querySelector("#calendar2");
    calendarEl3 = document.querySelector("#calendar3");
   // Fetch vehicle(resources) data and store for later use
   makeRequest('GET', 'api.php?type=resources', function (err, data) {
      buses = JSON.parse(data);
      for (var i=0; i<buses.length; i++){
         mybuses[buses[i].busID] = buses[i];
      }
      //makeSettingsDropdown(buses);
      console.log("Buses:");
      console.dir(mybuses);
      doCalendar(buses)
      setupUI();
   });
   
   makeRequest('GET', 'api.php?type=jobs&start='+formatDate(new Date()) +'&end=' + formatDate(new Date()), function (err, data) {
      jobs = JSON.parse(data);
      for (var i=0; i<jobs.length; i++){
         myjobs[jobs[i].id] = jobs[i];
      }
      //makeSettingsDropdown(drivers);
      console.log("Jobs:");
      console.dir(myjobs);
      doCalendar3(jobs);
      setupUI();
   });
    makeRequest('GET', 'api.php?type=driverresources', function (err, data) {
      drivers = JSON.parse(data);
      for (var i=0; i<drivers.length; i++){
         mydrivers[drivers[i].id] = drivers[i];
      }
      //makeSettingsDropdown(drivers);
      console.log("Drivers:");
      console.dir(mydrivers);
      doCalendar2(drivers);
   });
 
   // Fetch driver data and store for later use
   makeRequest('GET', 'api.php?type=drivers', function (err, data) {
      drivers = JSON.parse(data);
      for (var i=0; i<drivers.length; i++){
         mydrivers[drivers[i].EmployeeID] = drivers[i];
      }
      console.log("Drivers:");
      console.dir(mydrivers);
   });

   makeTabs(".tabs");
    let grip = document.querySelector("#resizer");
    grip.addEventListener("mousedown", startResize);
}

function startResize(evt) {
    let bod = document.querySelector("body");
    bod.classList.add("resizing");
    bod.addEventListener("mousemove", doResize, false);
    bod.addEventListener("mouseup", stopResize, false);
    document.querySelector(".active-viewer").style.height = (evt.pageY - 50)+ 'px';
    console.log("startResize");
    console.dir(evt);
}

function doResize(evt) {
    console.log("doResize:");
    console.dir(evt);
    document.querySelector(".active-viewer").style.height = (evt.pageY -50) + 'px';
}

function stopResize(evt) {
    console.log(`stopResize:`);
    console.dir(evt);
    document.querySelector("body").removeEventListener("mousemove", doResize, false);
    document.querySelector("body").removeEventListener("mouseup", stopResize, false);
    document.querySelector(".active-viewer").style.height = (evt.pageY -50) + 'px';
    local_data.store("vsize", {"vsize": evt.pageY});
    let bod = document.querySelector("body");
    bod.classList.remove("resizing");
}

function formatTime(d) {

   var hr = parseInt(d.toISOString().substr(11,2));
   var xm = 'am';
   if (hr>=12) {
      hr -= 12;
      xm = 'pm';
   }
   var min = d.toISOString().substr(14,2);

   return hr + ':' + min + xm;
}

function closeDialog() {
   var over = document.querySelector("#overlay");
   over.parentElement.removeChild(over);
}

function makeReservation() {
   const customer = document.querySelector('#customer').value;
   const pickup = document.querySelector('#pickup').value;
   const dropoff = document.querySelector('#dropoff').value;
   const frel = document.querySelector('#from').value;
   const toel = document.querySelector('#to').value;
   const pax = document.querySelector('#pax').value;

   const out = { "customer": customer, "date": window.reservation.date, "pickup": pickup, "dropoff": dropoff, "from": window.reservation.from, "to": window.reservation.to, "pax": pax };
   fetch("api.php?type=reserve&data=" + encodeURIComponent(JSON.stringify(out))).then((response) => { return response.json(); }).then((data) => {
      console.log("from fetch in makeReservation");
      console.dir(data);
      closeDialog();
      
      var alert = document.createElement('div');
      alert.className = "alert alert-warning alert-dismissible fade show toast";
      alert.role = 'alert';

      var html = "<b>Success!</b> Your reservation has been made.";
      html += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

      alert.innerHTML = html;
      document.body.append(alert);
      //alert.toast('show');
      alert.alert();


   });
   return false;
}

function modal(from, to, rsc) {
   var overlay = document.createElement('div');
   overlay.id = 'overlay';
   overlay.className = 'overlay';
   
   window.reservation = { "date": from.toLocaleDateString(), "from": from, "to": to };

   var oform = `<div id='dialog'>
   <div class='dlgtitle'>Reserve Bus <span id='Bus'>${rsc._resource.id}</span> on <span id='JobDate'>${from.toLocaleDateString()}</span></div>
   <div class='dlgform'>
      <div class='form-group'><label for='customer'>Customer</label> <input type='text' id='customer' name='customer' placeholder='Customer' class='form-control' onchange='handleForm(this)' autocomplete='off' /><div id='customer_suggestions' class='suggestions'></div></div>
      <div class='form-group'><label for='from'>From</label> <input type='text' id='from' name='from' placeholder='Pickup Time' value='${formatTime(from)}' size='10' class='form-time' onchange='handleForm(this)'/>
      <label style='width:2em' for='to'>To</label> <input type='text' id='to' name='to' placeholder='Dropoff Time' value='${formatTime(to)}' size='10' class='form-time' onchange='handleForm(this)'/>
      <label style='width:3em' for='pax'>Pax</label> <input type='text' id='pax' name='pax' placeholder='<=${rsc._resource.id.substr(0,2)}' size='10' class='form-time' onchange='handleForm(this)' autocomplete='off' /></div>
      <div class='form-check form-check-inline'><input class='form-check-input' type='radio' id='oneway' name='triptype' onchange='handleForm(this)' /><label class='form-check-label' for='oneway'>One Way</label>
      <input class='form-check-input' type='radio' id='roundtrip' name='triptype' onchange='handleForm(this)' checked=true /><label class='form-check-label' for='roundtrip'>Round Trip</label></div>
      <div class='form-group'><label for='pickup'>Pickup</label> <input type='text' id='pickup' name='pickup' placeholder='Pickup Location' class='form-control' onchange='handleForm(this)' autocomplete='off' /><div id='pickup_suggestions' class='suggestions'></div></div>
      <div class='form-group'><label for='dropoff'>Dropoff</label> <input type='text' id='dropoff' name='dropoff' placeholder='Dropoff Location' class='form-control' onchange='handleForm(this)' autocomplete='off' /><div id='dropoff_suggestions' class='suggestions'></div></div>
      <div class='form-group alignright'><button type='button' id='dlg_cancel' onclick='closeDialog()'>Cancel</button> <button type='button' id='dlg_reserve' onclick='return makeReservation()'>Reserve</button></div>
   </div>
</div>`;

   overlay.innerHTML = oform;
   document.body.append(overlay); 
  
   const customer = document.querySelector('#customer');
   const pickup = document.querySelector('#pickup');
   const dropoff = document.querySelector('#dropoff');
   const frel = document.querySelector('#from');
   const toel = document.querySelector('#to');
   const pax = document.querySelector('#pax');
   const dlgform = document.querySelector('#newdlg');
    
   customer.addEventListener("keydown", event => { doSuggestions('customer', event); });
   pickup.addEventListener("keydown", event => { doSuggestions('pickup', event); });
   dropoff.addEventListener("keydown", event => { doSuggestions('dropoff', event); });
   //dlgform.addEventListener("submit", event => { makeReservation(event, customer.value, pickup.value, dropoff.value, frel.value, toel.value, pax.value); });
   customer.focus();
}
let local_data = {
    store: function(key, obj) {
        if (key && obj) {
            localStorage.setItem(key, JSON.stringify(obj));
        }
    },
    get: function(key) {
        let out;
        if (key) {
            let item = localStorage.getItem(key);
            if (item) {
                out = JSON.parse(item);
            } else {
                out = {};
            }
            return out;
        } else {
            return {};
        }
    }
};

function handleForm(obj) {
   console.log("handleForm");
   console.dir(obj);
}

function pickSuggestion(txt, who) {
   txt = txt.replace(/<[^>]*>/g, '');
   var el = document.querySelector('#' + who);
   el.value = txt;
   const dropdown = document.querySelector("#" + who + "_suggestions");
   dropdown.style.height = "0px";
   dropdown.style.border = '0px';
   return false;
}
window.dialogState = {};

function doSuggestions(who, evt) {
   console.dir(evt);
   if (evt.key == "Backspace") {
      return true;
   }
   var txt = document.querySelector("#"+who).value;
   if (evt.key.length===1) {
      txt += evt.key;
   }
   
   // Handle 'ESC' key
   if (evt.keyCode === 27) {
      if (window.dialogState.open) {
         window.dialogState.nosuggestions = true;
         const dd = document.querySelector("#" + who + "_suggestions");
         if (dd) {
            dd.style.height = "0px";
            dd.style.border = "0px";
         }
      }
   }

   if ((evt.key == "Tab") || (evt.keyCode === 13)) {
      if (window.suggestions.length) {
         pickSuggestion(window.suggestions[0], who);
      }

      if (who == 'customer') {
         document.querySelector('#pickup').focus();
      } else if (who == 'pickup') {
         document.querySelector('#dropoff').focus();
      } else if (who == 'dropoff') {
         document.querySelector('#dlg_cancel').focus();
      }
      window.suggestions = [];
      window.dialogState.nosuggestions = false;
      evt.preventDefault();
      evt.stopPropagation();
      return false;
   }

   if (!txt.match(/\w/)) {
      var el = document.querySelector("#" + who + "_suggestions");
      el.innerHTML = '';
      el.style.height = "0px";
      el.style.border = "0px solid #3330";
      return true;
   }
   if (!window.dialogState.nosuggestions) {
      fetch("api.php?type=suggestion&rsc=" + who + "&q=" + txt).then((response) => { return response.json(); }).then((data) => {
         var out = '';
         window.suggestions = data['results'];

         for (var i in data['results']) {
            var item = data['results'][i];
            out += "<div class='suggestion'><a href='#' onclick='return pickSuggestion(\"" + item + "\", \""+who+"\")'>" + item + "</a></div>";
         }
         var el = document.querySelector("#" + who + "_suggestions");
         el.innerHTML = out;
         el.style.height = "9rem";
         el.style.border = "1px solid #333";
         window.dialogState.open = who;
      });
   }
}
      var simpleConfig = {
         resource:"<?php print $in['rsc']; ?>",
         pid: <?php print $in['pid'] ? $in['pid'] : "''"; ?>,
         process: <?php print json_encode($process); ?>,
         record: <?php print json_encode($current); ?>, // { "<?=$rsc?>ID": "new1" },
         <?php if ($process->Actions) { ?>actions: <?php print $process->Actions; ?>,<?php } ?>
         <?php if ($model->LoginID==$_SESSION['LoginID']) { ?>ModelID: <?php print $model->ModelID; ?>,<?php } ?>
         viewstate: 1,
         gridstate: 0,
         action: "new",
         id: null,
         grids: [],
         userEmail: "<?php print $_SESSION['Email']; ?>",
         init: "<?php print ($in['do']) ? $in['do'] : $process->JS; ?>",
         current: <?php print json_encode($current); ?>
      };

window.addEventListener("load", init);
</script>
   <div class='right'>
      <div id='details' class='tabs'>
         <ul>
           <li><a href="#buses" class="active buses">Buses</a></li> 
           <li><a href="#drivers" class='drivers'>Drivers</a></li> 
         </ul>
      </div>
      <div id='buses' class='active-viewer'></div>
      <div id='drivers'></div>
      <div id='resizer'></div>
      <div id='detail'><iframe src='/grid/view.php?id=<?php print $in['id']; ?>&rsc=Job&pid=335' id='viewer'></iframe>
<?php
    //include("/simple/clients/dharristours/templates/Jobs6_2.php");

?>
      </div>
   </div>
</main>
<div id='loaderWrap' style="display:none;">
   <div id='loader' class='loader'>Loading...</div>
</div>
<div id='overlay' class='overlay' style='display:none;'>
   <div id='dialog'>
      <div class='dlgtitle'>Reserve Bus for <span id='JobDate'></span></div>
      <div class='dlgform'>
         <div class='form-group'><label for='customer'>Customer</label> <input type='text' id='customer' name='customer' placeholder='Customer' class='form-control' onchange='handleForm(this)' autocomplete='off' /><div id='customer_suggestions' class='suggestions'></div></div>
         <div class='form-group'><label for='from'>From</label> <input type='text' id='from' name='from' placeholder='Pickup Time' value='${formatTime(from)}' size='10' class='form-time' onchange='handleForm(this)'/>
         <label style='width:2em' for='to'>To</label> <input type='text' id='to' name='to' placeholder='Dropoff Time' value='${formatTime(to)}' size='10' class='form-time' onchange='handleForm(this)'/>
         <label style='width:3em' for='pax'>Pax</label> <input type='text' id='pax' name='pax' placeholder='<=${rsc._resource.id.substr(0,2)}' size='10' class='form-time' onchange='handleForm(this)' autocomplete='off' /></div>
         <div class='form-check form-check-inline'><input class='form-check-input' type='radio' id='oneway' name='triptype' onchange='handleForm(this)' /><label class='form-check-label' for='oneway'>One Way</label>
         <input class='form-check-input' type='radio' id='roundtrip' name='triptype' onchange='handleForm(this)' checked=true /><label class='form-check-label' for='roundtrip'>Round Trip</label></div>
         <div class='form-group'><label for='pickup'>Pickup</label> <input type='text' id='pickup' name='pickup' placeholder='Pickup Location' class='form-control' onchange='handleForm(this)' autocomplete='off' /><div id='pickup_suggestions' class='suggestions'></div></div>
         <div class='form-group'><label for='dropoff'>Dropoff</label> <input type='text' id='dropoff' name='dropoff' placeholder='Dropoff Location' class='form-control' onchange='handleForm(this)' autocomplete='off' /><div id='dropoff_suggestions' class='suggestions'></div></div>
         <div class='form-group alignright'><button type='button' id='dlg_cancel' onclick='closeDialog()'>Cancel</button> <button type='button' id='dlg_reserve' onclick='return makeReservation()'>Reserve</button></div>
      </div>
   </div>
</div>
</body>
</html>