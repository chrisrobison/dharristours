<div class='tableGroup'>
   <div class='formHeading'>dns ID: <?php print $current->dnsID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Zone</label><input type='text' dbtype='varchar(100)' name='dns[<?php print $current->dnsID; ?>][Zone]' id='Zone' value='<?php print $current->Zone; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Name</label><input type='text' dbtype='varchar(100)' name='dns[<?php print $current->dnsID; ?>][Name]' id='Name' value='<?php print $current->Name; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>TTL</label><input type='text' dbtype='int(11)' name='dns[<?php print $current->dnsID; ?>][TTL]' id='TTL' value='<?php print $current->TTL; ?>' size='11' class='boxValue' /></div>
         <div class='contentField'><label>Type</label><input type='text' dbtype='varchar(50)' name='dns[<?php print $current->dnsID; ?>][Type]' id='Type' value='<?php print $current->Type; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Data</label><input type='text' dbtype='varchar(150)' name='dns[<?php print $current->dnsID; ?>][Data]' id='Data' value='<?php print $current->Data; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Owner</label><input type='text' dbtype='varchar(100)' name='dns[<?php print $current->dnsID; ?>][Owner]' id='Owner' value='<?php print $current->Owner; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>MXPriority</label><input type='text' dbtype='int(5)' name='dns[<?php print $current->dnsID; ?>][MXPriority]' id='MXPriority' value='<?php print $current->MXPriority; ?>' size='5' class='boxValue' /></div>
</div>
</div>
</div>