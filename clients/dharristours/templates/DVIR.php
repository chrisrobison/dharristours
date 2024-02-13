<div class='tableGroup'>
   <div class='formHeading'>DVIR ID: <?php print $current->DVIRID; ?></div>
   <div class='fieldcontainer' style='display:flex;'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>DVIR</label><input type='text' dbtype='varchar(200)' name='DVIR[<?php print $current->DVIRID; ?>][DVIR]' id='DVIR' value='<?php print $current->DVIR; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Date</label><input type='text' dbtype='datetime' name='DVIR[<?php print $current->DVIRID; ?>][Date]' id='Date' value='<?php print $current->Date; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Vehicle</label><input type='text' dbtype='varchar(200)' name='DVIR[<?php print $current->DVIRID; ?>][Vehicle]' id='Vehicle' value='<?php print $current->Vehicle; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Odometer</label><input type='text' dbtype='varchar(100)' name='DVIR[<?php print $current->DVIRID; ?>][Odometer]' id='Odometer' value='<?php print $current->Odometer; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Fuel</label><input type='text' dbtype='int(3)' name='DVIR[<?php print $current->DVIRID; ?>][Fuel]' id='Fuel' value='<?php print $current->Fuel; ?>' size='3' class='boxValue' /></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Bus </label><?php $boss->db->addResource("Bus");$arr = $boss->db->Bus->getlist();print $boss->utility->buildSelect($arr, $current->BusID, "BusID", "Bus", "DVIR[$current->DVIRID][BusID]")."</div>";?>
         <div class='contentField'><label>Bus Num</label><input type='text' dbtype='varchar(100)' name='DVIR[<?php print $current->DVIRID; ?>][BusNum]' id='BusNum' value='<?php print $current->BusNum; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Driver</label><input type='text' dbtype='varchar(100)' name='DVIR[<?php print $current->DVIRID; ?>][Driver]' id='Driver' value='<?php print $current->Driver; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Employee </label><?php $boss->db->addResource("Employee");$arr = $boss->db->Employee->getlist();print $boss->utility->buildSelect($arr, $current->EmployeeID, "EmployeeID", "Employee", "DVIR[$current->DVIRID][EmployeeID]")."</div>";?>
         <div class='contentField'><label>Address</label><input type='text' dbtype='varchar(200)' name='DVIR[<?php print $current->DVIRID; ?>][Address]' id='Address' value='<?php print $current->Address; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Report Date</label><input type='text' dbtype='datetime' name='DVIR[<?php print $current->DVIRID; ?>][ReportDate]' id='ReportDate' value='<?php print $current->ReportDate; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Report Time</label><input type='text' dbtype='time' name='DVIR[<?php print $current->DVIRID; ?>][ReportTime]' id='ReportTime' value='<?php print $current->ReportTime; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><label>Signature Date</label><input type='text' dbtype='date' name='DVIR[<?php print $current->DVIRID; ?>][SignatureDate]' id='SignatureDate' value='<?php print $current->SignatureDate; ?>' size='25' class='boxValue date' /></div>
         <div class='contentField'><label>Signature</label><input type='text' dbtype='varchar(200)' name='DVIR[<?php print $current->DVIRID; ?>][Signature]' id='Signature' value='<?php print $current->Signature; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Carrier</label><input type='text' dbtype='varchar(200)' name='DVIR[<?php print $current->DVIRID; ?>][Carrier]' id='Carrier' value='<?php print $current->Carrier; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Report File</label><input type='text' dbtype='varchar(200)' name='DVIR[<?php print $current->DVIRID; ?>][ReportFileURL]' id='ReportFileURL' value='<?php print $current->ReportFile; ?>' size='50' class='boxValue' /></div>
        </div>
        <div class='fieldcolumn'>
            <div style="height:30rem; width:25rem;"><img id="ReportFile" style="width:25rem;margin-left:1rem;border:1rem solid #fff;" src="<?php print $current->ReportFile; ?>"></div>
        </div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='mediumtext' name='DVIR[<?php print $current->DVIRID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
