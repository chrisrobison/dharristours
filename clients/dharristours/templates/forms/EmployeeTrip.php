<script language='Javascript' type='text/javascript'>
var userEmail = '<?php print htmlspecialchars($_SESSION['Email'], ENT_QUOTES); ?>';
function upAll(id) {
      var yetimes = getTimes(simpleConfig.record["YardEndTime"]);
      $("#YardEnd_hour").val(yetimes[0]);
      $("#YardEnd_minute").val(yetimes[1]);

      var stimes1 = getTimes(simpleConfig.record["JobStartTime"]);
      $("#JobStart_hour").val(stimes1[0]);
      $("#JobStart_minute").val(stimes1[1]);

      var etimes1 = getTimes(simpleConfig.record["JobEndTime"]);
      $("#JobEnd_hour").val(etimes1[0]);
      $("#JobEnd_minute").val(etimes1[1]);

      var stimes2 = getTimes(simpleConfig.record["YardStartTime"]);
      $("#YardStart_hour").val(stimes2[0]);
      $("#YardStart_minute").val(stimes2[1]);

      var etimes2 = getTimes(simpleConfig.record["JobArrivalTime"]);
      $("#JobArrival_hour").val(etimes2[0]);
      $("#JobArrival_minute").val(etimes2[1]);

   }

 function getTimes(mytime) {
       var stimes = mytime.split(/:/);
       stimes[2] = 0;

//       if (stimes[0] < 10) stimes[0] = '0' + stimes[0];

       return stimes;
   }


   function myNew() {
      doNew();
      $('#mygrid').trigger('reloadGrid');
      $("#OverTime").prop("checked", false);

      $("#YardStartTime").val("");
      $("#YardStart_hour").val("");
      $("#YardStart_minute").val("");

      $("#YardEndTime").val("");
      $("#YardEnd_hour").val("");
      $("#YardEnd_minute").val("");


      $("#JobStartTime").val("");
      $("#JobStart_hour").val("");
      $("#JobStart_minute").val("");

      $("#JobEndTime").val("");
      $("#JobEnd_hour").val("");
      $("#JobEnd_minute").val("");

      $("#JobArrivalTime").val("");
      $("#JobArrival_hour").val("");
      $("#JobArrival_minute").val("");

      $("#Trip").focus();
   }

    function updateTime(who) {
       var hr24 = $("#" + who + "_hour").val(),
          mins = $("#" + who + "_minute").val();
          // merid = $("#" + who + "_meridian").val(),
          // hr24 = parseInt(hr12) + parseInt(merid);
          // hr24 = (hr24 < 10) ? '0' + hr24 : hr24;
          // hr12 = (hr12 < 10) ? '0' + hr12 : hr12;
           var mytime = hr24 + ':' + mins + ':00';

       $("#" + who + "Time").val(mytime);

       try {
          simpleConfig.current[who + "Time"] = mytime;
       } catch(e) {
          console.log("simpleConfig.current does not exist");
          console.dir(simpleConfig);
       }

       $('#mygrid').setCell(simpleConfig.rowid, who + "Time", $("#" + who + "Time").val(), 'modified');

    }

</script> 

