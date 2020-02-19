<div class='tableGroup'>
   <div class='formHeading'>Bills ID: <?php print $current->BillsID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Bills</label><input type='text' dbtype='varchar(100)' name='Bills[<?php print $current->BillsID; ?>][Bills]' id='Bills' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Bills[<?php print $current->BillsID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>

         <div class='contentField'><label>Vendor </label><?php $boss->db->addResource("Vendor");$arr = $boss->db->Vendor->getlist();print $boss->utility->buildSelect($arr, $current->VendorID, "VendorID", "Vendor", "Bills[$current->BillsID][VendorID]")."</div>";?>
         <div class='contentField'><label>Monthly</label><select dbtype='tinyint(1)' name='Bills[<?php print $current->BillsID; ?>][Monthly]' id='Monthly'><option value='0'>No</option><option value='1'>Yes</option></select></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Due Date</label><input type='text' dbtype='datetime' name='Bills[<?php print $current->BillsID; ?>][DueDate]' id='DueDate' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Amount</label><input type='text' dbtype='decimal(10,2)' name='Bills[<?php print $current->BillsID; ?>][Amount]' id='Amount' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Check Number</label><input type='text' dbtype='varchar(100)' name='Bills[<?php print $current->BillsID; ?>][CheckNumber]' id='CheckNumber' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Date Paid</label><input type='text' dbtype='datetime' name='Bills[<?php print $current->BillsID; ?>][DatePaid]' id='DatePaid' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Total Paid</label><select dbtype='tinyint(1)' name='Bills[<?php print $current->BillsID; ?>][TotalPaid]' id='TotalPaid'><option value='0'>No</option><option value='1'>Yes</option></select></div>
         <div class='contentField'><label>Amount Paid</label><input type='text' dbtype='decimal(10,2)' name='Bills[<?php print $current->BillsID; ?>][AmountPaid]' id='AmountPaid' value='' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Bills[<?php print $current->BillsID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>