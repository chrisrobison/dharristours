<div class='tableGroup'>
   <div class='formHeading'>Rates ID: <?php print $current->RatesID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Rates</label><input type='text' dbtype='varchar(100)' name='Rates[<?php print $current->RatesID; ?>][Rates]' id='Rates' value='<?php print $current->Rates; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Rate</label><input type='text' dbtype='varchar(100)' name='Rates[<?php print $current->RatesID; ?>][Rate]' id='Rate' value='<?php print $current->Rate; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Rates[<?php print $current->RatesID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>First Four</label><input type='text' dbtype='float' name='Rates[<?php print $current->RatesID; ?>][FirstFour]' id='FirstFour' value='<?php print $current->FirstFour; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Overtime</label><input type='text' dbtype='float' name='Rates[<?php print $current->RatesID; ?>][Overtime]' id='Overtime' value='<?php print $current->Overtime; ?>' size='25' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>One Way</label><input type='text' dbtype='float' name='Rates[<?php print $current->RatesID; ?>][OneWay]' id='OneWay' value='<?php print $current->OneWay; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Pax</label><input type='text' dbtype='int(5)' name='Rates[<?php print $current->RatesID; ?>][Pax]' id='Pax' value='<?php print $current->Pax; ?>' size='5' class='boxValue' /></div>
         <div class='contentField'><label>Default Rate</label><select dbtype='tinyint(1)' name='Rates[<?php print $current->RatesID; ?>][DefaultRate]' id='DefaultRate'><option value='0'>No</option><option value='1'>Yes</option><?php print $current->DefaultRate; ?></select></div>
         <div class='contentField'><label>Business </label><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist();print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "Rates[$current->RatesID][BusinessID]")."</div>";?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Rates[<?php print $current->RatesID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>