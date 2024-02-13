<?php
 if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
   $obj = $boss->db;
   $in = $_POST + $_GET;
   $in['tab'] = (!$in['tab']) ? 'Modules' : $in['tab'];
   $rsc = $in['rsc'] = 'Process';
   if ($in['x']) {
      $obj->addResource('Process');
      $data =& $obj->Process;

      switch ($in['x']) {
         case 'new':
            $in['x'] = 'add';
            // $in['ProcessID'] = "new1";
            // $current->ProcessID = "new1";
            break;
         case 'add':
            $in['Created'] = $in['LastModified'] = 'now()';
            if ($in['ProcessID']) $in['ProcessID'] = "new1";
            $in['ProcessID'] = $newid = $in['ProcessID'] = $data->add($in);
            
            $data->get($in['ProcessID'], 'ProcessID');
            
            $in['x'] = 'get';
            $js .= "parent.doRefresh('Process');\n";
            // <li><a rel='nav' title='John' href='/grid/index.php?pid=240' class='nav'><div class='navIcon'><span class='simpleIcon icon-skull-n-bones'> </span></div>John</a></li>
            $html = "<li><a rel='nav' title='".$in['Process']."' href='/grid/index.php?pid=$newid' class='nav'><div class='navIcon'><span class='simpleIcon icon-".$in['Icon']."'> </span></div>".$in['Process']."</a></li>";
            $js .= "top.jQuery('#mid_".$in['ModuleID']."').append(\"".$html."\");\n";
            
//               $dummy['Process']['new1']['Process'] = "Sample";
            
            // $boss->storeObject($dummy);
 	    $model = $boss->getModel($newid);
            break;
         case 'update':
            $in['LastModified'] = 'now()';
            $data->update($in['ProcessID'], $in);
            $data->get($in['ProcessID'], 'ProcessID');
            
            $proc = $data->Process[0];
            //$js .= "alert('Successfully updated record ID ".$in['ProcessID']." in the Process table.');\n";
            // $html = "<li><a rel='nav' title='".$in['Process']."' href='/grid/index.php?pid=".$in['ProcessID']."' class='nav'><div class='navIcon'><span class='simpleIcon icon-".$in['Icon']."'> </span></div>".$in['Process']."</a></li>";
            $html = ""; $pid = $in['ProcessID'];
            $url = ($proc->URL) ? $proc->URL : "/grid/index.php?pid=".$in['ProcessID'];
            if ($proc->Settings) $url .= '&'.$proc->Settings;
            $target = ($proc->Target) ? " target='".$proc->Target."'" : "";
            if (!$proc->ClassName) { $proc->ClassName = "nav"; }
            $js = ($proc->JS) ? " onclick='".$proc->JS.";return false;'" : "";
            $rel = ($js) ? 'noload' : 'nav';
            $url = ($js) ? "javascript:".$proc->JS : $url;

            $html .= "\t\t<li id='pid_".$in['ProcessID']."'><a rel='$rel'$target title='".$in['Process']."' href='".$url."'$js class='".$proc->ClassName."'>";
            if ($proc->Icon) {
               if (preg_match("/\.(png|jpg|gif|ico|bmp|svg)/", $proc->Icon)) {
                  $html .= "<div class='navIcon'><img src='".$proc->Icon."' border='0' /></div>";
               } else {
                  $html .= "<div class='navIcon'><span class='simpleIcon icon-".$proc->Icon."'> </span></div>";
               }
            } else {
               $html .= "<div class='navNoIcon'>".preg_replace("/^(\w).*/", "$1", $in['Process'])."</div>";
            }
            $html .= $in['Process']."</a></li>";

            $js .= "top.jQuery('#pid_".$in['ProcessID']."').replaceWith(\"".$html."\");\n";
            break;
         case 'deleteProcess':
            if ($in['ProcessID']) {
               $data->remove($in['ProcessID']);
               $boss->db->dbobj->execute("delete from Model where ProcessID=".$boss->_quote($in['ProcessID'])); 
               $js .= "top.jQuery('#pid_".$in['ProcessID']."').replaceWith(function(){return \"\";});\n";
               $js .= "parent.doRefresh('Process');parent.frames['EditFrame'].src='blank.html';\n";
               $js .= "top.updateStatus('Successfully removed Process ID ".$in['ProcessID']." from the Process table.');\n";
            
            }
            break;
         case 'lookup':
            $data->get($in['ProcessID'], 'ProcessID');

            break;
      }
   }

   $obj->addResource('Module');
   $obj->Module->getlist();
   if ($in['genform']) $form = $boss->getForm($proc, true);
   if ($in['genmodel']) $model = $boss->getModel($in['ProcessID'], true);
   
   function genTableSelect($tbl) {
      global $obj;

      $tmptbls = $obj->dbobj->list_tables($boss->app->DB);
      $tables = '';
      
      $found = 0;
      foreach ($obj->dbobj->tables as $idx=>$table) {
         $s = '';
         if ($tbl==$table) {
            $s = ' SELECTED';
            $found = 1;
         }
         $tables .= "<option value='".$table."'$s>".$table."</option>\n";
      }
      if (!$found) $tables = "<option value='$tbl' SELECTED>$tbl</option>\n".$tables;
      return $tables;
   }
   
   function genSelect($data, $name, $key, $val, $id='') {
      $pkey = $name.'ID';
      $opts = "<option ></option>";
      foreach ($data as $idx=>$rec) {
         if ($rec->$key) {
            if ($rec->$pkey == $id) {
               $s = ' SELECTED';
            } else { 
               $s = '';
            }

            $opts .= "<option value='".$rec->$key."'$s>".$rec->$val."</option>\n";
         }
      }
      return $opts;
   }
   if ($in['x']!="add") $current = $boss->getObject('Process', $in['ProcessID']);
   $mods = $boss->getObject('Module');
   $modules = genSelect($mods->Module, 'Module', 'ModuleID', 'Module', $in['ModuleID']);

