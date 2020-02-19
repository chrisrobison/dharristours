<?php
   include($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<link href='//fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<link href="/lib/css/Aristo/jquery-ui-1.8.5.custom.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="/lib/css/icons48.css" />
<link rel="stylesheet" type="text/css" href="/lib/css/icons-small.css" />
<link rel='stylesheet' type='text/css' href='/lib/css/core.css'>
<link rel="stylesheet" type="text/css" href="/clients/sanrio/main.css" />
<style>
   body { margin:0;padding:0;font-size:14px;font-family:Georgia, Times, serif; background-color:#fff;}
   h1, h2, h3, h4, h5, a { font-family: Quicksand, "Helvetica Neue", Optima, Verdana, sans-serif; }
   a { text-decoration:none;color:#555; }
   a:hover { text-decoration:underline; color:#00a; }
   a:visited { color:#333; }
   a:active { color:#e00;display:inline-block;top:2px; }
   #main { margin:1em; font-size:1.5em; }
   ul.nav {
      margin-left:2em;
      float:left;
   }
   ul.nav li { margin-top: 1em; margin-bottom: 1em; }
   ul.nav li a { font-size:1.5em; }
   .navNoIcon {
      margin-right:.5em;
      padding:.35em .13em .2em .15em;
      border-radius: 1em; -webkit-border-radius: 1em; -moz-border-radius: 1em;
      text-shadow:2px 2px 0px #fff;
      font-size: 2.5em;
      vertical-align: middle;
      font-family: Quicksand, "Helvetica Neue", Optima, Verdana, sans-serif;
   }
   .navIcon {
      margin-right:.5em;
      padding:.2em .25em .4em .2em;
      border-radius: 1em; -webkit-border-radius: 1em; -moz-border-radius: 1em;
      font-family: Quicksand, "Helvetica Neue", Optima, Verdana, sans-serif;
   }
   .navNoIcon:hover, .navIcon:hover {
      background-color:#ffc;
   }
   div.navIcon img {
      width:.65em;
      height:.65em;
      margin-top:-2px;
      margin-left:-5px;
      position:relative;
   }
</style>
</head>
<body>
<div id='main'>
<h1>Help Desk</h1>
<ul class='nav'>
<li id='pid_10'><a rel='nav' title='Technical Support' href='/apps/embed.php?pid=10&id=new1&x=save' class='nav'><div class='navIcon'><img src='/clients/sanrio/img/kitty2.png' border='0' /></div>Tech Support</a></li>
<li id='pid_11'><a rel='nav' title='Online Account' href='/apps/embed.php?pid=11&id=new1&x=save' class='nav'><div class='navIcon'><img src='/clients/sanrio/img/NW-logo.jpg' border='0' /></div>Online Account</a></li>
<li id='pid_12'><a rel='nav' title='Purchase Request' href='/apps/embed.php?pid=12&id=new1&x=save' class='nav'><div class='navIcon'><img src='/clients/sanrio/img/CharmmyKitty.png' border='0' /></div>Purchase Request</a></li>
</ul> </div>

   <iframe name='uploadFrame' id='uploadFrame' width='100' height='100' style="position:absolute;left:-3000px;top:-3000px;"></iframe>
   
   <div id='formDialog' title='Support Form' style='display:none'>
      <iframe name='supportFrame' id='supportFrame' width='700' height='500'></iframe>
   </div>
</body>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.19/jquery-ui.min.js"></script>
<script type='text/javascript'>
var simpleConfig = {};
function postData(url, data, callback) {
   // check 'working' attribute in global config and only perform
   // one transaction at a time, deferring if busy
   if (!simpleConfig.working) {
      simpleConfig.working = true;

      $.ajax({
         type: "POST",
         url: url,
         data: data,
         success: function(msg) {
            $("body").append(msg);
            simpleConfig.modified = false;
            simpleConfig.working = false;
            if (callback && (typeof callback === "function")) {
               callback.apply(this, msg);
            } 
         }
      });
   } else {
      setTimeout(function() { postData(url, data, callback); }, 500);
   }
}

$(document).ready(function() {
   $("span.arrow").click(function() {
         $("ul.child", $(this).parent()).toggle();
         $(this).siblings("span.arrow").toggle();
         $(this).toggle();
      }
   );
   
   $("#formDialog").dialog({
      autoOpen:false,
      height:450,
      width:725,
      position: [50, 50],
      modal:true,
      buttons: {
         "Cancel": function() {
            $("#formDialog").dialog("close");            
         },
         "Send Request": function() { 
            var allInputs = $("#supportFrame").contents().find(':input'), sid="new1";
            allInputs.each(function(idx) {
               newname = $(this).attr('name');
               if (newname) {
                  newname = newname.replace(/\[\]/, "["+sid+"]");
                  $(this).attr('name', newname);
               }
            });
            $("#supportFrame").contents().find("#simpleForm").submit();
            setTimeout(function() { $("#formDialog").dialog("close"); }, 5000);
            // var pid = simpleConfig.pid.replace(/^pid_/, '');
            // postData("/grid/ctl.php?x=save&pid="+pid, data);
            // doSave();
            // alert("Request Sent");
         }
      }
   });

   $("ul.nav a").click(function(e) {
      simpleConfig.pid = $(this).parent().attr("id");
     // .replace(/\D/, '');
      $("#supportFrame").attr("src", $(this).attr("href"));
      $("#formDialog").attr("title", $(this).attr("title")).dialog("option", "title", $(this).attr("title")).dialog("open");
   
      e.preventDefault();
      e.stopPropagation();
      return false;
   });
});
</script>
</html>
