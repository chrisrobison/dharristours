<?php
    include("/simple/.env");
    include("/simple/lib/auth.php");

    $in = $_REQUEST;

    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, $env->db->db);

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    
    if (!array_key_exists("start", $in)) {
        $in['start'] = "2023-04-01";
    }
    
    if (!array_key_exists("end", $in)) {
        $in['end'] = "2023-04-30";
    }

    if (!array_key_exists("driver", $in)) {
        $in['driver'] = 67;
    }
    $buses = array();
    $busesobj = $boss->getObject("Bus", "Active=1");
    foreach ($busesobj->Bus as $bus) {
        $buses[$bus->BusID] = $bus->BusNumber;
    }
    $driverslist = $boss->getObject("Employee", "Driver=1 AND Active=1 ORDER BY FirstName, LastName");
        
    foreach ($driverslist->Employee["_ids"] as $idx=>$id) {
        if ($id == $in['driver']) {
            $currentDriver = $idx;
            $currentDriverID = $id;
        }
    }

    if (array_key_exists('x', $in)) {
        if ($in['x'] == "nextDriver") {
            if ($currentDriver == count($driverslist->Employee["_ids"]) - 1) {
                $currentDriver = -1;
            }
            $in['driver'] = $currentDriverID = $driverslist->Employee[$currentDriver+1]->EmployeeID;
        } else if ($in['x'] == "prevDriver") {
            if ($currentDriver == 0) {
                $currentDriver = count($driverslist->Employee["_ids"]);
            }
            $in['driver'] = $driverslist->Employee[$currentDriver-1]->EmployeeID;
        }
        
    }
    $driver = $boss->getObject("Employee", $in['driver']);

    $sql = "SELECT * from Job where (JobDate>='{$in['start']}' AND JobDate<='{$in['end']}') AND EmployeeID={$in['driver']}";
    $results = $boss->getObject("Job", "(JobDate>='{$in['start']}' AND JobDate<='{$in['end']}') AND EmployeeID='{$in['driver']}' AND JobCancelled!=1 ORDER BY JobDate");
    
    $all = array();
    foreach ($results->Job as $idx=>$job) {
        if ($job->BusID) {
            $obj = new stdClass();
            $obj->busID = $job->BusID;
            $obj->busnum = $buses[$job->BusID];
            $obj->date = $job->JobDate;
            
            $trips = $boss->getObject("TripReport", "Vehicle like '%{$obj->busnum}%' AND Day='{$job->JobDate}' ORDER BY StartTime");
            
            if (count($trips->TripReport)) {
                $tots = new stdClass();
                $tots->offduty = 0;
                $tots->driving = 0;
                $tots->sleeper = 0;
                $tots->onduty = 0;
                $tots->total = 0;
                $tots->date = $job->JobDate;
                $onduty = 0;
                
                $tmp = new stdClass();
                $tmp->total = 0;
                $tmp->onduty = 0;
                $tmp->date = $job->JobDate;
                
                foreach ($trips->TripReport as $trip) {
                    if ($trip->TripReportID) {
                        $tmp->total += $trip->Duration;
                        $tmp->driving += $trip->DrivingTime;
                        $tots->driving += $trip->Duration;
                        $tots->total += $trip->Duration;
                        $tmp->onduty += $trip->Standstill + $trip->Downtime;
                        if ($onduty==0) {
                            $tots->total += ceil(($trip->StartTime / 1000) / 60);
                            $onduty = 1;
                        } else {
                            $tots->onduty += ceil(($trip->StartTime / 1000) / 60) - $lastend;
                            $tots->total += ceil(($trip->StartTime / 1000) / 60) - $lastend;
                        }
                        $lastend = floor(($trip->EndTime / 1000) / 60);
                    }
                }
                $tmp->offduty = sprintf("%.2f", (((86400000 - $tmp->driving - $tmp->onduty)/1000)/60)/60);
                $tmp->driving = sprintf("%.2f", (($tmp->driving/ 1000)/60)/60);
                $tmp->onduty = sprintf("%.2f", (($tmp->onduty / 1000)/60)/60);
                $tmp->sleeper = "0.00";
                $tmp->total = "24.0";

                $tots->offduty += (1440 - $lastend); // log as offduty from end of last job to end of day
                $tots->total += (1440 - $lastend);

                $tots->driving = sprintf("%.2f", ($tots->driving / 60));
                $tots->onduty = sprintf("%.2f", ($tots->onduty / 60));
                $tots->sleeper = sprintf("%.2f", ($tots->sleeper / 60));
                $tots->offduty = sprintf("%.2f", (24 - ($tots->driving + $tots->onduty)));
                $tots->total = sprintf("%.2f", 24);
                $obj->hours = $tmp;
                if ($trip->Day=="2024-02-15") {
                }
            }
            $all[$obj->date] = $obj;
        }
    }
    function round15($hrs, $down=0) {
        return sprintf("%.2f", $hrs);
        $hrs = $hrs * 4;
        $hrs = ($down) ? floor($hrs) : ceil($hrs);
        return $hrs / 4;
    }
    //print json_encode($all);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hours of Service Report</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
        body {
            font-family: "Lexend", "Helvetica Neue", "Helvetica", sans-serif;
            margin: 0;
            padding: 0;
            font-size: 16px;
            font-weight: 300;
    display: flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
}
table {
    border-collapse: collapse;
    border: 2px solid #000;
}
td {
    border-right: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
    text-align: right;
    padding: 0.15em 0.5em;
}
th {
    background: #000;
    color:#fff;
}
tr:nth-child(even) td {
   background: #fff;
}
tr:nth-child(odd) td {
   background: #eee;
   border-right: #ddd;
}
main {
    display:flex;
    flex-direction: column;
    align-content: center;
    justify-content: center;
    max-width: 8in;
}
header {
    display: flex; 
    flex-direction: column;
    justify-content: space-between;
}
#form {
    display:flex;
    flex-direction: row;
    justify-content: space-between;
    background: #333;
    color: #eee;
}
#form button {
    width: 6em;
    border-radius: 4px;
    border: 1px outset #0009;
    padding: 0.25em;
    background: #fff6;
    color: #eee;
    text-shadow: 1px 1px 1px #0009;
}
#form label {
    display: inline-block;
    width: 3em;
    font-weight: 400;
}
#form select {
    font-family: "Lexend",sans-serif;
    font-weight: 300;
    font-size: 16px;
}
#form > div {
    display: flex;
    flex-direction: row;
    padding-left: 1em;
}
#form > div > div {
    display: flex;
    flex-direction: row;
}
.left {
    text-align: left;
}
.link {
    background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="91px" height="91px"><path fill-rule="evenodd" fill="rgb(0, 0, 0)" d="M52.589,0.292 C58.885,0.202 85.675,0.292 85.675,0.292 C85.675,0.292 87.425,0.695 88.826,2.091 C90.227,3.487 90.502,5.833 90.502,5.833 L90.402,12.660 L90.402,37.845 C90.402,37.845 89.421,42.265 85.225,42.343 C82.436,42.395 79.478,40.325 79.443,37.577 C79.455,37.204 79.373,19.406 79.373,19.406 L53.040,45.716 C53.040,45.716 49.755,48.599 49.303,48.981 C46.606,50.718 43.117,50.245 41.336,47.740 C40.115,46.023 40.439,43.897 41.455,41.529 C42.471,40.370 46.287,36.496 46.287,36.496 L71.270,11.311 C71.270,11.311 52.397,11.433 52.139,11.311 C50.149,9.852 48.241,8.374 48.313,5.689 C48.402,2.367 50.463,1.592 52.589,0.292 ZM9.826,26.602 C9.826,44.665 9.826,62.733 9.826,80.795 C27.905,80.795 45.989,80.795 64.068,80.795 C64.068,67.155 64.068,53.510 64.068,39.869 C67.219,36.796 70.370,33.722 73.521,30.650 C73.596,30.650 73.671,30.650 73.746,30.650 C73.746,44.665 73.746,58.685 73.746,72.700 C73.746,77.455 74.844,85.802 72.621,88.666 C70.467,91.441 61.373,90.240 56.641,90.240 C42.913,90.240 29.181,90.240 15.453,90.240 C10.498,90.240 3.063,91.260 1.048,88.216 C-0.807,85.414 0.373,77.285 0.373,73.150 C0.373,60.259 0.373,47.364 0.373,34.472 C0.373,29.806 -0.768,21.238 1.498,18.507 C3.587,15.989 10.984,16.932 15.453,16.933 C30.306,17.007 45.164,17.082 60.017,17.157 C56.941,20.305 53.865,23.454 50.789,26.602 C50.714,26.602 50.639,26.602 50.564,26.602 C36.986,26.602 23.404,26.602 9.826,26.602 Z"/></svg>');
    background-size: contain; 
    height: 0.8em;
    width: 0.8em;
    display: inline-block;
    content: " ";
    opacity: .6;
}
.clean {
    color: #ddd;

    text-shadow: -1px -1px 1px #0009, 1px 1px 1px #fff;
    text-decoration:none;

}
tr td.over {
        background-color: #c003;
}
tr td.ok {
        background-color: #0c03;

}
#hours-of-service {
    font-family: 'Inconsolata', monospace;
    font-size: 16px;
    width: 8in;
}
#hours-of-service th, #hours-of-service td {
   width: 14ch;
}
h2 {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    background-color: #11558d;
    color: #fff;
    border-bottom: 2px outset #0005;
    border-top: 2px outset #fff5;
    text-transform: uppercase;
    font-weight: 400;
}
.iframeWrap, #iframeWrap {
   display:flex;
   height: 50%;
   overflow-y: scroll;
    display: none;
}
#printhead {
    display: none;
}
.hoursWrap {
   display: inline-block;
   overflow: auto;
}
header a:hover {
    color: #fff;
}
@media (max-width: 600px) {
main {
    width: 100vw;
}
    header {
        flex-direction: column;
    }
    .linktext {
        display: none;
    }
    #hours-of-service {
        width: 100vw;
    }
     #form > div > div {
        flex-direction: row;
    }
    #form > div {
        flex-direction: column;
    }
    #form select {
        max-width: 14em;
    }
}
@media print {
    #form {
        display: none;
    }
    table {
        border: 1px solid #000;
    }
    table td {
       color: #000; 
    }
    body {
        font-weight: 300;
    }
    h2 {
        background: transparent;
        color: #000;
        border: none;
    }
    header {
        flex-direction: row;
    }
    .clean {
        display: none;
    }
    .link {
        display: none;
    }
    .details {
        display: none;
    }
    #printhead {
        display: block;
    }
    #hours-of-service {
        width: 7.75in;
    }
}
</style>
</head>
<body>
<main>
   <div>
   <div class='form'>
      <div id='form'>
         <div>
          <div>
            <label for='driver'>Driver</label>
            <select id='driver'> </select> &nbsp; 
          </div>
          <div>
            <label for='month'>Date</label>
            <input type='hidden' id='startdate' value=''>
            <input type='hidden' id='enddate' value=''>
