<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> Adam ID: <?php print $current->AdamID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Adam</label><input type='text' dbtype='varchar(100)' name='Adam[<?php print $current->AdamID; ?>][Adam]' id='Adam' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Adam[<?php print $current->AdamID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>

      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Yay</label><input type='text' dbtype='varchar(100)' name='Adam[<?php print $current->AdamID; ?>][Yay]' id='Yay' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Component </label><?php $boss->db->addResource("Component");$arr = $boss->db->Component->getlist();print $boss->utility->buildSelect($arr, $current->ComponentID, "ComponentID", "Component", "Adam[$current->AdamID][ComponentID]")."</div>";?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Adam[<?php print $current->AdamID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>