?>
<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<html>
   <head>
      <title>Process Form</title>
      <script language="JavaScript" type='text/javascript' src='/lib/js/cookies.js'>  </script>
      <script language="JavaScript" type='text/javascript'>
         var tblmap = new Object();
         tblmap['Modules'] = 'Module';
         tblmap['Processes'] = 'Process';
         // tblmap['ProcessResources'] = 'ProcessResource';
         
         function $$(who) {
            return document.getElementById(who);
         }

         function updateFields(who) {
            // $$('Template').value = "";
            var proc = $$('Process') || $$('Module');
            if (proc && proc.value=='') { proc.value = who.replace(/(a-z)(A-Z)/, "$1 $2"); }
            $('#Buttons').val('127');
            $('#Access').val('1');
         }

         function genForm() {
            var frm = document.mainform;
            if (frm) {
               frm.action = (frm.action.match(/\?/)) ? frm.action + '&genform=1' : frm.action + '?genform=1';
               if (!frm.x.value.match(/add|new/)) frm.x.value = 'update';
               setTimeout("document.mainform.submit()", 150);
            }
            return false;
         }

         function genmodel() {
            var frm = document.mainform;
            if (frm) {
               frm.action = (frm.action.match(/\?/)) ? frm.action + '&genmodel=1' : frm.action + '?genmodel=1';
               if (!frm.x.value.match(/add|new/)) frm.x.value = 'update';
               setTimeout("document.mainform.submit()", 150);
            }
            return false;
         }

         function saveRecord() {
            if (!$("#Process").val()) {
               alert("Please provide a name for your process.");
               $("#Process").focus();
            } else {
               var frm = document.mainform;
               
               if (frm) {
                  if (!frm.x.value.match(/add|new/)) frm.x.value = 'update';
                  setTimeout("document.mainform.submit()", 150);
               }
            }
            return false;
         }

         function newRecord() {
            var frm = document.mainform;
            
            if (frm) {
               frm.x.value = 'new';
               
               for (var i in frm) {
                  if ((frm[i]) && (frm[i].type == 'TEXT')) {
                     frm[i].value = '';
                  }
               }
            }
            var rsc = frm.rsc.value;
            frm[rsc].focus();
         }

         <?php print $js; ?>
      </script>
      <link rel='stylesheet' type='text/css' href='finder.css?ver=2.0' />
      <link href="/lib/css/Aristo/jquery-ui-1.8.5.custom.css" type="text/css" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="/lib/css/core.css" />
      <link rel="stylesheet" type="text/css" href="/lib/css/icons48.css" />
      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
      <script>
      // increase the default animation speed to exaggerate the effect
      $.fx.speeds._default = 500;
      $(function() {
         $( "#dialog" ).dialog({
            autoOpen: false,
            width: 400,
            maxHeight: 400,
            height: 400
         });
         $(".simpleIcon").click(function(e) {
            
         });
         $("#opener").click(function(e) {
            parent.$("#dialog").dialog("open");
            e.stopPropagation();
            e.preventDefault();
            return false;
         });
         $(function($) {
            $("#advOpen").click(function() {
               eraseCookie("AdvancedProcess");
               $(this).hide();
               $("#advClosed").show();
               $("#advancedWrap").hide('fast');
            });
            $("#advClosed").click(function() {
               setCookie("AdvancedProcess", true, 1);
               $(this).hide();
               $("#advOpen").show();
               $("#advancedWrap").show('fast');
            });

         });
         setButtons(<?php print $current->Buttons; ?>);
      });

      function setButtons(cnt) {
         var x;
         $(".btnbox").each(function() {
            x = parseInt($(this).val());
            if (x & cnt) {
               $(this).attr("checked", true);
            }
         });
         $("#Buttons").val(cnt);
      }
      function calcButtons() {
         var cnt = 0, x;
         $(".btnbox").each(function() {
            x = parseInt($(this).val());
            if ($(this).is(":checked") && (!(cnt & x))) {
               cnt += x;
               $("#btncnt").text("["+cnt+"]");
            }
         });
         $("#btncnt").text("["+cnt+"]");
         $("#Buttons").val(cnt);
      }
      </script>
      <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
      <style>
         body, input, select, button, textarea { font-family: 'Open Sans', sans-serif; }
         #dialog {
            width:300px;
            height:250px;
            overflow:auto;
         }
         #advanced {
            margin-left: 2.2em;
         }
         #advOpen, #advClosed {
            cursor:default;
         }
         .footer {
            position:fixed;
            white-space:nowrap;
         }
         #opener {
            clear:left;
         }
         #iconPreview {
            float:right;
            position:relative;
            top:1em;
         }
         .simpleButton {
             -moz-border-radius:4px;
             background: -moz-linear-gradient(center top , #D0D0D0 0%, #FFFFFF 50%, #E0E0E0 51%, #A0A0A0 100%) repeat scroll 0 0 transparent;
             border-color: #EEEEFF #999999 #999999 #EEEEFF;
             border-style: solid;
             border-width: 1px;
             color: #000000;
             cursor: default;
             display: inline-block;
             float: left;
             margin: 4px 2px 0;
             outline: medium none;
             padding: 1px 0.6em 4px;
             text-decoration: none;
             font-size:14px;
             font-family: "Helvetica Neue",Optima,'Gill Sans','Gill Sans MT',Verdana,Arial,Helvetica,sans-serif;
         }
         #mainWrap {
            line-height:1.2em;
         }
         #iconSpan {
            display:inline-block;
            height:48px;
            width:48px;
         }
         .label { width:10em; vertical-align: top; }
         .data { width:15em; }
      </style>
   </head>
   <body>
      <div class='heading'>Process Editor</div>
      <div id='mainWrap'>
         <form name='mainform' id='mainform' action='process.php' method='post'>
