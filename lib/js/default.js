var ui, modules, doScroll, employeeID;

var keyDefs = [];

function UI() {
   this.state = [];
   this.flowchart = {};
}

function initFrame() {
   ui = new UI();
   ui.drag = {};
   ui.state = {};

   var overviewTable = document.getElementById('overviewTable');
   var overviewFake = document.getElementById('overviewFake');
   var oviewTable = document.getElementById('oviewTable');
   if (overviewTable && overviewFake) {
      var nt = document.createElement('table');
      setClass(nt, 'listTable fakeTable');
      nt.setAttribute('id', 'fakeTable');
      nt.setAttribute('cellpadding', '4px');
      nt.setAttribute('width', '95%');
      var tmprow, i, c;
      for (i=0; i<overviewTable.childNodes[0].rows.length; i++) {
         tmprow = document.createElement('tr');
         tmprow.setAttribute('id', 'fake' + i);
         setClass(tmprow, ((i===0) ? 'headRow' : 'listItemRow'));
         
         for (c=0; c<tmprow.cells.length; c++) {
            tmprow.appendChild(overviewTable.childNodes[0].rows[i].cells[c]);
         }
         nt.appendChild(tmprow);
      }
      overviewFake.appendChild(nt);
      for (i=0; i<overviewTable.childNodes[0].rows[0].cells.length; i++) {
         overviewTable.childNodes[0].rows[0].cells[i].className = 'headHidden';
         overviewTable.childNodes[0].rows[0].cells[i].style.backgroundColor = 'transparent';
         overviewTable.childNodes[0].rows[0].cells[i].style.backgroundImage = 'none';
      }
      overviewTable.childNodes[0].rows[0].className = 'headHidden';
      overviewTable.childNodes[0].rows[0].style.backgroundColor = 'transparent';
      overviewTable.childNodes[0].rows[0].style.backgroundImage = 'none';
      overviewTable.childNodes[0].appendChild(overviewTable.childNodes[0].rows[0]);
   }
   if (doScroll) {
      var scrollRow = document.getElementById(doScroll);
      if (scrollRow) {
         overviewTable.scrollTop = scrollRow.offsetTop - 22 ;
      }
   }

   keyDefs[83] = { metaKey:'doSave()' };
   keyDefs[115] = { metaKey:'doSave()' };

   document.onkeypress = doKeypress;
}

function init(arr, curmod, curproc, rsc, currec) {
   var mod = (arr) ? arr : modules;
   
   ui = new UI();
   ui.drag = {};
   ui.state = {};
   if (mod) { buildModules(mod); }

   if (curmod || curproc || rsc || currec) {
       setTimeout("doLoad('"+curmod+"','"+curproc+"','"+rsc+"','"+currec+"')", 1000);
   }

   if (curmod) { showProcess('', curmod); }
}


function doLoad(curmod, curproc, rsc, currec) {
   // if (curmod) buildProcesses('', curmod);
   if (curproc) toggleProcess('', curproc, currec);
   
   if (rsc && currec) {
      var cframe = document.getElementById('content');
      if (cframe) {
         cframe.contentWindow.loadRecord();
         var cframe = document.getElementById('content');
         if (cframe) {
            cframe.contentWindow.loadRecord(currec, rsc, curproc);
         }
      }
   }

}

function buildModules(modules) {
   if (modules && modules.length) {
      var ourparent = document.getElementById('modules');
      var mel = [ ];
      var mc = [ ];

      for (var m=0; m<modules.length; m++) {
         var mod = modules[m];
         mel[mod.ModuleID] = document.createElement('DIV');
         mel[mod.ModuleID].setAttribute('id', 'Module_' + mod.ModuleID);
         mel[mod.ModuleID] = setClass(mel[mod.ModuleID], 'module ' + mod.ClassName);
         /*
         if (mel[mod.ModuleID].attachEvent) {
            mel[mod.ModuleID].attachEvent('onclick', showProcess);
         } else if (mel[mod.ModuleID].addEventListener) {
            mel[mod.ModuleID].addEventListener('click', showProcess, false);
         } else {
            mel[mod.ModuleID].onclick = showProcess;
         }
         */
         mel[mod.ModuleID].innerHTML = mod.Module;
         mel[mod.ModuleID].onclick = showProcess;
         
         if (ourparent) ourparent.appendChild(mel[mod.ModuleID]);
         if (mod.Processes.length) {
            mc[mod.ModuleID] = document.createElement('div');
            mc[mod.ModuleID].setAttribute('id','Module_' + mod.ModuleID + '_children');
            setClass(mc[mod.ModuleID], 'module_children');

            if (ourparent) ourparent.appendChild(mc[mod.ModuleID]);
            mel[mod.ModuleID].onclick = showProcess;
            buildProcesses('', mod.ModuleID);
         } else {

         }
      }
   }
}

function setClass(el, name) {
   var div = (typeof(el)=='string') ? document.getElementById(el) : el;
   
   if (div) {
      if (div.setAttribute) div.setAttribute('class', name);
      if (div.setAttribute && div.className) div.setAttribute('className', name);
      div.className = name;

      return div;
   } else {
      return false;
   }
}

function buildProcesses(evt, mid) {
   evt = (evt) ? evt : window.event;
   if (evt) {
      if (!mid) {
         var elem = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
         
         if (elem) {
            elem = (elem.nodeType == 1 || elem.nodeType==9) ? elem : elem.parentNode;
            mid = elem.id.replace(/Module_/, '');
         }
      }
   }
   
   if (mid) {
      // Grab requested module object
      var mod = getModule(mid);

      // Build processes from module object
      if (mod && mod.Processes) {
         var process = document.getElementById('Module_' + mid + '_children');     // Grab reference to process container for this module
                                                                              
         // Cheesey hack to clear old processes and add title 
         // TODO: should probably have a function to clear all children in a passed element reference and make 
         // call to that and just add the title via doc.createElem and appendChild
         var procs = mod.Processes;
         var pel = [ ];
         var pchild = [ ];
         var pc, children, xtra;
         for (var p=0; p<procs.length; p++) {
            xtra = (procs[p]._children) ? ' nodeClosed' : ' node';            // Node class type depends on if we have children or not
   
            // Create new process div and assign classes and events to it.
            pel[p] = document.createElement('div');
            pel[p].setAttribute('id', 'Process_' + procs[p].ProcessID);
            pel[p] = setClass(pel[p], 'proc'+xtra);
            /**
             *  This is the correct, W3C/standards way to add events to DOM objects, 
             *  but IE still chokes and never gets the assignment.   Since I refuse 
             *  to put any browser sniffing in here, we'll have to settle on simply 
             *  assigning the 'onclick' attribute of the element which works across 
             *  all browsers so is probably the way to go no matter what.
             *  
             *  Leaving this code in here for posterity - CDR
             **/
             /*
            if (pel[p].attachEvent) {
               pel[p].attachEvent('onclick', toggleProcess);
            } else if (pel[p].addEventListener) {
               pel[p].addEventListener('click', toggleProcess, false);
            } else {
               pel[p].onclick = toggleProcess;
            }
            */
            pel[p].innerHTML = procs[p].Process;
            pel[p].onclick = toggleProcess;     // and here is the bastardized assignment
            process.appendChild(pel[p]);

            if (procs[p]._children) {
               pc = pchild.length;
               pchild[pc] = document.createElement('DIV');
               
               pchild[pc] = buildProcessChildren(pchild[pc], procs[p]._children);
               pchild[pc].setAttribute('id', 'Process_' + procs[p].ProcessID + '_children');
               pchild[pc] = setClass(pchild[pc], 'procChild');
               pchild[pc].style.display = 'none';
               process.appendChild(pchild[pc]);
            }
            buildActions('Process_'+procs[p].ProcessID, procs[p].Action);
         }
      }
   }
   
   if (mod) {
      var content = document.getElementById('content');
      if (content) content.src = '/content.php?Resource='+mod.Resource+'&type=Module&ModuleID=' + mod.ModuleID;
   }
}

