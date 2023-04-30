<script>
    function openDriverLog() {
        let z = btoa("ID=" + simpleConfig.id);
        let tgt = '<?php print $boss->app->Assets; ?>/templates/forms/DriverLog.php?z=' + z;

        window.open(tgt, "btnJobWin", "height=800,width=600,resizable=yes,scrollbars=yes,status=yes,toolbar=yes,menubar=yes,location=no,personalbar=no");

        return false;
    }
    function updateMap(id) {
      const map = document.querySelector("#map");
      
      const origin = "origin=" + encodeURIComponent(simpleConfig.record.PickupLocation);
      const dropoff = "destination=" + encodeURIComponent(simpleConfig.record.DropOffLocation);
      map.src = `https://www.google.com/maps/embed/v1/directions?key=AIzaSyAAnPQjGJ_OxHT-45IvHUA6Rxt_4EgDdDA&${origin}&${dropoff}`;
      
    }
</script>
<div class='tableGroup'>
    <div class='formHeading'> Job ID:
        <?php print $current->JobID; ?>
    </div>
    <button name='driverLogButton' style='float:middle;background-color:green;color:white' onclick='return openDriverLog()'>Print Driver Log</button>
    <div class='fieldcontainer'>
        <div class='fieldcolumn fieldfloater'>
            <div class='contentField'><span class='fieldLabel'>Trip Cancelled: </span><span name='Job[][JobCancelled]' id='JobCancelled'></span></div>
            <div class='contentField'><span class='fieldLabel'>Job: </span><span name='Job[][Job]' id='Job'></span></div>
            <div class='contentField'><span class='fieldLabel'>Date: </span><span name='Job[][JobDate]' id='JobDate'></span></div>
            <div class='contentField'><span class='fieldLabel'>P/U Time: </span><span name='Job[][PickupTime]' id='PickupTime'></span></div>
            <div class='contentField'><span class='fieldLabel'>D/O Time: </span><span name='Job[][DropOffTime]' id='DropOffTime'></span></div>
            <div class='contentField'><span class='fieldLabel'>Pax: </span><span name='Job[][NumberOfItems]' id='NumberOfItems'></span></div>
            <div class='contentField'>
                <label>Directions</label><a href='https://www.google.com/maps/dir/ <?php print $current->PickupLocation; ?>' id='directionsPU' name='directionsPU' target='_blank'>View Full Route</a>

                <span id='travelStartTime'></span>
            </div>

            <div class='contentField'><span class='fieldLabel'>P/U Location: </span><span name='Job[][PickupLocation]' id='PickupLocation'></span></div>
            <div class='contentField'><span class='fieldLabel'>D/O Location: </span><span name='Job[][DropOffLocation]' id='DropOffLocation'></span></div>
            <div class='contentField'><span class='fieldLabel'>Final D/O: </span><span name='Job[][FinalDropOffLocation]' id='FinalDropOffLocation'></span></div>
        </div>
        <div class='fieldcolumn fieldfloater'>
            <div class='contentField'><span class='fieldLabel'>Hours: </span><span name='Job[][Hours]' id='Hours'></span></div>
            <div class='contentField'><span class='fieldLabel'>Contact: </span><span name='Job[][ContactName]' id='ContactName'></span></div>
            <div class='contentField'><span class='fieldLabel'>Phone: </span><span name='Job[][ContactPhone]' id='ContactPhone'></span></div>
            <div class='contentField'><span class='fieldLabel'>Special Instructions: </span><span name='Job[][SpecialInstructions]' id='SpecialInstructions'></span></div>
        </div>
	     <div class='fieldcolumn fieldfloater'><iframe id='map' width='600' height='400'></iframe></div>
    </div>
</div>