<div class='tableGroup'>
   <div class='formHeading'>Trip ID: <?php print $current->TripID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
      <div class='contentField'><label>Job#</label><input type='text' dbtype='int(15)' name='Trip[<?php print $current->TripID; ?>][JobID]' id='JobID' value='' size='10'  />
         <label>Date</label><input type='text' dbtype='date' name='Trip[<?php print $current->TripID; ?>][JobStartDate]' id='JobStartDate' value='' size='10' class='date' /></div>
    <fieldset title='EmployeeTime'>
             <legend>Employee Paid Time: <input type='text' dbtype='text' name='Trip[<?php print $current->TripID; ?>][TotalEmployeeHours]' id='TotalEmployeeHours' value='' size='5' disabled='disabled' /></legend>
         <div class='contentField'><label>Driver Overtime</label><select dbtype='tinyint(4)' name='Trip[<?php print $current->TripID; ?>][DriverOvertime]' id='DriverOvertime'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Yard Start Mileage</label><input type='text' dbtype='int(15)' name='Trip[<?php print $current->TripID; ?>][YardStartMileage]' id='YardStartMileage' value='' size='15' class='boxValue' /></div>
         <div class='contentField'><label>Yard Depart Time</label>
               <select id='YardStart_hour' onchange="updateTime('YardStart');">
                  <option value='00'>00</option>
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
                  <option value='12'>12</option>
                  <option value='13'>13</option>
                  <option value='14'>14</option>
                  <option value='15'>15</option>
                  <option value='16'>16</option>
                  <option value='17'>17</option>
                  <option value='18'>18</option>
                  <option value='19'>19</option>
                  <option value='20'>20</option>
                  <option value='21'>21</option>
                  <option value='22'>22</option>
                  <option value='23'>23</option>
               </select> :
               <select id='YardStart_minute' onchange="updateTime('YardStart');">
                  <option value='00'>00</option>
                  <option value='05'>05</option>
                  <option value='10'>10</option>
                  <option value='15'>15</option>
                  <option value='20'>20</option>
                  <option value='25'>25</option>
                  <option value='30'>30</option>
                  <option value='35'>35</option>
                  <option value='40'>40</option>
                  <option value='45'>45</option>
                  <option value='50'>50</option>
                  <option value='55'>55</option>
               </select>
               <input type="hidden" rel="data" onchange='doModify($(this))' id='YardStartTime' name='Trip[<?php print $current->TripID; ?>][YardStartTime]' value='<?php print $current->YardStartTime; ?>'></input>
	</div>
         <div class='contentField'><label>Yard Return Time</label>
               <select id='YardEnd_hour' onchange="updateTime('YardEnd');">
                  <option value='00'>00</option>
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
                  <option value='12'>12</option>
                  <option value='13'>13</option>
                  <option value='14'>14</option>
                  <option value='15'>15</option>
                  <option value='16'>16</option>
                  <option value='17'>17</option>
                  <option value='18'>18</option>
                  <option value='19'>19</option>
                  <option value='20'>20</option>
                  <option value='21'>21</option>
                  <option value='22'>22</option>
                  <option value='23'>23</option>
               </select> :
               <select id='YardEnd_minute' onchange="updateTime('YardEnd');">
                  <option value='00'>00</option>
                  <option value='05'>05</option>
                  <option value='10'>10</option>
                  <option value='15'>15</option>
                  <option value='20'>20</option>
                  <option value='25'>25</option>
                  <option value='30'>30</option>
                  <option value='35'>35</option>
                  <option value='40'>40</option>
                  <option value='45'>45</option>
                  <option value='50'>50</option>
                  <option value='55'>55</option>
               </select>
               <input type="hidden" rel="data" onchange='doModify($(this))' id='YardEndTime' name='Trip[<?php print $current->TripID; ?>][YardEndTime]' value='<?php print $current->YardEndTime; ?>'></input>
	</div>
         <div class='contentField'><label>Yard End Mileage</label><input type='text' dbtype='int(15)' name='Trip[<?php print $current->TripID; ?>][YardEndMileage]' id='YardEndMileage' value='' size='15' class='boxValue' /></div>
         <div class='contentField'><label>PaidBreak(min)</label><input type='text' dbtype='int(15)' name='Trip[<?php print $current->TripID; ?>][BreaktimeInMinutes]' id='BreaktimeInMinutes' value='' size='15' class='boxValue' /></div>
     </fieldset>
	<div class='contentField'><label>Total Paid Time</label><input type='text' dbtype='text' name='Trip[<?php print $current->TripID; ?>][TotalEmployeeHours]' id='TotalEmployeeHours' value='' size='25' disabled='disabled' /></div>
      </div>
      <div class='fieldcolumn'>
    <fieldset title='JobTime'>
             <legend>Total Billable Hours: <input type='text' dbtype='text' name='Trip[<?php print $current->TripID; ?>][TotalHoursWorked]' id='TotalHoursWorked' value='' size='5' disabled='disabled' /></legend>
         <div class='contentField'><label>Overtime</label><select dbtype='tinyint(4)' name='Trip[<?php print $current->TripID; ?>][Overtime]' id='Overtime'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Job Arrival Time</label>
               <select id='JobArrival_hour' onchange="updateTime('JobArrival');">
                  <option value='00'>00</option>
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
                  <option value='12'>12</option>
                  <option value='13'>13</option>
                  <option value='14'>14</option>
                  <option value='15'>15</option>
                  <option value='16'>16</option>
                  <option value='17'>17</option>
                  <option value='18'>18</option>
                  <option value='19'>19</option>
                  <option value='20'>20</option>
                  <option value='21'>21</option>
                  <option value='22'>22</option>
                  <option value='23'>23</option>
               </select> :
               <select id='JobArrival_minute' onchange="updateTime('JobArrival');">
                  <option value='00'>00</option>
                  <option value='05'>05</option>
                  <option value='10'>10</option>
                  <option value='15'>15</option>
                  <option value='20'>20</option>
                  <option value='25'>25</option>
                  <option value='30'>30</option>
                  <option value='35'>35</option>
                  <option value='40'>40</option>
                  <option value='45'>45</option>
                  <option value='50'>50</option>
                  <option value='55'>55</option>
               </select>
               <input type="hidden" rel="data" onchange='doModify($(this))' id='JobArrivalTime' name='Trip[<?php print $current->TripID; ?>][JobArrivalTime]' value='<?php print $current->JobArrivalTime; ?>'></input>
	</div>
         <div class='contentField'><label>Job Start Time</label>
               <select id='JobStart_hour' onchange="updateTime('JobStart');">
                  <option value='00'>00</option>
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
                  <option value='12'>12</option>
                  <option value='13'>13</option>
                  <option value='14'>14</option>
                  <option value='15'>15</option>
                  <option value='16'>16</option>
                  <option value='17'>17</option>
                  <option value='18'>18</option>
                  <option value='19'>19</option>
                  <option value='20'>20</option>
                  <option value='21'>21</option>
                  <option value='22'>22</option>
                  <option value='23'>23</option>
               </select> :
               <select id='JobStart_minute' onchange="updateTime('JobStart');">
                  <option value='00'>00</option>
                  <option value='05'>05</option>
                  <option value='10'>10</option>
                  <option value='15'>15</option>
                  <option value='20'>20</option>
                  <option value='25'>25</option>
                  <option value='30'>30</option>
                  <option value='35'>35</option>
                  <option value='40'>40</option>
                  <option value='45'>45</option>
                  <option value='50'>50</option>
                  <option value='55'>55</option>
               </select>
               <input type="hidden" rel="data" onchange='doModify($(this))' id='JobStartTime' name='Trip[<?php print $current->TripID; ?>][JobStartTime]' value='<?php print $current->JobStartTime; ?>'></input>
	</div>
         <div class='contentField'><label>Job End Time</label>
               <select id='JobEnd_hour' onchange="updateTime('JobEnd');">
                  <option value='00'>00</option>
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
                  <option value='12'>12</option>
                  <option value='13'>13</option>
                  <option value='14'>14</option>
                  <option value='15'>15</option>
                  <option value='16'>16</option>
                  <option value='17'>17</option>
                  <option value='18'>18</option>
                  <option value='19'>19</option>
                  <option value='20'>20</option>
                  <option value='21'>21</option>
                  <option value='22'>22</option>
                  <option value='23'>23</option>
               </select> :
               <select id='JobEnd_minute' onchange="updateTime('JobEnd');">
                  <option value='00'>00</option>
                  <option value='05'>05</option>
                  <option value='10'>10</option>
                  <option value='15'>15</option>
                  <option value='20'>20</option>
                  <option value='25'>25</option>
                  <option value='30'>30</option>
                  <option value='35'>35</option>
                  <option value='40'>40</option>
                  <option value='45'>45</option>
                  <option value='50'>50</option>
                  <option value='55'>55</option>
               </select>
               <input type="hidden" rel="data" onchange='doModify($(this))' id='JobEndTime' name='Trip[<?php print $current->TripID; ?>][JobEndTime]' value='<?php print $current->JobEndTime; ?>'></input>
	</div>
   </fieldset>
	<div class='contentField'><label>Total Billable Hours</label><input type='text' dbtype='text' name='Trip[<?php print $current->TripID; ?>][TotalHoursWorked]' id='TotalHoursWorked' value='' size='25' disabled='disabled' /></div>
   <div class='contentField'><label>Notes</label><textarea name='Trip[<?php print $current->TripID; ?>][Notes]' id='Notes' class='textBox' style='width:41em;height:5em;'><?php print $current->Notes; ?></textarea></div>
</div>
</div>
</div>
