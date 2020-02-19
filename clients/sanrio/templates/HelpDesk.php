<div class='tableGroup'>

   <div class='formHeading'><h1 class='boxHeading'> HelpDesk ID: <?php print $current->HelpDeskID; ?></h1></div>

   <div class='fieldcontainer'>

      <div class='fieldcolumn fieldfloater'>

         <div class='contentField'><label>Help Desk</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][HelpDesk]' id='HelpDesk' value='' size='50' class='boxValue' /></div>


         <div class='contentField'><label>Request Type ID</label><select name='HelpDesk[<?php print $current->HelpDeskID; ?>][RequestTypeID]' id='RequestTypeID'><?php print $boss->utility->makeListOptions('Request Type', ''); ?></select></div>

         <div class='contentField'><label>Request Status ID</label><select name='HelpDesk[<?php print $current->HelpDeskID; ?>][RequestStatusID]' id='RequestStatusID'><?php print $boss->utility->makeListOptions('Request Status', ''); ?></select></div>

         <div class='contentField'><label>Name</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Name]' id='Name' value='' size='50' class='boxValue' /></div>

         <div class='contentField'><label>Number</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Number]' id='Number' value='' size='50' class='boxValue' /></div>

         <div class='contentField'><label>Department</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Department]' id='Department' value='' size='50' class='boxValue' /></div>

      </div>

      <div class='fieldcolumn'>


         <div class='contentField'><label>Severity</label>		<select name='HelpDesk[<?php print $current->HelpDeskID; ?>][Severity]' 	id='Severity'><?php print $boss->utility->makeListOptions('Severity', ''); ?></select></div>

         <div class='contentField'><label>User Severity</label>		<select disabled='disabled' name='HelpDesk[<?php print $current->HelpDeskID; ?>][User_Severity]' 	id='User_Severity'><?php print $boss->utility->makeListOptions('Severity', ''); ?></select></div>

         <div class='contentField'><label>Category</label>		<select disabled='disabled' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Category]' 	id='Category'><?php print $boss->utility->makeListOptions('Category', ''); ?></select></div>

         <div class='contentField'><label>Category</label><input type='text' dbtype='varchar(100)' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Category]' id='Category' value='' size='50' class='boxValue' /></div>
</div>

         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='HelpDesk[<?php print $current->HelpDeskID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div>
</div>
</div>
