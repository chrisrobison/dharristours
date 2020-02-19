var mojoAd, data;
function mojo2(data) {
   if (data) {
      var s = data, tabContainer = document.body, tmp, panel, item, btn, tab, tabidx;

      if (s["Containers"] && s["Containers"]["main"]) mainContainer = document.getElementById(s.Containers.main);
      mainContainer.innerHTML = "";

      if (s["Title"]) window.title = s["Title"];
      if (s['Background']) mainContainer.appendChild(gen_tag(s['Background']));     // Generate tag for background from config
      if (s['Overlay']) mainContainer.appendChild(gen_tag(s['Overlay']));     // Generate tag for overlay from config
       
      // Create tab container
      tmp = document.createElement("div");
      tmp.setAttribute("id", "tabs");
      mainContainer.appendChild(tmp);
      
      // Create panel container
      tmp = document.createElement("div");
      tmp.setAttribute("id", "panel_container");
      mainContainer.appendChild(tmp);
      
      if (s["Containers"] && s["Containers"]["tabs"]) tabContainer = document.getElementById(s.Containers.tabs);
      if (s["Containers"] && s["Containers"]["panels"]) panelContainer = document.getElementById(s.Containers.panels);
      if (s["Components"]) {
         for (tabidx in s["Components"]) {
            item = s["Components"][tabidx];
            tab = s["Components"][tabidx]["Component"];

            panel = document.createElement("div");
            panel.setAttribute("class", "panel_content"+(item["Class"] ? " "+item["Class"]:''));
            panel.setAttribute("id", tab);

            tmp = document.createElement("div");
            tmp.setAttribute("class", "panel_title");
            tmp.innerHTML = "<h3 class='"+tab+"'>"+item["Title"]+"</h3>";
            panel.appendChild(tmp);

            if (item["Banner"]) {
               tmp = document.createElement("img");
               tmp.setAttribute("src", item["Banner"]);
               panel.appendChild(tmp);
            }

            tmp = document.createElement("div");
            tmp.setAttribute("class", "panel_body");
            
            if (item["Tag"]) {
               var tmp2 = document.createElement(item["Tag"]);
               tmp2.setAttribute("class", item["Class"]);
               tmp2.setAttribute("src", item["Src"]);
               tmp.appendChild(tmp2);
               panel.appendChild(tmp);
            } else { 
               tmp.innerHTML = item["Content"];
               panel.appendChild(tmp);
            }

            tmp = document.createElement("b");
            tmp.setAttribute("class", "notch");
            panel.appendChild(tmp);

            panelContainer.appendChild(panel);

            btn = document.createElement("div");
            btn.setAttribute("id", "tab_"+tab);
            btn.setAttribute("class", "tab");
            btn.innerHTML = "<a href='#"+tab+"'>"+item['Title']+"</a>";

            tabContainer.appendChild(btn);
         }
      }
   }
   
   tmp = document.createElement("form");
   tmp.innerHTML = '<form><select id="theme"><option value="#red">--Change Theme--</option><option value="#red">Red Theme</option><option value="#blue">Blue Theme</option><option value="#green">Green Theme</option><option value="#shiny">Shiny Theme</option><option value="#black">Black Theme</option></select></form>';
   tabContainer.appendChild(tmp);

   mojo_init();
}
var lastActive, activeTab;
function mojo_init() {
   $(".panel_content").hide(); //Hide all content
   var color = location.hash.replace(/#/,'');
   color = color?color:'red';
   $("body").attr("class", color);
   setTimeout(function() { $("#overlay").css({"left":"-300px"}).animate({"left":"27px"}, 1000); }, 1000);
   $("mojo_container").show("slow");

   //On Click Event
   $("#tabs .tab a").click(function(event) {
      activeTab = $(this).attr("href"); //Find the rel attribute value to identify the active tab + content
      $(".active").css({"z-index":"0"}).animate({"top":"220px","opacity":"0"}, 500, function() { $(".active").removeClass('active'); });  //Remove any "active" class
      //$(this).addClass("active"); //Add "active" class to selected tab
      $(".button_glow").removeClass("button_glow");
      $(".button_glow_bg").removeClass("button_glow_bg");
      $(this).parent().addClass("button_glow");
      $(this).parent().parent().addClass("button_glow_bg");

      // $(".panel_content").hide(); //Hide all tab content
      if (lastActive != activeTab) {
         $(activeTab).show().css({"top":"220px","z-index":"99999"}).animate({"top":"8px","opacity":"1"}, 500, function() { $(this).addClass('active'); }); //Fade in the active content
         lastActive = activeTab;
      } else {
         lastActive = null;
      }
      return false;
   });
   $("#theme").change(function() {
      $("#overlay").animate({"left":"300px"}, 500);
      var search = document.location.search.replace(/^\?/, '');
      setTimeout(function() { $.getJSON("/clients/mediaplex/genad.php?"+(search?search+'&':'')+"out=json", function(data) { mojoAd = mojo2(data); }); }, 500);
      $("body").data("dest", $(this).val());
      setTimeout(function() { document.location.hash = $("body").data("dest"); }, 800);
   });
}

function gen_tag(obj) {
   var tmp = document.createElement(obj['tag']);
   for (var i in obj) {
      if (i != 'tag') {
         tmp.setAttribute(i, obj[i]);
      }
   }
   return tmp;
}