function buildProcessChildren(ourparent, procs) {
   var cel = [ ];
   var cchild = [ ];
   var cc, xtra;
   for (var c=0; c<procs.length; c++) {
      cel[c] = document.createElement('div');
      cel[c].setAttribute('id', 'Process_' + procs[c].ProcessID);
      xtra = (procs[c]._children) ? ' nodeClosed' : ' node';
      setClass(cel[c], 'proc' + xtra);
      
      // Set event listener using bad form for better cross-browser comapt
      cel[c].onclick = toggleProcess;

      /*
      if (cel[c].attachEvent) {
         cel[c].attachEvent('onclick', toggleProcess);
      } else {
         cel[c].addEventListener('click', toggleProcess, false);
      }
      */

      cel[c].innerHTML = procs[c].Process;
      ourparent.appendChild(cel[c]);

      if (procs[c]._children) {
         cc = cchild.length;
         cchild[cc] = document.createElement('DIV');
         cchild[cc].setAttribute('id', 'Process_' + procs[c].ProcessID + '_children');
         setClass(cchild[cc], 'procChild childClosed');
         cchild[cc] = buildProcessChildren(cchild[cc], procs[c]._children[0]);
         ourparent.appendChild(cchild[cc]);
      }
   }
   return(ourparent);
}

function showProcess(evt, mid) {
   evt = (evt) ? evt : window.event;
   if (evt) {
      if (!mid) {
         var elem = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);

         if (elem) {
            elem = (elem.nodeType == 1 || elem.nodeType==9) ? elem : elem.parentNode;
            mid = elem.id.replace(/Module_/, '');
         }
      }
   }
   if (ui.moduleID) {
      var mel = document.getElementById('Module_' + ui.moduleID);
      var curmod = getModule(ui.moduleID);
      if (mel) mel = setClass(mel, 'module ' + curmod.ClassName);
   }


   if (mid) {
      ui.moduleID = mid;
      var mod = getModule(mid);
      var url;

      if (mod.URL) {
         url = mod.URL;  
      } else {
         url = '/content.php?Resource='+mod.Resource+'&type=Module&ModuleID=' + mid;
      }

      var content = document.getElementById('content');
      if (content) content.src = url;

      var curclass = '';
      var el = document.getElementById('Module_' + mid + '_children');
      if (el) {
         if (el.style.display != 'block') {
            el.style.display = 'block';
            curclass = 'moduleSelected';
         } else {
            el.style.display = 'none';
            curclass = 'moduleSelectedClosed';
         }
      } else {
         curclass = 'moduleSelectedClosed'; 
      }
      var cur = document.getElementById('Module_' + mid);
      if (cur) setClass(cur, curclass);
   }

   // closeProcesses();
   if (evt) return blockEvent(evt);
}

function closeProcesses() {
   if (modules) {
      for (var i in modules) {
         if (modules[i].ModuleID != ui.moduleID) {
            var el = document.getElementById('Module_' + modules[i].ModuleID + '_children');
            if (el) el.style.display = 'none';
            var cur = document.getElementById('Module_' + modules[i].ModuleID);
            if (cur) setClass(cur, 'module ' + modules[i].ClassName);
         }
      }         
   }
}

function getModule(modID) {
   if (modules) {
      for (var m=0; m<modules.length; m++) {
         if (modules[m].ModuleID==modID) {
            return modules[m];
         }
      }
   }
   return false;
}

function getProcess(pid, proclist) {
   var found;
   for (var p in proclist) {
      if (proclist[p].ProcessID == pid) {
         found = proclist[p];
         break;
      }
      if (proclist[p]._children) {
         found = getProcess(pid, proclist[p]._children);
      }
   }
   return found;
}

function selectModule(modID) {
   var mel;

   var oldmod = getModule(modID);

   // Clear any set module
   ui.module = modID;
   for (var m=0; m<modules.length; m++) {
      mel = document.getElementById('Module_' + modules[m].ModuleID);
      if (modID == modules[m].ModuleID) ui.moduleIndex = m;
      if (mel) {
         setClass(mel, 'module ' + modules[m].ClassName);
      }
   }

   mel = document.getElementById('Module_' + modID);
   if (mel) setClass(mel, 'moduleSelected');
   
}

function resetProcesses(proclist) {
   var pel, xtra;
   for (var p in proclist) {
      pel = document.getElementById('Process_' + proclist[p].ProcessID);
      if (pel) {
         xtra = (!proclist[p]._children) ? ' node' : ' nodeClosed';
         setClass(pel, 'proc' + xtra);
      }
      if (proclist[p]._children) {
         resetProcesses(proclist[p]._children);
      }
   }
}

function selectProcess(procID) {
   var mod = getModule(ui.currentModule);
   var procs = mod.Processes;
   var pel;
   
   if (ui.currentProcess) {
      pel = document.getElementById('Process_' + ui.currentProcess);
      if (pel) {
         xtra = ' nodeClosed';
         setClass(pel, 'proc' + xtra);
      }
   }
   ui.currentProcess = procID;
   ui.process = (procID && procID.replace) ? procID.replace(/Process_/,'') : procID;
   
   // Reset all processes 
   resetProcesses(procs);

   pel = document.getElementById('Process_' + procID);
   if (pel) {
      setClass(pel, 'proc nodeOpen');
   }
   
}

function buildActions(pid, actions) {
   if (actions && actions.length) {
      var ourparent = document.createElement('DIV');
      ourparent.setAttribute('id', pid+'_children');
      setClass(ourparent, 'parent');
      ourparent.innerHTML = '';
      
      document.getElementById(pid).parentNode.appendChild(ourparent);
      var act = [ ];

      for (var a=0; a<actions.length; a++) {
         act[a] = document.createElement('DIV');
         act[a].setAttribute('id', 'Action_' + actions[a].ActionID);
         setClass(act[a], 'action');
         act[a].onclick = doAction;
         act[a].innerHTML = actions[a].Action;
         ourparent.appendChild(act[a]);
      }
   }
}
function getProcessModule(pid) {
   var out;
   for (var m in modules) {
      if (modules[m].Processes) {
         out = getProcess(pid, modules[m].Processes);
         if (out) {
            return modules[m];
         }
      }
   }
}

