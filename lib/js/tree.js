var editframe, editor, dragObj, user, sitetree;
var ui = new UI();
var content = new Content();
var undodiv, undoparent;

function UI() {
   this.keystate = new Object();
   this.editing = 'node_1';
   this.state = new Array();
   this.drag = new Object();
   this.editopen = 1;
   this.loading = 0;
}

function Outline() { 

}

function Content(id, outliner_id, node, user_id, version, content) {
   this.id = id;
   this.outliner_id = outliner_id;
   this.node = node;
   this.user_id = user_id;
   this.version = version;
   this.content = content;
}

function Tree() {
   this.children = new Array();
}

if (!outline) {
   var outline = new Outline();
   outline.edit = true;
}

/**
 * Define key capture definitions.
 *
 * 'keyDefs' array is keyed by the value returned by the keyCode function on the keypress event
 * and is defined with an anonymous object that can take the following properties:
 * 
 * cmd - Function to call for plain keypress
 * shiftKey - Function to call if the SHIFT key is active at keypress 
 * ctrlKey - Function to call if the CTRL key is active at keypress
 * metaKey - Function to call if the META key (varies depending on OS) is active at keypress
 * ctrlshiftKey - Function to call if the SHIFT and CTRL keys are active at keypress
 *
 */
var keyDefs = new Array();

if (outline.edit) {
   // Escape
   // keyDefs[27] = { cmd:'unedit(evt, 1)' };
   // Enter
   // keyDefs[13] = { cmd:'addSibling(evt)', shiftKey:'doEnter(evt)', ctrlKey:'return true;' };
   // keyDefs[13] = { cmd:'editDocument(evt)', shiftKey:'doEnter(evt)', ctrlKey:'return true;' };
   // keyDefs[113] = { cmd:'selectNode(evt)' };
   // Tab
   // keyDefs[9] = { cmd:'addChild(evt)', shiftKey:'addParentSibling(evt)' };
   // keyDefs[25] = { shiftKey:'addParentSibling(evt)' };
   // Delete Key
   // keyDefs[46] = { cmd:'rmNode(evt)' };
   // keyDefs[8] = { cmd:'rmNode(evt)' };
}
// Up arrow 
keyDefs[38] = { cmd:'focusUp(evt)' };
keyDefs[63232] = { cmd:'focusUp(evt)' };
// Down arrow 
keyDefs[40] = { cmd:'focusDown(evt)' };
keyDefs[63233] = { cmd:'focusDown(evt)' };
// Left arrow
keyDefs[37] = { cmd:'closeBranch(evt)' };
keyDefs[63234] = { cmd:'closeBranch(evt)' };
// Right arrow 
keyDefs[39] = { cmd:'openBranch(evt)' };
keyDefs[63235] = { cmd:'openBranch(evt)' };
// Ctrl-Z
keyDefs[90] = { ctrlKey: 'undo()' };
keyDefs[122] = { ctrlKey: 'undo()' };
// Page up
// keyDefs[33] = { cmd:'pageUp(evt)' };
// Page down
// keyDefs[34] = { cmd:'pageDown(evt)' };

/**
 * Handler for when enter key is pressed. 
 * Action taken is determined by the current state of focus/editing
 *
 * @param evt - event object
 **/
function doEnter(evt) {
   evt = (evt) ? evt : window.event;
   
   try {
      if (ui.editopen) {
         unedit(evt);
         focusNode(ui.viewing);
      } else {
         selectNode(ui.viewing);
         ui.editing = ui.viewing;
      }
   } catch(e) {
      errorHandler(e);
   }
 
}

function updateTree(path, data) {
   var root = path; // Should root be removed now that we're retaining the '/' character in pathnames? Leaving in for now...
   
   var childroot = getObject(root+'_children');
   if (childroot) {
      var parentnode = childroot.parentNode;
      parentnode.removeNode(childroot);
      createChildContainer(root);
   }
   buildTree('node'+path, data, 'node'+path);
   
   var cur = getFile(path);
   cur = data;
}

function buildTree(root, data, path) {
   var rootnode = getObject(root);
   var mynode, icon;
   for (var i in data) {
      icon = (typeof(data[i]) == 'string') ? 'node' : 'branch_closed';
      
      if ((typeof(data[i]) == 'array') || (typeof(data[i]) == 'object')) {
         mynode = addBranch(i, root, icon, true, i);

         if (mynode) {
            mynode.setAttribute('class', 'branch_closed');
            mynode.setAttribute('className', 'branch_closed');
            var childs = getObject(mynode.id+'_children');
            if (childs) {
               childs.style.display='none';
               ui.state[mynode.id] = 0;
            }
         }
         buildTree(root+'/'+i, data[i], path+'/'+i);
      } else {
         mynode = addBranch(i, root, icon, false, i);
         if (mynode) {
            mynode.setAttribute('class', 'node');
            mynode.setAttribute('className', 'node');
         }
      }
   }
}

function buildNavTree(root, data, current) {
   var rootnode = getObject(root);
   var rootchildren = getObject(root+'_children');
   if (!rootchildren) {
      rootchildren = document.createElement('div');
      rootchildren.setAttribute('id', root+'_children');
      rootchildren.className = 'node_children';
      rootnode.appendChild(rootchildren);
   }
   var mynode, icon;
   
   for (var i in data) {
      // icon = (typeof(data[i]) == 'string') ? 'node nav' : 'branch_closed nav';
      icon = (data[i].NavID==current) ? (data[i].HasChild==1  ? ' withSubChildren ' : '') + data[i].ClassName + 'Selected' : data[i].ClassName;
      if (data[i]._children) {
         mynode = addNavBranch(data[i].NavID, i, root, icon, true);

         if (mynode) {
            var childs = getObject(mynode.id+'_children');
            if (childs) {
               ui.state[mynode.id] = 0;
            }
         }
         buildNavTree(mynode.id, data[i]._children, current);
      } else {
         mynode = addNavBranch(data[i].NavID, i, root, icon, false);
         if (mynode) mynode.className = icon;
      }
   }

   if (current) {
      showNode(current, 1);
   }
}

function compareBigInt(x1, x2) {
   x1 = parseInt(x1);
   x2 = parseInt(x2);
   while (x2 > 1073741824) {
      x1 = x1 / 2;
      x2 = x2 / 2;
   }
   return x1 & x2;
}

function buildAccessTree(root, data, user) {
   var root = $(root), out = '<ul class="tree">', me, modbox, procbox, checked; 
   
   for (var i in data) {
      if (data.hasOwnProperty(i)) {
         me = data[i];
         checked = (parseInt(me.Access) & parseInt(user.Access)) ? " checked='checked'" : "";
         modbox = "<input type='checkbox' id='Mod" + me.ModuleID + "' rel='" + me.Access + "'" + checked + " class='modbox' onclick='upMod(this)'>";
         out += "<li id='Module" + me.ModuleID + "' class='module branch_closed' rel='" + me.Access + "'>" + modbox + i;
         if (me._children) {
            out += "<ul id='Module" + me.ModuleID + "_children' class='module-children' style='display:none'>";
            for (var j in me._children) {
               pr = me._children[j];
               checked = (parseInt(pr.Access) & parseInt(user.ProcessAccess)) ? " checked='checked'" : "";
               procbox = "<input type='checkbox' id='Proc" + pr.ProcessID + "' rel='" + pr.Access + "'" + checked + " class='procbox' onclick='upProc(this)'>";
               out += "<li id='Process" + pr.ProcessID + "' rel='" + pr.Access + "'>" + procbox + pr.Process + "</li>";
            }
            out += "</ul>";
         }
         out += "</li>";
      }
   }
   out += "</ul>";

   root.html(out);
}

