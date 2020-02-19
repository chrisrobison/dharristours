var obj;
// <span class='delete' style='display:none'>x</span>
function genform(obj) {
   if (obj) {
      var mtype, rtype, out = $("<table />"), i, delbtn = $("<span/>").addClass('delete').text("x").css("display","none");

      for ( i in obj ) {
         mtype = typeof obj[i];
         rtype = getType(obj[i]);

         if ( ( rtype=="string" && ( obj[i] == "true" || obj[i] == "false" ) ) || ( mtype=="boolean" ) ) {
            
            out.append($("<tr>").append($("<td>"))
               .append(makeLabel(obj, i))
               .append($("<td>")
                  .append($("<input type='checkbox' />").attr( { "value": obj[i], "checked": (obj[i] && obj[i] != "false" && obj[i] != 0 && obj[i] != false) ? "checked" : false })
                        .data("val", {"obj":obj, "key":i } )
                        .change( 
                           function() {
                              var me = $(this).closest("tr").data("val");
                              me["obj"][me["key"]] = ($(this).attr('checked')) ? $(this).val() : false;
                           }
                        )
                     )// .append(delbtn)
                  )
               );

         } else if ( ( mtype !== "object" ) && ( mtype !== "array" ) ) {
            
//               .data("val", {"obj":obj, "key":i } )
            var frmInput = $("<input type='text' class='val' />").attr( { value: obj[i] })
               .change( function() {
                     var me = $(this).closest("tr").data("val");
                     me["obj"][me["key"]] = $(this).val();
               });

               out.append( $("<tr>")
               .data("val", {"obj":obj, "key":i } )
               .append($("<td>"))
                     .append(makeLabel(obj, i))
                     .append($("<td>").append( frmInput ) // .append(delbtn))
                  )
               );

         } else {
            out.append( $("<tr>")
            .data("val", {"obj":obj, "key":i } )
            .append($("<td>").addClass("toggle collapsible closed"))
               .append( makeLabel(obj, i) )
               .append( $("<td>").addClass('summary').append( $(summarize(obj[i]) ) ) )
            );

            out.append($("<tr>").attr("class", "hidden").append($("<td/>")).append($("<td/>").attr({ "colspan": 2, "class": "nest" }).append( genform( obj[i] ) ) ) );
         }
      }
      return out;
   }
}

function makeLabel(obj, i, cls, markup) {
   cls = cls ? cls : 'key';
   var typ = getType(obj), $toggle, out;

   $toggle = (cls.match(/collapsible|open|closed/)) ? $("<span/>").addClass('toggle').addClass(cls) : "";

   if (typ != "array") {
      out = $("<th contentEditable='true' class='label'>").addClass(cls).data("val", {"obj":obj, "key":i}).change(function(e) {
            var val = $(this).text(),
            me = $(this).closest("tr").data("val");
            if (val != me['key']) {
               me['obj'][val] = me['obj'][me["key"]];
               delete me['obj'][me['key']];
               me['key'] = val;
               $(this).data("val", {"obj":me['obj'], "key":val});
            }
            $(this).removeClass("editing");
         }).html(i).prepend($toggle);
   } else {
      out = $("<th class='unlabel'>").addClass(cls).data("val", {"obj":obj, "key":i}).html(i).prepend($toggle);
   }

   return out;
}

function markup(obj, i, showkey) {
   var type = getType(obj[i]), out='';
   if (showkey && (type != "object")) {
      out += "<label>" + i + "</label>=";
   }

   if (type === "number" || type === "boolean") {
      out += "<span class='boolean'>" + obj[i] + '</span>, ';
   
   } else if ((type === "object") || (type === "array")) {
      out += '<span class="children">' + summarize(obj[i]) + '</span>, ';
   
   } else {
      out += '<span class="value">"' + obj[i].replace(/(.{15,20})\b.*/, "$1" + '<span class="more" title="' + obj[i] + '">...</span>') + '"</span>, ';
      // out += '<span class="okey">' + i + '</span>=<span class="value">"' + obj[i].replace(/(.{15,20})\b.*/, "$1" + '<span class="more" title="' + obj[i] + '">...</span>') + '"</span>, ';
      // out += '<span class="value">"' + obj[i] + '"</span>, ';
   
   }
   
   return out;
}

