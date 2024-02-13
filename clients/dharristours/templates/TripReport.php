<script>
let lasttime;
function cleanMilliseconds(ms, el) {
   if (el.id != lasttime) {
      lasttime = el.id;
      
      let seconds = Math.floor(ms / 1000);
      let minutes = Math.floor(seconds / 60);
      let hours = (minutes > 60) ? Math.floor(minutes / 60) : 0
      minutes = minutes - (hours * 60);
      if (minutes < 10) {
        minutes = '0' + minutes;
      }
      return hours+':'+minutes;
    } else {
      return ms;
    }
}
</script>
<div class='tableGroup'>
   <div class='formHeading'>TripReport ID: <?php print $current->TripReportID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Trip Report</label><input type='text' dbtype='varchar(100)' name='TripReport[<?php print $current->TripReportID; ?>][TripReport]' id='TripReport' value='<?php print $current->TripReport; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='TripReport[<?php print $current->TripReportID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Vehicle</label><input type='text' dbtype='varchar(100)' name='TripReport[<?php print $current->TripReportID; ?>][Vehicle]' id='Vehicle' value='<?php print $current->Vehicle; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Day</label><input type='text' dbtype='date' name='TripReport[<?php print $current->TripReportID; ?>][Day]' id='Day' value='<?php print $current->Day; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Start Time</label><input type='text' dbtype='time' onchange='this.value=cleanMilliseconds(this.value, this)' name='TripReport[<?php print $current->TripReportID; ?>][StartTime]' id='StartTime' value='<?php print $current->StartTime; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>End Time</label><input type='text' dbtype='time' onchange='this.value=cleanMilliseconds(this.value, this)' name='TripReport[<?php print $current->TripReportID; ?>][EndTime]' id='EndTime' value='<?php print $current->EndTime; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Downtime</label><input type='text' dbtype='time' onchange='this.value=cleanMilliseconds(this.value, this)' name='TripReport[<?php print $current->TripReportID; ?>][Downtime]' id='Downtime' value='<?php print $current->Downtime; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Duration</label><input type='text' dbtype='decimal(15,4)' onchange='this.value=cleanMilliseconds(this.value, this)' name='TripReport[<?php print $current->TripReportID; ?>][Duration]' id='Duration' value='<?php print $current->Duration; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Standstill</label><input type='text' dbtype='decimal(15,4)' onchange='this.value=cleanMilliseconds(this.value, this)' name='TripReport[<?php print $current->TripReportID; ?>][Standstill]' id='Standstill' value='<?php print $current->Standstill; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Start Odometer</label><input type='text' dbtype='decimal(15,4)' name='TripReport[<?php print $current->TripReportID; ?>][StartOdometer]' id='StartOdometer' value='<?php print $current->StartOdometer; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>End Odometer</label><input type='text' dbtype='decimal(15,4)' name='TripReport[<?php print $current->TripReportID; ?>][EndOdometer]' id='EndOdometer' value='<?php print $current->EndOdometer; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Distance</label><input type='text' dbtype='decimal(15,4)' name='TripReport[<?php print $current->TripReportID; ?>][Distance]' id='Distance' value='<?php print $current->Distance; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Driver</label><input type='text' dbtype='varchar(100)' name='TripReport[<?php print $current->TripReportID; ?>][Driver]' id='Driver' value='<?php print $current->Driver; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Start Location</label><input type='text' dbtype='varchar(100)' name='TripReport[<?php print $current->TripReportID; ?>][StartLocation]' id='StartLocation' value='<?php print $current->StartLocation; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>End Location</label><input type='text' dbtype='varchar(100)' name='TripReport[<?php print $current->TripReportID; ?>][EndLocation]' id='EndLocation' value='<?php print $current->EndLocation; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Fuel Consumption</label><input type='text' dbtype='decimal(15,4)' name='TripReport[<?php print $current->TripReportID; ?>][FuelConsumption]' id='FuelConsumption' value='<?php print $current->FuelConsumption; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Average Fuel Consumption</label><input type='text' dbtype='varchar(100)' name='TripReport[<?php print $current->TripReportID; ?>][AverageFuelConsumption]' id='AverageFuelConsumption' value='<?php print $current->AverageFuelConsumption; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Reference Absolute</label><input type='text' dbtype='varchar(100)' name='TripReport[<?php print $current->TripReportID; ?>][ReferenceAbsolute]' id='ReferenceAbsolute' value='<?php print $current->ReferenceAbsolute; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Reference Relative</label><input type='text' dbtype='varchar(100)' name='TripReport[<?php print $current->TripReportID; ?>][ReferenceRelative]' id='ReferenceRelative' value='<?php print $current->ReferenceRelative; ?>' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='TripReport[<?php print $current->TripReportID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>