function toggleProcess(evt, pid, tid) { 
   evt = (evt) ? evt : window.event;
   if (evt) {
      var pel = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
      
      if (pel) {
         pel = (pel.nodeType == 1 || pel.nodeType==9) ? pel : pel.parentNode;

         var procname = pel.id;
         pid = procname.replace(/^Process_/, '');
      }
   }

   if (procname) {
      var childs = document.getElementById(procname+'_children');
      if (childs) {
         childs.style.display = (childs.style.display == 'none') ? 'block' : 'none';
      }
   }
   if (pid) {
      var curmod = getProcessModule(pid);
      var curproc = getProcess(pid, curmod.Processes);

      var mel = document.getElementById('Module_' + ui.moduleID);
      if (mel) mel = setClass(mel, 'module ' + curmod.ClassName);

      if (curproc && curproc.JS) eval(curproc.JS);
      if (!ui.state[procname]) ui.state[procname] = 0;     // Create array entry in ui object's state maintenance array
      
      selectProcess(pid);
      
      var url = '/content.php?Resource='+curproc.Resource+'&type=Process&ProcessID=' + pid;
      if (tid) {
         url += '&ID='+tid;
      }
      var content = document.getElementById('content');
      if (content) {
         content.src = url;
      }
   }
}

function doGet(actID, rsc, recID, frmID) {
	if (!frmID) frmID = 'mainform';
   var frm = document.forms[frmID];

   if (frm) {
      frm.x.value = 'get';
      frm.Resource.value = rsc;
      frm.ID.value = actID;
		createHiddenElement(frm, "type", "Action");
		createHiddenElement(frm, "ActionID", actID);
      setTimeout('document.'+frmID+'.submit()', 500);
   }

   return true;   
}
	
function createHiddenElement(frm, name, value) {
   input = document.createElement('input');
   input.setAttribute("name", name);
   input.setAttribute("value", value);
   input.setAttribute("type", "hidden");
   frm.appendChild(input);
}

function doNew(frmID) {
   var mainHelp = document.getElementById('mainHelp');
   if (mainHelp) mainHelp.style.display = 'none';

   var mainForm = document.getElementById('formMain');
   if (mainForm) mainForm.style.display = 'block';

	if (!frmID) frmID = 'mainform';
   var frm = document.forms[frmID];
   var rsc = frm.Resource.value;
   var setfocus = '';
   var focuser, mainid, newbtn, savebtn;
   
   for (var i=0; i<frm.elements.length; i++) {
      try {
         var newname = frm.elements[i].name.replace(/\[\d*\]/, '[new1]');
         
         if (frm.elements[i].type.match(/text|password/i)) {
            frm.elements[i].value = '';
            frm.elements[i].name = newname;
            
            if (!setfocus && !frm.elements[i].id.match(/^Track|Search/i)) setfocus = frm.elements[i].id;
         
         } else if (frm.elements[i].type.match(/select/i)) {
            frm.elements[i].name = newname;
            frm.elements[i].selectedIndex = 0;
         } else if (frm.elements[i].type.match(/radio/i)) {
            frm.elements[i].name = newname;
            if (frm[newname] && frm[newname][0]) {
               frm[newname][0].checked = true;
            }
         } else if (frm.elements[i].type.match(/hidden/i)) {
            frm.elements[i].name = newname;
         }
         
         if (setfocus) {
            focuser = document.getElementById(setfocus);
            if (focuser) focuser.focus();
         }
      } catch(e) {
         errorHandler(e, 'doNew');
      }

   }

   newbtn = document.getElementById('NewButton');
   if (newbtn) newbtn.style.display = 'none';

   savebtn = document.getElementById('SaveButton');
   if (savebtn) savebtn.style.display = 'block';

   mainid = document.getElementById('mainID');
   if (mainid) mainid.innerHTML = 'New Entry';
   
   var hid = document.getElementById(rsc+'ID');
   if (hid) hid.value = '';
   if (setfocus) {
      focuser = document.getElementById(setfocus);
      if (focuser) focuser.focus();
   }

   return true;
}

function doCopy(frmID) {
	if (!frmID) frmID = 'mainform';
   var frm = document.forms[frmID];
   var rsc = frm.Resource.value;
   var setfocus = '';
   var focuser, mainid, newbtn, savebtn;
   
   var jobhead = $(".formHeading").html();
   jobhead = jobhead.replace(/(\d*)/, "Copy of $1");
   $(".formHeading").html(jobhead);
   $(".formHeading").css({"background":"#990000","color":"#ffffff"});

   for (var i=0; i<frm.elements.length; i++) {
      try {
         var newname = frm.elements[i].name.replace(/\[\d*\]/, '[new1]');
         frm.elements[i].name = newname;
         if (setfocus) {
            focuser = document.getElementById(setfocus);
            if (focuser) focuser.focus();
         }
      } catch(e) {
         errorHandler(e, 'doNew');
      }

   }

   $("#SaveButton").css("display","block");
   $("#DeleteButton").css("display","none");
   $("#PrintButton").css("display","none");
   $("#NewButton").css("display","none");
   $("#mainID").html("Copy of "+jobhead);

   
   var hid = document.getElementById(rsc+'ID');
   if (hid) hid.value = '';
   if (setfocus) {
      focuser = document.getElementById(setfocus);
      if (focuser) focuser.focus();
   }

   return true;
}
function doRemove(frmID) {
	if (!frmID) frmID = 'mainform';
   var frm = document.forms[frmID];

   if (frm) {
      frm.x.value = 'remove';
      setTimeout('document.mainform.submit()', 150);
   }
}

function checkSubmit() {
   alert("Checking submission");
   return false;
}

function doSave(frmID) {
	if (!frmID) frmID = 'mainform';
   var frm = document.forms[frmID];
   if (frm) {
      if (frm.x) frm.x.value = 'update_multi';
      if (frm.onsubmit) {
         if (!eval(frm.onsubmit())) {
            return false;
         }
      }
      setTimeout('document.mainform.submit()', 150);
   }
   return true;
}

function loadRecord(id, rsc, pid) {
   if (checkModified()) {
      var frmID = 'mainform';
      var frm = document.forms[frmID];

      if (frm) {
         frm.x.value = 'get';
         frm.ID.value = id;
         frm.ProcessID.value = pid;
         frm.type.value = 'Process';
         frm.Resource.value = rsc;

         setTimeout('document.mainform.submit()', 150);
      }
      
      //if (window.parent) window.parent.selectProcess(pid);
   } 
   return false;
}

function doSearch(frmID) {
	if (!frmID) frmID = 'mainform';
   var frm = document.forms[frmID];

   if (frm) {
      frm.x.value = 'search';
      setTimeout('document.mainform.submit()', 150);
   }

   return false;
}
function blockEvent(evt) {
   evt = (evt) ? evt : ((event) ? event : null);
   evt.cancelBubble = true;
   if (!document.all) evt.stopPropagation();
   return false;
}

function hideActionsIfNoAnimal(pid) {
	//alert(document.getElementById('content').testme);
	//if (document.getElementById('content').objJS.dbobj.Animal.Animal.length > 0) alert('hit');
}

function debug(obj) {
   var dbg = document.getElementById('debug');
  
   if (!dbg) {
      dbg = document.createElement('DIV');
      dbg.setAttribute('style', 'position:absolute;top:0px;right:0px;width:350px;bottom:0px;background-color:#ffffcc;z-index:9999;');
      document.getElementById('centerWrap').appendChild(dbg);
   }
   
   var out = '';

   for (var i in obj) {
      out += i + ': ' + obj[i] + "<br />\n";
   }

   dbg.innerHTML = out;
}

