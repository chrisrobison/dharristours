// Object constructor for 'Section' objects to store current record
// info,, state, etc
function Section(name) { 
   this.name = name;
   this.state = 0;
   this.record = new Array();
}

var change = new Array();
var sections = new Array('Purchase', 'Contact', 'Vet', 'Animal','CC');
var section = new Object();
section.Purchase = new Section('Purchase');
section.Contact = new Section('Contact');
section.Vet = new Section('Vet');
section.Animal = new Section('Animal');
section.CC = new Section('CC');

var state = new Object();
state.currentRecord = 0;
state.currentMode = 'Browse';
state.resultset = new Array();
state.query = new Array();
state.ids = new Array();

// This needs to be replaced with real generated data from the db
var services = [{'ServiceID':"10",'Service':"Order On Hold",'Price':"0.00",'Shipping':"0.00",'Annual':"0.00",'Total':"0.00"},{'ServiceID':"100",'Service':"PetBank Ensure",'Price':"895.00",'Shipping':"95.00",'Annual':"0.00",'Total':"990.00"},{'ServiceID':"101",'Service':"PetBank Ensure Plus",'Price':"1395.00",'Shipping':"115.00",'Annual':"0.00",'Total':"1510.00"},{'ServiceID':"102",'Service':"PetBank Express",'Price':"295.00",'Shipping':"95.00",'Annual':"0.00",'Total':"390.00"},{'ServiceID':"103",'Service':"Cell Growth Trial",'Price':"500.00",'Shipping':"115.00",'Annual':"0.00",'Total':"615.00"},{'ServiceID':"104",'Service':"Cell Growth Trial Banked",'Price':"1500.00",'Shipping':"0.00",'Annual':"0.00",'Total':"1500.00"},{'ServiceID':"105",'Service':"Gene Banking Storage Standard",'Price':"100.00",'Shipping':"15.00",'Annual':"0.00",'Total':"115.00"},{'ServiceID':"106",'Service':"Gene Banking Storage Emergency",'Price':"150.00",'Shipping':"0.00",'Annual':"0.00",'Total':"150.00"},{'ServiceID':"107",'Service':"Gift Certificate Gene Banking",'Price':"990.00",'Shipping':"0.00",'Annual':"0.00",'Total':"990.00"},{'ServiceID':"108",'Service':"Gene Banking Cell Transfer To GSC",'Price':"500.00",'Shipping':"95.00",'Annual':"0.00",'Total':"595.00"},{'ServiceID':"109",'Service':"Gene Banking Endangered Standard",'Price':"600.00",'Shipping':"95.00",'Annual':"0.00",'Total':"695.00"},{'ServiceID':"110",'Service':"Gene Banking Endangered Emergency",'Price':"800.00",'Shipping':"115.00",'Annual':"0.00",'Total':"915.00"},{'ServiceID':"122",'Service':"Gene Banking Storage Standard",'Price':"200.00",'Shipping':"15.00",'Annual':"0.00",'Total':"215.00"},{'ServiceID':"124",'Service':"PetBank Ensure (Online)",'Price':"895.00",'Shipping':"95.00",'Annual':"0.00",'Total':"990.00"},{'ServiceID':"125",'Service':"PetBank Ensure Plus (Online)",'Price':"1395.00",'Shipping':"115.00",'Annual':"0.00",'Total':"1510.00"},{'ServiceID':"126",'Service':"PetBank Express (Online)",'Price':"295.00",'Shipping':"95.00",'Annual':"0.00",'Total':"390.00"},{'ServiceID':"127",'Service':"Transfer Express",'Price':"295.00",'Shipping':"0.00",'Annual':"0.00",'Total':"295.00"},{'ServiceID':"128",'Service':"Transfer Ensure",'Price':"500.00",'Shipping':"0.00",'Annual':"0.00",'Total':"500.00"}];

var keyDefs = new Array();

// Escape
keyDefs[27] = { cmd:'clearAllSections()' };
// Enter
keyDefs[13] = { cmd:'doEnter(evt)'};
// 'F'
keyDefs[70] = { metaKey:'clearAllSections()' };
keyDefs[102] = { metaKey:'clearAllSections()' };
// Cursor-Up/Left
// keyDefs[37] = { cmd:"gotoRecord('prev')" };
// keyDefs[38] = { cmd:"gotoRecord('prev')" };
// Cursor-Down/Right
// keyDefs[39] = { cmd:"gotoRecord('next')" };
// keyDefs[40] = { cmd:"gotoRecord('next')" };
// 'S'
keyDefs[83]  = { ctrl:"doSave()", meta:"doSave()" };
keyDefs[115] = { ctrl:"doSave()", meta:"doSave()" };
// 'N'
keyDefs[78]  = { ctrl:"doNew()", meta:"doNew()" };
keyDefs[110] = { ctrl:"doNew()", meta:"doNew()" };