<?php
    if ($in['start']) {
        $parts = explode("-", $in['start']);
        $sel[$parts[1]] = " SELECTED";
    }
    print <<<EOT
      <select id='month' name='month' onchange="app.changeDate()">
        <option value='01'{$sel['01']}>January</option>
        <option value='02'{$sel['02']}>February</option>
        <option value='03'{$sel['03']}>March</option>
        <option value='04'{$sel['04']}>April</option>
        <option value='05'{$sel['05']}>May</option>
        <option value='06'{$sel['06']}>June</option>
        <option value='07'{$sel['07']}>July</option>
        <option value='08'{$sel['08']}>August</option>
        <option value='09'{$sel['09']}>September</option>
        <option value='10'{$sel['10']}>October</option>
        <option value='11'{$sel['11']}>November</option>
        <option value='12'{$sel['12']}>December</option>
    </select>
EOT;
    print "<select id='year' name='year' onchange=\"app.changeDate()\">";
    for ($yr=2020; $yr<2025; $yr++) {
        $sel = ($parts[0] == $yr) ? " SELECTED" : "";
        print "<option value='$yr'$sel>$yr</option>";
    }
    print "</select>";
?>
      
          </div>
       </div>
       <div>
         <button id='lookup'>&#x1f50d; Lookup</button>
         <button id='print' onclick="window.print(); return false;">&#x1F5A8; Print</button>
       </div>
      </div>
   <div id="printhead"><h1>D Harris Tours Hours-of-Service Report</h1></div>
   <hr>
