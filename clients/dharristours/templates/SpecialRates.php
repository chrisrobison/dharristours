<div class='tableGroup'>
   <div class='formHeading'>SpecialRates ID: <?php print $current->SpecialRatesID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Special Rates</label><input type='text' dbtype='varchar(100)' name='SpecialRates[<?php print $current->SpecialRatesID; ?>][SpecialRates]' id='SpecialRates' value='<?php print $current->SpecialRates; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='SpecialRates[<?php print $current->SpecialRatesID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Cost28First Four</label><input type='text' dbtype='float' name='SpecialRates[<?php print $current->SpecialRatesID; ?>][Cost28FirstFour]' id='Cost28FirstFour' value='<?php print $current->Cost28FirstFour; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Cost28OT</label><input type='text' dbtype='float' name='SpecialRates[<?php print $current->SpecialRatesID; ?>][Cost28OT]' id='Cost28OT' value='<?php print $current->Cost28OT; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Cost28One Way</label><input type='text' dbtype='float' name='SpecialRates[<?php print $current->SpecialRatesID; ?>][Cost28OneWay]' id='Cost28OneWay' value='<?php print $current->Cost28OneWay; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Cost32First Four</label><input type='text' dbtype='float' name='SpecialRates[<?php print $current->SpecialRatesID; ?>][Cost32FirstFour]' id='Cost32FirstFour' value='<?php print $current->Cost32FirstFour; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Cost32OT</label><input type='text' dbtype='float' name='SpecialRates[<?php print $current->SpecialRatesID; ?>][Cost32OT]' id='Cost32OT' value='<?php print $current->Cost32OT; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Cost32One Way</label><input type='text' dbtype='float' name='SpecialRates[<?php print $current->SpecialRatesID; ?>][Cost32OneWay]' id='Cost32OneWay' value='<?php print $current->Cost32OneWay; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Cost38First Four</label><input type='text' dbtype='float' name='SpecialRates[<?php print $current->SpecialRatesID; ?>][Cost38FirstFour]' id='Cost38FirstFour' value='<?php print $current->Cost38FirstFour; ?>' size='25' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Cost38OT</label><input type='text' dbtype='float' name='SpecialRates[<?php print $current->SpecialRatesID; ?>][Cost38OT]' id='Cost38OT' value='<?php print $current->Cost38OT; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Cost38One Way</label><input type='text' dbtype='float' name='SpecialRates[<?php print $current->SpecialRatesID; ?>][Cost38OneWay]' id='Cost38OneWay' value='<?php print $current->Cost38OneWay; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Cost45First Four</label><input type='text' dbtype='float' name='SpecialRates[<?php print $current->SpecialRatesID; ?>][Cost45FirstFour]' id='Cost45FirstFour' value='<?php print $current->Cost45FirstFour; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Cost45OT</label><input type='text' dbtype='float' name='SpecialRates[<?php print $current->SpecialRatesID; ?>][Cost45OT]' id='Cost45OT' value='<?php print $current->Cost45OT; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Cost45One Way</label><input type='text' dbtype='float' name='SpecialRates[<?php print $current->SpecialRatesID; ?>][Cost45OneWay]' id='Cost45OneWay' value='<?php print $current->Cost45OneWay; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Cost55First Four</label><input type='text' dbtype='float' name='SpecialRates[<?php print $current->SpecialRatesID; ?>][Cost55FirstFour]' id='Cost55FirstFour' value='<?php print $current->Cost55FirstFour; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Cost55OT</label><input type='text' dbtype='float' name='SpecialRates[<?php print $current->SpecialRatesID; ?>][Cost55OT]' id='Cost55OT' value='<?php print $current->Cost55OT; ?>' size='25' class='boxValue' /></div>
<?php print $current->Notes; ?>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='SpecialRates[<?php print $current->SpecialRatesID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>