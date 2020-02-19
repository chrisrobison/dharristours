<div class='tableGroup'>
   <div class='formHeading'>Merchant ID: <?php print $current->MerchantID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Merchant</label><input type='text' dbtype='varchar(100)' name='Merchant[<?php print $current->MerchantID; ?>][Merchant]' id='Merchant' value='<?php print $current->Merchant; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Merchant[<?php print $current->MerchantID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
<?php print $current->Notes; ?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Merchant[<?php print $current->MerchantID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>