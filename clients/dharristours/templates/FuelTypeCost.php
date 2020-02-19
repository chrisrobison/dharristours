<div class='tableGroup'>
   <div class='formHeading'>FuelType ID: <?php print $current->FuelTypeID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Fuel Type</label><input type='text' dbtype='varchar(100)' name='FuelType[<?php print $current->FuelTypeID; ?>][FuelType]' id='FuelType' value='<?php print $current->FuelType; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Price</label><input type='text' dbtype='decimal(10,2)' name='FuelType[<?php print $current->FuelTypeID; ?>][Price]' id='Price' value='<?php print $current->Price; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
<?php print $current->Notes; ?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='FuelType[<?php print $current->FuelTypeID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>