function hideProcesses() {
   top.ui.processState = 0;
   ui.processState = 0;
   var proc = document.getElementById('process');
   if (proc) proc.style.display = 'none';
   
   var ct = document.getElementById('chatThing');
   if (ct) ct.style.display = 'none';

   var pframe = document.getElementById('processFrame');
   if (pframe) {
      ui.state.processFrame = parseInt(pframe.style.left);
      pframe.style.left = '1px';
   }

   var iface = document.getElementById('interface');
   if (iface) {
      ui.state.iface = iface.style.left;
      iface.style.left = '10px';
   } 
   
   setCookie('pf', 1, 999);
}

function showProcesses(override) {
   top.ui.processState = 1;
   ui.processState = 1;
   var proc = document.getElementById('process');
   if (proc) proc.style.display = 'block';

   var pfleft = parseInt(getCookie('pf'));
   if ((pfleft < 100) || (pfleft > 250) || (!pfleft)) pfleft = ui.state.processFrame;
   if ((pfleft < 100) || (pfleft > 250) || (!pfleft)) pfleft = 190;
   if (override) pfleft = override;

   // Set our cookie before tacking on a 'px'
   setCookie('pf', pfleft, 999);

   if (proc) proc.style.width = pfleft + 'px';

   var pborder = document.getElementById('processFrame');
   if (pborder) pborder.style.left = '218px';

   var iface = document.getElementById('interface');
   if (iface) iface.style.left = (pfleft + 8) + 'px';

}

function toggleProcessFrame() {
   if (top.ui.processState==1) {
      top.ui.processState = 0;
      top.hideProcesses();
   } else {
      top.ui.processState = 1;
      top.showProcesses(244);
   }
}

function toggleNotes(evt, who) {
   evt = (evt) ? evt : window.event;
   
   var arrow = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
   if (!who) who = 'Notes_' + arrow.id;

   var elm = document.getElementById(who);
   if (elm) {
      if (elm.style.display == 'none') {
         elm.style.display = 'table-row';
         arrow.src = '/img/sm_arrow_open.png';
      } else {
         elm.style.display = 'none';
         arrow.src = '/img/sm_arrow_closed.png';
      }
   }
   if (evt) {
      return blockEvent(evt);
   } else {
      return false;
   }
}

function toggleBBoxSend(evt,who){

   var mainHelp = document.getElementById('mainHelp');
   if (mainHelp) mainHelp.style.display = 'none';

   var elm = document.getElementById(who);
   if (elm) {
      if (elm.style.display == 'none') {
         elm.style.display = 'inline';
      } else {
         elm.style.display = 'none';
      }
   }
}

function doZoom(evt) {
   evt = (evt) ? evt : window.event;
   
   if (evt.altKey) {
      var flowchart = document.getElementById('flowchart');
      if (flowchart) {
         var pct = (evt.shiftKey) ? 1.10 : .90;    // Increase/decrease size depending on shift key state
         
         var newWidth = Math.round(parseInt(flowchart.width) * pct);
         var newHeight = Math.round(parseInt(flowchart.height) * pct);
         
         flowchart.style.width = newWidth + 'px';
         flowchart.style.height = newHeight + 'px';

         // alert("Currently: "+curWidth+"x"+curHeight+"\nGoing to: "+newWidth+"x"+newHeight);

      }
   }
}


function startResize(evt, who) {
   evt = (evt) ? evt : window.event;
   ui.clicking = 1;
   
   ui.drag.x = ui.drag.lastX = evt.clientX;
   ui.drag.y = ui.drag.lastY = evt.clientY;
   ui.drag.who = who;
   
   if (who=='frameBorder') {
      ui.state.overviewTable = document.getElementById('overviewTable');
      ui.state.mainForm = document.getElementById('formMain');
      ui.state.helpForm = document.getElementById('helpForm');

      if (document.addEventListener) {
         document.addEventListener('mousemove', resizeOverview, false);
         document.addEventListener('mouseup', stopResize, false);
      }

      ui.resizing = who;
   } else if (who == 'processFrame') {
      ui.state.process = document.getElementById('process');
      ui.state.processFrame = document.getElementById('processFrame');
      ui.state.appFrame = document.getElementById('interface');
      ui.state.chatThing = document.getElementById('chatThing');
      ui.state.content = document.getElementById('content');

      if (document.addEventListener) {
         document.addEventListener('mousemove', resizeProcess, false);
         document.addEventListener('mouseup', stopResize, false);
         ui.state.content.contentDocument.addEventListener('mousemove', resizeProcess, false);
         ui.state.content.contentDocument.addEventListener('mouseup', stopResize, false);
      }
      ui.resizing = who;
   }

   if (evt) return blockEvent(evt);
}

function resizeOverview(evt) {
   evt = (evt) ? evt : window.event;
   
   var movedY = evt.clientY - ui.drag.lastY;
   
   if (ui.state.overviewTable) ui.state.overviewTable.style.height = (parseInt(ui.state.overviewTable.style.height) + movedY) + 'px';
   if (ui.state.mainForm) ui.state.mainForm.style.top = (parseInt(ui.state.mainForm.style.top) + movedY) + 'px';
   if (ui.state.helpForm) ui.state.helpForm.style.top = (parseInt(ui.state.helpForm.style.top) + movedY) + 'px';

   ui.drag.lastY = evt.clientY;

   if (evt) return blockEvent(evt);
}

function resizeProcess(evt) {
   evt = (evt) ? evt : window.event;
   
   var movedX = evt.clientX - ui.drag.lastX;
 
   if (ui.state.process) ui.state.process.style.width =  evt.clientX + 'px';
   if (ui.state.chatThing) ui.state.chatThing.style.width =  evt.clientX + 'px';
   if (ui.state.processFrame) ui.state.processFrame.style.left = (evt.clientX + 1) + 'px';
   if (ui.state.appFrame) ui.state.appFrame.style.left = (evt.clientX + 8) + 'px';

   ui.drag.lastX = evt.clientX;
   
   if (evt) return blockEvent(evt);
}

function stopResize(evt) {
   evt = (evt) ? evt : window.event;
   
   if (ui.resizing == 'frameBorder') {
      setCookie('ot', parseInt(ui.state.overviewTable.style.height), 999);
      document.removeEventListener('mousemove', resizeOverview, false);
   } else if (ui.resizing == 'processFrame') {
      var procdiv = (document.getElementById('process')) ? document.getElementById('process') : parent.document.getElementById('process');
      if (procdiv) setCookie('pf', parseInt(procdiv.style.width), 999);
      document.removeEventListener('mousemove', resizeProcess, false);
      parent.document.removeEventListener('mousemove', resizeProcess, false);
      if (ui && ui.state && ui.state.content && ui.state.content.contentDocument) ui.state.content.contentDocument.removeEventListener('mousemove', resizeProcess, false);
      if (ui && ui.state && ui.state.content && ui.state.content.contentDocument) ui.state.content.contentDocument.removeEventListener('mouseup', stopResize, false);
   }
   document.removeEventListener('mouseup', stopResize, false);
   ui.clicking = 0;
   ui.resizing = '';
}

function startDrag(evt) {
   evt = (evt) ? evt : window.event;
   ui.clicking = 1;
   ui.drag.x = ui.drag.lastX = evt.clientX;
   ui.drag.y = ui.drag.lastY = evt.clientY;
   
   return false;
}

