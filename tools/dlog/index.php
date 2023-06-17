<?php
    include("/simple/.env");
    include("/simple/lib/auth.php");

    $in = $_REQUEST;
    
    if (!array_key_exists("date", $in)) {
        $in['date'] = "2023-05-11";
    }

    if (!array_key_exists("driver", $in)) {
        $in['driver'] = 67;
    }
?>
<!DOCTYPE html> 
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Daily Driver Log</title>
   <link href="//fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">
   <link href='/lib/css/tiny-date-picker.css' rel='stylesheet'>
   <link href='main.css' rel='stylesheet'>
   <script src='/lib/js/tiny-date-picker.min.js'></script>
   <style>
      .hoursWrap {
        position:relative;
      }
      #hours {
         
      }
      canvas {
       position: absolute;
       top: 42px;
       left: 109px;
       width: 1080px;
       height: 441px;
      }
      .remark {
       transform: rotate(28deg) translateX(30px) translateY(-10px);
       transform-origin: top left;
       font-size: 23px;
       width: 400px;
       overflow: hidden;
       white-space: nowrap;
       text-align: left;
      }
      .notes label {
         width: 5em;
         text-align: right;
         display: inline-block;
      }
      .notes {
        background: #fff;
        width: 80vw;
        padding: 18px;
        margin-left: 18px;
        margin-top: 18px;
        margin-bottom: 36px;
        display: flex;
        flex-direction: column;
        box-shadow: 0.75em .75em 0.5em rgba(0,0,0,.25);
      }
      .notes > div {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
      }
      .notes > div > div {
        display: inline-block;
      }
      #wrap {
        padding-bottom:12em;
        width: 80vw;
      }
      @media print {
         #form { display: none; }
         #perf { display: none; }
         body { background-color:#fff; }
         #main { background-color: #fff; margin: 0px; padding: 0px; box-shadow:none;}
         .notes { box-shadow: none; }
         #hours { width: 100vw; }
         .pagebreak { page-break-after: always; }
         #wrap { box-shadow: none; }
         canvas { width: 36.8cm; }
         .timetable { width: 36.8cm; }
      }
      .mytime {
         text-align: right;
         white-space: nowrap;
      }
      .downtime {
         text-align: right;
         white-space: nowrap;
         background: #0002;
      }
      .mynotes, .mynotes table {
         border-collapse: collapse;
      }
      .val {
         display: inline-block;
         width: 5em;
      }
      .mynotes td {
         padding-left: 0.5em;
         vertical-align: top;
      }
      .topval { width: 100%; }
      #wrap {
        padding-bottom: 12em;
      }
      #notes {

      }
      #main {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100vw;
    }
    .left {
        text-align: left;
    }
    @media (max-width: 600px) {
        

    }
   </style>
</head>
<body>
<div id='main'>
   <div id='form'>
      <label for='driver'>Driver:</label>
      <select id='driver'> </select> &nbsp; 
      <label for='date'>Date:</label>
      <input type='text' id='date' size='10' class='is-below'>
      <button id='lookup'>&#x1f50d; Lookup</button>
      <button id='print' onclick="window.print(); return false;">&#x1F5A8; Print</button>
   </div>
   <div id='wrap'>
      <div id='topform'>
         <table class='topform'>
            <tr>
               <td id='perf' colspan='4'>&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;</td>
            </tr>
            <tr><td><br></td></tr>
            <tr>
               <td class='carrier' rowspan=3><img src='path851.png' style='float:left;height:80px;position:relative;top:.0125em;left:.5em;padding-right:1em;'><span style='padding-right:.25em;'>D Harris Tours<br>153 Utah St.<br>SSF, CA 94080 </span><hr><span style='font-size:.7em'>(415) 902-8542<br>US DOT 2016332</span></td>
               <td>&nbsp;</td>
               <td><h1 style='display:inline-block;'>DRIVER'S DAILY LOG</h1>
               <table>
                  <tr><th class='label'><label>Pickup:</label></td><td><span class='topval' id='logpickup'></span></td></tr>
                  <tr><th class='label'><label>Drop-off:</label></td><td><span class='topval' id='logdropoff'></span></td></tr>
               </table>
               </td>
               <td>
               <table>
                  <tr><th class='label'><label>Date:</label></td><td><span class='topval' id='logdate'></span></td></tr>
                  <tr><th class='label'><label>Driver:</label></td><td><span class='topval' id='logdriver'></span></td></tr>
                  <tr><th class='label'><label>Bus #:</label></td><td><span class='topval' id='busno'></span></td>
               </tr></table></td>
            </tr>
         </table>
      </div>
      <div class="hoursWrap">
         <table id='hoursTable' class='timetable'>
         </table>
         <canvas id="hours" width="1440" height="400"></canvas>
      </div>
    </div>
    <div class="pagebreak"></div>
    <div class='notes'>
        <div>
            <div><label>Job ID:</label> <span id='jobid'></span></div>
            <div><label>Date:</label> <span id='jobdate'></span></div>
        </div>
     <table class='mynotes'>
        <thead>
           <tr>
              <th>Time</th><th>Location</th><th>Times</th>
           </tr>
        </thead>
        <tbody id='mynotes'></tbody>
     </table>
    </div>
   </div>
