<?php 
   include("fckeditor.php") ;
   $in = $_REQUEST;
   print_r($in);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>Editor</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="robots" content="noindex, nofollow">
		<link href="editor.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
		</script>
	</head>
	<body>
		<form action="editor.php" method="post">
         <?php
            $sBasePath = '/editor/';
            $oFCKeditor = new FCKeditor('Content[new1][Content]') ;
            $oFCKeditor->BasePath = $sBasePath ;
            $oFCKeditor->Config['SkinPath'] = $sBasePath . 'editor/skins/silver/' ;
            
            $file = preg_replace("/^node/", '', $in['up']);
            if ($file) {
               $txt = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/content'.$file);
            }
            $oFCKeditor->Value = $txt;
            $oFCKeditor->Create() ;
         ?>
			<input type="submit" value="Save">
		</form>
	</body>
</html>
