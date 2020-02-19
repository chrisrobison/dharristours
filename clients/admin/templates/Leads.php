<div class='tableGroup'>
   <div class='formHeading'>Leads ID: <?php print $current->LeadsID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Leads</label><input type='text' dbtype='varchar(100)' name='Leads[<?php print $current->LeadsID; ?>][Leads]' id='Leads' value='<?php print $current->Leads; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Business </label><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist();print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "Leads[$current->LeadsID][BusinessID]")."</div>";?>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Phone</label><input type='text' dbtype='varchar(50)' name='Leads[<?php print $current->LeadsID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Name</label><input type='text' dbtype='varchar(100)' name='Leads[<?php print $current->LeadsID; ?>][Name]' id='Name' value='<?php print $current->Name; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(100)' name='Leads[<?php print $current->LeadsID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>City</label><input type='text' dbtype='varchar(100)' name='Leads[<?php print $current->LeadsID; ?>][City]' id='City' value='<?php print $current->City; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Sales Person</label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "Leads[$current->LeadsID][SalesPerson_EmployeeID]")."</div>";?>
         <div class='contentField'><label>Referall</label><?php $boss->db->addResource("Client");$arr = $boss->db->Client->getlist();print $boss->utility->buildSelect($arr, $current->ClientID, "ClientID", "Client", "Leads[$current->LeadsID][Referall_ClientID]")."</div>";?>
         <div class='contentField'><label>Sales Cycle </label><?php $boss->db->addResource("SalesCycle");$arr = $boss->db->SalesCycle->getlist();print $boss->utility->buildSelect($arr, $current->SalesCycleID, "SalesCycleID", "SalesCycle", "Leads[$current->LeadsID][SalesCycleID]")."</div>";?>
         <div class='contentField'><label>Next Contact</label><input type='text' dbtype='date' name='Leads[<?php print $current->LeadsID; ?>][NextContact]' id='NextContact' value='<?php print $current->NextContact; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Upload</label><input type='file' dbtype='blob' name='Leads[<?php print $current->LeadsID; ?>][Upload]' id='Upload' class='boxValue'><?php print $current->Upload; ?></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Leads[<?php print $current->LeadsID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>