</body>
<script type='text/javascript'>
   
(function(win, doc) {
   const app = {
      config: {
         workStates: ['Off Duty', 'Sleeper', 'Driving', 'On Duty', 'Remarks']
      },
      init: function() {
         app.initCanvas();
         app.buildTimeTable();
         app.calendar = TinyDatePicker(document.querySelector('#date'), {
            mode: 'dp-below',
          });
         
         var drvr = document.querySelector("#driver");
         drvr.addEventListener("change", function(e) {
            if (document.querySelector("#date").value!="") {
               app.initCanvas();
               app.buildTimeTable();
               app.fetchJobs(e);
            }
         });

         document.querySelector('#date').addEventListener("change", function(e) {
            app.initCanvas();
            var drvr = document.querySelector("#driver");
            if (drvr.selectedIndex) {
               app.buildTimeTable();
               app.fetchJobs(e);
            }

         });
         
         fetch("api.php?type=drivers").then((response) => {
            return response.json();
         }).then((data) => {
            var out = "<option value=''>-- Select Driver --</option>";
            let sel = "";
            for (var i=0; i<data.length; i++) {
               sel = (data[i].EmployeeID == app.state.driver) ? " SELECTED" : "";
               out += `<option value='${data[i].EmployeeID}'${sel}>${data[i].Driver}</option>`;
            }
            document.querySelector("#driver").innerHTML = out;
            if (app.state.date) {
                document.querySelector("#date").value = app.state.date;
                document.querySelector("#jobdate").innerHTML = app.state.localdate;
            }
            if (app.state.driver) {
                let drvs = document.querySelector("#driver");
                let sidx = 0;
                for (let i=0; i<drvs.options.length; i++) {
                    opt = drvs.options[i];
                    if (opt.value == app.state.driver) {
                        opt.selected = true;
                    }
                };
            }

            if (app.state.driver && app.state.date) {
                app.fetchJobs();
            }
         });
         
         var btn = document.querySelector("#lookup");
         btn.addEventListener("click", function(e) {
            app.buildTimeTable();
            app.fetchJobs(e);
            e.preventDefault();
            return false;
         });
      },
      state: {
        date: "<?php if (array_key_exists('date', $in)) { print $in['date']; } ?>",
        localdate: "<?php if (array_key_exists('date', $in)) { print date("n/d/Y", strtotime($in['date'])); } ?>",
        driver: "<?php if (array_key_exists('driver', $in)) { print $in['driver']; } ?>"
      },
      fetchJobs: function(e) {
         var drvr = document.querySelector("#driver");
         var driver = drvr.options[drvr.selectedIndex].value;
         var mydate = document.querySelector("#date").value;
          
         if (driver && mydate) {
            let dp, dy, dm, dd;
            if (mydate.match(/\-/)) {
                dp = mydate.split(/\-/);
                dy = dp[0]; dm = dp[1] - 1; dd = dp[2];
            } else if (mydate.match(/\//)) {
                dp = mydate.split(/\//);
                dm = dp[0] - 1; dd = dp[1]; dy = dp[2];
            }
            $("#logdate").innerHTML = new Date(dy, dm, dd).toLocaleDateString();
            app.state.localdate = new Date(dy, dm, dd).toLocaleDateString();

            $("#logdriver").innerHTML = drvr.options[drvr.selectedIndex].text;
            fetch("api.php?type=jobs&EmployeeID="+driver+"&jobdate="+mydate).then((response) => response.json()).then((data) => {
               console.dir(data);
               var last = 0, x, y;
               $("#busno").innerHTML = data[0]['busnum'];
               $("#logpickup").innerHTML = data[0]['pickup'];
               $("#logdropoff").innerHTML = data[data.length-1]['dropoff'];
               $("#jobid").innerHTML = data[0]['id'];
               var tots = {OffDuty:0, Sleeper:0, Driving:0, OnDuty:0, Remarks:0};
               
               app.updateTrips(data[0]);
            });
         }
      },
      updateTrips: function(trips) {
         console.log("in updateTrips");
         console.dir(trips);
         let onduty = 0, mynotes = "";

         if (trips["trips"]) {
            let tots = { OffDuty: 0, Sleeper: 0, Driving: 0, OnDuty: 0, Remarks: 0 }
            let startHour, endHour, lastEndTime = 0, i, cell, startInMinutes, endInMinutes;
            trips["trips"].sort((a, b) => b.startHour - a.startHour);

            trips["trips"].forEach((trip, tidx)=>{
               startHour = (((trip.StartTime / 1000) / 60) / 60);
               endHour = (((trip.EndTime / 1000) / 60) / 60);
               startMin = Math.round((startHour - Math.floor(startHour)) * 60); // (startHour * 60) - ((trip.StartTime / 1000) / 60);
               startMin = (startMin < 10) ? "0" + startMin : startMin;
               endMin = Math.round((endHour - Math.floor(endHour)) * 60); // (endHour * 60) - ((trip.EndTime / 1000) / 60);
               endMin = (endMin < 10) ? "0" + endMin : endMin;
               startHour = Math.floor(startHour);
               endHour = Math.floor(endHour);
               
               startInMinutes = Math.floor((trip.StartTime / 1000) / 60);
               endInMinutes = Math.floor((trip.EndTime / 1000) / 60);

               console.log(`trip start time: ${trip.StartTime} start hour: ${startHour} start min: ${startMin}`);
               console.log(`trip end time: ${trip.EndTime} end hour: ${endHour} end min: ${endMin}`);
               app.ctx.lineWidth = 5;
               app.ctx.strokeStyle = "#ff0000";

               app.ctx.beginPath();
               app.ctx.moveTo(startInMinutes, 125);
               app.ctx.lineTo(endInMinutes, 125);
               app.ctx.stroke();
               app.ctx.closePath()
               
               duty = (onduty) ? "On Duty" : "Off Duty";

               let yPos = (app.config.workStates.indexOf(duty) * 50) + 25;
               console.log(`yPos: ${yPos}`);
               app.ctx.lineWidth = 5;
               app.ctx.strokeStyle = "#ff0000";

               app.ctx.beginPath();
               app.ctx.moveTo(lastEndTime, yPos);
               app.ctx.lineTo(startInMinutes, yPos);
               app.ctx.lineTo(startInMinutes, 125);
               
               if (tidx < trips["trips"].length - 1) {
                  app.ctx.moveTo(endInMinutes, 125);
                  app.ctx.lineTo(endInMinutes, 175);
            
               } else {
                  app.ctx.moveTo(endInMinutes, 125);
                  app.ctx.lineTo(endInMinutes, 25);
               }
               
               app.ctx.stroke();
               app.ctx.closePath();
               let sxm = 'am', exm = 'am';
               if (endHour > 12) {
                  exm = 'pm';
                  endHour -= 12;
               }
               sxm = (startHour > 12) ? 'pm' : 'am';
               startHour = (startHour > 12) ? startHour - 12 : startHour;
               let dt = (app.cleanTime(trip.Downtime)) ? `<tr><td class="downtime"></td><td colspan=2 class="downtime"><label>Downtime:</label> <span class="val">${app.cleanTime(trip.Downtime)}</span></td></tr>` : "";
               let ss = (app.cleanTime(trip.Standstill)) ? `<tr><td class="mytime"><label>Standstill:</label> <span class="val">${app.cleanTime(trip.Standstill)}</span></td></tr>` : "";
               let dur = (app.cleanTime(trip.Duration)) ? `<tr><td class="mytime"><label>Driving:</label> <span class="val">${app.cleanTime(trip.Duration)}</span></td></tr>` : "";
               let dis = (trip.Distance) ? `<tr><td class="mytime"><label>Distance:</label> <span class="val">${trip.Distance} miles</span></td></tr>` : "";

               mynotes += `${dt}
      <tr class='note-item'>
         <td>${startHour}:${startMin}${sxm}</td><td class='left'>${trip.StartLocation.replace(/(.+)\s\d\d\d\d\d.*/,'$1')}</td><td rowspan="2">
            <table style="width:100%;">
            ${dur}
            ${dis}
            ${ss}
            </table>
         </td>
      </tr>
      <tr><td>${endHour}:${endMin}${sxm}</td> <td class='left'>${trip.EndLocation.replace(/(.+)\s\d\d\d\d\d.*/,'$1')}</td></tr>
   </table>
</td></tr>`;
               app.setRemark(Math.floor(startInMinutes / 60), trip.StartLocation);
               app.setRemark(Math.floor(endInMinutes / 60), trip.EndLocation);

               tots.Driving += Math.floor((trip.Duration / 1000) / 60);

               if (!onduty) {
                  tots.OffDuty += Math.floor((trip.StartTime / 1000) / 60);
                  onduty = 1;
               } else {
                  tots.OnDuty += Math.floor(((trip.StartTime / 1000)/60) - lastEndTime);
               }
               
               lastEndTime = endInMinutes;
            });
            

            tots.OffDuty += 1440 - lastEndTime;
            app.ctx.beginPath();
            app.ctx.moveTo(endInMinutes, 125);
            app.ctx.lineTo(endInMinutes, 25);
            app.ctx.lineTo(1440, 25);
            app.ctx.stroke();
            app.ctx.closePath();
console.log("Totals:");
console.dir(tots);
            let timeTotal = 0;
            for (i in app.config.workStates) {
               var wstxt = app.config.workStates[i];
               wstxt = wstxt.replace(/\s* /g, '');
               
               timeTotal += Math.round(tots[wstxt] / 60);

               var el = $("#" +  wstxt + "_total");
               if (el) {
                  el.innerHTML = Math.round(tots[wstxt] / 60);
               }
               tots.Remarks += Math.round(tots[wstxt] / 60);
            }

            $("#Remarks_total").innerHTML = timeTotal;
            $("#mynotes").innerHTML = mynotes;
         }
      },
      cleanTime: function(timestamp) {
         let seconds = timestamp / 1000;
         let minutes = Math.floor(seconds / 60);
         let hours = Math.floor(minutes / 60);
         minutes = minutes - (hours * 60);

         let days = Math.floor(hours / 24);

         let out = "";
         if (days > 0) {
            out += `${days}d `;
            hours = hours - (days * 24);
            out += `${hours}h `;
            //minutes = minutes - (hours * 60);
            out += `${minutes}m`;
         } else if (hours > 0) {
            out += `${hours}h `;
            //minutes = minutes - (hours * 60);
            out += `${minutes}m`;
         } else if (minutes > 0) {
            out += `${minutes}m`;
         }
         return out;
      },
      setRemark: function(hr, remark) {
         if (remark) {
            remark = remark.replace(/\(?\d\d\d\)?[\-\s]?\d\d\d\-\d\d\d\d/, '');
            remark = remark.replace(/D\s*Harris Tours.*/, 'D Harris Tours');
            remark = remark.replace(/CA.*/s, '');
            remark = remark.replace(/\d\d\d\d\d\-\d\d\d\d/,'');
         }
         var city = app.guessCity(remark);
         if (app.lastHourRemark != remark) {
            var remarkCell = document.querySelector("#Remarks_"+hr);
            if (remarkCell) {
               if (remark!= "Not Driving") {
                  remarkCell.innerHTML = "<div class='remark'>" + remark + "</div>";
               }
            }
            app.lastHourRemark = remark;
         }
 
      },
      setHour: function(type, hour, val, min) {
         var cell = document.querySelector("#"+type+"_"+hour);

         if (cell) {
            cell.innerHTML = "<div class='line' style='width:" + (42 * 1) + "px;' title='" + val + "'></div>";
         }

         if (val) {
            val = val.replace(/\(?\d\d\d\)?[\-\s]?\d\d\d\-\d\d\d\d/, '');
            val = val.replace(/D\s*Harris Tours.*/, 'D Harris Tours');
            val = val.replace(/CA.*/, '');
         }
         var city = app.guessCity(val);
         if (app.lastHourRemark != val) {
            var remarkCell = document.querySelector("#Remarks_"+hour);
            if (remarkCell) {
               if (val!= "Not Driving") {
                  //remarkCell.innerHTML = "<div class='remark'>" + val + ", CA</div>";
               }
            }
            app.lastHourRemark = val;
         }
         return cell;
      },

      buildTimeTable: function() {
         var workstate, out='', foot='';

         // Handle headers and footers first
         out += "<thead><tr><th class='blank'></th>";
         foot += "<tr class='tfoot'><th class='blank'></th>";
         for (var c=0; c<24; c++) {
            if ((c ) === 0) {
               t = "12a";
            } else if ((c ) === 12) {
               t = "12p";
            } else {
               t = c % 12;
            }
            out += "<th>" + t + "</th>";
            foot += "<th>" + t + "</th>";
         }
         foot += "<th></th><th class='totalhours'><div id='totalhours'></div></th></tr>";
         out += "<th></th><th class='totalhours'>Total<br>Hours</th></tr></thead>\n";
         
         // Now generate timelines for each app.conf.workStates
         out += "<tbody>";
         var wsCount = app.config.workStates.length;
         for (var i=0; i < wsCount; i++) {
            out += "<tr>";
            workstate = app.config.workStates[i];
            wrk = workstate.replace(/\W/, '');
            out += "<th>" + (i + 1) + ". " + workstate + "</th>";

            for (var j=0; j < 24; j++) {
               out += "<td id='" + wrk + "_" + j + "'></td>";
            }
            out += "<td colspan='2' class='totalhours'><div id='" + wrk + "_total' class='total'></div></td>";
            out += "</tr>\n";

            console.log("app.config.workStates.length: "+wsCount);
            if (i == (wsCount - 2)) {
               out += foot;
            }
         }
         out += "</tbody>";

         var hours = document.querySelector('#hoursTable');
         hours.innerHTML = out;
         console.log(out);
         return out;
      },
      initCanvas: function() {
          app.canvas = $("canvas");
          app.ctx = app.canvas.getContext("2d");

          app.ctx.clearRect(0, 0, 1440, 200);
          app.ctx.save();

          app.ctx.rect(0,0,1440,200);
          app.ctx.fillStyle = "#fff";
          app.ctx.fill();
          app.drawGrid();
          app.state.loaded = true;
      },
      drawGrid: function() {
         for (i=0; i<5; i++) {
             app.ctx.lineWidth = 2;
             app.ctx.strokeStyle = "#ff0000";
             app.ctx.beginPath();
             app.ctx.moveTo(0, i * 50);
             app.ctx.lineTo(1440, i * 50); 
             app.ctx.stroke();
             app.ctx.closePath();

         }
         for (let i=0; i<24; i++) {
            app.ctx.lineWidth = 1;
            app.ctx.strokeStyle = "#000000";
            app.ctx.beginPath();
            app.ctx.moveTo(i * 60, 0);
            app.ctx.lineTo(i * 60, 200); 
            app.ctx.stroke();
            app.ctx.closePath();
            
            for (let j=0; j<5; j++) {
                app.ctx.strokeStyle = "#ff0000";
                app.ctx.lineWidth = 2;
                app.ctx.beginPath();
                app.ctx.moveTo((i * 60) + 30, (50 * j));
                app.ctx.lineTo((i * 60) + 30, (50 * j) - 35);
                app.ctx.moveTo((i * 60) + 15, (50 * j));
                app.ctx.lineTo((i * 60) + 15, (50 * j) - 20);
                app.ctx.moveTo((i * 60) + 45, (50 * j));
                app.ctx.lineTo((i * 60) + 45, (50 * j) - 20);
                app.ctx.stroke();
                app.ctx.closePath();
            }
         }
      },

      lastHourRemark: '',
      guessCity: function(addr) {
         var cities = ['South San Francisco', 'San Francisco', 'San Rafael', 'Vallejo', 'San Ramon', 'Castro Valley', 'Loma Mar', 'Alameda', 'Oakland', 'Sausalito', 'Elk Grove', 'Walnut Creek', 'Berkeley', 'Rocklin', 'Atherton', 'Brentwood', 'Folsom', 'Pacifica', 'Morgan Hill', 'Burlingame', 'Lagunita', 'El Cerrito', 'Richmond', 'Monterey', 'Montara', 'Concord', 'Pleasanton', 'Windsor', 'Corte Madera', 'Oakville', 'Mill Valley', 'Daly City', 'Vacaville', 'Union City', 'Merced', 'San Mateo', 'Palo Alto', 'Hayward', 'Livermore', 'Santa Clara', 'Sunnyvale', 'San Carlos', 'Redwood City', 'San Leandro', 'Pleasant Hill', 'Hercules', 'Eureka', 'Marin City', 'Danville', 'Alviso', 'Pittsburgh', 'Rohnert Park', 'San Lorenzo', 'Half Moon Bay', 'San Pablo', 'Dublin', 'Larkspur', 'Davis', 'Sacramento', 'Lafayette', 'Ross', 'Pittsburg', 'Menlo Park', 'Novato', 'Arbuckle', 'San Jose', 'Kentfield', 'Fremont', 'Piedmont', 'Boulder Creek', 'Healdsburg', 'Fairfax', 'Milpitas', 'Martinez', 'Aptos', 'Fairfield', 'Orinda', 'Antioch', 'Oakley', 'Pinole', 'Clayton', 'Greenbrae', 'Lotus', 'Dixon', 'Stockton', 'Albany', 'Emeryville', 'Cazadoro', 'El Sobrante', 'Oakhurst', 'Stanford', 'Nicasio', 'Suisun City', 'Napa', 'Tomales', 'Newark', 'Modesto', 'Santa Rosa', 'Turlock', 'Pescadero', 'Santa Cruz', 'Groveland', 'Tiburon', 'Crockett', 'Sonoma', 'Brisbane', 'Mountain House', 'Mt House', 'Tracy', 'Moraga', 'Los Altos', 'Fresno', 'San Bruno', 'Petaluma', 'Benecia', 'Gilroy', 'Sausilito', 'Stinson Beach', 'Felton', 'San Gregorio', 'Mountain View', 'Mt View', 'Mt. View', 'Millbrae', 'Milbrae', 'Rodeo', 'Clarksberg', 'Alamo', 'Marysville', 'Yuba City', 'Belmont', 'Inverness'];
         var re, city='';

         for (var i=0; i<cities.length; i++) {
            re = new RegExp(cities[i], 'i');
            if (re.exec(addr)) {
               city = cities[i];
               i = cities.length;
            }
         }

         if (!city) { city = "San Francisco"; }
         return city;
      }

   };

   window.app = app;
   window.addEventListener('load', function() {
      app.init();
   });

})(window, document);
function $(str) {
   return document.querySelector(str);
}
</script>
</html>
