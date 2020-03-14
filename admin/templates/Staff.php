<div class='tableGroup'>
   <div class='boxHeading'> Staff ID: <?php print $current->StaffID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Name</span><input type='text' name='Staff[<?php print $current->StaffID; ?>][Name]' id='Name' value='<?php print $current->Name; ?>' size='21' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Ext</span><input type='text' name='Staff[<?php print $current->StaffID; ?>][Ext]' id='Ext' value='<?php print $current->Ext; ?>' size='3' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Cell</span><input type='text' name='Staff[<?php print $current->StaffID; ?>][Cell]' id='Cell' value='<?php print $current->Cell; ?>' size='15' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Home</span><input type='text' name='Staff[<?php print $current->StaffID; ?>][Home]' id='Home' value='<?php print $current->Home; ?>' size='16' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Office</span><input type='text' name='Staff[<?php print $current->StaffID; ?>][Office]' id='Office' value='<?php print $current->Office; ?>' size='16' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Email</span><input type='text' name='Staff[<?php print $current->StaffID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='30' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Position</span><input type='text' name='Staff[<?php print $current->StaffID; ?>][Position]' id='Position' value='<?php print $current->Position; ?>' size='35' class='boxValue' /></div>
      </span>
   </div>
</div>