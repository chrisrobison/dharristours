(function(global) {
   global.conversant = global.conversant || {};
   
   global.conversant.amp = {
      container: document.createElement("div"),
      buildRequest: function(data) {
         var req = {
           "site": {
             "id": data.siteid,
           },
           "imp": [
             {
               "banner": {
                 "h": data.height,
                 "w": data.width
               },
               "displaymanager": "amp",
               "displaymanagerver": "1.0.0",
               "id": 1,
               "secure": 1
             }
           ]
         };

         return req;
      },

      postRequest: function(req, callback) {
         var http = new XMLHttpRequest();
         // var url = "https://api.greystripe.com/s2s/api?debug=1&override=1&ip=173.51.57.85";
         var url = "https://amp.simpsf.com/amp/amp.php";
         //var url = "https://media.msg.dotomi.com/s2s/header";
         http.open("POST", url, true);

         //Send the proper header information along with the request
         http.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
         
      	var that = this;
         http.onreadystatechange = function() {//Call a function when the state changes.
            if (http.readyState == 4 && http.status == 200) {
               (callback) ?  callback(http) : handleResponse(http);
            } else {
               that.handleError(http);
            }
         }
         http.send(JSON.stringify(req));
         
         return http;
      },
     
      /**
       *  Kick off script handler, passing array of script elements to be handled
       **/
      execScripts: function(wrapper) {
         var domscripts = wrapper.getElementsByTagName("script");
         var scripts = [];

         for (var i=0; i<domscripts.length; i++) {
            var el = document.createElement("script");
            if (domscripts[i].src) {
               el.src = domscripts[i].src;
            } else {
               el.text = domscripts[i].text;
            }
            scripts.push(el);
         }
            
         this.handleScripts(scripts);
      },

      /**
       * Shifts script element off passed array and either appends a script tag 
       * to document head if 'src' available, otherwise, eval's code
       *
       **/
       
      handleScripts: function(scripts) {
         if (scripts.length > 0) {
            var script = scripts.shift();
            if (script.src) {
               var newtag = document.createElement("script");
               newtag.src = script.src;
               newtag.onload = this.handleScripts(scripts);
               document.head.appendChild(newtag);
            } else {
               eval(script.text);
               this.handleScripts(scripts);
            }
         }
      },

      handleResponse: function(res) {
         this.container.innerHTML = res.responseText;
         this.execScripts(this.container);
      },

      handleError: function(res) {
         // TODO: Add error handling code here
      },
      
      loadScript: function(url, attr, callback) {
         var el = document.createElement("script");
         el.src = url;

         for (var key in attr) {
            el[key] = attr[key];
         }

         if (callback) {
            el.onload = callback;
         }

         document.head.appendChild(el);
      },
      
      init: function(data) {
         this.loadScript("https://cdn.ampproject.org/v0/amp-ad-0.1.js", {"async": true, "custom-element": "amp-ad"});
         this.loadScript("https://secure.cdn.fastclick.net/clients/jac/jac.js", {});
         
         var req = this.buildRequest(data);
         var that = this;
         var conn = this.postRequest(req, function(conn) {
            window.context.renderStart();    // Notify amp environment that we are starting ad rendering
            if (conn.responseText.match(/^window/)) {
               eval(conn.responseText);
            } else {
               that.response = JSON.parse(conn.responseText);
               that.content = that.response.seatbid[0].bid[0].adm;
               
               eval(that.content);
            }
         });
      }
   };
   global.pbjs = global.pbjs ? global.pbjs : {};
   global.pbjs.conversantResponse = function(data) {
      global.conversant.amp.response = data;
      global.conversant.amp.content = data.seatbid[0].bid[0].adm;
      
      var container = document.createElement("div");
      container.innerHTML = global.conversant.amp.content;

      document.body.appendChild(container);
      
      global.conversant.amp.execScripts(container);  // Not needed (or more accurately, forbidden) if ad is amp document
   };

})(window);

