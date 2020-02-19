<div class='tableGroup'>
   <div class='formHeading'>Invoice ID: <?php print $current->InvoiceID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Invoice</label><input type='text' dbtype='varchar(100)' name='Invoice[<?php print $current->InvoiceID; ?>][Invoice]' id='Invoice' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Job </label><?php $boss->db->addResource("Job");$arr = $boss->db->Job->getlist();print $boss->utility->buildSelect($arr, $current->JobID, "JobID", "Job", "Invoice[$current->InvoiceID][JobID]")."</div>";?>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(250)' name='Invoice[<?php print $current->InvoiceID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Invoice Date</label><input type='text' dbtype='varchar(50)' name='Invoice[<?php print $current->InvoiceID; ?>][InvoiceDate]' id='InvoiceDate' value='' size='50' class='boxValue date' /></div>
         <div class='contentField'><label>Invoice Amt</label><input type='text' dbtype='varchar(50)' name='Invoice[<?php print $current->InvoiceID; ?>][InvoiceAmt]' id='InvoiceAmt' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Tax</label><input type='text' dbtype='varchar(50)' name='Invoice[<?php print $current->InvoiceID; ?>][Tax]' id='Tax' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Arrival Date</label><input type='text' dbtype='datetime' name='Invoice[<?php print $current->InvoiceID; ?>][ArrivalDate]' id='ArrivalDate' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Arrival Time</label><input type='text' dbtype='varchar(100)' name='Invoice[<?php print $current->InvoiceID; ?>][ArrivalTime]' id='ArrivalTime' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Start Time</label><input type='text' dbtype='varchar(50)' name='Invoice[<?php print $current->InvoiceID; ?>][StartTime]' id='StartTime' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>End Time</label><input type='text' dbtype='varchar(50)' name='Invoice[<?php print $current->InvoiceID; ?>][EndTime]' id='EndTime' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Yard Starting Mileage</label><input type='text' dbtype='int(11)' name='Invoice[<?php print $current->InvoiceID; ?>][YardStartingMileage]' id='YardStartingMileage' value='' size='11' class='boxValue' /></div>
         <div class='contentField'><label>Yard Ending Mileage</label><input type='text' dbtype='int(11)' name='Invoice[<?php print $current->InvoiceID; ?>][YardEndingMileage]' id='YardEndingMileage' value='' size='11' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Starting Mileage</label><input type='text' dbtype='int(11)' name='Invoice[<?php print $current->InvoiceID; ?>][StartingMileage]' id='StartingMileage' value='' size='11' class='boxValue' /></div>
         <div class='contentField'><label>Ending Mileage</label><input type='text' dbtype='int(11)' name='Invoice[<?php print $current->InvoiceID; ?>][EndingMileage]' id='EndingMileage' value='' size='11' class='boxValue' /></div>
         <div class='contentField'><label>Billable Hours</label><input type='text' dbtype='varchar(50)' name='Invoice[<?php print $current->InvoiceID; ?>][BillableHours]' id='BillableHours' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Paid Amt</label><input type='text' dbtype='varchar(50)' name='Invoice[<?php print $current->InvoiceID; ?>][PaidAmt]' id='PaidAmt' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Balance</label><input type='text' dbtype='varchar(50)' name='Invoice[<?php print $current->InvoiceID; ?>][Balance]' id='Balance' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Check Num</label><input type='text' dbtype='varchar(50)' name='Invoice[<?php print $current->InvoiceID; ?>][CheckNum]' id='CheckNum' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Check Date</label><input type='text' dbtype='varchar(50)' name='Invoice[<?php print $current->InvoiceID; ?>][CheckDate]' id='CheckDate' value='' size='50' class='boxValue date' /></div>

         <div class='contentField'><label>Invoice Sent</label><select dbtype='tinyint(4)' name='Invoice[<?php print $current->InvoiceID; ?>][InvoiceSent]' id='InvoiceSent'><option value='0'>No</option><option value='1'>Yes</option></select></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Invoice[<?php print $current->InvoiceID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>