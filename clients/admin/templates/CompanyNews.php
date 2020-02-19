<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> CompanyNews ID: <?php print $current->CompanyNewsID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Company News</label><input type='text' dbtype='varchar(100)' name='CompanyNews[<?php print $current->CompanyNewsID; ?>][CompanyNews]' id='CompanyNews' value='' size='50' class='boxValue' /></div>

      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Publish Date</label><input type='text' dbtype='datetime' name='CompanyNews[<?php print $current->CompanyNewsID; ?>][PublishDate]' id='PublishDate' value='' size='25' class='boxValue date' /></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='CompanyNews[<?php print $current->CompanyNewsID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>