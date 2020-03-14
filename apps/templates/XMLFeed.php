<div class='tableGroup'>
   <div class='boxHeading'> OrgChartPoint ID: <?php print $current->OrgChartPointID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Query Str</span><textarea name='OrgChartPoint[<?php print $current->OrgChartPointID; ?>][QueryStr]' id='QueryStr' class='textBox' style='width:41em;height:5em;'><?php print $current->QueryStr; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Caption</span><input type='text' name='OrgChartPoint[<?php print $current->OrgChartPointID; ?>][Caption]' id='Caption' value='<?php print $current->Caption; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Description</span><textarea name='OrgChartPoint[<?php print $current->OrgChartPointID; ?>][Description]' id='Description' class='textBox' style='width:41em;height:5em;'><?php print $current->Description; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Coord X</span><input type='text' name='OrgChartPoint[<?php print $current->OrgChartPointID; ?>][CoordX]' id='CoordX' value='<?php print $current->CoordX; ?>' size='11' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Coord Y</span><input type='text' name='OrgChartPoint[<?php print $current->OrgChartPointID; ?>][CoordY]' id='CoordY' value='<?php print $current->CoordY; ?>' size='11' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Icon Type</span><input type='text' name='OrgChartPoint[<?php print $current->OrgChartPointID; ?>][IconType]' id='IconType' value='<?php print $current->IconType; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Species</span><input type='text' name='OrgChartPoint[<?php print $current->OrgChartPointID; ?>][Species]' id='Species' value='<?php print $current->Species; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Url</span><input type='text' name='OrgChartPoint[<?php print $current->OrgChartPointID; ?>][Url]' id='Url' value='<?php print $current->Url; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Query Total Str</span><textarea name='OrgChartPoint[<?php print $current->OrgChartPointID; ?>][QueryTotalStr]' id='QueryTotalStr' class='textBox' style='width:41em;height:5em;'><?php print $current->QueryTotalStr; ?></textarea></div>
         <div class='contentField'><span class='fieldLabel'>Section ID</span><input type='text' name='OrgChartPoint[<?php print $current->OrgChartPointID; ?>][SectionID]' id='SectionID' value='<?php print $current->SectionID; ?>' size='11' class='boxValue' /></div>
      </span>
   </div>
</div>