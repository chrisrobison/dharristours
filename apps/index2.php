<?php  if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php"); ?>
<!DOCTYPE html>
<html dir="ltr">
   <head>
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/dojo/1.5/dojo/dojo.xd.js" djConfig="parseOnLoad: true"> </script>
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
      <script type="text/javascript" src="/lib/js/i18n/grid.locale-en.js"></script>
      <script type="text/javascript" src="/lib/js/jquery.jqGrid.min.js"></script>


      <script type="text/javascript">
            dojo.require("dijit.dijit"); // loads the optimized dijit layer
            dojo.require("dijit.layout.BorderContainer");
            dojo.require("dijit.layout.TabContainer");
            dojo.require("dijit.layout.AccordionContainer");
            dojo.require("dijit.layout.ContentPane");
            dojo.require("dijit._Calendar");
      </script>
      <script type="text/javascript" src="/lib/js/default.js"> </script>
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
               <?php
                  if ($in['pid']) {
                     $proc = $boss->getObject("Process", $in['pid']);
                     $url = "/apps/content.php?Resource=".$proc->Resource."&type=Process&ProcessID=".$proc->ProcessID;
                     if ($in['id']) {
                        $url .= "&ID=".$in['id'];
                     }
                     $title = $proc->Process;
                     $tgt = $proc->Target;
                     print "setTimeout(function() { loadUrl('$url','$title','$tgt');}, 1000);\n";
                  }
               ?>
            });
        </script>
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/dojo/1.5/dijit/themes/claro/claro.css" />
        <link href="/lib/css/ui.jqgrid.css" type="text/css" rel="stylesheet" />
        <link href="/lib/css/Aristo/jquery-ui-1.8.5.custom.css" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="/lib/css/core.css" />
        <style type="text/css">
            html, body { width: 100%; height: 100%; margin: 0; }
        </style>
        <link rel="stylesheet" type="text/css" href="<?php print $boss->app->Assets . "/" . $boss->app->CSS; ?>" />
    </head>
    <body class="claro">
        <div dojoType="dijit.layout.BorderContainer" id="mainContent" design="sidebar" style="width:100%;height:100%;border:0px;">
            <div dojoType="dijit.layout.ContentPane" region="leading" style="width:190px;margin:0px;padding:0px;" splitter="true">
               <div  dojoType="dijit.layout.ContentPane" id='logoWrap' region="top">
                  <div id='appLogo'><img src="<?php print $boss->app->Assets . "/" . $boss->app->Logo; ?>" border="0" /></div>
               </div>
               <div id="accordion" class='nav' dojoType="dijit.layout.AccordionContainer" region="trailing"  style="position:absolute;top:125px;bottom:0px;width:100%;padding:0px;margin:0px;left:0px;" splitter="true" minsize="20">
                  <?php include("nav3.php"); ?>
               </div>
            </div>
            <div dojoType="dijit.layout.TabContainer" tabstrip="true" id="tabs" splitter="true" region="center">
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
            <div dojoType="dijit.layout.ContentPane" region="bottom" id="footer" style="height:32px;" splitter="true">
               <div id="copy">
                  <a target="_blank" href="http://www.simplesoftwaresf.com/">Simple Software Co. of SF</a><br/>
                  &copy; Copyright 2010, All Rights Reserved
               </div>
               <div id="status">Status: <b style="color:#009900">OK</b><br />Logged in as: <?php print $_SESSION['Email']; ?> [<a href="/login.php?logout=true" target="_top" style="color:#0000ff;text-decoration:underline;">Logout</a>]</div>
            </div>
         </div>
    </body>
</html>
