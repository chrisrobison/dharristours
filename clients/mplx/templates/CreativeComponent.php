<div class='tableGroup'>
   <div class='formHeading'>CreativeComponent ID: <?php print $current->CreativeComponentID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Creative Component</label><input type='text' dbtype='varchar(100)' name='CreativeComponent[<?php print $current->CreativeComponentID; ?>][CreativeComponent]' id='CreativeComponent' value='<?php print $current->CreativeComponent; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='CreativeComponent[<?php print $current->CreativeComponentID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
<?php print $current->Notes; ?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='CreativeComponent[<?php print $current->CreativeComponentID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>