;(function() {
	
	window.simplePlumb = {
		init : function() {

			var sourceAnchors = ["Continuous", "LeftMiddle" ],
				targetAnchors = ["Continuous", "RightMiddle"],
			exampleColor = '#00f',
			exampleDropOptions = {
					tolerance:'touch',
					hoverClass:'dropHover',
					activeClass:'dragActive'
			}, 
			connector = [ "Bezier", { cssClass:"connectorClass", hoverClass:"connectorHoverClass" } ],
			connectorStyle = {
				gradient:{stops:[[0, exampleColor], [0.5, '#09098e'], [1, exampleColor]]},
				lineWidth:5,
				strokeStyle:exampleColor
			},
			hoverStyle = {
				strokeStyle:"#449999"
			},
			overlays = [ ["Diamond", { fillStyle:"#09098e", width:15, length:15 } ] ],
			endpoint = ["Dot", { cssClass:"endpointClass", radius:10, hoverClass:"endpointHoverClass" } ],
			endpointStyle = { fillStyle:exampleColor },
			anEndpoint = {
				endpoint:endpoint,
				paintStyle:endpointStyle,
				hoverPaintStyle:{ fillStyle:"#449999" },
				isSource:true, 
				isTarget:true, 
				maxConnections:-1, 
				connector:connector,
				connectorStyle:connectorStyle,
				connectorHoverStyle:hoverStyle,
				connectorOverlays:overlays
			};
			
			jsPlumb.Defaults.DragOptions = { cursor: 'pointer', zIndex:2000 };
         jsPlumb.Defaults.Container = $("body");

			var connections = {
				// "window4":["window2"]
				
			},
			endpoints = {},			
			// ask jsPlumb for a selector for the window class
			divsWithWindowClass = jsPlumb.CurrentLibrary.getSelector(".field");
			allfields = $(".field[rel]");
			// add endpoints to all of these - one for source, and one for target, configured so they don't sit
			// on top of each other.
			// for (var i = 0 ; i < divsWithWindowClass.length; i++) {
			//	var id = jsPlumb.getId(divsWithWindowClass[i]);
			//	endpoints[id] = [
					// note the three-arg version of addEndpoint; lets you re-use some common settings easily.
			//		jsPlumb.addEndpoint(id, anEndpoint, {anchor:sourceAnchors}),
			//		jsPlumb.addEndpoint(id, anEndpoint, {anchor:targetAnchors})
			//	];
			//}
         for (var i = 0; i < allfields.length; i++) { 
            var id = allfields.attr('id');
					jsPlumb.addEndpoint(id, anEndpoint, {anchor:"Continuous"});
         }
			// then connect everything using the connections map declared above.
			for (var e in endpoints) {
				if (connections[e]) {
					for (var j = 0; j < connections[e].length; j++) {					
						jsPlumb.connect({
							source:endpoints[e][0],
							target:endpoints[connections[e][j]][1]
						});						
					}
				}	
			}
			
			// bind click listener; delete connections on click			
			jsPlumb.bind("click", function(conn) {
				jsPlumb.detach(conn);
			});
			
			// bind beforeDetach interceptor: will be fired when the click handler above calls detach, and the user
			// will be prompted to confirm deletion.
			jsPlumb.bind("beforeDetach", function(conn) {
				return confirm("Delete connection?");
			});
			
			//
			// configure ".window" to be draggable. 'getSelector' is a jsPlumb convenience method that allows you to
			// write library-agnostic selectors; you could use your library's selector instead, eg.
			//
			// $(".window")  		jquery
			// $$(".window") 		mootools
			// Y.all(".window")		yui3
			//
			jsPlumb.draggable($(".fieldlist"));
		}
	};
	
})();

$(function() {
   jsPlumb.bind("ready", function() {
      simplePlumb.init();
   });
   // $(".window").draggable({ drag: function(e) { jsPlumb.repaintEverything(); } });
});