function upProc() {
   var access = 0;
   $(".procbox").each(function() {
      var bit = parseInt($(this).attr("rel")),
          checked = $(this).is(":checked");
      if (checked && !(access & bit)) {
         console.log("Process "+$(this).attr('id')+"checkbox checked with unflagged bit.  Setting bit: " + bit + ".  Access now at " + (access + bit));
         access = access + bit;
      } else {
         console.log("Process "+$(this).attr('id')+"checkbox *NOT* checked.  Access remains at "+access);
      }
   });

   $("#ProcessAccess").val(access);
   
   return access;
}

function upMod(who) {
   var access = 0;
   $(who).attr("checked", "checked");
   $(".modbox").each(function() {
      var bit = parseInt($(this).attr("rel")),
          checked = $(this).is(":checked");
      
      console.log("Process "+$(this).attr('id')+"checkbox checked with unflagged bit.  Setting bit: "+bit+ ".  Access now at "+(access+bit));
      if (checked && !(access & bit)) {
         access = access + bit;
      } else {
         console.log("Process "+$(this).attr('id')+"checkbox *NOT* checked.  Access remains at "+access);
      }
   });

   $("#Access").val(access);

   return access;
}
function buildModuleTree(root, data, user) {
   var rootnode = getObject(root+"_children");
   $("#"+root+"_children").html("<hr>");
   var mynode, icon, maccess, paccess;
   var maccess = (user && user.Access) ? parseInt(user.Access) : 0;
   var paccess = (user && user.ProcessAccess) ? parseInt(user.ProcessAccess) : 0;
   var disabled = "";
   for (var i in data) {
      icon = 'branch_closed';
      if (data[i]['_children']) {
         // var disabled = (data[i]['Access'] & 1) ? " disabled='disabled'" : "";
         sel = (compareBigInt(maccess, data[i]['Access']) ? "checked='true'" : '' );
         mynode = addBranch("<input type='checkbox' rel='bit_module_"+data[i]['Access']+"' class='Access' onchange=\"updateAccess('Access', (this.checked) ? this.value : 0, this);doModify($('#Access'));\" name='Module" + data[i]['ModuleID'] + "Bit" + data[i]['Access'] + "' value='" + data[i]['Access'] + "' default='" + data[i]['Access'] + "' " + sel + disabled + " />"+i, root, icon, true, 'Mod_'+data[i]['ModuleID']);

         if (mynode) {
            mynode.setAttribute('class', 'branch_closed');
            mynode.setAttribute('className', 'branch_closed');
            var childs = getObject(mynode.id+'_children');
            if (childs) {
               childs.style.display='none';
               ui.state[mynode.id] = 0;
            }
         }
         
         var proc, txt, sel;
         for (var c in data[i]['_children']) {
            proc = data[i]['_children'][c];
            // var disabled = (proc['Access'] & 1) ? " disabled='disabled'" : "";
            sel = (compareBigInt(paccess, proc['Access']) ? "checked='true'" : '' );
            txt = "<input type='checkbox' rel='bit_process_" + proc['Access'] + "' class='ProcessAccess' onchange=\"updateAccess('ProcessAccess', (this.checked) ? this.value : 0, this);doModify($('#ProcessAccess'));\" name='Process" + proc['ProcessID'] + "Bit" + proc['Access'] + "' value='" + proc['Access'] + "' default='" + proc['Access'] + "' " + sel + disabled + " />" + proc['Process'];

            procnode = addBranch(txt, mynode.id, 'node', false, 'Proc_'+proc['ProcessID']);
         
            if (procnode) {
               procnode.setAttribute('class', 'node');
               procnode.setAttribute('className', 'node');
            }
         }
      } else {
         // var disabled = (data[i]['Access'] & 1) ? " disabled='disabled'" : "";
         mynode = addBranch("<input type='checkbox' rel='bit_module_"+data[i]['Access']+"' class='Access' onchange=\"updateAccess('Access', (this.checked) ? this.value : 0, this);doModify($('#Access'));\" name='Module" + data[i]['ModuleID'] + "' value='" + data[i]['Access'] + "Bit" + data[i]['Access'] + "' default='" + data[i]['Access'] + "' " + (compareBigInt(maccess, data[i]['Access']) ? "checked='true'" : '' ) + disabled + " />"+i, root, 'node', false, 'Mod_'+data[i]['ModuleID']);
         if (mynode) {
            mynode.setAttribute('class', 'node');
            mynode.setAttribute('className', 'node');
         }
      }
   }
}

function buildModulePrefTree(root, data, user) {
   var rootnode = getObject(root+"_children");
   $("#"+root+"_children").html("<hr>");
   var mynode, icon, maccess, paccess;
   user.ModulePref = parseInt(user.ModulePref);
   user.ProcessPref = parseInt(user.ProcessPref);
   user.Access = parseInt(user.Access);
   user.ProcessAccess = parseInt(user.ProcessAccess);
   
   var maccess = (user && user.ModulePref) ? parseInt(user.ModulePref) : user.Access;
   var paccess = (user && user.ProcessPref) ? parseInt(user.ProcessPref) : user.ProcessAccess;
   var disabled = "";
   
   for (var i in data) {
      icon = 'branch_closed';
      if (data[i]['_children']) {
         // var disabled = (data[i]['Access'] & 1) ? " disabled='disabled'" : "";
         sel = (compareBigInt(maccess, data[i]['Access']) ? "checked='true'" : '' );
         mynode = addBranch("<input type='checkbox' rel='bit_module_"+data[i]['Access']+"' class='Access' onchange=\"updateAccess('Access', (this.checked) ? this.value : 0, this);doModify($('#Access'));\" name='Module" + data[i]['ModuleID'] + "Bit" + data[i]['Access'] + "' value='" + data[i]['Access'] + "' default='" + data[i]['Access'] + "' " + sel + disabled + " />"+i, root, icon, true, 'Mod_'+data[i]['ModuleID']);

         if (mynode) {
            mynode.setAttribute('class', 'branch_closed');
            mynode.setAttribute('className', 'branch_closed');
            var childs = getObject(mynode.id+'_children');
            if (childs) {
               childs.style.display='none';
               ui.state[mynode.id] = 0;
            }
         }
         
         var proc, txt, sel;
         for (var c in data[i]['_children']) {
            proc = data[i]['_children'][c];
            // var disabled = (proc['Access'] & 1) ? " disabled='disabled'" : "";
            sel = (compareBigInt(paccess, proc['Access']) ? "checked='true'" : '' );
            txt = "<input type='checkbox' rel='bit_process_" + proc['Access'] + "' class='ProcessAccess' onchange=\"updateAccess('ProcessAccess', (this.checked) ? this.value : 0, this);doModify($('#ProcessAccess'));\" name='Process" + proc['ProcessID'] + "Bit" + proc['Access'] + "' value='" + proc['Access'] + "' default='" + proc['Access'] + "' " + sel + disabled + " />" + proc['Process'];

            procnode = addBranch(txt, mynode.id, 'node', false, 'Proc_'+proc['ProcessID']);
         
            if (procnode) {
               procnode.setAttribute('class', 'node');
               procnode.setAttribute('className', 'node');
            }
         }
      } else {
         // var disabled = (data[i]['Access'] & 1) ? " disabled='disabled'" : "";
         mynode = addBranch("<input type='checkbox' rel='bit_module_"+data[i]['Access']+"' class='Access' onchange=\"updateAccess('Access', (this.checked) ? this.value : 0, this);doModify($('#Access'));\" name='Module" + data[i]['ModuleID'] + "Bit" + data[i]['Access'] + "' value='" + data[i]['Access'] + "' default='" + data[i]['Access'] + "' " + (compareBigInt(maccess, data[i]['Access']) ? "checked='true'" : '' ) + disabled + " />"+i, root, 'node', false, 'Mod_'+data[i]['ModuleID']);
         if (mynode) {
            mynode.setAttribute('class', 'node');
            mynode.setAttribute('className', 'node');
         }
      }
   }
}