function toggle(who) {
   var tb = document.getElementById(who + 'Section');
   if (tb) tb.style.display = (!section[who].state) ? 'none' : 'block';

   var arrow = document.getElementById(who+'Arrow');
   if (arrow) arrow.src = (!section[who].state) ? 'img/arrow_closed.png' : 'img/arrow_open.png';
   section[who].state ^= 1;
   
   createCookie(who, section[who].state, 100);
}

function init() {
   initDOMAPI();
   for (var s=0; s<sections.length; s++) {
      var tmp = getCookie(sections[s]);

      if (tmp==1) toggle(sections[s]);
   }
   var trans = document.getElementById('transport');
   trans.src = 'cmd.php';
   //var trans = window.open('cmd.php', trans);
   setTimeout("highlightRow(0, 'gridSelected', '#99eeff');", 2000);
}

function unsave(who) {
   if (who) {
      var ani = document.getElementById(who+'Save');
      if (ani) ani.src = 'img/pencil.png';
   }
}

function unflash(evt, who) {
   evt = (evt) ? evt : window.event;
   if (state.updating) return true;
   if (who) {
      var ani = document.getElementById(who+'Save');
      if (ani) ani.src = 'img/save.png';
   }
}

function flash(evt, who) {
   evt = (evt) ? evt : window.event;
   if (evt.target.name.match(/ID$/)) return false;
   if (who) {
      var ani = document.getElementById(who+'Save');
      if (ani) ani.src = 'img/ani_save.gif';
   }
}

function updateNav(recno, rectot) {
   var navtxt = document.getElementById('resultCount');
   if (navtxt) navtxt.innerHTML = '&nbsp; of ' + (rectot);

   var jumpid = document.getElementById('jumpID');
   if (jumpid) jumpid.value = (recno + 1);

   /*
   var pos = Math.round((recno / rectot) * 54) + 4;
   var tab = document.getElementById('rolodexTab');
   if (tab) tab.style.top = pos + 'px';
   */
}

function updateResults(arr) {
   state.resultset = arr;
   state.currentRecord = 0;
   updateNav(state.currentRecord, state.resultset.length);
   changeMode('Browse', 1);
}

function gotoRecord(type, view, rcs) {
   selectRow(state.currentRecord + 1, 0);
   rcs = (rcs) ? rcs : 'Purchase';
   if ((state.currentRecord==null) || (!state.resultset.length)) return true;

   switch (type) {
      case 'first':
         state.currentRecord = 0;
         break;
      case 'prev':
         --state.currentRecord;
         break;
      case 'next':
         ++state.currentRecord;
         break;
      case 'last':
         state.currentRecord = state.resultset.length - 1;
         break;
      default: 
         state.currentRecord = parseInt(type) - 1;
   }
   
   if (state.currentRecord < 0) state.currentRecord = 0;
   if (state.currentRecord > (state.resultset.length - 1)) state.currentRecord = state.resultset.length - 1;
   if (view) viewRecord(state.currentRecord, rcs);
   updateNav(state.currentRecord, state.resultset.length);

   return false;
}

function browseRecord(evt) {
   evt = (evt) ? evt : window.event;

   if (evt.layerY < 30) {
      selectRow((state.currentRecord - 1), 0);
   } else {
      selectRow((state.currentRecord + 1), 0);
   }
   
   if (state.currentRecord < 0) state.currentRecord = 0;
   if (state.currentRecord > (state.resultset.length - 1)) state.currentRecord = state.resultset.length - 1;
   viewRecord(state.currentRecord, 'Purchase');
   updateNav(state.currentRecord, state.resultset.length);

}

function viewRecord(oid, rcs, pid) {
   clearForm(pid, true);
   rcs = 'Purchase';
   if (oid) {
      document.forms[rcs+'Form'].ID.value = state.resultset[oid];
      document.forms[rcs+'Form']['PurchaseID'].value = state.resultset[oid];
      pid = state.resultset[oid];
   } else if (pid) {
      document.forms[rcs+'Form'].ID.value = pid;
      document.forms[rcs+'Form']['PurchaseID'].value = pid;
   }
   document.forms[rcs+'Form']['PurchaseID'].name = 'Purchase[search][PurchaseID]';
   selectRow(oid, pid);
   state.ids = new Array();

   document.forms[rcs+'Form'].x.value = 'view';
   document.getElementById('EditButton').removeAttribute('disabled');
   document.getElementById('SaveButton').setAttribute('disabled', true);
   // document.forms[rcs+'Form'].browse.value = 1;
   // changeMode('Browse', 1);
   setTimeout("document.forms['"+rcs+"Form'].submit();", 150);
}

