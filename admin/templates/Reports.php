<br/><div id="formContent">
<div class='contentField'><span class='fieldLabel'>Report Title:</span><input type='text' name='Report[<? print $current->ReportID; ?>][Report]' id='Report' value='<?php print $current->Report; ?>' size='35' class='inputBox' /> <!-- </div> -->
<!-- <div class='contentField'>--> <span style='margin-left:3em;padding-right:.5em;'>Template:</span><input type='text' name='Report[<? print $current->ReportID; ?>][Template]' id='Template' value='<?php print $current->Template; ?>' size='35' class='inputBox' /></div>
<div class='contentField'><span class='fieldLabel'>Query:</span><textarea rows='4' cols='82' name='Report[<? print $current->ReportID; ?>][Query]' id='Query' class='inputBox'><?php print $current->Query; ?></textarea></div>
</div>
<div id='viewChartWrap' style='top:22%;'><span id='viewChartIcon'>Ý</span><a href='report.php?ReportID=<?php print $current->ReportID; ?>' class='viewChart' target='_blank'>View report in new window</a></div>
<div id='reportWrap' style='position:absolute;top:27%;bottom:4px;left:0px;right:4px;border:1px inset #a0a0a0;'>
<iframe id='reportFrame' name='reportFrame' width='100%' height='100%' src='report.php?ReportID=<?php print $current->ReportID; ?>'> </iframe>
</div>
