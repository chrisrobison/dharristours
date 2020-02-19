<div class='tableGroup'>
   <div class='formHeading'>Fuel ID: <?php print $current->FuelID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Fuel</label><input type='text' dbtype='varchar(100)' name='Fuel[<?php print $current->FuelID; ?>][Fuel]' id='Fuel' value='<?php print $current->Fuel; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Bus </label><?php $boss->db->addResource("Bus");$arr = $boss->db->Bus->getlist();print $boss->utility->buildSelect($arr, $current->BusID, "BusID", "Bus", "Fuel[$current->FuelID][BusID]")."</div>";?>
         <div class='contentField'><label>Fuel Date</label><input type='text' dbtype='date' name='Fuel[<?php print $current->FuelID; ?>][FuelDate]' id='FuelDate' value='<?php print $current->FuelDate; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Employee </label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "Fuel[$current->FuelID][EmployeeID]")."</div>";?>
         <div class='contentField'><label>Fuel Amount</label><input type='text' dbtype='decimal(10,2)' name='Fuel[<?php print $current->FuelID; ?>][FuelAmount]' id='FuelAmount' value='<?php print $current->FuelAmount; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Gallons</label><input type='text' dbtype='decimal(5,3)' name='Fuel[<?php print $current->FuelID; ?>][Gallons]' id='Gallons' value='<?php print $current->Gallons; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>PPG</label><input type='text' dbtype='decimal(10,2)' name='Fuel[<?php print $current->FuelID; ?>][PPG]' id='PPG' value='<?php print $current->PPG; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Fuel[<?php print $current->FuelID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>