function selectRow(oid, pid) {
   if (pid && !oid) {
      for (var i in state.resultset) {
         if (state.resultset[i].PurchaseID == pid) {
            oid = i;
            break;
         }
      }
   }
   if (!pid && oid) pid = state.resultset[oid].PurchaseID;
   if (!pid && !oid) {
      for (var i in state.resultset) {
         oid = i;
         pid = state.resultset[oid].PurchaseID;
         state.currentRecord = 0;
         break;
      }
   }
   if (!state.currentRecord) state.currentRecord = 0;
   highlightRow(state.currentRecord, 'gridCell row' + (state.currentRecord & 1), 'transparent');
   
   if (!oid) oid = 0;
   state.currentRecord = oid;
   state.PurchaseID = pid;
   highlightRow(oid, 'gridSelected', '#99eeff');
   updateNav(state.currentRecord, state.resultset.length);
}

function highlightRow(rownum, newclass, bgcolor) {
   if (!rownum) rownum = 0;
   newclass = (newclass) ? newclass : 'gridCell'
   var gridBody = document.getElementById('gridBody');
   if (gridBody && gridBody.rows.length) {
      gridBody.rows.item(rownum).setAttribute('className', newclass);
      gridBody.rows.item(rownum).setAttribute('class', newclass);
      for (var cell=0; cell<gridBody.rows[rownum].cells.length; cell++) {
         gridBody.rows.item(rownum).cells.item(cell).setAttribute('class', newclass);
         gridBody.rows.item(rownum).cells.item(cell).setAttribute('className', newclass);
      }
   }
}

function updateGrid(data, clear, count) {
   var content = document.getElementById('detail');
   var grid = document.getElementById('grid');
   var gridBody = document.getElementById('gridBody');
   
   if (count) state.recordCount = count;
   state.fetching = 0;

   if (gridBody && data) {
      if (clear) gridBody.innerHTML = '';  // Cheese! :^)
      var tr, td, t, tmp, sel;
      td = new Array();
      var row = 1;
      var cnt = 0;

      for (var g in data) {
         sel = '';
         tr = document.createElement('tr');
         td[0] = data[g]['PurchaseID'];
         td[1] = data[g]['ServiceType'];
         td[2] = data[g]['Status'];
         td[3] = data[g]['Contact'];
         td[4] = data[g]['Vet'];
         td[5] = data[g]['Animal'];
         td[6] = data[g]['Paid'];
         
         if (cnt == 0) {
            tr.setAttribute('className', 'gridSelected');
            sel = ' gridSelected';
         }
         row ^= 1;

         for (t=0; t<td.length; t++) {
            tmp = document.createElement('td');
            tmp.setAttribute('nowrap', true);
            tmp.setAttribute('class', 'gridCell row'+row+sel);
            
            tmp.innerHTML = "<a class='gridLink' href='javascript:void(null)' onclick=\"viewRecord("+cnt+", 'Purchase', "+data[g]['PurchaseID']+")\">" + ((td[t]) ? td[t] : '') + "</a>";
            tr.appendChild(tmp);
         }
         cnt++;
         gridBody.appendChild(tr);
      }
      tr = document.createElement('tr');
      tmp = document.createElement('td');
      tmp.setAttribute('colspan', '7');
      tmp.setAttribute('class', 'gridCell');
      tmp.setAttribute('height', '100%');
      tmp.setAttribute('style', 'height:100%;');
      tr.appendChild(tmp);
      gridBody.appendChild(tr);
      
      showGrid();

      if (clear) {
         highlightRow(0, 'gridSelected', '#99eeff');
      }
   }
}

function toggleGrid() {
   if (!state['List'] || (state['List'] == 0)) {
      showGrid();
   } else {
      hideGrid();
   }
}

function showGrid() {
   var detail = document.getElementById('detail');
   var grid = document.getElementById('grid');
   var handle = document.getElementById('frameBorder');
   var toolbar = document.getElementById('toolbar');

   if (grid) grid.style.display = 'block';
   if (detail) detail.style.top = '182px';
   if (handle) handle.style.top = '150px';
   if (toolbar) toolbar.style.top = '158px';
   // setButton('modeList', 'modeButton modeSelected enabled');
   state['List'] = 1;
}

function hideGrid() {
   var detail = document.getElementById('detail');
   var grid = document.getElementById('grid');
   var handle = document.getElementById('frameBorder');
   var toolbar = document.getElementById('toolbar');

   if (grid) grid.style.display = 'none';
   if (detail) detail.style.top = '32px';
   if (toolbar) toolbar.style.top = '8px';
   if (handle) handle.style.top = '0px';
   // setButton('modeList', 'modeButton');
   state['List'] = 0;
}

