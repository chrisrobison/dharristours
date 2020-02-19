Storage.prototype.setObject = function(key, value) { this.setItem(key, JSON.stringify(value)); }
Storage.prototype.getObject = function(key) { return this.getItem(key) && JSON.parse(this.getItem(key)); }
var grid, store;

$(document).ready(function($) {
   // Attach handlers to action buttons
   var actions = {
      "New":         function() {return doNew();},
      "Copy":        function() {$("#ActionsMenu").slideUp(100);return doCopy();},
      "Save":        function() {return doSave();},
      "Relate":      function() {return doRelate();},
      "Delete":      function() {return doRemove();},
      "Print":       function() {return doPrint();},
      "PrintGrid":   function() {return doPrintGrid();},
      "Columns":     function() {return doColumns();},
      "Export":      function() {return doExport();},
      "ExportGrid":  function() {return doExportGrid();},
      "Import":      function() {return doImport();},
      "Search":      function() {return doSearch();},
      "Help":        function() {return doHelp();},
      "ToggleSearch":function() {return toggleSearch();},
      "GridExport":  function() {return saveLayout();},
      "ResetLayout":  function() {return resetLayout();},
      "ClearStorage":  function() {return clearStorage();}
   };
   
   $("#ActionsButton").click(function() { $("#ToolsMenu").slideUp(100); $("#ActionsMenu").slideToggle(100); });
   $("#ToolsButton").click(function() { $("#ActionsMenu").slideUp(100); $("#ToolsMenu").slideToggle(100); });
   $("document").keydown(function(e) { 
   });

   for (var a in actions) {
      $("#"+a+"Button").click(function(event) { 
         $(".menu").slideUp(100); 
         var bid = $(this).attr('id').replace(/Button/i,'');
         if (simpleConfig.actions && simpleConfig.actions[bid]) simpleConfig.actions[bid](event); 
         return actions[bid](event); 
      }); 
      $("#menu"+a).click(function(event) { 
         $(".menu").slideUp(100); 
         var bid = $(this).attr('id').replace(/menu/i,'');
         if (simpleConfig.actions && simpleConfig.actions[bid]) simpleConfig.actions[bid](event); 
         return actions[bid](event); 
      });
   }

   grid = $("#mygrid");

   if (grid) {
      grid.jqGrid('setGridParam', {   
            onSelectRow: function(id) { 
               $("#customButtons .disabled").removeClass("disabled");
               selectRow(id); 
            },
            ondblClickRow: function(rowid) { debugger;var rowid = $("#grid").getGridParam('selrow'); $(this).jqGrid('editGridRow', rowid); },
            resizeStop: function(width, idx) { },
            gridComplete: function() { $("#mygrid").setGridWidth($("body").width() - 2 ); }
      });
      grid.gridResize();
      grid.setGridHeight(parseInt($("#main").height()) / 4);
      
      $(".HeaderButton").click(function() {gridDisplay($('#mygrid'), 'toggle'); });
      $(".RelatedButton").click(function() {gridDisplay($('#showRelated'), 'toggle'); });
      window.onresize = function() { doLayout('open'); };
      $("window").resize(function() { doLayout('open'); });
      setTimeout(function() { $("#mygrid").setGridWidth($("body").width() - 2); }, 1000);
      $("#gbox_mygrid").resizable({ handles: 'n, s' });
      
      doLayout();
   }
   
   if (simpleConfig.init) {
      if (actions[simpleConfig.init]) {
         actions[simpleConfig.init]();
      }
   }

   if (localStorage[simpleConfig.resource + simpleConfig.pid]) {
      colConf = JSON.parse(localStorage[simpleConfig.resource + simpleConfig.pid]);
      
      if (colConf['config']) {
         $("#mygrid").jqGrid({gridComplete: function() {
            $("#mygrid").jqGrid.GridUnload();
            $("#mygrid").jqGrid.jqGridImport({"imptype":"jsonstring", "impstring": colConf['config']});
         }});
      }
      if (colConf['columnOrder']) {
         grid.jqGrid("remapColumns", colConf['columnOrder'], true);
      }

      if (colConf['columnDisplay']) {
         for (var i in colConf['columnDisplay']) {
            grid.jqGrid(colConf['columnDisplay'][i] + 'Col', i);
         }
      }
   }
   
   if (store) {
      simpleConfig.searchToolbar = store.get("searchToggle");
      if (simpleConfig.searchToolbar) {
         toggleSearch();
      }
   }
   $("#showRelated").on("click", "h3", function() { $(this).toggleClass('open'); });
   $("form#simpleForm").on("change", ":input", function(e) { doModify($(this)); });

   $("#gview_mygrid table thead tr").on("mouseup", ".ui-jqgrid-resize", function(i) {
      saveLayout();
   });
   if ($("#mygrid").length) {
      $("#mygrid")[0].toggleToolbar();
   }
   $("body").keyup(function(e) {
      if (e.keyCode == 27) {
         $(".menu").slideUp(100);
      }
   });
 });

