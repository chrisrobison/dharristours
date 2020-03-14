// Global vars
var ui;
var typedefs = new Array();
var frm = document.forms['dbtool'];

function UI() { }  // Cheap UI object definition

/**
* Initialize the tree.
* And to call showTree(imagePath); to actually show the tree.
* Alternatively this can be done in a script block at the bottom of the page.
* Though this method is somewhat cleaner.
 **/
function init(obj) {
   ui = new UI();
   ui.coltype = (obj['coltype']) ? obj['coltype'] : ($("#kiss").is(":checked")) ? 'simple' : 'advanced';
   ui.state = new Array();
   ui.highZ = 1;
   initDOMAPI();

   var container = document.getElementById('schemas');
   var tableDiv = new Array();
   var headingDiv = new Array();
   var fieldContainer = new Array();
   var row = col = 0;

   for (var d in coltypes[ui.coltype]) {
      typedefs[d] = d;
   }
   if (ui.coltype = 'simple') { $("#colattr").hide(); }
   var showtables = $("#showtables");
   for (var tbl in obj.tables) {
      if (!tbl.match(/^wp_/)) {
         ui.state[tbl] = new Object();
         ui.state[tbl].state = 1;
         ui.state[tbl].showing = 1;

         tableDiv[tbl] = document.createElement('div');
         tableDiv[tbl].setAttribute('id', 'table_' + tbl);
         if (relations && relations[tbl]) tableDiv[tbl].setAttribute('rel', relations[tbl].join(" "));
         tableDiv[tbl].setAttribute('class', 'tableDiv tableCol' + col + ' tableRow' + row);
   //      tableDiv[tbl].setAttribute('className', 'tableDiv tableCol' + col + ' tableRow' + row);
         tableDiv[tbl].setAttribute('style', 'top:' + ((row * 10) + 5) + 'em;left:' + ((col * 22) + 1) + 'em;');
         
         var colors = new Array(getColor(), getColor(), getColor());
         var stored = getValue('table_' + tbl);
         var mytable = getTable(tbl);

         var xy = [];
         if (stored) xy = stored.split(/:/);
         
         headingDiv[tbl] = document.createElement('div');
         headingDiv[tbl].setAttribute('id', tbl + '_heading');
         headingDiv[tbl].setAttribute('class', 'tableHeading');
         headingDiv[tbl].setAttribute('style', 'background-color:rgb(' + colors.join(',') + ');');
   //      headingDiv[tbl].setAttribute('onmousedown', "dragStart(event, 'table_" + tbl + "')");
         headingDiv[tbl].innerHTML = "<div class='linkBtn' onmousedown='return dragStart(event, \"table_" + tbl + "\", \"link\")'> </div>";
         headingDiv[tbl].innerHTML += "<div class='toggle" + ((mytable && (mytable.state=='block')) ? 'Up' : 'Btn') + "' id='"+tbl+"_button' onclick='toggleTable(\"" + tbl + "\")'> </div><span class='headLabel'>" + tbl + "</span>";
         
         fieldContainer[tbl] = document.createElement('ul');
         fieldContainer[tbl].setAttribute('id', tbl + '_container');
         fieldContainer[tbl].setAttribute('class', 'fieldContainer sortable');
         fieldContainer[tbl].setAttribute('style', 'display:none;');

         tableDiv[tbl].appendChild(headingDiv[tbl]);
         tableDiv[tbl].appendChild(fieldContainer[tbl]);
         container.appendChild(tableDiv[tbl]);
         
         if (stored) {
            ui.zcount = 100;
            // if (xy[0] && xy[0] > 10) tableDiv[tbl].style.left = xy[0] + 'px';
            if (mytable && mytable.left && mytable.left > 10) tableDiv[tbl].style.left = mytable.left + 'px';
            
            // if (xy[1] && xy[1] > 10) tableDiv[tbl].style.top = xy[1] + 'px';
            if (mytable && mytable.top && mytable.top > 10) tableDiv[tbl].style.top = mytable.top + 'px';
            
            //fieldContainer[tbl].style.display = (xy[2]) ? xy[2] : 'none';
            fieldContainer[tbl].style.display = (mytable.state) ? mytable.state : 'none';
            
            if (xy[3]) {
               tableDiv[tbl].style.zIndex = xy[3];
               if (xy[3] > ui.highZ) {
                  ui.highZ = xy[3];
               }
            }
            // if (xy[4]==1) {
            if (mytable && mytable.hidden) {
               tableDiv[tbl].style.display = 'none';
               $("#show_"+tbl).removeAttr("checked");
               ui.state[tbl].showing = 0;
               ui.state[tbl].hidden = 1;
            }
         }
         var ischecked = (ui.state[tbl].hidden) ? '' : "checked='checked'";
         $("#showtables").append("<div id='view_"+tbl+"' class='showcheck'><input type='checkbox' id='show_"+tbl+"' " + ischecked + "> "+tbl+"</div>");
         genHTML(obj.tables[tbl].fields, tbl, fieldContainer[tbl]);

         ++col;
         if (col > 3) {
            ++row;
            col = 0;
         }
      }
   }
   
   if (!ui.editor) ui.editor = document.getElementById('coltypes');
   $(".sortable" ).sortable({
      update: function(event, myui) { 
         var afterField = myui.item.prev().attr('id').replace(/_field/, '').split(/\_/, 2);
         var tableField = myui.item.attr('id').replace(/_field/, '').split(/\_/, 2);
         var out = {"x":"move", "rsc": tableField[0], "field": tableField[1], "after":afterField[1] };
         $.post("ctl.php", out, function(data) {
            console.log(data);
         });

      },
      start: function(event, myui) {
         ui.dragType = 'field'; 
      }
   });
}