function updateData(who, data, mom, par, gpar) {
   if (!data) return false;
   if (who=='Purchase') state.data = data;
   
   if (!mom) mom = "Purchase["+data['PurchaseID']+"]";
      
   var momkey, typ, cssclass;
   var frm = document.forms['PurchaseForm'];
   var oview = '';

   /**
    * Setup array that defines our overview line.  The field list is suppose to be 'fuzzy'
    * in that not every field exists in each section.  The result is a line of data containing
    * data from fields that do exist in each section.
    *
    * Todo: This should really be defined elsewhere, preferably in the db, but not here in the 
    *       client-side javascript.  Extending the use of the StaticList/StaticListItem tables
    *       with serialized js could be the answer or the addition of a generic configuration table.
    *
    **/
   var stat = { 'LastName':1, 'FirstName':1, 'Clinic':1, 'Phone':1, 'Email':1, 'Name':1, 'Species':1, 'Breed':1 };
   
   state.updating = 1;

   try {
      /**
       * Recursively iterate through each array item, calling this function
       * again if the value is not a string or number and calling updateSample
       * if the key we are looking at is a sample.
       **/
      for (var key in data) {
         typ = typeof(data[key]);
         if (!typ.match(/number|string/)) {
            if (key.match(/Sample/i)) {
               updateSamples(data[key]);
            } else {
               /** 
                * To compensate for the oddness of the dbobj only returning all but the first
                * array element as the ID of the record contained within, we perform a check
                * of 'key' for '0' and if so, grab the ID from the child, otherwise use 'key'
                * unchanged.  If the mysterious '0' ever clears up, this will simply evaluate 
                * false each time and assign the correct ID.  This shouldn't hose anything else
                * either since there really shouldn't be any keys of '0' anywhere else in the object
                **/
               if (data[key]) {
                  momkey = (key==0) ? data[key][par+'ID'] : key;
                  updateData(who + '_' + key, data[key], mom+'['+momkey+']', key, who);
               }
            }
         } else {
            if (key.match && key.match(/ID$/i) && !state.ids[key]) {
               if (who) {
                  if (!state.ids[who]) state.ids[who] = new Array();
                  // alert("setting who: "+who+" key: "+key+" value: "+data[key]);
                  state.ids[who][key] = data[key];
                  state.ids[key] = data[key];
               } else {
                  state.ids[key] = data[key];
               }
            }
            var input = document.getElementById(who+'_'+key);
            if (!input) input = document.getElementById(key);

            if (input) {
               if (input.type.match(/select/)) {
                  setSelect(input, data[key]);
               } else if (input.type.match(/check/)) {
                  if (data[key]) {
                     input.setAttribute('checked', true);
                  } else {
                     input.removeAttribute('checked');
                  }
               } else {
                  if ((key == 'CC') && (data[key])) data[key] = '************' + data[key].replace(/\d+(\d\d\d\d)/, '$1');
                  
                  cssclass = (input.type == 'textarea') ? 'orderCommentsView' : 'orderView';
                  data[key] = data[key].replace(/\&\#039\;/g, "'");
                  data[key] = data[key].replace(/\&amp\;/g, "&");
                  input.value = data[key];
                  input.setAttribute('class', cssclass);
               }
               if (stat[key]) {
                  oview += data[key] + ' ';
               }
               input.name = mom + '[' + key + ']';
               input.setAttribute('name', mom + '[' + key + ']');
               input.setAttribute('disabled', true);
            }
         }
      }
      if (data['CC']) {
         var ccicon = (data['Paid']==1) ? '/img/cc_accepted.png' : ((data['Paid']==-1) ? '/img/cc_rejected.png' : '/img/cc_unknown.png');
         var ccimg = document.getElementById('ccimg');

         if (ccimg) ccimg.src = ccicon;
      }
      updateOverview(who, oview);
      
   } catch(e) {
      errorHandler(e, 'updateData');
   }
   if (data['PurchaseID']) {
      var dispDate = document.getElementById('dispDate');
      if (dispDate) dispDate.innerHTML = data['Created'].replace(/\s.*/, '');
      finishUpdate('Purchase['+data['PurchaseID']+']' , data['PurchaseID']);
   }
   if (data['ActiveClient']==1) document.getElementById('ActiveClient').checked = true;
   if (data['ClientContract']==1) document.getElementById('ClientContract').checked = true;
   if (data['VetContract']==1) document.getElementById('VetContract').checked = true;

   state.updating = 0;
}

function setSelect(elem, val) {
   elem = (typeof(elem) == 'string') ? document.getElementById(elem) : elem;
   
   if (elem) {
      for (var o=0; o<elem.options.length; o++) {
         if ((val == elem.options[o].text) || (val == elem.options[o].value)) {
            elem.selectedIndex = o;
            break;
         }
      }
   }
}

function finishUpdate(txt, pid) {
   var frm = document.forms['PurchaseForm'].elements;
   var newname;
   var phones = 1;

   for (var s in sections) { if (!state.ids[sections[s]+'ID']) state.ids[sections[s]+'ID'] = 'new1'; } 
   for (var key=0; key<frm.length; key++) {
      try {
         if (frm[key].name && frm[key].name != 'ccbtn' && frm[key].type!='hidden' && frm[key].value=='') {
            newname = frm[key].name.replace(/Purchase\[(\d*|search\d?|new.?)?\]/g, txt);
            if (frm[key].name.match(/Contact/)) {
               newname = newname.replace(/\[Contact\]\[(\d*|search\d?|new.?)?\]/g, "[Contact]["+state.ids['ContactID']+"]");
               
               if (frm[key].name.match(/Address/) && state.ids['Purchase_Contact_0_Address_0'] && state.ids['Purchase_Contact_0_Address_0']['AddressID']) {
                  newname = newname.replace(/(\[Contact\]\[\d*\]\[Address\])\[(\d*|search\d?|new.?)\]/g, "$1["+state.ids['Purchase_Contact_0_Address_0']['AddressID']+"]");
               }
            }
            if (frm[key].name.match(/Vet/)) {
               newname = newname.replace(/\[Vet\]\[(\d*|search\d?|new.?)?\]/g, "[Vet]["+state.ids['VetID']+"]");
               if (frm[key].name.match(/Address/) && state.ids['Purchase_Vet_0_Address_0'] && state.ids['Purchase_Vet_0_Address_0']['AddressID']) {
                  newname = newname.replace(/(\[Vet\]\[\d*\]\[Address\])\[(\d*|search\d?|new.?)\]/g, "$1["+state.ids['Purchase_Vet_0_Address_0']['AddressID']+"]");
               }
            }
            if (frm[key].name.match(/Animal/)) newname = newname.replace(/\[Animal\]\[(\d*|search\d?|new.?)?\]/g, "[Animal]["+state.ids['AnimalID']+"]");
            if (frm[key].name.match(/CC/)) newname = newname.replace(/\[CC\]\[(\d*|search\d?|new.?)?\]/g, "[CC]["+state.ids['CCID']+"]");
            newname = newname.replace(/\[\]/g, "[new1]");

            if (frm[key].name.match(/Phone/i)) {
               newname = newname.replace(/(\[Contact\]\[[^\]]*\])\[Phone\]\[[^\]]*\]/, '$1[Phone][new'+phones+']');
               newname = newname.replace(/(\[Vet\]\[[^\]]*\])\[Phone\]\[[^\]]*\]/, '$1[Phone][new'+phones+']');
               phones++
            }

            frm[key].setAttribute('name', newname);
            frm[key].name = newname;

            if (frm[key].type.match(/select/i)) {
               // frm[key].selectedIndex = 0;
            } else if (frm[key].type.match(/textarea/)) {
               frm[key].setAttribute('class', 'orderCommentsView');
               frm[key].setAttribute('className', 'orderCommentsView');
            } else if (frm[key].type == 'text') {
               frm[key].setAttribute('class', 'orderView');
               frm[key].setAttribute('className', 'orderView');
            } else if (frm[key].type.match(/radio|checkbox/)) {
               frm[key].removeAttribute('checked');
            }
            frm[key].setAttribute('disabled', 'true');
         }
      } catch(e) {
         errorHandler(e, "finishUpdate('" + txt+': key: '+key+' gpar:' + gpar+': par: '+par+ "', '"+pid+"')");
      }
   }
}