function keys(obj) {
   var key, out = [];

   for (key in obj) {
      if (obj.hasOwnProperty(key)) {
         out[out.length] = key;
      }
   }
   return out;
}

function cleanObj(obj, arr) {
   var t, i, newobj = (arr) ? [] : {};
   for ( i in obj ) {
      if ((obj[i] != null) && (obj[i] != undefined)) {
         t = getType( obj[i] );

         if (t != "function") {
            switch (t) {
               case "array":
                  if ( obj[i].length ) {
                     newobj[i] = cleanObj(obj[i], true);
                  }
                  break;
               case "object":
                  if ( ( obj.hasOwnProperty(i)) && !$.isEmptyObject( obj[i] ) ) {
                     newobj[i] = cleanObj(obj[i]);
                  }
                  break;
               default:
                  newobj[i] = obj[i];
            } 
         }
      }
   }
   return newobj;
}

function getType(obj) {
   if ($.isArray(obj)) {
      return "array";
   } else {
      return typeof obj;
   }
}

function cleanObject(obj) {
   var t = getType(obj), key, out, cnt;
   
   if (t != "function") {
      switch (t) {
         case "array":
            out = [];
            cnt = obj.length;
            for (key=0; key<cnt; key++) {
               
            }
            break;
         case "object":
            out = { };
            for (key in obj) {
               if (obj[key]) {
                  var tmpType = getType(obj[key]);
                  if (tmpType=="array" || tmpType=="object") {
                     out[key] = cleanObject(obj[key]);
                  } else {
                     out[key] = obj[key];
                  }
               }
            }

            break;
         default:
            out = obj;
      }
   }

   return out;
}

function saveLayout(grid) {
   grid = grid ? grid : "#mygrid";
   var config = cleanObj($(grid)[0].p), newconfig;
   // var config = exportConfig(grid);
   
   newconfig = {
      cmTemplate: config.cmTemplate,
      colNames: config.colNames,
      colModel: config.colModel,
      jsonReader: config.jsonReader,
      rowList: config.rowList,
      caption: config.caption,
      datatype: config.datatype,
      url: config.url,
      editurl: config.editurl,
      remapColumns: config.remapColumns,
      sortorder: config.sortorder,
      sortname: config.sortname,
      rowNum: config.rowNum,
      autowidth: config.autowidth,
      resizable: config.resizable,
      shrinkToFit: config.shrinkToFit,
      viewrecords: config.viewrecords,
      gridview: config.gridview,
      altRows: config.altRows,
      pager: config.pager
   };

   localStorage.setItem(simpleConfig.resource + simpleConfig.pid, JSON.stringify(newconfig));
   
   postData("ctl.php", {"x":"storeConfig", "data":{"config": JSON.stringify(newconfig)}, "mid": simpleConfig.ModelID, "pid": simpleConfig.pid, "rsc": simpleConfig.resource});
}

function clearStorage() {
   if (confirm("Are you sure you want to permanently remove ALL locally stored settings and data?")) {
      localStorage.clear(); 
      top.updateStatus("All localStorage data has been permanently.");
   }
}

function exportConfig(grid) {
   var config = $(grid).jqGridExport({"exptype":"jsonstring", "ident":"   "});
   return cleanObj(config);
}

function resetLayout() {
   localStorage.removeItem(simpleConfig.resource + simpleConfig.pid);
   postData("ctl.php", {"x":"resetConfig", "pid": simpleConfig.pid, "mid": simpleConfig.ModelID });
}

