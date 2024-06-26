// Global variables
var browser = new Browser();

// initialize upon load to let all browsers establish content objects
function initDOMAPI() {
    if (document.images) {
        browser.isCSS = (document.body && document.body.style) ? true : false;
        browser.isW3C = (browser.isCSS && document.getElementById) ? true : false;
        browser.isIE4 = (browser.isCSS && document.all) ? true : false;
        browser.isNN4 = (document.layers) ? true : false;
        browser.isIE6CSS = (document.compatMode && document.compatMode.indexOf("CSS1") >= 0) ? true : false;
    }
}
// set event handler to initialize API
//window.onload = initDOMAPI;

// Seek nested NN4 layer from string name
function seekLayer(doc, name) {
    var theObj;
    for (var i = 0; i < doc.layers.length; i++) {
        if (doc.layers[i].name == name) {
            theObj = doc.layers[i];
            break;
        }
        // dive into nested layers if necessary
        if (doc.layers[i].document.layers.length > 0) {
            theObj = seekLayer(document.layers[i].document, name);
        }
    }
    return theObj;
}

// Convert object name string or object reference
// into a valid element object reference
function getRawObject(obj) {
    var theObj;
    if (typeof obj == "string") {
        if (document.getElementById) {
            theObj = document.getElementById(obj);
        } else if (document.all) {
            theObj = document.all(obj);
        } else if (document.layer) {
            theObj = seekLayer(document, obj);
        }
    } else {
        // pass through object reference
        theObj = obj;
    }
    return theObj;
}

// Convert object name string or object reference
// into a valid style (or NN4 layer) reference
function getObject(obj) {
    var theObj = getRawObject(obj);
    if (theObj && browser.isCSS) {
        theObj = theObj.style;
    }
    return theObj;
}

// Position an object at a specific pixel coordinate
function shiftTo(obj, x, y) {
    var theObj = getObject(obj);
    if (theObj) {
        if (browser.isCSS) {
            // equalize incorrect numeric value type
            var units = (typeof theObj.left == "string") ? "px" : 0 
            theObj.left = x + units;
            theObj.top = y + units;
        } else if (browser.isNN4) {
            theObj.moveTo(x,y)
        }
    }
}

// Move an object by x and/or y pixels
function shiftBy(obj, deltaX, deltaY) {
    var theObj = getObject(obj);
    if (theObj) {
        if (browser.isCSS) {
            // equalize incorrect numeric value type
            var units = (typeof theObj.left == "string") ? "px" : 0 
            theObj.left = getObjectLeft(obj) + deltaX + units;
            theObj.top = getObjectTop(obj) + deltaY + units;
        } else if (browser.isNN4) {
            theObj.moveBy(deltaX, deltaY);
        }
    }
}

// Set the z-order of an object
function setZIndex(obj, zOrder) {
    var theObj = getObject(obj);
    if (theObj) {
        theObj.zIndex = zOrder;
    }
}

// Set the background color of an object
function setBGColor(obj, color) {
    var theObj = getObject(obj);
    if (theObj) {
        if (browser.isNN4) {
            theObj.bgColor = color;
        } else if (browser.isCSS) {
            theObj.backgroundColor = color;
        }
    }
}

// Set the visibility of an object to visible
function show(obj) {
    var theObj = getObject(obj);
    if (theObj) {
        theObj.visibility = "visible";
    }
}

// Set the visibility of an object to hidden
function hide(obj) {
    var theObj = getObject(obj);
    if (theObj) {
        theObj.visibility = "hidden";
    }
}

// Retrieve the x coordinate of a positionable object
function getObjectLeft(obj)  {
    var elem = getRawObject(obj);
    var result = 0;
    if (document.defaultView && document.defaultView.getComputedStyle) {
        var style = document.defaultView;
        var cssDecl = style.getComputedStyle(elem, "");
        result = cssDecl.getPropertyValue("left");
    } else if (elem.currentStyle) {
        result = elem.currentStyle.left;
    } else if (elem.style) {
        result = elem.style.left;
    } else if (browser.isNN4) {
        result = elem.left;
    }
    return parseInt(result);
}

// Retrieve the y coordinate of a positionable object
function getObjectTop(obj)  {
    var elem = getRawObject(obj);
    var result = 0;
    if (document.defaultView && document.defaultView.getComputedStyle) {
        var style = document.defaultView;
        var cssDecl = style.getComputedStyle(elem, "");
        result = cssDecl.getPropertyValue("top");
    } else if (elem.currentStyle) {
        result = elem.currentStyle.top;
    } else if (elem.style) {
        result = elem.style.top;
    } else if (browser.isNN4) {
        result = elem.top;
    }
    return parseInt(result);
}

// Retrieve the rendered width of an element
function getObjectWidth(obj)  {
    var elem = getRawObject(obj);
    var result = 0;
    if (elem.offsetWidth) {
        result = elem.offsetWidth;
    } else if (elem.clip && elem.clip.width) {
        result = elem.clip.width;
    } else if (elem.style && elem.style.pixelWidth) {
        result = elem.style.pixelWidth;
    }
    return parseInt(result);
}

// Retrieve the rendered height of an element
function getObjectHeight(obj)  {
    var elem = getRawObject(obj);
    var result = 0;
    if (elem.offsetHeight) {
        result = elem.offsetHeight;
    } else if (elem.clip && elem.clip.height) {
        result = elem.clip.height;
    } else if (elem.style && elem.style.pixelHeight) {
        result = elem.style.pixelHeight;
    }
    return parseInt(result);
}


