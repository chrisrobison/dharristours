// Global vars
var ui;
var typedefs = new Array();

function UI() { }  // Cheap UI object definition

/**
* Initialize the tree.
* And to call showTree(imagePath); to actually show the tree.
* Alternatively this can be done in a script block at the bottom of the page.
* Though this method is somewhat cleaner.
 **/
function init(obj) {
   ui = new UI();
   ui.state = new Array();
   initDOMAPI();

   var container = document.getElementById('schemas');
   var tableDiv = new Array();
   var headingDiv = new Array();
   var fieldContainer = new Array();
   var row = col = 0;
   for (var d in coltypes) {
      typedefs[d] = d;
   }

   for (var tbl in obj.tables) {
      ui.state[tbl] = new Object();
      ui.state[tbl].state = 1;

      tableDiv[tbl] = document.createElement('div');
      tableDiv[tbl].setAttribute('id', 'table_' + tbl);
      tableDiv[tbl].setAttribute('class', 'tableDiv tableCol' + col + ' tableRow' + row);
      tableDiv[tbl].setAttribute('className', 'tableDiv tableCol' + col + ' tableRow' + row);
      tableDiv[tbl].setAttribute('style', 'top:' + (row * 10) + 'em;left:' + (col * 22) + 'em;');
      
      var colors = new Array(getColor(), getColor(), getColor());
      var cookiename = 'table_' + tbl;
      var stored = getCookie(cookiename);
      var xy = new Array();
      if (stored) xy = stored.split(/:/);
      
      headingDiv[tbl] = document.createElement('div');
      headingDiv[tbl].setAttribute('id', tbl + '_heading');
      headingDiv[tbl].setAttribute('class', 'tableHeading transparent');
      headingDiv[tbl].setAttribute('className', 'tableHeading transparent');
      headingDiv[tbl].setAttribute('style', 'background-color:rgb(' + colors.join(',') + ');height:16px;');
      headingDiv[tbl].setAttribute('onmousedown', "dragStart(event, 'table_" + tbl + "')");
      headingDiv[tbl].innerHTML = "<div class='toggle" + ((xy && (xy[2]=='block')) ? 'Up' : 'Btn') + "' id='"+tbl+"_button' onclick='toggleTable(\"" + tbl + "\")'> </div>" + tbl;
      
      fieldContainer[tbl] = document.createElement('div');
      fieldContainer[tbl].setAttribute('id', tbl + '_container');
      fieldContainer[tbl].setAttribute('class', 'fieldContainer');
      fieldContainer[tbl].setAttribute('className', 'fieldContainer');
      fieldContainer[tbl].setAttribute('style', 'display:none;');

      tableDiv[tbl].appendChild(headingDiv[tbl]);
      tableDiv[tbl].appendChild(fieldContainer[tbl]);
      container.appendChild(tableDiv[tbl]);
      
      if (stored) {
         if (xy[0]) tableDiv[tbl].style.left = xy[0] + 'px';
         if (xy[1]) tableDiv[tbl].style.top = xy[1] + 'px';
         fieldContainer[tbl].style.display = (xy[2]) ? xy[2] : 'none';
         if (xy[2] == 'block') tableDiv[tbl].style.zIndex = '+1';
      }

      var fieldsHTML = genHTML(obj.tables[tbl].fields, tbl, fieldContainer[tbl]);

      ++col;
      if (col > 3) {
         ++row;
         col = 0;
      }
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
function genHTML(obj, tableName, parent) {
   var myparent = parent;
   
   for (var i in obj) {
      var objID = tableName + '_' + i + '_field';
      var pkey = (obj[i].key == 'PRI') ? ' primaryKey' : '';
      var mkey = (obj[i].key == 'MUL') ? ' multiKey' : '';

      var newdiv = document.createElement('div');
      
      newdiv.setAttribute('id', objID);
      newdiv.setAttribute('class', 'tableField' + pkey + mkey);
      newdiv.setAttribute('className', 'tableField' + pkey + mkey);
      newdiv.innerHTML = "<span class='fieldDef'>" + obj[i].type + "</span>" + i;

      myparent.appendChild(newdiv);
   }

   var newdiv = document.createElement('div');
   var objID = tableName + '_new_field';
   newdiv.setAttribute('id', objID);
   newdiv.setAttribute('class', 'tableField');
   newdiv.setAttribute('className', 'tableField');
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
   evt = (evt) ? evt : window.event;
   
   if (ui.state.table) {
      var obj = document.getElementById('table_' + ui.state.dragging);
      var newX = getObjectLeft('table_' + ui.state.dragging);
      var newY = getObjectTop('table_' + ui.state.dragging);
      var objcont = document.getElementById(ui.state.dragging + '_container');

      createCookie('table_' + ui.state.dragging, newX + ':' + newY + ':' + ((objcont.style.display) ? objcont.style.display : 'none'), 100);
      ui.state.table = '';
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
 * Handle document click events
 *
 * @param evt - Event object
 *
 **/
function doClick(evt) {
   evt = (evt) ? evt : window.event;
   var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
   
   evt.sourceFunction = 'doClick';
   ui.state.adding = 0;
   if (node.id.match(/_field/)) {
      var el = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);

      var editor = document.getElementById('coltypes');
      editor.style.zIndex = '100000';
      editor.style.display = 'block';

      if (editor) {
         editor.style.top = (getTop(el) - 53) + 'px'; //  el.offsetTop + el.parentNode.offsetTop + 'px';
         editor.style.left = (getLeft(el) - 16) + 'px'; // el.parentNode.offsetLeft + 'px';
        
         if (el.firstChild) var typedef = el.firstChild.innerHTML.replace(/\(.*/, '');
         var tableName = el.id.replace(/(\w+)_(\w+)_field/, "$1");
         var fieldName = el.id.replace(/.+?_(\w+)_field/, "$1");
         var attrValue = '';
         if (el.firstChild && coltypes[typedef]) attrValue = el.firstChild.innerHTML.replace(/.+?\((.+?)\)/, "$1");

         ui.state.tableName = tableName;
         ui.state.fieldName = fieldName;

         document.getElementById('colname').value = fieldName;
         document.getElementById('colattr').value = attrValue;

         var frmImg = document.getElementById('save');
         if (frmImg && (fieldName!='new')) {
            frmImg.src = 'img/sm_delete.png';
            frmImg.setAttribute('onclick', 'return doDelete();');
         } else {
            ui.state.adding = 1;
            frmImg.src = 'img/save.png';
            frmImg.setAttribute('onclick', 'return doAdd();');

         }
         
         fillSelect('coltype', typedefs, typedef);

         document.dbtool.colname.focus();
         document.dbtool.colname.select();
      }
   }
   //dump(evt.target);
}

/**
 * Handler to switch action image to 'save' icon
 *
 **/
function doChange() {
   if (ui.state.adding) return true;
   var frmImg = document.getElementById('save');
   if (frmImg) {
      frmImg.src = 'img/save.png';
      frmImg.setAttribute('onclick', 'return doUpdate();');
   }
   ui.state.modified = ui.state.tableName;
}

/**
 * Handler for add new field
 *
 **/
function doAdd() {
   var frm = document.forms['dbtool'];
   frm.tableName.value = ui.state.tableName;
   frm.fieldName.value = ui.state.fieldName;
   frm.x.value = 'add';
   setTimeout("document.forms['dbtool'].submit();", 100);
   return false;
}

/**
 * Handler for updating existing field
 *
 **/
function doUpdate() {
   var frm = document.forms['dbtool'];
   frm.tableName.value = ui.state.tableName;
   frm.fieldName.value = ui.state.fieldName;
   frm.x.value = 'update';
   setTimeout("document.forms['dbtool'].submit();", 100);
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

   setTimeout('document.dbtool.submit();', 200);
}

/**
 * Handler for deleting existing field
 *
 **/
function doDelete() {
   var frm = document.forms['dbtool'];
   frm.tableName.value = ui.state.tableName;
   frm.fieldName.value = ui.state.fieldName;
   frm.x.value = 'delete';
   setTimeout("document.forms['dbtool'].submit();", 100);
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
      btn.setAttribute('class', (tbl.style.display=='block') ? 'toggleUp' : 'toggleBtn');
      btn.className = (tbl.style.display=='block') ? 'toggleUp' : 'toggleBtn';
   }
   var tbltop = getObject('table_' + who);
   var newX = getObjectLeft('table_' + who);
   var newY = getObjectTop('table_' + who);

   createCookie('table_' + who, newX + ':' + newY + ':' + ((tbl.style.display) ? tbl.style.display : 'none'), 100);
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

document.onmouseover = doOver;
document.onmouseout = doOut;
document.onmousedown = doDown;
document.onmouseup = doUp;
document.onclick = doClick;