function selectRow(id) {
   simpleConfig.current = $("#mygrid").jqGrid('getRowData',id);
   simpleConfig.rowid = id;

   if (!simpleConfig.modified || (simpleConfig.modified && confirm("There are changes that have *NOT* been saved!\nClick OK to discard your modifications   -or-\nClick Cancel to go back and Save your changes."))) {
      
      simpleConfig.record = $("#mygrid").jqGrid('getRowData',id);
      simpleConfig.id = simpleConfig.record[simpleConfig.resource+'ID'];
      simpleConfig.action = 'update';
      simpleConfig.modified = false;
      
      if (simpleConfig && simpleConfig.actions && simpleConfig.actions['Select']) {
         simpleConfig.actions['Select'](id);
      }

      doSelect(id); 
   } 
}

function updateForm(frm, id, data) {
   $(".formHeading").text(simpleConfig.resource + ' ID: ' + simpleConfig.id);
}

function toggleSearch() {
   $("#mygrid")[0].toggleToolbar();
   simpleConfig.searchToolbar = (simpleConfig.searchToolbar) ? 0 : 1;
   if (store) store.set("searchToggle", simpleConfig.searchToolbar);
}

function fillForm(frm, id, data, retChildren) {
   $(".formHeading").text(simpleConfig.resource + ' ID: ' + simpleConfig.id);
   $("#simpleID").val(id);
   $("#simpleID").attr('name', $("#simpleID").attr('name').replace(/\[.*?\]/, "["+id+"]"));
   var $tmpel, related = { };
   for (var key in data) {
      if (data.hasOwnProperty(key)) {
         if (retChildren && ((typeof(data[key]) === "array") || (typeof(data[key]) === "object"))) {
            if (typeof(data[key]) === "string") data[key] = data[key].replace(/\\n/g, "\n");
            related[key] = data[key];
         } else {
            $tmpel = $("#"+key, frm);
            if ($tmpel.length) {
               $tmpel.val(data[key]);
               try {
                  $tmpel.attr("name", $tmpel.attr('name').replace(/\[.*?\]/, "["+id+"]"));
               } catch (e) { }
            }
         }
      }
   }
   return (retChildren) ? related : true;
}

function loadRecord(rsc, id, callback) {
   $.getJSON("ctl.php", {"x":"related", "rsc":rsc, "id":id}, function(data) {
      var $tmpel, related = {};
      simpleConfig.current = data;
      for (var key in data) {

         if (data.hasOwnProperty(key)) {
            if ((data[key]!==null) && ((typeof(data[key]) === "array") || (typeof(data[key]) === "object"))) {
               related[key] = data[key];
            } else {
               $tmpel = undefined;
               $tmpel = $("#"+key);
               if ($tmpel.length) {
                  if (($tmpel[0].nodeName === "SELECT") || ($tmpel[0].nodeName === "INPUT") || ($tmpel[0].nodeName==="TEXTAREA")){
                     if (typeof(data[key]) === "string") data[key] = data[key].replace(/\\n/g, "\n");
                     $tmpel.val(data[key]);
                     $tmpel.attr("name", $tmpel.attr('name').replace(/\[.*?\]/, "["+id+"]"));
                     // $tmpel.unbind('change'); $tmpel.bind('change', function() { doModify($(this)); });
                     var rel = $tmpel.attr("id");
                     if (rel) {
                        $(rel + "_display").html(data[key]);
                     }
                  } else if ($tmpel[0].nodeName === "IMG") {
                     $tmpel.attr("src", data[key]); 
                  } else {
                     $tmpel.html(data[key]);
                  }
               }
            }
         }
      }
      // simpleConfig.process.useGrid = 1;
      if (simpleConfig && simpleConfig.process && simpleConfig.process.ShowRelated==="1") {
         if (simpleConfig && simpleConfig.process && simpleConfig.process.useGrid) {
            $("#showRelated").html("");
            doClamped(rsc, id);
         } else {
            $("#showRelated").html(buildRelated(related));
         }
      } else {
         $("#showRelated").hide();
      }
      $("#formContainer").scrollTop(0);

      if (callback && typeof callback == "function") {
         callback.apply(this, [id]);
      }
   });
}

