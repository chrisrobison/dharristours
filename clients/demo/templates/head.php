      <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/dojo/1.3/dijit/themes/tundra/tundra.css">
      <style type="text/css">
            body, html { font-family:helvetica,arial,sans-serif; font-size:90%; }
      </style>
      <style type="text/css">
            html, body { width: 100%; height: 100%; margin: 0; }
            ul.nav { margin:0; padding:0; }
            ul.nav li { list-style: none outside none; padding: 2px 0px; }
            a { text-decoration:none; color: #444444; }
            a:hover { text-decoration:underline; color: #4444ff; }
            .fieldLabel {position: relative; text-align: right; float: left; width: 150px; display: block;}
            .boxHeading {position: relative; text-align: right; float: left; width: 150px; display: block;font-size:1.2em;font-weight:bold;}
      </style>
        <style type="text/css">
            .tundra table.dijitCalendarContainer { margin: 25px auto; } 
            #formatted { text-align: center; }
        </style>
       <script type="text/javascript" src="/lib/js/cmd.js"> </script>
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
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