function updateSamples(data) {
   var tbl = document.getElementById('sampleTable');
   if (tbl) {
      var samkeys = new Array('SampleID', 'Status', 'CellCount', 'Source', 'Type');
      var row = 0;
      for (var i in data) {
         row++;
         for (var s=0; s<samkeys.length; s++) {
            if (tbl.rows[row] && data[i]) tbl.rows[row].cells[s].innerHTML = data[i][samkeys[s]];
         }
      }
   }
}

function clearOverviews() {
   var sections = new Array('Purchase', 'Contact', 'Vet', 'Animal', 'CC');
   for (var s in sections) {
      updateOverview(sections[s], '');
   }
}

function editAllSections() {
   editSection('Purchase');
}

function editSection(who) {
   var frm = document.forms[who+'Form'].elements;
   
   for (var key=0; key<frm.length; key++) {
      try {
         if (!frm[key].id.match(/(PurchaseID|ContactID|VetID|AnimalID|CCID)$/)) {
            if (frm[key].type.match(/textarea/)) {
               frm[key].setAttribute('class', 'orderComments');
               frm[key].removeAttribute('disabled');
            } else if (!frm[key].type.match(/radio|checkbox/)) {
               frm[key].setAttribute('class', 'orderInput');
               frm[key].removeAttribute('disabled');
            } else {
               frm[key].removeAttribute('disabled');
            }
         }
      } catch(e) {
         errorHandler(e, "editSection('" + who + "')");
      }
   }
}

