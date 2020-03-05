var obj, simpleConfig = {undo:[], buffer:[]};
$(document).ready(function() {
   
   $("#main").on("dblclick", "th.label", function(e) {
      simpleConfig.editing = $(this);
      $(this).addClass("editing");
      $(this).get(0).contentEditable = true;
      $(this).focus();
      e.stopImmediatePropagation();
      e.stopPropagation();
      return false;
   }).on("click", "td input", function(e) {
      e.stopPropagation();
      e.stopImmediatePropagation();
   }).on("click", ".collapsible", function(e) { 
      $(this).toggleClass("closed").toggleClass("open");
      var par = $(this).parent();
      $(".summary", par).first().toggle();
      $(".details", par).first().toggle();
      
      return false;
   })
   .on("dblclick", "tr", addEntry)
   .on("blur", "input", function(e) {
      var val = $(this).val();
      if (!val) {
         var data = $(this).data('val');
         delete(data['obj'][data['key']]);
         $(this).closest("tr").remove();
      }
   });
   $("body").keyup( function(e) {
      switch(e.keyCode) {
         case 27:
            console.log("Escape pressed");
            var c = simpleConfig, el = c.editing,
                tr = el.closest("tr");

            if (c && el) {
               var newcontent = (c.edit.type == "html") ? el.html() : el.val();
               if (!newcontent || newcontent.match(/^newItem/)) {
                  var me = tr.data("val");
                  if (me && me[newcontent]) {
                     delete me[newcontent];
                  }
                  tr.remove();
                  el.blur();
                  delete(simpleConfig.editing);
                  return true;
               } 
               
               if (c.edit) {
                  if (c.edit.type == 'html') {
                     el.html(c.edit.value);
                  } else if (c.edit.type == 'input') {
                     el.val(c.edit.value);
                  }
               }

               el.blur();
               delete(simpleConfig.editing);
            }
            break;

         case 13:
            // console.log("Saving Model");       
            // saveModel();
            // $(".focus").removeClass("focus");
            // $(":focus").blur();
            break;
         default:
      }
      
   }) 
   .keydown(function(e) {
      //   1         2        4        8
      // altKey, shiftKey, metaKey, ctrlKey
      // 37 = left, 38 = up, 39 = right, 40 = down
      e.modifiers = 0;
      if (e.altKey)     e.modifiers += 1;
      if (e.shiftKey)   e.modifiers += 2;
      if (e.metaKey)    e.modifiers += 4;
      if (e.ctrlKey)    e.modifiers += 8;

      if (!simpleConfig.active) {
         simpleConfig.active = $("tr", "#main").first();
         $(".active").removeClass("active");
         simpleConfig.active.addClass('active');
      }

      var stop = false;
      switch(e.keyCode) {
         case 8:     // Delete key
            deleteItem(e);
            stop = true;
            break;
         case 13:
            if (simpleConfig.editing) {
               saveModel();
            } else {
               if ($("td.collapsible", simpleConfig.active).length) {
                  if ($("td.collapsible.open", simpleConfig.active).length) {
                     closeNode(simpleConfig.active);
                  } else {
                     openNode(simpleConfig.active);
                  }
               } else {
                  $("input", simpleConfig.active).focus();
                  stop = true;
               }
            }
            break;
         case 90:    // 'Z' key
            if (e.modifiers & 12) {    // Meta or Ctrl
               var undo = simpleConfig.undo.unshift();
               if (undo) {
                  undo.parent.append(undo.ui);
                  undo.obj[undo.key] = undo.item;
               }
            }
            break;
         case 83:    // S key
            if (e.modifiers & 12) {    // Meta or Ctrl
               doSave();
               stop = true;
            }
            break;
         case 88:    // X key
            if (e.modifiers & 12) {    // Meta or Ctrl
               cutItem();
               stop = true;
            }
            break;
         case 86:    // V key
            if (e.modifiers & 12) {    // Meta or Ctrl
               pasteItem();
               stop = true;
            }
            break;
         case 67:    // C key
            if (e.modifiers & 12) {    // Meta or Ctrl
               copyItem();
               stop = true;
            }
            break;
         case 40:    // down arrow
            moveDown(e);
            stop = true;
            break;
         case 38:    // up arrow
            moveUp(e);
            stop = true;
            break;
         case 39:    // right arrow
            moveRight(e);
            break;
          case 37:   // left arrow
            moveLeft(e);
            break;
      }
      if (stop) {
         e.preventDefault();
         e.stopPropagation();
         return false;
      }
   });

   $("#gridform").submit(function(e) { 
      var jsondata = $("#jsondata").val();
      obj = JSON.parse( jsondata ); 
      $("#jsondata").val(js_beautify(jsondata));
      renderJSON(obj);
      
      return false;
   });
   $("#compact").click(function(e) {
      $("#jsondata").val(JSON.stringify(obj));
   });
   
   $("#expand").click(function(e) {
      $("#jsondata").val(js_beautify(JSON.stringify(obj)));
   });
   
   $("#view").click(function(e) { 
      var jsondata = $("#jsondata").val();
      obj = JSON.parse( jsondata ); 
      $("#jsondata").val(js_beautify(jsondata));
      renderJSON(obj);

      $("table").dblclick(function() {
         $(this).append("<tr><td></td><th class='label key' contenteditable='true'>New Key</th><td><input type='text' class='val' value='New Value'></td></tr>");
      });
      $(".summary").after($("<span/>").addClass('delete').text("x").css("display","none")).after($("<span/>").addClass('add').text("+").css("display","none"));
      
      return false;
   });
   $("#save").click(function(e) {
      doSave();
      return false; 
   });
   $("#main").change(function() {
      $('#jsondata').val(js_beautify(JSON.stringify(obj))); 
      return false; 
   });

   $("#main").on("focus", "input.val", function() { simpleConfig.editing = $(this); simpleConfig.edit = { value: $(this).val(), type: "input" }; $(this).addClass("focus", 100); }).on("blur", "input.val", function() { $(this).removeClass("focus", 100); delete(simpleConfig.editing); simpleConfig.edit = {};  });
   $(".btn").mousedown(function() { $(this).css({"position":"relative","top":"4px"}); }).mouseup(function() { $(this).css({"position":"relative","top":"0px"}); });
   $("#main").keydown(function(e) {
      console.log("Keydown: " + e.which);
   });
   
   $("#main")
      .on("click", "tr", function(e) { 
         simpleConfig.active = $(this); 
         $(".active").removeClass("active");
         $(this).addClass('active');
         e.stopImmediatePropagation();
         e.stopPropagation();
         e.preventDefault();
         return false;
      })
      .on("focusout", "th.label", function(e) {
         $(this).change();
            // $("label", $(this)).html($("input.key", $(this)).val());
            // $("input.key").hide();
         }) 
      .on("click", ".delete", function() {
         var data = $("input", $(this).parent()).data("val");
         delete data['obj'][data['key']];
         $(this).parents("tr").first().remove();
      });

   var jsdata = $("#jsondata").val();
   if (jsdata) {
      obj = JSON.parse( jsdata ); 
      $("#jsondata").val(js_beautify(jsdata));
      renderJSON(obj);
   }

   $("#mid").change(function() {
      var newmid = $(this).val();
      $.getJSON("/model.php?full=1&mid="+newmid, function(data) {
        obj = data['Config'];
        $("#model").html(data['Model'] + '[' + newmid + ']');
        $("#jsondata").val(js_beautify(JSON.stringify(data)));
        renderJSON(obj);
      });
      // location.href = location.href.replace(/\?.*/, '') + '?mid=' + $(this).val();
   });
});

