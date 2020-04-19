<?php  if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php"); ?>
<!DOCTYPE html>
<html dir="ltr">
   <head>
      <meta http-equiv="X-UA-Compatible" content="chrome=1">
      <title><?php print $boss->app->App; ?> Workplace</title>
      <link rel="icon" type="image/png" href="<?php 
         $favico = $boss->app->Assets . '/img/favicon.png';
         if (file_exists($_SERVER['DOCUMENT_ROOT'] . $favico)) { 
            print $favico; 
         } else {
            //print "/favicon.ico?v=2.4";
            print "/clients/dharristours/favicon.ico?v=2.4";
         }
      ?>">
      <link href='//fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
      <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/dojo/1/dijit/themes/claro/claro.css" />
      <link href="/lib/css/ui.jqgrid.css" type="text/css" rel="stylesheet" />
      <link href="/lib/css/Aristo/jquery-ui-1.8.5.custom.css" type="text/css" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="/lib/css/icons48.css" />
      <link rel="stylesheet" type="text/css" href="/lib/css/icons24.css" />
      <link rel="stylesheet" type="text/css" href="/lib/css/core.css" />
      <style>
       .dijitAccordionText, ul.nav li a.nav { font-family: Quicksand, "Helvetica Neue", Optima, Verdana, sans-serif; white-space:nowrap; }
      </style>
      <link rel="stylesheet" type="text/css" href="<?php print $boss->app->Assets . "/" . $boss->app->CSS; ?>" />
      <?php
         if ($_SERVER['HTTPS'] == "on") {
      ?>
      <script type="text/javascript">
         djConfig = { 
           modulePaths: { 
               "dojo": "https://ajax.googleapis.com/ajax/libs/dojo/1/dojo", 
               "dijit": "https://ajax.googleapis.com/ajax/libs/dojo/1/dijit", 
               "dojox": "https://ajax.googleapis.com/ajax/libs/dojo/1/dojox" 
            } 
         }; 
      </script>
      <?php 
         }
      ?>
      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/dojo/1/dojo/dojo.xd.js" djConfig="parseOnLoad: true"> </script>
      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
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
    </head>
    <body class="claro">
        <div dojoType="dijit.layout.BorderContainer" id="mainContent" design="sidebar" style="width:100%;height:100%;border:0px;">
            <div dojoType="dijit.layout.ContentPane" region="leading" style="width:205px;margin:0px;padding:0px;" splitter="true">
               <div  dojoType="dijit.layout.ContentPane" id='logoWrap' region="top">
                  <div id='appLogo'><img id='logoImage' src="<?php print $boss->app->Assets . "/" . $boss->app->Logo; ?>" border="0" width='200' /></div>
               </div>
               <div id="accordion" class='nav' dojoType="dijit.layout.AccordionContainer" region="trailing"  style="position:absolute;top:75px;bottom:0px;width:100%;padding:0px;margin:0px;left:0px;" splitter="true" minsize="20">
                  <?php include("nav3.php"); ?>
               </div>
            </div>
            <div dojoType="dijit.layout.TabContainer" tabstrip="true" id="tabs" splitter="true" region="center">
                <div dojoType="dijit.layout.ContentPane" id='dashboardTab' title="Dashboard">
                   <div id="content1">
                  <?php 
                     // Figure out what to display in the inital dashboard tab. Defaults to global dashboard.php in /apps/templates
                     $dashurl = "/apps/templates/dashboard.php";
                     
                     if ($_SESSION['Login']->InitialProcess) {

                        $myproc = $boss->getObject("Process", $_SESSION['Login']->InitialProcess);
                        $dashurl = ($myproc->URL) ? $myproc->URL : "/grid/?pid=" . $_SESSION['Login']->InitialProcess;

                     } elseif (file_exists($_SERVER['DOCUMENT_ROOT'].$boss->app->Assets.'/dashboard.php')) {
                        
                        $dashurl = $boss->app->Assets.'/dashboard.php';

                     }

		     $prot = ($_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
		     $dashurl = $prot . $_SERVER['SERVER_NAME'] . $dashurl;
                  ?>
                     <div class='frameWrap'><iframe width="100%" scrolling="auto" height="100%" border="0" style="padding:0px;margin:0px;" src="<?php print $dashurl; ?>" class="framed"></iframe></div>
                  </div>
               </div>
            </div>
            <?php
               $created = strtotime($boss->app->Created);
               $expires = $created + (60 * 60 * 24 * 30);
               $timeleft = $expires - time();
               $days = round($timeleft / 60 / 60 / 24);
               $trialdone = "";
               if ($days < 30) $trialdone = "trialwarn";
               if ($days < 14) $trialdone = "trialwarn";
               if ($days < 0) $trialdone = "trialdone";
               if ($boss->app->PayStatus == "current") $trialdone = "paid";
            ?>
            <div dojoType="dijit.layout.ContentPane" region="bottom" id="footer" style="height:32px;" splitter="true"<?php print ($trialdone) ? " class='$trialdone'" : ''; ?>>
               <div id="copy"><a style='color:inherit' href='#changePasswd' id='chpassIcon'>&#9881;</a>   Logged in as: <a id='easteregg' style="color:#cc0;font-size:1.1em;" href="javascript:var%20s%20=%20document.createElement('script');s.type='text/javascript';document.body.appendChild(s);s.src='/lib/js/asteroids.min.js';void(0);"><?php print $_SESSION['FirstName'].' '.$_SESSION['LastName']; ?></a> [<a href="/login.php?logout=true" target="_top" style="color:#ffaaaa;text-decoration:underline;">Logout</a>] 
               <br/>&copy; Copyright <?php print date("Y"); ?>, Simple Software Inc.</div>
               <div id="simpleStatus"> Status: <b class='status'>
               <?php 
                  if ($boss->app->PayStatus != "current") { 
                     print $days . " days left on your trial."; 
                     ?>
                     <div id="googleCheckout" style="position:relative;width:250px;left:-7px;">
                        <?php include($_SERVER['DOCUMENT_ROOT'] . '/checkout/simple/subscription.php'); ?>
                     </div>
                     <?php
                  } else { 
                     print "OK"; 
                  } ?></b></div>
            </div>
         </div>
         <?php include("chpass.php"); ?>
    </body>
    <script>   
      var simpleConfig = {};

      jQuery(function($) {
         $("a[rel='logout']").click(function(e) { top.location.href = "/login.php?logout=true"; });
         $("a[rel='nav']").live('click', function(event) { 
               loadUrl($(this).attr('href'), $(this).attr('title'), $(this).attr('target'), event.shiftKey, $(this).data('module'));
               event.preventDefault(); event.stopPropagation(); return false;
         });
         
         $("span.arrow").click(function() { 
            $("ul.child", $(this).parent()).toggle(); 
            $(this).siblings("span.arrow").toggle();
            $(this).toggle();
         });
         
         $("#chpassIcon").click(function() { $("#chpassDialog").dialog("open"); return false; });
         $( "#chpassDialog" ).dialog({
            autoOpen: false,
            height: 300,
            width: 400,
            modal: true,
            open: function(event, ui) {
               $("#chpassResults").empty().hide();
               $("#chpass").show();
            }, 
            buttons: { 
               "Cancel": function() { 
                  $( this ).dialog("close"); 
               },
               "Change Password": function() {
                  $.post('/grid/ctl.php', $("#chpass").serialize(), function() {
                     $("#chpassDialog").dialog("close");
                  });
               }
            },
            close: function() {
               $(this).dialog("close");
               // allFields.val( "" ).removeClass( "ui-state-error" );
            }
         });

         <?php
            if ($in['pid']) {
               $proc = $boss->getObject("Process", $in['pid']);
               $url = "/grid/?rsc=".$proc->Resource."&pid=".$proc->ProcessID;
               if ($in['id']) {
                  $url .= "&id=".$in['id'];
               }
               $title = $proc->Process;
               $tgt = $proc->Target;
               print "setTimeout(function() { loadUrl('$url','$title','$tgt');}, 2000);\n";
            }
         ?>
         /* setTimeout(function() {
            if (localStorage && localStorage['tabs']) {
               var tabs = JSON.parse(localStorage['tabs']);
               for (var i in tabs) {
                  loadUrl(tabs[i].url, tabs[i].title, tabs[i].target);
               }
            }
         }, 2000);
         */
         dojo.ready(function() {
            if (sessionStorage && sessionStorage['tabs']) {
               var tabs = JSON.parse(sessionStorage['tabs']);
               for (var i in tabs) {
                  loadUrl(tabs[i].url, tabs[i].title, tabs[i].target, tabs[i].force, tabs[i].mid, tabs[i].isModule);
               }
               
               var tab_container = dijit.byId("tabs"),
                   dashboardTab = dijit.byId("dashboardTab");

               if (tab_container && dashboardTab) {
                  tab_container.selectChild(dashboardTab);
               }

            }

         });
      });
      // window.onbeforeunload = function(e) { return "You are about to exit your Simple Workspace."; };
   </script>
</html>