function clearAllSections() {
   clearSection('Purchase');

   var navtxt = document.getElementById('resultCount');
   if (navtxt) navtxt.innerHTML = '&nbsp;';

   var jumpID = document.getElementById('jumpID');
   if (jumpID) jumpID.value = '';

   clearOverviews();
   clearSamples();
}

function clearForm(pid, disable) {
   pid = (pid) ? pid : 'new1';

   var frm = document.forms['PurchaseForm'].elements;
   var rtxt = 'Purchase['+pid+']';
   var newname;
   var phones = '';
   for (var key=0; key<frm.length; key++) {
      try {
         if (frm[key].name && frm[key].name != 'ccbtn' && !frm[key].name.match(/^(PurchaseID|ID)$/)) {
            newname = frm[key].name.replace(/\[(\d*|search\d?|new.?)?\]/g, '['+pid+']');
            newname = newname.replace(/Purchase\[(\d*|search\d?|new.?)?\]/g, rtxt);
            
            if (frm[key].id.match(/Phone/i)) {
               newname = newname.replace(/\[Phone\]\[(\d*|search\d?|new.?)?\]/, '[Phone]['+pid+phones+']');
               if (!phones) {
                  phones = 1;
               } else {
                  phones++
               }
            }
 
            if (!frm[key].type.match(/checkbox/)) {
               frm[key].value = '';
            } else if (frm[key].type.match(/checkbox/)) {
               frm[key].checked = false;
            }

            if (!disable) {
               frm[key].removeAttribute('disabled');
            } else {
               frm[key].setAttribute('disabled', true);
            }

            frm[key].name = newname;

            if (frm[key].type.match(/select/i)) {
               frm[key].selectedIndex = 0;
            } else if (frm[key].type == 'textarea') {
               frm[key].setAttribute('class', 'orderCommentsView');
               frm[key].setAttribute('className', 'orderCommentsView');
            } else if (frm[key].type == 'text') {
               frm[key].setAttribute('class', 'orderView');
               frm[key].setAttribute('className', 'orderView');
            } else if (frm[key].type == 'checkbox') {
               frm[key].checked = false;
               frm[key].removeAttribute('checked');
            }
         }
      } catch(e) {
         errorHandler(e, "clearForm('" + who + "')");
      }
   }
   clearOverviews();
}


function clearSection(who, txt) {
   var frm = document.forms[who+'Form'].elements;
   var txt = (txt) ? txt : 'search';
   clearForm('search', false);
}

function clearSamples() {
   var tbl = document.getElementById('sampleTable');
   if (tbl) {
      for (var r=0; r<tbl.rows.length; r++) {
         for (var c=0; c<5; c++) {
            if (tbl.rows[r] && tbl.rows[r].cells) tbl.rows[r].cells[c].innerHTML = '&nbsp;';
         }
      }
   }
}

function updateOverview(who, txt) {
   var oview = document.getElementById(who+'Overview');
   if (!oview) oview = document.getElementById('Purchase_'+who+'_0Overview');
   if (oview) oview.innerHTML = txt;
}

function setButton(who, state) {
   var elm = document.getElementById(who);
   if (elm) {
      //var cc = elm.getAttribute('class');
      elm.setAttribute('class', state);
   }
}

function changeMode(newmode, noupdate) {
   var curdiv = document.getElementById('mode' + state.currentMode);
   if (curdiv) curdiv.setAttribute('class', 'modeButton');
   
   var newdiv = document.getElementById('mode' + newmode);
   if (newdiv) newdiv.setAttribute('class', 'modeSelected');

   switch (newmode) {
       case "Browse":
         document.getElementById('SaveButton').setAttribute('disabled', true);
         document.getElementById('EditButton').removeAttribute('disabled');
         setButton('modeEdit', 'modeButton enabled');
         /*
         if (!noupdate && (state.data)) {
            updateData('Purchase', state.data);
            updateNav(state.currentRecord, state.resultset.length);
         }
         */
         //setTimeout("document.forms['PurchaseForm'].submit()", 250);
         break;
      case "Search":
         document.getElementById('SaveButton').setAttribute('disabled', true);
         document.getElementById('EditButton').removeAttribute('disabled');
         setButton('modeEdit', 'modeButton disabled');
         document.PurchaseForm.x.value = 'search';
         clearAllSections();
         break;
      case "Edit":
         document.getElementById('EditButton').setAttribute('disabled', true);
         document.getElementById('SaveButton').removeAttribute('disabled');
         document.PurchaseForm.x.value = 'update';
         editAllSections();
         break;
   }
   
   state.currentMode = newmode;
}