<input type='hidden' name='x' value='<?php print $in['x']; ?>' />
<input type='hidden' name='rsc' value='Process' />
<div id='recordForm'><input type='hidden' name='ProcessID' value='<?php print $in['ProcessID']; ?>'>
<?php

?>
<div id='iconPreview'><span style='margin-right:1em;border:2px ridge #bbb;box-shadow:1px 1px 3px rgba(0,0,0,.4)' id="iconSpan" class="<?php if (!preg_match("/\.(png|jpg|gif|svg|bmp|ico)/", $current->Icon)) print "simpleIcon icon-".$current->Icon; ?>">
<?php if (preg_match("/\.(png|jpg|gif|svg|bmp|ico)/", $current->Icon)) {
?>
<img src="<?php print $boss->app->Assets.$current->Icon; ?>" width='48' height='48' border="0"><?php 
} ?></span></div>
<div class='formrow'><span class='label'>Resource</span><select name='Resource' id='Resource' onchange='updateFields(this.options[this.selectedIndex].value)' class='dataList'>
<option value=''>--Select One--</option>
<?php
   print genTableSelect($current->Resource);
?>
</select></div>
<div class='formrow'><span class='label'>Process</span><input type='text' size='15' name='Process' id='Process' value='<?php print $current->Process; ?>' class='data' /></div> 

