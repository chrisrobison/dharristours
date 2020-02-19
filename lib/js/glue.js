var openPanes = 0;
function loadApp(id, x, y) {
   var viewport = dojo.html.getViewport();
   
   x = (x) ? x : parseInt(viewport.width * .8) + 'px';
   y = (y) ? y : parseInt(viewport.height * .8) + 'px';
   
   var params = {
      widgetId: 'float_'+id,
      title: id + ' Manager',
      href: '/app.php?t='+id,
      iconSrc: '/img/' + id + '_24.png',
      displayCloseAction: true,
      displayMinimizeAction: true,
      displayMaximizeAction: true,
      constrainToContainer: true,
      executeScripts: true,
      toggleDuration: 700,
      taskBarId: 'mytaskbar',
      resizable: true,
      windowState: 'normal',
      hasShadow: true,
      style: {
         height: y,
         width: x,
         top: ((openPanes * 50) + 50) + 'px',
         left: ((openPanes * 50) + 50) +'px'
      }
   };

   makePane(params);
               
}

/**
 * makePane(params) - Create floating pane widget.
 *
 * @param params object containing widget settings; if sub-object 'style' exists,
 *        each of it's attributes is applied to the style of the created widget.
 **/
function makePane(params) {
   openPanes++;
   var div=document.createElement("div");
   div.style.position="absolute";
   div.innerHTML="Initial <i>dummy</i> <b>div</b> contents";

   /**
    * Grab reference to a container to append pane to.  If no 'container' attribute
    * exists in passed object, defaults to document.body
    **/
   var pdiv = (params.container) ? dojo.byId(params.container) : document.body;
   pdiv.appendChild(div);  
   
   if (params.style) { 
      for (var s in params.style) {
         div.style[s] = params.style[s];
      }
   }

   // Create the widget
   var widget = dojo.widget.createWidget("FloatingPane", params, div);
   
}

function setAttributes(obj, arr) {
   if (arr.length && obj) {
      for (var s in arr) {
         obj[s] = arr[s];
      }
   }
}

function saveContent(txt, ContentID, NavID) {

   var req = { };
   req['Nav[' + NavID + '][Content][' + ContentID + '][ContentID]'] = ContentID;
   req['Nav[' + NavID + '][Content][' + ContentID + '][Content]'] = txt;
   req['NavID'] = NavID;
   req['ContentID'] = ContentID;
   req['x'] = 'save';

        dojo.io.bind({
         url: "/app.php",
         load: saveResults,
         mimetype: "text/plain",
         content: req
      });
 
}

function saveResults(type, data, evt) {
   alert(data);  
}

function saveForm(who,pane) {
    var bindArgs = {
        url: "app.php",
        mimetype: "text/javascript",
        formNode: document.getElementById(who),
        method: "post",
        handle: cmdCallback
    };
   
    // dispatch the request
    req=dojo.io.bind(bindArgs);
    
    var widpane = dojo.widget.byId(pane+'Overview');
    if (widpane) widpane.refresh();

    if (pane) hidePane(pane);
    return false;
}
var result;
function cmdCallback(type, data, evt) {
   if (type == 'error') {
      // alert("Error received on last server transaction:\n"+data);
   } else {
      if (!result) result = data;
      // if (data) alert(data);
      // result['rsc'] = (!result['rsc']) ? 'Home' : result['rsc'];
   }
}

function buildTable(fields, data, handler) {
   var out = '<tr>';
   var f, d, className;
   for (f in fields) {
      headClass = (fields[f].headClass) ? " class='"+fields[f].headClass+"'" : '';
      out += "<th field='" + fields[f].field + "' " + headClass + " dataType='" + fields[f].dataType + "'>" + fields[f].label + "</th>";
   }
   out += '</tr>';

   for (d in data) {
      for (f in fields) {
         className = (data[d].className) ? " class='"+data[d].className+"'" : '';
         out += "<td" + className + ">" + data[d][fields[f].field] + "</td>";
      }
      out += '</tr>';
   }
   return out;
}

function loadLayout(lid, xtra) {
   /* 
   var rp = dojo.widget.getWidgetById('MainPane');
   if (rp) {
      rp.setUrl('/app.php?t=LayoutManager&rsc=Layout&LayoutID=' + lid);
   }
   */
   var docPane = dojo.widget.getWidgetById("ContentEditor");
   if (docPane) {
      docPane.setUrl('/app.php?t=Layout&rsc=Layout&LayoutID=' + lid);
   }
   
   var metaPane = dojo.widget.getWidgetById("WebsiteMeta");
   if (metaPane) {
      metaPane.setUrl('/app.php?t=LayoutPreview&LayoutID=' + lid);
   }

}

// TODO: Add dojo.io.bind call to update sequence of 'rsc' record. 
//       Figure a simple way to switch the Sequence fields of this 
//       record and that of the record immediately preceding/following
//       it (depending on the direction being moved)
function updateSequence(rsc, id, seq, dir) {
   
}

// TODO: Add dojo.io.bind call to cmd.php for removing record 'id' from 'rsc'
function remove(rsc, id) {

}

// TODO: Add dojo.io.bind call to cmd.php for removing clamp records
//       between src[srcID] and tgt[tgtID]
function removeLink(src, srcID, tgt, tgtID, rev) {
   
}


function saveContact() {
   dojo.byId('Contact').value = dojo.byId('LastName').value + ', ' + dojo.byId('FirstName').value;
   sendForm('form1');
}

function dump(obj) {
   var txt = '';
   for (var o in obj) {
      txt += o + ': ' + obj[o] + "\n";
   }
   return txt;
}

function sendForm(who) {
    var bindArgs = {
        url: "app.php",
        formNode: document.getElementById(who),
        method: "post", 
        load: function(type, data, evt) { 
            myobj = data;
            updateTable(myobj); 
        }, 
        mimetype: "text/json"
    };
   
    // dispatch the request
    req=dojo.io.bind(bindArgs);
}

function newContact() {
   var docPane = dojo.widget.getWidgetById("ContactDetail");
   if (docPane) {
      docPane.setUrl('/app.php?t=ContactDetail&rsc=Contact');
   }
}

function updateTable(data) {
   var t = filteringTable;
   t.store.addData(data);
}

currentResource = null;

function load(who) {
   var lid = filteringTable[who].getSelectedData();
   currentResource = who;

   var docPane = dojo.widget.getWidgetById("DetailPane");
   if (docPane) {
      docPane.setUrl('/app.php?t=' + who + 'Detail&rsc=' + who + '&' + who + 'ID=' + lid[who+'ID']);
   }
}

