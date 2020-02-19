<?php
   require($_SERVER['DOCUMENT_ROOT'] . '/lib/auth.php');
?>

<!DOCTYPE html> 
<html>
   <head>
   <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
   <link rel='stylesheet' type='text/css' href='/lib/css/core.css' />
<link href='//fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <style>
      body { }
      h1, h2, h3, h4, h5 { font-family: Quicksand, "Helvetica Neue", Optima, Verdana, sans-serif; }
      #main {
         position:relative;
         max-width:700px;
      }
      a { 
         color: #0000cc;
      }
      a:hover {
         color: #0000ff;
         text-decoration: underline;
      }
      a:active {
         color:red;
         position:relative;
         top:2px;
      }
      a:visited {
         color:#770099;
      }
      h1 { margin-bottom:.25em;cursor:pointer; }
      h2:before { font-size:1.2em; font-weight:normal; content: "\2295" " "; margin-left:0px; color:#000; cursor:pointer;} 
      h2.open:before { font-size:1.2em; font-weight:normal; content: "\2297" " "; margin-left:0px; color:#000; cursor:pointer;} 
      h2 { cursor:default; margin-bottom:0px;}
      h1 + ul, h2 + ul { margin-left:0px; padding-left:1em; list-style-type:none;cursor:default; }
      h2 + div.section { margin-left: 2em;cursor:default; }
      h3 { margin:4px 0; cursor:default;}
      h3 strong:before, h3.collapsible:before { content: "\2295" " "; margin-left:.5em; color:#000; cursor:pointer;} 
      h3.open strong:before { content: "\2297" " "; margin-left:.5em; color:#000; } 
      h3 strong { cursor:pointer;font-weight:normal;font-size:1.0em; }
      h3 + ul { margin: 0 0 0 0em; padding-left:1em;cursor:default;}
      h3 + ul li { list-style-type: none; padding-left:1em; margin-left:0px; cursor:default;}
#toolbar BUTTON, #toolbar A, .simpleButton, #toolbar a.button, .toggleDown {
    -moz-border-bottom-colors: none;
-moz-border-left-colors: none;
-moz-border-right-colors: none;
-moz-border-top-colors: none;
background: -moz-linear-gradient(center top , #F0F0F0 0%, #E0E0E0 49%, #D5D5D5 51%, #D7D7D7) repeat scroll 0 0 transparent;
border-color: #EEEEFF #999999 #999999 #EEEEFF;
border-image: none;
border-radius: 2px 2px 2px 2px;
border-style: solid;
border-width: 1px;
color: #4F4F4F;
cursor: default;
display: inline-block;
float: left;
font-size: 14px;
font-weight: normal;
height: 1.4em;
margin: 4px 2px 0;
outline: medium none;
padding: 0.1em 0.125em 0.075em 0.125em;
text-decoration: none;
text-shadow: 0 0 0 transparent, 0 1px 0 #FFFFFF;
       white-space: nowrap;
       }
</style>
</head>
   <body>
         <div id='toolbar'>
            <div id='toolfloat' style='float:right;'>
               <a class='toolbarButton' title='Edit Dash' href='#' onclick='return top.loadUrl("/grid/?pid=37", "Dash Edit")'><img class='toolbtn'  src='/img/dbtool/icon_renameTable.png'></a> 
            </div>
         </div>
   <div style="margin:2em;max-width:800px;">
      <div id='updates'>
         <span id='header'></span>
<?php
   $dash = $boss->getObject("Dashboard", "1=1 ORDER BY Category, Sequence");
   $first = 0;

   foreach ($dash->Dashboard as $key=>$item) {
      if (!preg_match("/^_/", $key)) {
         $class = ($item->Class) ? ' ' . $item->Class : '';
         if ($item->Category != "header") {
            if (!$done[$item->Category]) {
               if ($ul) print "</ul>";
               if (!$first) {
                  print "<h1 class='head'>".$item->Category."</h1>\n<ul class='$class'>\n\t";
                  $first = 1;
               } else {
                  print "<h2 class='open'>".$item->Category."</h2>\n<ul class='$class'>\n\t";
               }
               $done[$item->Category] = 1;
               $ul = 1;
            }
            print "<li><h3 class='closed$class'>" . $item->Dashboard . "</h3>\n<ul class='$class'>\n\t<li>\n\t";
            $url = "";
            $url = preg_replace("/\s*$/", '', $item->Url);

            if ($url != "") {
               if ($item->Type == 'image') {
                  print "<img src='{$url}'>";
               } else if ($item->Type == 'iframe') {
                  print "<iframe width='600' height='300' src='{$url}' border='0' style='border:.2em solid #000;border-radius:1em;'></iframe>";
               } else if ($item->Type == 'link') {
                  print "<a href='{$url}' target='_blank'>{$url}</a>";
               } else {
                  if (preg_match("/^https?:\/\//", $url)) {
                     print "<iframe id='myfr' width='800' height='400' src='{$url}' border='0' style='border:.2em solid #000;border-radius:1em;'></iframe>";
                  } else {
                     print file_get_contents($_SERVER['DOCUMENT_ROOT'] . $url);
                  }
               }
            } else {
               print $item->Content;
            }
            print "\n\t</li>\n</ul>";
         } else {
            $header = $item;
         }
      }
   }
?>
</ul>
      </div>
   </div>
   </body>
   <script type='text/javascript'>
      $(document).ready(function() {
         // $("h2").next("ul").hide("fast");
         $("h2").click(function(event) {
            $(this).toggleClass("open");
            $(this).next("div.section").slideToggle('fast');
            $(this).next("ul").slideToggle('fast');
            $(this).attr("unselectable", "on")
               .css("MozUserSelect", "none")
               .bind("selectstart.ui", function() { return false; }); 
            return false;
         });
         $("h2").next("div.section").hide("fast");
         $("h3").next("ul").hide("fast");
         $("h3").click(function(event) {
            $(this).toggleClass("open");
            $(this).next("ul").slideToggle('fast');
            $(this).attr("unselectable", "on")
               .css("MozUserSelect", "none")
               .bind("selectstart.ui", function() { return false; }); 
            return false;
         });
      });
   </script>
</html>
