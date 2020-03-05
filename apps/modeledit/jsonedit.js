var obj;
// <span class='delete' style='display:none'>x</span>
function newitem(key, val, myobj, defaultVal) {
   if (!defaultVal) {
      if (simpleConfig.action == "addArray") {
         defaultVal = val = '[ "item 1", "item2" ]';
      } else if (simpleConfig.action == "addObject") {
         defaultVal = val = '{ "key1": "item1", "key2": "item2" }';
      }
   }
   val = val ? val : defaultVal;

   var frmInput = $("<input type='text' class='val' />").attr( { value: val, defaultValue: defaultVal })
      .data("val", {"obj":myobj, "key":key } )
      .blur( changed )
      .change( changed );

   var out = $("<tr>")
      .data("val", {"obj":myobj, "key":key } )
      .append($("<td>")).append(makeLabel(myobj, key)).append($("<td>").append(frmInput));
   return out;
}

function changed(e) {
   var me = $(this).closest("tr").data("val"), val = $(this).val();
   if (val.match(/^[\{\[]/)) {
      val = me["obj"][me["key"]] = JSON.parse(val);
      $(this).closest("tr").replaceWith(makeCollapsible(me["obj"], me["key"]));
   } else {
      me["obj"][me["key"]] = val;
   }
}

function genform(obj) {
   if (obj) {
      var mtype, rtype, i, 
          out = $("<table />"), 
          delbtn = $("<span/>").addClass('delete').text("x").css("display","none");

      for ( i in obj ) {
         mtype = typeof obj[i];
         rtype = getType(obj[i]);

         if ( ( mtype=="string" && ( obj[i] == "true" || obj[i] == "false" ) ) || ( mtype=="boolean" ) ) {
            
            out.append($("<tr>").append($("<td>"))
               .data("val", {"obj":obj, "key":i } )
               .append(makeLabel(obj, i))
               .append($("<td>")
                  .append($("<input type='checkbox' />").prop( { "value": obj[i], "checked": (obj[i] && obj[i] != "false" && obj[i] != 0 && obj[i] != false) ? "true" : false })
                     .data("val", {"obj":obj, "key":i } )
                     .change( 
                        function(e) {
                           var me = $(this).closest("tr").data("val");
                           me["obj"][me["key"]] = this.checked ? true : false;
                        }
                     )
                  )
               )
            );

         } else if ((rtype=="string") || ( ( mtype !== "object" ) && ( mtype !== "array" ) )) {
            
            var frmInput = $("<input type='text' class='val' />").attr( { value: obj[i], defaultValue: obj[i] })
               .data("val", {"obj":obj, "key":i } )
               .mousedown( 
                  function(e) {
                     if (e.which == 3) {
                        e.preventDefault();
                        // e.stopPropagation();
                        // e.stopImmediatePropagation();
                        return false;
                     }
                  }
               )
               .blur( changed )
               .change( changed );

               out.append( 
                  $("<tr>")
                  .data("val", {"obj":obj, "key":i } )
                  .append( $("<td>") )
                  .append( makeLabel(obj, i) )
                  .append( $("<td>").append( frmInput ) )
               );

         } else {
            out.append(makeCollapsible(obj, i));
         }
      }
      return out;
   }
}

function makeCollapsible(obj, key) {
   var out = $("<tr>").data("val", {"obj":obj, "key":key } )
   .append($("<td>").addClass("toggle collapsible closed"))
      .append( makeLabel(obj, key ) )
         .append( $("<td>").append($("<div/>").addClass('summary').append( $(summarize(obj[key]) ) ) )
            .append($("<div/>").addClass('details').css("display","none").append( genform( obj[key] ) ) ) 
         );
   return out;

}

function makeLabel(obj, i, cls, markup) {
   cls = cls ? cls : 'key';
   var typ = getType(obj), $toggle, out;

   $toggle = (cls.match(/collapsible|open|closed/)) ? $("<span/>").addClass('toggle').addClass(cls) : "";

   if (typ != "array") {
      out = $("<th class='label'>")
               .addClass(cls)
               .data("val", {"obj":obj, "key":i})
               .change(updateLabel)
               .blur(function(e) {
                  console.log("ContentEditable blur");
                  $(this).removeClass("editing");
                  $(this)[0].contentEditable = false;
               })
               .dblclick( editLabel )
               .html(i).prepend( $toggle );
   } else {
      out = $("<th class='unlabel'>").addClass(cls).data("val", {"obj":obj, "key":i}).html(i).prepend($toggle);
   }

   return out;
}

function updateLabel(e) {
   // Create new key set to old key's value then delete the old key
   // TODO: Figure out way to retain position (renamed keys are appended to the containing object)
   var $this = $(this), 
         val = $this.text(),
          me = $this.closest("tr").data("val");

   if (!me || (val != me['key'])) {
      me['obj'][val] = me['obj'][me["key"]];
      delete me['obj'][me['key']];
      me['key'] = val;
      $this.data("val", {"obj":me['obj'], "key":val});
      $this.closest("tr").data("val", {"obj":me['obj'], "key":val});
   }
   $this.removeClass("editing");
   $this.get(0).contentEditable = false;
}

function editLabel(e) {
   var $this = $(this), me = $this.closest("tr").data("val");
   simpleConfig.editing = $this;
   simpleConfig.edit = { value: $this.html(), key: me["key"], data: me, type: "html" };

   $this.addClass("editing");
   $this.get(0).contentEditable = true;
   $this.focus();
   
   // e.stopImmediatePropagation();
   // e.stopPropagation();
   
   return false; 
}

function markup(obj, i, showkey) {
   if (obj[i] == null) obj[i] = "";
   var type = getType(obj[i]), out='';
   if (showkey && (type != "object")) {
      out += "<label>" + i + "</label>:";
   }

   if (type === "number" || type === "boolean") {
      out += "<span class='boolean'>" + obj[i] + '</span>, ';
   } else if ((type === "object") || (type === "array")) {
      out += '<span class="children">' + summarize(obj[i]) + '</span>, ';
   } else {
      out += '<span class="value">"' + obj[i].replace(/(.{15,20})\b.*/, "$1" + '<span class="more" title="' + obj[i] + '">...</span>') + '"</span>, ';
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
   } else if ((val != null) && (val != undefined) && !$.isArray(val) && typeof val === "object") {
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

function editValue(e) {
   if (simpleConfig.active) {
      simpleConfig.editing = $("td input.val", simpleConfig.active);
      simpleConfig.edit = { value: simpleConfig.editing.val(), type: "input", data: simpleConfig.active.closest("tr").data("val") };
      
      $("td input.val", simpleConfig.active).focus();
      selectElementContents(simpleConfig.editing[0]);
   }
}

function editKey(e) {
   if (simpleConfig.active) {
      simpleConfig.editing = $("th", simpleConfig.active);
      simpleConfig.edit = { value: simpleConfig.editing.val(), type: "html", data: simpleConfig.active.closest("tr").data("val")};

      editLabel.call($("th", simpleConfig.active), e);
      selectElementContents(simpleConfig.editing[0]);
   }
}

function getKey(key, par) {
   var num, cnt = 1;
   if (num = key.match(/(\d+)$/)) { 
      cnt = num[1];
   } else {
      key += '1'; 
   }
   while (par[key]!=undefined) { 
      cnt++; 
      key = key.replace(/\d+$/, cnt);
      if (cnt > 500) break;
   }
   return key;
}

function copyItem(e) {
   if (simpleConfig.active) {
      var data = simpleConfig.active.data('val'), 
      key = getKey(data['key'], data['obj']);
      
      console.log("Copying item: " + data['key'] + " [tmp key: " + key +"]");
      
      var buffer = { "ui":simpleConfig.active.clone(), "key": data['key'], "item":data['obj'][data['key']]};
      simpleConfig.buffer.unshift(buffer);
   }
}

function cutItem(e) {
   copyItem();
   deleteItem();
}

function pasteItem() {
   if (simpleConfig.active) {
      var me = simpleConfig.active.data('val'),
          buffer = simpleConfig.buffer.shift();
      
      console.log("Pasting item: " + buffer['key']);
      
      if (buffer) {
         me['obj'][getKey(buffer['key'], me['obj'])] = buffer['item'];
         simpleConfig.active.after(buffer['ui']);
      }
   } 
}

function deleteItem(e) {
   if (simpleConfig.active) {
      var me = simpleConfig.active.data('val');
      console.log("Deleting key: " + me['key']);
      var undo = { "parent": simpleConfig.active.parent(), "ui":simpleConfig.active.remove(), "obj": me['obj'], "key": me['key'], "item":me['obj'][me['key']]};
      simpleConfig.undo.unshift(undo);
      delete(me['obj'][me['key']]);
   }
}

function addObject(e) {
   simpleConfig.action = "addObject";
   addEntry.call(this, e);
}

function addArray(e) { 
   simpleConfig.action = "addArray";
   addEntry.call(this, e);
}

function addEntry(e) {
   var newkey = 'newItem1',
       newval = '', th,
       data = simpleConfig.active.data('val'), cnt = 1, html;
   
   // Handle addition to arrays differently so we don't disturb array ordering
   if ($.isArray(data['obj'])) {
      newkey = data['obj'].length;
      data['obj'][newkey] = newval;
      html = newitem(newkey, newval, data['obj']);
      simpleConfig.active.parent().append(html);
      $("input", html).focus().select();
   } else {
   // Add new key after item clicked in the case of an object
      while (data['obj'][newkey]!=undefined) { cnt++; newkey = newkey.replace(/\d+$/, cnt); }
      data['obj'][newkey] = newval;
      html = newitem(newkey, newval, data['obj']);
      
      simpleConfig.active.after(html);

      th = $("th", html);
      th[0].contentEditable = true;
      selectElementContents(th[0]);
      th.focus();
      simpleConfig.editing = th;
      simpleConfig.edit = { value: th.html() };
   }
   if (e.stopPropagation) e.stopPropagation();
   if (e.preventDefault) e.preventDefault();
   return false;
}

function moveUp(e) {
   var nex = simpleConfig.active.prev("tr");
   if (nex.length) {
      if ($("td.collapsible", nex).length) {
         prev = ($("td.collapsible.open", nex).length) ? $("table tr:last", nex) : nex;
         simpleConfig.active = (prev.length) ? prev : simpleConfig.active.parents("tr").first();
      } else {
         simpleConfig.active = nex;
      }
   } else {
      simpleConfig.active = simpleConfig.active.parents("tr").first();
   }

   $(".active").removeClass("active");
   simpleConfig.active.addClass('active');
   simpleConfig.active.scrollintoview({duration:100});
}

function moveDown(e) {
   var nex = simpleConfig.active.next("tr");
   if ($("td.collapsible.open", simpleConfig.active).length) {
      nex = $("tr", simpleConfig.active).first();  
   }
   if (nex.length) {
      simpleConfig.active = nex;
      $(".active").removeClass("active");
      simpleConfig.active.addClass('active');
   } else {
      simpleConfig.active = simpleConfig.active.parents("tr").first().next("tr");
      $(".active").removeClass("active");
      simpleConfig.active.addClass('active');
   }
   simpleConfig.active.scrollintoview({duration:100});
}

function moveLeft(e) {
   if (!$("td.collapsible.open", simpleConfig.active).length) {
      simpleConfig.active = simpleConfig.active.parents("tr").first();
      $(".active").removeClass("active");
      simpleConfig.active.addClass('active');
      simpleConfig.active.scrollintoview( { duration: 100 } );
   } else {
      closeNode(simpleConfig.active);
   }
}

function moveRight(e) {
   openNode(simpleConfig.active);
}

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

function getOptions(rsc) {
   if (typeof(rsc) == "string") {
      var tmprsc = rsc;
      rsc = [tmprsc];
   }
   
   for (var i=0; i < rsc.length; i++ ) {
      var who = rsc[i];
      $.getJSON("ctl.php", {x:"get", "rsc":who }, function(obj) {
         $.extend(window.data, obj);
      });
   }
}

function selectElementContents(el) {
    var range = document.createRange();
    range.selectNodeContents(el);
    var sel = window.getSelection();
    sel.removeAllRanges();
    sel.addRange(range);
}

function saveModel() {
   var c = simpleConfig, el = c.editing;
   if (c && el) {
      var newcontent = (c.edit.type == "input") ? el.val() : el.html();
      if (!newcontent || newcontent.match(/^newItem/)) {
         var me = el.closest("tr").data("val");
         if (me && me[newcontent]) { delete me[newcontent]; }
         el.closest("tr").remove();
      } 
      el.blur();
      $(".focus").removeClass("focus");
      delete(simpleConfig.editing);
   }
   doSave();
   console.log("Saved Model");       
}

function doSave() {
   var json = JSON.stringify(obj),
       out = { x: "save", mid: $("#mid").val(), model: json };
   $('#jsondata').val(json); 
   $.post("ctl.php", out, function(data) {
      console.log(data);
   });
}

function openNode(node) {
   var col = $("td.collapsible", node).first();
   if (col.length) {
      col.addClass("open").removeClass("closed");
      $(".summary", node).first().hide();
      $(".details", node).first().show(100);
      $(".active").removeClass("active");
      simpleConfig.active = $("tr", node).first();
      simpleConfig.active.addClass('active');
   }
}

function closeNode(node) {
   var col = $("td.collapsible", node).first(), par;
   if (col.length) {
      col.addClass("closed").removeClass("open");
      $(".summary", node).first().show();
      $(".details", node).first().hide(100);
    } else {
      par = $(node).parents("tr").first();

      if (par.length) {
         $("td.collapsible", par).first().addClass("closed").removeClass("open");
         $(".summary", par).show();
         $(".details", par).hide(100);
         $(".active").removeClass("active");
         simpleConfig.active = par;
         simpleConfig.active.addClass('active');
      }
   }
}

$(function() {
   var option = {
      width: 150,
      items: [
         {
            text: "Edit Value",
            icon: "img/wi0062-16.gif",
            alias: "editValue",
            action: editValue 
         }, {
            text: "Edit Key",
            icon: "img/modify-key-icon.png",
            alias: "editKey",
            action: editKey 
         },
         //this is normal menu item, menuAction will be called if this item is clicked on 
         {
            text: "Delete Item",
            icon: "img/delete-icon.png",
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
            icon: "img/add-icon.png",
            alias: "1-4",
            type: "group",
            width: 170,
            items: [{
               text: "Child Array",
               icon: "img/new-array.png",
               alias: "addArray",
               action: function(e) {
                  simpleConfig.action = "addArray";
                  addArray.call(this, e);
               }
            }, {
               text: "Child Object",
               icon: "img/new-object.png",
               alias: "addObject",
               action: function(e) {
                  simpleConfig.action = "addObject";
                  addObject.call(this, e);
               }
            }, {
               text: "Entry",
               icon: "img/wi0111-16.gif",
               alias: "addEntry",
               action: function(e) {
                  simpleConfig.action = "addEntry";
                  addEntry.call(this, e);
               }
            }]
         }, {
            type: "splitLine"
         }, {
            text: "Refresh",
            icon: "img/wi0124-16.gif",
            alias: "1-5",
            action: menuAction
         }
      ]
   };

   // $("#jsondata").val(JSON.stringify(option));
   function menuAction() {
      alert(this.data.alias);
   }
   $("#main").contextmenu(option); 
   window.data = {};
   getOptions(["ColModelOption", "GridOption"]);
});

