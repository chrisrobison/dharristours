Storage.prototype.setObject = function(key, value) { this.setItem(key, JSON.stringify(value)); }
Storage.prototype.getObject = function(key) { return this.getItem(key) && JSON.parse(this.getItem(key)); }

var grid;
$(document).ready(function($) {
   $.extend($.fn.fmatter , {
      time: function(cellvalue, options, rowdata) {
         if (cellvalue && (cellvalue != undefined) && (cellvalue != null) && (cellvalue != "null")) {
            var parts = cellvalue.replace(/^0/,'').split(/:/),
                xm = 'am',
                hour = parseInt(parts[0]);

            if (hour >= 12) {
               xm = 'pm';
               if (hour > 12) hour -= 12;
            } else if (hour == 0) {
               hour = 12;
               xm = 'am';
            }
            return hour + ':' + parts[1] + ' ' + xm;
         } else {
            return cellvalue;
         }
      }
   });
   $.extend($.fn.fmatter.time, {
         unformat : function(cellvalue, options) {
            if (cellvalue && (cellvalue != undefined) && (cellvalue != null) && (cellvalue != "null")) {
               var  out = '', 
               parts = cellvalue.replace(/^0/, '').split(/[:\s]/);

               if (cellvalue.match(/pm/)) parts[0] = parseInt(parts[0]) + 12;
               if (parts[0] == 24) parts[0] = 12;
               if (parts[0] < 10) parts[0] = '0' + parts[0];
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

   // Attach handlers to action buttons
   var actions = {
      "New":         function() {return doNew();},
      "Copy":        function() {$(".menu").slideUp(50);return doCopy();},
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
      "ResetLayout": function() {return resetLayout();},
      "ClearStorage":function() {return clearStorage();},
      "Report":      function() {return doReport();}
   };
 
   /* 
   $("#ActionsButton").click(function(e) { 
      var $this = $(this), me = $this.attr("id").replace(/Button/, ''), menu = me + "Menu";
      $(".menu").not("#" + menu).slideUp(50);
      
      var $menu = $("#" + menu);
      if (simpleConfig.gridstate == 2) {
         $menu.css( { top: (-1 * $menu.height()) + 'px' } ).addClass('upMenu');
      } else {
         $menu.css( { top: "40px" } ).removeClass('upMenu');
      }
      $menu.slideToggle(75);
   });
   */
   $("#toolbar").on("click", ".buttonMenu", function(e) {
      var $this = $(this), me = $this.attr("id").replace(/Button/, ''), menu = me + "Menu";
      $(".menu").not("#" + menu).slideUp(75);
      $("#" + menu).slideToggle(100);
   });

   $("document").keydown(function(e) { console.log(e); });

   for (var a in actions) {
      $("#"+a+"Button").click(function(event) { 
         $(".menu").slideUp(75); 
         var bid = $(this).attr('id').replace(/Button/i,'');
         if (simpleConfig.actions && simpleConfig.actions[bid]) simpleConfig.actions[bid](event); 
         return actions[bid](event); 
      }); 

      $("#menu"+a).click(function(event) { 
         $(".menu").slideUp(75); 
         var bid = $(this).attr('id').replace(/menu/i,'');
         if (simpleConfig.actions && simpleConfig.actions[bid]) {
            var ret = simpleConfig.actions[bid](event);
            if (!ret) {
               return ret;
            } else {
               return actions[bid](event); 
            }
         } else {
            return actions[bid](event); 
         }
      });
   }

   grid = $("#mygrid");
   
   setGridHeight();

   grid.jqGrid('setGridParam', {   
         onSelectRow: function(id) { 
            $("#customButtons .disabled").removeClass("disabled");
            if (selectRow(id)) { 
               if (simpleConfig.actions && simpleConfig.actions['Select']) simpleConfig.actions['Select'](id);
            }
         },
         ondblClickRow: function(rowid) { var rowid = $("#grid").getGridParam('selrow'); $(this).jqGrid('editGridRow', rowid); },
         resizeStop: function(width, idx) { } // ,
         // gridComplete: function() { 
            // grid.setGridWidth($("body").width() - 2 ); 
            // setGridHeight();
         // }
   });
   grid.gridResize();

   $(".HeaderButton").click(function() { gridDisplay(grid, 'toggle'); });
   
   $(".RelatedButton").click(function() {
      gridDisplay($('#showRelated'), 'toggle'); 
   });

   window.onresize = function() { doLayout('open'); };
   $("window").resize(function() { doLayout('open'); });
   
   setTimeout(function() { $("#mygrid").setGridWidth($("body").width() - 2); $("#mygrid").setGridWidth($("body").width() - 2); }, 1000);
   $("#gbox_mygrid").resizable({ 
      handles: 'n, s',
      stop: function(event, ui) {
         console.log("New size: " + ui.size.width + " x " + ui.size.height);
         simpleConfig.size = ui.size;
         store.set("gridHeight", ui.size.height);
      }
   });

   setGridHeight();
   
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
//         toggleSearch();
      }
   }
   $("#showRelated").on("click", "h3", function() { $(this).toggleClass('open'); });
   $("form#simpleForm").on("change", ":input", function(e) { doModify($(this)); });

   $("#gview_mygrid table thead tr").on("mouseup", ".ui-jqgrid-resize", function(i) {
      saveLayout();
   });
   toggleSearch();
   
   $("body").keyup(function(e) {
      if (e.keyCode == 27) {
         $(".menu").slideUp(100);
      }
   });
   gridConfig = grid.getGridParam();

   setTimeout(function(gridConfig) { grid.setGridParam(gridConfig); }, 1000);
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
      pager: config.pager,
      scroll: config.scroll,
      scrollrows: config.scrollrows
   };

   localStorage.setItem(simpleConfig.resource + simpleConfig.pid, JSON.stringify(newconfig));
   
   postData("ctl.php", {"x":"storeConfig", "data":{"config": JSON.stringify(newconfig)}, "mid": simpleConfig.ModelID, "pid": simpleConfig.pid, "rsc": simpleConfig.resource});
}

function clearStorage() {
   if (confirm("Are you sure you want to permanently remove ALL locally stored settings and data?")) {
      localStorage.clear(); 
      top.updateStatus("All locally stored data has been cleared.");
   }
}

function exportConfig(grid) {
   var config = $(grid).jqGrid('jqGridExport', {"exptype":"jsonstring", "ident":"   "});
   return cleanObj(config);
}

function importConfig(grid, impstr) {
   return $(grid).jqGrid('jqGridImport', { imptype: "jsonstring", impstring: impstr });
}

function resetLayout() {
   localStorage.removeItem(simpleConfig.resource + simpleConfig.pid);
   postData("ctl.php", {"x":"resetConfig", "pid": simpleConfig.pid, "mid": simpleConfig.ModelID });
}

function selectRow(id) {
   var grid = $("#mygrid");
   simpleConfig.current = simpleConfig.record = grid.jqGrid('getRowData',id);
   if (!simpleConfig.resource) simpleConfig.resource = simpleConfig.process.Resource;
   simpleConfig.rowid = id;

   if (!simpleConfig.modified || (simpleConfig.modified && confirm("There are changes that have *NOT* been saved!\nClick OK to discard your modifications   -or-\nClick Cancel to go back and Save your changes."))) {
      
      simpleConfig.record = grid.jqGrid('getRowData', id);
      simpleConfig.id = simpleConfig.record[simpleConfig.resource+'ID'];
      simpleConfig.action = 'update';
      simpleConfig.modified = false;
      
      if (simpleConfig && simpleConfig.actions && simpleConfig.actions['Select']) {
         simpleConfig.actions['Select'](id);
      }

      doSelect(id); 
      grid.setSelection(simpleConfig.rowid, false);
   } else {
      return false;
   }
}

function updateForm(frm, id, data) {
   simpleConfig.rowid = simpleConfig.id = id;
   $(".formHeading").text(simpleConfig.resource + ' ID: ' + simpleConfig.id);
   $("#simpleID").val(id);
   $("#simpleID").attr('name', $("#simpleID").attr('name').replace(/\[.*?\]/, "["+id+"]"));
   var $tmpel, related = { };
   /* {{{
   for (var key in data) {
      if (data.hasOwnProperty(key)) {
         if (retChildren && ((typeof(data[key]) === "array") || (typeof(data[key]) === "object"))) {
            if (typeof(data[key]) === "string") data[key] = data[key].replace(/\\n/g, "\n").replace(/--/g, "\n--");
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
   }}} */
}

function toggleSearch() {
   if ($("#mygrid") && $("#mygrid")[0] && $("#mygrid")[0].toggleToolbar) {
      $("#mygrid")[0].toggleToolbar();
      simpleConfig.searchToolbar = (simpleConfig.searchToolbar) ? 0 : 1;
      if (store) store.set("searchToggle", simpleConfig.searchToolbar);
   } else {
      setTimeout(toggleSearch, 1000);
   }
}

function fillForm(rsc, id, data, prefx) {
   var key, $tmpel, related = { };
   if (data) {
      for (key in data) {
         if (data.hasOwnProperty(key)) {
            if ((data[key]!==null) && ((typeof(data[key]) === "array") || (typeof(data[key]) === "object"))) {
               related[key] = data[key];
            } else {
               $tmpel = undefined;
               if (prefx) {
                  $tmpel = $("#" + rsc + "-" + key);
               } else {
                  $tmpel = $("#" + key + ", ." + key);
               }
               if ($tmpel.length) {
                  $tmpel.each(function(idx) {
                     $this = $(this);
                     if (($this[0].nodeName === "SELECT") || ($this[0].nodeName === "INPUT") || ($this[0].nodeName==="TEXTAREA")) {
                        if (typeof(data[key]) === "string") data[key] = data[key].replace(/\\n/g, "\n").replace(/\r?\n\r?\n\r?\n/g, "\n\n");
                        
                        if ($this.is('input[type="checkbox"]')) {
                           if (data[key] && data[key] != "false" && data[key] != "0") {
                              $this.prop("checked", true).val(1);
                           } else {
                              $this.prop("checked", false).val(1);
                           }
                        } else {
                           $this.val(data[key]).change();
                        }
                        // $this.change();
                        // $this.attr("name", $tmpel.attr('name').replace(/\[.*?\]/, "["+id+"]"));
                        if (prefx) {
                           $this.attr("name", prefx + '[' + rsc + '][' + id + '][' + key +']' );
                        } else {
                           $this.attr("name", rsc + '[' + id + '][' + key +']' );
                        }
                        $(key + "_display").html(data[key]);
                     } else if ($this[0].nodeName === "IMG") {
                        $this.attr("src", data[key]); 
                     } else {
                        $this.html(data[key]);
                     }
                  });
               }
            }

            simpleConfig.modified = false;
            undoModify();
            if (key == "LastModifiedBy") {
               $("#LastModifiedBy").val(simpleConfig.userEmail);
            }
         }
      }
   }
   
   return related;
}

function loadRecord(rsc, id, callback) {
   simpleConfig.modified = false;
   simpleConfig.loading = true;
   $.getJSON("ctl.php", {"x":"related", "rsc":rsc, "id":id}, function(data) {
      var $tmpel, related;
      simpleConfig.current = data;
      
      related = fillForm(rsc, id, data);
      if (related) {
         for (var i in related) {
            if (related.hasOwnProperty(i)) {
               var name = i.replace(/^related_/, '');
               fillForm(name, related[i][0][name+'ID'], related[i][0], rsc + '[' + id + ']');
            }
         }
      }
      undoModify();
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
      simpleConfig.loading = false;
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
      rgrid.jqGrid('gridResize',{minWidth:350,maxWidth:5000,minHeight:80, maxHeight:500});
      
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
            var rid, fld, tbl, myclass, val;
            tbl = rel.replace(/^related_/,'');
            for (var x in related[rel]) {
               if (related[rel][x] != null) {
                  relout += "<tr>";
                  for (var f in related[rel][x]) {
                     if (related[rel][x].hasOwnProperty(f)) {
                        fld = f; //rfields[f];
                        val = related[rel][x][fld];
                        myclass = '';
                        if (fld == tbl+'ID') {
                           rid = related[rel][x][fld];
                           myclass = " class='referenceID'";
                        }
                        if ((related[rel][x][fld] == "null") || (related[rel][x][fld]==null) || (related[rel][x][fld]==undefined))  related[rel][x][fld] = '';
                        relout += "<td"+myclass+">ID <b>" + rid + "</b>: <a href='#' onclick='return top.loadUrl(\"/grid/?pid=" + related[rel][x]['_pid'] + "&id=" + rid + "\",\"" + tbl + "\")'>"+related[rel][x][fld]+"</a></td>";
                        var relel = $("#" + tbl + "-" + fld),
                            reldisp = $("#" + tbl + "-" + fld + "_display");
                        if (relel.length) {
                           var rname = relel.attr("name"), 
                               newname = simpleConfig.resource + "[" + simpleConfig.id + "][" + tbl + "][" + rid + "][" + fld + "]";
                           relel.attr("name", newname).val(related[rel][x][fld]);
                        }
                        if (reldisp.length) {
                           reldisp.html(related[rel][x][fld]);
                        }
                     }
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
   if (simpleConfig.loading) return false;
   if (parseInt(simpleConfig.process.Buttons) & 2) {
      var key = $(who).attr("id");
      
      if (!simpleConfig.record) simpleConfig.record = {};
      
      simpleConfig.record[key] = who.val();
      
      $(".disabled").removeClass('disabled');
      
      if (who) {
         if (who[0].nodeName != "SELECT") {
            who.addClass("modified");
         }
      }
      if (!simpleConfig.modified && !simpleConfig.loading) {
         simpleConfig.modified = true;
         simpleBounce('#SaveButton');
         $("#SaveButton").addClass('modified');
      }
      if (simpleConfig.action != 'new') { 
         // var colname = who.attr('id').replace(/([a-z])([A-Z])/, "$1 $2");
         // $('#mygrid').setCell(simpleConfig.rowid, colname, who.val(), 'modified'); 
         
         if (who.attr('rel') && who.attr('id').match(/ID$/)) {
            var colname = who.attr('rel'); 
            $('#mygrid').setCell(simpleConfig.rowid, colname, $("option:selected", who).text(), 'modified'); 
         } else {
            var colname = who.attr('id'); // .replace(/([a-z])([A-Z])/, "$1 $2");
            $('#mygrid').setCell(simpleConfig.rowid, colname, who.val(), 'modified'); 
         }
      }
   }
}

function undoModify() {
   simpleConfig.modified = false;
   $(".modified").removeClass('modified');
   $("#SaveButton").addClass("disabled");
}

function getRealID(id) {

   var record = $("#mygrid").jqGrid('getRowData', id);
   return record[simpleConfig.resource+'ID'];
}

function doSelect(id, callback) {
   if (!simpleConfig.resource) simpleConfig.resource = simpleConfig.process.Resource;
   
   simpleConfig.record = $("#mygrid").jqGrid('getRowData', id);
   
   if (!simpleConfig.current) {
      simpleConfig.current = $("#mygrid").jqGrid('getRowData', id);
   }
   //simpleConfig.id = id; // simpleConfig.record[simpleConfig.resource+'ID'];
   simpleConfig.id =  simpleConfig.record[simpleConfig.resource+'ID'];
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
//   var gridH = $("#main").height() * .1;
//   $("#mygrid").setGridHeight(gridH);
//   $("#showGridButton").show();
//   $("#showFormButton").hide();
//   doLayout();
   
}

function doNew() {
   simpleConfig.id = 'new1';
   simpleConfig.action = 'new';
   simpleConfig.current = {};
   $("#cmd").val("new");
   $("#simpleID").val('new1');
   $("#simpleID").attr('name', simpleConfig.resource+'[new1]['+simpleConfig.resource+'ID]');
   $(".formHeading").text(simpleConfig.resource + ' ID: [New Entry]');
   $("a.simpleButton", $("#toolbar")).show(100);
   $("#formContainer").show(100);
   // var allInputs = $(':input:not(input[type=hidden])', "#simpleForm"), newname;
   var allInputs = $(':input', "#simpleForm"), newname;
   allInputs.each(function(idx) {
      var me = $(this),
      typ = me.attr('type'),
      rel = me.attr('rel'),
      key = me.attr('id'),
      def = (me.attr('default')) ? me.attr('default') : '';
      if ((rel=="data") || ((rel!="data") && (typ!='hidden'))) {
         me.val(def);
         newname = me.attr('name') || me.attr('id');
         if (newname) newname = newname.replace(/\[.*?\]/, "[new1]");
         me.attr('name', newname);
         simpleConfig.record[key] = (key == "LastModifiedBy") ? simpleConfig.userEmail : "";
      }
   });
   $("input.focus:last").focus();
   $("#formContainer").scrollTop(0);
   return false;
}

function gridDisplay(mygrid, state) {
   var related = $("#relatedWrap"),
       mainH = $("#main")[0].offsetHeight,
       toolH = $("#toolbar")[0].offsetHeight,
       gridH, sw;
   var relatedH = (related.length) ? $("#relatedWrap")[0].offsetHeight : 0;
   
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
   var grid = $("#mygrid"), tool = $("#toolbar"), main = $("#main"), mainH, gridH, sw, formH, toolH;
   
   if (main.length) mainH = main[0].offsetHeight;
   if (tool.length) toolH = tool[0].offsetHeight;

   if (state=='toggle') {
      sw = grid.data("viewstate");
      state = (sw ^ 1) ? "closed" : "open";
      grid.data("viewstate", (sw^1))
   }

   if (state == 'closed') {
      gridH = $(".ui-jqgrid-titlebar")[0].offsetHeight;
   } else {
      gridH = $("#gbox_mygrid").height();
   }

   formH = mainH - (gridH + toolH);
   
   $("#formContainer").height(formH);
   $("#showRelated").height(formH - 22);
   
   grid.setGridWidth($("body").width() - 2);
   grid.setSelection(simpleConfig.rowid, false);

}

function flagEmail(msgType) {
   var curval = $("#sendEmail").val();
   if (!curval) $("#sendEmail").val(msgType);
}

function addDate(who) {
   var d = new Date();
   who.value = who.value.replace(/\n$/m, '') + "\n-- Updated by " + simpleConfig.userEmail + " on " + (d.getMonth() + 1) + '/' + d.getDate() + '/' + d.getFullYear() + ' at ' + d.toLocaleTimeString();
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
      
//pepe doesn't understand why you rename all fields since they're already set
      allInputs.each(function(idx) {
         newname = $(this).attr('name');
         if (newname) {
              //pepe adds check if not part of ID
      var me = $(this),
      typ = me.attr('type'),
      rel = me.attr('rel'),
      key = me.attr('id');
      if ((rel=="data") || ((rel!="data") && (typ!='hidden'))) {
//            newname = newname.replace(/\[.*?\]/, "["+sid+"]");
//            $(this).attr('name', newname);
	      if (newname.indexOf(sid)  == -1 && newname.indexOf("hour")  == -1  && newname.indexOf("dropoffToggle")  == -1  && newname.indexOf("EmployeeYard")  == -1 && newname.indexOf("doNotify")  == -1 && newname.indexOf("minute")  == -1 && newname.indexOf("meridian")  == -1) 
	      { 
	         alert("ID Not Correct! sid =" + sid + " and name = " + newname);
	         return false;
              }
	        // alert("ID Not Correct! sid =" + sid + " and name = " + newname);
	      //end pepe
	}
	}
      });
    
      var chkboxes = $("#simpleForm").find(':checkbox:not(:checked)');
      chkboxes.val("0").attr("checked", true).prop("checked", true);
      $("#LastModifiedBy").val(simpleConfig.userEmail).attr("name", simpleConfig.resource + "[" + sid + "][LastModifiedBy]");

      // var frmdata = $("#simpleForm").serialize(), data = decodeQuery(frmdata);
      // data['data'] = frmdata; // frmdata[simpleConfig.resource];
      // data['x'] = $("#cmd").val(); data['pid'] = simpleConfig.pid; data['rsc'] = simpleConfig.resource;
      
      var data = { "data": serializeForm($(":input")), "x": $("#cmd").val(), "pid": simpleConfig.pid, "rsc": simpleConfig.resource };
      if (sid != 'new1') data['id'] = sid;
      if ($("#sendEmail").length) {
         data['sendEmail'] = $("#sendEmail").val();
      }

      postData("ctl.php", $.param(data));

      chkboxes.each(function() {
         $(this).val("1").attr("checked", false).prop("checked", false);
      });
   }
   if (parseInt(simpleConfig.process.Buttons) & 2) {
      $("#SaveButton").show(100).addClass('disabled');
      
   } else {
      $("#SaveButton").hide(100);
   }
   return false;
}

function serializeForm(who) {
   var out = {}, parts, val, key, rsc;
   
   who.each(function() {
      val = $(this).val();
      key = $(this).attr("name");
      parts = [];
      
      if (key) {
         trsc = key.match(/^([^\[]+)\[/);
         if (trsc) rsc = trsc[0].replace(/[\[\]]/g, '');
         parts = key.match(/\[([^\]]+)\]/g);
         if (parts) {
            // if (!out[rsc]) out[parts[1]] = {};
            // if (!out[rsc][parts[2]]) out[parts[1]][parts[2]] = {};
            if (($(this).attr("type") == "hidden") && ($(this).attr("rel") != "data")) {
               return true;
            }
            var tmp = buildObject(out[rsc], parts, val);
            out[rsc] = $.extend(out[rsc], tmp);
            // out[parts[1]][parts[2]][parts[3]] = val;
         }
      }
   });
   return out;
}

function buildObject(obj, keys, val) {
   var key = keys.shift().replace(/[\[\]]/g, '');
   if (!obj) obj = {};
   if (keys.length > 0) {
      if (!obj[key]) obj[key] = {};
      //obj[key] = $({}, obj[key], buildObject(obj[key], keys, val));
      obj[key] = buildObject(obj[key], keys, val);
   } else {
      obj[key] = val;
   }

   return obj;
}

// **** Remove this once serializeForm has been vetted
// **** |
// **** V
function decodeQuery(q) {
   var parts = q.split(/&/), plen = parts.length, keyval, out = {}, i=0;
   
   for (; i < plen; i++) {
      keyval = parts[i].split(/=/, 2);
      keyval[0] = decodeURIComponent(keyval[0].replace(/\+/g, ' '));
      keyval[1] = decodeURIComponent(keyval[1].replace(/\+/g, ' '));
      out[keyval[0]] = keyval[1];
   }

   return out;
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
   var $who = $(who);
   if (simpleConfig.bouncing) return true;
   if (simpleConfig.modified && !simpleConfig.loading) {
      if (simpleConfig.modified == true) {
         simpleConfig.bouncing = true;
         $who.addClass("changed");
         $who.effect("pulsate", { times:3 }, 250);
         setTimeout(function() { simpleBounce(who); }, 5000);
      } else {
         simpleConfig.bouncing = false;
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
   var allrows;
   allrows = $("#mygrid").jqGrid('getRowData');
   for (var i=0;i<allrows.length;i++) {
      for (var key in allrows[i]) {
         allrows[i][key] = allrows[i][key].replace(/\'/g, "&quot;");
      }
   }
   var url = 'ctl.php?rsc='+simpleConfig.resource+'&pid='+simpleConfig.pid+'&x=export&_cache='+(new Date()).getTime();
   
   var rows = JSON.stringify(allrows);
   var sendform = $("#sendform");
   $("#send_data").val(rows);
   sendform.submit();
}

function doExport() {
   $("#exportFrame").attr("src", "ctl.php?x=export&rsc="+simpleConfig.resource+"&pid="+simpleConfig.pid+"&_cache="+(new Date()).getTime());
   return false;   
}

function doReport() {
   $("#exportFrame").attr("src", "/apps/report.php?rid=&rsc="+simpleConfig.resource+"&pid="+simpleConfig.pid+"&_cache="+(new Date()).getTime());
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
   //var allInputs = $(':input:not(input[type=hidden]),input[type=hidden][rel=data]', "#simpleForm"), newname;
//pepe added
   var allInputs = $(':input', "#simpleForm"), newname;
   var def;
 //end pepe
   allInputs.each(function(idx) {
 //pepe
      var me = $(this),
      typ = me.attr('type'),
      rel = me.attr('rel'),
      key = me.attr('id'),
      def = (me.attr('default')) ? me.attr('default') : '';
      if ((rel=="data") || ((rel!="data") && (typ!='hidden'))) {
         newname = me.attr('name') || me.attr('id');
         if (newname) newname = newname.replace(/\[.*?\]/, "[new1]");
         me.attr('name', newname);
         simpleConfig.record[key] = (key == "LastModifiedBy") ? simpleConfig.userEmail : "";
     } 
 //end pepe
      // newname = $(this).attr('name').replace(/\[.*?\]/, "[new1]"); //pepe commented
     // $(this).attr('name', newname); //pepe commented
   });
   // doModify(); //pepe commented

   $("#SaveButton").css("display","block");
   $("#DeleteButton").css("display","none");
   $("#NewButton").css("display","none");
//   $("#mainID").html("Copy of "+jobhead); //pepe commented

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
   if (url) {
      var qs = '', c = url.split(/\?/, 2), h, t;
      if (c[1]) {
         qs = 'z=' + btoa(c[1]);
      }
      t = url.match(/(#.*)/, url);
      h = (t) ? t[0] : '';

      url = c[0] + '?' + qs + h;
   }
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
   $("#map").attr('src', "/tools/map2.php?address=" + encodeURIComponent(address));
}
    // setup grid print capability.  Add print button to navigation bar and bind to click.
function setPrintGrid(gid,pid,pgTitle){
   // print button title.
   var btnTitle = 'Print Grid';
   // setup print button in the grid top navigation bar.
   $('#'+gid).jqGrid('navSeparatorAdd','#'+gid+'_toppager_left', {sepclass :'ui-separator'});
   $('#'+gid).jqGrid('navButtonAdd','#'+gid+'_toppager_left', {caption: '', title: btnTitle, position: 'last', buttonicon: 'ui-icon-print', onClickButton: function() {   PrintGrid();   } });

   // setup print button in the grid bottom navigation bar.
   $('#'+gid).jqGrid('navSeparatorAdd','#'+pid, {sepclass : "ui-separator"});
   $('#'+gid).jqGrid('navButtonAdd','#'+pid, {caption: '', title: btnTitle, position: 'last', buttonicon: 'ui-icon-print', onClickButton: function() { PrintGrid();   } });

   function PrintGrid(){
      // attach print container style and div to DOM.
      $('head').append('<style type="text/css">.prt-hide {display:none;}</style>');
      $('body').append('<div id="prt-container" class="prt-hide"></div>');

      // copy and append grid view to print div container.
      $('#gview_'+gid).clone().appendTo('#prt-container').css({'page-break-after':'auto'});
      // remove navigation divs.
      $('#prt-container div').remove('.ui-jqgrid-toppager,.ui-jqgrid-titlebar,.ui-jqgrid-pager');
      // print the contents of the print container.   
      $('#prt-container').printElement({pageTitle:pgTitle, overrideElementCSS:[{href:'css/print-container.css',media:'print'}]});
      // remove print container style and div from DOM after printing is done.
      $('head style').remove();
      $('body #prt-container').remove();
   }
}

function toggleGrid(setstate) {
   if(setstate == 0) setstate = 267;
   console.log("[toggleGrid] called with state argument: '" + setstate + "'");
   var gridH = $("#main").height(), saved,
       state = (setstate == 0) || setstate ? setstate : simpleConfig.gridstate;
   if (!state) state = 0;
   
   saved = store.get("gridHeight");
   
   // TODO: Find out how full screen toggle is actually working 
   // here and fix it so the toolbar isn't off the screen 
   switch (parseInt(state)) {
      case 0:
         gridH = saved ? saved : (gridH * .25);
         console.log("[toggleGrid] State '0'   Grid Height: " + gridH);
         break;
      case 1:
         gridH -= 90;
         console.log("[toggleGrid] State '1'   Grid Height: " + gridH);
         break;
      case 2:
         gridH = 100;
         console.log("[toggleGrid] State '2'   Grid Height: " + gridH);
         break;
      default:
         gridH = saved ? saved : (gridH * .25);
         console.log("[toggleGrid] *FAILOVER*  Grid Height: " + gridH);
   }
   state++;
   if (state > 2) state = 0;
   simpleConfig.gridstate = state;
   
   setGridHeight(gridH, true);
   // $("#gview_mygrid").animate({ height: gridH }, 250, "swing");
   // $("#gbox_mygrid").animate({ height: gridH + 50 }, 250, "swing", function() {
   //   $("#mygrid").setGridHeight(gridH);
   //   doLayout();
   // });
   
   // $("#mygrid").setGridHeight(gridH - 65);
   return false;
}
   function setGridHeight(sz, anim) {
      gridH = sz ? sz : store.get("gridHeight");
      if (!gridH) {
         gridH = ($("#main").height() * .25) - 65;
         if (!gridH || (gridH < 1)) gridH = 200;
         store.set("gridHeight", gridH);
      }

      if (anim) {
         $("#gview_mygrid").animate({ height: gridH }, 250, "swing");
         $("#gbox_mygrid").animate({ height: gridH + 50 }, 250, "swing", function() {
            $("#mygrid").setGridHeight(gridH);
            doLayout();
            console.log("[setGridHeight] With animation | Grid height: " + gridH);
         });
      } else {
         $("#gview_mygrid").css({ height: gridH });
         $("#gbox_mygrid").css({ height: gridH + 50 });
         $("#mygrid").jqGrid("setGridHeight", gridH);
         doLayout();
         console.log("[setGridHeight] No animation | Grid height:" + gridH);
      }
      return gridH;
   }
  function initDateWithButton(elem) {
    if (/^\d+%$/.test(elem.style.width)) {
      // remove % from the searching toolbar
      //elem.style.width = '';
      $(elem).css({
        width: "230px"
      });
    }
    // to be able to use 'showOn' option of datepicker in advance searching dialog
    // or in the editing we have to use setTimeout
    setTimeout(function() {
      $(elem).datepicker({
        dateFormat: 'dd-mm-yy',
        showOn: 'button',
        changeYear: true,
        changeMonth: true,
        buttonImageOnly: true,
        buttonImage: "//jqueryui.com/resources/demos/datepicker/images/calendar.gif",
        buttonText: "Select date",
        onSelect: function(dateText, inst) {
          if (inst.id.substr(0, 3) === "gs_") {
            grid[0].triggerToolbar();
          } else {
            // to refresh the filter
            $(inst).trigger("change");
          }
        }
      });
    }, 100);
  };


var Base64 = {

    // private property
    _keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

    // public method for encoding
    encode : function (input) {
        var output = "";
        var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
        var i = 0;

        input = Base64._utf8_encode(input);

        while (i < input.length) {

            chr1 = input.charCodeAt(i++);
            chr2 = input.charCodeAt(i++);
            chr3 = input.charCodeAt(i++);

            enc1 = chr1 >> 2;
            enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
            enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
            enc4 = chr3 & 63;

            if (isNaN(chr2)) {
                enc3 = enc4 = 64;
            } else if (isNaN(chr3)) {
                enc4 = 64;
            }

            output = output +
            this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
            this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

        }

        return output;
    },

    // public method for decoding
    decode : function (input) {
        var output = "";
        var chr1, chr2, chr3;
        var enc1, enc2, enc3, enc4;
        var i = 0;

        input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

        while (i < input.length) {

            enc1 = this._keyStr.indexOf(input.charAt(i++));
            enc2 = this._keyStr.indexOf(input.charAt(i++));
            enc3 = this._keyStr.indexOf(input.charAt(i++));
            enc4 = this._keyStr.indexOf(input.charAt(i++));

            chr1 = (enc1 << 2) | (enc2 >> 4);
            chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
            chr3 = ((enc3 & 3) << 6) | enc4;

            output = output + String.fromCharCode(chr1);

            if (enc3 != 64) {
                output = output + String.fromCharCode(chr2);
            }
            if (enc4 != 64) {
                output = output + String.fromCharCode(chr3);
            }

        }

        output = Base64._utf8_decode(output);

        return output;

    },

    // private method for UTF-8 encoding
    _utf8_encode : function (string) {
        string = string.replace(/\r\n/g,"\n");
        var utftext = "";

        for (var n = 0; n < string.length; n++) {

            var c = string.charCodeAt(n);

            if (c < 128) {
                utftext += String.fromCharCode(c);
            }
            else if((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            }
            else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }

        }

        return utftext;
    },

    // private method for UTF-8 decoding
    _utf8_decode : function (utftext) {
        var string = "";
        var i = 0;
        var c = c1 = c2 = 0;

        while ( i < utftext.length ) {

            c = utftext.charCodeAt(i);

            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            }
            else if((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i+1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            }
            else {
                c2 = utftext.charCodeAt(i+1);
                c3 = utftext.charCodeAt(i+2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }

        }

        return string;
    }
}

if (!window.btoa) { window.btoa = function(str) { return Base64.encode(str); } }
if (!window.atob) { window.atob = function(str) { return Base64.decode(str); } }