function doSearch() {
   try {
      var pid = document.getElementById('PurchaseID');
      if (pid && pid.value!='') {
         document.forms['PurchaseForm'].x.value = 'get';
         document.forms['PurchaseForm'].ID.value = pid.value;
         document.forms['PurchaseForm'].SearchResource.value = 'Purchase';
      } else { 
         document.forms['PurchaseForm'].x.value = 'search';
         document.forms['PurchaseForm'].ID.value = '';
      }
      setTimeout("document.forms['PurchaseForm'].submit()", 50);
   } catch(e) {
      errorHandler(e, 'doSearch');
   }
   return false;
}

function doChange(who) {
   change[who] = 1;
}

function doSave() {
   var who = 'Purchase';
//   if (change && change[who]) {
      document.forms[who+'Form'].x.value = 'update';
      setTimeout("document.PurchaseForm.submit();", 250);
//   }
   // doPush('saveBtn');
   // setTimeout("doRelease('saveBtn');", 500);
   setTimeout("document.getElementById('SaveButton').setAttribute('disabled', true);", 250);
   
   changeMode('Browse', 1);
   return false;
}

function doNew(who, txt) {
   who = (!who) ? 'Purchase' : who;
   var frm = document.forms[who+'Form'].elements;
   var txt = (txt) ? txt : 'new1';
   var focus = 0;
   var newname;
   var date = new Date();
//   var mo = date
   var dispDate = date.getFullYear()+'-'+(date.getMonth() + 1) + '-' + date.getDate();
   var savebtn = document.getElementById('SaveButton');
   if (savebtn) savebtn.removeAttribute('disabled');
   
   var editbtn = document.getElementById('EditButton');
   if (editbtn) editbtn.setAttribute('disabled', true);
   var phones = 1;
   for (var key=0; key<frm.length; key++) {
      try {
         frm[key].removeAttribute('disabled');
         if (!frm[key].type.match(/checkbox|button/)) {
            if (frm[key].name.match(/Phone/)) {
               newname = frm[key].name.replace(/\[Phone\]\[(\d*|search\d?|new.*)\]/g, '[Phone][new' + phones + ']');
               newname = newname.replace(/\[(\d*|search\d?)\]/g, '[new1]');
               phones++;
            } else {
               newname = frm[key].name.replace(/\[(\d*|search\d?)\]/g, '[new1]');
            }
            frm[key].value = '';
            frm[key].name = newname;
            if (newname.match(/FirstName/) && !focus) {
               focus = 1;
               frm[key].focus();
            }
            if (frm[key].type.match(/textarea/)) {
               frm[key].setAttribute('class', 'orderComments');
            } else {
               frm[key].setAttribute('class', 'orderInput');
            }
            if (frm[key].id == 'Purchase_Created'){
               frm[key].setAttribute('value',dispDate);
               var dateSpan = document.getElementById('dispDate')
               if (dateSpan) dateSpan.innerHTML = dispDate;
            }
         } else if (frm[key].type.match(/checkbox/)) {
            newname = frm[key].name.replace(/\[(\d*|search\d?)\]/g, '[new1]');
            frm[key].checked = false;
            frm[key].name = newname;
         }
         clearOverviews();
      } catch(e) {
         errorHandler(e, "doNew('" + who + "','" + txt + "')");
      }
   }

   // Set defaults for 'Status' and 'Service'
   document.getElementById('Purchase_StatusID').selectedIndex = 1;
   document.getElementById('Purchase_ServiceID').selectedIndex = 1;

   setValue('Purchase_Status', 'Received At GSC');
   setValue('Purchase_Service', 'Order On Hold');
}


function doPush(who) {
   var btn = document.getElementById(who);
   if (btn) {
      btn.style.top = (getObjectTop(who) + 2) + 'px';
      btn.style.backgroundColor = '#ffff00';
   }
}

function doRelease(who) {
   var btn = document.getElementById(who);
   if (btn) btn.style.top = '0px';
      btn.style.backgroundColor = 'transparent';
}

function getCookie(Name) {
   var search = Name + "="
   if (document.cookie.length > 0) { // if there are any cookies
      offset = document.cookie.indexOf(search) 
      if (offset != -1) { // if cookie exists 
    offset += search.length 
    // set index of beginning of value
    end = document.cookie.indexOf(";", offset) 
    // set index of end of cookie value
    if (end == -1) 
    end = document.cookie.length
    return unescape(document.cookie.substring(offset, end))
      } 
   }
}

function createCookie(name,value,days) {
   if (days) {
      var date = new Date();
      date.setTime(date.getTime()+(days*24*60*60*1000));
      var expires = "; expires="+date.toGMTString();
   } else var expires = "";
   document.cookie = name + "=" + value + expires + "; path=/";
}

function eraseCookie(name) {
   createCookie(name,"",-1);
}

