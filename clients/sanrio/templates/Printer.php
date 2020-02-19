<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> Printer ID: <?php print $current->PrinterID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Printer</label><input type='text' dbtype='varchar(100)' name='Printer[<?php print $current->PrinterID; ?>][Printer]' id='Printer' value='' size='50' class='boxValue' /></div>

         <div class='contentField'><label>IPAddress</label><input type='text' dbtype='varchar(100)' name='Printer[<?php print $current->PrinterID; ?>][IPAddress]' id='IPAddress' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Model</label><input type='text' dbtype='varchar(100)' name='Printer[<?php print $current->PrinterID; ?>][Model]' id='Model' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Type</label><input type='text' dbtype='varchar(100)' name='Printer[<?php print $current->PrinterID; ?>][Type]' id='Type' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Service Tag</label><input type='text' dbtype='varchar(100)' name='Printer[<?php print $current->PrinterID; ?>][ServiceTag]' id='ServiceTag' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>PODate</label><input type='text' dbtype='datetime' name='Printer[<?php print $current->PrinterID; ?>][PODate]' id='PODate' value='' size='25' class='boxValue date' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Cost</label><input type='text' dbtype='decimal(10,2)' name='Printer[<?php print $current->PrinterID; ?>][Cost]' id='Cost' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>MACAddress</label><input type='text' dbtype='varchar(100)' name='Printer[<?php print $current->PrinterID; ?>][MACAddress]' id='MACAddress' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>User</label><input type='text' dbtype='varchar(100)' name='Printer[<?php print $current->PrinterID; ?>][User]' id='User' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(100)' name='Printer[<?php print $current->PrinterID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Printer[<?php print $current->PrinterID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>