function storeTable(tbl) {
   tbl = tbl.replace(/^table_/, '');
   var pos = $("#table_"+tbl).offset();
   ui.state[tbl].top = pos.top;
   ui.state[tbl].left = pos.left;
   // ui.state[tbl].zIndex = $("#table_"+tbl).css('z-index');
   ui.state[tbl].state = $('#'+tbl+"_container").css('display');
   store.set(tbl, JSON.stringify(ui.state[tbl])); 
}

function getTable(tbl) {
   var result, txtobj = store.get(tbl);
   if (txtobj) {
      try {
         result = JSON.parse(txtobj);
      } catch(e) {
         result = txtobj;
      }
      return result;
   } else {
      return txtobj;
   }
}

/**
 * getColors - Returns random number between 1-255 for random header color generation
 *
 **/
function getColor() {
   return Math.round(Math.random()*255);
}
/**
 * Build table fields from passed object using DOM techniques and 
 * applying built document tree fragments to 'parent'
 *
 * @param obj - Table fields array/object
 * @param obj - Document object to append to
 *
 **/
function genHTML(obj, tableName, myparent) {
   for (var i in obj) {
      var objID = tableName + '_' + i + '_field';
      var pkey = (obj[i].key == 'PRI') ? ' primaryKey' : '';
      var mkey = (obj[i].key == 'MUL') ? ' multiKey' : '';

      var newdiv = document.createElement('li');
      
      newdiv.setAttribute('id', objID);
      newdiv.setAttribute('class', 'tableField' + pkey + mkey);
      // newdiv.setAttribute('className', 'tableField' + pkey + mkey);
      newdiv.innerHTML = "<span class='fieldDef'>" + obj[i].type + "</span>" + i;

      myparent.appendChild(newdiv);
   }

   var newdiv = document.createElement('li');
   var objID = tableName + '_new_field';
   newdiv.setAttribute('id', objID);
   newdiv.setAttribute('class', 'tableField');
   // newdiv.setAttribute('className', 'tableField');
   // newdiv.innerHTML = "<span class='newField'>*</span>";
   newdiv.innerHTML = "<span class='"+tableName+"_new'>&nbsp;</span>";

   myparent.appendChild(newdiv);

   return myparent;
}


/**
 * Handle document mouseover events
 *
 * @param evt - Event object
 *
 **/
function doOver(evt) {
   evt = (evt) ? evt : window.event;
   return true;
}

/**
 * Handle document mouseout events
 *
 * @param evt - Event object
 *
 **/
function doOut(evt) {
   evt = (evt) ? evt : window.event;
   return true;
}

/**
 * Handle document mousedown events
 *
 * @param evt - Event object
 *
 **/
function doDown(evt) {
   evt = (evt) ? evt : window.event;
   var target = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
   if (target.id.match(/_heading/i)) {
      ui.state.table = 1;
      ui.state.dragging = target.id.replace(/_.*/, '');
      ui.state.zindex = target.style.zIndex;
   }
   
   return true;
}

/**
 * Handle document mouseup events
 *
 * @param evt - Event object
 *
 **/
