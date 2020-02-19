<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> Cellular ID: <?php print $current->CellularID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Cellular</label><input type='text' dbtype='varchar(100)' name='Cellular[<?php print $current->CellularID; ?>][Cellular]' id='Cellular' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Model Type</label><input type='text' dbtype='varchar(100)' name='Cellular[<?php print $current->CellularID; ?>][ModelType]' id='ModelType' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Mobile OS</label><input type='text' dbtype='varchar(100)' name='Cellular[<?php print $current->CellularID; ?>][MobileOS]' id='MobileOS' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>IMEISN</label><input type='text' dbtype='varchar(100)' name='Cellular[<?php print $current->CellularID; ?>][IMEISN]' id='IMEISN' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Data Plan</label><select dbtype='tinyint(1)' name='Cellular[<?php print $current->CellularID; ?>][DataPlan]' id='DataPlan'><option value='0'>False</option><option value='1'>True</option></select></div>
         <div class='contentField'><label>Intl Roaming</label><select dbtype='tinyint(1)' name='Cellular[<?php print $current->CellularID; ?>][IntlRoaming]' id='IntlRoaming'><option value='0'>False</option><option value='1'>True</option></select></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Intl Data Plan</label><select dbtype='tinyint(1)' name='Cellular[<?php print $current->CellularID; ?>][IntlDataPlan]' id='IntlDataPlan'><option value='0'>False</option><option value='1'>True</option></select></div>
         <div class='contentField'><label>Account Num</label><input type='text' dbtype='varchar(100)' name='Cellular[<?php print $current->CellularID; ?>][AccountNum]' id='AccountNum' value='' size='50' class='boxValue' /></div>

         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(100)' name='Cellular[<?php print $current->CellularID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Cellular[<?php print $current->CellularID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>