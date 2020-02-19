{  
   "mojoID": "543276",
   "Title": "New 2011 Lexus LC Series",
   "Defaults": {
      "click": "http://www.11oclocktoast.com/",
      "hover": "function(event) { $(this).animate({'top':'0px','opacity':'1'}, 500); }",
      "blur": "function(event) { $(this).animate({'top':'250px','opacity':'0'}, 500); }"
   },
   "Containers": {
      "main": "mojo_container",
      "tabs": "tabs",
      "panels": "panel_container"
   },
   "Background": { 
      "src": "img/ad_bg2.jpg",
      "tag": "img",
      "id": "ad",
      "border": "0",
      "height": "210",
      "width": "300"
   },
   "Overlay": {
      "id": "overlay",
      "tag": "div",
      "style": "left:-300px"
   },
   "Component":{
      "Email":{
         "Component":"Email",
         "Title":"Email to a Friend",
         "Type":"text",
         "Class":"callout",
         "Src":"",
         "Content":"<div class='padding'><h2>HTML Form</h2><form action='email.php' method='post'><label for='email'>Email:</label><input type='text' id='email' /><input type='submit' value='Subscribe' /></form></div>"
      },
      "MySpace":{
         "Component":"MySpace",
         "Title":"Share on MySpace",
         "Type":"text",
         "Class":"callout_right",
         "Banner":"img/banner_myspace.jpg",
         "Src":"",
         "Content":"<p>Share the new Lexus IS C with your Friends on MySpace. Click the link below to post the IS C to your profile or send a message. Don't worry, you'll be able to preview it before sending.</p><div id='share_myspace' class='tab'><a href=\"javascript:void(window.open('http://www.myspace.com/Modules/PostTo/Pages/?u=http://www.volvocars.com/us/all-cars/volvo-s60/Pages/default.aspx?s60tourhub','ptm','height=450,width=440').focus())\">Share on MySpace</a></div>"
      },
      "Locations":{
         "Component":"Locations",
         "Title":"Dealer Locations",
         "Type":"text",
         "Class":"callout gmap",
         "Src":"http://mediaplex.dev.sscsf.com/clients/mediaplex/templates/gmaps.html",
         "Tag":"iframe",
         "Content":""
      },
      "Facebook":{
         "Component":"Facebook",
         "Title":"Share on Facebook",
         "Type":"text",
         "Class":"callout_right",
         "Banner":"img/banner_fb.jpg",
         "Src":"",
         "Content":"<p>Share the new Lexus IS C with your Friends on facebook. Click the link below to post the IS C to your profile or send a message. Don't worry, you'll be able to preview it before sending.</p><div id='share_fb' class='tab'><a target='_blank' href='http://www.facebook.com/share.php?u=http://www.volvocars.com/us/all-cars/volvo-s60/Pages/default.aspx?s60tourhub'>Share on Facebook</a></div>"
      } 
   }
}