function buildPrefTree(root, data, user) {
   var rootnode = getObject(root);
   var mynode, icon;
   var maccess = (user && user.ModulePref) ? user.ModulePref : 0;
   var paccess = (user && user.ProcessPref) ? user.ProcessPref : 0;

   for (var i in data) {
      icon = 'branch_closed';
      if (data[i]['_children']) {

         mynode = addBranch("<input type='checkbox' rel='bit_module_"+data[i]['Access']+"' onchange=\"updateAccess('Access', (this.checked) ? this.value : 0, this)\" name='Module" + data[i]['ModuleID'] + "' value='" + data[i]['Access'] + "' " + (compareBigInt(maccess, data[i]['Access']) ? "checked='true'" : '' ) + " />"+i, root, icon, true, 'Mod_'+data[i]['ModuleID']);
         // mynode = addBranch("<input type='checkbox' onchange=\"(this.checked)?updateAccess('ModulePref', this.value) : updateAccess('ModulePref', -(this.value));\" name='Module" + data[i]['ModuleID'] + "' value='" + data[i]['Access'] + "' " + (compareBigInt(maccess, data[i]['Access']) ? "checked='true'" : '' ) + " />"+i, root, icon, true);

         if (mynode) {
            mynode.setAttribute('class', 'branch_closed');
            mynode.setAttribute('className', 'branch_closed');
            var childs = getObject(mynode.id+'_children');
            if (childs) {
               childs.style.display='none';
               ui.state[mynode.id] = 0;
            }
         }
         
         var proc, txt, sel;
         for (var c in data[i]['_children']) {
            proc = data[i]['_children'][c];
            sel = (compareBigInt(paccess, proc['Access']) ? 'CHECKED' : '' );
            
            txt = "<input type='checkbox' rel='bit_process_" + proc['Access'] + "' onchange=\"updateAccess('ProcessAccess', (this.checked) ? this.value : 0, this);\" name='Process" + proc['ProcessID'] + "' value='" + proc['Access'] + "' " + sel + " />" + proc['Process'];
            procnode = addBranch(txt, mynode.id, 'node', false, 'Proc_'+proc['ProcessID']);
            // txt = "<input type='checkbox' onchange=\"updateAccess('ProcessPref', ((this.checked) ? this.value : -(this.value)));\" name='Process" + proc['ProcessID'] + "' value='" + proc['Access'] + "' " + sel + " />" + proc['Process'];

            //procnode = addBranch(txt, mynode.id, 'node', false);
         
            if (procnode) {
               procnode.setAttribute('class', 'node');
               procnode.setAttribute('className', 'node');
            }
         }
      } else {
         mynode = addBranch("<input type='checkbox' rel='bit_module_"+data[i]['Access']+"' onchange=\"updateAccess('Access', (this.checked) ? this.value : 0, this)\" name='Module" + data[i]['ModuleID'] + "' value='" + data[i]['Access'] + "' " + (compareBigInt(maccess, data[i]['Access']) ? "checked='true'" : '' ) + " />"+i, root, 'node', false, 'Mod_'+data[i]['ModuleID']);
         //mynode = addBranch("<input type='checkbox' onchange=\"(this.checked)?updateAccess('Access', this.value) : updateAccess('Access', -(this.value));\" name='Module" + data[i]['ModuleID'] + "' value='" + data[i]['Access'] + "' " + (compareBigInt(maccess, data[i]['Access']) ? 'checked="true"' : '' ) + "/>"+i, root, 'node', false);
         if (mynode) {
            mynode.setAttribute('class', 'node');
            mynode.setAttribute('className', 'node');
         }
      }
   }
}

var junkID = 0;
var id, txt, par, icon, dochild;
function addNavBranch(id, txt, par, icon, dochild) {
   txt = (arguments[1]) ? arguments[1] : 'Unknown';
   id = (arguments[0]) ? arguments[0] : junkID++;

   try {
      var newnode = 'Nav_' + id;
      var myparent = getObject(par);

      if (myparent) {
         // Create our new node
         var newchild = mkNode(newnode, icon, txt);
         
         // Grab child container for our parent, creating one if necessary
         var childContainer = getObject(par + '_children');
         if (!childContainer) {
            childContainer = createChildContainer(par);
            childContainer.style.display = 'none';
         }
         
         // Append our new node to parent child container
         if (newchild) childContainer.appendChild(newchild);
         
         // Add child container for our new node if requested
         if (dochild) {
            var check = getObject(newnode + '_children');
            if (!check) {
               var newchildContainer = mkNode(newnode+'_children', 'children', ''); 
               newchildContainer.style.display = 'none';
               childContainer.appendChild(newchildContainer);
            }
         }
       }
   } catch(e) {
      errorHandler(e);
   }
   return newchild;
}

function addBranch(txt, par, icon, dochild, newnode) {
   txt = (txt) ? txt : 'Unknown';

   try {
      if (!newnode) newnode = "node_"+Date.now();
      var myparent = getObject(par);

      if (myparent) {
         // Create our new node
         var newchild = mkNode(newnode, icon, txt);
         
         // Grab child container for our parent, creating one if necessary
         var childContainer = getObject(par + '_children');
         if (!childContainer) {
            childContainer = createChildContainer(par);
            childContainer.style.display = 'none';
         }
         
         // Append our new node to parent child container
         if (newchild) childContainer.appendChild(newchild);
         
         // Add child container for our new node if requested
         if (dochild) {
            var check = getObject(newnode + '_children');
            if (!check) {
               var newchildContainer = mkNode(newnode+'_children', 'children', ''); 
               childContainer.appendChild(newchildContainer);
            }
         }
       }
   } catch(e) {
      errorHandler(e);
   }
   return newchild;
}


function addSibling(evt, txt, par) {
   evt = (evt) ? evt : window.event;
   txt = (txt) ? txt : 'New Outline Item';

   try {
      var curObj = (par) ? par : ((ui.viewing) ? ui.viewing : ui.editing );
      
      if (ui.editing) unedit(evt, ui.editing);
      if (ui.focus) unfocus(ui.focus);

      var mysister = getObject(curObj);
      var myparent = mysister.parentNode;

      if (myparent) {
         var newnode = myparent.id.replace(/_children/, '') + '_' + myparent.childNodes.length; 
         var newchild = mkNode(newnode, 'node', txt); 
         
         ui.state[myparent.id+'_children'] = 1;
         if (mysister && mysister.nextSibling && mysister.nextSibling.id && (!mysister.nextSibling.id.match(/_children/))) {
            myparent.insertBefore(newchild, mysister.nextSibling);  
         } else {
            myparent.appendChild(newchild);
         }
         focusNode(newnode);
      }
      if (newnode) setTimeout("selectNode('"+newnode+"');", 50);
   } catch(e) {
      errorHandler(e);
   }

   return blockEvent(evt);
}