function doKeypress(evt) {
   evt = evt ? evt : ((event) ? event : null);
   if (evt) {
      var doit = '';
      var key = (!evt.keyCode) ? evt.charCode : evt.keyCode;
      shifted = evt.shiftKey;
      
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
         //    alert('doit: '+doit);
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

function errorHandler(e, caller) { 
   var errstr = '';

   for (var err in e) {
      errstr += err + ': ' + e[err] + "\n";
   }

   alert('Error from: '+ caller + "\n"+errstr);
}

function doEnter(evt) {
   evt = (evt) ? evt : window.event;
   
   if (document.PurchaseForm.x.value == 'search') {
      doSearch();
   } else if (document.PurchaseForm.x.value == 'update') {
      doSave();
   }
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

function doClick(evt) {
   evt = (evt) ? evt : window.event;
   var target = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);

   if ((state.currentMode == 'Browse') && (target.type && target.type.match(/text/i))) {
      var mb = document.getElementById('modeBrowse');
      return blockEvent(evt);
   } else {
      return true;
   }
}

document.onkeypress = doKeypress;

function blockEvent(evt) {
   evt = (evt) ? evt : event;
   evt.cancelBubble = true;
   if (!document.all) evt.stopPropagation();
   return false;
}

function doAuth() {
   doSave();
   // var xport = window.open('http://clonesoft.newdledev.com/cybersource/ccwrap.php?id='+state.data['PurchaseID'], 'xport');
   var spin = document.getElementById('spinner');
   spin.style.display = 'block';
   setTimeout("doCC(" + state.data['PurchaseID'] + ")", 3000);
   setTimeout("stopSpinner()", 15000);
}

function doCC(id) {
   var xport = document.getElementById('transport');
   if (xport) xport.src = '/cybersource/ccwrap.php?id='+state.data['PurchaseID'];
}

function stopSpinner() {
   var spin = document.getElementById('spinner');
   spin.style.display = 'none';
}

function updateAuth(result, authcode) {
   stopSpinner();
   
   var resdiv = document.getElementById('Purchase_AuthResponse');
   if (resdiv) resdiv.value = result;
   
   var codediv = document.getElementById('Purchase_AuthCode');
   if (codediv) codediv.value = authcode;
   
   var ccimg = document.getElementById('ccimg');

   if (result && result.match(/accept/i)) {
      if (ccimg) ccimg.src = '/img/cc_accepted.png';
   } else {
      if (ccimg) ccimg.src = '/img/cc_rejected.png';
   }
}

function updateService(who) {
   var svc;
   for (var s in services) {
      if (services[s].ServiceID == who) {
         svc = services[s];
         break;
      }
   }
   if (svc) {
      setValue('Purchase_Amount', svc.Price);
      setValue('Purchase_Shipping', svc.Shipping);
      setValue('Purchase_Total', svc.Total);
      setValue('Purchase_Service', svc.Service);
   }
}

function updateStatus(what) {
   what = what.replace(/\d+\s\-\s/, '');
   setValue('Purchase_Status', what);
}

function setValue(elem, value) {
   elem = (typeof(elem) == 'string') ? document.getElementById(elem) : elem;
   if (elem) elem.value = value;
}

function updateTime(tm) {
   var tel = document.getElementById('pagetime');
   if (tel) tel.innerHTML = tm + ' seconds';
}

function moreResults(start, qty) {
   if (!state.fetching) {
      state.fetching = 1;
      qty = (qty) ? qty : 50;
      var url = '/sales/cmd.php?x=search&y=more&start=' + start + '&count=' + qty;
      var xport = document.getElementById('transport');
      xport.src = url;
   }
}

function checkResults() {
   // if (state.recordCount) {
      var tbl = document.getElementById('gridBody');
      if (tbl && tbl.rows) var ourcount = tbl.rows.length;

      if (state.recordCount > ourcount) {
         moreResults(ourcount);
      }
   // }
}

function updateName(lastName, firstName, category) {
   var hidden = document.getElementById('Purchase_'+category+'_0_'+category);
   if (hidden) {
      hidden.value = lastName + ', ' + firstName;
   }
}

function doRemove() {
   var ok = prompt('Are you sure you want to permanently delete this purchase?');

   if (ok) {
      // - Put in code to collapse currently selected record row in result table
      // - Clear form fields
      // - Make call to server remove ONLY the purchase record, or better yet, simply 
      //   flag the status for that record to an absurd value (such as -99999)
   }
}

function updateTotal() {
   var total = document.getElementById('Purchase_Total');
   var price = document.getElementById('Purchase_Amount');
   var ship  = document.getElementById('Purchase_Shipping');

   if (total && price && ship) {
      total.value = parseFloat(price.value) + parseFloat(ship.value);
   }
}
