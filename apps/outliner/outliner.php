<?php
   require_once("obj_class.php");
   
   session_start();
   
   $in =& $_REQUEST;
   $maillogin = $in['user_id'] = 'netoasis.net';
   $pass = $_SESSION['pass'];

   $obj = new obj('cdrmail2', 'pimp', 'pimpin');
   $obj->addResource('outliner');
   
   switch($in['x']) {
      case 'view':
         // $obj->outliner->get($in['id'], 'id');
         $obj->outliner->get($in['id'], 'id', "user_id='netoasis.net'");
         foreach ($obj->outliner->outliner[0] as $key=>$val) {
            $in[$key] = $val;
         }
         break;
      case 'save':
         if ((!$in['id']) || ($in['id'] == 'new')) {
            $in['last_modified'] = $in['created'] = 'now()';
            $in['version'] = ($in['version']) ? $in['version'] + .01 : 1;
            $in['title'] = 'New Outline';
            $in['outliner_id'] = $in['id'] = $obj->outliner->add($in);
         } else {
            $in['version'] = ($in['version']) ? $in['version'] + .01 : 1;
            $in['last_modified'] = 'now()';
            $obj->outliner->update($in['id'], $in);
         }
         break;
      case 'new':
         $in['last_modified'] = $in['create'] = 'now()';
         $in['version'] = ($in['version']) ? $in['version'] + .01 : 1;
         $in['title'] = 'New Outline';
         $in['outliner_id'] = $in['id'] = $obj->outliner->add($in);
         break;
      default:

   }

   $obj->outliner->get($in['id'], 'id', "version='".$in['version']."'");
   $outline = $obj->outliner->outliner[0];
   
   $obj->outliner->getlist("user_id='netoasis.net'");
   $out = $obj->outliner->outliner;
   $ocnt = count($out);
   $outlineList = "<option> -- Saved Outlines --</option>\n";
   for ($o=0;$o<$ocnt;$o++) {
      $s = ($in['id'] == $out[$o]->id) ? ' SELECTED' : '';
      $outlineList .= "<option value='".$out[$o]->id."'$s>".$out[$o]->title."</option>\n";
   }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
   <head>
      <title>CDRMail Outliner</title>
      <script language="JavaScript" type='text/javascript' src='lib/domlib.js'>  </script>
      <script language="JavaScript" type='text/javascript' src='lib/outliner.js'>  </script>
      <script language="JavaScript" type='text/javascript' src='lib/textile.js'>  </script>
      <link rel='stylesheet' type='text/css' href='lib/outliner.css' />
   </head>
   <body onload="init();">
      <div id='content'>
         <form action='outliner.php' name='outlineform' id='outlineform' method='post'>
            <input type='hidden' name='x' value=''>
            <input type='hidden' name='id' value='<?php print $in['id']; ?>'>
            <input type='hidden' name='title' value=''>
            <input type='hidden' name='outline' value=''>
            <input type='hidden' name='version' value='<?php print $in['version']; ?>'>
            <div id='controls' onmouseover="ui.over='button'">
              <a href='javascript:void(null);' onclick='document.forms[0].x.value="new";document.forms[0].id.value="new";setTimeout("document.forms[0].submit();", 150);' onmousedown="return press('newoutline')" onmouseup="return release('newoutline')"><img id='newoutline' src='img/toolbar/btn_outliner.png' class='btn' title='New Outline' 
              /></a><a href='javascript:void(null);' onclick='saveOutline();' onmousedown="return press('save')" onmouseup="return release('save')"><img id='save' src='img/toolbar/btn_save.png' class='btn' title='Save Outline' /></a><a href='javascript:void(null);' onclick='addSibling(event);' onmousedown="return press('newnode')" onmouseup="return release('newnode')"><img id='newnode' src='img/toolbar/btn_newnode.png' class='btn' title='New Node' 
              /></a><a href='javascript:void(null);' onclick='addChild(event);' onmousedown="return press('newchild')" onmouseup="return release('newchild')"><img id='newchild' src='img/toolbar/btn_newchild.png' class='btn' title='New Child Node' /></a>
               <select name='files' id='files' onchange="viewOutline(this.options[this.selectedIndex].value);" class='files'>
                  <?php print $outlineList; ?>
               </select>
            </div>
            <div id='node_children' onmouseover="ui.over='tree';">
               <?php
                  if ($in['outline']) {
                     print $in['outline'];
                  } else if ($in['id']) {
                     print "<div class='node' id='node_1'>New Outline [&lt;TAB&gt; adds child; &lt;SHIFT&gt;-&lt;ENTER&gt; adds sibling; &lt;SHIFT&gt;-&lt;TAB&gt; adds new parent sibling]</div>\n";
                  }
               ?>
            </div>
         </form>
      </div>
      <div id='editwrap'><form name='editor' method='post' action='outliner.php' onsubmit='return false;'><textarea id='editframe' name='editframe' class='content' onfocus='this.select()'></textarea></form></div>
      <div id='resizeBorder'>&nbsp;</div>
      <div id='docwrap'>
         <div id='showDoc'> </div>
         <div id='editWrap'><textarea id='editDoc' name='editDoc' rows='20' cols='100' onkeypress="setTimeout('liveUpdate(\'showDoc\', \'editDoc\');', 250);" onfocus="ui.editFocus=1" onblur="ui.editFocus=0"></textarea></div>
         <!-- <iframe name='editDoc' id='editDoc' height='100%' width='100%' src='edit.php'></iframe> -->
      </div>
      <div id='focuswrap'> </div>
      <div id='drag'>&nbsp;</div>
      <div id='debug'>&nbsp;</div>
      <div id='statuscon'>&nbsp;</div>
      <form name='contentform' id='contentform' action='cmd.php' method='post' target='transporter2' onsubmit="return false">
         <input type='hidden' name='x' value=''>
         <input type='hidden' name='id' value=''>
         <input type='hidden' name='node' value=''>
         <input type='hidden' name='newnode' value=''>
         <input type='hidden' name='outliner_id' value='<?php print $in['id']; ?>'>
         <input type='hidden' name='title' value=''>
         <input type='hidden' name='version' value=''>
         <input type='hidden' name='content' value=''>
      </form>
      <div id='transport'><iframe id='transporter' name='transporter' height='110' width='110'> </iframe></div>
   </body>
</html>
