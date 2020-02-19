<div id='viewChartWrap' style='top:30%;'>
      <span id='viewChartIcon'><img src='/img/external.gif'></span>
         <a id='reportLink' href='/apps/report.php?ReportID=<?php print $current->ReportID; ?>' class='viewChart' target='_blank'>View report in new window</a>
</div>
<div id="formContent">
   <div class='contentField'>
      <span class='fieldLabel'>Report Title:</span>
      <input type='text' name='Report[<? print $current->ReportID; ?>][Report]' id='Report' value='<?php print $current->Report; ?>' size='35' class='inputBox'/>
   </div> 
   <div class='contentField'>
      <span class='fieldLabel'>Template:</span>
      <input type='text' name='Report[<? print $current->ReportID; ?>][Template]' id='Template' value='<?php print $current->Template; ?>' size='35' class='inputBox' />
   </div>
   <div class='contentField'>
      <span class='fieldLabel'>Query:</span>
      <textarea rows='4' cols='82' name='Report[<? print $current->ReportID; ?>][Query]' id='Query' class='inputBox'><?php print $current->Query; ?></textarea>
   </div>
</div>
