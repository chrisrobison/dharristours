<?php
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");

   $boss->db->addResource('JobCal');
   $boss->db->JobCal->getlist();//gets clamps...CLLAAAMMMPPP
   $events = $boss->db->JobCal->JobCal;
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
   <link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/dojo/1.5/dijit/themes/claro/claro.css" />
	
   <script src="/code/dojocal/js/dojo/dojo.js.uncompressed.js" type="text/javascript" djconfig=""></script>
	<script src="/code/dojocal/js/dijit/dijit.js.uncompressed.js" type="text/javascript"></script>
	<!-- temporariy including all dijits for test controls -->
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
				firstUserCalendar = new dojoc.dojocal.UserCalendar({id: 'firstCal', color: '#001166', fontColor: 'black'}),
//				firstUserCalendar = new dojoc.dojocal.UserCalendar({id: 'firstCal', color: '#eeaaff', fontColor: '#444400'}),
				secondUserCalendar = new dojoc.dojocal.UserCalendar({id: '2ndCal', color: '#001166', fontColor: '#005566'});
			firstUserCalendar.defaultEventClass = 'dojoc.dojocal.InplaceEditableEvent';
			firstUserCalendar.addEvents(
				[
               <?php 
                  $jsevents = Array();
                  foreach ($events as $event) {
                     if ($event->LoginID=='0') {
//                        $start = date("c", strtotime($event->StartDateTime));
                        $start = date("c", strtotime($event->StartDateTime));
                        $out = "{startDateTime: '".$start."',";
                        $out .= "duration: ".$event->Duration.",";
                        $out .= "summary: ' ".$event->NumberOfItems." Driver ".$event->Employee." JobID ".$event->JobID."',";
//                        $out .= " ' ".$event->Description."',";
                        $out .= "description: '".$event->JobID."',";
                        $out .= "color: '".$event->Color."'}";
//                        $out = "{startDateTime: '".preg_replace("/\s/", "T", $event->StartDateTime)."Z',";
//                        $out .= "duration: ".$event->Duration.",";
//                        $out .= "summary: '".$event->Calendar."',";
//                        $out .= "description: '".$event->Notes."'}";
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
                     if ($event->LoginID!='0') {
                        $start = date("c", strtotime($event->StartDateTime));
                        $out = "{startDateTime: '".$start."',";
                        $out .= "duration: ".$event->Duration.",";
                        $out .= "summary: ' ".$event->NumberOfItems." Driver ".$event->Employee."',";
                        $out .= "description: '".$event->JobID."',";
                        $out .= "color: '".$event->Color."'}";
//                        $out = "{startDateTime: '".preg_replace("/\s/", "T", $event->StartDateTime)."Z',";
//                        $out .= "duration: ".$event->Duration.",";
//                        $out .= "summary: '".$event->Calendar."',";
//                        $out .= "description: '".$event->Notes."'}";
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
				// props['weekStartsOn'] = parseInt(dojo.byId('weekStartsOn').value);
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
		   left: 180px;
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
			float: left;
         position: relative;
			top: 4px;
			left: 4px;
			bottom: 4px;
			padding: 0 4px;
			border: 1px solid #aaa;
			background-color: #f0f0f0;
			width: 180px;
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

	<div class="myParamsContainer collapsed">

		<h3>Parameters:</h3>
		<div class="liveParams">
			<div class="p">
				view:
				<select id="viewMode" style="width: 8em;">
					<option value="1" selected="selected">Day</option>
					<option value="2">Week</option>
					<option value="3">Month</option>
				</select>
				<!--<div dojoType="dojoc.dojocal.ViewSwitcher" viewModes="['day','week']" class="liveParams mySwitcher" id="viewMode"></div>-->
			</div>
			<div class="p">
				date:
				<div dojoType="dijit.form.DateTextBox" class="liveWidget" value="" style="width: 7.5em;" class="liveParams" id="setDate" intermediateChanges="true"></div>
			</div>
		</div>

		<hr>

	</div>

	<div class="myTitleArea">
	</div>


	<div id="cal" dojoType="dojoc.dojocal.SlickGrid" class="myDojocal" viewMode="DAY"></div>


</body>

</html>
