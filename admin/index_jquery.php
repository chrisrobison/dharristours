<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html dir="ltr">
   <head>
      <style type="text/css">
            body, html { font-family:helvetica,arial,sans-serif; font-size:90%; }
      </style>
      <style type="text/css">
            /* ul.nav { margin:0; padding:0; }
            ul.nav li { list-style: none outside none; padding: 2px 0px; }
            a { text-decoration:none; color: #444444; }
            a:hover { text-decoration:underline; color: #4444ff; }*/
      </style>
       <script type="text/javascript" src="/lib/js/cmd.js"> </script>
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
      <script type="text/javascript" src="/lib/js/jquery-ui-1.7.2.custom/js/jquery-ui-1.7.2.custom.min.js"></script>
      <script type="text/javascript" src="/lib/js/jquery.layout.min.js"></script>

      <script type='text/javascript'>
         jQuery(function($) {
            $(document).ready(function() {
//               $("body").layout( {
//                  applyDefaultStyles: true,
//                  closable: true,
//                  resizable: true,
//                  slidable: true
//                  } );
               $("div.tab_nav").tabs("panes");
             
//            $("a[rel='nav']").click(function() { loadUrl($(this).attr('href')); return false;});
            });
         });

      </script>
      <link href="/lib/js/jquery-ui-1.7.2.custom/css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css"></link>
   </head>
    <body>
            <div class="ui-layout-north">
                <img src="/peninsulatour.com/images/Peninsulatour.280w39hgif.gif" border="0" />
            </div>
            <div class="ui-layout-center" >
                <div id="tabs_home">
                      <ul class='tab_nav'>
                         <li><a rel='nav' href="#CompanyList">Companies List</a></li>
                         <li><a rel='nav' href="#ScheduledJobs">Scheduled Jobs</a></li>
                         <li><a rel='nav' href="#Invoice">Invoices</a></li>
                         <li><a rel='nav' href="#Calendar">View Calendar</a></li>
                      </ul>
                     <div class="panes">
                        <div id="CompanyList">
                                  Click a link on the left to get started.
                        </div>
                        <div id="ScheduledJobs">
                                  Click a link on the left to get started.
                        </div>
                        <div id="Invoices">
                                  Click a link on the left to get started.
                        </div>
                        <div id="Calendar">
                                  Click a link on the left to get started.
                        </div>
                     </div>
               </div>
            </div>
            <div class="ui-layout-east">
             <h2>Simple Chat</h2>
             <div>Heath is Online</div>
             <div>Patrick is Offline</div>
            </div>
            <div class="ui-layout-south">
                <span style="color:red;font-weight:bold">Alert: </span>New Order Pending
            </div>
       </div>
    </body>
</html>
