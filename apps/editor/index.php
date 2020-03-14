<?php 
   require_once("../lib/boss_class.php") ;
   include("fckeditor.php") ;
   $in = $_REQUEST;
   
   $boss = new boss();
   session_start();
   if (!$in['ContentID'] && $in['NavID']) {
      $boss->db->addResource('Content');
      $boss->db->Content->get($in['NavID'], 'NavID');
      if (count($boss->db->Content->Content)) {
         $in['ContentID'] = $boss->db->Content->Content[0]->ContentID;
      }
   } 
//Content[' . ((!$in['ContentID']) ? 'new1' : $in['ContentID']) . '][Content]
   if ($in['x'] == 'update') {
      $out = $in;
      $out['Content'][$in['ContentID']]['Content'] = preg_replace("/\&lt;/s", "<", $out['Content'][$in['ContentID']]['Content']); 
     $out['Content'][$in['ContentID']]['Content'] = preg_replace("/\&gt;/s", ">", $out['Content'][$in['ContentID']]['Content']); 
     if ($in['NavID']) $out['Nav'][$in['NavID']]['Modified'] = 1;
      $boss->storeRecord($out);
   }
   if ($in['ContentID']) {
      $current = $boss->getObject('Content', $in['ContentID']);
   }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>Editor</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="robots" content="noindex, nofollow">
		<link href="editor.css" rel="stylesheet" type="text/css" />
		<link href="/lib/css/default.css" rel="stylesheet" type="text/css" />
		<link href="/site/css/website.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src='/lib/js/default.js'> </script>
		<script type="text/javascript">
         window.onclose = checkModified;
         document.onkeypress = doModify;
		</script>
	</head>
	<body onunload="checkModified()">
		<form action="/editor/index.php" method="post">
         <input type='hidden' name='NavID' value='<?php print $current->NavID; ?>'/>
         <input type='hidden' name='ContentID' value='<?php print $in['ContentID']; ?>'/>
         <input type='hidden' name='Content[<?php print $in['ContentID']; ?>][ContentID]' value='<?php print $in['ContentID']; ?>'/>
         <input type='hidden' name='Content[<?php print $in['ContentID']; ?>][NavID]' value='<?php print $current->NavID; ?>'/>
         <input type='hidden' name='Content[<?php print $in['ContentID']; ?>][LastModifiedBy]' value='<?php print $_SESSION['Email']; ?>'/>
         <input type='hidden' name='Nav[<?php print $current->NavID; ?>][LastModifiedBy]' value='<?php print $_SESSION['Email']; ?>'/>
         <input type='hidden' name='Nav[<?php print $current->NavID; ?>][Modified]' value='1'/>
         <input type='hidden' name='Content[<?php print $in['ContentID']; ?>][ParentID]' value='<?php print $current->ParentID; ?>'/>
         <input type='hidden' name='x' value='update'/>
         <?php
            $sBasePath = '/editor/';
            $oFCKeditor = new FCKeditor('Content[' . ((!$in['ContentID']) ? 'new1' : $in['ContentID']) . '][Content]') ;
            $oFCKeditor->BasePath = $sBasePath ;
            $oFCKeditor->ToolbarSet = 'CMS';
            $oFCKeditor->Config['SkinPath'] = $sBasePath . 'editor/skins/silver/' ;
            // The 'FullPage' option has a bug that doesn't allow the style sheet to load
            // $oFCKeditor->Config['FullPage'] = true ;
            $oFCKeditor->Value = $current->Content;
            $oFCKeditor->Create() ;
         ?>
         <div id='buttons' style='z-index:100000;position:absolute;float:right;right:10em;top:40em;width:40em;height:24px;'>
            <input type='button' value='Close' onclick="self.close();" style='float:right;' accesskey='c' title='Click this button to cancel your changes and close this editor window'/>
            <input tabindex='60' type='button' value='Preview' onclick="window.open('/site.php?NavID=<?php print $current->NavID ?>')" style='float:right;margin-right:1em;' accesskey='p'/>
            <input type='submit' value='Save' style='float:right;' accesskey='s' title='Click this button to save your changes'/>
         </div>
		</form>
	</body>
</html>
