var simple = {
   controller: function(action) {
      if (simple.actions[action]) simple.actions[action]();
   }, 
   actions: {
      
      truncate: function() {
         apprise("WARNING: This action will permanently remove data!!\nAre you absolutely sure you want to truncate the table '" + 
                        myui.table + "'?\n", {'verify':true, 'animate':true}, function(data) {
            if (data) { 
               simple.post('truncate', { tableName: myui.table });
            }
         });
      },
      drop: function() {
         apprise("WARNING: This action will permanently remove data!!\nAre you absolutely sure you want to drop the table '" + 
                        myui.table + "'?\n", {'verify':true, 'animate':true}, function(data) {
            if (data) {
               simple.post('drop', { tableName: myui.table });
            }
         });
      },
      rename: function() {

      },
      copy: function() {

      },
      export: function() {

      },
      import: function() {

      },
      post: function(cmd, data) {
         $.post("cmd.php?x=" + cmd, data, function(data) { $("body").append(data); console.log(data); });
      }
   }
};

/**
    toolbarClick  - central click handler for toolbar buttons
 
    New, Copy, Rename, Import, Update via Import, Export, Truncate, Drop
* 
**/
function toolbarClick(e) {
   var me = $(this), who = me.attr('href').replace(/\W/, '');
   console.log("Toolbar button clicked: " + who);
   if (!myui.table) {
      var mytbl = $(".shadow").attr("id");

      if (mytbl) {

         mytbl = mytbl.replace(/^table_/, '');
         myui.table = mytbl;
      } else {
         if (!who.match(/newTable|import/)) {
            apprise("You need to select a table before you can " + who + " it", {'animate':true});
            return false;
         }
      }
   }
   return controller(who);
}

function controller(action) {
   switch (action) {
      case "truncate":
      case "drop":
         apprise("WARNING: This action will permanently remove data!!<br>\nAre you absolutely sure you want to " + action.toUpperCase() + " the table '" + myui.table + "'?\n", {'verify':true, 'animate':true}, function(data) {
            console.log("User responded '" + data + "' for '" + action + "ing' table '" + myui.table +"'");
            if (data) {
               $.get("cmd.php", { "x": action, "tableName": myui.table }, function(data) {
                  $("body").append(data);
                  console.log(data);
               });
            }
         });
         break;
      case "rename":
         var newname = prompt("Rename table '" + myui.table + "' to:");
         if (newname && myui.table) {
            $.get("cmd.php", { x: 'rename', tableName: myui.table, newName: newname }, function(data) {
               $("body").append(data);
               console.log(data);
            });
         }
         break;
      case "newtbl":
         $("#dbDialog").dialog("open"); 
         break;
      case "copy":
         apprise("<div class='alert'><h2>Copy Table: <span>"+myui.table+"</span></h2><hr><span>To make a copy of table <b>'" + 
            myui.table + "'</b> we need to give it a name.<br>What would you like to call your new table?</span></div>", 
            {'input':true, 'animate':true}, 
            function(newname) {
               if (newname && myui.table) {
                  $.get("cmd.php", { x: 'copy', tableName: myui.table, newName: newname }, function(data) {
                     $("body").append(data);
                     console.log(data);
                  });
               }
            }
         );
         break;
      case "import":
         // TODO: Add import calls here   
         break;
      case "export":
         $("#exportFrame").attr("src", "ctl.php?x=export&rsc=" + myui.table);
         break;
      case "exportSQL":
         $("#exportFrame").attr("src", "cmd.php?x=exportSQL&rsc=" + myui.table);
         break;
      default:
   }
      
   return false;
}

$(function() {
   var option = {
      width: 150,
      items: [
         {
            text: "New Table",
            icon: "/img/dbtool/icon_newTable.png",
            alias: "newtbl",
            action: menuAction 
         },
         { type: "splitLine" },
         {
            text: "Import from...",
            icon: "/img/dbtool/icon_importTable.png",
            alias: "import",
            type: "group",
            width: 170,
            items: [
            /* {
               text: "Other table",
               icon: "img/new-array.png",
               alias: "importOther",
               action:menuAction 
            }, */
            {
               text: "SQL",
               icon: "img/new-object.png",
               alias: "importSQL",
               action:menuAction 
            }, {
               text: "Delimited Text",
               icon: "img/wi0111-16.gif",
               alias: "importText",
               action:menuAction 
            }]
         },
         {
            text: "Export to...",
            icon: "/img/dbtool/icon_exportTable.png",
            alias: "exportGroup",
            type: "group",
            width: 170,
            items: [
           /* {
               text: "Other table",
               icon: "img/new-array.png",
               alias: "exportOther",
               action:menuAction 
            }, */
            {
               text: "SQL",
               icon: "img/new-object.png",
               alias: "exportSQL",
               action:menuAction 
            }, {
               text: "Delimited Text",
               icon: "img/wi0111-16.gif",
               alias: "export",
               action:menuAction 
            }]
         },
         { type: "splitLine" },
         {
            text: "Truncate Table",
            icon: "/img/dbtool/icon_truncateTable.png",
            alias: "truncate",
            action: menuAction 
         }, {
            text: "Drop Table",
            icon: "/img/dbtool/icon_dropTable.png",
            alias: "drop",
            action: menuAction
         },
         { type: "splitLine" },
         //this is normal menu item, menuAction will be called if this item is clicked on 
         {
            text: "Rename Table",
            icon: "/img/dbtool/icon_renameTable.png",
            alias: "rename",
            action: menuAction 
         },
         //this is normal menu item, menuAction will be called if this item is clicked on 
         {
            text: "Copy Table",
            icon: "/img/dbtool/icon_copyTable.png",
            alias: "copy",
            action: menuAction 
         },
         {
            text: "Refresh",
            icon: "img/wi0124-16.gif",
            alias: "refresh",
            action: menuAction
         }
      ]
   };

   // $("#jsondata").val(JSON.stringify(option));
   function menuAction() {
      controller(this.data.alias);
   }
   $(".tableDiv").contextmenu(option); 
});
