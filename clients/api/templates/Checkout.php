<div class='tableGroup'>
   <div class='formHeading'>Checkout ID: <?php print $current->CheckoutID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Checkout</label><input type='text' dbtype='varchar(100)' name='Checkout[<?php print $current->CheckoutID; ?>][Checkout]' id='Checkout' value='<?php print $current->Checkout; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Checkout[<?php print $current->CheckoutID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Serial Number</label><input type='text' dbtype='varchar(100)' name='Checkout[<?php print $current->CheckoutID; ?>][SerialNumber]' id='SerialNumber' value='<?php print $current->SerialNumber; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Google Order Number</label><input type='text' dbtype='varchar(100)' name='Checkout[<?php print $current->CheckoutID; ?>][GoogleOrderNumber]' id='GoogleOrderNumber' value='<?php print $current->GoogleOrderNumber; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Timestamp</label><input type='text' dbtype='datetime' name='Checkout[<?php print $current->CheckoutID; ?>][Timestamp]' id='Timestamp' value='<?php print $current->Timestamp; ?>' size='25' class='boxValue date' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Merchant Data</label><input type='text' dbtype='varchar(255)' name='Checkout[<?php print $current->CheckoutID; ?>][MerchantData]' id='MerchantData' value='<?php print $current->MerchantData; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Buyer </label><?php $boss->db->addResource("Buyer");$arr = $boss->db->Buyer->getlist();print $boss->utility->buildSelect($arr, $current->BuyerID, "BuyerID", "Buyer", "Checkout[$current->CheckoutID][BuyerID]")."</div>";?>
         <div class='contentField'><label>Order Total</label><input type='text' dbtype='decimal(10,2)' name='Checkout[<?php print $current->CheckoutID; ?>][OrderTotal]' id='OrderTotal' value='<?php print $current->OrderTotal; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Fulfillment Order State</label><input type='text' dbtype='varchar(100)' name='Checkout[<?php print $current->CheckoutID; ?>][FulfillmentOrderState]' id='FulfillmentOrderState' value='<?php print $current->FulfillmentOrderState; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Financial Order State</label><input type='text' dbtype='varchar(100)' name='Checkout[<?php print $current->CheckoutID; ?>][FinancialOrderState]' id='FinancialOrderState' value='<?php print $current->FinancialOrderState; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Buyer Address</label><textarea dbtype='text' name='Checkout[<?php print $current->CheckoutID; ?>][BuyerAddress]' id='BuyerAddress' class='textBox'><?php print $current->BuyerAddress; ?></textarea></div>
         <div class='contentField'><label>Cart</label><textarea dbtype='text' name='Checkout[<?php print $current->CheckoutID; ?>][Cart]' id='Cart' class='textBox'><?php print $current->Cart; ?></textarea></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Checkout[<?php print $current->CheckoutID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>