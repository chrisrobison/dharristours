<div class='tableGroup'>
   <div class='formHeading'>Renewal ID: <?php print $current->RenewalID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Renewal</label><input type='text' dbtype='varchar(100)' name='Renewal[<?php print $current->RenewalID; ?>][Renewal]' id='Renewal' value='<?php print $current->Renewal; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Renewal[<?php print $current->RenewalID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Type</label><input type='text' dbtype='varchar(100)' name='Renewal[<?php print $current->RenewalID; ?>][Type]' id='Type' value='<?php print $current->Type; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Renewal Date</label><input type='text' dbtype='date' name='Renewal[<?php print $current->RenewalID; ?>][RenewalDate]' id='RenewalDate' value='<?php print $current->RenewalDate; ?>' size='25' class='boxValue date' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Employee </label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "Renewal[$current->RenewalID][EmployeeID]")."</div>";?>
         <div class='contentField'><label>Bus </label><?php $boss->db->addResource("Bus");$arr = $boss->db->Bus->getlist();print $boss->utility->buildSelect($arr, $current->BusID, "BusID", "Bus", "Renewal[$current->RenewalID][BusID]")."</div>";?>
         <div class='contentField'><label>Recurring</label><select dbtype='tinyint(1)' name='Renewal[<?php print $current->RenewalID; ?>][Recurring]' id='Recurring'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->Recurring; ?></select></div>
         <div class='contentField'><label>Recurs</label><input type='text' dbtype='int(15)' name='Renewal[<?php print $current->RenewalID; ?>][Recurs]' id='Recurs' value='<?php print $current->Recurs; ?>' size='15' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Renewal[<?php print $current->RenewalID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>