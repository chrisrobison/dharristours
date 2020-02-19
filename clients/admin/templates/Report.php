<div class='tableGroup'>
   <div class='formHeading'>Report ID: <?php print $current->ReportID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Report</label><input type='text' dbtype='varchar(100)' name='Report[<?php print $current->ReportID; ?>][Report]' id='Report' value='<?php print $current->Report; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Template</label><input type='text' dbtype='varchar(100)' name='Report[<?php print $current->ReportID; ?>][Template]' id='Template' value='<?php print $current->Template; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Query</label><textarea dbtype='text' name='Report[<?php print $current->ReportID; ?>][Query]' id='Query' class='textBox'><?php print $current->Query; ?></textarea></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Function</label><input type='text' dbtype='varchar(100)' name='Report[<?php print $current->ReportID; ?>][Function]' id='Function' value='<?php print $current->Function; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Report[<?php print $current->ReportID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>