function moveChart(evt) {
   evt = (evt) ? evt : window.event;
   
   if (ui.clicking) {
      var flowchart = document.getElementById('flowchart');
      if (flowchart) {
         ui.flowchart.x -= (ui.drag.lastX - evt.clientX);
         ui.flowchart.y -= (ui.drag.lastY - evt.clientY);
         
         flowchart.style.left = ui.flowchart.x + 'px';
         flowchart.style.top = ui.flowchart.y + 'px';

         ui.drag.lastX = evt.clientX;
         ui.drag.lastY = evt.clientY;
      }
      
      return false;
   }
}

function stopDrag(evt) {
   evt = (evt) ? evt : window.event;
   
   if (ui.clicking) {
      ui.clicking = 0;
      
      return false;
   }
}


var helpwin;
function showHelp() {
   var url = 'help.php?';
   url += (ui.module) ? 'module='+ui.module+'&' : '';
   url += (ui.process) ? 'process='+ui.process : '';

   if (!helpwin || helpwin.closed) {
      helpwin = window.open(url, 'helpwin', 'width=600,height=700,left='+(screen.width - 700)+',toolbar=no,status=no,location=no,directories=no,menubar=no,resizable=yes,scrollbars=no');
   } else {
      helpwin.focus();
      helpwin.document.location.href = url;
   }
   hideHelp();
   return false;
}
var win;
function newWindow(mypage,myname,w,h,scroll,pos){
   var LeftPosition, TopPosition;

   if (pos=="random") { 
      LeftPosition = (screen.width) ? Math.floor(Math.random() * (screen.width - w)) : 100;
      TopPosition = (screen.height) ? Math.floor(Math.random() * ((screen.height - h) - 75)) : 100;
   }

   if (pos=="center") { 
      LeftPosition = (screen.width) ? (screen.width - w) / 2 : 100;
      TopPosition = (screen.height) ? (screen.height - h) / 2 : 100;
   } else if ((pos != "center" && pos != "random") || pos==null) { 
      LeftPosition=0;
      TopPosition=20;
   }
   var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';

   if (!win || win.closed ) { 
      win = window.open(mypage, myname, settings);
   } else { 
      win.focus(); 
   }

   return false;
}

function showNewRecord(evt, tableEntry) {
   evt = (evt) ? evt : window.event;
   
   if (tableEntry) {
      var subtbl = document.getElementById('subtable');
      if (subtbl) {
         var tmprow = document.createElement('tr');
         tmprow.setAttribute('id', 'newrecord');
         var rowref = subtbl.insertRow(subtbl.rows.length);
         rowref.innerHTML = tableEntry;
      }
         
      // var newrec = document.getElementById('newrecord');
      // if (newrec) newrec.style.visibility = 'visible';
      
      var newctl = document.getElementById('newcontrol');
      if (newctl) newctl.style.visibility = 'collapse';
      
      document.getElementById('new1').focus();
   } else {
      var ns = document.getElementById('newSample');
      if (ns) ns.style.display = 'table-row';

      var nc = document.getElementById('newcontrol');
      if (nc) nc.style.display = 'none';
      document.getElementById('FlaskName_new1').focus();
   }
   if (evt) return blockEvent(evt);
}

function updateAccess(who, amt, caller) {
   var el, out, access, bit, friends;
   amt = parseInt(caller.getAttribute('rel').replace(/^\D*/,''));
   if ($) friends = $('input[rel="'+caller.getAttribute('rel')+'"]');
   el = document.getElementById(who);
   if (el) {
      access = parseInt(el.getAttribute('value'));
      bit = Math.abs(parseInt(amt));
      el.value = access ^ bit;
      if (friends) friends.attr('checked', (el.value > access) ? true : false); 
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

function doBug() {
   var content = document.getElementById('content'); 
   if (content) {
      var doc = '';
      if (content.contentWindow) {
         doc = content.contentWindow.document;
      } else {
         doc = content.body.document;
      }
      
      if (doc) {
         var frm = doc.mainform;
         if (frm) {
            frm.action = 'bug.php';
            frm.target = 'bug';
            frm.x.value = '';
            setTimeout("document.getElementById('content').contentWindow.document.mainform.submit()", 250);
         }
      }
   }
   newWindow('bug.php','bug','400','400','no','center');
}

function doChat() {
   resetChat();
   newWindow('/chat/chat.php', 'chat', '250', '600', 'yes', '');
}

function submitForm() {
	var frmID = 'mainform';
   var frm = document.forms[frmID];
   
   if (frm && frm.x && frm.x.value && !frm.x.value.match(/^update/)) {
      return checkModified();
   } else {
      return true;
   }
}

function checkModified() {
   if (document.mainform) {
      if (document.mainform.x.value && document.mainform.x.value.match && (!document.mainform.x.value.match(/update_multi|add|save/i))) {
         if (document.mainform.modified.value!='') {
            var ok = confirm("You have made modifications to this information without saving.\nPress 'OK' to discard changes or 'Cancel' to return.");
            if (!ok) {
               return false;
            } else {
               return true;
            }
         } else {
            return true;
         }
      }
   } else {
      return true;
   }
}

function doModify(evt) {
   evt = (evt) ? evt : window.event;

   var frm = document.mainform;
   if (frm && frm.modified) {
      frm.modified.value = 1;
   }
   if (!ui.flashing) {
      flashSave(10, 1);
      ui.flashing = 1;
   } 
}

function doPunchDown(evt, who) {
   evt = (evt) ? evt : ((window.event) ? window.event : null);
   var target = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);

   if (typeof(who)=='string') who = document.getElementById(who);
   if (who.className='btnEnabled') who.style.top = '2px';
}

function doPunchUp(evt, who) {
   evt = (evt) ? evt : ((window.event) ? window.event : null);
   var target = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);

   if (typeof(who)=='string') who = document.getElementById(who);
   if (who.className='btnEnabled') who.style.top = '0px';
}

var overhelp;
function startHelp() {
   overhelp = setTimeout('popupHelp()', 1000);
}

function popupHelp() {
   var url = 'help.php?';
   url += (ui.module) ? 'module='+ui.module+'&' : '';
   url += (ui.process) ? 'process='+ui.process+'&' : '';
   url += 'blurb=1';

   var pop = document.getElementById('helpPopup');
   var hlp = document.getElementById('helpFrame');
   
   if (hlp) {
      hlp.src = url;
   }

   if (pop) {
      pop.style.clip = 'rect(0px,300px,200px,0px)';
      pop.style.display = 'block';
   }
   slideHelp(299);
}

function hideHelp() {
   var pop = document.getElementById('helpPopup');
   
   if (pop) {
      unslideHelp(1);
      // pop.style.display = 'none';
   }
}

var helpWin = new Object();
helpWin.opening = false;
helpWin.closing = false;
helpWin.open = false;
helpWin.closed = true;

function slideHelp(x) {
   if (helpWin.open) return true;
   if (helpWin.closing) clearTimeout(helpWin.closing);
   if (helpWin.opening) clearTimeout(helpWin.opening);

   var dec = Math.round((Math.atan(x)*10)); 
   //var dec = (x<20) ? 3 : 10;
   x = x - dec;

   var help = document.getElementById('helpPopup');
   if (help) {
      help.style.clip = 'rect(0px,300px,200px,' + x + 'px)';
      //help.style.display = 'block';
   }
   if (x > 0) {
      helpWin.opening = setTimeout("slideHelp("+x+")", 0);
   } else {
      helpWin.open = true;
      helpWin.closed = false;
   }
   return true;
}

