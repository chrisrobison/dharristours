<div class='tableGroup'>
   <div class='formHeading'>History ID: <?php print $current->HistoryID; ?></div>
   <div class='fieldcontainer'>
         <div class='contentField' style="display: flex;"><label>User </label><?php $boss->db->addResource("Login");$arr = $boss->db->Login->getlist();print $boss->utility->buildSelect($arr, $current->LoginID, "LoginID", "Login", "History[$current->HistoryID][LoginID]")."</div>";?></div>
      <div class='fieldcolumn fieldfloater' style="display:flex;flex-direction:column;justify-content:center;align-items:center;">
         <div class='contentField' style="display:flex;">
            <label>Undo</label>
            <div style="width:30rem;white-space:normal;font-family:monospace;height:10rem;overflow-y:scroll;" data-name='History[<?php print $current->HistoryID; ?>][Undo]' id='Undo' class='textBox'><?php print $current->Undo; ?></div>
         </div>
         <button style="font-size: 22px;width:20rem;background:#c00;color:#fff;border-radius:1rem;" onclick="doUndo(event);return false;">Undo Update</button>
      </div>
      <div class='fieldcolumn' style="display: flex;flex-direction:column;justify-content:center;align-items:center;">
         <div class='contentField' style="display:flex;">
            <label>Redo</label>
            <div style="width:30rem;white-space:normal;font-family:monospace;height:10rem;overflow-y:scroll;" data-name='History[<?php print $current->HistoryID; ?>][Redo]' id='Redo' class='textBox'><?php print $current->Redo; ?></div>
         </div>
         <button style="font-size: 22px;width:20rem;background:#c00;color:#fff;border-radius:1rem;" onclick="doRedo(event);return false;">Redo Update</button>
      </div>
         <div style="display: none;" class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='History[<?php print $current->HistoryID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div>
   </div>
<script>
function doUndo(evt) {
    let id = simpleConfig.id;
   if (confirm("Are you sure you want to UNDO this update?\nOK to Continue\nCancel to Return")) {
        fetch(`/portal/api.php?type=undo&id=${id}`).then(r=>r.json()).then(data=>{
            console.log(`UNDO Complete`);
            console.dir(data);
            if (data.status == "ok") {
                alert(`Successfully applied UNDO. [${id}]`);
            } else {
                alert(`Error applying UNDO: ${data.error}`);
            }
        });
   }
}

function doRedo(evt) {
    let id = simpleConfig.id;
    
   if (id && confirm(`Are you sure you want to REDO this update [${id}]?\nOK to Continue\nCancel to Return`)) {
        fetch(`/portal/api.php?type=redo&id=${id}`).then(r=>r.json()).then(data=>{
            if (data.status == "ok") {
                alert(`Successfully applied REDO. [${id}]`);
            } else {
                alert(`Error applying REDO: ${data.error}`);
            }
        });
   }
}

</script>
