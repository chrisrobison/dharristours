<div class='tableGroup'>
   <div class='formHeading'>SupportTicket ID: <?php print $current->SupportTicketID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Support Ticket</label><input type='text' dbtype='varchar(100)' name='SupportTicket[<?php print $current->SupportTicketID; ?>][SupportTicket]' id='SupportTicket' value='<?php print $current->SupportTicket; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='SupportTicket[<?php print $current->SupportTicketID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Date Called</label><input type='text' dbtype='date' name='SupportTicket[<?php print $current->SupportTicketID; ?>][DateCalled]' id='DateCalled' value='<?php print $current->DateCalled; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Customer</label><input type='text' dbtype='varchar(100)' name='SupportTicket[<?php print $current->SupportTicketID; ?>][Customer]' id='Customer' value='<?php print $current->Customer; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Date Solved</label><input type='text' dbtype='date' name='SupportTicket[<?php print $current->SupportTicketID; ?>][DateSolved]' id='DateSolved' value='<?php print $current->DateSolved; ?>' size='25' class='boxValue date' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='SupportTicket[<?php print $current->SupportTicketID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>