<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> Pricing ID: <?php print $current->PricingID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Pricing</label><input type='text' dbtype='varchar(100)' name='Pricing[<?php print $current->PricingID; ?>][Pricing]' id='Pricing' value='' size='50' class='boxValue' /></div>

         <div class='contentField'><label>Features</label><input type='text' dbtype='varchar(100)' name='Pricing[<?php print $current->PricingID; ?>][Features]' id='Features' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Most Popular</label><select dbtype='tinyint(1)' name='Pricing[<?php print $current->PricingID; ?>][MostPopular]' id='MostPopular'><option value='0'>False</option><option value='1'>True</option></select></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Level</label><input type='text' dbtype='int(15)' name='Pricing[<?php print $current->PricingID; ?>][Level]' id='Level' value='' size='15' class='boxValue' /></div>
         <div class='contentField'><label>Price</label><input type='text' dbtype='decimal(10,2)' name='Pricing[<?php print $current->PricingID; ?>][Price]' id='Price' value='' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Pricing[<?php print $current->PricingID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>