<div class='formrow'><span class='label'>Icon</span><input type='text' size='15' name='Icon' id='Icon' value='<?php print $current->Icon; ?>' class='data' />
<button id="opener">Icons</button>
</div>
   <div class='formrow optionrow'>
      <input type='hidden' size='3' name='Buttons' id='Buttons' value='<?php print $current->Buttons; ?>' class='data' />
      <fieldset class='options'>
         <legend>Buttons <span id='btncnt' style='color:#ddd'>[<?php print $current->Buttons; ?>]</span></legend>
<?php  
   $btns = array();
   $btns["1"] = "New / Copy";
   $btns["2"] = "Save";
   $btns["4"] = "Delete";
   $btns["8"] = "Print";
   $btns["16"] = "Import";
   $btns["32"] = "Export";
   $btns["64"] = "Relate";
 
   foreach ($btns as $bit=>$txt) {
      $chk = (($current->Buttons & $bit) || ($in['x']=='new')) ? "checked='checked'" : '';
      print "<span class='chkopt'><input class='btnbox' type='checkbox' onchange='calcButtons()' value='$bit' id='bit_$bit' $chk> $txt</span>\n";
   }
?><br clear='left'>
      </fieldset>
   </div>
   <div class='formrow optionrow'>
      <fieldset class='options'>
         <legend>Options</legend>
            <span class='chkopt'><input type='hidden' name='ShowRelated' id='ShowRelated' value='<?php print $current->ShowRelated; ?>'><input type='checkbox' id='checkShowRelated' value='1' <?php print ($current->ShowRelated) ? 'checked="checked"' : ''; ?> onchange="$('#ShowRelated').val(this.checked?1:0)"> Show Related</span>
            <span class='chkopt'><input type='hidden' name='NoTable' id='NoTable' value='<?php print $current->NoTable; ?>'><input type='checkbox' id='checkNoTable' value='1' <?php print ($current->NoTable) ? 'checked="checked"' : ''; ?> onchange="$('#NoTable').val(this.checked?1:0)"> No Table</span>
            <span class='chkopt'><input type='hidden' name='NoSearch' id='NoSearch' value='<?php print $current->NoSearch; ?>'><input type='checkbox' name='checkNoSearch' id='checkNoSearch' class='check' value='1' <?php print ($current->NoSearch) ? "CHECKED='checked'" : ''; ?> onchange="$('#NoSearch').val(this.checked?1:0)" /> No Form</span>
            <span class='chkopt'><input type='hidden' name='Dynamic' id='Dynamic' value='<?php print $current->Dynamic; ?>'><input type='checkbox' id='checkDynamic' value='1' <?php print ($current->Dynamic) ? 'checked="checked"' : ''; ?> onchange="$('#Dynamic').val(this.checked?1:0)"> Dynamic</span>
         
      </fieldset>
   </div>
