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
      <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800'>
      <link rel="stylesheet" type="text/css" href="lib/default.css">
      <link rel="stylesheet" type="text/css" href="lib/contextmenu.css">
      <link rel="stylesheet" type="text/css" href="/lib/css/icons48.css">
      <link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.css">
   </head>
   <body>
      <div id='main'>
	   <canvas id="canvas"></canvas>
	   <canvas id="relate"></canvas>
      <form name='dbtool' id='dbtool' action='index.php' method='post'>
         <div id='toolbar'>
            <span id='dbTitle' style='float:right;'><?php print preg_replace("/^SS_/", '', $db); ?> Database</span>
            <div id='toolfloat'>
               <!-- <button class='newtbl' id='newtbl'>New Table</button><button class='newtbl' id='newimporttbl'>Import New Table</button><button class='newtbl' id='tblimport'>Import Table</button>-->
               <a class='toolbarButton' title='New Table' id='newtbl' href='#newTable'><img class='toolbtn' src='/img/dbtool/icon_newTable.png'></a><a class='toolbarButton' title='Copy Table' href='#copy'><img class='toolbtn' src='/img/dbtool/icon_copyTable.png'></a><a class='toolbarButton' title='Rename Table' href='#rename'><img class='toolbtn' src='/img/dbtool/icon_renameTable.png'></a> &nbsp;
               <a class='toolbarButton' title='Import Table' id='newimporttbl' href='#import'><img class='toolbtn' src='/img/dbtool/icon_importTable.png'></a><a class='toolbarButton' title='Update Table' id='tblimport' href='#update'><img class='toolbtn' src='/img/dbtool/icon_importTable.png'></a><a class='toolbarButton' title='Export Table' href='#export'><img class='toolbtn' src='/img/dbtool/icon_exportTable.png'></a> &nbsp; 
               <a class='toolbarButton' title='Truncate Table' href='#truncate'><img class='toolbtn' src='/img/dbtool/icon_truncateTable.png'></a><a class='toolbarButton' title='Drop Table' href='#drop'><img class='toolbtn' src='/img/dbtool/icon_dropTable.png'></a>
            </div>
            <div id='currentTableWrap'>Current Table: <span id='currentTable'>NONE</span></div>
            <div id='showtables'></div>
            <div class='showtableTabClosed' id='showtableTab'></div>
         </div>
         <input type='hidden' name='tableName' id='tableName' value=''/>
         <input type='hidden' name='fieldName' id='fieldName' value=''/>
         <input type='hidden' name='x' value='add'/>
         <input type='hidden' name='newtable' value=''/>
         <div id='coltypes'>
            <input type='image' name='save' id='save' src='img/save.png'><input style='display:none;margin-top:4px;' type='image' name='delete' id='delete' src='img/delete.png'><input onchange="doChange()" type='text' name='colname' id='colname'>
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
               $file = file($_SERVER['DOCUMENT_ROOT']."/lib/css/icons48.txt");
               
               $row = 0; $col = 0;
               foreach ($file as $icon) {
                  $icon = rtrim($icon);
                  if (preg_match("/\d*-(.+?)\.png/", $icon, $match)) {
                     $ico = $match[1];
                  } else {
                     $ico = $icon;
                  }

                  print "<span class='simpleIcon icon-".$ico."' title='".$ico."'></span>";
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
      <iframe name='exportFrame' id='exportFrame' style='position:absolute;left:-2000px;width:100px;height:100px;top:-2000px;'></iframe>
      </div>
      <div style="clear:both"></div>
      <br clear="all">
   </body>
      <script type='text/javascript' src="/lib/js/json2.js"> </script>
      <script type='text/javascript' src="/lib/js/store.js"> </script>
      <script type="text/javascript">
         <?php print $js; ?>
      </script>
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
      <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js" type="text/javascript"></script>
      <script type='text/javascript' src="lib/ui.js"> </script>
      <script type='text/javascript' src="lib/schema.js"> </script>
      <script type="text/javascript" src="lib/jquery.contextmenu.js"></script>
      <script type="text/javascript" src="lib/jquery.tipsy.js"></script>
      <script type='text/javascript'>
         var myui = { dragging:'' };
         $(document).ready(function() {
            init(schema);
            updateRelations($("#canvas"), $("div.tableDiv"));
            // $("div.tableDiv").each(function() { });

            $("#main").on("click", ".tableDiv", function(e) {
               var $this = $(this), mytable = $(this).attr('id');

               if (mytable) {
                  $(".tableDiv").css("z-index", "auto");
                  var oldtbl = $("#table_"+myui.table),
                     newz = parseInt(oldtbl.css("z-index")) - 1;
                  if (isNaN(newz)) newz = 10;
                  oldtbl.css({"z-index": newz});
                  $this.css("z-index", newz + 1);
                  $(".shadow").removeClass("shadow");
                  $this.addClass("shadow");
                  myui.table = mytable.replace(/^table_/, '');
                  $("#currentTable").html(myui.table);
               }
            });

            $("div.tableDiv").on("click", ".toggle", function(e) { 
               $(".tableDiv").css("z-index", "auto");
               $(this).closest(".tableDiv").css("z-index", (getHighIndex(".tableDiv") + 1));
               
               var mytable = $(this).closest(".tableDiv").attr('id');
               if (mytable) myui.table = mytable.replace(/^table_/, '');
               
               $("ul.fieldContainer", $(this).closest(".tableDiv")).toggle(150, function() {
                  storeTable($(this).closest(".tableDiv").attr('id'));
                  updateRelations($("#canvas"), $("div.tableDiv"));
               });
               $(this).toggleClass('toggleUp toggleBtn');
            });

            $("#main").on("mousedown", ".tableDiv", function(e) {
               $(".tableDiv").css("z-index", "auto");
               $(".shadow").removeClass("shadow");
               $(this).addClass("shadow").css("z-index", getHighIndex(".tableDiv"));
               
               var who = $(this).attr('id');
               who = who.replace(/^table_/, '');
               myui.table = who;
            });

            $("div.tableDiv").draggable({
               stack: "div.tableDiv",
               handle: ".headLabel",
               start: function(event, myui) {
                  ui.dragType = 'table';
                  ui.currentTable = ui.dragging = this.id.replace(/table_/, '');
                  $(".shadow").removeClass("shadow");
                  $(this).addClass("shadow");
                  
                  var mytable = $(this).attr('id');
                  if (mytable) myui.table = mytable.replace(/^table_/, '');
                  
               },
               stop: function(event, myui) {
                  // $(this).css('z-index', 1);
                  storeTable($(this).attr("id"));
                  // myui.currentTable = myui.dragging;
                  // myui.dragging = undefined;
               },
               drag: function() {
                  updateRelations($("#canvas"), $("div.tableDiv"));
               }
 
            });

            $("div.linkBtn").draggable({
               stack: "div.tableDiv",
               delay: 100,
               appendTo: "#schemas",
               helper: function() { 
                 var me = $(this).closest(".tableDiv"),
                 clone = me.clone().attr("id", me.attr('id').replace(/table/, 'clone')).addClass('tableDiv clone');
                 me.addClass("dragging");
                 return clone[0];
               },
               handle: ".tableHeading",
               opacity: .35,
               start: function(event, myui) {
                  var me = $(this).closest(".tableDiv");
                  ui.linking = 1;
                  ui.dragType = 'table';
                  $(".focus").removeClass("focus");
                  me.addClass("focus");
                  var who = me.attr("id");
                  
                  myui.table = ui.currentTable = ui.dragging = who.replace(/table_/, '');
               },
               stop: function(event, myui) {
                  $(".clone").removeClass("tableDiv");
                  updateRelations($("#canvas"), $("div.tableDiv"));
                  ui.linking = 0;

                  // $(this).css('z-index', 1);
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
                  var local = $(myui.draggable).closest(".tableDiv").attr('id').replace(/table_/, '');
                  
                  if (!relations) relations = { };
                  if (ui.dragging == ui.dropped) { return false; }
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
            $(".toolbarButton").click(toolbarClick);

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
               $("#importIconPreview").attr("class", "simpleIcon iconPreview icon-"+$(this).attr('title'));
            });

            $(".simpleIcon", "#dbDialog").click(function(e) {
               $(".selectedIcon").removeClass("selectedIcon");
               $(this).addClass("selectedIcon");
               $("#Icon").val($(this).attr('title'));
               $("#iconPreview").attr("class", "simpleIcon iconPreview icon-"+$(this).attr('title'));
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
                  Cancel: function() { $( this ).dialog( "close" ); },
                  "Next": function() {
                     if ($("#newimport").val()!="") {
                        $("#newimportform").submit();
                        $( this ).dialog( "close" );
                     } else {
                        $("#newimport").focus();
                     }
                  }
               }
            });
            
            $("#importTable").change(function() { 
               $("input#rsc").val($(this).val());
            });

            $("#showtables").on('click', '.showcheck', function(evt) {
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

            ui.toggle = {};
            ui.toggle.tables = 0;

            $("#showtableTab").click(function() {
               $("#showtables").toggle('slide', {}, 500);
               $("#showtableTab").animate({"left": ( ui.toggle.tables ? 0 :200 ) }, 500).toggleClass('showtableTabOpen').toggleClass('showtableTabClosed');
               ui.toggle.tables ^= 1;
            });

            $("#delete").click(function() {
               
               return false;
            });

            <?php print $jsup; ?>
            $("#toolbar a[title]").tipsy();            
         });
      </script>
      <script type='text/javascript' src="lib/dbtool.js"> </script>
      <script type='text/javascript' src="/lib/js/apprise-1.5.min.js"> </script>
</html>
