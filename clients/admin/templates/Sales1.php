<div class='tableGroup'>
   <h1 class='boxHeading'> Sales ID: <?php print $current->SalesID; ?></h1>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Sales</label><input type='text' dbtype='varchar(100)' name='Sales[<?php print $current->SalesID; ?>][Sales]' id='Sales' value='<?php print $current->Sales; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Notes</label><textarea dbtype='text' name='Sales[<?php print $current->SalesID; ?>][Notes]' id='Notes' class='textBox'><?php print $current->Notes; ?></textarea></div>
         <div class='contentField'><label>Sales Date</label><input type='text' dbtype='date' name='Sales[<?php print $current->SalesID; ?>][SalesDate]' id='SalesDate' value='<?php print $current->SalesDate; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Business ID</label><?php $boss->db->addResource("Business");$arr = $boss->db->Business->getlist();print $boss->utility->buildSelect($arr, $current->BusinessID, "BusinessID", "Business", "Sales[$current->SalesID][BusinessID]");?></div>
         <div class='contentField'><label>Region</label><input type='text' dbtype='varchar(250)' name='Sales[<?php print $current->SalesID; ?>][Region]' id='Region' value='<?php print $current->Region; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Follow Up Date Time</label><input type='text' dbtype='datetime' name='Sales[<?php print $current->SalesID; ?>][FollowUpDateTime]' id='FollowUpDateTime' value='<?php print $current->FollowUpDateTime; ?>' size='25' class='boxValue' /></div>
      </div>
   </div>
</div>