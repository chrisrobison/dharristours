<div class='tableGroup'>
   <div class='formHeading'>Damage ID: <?php print $current->DamageID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Bus </label><?php $boss->db->addResource("Bus");$arr = $boss->db->Bus->getlist();print $boss->utility->buildSelect($arr, $current->BusID, "BusID", "Bus", "Damage[$current->DamageID][BusID]")."</div>";?>
         <div class='contentField'><label>Damage</label><input type='text' dbtype='varchar(200)' name='Damage[<?php print $current->DamageID; ?>][Damage]' id='Damage' value='<?php print $current->Damage; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Reported By</label><input type='text' dbtype='varchar(200)' name='Damage[<?php print $current->DamageID; ?>][ReportedBy]' id='ReportedBy' value='<?php print $current->ReportedBy; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Damage Location</label><label style='width:1em;'>x</label><input type='text' dbtype='int(10)' name='Damage[<?php print $current->DamageID; ?>][x]' id='x' value='<?php print $current->x; ?>' size='3' class='boxValue' style='width:4em;' />
         <label style='width:1em'>y</label><input type='text' dbtype='int(10)' name='Damage[<?php print $current->DamageID; ?>][y]' id='y' value='<?php print $current->y; ?>' size='3' class='boxValue'  style='width:4em;'/></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Severity</label><input type='range' min='1' max='5' step='1' dbtype='int(2)' name='Damage[<?php print $current->DamageID; ?>][Severity]' id='Severity' value='<?php print $current->Severity; ?>' class='boxValue' style='width:15em;' list='tickmarks' />
         <datalist id='tickmarks'>
            <option value='1'></option>
            <option value='2'></option>
            <option value='3'></option>
            <option value='4'></option>
            <option value='5'></option>
         </datalist></div>
         <div class='contentField'><label>Status</label><select id='Status' name='Damage[<?php print $current->DamageID; ?>][Status]' class='genSelect'>
            <option value='new'<?php if ($current->Status == "new") { print " SELECTED"; } ?>>New</option>
            <option value='acknowleged'<?php if ($current->Status == "acknowleged") { print " SELECTED"; } ?>>Acknowleged</option>
            <option value='rejected'<?php if ($current->Status == "rejected") { print " SELECTED"; } ?>>Rejected</option>
            <option value='blocked'<?php if ($current->Status == "blocked") { print " SELECTED"; } ?>>Blocked</option>
            <option value='in process'<?php if ($current->Status == "in process") { print " SELECTED"; } ?>>In Process</option>
            <option value='in review'<?php if ($current->Status == "in review") { print " SELECTED"; } ?>>In Review</option>
            <option value='complete'<?php if ($current->Status == "complete") { print " SELECTED"; } ?>>Complete</option>
         </select>
         <!--input type='text' dbtype='enum('new','acknowleged','rejected','blocked','in process','in review','complete')' name='Damage[<?php print $current->DamageID; ?>][Status]' id='Status' value='<?php print $current->Status; ?>' size='25' class='boxValue' /-->
         </div>
      <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Damage[<?php print $current->DamageID; ?>][Notes]' id='Notes' style='width:24em;' class='textBox'></textarea></div></div>
      </div>
      </div>
   <div class='fieldcolumn'>
      <canvas style="width:4in;" id='bus'></canvas>
   </div>
   </div>
</div>
<script>
   const canvas = document.getElementById('bus');
   const note = document.getElementById('Notes');
   const ctx = canvas.getContext('2d');
   const img = new Image();
   
   img.onload = drawBus;
   img.src = '/tools/dvir/businspection.jpg';
   var nx, ny;
   var damage = {}, damages = [];
   window.damages = damages;
   
   function getDamages(busID) {
      fetch("/tools/dvir/api.php?type=damages&BusID=" + busID).then((response) => {
         return response.json();
      }).then((data) => {
         window.damages = damages = data;
         loadDamages(damages);
      });
   }
   
   function drawDamage(rec) {
      if (rec) {
         ctx.lineWidth = 30;
         ctx.strokeStyle = "#ffff00";
         ctx.beginPath();
         ctx.ellipse(rec.x, rec.y, 150, 150, 0, 0, 2 * Math.PI);
         ctx.stroke();
      }
   }

   function loadDamages(damages) {
      var damageForm = document.querySelector("#damage");
      for (var i=0; i<damages.length; i++) {
         ctx.lineWidth = 30;
         ctx.strokeStyle = "#ff0000";
         ctx.beginPath();
         ctx.ellipse(damages[i].x, damages[i].y, 150, 150, 0, 0, 2 * Math.PI);
         ctx.stroke();
         note.value = note.value + "\n[" + damages[i].x + ":" + damages[i].y + "] " + damages[i].Damage;
         if ((simpleConfig.current.x == damages[i].x) && (simpleConfig.current.y == damages[i].y)) {
            drawDamage(simpleConfig.current);
         }
      }
   }
   
   function drawBus() {
      canvas.width = this.naturalWidth;
      canvas.height = this.naturalHeight;

      ctx.clearRect(0, 0, canvas.width, canvas.height);
      ctx.drawImage(this, 0, 0);
   }
   function clearDamages() {
      drawBus.call(img);
   }

   document.querySelector("#BusID").addEventListener("change", function (e) {
      clearDamages();
      getDamages(this.options[this.selectedIndex].value);
      var busname = this.options[this.selectedIndex].text.replace(/\#/,'');
   });


</script>
