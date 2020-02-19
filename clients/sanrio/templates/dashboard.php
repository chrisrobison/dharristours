<?php  if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php"); ?>
<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title>Dashboard</title>
      <style>
      
         /* Move inline styles into external stylesheet */
         body { font-family:"Helvetica Neue","Helvetica","Tahoma",sans-serif; margin:0;padding:0; }
         #dash { margin:1em; }
         h1 { margin:20px 0 0 0; }
         ol, ul { margin-top:0px; padding-left:1em; list-style-position:inside;cursor:default;}
         #main > ul > li, ol > li { font-size:1.2em;font-weight:bold;padding-top:1em; }
         ul ul { font-size: .9em; }
         li.closed+ul, li.open+ul { margin-left:3em; }
         li { padding:.5em; list-style-type:none; margin-left:2em; font-weight:normal; }
         li.closed:before { font-size:1.2em; font-weight:normal; content: "\2295" " "; margin-left:.5em; color:#000; }
         li.open:before { content: "\2297" " "; font-weight:normal;font-size:1.2em; margin-left:.5em; color:#000;}
         li:before { margin-left:2em; }
         li + ul { display:none; }
         .data { color:#0022ff; }
         .condition { color: #aa0000; }
         .task { color: #00aa99; }
         .action { color: #aa00ff; }
         .process { color: #cccc00; }
         .formHeading {display:none; }
         label { display:inline-block; width:15em; vertical-align:top;}
         input.boxValue { width: 25em; }
         
      </style>
  </head>
   <body>
      <div id='appLogo'><img src="<?php print "/img/ani-logo.gif"; ?>" /></div>
      
      <div id='dash'>
         <h1>Sanrio Helpdesk</h1>
         <button id='expandAll'>Expand All</button><button id='collapseAll'>Collapse All</button>
         <ul>
            <li class='closed'>Tech Support</li>
            <ul>
               <li>
                  <form id="TechSupport" rel="HelpDesk">
                     <input type='hidden' name='pid' id='17' value='17' />
                     <fieldset title='Tech Support'>
                        <legend>Request Technical Support</legend>
                     <?php 
                        $current->HelpDeskID = "new1"; 
                        include($boss->getPath('/templates/TechSupport.php'));
                        ?>
                     </fieldset>
                  </form>
               </li>
            </ul>
            <li>Online Account</li>
            <ul>
               <li>
                  <form id="OnlineAccountRequest" rel="HelpDesk">
                     <input type='hidden' name='pid' id='231' value='231' />
                     <fieldset title='Customer Information'>
                        <legend>Request Customer Online Account</legend>
                     <?php 
                        $current->HelpDeskID = "new1"; 
                        include($boss->getPath('/templates/OnlineAccount.php'));
                        ?>
                     </fieldset>
                  </form>
               </li>
               <!--ul>
                  <li class='data'>Customer</li>
                  <li class='data'>Customer Number</li>
                  <li class='data'>Access Type (Regular, Boutique, Special)</li>
               </ul-->
            </ul>
            <li title="The manager of the new employee initiates this request to IT">New Hardware/Software</li>
            <ul>
              <li class='task'>Review and fulfill hardware/software requirements</li>
              <li class='condition'>If asset &gt; $2000</li>
              <ul>
                <li class='task'>Obtain approval and PAR from Finance</li>
                <li class='task'>Generate PO and relate to PAR</li>
                <li class='task'>Assign asset to employee or department</li>
                <li class='task'>Notify Accounting to zero out PAR</li>
              </ul>
              <li class='condition'>If asset &lt; $2000</li>
              <ul>
                <li class='task'>Generate PO</li>
                <li class='task'>Assign asset to employee or department</li>
              </ul>
              <li class='condition'>For computers</li>
              <ul>
                <li class='task'>Review computer checklist for software</li>
                <li class='task'>Install OS and applications</li>
                <li class='task'>Setup Printers</li>
              </ul>
            </ul>
            <li title="HR requests from IT">Setup New Employee</li>
            <ul>
              <li class='request'>New Sanrio employee WITH email</li>
              <ul>
                <li class='task'>Complete employee setup checklist</li>
                <ul>
                  <li class='task' title="Look in UserAccounts table for new accounts to setup">Setup account in Active Directory</li>
                  <li class='task optional'>Create Kitty login</li>
                  <li class='task optional'>Create online user account</li>
                  <li class='task optional'>Create Crystal user</li>
                  <li class='task optional'>Add to appropriate distribution lists</li>
                  <li class='task optional'>Create Concur Account</li>
                  <li class='task optional'>VPN</li>
                </ul>
              </ul>
              <li class='request'>New Sanrio employee WITHOUT email</li>
              <ul>
                <li class='task optional'>Setup account in Active Directory</li>
                <li class='task optional'>Add to appropriate distribution lists</li>
              </ul>
              <li class='request'>New <u>Non-Sanrio</u> Employee</li>
              <ul>
                <li class='task'>Add to GAL</li>
              </ul>
              <li class='request'>Assign hardware/asset</li>
              <ul>
                <li class='task'>New asset - see above</li>
                <li class='task'>Used asset - relocate from previous employee/department</li>
              </ul>
            </ul>
            <li class='request' title="HR requests from IT">Terminate Employee</li>
            <ul>
              <li class='task'>Disable Active Directory account. Reset password.</li>
              <li class='task'>Deliver equipment list to HR</li>
              <li class='task'>Remove from distribution lists</li>
              <li class='task'>Disable all accounts</li>
            </ul>
         </ul>
      </div>
   </body>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
   <script type='text/javascript'>
      $.fn.serializeObject = function() {
          var o = {};
          var a = this.serializeArray();
          $.each(a, function() {
            var parts = this.name.match(/(\w+)\[(\w+)\]\[(\w+)\]/);
            if (parts) {
               if (!o[parts[0]]) o[parts[0]] = [];
               if (!o[parts[0]][parts[1]]) o[parts[0]][parts[1]] = {};
               o[parts[0]][parts[1]][parts[2]] = this.value;
            } else {
               o[this.name] = this.value;
            }
          });
          return o;
      };
      $(document).ready(function() {
         $("li").each(function() { if ($(this).next().is('ul')) { $(this).addClass("closed"); }});
         $("li").click(function() { if ($(this).next().is('ul')) { $(this).toggleClass("closed").toggleClass("open").next('ul').toggle(250);} });
         $("#expandAll").click(function() { $("li").removeClass("closed").addClass("open").next('ul').show(250);});
         $("#collapseAll").click(function() { $("li").removeClass("open").addClass("closed").next('ul').hide(250);});
         $("li > a").click(function(event) { 
            if ($(this).attr('href').match(/mailto:/)) return true;
            parent.loadUrl($(this).attr('href'), $(this).text(), $(this).attr('target')); 
            event.preventDefault();
            event.stopPropagation(); 
            return false;
            }); 
         // $(".textBox").parent().html("");
         $("form fieldset").append("<button class='add'>Save</button>");
         $("form").submit(function(event) {
            //var data = { data: $(this).serializeObject(), x: "save", rsc:$(this).attr('rel') }
            var x = $(this).serialize();
            $.post("/grid/ctl.php?x=save&rsc="+$(this).attr('rel'), $(this).serialize(), function(data) {
               $("body").append(data); 
               alert("Save was successful.");
               $("li").each(function() { if ($(this).next().is('ul')) { $(this).addClass("closed"); }});
            });
            event.preventDefault();
            event.stopPropagation(); 
            return false;
         });
      });
   </script>
</html>
