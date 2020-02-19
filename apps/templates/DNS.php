<?php
   $sys = new boss();
   $sys->db->dbobj->execute("use SS_System");
   $sys->db->dbobj->db = "SS_System";

   $cond = "App like '%._%' AND Email=".$boss->q($_SESSION['Email']);
   $apps = $sys->getObject("App", $cond);

$boss = new boss();
   $cnt = count($apps->App['_ids']);
   for ($i=0; $i < $cnt; $i++) {
      if ($boss->db->dbobj->db!='SS_Api') {
         // $boss->db->dbobj->execute("delete from DNS where Zone='{$apps->App[$i]->App}'");   
         $sql = "insert into {$boss->app->DB}.DNS select * from SS_Api.DNS where SS_Api.DNS.Zone='{$apps->App[$i]->App}'";
         //print $sql."\n";
         $boss->db->dbobj->execute($sql);
      }
   }

?>
<div class='tableGroup'>
   <div class='formHeading'>DNS Record ID: <?php print $current->DNSID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Domain</label><span id='Zone'></span></div>
         <div class='contentField'><label>Hostname</label><input type='text' dbtype='varchar(100)' name='DNS[<?php print $current->DNSID; ?>][Name]' id='Name' value='<?php print $current->Name; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Data</label><input type='text' dbtype='varchar(100)' name='DNS[<?php print $current->DNSID; ?>][Data]' id='Data' value='<?php print $current->Data; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Type</label>
            <select dbtype='varchar(50)' name='DNS[<?php print $current->DNSID; ?>][Type]' id='Type'>
               <option value='A'>A - Address Record</option>   
               <option value='CNAME'>CNAME - Canonical Name Record</option>   
               <option value='MX'>MX - Mail Exchange Record</option>   
               <option value='NS'>NS - Name Server Record</option>   
               <option value='TXT'>TXT - Text Record</option>   
               <option value='SOA'>SOA - Start of Authority Record</option>   
               <option value='AAAA'>AAAA - IPv6 Address Record</option>   
               <option value='SPF'>SPF - Sender Policy Framework Record</option>   
               <option value='SRV'>SRV - Service Locator Record</option>   
               <option value='LOC'>LOC - Location Record</option>   
            </select>
         </div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField' style='height:24px'></div>
         <div class='contentField'><label>TTL</label><input type='text' dbtype='int(11)' name='DNS[<?php print $current->DNSID; ?>][TTL]' id='TTL' value='<?php print $current->TTL; ?>' size='11' class='boxValue' style='width:4em'></div>
         <div class='contentField'><label>MXPriority</label><input type='text' dbtype='int(5)' name='DNS[<?php print $current->DNSID; ?>][MXPriority]' id='MXPriority' value='<?php print $current->MXPriority; ?>' size='5' class='boxValue' style='width:2em;'></div>
         <!-- <div class='contentField'><label>Owner</label><span id='Owner'></span></div>-->
      </div>
   </div>
</div>
<script>
   $(function() {
      $("#Type").change(function() {
         if ($(this).val() == "MX") {
            $("#MXPriority").parent().show();
         } else {
            $("#MXPriority").parent().hide();
         }
      });
   });
</script>
