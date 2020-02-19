<div class='tableGroup'>
   <div class='formHeading'><h1 class='boxHeading'> UserList ID: <?php print $current->UserListID; ?></h1></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>User List</label><input type='text' dbtype='varchar(50)' name='UserList[<?php print $current->UserListID; ?>][UserList]' id='UserList' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Caption</label><input type='text' dbtype='varchar(100)' name='UserList[<?php print $current->UserListID; ?>][Caption]' id='Caption' value='' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Value</label><input type='text' dbtype='varchar(100)' name='UserList[<?php print $current->UserListID; ?>][Value]' id='Value' value='' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Sequence</label><input type='text' dbtype='int(11)' name='UserList[<?php print $current->UserListID; ?>][Sequence]' id='Sequence' value='' size='11' class='boxValue' /></div>
         <div class='contentField'><label>List Desc</label><input type='text' dbtype='varchar(100)' name='UserList[<?php print $current->UserListID; ?>][ListDesc]' id='ListDesc' value='' size='50' class='boxValue' /></div>
</div>
</div>
</div>