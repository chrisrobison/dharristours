<?php
   require($_SERVER['DOCUMENT_ROOT'] . '/lib/auth.php');
?>
<!DOCTYPE html> 
<html>
   <head>
   <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
   <link rel='stylesheet' type='text/css' href='/lib/css/core.css' />
   <link rel='stylesheet' type='text/css' href='/lib/css/icons48.css' />
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
      h3 + div.open { margin-left: 2em; }
      h1 { margin-bottom:.25em;cursor:pointer; }
      h2:before { font-size:1.2em; font-weight:normal; content: "\25B8" " "; margin-left:0px; color:#000; cursor:pointer;} 
      h2.open:before { font-size:1.2em; font-weight:normal; content: "\25BE" " "; margin-left:0px; color:#000; cursor:pointer;} 
      h2 { cursor:default; margin-bottom:0px;}
      h1 + ul, h2 + ul, h3 + ul { margin-left:2em; padding-left:1em; list-style-type:none;cursor:default; }
      h2 + div.section { margin-left: 2em;cursor:default; }
      h3 { margin:4px 0; cursor:default;}
      h3.hide, h3 strong:before, h3.collapsible:before { content: "\25B8" " "; margin-left:.5em; color:#000; cursor:pointer;} 
      h3.open strong:before { content: "\25BE" " "; margin-left:.5em; color:#000; } 
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
      #toolbar { position: fixed; top:0px;left:0px;right:0px;width:100%;}
      div.closed, ul.closed { display:none; }
      h2.header:before { content: " "; }
      iframe { resize:both; }
      div.resize { resize:both; }
      .iframe { width:800px; height:400px; overflow:hidden; border:1px inset #ccc;background-color:#eee;text-align:center; padding-top:4px; }
      .simpleIcon { outline: none; }
   </style>
   </head>
   <body>
   <div id='toolbar'>
      <div id='toolfloat' style='float:right;'>
         <a class='toolbarButton' title='Edit Dash' href='#' onclick='return top.loadUrl("/grid/?pid=37", "Dash Edit")'><img class='toolbtn'  src='/img/dbtool/icon_renameTable.png'></a> 
      </div>
   </div>
   <div style="margin:3em 1em 1em 2em;max-width:800px;">
      <div id='sidebar'>
      </div>
      <div id='updates'>
<?php
   $dash = $boss->getObject("Dashboard", "1=1 ORDER BY CategorySequence,Category, Sequence");
   $first = 0;

   foreach ($dash->Dashboard as $key=>$item) {
      if (!preg_match("/^_/", $key)) {
         // $class = $class ? $class : "open";
         $item->Class = preg_replace("/\s*/", '', $item->Class);
         $state = ($item->State) ? "open" : "closed";
         $class = ($item->Class) ? ' ' . $item->Class : $state;
      
         if (($item->Category != "header") && ($item->Category != "sidebar")) {
            if (!$done[$item->Category]) {
               if ($ul) print "</ul>\n";
               print "<h2 class='$class'>".$item->Category."</h2>\n<ul class='$state'>\n";
               $done[$item->Category] = 1;
               $ul = 1;
            }
            print "\t<li>";
            $url = "";
            $url = preg_replace("/\s*$/", '', $item->Url);
            if ($item->Dashboard && $item->Type != "link") print "<h3 class='$class'>" . $item->Dashboard . "</h3>\n";
            if ($item->Dashboard && $item->Type == "link") {
            //print "<a href='{$url}' target='_blank'>" . $item->Dashboard . "</a>\n";
               print "\t\t<a target='_blank' title='" . $item->Dashboard . "' href='" . $item->Url . "'$js class='" . $proc->ClassName . "'>";
               if ($item->Icon) {
                  if (preg_match("/\.(png|jpg|gif|ico|bmp|svg)$/", $item->Icon)) {
                     $icon = (file_exists($_SERVER['DOCUMENT_ROOT'].$boss->app->Assets.$item->Icon)) ? $boss->app->Assets.$item->Icon : $item->Icon;
                     if (!file_exists($_SERVER['DOCUMENT_ROOT'].$icon)) {
                        print "<div class='navNoIcon'>".preg_replace("/^(\w).*/", "$1", $item->Dashboard)."</div>";
                     } else {
                        print "<div class='navIcon'><img src='".$icon."' border='0' /></div>";
                     }
                  } else {
                     print "<div class='navIcon'><span class='simpleIcon icon-".$item->Icon."'> </span></div>";
                  }
               } else {
                  print "<div class='navNoIcon'>".preg_replace("/^(\w).*/", "$1", $item->Process)."</div>";
               }
               print $item->Dashboard."</a>";
            }
            print "\t\t<div class='$state'>\n"; // <ul class='$state'>\n\t<li>\n\t";
            if ($url != "") {
               if ($item->Type == 'image') {
                  print "<img src='{$url}'>";
               } else if ($item->Type == 'iframe') {
                  print "<div class='iframe resize'><iframe width='99%' height='99%' src='{$url}' style='border:0px;padding:0px;margin:0px;' border='0'></iframe></div>";
               } else if ($item->Type == 'link') {
                  // print "<a href='{$url}' target='_blank'>{$url}</a>";
               } else {
                  if (preg_match("/^https?:\/\//", $url)) {
                     print "<div class='iframe resize'><iframe id='myfr' width='100%' height='100%' style='border:0px;padding:0px;margin:0px;' src='{$url}' border='0'></iframe></div>";
                  } else {
                     print file_get_contents($_SERVER['DOCUMENT_ROOT'] . $url);
                  }
               }
            } else {
               print $item->Content;
            }
            print "\t\t</div></li>\n";
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
      var dashboard = <?php print json_encode($dash->Dashboard); ?>;
      $(document).ready(function() {
         $("#updates").attr("unselectable", "on")
            .css("MozUserSelect", "none")
            .bind("selectstart.ui", function() { return false; }); 
         
         $("h2,h3").click(function(e) {
            $(this).toggleClass("open").next("ul,div").toggleClass("open").toggleClass("closed");
            return false;
         });
         $("h2::before").first().css({content: " "});
      });
   </script>
</html>
