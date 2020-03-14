<?php  if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php"); ?>
<!DOCTYPE html>
<html dir="ltr">
    <head>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/dojo/1.5/dojo/dojo.xd.js" djConfig="parseOnLoad: true"> </script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
 
        <script type="text/javascript">
            dojo.require("dijit.dijit"); // loads the optimized dijit layer
            dojo.require("dijit.layout.BorderContainer");
            dojo.require("dijit.layout.TabContainer");
            dojo.require("dijit.layout.AccordionContainer");
            dojo.require("dijit.layout.ContentPane");
            dojo.require("dijit._Calendar");
        </script>
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
            });
        </script>
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/dojo/1.5/dijit/themes/claro/claro.css" />
        <link rel="stylesheet" type="text/css" href="/lib/css/core.css" />
        <style type="text/css">
            html, body { width: 100%; height: 100%; margin: 0; }
        </style>
        <link rel="stylesheet" type="text/css" href="<?php print $boss->app->Assets . "/" . $boss->app->CSS; ?>" />
    </head>
    <body class="claro">
        <div dojoType="dijit.layout.BorderContainer" style="width:100%;height:100%;border:0px;">
            <div dojoType="dijit.layout.BorderContainer" region="left" style="width:200px;">
               <div  dojoType="dijit.layout.ContentPane" id='logoWrap' region="top">
                  <div id='appLogo'><img src="<?php print $boss->app->Assets . "/" . $boss->app->Logo; ?>" border="0" /></div>
               </div>
               <div id="accordion" class='nav' dojoType="dijit.layout.AccordionContainer" region="leading"  style="width:190px;padding:0px;margin:0px;left:0px;">
                  <?php include("nav3_cp.php"); ?>
               </div>
            </div>
            <div dojoType="dijit.layout.TabContainer" splitter="true" tabstrip="true" id="tabs" region="center">
                <div dojoType="dijit.layout.ContentPane" title="Dashboard">
                   <div id="content1">
                     <h1>Welcome to Simple</h1>
                      <p>To open a new tab, click a link on the left.</p>
                      <p>To Close a tab, click the 'X' next to the tab name. You can switch between tabs without losing your place by clicking the name of the tab.</p>
                      <hr/>
                      <p>Please do NOT use your browser 'Back' button. This will reload the entire page and all tabs will be closed.</p>
                   </div>
                </div>
            </div>
            <!--
            <div dojoType="dijit.layout.ContentPane" region="bottom">
               <div id="copy" style="float:right;text-align:right;">&copy;Copyright 2010&mdash;Simple Software Co. of SF<br/>All Rights Reserved</div>
               <div id="status">Status: <b>OK</b></div>
            </div>
            -->
        </div>
    </body>
</html>
