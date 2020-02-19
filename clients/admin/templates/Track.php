<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> Track ID: <?php print $current->TrackID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Process ID</label><?php $boss->db->addResource("Process");$arr = $boss->db->Process->getlist();print $boss->utility->buildSelect($arr, $current->ProcessID, "ProcessID", "Process", "Track[$current->TrackID][ProcessID]")."</div>";?>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(75)' name='Track[<?php print $current->TrackID; ?>][Email]' id='Email' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Resource</label><input type='text' dbtype='varchar(75)' name='Track[<?php print $current->TrackID; ?>][Resource]' id='Resource' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Resource ID</label><?php $boss->db->addResource("Resource");$arr = $boss->db->Resource->getlist();print $boss->utility->buildSelect($arr, $current->ResourceID, "ResourceID", "Resource", "Track[$current->TrackID][ResourceID]")."</div>";?>
         <div class='contentField'><label>Track</label><input type='text' dbtype='varchar(100)' name='Track[<?php print $current->TrackID; ?>][Track]' id='Track' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Quantity</label><input type='text' dbtype='int(15)' name='Track[<?php print $current->TrackID; ?>][Quantity]' id='Quantity' value='' size='15' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Unit</label><input type='text' dbtype='varchar(50)' name='Track[<?php print $current->TrackID; ?>][Unit]' id='Unit' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Type</label><input type='text' dbtype='varchar(50)' name='Track[<?php print $current->TrackID; ?>][Type]' id='Type' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Form Time</label><input type='text' dbtype='int(32)' name='Track[<?php print $current->TrackID; ?>][FormTime]' id='FormTime' value='' size='32' class='boxValue' /></div>

</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Track[<?php print $current->TrackID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>