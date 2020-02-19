<?php
   $fields = array(
               array('field'=>'FormID', 'label'=>'Order ID','dataType'=>'integer'), 
               array('field'=>'LastName1', 'label'=>'Last Name', 'dataType'=>'string'),
               array('field'=>'FirstName1', 'label'=>'First Name', 'dataType'=>'string'),
               array('field'=>'Lender', 'label'=>'Lender', 'dataType'=>'string'),
               array('field'=>'LastModified', 'label'=>'Updated', 'dataType'=>'date',  'format'=>'%b %d, %Y')
               // array('field'=>'LastFormed', 'label'=>'Formed', 'dataType'=>'date',  'format'=>'%b %d, %Y')
            );
   
   $boss->db->addResource('Form');
   $boss->db->Form->getlist();
   $list = $boss->db->Form->Form;
?>
<script type='text/javascript'>
tableFields = <?php print json_encode($fields); ?>;
tableObject = <?php print json_encode($list); ?>;

function loadForm(lid) {
   if (!lid) { lid = filteringTable.getSelectedData(); }
   
   var docPane = dojo.widget.getWidgetById("FormDetail");
   if (docPane) {
      docPane.setUrl('/app.php?t=FormDetail&rsc=Form&FormID=' + lid.FormID);
   }
}
filteringTable = null;
function initForm() {
   var params = {
                  valueField: "FormID",
                  headClass: "fixedHeader",
                  tbodyClass: "scrollContent",
                  alternateRows: "true",
                  rowAlternateClass: "alternateRow"
                 };

   filteringTable = dojo.widget.createWidget("dojo:FilteringTable", params, dojo.byId("FormTable"));

   for (var x=0; x<tableFields.length; x++) {
      filteringTable.columns.push(filteringTable.createMetaData(tableFields[x]));
   }

   filteringTable.store.setData(tableObject);
   dojo.event.connect(dojo.byId('FormTable'), 'onclick', function(e) { loadForm(); });
}
dojo.addOnLoad(initForm);
</script>
<table id="FormTable" class='listTable' cellpadding="2" cellspacing="0" border="0"> </table> 
