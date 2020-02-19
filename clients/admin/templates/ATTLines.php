<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> ATTLines ID: <?php print $current->ATTLinesID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>ATTLines</label><input type='text' dbtype='varchar(50)' name='ATTLines[<?php print $current->ATTLinesID; ?>][ATTLines]' id='ATTLines' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Name</label><input type='text' dbtype='varchar(50)' name='ATTLines[<?php print $current->ATTLinesID; ?>][Name]' id='Name' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Phone Number</label><input type='text' dbtype='varchar(50)' name='ATTLines[<?php print $current->ATTLinesID; ?>][PhoneNumber]' id='PhoneNumber' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Model Type</label><input type='text' dbtype='char(50)' name='ATTLines[<?php print $current->ATTLinesID; ?>][ModelType]' id='ModelType' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Mobile OS</label><input type='text' dbtype='char(50)' name='ATTLines[<?php print $current->ATTLinesID; ?>][MobileOS]' id='MobileOS' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>IMEISN</label><input type='text' dbtype='char(50)' name='ATTLines[<?php print $current->ATTLinesID; ?>][IMEISN]' id='IMEISN' value='' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Data Plan</label><select dbtype='tinyint(1)' name='ATTLines[<?php print $current->ATTLinesID; ?>][DataPlan]' id='DataPlan'><option value='0'>False</option><option value='1'>True</option></select></div>
         <div class='contentField'><label>Intl Roamin</label><select dbtype='tinyint(1)' name='ATTLines[<?php print $current->ATTLinesID; ?>][IntlRoamin]' id='IntlRoamin'><option value='0'>False</option><option value='1'>True</option></select></div>
         <div class='contentField'><label>Intl Data Plan</label><select dbtype='tinyint(1)' name='ATTLines[<?php print $current->ATTLinesID; ?>][IntlDataPlan]' id='IntlDataPlan'><option value='0'>False</option><option value='1'>True</option></select></div>
         <div class='contentField'><label>Account Num</label><input type='text' dbtype='int(9)' name='ATTLines[<?php print $current->ATTLinesID; ?>][AccountNum]' id='AccountNum' value='' size='9' class='boxValue' /></div>
<input type='text' dbtype='char(50)' name='ATTLines[<?php print $current->ATTLinesID; ?>][Notes]' id='Notes' value='' size='50' class='boxValue' /></div>
</div>
</div>
</div>