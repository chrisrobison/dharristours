/**
 * Client-side form generation via programmatic definition
 *
 *    Usage:
 *
 *    // description of parameters for floating pane
 *    var formObject = [
 *       //basic
 *       {name: "widgetId", type: "string", value: ""},
 *       {name: "title", type: "string", value: "Window"},
 *       {name: "href", type: "string", value: "doc0.html"},
 *       {name: "iconSrc", type: "image", values: ["images/note.gif", "images/flatScreen.gif", "images/openFolder.gif"] },
 *       
 *       // hide/show
 *       {name: "displayCloseAction", type: "boolean"},
 *       {name: "displayMinimizeAction", type: "boolean"},
 *       {name: "displayMaximizeAction", type: "boolean"},
 *       {name: "toggle", type: "string", values: ["wipe", "fade", "explode"]},
 *       {name: "toggleDuration", type: "number", value: 500},
 *       {name: "taskBarId", type: "string", value: "mytaskbar"},
 *       {name: "resizable", type: "boolean"},
 *       {name: "windowState", type: "string", values: ["normal", "minimized", "maximized"]},
 *       
 *       // appearance
 *       {name: "hasShadow", type: "boolean"}
 *    ];
 *
 *    var frm1 = new FormUI('formname', formObject);
 *    frm1.render();
 *
 **/

function FormUI(frm, obj) {
   this.form = dojo.byId(frm);
   this.data = obj;

}

// creates a form for setting the parameters in descriptor
FormUI.prototype.generate = function(descriptor) {
   // make table of parameters
   var text = "";
   dojo.lang.forEach(this.data, function(item){
      text += "<tr><td>" + item.name + "</td><td>";
      var values = (item.type == "boolean") ? [true, false] : item.values;
      if (values) {
         dojo.lang.forEach(values, function(val) {
            text += "<input type='radio' name='" + item.name + "' value='" + val + "'> " +
            ((item.type=="image" && val != "none") ? "<img src='"+val+"'>" : val);
         });
      } else if (item.type=='textarea') {
         text += "<textarea cols='"+item.cols+"' rows='"+item.rows+"' name='" + item.name + "' id='" + item.name + "'";
         if (item.className) { text += " class='" + item.className + "'"; }
         text += (item.value || '') + "</textarea>";
      } else {
         text += "<input id='" + item.name + "' name='" + item.name + "' id='" + item.name + "' value='" + (item.value||"") + "'";
         if (item.className) { text += " class='" + item.className + "'"; }
         text += "/>";
      }
      text += "</td></tr>";
   });
   return "<table class='params'>"+text+"</table>";
}

// return all the values in the given form as name/value pairs
// (see also dojo.io.encodeForm)
FormUI.prototype.serialize = function(description) {
   formNode = this.form;
   var params = {};
   for (var i=0; i < formNode.elements.length; i++) {
      var elm = formNode.elements[i];
      if (elm.type=="checkbox") {
         params[elm.name] = elm.checked ? true : false;
      } else if(elm.type=="radio") {
         if (elm.checked) {
            switch (elm.value) {
               case "true":
                  params[elm.name] = true;
                  break;
               case "false":
                  params[elm.name] = false;
                  break;
               default:
                  params[elm.name] = elm.value;
            }
         }
      }else{
         if (elm.value != "") {
            if (/^[0-9]*$/.test(elm.value)) {
               params[elm.name]=parseInt(elm.value);// convert from string --> number
            } else {
               params[elm.name]=elm.value;
            }
         }
      }
   }
   return params;
}

