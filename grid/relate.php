   <?php
      if (!$boss) require_once($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');

      $opts = '';
      $mods = $boss->getObject('Module', "Access & {$_SESSION['Access']}");
      foreach ($mods->Module as $mod) {
         if ($mod->ModuleID) {
            $opts .= "<optgroup label='{$mod->Module}'>";
            $procs = $boss->getObject('Process', "ModuleID={$mod->ModuleID} AND Access & {$_SESSION['ProcessAccess']}");
            foreach ($procs->Process as $proc) {
               if ($proc->ProcessID) {
                  $s = (!$proc->Resource) ? ' disabled' : ''; 
                  $opts .= "<option value='{$proc->ProcessID}:{$proc->Resource}'$s>{$proc->Process}</option>\n";
               }
            }
            $opts .= "</optgroup>";
         }
      }
   ?>
   <div id='relateDialog' title='Relate Data' style='display:none'>
      <form id='relateForm' name='relateForm'>
         <div id='relateToolbar'>
            <select name='relateProcs' id='relateProcs'>
               <option>-- Select Relation --</option>
               <?php print $opts; ?>
            </select>
         </div>
         <table id='relateGrid'> </table>
         <div id='relateNav'> </div>
      </form>
   </div>
   <script>
      jQuery(function($) {
         var relateLoaded = false;
         var relateGrid = $("#relateGrid");
         relateGrid.data('config', simpleConfig);
         relateGrid.jqGrid(<?php print $json; ?>);
         $("#relateNav").jqGrid('navGrid','#relateNav', {add:false,del:false,edit:false,refresh:true,search:true,view:false}, {}, {}, {}, {} ); 
         $("#relateProcs").change(function(event) {
            var rproc = $(this).val().split(/:/);
            $.getJSON("/model.php?pid="+rproc[0], function(data, status) {
               data['pager'] = "#relateNav";
               data['multiselect'] = true;
               try { $("#relateGrid").GridUnload("#relateGrid"); } catch(e) { } 
               $("#relateGrid").jqGrid(data);
               $("#relateGrid").jqGrid('navGrid','#relateNav', {add:false,del:false,edit:true,refresh:true,search:true,view:true}, {}, {}, {}, {} ); 
            });
         });
         $("#relateDialog").dialog({
            autoOpen: false,
            height: 400,
            width: 700,
            modal: false,
            buttons: [
               { 
                  text: "Relate Records",
                  click: function() {
                     var picks = $("#relateGrid").jqGrid('getGridParam','selarrrow');
                     var data = [], out = {}, rproc = $("#relateProcs").val().split(/:/), row, rid;
                     if (!picks.length) {
                        out.x = "unclamp";
                        out.rsc = simpleConfig.resource;
                        out.id = simpleConfig.id;
                        out.remote = rproc[1];
                     } else {
                        for (var i in picks) {
                           row = $("#relateGrid").jqGrid('getRowData',picks[i]);
                           rid = row[rproc[1]+'ID'];
                           data[data.length] = { 
                              "Local":simpleConfig.resource, 
                              "LocalID":simpleConfig.id,
                              "Remote":rproc[1],
                              "RemoteID":rid,
                              "ProcessID":rproc[0]
                           };
                           
                           data[data.length] = { 
                              "Remote":simpleConfig.resource, 
                              "RemoteID":simpleConfig.id,
                              "Local":rproc[1],
                              "LocalID":picks[i],
                              "ProcessID":simpleConfig.pid // rproc[0]
                           };
                        }
                        out.data = data;
                        out.x = "clamp";
                        out.id = simpleConfig.id;
                        out.rsc = simpleConfig.resource;
                     }

                     $.ajax({
                        type: "POST",
                        url: "ctl.php",
                        data: out,
                        success: function(msg) {
                           $("body").append(msg);
                        }
                     });
                     $(this).dialog("close");
                  }
               },
               { 
                  text: "Cancel",
                  click: function() {
                     $(this).dialog("close");
                  }
               }
            ],
            close: function() {
               // do closing cleanup here
            }
         });
      });
   </script>
