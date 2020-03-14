<?php 
   require_once("head.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
   <head>
      <title>Documentationer</title>
      <script language="JavaScript" type='text/javascript' src='lib/fileman.js'>  </script>
      <?php include("files.php"); ?>
      <link rel='stylesheet' type='text/css' href='default.css' />
   </head>
   <body onload="init();">
      <div id='content'>
         <form action='outliner.php' name='outlineform' id='outlineform' method='post'>
            <input type='hidden' name='x' value=''>
            <input type='hidden' name='id' value='<?php print $in['id']; ?>'>
            <input type='hidden' name='title' value=''>
            <input type='hidden' name='outline' value=''>
            <input type='hidden' name='version' value='<?php print $in['version']; ?>'>
            <!-- 
            <div id='controls' onmouseover="ui.over='button'">
              <a href='javascript:void(null);' onclick='saveOutline();' onmousedown="press('save')" onmouseup="release('save')"><img id='save' src='img/toolbar/btn_save.png' class='btn' title='Save Outline' /></a>
            </div>
            -->
            <div id='node' onmouseover="ui.over='tree';"> </div>
            <div id='node_children' onmouseover="ui.over='tree';">
            </div>
         </form>
      </div>
      <div id='editwrap'><form name='editor' method='post' action='outliner.php' onsubmit='return false;'><textarea id='editframe' name='editframe' class='content'></textarea></form></div>
      <div id='docwrap'><iframe name='editDoc' id='editDoc' height='100%' width='100%' src='editor.php'></iframe></div>
      <div id='resizeBorder'>&nbsp;</div>
      <div id='focuswrap'> </div>
      <div id='drag'>&nbsp;</div>
      <div id='debug'>&nbsp;</div>
      <div id='statuscon'>&nbsp;</div>
      <div id='transport'><iframe id='transporter' name='transporter' height='110' width='110'> </iframe></div>
   </body>
</html>
