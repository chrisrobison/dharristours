<div class='tableGroup'>
   <div class='formHeading'>StaticList ID: <?php print $current->StaticListID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Static List</label><input type='text' dbtype='varchar(100)' name='StaticList[<?php print $current->StaticListID; ?>][StaticList]' id='StaticList' value='<?php print $current->StaticList; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Caption</label><input type='text' dbtype='varchar(100)' name='StaticList[<?php print $current->StaticListID; ?>][Caption]' id='Caption' value='<?php print $current->Caption; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Value</label><input type='text' dbtype='varchar(100)' name='StaticList[<?php print $current->StaticListID; ?>][Value]' id='Value' value='<?php print $current->Value; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Sequence</label><input type='text' dbtype='int(11)' name='StaticList[<?php print $current->StaticListID; ?>][Sequence]' id='Sequence' value='<?php print $current->Sequence; ?>' size='11' class='boxValue' /></div>
         <div class='contentField'><label>List Desc</label><input type='text' dbtype='varchar(100)' name='StaticList[<?php print $current->StaticListID; ?>][ListDesc]' id='ListDesc' value='<?php print $current->ListDesc; ?>' size='50' class='boxValue' /></div>
</div>
</div>
</div>