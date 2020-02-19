function doRSS(feed) {
   // use jQuery 'get' to fetch our content then consume it <nom nom nom>
   var out, html;
   out = document.createElement('div');
   out.setAttribute('class', 'feed');

   $.get(feed, function(d) {
      out.innerHTML += "<h1>"+$(d).find('title').first().text() +"</h1>";
      $(d).find('item').each(function() {
         html = "<div class='rssItem'><h2 class='postTitle'>" + $(this).find('title').text() + "</h2>";
         html += "<em class='date'>" + $(this).find('pubDate').text() + "</em>";
         html += "<p class='description'>" + $(this).find('description').text() ;
         html += "</p><a href='" + $(this).find('link').text() + "' class='readMore' target='_blank'>Read More...</a></div>";
 
         out.innerHTML += html;  
      });
   });
   return out;
}

function jsonRSS(feed, tgt) {
   var out = document.createElement('div');
   out.setAttribute('class', 'feed');
   out.setAttribute('id', 'rssFeed');
   
   // use jQuery 'get' to fetch our content then consume it <nom nom nom>
   $.get("/tools/xml2json.php?url="+feed, function(d) {
      var myfeed = (d['channel']) ? d['channel'] : d;
      var el, item, html;
      html = "<h1>"+myfeed['title']+"</h1>";
      tgt = (typeof tgt === 'string') ? $(tgt) : tgt;
      tgt.append(html);
      html = "<ul>";
      for (var i in myfeed['item']) {
         item = myfeed['item'][i];
         html += "<li class='toggle closed'><h2 class='postTitle'>";
         html += "" + item['title'] + "</h2><div class='rssItem' id='rssItem_"+i+"' style='display:none'>";
         html += "<em class='date'>" + item['pubDate'] + "</em>";
         html += "<p class='description'>" + item['description'] ;
         html += "</p><a href='" + item['link'] + "' class='readMore' target='_blank'>Read More...</a></div></li>";
      }
      html += "</ul>";
      tgt.append(html);
   });
}
function calRSS(feed, tgt) {
   var out = document.createElement('div');
   out.setAttribute('class', 'feed');
   out.setAttribute('id', 'rssFeed');
   
   // use jQuery 'get' to fetch our content then consume it <nom nom nom>
   $.get("/tools/xml2json.php?url="+feed, function(d) {
      var myfeed = (d['channel']) ? d['channel'] : d;
      var el, item, html;
      html = "";
      tgt = (typeof tgt === 'string') ? $(tgt) : tgt;
      tgt.append(html);
      html = "<ul>";
      for (var i in myfeed['entry']) {
         item = myfeed['entry'][i];
         html += "<li class='toggle closed'><h2 class='postTitle'>";
         html += "" + item['title'] + "</h2><div class='rssItem' id='rssItem_"+i+"' style='display:none'>";
         html += "<em class='date'>" + item['published'] + "</em>";
         html += "<p class='description'>" + item['summary'] ;
         html += "</p><a href='" + item['link'][0]['@attributes']['href'] + "' class='readMore' target='_blank'>View booking...</a></div></li>";
      }
      html += "</ul>";
      tgt.append(html);
   });
}


function getRSS(feed, el) {
   el = (typeof el === 'string') ? $(el) : el;
   el.append(doRSS(feed));
}

