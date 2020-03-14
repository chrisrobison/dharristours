<?php if (!$boss) require_once($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php'); ?>
<div id='newimportDialog' title="Create Table from Import" style='display:none' class='dialog'>
   <form action='cmd.php' id='newimportform' name='newimportform' method='post' target='importFrame' enctype='multipart/form-data'>
      <input type='hidden' name='x' value='newimport'>
      <label for='newimport'>Table Name:</label><input type='text' name='newimport' id='newimport' size='30'><br><br>
      <label for='newimportFile'>Upload File to Import:</label> <input type='file' name='newimportFile' id='newimportFile'>
      <div id='importmakeToolWrap'><input type='checkbox' checked='checked' name='importMakeTool' id='importMakeTool'><label for='importModuleID'>Create Component in:</label>
      <select name='importModuleID' id='importModuleID'>
         <?php print $opts; ?>
      </select></div>
      <input type='hidden' name='importIcon' id='importIcon' value='' />
      Select Icon: <span id='importIconPreview' class='simpleIcon iconPreview'> </span><br>
      <div id="importIcons">
      <?php 
         $file = file($_SERVER['DOCUMENT_ROOT']."/lib/css/icons48.txt");
         
         $row = 0; $col = 0;
         foreach ($file as $icon) {
            $icon = rtrim($icon);
            if (preg_match("/\d*-(.+?)\.png/", $icon, $match)) {
               $ico = $match[1];
            } else {
               $ico = $icon;
            }
         
            print "<span class='simpleIcon icon-".$ico."' title='".$ico."'></span>";
            ++$col;
            if ($col==10) {
               ++$row; $col = 0;
            }
         }
      ?>
      </div>
   </form>
   <p class='help' style='display:none;'>To create a new table by importng data you may either <em><u>Upload a File</u></em> or <em><u>Copy &amp; Paste</u></em> your data as delimited text into the system using the form above.  The first line of your data <em><u>MUST</u></em> contain the delimited field names.  The remaining lines should contain your actual delimited data, one entry per line.  Valid characters to use as delimiters are '&lt;Tab&gt;' [tabs], '|' [pipes], or ',' [commas].  Each row or record should contain an entry for each field. </p>
</div>

