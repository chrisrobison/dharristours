<?php
   require_once("obj_class.php");

   $in =& $_REQUEST;
print_r($in);
   $obj = new obj('cdrmail2', 'pimp', 'pimpin');
   $obj->addResource('doc');
   
   if (($in['node']) && ($in['outliner_id'])) {
      $obj->doc->get($in['node'], 'node', "outliner_id='".$in['outliner_id']."' ORDER BY version desc");
      $doc = $obj->doc->doc[0];
      
      if (($in['x'] == 'save') && ($doc->id)) {
         $in['version'] = (!$doc->version) ? 1 : ($doc->version + .1);
         $in['last_modified'] = 'now()';

         $obj->doc->update($doc->id, $in);
      } else if ($in['x'] == 'save') {
         $in['last_modified'] = 'now()';
         $in['created'] = 'now()';
         $obj->doc->add($in);
      }
   }


   if ($in['newnode']) {
      $obj->doc->get($in['newnode'], 'node', "outliner_id='".$in['outliner_id']."' ORDER BY version desc");
      $doc = $obj->doc->doc[0];
      $in['node'] = $in['newnode'];
      unset($in['newnode']);
   }

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Editor</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<script language="JavaScript" type="text/javascript" src="lib/html2xhtml.js"></script>
	<script language="JavaScript" type="text/javascript" src="lib/richtext.js"></script>
	<script language="JavaScript" type="text/javascript">
      function update(who, outline) {
         var frm = document.editForm;
         frm.x.value = 'save';
         frm.newnode.value = who;
         frm.outliner_id.value = outline;
         updateRTE('rte1');
         setTimeout("document.editForm.submit()", 250);
      }

      function setTitle(txt) {
         var nodeTitle = document.getElementById('nodeTitle');
         if (nodeTitle) {
            nodeTitle.innerHTML = txt;
         }
      }
   </script>
   <link rel='stylesheet' type='text/css' href='lib/outliner.css' />
</head>
<body onload="setTitle('<?php print $in['node']; ?>');">
<form name='editForm' id='editForm' method='post' action='edit.php'>
<input type='hidden' name='x' value='' />
<input type='hidden' name='id' value='<?php print $doc->id; ?>' />
<input type='hidden' name='outliner_id' value='<?php print $in['outliner_id']; ?>' />
<input type='hidden' name='newnode' value='<?php print $in['newnode']; ?>' />
<input type='hidden' name='node' value='<?php print $in['node']; ?>' />
<input type='hidden' name='user_id' value='<?php print $in['user_id']; ?>' />
<input type='hidden' name='version' value='<?php print $in['version']; ?>' />

<script language='JavaScript' type='text/javascript'>
<!--
//Usage: initRTE(imagesPath, includesPath, cssFile, genXHTML)
initRTE("img/", "lib/", "lib/outliner.css", true);
//-->
</script>
<noscript><p><b>Javascript must be enabled to use this form.</b></p></noscript>

<script language="JavaScript" type="text/javascript">
<!--
// Usage: writeRichText(fieldname, html, width, height, buttons, readOnly)
writeRichText('rte1', '<?php print rteSafe($doc->content); ?>', '100%', '100%', true, false);
//-->
</script>
<p><input type="submit" name="saveBtn" value="Save"></p>
</form>
<?php
function rteSafe($strText) {
	//returns safe code for preloading in the RTE
	$tmpString = $strText;
	
	//convert all types of single quotes
	$tmpString = str_replace(chr(145), chr(39), $tmpString);
	$tmpString = str_replace(chr(146), chr(39), $tmpString);
	$tmpString = str_replace("'", "&#39;", $tmpString);
	
	//convert all types of double quotes
	$tmpString = str_replace(chr(147), chr(34), $tmpString);
	$tmpString = str_replace(chr(148), chr(34), $tmpString);
//	$tmpString = str_replace("\"", "\"", $tmpString);
	
	//replace carriage returns & line feeds
	$tmpString = str_replace(chr(10), " ", $tmpString);
	$tmpString = str_replace(chr(13), " ", $tmpString);
	
	return html_entity_decode($tmpString);
}
?>
</body>
</html>
