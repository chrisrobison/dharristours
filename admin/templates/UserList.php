<?php
   $fields = array(
               array('field'=>'Company', 'label'=>'Company','dataType'=>'string'), 
               array('field'=>'User', 'label'=>'Username', 'dataType'=>'string'),
               array('field'=>'LastName', 'label'=>'Last Name', 'dataType'=>'string'),
               array('field'=>'FirstName', 'label'=>'First Name', 'dataType'=>'string'),
               array('field'=>'Email', 'label'=>'Email', 'dataType'=>'string')
            );
   
   $boss->db->addResource('User');
   $boss->db->User->getlist();
   $list = $boss->db->User->User;
?>
<script type='text/javascript'>
tableFields = <?php print json_encode($fields); ?>;
tableObject = <?php print json_encode($list); ?>;

function loadUser(lid) {
   if (!lid) { lid = userTable.getSelectedData(); }
   
   var docPane = dojo.widget.getWidgetById("DetailPane");
   if (docPane) {
      docPane.setUrl('/admin/app.php?t=UserDetail&rsc=User&UserID=' + lid.UserID);
   }
}
userTable = null;
function initUser() {
   var params = {
                  valueField: "UserID",
                  headClass: "fixedHeader",
                  tbodyClass: "scrollContent",
                  enableAlternateRows: "true",
                  rowAlternateClass: "alternateRow"
                 };

   userTable = dojo.widget.createWidget("dojo:FilteringTable", params, dojo.byId("UserTable"));

   for (var x=0; x<tableFields.length; x++) {
      userTable.columns.push(userTable.createMetaData(tableFields[x]));
   }

   userTable.store.setData(tableObject);
   dojo.event.connect(dojo.byId('UserTable'), 'onclick', function(e) { loadUser(); });
}
dojo.addOnLoad(initUser);
</script>
<table id="UserTable" class='listTable' cellpadding="2" cellspacing="0" border="0"> </table> 