function unslideHelp(x) {
   if (overhelp) clearTimeout(overhelp);
   if (helpWin.closed) return true;
   if (helpWin.opening) clearTimeout(helpWin.opening);
   if (helpWin.closing) clearTimeout(helpWin.closing);

   var dec = Math.round((Math.atan(x)*10)); 
   //var dec = (x>280) ? 3 : 10
   x = x + dec;

   var help = document.getElementById('helpPopup');
   if (help) {
      help.style.clip = 'rect(0px,300px,200px,' + x + 'px)';
      help.style.display = 'block';
   }
   if (x < 300) {
      helpWin.closing = setTimeout("unslideHelp("+x+")", 0);
   } else {
      helpWin.open = false;
      helpWin.closed = true;
      help.style.display = 'none';
      setTimeout("document.getElementById('helpPopup').style.display = 'none';", 50);
   }
   return true;
}

function doSort(who) {
   var frm = document.mainform;
   if (frm && frm.Sort) {
      frm.Sort.value = who;

      if (frm && frm.SortDir) {
         if (frm.SortDir.value == 'desc') {
            frm.SortDir.value = '';
         } else {
            frm.SortDir.value = 'desc';
         }
      }
      setTimeout("document.mainform.submit();", 250);
   }
   return true;
}

function doMap() {
   buildProcesses('', 12);
}

function flashSave(pos, dir) {
   if (!pos) pos = 10;
   if (!dir) dir = 1;

   pos = pos + (dir * 10);
   
   if ((pos > 200) || (pos < 20)) dir = -dir;

   var btn = document.getElementById('SaveButton');
   if (btn) {
      btn.style.backgroundColor = 'rgb(192, '+pos+', '+pos+')';
   }
   setTimeout("flashSave("+pos+", "+dir+")", 50);
}

function setCookie(name,value,days) {
   var expires, date;

   if (days) {
      date = new Date(); 
      date.setTime(date.getTime()+(days*24*60*60*1000));
      expires = "; expires="+date.toGMTString();
   } else {
      expires = "";
   }
   document.cookie = name + "=" + value + expires + "; path=/";
}

function getCookie(name) {
   var nameEQ = name + "=";
   var ca = document.cookie.split(';');
   for(var i=0;i < ca.length;i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1,c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
   }
   return null;
}

function eraseCookie(name) {
   setCookie(name,"",-1);
}

/**
 * Handle errors
 *
 * @param obj - Object returned by error
 * @param str - The function where the error occured
 * @param int - Recursion level
 **/
function errorHandler(e, func, lvl) {
   var err = 'In function '+func+"\n";
   lvl = (lvl) ? lvl : 0;

   for (var i in e) {
      if ((typeof(e[i])=='array') || (typeof(e[i])=='object')) {
         errorHandler(e[i], (lvl+1));
      } else {
         err += i + ': ' + e[i] + "\n";
      }
   }
   alert(err);
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
      debugDiv.style.zIndex = 999999;
      debugDiv.style.display = 'block';
      debugDiv.style.backgroundColor = '#ffffcc';
      if (debugDiv) debugDiv.innerHTML = dbg;
      return true;
   } else {
      return dbg;
   }
}
/**
 * Dump generated HTML source for the current page
 * 
 * @param obj     - Reference to document or document element to dump.  
 *                  Defaults to entire document if not specified.
 * @param target  - Target window name to dump content to
 *
 **/
function dumpHTML(obj, target) {
   if (!obj) obj = document;
   if (!target) target = window.open('', 'newwin');

   target.document.write(obj.innerHTML);
}

function focusClick(evt) {
   evt = (evt) ? evt : window.event;
   
   var target = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
   // target = (target.nodeType == 1 || target.nodeType==9) ? target : target.parentNode;
   //alert(target.tagName + ' : ' + target.name + ' : ' + target.id + ' : ' + target.className);
   if (target.focus) target.focus();
}
function setDisplayByStatus(){
   if(document.getElementById('orderStatus')){
      if (document.getElementById('orderStatus').value > 2){
        document.getElementById('contractCheckMark').style.display = 'inline';
        document.getElementById('labelsCheckMark').style.display = 'inline';
        document.getElementById('bioboxToggle').innerHTML = 'Bio Box Send Details';
        document.getElementById('bBoxToggle').style.display = 'block';
      }
   }
}


/**
 *replaceNew1InName() is designed to do the work of name replacement that
 *is necessary when adding a new object to a resource.  It is activated 
 *normally via an onchange handler to replace '[new1]' in a select element 
 *name with the value of the most recently selected option element.
 **/

function replaceNew1InName(elementId){
  
   mySelectElementName = document.getElementById(elementId).name;
   myNewNumber = document.getElementById(elementId).value;
   myReplacement = mySelectElementName.replace(/\[(new1)\]/,'['+myNewNumber+']');
   mySelectElementName = myReplacement;
   document.getElementById(elementId).name = myReplacement;
}
 
function labelsOK(){
   document.getElementById('labelsCheckMark').style.display = 'inline';
   var datePrinted = new Date();
   var year = datePrinted.getFullYear();
   var month = datePrinted.getMonth() + 1;
   var date = datePrinted.getDate();
   document.getElementById('labelsPrinted').value = year + "." + month + "." + date;
}

function contractOK(){
   document.getElementById('contractCheckMark').style.display = 'inline';
   document.getElementById('contractPrinted').value = 1;
}

function moveSample(samID) {
   if (!samID) return false;

   var saminc = document.getElementById('SampleIncubator_'+samID);
   var sam = document.getElementById('SampleDewar_'+samID);
   if (saminc) saminc.style.display = 'none';
   if (sam) sam.style.display = 'inline';
}

function doKeypress(evt) {
   evt = evt ? evt : ((event) ? event : null);
   if (evt) {
      var doit = '';
      var key = (!evt.keyCode) ? evt.charCode : evt.keyCode;
      shifted = evt.shiftKey;

      // setStatus('[keypress] '+key+((evt.ctrlKey)?' ctrl':'')+((evt.altKey)?' alt':'')+((evt.shiftKey)?' shift':''));
      // alert('[keypress] '+key+((evt.ctrlKey)?' ctrl':'')+((evt.altKey)?' alt':'')+((evt.shiftKey)?' shift':''));
      if (keyDefs[key]) {
         // KEY (no modifier keys)
         if (keyDefs[key].cmd) doit = keyDefs[key].cmd;
         // SHIFT-KEY
         if ((evt.shiftKey) && (keyDefs[key].shiftKey)) doit = keyDefs[key].shiftKey;
         // CTRL-KEY
         if ((evt.ctrlKey) && (keyDefs[key].ctrlKey)) doit = keyDefs[key].ctrlKey;
         // META-KEY
         if ((evt.metaKey) && (keyDefs[key].metaKey)) doit = keyDefs[key].metaKey;
         // SHIFT-META-KEY
         if ((evt.shiftKey) && (evt.metaKey) && (keyDefs[key].shiftmetaKey)) doit = keyDefs[key].shiftmetaKey;
         // SHIFT-CTRL-KEY
         if ((evt.shiftKey) && (evt.ctrlKey) && (keyDefs[key].shiftctrlKey)) doit = keyDefs[key].shiftctrlKey;
         // ALT-KEY
         if ((evt.altKey) && (keyDefs[key].altKey)) doit = keyDefs[key].altKey;
         // SHIFT-ALT-KEY
         if ((evt.shiftKey) && (evt.altKey) && (keyDefs[key].shiftaltKey)) doit = keyDefs[key].shiftaltKey;
//         setStatus('[keypress] '+key+' code: '+doit+'   '+((evt.ctrlKey)?' ctrl':'')+((evt.altKey)?' alt':'')+((evt.shiftKey)?' shift':''));
         
         if (doit) {
            try {
               eval(doit);
            } catch(e) { 
               errorHandler(e, 'doKeypress'); 
            }

            return false;
         } 
      } 
   }
}