function updateRelated(remote, pid, ids) {
   var rname = remote + pid, rgrid = $("#"+rname+"Grid");
   if (!rgrid.length) {
      $("#showRelated").append("<table id='"+rname+"Grid'></table><div id='"+rname+"Nav'><div id='"+rname+"colch'></div></div>");
      rgrid = $("#"+rname+"Grid");
   }
   $.getJSON("/model.php?pid="+pid, function(data, result) {
      data['pager'] = "#"+rname+"Nav";
      data['hiddengrid'] = true;
      data['url'] += "&ids="+ids.join(",");
      data['editurl'] += "&ids="+ids.join(",")+'&';
      try { $("#"+rname+"Grid").GridUnload("#"+rname+"Grid"); } catch(e) { } 
      rgrid.jqGrid(data);
      rgrid.jqGrid('navGrid','#'+rname+'Nav', {add:false,del:false,edit:false,refresh:true,search:false,view:true}, {}, {}, {}, {} ); 
      rgrid.jqGrid('navButtonAdd','#'+rname+'Nav',
         { 
            caption: "Columns", 
            title: "Reorder Columns", 
            onClickButton : function (){ 
               $("#"+rname+"Grid").jqGrid('columnChooser', 
                  {  
                     left:300, 
                     top:100,
                     done:function(cols) {
                     var sel = [], unsel = [], all = {}, colMap = {}, 
                         colModel = this.jqGrid("getGridParam", "colModel"), 
                         colNames = this.jqGrid("getGridParam", "colNames");

                     var opts = $("option", $("#colchooser_"+rname+'Grid')).each(function(i) {
                        if (this.selected) {
                           all[colModel[this.value].name] = 'show';
                           sel[sel.length] = colModel[this.value].name;
                           colMap[colModel[this.value].name] = i;
                        } else {
                           unsel[unsel.length] = colModel[this.value].name;
                           all[colModel[this.value].name] = 'hide';
                        }

                     });
                     
                     var colConf = { "columnOrder": cols, "columnDisplay": all };
                     localStorage.setItem(remote + pid, JSON.stringify(colConf));
                     //  localStorage.setItem(remote + pid, JSON.stringify(all));

                     if (cols)  {
                         this.jqGrid("remapColumns", cols, true);
                         this.setGridWidth($("body").width());
                     }
                  }
               }); 
            } 
         }
      );
      rgrid.jqGrid('gridResize',{minWidth:350,maxWidth:3000,minHeight:80, maxHeight:500});
      
      if (localStorage[remote + pid]) {
         var colConf = JSON.parse(localStorage[remote + pid]),
             cols = colConf['columnDisplay'];
         if (cols) {
            for (var i in cols) { rgrid.jqGrid(cols[i]+'Col', i); }
         }
      }

   });
}

function doClamped(local, id) {
   $.getJSON("/grid/ctl.php?x=clamped&local="+encodeURIComponent(local)+"&id="+id, function(data) {
      var arr = data['Clamp'], clamped = {}, tmp, key;
      
      if (arr && arr['_ids'] && arr['_ids'].length) {
         for (var i=0; i<arr['_ids'].length; i++) {
            key = arr[i].Remote+'::'+arr[i].ProcessID;
            if (!clamped[key]) clamped[key] = [];
            clamped[key][clamped[key].length] = arr[i].RemoteID;
         }
         for (var i in clamped) {
            if (clamped.hasOwnProperty(i)) {
               tmp = i.split(/::/);
               updateRelated(tmp[0], tmp[1], clamped[i]);
            }
         }
      }
   });
}

