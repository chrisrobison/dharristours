<div class='tableGroup'>
   <div class='formHeading'>BusPart ID: <?php print $current->BusPartID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Part</label><input type='text' dbtype='varchar(100)' name='BusPart[<?php print $current->BusPartID; ?>][BusPart]' id='BusPart' value='<?php print $current->BusPart; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='BusPart[<?php print $current->BusPartID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>List Price</label><input type='text' dbtype='decimal(10,2)' name='BusPart[<?php print $current->BusPartID; ?>][ListPrice]' id='ListPrice' value='<?php print $current->ListPrice; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Net Price</label><input type='text' dbtype='decimal(10,2)' name='BusPart[<?php print $current->BusPartID; ?>][NetPrice]' id='NetPrice' value='<?php print $current->NetPrice; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Part Number</label><input type='text' dbtype='varchar(100)' name='BusPart[<?php print $current->BusPartID; ?>][PartNumber]' id='PartNumber' value='<?php print $current->PartNumber; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Bus </label><?php $boss->db->addResource("Bus");$arr = $boss->db->Bus->getlist();print $boss->utility->buildSelect($arr, $current->BusID, "BusID", "Bus", "BusPart[$current->BusPartID][BusID]")."</div>";?>
         <div class='contentField'><label>Quantity On Hand</label><input type='text' dbtype='int(15)' name='BusPart[<?php print $current->BusPartID; ?>][QuantityOnHand]' id='QuantityOnHand' value='<?php print $current->QuantityOnHand; ?>' size='15' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='BusPart[<?php print $current->BusPartID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>
