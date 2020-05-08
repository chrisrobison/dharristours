<div class='tableGroup'>
   <div class='formHeading'>Damage ID: <?php print $current->DamageID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Damage</label><input type='text' dbtype='varchar(200)' name='Damage[<?php print $current->DamageID; ?>][Damage]' id='Damage' value='<?php print $current->Damage; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Reported By</label><input type='text' dbtype='varchar(200)' name='Damage[<?php print $current->DamageID; ?>][ReportedBy]' id='ReportedBy' value='<?php print $current->ReportedBy; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Status</label><input type='text' dbtype='enum('new','acknowleged','rejected','blocked','in process','in review','complete')' name='Damage[<?php print $current->DamageID; ?>][Status]' id='Status' value='<?php print $current->Status; ?>' size='25' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Damage Location</label><label style='width:1em;'>x</label><input type='text' dbtype='int(10)' name='Damage[<?php print $current->DamageID; ?>][x]' id='x' value='<?php print $current->x; ?>' size='3' class='boxValue' style='width:4em;' />
         <label style='width:1em'>y</label><input type='text' dbtype='int(10)' name='Damage[<?php print $current->DamageID; ?>][y]' id='y' value='<?php print $current->y; ?>' size='3' class='boxValue'  style='width:4em;'/></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Severity</label><input type='text' dbtype='int(2)' name='Damage[<?php print $current->DamageID; ?>][Severity]' id='Severity' value='<?php print $current->Severity; ?>' size='2' class='boxValue' style='width:15em;' /></div>
         <div class='contentField'><label>Bus </label><?php $boss->db->addResource("Bus");$arr = $boss->db->Bus->getlist();print $boss->utility->buildSelect($arr, $current->BusID, "BusID", "Bus", "Damage[$current->DamageID][BusID]")."</div>";?>
      </div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Damage[<?php print $current->DamageID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>