function buildRelated(related, pid) {
   var relout = "", rout='', hout='', cout='', rfields=[], cid;
   for (var rel in related) {
      if (!rel.match(/^_clamped/)) {
         rout = rel.replace(/^related_/, '');
         hout = cout = ''; 
         if (related[rel] && related[rel].length && related[rel][0]) {
            relout += "<h3>"+rout+"</h3><table cellpadding='0' cellspacing='0' border='0' class='related' id='"+rel+"Grid'>";
            rfields = []; 
            for (var i in related[rel][0]) {
               if (!i.match(/^(Created|CreatedBy|LastModified|LastModifiedBy|Notes)$/)) {
                  if (rfields.length < 2) rfields[rfields.length] = i;
               }
            }
            
            //for (var fld in related[rel][0]) {
            for (var f in rfields) {
               cid = rel+':'+rfields[f]+'Column';
               cout += "<col class='relatedColumner' id='"+cid+"'/>";
               // hout += "<th id='header_"+rfields[f]+"' onclick='$(\"#"+cid+"\").toggle()'>"+rfields[f].replace(/([a-z])([A-Z])/g, "$1 $2")+"</th>";
            }
            cout += "<col class='relatedColumner unlinkColumn' id='"+rel+"UnlinkColumn'/>";
            // if (parseInt(simpleConfig.process.Buttons) & 64) hout += "<th id='header_"+rel+"_unrelate'>Unlink</th>";

            relout += "<colgroup>" + cout + "<col /></colgroup>";
            // relout += "<thead><tr>" + hout + "<th></th></tr></thead>";
            relout += "<tbody>";
            var rid, fld, tbl, myclass;
            tbl = rel.replace(/^related_/,'');
            for (var x in related[rel]) {
               if (related[rel][x] != null) {
                  relout += "<tr>";
                  
                  for (var f in rfields) {
                     fld = rfields[f];
                     myclass = '';
                     if (fld == tbl+'ID') {
                        rid = related[rel][x][fld];
                        myclass = " class='referenceID'";
                     }
                     if ((related[rel][x][fld] == "null") || (related[rel][x][fld]==null) || (related[rel][x][fld]==undefined))  related[rel][x][fld] = '';
                     relout += "<td"+myclass+"><a href='#' onclick='return top.loadUrl(\"/grid/?pid=" + related[rel][x]['_pid'] + "&id=" + rid + "\",\"" + tbl + "\")'>"+related[rel][x][fld]+"</a></td>";
                  }

                  if (parseInt(simpleConfig.process.Buttons) & 64) {
                     relout += "<td class='rmRelate'>";
                     relout += "<a href='#' title='Delete Relationship' onclick='$(this).parent().parent().hide();unclamp(\"" + 
                        simpleConfig.resource + "\",\"" + 
                        simpleConfig.id + "\",\"" + 
                        tbl + "\",\"" + 
                        rid + "\")'><img width='16' height='16' class='rmIcon' alt='Delete Relationship' src='/img/delete.png' border='0'/></a></td>";
                     relout += "</tr>";
                  }
               }
            }
            relout += "</tbody></table>";
         }
      }
   }
   return relout;
}

function disableSave() {
   $("#SaveButton").addClass('disabled');
}

function doModify(who) {
   if (parseInt(simpleConfig.process.Buttons) & 2) {
      var key = who.attr("id");
      
      if (!simpleConfig.record) simpleConfig.record = {};
      
      simpleConfig.record[key] = who.val();
      
      $(".disabled").removeClass('disabled');
      
      if (who) {
         if (who[0].nodeName != "SELECT") {
            who.addClass("modified");
         }
      }
      if (!simpleConfig.modified) {
         simpleConfig.modified = true;
         simpleBounce('#SaveButton');
         $("#SaveButton").addClass('modified');
      }
      if (simpleConfig.action != 'new') { 
         var colname = who.attr('id'); // .replace(/([a-z])([A-Z])/, "$1 $2");
         $('#mygrid').setCell(simpleConfig.rowid, colname, who.val(), 'modified'); 
      }
   }
}

function doSelect(id, callback) {
   simpleConfig.record = $("#mygrid").jqGrid('getRowData', id);
   simpleConfig.id = simpleConfig.record[simpleConfig.resource+'ID'];
   simpleConfig.action = 'update';
   simpleConfig.modified = false;
   
   var ret = simpleConfig.record;

   $(".formHeading").text(simpleConfig.resource + ' ID: ' + simpleConfig.id);
   $("#simpleID").val(simpleConfig.id);
   $("#simpleID").attr('name', simpleConfig.resource+'['+simpleConfig.id+']['+simpleConfig.resource+'ID]');
   $("#cmd").val("save");
   $("#formContainer").show();
   loadRecord(simpleConfig.resource, simpleConfig.id, callback);
   $("a.simpleButton", $("#toolbar")).show();
   
   $(".changed").removeClass("changed");
   $(".modified").removeClass("modified");

   if (parseInt(simpleConfig.process.Buttons) & 2) {
      $("#SaveButton").show();
   } else {
      $("#SaveButton").hide();
   }

   if (callback && typeof callback == "function") {
      callback.apply(this, [ id ]);
   }
}

