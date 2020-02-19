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
   var json = {};
   $.getJSON("orgchart.php?id="+id, function(data) {
      json = data;
      var rgraph = new $jit.RGraph({
         injectInto: 'infovis',
         background: { CanvasStyles: { strokeStyle: '#555' } },
         Navigation: { enable: true, panning: true, zooming: 10 },
         Node: { color: '#ddeeff' },
         Edge: { color: '#C17878', lineWidth:1.5 },
         onBeforeCompute: function(node){
             Log.write("centering " + node.name + "...");
             $jit.id('inner-details').innerHTML = node.data.relation;
         },
         
         onCreateLabel: function(domElement, node){
             domElement.innerHTML = node.name;
             domElement.onclick = function(){
                 rgraph.onClick(node.id, {
                     onComplete: function() {
                         Log.write("done");
                     }
                 });
             };
         },
         
         onPlaceLabel: function(domElement, node){
            var style = domElement.style;
            style.display = '';
            style.cursor = 'pointer';

            if (node._depth <= 1) {
                style.fontSize = "0.8em";
                style.color = "#ccc";
            } else if(node._depth == 2){
                style.fontSize = "0.7em";
                style.color = "#494949";
            } else {
                style.display = 'none';
            }

            var left = parseInt(style.left);
            var w = domElement.offsetWidth;
            style.left = (left - w / 2) + 'px';
         }
      });
      
      rgraph.loadJSON(json);
      
      rgraph.graph.eachNode(function(n) {
         var pos = n.getPos();
         pos.setc(-200, -200);
      });

      rgraph.compute('end');
      
      rgraph.fx.animate({
         modes:['polar'],
         duration: 2000
      });
   });
}