function addChild(evt, txt, par) {
   evt = (evt) ? evt : window.event;
   txt = (txt) ? txt : 'New Outline Item';

   try {
      if (ui.editing) unedit(evt);
      if (ui.focus) unfocus(ui.focus);

      var curObj = (par) ? par : ((ui.viewing) ? ui.viewing : ui.editing );
      var myparent = getObject(curObj);
      var children = getObject(curObj + '_children');
      
      if (children) {
         var newnode = curObj + '_' + children.childNodes.length;
      } else {
         var newnode = curObj + '_' + 1;
      }

      if (myparent) {
         var newchild = mkNode(newnode, 'node', txt); 

         if (!children) {
            var childwrap = document.createElement('div');
            childwrap.setAttribute('id', myparent.id + '_children');
            childwrap.setAttribute('class', 'children');
            myparent.className = 'branch_open';
            myparent.setAttribute('class', 'branch_open');
            
            if (myparent.nextSibling) {
               myparent.parentNode.insertBefore(childwrap, myparent.nextSibling);
            } else {
               myparent.parentNode.appendChild(childwrap);
            }
            var children = getObject(myparent.id + '_children');
         } else {
            children.style.display = 'none';
         }
         ui.state[myparent.id+'_children'] = 1;
         
         if (newchild) children.appendChild(newchild);
         if (newnode && !par) {
            focusNode(newnode);
            setTimeout("selectNode('"+newnode+"');", 50);
         }
      }
   } catch(e) {
      errorHandler(e);
   }

   return blockEvent(evt);
}

function addParentSibling(evt, txt, par) {
   evt = (evt) ? evt : window.event;
   txt = (txt) ? txt : 'New Outline Item';

   try {
      if (ui.editing) updateContent(evt);
      if (ui.focus) unfocus(ui.focus);
      
      var curObj = (par) ? par : ((ui.viewing) ? ui.viewing : ui.editing );
      var currentNode = getObject(curObj);

      var parentid = 0;
      var checker = currentNode.parentNode;

      var parentid = (currentNode.parentNode && currentNode.parentNode.nodeType == 3) ? currentNode.parentNode.parentNode.id : currentNode.parentNode.id;
      
      if (parentid) var myparent = getObject(parentid);
      if (myparent && myparent.parentNode) var grandparent = myparent.parentNode;

      if ((parentid!='node_children') && grandparent && grandparent.id) {
         var newnode = grandparent.id.replace(/_children/, '') + '_' + grandparent.childNodes.length; 
      } else {
         var grandparent = getObject('node_children');
         var newnode = 'node_' + grandparent.childNodes.length;
      }
      var newchild = mkNode(newnode, 'node', 'New Outline Item'); 

      ui.state[grandparent.id+'_children'] = 1;
      if (myparent && myparent.nextSibling) {
         grandparent.insertBefore(newchild, myparent.nextSibling.nextSibling);  
      } else {
         grandparent.appendChild(newchild);
      }

      if (newnode) {
         focusNode(newnode);
         setTimeout("selectNode('"+newnode+"');", 50);
      }
   } catch(e) {
      errorHandler(e);
   }
   
   return blockEvent(evt);
}

function mkNode(id, classname, txt) {
   try {
      var xnode = document.createElement('div');
      xnode.setAttribute('id', id);
      xnode.className = classname;
      xnode.onclick = nodeClick;
      xnode.innerHTML = txt;
   } catch(e) {
      errorHandler(e);
   }

   return xnode;
}

function rmNode(evt) {
   evt = (evt) ? evt : window.event;
   
   try {
      
      if (!ui.editopen && ui.focus) {
         var currentNode = getObject(ui.focus);
         if (currentNode) {
            undoparent = currentNode.parentNode;
            undodiv = undoparent.removeChild(currentNode);
         }
      }
      var editframe = getObject('editframe');
      if (editframe && (editframe.value!='')) {
         return true;
      } else { 
         unedit(evt, true);
         var currentNode = getObject(ui.editing);
         if (currentNode) {
            ui.undo = currentNode.parentNode.removeChild(currentNode);
         }
         return blockEvent(evt);
      }
   } catch(e) {
      errorHandler(e);
   }
   return false;
}

function createChildContainer(who) {
   try { 
      var check = getObject(who+"_children");
      if (check) return check;

      var myparent = (typeof(who)=='string') ? getObject(who) : who;
      var childwrap = document.createElement('div');

      childwrap.setAttribute('id', myparent.id + '_children');
      childwrap.setAttribute('class', 'children');
      myparent.setAttribute('class', 'branch_open');
      myparent.className = 'branch_open';
      
      if (myparent.nextSibling) {
         myparent.parentNode.insertBefore(childwrap, myparent.nextSibling);
      } else {
         myparent.parentNode.appendChild(childwrap);
      }

      ui.state[myparent.id + '_children'] = 1;
   } catch(e) {
      errorHandler(e);
   }

   return childwrap;
}

function closeBranch(evt) {
   evt = (evt) ? evt : window.event;
   
   try {
      if (ui.editopen == 1) {
         return true;
      } else if (ui.viewing) {
         var curview = getObject(ui.viewing);
         var viewChildren = getObject(ui.viewing+'_children');
         if ((viewChildren && viewChildren.style.display == 'none') || (!viewChildren)) {
            if (curview.parentNode.id.match(/^node/)) {
               var newnode = curview.parentNode.id.replace(/_children/, '');
               focusNode(newnode);
               return blockEvent(evt);
            }
         } else {
            toggleBranch(ui.viewing);
         }
      }
   } catch(e) {
      errorHandler(e);
   }
   return false;
}

function openBranch(evt) {
   evt = (evt) ? evt : window.event;
   
   try {
      if (ui.editopen == 1) {
         return true;
      } else if (ui.viewing) {
         var curview = getObject(ui.viewing);
         var viewChildren = getObject(ui.viewing+'_children');
         if (viewChildren && viewChildren.style.display == 'none') {
            toggleBranch(ui.viewing);
            return blockEvent(evt);
         } else if (viewChildren) {
            focusNode(viewChildren.firstChild);
         }
      }
   } catch(e) {
      errorHandler(e);
   }
   return true;
}

function selectNode(node) {
   return true;
   try {
      node = (!node) ? ui.viewing : node;
      var nodeobj = (typeof(node) == 'string') ? getObject(node) : node;
      if (!nodeobj) return false;

      if (outline.edit) {
         var editor = getObject('editframe');
         var editwrap = getObject('editwrap');
         
         if (editwrap && (nodeobj.parentNode.id.match(/^node/))) {
            editor.style.display = 'block';
            editwrap.style.display = 'block';
            
            nodeobj.parentNode.appendChild(editwrap);
            editwrap.style.top = nodeobj.offsetTop + 'px';
            editwrap.style.left = nodeobj.offsetLeft + 'px';
            editwrap.style.height = getObjectHeight(nodeobj) + 'px';
            editor.style.height = getObjectHeight(nodeobj) + 'px';
            editwrap.style.width = '40em';
            
            try {
               if (editor) {
                  editor.value = nodeobj.innerHTML;
                  editor.className = 'editing';
                  
                  if (editor.setSelectionRange) {
                     try { 
                        editor.selectionStart = 0;
                        editor.selectionEnd = parseInt(editor.textLength);
                     } catch(e) { }
                     editor.focus();
                  }
                  setTimeout("getObject('editframe').focus();", 1500);
               }
            } catch(e) { errorHandler(e); }
         }
      } else {
         if (ui.selected) {
            getObject(ui.selected).style.backgroundColor = 'transparent';
         }
         nodeobj.style.backgroundColor = '#ffffcc';
         ui.editopen = 1;
         ui.viewing = ui.focus = ui.editing = nodeobj.id;
         ui.selected = nodeobj.id;
      }
      ui.editopen = 1;
      ui.viewing = ui.focus = ui.editing = nodeobj.id;
      ui.selected = nodeobj.id;
   } catch(e) {
      errorHandler(e);
   };
   return true;
}

