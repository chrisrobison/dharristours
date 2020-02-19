/*
	Copyright (c) 2004-2009, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/

/*
	Author: unscriptable
	Date: Dec 5, 2008
*/
dojo.provide('dojoc.dojocal.Grid');

dojo.require('dojoc.dojocal._base.common');
dojo.require('dijit._Templated');
dojo.require('dijit._Widget');
dojo.require('dojo.fx');
dojo.require("dojo.date");
dojo.require('dojo.date.locale');
dojo.require('dojo.dnd.Moveable');

(function () { // closure for local variables

// bring these local for speed, size, and convenience
var djc = dojoc.dojocal,
	viewModes = djc.ViewModes,
	dndModes = djc.DndModes,
	allDayEventsPositions = djc.AllDayEventPositions;

dojo.declare('dojoc.dojocal.Grid', [dijit._Widget, dijit._Templated], {
	/**
	 * summary: the main dojocal widget used to display a day, week, or month view of a user's calendar events
	 * requires: dojo 1.1.1 / dijit 1.1.1 or higher
	 * TODO:
	 * - finish transitions to/from MONTH view
	 * - visual resize of events
	 * - Move views into separate widget classes so they can be created dynamically
	 * - Intelligent overlap:
	 *     - Figure out bugs when events span multiple groups
	 * - Use Adam Peller's CLDR functions to automatically grab the locale's start of week and weekend days?
	 * - When dragging in day view, the week view is not updated (use data store notifications?)
	 * - Finish All Day row
	 *   - Add dblclick functionality to splitter (collapse/uncollapse)
	 *   v Gray-out background when footer will close (in addition to current font graying)
	 *   - Add ability to add events to it
	 * - Add demo/testing features:
	 *   v Add functionality to switch view
	 * 	 v grid line increment changer
	 *   v time/date format changer
	 * 	 v font resizer
	 *   - theme-switching
	 * - Future demo/testing features:
	 *   - inline edit
	 *   - navigation control
	 * - Investigate iCal format coming from the data store
	 * - Create monthly view
	 */

	templatePath: dojo.moduleUrl('dojoc.dojocal', 'resources/Grid.html'),

	// minutesPerGridLine: Integer
	// number of minutes between horizontal grid lines
	minutesPerGridLine: 15,

	// userChangeResolution: Integer
	// resolution of user changes (e.g. drag and drop) in minutes
	// changes smaller than this are rounded up or down
	userChangeResolution: 15,

	// initialStartTime: Integer
	// number of minutes to scroll from midnight when displaying calendar.  use 450 for 7:30 AM, 780 for 1:00 PM
	initialStartTime: 480,

	// viewMode: dojoc.dojocal.ViewModes
	// Note: leave as blank string in this declaration so dijit does not try to force string attributes to numbers
	viewMode: '',

	// animationDuration: Number
	// the duration of any animations used by the grid
	animationDuration: 250,

	// timeCellDatePattern: String
	// the dojo.date.locale-formatted date string used in the time column on day and week views
	timeCellDatePattern: 'h:mm a',

	// dayHeaderDatePattern: String
	// the dojo.date.locale-formatted date string used in the date header on day view
	dayHeaderDatePattern: 'EEEE MMMM dd, yyyy',

	// weekHeaderDatePattern: String
	// the dojo.date.locale-formatted date string used in the date header on week view
	weekHeaderDatePattern: 'EEE M/dd',

	// monthHeaderDatePattern: String
	// the dojo.date.locale-formatted date string used in the date header on week view
	monthHeaderDatePattern: 'EEE',

	// monthCellDatePattern: String
	// the dojo.date.locale-formatted date string used in the date header on each month cell
	monthCellDatePattern: 'd',

	// monthCellOneDatePattern: String
	// the dojo.date.locale-formatted date string used in the date header on the first
	// month cell that fals within a month (the month view spans slightly more than 1 month)
	monthCellOneDatePattern: 'MMM d',

	// cornerCellDatePattern: String
	// the dojo.date.locale-formatted date string used in the upper left corner in all views
	cornerCellDatePattern: 'yyyy',

	// allDayEventAreaLabel: String
	// the label to show in the "All Day" events area time column
	allDayEventAreaLabel: 'All Day',

	// date: String
	// set this to the dojocal's initial date (ISO-formatted date string)
	date: '',

	// weekStartsOn: Integer
	// the day that weeks should start on
	// 0 = sunday, 1 = monday, etc.
	// Hint: use dojo.cldr.supplemental.getFirstDayOfWeek() to let this adjust automatically
	// to the user's browser locale
	//weekStartsOn: new Date().getDay(),
   weekStartsOn: 0,

	// weekDaysShown: String|Array
	// set this to show or hide certain days in the applicable views (e.g. hide weekends)
	// example: '0,1,2,3,4,5,6' shows all days,
	// example: '1,2,3,4,5' shows Mon to Fri when weekStartsOn == 0 (Sun)
	// Hint: use dojo.cldr.supplemental.getWeekend to determine weekend days for the
	// user's browser locale
	// TODO: implement this weekDaysShown
	weekDaysShown: true,

	// defaultEventClass: String
	// a fully-qualified dijit class to be used to create new event widgets
	// TODO: use this when auto-creating events from data store? or remove this?
	defaultEventClass: 'dojoc.dojocal.Event',

	// dndMode: dojoc.dojocal.DndModes
	// level of drag and drop:
	//   dojoc.dojocal.DndModes.NONE -- drag and drop is not enabled
	//   dojoc.dojocal.DndModes.FLUID -- drag and drop uses a free-form method to allow smoother dragging
	//   dojoc.dojocal.DndModes.DISCRETE -- drag and drop snaps to valid positions only
	dndMode: dndModes.DISCRETE,

	// dndDetectDistance: Number
	// the distance a user must drag before a drag and drop operation is detected
	dndDetectDistance: 3,

	// dndFluidSnapThreshold: Integer
	// pixels to move before an event widget stops clinging to current day or time (for fluid dnd)
	dndFluidSnapThreshold: 25,

	// splitterMinHeight: String
	// the splitters may not be sized any smaler than this height.
	// use any css measurement (except %). e.g. 2.5em, 40px, 24pt, etc.
	splitterMinHeight: '2em',

	// splitterMaxHeight: String
	// the splitters may be opened to this height.
	// use any css measurement (except %). e.g. 2.5em, 40px, 24pt, etc.
	splitterMaxHeight: '10em',

	// splitterIsCollapsible:  Boolean
	// the splitters will collapse if the user drags them below splitterMinHeight
	splitterIsCollapsible: true,

	// eventPositionerClass: String
	// use this prperty to create your own event positioner
	// see dojoc.dojocal._base.EventPositioner for more info
	eventPositionerClass: 'dojoc.dojocal._base.EventPositioner',

	// internal properties
	_weekStartDate: null,
	_weekdayColNum: 0,

	/***** public methods *****/

	setViewMode: function (/* dojoc.dojocal.ViewModes|String|Number */ newMode) {
		// summary: switches the grid to the new viewMode
		//
		// newMode: dojoc.dojocal.ViewModes
		// one of the valid view modes specified in dojoc.dojocal.ViewModes
		// (or a String or Number that matches one)
		newMode = djc.fixViewMode(newMode);
		var oldMode = this.viewMode;
		this._switchView(oldMode, newMode, true);
		this.viewMode = newMode;
	},

	setDate: function (/* Date|String? */ date) {
		// summary: sets the new date for the grid and adjust the current view accordingly
		if (!date)
			date = new Date();
		else if (dojo.isString(date))
			date = new Date(date);
		var prevDate = this.date,
			prevWeekStartDate = this._weekStartDate,
			prevMonthStartDate = this._monthStartDate;
		this.date = djc.dateOnly(date);

		// calc start dates for multi-day views (week, month)
		this._weekStartDate = dojo.date.add(this.date, 'day', -this.date.getDay() + this.weekStartsOn);
		if (this._weekStartDate.getMonth() != this.date.getMonth()) // week started in the prev month
			this._monthStartDate = this._weekStartDate;
		else
			this._monthStartDate = dojo.date.add(this._weekStartDate, 'day', -Math.ceil((this._weekStartDate.getDate() - 1) / 7) * 7);

		// if the day changed
		if (!prevDate || dojo.date.compare(prevDate, this.date) != 0) {
			this._prevWeekdayColNum = this._weekdayColNum;
			this._weekdayColNum = this.date.getDay() - this.weekStartsOn;
			// reload day view
			this._setDayHeaderDate();
			this._setCornerHeaderDate();
			this._setTimeColumnDates(); // TODO: does this really belong here?
			this._removeAllEventsFromView(this.dayColumnLayout);
			this.dayColumnLayout.setAttribute('day', this.date.getDay());
			djc.getAncestorByTagName(this.dayHeaderDateNode, 'TD').setAttribute('day', this.date.getDay());
			this.dayFooterColumnLayout.setAttribute('day', this.date.getDay());
			this._loadEventsIntoView(viewModes.DAY);
			this._checkDayHighlighting();
			this._checkEventOverlapping(this.dayColumnLayout, viewModeMap[viewModes.DAY].isExpanded);
			this._checkTodayHighlighting();
		}

		// if the week changed
		if (!prevWeekStartDate || dojo.date.compare(prevWeekStartDate, this._weekStartDate) != 0) {
			this._setWeekHeaderDates();
			this._setCornerHeaderDate();
			this._setTimeColumnDates(); // TODO: does this really belong here?
			// TODO: make this and the next 2 methods have consistent signatures
			this._removeAllEventsFromView(this.weekTableNode);
			this._loadEventsIntoView(viewModes.WEEK);
			dojo.forEach(this.weekDayLayouts, function (layout) {
				this._checkEventOverlapping(layout, viewModeMap[viewModes.WEEK].isExpanded);
			});
		}

		// if month changed
		// Note: don't change the month view if we're currently viewing it and the new date is still
		// visible (_monthStartDate should not change in this case)
		if (!prevMonthStartDate || dojo.date.compare(prevMonthStartDate, this._monthStartDate) != 0) {
			this._setMonthHeaderDates();
			this._setMonthCellHeaderDates();
			this._setCornerHeaderDate();
//			this._removeAllEventsFromView(this.monthTableNode); // TODO: make this and the next method have consistent signatures
//			this._loadEventsIntoView(viewModes.MONTH);
			this._checkDayHighlighting();
			this._checkTodayHighlighting();
		}
	},

	setStartOfDay: function (/* Number */ minuteOfDay) {
		// summary: scrolls the top of the day and week views to the hour of the day specified.
		// minuteOfDay: Number
		//   the minute of the day. e.g. 450 (min) == 7.5 (hr) * 60 == 7:30 am
		// TODO: allow user to pass "auto" to try to scroll as many imminent events into view???
		this._scrollToTime(minuteOfDay);
	},

	getStartOfDay: function (/* Boolean? */ exact) {
		// summary: returns the minute of the day to which the day and week views are currently scrolled
		//   (see setStartOfDay)
		// exact: set to true to return as precise a result as possible, omit or set to false to return the value
		//   rounded to the nearest minute
		var min = this.weekContainerNode.scrollTop / this.weekBodyNode.offsetHeight * djc.minutesPerDay;
		return exact ? Math.round(min * 60) / 60 : min;
	},

	addCalendar: function (/* dojoc.dojocal.UserCalendar */ calendar) {
		// summary:
		// adds a manually created (non-data-store) calendar of events to the grid
		// and automatically shows events in the pertinent views
		this._calendars.push(calendar);
		this.connect(calendar, 'onChangeEvent', '_onCalendarChangeEvent');
		dojo.forEach(calendar.getEvents(), function (event) {
			// TODO: is the right way to ensure we have this class loaded?
			// use dojo['require'] instead of dojo.require to prevent the build system from trying to bake-in anything
			dojo['require'](event.options.eventClass);
			var viewsMap = this._whereIsUserEventDisplayable(event.data);
			if ('DAY' in viewsMap) {
				var ewDay = this._createEventWidget(event, calendar);
				this._addEventToDayView(ewDay);
				ewDay.startup();
			}
			if ('WEEK' in viewsMap) {
				var ewWeek = this._createEventWidget(event, calendar);
				this._addEventToWeekView(ewWeek);
				ewWeek.startup();
			}
		}, this);
		// fix any overlapping events
		this._checkEventOverlapping(this.dayColumnLayout, viewModeMap[viewModes.DAY].isExpanded);
		dojo.forEach(this._weekDayLayouts, function (layout) {
			this._checkEventOverlapping(layout, viewModeMap[viewModes.WEEK].isExpanded);
		}, this);
	},

	removeCalendar: function (/* dojoc.dojocal.UserCalendar|String */ calendarOrId) {
		// summary:
		// manually removes a caendar of events and automatically removes the events
		// from all of the views
		var pos = this._findCalendarPos(calendarOrId);
		this._calendars.splice(pos, 1);
		// TODO: remove event widgets from views
	},

	/***** public event hooks *****/

	// onDayClick: Function
	// connect to this event to capture user clicks on the day cells
	onDayClick: function (e, date) {},

	// onHeaderClick: Function
	// connect to this event to capture user clicks on the header cells
	onHeaderClick: function (e, date) {},

	// onHeaderDblClick: Function
	// connect to this event to capture user double-clicks on the header cells
	onHeaderDblClick: function (e, date) {},

	// TODO: add many more public event hooks

	/***** overrides *****/

	postCreate: function () {
		this.inherited(arguments);
		// create helper objects
		if (this.eventPositionerClass) {
			dojo['require'](this.eventPositionerClass);
			var ePosClass = dojo.getObject(this.eventPositionerClass);
			this._eventPositioner = new ePosClass();
		}
		// collections
		this._calendars = [];
		// make all text unselectable (event widgets should make their text selectable only when/if they are being edited in-place)
		dojo.setSelectable(this.domNode, false);
		// create programmatic dom elements
		this._fixHeaders();
		this._createHourlyRows();
		this._createMonthRows();
		this._prepareSplitters();
		// collect day layout elements (because we use them often)
		this._weekDayLayouts = dojo.query('.dojocalDayColumnLayout', this.weekTableNode);
		this._weekAllDayLayouts = dojo.query('.dojocalDayColumnLayout', this.weekFooterNode);
		// clean up the date property (and set all date-related element texts)
		this.setDate(this.date);
		// set the initial view
		this.viewMode = djc.fixViewMode(this.viewMode);
		this._switchView(null, this.viewMode, false);
		// create periodic updater
		this._updaterTimer = setInterval(dojo.hitch(this, this._updateToCurrentTime), 5000);
	},

	startup: function () {
		this.inherited(arguments);
		this._scrollToTime(this.initialStartTime);
		this._checkTodayHighlighting();
		this._updateToCurrentTime();
	},

	destroy: function () {
		clearInterval(this._updaterTimer);
		delete this._weekDayLayouts;
		delete this._weekAllDayLayouts;
		if (this.weekSplitterMoveable)
			this.weekSplitterMoveable.destroy();
		this.inherited(arguments);
	},

	/***** rendering methods *****/

	_fixHeaders: function(/* Boolean */ force) {
//		// summary:
//		//   fixes the missing horizontal space in header caused by the scroll bar in the calendar body
//		if (!this._isFixedHeaders || force) {
//			this.weekHeaderWrapper.style.paddingRight = djc.getScrollbarWidth() + 'px';
//			this.weekFooterWrapper.style.paddingRight = djc.getScrollbarWidth() + 'px';
//			this.dayHeaderWrapper.style.paddingRight = djc.getScrollbarWidth() + 'px';
//			this.dayFooterWrapper.style.paddingRight = djc.getScrollbarWidth() + 'px';
//			this._isFixedHeaders = true;
//		}
	},

	_setMonthHeaderDates: function () {
		var date = new Date(this._weekStartDate);
		dojo.query('.dojocalDateCellText', this.monthHeaderTable).forEach(function (node) {
			node.innerHTML = dojo.date.locale.format(date, {selector: 'date', datePattern: this.monthHeaderDatePattern});
			// 0 = Sunday. don't store date object on node because IE will leak memory
			djc.getAncestorByTagName(node, 'TD').setAttribute('day', date.getDay().toString());
			date = dojo.date.add(date, 'day', 1);
		}, this);
	},

	_setWeekHeaderDates: function () {
		var date = new Date(this._weekStartDate);
		// Note: we're doing two dojo.query's since Nodelist.concat is b0rked for Safari 3.2+ until dojo 1.2.3
		dojo.query('.dojocalDateCellText', this.weekHeaderTable).forEach(function (node) {
			node.innerHTML = dojo.date.locale.format(date, {selector: 'date', datePattern: this.weekHeaderDatePattern});
			// 0 = Sunday. don't store date object on node because IE will leak memory
			djc.getAncestorByTagName(node, 'TD').setAttribute('day', date.getDay().toString());
			date = dojo.date.add(date, 'day', 1);
		}, this);
	},

	_setDayHeaderDate: function () {
		this.dayHeaderDateNode.innerHTML = dojo.date.locale.format(this.date, {selector: 'date', datePattern: this.dayHeaderDatePattern});
	},

	_setCornerHeaderDate: function () {
		if (this.cornerCellDatePattern != null) {
			var dateString = dojo.date.locale.format(this._weekStartDate, {selector: 'date', datePattern: this.cornerCellDatePattern});
			dojo.query('.dojocalDateLeader .dojocalDateCellText', this.domNode).forEach(function (node) {
				node.innerHTML = dateString;
			}, this);
		}
	},

	_setTimeColumnDates: function () {
		var date = new Date(this._weekStartDate);
		dojo.query('.dojocalTimeCellText', this.domNode).forEach(function (node) {
			date.setHours(node.parentNode._hour, 0, 0);
			node.innerHTML = dojo.date.locale.format(date, {selector: 'time', timePattern: this.timeCellDatePattern});
		}, this);
	},

	_createHourlyRows: function () {
		this._createTimeCells();
		this._createGridLines();
	},

	_createTimeCells: function () {
		// create time leader cells for week and day views
		var template = this.timeCellTemplate,
			weekCont = this.weekTimeLayoutContainer,
			dayCont = this.dayTimeLayoutContainer,
			height = 1 / djc.hoursPerDay;
		for (var i = 0; i < djc.hoursPerDay; i++) { //every hour
			// week view
			var weekCell = template.cloneNode(true);
			weekCell.style.top = (i * height * 100) + '%';
			weekCell.style.height = (height * 100) + '%';
			weekCell._hour = i;
			weekCont.appendChild(weekCell);
			// day view
			var dayCell = weekCell.cloneNode(true);
			dayCell._hour = i;
			dayCont.appendChild(dayCell);
		}
	},

	_createGridLines: function () {
		// create grid lines for week and day views
		var template = this.dayRowTemplate,
			weekCont = this.weekRowsContainerNode,
			dayCont = this.dayRowsContainerNode,
			gridLinesPerDay = Math.floor(djc.minutesPerDay / this.minutesPerGridLine),
			//height = 1 / gridLinesPerDay,
			gridLinesPerHour = gridLinesPerDay / djc.hoursPerDay;
		for (var i = 0; i <= gridLinesPerDay; i++) { // for each grid line
			// week view
			var weekRow = template.cloneNode(true),
				top = i / gridLinesPerDay;
			weekRow.style.top = (top * 100) + '%';
			//weekRow.style.height = (height * 100) + '%';
			if (i % gridLinesPerHour == 0)
				dojo.addClass(weekRow, 'dojocalDayRowHourly');
			weekCont.appendChild(weekRow);
			// day view
			var dayRow = weekRow.cloneNode(true);
			dayCont.appendChild(dayRow);
		}
	},

	_createMonthRows: function () {
		var rowTemplate = this.monthRowTemplate,
			tbody = dojo.query('TBODY', this.monthTableNode)[0]
		dojo.forEach(new Array(6), function (dummy, i) {
			tbody.appendChild(rowTemplate.cloneNode(true));
		});
	},

	_setMonthCellHeaderDates: function () {
		// this method also determines if a row should be visible or not and styles cells
		// that are not in the current month
		var date = this._monthStartDate,
			currMonth = this.date.getMonth(),
			currYear = this.date.getFullYear(),
			rowsUsed = 0;
		dojo.query('.dojocalDayCellHeader', this.monthTableNode).forEach(function (node, pos) {
			var datePattern = pos == 0 || date.getDate() == 1 ? this.monthCellOneDatePattern : this.monthCellDatePattern;
			node.innerHTML = dojo.date.locale.format(date, {selector: 'date', datePattern: datePattern});
			// 0 = Sunday. don't store date object on node because IE will leak memory
			var td = djc.getAncestorByTagName(node, 'TD');
			if (date.getMonth() <= currMonth && date.getFullYear() <= currYear)
				rowsUsed = Math.max(rowsUsed, td.parentNode.rowIndex);
			dojo[date.getMonth() != currMonth ? 'addClass' : 'removeClass'](td, 'dojocalDayCellOutOfMonth');
			// TODO: is this next line useful?
			td.setAttribute('day', date.getDay().toString());
			date = dojo.date.add(date, 'day', 1);
		}, this);
		dojo.query('.dojocalMonthRow', this.monthTableNode).forEach(function (row) {
			dojo.style(row, 'display', (row.rowIndex > rowsUsed) ? 'none' : '');
		});
	},

	_prepareSplitters: function () {
		// TODO: remove moveables in destroy?????? memory leak?
		// week view
		this.weekSplitterMoveable = new dojo.dnd.Moveable(this.weekSplitter);
		this.weekSplitterMoveable._sizedNode = this.weekFooterWrapper;
		this.weekSplitterMoveable._flexNode = this.weekContainerNode;
		this.weekSplitterMoveable._collapseDetectorNode = this.weekFooterCollapseDetector;
		this.connect(this.weekSplitterMoveable, 'onMoveStart', dojo.hitch(this, '_onSplitterMoveStart', this.weekSplitterMoveable));
		this.connect(this.weekSplitterMoveable, 'onMoveStop', dojo.hitch(this, '_onSplitterMoveStop', this.weekSplitterMoveable));
		this.connect(this.weekSplitterMoveable, 'onMoving', dojo.hitch(this, '_onSplitterMoving', this.weekSplitterMoveable));
		// day view
		this.daySplitterMoveable = new dojo.dnd.Moveable(this.daySplitter);
		this.daySplitterMoveable._sizedNode = this.dayFooterWrapper;
		this.daySplitterMoveable._flexNode = this.dayContainerNode;
		this.daySplitterMoveable._collapseDetectorNode = this.dayFooterCollapseDetector;
		this.connect(this.daySplitterMoveable, 'onMoveStart', dojo.hitch(this, '_onSplitterMoveStart', this.daySplitterMoveable));
		this.connect(this.daySplitterMoveable, 'onMoveStop', dojo.hitch(this, '_onSplitterMoveStop', this.daySplitterMoveable));
		this.connect(this.daySplitterMoveable, 'onMoving', dojo.hitch(this, '_onSplitterMoving', this.daySplitterMoveable));
	},

	/***** splitter event handlers and methods *****/

	_onSplitterMoveStart: function (splitter, /* dojo.dnd.Mover */ mover) {
		// update the splitter constraints here in case they were changed since the last move
		this.weekFooterCollapseDetector.style.minHeight = this.dayFooterCollapseDetector.style.minHeight = this.splitterMinHeight;
		this.weekFooterCollapseDetector.style.maxHeight = this.dayFooterCollapseDetector.style.maxHeight = this.splitterMaxHeight;
		// record splitter offset for later calcs
		splitter._nodeYOffset = splitter.node.offsetTop;
		// record original values for later calcs while ensuring we have a value in the node's style attribute
		splitter._origFooterNodeHeight = parseInt(dojo.getComputedStyle(splitter._sizedNode).height);
		splitter._sizedNode.style.height = splitter._origFooterNodeHeight + 'px';
		// TODO: let splitter reside on top or bottom
		splitter._origFlexNodeBottom = parseInt(dojo.getComputedStyle(splitter._flexNode).bottom);
		splitter._flexNode.style.bottom = splitter._origFlexNodeBottom + 'px';
	},

	_onSplitterMoveStop: function (splitter, /* dojo.dnd.Mover */ mover) {
		// fix a dojo.dnd.Moveable bug
		splitter.node.style.position = '';
		// check if we should collapse the footer
		if (splitter._sizedNode.scrollHeight < splitter._collapseDetectorNode.offsetHeight) {
			// collapse footer
			splitter._sizedNode.style.height = '0';
			splitter._flexNode.style.bottom = -splitter._nodeYOffset + 'px';
		}
		// sync the other splitter
		var otherSplitter = splitter == this.daySplitterMoveable ? this.weekSplitterMoveable : this.daySplitterMoveable;
		otherSplitter._sizedNode.style.height = splitter._sizedNode.style.height;
		otherSplitter._flexNode.style.bottom = splitter._flexNode.style.bottom;
	},

	_onSplitterMoving: function (splitter, /* dojo.dnd.Mover */ mover, /* Object */ leftTop) {
		// save current values in case we need to revert
		var snHeight = splitter._sizedNode.style.height,
			fnBottom = splitter._flexNode.style.bottom;
		splitter._sizedNode.style.height = splitter._origFooterNodeHeight + splitter._nodeYOffset - leftTop.t + 'px';
		// TODO: let splitter reside on top or bottom
		splitter._flexNode.style.bottom = splitter._origFlexNodeBottom + splitter._nodeYOffset - leftTop.t + 'px';
		leftTop.l = 0;
		leftTop.t = splitter._nodeYOffset;
		// check if we've sized too large
		if (splitter._collapseDetectorNode.offsetHeight < splitter._sizedNode.clientHeight) {
			splitter._sizedNode.style.height = snHeight;
			splitter._flexNode.style.bottom = fnBottom;
		}
		// or too small
		else if (!this.splitterIsCollapsible && splitter._collapseDetectorNode.offsetHeight > splitter._sizedNode.clientHeight) {
			splitter._sizedNode.style.height = snHeight;
			splitter._flexNode.style.bottom = fnBottom;
		}
		// check if we should collapse the footer (sized too small)
		if (this.splitterIsCollapsible) {
			if (!splitter._willCollapse && splitter._sizedNode.clientHeight < splitter._collapseDetectorNode.offsetHeight) {
				dojo.addClass(splitter._sizedNode, 'dojocalSplitterWillCollapse');
				splitter._willCollapse = true;
			}
			else if (splitter._willCollapse && splitter._sizedNode.clientHeight >= splitter._collapseDetectorNode.offsetHeight) {
				dojo.removeClass(splitter._sizedNode, 'dojocalSplitterWillCollapse');
				splitter._willCollapse = false;
			}
		}
	},

	/***** visualization methods *****/

	_updateToCurrentTime: function () {
		this._checkTodayHighlighting();
		this._updateTimeMarker();
	},

	_checkDayHighlighting: function () {
		if (this._prevWeekdayColNum != this._weekdayColNum) {
			if (this._prevWeekdayColNum != undefined) {
				dojo.removeClass(this._weekDayLayouts[this._prevWeekdayColNum], 'dojocalDay-selected');
				dojo.removeClass(this._weekAllDayLayouts[this._prevWeekdayColNum], 'dojocalDay-selected');
			}
			dojo.addClass(this._weekDayLayouts[this._weekdayColNum], 'dojocalDay-selected');
			dojo.addClass(this._weekAllDayLayouts[this._weekdayColNum], 'dojocalDay-selected');
		}
	},

	_checkTodayHighlighting: function () {
		// TODO: this is still messed up, plus it needs to not manipulate strings (addClass/removeClass) unless they need to be changed!
		var today = djc.dateOnly(new Date()),
			todayOffset = dojo.date.difference(this._weekStartDate, today, 'day'),
			col = this._dayOfWeekToCol(today.getDay());
		if (col != this._todayWeekdayColNum && this._todayWeekdayColNum != undefined) {
			// week view
			dojo.removeClass(this._weekDayLayouts[this._todayWeekdayColNum], 'dojocalDay-today');
			dojo.removeClass(this._weekAllDayLayouts[this._todayWeekdayColNum], 'dojocalDay-today');
			// hide minute markers
			this.weekColumnTimeMarker.style.display = this.dayColumnTimeMarker.style.display = 'none';
		}
		if (todayOffset >= 0 && todayOffset < 7) {
			this._todayWeekdayColNum = col;
			// week view
			dojo.addClass(this._weekDayLayouts[this._todayWeekdayColNum], 'dojocalDay-today');
			dojo.addClass(this._weekAllDayLayouts[this._todayWeekdayColNum], 'dojocalDay-today');
			// move and show minute markers
			if (this.weekColumnTimeMarker.parentNode != this._weekDayLayouts[this._todayWeekdayColNum])
			this._weekDayLayouts[this._todayWeekdayColNum].appendChild(this.weekColumnTimeMarker);
			this.weekColumnTimeMarker.style.display = this.dayColumnTimeMarker.style.display = '';
		}
		// day view
		dojo[this._todayWeekdayColNum == this._weekdayColNum ? 'addClass' : 'removeClass'](this.dayColumnLayout , 'dojocalDay-today');
	},

	_updateTimeMarker: function () {
		var minutes = this._timeOfDayInMinutes(new Date()),
			dayMarker = this.dayColumnTimeMarker,
			weekdayMarker = this.weekColumnTimeMarker;
		dayMarker.style.top = minutes / djc.minutesPerDay * 100 + '%';
		weekdayMarker.style.top = minutes / djc.minutesPerDay * 100 + '%';
	},

	_scrollToTime: function (/* Number */ minuteOfDay) {
		this.weekContainerNode.scrollTop = this.dayContainerNode.scrollTop = this.dayBodyNode.offsetHeight / djc.minutesPerDay * minuteOfDay;
	},

	_addEventToDayView: function (eWidget) {
		this._addEventToDayLayout(eWidget, this.dayColumnLayout);
	},

	_addEventToWeekView: function (eWidget) {
		var dayNum = this._dayOfWeekToCol(eWidget.data._startDateTime.getDay()),
			dayLayout = this._weekDayLayouts[dayNum];
		this._addEventToDayLayout(eWidget, dayLayout);
	},

	_addEventToDayLayout: function (eWidget, viewEl) {
		// get time of day rounded to minutes
		var startMinutes = this._timeOfDayInMinutes(eWidget.data._startDateTime),
			durationMinutes = Math.round(eWidget.data.duration / 60);
		// convert to % of a day
		dojo.style(eWidget.domNode, 'top', startMinutes / djc.minutesPerDay * 100 + '%');
		// clear this from any prevous drag-and-drop
		dojo.style(eWidget.domNode, 'left', '');
		// this is a hack to prevent the dojo.dnd.Mover from interpreting the top and left as pixels (when they are %!)
		dojo.style(eWidget.domNode, 'position', '');
		dojo.style(eWidget.domNode, 'height', durationMinutes / djc.minutesPerDay * 100 + '%');
		viewEl.appendChild(eWidget.domNode);
	},

	_loadEventsIntoView: function (/* dojoc.dojocal.ViewMode */ view) {
		var start = view == viewModes.DAY ? this.date : this._weekStartDate,
			end = dojo.date.add(start, 'day', viewModeMap[view].numDays),
			_this = this;
		dojo.forEach(this._calendars, function (cal) {
			dojo.forEach(cal.getEvents(), function (event) {
				var testStart = event.data._startDateTime,
					testEnd = dojo.date.add(testStart, 'second', event.data.duration);
				if (end >= testStart && start <= testEnd) {
					var eWidget = _this._createEventWidget(event, cal);
					if (view == viewModes.DAY)
						_this._addEventToDayView(eWidget);
					else
						_this._addEventToWeekView(eWidget);
					eWidget.startup();
				}
			});
		});
	},

	_getAllEventsInNode: function (viewEl) {
		// retrieve all widgets whose nodes we've marked as isDojocalEvent
		return dojo.query("[isDojocalEvent]", viewEl).map(dijit.byNode);
	},

	_removeAllEventsFromView: function (viewEl) {
		this._getAllEventsInNode(viewEl).forEach(function (e) {
			e.destroy();
		});
	},

	_createEventWidget: function (userEvent, userCalendar) {
		var eventClass = dojo.getObject(userEvent.options.eventClass),
			eventWidget = new eventClass({data: userEvent.data, color: userEvent.options.color, fontColor: userEvent.options.fontColor});
		// connect events
		this.connect(eventWidget, 'onDataChange', dojo.hitch(this, '_onEventDataChange', eventWidget));
		if (this.dndMode != dndModes.NONE) {
			dojo.addClass(eventWidget.domNode, 'draggableEvent');
			// TODO: remove eventWidget.moveable??????? memory leak?
			var moveable = eventWidget.moveable = new dojo.dnd.Moveable(eventWidget.domNode, {delay: this.dndDetectDistance});
			this.connect(moveable, 'onMoveStart', dojo.hitch(this, '_onEventDragStart', eventWidget));
			this.connect(moveable, 'onMoveStop', dojo.hitch(this, '_onEventDragStop', eventWidget));
			this.connect(moveable, 'onMoving', dojo.hitch(this, '_onEventDragging', eventWidget));
		}
		// add special attributes so we can find this event easily
		eventWidget.domNode.setAttribute('isDojocalEvent', 'true');
		eventWidget.domNode.setAttribute('dojocalCalId', userCalendar.id);
		return eventWidget;
	},

	/***** other methods *****/

	_findCalendarById: function (id) {
		var pos = this._findCalendarPos(id);
		return pos >= 0 ? this._calendars[pos] : null;
	},

	_findCalendarPos: function (/* dojoc.dojocal.UserCalendar|String */ which) {
		var findBy = typeof which == 'string' ? 'id' : 'ref',
			found = -1;
		dojo.some(this._calendars, function (cal, pos) {
			if ((findBy == 'id' && cal.id == which) || (findBy == 'ref' && cal == which))
				found = pos;
			return found >= 0;
		});
		return found;
	},

	_dayOfWeekToCol: function (dayOfWeek) {
		return (dayOfWeek - this.weekStartsOn) % 7;
	},

	_colToDayOfWeek: function (colNum) {
		return (colNum + this.weekStartsOn) % 7;
	},

	_layoutToCol: function (layoutEl) {
		return parseInt(layoutEl.getAttribute('day'));
	},

	_layoutToDate: function (layoutEl) {
		var col = this._layoutToCol(layoutEl);
		return dojo.date.add(this._weekStartDate, 'day', col);
	},

	_nodeToLayout: function (node) {
		return djc.getAncestorByClassName(node, 'dojocalLayout');
	},

	_timeOfDayInMinutes: function (date) {
		return date.getHours() * 60 + date.getMinutes() + Math.round(date.getSeconds() / 60);
	},

	_whereIsUserEventDisplayable: function (/* UserEvent */event) {
		// TODO: recurrence and list view
		var where = {},
			testStart = event._startDateTime,
			testEnd = dojo.date.add(testStart, 'second', event.duration),
			testFunc = function (start, end) {
				return end >= testStart && start <= testEnd;
			};
		// test day view
		if (testFunc(this.date, dojo.date.add(this.date, 'day', 1))) {
			where.DAY = true;
			where.WEEK = true; // if it's on the current day, then it's on the current week!
		}
		// test week view
		else if (testFunc(this._weekStartDate, dojo.date.add(this._weekStartDate, 'day', 7))) {
			where.WEEK = true;
		}
		// test month view
		// TODO: detect when an event is viewable even if it not in this month (but is at the end or start of an adjacent month)
		var monthStart = dojo.date.add(this.date, 'day', -this.date.getDate() + 1),
			monthEnd = dojo.date.add(monthStart, 'month', 1);
		if (testFunc(monthStart, monthEnd)) {
			where.MONTH = true;
		}
		return where;
	},

	_switchView: function (oldMode, newMode, animate) {
		if (oldMode != newMode) {
			var oldNode = this[(viewModeMap[oldMode] || {}).nodeName],
				newNode = this[(viewModeMap[newMode] || {}).nodeName];
			// check if we're animating or not
			if (!animate || this._transitionViews(oldMode, newMode, oldNode, newNode) === false) {
				if (oldNode) {
					dojo.style(oldNode, 'zIndex', 0);
					dojo.style(oldNode, 'visibility', 'hidden');
				}
				if (newNode) {
					dojo.style(newNode, 'visibility', 'visible');
					dojo.style(newNode, 'zIndex', 1);
				}
			}
		}
	},

	_transitionViews: function (oldMode, newMode, oldNode, newNode) {
		// TODO: finish _transitionsViews() by crating a property to specify fadeIn, wipeIn, etc.
		// TODO: stop any current animation before starting new one!
		return false;
	},

	/***** internal event handlers ****/

	_onCalendarChangeEvent: function (event, changeType) {
		if (changeType == 'add') {
			// TODO:
			// create widgets for day, week, and month views
			// store in local cache????
		}
		else if (changeType == 'remove') {
			// TODO:
			// destroy widgets for day, week, and month views
			// remove from local cache????
		}
	},

	_onHeaderDateClick: function (e) {
		if (this._selectedEvent) {
			this._selectedEvent.setSelected(false);
			delete this._selectedEvent;
		}
		// TODO: check for day or week
		var cell = djc.getAncestorByAttrName(e.target, 'day'),
			date = dojo.date.add(this._weekStartDate, 'day', parseInt(cell.getAttribute('day')));
		if (cell && this.onHeaderClick(e, date) != false) {
			this.setDate(date);
		}
	},

	_onHeaderDateDblClick: function (e) {
		// TODO: check for day or week
		var cell = djc.getAncestorByAttrName(e.target, 'day'),
			date = dojo.date.add(this._weekStartDate, 'day', parseInt(cell.getAttribute('day')));
		if (cell && this.onHeaderDblClick(e, date) != false) {
			this.setViewMode(viewModes.DAY);
		}
	},

	_onDayLayoutClick: function (e) {
		// unselect the selected event widget
		if (this._selectedEvent) {
			this._selectedEvent.setSelected(false);
			delete this._selectedEvent;
		}
		// identify what was clicked (type) and the pertinent node
		// attribute names must be in reverse dom order
		var node, type;
		dojo.some(['isdojocalevent', 'day'], function (attrName) {
			type = attrName;
			return node = djc.getAncestorByAttrName(e.target, attrName);
		});
		if (node) {
			if (type == 'day') {
				return this._onDayClick(node, e);
			}
			else if (type == 'isdojocalevent') {
				return this._onEventClick(dijit.byNode(node), e);
			}
		}
	},

	_onDayClick: function (layoutNode, e) {
		var cell = djc.getAncestorByAttrName(e.target, 'day'),
			date = dojo.date.add(this._weekStartDate, 'day', parseInt(cell.getAttribute('day')));
console.log(cell, date)
		if (cell && this.onDayClick(e, date) != false) {
			this.setDate(date);
		}
	},

	_onEventClick: function (eventWidget, e) {
		eventWidget.setSelected(true);
		this._selectedEvent = eventWidget;
	},

	_onEventDataChange: function (eventWidget) {
		// TODO:
	},

	/***** event overlapping methods *****/

	_checkEventOverlapping: function (/* Node */ layoutNode, /* Boolean */ isExpandedView) {
//console.log('begin: ', (new Date()).getMilliseconds())
		if (this._eventPositioner) {
			// get event box layout data
			var eWidgets = this._getAllEventsInNode(layoutNode),
				eData = this._eventPositioner.checkOverlapping(eWidgets);
			// now, loop through ALL boxes and set their nodes' widths, lefts, and rights
			// use rights (right style property) for boxes near the right side to assist transition animations
			dojo.forEach(eData, function (datum) {
				var newBox = datum.newBox,
					nStyle = datum.widget.domNode.style;
				datum.widget._layoutBox = newBox; // save for transitions
				if (newBox) {
					if (isExpandedView) {
						nStyle.width = newBox.spacing + '%';
						// set left or right depending on anchor property
						nStyle.left = newBox.anchor == 'l' ? newBox.l + '%' : 'auto';
						nStyle.right = newBox.anchor == 'r' ? (100 - newBox.r) + '%' : 'auto';
					}
					else {
						nStyle.width = newBox.w + '%';
						// set left or right depending on anchor property
						nStyle.left = newBox.anchor == 'l' ? newBox.l + '%' : 'auto';
						nStyle.right = newBox.anchor == 'r' ? (100 - newBox.r) + '%' : 'auto';
					}
				}
				else {
					// clear the properties for events that are not in groups (i.e. use the class rules)
					nStyle.minWidth = nStyle.width = nStyle.left = nStyle.right = '';
				}
			});
		}
//console.log('end: ', (new Date()).getMilliseconds())
	},

	/***** drag and drop handlers and methods ****/
	/***** TODO: reuse or reduce redundant code *****/

	// time a user lingers near a column before snapping the event widget to it
	_dragSnapTimeout: 500,

	// time a user stops dragging before updating the event widget's date and time
	_dragUpdateTimeout: 100,

	// time between checks for auto-scrolling during a drag-and-drop
	_dragAutoScrollTimeout: 50,

	// speed in px per sec per scroll offset for auto-scrolling during a drag-and-drop
	_dragAutoScrollSpeed: 4,

	_onEventDragStart: function (eventWidget, /* dojo.dnd.Mover */ mover) {
		// clear any local styles from overlapping
		var es = eventWidget.domNode.style;
		es.left = es.width = es.minWidth = '';
		eventWidget._dndData = this._getDraggedEventStartData(eventWidget);
		// looks nicer unselected TODO: use dojoMoveItem instead?
		eventWidget.setSelected(false);
		// start detecting for auto-scroll
		if (eventWidget._dndData.scrollBox) {
			this._onEventdraggingAutoScrollTimer = setInterval(dojo.hitch(this, this._onCheckAutoScroll, eventWidget, mover), 100);
		}
	},

	_onEventDragStop: function (eventWidget, /* dojo.dnd.Mover */ mover) {
		// cancel dragging events asap or IE6 may still execute them!
		if (this._onEventDraggingSetDateTimeTimer)
			clearTimeout(this._onEventDraggingSetDateTimeTimer);
		// stop detecting for auto-scroll
		clearTimeout(this._onEventdraggingAutoScrollTimer)
		// snap to the closest day
		// Note: assumes that a new day is guaranteed to be found (i.e. dnd operation always ends successfully)!
		var newDragData = this._getDraggedEventCurrentData(eventWidget);
		eventWidget.setDateTime(newDragData.dateTime);
		this._addEventToDayLayout(eventWidget, newDragData.col);
		this._checkEventOverlapping(eventWidget._dndData.col, viewModeMap[this.viewMode].isExpanded);
		if (eventWidget._dndData.col != newDragData.col)
			this._checkEventOverlapping(newDragData.col, viewModeMap[this.viewMode].isExpanded);
		eventWidget.setSelected(true);
		this._selectedEvent = eventWidget;
		delete eventWidget._dndData;
		// TODO: remove the following code when we are using the dojo data store!
		// sync the event in the opposite view (and month view in future)
		var cell = djc.getAncestorByAttrName(eventWidget.domNode, 'day'),
			day = parseInt(cell.getAttribute('day')),
			col = this.viewMode == viewModes.DAY ? this._weekDayLayouts[day] : this.dayColumnLayout;
		// Note: this may be running unnecessarily on day view if the user did not select the weekday column first
		dojo.some(this._getAllEventsInNode(col), function (event) {
			if (event.data.guid == eventWidget.data.guid) {
				event.setDateTime(newDragData.dateTime);
				this._addEventToDayLayout(event, col);
				return true;
			}
		}, this);
		this._checkEventOverlapping(col, viewModeMap[this.viewMode == viewModes.DAY ? viewModes.WEEK : viewModes.DAY].isExpanded);
	},

	_onEventDragging: function (eventWidget, /* dojo.dnd.Mover */ mover, /* Object */ leftTop) {
		// TODO: month view
		// restrict movement to calendar day(s)
		leftTop.l = Math.min(Math.max(eventWidget._dndData.boundingBox.l, leftTop.l), eventWidget._dndData.boundingBox.r - eventWidget.domNode.offsetWidth);
		leftTop.t = Math.min(Math.max(eventWidget._dndData.boundingBox.t, leftTop.t), eventWidget._dndData.boundingBox.b - eventWidget.domNode.offsetHeight);
		// figure out nearest day and time
		var isFluid = this.dndMode == dndModes.FLUID,
			newDragData = this._getDraggedEventCurrentData(eventWidget, isFluid ? null : leftTop);
		eventWidget._dndData.currentData = newDragData;
		eventWidget._dndData.leftTop = leftTop; // save for auto-scroll
		// if we're doing fluid dnd
		if (isFluid) {
			// snap to the current weekday column if we've been close to a column for a while
			if (Math.abs(leftTop.l /*+ eventWidget._dndData.parentBox.l*/ - newDragData.colCoords.l) < this.dndFluidSnapThreshold) {
				if (!eventWidget._dndData._snapToColCheckTime || ((new Date()) - eventWidget._dndData._snapToColCheckTime > this._dragSnapTimeout)) {
//					leftTop.l = -(eventWidget._dndData.parentBox.l - newDragData.colCoords.l);
					leftTop.l = newDragData.colCoords.l;
				}
			}
			else {
				eventWidget._dndData._snapToColCheckTime = new Date();
			}
			// snap to the current time row if we've been close to a time for a while
			var nearbyTimePx = Math.round(leftTop.t / newDragData.colCoords.h * 24 * 60 / this.userChangeResolution) * this.userChangeResolution / 60 / 24 * newDragData.colCoords.h;
			if (Math.abs(leftTop.t - nearbyTimePx) < this.userChangeResolution / 2) {
				if (!eventWidget._dndData._snapToRowCheckTime || ((new Date()) - eventWidget._dndData._snapToRowCheckTime > this._dragSnapTimeout)) {
					leftTop.t = nearbyTimePx;
				}
			}
			else {
				eventWidget._dndData._snapToRowCheckTime = new Date();
			}
		}
		// otherwise, we must be doing DISCRETE dnd
		else {
			leftTop.l = -(/*eventWidget._dndData.parentBox.l */- newDragData.colCoords.l);
			leftTop.t = (newDragData.dateTime.getMinutes() + newDragData.dateTime.getHours() * 60) / 60 / 24 * newDragData.colCoords.h;
		}
		// reset dragging events
		if (this._onEventDraggingSetDateTimeTimer)
			clearTimeout(this._onEventDraggingSetDateTimeTimer);
		this._onEventDraggingSetDateTimeTimer = setTimeout(dojo.hitch(this, this._onEventDraggingSetDateTime, eventWidget), this._dragUpdateTimeout);
	},

	_onEventDraggingSetDateTime: function (eventWidget) {
		eventWidget.setDateTime(eventWidget._dndData.currentData.dateTime);
	},

	_getDraggedEventStartData: function (eventWidget) {
		// TODO: month view
		// TODO: save the original data so that it can be reverted?
		// TODO: move the node refs to viewModeMap
		// get bounding box and offsetParent box
		var bNode = this.viewMode == viewModes.WEEK ? this.weekTableNode : this.dayColumnLayout,
			sNode = this.viewMode == viewModes.WEEK ? this.weekContainerNode : this.dayContainerNode,
			bBox = dojo.coords(bNode, true),
			sBox = sNode.scrollHeight > sNode.clientHeight || sNode.scrollWidth > sNode.clientWidth ? dojo.coords(sNode, true) : null,
			pBox = dojo.coords(eventWidget.domNode.offsetParent, true),
			targets = this.viewMode == viewModes.DAY ? [this.dayColumnLayout] : this._weekDayLayouts;
		// get drop target boxes in reference to offsetParent (since that's how dojo.moveable will report leftTop)
		targets = dojo.map(targets, function (tgt) {
			var tc = dojo.coords(tgt, true);
			return {l: tc.x - pBox.x, t: tc.y - pBox.y, w: tc.w, h: tc.h, node: tgt};
		});
		var data = {
				boundingBox: {
					l: bBox.x - pBox.x,
					t: bBox.y - pBox.y,
					r: bBox.x + bBox.w - pBox.x,
					b: bBox.y + bBox.h - pBox.y
				},
				parentBox: pBox,
				scrollBox: !!sBox && {
					l: sBox.x - pBox.x,
					t: sBox.y - pBox.y,
					r: sBox.x + sBox.w - pBox.x,
					b: sBox.y + sBox.h - pBox.y
				},
				// TODO: find a better way to get the col node since this could be broken by a change in the html structure
				col: eventWidget.domNode.offsetParent,
				targetBoxes: targets
			};
//console.dir(data)
		return data;
	},

	_getDraggedEventCurrentData: function (eventWidget, leftTop) {
		var n = eventWidget.domNode,
			eventCoords = leftTop || {l: n.offsetLeft, t: n.offsetTop},
			bestPick,
			bestPickOverlap = -1;
		eventCoords.w = n.offsetWidth;
		eventCoords.h = n.offsetHeight;
		// find "best pick": the target that overlaps with the event the most
		dojo.forEach(eventWidget._dndData.targetBoxes, function (box) {
			var colCoords = box,
				overlapX = Math.max(Math.min(eventCoords.l + eventCoords.w, colCoords.l + colCoords.w) - Math.max(eventCoords.l, colCoords.l), 0),
				overlapY = Math.max(Math.min(eventCoords.t + eventCoords.h, colCoords.t + colCoords.h) - Math.max(eventCoords.t, colCoords.t), 0),
				overlap = overlapX * overlapY;
			if (overlap > bestPickOverlap) {
				bestPickOverlap = overlap;
				bestPick = {col: box.node, colCoords: colCoords, eventCoords: eventCoords};
			}
		});
		// get the new date and time from the best pick
		var newTime = Math.round((eventCoords.t - bestPick.colCoords.t) / bestPick.colCoords.h * 24 * 60 / this.userChangeResolution) * this.userChangeResolution,
			newDate = this._layoutToDate(bestPick.col);
		newDate.setMinutes(newTime, 0, 0);
		bestPick.dateTime = newDate;
		return bestPick;
	},

	_onCheckAutoScroll: function (eventWidget, mover) {
		// check that we've had at least one _onEventDragging occurrence
		if (!eventWidget._dndData.leftTop) return;
		// get amount user dragged event over scroll container (if any)
		var n = eventWidget.domNode,
			lt = eventWidget._dndData.leftTop,
//			pBox = eventWidget._dndData.parentBox,
			sBox = eventWidget._dndData.scrollBox,
			// TODO: fix: this only works if the event's box is smaller than the scroll container's box!
			hDir = Math.min(lt.l - sBox.l, 0) + Math.max(lt.l + n.offsetWidth - sBox.r, 0),
			vDir = Math.min(lt.t - sBox.t, 0) + Math.max(lt.t + n.offsetHeight - sBox.b, 0);
		// if scrolling is needed
		if (hDir || vDir) {
			// TODO: reuse or reduce redundant code
			// TODO: use actual time difference since previous check, not configured _dragAutoScrollTimeout
			// calc new scroll offsets
			var sNode = this.viewMode == viewModes.WEEK ? this.weekContainerNode : this.dayContainerNode,
				hScroll = this._dragAutoScrollSpeed / (1000 / this._dragAutoScrollTimeout) * hDir,
				vScroll = this._dragAutoScrollSpeed / (1000 / this._dragAutoScrollTimeout) * vDir,
				// save these to measure the ACTUAL scroll
				prevScrollLeft = sNode.scrollLeft,
				prevScrollTop = sNode.scrollTop;
			// ensure we scroll at least 1 px
			hScroll = Math[hDir > 0 ? 'ceil' : 'floor'](hScroll);
			vScroll = Math[vDir > 0 ? 'ceil' : 'floor'](vScroll);
			// apply scroll
			sNode.scrollLeft += hScroll;
			sNode.scrollTop += vScroll;
			// find actual scroll
			hScroll = sNode.scrollLeft - prevScrollLeft;
			vScroll = sNode.scrollTop - prevScrollTop;
			// adjust new leftTop
			n.style.left = n.offsetLeft + hScroll + 'px';
			n.style.top = n.offsetTop + vScroll + 'px';
			mover.marginBox.l += hScroll;
			mover.marginBox.t += vScroll;
			sBox.l += hScroll;
			sBox.t += vScroll;
			sBox.r += hScroll;
			sBox.b += vScroll;
			lt.l += hScroll;
			lt.t += vScroll;
		}
	}

});

// a collection of facts about the view modes
var viewModeMap = {
		// TODO: make these localizeable
		1: {name: 'DAY', displayName: 'Day', nodeName: 'dayViewNode', isExpanded: true, numDays: 1},
		2: {name: 'WEEK', displayName: 'Week', nodeName: 'weekViewNode', isExpanded: false, numDays: 7},
		3: {name: 'MONTH', displayName: 'Month', nodeName: 'monthViewNode', isExpanded: false, numDays: 42}
	};

})(); // end of closure for local variables
