<div class='tableGroup'>
   <div class='formHeading'>Buses ID: <?php print $current->BusesID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Buses</label><input type='text' dbtype='varchar(100)' name='Buses[<?php print $current->BusesID; ?>][Buses]' id='Buses' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Owned By</label><input type='text' dbtype='varchar(100)' name='Buses[<?php print $current->BusesID; ?>][OwnedBy]' id='OwnedBy' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Rental Price</label><input type='text' dbtype='float' name='Buses[<?php print $current->BusesID; ?>][RentalPrice]' id='RentalPrice' value='' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Model</label><input type='text' dbtype='varchar(50)' name='Buses[<?php print $current->BusesID; ?>][Model]' id='Model' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>License</label><input type='text' dbtype='varchar(50)' name='Buses[<?php print $current->BusesID; ?>][License]' id='License' value='' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Last Service</label><input type='text' dbtype='varchar(150)' name='Buses[<?php print $current->BusesID; ?>][LastService]' id='LastService' value='' size='50' class='boxValue' /></div>
</div>
</div>
</div>