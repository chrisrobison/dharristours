<script>
   function openDriverLog() {
      let z = btoa("ID=" + simpleConfig.id);
      let tgt = '<?php print $boss->app->Assets; ?>/templates/DriverLog.php?z=' + z;
      
      window.open(tgt, "btnJobWin", "height=800,width=600,resizable=yes,scrollbars=yes,status=yes,toolbar=yes,menubar=yes,location=no,personalbar=no");
      
      return false;
   }
</script>
<div class='tableGroup'>
   <div class='formHeading'> Job ID: <?php print $current->JobID; ?></div>
   <button name='driverLogButton' style='float:middle' onclick='return openDriverLog()'>Print Driver Log</button>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Trip Cancelled: </span><span name='Job[][JobCancelled]' id='JobCancelled'></span></div>
         <div class='contentField'><span class='fieldLabel'>Job: </span><span name='Job[][Job]' id='Job'></span></div>
	 <div class='contentField'><span class='fieldLabel'>Date: </span><span name='Job[][JobDate]' id='JobDate'></span></div>
         <div class='contentField'><span class='fieldLabel'>P/U Time: </span><span name='Job[][PickupTime]' id='PickupTime'></span></div>
         <div class='contentField'><span class='fieldLabel'>D/O Time: </span><span name='Job[][DropOffTime]' id='DropOffTime'></span></div>
         <div class='contentField'><span class='fieldLabel'>Pax: </span><span name='Job[][NumberOfItems]' id='NumberOfItems'></span></div>
         <div class='contentField'><span class='fieldLabel'>Bus: </span><span name='Job[][BusID]' id='BusID'></span></div>
         <div class='contentField'><span class='fieldLabel'>P/U Location: </span><span name='Job[][PickupLocation]' id='PickupLocation'></span></div>
         <div class='contentField'><span class='fieldLabel'>D/O Location: </span><span name='Job[][DropOffLocation]' id='DropOffLocation'></span></div>
         <div class='contentField'><span class='fieldLabel'>Final D/O: </span><span name='Job[][FinalDropOffLocation]' id='FinalDropOffLocation'></span></div>
      </div>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Hours: </span><span name='Job[][Hours]' id='Hours'></span></div>
	 <div class='contentField'><span class='fieldLabel'>Business Location: </span><span name='Job[][BusinessLocation]' id='BusinessLocation'></span></div>
	 <div class='contentField'><span class='fieldLabel'>Contact: </span><span name='Job[][ContactName]' id='ContactName'></span></div>
	 <div class='contentField'><span class='fieldLabel'>Phone: </span><span name='Job[][ContactPhone]' id='ContactPhone'></span></div>
	 <div class='contentField'><span class='fieldLabel'>Special Instructions: </span><span name='Job[][SpecialInstructions]' id='SpecialInstructions'></span></div>
      </div>
   </div>
</div>
