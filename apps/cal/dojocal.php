<?php
   //require_once("boss_class.php");
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");

   $boss = new boss();

   $boss->db->addResource('Calendar');
   $boss->db->Calendar->getlist();
   
   $events = $boss->db->Calendar->Calendar;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
	<title>Calendar</title>
	<meta http-equiv="X-UA-Compatible" content="IE=7"/>
	<link rel="stylesheet" href="/code/dojocal/js/dijit/themes/dijit.css" type="text/css"/>
	<link rel="stylesheet" href="/code/dojocal/js/dijit/themes/tundra/tundra.css" type="text/css"/>
	<link rel="stylesheet" href="/code/dojocal/js/dojoc/dojocal/resources/Grid.css" type="text/css"/>
	<link rel="stylesheet" href="/code/dojocal/js/dojoc/dojocal/resources/Event.css" type="text/css"/>
	<script src="/code/dojocal/js/dojo/dojo.js.uncompressed.js" type="text/javascript" djconfig=""></script>
	<script src="/code/dojocal/js/dijit/dijit.js.uncompressed.js" type="text/javascript"></script>
	<!-- temporaricode/dojocalncluding all dijits for test controls -->
	<script src="/code/dojocal/js/dijit/dijit-all.js.uncompressed.js" type="text/javascript"></script>
	<script src="/code/dojocal/js/dojoc/dojocal/Grid.js" type="text/javascript"></script>
	<script src="/code/dojocal/js/dojoc/dojocal/ViewSwitcher.js" type="text/javascript"></script>
	<script type="text/javascript">
		dojo.require('dojo.date.stamp');
		dojo.require('dojoc.dojocal.SlickGrid');
		dojo.addOnLoad(function () {
			// set theme
			dojo.addClass(dojo.body(), 'tundra');
			// create widgets
			dojo.parser.parse();
			// create user calendars and add to dojocal
			var baseDate = dojoc.dojocal.dateOnly(new Date()),
				dojocal = dijit.byId('cal'),
				firstUserCalendar = new dojoc.dojocal.UserCalendar({id: 'firstCal', color: '#661100', fontColor: '#665500'}),
//				firstUserCalendar = new dojoc.dojocal.UserCalendar({id: 'firstCal', color: '#eeaaff', fontColor: '#444400'}),
				secondUserCalendar = new dojoc.dojocal.UserCalendar({id: '2ndCal', color: '#001166', fontColor: '#005566'});
			firstUserCalendar.defaultEventClass = 'dojoc.dojocal.InplaceEditableEvent';
			firstUserCalendar.addEvents(
				[
               <?php 
                  $jsevents = Array();
                  foreach ($events as $event) {
                     if ($event->LoginID=='1') {
                        $out = "{startDateTime: '".preg_replace("/\s/", "T", $event->StartDateTime)."Z',";
                        $out .= "duration: ".$event->Duration.",";
                        $out .= "summary: '".$event->Calendar."',";
                        $out .= "description: '".$event->Notes."'}";
                        $jsevents[] = $out;
                     }
                  }
                  print join(",", $jsevents);
               ?>
				]
			);
			secondUserCalendar.addEvents(
				[
               <?php 
                  $jsevents = Array();
                  foreach ($events as $event) {
                     if ($event->LoginID=='3') {
                        $out = "{startDateTime: '".preg_replace("/\s/", "T", $event->StartDateTime)."Z',";
                        $out .= "duration: ".$event->Duration.",";
                        $out .= "summary: '".$event->Calendar."',";
                        $out .= "description: '".$event->Notes."'}";
                        $jsevents[] = $out;
                     }
                  }
                  print join(",", $jsevents);
               ?>
				]
         );
			function addCalEvents () {
				dojocal.addCalendar(firstUserCalendar);
				dojocal.addCalendar(secondUserCalendar);
			}
			addCalEvents();
			// set up testing widgets
			var liveWidgets = dojo.query('.liveWidget').map(dijit.byNode),
				staticWidgets = dojo.query('.staticWidget').map(dijit.byNode);
			function callCalFunc (w, func) {
				console.log('calling dojocal method: ', func, w.getValue());
				dojocal[func](w.getValue());
			}
			function setCalProp (w, prop) {
				console.log('setting dojocal property: ', prop, w.getValue());
				dojocal[prop] = w.getValue();
			}
			function recreateCal () {
				var props = {'class': 'myDojocal'};
				dojo.forEach(staticWidgets.concat(liveWidgets), function (w) {
					if (w.id.substr(0, 3) != 'set')
						props[w.id] = w.getValue();
				});
				props['weekStartsOn'] = parseInt(dojo.byId('weekStartsOn').value);
				props['dndMode'] = parseInt(dojo.byId('dndMode').value);
				console.log('re-creating grid: ', props);
				var newCal = new dojoc.dojocal.Grid(props);
				dojo.place(newCal.domNode, dojocal.domNode, 'after');
				dojo.forEach(staticWidgets.concat(liveWidgets), function (w) {
					if (w.id.substr(0, 3) == 'set') {
						newCal[w.id](w.getValue());
					}
				});
				newCal.startup(); // after adding to document so rendering works!
				dojocal.destroy();
				dojocal = newCal;
				addCalEvents();
			}
			dojo.forEach(liveWidgets, function (w) {
				var func = w.id.substr(0, 3) == 'set' ? dojo.partial(callCalFunc, w, w.id) : dojo.partial(setCalProp, w, w.id);
				dojo.connect(w, 'onChange', func);
			});
			dojo.connect(dijit.byId('recreateGrid'), 'onClick', recreateCal);
			dojo.connect(dojo.byId('viewMode'), 'change', function (e) {
				console.log('switching view: ', e.target.value);
				dojocal.setViewMode(parseInt(e.target.value));
			});
			dojo.connect(dijit.byId('fontSize'), 'onChange', dijit.byId('fontSize'), function (e) {
				var time = dojocal.getStartOfDay(true);
				dojocal.domNode.style.fontSize = this.getValue() + 'px';
				dojocal.setStartOfDay(time);
			});
		});
	</script>
	<style>
		body {
			font-family: Arial, sans-serif;
			font-size: 16px;
			margin: 0;
			padding: 0;
		}
		html.dj_ie,
		.dj_ie body {
			font-size: 100%;
			height: 100%;
			width: 100%
		}
		.myDojocal {
			position: absolute;
			top: 0px;
			bottom: 8px;
			left: 300px;
			right: 8px;
			border: 1px solid #ccc;
		}
		.dj_ie .myDojocal {
			right: ;
			bottom: ;
			height: expression(document.body.clientHeight - offsetTop - 8 + 'px');
			width: expression(document.body.clientWidth - offsetLeft - 8 + 'px');
		}
		.mySwitcher {
			white-space: nowrap;
		}
		.myParamsContainer .p {
			line-height: 1.5em;
			margin: 4px 0;
		}
		.myParamsContainer {
			/* TODO: fix for IE6 */
			position: absolute;
			top: 4px;
			left: 4px;
			bottom: 4px;
			padding: 0 4px;
			border: 1px solid #aaa;
			background-color: #f0f0f0;
			width: 276px;
			font-size: 75%;
			overflow-y: auto;
			overflow-x: hidden;
			vertical-align: baseline;
		}
		.myTitleArea {
			position: absolute;
			top: 0;
			left: 0px;
			height: 64px;
		}
		.hint {
			color: #aaa;
			font-size: 80%;
		}
		h3 {
			margin-bottom: 0;
		}
	</style>