function doNew() {
   simpleConfig.id = 'new1';
   simpleConfig.action = 'new';
   $("#cmd").val("new");
   $("#simpleID").val('new1');
   $("#simpleID").attr('name', simpleConfig.resource+'[new1]['+simpleConfig.resource+'ID]');
   $(".formHeading").text(simpleConfig.resource + ' ID: [New Entry]');
   $("a.simpleButton", $("#toolbar")).show(100);
   $("#formContainer").show(100);
   // var allInputs = $(':input:not(input[type=hidden])', "#simpleForm"), newname;
   var allInputs = $(':input', "#simpleForm"), newname;
   var def,typ,rel;
   allInputs.each(function(idx) {
      typ = $(this).attr('type');
      rel = $(this).attr('rel');
      def = ($(this).attr('default')) ? $(this).attr('default') : '';
      if ((rel=="data") || ((rel!="data") && (typ!='hidden'))) {
         $(this).val(def);
         newname = $(this).attr('name') || $(this).attr('id');
         if (newname) newname = newname.replace(/\[.*?\]/, "[new1]");
         $(this).attr('name', newname);
         // $(this).unbind('change'); $(this).bind('change', function() { doModify(); });
      }
   });
   $("input.focus:last").focus();
   $("#formContainer").scrollTop(0);
   return false;
}

function gridDisplay(mygrid, state) {
   var mainH = $("#main")[0].offsetHeight;
   var toolH = $("#toolbar")[0].offsetHeight;
   var relatedH = $("#relatedWrap")[0].offsetHeight;
   var gridH, sw;
   if (state=='toggle') {
      sw = $("#mygrid").data("viewstate");
      state = (sw ^ 1) ? "closed" : "open";
      $("#mygrid").data("viewstate", (sw^1))
   }
   if (state == 'closed') {
      gridH = $(".ui-jqgrid-titlebar")[0].offsetHeight;
   } else {
      if (simpleConfig.mygridH) {
//            gridH = simpleConfig.mygridH;
      } else {
      }
      gridH = Math.round(mainH / 2.5) - toolH;
   }
   //$("#gbox_mygrid").height(gridH);
   //$("#mygrid").setGridHeight(gridH - 60);
   var formH = mainH - (gridH + toolH);
   $("#formContainer").height(formH);

}

function doLayout(state) {
   var gridH, sw, formH, tool, main, mainH, toolH;
   tool = $("#toolbar"); main = $("#main");
   if (main.length) mainH = main[0].offsetHeight;
   if (tool.length) toolH = tool[0].offsetHeight;
   if (state=='toggle') {
      sw = $("#mygrid").data("viewstate");
      state = (sw ^ 1) ? "closed" : "open";
      $("#mygrid").data("viewstate", (sw^1))
   }
   if (state == 'closed') {
      gridH = $(".ui-jqgrid-titlebar")[0].offsetHeight;
   } else {
      gridH = $("#gbox_mygrid").height();
   }
   formH = mainH - (gridH + toolH);
   $("#formContainer").height(formH);
   $("#mygrid").setGridWidth($("body").width() - 2);
}

function flagEmail(msgType) {
   var curval = $("#sendEmail").val();
   if (!curval) $("#sendEmail").val(msgType);
}

function addDate(who) {
   var d = new Date();
   who.value += "-- Updated by " + simpleConfig.userEmail + " on " + (d.getMonth() + 1) + '/' + d.getDate() + '/' + d.getFullYear() + ' at ' + d.toLocaleTimeString() + "\n";
}

function doSave() {
   if (!simpleConfig.modified) {
      return false;
   }

   if ((parseInt(simpleConfig.process.Buttons) & 2) || (simpleConfig.action==='new')) {
      $(".changed").removeClass("changed");
      $(".modified").removeClass("modified");
      // $("#cmd").val("save");
      var notes = $("#Notes");
      if (notes.length) addDate(notes[0]);
      
      var newname, 
          allInputs = $(':input', "#simpleForm"), 
          sid = $("#simpleID").val();
      
      simpleConfig.modified = false;
      simpleConfig.id = sid;
      
      if ($("#cmd").val() != 'new') {
         simpleConfig.action = 'save';
         $("#cmd").val('save');
      }
      
      allInputs.each(function(idx) {
         newname = $(this).attr('name');
         if (newname) {
            newname = newname.replace(/\[\]/, "["+sid+"]");
            $(this).attr('name', newname);
         }
      });
      
      var data = $("#simpleForm").serialize();
      data['x'] = $("#cmd").val();
      data['id'] = sid;
      data['pid'] = simpleConfig.ProcessID;
      data['rsc'] = simpleConfig.Resource;
      postData("ctl.php", data);
   }
   if (parseInt(simpleConfig.process.Buttons) & 2) {
      $("#SaveButton").show(100).addClass('disabled');
      
   } else {
      $("#SaveButton").hide(100);
   }
   return false;
}