function notifyMessage(msg) {
   if (msg) {
      var out = '';
      var sender = msg['SenderID'].replace(/\@.*/, '');
      msg['Chat'] = msg['Chat'].replace(/\&gt\;/, '>');
      msg['Chat'] = msg['Chat'].replace(/\&lt\;/, '<');
      msg['Chat'] = msg['Chat'].replace(/\&amp\;/, '&');
      msg['Chat'] = msg['Chat'].replace(/\&quot\;/, "'");

      var chat = document.getElementById('chat');
      
      if (chat) {
         setClass(chat, 'chat chatAlert');
         chat.setAttribute('title', 'New message from '+sender+': '+msg['Chat']);
      }
   }
   if (msg['Notified']!=1) playSound('/sounds/beep8.wav');
}

function resetChat() {
   var chat = document.getElementById('chat');
   
   if (chat) {
      setClass(chat, 'chat');
      chat.setAttribute('title', 'Open chat window');
   }
}

function playSound(url) {
   var sndFrame = document.getElementById('snd');
   
   if (sndFrame) {
      sndFrame.src = "about:blank";
      sndFrame.src = url;
   }
   setTimeout("endSound()", 5000);
}

function endSound() {
   var sndFrame = document.getElementById('snd');
   if (sndFrame) {
      sndFrame.src = "about:blank"; //so refresh won't replay sound
   }
}

function updateDataStatus() {

}
var timediv;
function updateTime(timediv, mydate) {
   timediv = (timediv) ? timediv : 'clockTime0';
   var now = new Date(mydate - 8000);
   var newtime = getTimeString(now);
   var flip = now.getSeconds() % 2;

   var el = document.getElementById(timediv + flip);
   var el2 = document.getElementById(timediv + (flip ^ 1));
   if (el) {
      el.innerHTML = newtime;
      el.style.width = '300px';
      el.style.display = 'block';
   }
   setTimeout(function() {
      updateTime(timediv, mydate + 60000);
   }, 60000);
   // setTimeout("document.getElementById('" + (timediv + (flip ^ 1)) + "').style.display = 'none';", 50);
}

var datediv;
function updateDate(datediv) {
   datediv = (datediv) ? datediv : 'clockDate';
   var now = new Date();

   var el = document.getElementById(datediv);
   if (el) {
      el.innerHTML = getDateString(now);
      el.style.width = '300px';
   }
}

function getDateString(date) {
   var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
   return months[date.getMonth()] + " " + date.getDate() + ", " + date.getFullYear();
}

function getTimeString(date) {
   var tmphr = (date.getHours()>12) ? date.getHours() - 12 : date.getHours();
   var hr = (tmphr < 10) ? '0' + tmphr : tmphr;
   var xm = (date.getHours()>11) ? 'PM' : 'AM';
   var mn = (date.getMinutes()<10) ? '0' + date.getMinutes() : date.getMinutes();
   var sc = (date.getSeconds()<10) ? '0' + date.getSeconds() : date.getSeconds();
   
   return hr + ':' + mn + ':' + sc + ' ' + xm;
}

function doCheck(who) {
   return true;
}

var search, tbl, searchTO;
function filterTable(search, tbl) {
   // evt = (evt) ? evt : window.event;
   // var charCode = (evt.charCode) ? evt.charCode : evt.keyCode;
   // var newkey = String.fromCharCode(charCode);
   // search += newkey;
   
   if (!tbl) tbl = 'oviewTable';
   
   if (search) {
      var tbl = document.getElementById(tbl);
      var found, r, row, out, res, cell;
      for (var r=0; r<tbl.rows.length; r++) {
         found = 0;
         row = tbl.rows[r];
         for (var x=0; x<row.cells.length; x++) {
            cell = row.cells[x];
            
            eval("res = cell.innerHTML.match(/" + search + "/i)");
            if (res) found = 1;
         }
         if (!found && (row.style.display != 'none')) {
            row.style.display = 'none';
            // row.style.visibility = 'collapse';
         } else if (found && (row.style.display != 'table-row')) {
            row.style.display = 'table-row';
            // row.style.visibility = 'visible';
         }
      }
   }
   setTimeout("document.mainform.modified.value = '';", 500);
}

function buildTable(tblname, obj, fields, styles, id) {
   if (!tblname) var tblname = 'assetTable';
   if (!styles) var styles = new Array();

   var tbl = document.getElementById(tblname);
   
   if (tbl) {
      tbl.innerHTML = '';  // Cheesy hack to clear table (fastest across browsers)
      
      var arr, row, cell, sel;
      row = document.createElement('tr');
      
      for (var field in fields) {
         cell = document.createElement('th');
         cell.className = 'ts_head';
         cell.innerHTML = fields[field];
         row.appendChild(cell);
      }
      tbl.appendChild(row);
      var flop = 0;
      var cnt = 0;
      for (var item in obj) {
         row = document.createElement('tr');
         row.id = 'row' + cnt;
         row.setAttribute('id', 'row' + cnt);
         row.onclick = doTableClick;
         sel = (id==obj[item]['ID']) ? ' current' : ''; 
         flop ^= 1;
         for (var field in fields) {
            cell = document.createElement('td');
            cell.className = 'ts_cell ts_row' + flop + ' ' + ((styles[field]) ? styles[field] : '') + sel;
            cell.id = field + cnt;
            if (field != 'Thumbnail') {
               cell.innerHTML = obj[item][field];
            } else {
               cell.innerHTML = "<img src='" + obj[item][field] + "'/>";
            }
            row.appendChild(cell);
         }
         tbl.appendChild(row);
         ++cnt;
      }
   } 
}
var currentAsset;
function doTableClick(evt) {
   evt = (evt) ? evt : window.event;
   if (evt && evt.target) {
      var tar = evt.target;
      var aid = tar.id.replace(/\D*/, '');
      var i, fel, cell;
      
      for (i in assets[aid]) {
         fel = document.getElementById(i);
         if (fel) fel.value = assets[aid][i];
         
         if (currentAsset) {
            cell = document.getElementById(i + currentAsset);
            if (cell) cell.className = cell.className.replace(/\scurrent/, '');
         }
         cell = document.getElementById(i + aid);
         if (cell) cell.className += ' current'

         cell = document.getElementById('AssetID');
         if (cell) cell.innerHTML = assets[aid]['AssetID'];
         
         cell = document.getElementById('AssetImage');
         if (cell) cell.src = assets[aid]['URI'];
      }
      currentAsset = aid;
      // document.location.href = '/content/assets/index.php?id=' + assets[aid]['AssetID'];
   }
}
var editedCells;
function editPunch(who, root, when, id, punch) {
   if (!editedCells) editedCells = new Array();
   if (typeof(who) == 'string') who = document.getElementById(who);
   var cellname = who.name;
   var curtime = who.innerHTML;
   if (curtime.match(/input/i)) return false;
   var cnt = editedCells.length;
   var out = "<div id='editedCell" + cnt + "'><input type='text' onclick='return false;' class='boxValue' name='" + root + "[Time]' id='punchTime' value='" + curtime + "' size='10' style='width:4em;padding:0px;margin:0px;'/>\n";
   out += "<input type='hidden' name='" + root + "[Date]' id='punchDate' value='" + when + "'/>\n";
   out += "<input type='hidden' name='" + root + "[EmployeeID]' id='punchEmployeeID' value='" + id + "'/>\n";
   out += "<input type='hidden' name='" + root + "[Punch]' id='punchPunch' value='" + punch + "'/>\n";
   out += "<input type='hidden' name='" + root + "[Type]' id='punchType' value='" + ((punch=='lunch'||punch=='out') ? 'out' : 'in') + "'/></div>\n";
   who.innerHTML = out;
   who.name = cellname;
   var pt = document.getElementById('punchTime');
   if (pt) {
      pt.focus();
      pt.select();
   }
   if (document.mainform && document.mainform.x) document.mainform.x.value = 'update';
   editedCells[cnt] = {'Punch':curtime, 'Cell':who, 'Name': cellname};
}