</head>

<body>

	<div class="myParamsContainer">

		<h3>Live parameters:</h3>
		<div class="hint">(these update immediately)</div>

		<div class="liveParams">
			<div class="p">
				viewMode:
				<select id="viewMode" style="width: 8em;">
					<option value="1">Day</option>
					<option value="2" selected="selected">Week</option>
					<option value="3">Month</option>
				</select>
				<!--<div dojoType="dojoc.dojocal.ViewSwitcher" viewModes="['day','week']" class="liveParams mySwitcher" id="viewMode"></div>-->
			</div>
			<div class="p">
				userChangeResolution:
				<div dojoType="dijit.form.NumberSpinner" class="liveWidget" value="15" smallDelta="5" class="liveParams" style="width: 7.5em;" id="userChangeResolution" intermediateChanges="true"></div>
				<div class="hint">try 5, 15, or 30</div>
			</div>
			<div class="p">
				animationDuration:
				<div dojoType="dijit.form.NumberSpinner" class="liveWidget" value="250" smallDelta="50" class="liveParams" largeDelta="250" style="width: 7.5em;" id="animationDuration" intermediateChanges="true"></div>
				<div class="hint">try 250 or 500 (or even 5000 to watch, but <br/>click on a day with events first!)</div>
			</div>
			<div class="p">
				date:
				<div dojoType="dijit.form.DateTextBox" class="liveWidget" value="" style="width: 7.5em;" class="liveParams" id="setDate" intermediateChanges="true"></div>
			</div>
			<div class="p">
				base fontSize (via CSS):
				<div id="fontSize" class="" dojoType="dijit.form.NumberSpinner" value="16" constraints="{max:24,min:6}" style="width: 7.5em;" intermediateChanges="true"></div>
				<div class="hint">(the grid's scrollTop needs to be reset after changing font size)</div>
			</div>
		</div>

		<hr>

		<div class="p" style="float: right;">
			<div id="recreateGrid" dojoType="dijit.form.Button" label="Re-create grid"></div>
		</div>
		<h3>Static parameters:</h3>
		<div class="hint">(click "Re-create grid" button to see changes)</div>

		<div class="staticParams">
			<div class="p">
				minutesPerGridLine:
				<div id="minutesPerGridLine" class="staticWidget" dojoType="dijit.form.NumberSpinner" value="15" smallDelta="5" class="staticParams" style="width: 7.5em;"></div>
			</div>
			<div class="p">
				initialStartTime:
				<div id="initialStartTime" class="staticWidget" dojoType="dijit.form.NumberSpinner" value="480" smallDelta="15" largeDelta="60" class="staticParams" style="width: 7.5em;"></div>
			</div>
			<div class="hint">(date/time patterns are in dojo.date.locale)</div>
			<div class="p">
				timeCellDatePattern:
				<div id="timeCellDatePattern" class="staticWidget" dojoType="dijit.form.TextBox" value="h:mm a" class="staticParams" style="width: 8em;"></div>
			</div>
			<div class="p">
				dayHeaderDatePattern:
				<div id="dayHeaderDatePattern" class="staticWidget" dojoType="dijit.form.TextBox" value="EEEE MMMM dd, yyyy" class="staticParams" style="width: 8em;"></div>
			</div>
			<div class="p">
				weekHeaderDatePattern:
				<div id="weekHeaderDatePattern" class="staticWidget" dojoType="dijit.form.TextBox" value="EEE M/dd" class="staticParams" style="width: 8em;"></div>
			</div>
			<div class="p">
				cornerCellDatePattern:
				<div id="cornerCellDatePattern" class="staticWidget" dojoType="dijit.form.TextBox" value="yyyy" class="staticParams" style="width: 8em;"></div>
			</div>
			<div class="p">
				allDayEventAreaLabel:
				<div id="allDayEventAreaLabel" class="staticWidget" dojoType="dijit.form.TextBox" value="All Day" class="staticParams" style="width: 8em;"></div>
			</div>
			<div class="p">
				weekStartsOn:
				<select id="weekStartsOn" style="width: 8em;">
					<option value="0">Sunday</option>
					<option value="1">Monday</option>
					<option value="2">Tuesday</option>
					<option value="3">Wednesday</option>
					<option value="4">Thursday</option>
					<option value="5">Friday</option>
					<option value="6">Saturday</option>
				</select>
			</div>
			<div class="p">
				dndMode:
				<select id="dndMode" style="width: 8em;">
					<option value="0">None</option>
					<option value="1" selected="selected">Discrete</option>
					<option value="2">Fluid</option>
				</select>
			</div>
			<!--<div class="p">-->
				<!--allowDragAndDrop:-->
				<!--<div id="allowDragAndDrop" disabled="disabled" class="staticWidget" dojoType="dijit.form.CheckBox" class="staticParams" checked="true" value="true"></div>-->
			<!--</div>-->
		</div>
	</div>

	<div class="myTitleArea">
	</div>


	<div id="cal" dojoType="dojoc.dojocal.SlickGrid" class="myDojocal" viewMode="WEEK"></div>


</body>

</html>
