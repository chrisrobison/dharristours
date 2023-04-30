<?php
   include_once($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');

   if ($in['pid'] || $in['ProcessID']) {
      $in['pid'] = ($in['pid'])?$in['pid']:($in['ProcessID']?$in['ProcessID']:0);
      if ($in['pid']) $process = $boss->getObject("Process", $in['pid']);
      if (!$in['rsc'] && $process->Resource) $in['rsc'] = $process->Resource;
      if (!((int)$_SESSION['ProcessAccess'] & (int)$process->Access)) {
         include($boss->getPath("templates/noaccess.php"));
         exit;
      }
   }
   
   $rsc = $in['rsc'] = ($in['rsc']) ? $in['rsc'] : 'Bug';
   if (!$rsc) {
      $rsc = $in['rsc'] = $process->Resource;
   }

   $id = $in['id'];

   if ($id) {
      $record = $boss->getObject($rsc, $id);
   }

   $model = $boss->getModel($in['pid']);
   $json = preg_replace("/\r?\n/", "\\n", $model->Config);
?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="X-UA-Compatible" content="chrome=1">
      <title>Simple Software: <?php print $boss->app->App; ?> Data Tool</title>
      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
      <script type="text/javascript" src="/lib/js/ui.multiselect.js"></script>
      <script type="text/javascript" src="/lib/js/i18n/grid.locale-en.js"></script>
      <script type="text/javascript" src="/lib/js/jquery.jqGrid.min.js"></script>
      <script type="text/javascript" src="/lib/js/jquery.printElement.min.js"></script>
      <script type="text/javascript" src="/lib/js/json2.js"></script>
      <script type="text/javascript" src="/lib/js/store.js"></script>
      <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet" type="text/css">
      <link href="/lib/css/ui.jqgrid.css" type="text/css" rel="stylesheet" />
      <link href="/lib/css/ui.multiselect.css" type="text/css" rel="stylesheet" />
      <link href="/lib/css/Aristo/jquery-ui-1.8.5.custom.css" type="text/css" rel="stylesheet" />
      <link href="/lib/css/core.css?ver=4.02" type="text/css" rel="stylesheet" />
      <link href="/lib/css/print.css" type="text/css" rel="stylesheet" media="print" />
      <link href="<?php print $boss->app->Assets . '/' . $boss->app->CSS; ?>" type="text/css" rel="stylesheet" />
    </head>
   <body>
      <!--[if IE]>
       <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js"></script>
       <style>
        .chromeFrameInstallDefaultStyle {
          margin-top:-250px;
          border: 5px solid black;
        }
       </style>
       <div id="prompt">
         <h1>This application requires installation of the Google chrome frame plugin.</h1>
        <!-- if IE without GCF, prompt goes here -->
       </div>
       <script>
        // The conditional ensures that this code will only execute in IE,
        // Therefore we can use the IE-specific attachEvent without worry
        if (window['attachEvent']) {
           window.attachEvent("onload", function() {
              CFInstall.check({
                 mode: "inline", // the default
                 node: "prompt"
              });
           });
        }
       </script>
     <![endif]-->
     <div id='main' class='grid'>
        <div class='modal-overlay' id='modal-busy'>
           <div class="ball"></div>
           <div class="ball1"></div>
        </div>
         <?php 
            if (!$process->NoTable) {
         ?>
         <table id="mygrid"></table>
         <div id="<?php print $process->Resource; ?>Nav"></div>
         <?php 
            } 
            include($boss->getPath("templates/toolbar.php")); 
         ?>
         <div id='formContainer'<?php if (!$process->NoTable) print " style='display:none'"; ?>>
            <div id='loading'>
               <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            </div>
            <form id="simpleForm" name="simpleForm" method="POST" autocomplete="on">
               <input type="hidden" id="cmd" name="x" value="get" />
               <input type="hidden" id="simpleID"name='ID' value='' />
               <input type="hidden" id="pid" name='pid' value='<?php print $in['pid']; ?>' />
               <input type="hidden" id="LastModifiedBy" rel='data' name='<?php print $rsc; ?>[][LastModifiedBy]' value='<?php print $_SESSION['Email'] . "|" . $_SERVER['REMOTE_ADDR'] ; ?>' />
               <?php 
                  /*
                     TODO: NoSearch is being re-used here as NoForm in the Process tables.  
                     Need to update to NoForm across all Process tables at some point
                   */
                  if (!$process->NoSearch) {
                     $boss->showForm($process); 
                  }
               ?>
            </form>
            <div id='showRelatedTab' title='Show/Hide Related Data' class='showRelatedTabClosed'></div>
            <div id='showRelated' class='showRelated'>
               <table id='relatedGrid'> </table>
               <div id='relatedNav'> </div>
            </div>
         </div>
         <iframe name='uploadFrame' id='uploadFrame' class='hiddenFrame' src='/blank.html'></iframe>
         <iframe name='exportFrame' id='exportFrame' class='hiddenFrame' src='/blank.html'></iframe>
         <form id='sendform' name='sendform' target='exportWin' method='POST' action='ctl.php'>
            <input type="hidden" id="send_X" name='x' value='export' />
            <input type="hidden" id="send_pid" name='pid' value='<?php print $in['pid']; ?>' />
            <input type="hidden" id="send_rsc" name='rsc' value='<?php print $rsc; ?>' />
            <input type="hidden" id="send_data" name='data' value='' />
         </form>
         <?php 
            if ($process->ShowRelated==1) include("relate.php");
            include("import.php");
         ?>
         <div id='mapWrap' style='display:none;'>
            <iframe id='map' name='map' height='100%' width='100%'></iframe>
         </div>
      </div>
   </body>
   <script type='text/javascript'>
      $(function($) {
         $.extend(jQuery.jgrid.defaults, { altRows:true, forceFit:true });
         var grid = $("#mygrid");
         <?php if ($json) { ?>
         var model = <?php print $json; ?>;
         model.scrollrows = true;
//	 model.search = true;
         <?php } ?>
         grid.data('config', simpleConfig);
         grid.jqGrid(model);
         grid.jqGrid('navGrid','#<?php print $process->Resource; ?>Nav', {add:false,del:false,edit:false,refresh:true,search:true,view:false}, {}, {}, {}, {} ); 
         grid.jqGrid('filterToolbar', { stringResult: false, searchOnEnter: false, groupOp: 'AND' });
         // grid.jqGrid('searchGrid', { multipleSearch: true,  multipleGroup:true, showQuery: true });
         
         var gridH = store.get("gridHeight");
         if (!gridH) gridH = 200;
         console.log("Grid Height: " + gridH);
         grid.setGridHeight(gridH - 25);

         // setup grid print capability. Add print button to navigation bar and bind to click.
         setPrintGrid('mygrid', '<?php print $process->Resource; ?>Nav','<?php print $process->Process; ?>');
         
         // Set dateformat returned by jquery datepicker
         $("input.date").datepicker({dateFormat: 'yy-mm-dd' });

         // bind press of enter key on form text boxes to call doSave()
         $("form#simpleForm input[type=text]").bind('keyup', function(e) { if ((e.keyCode==13) || (((e.ctrlKey || e.metaKey) && e.keyCode==83)))  { doSave(); return false; } });
         // Bind ctrl-enter on textareas 
         $("form#simpleForm").bind('keyup', function(e) { if ((e.ctrlKey || e.metaKey) && e.keyCode==83) return doSave(); });
         <?php
            if ($in['rsc'] && $in['id']) {
               print "setTimeout(function() { selectRow(" . $boss->q( $in['id'] ) . "); $('#mygrid').setSelection({$in['id']}); }, 2000);\n";
            }
         ?>
         if ($("#mygrid_Description").length) {
            var descHTML = $("#mygrid_Description").html();
            $("#mygrid_Description").html('<span class="ui-jqgrid-resize ui-jqgrid-resize-ltr" style="cursor: col-resize;">&nbsp;</span>'+descHTML);
         }
         var customButtons = $("#customButtons");
         if (customButtons.length) {
            customButtons.appendTo($("#toolbar"));
         }
         
         $("#mapWrap").dialog({
            autoOpen: false,
            height: 500,
            width: 800,
            position: 'center'
         });
         
         if (typeof ui !== 'object') ui = {};
         if (typeof ui.toggle !== 'object') ui.toggle = {};
         ui.toggle.showRelated = 0;
         
         $("#showRelatedTab").click(function() {
            $("#showRelated").show().css("overflow","hidden").animate({ width: (ui.toggle.showRelated ? "0px" : "235px") }, 500, function() { $("#showRelated").css('overflow', 'visible'); });
            $("#showRelatedTab").animate({"right":(ui.toggle.showRelated ? "0px" : "235px" ) }, 500).toggleClass('showRelatedTabOpen').toggleClass('showRelatedTabClosed');
            ui.toggle.showRelated ^= 1;
         });

         $(".ui-jqgrid-titlebar").css("display", "none");

         $("#GridResetButton").click(function() { toggleGrid(); });
         toggleGrid('<?php print $process->NoSearch; ?>');
      });   
   </script>
   <script type="text/javascript" src="/lib/js/grid.js?ver=4.08"></script>
   <script type='text/javascript'>
      var simpleConfig = {
         resource:"<?php print $in['rsc']; ?>",
         pid: <?php print $in['pid'] ? $in['pid'] : "''"; ?>,
         process: <?php print json_encode($process); ?>,
         record: { "<?=$rsc?>ID": "new1" },
         <?php if ($process->Actions) { ?>actions: <?php print $process->Actions; ?>,<?php } ?>
         <?php if ($model->LoginID==$_SESSION['LoginID']) { ?>ModelID: <?php print $model->ModelID; ?>,<?php } ?>
         viewstate: 1,
         gridstate: 0,
         action: "new",
         id: null,
         grids: [],
         userEmail: "<?php print $_SESSION['Email']; ?>",
         init: "<?php print ($in['do']) ? $in['do'] : $process->JS; ?>"
      };
      toggleSearch();
   </script>
</html>
