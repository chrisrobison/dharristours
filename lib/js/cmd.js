var mytabs = {};

function loadUrl(who, title, tgt, force, mid, isModule, id) {
   if (!who || who == "#") return true;
   let pid;
   if (id) pid = id.replace(/^pid_/, '');
console.log(`el id is ${id}.  pid is ${pid}`);
   var tab_container = dijit.byId("tabs");
   tab_container.setTitle = function(tab, title) {    
      tab.attr('title', title);
      this.tablist.pane2button[tab].attr('label', title); 
   };
   
   if (mid && isModule) {
      simple.module = findModule(mid);
   }

   var q = (who.match(/plain/)) ? '' : 'f=1&';
   q = 'f=1&';
   var dest = (who.match(/^(http:|https:|\/)/)) ? "/apps/framed.php?url=" + encodeURIComponent(who) : "/apps/cmd.php?" + q + "t=" + encodeURIComponent(who),
       myid = (who.match(/module/)) ? "module-" + mid : "tab-" + title.replace(/\W/, '');
   
   if (!mytabs[myid]) {
      mytabs[myid] = {url:who, "title":title, "target": tgt, "force": force, "mid": mid, "isModule": isModule};
      var myclass = ""; // (isModule) ? "smallIcon small-" + simple.module.ClassName + " module-mid" : "";
      // var dest = who;
      var pane = new dijit.layout.ContentPane({
         // id: myid,
         href: dest,
         title: title,
         closable: true,
         iconClass: myclass,
         onClose: function(pane, tab) {
            console.log("Closed " + tab.title);
            if (sessionStorage) {
               var href = decodeURIComponent(tab.href.replace(/^.+?url=/, ''));
               delete(simpleConfig.tabs[href]);
               delete(mytabs[myid]);
               sessionStorage.removeItem("tabs");
               sessionStorage.setItem("tabs", JSON.stringify(simpleConfig.tabs));
               console.log("Removed " + href + " from local storage.");
            }
            return true;
         }
      });
   } 
   const opts = {};

   if (tgt) {
      if (typeof tgt !== 'object') tgt = window[tgt];
      if (!tgt) {
         tgt = window.open(dest, title.replace(/\W*/, ''), opts);
      } 
      //tgt.document.location.href = dest;
      return false;
   }
   
   if (!dojo.some(tab_container.getChildren(), function(fpane) {
      if ((mid && (fpane.id == "module-" + mid)) || (fpane.href == dest)) {
         tab_container.selectChild(fpane);
         
         if (fpane.id == "module-" + mid) {
            delete(mytabs['module-' + mid]);
            fpane.title = title;
            //tab_container.tablist.pane2button[myid].attr('label', title); 
            fpane.href = dest;
            // fpane.id = myid;
            fpane.refresh();
            return true;
         }

         if (force) {
            fpane.refresh();
            // tab_container.removeChild(fpane);
            // return false;
         }
      }
      return fpane.href == dest; 
      }))  { 
      var pane = new dijit.layout.ContentPane({
         // id: myid,
         href: dest,
         title: title,
         closable: true,
         iconClass: myclass,
         onClose: function(pane, tab) {
            console.log("Closed " + tab.title);
            if (sessionStorage) {
               var href = decodeURIComponent(tab.href.replace(/^.+?url=/, ''));
               delete(simpleConfig.tabs[href]);
               delete(mytabs[myid]);
               sessionStorage.removeItem("tabs");
               sessionStorage.setItem("tabs", JSON.stringify(simpleConfig.tabs));
               console.log("Removed " + href + " from local storage.");
            }
            return true;
         }
      });
      tab_container.addChild(pane);
      tab_container.selectChild(pane);
   }
   if (simpleConfig) {
      if (!simpleConfig.tabs) simpleConfig.tabs = {};
      simpleConfig.tabs[who] = { "url": who, "title": title, "target":tgt, "force":force, "mid":mid, "isModule":isModule };
      
      if (sessionStorage) sessionStorage.setItem("tabs", JSON.stringify(simpleConfig.tabs));
   }
   return false;
}

if (!simple) {
   var simple = {};
}

function loadModule(url, mid, mod) {
   if (simple && simple.loaded) {
      url = url ? url : "/apps/module.php?mid=" + mid;

      return loadUrl(url, mod, '', '', mid, true);
   } else {
      simple = { loaded: true };
   }
}

function findModule(mid) {
   if (modules) {
      for (var i=0; i < modules.length; i++) {
         if (modules[i].ModuleID == mid) {
            return modules[i];
         }
      }
   }
}

function updateStatus(msg) {
   if (msg && msg.match(/<script/)) {
      $("body").append(msg);
   } else {
      $("#simpleStatus").html("Status: <b style=\"color:#009900\">"+msg+"</b>");
   }
   
}
function chpass() {
   
}