// Return the available content width space in browser window
function getInsideWindowWidth() {
    if (window.innerWidth) {
        return window.innerWidth;
    } else if (browser.isIE6CSS) {
        // measure the html element's clientWidth
        return document.body.parentElement.clientWidth
    } else if (document.body && document.body.clientWidth) {
        return document.body.clientWidth;
    }
    return 0;
}
// Return the available content height space in browser window
function getInsideWindowHeight() {
    if (window.innerHeight) {
        return window.innerHeight;
    } else if (browser.isIE6CSS) {
        // measure the html element's clientHeight
        return document.body.parentElement.clientHeight
    } else if (document.body && document.body.clientHeight) {
        return document.body.clientHeight;
    }
    return 0;
}

function Browser() {

  var ua, s, i;

  this.isIE    = false;
  this.isNS    = false;
  this.version = null;

  ua = navigator.userAgent;

  s = "MSIE";
  if ((i = ua.indexOf(s)) >= 0) {
    this.isIE = true;
    this.version = parseFloat(ua.substr(i + s.length));
    return;
  }

  s = "Netscape6/";
  if ((i = ua.indexOf(s)) >= 0) {
    this.isNS = true;
    this.version = parseFloat(ua.substr(i + s.length));
    return;
  }

  // Treat any other "Gecko" browser as NS 6.1.

  s = "Gecko";
  if ((i = ua.indexOf(s)) >= 0) {
    this.isNS = true;
    this.version = 6.1;
    return;
  }
}

var browser = new Browser();

// Global object to hold drag information.

var dragObj = new Object();
dragObj.zIndex = 0;
var dragging = 0;

function dragStart(evt, id) {
  var evt = (evt) ? evt : window.event;
  if (dragging == 1) {
     return false;
  }
  var el;
  var x, y;

  // If an element id was given, find it. Otherwise use the element being
  // clicked on.
  if (id) {
    dragObj.elNode = document.getElementById(id);
  } else {
      dragObj.elNode = (evt.target) ? evt.target : evt.srcElement;

      // If this is a text node, use its parent element.
      if (dragObj.elNode.nodeType == 3) {
         dragObj.elNode = dragObj.elNode.parentNode;
      }
  }

  // Get cursor position with respect to the page.
  x = evt.clientX;
  y = evt.clientY;

  // Save starting positions of cursor and element.

  dragObj.cursorStartX = x;
  dragObj.cursorStartY = y;
  dragObj.elStartLeft  = getObjectLeft(id);
  dragObj.elStartTop   = getObjectTop(id);

  if (isNaN(dragObj.elStartLeft)) dragObj.elStartLeft = 0;
  if (isNaN(dragObj.elStartTop))  dragObj.elStartTop  = 0;

   // Update element's z-index.
   dragObj.elNode.style.zIndex = '20000';

   // Capture mousemove and mouseup events on the page.
   if (document.attachEvent) {
      document.attachEvent("onmousemove", dragGo);
      document.attachEvent("onmouseup",   dragStop);
      window.event.cancelBubble = true;
      window.event.returnValue = false;
   } else if (document.addEventListener) {
      document.addEventListener("mousemove", dragGo,   true);
      document.addEventListener("mouseup",   dragStop, true);
      evt.preventDefault();
   } else {
      document.onmousemove = dragGo;
      document.mouseup = dragStop;
   }
   dragging = 1;
}

function dragGo(evt) {
   evt = (evt) ? evt : window.event;
   var x, y;

   // Get cursor position with respect to the page.
   x = evt.clientX;
   y = evt.clientY;

   // Move drag element by the same amount the cursor has moved.
   dragObj.elNode.style.left = (dragObj.elStartLeft + x - dragObj.cursorStartX) + "px";
   dragObj.elNode.style.top  = (dragObj.elStartTop  + y - dragObj.cursorStartY) + "px";

   if (!evt.preventDefault) {
      evt.cancelBubble = true;
      evt.returnValue = false;
   } else {
      evt.preventDefault();
   }
}

function dragStop(evt) {
   evt = (evt) ? evt : window.event;
   // Stop capturing mousemove and mouseup events.

   if (document.detachEvent) {
      document.detachEvent("onmousemove", dragGo);
      document.detachEvent("onmouseup",   dragStop);
   } else if (document.removeEventListener) {
      document.removeEventListener("mousemove", dragGo,   true);
      document.removeEventListener("mouseup",   dragStop, true);
   } else {
      document.onmousemove = null;
      document.onmouseup = null;
   }
   dragging = 0;
}

function getCookie(Name) {
   var search = Name + "="
   if (document.cookie.length > 0) { // if there are any cookies
      offset = document.cookie.indexOf(search) 
      if (offset != -1) { // if cookie exists 
    offset += search.length 
    // set index of beginning of value
    end = document.cookie.indexOf(";", offset) 
    // set index of end of cookie value
    if (end == -1) 
    end = document.cookie.length
    return unescape(document.cookie.substring(offset, end))
      } 
   }
}

function createCookie(name,value,days) {
   if (days) {
      var date = new Date();
      date.setTime(date.getTime()+(days*24*60*60*1000));
      var expires = "; expires="+date.toGMTString();
   } else var expires = "";
   document.cookie = name + "=" + value + expires + "; path=/";
}

function eraseCookie(name) {
   createCookie(name,"",-1);
}

function clearSelect(sel) {
   if (sel && sel.options) {
      for (var s=sel.options.length; s>0; s--) {
         sel.options[s] = null;
      }
   }
}

function fillSelect(who, data, current) {
   var sel = document.getElementById(who);
   var opt = new Array();
   if (sel && sel.options) {
      clearSelect(sel);
      var selected = '';
      for (var d in data) {
         selected = (d == current) ? true : false;

         opt[opt.length] = new Option(data[d], d, selected, selected);
         sel.options[opt.length - 1] = opt[opt.length - 1];
      }
   }
}