<div id='advanced'><span id='advClosed' style="<?php if ($_COOKIE['AdvancedProcess']) print "display:none"; ?>">&#x25BA;</span><span id='advOpen' style="<?php if (!$_COOKIE['AdvancedProcess']) print "display:none"; ?>">&#x25BC;</span> Advanced</div>
<div id='advancedWrap' style="<?php if (!$_COOKIE['AdvancedProcess']) print "display:none"; ?>">
   <div class='formrow'><span class='label'>Module</span><select name='ModuleID' id='ModuleID' class='dataList'><?php print $modules; ?></select></div>
   <div class='formrow'><span class='label'>Process ID</span><input type='text' size='10' name='ProcessID' id='ProcessID' value='<?php print $current->ProcessID; ?>' disabled="disabled" class='data' /></div>
   <div class='formrow'><span class='label'>Parent</span><select name='ParentID' id='ParentID' class='dataList'>
	<option value='0'>--Select One--</option>
      <?php
         $procs = $boss->getObject('Process', "ModuleID=".$boss->_quote($in['ModuleID']));
         print genSelect($procs->Process, 'Process', 'ProcessID', 'Process', $current->ParentID);
      ?>
      </select>
   </div>
   <!--<div class='formrow'><label class='label'>Buttons</label><input type='text' size='11' name='Buttons' id='Buttons' value='<?php print $current->Buttons; ?>' class='data' /></div><br />-->
   <div class='formrow'><span class='label'>URL</span><input type='text' size='25' name='URL' id='URL' value='<?php print $current->URL; ?>' class='data' /></div>
   <div class='formrow'><span class='label'>JS</span><input type='text' size='25' name='JS' id='JS' value='<?php print $current->JS; ?>' class='data' /></div>
   <div class='formrow'><span class='label'>Only</span><input type='text' size='25' name='Only' id='Only' value='<?php print $current->Only; ?>' class='data' /></div>
   <div class='formrow'><span class='label'>ClassName</span><input type='text' size='25' name='ClassName' id='ClassName' value='<?php print $current->ClassName; ?>'  class='data' /></div>
   <div class='formrow'><span class='label'>Settings</span><input type='text' size='25' name='Settings' id='Settings' value='<?php print $current->Settings; ?>' class='data' /></div>
   <div class='formrow'><span class='label'>Actions</span><textarea rows='3' cols='27' name='Actions' id='Actions' class='data'><?php print $current->Actions; ?></textarea></div>
   <div class='formrow'><span class='label'>Access</span><input type='text' size='20' name='Access' id='Access' value='<?php print $current->Access; ?>' class='data' /></div>
   <div class='formrow'><span class='label'>Sequence</span><input type='text' size='11' name='Sequence' id='Sequence' value='<?php print $current->Sequence; ?>' class='data' /></div>
   <div class='formrow'><span class='label'>Template</span><input type='text' size='25' name='Template' id='Template' value='<?php print $current->Template; ?>' class='data' /></div>
   <div class='formrow'><span class='label'>Print Template</span><input type='text' size='25' name='PrintTemplate' id='PrintTemplate' value='<?php print $current->PrintTemplate; ?>' class='data' /></div>
   <div class='formrow'><span class='label'>Form</span><input type='text' size='25' name='Form' id='Form' value='<?php print $current->Form; ?>' class='data' /></div>
   <div class='formrow'><span class='label'>Help</span><input type='text' size='25' name='Help' id='Help' value='<?php print $current->Help; ?>' class='data' /></div>
   <div class='formrow'><span class='label'>Target</span><input type='text' size='25' name='Target' id='Target' value='<?php print $current->Target; ?>' class='data' /></div>
   <div class='formrow'><span class='label'>Submit Handler</span><input type='text' size='25' name='SubmitHandler' id='SubmitHandler' value='<?php print $current->SubmitHandler; ?>' class='data' /></div>
   <div class='formrow'><span class='label'>Overview Query</span><textarea rows='3' cols='27' name='OverviewQuery' id='OverviewQuery' class='data'><?php print $current->OverviewQuery; ?></textarea></div>
   <div class='formrow'><span class='label'>Overview Function</span><input type='text' size='25' name='OverviewFunction' id='OverviewFunction' value='<?php print $current->OverviewFunction; ?>' class='data' /></div>
   <div class='formrow'><span class='label'>Overview Procedure</span><input type='text' size='25' name='OverviewProcedure' id='OverviewProcedure' value='<?php print $current->OverviewProcedure; ?>' class='data' /></div>

   <div class='formrow'><span class='label'>Search Fields</span><input type='text' size='25' name='SearchFields' id='SearchFields' value='<?php print $current->SearchFields; ?>' class='data' /></div>
   <div class='formrow'><span class='chkbox'><input type='hidden' name='NoTrack' id='NoTrack' value='<?php print $current->NoTrack; ?>'><input type='checkbox' name='checkNoTrack' id='checkNoTrack' class='check' value='1' <?php print ($current->NoTrack) ? "CHECKED='checked'" : ''; ?> onchange="$('#NoTrack').val(this.checked?1:0)" /> NoTrack</span>
      <span class='chkbox'><input type='hidden' name='IsNew' id='IsNew' value='<?php print $current->IsNew; ?>'><input type='checkbox' name='checkIsNew' id='checkIsNew' class='check' value='1' <?php print ($current->IsNew) ? "CHECKED='checked'" : ''; ?> onchange="$('#IsNew').val(this.checked?1:0)" /> Is New</span>
      <span class='chkbox'><input type='hidden' name='NoFramed' id='NoFramed' value='<?php print $current->NoFramed; ?>'><input type='checkbox' name='checkNoFramed' id='checkNoFramed' class='check' value='1' <?php print ($current->NoFramed) ? "CHECKED='checked'" : ''; ?> onchange="$('#NoFramed').val(this.checked?1:0)" /> No Frame</span>
   </div>