function updateStatus(msg) {
   if (msg) $("#status").text = msg;
}

function doColumns(who, pid) {
   grid = who ? who + 'Grid' : 'mygrid';
   pid = pid ? pid : simpleConfig.pid;
   
   if (!who) who = 'mygrid';

   $("#"+grid).columnChooser(
      {
      left:300,
      top:100,
      done:function(cols) {
         var sel = [], unsel = [], all = {}, colMap = {}, colModel = this.jqGrid("getGridParam", "colModel"), colNames = this.jqGrid("getGridParam", "colNames");

         var opts = $("option", $("#colchooser_mygrid")).each(function(i) {
            if (this.selected) {
               all[colModel[this.value].name] = 'show';
               sel[sel.length] = colModel[this.value].name;
               colMap[colModel[this.value].name] = i;
            } else {
               unsel[unsel.length] = colModel[this.value].name;
               all[colModel[this.value].name] = 'hide';
            }

         });
         var config = $("#mygrid").jqGridExport({"exptype":"jsonstring"});
         var colConf = { "columnOrder": cols, "columnDisplay": all, "config": config };
         localStorage.setItem(simpleConfig.resource + simpleConfig.pid, JSON.stringify(colConf));

         if (cols)  {
             this.jqGrid("remapColumns", cols, true);
             var gwdth = this.jqGrid("getGridParam","width");
             this.jqGrid("setGridWidth",gwdth);
             $("#" + grid).setGridWidth($("body").width());
         }
      }
   });
   return false;
}

function simpleBounce(who) {
   if (simpleConfig.modified) {
      $(who).addClass("changed");
      $(who).effect("bounce", { times:3 }, 250);
      if (simpleConfig.modified == true) {
         setTimeout(function() { simpleBounce(who); }, 3000);
      }
   }
}

function doRemove() {
   if (confirm('Are you sure you want to delete this record?')) {
      simpleConfig.action = 'delete';
      postData("ctl.php", {"x":"delete","rsc":simpleConfig.resource,"id":simpleConfig.id,"pid":simpleConfig.pid});
   } 
}

function doImport() {
   $("#importDialog").dialog("open");
}

function doExportGrid() {

}

