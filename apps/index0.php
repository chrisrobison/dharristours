<?php  
   if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
?>
<!DOCTYPE html>
<html dir="ltr">
   <head>
      <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/dojo/1.5/dijit/themes/tundra/tundra.css" />
      <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/smoothness/jquery-ui.css" />
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
      <script type="text/javascript" src="/lib/js/cmd.js"> </script>
      <script type='text/javascript'>
         jQuery(function($) {
            $("a[rel='logout']").click(
               function(e) {
                  top.location.href = "/login.php?logout=true";
               }
            );
            $("a[rel='nav']").click(
               function(e) { 
                  if (!loadUrl($(this).attr('href'), $(this).attr('title'), $(this).attr('target'))) { 
                     e.preventDefault(); 
                     e.stopPropagation(); 
                     return false;
                  } 
               }
            );
            $("#accordion").accordion({ fillSpace: false }); 
         });
      </script>
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/dojo/1.3/dojo/dojo.xd.js" djConfig="parseOnLoad: true"> </script>
      <script type="text/javascript">
          dojo.require("dijit.layout.BorderContainer");
          dojo.require("dijit.layout.TabContainer");
          dojo.require("dijit.layout.AccordionContainer");
          dojo.require("dijit.layout.ContentPane");
          dojo.require("dijit.dijit"); // loads the optimized dijit layer
          dojo.require("dijit._Calendar");
       </script>
      <link rel="stylesheet" type="text/css" href="<?php print $boss->app->Assets . "/" . $boss->app->CSS; ?>" />
   </head>
    <body class="tundra">
        <div dojoType="dijit.layout.BorderContainer" design="sidebar" gutters="true" liveSplitters="true" style="width: 100%; height: 100%;">
            <div dojoType="dijit.layout.BorderContainer" gutters="true" liveSplitters="false" region="left" style="width:180px;">
               <div  dojoType="dijit.layout.ContentPane" id='left' region="top">
                  <div id='appLogo'><img src="<?php print $boss->app->Assets . "/" . $boss->app->Logo; ?>" border="0" /></div>
               </div>
               <div id="accordion" class='nav' dojoType="dijit.layout.ContentPane" region="center" style="width:175px;padding:0px;margin:0px;">
                  <?php include("nav3.php"); ?>
               </div>
            </div>
            <div dojoType="dijit.layout.TabContainer" splitter="true" region="center" tabstrip="true" id="tabs">
                <div id="contentTab1" dojoType="dijit.layout.ContentPane" selected="true" closable="true" title="Welcome">
                   <div id="content1">
                   To open a new tab, click a link on the left.<br><br> 
                   To Close a tab, click the 'X' next to the tab name. You can switch between tabs without losing your place by clicking the name of the tab.
                   <br>
                   Please do NOT use your browser 'Back' button. This will reload the entire page and all tabs will be closed.
                   <br><br>
                   
                                                                             </blockquote> </div>
                </div>
            </div>
            <!--
            <div dojoType="dijit.layout.ContentPane" region="trailing">
             <h2>Simple Chat</h2>
             <div>Heath is Online</div>
             <div>Patrick is Offline</div>
            </div>
            -->
            <div dojoType="dijit.layout.ContentPane" region="bottom" id="status">
                
            </div>
        </div>
    </body>
</html>
