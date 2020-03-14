/*!
 * simple.js - Simple Software Javascript Toolkit v0.44
 *
 * Author:     Christopher D. Robison <cdr@cdr2.com> 
 * Created:    Aug 6, 2010
 *
 * Modified:   2012-05-13 04:20:08 -0800 [Sun, 13 May 2012]
 * Revision:   v0.44
 *
 */
(function() {

   // Setup object globals and optimizations
   var 
      // Optimize references on 'window' and 'undefined' for maximum speed;
      window = this,
      undefined,
      
      // Save a copy of any existing simple object in case of overwrite
      _simple = window.simple,
      
      // Same for our '$$' shortcut
      _$$ = window.$$,

      simple = window.simple = window.$$ = function( config ) {
         return new simple.fn.init( config );
      };

simple.fn = simple.prototype = {
   init: function(config) {
      if (config && typeof config === "object") {
         for (var i in config) {
            this[i] = config[i];
         }
      }
   },

   
   include: function( path, reload ) {
      var scripts = document.getElementsByTagName("script");
      if (!reload) {
         for (var i=0; i<scripts.length; i++) {
            if (scripts[i].src && scripts[i].src.toLowerCase() == path.toLowerCase() ) return;
         }
      }
      var sobj = document.createElement('script');
      sobj.src = path;
      //compatible for both IE & FireFox
      if (!document.all) {
         sobj.readyState='undefined';
         sobj.onload=function(){
            this.readyState='loaded';
         };
      }
      document.getElementsByTagName('head')[0].appendChild(sobj);
   },
   controller: function(action) {
      if (simple.actions[action]) simple.actions[action]();
   }, 
   actions: {
      
      truncate: function() {
         if ( apprise("WARNING: This action will permanently remove data!!\n" +
                      "Are you absolutely sure you want to truncate the table '" + 
                       myui.table + "'?\n", {'verify':true, 'animate':true} ) ) {
            simple.post('truncate', { tableName: myui.table });
         }
      },
      drop: function() {
         if ( apprise("WARNING: This action will permanently remove data!!\n" +
                      "Are you absolutely sure you want to drop the table '" + 
                       myui.table + "'?\n", {'verify':true, 'animate':true} ) ) {
            simple.post('drop', { tableName: myui.table });
         }
      },
      rename: function() {
         var newname = apprise("<div class='alert'><h2>Rename Table: <span>" + myui.table + "</span></h2><hr><span>What would you like to rename the table <b>'" + myui.table + "'</b> to?</span></div>", {'input':true, 'animate':true});
         if (newname && myui.table) {
            $.get("cmd.php", { x: 'rename', tableName: myui.table, newName: newname }, function(data) {
               $("body").append(data);
               console.log(data);
            });
         }

      },
      copy: function() {
         var newname = apprise("<div class='alert'><h2>Copy Table: <span>"+myui.table+"</span></h2><hr><span>To make a copy of table <b>'" + myui.table + "'</b> we need to give it a name.<br>What would you like to call your new table?</span></div>", {'input':true, 'animate':true});
         if (newname && myui.table) {
            $.get("cmd.php", { x: 'copy', tableName: myui.table, newName: newname }, function(data) {
               $("body").append(data);
               console.log(data);
            });
         }
      },
      export: function() {

      },
      import: function() {

      }
   },
   post: function(cmd, data) {
      $.post("cmd.php?x=" + cmd, data, function(data) { $("body").append(data); console.log(data); });
   }


})();
