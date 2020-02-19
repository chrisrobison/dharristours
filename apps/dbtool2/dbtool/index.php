<?php
   require_once('head.php');
   
   $opts = '';
   $mods = $boss->getObject('Module', "Access & {$_SESSION['Access']} order by Sequence");
   foreach ($mods->Module as $mod) {
      if ($mod->ModuleID) {
         $opts .= "<option value='{$mod->ModuleID}'>".$mod->Module."</option>\n";
      }
   }
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Visual DB Schema Editor</title>
      <link rel="stylesheet" type="text/css" href="lib/default.css" />
      <link rel="stylesheet" type="text/css" href="/lib/css/icons.css" />
      <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.css" />
      <style>
         #main {
            position:relative;
         }
         .selectedIcon {
            background-color: #aaddff;
         }
         #dbDialog {
            width:500px;
            height:400px;
            z-index: 999999;
            background-color: #ffffff;
         }
         .ui-dialog {
            -moz-box-shadow: 1em 1em 1em rgba(0,0,0,.4);
            -webkit-box-shadow: 1em 1em 1em rgba(0,0,0,.4);
            box-shadow: 1em 1em 1em rgba(0,0,0,.4);
            z-index:999999;
         }
         #makeToolWrap {
            margin:.5em 2px;
            padding:.5em 2px;
         }
         #makeToolWrap.notool {
            color:#bbbbbb;
         }
         label { padding-right:.25em; }
         #relate { width:2000px; height:3000px; }
         #canvas { width:2000px; height:3000px; }
         #showtables { width:173px;position:absolute;top:28px;min-height:400px;border:1px solid #666;-moz-box-shadow:.5em .5em .75em rgba(0,0,0,.25);-webkit-box-shadow:.5em .5em .75em rgba(0,0,0,.25);box-shadow:.5em .5em .75em rgba(0,0,0,.25);background-color:#000;font-size:1.2em;line-height:2em;padding:0px 1em 1em 1em;color:#f0f0f0;opacity:.75;display:none;}
         #showtableTab { position:absolute;left:0px;top:200px;width:1em;height:2em;border:1px solid #000; border-radius: 0 .25em .25em 0;border-left:0px;background-color:#fafafa;font-size:2em;color:#000;text-align:center;padding-top:8px;z-index:999999;cursor:pointer;}
         .showtablesOpen { width:200px; }
         .showtableTabOpen { left:200px;-moz-box-shadow:.25em .25em .5em rgba(0,0,0,.25);-webkit-box-shadow:.25em .25em .5em rgba(0,0,0,.25);box-shadow:.25em .25em .5em rgba(0,0,0,.25); }
         .showtableTabOpen:before { content: "\25C2"; }
         .showtableTabClosed { left:0px; }
         .showtableTabClosed:before { content: "\25B8"; }
      </style>
   </head>
   <body>
      <div id='main'>
	   <canvas id="canvas"></canvas>
	   <canvas id="relate"></canvas>
      <form name='dbtool' id='dbtool' action='index.php' method='post'>
         <div id='toolbar'>
            <div id='toolfloat'><!-- <input type='checkbox' id='kiss' name='kiss' value='simple'<?php if (!$_SESSION['kiss']) { ?>checked="checked"<?php } ?>> Keep it Simple--></div>
            <div id='tblbtn'><button class='newtbl' id='newtbl'>New Table</button><button class='newtbl' id='newimporttbl'>Import New Table</button><button class='newtbl' id='tblimport'>Import Table</button><span id='dbTitle' style='float:left;'><?php print preg_replace("/^SS_/", '', $db); ?> Database</span></div>
            <div id='showtables'>
            </div>
            <div class='showtableTabClosed' id='showtableTab'></div>
         </div>
         <input type='hidden' name='tableName' id='tableName' value=''/>
         <input type='hidden' name='fieldName' id='fieldName' value=''/>
         <input type='hidden' name='x' value='add'/>
         <input type='hidden' name='newtable' value=''/>
         <div id='coltypes'>
            <input type='image' name='save' id='save' src='img/save.png'><input onclick='return doUpdate()' style='display:none' type='image' name='btnUpdate' id='btnUpdate' src='img/save.png'><input style='display:none' onclick='return doDelete()' type='image' name='delete' id='delete' src='img/delete.png'><input onchange="doChange()" type='text' name='colname' id='colname'>
            <div id='typelist' style='display:inline-block;'>
               <select name='coltype' id='coltype' class='typelist' onchange="doChange()"> </select>
               <input type='text' onchange='doChange()' name='colattr' id='colattr'>
            </div>
         </div>
         <div id='schemas'> </div>
         <div id='debug'> </div>
      </form>
      <div id='dbDialog' title="Create Table" style='display:none'>
         <form id='newtblform' method='post'>
            <input type='hidden' name='x' value='newtable'>
            <label for='tblname'>Table Name:</label><input type='text' name='newtable' id='newtable' size='30'><br>
            <div id='makeToolWrap'><input type='checkbox' checked='checked' name='makeTool' id='makeTool'><label for='ModuleID'>Create Component in</label>
            <select name='ModuleID' id='ModuleID'>
               <?php print $opts; ?>
            </select></div>
            <input type='hidden' name='Icon' id='Icon' value='' />
            Select Icon: <span id='iconPreview' class='simpleIcon'> </span><br>
            <div id="icons">
            <?php 
               $file = file($_SERVER['DOCUMENT_ROOT']."/lib/css/icons.txt");
               
               $row = 0; $col = 0;
               foreach ($file as $icon) {
                  preg_match("/\d*-(.+?)\.png/", $icon, $match);

                  print "<span class='simpleIcon icon-".$match[1]."' title='".$match[1]."'></span>";
                  ++$col;
                  if ($col==10) {
                     ++$row; $col = 0;
                  }
               }
            ?>
            </div>
         </form>
      </div>
      <?php include("import.php"); ?>
      <?php include("newimport.php"); ?>
      <iframe name='importFrame' id='importFrame' style='position:absolute;left:-2000px;width:100px;height:100px;top:-2000px;'></iframe>
      </div>
      <div style="clear:both"></div>
      <br clear="all">
   </body>
      <script type='text/javascript' src="/lib/js/json2.js"> </script>
      <script type='text/javascript' src="/lib/js/store.js"> </script>
      <script type='text/javascript' src="lib/ui.js"> </script>
      <script type='text/javascript' src="lib/schema.js"> </script>
      <script type="text/javascript">
         <?php print $js; ?>
      </script>
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
      <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js" type="text/javascript"></script>
      <script type='text/javascript'>
         var myui = { dragging:'' };
         $(document).ready(function() {
            init(schema);
            updateRelations($("#canvas"), $("div.tableDiv"));
            $("div.tableDiv").mousedown(function() {
               $("div.tableDiv").css("z-index", "1");
               $(this).css("z-index", "999");
            });

            // $("div.tableDiv").each(function() { });
            
            $("div.tableDiv").draggable({
               appendTo: "#schemas",
               helper: function() { 
                 var clone = $(this).clone().attr("id", $(this).attr('id').replace(/table/, 'clone')).addClass('tableDiv');
                 return clone[0];
               },
               handle: ".tableHeading",
               opacity: .35,
               start: function(event, myui) {
                  ui.dragType = 'table';
                  ui.currentTable = ui.dragging = this.id.replace(/table_/, '');
               },
               stop: function(event, myui) {
                  $(this).css('z-index', 1);
                  
                  // myui.currentTable = myui.dragging;
                  // myui.dragging = undefined;
               },
               drag: function() {
                  updateRelations($("#canvas"), $("div.tableDiv"));
               }
            });
            
            $("div.tableDiv").droppable({
               drop: function(event, myui) {
                  ui.dropped = this.id.replace(/table_/, '');
                  var local = myui.draggable.attr('id').replace(/table_/, '');
                  
                  if (!relations) relations = { };
                  
                  var src = $("#table_" + ui.dragging),
                     dest = $("#table_" + ui.dropped);
                  
                  if (ui.dragType=='table' && confirm("Linking " + local + " to " + ui.dropped)) {
                     $.get("cmd.php", {l: local, r: ui.dropped, x: 'clamp' }, function(data, txtStatus, xhr) { });
                     src.attr("rel", src.attr('rel') + ' ' + ui.dropped);
                     relations[ui.dragging] = relations[ui.dragging] ? relations[ui.dragging] + ' ' + ui.dropped : ui.dropped;
                     updateRelations($("#canvas"), $("div.tableDiv"));
                  } 
                  ui.dragging = '';
               }
            });
            frm = document.forms['dbtool'];
            $("#kiss").change(function() { 
               ui.coltype = ($(this).is(":checked")) ? "simple" : "advanced";
            });
            
            $("#newimporttbl").click(function(e) { $("#newimportDialog").dialog("open"); return false; });
            $("#tblimport").click(function(e) { $("#importDialog").dialog("open"); return false; });
            $("#newtbl").click(function(e) { $("#dbDialog").dialog("open"); return false; });
            
            $("#colname").keydown(function(e) {
               doChange();
               console.log('Keydown code: '+e.which);
               if (e.which==27) { unedit(); }
               if (e.which==13) { 
                  $.get("cmd.php", $("#dbtool").serialize(), function(data) { console.log(data); }); 
                  if (ui.state.adding) {
                     var newli = "<li class='tableField' id='" + ui.state.tableName + '_' + $("#colname").val() + "_field'><span class='fieldDef'>" + $("#coltype").val()+"</span> " + $("#colname").val() + "</li>";
                     $('#' + ui.state.tableName + '_new_field').before(newli);
                     unedit(false);
                     doEdit(ui.state.tableName, 'new', '');
                  } else {
                     unedit(false);
                  }
                  return false; 
               }
            });
            $("#makeTool").click(function() { 
               if ($(this).is(":checked")) {
                  $("#makeToolWrap").removeClass('notool');
                  $("#ModuleID").attr("disabled",false);
               } else {
                  $("#makeToolWrap").addClass('notool');
                  $("#ModuleID").attr("disabled","disabled");
               }
            });
            
            $(".simpleIcon", "#newimportDialog").click(function(e) {
               $(".selectedIcon").removeClass("selectedIcon");
               $(this).addClass("selectedIcon");
               $("#importIcon").val($(this).attr('title'));
               $("#importiconPreview").attr("class", "simpleIcon icon-"+$(this).attr('title'));
            });

            $(".simpleIcon", "#dbDialog").click(function(e) {
               $(".selectedIcon").removeClass("selectedIcon");
               $(this).addClass("selectedIcon");
               $("#Icon").val($(this).attr('title'));
               $("#iconPreview").attr("class", "simpleIcon icon-"+$(this).attr('title'));
            });

            $( "#dbDialog" ).dialog({
               autoOpen: false, width: 500, maxHeight: 800, maxWidth: 1000, height: 500, modal: true,
               buttons: {
                  "Create Table": function() {
                     if ($("#newtable").val()!="") {
                        $("#newtblform").submit();
                        $( this ).dialog( "close" );
                     } else {
                        $("#newtblform").focus();
                     }
                  },
                  Cancel: function() { $( this ).dialog( "close" ); }
               }
            });
            $("#importDialog").dialog({
               autoOpen: false, height: 300, width: 400, modal: false,
               buttons: {
                  "Import": function() {
                     $("#import").submit();
                     $(this).dialog("close");
                  },
                  "Cancel": function() { $(this).dialog("close"); }
               }
            });
            
            $("#newimportDialog").dialog({
               autoOpen: false, width: 500, maxHeight: 800, maxWidth: 1000, height: 500, modal: true,
               buttons: {
                  "Create Table": function() {
                     if ($("#newimport").val()!="") {
                        $("#newimportform").submit();
                        $( this ).dialog( "close" );
                     } else {
                        $("#newimport").focus();
                     }
                  },
                  Cancel: function() { $( this ).dialog( "close" ); }
               }
            });
            $("#importTable").change(function() { 
               $("input#rsc").val($(this).val());
            });

            $(".showcheck").live('click', function(evt) {
               var pos, el = $(this), tbl = $(this).attr('id').replace(/^[^_]+_/, '');
               
               if (tbl) {
                  pos = ui.state[tbl].offset = $('#table_' + tbl).offset();

                  if (ui.state[tbl].showing) {
                     ui.state[tbl].showing = 0;
                     ui.state[tbl].hidden = 1;
                     $("#show_"+tbl).removeAttr("checked");
                     $("#table_"+tbl).css('display', 'none');
                     tableStore = pos.left + ':' + pos.top + ':' + $("#"+tbl+"_container").css('display') + ':1000:1';
                  } else {
                     ui.state[tbl].showing = 1;
                     ui.state[tbl].hidden = 0;
                     $("#show_"+tbl).attr("checked","checked");
                     $("#table_"+tbl).css('display', 'block');
                     tableStore =  pos.left + ':' + pos.top + ':' + $("#"+tbl+"_container").css('display') + ':1000:0';
                  }
                  if (tableStore) storeValue('table_'+tbl, tableStore);
                  storeTable(tbl);
               }
            });
            $("#dbTitle").mouseenter(function(evt) {
               $("#showtables").show('slide', 500);
               $("#showtableTab").animate({"left":200}, 500).addClass('showtableTabOpen').removeClass('showtableTabClosed');
               ui.toggle.tables = 1;
            });
            ui.toggle = {};
            ui.toggle.tables = 0;
            // $("#showtables").mouseleave(function(evt) { $("#showtables").hide('fast'); });
            $("#showtableTab").click(function() {
               $("#showtables").toggle('slide', {}, 500);
               $("#showtableTab").animate({"left":(ui.toggle.tables?0:200)}, 500).toggleClass('showtableTabOpen').toggleClass('showtableTabClosed');
               ui.toggle.tables ^= 1;
            });
            <?php print $jsup; ?>
         });
      </script>
</html>
