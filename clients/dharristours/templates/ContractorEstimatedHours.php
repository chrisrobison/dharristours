<div class='tableGroup'>
   <div class='formHeading'>ContractorEstimatedHours ID: <?php print $current->ContractorEstimatedHoursID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Contractor Estimated Hours</label><input type='text' dbtype='varchar(100)' name='ContractorEstimatedHours[<?php print $current->ContractorEstimatedHoursID; ?>][ContractorEstimatedHours]' id='ContractorEstimatedHours' value='<?php print $current->ContractorEstimatedHours; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='ContractorEstimatedHours[<?php print $current->ContractorEstimatedHoursID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Hours</label><input type='text' dbtype='decimal(15,4)' name='ContractorEstimatedHours[<?php print $current->ContractorEstimatedHoursID; ?>][Hours]' id='Hours' value='<?php print $current->Hours; ?>' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='ContractorEstimatedHours[<?php print $current->ContractorEstimatedHoursID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>