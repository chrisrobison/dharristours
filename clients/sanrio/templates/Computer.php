<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> Computer ID: <?php print $current->ComputerID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Computer</label><input type='text' dbtype='varchar(100)' name='Computer[<?php print $current->ComputerID; ?>][Computer]' id='Computer' value='' size='50' class='boxValue' /></div>

         <div class='contentField'><label>IPAddress</label><input type='text' dbtype='varchar(100)' name='Computer[<?php print $current->ComputerID; ?>][IPAddress]' id='IPAddress' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Model</label><input type='text' dbtype='varchar(100)' name='Computer[<?php print $current->ComputerID; ?>][Model]' id='Model' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Type</label><input type='text' dbtype='varchar(100)' name='Computer[<?php print $current->ComputerID; ?>][Type]' id='Type' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Service Tag</label><input type='text' dbtype='varchar(100)' name='Computer[<?php print $current->ComputerID; ?>][ServiceTag]' id='ServiceTag' value='' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>PODate</label><input type='text' dbtype='datetime' name='Computer[<?php print $current->ComputerID; ?>][PODate]' id='PODate' value='' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Cost</label><input type='text' dbtype='decimal(10,2)' name='Computer[<?php print $current->ComputerID; ?>][Cost]' id='Cost' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>MACAddress</label><input type='text' dbtype='varchar(100)' name='Computer[<?php print $current->ComputerID; ?>][MACAddress]' id='MACAddress' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>User</label><input type='text' dbtype='varchar(100)' name='Computer[<?php print $current->ComputerID; ?>][User]' id='User' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(100)' name='Computer[<?php print $current->ComputerID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Computer[<?php print $current->ComputerID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>