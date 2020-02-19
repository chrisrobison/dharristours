<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> Asset ID: <?php print $current->AssetID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Asset</label><input type='text' dbtype='varchar(100)' name='Asset[<?php print $current->AssetID; ?>][Asset]' id='Asset' value='' size='50' class='boxValue' /></div>

         <div class='contentField'><label>IPAddress</label><input type='text' dbtype='varchar(100)' name='Asset[<?php print $current->AssetID; ?>][IPAddress]' id='IPAddress' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Model</label><input type='text' dbtype='varchar(100)' name='Asset[<?php print $current->AssetID; ?>][Model]' id='Model' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Type</label><input type='text' dbtype='varchar(100)' name='Asset[<?php print $current->AssetID; ?>][Type]' id='Type' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Service Tag</label><input type='text' dbtype='varchar(100)' name='Asset[<?php print $current->AssetID; ?>][ServiceTag]' id='ServiceTag' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>PODate</label><input type='text' dbtype='datetime' name='Asset[<?php print $current->AssetID; ?>][PODate]' id='PODate' value='' size='25' class='boxValue date' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Cost</label><input type='text' dbtype='decimal(10,2)' name='Asset[<?php print $current->AssetID; ?>][Cost]' id='Cost' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>MACAddress</label><input type='text' dbtype='varchar(100)' name='Asset[<?php print $current->AssetID; ?>][MACAddress]' id='MACAddress' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>User</label><input type='text' dbtype='varchar(100)' name='Asset[<?php print $current->AssetID; ?>][User]' id='User' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(100)' name='Asset[<?php print $current->AssetID; ?>][Description]' id='Description' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Asset Type</label><input type='text' dbtype='varchar(100)' name='Asset[<?php print $current->AssetID; ?>][AssetType]' id='AssetType' value='' size='50' class='boxValue' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Asset[<?php print $current->AssetID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>