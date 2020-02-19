<?php
   if (!$boss) require_once($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');
?>
<div id='importDialog' title='Import Data' style='display:none'>
   <form action='ctl.php' id='import' name='import' method='post' target='importFrame' enctype='multipart/form-data'>
      <input type='hidden' name='x' value='import'/>
      <input type='hidden' name='rsc' value='<?php print $in['rsc']; ?>'/>
      <input type='hidden' name='pid' value='<?php print $in['pid']; ?>'/>
<h3>Send information to import</h3>
      Upload File to Import: <input type='file' name='importFile' id='importFile'/>
      <br>
      <p> - OR -</p>
      Text of Data to Import: <textarea name='importText' id='importText' style='width:25em;height:4em;'></textarea>
   </form>
   <p class='help' style='display:none;'>To import data into '<?php print $in['rsc']; ?>' data store you may either upload a file or copy &amp; paste the text of the data to import.  The first line of the data <strong>must</strong> contain the names of the fields and those names must match those in the table.  The remaining lines contain your delimited data, one entry per line.  Valid delimiters are 'Tab', '|', and ','.  Values may optionally be quoted with double quotes ("). </p>
</div>
<script>
jQuery(function($) {
   $("#importDialog").dialog({
      autoOpen: false,
      height: 300,
      width: 400,
      modal: false,
      buttons: [
         { text: "Import", click: function() { $("#import").submit(); $(this).dialog("close"); } }, 
         { text: "Cancel", click: function() { $(this).dialog("close"); } }
      ]
   });
});
</script>
<iframe name='importFrame' id='importFrame' style='position:absolute;left:-2000px;width:100px;height:100px;top:-2000px;'></iframe>