function doExport() {
   debugger;
   var allrows;
   allrows = $("#mygrid").jqGrid('getRowData');
   for (var i=0;i<allrows.length;i++) {
      for (var key in allrows[i]) {
         allrows[i][key] = allrows[i][key].replace(/'/g, "&quot;");
      }
   }
   /*
   var url = 'ctl.php?rsc='+simpleConfig.resource+'&pid='+simpleConfig.pid+'&x=export&_cache='+(new Date()).getTime();
   
   var rows = JSON.stringify(allrows);
   var sendform = $("#sendform");
   $("#send_data").val(rows);
   sendform.submit();
   */
   
   $("#exportFrame").attr("src", "ctl.php?x=export&rsc="+simpleConfig.resource+"&pid="+simpleConfig.pid+"_cache="+(new Date()).getTime());
   return false;   
}

function downloadData(url, data, callback) {
   // check 'working' attribute in global config and only perform
   // one transaction at a time, deferring if busy
   if (!simpleConfig.working) {
      simpleConfig.working = true;
      var xport = document.createElement("div");

      $.ajax({
         type: "POST",
         url: url,
         data: data,
         success: function(msg) {
            $("body").append(msg);
            simpleConfig.modified = false;
            simpleConfig.working = false;
            if (callback && (typeof callback === "function")) {
               callback.apply(this, msg);
            } 
         }
      });
   } else {
      setTimeout(function() { postData(url, data, post); }, 500);
   }
}

function doSearch() {
   $("#mygrid").jqGrid("searchGrid", { 
      multipleSearch: true, 
      multipleGroup: false, 
      showQuery: true, 
      left: 200, 
      top: 100,
      onSearch: function(form) {
         var sql = $(".query").html();
         $("#mygrid")[0].p.postData["sql"] = sql;
      },
      closeAfterSearch: true,
      closeAfterReset: true
   });
   return false;
}

function doAdvancedSearch() {
   $("#mygrid").jqGrid("searchGrid", { multipleSearch: true, multipleGroup: true, showQuery: true, left: 200, top: 100 });
   return false;
}

function postData(url, data, callback) {
   // check 'working' attribute in global config and only perform
   // one transaction at a time, deferring if busy
   if (!simpleConfig.working) {
      simpleConfig.working = true;

      $.ajax({
         type: "POST",
         url: url,
         data: data,
         success: function(msg) {
            $("body").append(msg);
            simpleConfig.modified = false;
            simpleConfig.working = false;
            if (callback && (typeof callback === "function")) {
               callback.apply(this, msg);
            } 
         }
      });
   } else {
      setTimeout(function() { postData(url, data, post); }, 500);
   }
}

function newApp() {
   var appname = prompt("Name of New Application Space");
   
   postData('/admin/tool/ctl.php', {"x":"newapp", "appname":appname});
}

function doRelate() {
   // $("#relateGrid").jqGrid();
   $("#relateDialog").dialog("open");
}

function doCopy(frmID) {
   simpleConfig.id = 'new1';
   simpleConfig.action = 'new';
   $("#cmd").val("new");
   $("#simpleID").val('new1');
   $("#simpleID").attr('name', simpleConfig.resource+'[new1]['+simpleConfig.resource+'ID]');
   $(".formHeading").text(simpleConfig.resource + ' ID: [New Copy]').css({"background":"#990000","color":"#ffffff"});
   $("a.simpleButton", $("#toolbar")).show();
   $("#formContainer").show(100);
   var allInputs = $(':input:not(input[type=hidden])', "#simpleForm"), newname;
   var def;
   allInputs.each(function(idx) {
      newname = $(this).attr('name').replace(/\[.*?\]/, "[new1]");
      $(this).attr('name', newname);
   });
   doModify();

   $("#SaveButton").css("display","block");
   $("#DeleteButton").css("display","none");
   $("#NewButton").css("display","none");
   $("#mainID").html("Copy of "+jobhead);

   return true;
}

function doPrint() {
   var notes = $("#Notes");
   if (notes.length) {
       notes.after($("<div/>").attr('id', 'showNotes').html(notes.val()));
       notes.hide();
   }
   window.print();  
   setTimeout(function() { $("#Notes").show(); $("#showNotes").hide(); }, 10000);
}

function doPrintGrid() {
   window.open("/printgrid.php?pid="+simpleConfig.pid+"&id="+simpleConfig.id, 'printgrid');
}

function unclamp(local,localID,remote,remoteID) {
   $.getJSON("ctl.php", {"x":"unclamp", "rsc":local, "id":localID, "remote":remote, "rid":remoteID}, function(data) {
      $("body").append(data);
   });
    
}

function getHighIndex(selector) {
    selector = selector ? selector : "*"; 

    var elements = document.querySelectorAll(selector) ||
                   oXmlDom.documentElement.selectNodes(selector),
        i = 0,
        e, s,
        max = elements.length,
        found = [];

    for (; i < max; i += 1) {
        e = elements[i].style.zIndex;
        s = elements[i].style.position;
        if (e && s !== "static") {
          found.push(parseInt(e, 10));
        }
    }

    return found.length ? Math.max.apply(null, found) : 0;
}

function openWin(url, tgt, opt) {
   if (simpleConfig.id && simpleConfig.id != null && simpleConfig.id != undefined) {
      if (!opt) opt = "height=800,width=600,resizable=yes,scrollbars=yes,status=yes,toolbar=yes,menubar=yes,location=no,personalbar=no";
      if (!tgt) tgt = "_blank";
      
      window.open(url, tgt, opt );
   }
   return false;
}

function showMap(address, title) {
   $("#mapWrap").dialog('option', 'title', title + ': ' + address);
   $("#mapWrap").dialog('open');
   $("#map").attr('src', "/map.php?address=" + encodeURIComponent(address));
}