</div>
<div class='form'>
<header>
<h2><?php 
    print "<a class='clean' href='index.php?x=prevDriver&start=".date("Y-m-01", strtotime($in['start']))."&driver=".$in['driver']."&end=".date("Y-m-t", strtotime($in['start']))."'> ◀ </a>";
    print $driver->LastName.", ".$driver->FirstName; 
    print "<a class='clean' href='index.php?x=nextDriver&start=".date("Y-m-01", strtotime($in['start']))."&driver=".$in['driver']."&end=".date("Y-m-t", strtotime($in['start']))."'> ▶ </a>";
?></h2>
<h2><?php 
    print "<a class='clean' href='index.php?start=".date("Y-m-01", strtotime($in['start']) - 86400)."&driver=".$in['driver']."&end=".date("Y-m-t", strtotime($in['start']) - 86400)."'> ◀ </a>";
    print date("M j, Y", strtotime($in['start']))." - ".date("M j, Y", strtotime($in['end'])); 
    print "<a class='clean' href='index.php?start=".date("Y-m-01", strtotime($in['start']) + (86400 * 31))."&driver=".$in['driver']."&end=".date("Y-m-t", strtotime($in['start']) + (86400 * 31))."'> ▶ </a>";
?></h2>
</header>
<div class="hoursWrap">
    <table id="hours-of-service">
        <thead>
            <tr>
                <th>Date</th>
                <th>Off-Duty</th>
                <th>Sleeper</th>
                <th>Driving</th>
                <th>On-Duty</th>
                <th>Total</th>
                <th class='details'></th>
            </tr>
        </thead>
        <tbody>
