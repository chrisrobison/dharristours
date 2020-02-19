<?php if (!$boss) require_once($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php'); ?>
<div id='importDialog' class='dialog' title='Import Data' style='display:none'>
   <form action='ctl.php' id='import' name='import' method='post' target='importFrame' enctype='multipart/form-data'>
      <input type='hidden' id='x' name='x' value='import'/>
      <input type='hidden' id='rsc' name='rsc' value='<?php print $in['rsc']; ?>'/>
      <input type='hidden' id='pid' name='pid' value='<?php print $in['pid']; ?>'/>
      <h3>Send information to import</h3>
      <?php
         function genTableSelect($tbl="") {
            global $boss;
            $tbls = $boss->getTables();

            foreach ($tbls as $table) {
               $s = '';
               if ($tbl==$table) {
                  $s = ' SELECTED';
                  $found = 1;
               }
               $tables .= "<option value='".$table."'$s>".$table."</option>\n";
            }
            if (!$found) $tables = "<option value='' SELECTED>-- Select Table --</option>\n".$tables;
            return $tables;
         }
      ?>
      <div class='formrow'>
         <label for='importTable'>Table to Import Into:</label>
         <select name='importTable' id='importTable'>
            <?php print genTableSelect(); ?>
         </select>
      </div>
      Upload File to Import: <input type='file' name='importFile' id='importFile'/>
      <br>
      <p> - OR -</p>
      Text of Data to Import: <textarea name='importText' id='importText' style='width:25em;height:4em;'></textarea>
   </form>
   <p class='help' style='display:none;'>To import data into the '<?php print $in['rsc']; ?>' table you may either upload a file or copy &amp; paste the information to copy into the system.  The first line of the data sent must contain delimited field names with the remaining lines containing your delimited data, one entry per line.  Valid delimiters are 'Tab', '|', and ','.  Each row must contain an entry for each field. </p>
</div>

