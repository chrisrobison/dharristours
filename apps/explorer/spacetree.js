var labelType, useGradients, nativeTextSupport, animate;

(function() {
  var ua = navigator.userAgent,
      iStuff = ua.match(/iPhone/i) || ua.match(/iPad/i),
      typeOfCanvas = typeof HTMLCanvasElement,
      nativeCanvasSupport = (typeOfCanvas == 'object' || typeOfCanvas == 'function'),
      textSupport = nativeCanvasSupport 
        && (typeof document.createElement('canvas').getContext('2d').fillText == 'function');
  //I'm setting this based on the fact that ExCanvas provides text support for IE
  //and that as of today iPhone/iPad current text support is lame
  labelType = (!nativeCanvasSupport || (textSupport && !iStuff))? 'Native' : 'HTML';
  nativeTextSupport = labelType == 'Native';
  useGradients = nativeCanvasSupport;
  animate = !(iStuff || !nativeCanvasSupport);
})();

var Log = {
  elem: false,
  write: function(text){
    if (!this.elem) 
      this.elem = document.getElementById('log');
    this.elem.innerHTML = text;
    this.elem.style.left = (500 - this.elem.offsetWidth / 2) + 'px';
  }
};


function init(id){
    //init data
      var json = {};
      $.getJSON("orgchart.php?id="+id, function(data) {
      json = data;
      for (var i in data.data) {
         if (!i.match(/^\$/)) {
            var el = $("#"+i);
            if (el.length) {
               if (el.is(":input")) {
                  el.val(data.data[i]);
               } else {
                  el.html(data.data[i]);
               }
            }
         }
      }

    //end
    //init Spacetree
    //Create a new ST instance
    var st = new $jit.ST({
        orientation: "top",
        width: 900,
        height: 800,
        subtreeOffset: 10,
        siblingOffset: 6,
        //id of viz container element
        injectInto: 'infovis',
        //set duration for the animation
        duration: 500,
        //set animation transition type
        transition: $jit.Trans.Quart.easeInOut,
        //set distance between node and its children
        levelDistance: 50,
        //enable panning
        Navigation: {
          enable:true,
          panning:true
        },
        //set node and edge styles
        //set overridable=true for styling individual
        //nodes or edges
        Node: {
            type: 'rectangle',
            color: '#000',
            lineWidth: 2,
            width:120,
            height: 80,
            overridable: true,
            align: "left"
        },
        
        Edge: {
            type: 'bezier',
            lineWidth: 2,
            color: '#000',
            overridable: true
        },
        Events: {
         enable: true,
         onClick: function(node, eventInfo, e) {
            for (var i in node.data) {
               if (!i.match(/^\$/)) {
                  if ($("#"+i).length) {
                     $("#"+i).val(node.data[i]);
                  }
               }
            }
         }
        },
        onBeforeCompute: function(node){
            // Log.write("loading " + node.name);
        },
        
        onAfterCompute: function(){
            // Log.write("done");
        },
        
        //This method is called on DOM label creation.
        //Use this method to add event handlers and styles to
        //your node.
        onCreateLabel: function(label, node){
            label.id = node.id;            
            label.innerHTML = node.name + "<br><span class='small'>" + node.data.Title + "</span>";
            label.onclick = function(){
              st.onClick(node.id);
            };
            //set label styles
            var style = label.style;
            style.width = 114 + 'px';
            style.height = 70 + 'px';            
            style.cursor = 'pointer';
            style.color = '#333';
            style.fontSize = '1.1em';
            // style.textAlign= 'center';
            style.paddingTop = '8px';
            style.paddingLeft = '5px';
        },
        //This method is called right before plotting
        //a node. It's useful for changing an individual node
        //style properties before plotting it.
        //The data properties prefixed with a dollar
        //sign will override the global node style properties.
        onBeforePlotNode: function(node){
            //add some color to the nodes in the path between the
            //root node and the selected node.
            if (node.selected) {
                node.data.$color = "#fff";
            } else {
                delete node.data.$color;
                node.data.$color = "#adf";
                //if the node belongs to the last plotted level
                if(!node.anySubnode("exist")) {
                    //count children number
                    var count = 0;
                    node.eachSubnode(function(n) { count++; });
                    //assign a node color based on
                    //how many children it has
                    // node.data.$color = ['#cfd', '#fcd', '#dfc', '#fcf', '#ccf', '#ddd', '#fdd', '#dfd', '#fdf', '#ddf', '#eee', '#fee', '#efe', '#fef', '#eef', '#fff'][count];
                    node.data.$color = ['#d05be5', '#ad5be5', '#895be5', '#665be5', '#5b73e5', '#5b97e5', '#5bbae5', '#5bdde5', '#5be5ca', '#5be5a7', '#5be584', '#5be561', '#79e55b', '#9ce55b', '#bfe55b', '#e2e55b', '#e5c55b', '#e5a25b', '#e57e5b', '#e55b5b'][count];
                    console.log("Node: " + node.name + "\n\tFound " + count + " children.  Assigning color: " + node.data.$color);
                    //node.data.$color = '#ddd';
                }
            }
        },
        
        //This method is called right before plotting
        //an edge. It's useful for changing an individual edge
        //style properties before plotting it.
        //Edge data proprties prefixed with a dollar sign will
        //override the Edge global style properties.
        onBeforePlotLine: function(adj){
            if (adj.nodeFrom.selected && adj.nodeTo.selected) {
                adj.data.$color = "#68b";
                adj.data.$lineWidth = 3;
            }
            else {
                delete adj.data.$color;
                delete adj.data.$lineWidth;
            }
        }
    });
    //load json data
    st.loadJSON(json);
    //compute node positions and layout
    st.compute();
    //optional: make a translation of the tree
    st.geom.translate(new $jit.Complex(-200, -200), "current");
    //emulate a click on the root node.
    st.onClick(st.root);
    //end
    //Add event handlers to switch spacetree orientation.
    var top = $jit.id('r-top'), 
        left = $jit.id('r-left'), 
        bottom = $jit.id('r-bottom'), 
        right = $jit.id('r-right'),
        normal = $jit.id('s-normal');
        
    
    function changeHandler() {
        if(this.checked) {
            top.disabled = bottom.disabled = right.disabled = left.disabled = true;
            st.switchPosition(this.value, "animate", {
                onComplete: function(){
                    top.disabled = bottom.disabled = right.disabled = left.disabled = false;
                }
            });
        }
    };
    
    top.onchange = left.onchange = bottom.onchange = right.onchange = changeHandler;
    //end

   });
}