function unfocus(who) {
   who = (who) ? who : ui.focus;

   try {
      var nodeobj = getObject(who);

      var fclass = nodeobj.className.replace(/ focused/i, '');
      var fclass = fclass.replace(/focused/i, '');
      if (nodeobj) {
         nodeobj.setAttribute('class', fclass);
         nodeobj.setAttribute('className', fclass);
      }
      ui.lastfocus = who;
      ui.focusclass = '';
      ui.focus = '';
   } catch(e) {
      errorHandler(e);
   }

}

function focusNode(node) {
   try {
      ui.lastfocus = ui.viewing;
      if (ui.focus) unfocus(ui.focus);
      if (ui.viewing) unfocus(ui.viewing);
      var nodeobj = (typeof(node)=='string') ? getObject(node) : node;
      if (ui.editopen) unedit();
      if (!nodeobj || (!nodeobj.id.match(/^node/))) {
         return false;
      }
      ui.viewing = nodeobj.id;
      ui.focus = nodeobj.id;
      ui.focusclass = nodeobj.className;
      nodeobj.setAttribute('class', ui.focusclass + ' focused');
      nodeobj.setAttribute('className', ui.focusclass + ' focused');
      
      setTimeout("viewFile('"+nodeobj.id+"')", 50);
   } catch(e) { 
      errorHandler(e);
   }
   return false;
}

function updateDocument(cnt) {
   content = cnt;
   var editframe = getObject('editDoc');
   if (editframe) {
      editframe.contentWindow.document.getElementById('rte1').contentWindow.document.body.innerHTML = content.content;
   }
}

function viewFile(who) {
   if (!who) return false;
   
   var editframe = getObject('editDoc');
   if (editframe) {
      return(editframe.contentWindow.document.location.href = 'icons.php?up=' + who);
   }
}

function editDocument(evt, who) {
   evt = (evt) ? evt : window.event;
   
   who = ui.focus;
   if (!who) return false;
   
   var editframe = getObject('editDoc');
   if (editframe) {
      var mydoc = editframe.contentWindow.document.getElementById('rte1').contentWindow.document.location.href = 'editor.php?up=' + who;
   }
   return true;
}

