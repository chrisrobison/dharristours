   $(document).ready(function($) {
      // Attach handlers to action buttons
      var actions = {
         "New":      function() {return doNew();},
         "Copy":     function() {return doCopy();},
         "Save":     function() {return postData();},
         "Delete":   function() {return doRemove();},
         "Print":    function() {return doPrint();},
         "Columns":  function() {return doColumns();}
      };
      var btn;
      for (var a in actions) {
         btn = $("#"+a+"Button");
         btn.click(actions[a]); 
//         btn.mousedown(function() { $(this).css({'top':'3px','background-color':'#ffffaa','position':'relative'}); });
//         btn.mouseup(function() { $(this).css({'top':'0px','background-color':'#b0b0b0'}); });
      }

      var grid = $("#mygrid");

      grid.jqGrid('setGridParam', {   
         onSelectRow: function(id) {
            var ret = $("#mygrid").jqGrid('getRowData',id);
            var rid = ret[simpleConfig.resource+'ID'];
            simpleConfig.id = rid;
            $(".boxHeading").text(simpleConfig.resource + ' ID: ' + rid);
            $("#simpleID").val(rid);
            $("#simpleID").attr('name', simpleConfig.resource+'['+rid+']['+simpleConfig.resource+'ID]');
            $("#cmd").val("save");
            var $tmpel,newname;
            for (var key in ret) {
               if (ret.hasOwnProperty(key)) {
                  $tmpel = $("#"+key);
                  if ($tmpel.length) {
                     $tmpel.val(ret[key]);
                     newname = $tmpel.attr('name').replace(/\[.*?\]/, "["+rid+"]");
                     $tmpel.attr("name", newname);
                     $tmpel.change(function() {
                        $('#mygrid').setCell(simpleConfig.id, $(this).attr('id'), $(this).val(), 'modified');
                        $(this).addClass("modified");
                        if (!simpleConfig.modified) {
                           simpleConfig.modified = true;
                           simpleBounce('#SaveButton');
                           $("#SaveButton").addClass('modified');
                        }
                     });
                  }
               }
            }
            $("a.simpleButton", $("#toolbar")).show("slow");
         }
      
      });
      $(".HeaderButton").click(function() {doLayout('toggle'); });
      window.onresize = function() { doLayout('open'); };
      $("window").resize(function() { doLayout('open'); });
      
      doLayout();
   });
   
   function doLayout(state) {
      var mainH = $("#main")[0].offsetHeight;
      var toolH = $("#toolbar")[0].offsetHeight;
      var gridH, sw;
      if (state=='toggle') {
         sw = $("#mygrid").data("viewstate");
         state = (sw ^ 1) ? "closed" : "open";
         $("#mygrid").data("viewstate", (sw^1))
      }
      if (state == 'closed') {
         gridH = $(".ui-jqgrid-titlebar")[0].offsetHeight;
      } else {
         gridH = Math.round(mainH / 2.5) - toolH;
         $("#mygrid").setGridHeight(gridH - 60);
      }
      var formH = mainH - (gridH + toolH);
      $("#formContainer").height(formH);
   }

   function postData() {
      $("#cmd").val("save");
      var allInputs = $(':input', "#simpleForm"), newname;
      var sid = $("#simpleID").val();
      allInputs.each(function(idx) {
         newname = $(this).attr('name').replace(/\[\]/, "["+sid+"]");
         $(this).attr('name', newname);
      });
 
      $.ajax({
         type: "POST",
         url: "ctl.php",
         data: $("#simpleForm").serialize(),
         success: function(msg) {
            top.updateStatus(msg);
            simpleConfig.modified = false;
            $(".modified").removeClass("modified");
         }
      });
      return false;
   }

   function updateStatus(msg) {
      $("#status").text = msg;
      return false;
   }
   function doColumns() {
      $("#mygrid").setColumns();
      return false;
   }
   function doNew() {
      $("a.simpleButton", $("#toolbar")).show();
      var allInputs = $(':input:not(input[type=hidden])', "#simpleForm"), newname;
      
      allInputs.each(function(idx) {
         $(this).val("");
         newname = $(this).attr('name').replace(/\[.*?\]/, "[new1]");
         $(this).attr('name', newname);
      });
      $("#simpleID").val('new1');
      $("#simpleID").attr('name', simpleConfig.resource+'[new1]['+simpleConfig.resource+'ID]');
      $(".boxHeading").text(simpleConfig.resource + ' ID: [New Entry]');
      $("#cmd").val("new");
      allInputs[0].focus();
      return false;
   }
   function simpleBounce(who) {
      if (simpleConfig.modified) {
         $(who).effect("bounce", { times:3 }, 250);
         if (simpleConfig.modified == true) {
            setTimeout(function() { simpleBounce(who); }, 3000);
         }
      }
   }
   function doRemove() {
      $("#cmd").val("delete");
      var sid = $("#simpleID").val();
       $.ajax({
         type: "POST",
         url: "ctl.php",
         data: {'rsc':simpleConfig.resource,'id':simpleConfig.id, 'x':'delete' },
         success: function(msg) {
            top.updateStatus(msg);
            alert(msg);
            simpleConfig.modified = false;
            $(".modified").removeClass("modified");
            // Remove row
            // clear form
         }
      });
  
   }
