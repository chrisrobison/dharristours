var state = new Object();
var ui = new Object();

function getEvent(evt) {
   evt = (evt) ? evt : ((window.event) ? window.event : null);

   return evt;
}

function selectModule(evt, moduleID) {
   evt = getEvent(evt);

   state.Module = moduleID;      // Store current moduleID in 'state' object for later reference
   
   // Deselect any existing selection
   if (ui.Module) {
      ui.Module.setAttribute('class', 'listRow');
      ui.Module.setAttribute('className', 'listRow');
   }

   // Change class of selected item to 'selectedList' which highlights the entry
   var target = (evt.target.nodeType == 3) ? evt.target.parentNode : evt.target;
   if (target) {
      var realTarget = (target.parentNode.id == 'formWrap') ? target : target.parentNode;

      realTarget.setAttribute('class', 'listRowSelected');
      realTarget.setAttribute('className', 'listRowSelected');
      
      ui.Module = realTarget;
   }
   
   // Show Process div
   var proc = document.getElementById('Process');

   // Load browse.php into ProcessFrame with passed moduleID to display list of 
   // processes associated with this module
   var ProcessFrame = document.getElementById('ProcessFrame');
   if (ProcessFrame) ProcessFrame.src = 'browse.php?rsc=Process&ModuleID=' + moduleID;
   
   // Clear ProcessResource frame
   var ProcessResourceFrame = document.getElementById('ProcessResourceFrame');
   if (ProcessResourceFrame) ProcessResourceFrame.style.display = '';

   // Load editor frame with details of selected module
   var EditFrame = document.getElementById('EditFrame');
   if (EditFrame) EditFrame.src = 'edit.php?rsc=Module&ModuleID=' + moduleID;
}

function selectProcess(evt, processID) {
   evt = getEvent(evt);
   state.Process = processID;
   
   // Deselect any existing selection
   if (ui.Process) {
      ui.Process.setAttribute('class', 'listRow');
      ui.Process.setAttribute('className', 'listRow');
   }
   
   // Unfocus module
   if (ui.Module) {
      ui.Module.setAttribute('class', 'unfocusedRow');
      ui.Module.setAttribute('className', 'unfocusedRow');
   }


   // Change class of selected item to 'selectedList' which highlights the entry
   var target = (evt.target.nodeType == 3) ? evt.target.parentNode : evt.target;
   if (target) {
      var realTarget = (target.parentNode.id == 'formWrap') ? target : target.parentNode;

      realTarget.setAttribute('class', 'listRowSelected');
      realTarget.setAttribute('className', 'listRowSelected');
      ui.Process = realTarget;
   }

   // Load browse.php into ProcessResourceFrame with passed processID to display list of 
   // ProcessResources associated with this process
   var ProcessResourceFrame = document.getElementById('ProcessResourceFrame');
   if (ProcessResourceFrame) ProcessResourceFrame.src = 'browse.php?rsc=ProcessResource&ProcessID=' + processID;
   
   // Load editor frame with details of selected process
   var EditFrame = document.getElementById('EditFrame');
   if (EditFrame) EditFrame.src = 'edit.php?rsc=Process&ProcessID=' + processID;
}

function selectProcessResource(evt, ProcessResourceID) {
   evt = getEvent(evt);
   state.ProcessResource = ProcessResourceID;

   // Unfocus module
   if (ui.Module) {
      ui.Module.setAttribute('class', 'unfocusedRow');
      ui.Module.setAttribute('className', 'unfocusedRow');
   }

   // Unfocus process
   if (ui.Process) {
      ui.Process.setAttribute('class', 'unfocusedRow');
      ui.Process.setAttribute('className', 'unfocusedRow');
   }
   
   // Unfocus ProcessResource 
   if (ui.ProcessResource) {
      ui.ProcessResource.setAttribute('class', 'listRow');
      ui.ProcessResource.setAttribute('className', 'listRow');
   }

 // Change class of selected item to 'selectedList' which highlights the entry
   var target = (evt.target.nodeType == 3) ? evt.target.parentNode : evt.target;
   if (target) {
      var realTarget = (target.parentNode.id == 'formWrap') ? target : target.parentNode;

      realTarget.setAttribute('class', 'listRowSelected');
      realTarget.setAttribute('className', 'listRowSelected');
      
      ui.ProcessResource = realTarget;
   }

   // Load editor frame with details of selected ProcessResource
   var EditFrame = document.getElementById('EditFrame');
   if (EditFrame) EditFrame.src = 'edit.php?rsc=ProcessResource&ProcessResourceID=' + ProcessResourceID;
}

function selectNav(evt, NavID) {
   evt = getEvent(evt);
   state.Nav = NavID;
   
   // Deselect any existing selection
   if (ui.Nav) {
      ui.Nav.setAttribute('class', 'listRow');
      ui.Nav.setAttribute('className', 'listRow');
   }
   
   // Unfocus module
   if (ui.Module) {
      ui.Module.setAttribute('class', 'unfocusedRow');
      ui.Module.setAttribute('className', 'unfocusedRow');
   }


   // Change class of selected item to 'selectedList' which highlights the entry
   var target = (evt.target.nodeType == 3) ? evt.target.parentNode : evt.target;
   if (target) {
      var realTarget = (target.parentNode.id == 'formWrap') ? target : target.parentNode;

      realTarget.setAttribute('class', 'listRowSelected');
      realTarget.setAttribute('className', 'listRowSelected');
      ui.Nav = realTarget;
   }

   // Load browse.php into NavFrame with passed NavID to display list of 
   // Navs associated with this Nav
   var NavFrame = document.getElementById('NavFrame');
   if (NavFrame) NavFrame.src = 'browse.php?rsc=Nav&NavID=' + NavID;
   
   // Load editor frame with details of selected Nav
   var EditFrame = document.getElementById('EditFrame');
   if (EditFrame) EditFrame.src = 'edit.php?rsc=Nav&NavID=' + NavID;
}
function doNew(who) {
   var EditFrame = document.getElementById('EditFrame');
   var url = 'edit.php?x=new&rsc=' + who;
   var currentIDs = new Array();

   if (state.Module && (who!='Module')) currentIDs[currentIDs.length] = 'ModuleID=' + state.Module;
   if (state.Nav && (who!='Nav')) currentIDs[currentIDs.length] = 'NavID=' + state.Nav;
   if (currentIDs) url += '&' + currentIDs.join('&');
   if (EditFrame) EditFrame.src = url;
}

function doDelete(who) {
   var EditFrame = document.getElementById('EditFrame');

   if (state[who]) {
      var url = 'edit.php?x=delete&rsc=' + who + '&' + who + 'ID=' + state[who];
      if (EditFrame) EditFrame.src = url;
      return true;
   } else {
      alert("Error: Cannot delete " + who + ".\nNo "+who+" selected.  Please select a "+who+" and try again.");
      return false;
   }   
}

function doRefresh(who) {
   var target = document.getElementById(who+'Frame');
   if (target) {
      target.contentDocument.location.reload();
   }
}