function getFile(path) {
   path = path.replace(/^node\//, '');
   var pieces = path.split(/\//);
   
   var cur = files;

   for (var i in pieces) {
      if (cur[pieces[i]]) {
         cur = cur[pieces[i]];
      }
   }
   return(cur);
}

function getFiles(path) {
   if (!ui.files) ui.files = new Array();
   if (ui.files[path]) return true;
   ui.files[path] = 1;

   var transport = getObject('transporter');
   return transport.contentWindow.document.location.href = 'files.php?up='+path;
}


function focusUp(evt) {
   evt = (evt) ? evt : window.event;
   
   try {
      if (ui.editing) updateContent(evt);
      if (!ui.viewing) ui.viewing = ui.focus = 'node_1';

      var currentNode = getObject(ui.viewing);
      var newnode = '';
      var seek;
      if (currentNode) {
         if ((currentNode.parentNode.id == 'node_children') && (!currentNode.previousSibling)) {
            return true;
         }
         if (currentNode.previousSibling) {
            seek = currentNode.previousSibling;

            while (seek && seek.nodeType != 1) {
               seek = seek.previousSibling;
            }

            if (seek && seek.id == 'node_children') seek = null;
            
            if (seek && seek.id && seek.id.match(/_children/)) {
               seek = seek.previousSibling;
               while (seek && seek.nodeType != 1) {
                  seek = seek.previousSibling;
               }
               if (seek && seek.id == 'node_children') 
                  seek = null;
            }

            if (seek) {
               var sibkids = getObject(seek.id + '_children');
               if (sibkids && sibkids.style.display!='none') {
                  while (sibkids && sibkids.lastChild && sibkids.style.display!='none') {
                     seek = sibkids.lastChild;
                     
                     if (seek && seek.id && seek.id.match(/_children/)) 
                        seek = seek.previousSibling;

                     sibkids = getObject(seek.id + '_children');
                  }
               }
            }
         } else {
            seek = currentNode.parentNode.previousSibling;
         }
         
         if (seek && seek.id) { 
            newnode = seek.id; 
            setStatus('focusUp(evt) - ' + seek.id);
         }
      }
      
      if (newnode) {
         ui.viewing = newnode;
         setTimeout("focusNode('"+newnode+"');", 50);
         var el = getObject(newnode);
         var root = getObject('node_children');
         var tmp = el;
         var stop = el.offsetTop;

         while (tmp.parentNode.id!='node_children') {
            stop += tmp.parentNode.offsetTop;
            tmp = tmp.parentNode;
         }
         if (stop < root.scrollTop) {
            el.scrollIntoView(true);
            root.scrollLeft = 0;
         }
 
      }

   } catch(e) {
      errorHandler(e);
   };

   return blockEvent(evt);
}

function focusDown(evt) {
   evt = (evt) ? evt : window.event;
   
   try {
      if (ui.editing) unedit(evt);
      // if (!ui.viewing) ui.viewing = ui.focus = 'node_1';

      var currentNode = getObject(ui.viewing);
      var newnode = '';
      var seek='';
      if (currentNode) {
         while (!seek) {
            if (currentNode.nextSibling) {
               seek = (currentNode.nextSibling.nodeType == 3) ? currentNode.nextSibling.nextSibling : currentNode.nextSibling;
            } else {
               currentNode = currentNode.parentNode;
            } 
         }

         var cnt = 0;
         while (!newnode) {
            cnt++;
            if (seek && seek.id && (!seek.id.match(/_children/) && (seek.id.match(/^node/)))) {
               newnode = seek.id;
            } else if (seek && seek.id && (seek.id.match(/_children/))) {
               var p = seek.id.replace(/_children/);
               if ((seek.style.display!='none') || (ui.state[p])) {
                  seek = seek.firstChild; 
               } else {
                  seek = (seek.nextSibling && seek.nextSibling.nodeType == 3) ? seek.nextSibling.nextSibling : seek.nextSibling;
               }
            } else {
               if (seek && seek.nextSibling) {
                  seek = (seek.nextSibling.nodeType == 3) ? seek.nextSibling.nextSibling : seek.nextSibling;
               } else if (currentNode.parentNode && currentNode.parentNode.nextSibling) {
                  seek = (currentNode.parentNode.nextSibling.nodeType == 3) ? currentNode.parentNode.nextSibling.nextSibling : currentNode.parentNode.nextSibling;
               } else if (currentNode.parentNode.parentNode && currentNode.parentNode.parentNode.nextSibling) {
                  seek = (currentNode.parentNode.parentNode.nextSibling.nodeType == 3) ? currentNode.parentNode.parentNode.nextSibling.nextSibling : currentNode.parentNode.parentNode.nextSibling;
               }
            }
            if (newnode && (!newnode.match(/^node/))) {
               newnode = '';
               seek = seek.parentNode.nextSibling;
            }
            if (cnt > 8) {
               return true;
            }
         }
      }
      
      if (newnode) {
         ui.viewing = newnode;
         setTimeout("focusNode('"+newnode+"');", 50);
         
         var root = getObject('node_children');
         var el = getObject(newnode);
         var tmp = el;
         var stop = el.offsetTop + el.offsetHeight;

         while (tmp.parentNode.id!='node_children') {
            stop += tmp.parentNode.offsetTop;
            tmp = tmp.parentNode;
         }
         if (stop > root.offsetHeight) {
            el.scrollIntoView(false);
            root.scrollLeft = 0;
         }
      }

   } catch(e) {
      errorHandler(e);
   };

   return blockEvent(evt);
}

function startDrag(evt) {
   evt = (evt) ? evt : ((window.event) ? window.event : "");
   try {
      var who = getEventTarget(evt);

      if (who) {
         setStatus('startDrag with '+who.id);

         /*
         if (!outline.edit) { return true; }

         if (ui.over=='button') {
            evt.target.style.top = (getObjectTop(evt.target) + 2) + 'px';
            return true;
         }
         
         */
         if ((!who.id.match(/^node/)) || ui.clicking || ui.dragging) return true;
         if (ui.editopen) unedit(evt);
         if (!ui.drag) ui.drag = new Object();   
         ui.drag.y = evt.clientY;
         ui.drag.x = evt.clientX;
         ui.drag.downY = ui.drag.y;
         ui.drag.downX = ui.drag.x;
         ui.clicking = 1;
         ui.dragging = 1;
         ui.drag.target = who;

         // debug(who);

         dragObj = getObject('drag');
         dragObj.style.top = ui.drag.y + 'px';
         dragObj.style.left = ui.drag.x + 'px';
         dragObj.innerHTML = (who.textContent) ? who.textContent : who.innerText;
      }
   } catch(e) {
      errorHandler(e);
   };

   return blockEvent(evt);
}

function drag(evt) {
   evt = (evt) ? evt : window.event;
   var who = getEventTarget(evt);
   try {
      if (who) {
         if (!outline.edit) return true;

         setStatus("[drag] x: "+evt.clientX + " y: "+evt.clientY+" over: "+who.id);
         if (!ui.dragging) return true;

         if (evt) {
            ui.drag.y = evt.clientY;
            ui.drag.x = evt.clientX;
            if (ui.dragging) {
               if (ui.clicking && ((Math.abs(ui.drag.x - ui.drag.downX) > 2) || (Math.abs(ui.drag.y - ui.drag.downY) > 2))) {
                  if (!dragObj) dragObj = getObject('drag');
                  dragObj.style.display = 'block';
                  ui.clicking = 0;
               }
               dragObj.style.top = (ui.drag.y + 4) + 'px';
               dragObj.style.left = (ui.drag.x + 6) + 'px';
            }
         }
      }
   } catch(e) {
      errorHandler(e);
   };

   return blockEvent(evt);
}

function stopDrag(evt) {
   evt = (evt) ? evt : ((window.event) ? window.event : '');

   try {
      var who = getEventTarget(evt);

      setStatus("in stopDrag with "+who.id+"\nui.editing: "+ui.editing);   

      if ((!outline.edit) || (!ui.dragging)) return true;
      if (ui.over=='button') {
         who.style.top = (getobjecttop(who) - 2) + 'px';
         return true;
      }
    
      if (ui.editing) updateContent(ui.editing);

      setStatus("[stopDrag] x: "+evt.clientX + " y: "+evt.clientY+" over: "+who.id+" editing: "+ui.editing);
      //debug(evt);
      if ((ui.dragging) && (!ui.clicking)) {
         ui.dragging = 0;

         if (dragObj) dragObj.style.display = 'none';

         if (ui.overNode) {
            var pnode = getObject(ui.drag.target.id);
            var tnode = getObject(ui.drag.target.id+'_children');
            
            var onode = getObject(ui.overNode+'_children');
            if (onode) {
               if (pnode) onode.appendChild(pnode);
               if (tnode) onode.appendChild(tnode);
               if (ui.editopen) unedit(evt);
            } else {
               var onode = getObject(ui.overNode);
               if ((onode.nextSibling) && (onode.nextSibling.id.match(/^node/))) {
                  if (pnode) onode.parentNode.insertBefore(pnode, onode.nextSibling);
                  if (tnode) onode.parentNode.insertBefore(tnode, onode.nextSibling);
                  if (ui.editopen) unedit(evt);
               }
            }
         }
         if (ui.drag.target.id.match(/node_addon_/i)) {
            var myuid = ui.drag.target.id.replace(/^node_addon_/i, '');
            var row = getObject('addonrow_'+myuid);
            if (row) {
               var tbl = getObject('addontbl');
               if (tbl) {
                  tbl.deleteRow(row.rowIndex);
               }
            }
         }
      }
      
      if ((ui.drag.target.id.match(/^node/)) && (!ui.drag.target.id.match(/children/))) {
         who.style.borderBottom = '2px solid transparent';
      }

      ui.dragging = 0;
      ui.clicking = 0;
      ui.drag.x = 0;
      ui.drag.y = 0;
      ui.drag.downX = 0;
      ui.drag.downY = 0;
   } catch(e) {
      errorHandler(e);
   };
   return true;
}

function doClick(evt) {
   evt = (evt) ? evt : window.event;

   self.focus();
   try {
      var who = getEventTarget(evt);
      if (who) {

         try {

            var nodeItem = who;
            var clickX = (evt.offsetX) ? evt.offsetX : evt.layerX;
            clickX = clickX - nodeItem.offsetLeft;
   
            if (who.id && who.id.match(/editor|editframe/)) {
               if (ui.editing && (clickX < 18)) {
                  setTimeout("toggleBranch('"+ui.editing+"')", 10);
                  return blockEvent(evt);
               } else {
                  return true;
               }
            } else if ((clickX < 18) && (nodeItem.id)) {
               toggleBranch(who.id);
               return blockEvent(evt);
            } else {
               return true;
            }
         } catch(e) {
            errorHandler(e);
         }
         
         if (ui.editing && (ui.editing != who.id)) {
            updateContent(ui.editing);
         }
         
         if (ui.viewing == who.id) {
            selectNode(who);
         } else {
            ui.viewing = who.id;
            focusNode(who);
         }
      }
   } catch(e) {
      errorHandler(e);
   };
   return false;
}

function showNode(who, tgt) {
   var pnode;
   var nodename = (who.match(/^Nav_/)) ? who : 'Nav_' + who;
   var el = document.getElementById(nodename);
   if (el) {
      var newclass = el.className.replace(/Selected/i, '');
      if (tgt) el.className = newclass + 'Selected';
      if (el.parentNode.id.match(/_children/i)) {
         el.parentNode.style.display = 'block';
         pnode = el.parentNode.id.replace(/_children/, '');
         showNode(pnode, tgt);
      }
   }
   var el = document.getElementById(nodename + '_children');
   if (el) el.style.display = 'block';


}

function nodeClick(evt) {
   evt = (evt) ? evt : window.event;

   try {
      var who = getEventTarget(evt);
      if (who) {
         try {
            var nodeItem = who;
            var clickX = (evt.offsetX) ? evt.offsetX : evt.layerX;
            clickX = clickX - nodeItem.offsetLeft;
            
            if (nodeItem.id.match(/Nav/)) {
               var navID = nodeItem.id.replace(/Nav_/,'');
               var navItem = getNav(navID, navElements);
               window.location.href = '/site.php?Resource=Nav&NavID=' + navItem;
            }
            if (who.id && who.id.match(/editor|editframe/)) {
               if (ui.editing && (clickX < 18)) {
                  setTimeout("toggleBranch('"+ui.editing+"')", 10);
                  return blockEvent(evt);
               } else {
                  return true;
               }
            } else if ((clickX < 18) && (nodeItem.id)) {
               toggleBranch(who.id);
               return blockEvent(evt);
            } else {
               return true;
            }
         } catch(e) {
            errorHandler(e);
         }
         
         if (ui.editing && (ui.editing != who.id)) {
            updateContent(ui.editing);
         }
         
         if (ui.viewing == who.id) {
            selectNode(who);
         } else {
            ui.viewing = who.id;
            focusNode(who);
         }
      }
   } catch(e) {
      errorHandler(e);
   };
   return false;
}
function getKeys(obj) {
   var keys = new Array();
   for (var i in obj) {
      keys[keys.length] = i;
   }
   return keys;
}

function toggleBranch(who, state) {
   try {
      var ch = getObject(who+'_children');
      var pa = getObject(who);
      if (!pa) pa = getObject('node'+who);
      /*
      var cur = getFile(who);
      
      if ((typeof(cur)=='object') || (typeof(cur)=='array')) {
         var keys = getKeys(cur);
         if (!keys.length) {
            getFiles(who);
         }
      }
      */
      if (ch && ch.style.display == 'none') {
      // if (!ui.state[who+'_children'] && (!outline.edit)) {
         ui.state[who+'_children'] = 0;
      } else {
         ui.state[who+'_children'] = 1;
      }
      var p = (pa.className.match(/focus/i)) ? ' focused' : '';
      if (ch) {
         if (!ui.state[who+'_children']) {
            ui.state[who+'_children'] = 1;
            ch.style.display = 'block';
            if (pa) pa.className = 'branch_open'+p;
            if (pa) pa.setAttribute('class', 'branch_open'+p);
            ui.focusclass = 'branch_open';
         } else {
            ui.state[who+'_children'] = 0;
            ch.style.display = 'none';
            if (pa) pa.className = 'branch_closed'+p;
            if (pa) pa.setAttribute('class', 'branch_closed'+p);
            ui.focusclass = 'branch_closed';
         }
      }
      // selectNode(who);
      // focusNode(who);
   } catch(e) {
      errorHandler(e);
   };
   return false;
}

function updateContent(who) {
   try {
      var editwrap = getObject('editwrap');
      var editframe = getObject('editframe');
      
      if (editwrap && ((editwrap.style.display=='none') || (editframe.style.display=='none'))) {
         return true;
      } else {
         if (editframe.value!='') {
            var updiv = getObject(who);
            var val = editframe.value.replace(/\n/, "<br>");
            if (updiv) { updiv.innerHTML = editframe.value; }
         }
      }
   } catch(e) {
      errorHandler(e);
   };
   return false;
}

function updateAccess(who, amt, caller) {
   var el, out, access, bit, friends, chk;
   if (!amt) amt = parseInt(caller.getAttribute('rel').replace(/^\D*/,''));
   if ($) friends = $('input[rel="'+caller.getAttribute('rel')+'"]');
   el = document.getElementById(who);
   if (el) {
      access = parseInt(el.value);
      bit = Math.abs(parseInt(amt));
      el.value = access ^ bit;
      chk = $(caller).prop('checked');
      if (friends) friends.attr('checked', chk ? "checked" : false); 
   }
   return updateAllAccess();
}

function updateAllAccess() {
   var mods, procs, access=0, procAccess=0, tmp;
   mods = $(".accessTree input[type='checkbox'].Access:checked");
   procs = $(".accessTree input[type='checkbox'].ProcessAccess:checked");

   mods.each(function() {
      tmp = parseInt($(this).attr('rel').replace(/^\D*/, ''));
      if (!(tmp & access)) { access += tmp; }
      console.log("Module value: " + tmp + ".  Access is now: " + access);
   });
   
   procs.each(function() {
      tmp = parseInt($(this).attr('rel').replace(/^\D*/, ''));
      if (!(tmp & procAccess)) { procAccess += tmp; }
      console.log("Process Access value: " + tmp + ".  procAccess is now: " + procAccess);
   });
   
   $("#Access").val(access);
   $("#ProcessAccess").val(procAccess);
   return( { 'Access':access,'ProcessAccess':procAccess });
}


function unedit(evt, noupdate) {
   evt = (evt) ? evt : ((window.event) ? window.event : null);
   
   try {
      if (!ui.editopen) return true;
      var who = (ui.editing) ? ui.editing : getEventTarget(evt);
      
      self.focus();

      if (!noupdate && (ui.editing && (ui.editing != who.id))) {
         updateContent(ui.editing);
      } 
      var editor = getObject('editframe');
      var editwrap = getObject('editwrap');

      if (editor) {
         editor.value = '';
         editor.blur();
         editor.style.display = 'none';
      }
      if (editwrap) editwrap.style.display = 'none';
      
      var xport = getObject('debug');
      if (xport) xport.appendChild(editwrap);
      ui.editopen = 0;
      ui.editing = '';
   } catch(e) {
      errorHandler(e);
   };
   return false;
}

function setStatus(txt) {
   var stat = top.document.getElementById('statuscon');
   
   try {
      if (stat) {
         stat.style.display = 'block';
         if (stat.style.display != 'none') {
            stat.innerHTML = txt;
         }
      }
   } catch(e) {
      errorHandler(e);
   }
   return true;
}

function errorHandler(e) {
   var errtxt = '';
   for (var i in e) {
      errtxt += "\t" + i + ': ' + e[i] + "\n";
   }
   alert("*** An error has occured:\n"+errtxt);
}

function debug(obj) {
   try {
      if (obj) {
         var dbg = '';
         for (var i in obj) {
            /* 
               if ((typeof(obj[i]) != 'function') && (!i.match(/_NODE$/))) { 
            */
            if (!i.match(/_NODE|view|innerHTML$/)) { 
               try {
                  if (obj[i]) dbg += i + ': ' + obj[i] + "<br>\n";
               } catch(e) {
                  errorHandler(e);
               }
            }
         }
         var debug = getObject('debug');
         debug.style.display = 'block';
         if (debug) debug.innerHTML = dbg;
      }
   } catch(e) {
      errorHandler(e);
   }
}

function doKeypress(evt) {
   try {
   evt = evt ? evt : ((event) ? event : null);
   if (evt) {
      var doit = '';
      var key = (!evt.keyCode) ? evt.charCode : evt.keyCode;
      shifted = evt.shiftKey;
      
      setStatus('[keypress] '+key+((evt.ctrlKey)?' ctrl':'')+((evt.altKey)?' alt':'')+((evt.shiftKey)?' shift':''));
      if (keyDefs[key]) {
         // KEY (no modifier keys)
         if (keyDefs[key].cmd) doit = keyDefs[key].cmd;
         // Shift-KEY
         if ((evt.shiftKey) && (keyDefs[key].shiftKey)) doit = keyDefs[key].shiftKey;
         // Ctrl-KEY
         if ((evt.ctrlKey) && (keyDefs[key].ctrlKey)) doit = keyDefs[key].ctrlKey;
         // Shift-Ctrl-KEY
         if ((evt.shiftKey) && (evt.ctrlKey) && (keyDefs[key].shiftctrlKey)) doit = keyDefs[key].shiftctrlKey;
         // Alt-KEY
         if ((evt.altKey) && (keyDefs[key].altKey)) doit = keyDefs[key].altKey;
         // Shift-Alt-KEY
         if ((evt.shiftKey) && (evt.altKey) && (keyDefs[key].shiftaltKey)) doit = keyDefs[key].shiftaltKey;
         
         setStatus('[keypress] '+key+' code: '+doit+'   '+((evt.ctrlKey)?' meta':'')+((evt.ctrlKey)?' ctrl':'')+((evt.altKey)?' alt':'')+((evt.shiftKey)?' shift':''));
         
         if (doit) {
            try {
               eval(doit);
            } catch(e) { 
               errorHandler(e);
            }
         } 
      } 
   }
   } catch(e) {
      errorHandler(e);
   };
}

function undo() {
   if (undodiv && undoparent) {
      undoparent.appendChild(undodiv);
      undodiv = null;
      undoparent = null;
   }
}

function sendProposal() {
   var eform = document.getElementById('outlineform');
   var aform = document.getElementById('agendaform');

   if (eform && aform) {
      aform.agendaitem.value = eform.addagenda.value;
      eform.addagenda.value = '';
      setTimeout("document.outlineform.submit();", 100);
   }
}

function saveOutline() {
   try {
      var frm = document.outlineform;
      frm.x.value = 'save';
      
      if (ui.focus) unfocus(ui.focus);
      if (ui.editing) updateContent(ui.editing);
    
      var editor = getObject('editwrap');
      var editframe = getObject('editframe');
      if (editor) {
         editframe.style.display = 'none';
         editor.style.display = 'none';
         getObject('debug').appendChild(editor);
      }

      var content = getObject('node_1');

      if (content) {
         frm.title.value = content.innerHTML;
         frm.outline.value = content.innerHTML.replace(/^\s*/, '');
         setTimeout("document.outlineform.submit();", 100);
      }
   } catch(e) {
      errorHandler(e);
   };
}

var dumpwin;
function cdrdump(obj, top) {
   if (!dumpwin) {
      dumpwin = window.open('blank.html', 'dumpwin');
      dumpwin.document.write("<h1>Dump of object</h1><hr>\n<pre>");

   if (dumpwin) {
      for (var key in obj) {
         dumpwin.document.write(key+': '+obj[key]+"<br>\n");
         if ((typeof(obj[key])=='object') || (typeof(obj[key])=='array')) {
            cdrdump(obj[key], 0);
         }
      }
   }
   if (top) dumpwin.document.write("</pre>");
   dumpwin.document.close();
   }
}
function viewOutline(id) {
   var frm = document.outlineform;
   frm.x.value = 'view';
   frm.id.value = id;
   frm.outline.value = '';
   setTimeout("document.outlineform.submit();", 250);
}

function getObjectHeight(obj)  {
   try {
      var result = 0;
      if (obj.offsetHeight) {
         result = obj.offsetHeight;
      } else if (obj.clip && obj.clip.height) {
         result = obj.clip.height;
      } else if (obj.style && obj.style.pixelHeight) {
         result = obj.style.pixelHeight;
      }
   } catch(e) {
      errorHandler(e);
   };
   return parseInt(result);
}

function getObjectLeft(obj)  {
   try {
      var result = 0;
      if (document.defaultView && document.defaultView.getComputedStyle) {
         var style = document.defaultView;
         var cssDecl = style.getComputedStyle(obj, "");
         result = cssDecl.getPropertyValue("left");
      } else if (obj.currentStyle) {
         result = obj.currentStyle.left;
      } else if (obj.style) {
         result = obj.style.left;
      } 
   } catch(e) {
      errorHandler(e);
   };
   return parseInt(result);
}

function getObjectTop(obj)  {
   try {
      var result = 0;
      if (document.defaultView && document.defaultView.getComputedStyle) {
         var style = document.defaultView;
         var cssDecl = style.getComputedStyle(obj, "");
         result = cssDecl.getPropertyValue("top");
      } else if (obj.currentStyle) {
         result = obj.currentStyle.top;
      } else if (obj.style) {
         result = obj.style.top;
      } 
   } catch(e) {
      errorHandler(e);
   };

   return result;
}

function shiftTo(obj, x, y) {
    var theObj = getObject(obj);
    if (theObj) {
      // equalize incorrect numeric value type
      var units = (typeof theObj.left == "string") ? "px" : 0 
      theObj.left = x + units;
      theObj.top = y + units;
    }
}

function shiftBy(obj, deltaX, deltaY) {
    var theObj = getObject(obj);
    if (theObj) {
      // equalize incorrect numeric value type
      var units = (typeof theObj.left == "string") ? "px" : 0 
      theObj.left = getObjectLeft(obj) + deltaX + units;
      theObj.top = getObjectTop(obj) + deltaY + units;
    }
}

function getEventTarget(evt) {
   evt = (evt) ? evt : ((window.event) ? window.event : "")
   
   try {
      if (evt) {
         var elem;
         if (evt.target) {
            elem = (evt.target.nodeType == 3) ? evt.target.parentNode : evt.target;
         } else {
            elem = evt.srcElement;
         }
      }
   } catch(e) {
      errorHandler(e);
   };

   return elem;
}

function doOver(evt) {
   evt = (evt) ? evt : event;
   
   var who = getEventTarget(evt);
   setStatus(who.id);

   if (who.id.match(/^node/) && (!who.id.match(/_children$/))) {
      ui.overNode = who.id;
      
      if (ui.dragging) {
         who.style.borderBottom = '2px solid #000000';
      }
   }
   return true;
}

function doOut(evt) {
   evt = (evt) ? evt : event;
   var who = getEventTarget(evt);

   setStatus('Leaving ' + who.id);

   if (who.id.match(/^node/) && (!who.id.match(/_children$/))) {
      if (ui.dragging) {
         who.style.borderBottom = '2px solid transparent';
      }
   }
   return true;
}

function doDoubleClick(evt) {
   evt = (evt) ? evt : window.event;

   var who = getEventTarget(evt);
   if (who.id.match(/^node/)) {
      selectNode(who.id);
   }
}

function press(who) {
   shiftBy(who, 0, 2);
}

function release(who) {
   shiftBy(who, 0, -2);
}

function getObject(who) {
   if (typeof(who) == 'object') {
      return who;
   } else {
      return document.getElementById(who);
   }
}

function blockEvent(evt) {
   evt = (evt) ? evt : event;
   evt.cancelBubble = true;
   if (!document.all) evt.stopPropagation();
   return false;
}

function init() {
   buildTree('node', files, 'node');

   ui.files = new Array();
}

function getNav(navID, navTree) {
   var found = 0;
   for (var i in navTree) {
      if (navTree[i].NavID == navID) {
         found = navTree[i].NavID;
         break;
      } else if (navTree[i]._children) {
         found = getNav(navID, navTree[i]._children);
         if (found) break;
      }
   }
   return found;
}
//document.onkeypress = doKeypress;
//top.document.onkeypress = doKeypress;

document.onclick = doClick;
//top.document.onclick = doClick;

document.onmousemove = drag;
//top.document.onmousemove = drag;

document.onmouseup = stopDrag;
//top.document.onmouseup = stopDrag;

document.onmousedown = startDrag;
//top.document.onmousedown = startDrag;

document.onmouseover = doOver;
//top.document.onmouseover = doOver;

document.onmouseout = doOut;
//top.document.onmouseover = doOut;

document.ondoubleclick = doDoubleClick;
