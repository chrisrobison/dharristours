<script language='Javascript' type='text/javascript'>
 var userEmail = '<?php print htmlspecialchars($_SESSION['Email'], ENT_QUOTES); ?>';
 function upAll(id) {
       var etimes = getTimes(simpleConfig.record["EndTime"]);
       $("#End_hour").val(etimes[0]);
       $("#End_minute").val(etimes[1]);

       var stimes2 = getTimes(simpleConfig.record["StartTime"]);
       $("#Start_hour").val(stimes2[0]);
       $("#Start_minute").val(stimes2[1]);

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

       $("#StartTime").val("");
       $("#Start_hour").val("");
       $("#Start_minute").val("");

       $("#EndTime").val("");
       $("#End_hour").val("");
       $("#End_minute").val("");


       $("#EmployeePayrollDetails").focus();
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
        getTotalHours();
     }

    function getTotalHours() {
      var valuestart = $("#StartTime").val();
      var valuestop = $("#EndTime").val();


      var timeDiff = diff(valuestart,valuestop);
      alert(timeDiff);
      $("#TotalHours").val(timeDiff);
   }

   function diff(startTime, endTime) {
      startTime = startTime.split(":");
      endTime = endTime.split(":");

      var startDate = new Date(0, 0, 0, startTime[0], startTime[1], 0);
      var endDate = new Date(0, 0, 0, endTime[0], endTime[1], 0);

      var difference = endDate.getTime() - startDate.getTime();
      var Hours = Math.floor(difference / 1000 / 60 / 60);

      difference -= Hours * 1000 * 60 * 60;
      var Minutes = Math.floor(difference / 1000 / 60);

      if (Hours < 0)
      Hours = Hours + 24;

   return Hours + ":" +  Minutes;
   }

</script>

<div class='tableGroup'>
   <div class='formHeading'>EmployeePayrollDetails ID: <?php print $current->EmployeePayrollDetailsID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Employee </label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "EmployeePayrollDetails[$current->EmployeePayrollDetailsID][EmployeeID]")."</div>";?>
         <div class='contentField'><label for="EmployeePayrollDetails">Payroll Type</label>
            <select name='EmployeePayrollDetails[<?php print $current->EmployeePayrollDetailsID; ?>][EmployeePayrollDetails]' id='EmployeePayrollDetails' >
                <option value="Driving" <?php if($current->EmployeePayrollDetails == 'Driving'): ?> selected="selected"<?php endif; ?>>Driving</option>
                <option value="Office" <?php if($current->EmployeePayrollDetails == 'Office'): ?> selected="selected"<?php endif; ?>>Office</option>
                <option value="Mechanic" <?php if($current->EmployeePayrollDetails == 'Mechanic'): ?> selected="selected"<?php endif; ?>>Mechanic</option>
                <option value="Cleaning" <?php if($current->EmployeePayrollDetails == 'Cleaning'): ?> selected="selected"<?php endif; ?>>Cleaning</option>
                <option value="Other" <?php if($current->EmployeePayrollDetails == 'Other'): ?> selected="selected"<?php endif; ?>>Other</option>
            </select></div>           
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' placeholder"Job IDs, or Vehicles" name='EmployeePayrollDetails[<?php print $current->EmployeePayrollDetailsID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Payroll Date</label><input type='text' dbtype='date' name='EmployeePayrollDetails[<?php print $current->EmployeePayrollDetailsID; ?>][PayrollDate]' id='PayrollDate' value='<?php print $current->PayrollDate; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Start Time</label>
               <select id='Start_hour' onchange="updateTime('Start');">
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
               <select id='Start_minute' onchange="updateTime('Start');">
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
               <input type="hidden" rel="data" onchange='doModify($(this))' id='StartTime' name='EmployeePayrollDetails[<?php print $current->EmployeePayrollDetailsID; ?>][StartTime]' value='<?php print $current->StartTime; ?>'></input>
	</div>
            <div class='contentField'><label>End Time</label>
                <select id='End_hour' onchange="updateTime('End');">
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
                <select id='End_minute' onchange="updateTime('End');">
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
                <input type="hidden" rel="data" onchange='doModify($(this))' id='EndTime' name='EmployeePayrollDetails[<?php print $current->EmployeePayrollDetailsID; ?>][EndTime]' value='<?php print $current->EndTime; ?>'></input>
    </div>

         <div class='contentField'><label>Total Hours</label><input type='text' dbtype='varchar(200)' name='EmployeePayrollDetails[<?php print $current->EmployeePayrollDetailsID; ?>][TotalHours]' id='TotalHours' value='<?php print $current->TotalHours; ?>' size='50' class='boxValue' /></div>
   </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Overtime</label><select dbtype='tinyint(1)' name='EmployeePayrollDetails[<?php print $current->EmployeePayrollDetailsID; ?>][Overtime]' id='Overtime'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->Overtime; ?></select></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='EmployeePayrollDetails[<?php print $current->EmployeePayrollDetailsID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>