<br/><br/><br/> <br/>
<br clear="both">
</div>
</div></form>
</div>

      <div class='footer'>
         <form name='localButtons' id='localButtons' onsubmit='return false'>
            <!-- 
            <input type='button' class='btn' value='New Module' onclick='addModule()'>
            <input type='button' class='btn' value='New Process' onclick='addProcess()'>
            <input type='button' class='btn' value='New ProcessResource' onclick='addProcessResource()'>
            <input type='button' class='footerButton' value='New <?php print $rsc; ?>' onclick="parent.doNew('<?php print $rsc; ?>')" />
            <input type='button' class='footerButton' value='Delete <?php print $rsc; ?>' onclick='deleteRecord()' />
            -->
            <a href='#save' onclick="return saveRecord();" class='simpleButton'><span class="ui-icon ui-icon-disk"> </span> Save</a>
            <a href='#genform' onclick="return genForm();" class='simpleButton'><span class="ui-icon ui-icon-suitcase"> </span> Generate Form</a>
            <a href='#genmodel' onclick="return genmodel();" class='simpleButton'><span class="ui-icon ui-icon-calculator"> </span> Generate Model</a>
            <!--
            <input type='button' class='simpleButton' value='Save' onclick='saveRecord()' />
            <input type='button' class='simpleButton' value='Generate Form' onclick='genForm()' />
            <input type='button' class='simpleButton' value='Generate Model' onclick='genmodel()' />
            -->
         </form>
      </div>
      <div id='debug'>

      </div>
   </body>
</html>
