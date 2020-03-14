       <div dojoType="dijit.layout.BorderContainer" style="width: 100%; height: 100%;">
            <div dojoType="dijit.layout.ContentPane" region="top">
                <img src="/img/pt_bus.png" style="float:right;padding-right:25px;"  height="50" border="0" />
                <img src="/img/pt_logo.png" border="0" />
            </div>
            <div dojoType="dijit.layout.AccordionContainer" region="leading">
                <div dojoType="dijit.layout.AccordionPane" title="Customers">
                   <ul class='nav'>
                      <li><a rel='nav' href="Business">Companies List</a></li>
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

