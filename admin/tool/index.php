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
   
   $model = $boss->getModel($in['pid']);
   $json = preg_replace("/\r?\n/", "\\n", $model->Config);
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Simple Software: <?php print $boss->app->App; ?> Data Tool</title>
      <script type='text/javascript'>
         var simpleConfig = {
            resource:"<?php print $rsc; ?>",
            pid: <? print $in['pid'] ? $in['pid'] : "''"; ?>,
            process: <?php print json_encode($process); ?>, 
            <?php if ($process->Actions) { ?>actions: <?php print $process->Actions; ?>,<?php } ?>
            <?php if ($model->LoginID==$_SESSION['LoginID']) { ?>ModelID: <?php print $model->ModelID; ?>,<?php } ?>
            viewstate: 1,
            action: "new",
            id: null,
            grids: [],
            userEmail: "<?php print $_SESSION['Email']; ?>",
            init: "<?php print ($in['do']) ? $in['do'] : $process->JS; ?>"
         };
      </script>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
      <script type="text/javascript" src="/lib/js/ui.multiselect.js"></script>
      <script type="text/javascript" src="/lib/js/i18n/grid.locale-en.js"></script>
<script>
 jQuery.browser = {};
   (function () {
       jQuery.browser.msie = false;
       jQuery.browser.version = 0;
       if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
           jQuery.browser.msie = true;
           jQuery.browser.version = RegExp.$1;
       }
   })();
</script>
      <script type="text/javascript" src="/lib/js/jquery.jqGrid.min.js"></script>
      <script type="text/javascript" src="/lib/js/json2.js"></script>
      <script type="text/javascript" src="/lib/js/store.js"></script>
      <link href="/lib/css/ui.jqgrid.css" type="text/css" rel="stylesheet" />
      <link href="/lib/css/ui.multiselect.css" type="text/css" rel="stylesheet" />
      <link href="/lib/css/Aristo/jquery-ui-1.8.5.custom.css" type="text/css" rel="stylesheet" />
      <link href="/lib/css/core.css" type="text/css" rel="stylesheet" />
      <link href="/lib/css/print.css" type="text/css" rel="stylesheet" media="print" />
      <link href="<?php print $boss->app->Assets . '/' . $boss->app->CSS; ?>" type="text/css" rel="stylesheet" />
    </head>
   <body>
      <div id='main'>
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
            <form id="simpleForm" name="simpleForm" onsubmit="return false;">
               <input type="hidden" id="cmd" name='x' value='get' />
               <input type="hidden" id="simpleID" name='ID' value='' />
               <input type="hidden" id="pid" name='pid' value='<?php print $in['pid']; ?>' />
               <?php $boss->showForm($process); ?>
            </form>
            <div id='relatedWrap' title='Related Data' style='clear:left;'>
               <!--<h3>Related Information</h3>-->
               <div id='relatedData'>
                  <table id='relatedGrid'> </table>
                  <div id='relatedNav'> </div>
               </div>
            </div>
         </div>
         <iframe name='exportFrame' id='exportFrame' style='position:absolute;left:-2000px;width:100px;height:100px;top:-2000px;' src='/blank.html'></iframe>
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
      </div>
   </body>
   <script type='text/javascript'>
      jQuery.extend($.fn.fmatter , {
         time: function(cellvalue, options, rowdata) {
            if (cellvalue) {
               var parts = cellvalue.replace(/^0/,'').split(/:/);
               var xm = 'am';
               if (parts[0]>12) {
                  xm = 'pm';
                  parts[0] = parts[0] - 12;
               } else if (parts[0] == 0) {
                  parts[0] = 12;
                  xm = 'am';
               }
               return parts[0] + ':' + parts[1] + ' ' + xm;
            } else {
               return cellvalue;
            }
         }
      });
      jQuery.extend($.fn.fmatter.time, {
            unformat : function(cellvalue, options) {
               if (cellvalue) {
                  var  out = '', 
                  parts = cellvalue.split(/[:\s]/);

                  if (cellvalue.match(/pm/)) parts[0] = parseInt(parts[0]) + 12;
                  if (parts[0] < 10) parts[0] = '0' + parts[0];
                  if (parts[1] < 10) parts[1] = '0' + parts[1]; 
                  
                  out = parts[0] + ':' + parts[1];

                  if (parts.length > 3) {
                     if (parts[2] < 10) parts[2] = '0' + parts[2];
                     out += ':' + parts[2]; 
                  }
                  return out;
               } else {
                  return cellvalue;
               }
            }
         });
         // var model = <?php print $json; ?>;
      jQuery(function($) {
         $.extend(jQuery.jgrid.defaults, { altRows:true, forceFit:true });
         var grid = $("#mygrid");
         <?php if ($json) { ?>
         var model = <?php print $json; ?>;
         <?php } ?>
         grid.data('config', simpleConfig);
         grid.jqGrid(model);
         grid.jqGrid('navGrid','#<?php print $process->Resource; ?>Nav', {add:false,del:false,edit:false,refresh:true,search:true,view:false}, {}, {}, {}, {} ); 
         grid.jqGrid('filterToolbar', { stringResult: false, searchOnEnter: false, groupOp: 'AND' });

         $("input.date").datepicker({dateFormat: 'yy-mm-dd' });
         $("form#simpleForm input[type=text]").bind('keyup', function(e) { if ((e.keyCode==13) || (((e.ctrlKey || e.metaKey) && e.keyCode==83)))  { doSave(); return false; } });
         $("form#simpleForm").bind('keyup', function(e) { if ((e.ctrlKey || e.metaKey) && e.keyCode==83) return doSave(); });
         <?php
            if ($in['rsc'] && $in['id']) {
               print "setTimeout(function() { doSelect(".$boss->_quote($in['id'])."); }, 1000); \n";
            }
         ?>
         if ($("#mygrid_Description").length) {
            var descHTML = $("#mygrid_Description").html();
            $("#mygrid_Description").html('<span class="ui-jqgrid-resize ui-jqgrid-resize-ltr" style="cursor: col-resize;">&nbsp;</span>'+descHTML);
         }

      });
   </script>
   <script type="text/javascript" src="/lib/js/grid.js"></script>
</html>
