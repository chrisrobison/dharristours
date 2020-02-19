/*
	Copyright (c) 2004-2009, The Dojo Foundation
	All Rights Reserved.

	Licensed under the Academic Free License version 2.1 or above OR the
	modified BSD license. For more information on Dojo licensing, see:

		http://dojotoolkit.org/book/dojo-book-0-9/introduction/licensing
*/

/*
	Author: unscriptable
	Date: Dec 13, 2008
	Base classes for Event Widgets.
*/
dojo.provide('dojoc.dojocal.Event');
dojo.provide('dojoc.dojocal.DraggableEvent');

dojo.require('dijit._Templated');
dojo.require('dijit._Widget');
dojo.require('dojoc.dojocal._base.EventMixin');
dojo.require('dojo.date.locale');
dojo.require('dojo.dnd.Moveable');

(function () { // closure for local variables

dojo.declare('dojoc.dojocal.Event', [dijit._Widget, dijit._Templated, dojoc.dojocal._base.EventMixin], {
	 //summary:
	 //   A very basic dojocal event widget that shows the start time and the summary of the event.

	templatePath: dojo.moduleUrl('dojoc.dojocal', 'resources/Event.html'),

	// baseClass: String
	//   the base class for this event widget (used for creating state-related classes e.g. dojocalEvent-selected)
	baseClass: 'dojocalEvent',

	// cssClasses: String
	//   additional css classes to add to the root dom node of the event widget
	//   this is useful for creating customized event widgets without subclassing
	cssClasses: '',

	// timeFormat: String
	//   the dojo.date.locale-formatted date string used to display the event start time
	timeFormat: 'h:mm a',

	// dateFormat: String
	//   the dojo.date.locale-formatted date string used to display the event start date (in the domNode.title)
	dateFormat: 'd MMM yyyy',

	/***** overrides *****/

	setSelected: function (selected) {
		this.inherited(arguments);
		this._setCssState('selected', this.selected);
		if (selected) {
			// adjust text color so it's more readable (now that the opacity was increased)
			var fgColor = new dojo.Color(this.fontColor),
				bgColor = new dojo.Color(this.color);
			// check if our colors are "dark on dark" or "light on light"
			// TODO? find a formula that satisfies more color combinations
			var isTooClose = Math.abs(fgColor.r - bgColor.r) < 96 || Math.abs(fgColor.g - bgColor.g) < 96 || Math.abs(fgColor.b - bgColor.b) < 96;
			if (isTooClose) {
				// lighten or darken our text
				var colorDir = (fgColor.r - bgColor.r > 0) + Math.abs(fgColor.g - bgColor.g > 0) + Math.abs(fgColor.b - bgColor.b > 0),
				newColor = new dojo.Color();
				dojo.blendColors(fgColor, new dojo.Color(colorDir > 0 ? 'white' : 'black'), 0.75, newColor);
				dojo.style(this.domNode, 'color', newColor.toCss());
			}
		}
		else {
			dojo.style(this.domNode, 'color', this.fontColor);
		}
	},

	setEditing: function (editing) {
		// TODO? set focus and detect blur
		this.inherited(arguments);
		this._setCssState('editing', this.editing);
	},

	setColor: function (/* String */ color) {
		this.inherited(arguments);
		// until we're not supporting the older, non-CSS3 browsers, the opaque border and semi-opaque background cannot be set on the same node
		dojo.style(this.borderNode, 'borderColor', color);
		dojo.style(this.backgroundNode, 'backgroundColor', color);
	},

	setFontColor: function (/* String */ fontColor) {
		this.inherited(arguments);
		dojo.style(this.domNode, 'color', fontColor);
	},

	setData: function (/* dojoc.dojocal.UserEvent */ data) {
		this.inherited(arguments);
		this.summary = this.data.summary || '';
		this.text = this.data.text || '';
		if (this._started)
			this._updateTimeLabel();
	},

	setDateTime: function (/* Date */ dateTime) {
		this.inherited(arguments);
		if (this._started)
			this._updateTimeLabel();
	},

	postCreate: function () {
		this.inherited(arguments);
		this.setColor(this.color);
		this.setFontColor(this.fontColor);
	},

	postMixInProperties: function () {
		this.inherited(arguments);
		if (!this.data)
			this.data = {};
		this.setData(this.data);
	},

	startup: function () {
		this.inherited(arguments);
		this._updateTimeLabel();
	},

	/***** private properties and methods *****/

	_timeLabel: '',

	_setCssState: function (/* String */ state, /* Boolean */ on) {
		dojo[on ? 'addClass' : 'removeClass'](this.domNode, this.baseClass + '-' + state);
	},

	_updateTimeLabel: function () {
		this._timeLabel = dojo.date.locale.format(this.data._startDateTime, {selector: 'time', timePattern: this.timeFormat});
		if (this.timeTextNode && this.timeTextNode.innerHTML != this._timeLabel)
			this.timeTextNode.innerHTML = this._timeLabel;
	}

});

})(); // end of closure for local variables
