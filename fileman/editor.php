<?php
   require_once('head.php');
   
   if (($in['x'] == 'save') && ($in['modified']=='1')) {
      $cwd = getcwd();
      chdir(dirname($base.$path));

      $fh = fopen($base, 'w');
      fwrite($fh, $in['content']);
      fclose($fh);
      
      $ph = popen("/usr/bin/cvs update ".$base." 2>&1", 'r');
      pclose($ph);

      $ph = popen("/usr/bin/cvs ci -m 'Updates by ".$_SESSION['Email']." via web editor' ".$base." 2>&1", 'r');
      $results = '';
      while ($out = fread($ph, 8192)) {
         $result .= $out;
      }
      print "<script type='text/javascript'>alert('".preg_replace("/'/", "&apos;", $results)."</script>";
      pclose($ph);
      chdir($cwd);
   }
   
   if ($in['up']) {
      if (!is_dir($base)) {
         $fh = fopen($base, 'r');
         if ($fh) $file = fread($fh, filesize($base));
         if ($file) $file = htmlspecialchars($file, ENT_QUOTES);
         //if ($file) $file = nl2br($file);
         $contents = '<pre>'.$file.'</pre>';
         if ($fh) fclose($fh);
      } else {
      }
   }

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
   <head>
      <title>Editor</title>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <link rel='stylesheet' type='text/css' href='lib/default.css' />
   </head>
   <body style='background-color:#f0f0f0;'>
      <div id='editControls' style="margin-top:3px">
         <a href='#save' onclick='document.editForm.submit();' onmousedown="this.style.top='3px';" onmouseup="this.style.top='0px';"><img id='save' src='img/toolbar/btn_save.png' class='btn' title='Save' /></a>
         <div style='float:right;margin-right:4px;margin-top:.75em;'>Editing: <?php print $in['up']; ?></div>
      </div>
      <form name='editForm' id='editForm' method='post' action='editor.php'>
         <input type='hidden' name='x' value='save' />
         <input type='hidden' name='modified' value='' />
         <input type='hidden' name='up' value='<?php print $in['up']; ?>' />
         <div id='editor' style='position:absolute;top:38px;left:0px;right:0px;bottom:0px;border-top:1px solid black;'>
            <textarea onchange="document.editForm.modified.value='1';" name='content' id='content' style='width:100%;height:100%;position:absolute;top:0px;border-top:0px;left:0px;right:0px;bottom:0px;'><?php print $file; ?></textarea>
         </div>
      </form>
   </body>
</html>