function summarize(obj) {
   var xtra = cnt = 0, out='', type, disp, max = 3;
   
   if ($.isArray(obj)) {
      disp = (obj.length > max) ? max : obj.length;
      out = '<span class="array">[ ';
      for (var i=0; i < disp; i++) {
         out += markup(obj, i);
      }
      if (obj.length > max) {
         out += "<span class='more'>" + (obj.length - max) + " more...</span>";
      }
      out = out.replace(/,\s*$/, '');
      out += " ]</span>";
   } else {
      out = "<span class='object'>{ ";
      for (var i in obj) {
         if (obj.hasOwnProperty(i)) {
            if (cnt < max) {
               out += markup(obj, i, true);
            } else {
               xtra++;
            }
            cnt++;
         }
      }
      if (parseInt(xtra) > 0) out += "<span class='more'>" + xtra + " more...</span>";
      out = out.replace(/,\s*$/, '');
      out += " }</span>";
   }

   return out;
}

function getType(val) {
   type = typeof val;
   if (isNumber(val)) {
      type = "number";
   } else if (isBoolean(val)) {
      type = "boolean";
   } else if (!$.isArray(val) && typeof val === "object") {
      type = "object";
   } else if ($.isArray(val)) {
      type = "array";
   } else {
      type = "string";
   }
   return type; 
}

function isNumber(n) { return !isNaN(parseFloat(n)) && isFinite(n); }
function isBoolean(n) { return typeof n === 'boolean'; }

function editValue() {

}

function editKey() {

}

function deleteItem() {

}

function addObject() { }
function addArray() { }
function addEntry() { }

function renderJSON(obj) {
   $("#main").empty().append( genform( obj ) );
}

function viewJSON(data) {
   if (typeof data === "string") {
      obj = JSON.parse( data );
   } else {
      obj = data;
   }

   renderJSON(obj);
   return obj;
}

$(function() {
   var option = {
      width: 150,
      items: [
         {
            text: "Edit Value",
            icon: "icons/wi0062-16.gif",
            alias: "editValue",
            action: editValue 
         }, {
            text: "Edit Key",
            icon: "icons/modify-key-icon.png",
            alias: "editKey",
            action: editKey 
         },
         //this is normal menu item, menuAction will be called if this item is clicked on 
         {
            text: "Delete Item",
            icon: "icons/delete-icon.png",
            alias: "deleteItem",
            action: deleteItem
         },
         //this is a split line
         {
            type: "splitLine"
         },
         //this is a parent item, which has some sub-menu items
         {
            text: "New",
            icon: "icons/add-icon.png",
            alias: "1-4",
            type: "group",
            width: 170,
            items: [{
               text: "Child Array",
               icon: "icons/new-array.png",
               alias: "addArray",
               action: addArray
            }, {
               text: "Child Object",
               icon: "icons/new-object.png",
               alias: "addObject",
               action: addObject
            }, {
               text: "Entry",
               icon: "icons/wi0111-16.gif",
               alias: "addEntry",
               action: addEntry
            }]
         }, {
            type: "splitLine"
         }, {
            text: "Item Four",
            icon: "icons/wi0124-16.gif",
            alias: "1-5",
            action: menuAction
         }, {
            text: "Group Three",
            icon: "icons/wi0062-16.gif",
            alias: "1-6",
            type: "group",
            width: 180,
            items: [
               {
                  text: "Item One",
                  icon: "icons/wi0096-16.gif",
                  alias: "4-1",
                  action: menuAction
               }, {
                  text: "Item Two",
                  icon: "icons/wi0122-16.gif",
                  alias: "4-2",
                  action: menuAction
               }
            ]
         }
      ]
   };

   // $("#jsondata").val(JSON.stringify(option));
   function menuAction() {
      alert(this.data.alias);
   }
   $("#main").contextmenu(option); 
});

