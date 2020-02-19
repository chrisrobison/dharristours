<div class='tableGroup'>
   <div class='boxHeading'> Buses ID: <?php print $current->BusesID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Buses</span><input type='text' name='Buses[<?php print $current->BusesID; ?>][Buses]' id='Buses' value='<?php print $current->Buses; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Owned By</span><input type='text' name='Buses[<?php print $current->BusesID; ?>][OwnedBy]' id='OwnedBy' value='<?php print $current->OwnedBy; ?>' size='50' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Rental Price</span><input type='text' name='Buses[<?php print $current->BusesID; ?>][RentalPrice]' id='RentalPrice' value='<?php print $current->RentalPrice; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Last Updated</span><input type='text' name='Buses[<?php print $current->BusesID; ?>][LastUpdated]' id='LastUpdated' value='<?php print $current->LastUpdated; ?>' size='25' class='boxValue' /></div>
      </span>
   </div>
</div>