<div class='tableGroup'>
   <div class='boxHeading'> Invoice ID: <?php print $current->InvoiceID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Total</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][Total]' id='Total' value='<?php print $current->Total; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Tax</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][Tax]' id='Tax' value='<?php print $current->Tax; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Paid</span><input type='text' name='Invoice[<?php print $current->InvoiceID; ?>][Paid]' id='Paid' value='<?php print $current->Paid; ?>' size='50' class='boxValue' /></div>
      </span>
   </div>
</div>
