<div class='tableGroup'>
   <div class='formHeading'>History ID: <?php print $current->HistoryID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>History</label><input type='text' dbtype='varchar(100)' name='History[<?php print $current->HistoryID; ?>][History]' id='History' value='<?php print $current->History; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='History[<?php print $current->HistoryID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Undo</label><textarea dbtype='text' name='History[<?php print $current->HistoryID; ?>][Undo]' id='Undo' class='textBox'><?php print $current->Undo; ?></textarea></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Redo</label><textarea dbtype='text' name='History[<?php print $current->HistoryID; ?>][Redo]' id='Redo' class='textBox'><?php print $current->Redo; ?></textarea></div>
         <div class='contentField'><label>Login </label><?php $boss->db->addResource("Login");$arr = $boss->db->Login->getlist();print $boss->utility->buildSelect($arr, $current->LoginID, "LoginID", "Login", "History[$current->HistoryID][LoginID]")."</div>";?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='History[<?php print $current->HistoryID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>