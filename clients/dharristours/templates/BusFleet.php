<div class='tableGroup'>
   <div class='formHeading'>Bus ID: <?php print $current->BusID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Bus</label><input type='text' dbtype='varchar(100)' name='Bus[<?php print $current->BusID; ?>][Bus]' id='Bus' value='<?php print $current->Bus; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Owned By</label><input type='text' dbtype='varchar(100)' name='Bus[<?php print $current->BusID; ?>][OwnedBy]' id='OwnedBy' value='<?php print $current->OwnedBy; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Rental Price</label><input type='text' dbtype='float' name='Bus[<?php print $current->BusID; ?>][RentalPrice]' id='RentalPrice' value='<?php print $current->RentalPrice; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Over Time Price</label><input type='text' dbtype='decimal(10,2)' name='Bus[<?php print $current->BusID; ?>][OverTimePrice]' id='OverTimePrice' value='<?php print $current->OverTimePrice; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Cost</label><input type='text' dbtype='decimal(10,2)' name='Bus[<?php print $current->BusID; ?>][Cost]' id='Cost' value='<?php print $current->Cost; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Over Time Cost</label><input type='text' dbtype='decimal(10,2)' name='Bus[<?php print $current->BusID; ?>][OverTimeCost]' id='OverTimeCost' value='<?php print $current->OverTimeCost; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Miles Per Gallon</label><input type='text' dbtype='int(11)' name='Bus[<?php print $current->BusID; ?>][MilesPerGallon]' id='MilesPerGallon' value='<?php print $current->MilesPerGallon; ?>' size='11' class='boxValue' /></div>
         <div class='contentField'><label>Model</label><input type='text' dbtype='varchar(50)' name='Bus[<?php print $current->BusID; ?>][Model]' id='Model' value='<?php print $current->Model; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>License</label><input type='text' dbtype='varchar(50)' name='Bus[<?php print $current->BusID; ?>][License]' id='License' value='<?php print $current->License; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Last Service</label><input type='text' dbtype='date' name='Bus[<?php print $current->BusID; ?>][LastService]' id='LastService' value='<?php print $current->LastService; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Active</label><select dbtype='tinyint(1)' name='Bus[<?php print $current->BusID; ?>][Active]' id='Active'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->Active; ?></select></div>
         <div class='contentField'><label>Wheel Chair</label><select dbtype='tinyint(1)' name='Bus[<?php print $current->BusID; ?>][WheelChair]' id='WheelChair'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->WheelChair; ?></select></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Sound System</label><input type='text' dbtype='varchar(100)' name='Bus[<?php print $current->BusID; ?>][SoundSystem]' id='SoundSystem' value='<?php print $current->SoundSystem; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Insurance</label><input type='text' dbtype='varchar(100)' name='Bus[<?php print $current->BusID; ?>][Insurance]' id='Insurance' value='<?php print $current->Insurance; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Extras</label><input type='text' dbtype='varchar(100)' name='Bus[<?php print $current->BusID; ?>][Extras]' id='Extras' value='<?php print $current->Extras; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Capacity</label><input type='text' dbtype='int(15)' name='Bus[<?php print $current->BusID; ?>][Capacity]' id='Capacity' value='<?php print $current->Capacity; ?>' size='15' class='boxValue' /></div>
         <div class='contentField'><label>VIN</label><input type='text' dbtype='varchar(100)' name='Bus[<?php print $current->BusID; ?>][VIN]' id='VIN' value='<?php print $current->VIN; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Year</label><input type='text' dbtype='varchar(100)' name='Bus[<?php print $current->BusID; ?>][Year]' id='Year' value='<?php print $current->Year; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Make</label><input type='text' dbtype='varchar(100)' name='Bus[<?php print $current->BusID; ?>][Make]' id='Make' value='<?php print $current->Make; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Registration Date</label><input type='text' dbtype='date' name='Bus[<?php print $current->BusID; ?>][RegistrationDate]' id='RegistrationDate' value='<?php print $current->RegistrationDate; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>SPABLicense Date</label><input type='text' dbtype='date' name='Bus[<?php print $current->BusID; ?>][SPABLicenseDate]' id='SPABLicenseDate' value='<?php print $current->SPABLicenseDate; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Fuel Size</label><input type='text' dbtype='int(15)' name='Bus[<?php print $current->BusID; ?>][FuelSize]' id='FuelSize' value='<?php print $current->FuelSize; ?>' size='15' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Bus[<?php print $current->BusID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>