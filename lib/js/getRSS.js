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
         html += "<br clear='both'/><a href='" + $(this).find('link').text() + "' class='readMore' target='_blank'>Read More...</a></p></div>";
 
         out.innerHTML += html;  
      });
   });
   return out;
}

function jsonRSS(feed, el) {
   el = (typeof el === 'string') ? $(el) : el;
   // use jQuery 'get' to fetch our content then consume it <nom nom nom>
   var out, html;
   out = document.createElement('div');
   out.setAttribute('class', 'feed');

   $.get("/tools/xml2json.php?url="+feed, function(d) {
      out.innerHTML += "<h1>"+d['channel']['title']+"</h1>";
      for (var i in d['channel']['item']) {
         item = d['channel']['item'][i];
         out.innerHTML += "<div class='rssItem'><h2 class='postTitle'>" + item['title'] + "</h2>";
         out.innerHTML += "<em class='date'>" + item['pubDate'] + "</em>";
         out.innerHTML += "<p class='description'>" + item['description'] ;
         out.innerHTML += "<br clear='both'/><a href='" + item['link'] + "' class='readMore' target='_blank'>Read More...</a></p></div>";
      }
   });
   el.append(out);
}


function getRSS(feed, el) {
   el = (typeof el === 'string') ? $(el) : el;
   el.append(doRSS(feed));
}

