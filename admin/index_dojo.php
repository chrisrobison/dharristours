<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html dir="ltr">
   <head>
      <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/dojo/1.3/dijit/themes/soria/soria.css">
      <style type="text/css">
            body, html { font-family:helvetica,arial,sans-serif; font-size:90%; }
      </style>
      <style type="text/css">
            html, body { width: 100%; height: 100%; margin: 0; }
            ul.nav { margin:0; padding:0; }
            ul.nav li { list-style: none outside none; padding: 2px 0px; }
            a { text-decoration:none; color: #444444; }
            a:hover { text-decoration:underline; color: #4444ff; }
      </style>
        <style type="text/css">
            .tundra table.dijitCalendarContainer { margin: 25px auto; } 
            #formatted { text-align: center; }
        </style>
       <script type="text/javascript" src="/lib/js/cmd.js"> </script>
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
      <script type="text/javascript">
         google.load("jquery", "1.4.2");
         google.load("jqueryui", "1.7.2");
      </script>
      <script type='text/javascript'>
         jQuery(function($) {
            $("a[rel='nav']").click(function() { loadUrl($(this).attr('href')); return false;});
         });
      </script>

      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/dojo/1.3/dojo/dojo.xd.js"
      djConfig="parseOnLoad: true">
      </script>
      <script type="text/javascript">
          dojo.require("dijit.layout.BorderContainer");
          dojo.require("dijit.layout.TabContainer");
          dojo.require("dijit.layout.AccordionContainer");
          dojo.require("dijit.layout.ContentPane");
           dojo.require("dijit.dijit"); // loads the optimized dijit layer
        dojo.require("dijit._Calendar");
    </script>
   </head>
    <body class="soria ">
        <div dojoType="dijit.layout.BorderContainer" style="width: 100%; height: 100%;">
            <div dojoType="dijit.layout.ContentPane" region="top">
                <img src="/peninsulatour.com/images/Peninsulatour.280w39hgif.gif" border="0" />
            </div>
            <div dojoType="dijit.layout.AccordionContainer" region="leading">
                <div dojoType="dijit.layout.AccordionPane" title="Customers">
                   <ul class='nav'>
                      <li><a rel='nav' href="CompanyList">Companies List</a></li>
                   </ul>
                </div>
                <div dojoType="dijit.layout.AccordionPane" title="Jobs">
                   <ul class='nav'>
                      <li><a rel='nav' href="ScheduledJobs">Scheduled Jobs</a></li>
                   </ul>
                </div>
                <div dojoType="dijit.layout.AccordionPane" title="Invoices">
                   <ul class='nav'>
                      <li><a rel='nav' href="Invoice">Invoices</a></li>
                   </ul>
                </div>
                <div class="tudra" dojoType="dijit.layout.AccordionPane" title="Calendar">
                   <ul class='nav'>
                      <li><a rel='nav' href="Calendar">View Calendar</a></li>
                   </ul>
        <div style="display:none" dojoType="dijit._Calendar" onChange="dojo.byId('formatted').innerHTML=dojo.date.locale.format(arguments[0], {formatLength: 'full', selector:'date'})">
                </div>
                        <p id="formatted" style="display:none;">
                                </p>    

              </div>
            </div>
            <div dojoType="dijit.layout.TabContainer" region="center" id="tabs">
                <div id="contentTab1" dojoType="dijit.layout.ContentPane" selected="true" closable="true" title="Welcome">
                   <div id="content1">
                      Click a link on the left to get started.
                   </div>
                </div>
            </div>
            <div dojoType="dijit.layout.ContentPane" region="trailing">
             <h2>Simple Chat</h2>
             <div>Heath is Online</div>
             <div>Patrick is Offline</div>
            </div>
            <div dojoType="dijit.layout.ContentPane" region="bottom">
                <span style="color:red;font-weight:bold">Alert: </span>New Order Pending
            </div>
        </div>
    </body>
</html>
