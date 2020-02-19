var currentTab = 0;

function switchTabs(towho) {
   var iup = document.getElementById(tabs[currentTab].tabname + "ImgUp");
   var idn = document.getElementById(tabs[currentTab].tabname + "ImgDown");
   
   idn.setAttribute("style", "display:inline;z-index:1;");
   iup.setAttribute("style", "display:none;");
   
   document.getElementById(tabs[towho].tabname + "ImgDown").setAttribute("style", "display:none;");
   document.getElementById(tabs[towho].tabname + "ImgUp").setAttribute("style", "display:inline;z-index:20;");

   currentTab = towho;
   document.forms[0].section.value = tabs[towho].tabname;
   document.forms[0].table.value = tabs[towho].table;
   setTimeout("document.forms[0].submit();", 150);
}

function initTabs() {
   var tabhtml = '';
   var iopts = "border='0' hspace='0' vspace='0'";
   var curLeft = 0;
   for (var i=0; i<tabs.length; i++) {
      var tn = tabs[i].tabname;

      // Construct HTML for tab container and populate with 'Up' & 'Down' tabs
      // Styles attributes are handled below
      tabhtml += "<span style='display:absolute;top:0px;left:" + curLeft + "px;' class='tabContainer' id='" + tn + "'>\n";
      
      // Build span tag for 'Up' tab
      tabhtml += "<span class='domains' id='" + tn + "ImgUp' onclick='switchTabs("+i+")'>";
      tabhtml += "<img src='/img/tab-" + tn + "-up.png' "+iopts+" height='" + tabs[i].height+"' width='"+tabs[i].widthUp+"'>";
      tabhtml += "</span>\n";

      // Build span tag for 'Down' tab
      tabhtml += "<span class='domains' id='" + tn + "ImgDown' onclick='switchTabs(" + i + ")'>";
      tabhtml += "<img src='/img/tab-" + tn + "-down.png' "+iopts+" height='" + tabs[i].height+"' width='"+tabs[i].widthDown+"'>";
      tabhtml += "</span>\n";

      tabhtml += "</span>";

      if (tabs[i].tabname == document.forms[0].section.value) {
         curLeft += tabs[i].widthUp;
      } else {
         curLeft += tabs[i].widthDown;
      }
   }
   // Add our constructed HTML to the 'tabbar' div in our page
   document.getElementById('tabbar').innerHTML = tabhtml;

   var zcnt = tabs.length + 1;
   var curpos = 0;

   for (var i=0; i<tabs.length; i++) {
      var sopt = "top:0px;height:"+tabs[i].height+"px;left:"+curpos+"px;z-index:"+zcnt+";";
      var iup = document.getElementById(tabs[i].tabname + "ImgUp");
      var idn = document.getElementById(tabs[i].tabname + "ImgDown");

      if (tabs[i].tabname == document.forms[0].section.value) {
         iup.style.visibility = 'visible';
         iup.style.display = 'inline';
         idn.style.visibility = 'hidden';
         idn.style.display = 'none';

//         iup.setAttribute("style", sopt+"display:inline;width:"+tabs[i].widthUp+"px;");
//         idn.setAttribute("style", sopt+"display:none;width:"+tabs[i].widthDown+"px;");
         curpos = tabs[i].widthUp;
         currentTab = i;
         --zcnt;
      } else {
         idn.style.display = 'inline';
         idn.style.visibility = 'visible';
         iup.style.display = 'none';
         iup.style.visibility = 'hidden';

//         idn.setAttribute("style", sopt+"display:inline;width:"+tabs[i].widthDown+"px;");
//         iup.setAttribute("style", sopt+"display:none;width:"+tabs[i].widthUp+"px;");
         curpos = (curpos + tabs[i].widthDown);
         --zcnt;
      }
   }
}