function uneditPunch() {
   var lastedit = editedCells.length - 1;
   if (lastedit > -1) {
      editedCells[lastedit].innerHTML = editedCells[lastedit].Punch;
      var lastin = editedCells.pop();
   }
}

function editPayroll(who, fname) {
   var curval = who.innerHTML;
   if (curval.match(/input/i)) return false;
   
   var out = "<input type='text' onclick='return false;' class='boxValue' name='" + fname + "' id='PayrollEdit' value='" + curval + "' size='10' style='width:2em;'/>\n";

   who.innerHTML = out;
   var pt = document.getElementById('PayrollEdit');
   if (pt) pt.focus();
   if (document.mainform && document.mainform.x) document.mainform.x.value = 'update';

}
function doTab(evt) {
   evt = (evt) ? evt : window.event;
   
   if (!employeeID) {
      return true;
   } else {
      var types = {'in':'lunch', 'lunch':'return', 'return':'out', 'out':''};
      var elem = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
      if (elem && elem.parentNode && elem.parentNode.parentNode.id) {
         if (elem.parentNode.parentNode.id.match(/(in|lunch|return|out)/)) {
            var curcell = elem.parentNode.parentNode.id.split(/_/);
            var cellname = elem.name.split(/_/);
            if (types[curcell[0]]) {
               var celldate = curcell[1].replace(/(\d\d\d\d)(\d\d)(\d\d)/, '$1-$2-$3');
               var newcell = document.getElementById(types[curcell[0]] + '_' + curcell[1]);
               if (newcell) {
                  if (!cellname[1]) cellname[1] = 'new' + ((editedCells.length + 2) * 100);
                  editPunch(newcell, 'Timeclock['+cellname[1]+']', celldate, employeeID, types[curcell[0]]);
               }
            }
         }
      }
      return false;
   } 
}

function doEscape() {
   if (editedCells && editedCells.length) {
      uneditPunch();
   }
}
function makeDate(mm, dd, yyyy, curid, rsc, field) {
   var m = document.getElementById(mm);
   var d = document.getElementById(dd);
   var y = document.getElementById(yyyy);
   var dateInput = document.getElementById(field);
   dateInput.name = rsc + '[' + curid + '][' + field + ']';
   dateInput.value = y.value + '-' + m.value + '-' + d.value;
}

function makeTime(hh, mm, ampm, curid, rsc, field) {
   var h = document.getElementById(hh);
   var m = document.getElementById(mm);
   var a = document.getElementById(ampm);
   var timeInput = document.getElementById(field);
   timeInput.name = rsc + '[' + curid + '][' + field + ']';
   timeInput.value = h.value + ':' + m.value + ' ' + a.value;
}
           
function authorize(who) {
   var disp = who + 'disp';
   var inp = document.getElementById(who);
   var dis = document.getElementById(disp);
   var now = new Date();
   var month = now.getMonth() + 1;
   var date = now.getDate();
   var year = now.getFullYear();
   var hour = now.getHours();
   var minute = now.getMinutes();
   var second = now.getSeconds();
   var theDate = month + '/' + date + '/' + year + ' ' + hour + ':' + minute + ':' + second;
   inp.value = theDate;
   dis.innerHTML = theDate;
   var btn = document.getElementById(who + 'Button');
   if (btn) btn.style.display = 'none';
}

function updateChecked(who, tgt) {

   var tgtEl = document.getElementById(tgt);
   if (tgtEl && who && who.checked) {
      tgtEl.value = 1;
   } else if (tgtEl && who) {
      tgtEl.value = 0;
   }
   return false;
}
function moveItems(fromBox, toBox, type) {
   var fb = document.getElementById(fromBox);
   var tb = document.getElementById(toBox);
   var opts = fb.options;
   var updated = [];
   for (var o=0; o<opts.length; o++) {
      if (opts[o].selected) {
         tb.options[tb.options.length] = new Option(opts[o].text, opts[o].value);
         updated[updated.length] = opts[o].value;
      }
   }
   for (var o=0; o<opts.length; o++) {
      if (opts[o].selected) {
         opts[o].selected = false;
         rmOption(o, fb);
      }
   }
   updateUserAccess(updated, type);
}

function rmOption(idx, el) {
   for (var o=idx; o<el.options.length-1; o++) {
      if (el.options[o+1]) el.options[o] = new Option(el.options[o+1].text, el.options[o+1].value);
   }
   el.options.length = el.options.length - 1;
}

function moveAllItems(fromBox, toBox, type) {
   var fb = document.getElementById(fromBox);
   var tb = document.getElementById(toBox);
   var updated = [];

   if (fb && fb.options) {
      for (var o in fb.options) {
         if (fb.options[o].text) {
            tb.options[tb.options.length] = new Option(fb.options[o].text, fb.options[o].value);
            updated[updated.length] = fb.options[o].value;
         }
      }
      for (var o=fb.options.length; o>0; o--) { rmOption(o, fb); }
   }
   var lang = updateLanguages();
   updateUserAccess(updated, type);
}

function removeAllItems(who) {
   var fb = document.getElementById(who);
   
   if (fb && fb.options) {
      for (var o=fb.options.length; o>0; o--) { rmOption(o, fb); }
   }
}

function updateUserAccess(arr, type) {
   var fid = document.getElementById('FormID').value;
   document.location.href = 'userAccess.php?src=Form&srcID='+fid+'&tgt=User&tgtID='+arr[0]+'&FormID='+fid+'&x='+type+'&UserID='+arr[0];
}

function doKeypress(evt) {
   evt = (evt) ? evt : window.event;

   var key = (!evt.keyCode) ? evt.charCode : evt.keyCode;
   var shifted = evt.shiftKey;

   if ((key == 13) && (!evt.ctrlKey && !evt.metaKey)) {
      return false;
   }
   return true;

}

document.onkeypress = doKeypress;