function doUp(evt) {
   var tblname, evt = (evt) ? evt : window.event;
   
   if (ui.state.dragging) {
      if (evt && evt.target && evt.target.parentNode) tblname = evt.target.parentNode.id.replace(/_.*/, '');
      if (tblname) {
         var obj = document.getElementById('table_' + tblname);
         if (obj && (tblname != "typelist")) {
            var pos = $('#table_' + tblname).offset();
            var newX = pos.left; // getObjectLeft('table_' + tblname);
            var newY = pos.top; // getObjectTop('table_' + tblname);
            var objcont = document.getElementById(tblname + '_container');
            
            storeTable(tblname);
            storeValue('table_' + tblname, newX + ':' + newY + ':' + ((objcont.style.display) ? objcont.style.display : 'none') + ':' + obj.style.zIndex  + ':0');
            ui.state.table = '';
         }
      }
   }
   ui.state.dragging = '';

   return true;
}

function getLeft(elm) {
   var lft = 0;

   while (elm) {
      if (elm.offsetLeft) lft = lft + elm.offsetLeft;
      if (elm.parentNode) {
         elm = elm.parentNode;
      } else {
         elm = null;
      }
   }
   return lft;
}


function getTop(elm) {
   var top = 0;

   while (elm) {
      if (elm.offsetTop) top = top + elm.offsetTop;

      if (elm.parentNode) {
         elm = elm.parentNode;
      } else {
         elm = null;
      }
   }
   return top;
}

/**
 * Handle document keypress events
 *
 * @param evt - Event object
 *
 **/
function doKey(evt) {
   evt = (evt) ? evt : window.event;
   var key = (evt.keyCode) ? evt.keyCode :  evt.which;
   if (key) {
      switch(key) {
         case 13: 
           return false;
           break;
         default:
            return true;
      }
   }
}

function doEdit(tableName, fieldName, typedef) {
   if (ui.editor) {
      ui.editor.style.zIndex = '9001';
      ui.editor.style.display = 'block';
      ui.state.adding = 0;
      
      // Grab DOM element of the table/field we want to edit
      var fieldContainer = $("#"+tableName+'_'+fieldName+'_field'), attrValue = '';
      
      // Store table and field in ui.state global
      $("#tableName").val(tableName);
      ui.state.tableName = tableName;
      
      $("#fieldName").val(fieldName);
      ui.state.fieldName = fieldName;

      // Store ref to element we our editing and the original content
      // so we can "undo" or escape out of editing the field
      if (fieldContainer.length) {
         ui.editingNode = fieldContainer[0];
         ui.oemContent = fieldContainer.html();
         
         // Replace fieldContainer content with our global edit object
         fieldContainer.html(ui.editor);
      }
      
      // Show attribute element if we are in 'advanced' mode
      (ui.coltype == 'advanced') ? $("#colattr").show() : $("#colattr").hide(); 

      ui.editing = true;
      
      // Setup ui.editor input elements with our data
      $('#colname').val(fieldName).focus()[0].select();
      $('#colattr').val(attrValue);
      
      // Update our state 
      if (fieldName == 'new') {
         ui.state.action = 'add';
         ui.state.adding = 1;
         $("#save").unbind("click");
         $("#save").attr("src", "img/save.png").bind("click", function(event) { doUpdate(); });
      } else {
         ui.state.action = 'delete'
         ui.state.adding = 0;
         $("#save").unbind("click");
         $("#save").attr("src", "img/delete.png").bind("click", function(event) { doDelete(); });
      }

      fillSelect('coltype', coltypes[ui.coltype], typedef);
   }
}

/**
 * Handle document click events
 *
 * @param evt - Event object
 *
 **/
function doClick(evt) {
   evt = (evt) ? evt : window.event;
   var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null),
         el = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
   evt.sourceFunction = 'doClick';
   ui.state.adding = 0;
   if (el.id.match(/_field/)) {
      if (ui.editing) unedit();

      if (ui.editor) {
         ui.editor.style.zIndex = '9001';
         ui.editor.style.display = 'block';
        
         if (el.firstChild) var typedef = el.firstChild.innerHTML.replace(/\(.*/, '');
         
         var tableName = el.parentNode.id.replace(/_container/, ""),
                   tre = new RegExp(tableName + "_"),
             fieldName = el.id.replace(/_field/, "").replace(tre, ""),
             attrValue = '',
                pardiv = document.getElementById(tableName+'_'+fieldName+'_field');
         
         doEdit(tableName, fieldName, typedef);
      }
   }
   //dump(evt.target);
}

