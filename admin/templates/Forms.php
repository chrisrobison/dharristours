<div id='appToolbar'>
   <div id='newcontactButton' class='toolbarButton' title='Create new contact entry' onclick="add('Form')"> </div>
   <div id='saveButton' class='toolbarButton' title='Save changes to current entry' onclick="sendForm('form1')"> </div>
   <div id='deleteButton' class='toolbarButton' title='Create new contact entry' onclick="remove('Form')"> </div>
   <!-- <input type='button' value='Save' onclick="saveForm()" /> -->
</div>
	<div class='splitContainer' dojoType="SplitContainer" orientation="horizontal" sizerWidth="5" activeSizing="1" style='width:99%;height:90%;border:1px solid #c0c0c0;'>
      <div dojoType="ContentPane" layoutAlign='left' id='FormList' sizeMin='20' sizeShare='40' executeScripts='true' cacheContent='false' href='app.php?t=FormList' style='border-right:1px solid #888;overflow-x:auto;overflow-y:auto;'> </div>
      <div dojoType="ContentPane" layoutAlign='right' id='FormDetail' sizeMin="20" sizeShare="60" executeScripts='true' cacheContent='false' href='app.php?t=FormDetail' style='border-left:1px solid #444;overflow-x:auto;overflow-y:auto;'> </div>
   </div>