<?php
    $seen = array();
    $fromday = date("j", strtotime($in['start']));
    $frommon = date("n", strtotime($in['start']));
    $today = date("t", strtotime($in['start']));
    $yr = date("Y", strtotime($in['start']));

    for ($d=1; $d<=$today; $d++) {
        $jobdate = $yr . "-" . sprintf("%02d", $frommon) . "-" . sprintf("%02d", $d);
        $day = $all[$jobdate];
    //foreach ($all as $jobdate=>$day) {
        if ($day && !array_key_exists($day->date.':'.$day->busnum, $seen) && ($day->hours->offduty && $day->hours->total)) {
            $xtra = ($day->hours->driving > 10) ? "over" : "ok";
            $out = "";
            $out .= "<tr><td class='left'>".date("m/d", strtotime($day->date))."</td>";
            $out .= "<td>".$day->hours->offduty."</td>";
            $out .= "<td>".$day->hours->sleeper."</td>";
            $out .= "<td class='$xtra'>".$day->hours->driving."</td>";
            $out .= "<td>".$day->hours->onduty."</td>";
            $out .= "<td>".$day->hours->total."</td>";
            $mydate = date("Y-m-d", strtotime($day->date));
            $url = "/tools/dlog/dlog.php?driver=".$driver->EmployeeID."&date=".date("Y-m-d", strtotime($day->date));
            $out .= "<td class='details'><a target='_blank' onclick=\"return app.viewDetail('{$url}', '{$day->date}');\" href='{$url}'><span class='linktext'>Details</span> <span class='link'></span></a></td></tr>";
            print $out."\n";
            $seen[$day->date.':'.$day->busnum] = 1;
        } else {
            $out = "";
            $out .= "<tr><td class='left'>".date("m/d", strtotime($jobdate))."</td>";
            $out .= "<td></td>";
            $out .= "<td></td>";
            $out .= "<td></td>";
            $out .= "<td></td>";
            $out .= "<td></td>";
            $out .= "<td class='details'></td></tr>";
            print $out."\n";

        }
    }
?>
        </tbody>
    </table>
</div>
</div>
</div>
<div id="iframeWrap">
   <iframe height="100%" width="100%" id="logviewer"></iframe>
</div>
</main>
<script>
(function() {
    let app = {
        data: {
            drivers: [
            <?php print json_encode($driverslist); ?>
            ]
        },
        state: {
            driver: <?php print (array_key_exists("driver", $in)) ? $in['driver'] : 67; ?>,
            start: "<?php print (array_key_exists("start", $in)) ? $in['start'] : '2023-04-01'; ?>",
            end: "<?php print (array_key_exists("end", $in)) ? $in['end'] : '2023-04-30'; ?>"
        },
        init: function() {
            if (app.state.start) {
                document.querySelector("#startdate").value = app.state.start;
            }
            if (app.state.end) {
                document.querySelector("#enddate").value = app.state.end;
            }
            
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
         });
         
         var drvr = document.querySelector("#driver");
         drvr.addEventListener("change", function(e) {
            if (document.querySelector("#startdate").value!="") {
                let start = document.querySelector("#startdate").value;
                let end = document.querySelector("#enddate").value;
                let driver = drvr.options[drvr.selectedIndex].value;

                window.location.href = `index.php?start=${start}&end=${end}&driver=${driver}`;
            }
        });
         var btn = document.querySelector("#lookup");
         btn.addEventListener("click", function(e) {
            
           e.preventDefault();
           return false;
        });
        },
        viewLog: function(e, driverid, seldate) {
         if (e && e.preventDefault) {
            e.preventDefault();
         }
         let url = `dlog.php?driver=${driverid}&date=${seldate}`;
         console.log(`Viewing log ${url}`);

         document.querySelector("#logviewer").src = url;
         return false;
        },
        viewDetail(url, txt) {
            if (parent && parent.loadUrl) {
                parent.loadUrl(url,`HoS: {$driver->LastName} {$day->date}`);
            } else {
                location.href = url;
            }
            return false;
        },
        changeDate: function() {
            let moEl = document.querySelector("#month");
            let yrEl = document.querySelector("#year");
            let startdate = document.querySelector("#startdate");
            let enddate = document.querySelector("#enddate");
            let drvr = document.querySelector("#driver");
            let driver = drvr.options[drvr.selectedIndex].value;

            let yr = yrEl.options[yrEl.selectedIndex].value;
            let mo = moEl.options[moEl.selectedIndex].value;
            startdate.value = yr + '-' + mo + '-01';
            enddate.value = yr + '-' + mo + '-31';
            
            window.location.href = `index.php?start=${startdate.value}&end=${enddate.value}&driver=${driver}`;
        }
    };
    
    window.app = app;
    app.init();
})();
</script>
</body>
</html>