function unedit(update) {
   if (ui.editing) {
      $('body').append(ui.editor);
      ui.editingNode.innerHTML = ui.oemContent;
      if (update) {
         ui.editingNode.innerHTML = "<span class='fieldDef'>"+ $("#coltype").val()+"</span> " + $("#colname").val();
      }
   }
   ui.editing = false;
}

/**
 * Handler to switch action image to 'save' icon
 *
 **/
function doChange() {
   if (ui.state.adding) return true;
   if ($("#colname").val() == ui.state.fieldName) return true;
   
   $("#save").unbind('click');
   $("#save").attr('src', 'img/save.png').click(function() { return doUpdate(); });
   /*
   var frmImg = document.getElementById('save');
   if (frmImg) {
      frmImg.src = 'img/save.png';
      frmImg.setAttribute('onclick', 'return doUpdate();');
   }
   */
   ui.state.modified = ui.state.tableName;
}

/**
 * Handler for add new field
 *
 **/
function doAdd() {
   var newli = "<li class='tableField' id='" + ui.state.tableName + '_' + $("#colname").val() + "_field'><span class='fieldDef'>" + $("#coltype").val()+"</span> " + $("#colname").val() + "</li>";
   $('#' + ui.state.tableName + '_new_field').before(newli);
   frm.tableName.value = ui.state.tableName;
   frm.fieldName.value = frm.colname.value; // ui.state.fieldName;
   frm.x.value = 'add';
   // setTimeout("document.forms['dbtool'].submit();", 100);
   sendData('cmd.php', $("#dbtool").serialize());
   unedit();
   
   return false;
}

/**
 * Handler for updating existing field
 *
 **/
function doUpdate() {
   // var frm = document.forms['dbtool'];
   frm.tableName.value = ui.state.tableName;
   frm.fieldName.value = ui.state.fieldName;
   frm.x.value = 'update';
   // setTimeout("document.forms['dbtool'].submit();", 100);
   sendData('cmd.php', $("#dbtool").serialize());
   unedit(true);
   return false;
}

/**
 * Table creation handler
 **/
function newTable() {
   var newtable = prompt("Please enter a name for your new table");

   if (!newtable) return false;
   document.dbtool.x.value = 'newtable';
   document.dbtool.newtable.value = newtable;

   sendData('cmd.php', $("#dbtool").serialize());
   // setTimeout('document.dbtool.submit();', 200);
}

/**
 * Handler for deleting existing field
 *
 **/
function doDelete() {
   unedit();
   // var frm = document.forms['dbtool'];
   frm.tableName.value = ui.state.tableName;
   frm.fieldName.value = ui.state.fieldName;
   frm.x.value = 'delete';
   sendData('cmd.php', $("#dbtool").serialize());
   // setTimeout("document.forms['dbtool'].submit();", 100);
   ui.editingNode.parentNode.removeChild(ui.editingNode);
   return false;
}

/**
 * Toggle table display
 *
 **/
function toggleTable(who) {
   var tbl = document.getElementById(who+'_container');
   
   if (tbl && tbl.style) {
      tbl.style.display = (tbl.style.display!='none') ? 'none' : 'block';
      tbl.className = 'fieldContainer';
   }

   var btn = document.getElementById(who+'_button');
   if (btn) {
      if (tbl.style.display == 'block') {
         btn.setAttribute('class', 'toggleUp');
         btn.className = 'toggleUp';
      } else {
         btn.setAttribute('class', 'toggleBtn');
         btn.className = 'toggleBtn';
      }
   }
   
   var pos = $("#table_"+who).offset();
   if (pos.left && pos.top) {
      storeValue('table_' + who, pos.left + ':' + pos.top + ':' + (($('table_'+who).css('display') =='block') ? 'none' : 'block') + ':1:0');
   }
   
   storeTable(who);
}

function sendData(url, data) {
   $.post("cmd.php", $("#dbtool").serialize(), function(data, txtStatus, xhr) { console.log(data); });
   // setTimeout("document.forms['dbtool'].submit();", 100);
   return false;
}
/**
 * Dump keys and values for passed object.  Allows recursive 
 * introspection when passed 'recurse' argument evaluates true.
 * 
 * @param obj - Object to dump
 * @param recurse - True value performs recursion
 * @param child - Used internally for tracking during recursion
 *
 **/
