<input type='hidden' name='ChartID' value='<?php print $current->ChartID; ?>' />
<div id="formContent" style='margin-top: 1em;float:left;'>
   <div class='contentField'><span class='fieldLabel'>Chart: </span><input type='text' name='Chart[<?php print $current->ChartID; ?>][Chart]' id='Chart' value='<?php print $current->Chart; ?>' size='50' class='inputBox' /></div>
   <div class='contentField'><span class='fieldLabel'>Title: </span><input type='text' name='Chart[<?php print $current->ChartID; ?>][Title]' id='Title' value='<?php print $current->Title; ?>' size='50' class='inputBox' /></div>
   <div class='contentField'><span class='fieldLabel'>Query</span><textarea name='Chart[<?php print $current->ChartID; ?>][Query]' id='Query' class='inputBox' cols='56' rows='3'><?php print $current->Query; ?></textarea></div>
</div>
<div id='formContentRight' style='margin-top:1em;'>
   <div class='contentField'><span class='fieldLabel'>Dimensions: </span><input type='text' name='Chart[<?php print $current->ChartID; ?>][Width]' id='Width' value='<?php print $current->Width; ?>' size='3' class='inputBox' /> X <input type='text' name='Chart[<? print $current->ChartID; ?>][Height]' id='Height' value='<?php print $current->Height; ?>' size='3' class='inputBox' /></div>
   <div class='contentField'><span class='fieldLabel'>X Title: </span><input type='text' name='Chart[<?php print $current->ChartID; ?>][TitleX]' id='TitleX' value='<?php print $current->TitleX; ?>' size='15' class='inputBox' /></div>
   <div class='contentField'><span class='fieldLabel'>Y Title: </span><input type='text' name='Chart[<?php print $current->ChartID; ?>][TitleY]' id='TitleY' value='<?php print $current->TitleY; ?>' size='15' class='inputBox' /></div>
   <div class='contentField'><span class='fieldLabel'>Chart Type: </span><select name='Chart[<?php print $current->ChartID; ?>][Type]' id='ChartType'>
   <?php
      $types = array('bars'=>'bars',
                     'lines'=>'lines',
                     'linepoints'=>'lines with points',
                     'area'=>'area',
                     'pie'=>'pie',
                     'thinbarline'=>'thin bar line [impulse]',
                     'error bar'=>'error bar',
                     'squared'=>'squared');
      foreach ($types as $key=>$val) {
         $s = ($key==$current->Type) ? ' SELECTED' : '';
         print "<option value='$key'$s>$val</option>\n";
      }
   ?></select>
   </div>
</div>
<br/>
<div id='viewChartWrap'><span id='viewChartIcon'>Ý</span><a href='chart.php?ChartID=<?php print $current->ChartID; ?>' class='viewChart' target='_blank'>View chart in new window</a></div>
<div id='chartWrap' style='position:relative;top:2em;width:99.8%;height:70%;border-top:1px inset #a0a0a0;background-color:#f0f0f0;padding:0px;'>
   <iframe style='background-color:white;position:absolute;top:2px;left:0px;right:4px;bottom:0px;border-top:1px solid #606060;border-left:0px;' width='100%' height='100%' id='chartFrame' name='chartFrame' src='chart.php?ChartID=<?php print $current->ChartID; ?>'> </iframe>
</div>