function dump(obj, recurse, child) {
   var dbg = '';
   for (var i in obj) {
      if ((typeof(obj[i]) != 'function') && (!i.match(/_NODE$/))) { 
         dbg += i + ': ' + obj[i] + "<br>\n";
         if (recurse && ((typeof obj[i] == 'object') || (typeof obj[i] == 'array'))) {
            dbg += dump(obj[i], recurse, 1);
         }
      }
   }

   if (!child) {
      var debugDiv = document.getElementById('debug');
      debugDiv.style.zIndex = 1;
      debugDiv.style.display = 'block';
      if (debugDiv) debugDiv.innerHTML = dbg;
   } else {
      return dbg;
   }
}

function updateLink(e, ui) {
   var canvasJq = $("#relate");
   var canvasEl = canvasJq[0];
   canvasEl.width = canvasJq.width();
   canvasEl.height = canvasJq.height();
   var cOffset = canvasJq.offset();
   var ctx = canvasEl.getContext("2d");
   ctx.clearRect(0, 0, canvasEl.width, canvasEl.height);
   ctx.beginPath();
   
   var obj = linking;
   var objID = obj.attr("id").replace(/table_/, "");
   var srcOffset = obj.offset();
   var srcHeight = 0; //obj.height()/2;
   
   var tgtEl = $("#table_"+objID);
   if (tgtEl.length) {
      var tgtOffset = tgtEl.offset();
      var tgtHeight = 0; // obj.height()/2;
      ctx.moveTo(srcOffset.left - cOffset.left, srcOffset.top - cOffset.top + srcHeight);
      ctx.lineTo(tgtOffset.left - cOffset.left, tgtOffset.top - cOffset.top + tgtHeight);
   }
   ctx.stroke();
   ctx.closePath();
}


function updateRelations(canvasJq, blkEls) {
   try {
   if (canvasJq) {
      var canvasEl = canvasJq[0];
      if (canvasEl) {
         canvasEl.width = canvasJq.width();
         canvasEl.height = canvasJq.height();

         var cOffset = canvasJq.offset(), ctx = canvasEl.getContext("2d");

         ctx.clearRect(0, 0, canvasEl.width, canvasEl.height);
         ctx.beginPath();
      }         
      related = {};
      
      $(blkEls).each(function(){
         var obj = $(this), objID = obj.attr("id").replace(/table_/, "");
         
         if (obj.attr("rel")) {
            var srcOffset = obj.offset(), links = obj.attr("rel").split(/ /);
            
            for (var l in links) {
               if (!related[links[l]]) related[links[l]] = {};
               if (!related[objID]) related[objID] = {};
 
               if (!related[links[l]][objID] && !related[objID][links[l]] ) {
                  var tgtEl = $("#table_"+links[l]);

                  if (tgtEl.length) {
                     var src, tgt, tgtOffset = tgtEl.offset();
                     
                     src = { 
                              left: (srcOffset.left - cOffset.left) + (obj.width() / 2), 
                              top: (srcOffset.top - cOffset.top) + obj.height(),
                              cx: (((tgtOffset.left - cOffset.left) - (srcOffset.left - cOffset.left)) * .25),
                              cy: (((tgtOffset.top - cOffset.top) - (srcOffset.top - cOffset.top)) * .25)
                           };
                     tgt = { 
                              left: (tgtOffset.left - cOffset.left) + (tgtEl.width() / 2),
                              top: (tgtOffset.top - cOffset.top) + tgtEl.height(),
                              cx: -(((tgtOffset.left - cOffset.left) - src.left) * .25),
                              cy: -(((tgtOffset.top - cOffset.top) - src.top) * .25)
                           };
                     ctx.moveTo(src.left, src.top);
                     ctx.bezierCurveTo(src.left + src.cx, src.top + src.cy, tgt.left + tgt.cx, tgt.top + tgt.cy, tgt.left, tgt.top);
                     // ctx.moveTo(srcOffset.left - cOffset.left, srcOffset.top - cOffset.top);
                     // ctx.lineTo(tgtOffset.left - cOffset.left, tgtOffset.top - cOffset.top);
                  }
                  related[links[l]][objID] = 1;
               }
            }
         }
      });
      ctx.lineWidth = 3;
      ctx.strokeStyle = "#09d";
      ctx.shadowOffsetX = 3;
      ctx.shadowOffsetY = 3;
      ctx.shadowBlur = 3;
      ctx.shadowColor = "rgba(0,0,0,.4)";

      ctx.stroke();
      ctx.closePath();
   }
   } catch(err) {
      // do some error handling here for Christ's sake
   }
}


//document.onmouseover = doOver;
// document.onmouseout = doOut;
document.onmousedown = doDown;
document.onmouseup = doUp;
document.onclick = doClick;

