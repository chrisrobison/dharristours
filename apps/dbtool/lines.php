<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="en">
<head>
	<meta equiv="Content-type" content="text/html; charset=utf8" />
   <link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js" type="text/javascript"></script>
	<style type="text/css">
	canvas {
		position:absolute;
		width: 100%;
		height: 100%;
	}
	.blk h1, .blk ul, .blk li {
		margin:0;
		padding:0;
		list-style:none
	}
	.ui-dialog {
      opacity: .6;
   }
   /*
	.blk {
		opacity: 0.9;
		border:1px solid #000;
		background:#fff;
		position:absolute;
		padding: 5px;
		z-index: 10
	}
	#blk-a{
		left:15px;
		top:50px;
	}
	#blk-b{
		left:375px;
		top:250px;
	}
	#blk-c{
		left:275px;
		top:50px;
	}
	*/
	</style>
	<script type = "text/javascript">
	function updateCanvas(canvasJq, blkEls) {
		var canvasEl = canvasJq[0];
		canvasEl.width = canvasJq.width();
		canvasEl.height = canvasJq.height();
		var cOffset = canvasJq.offset();
		var ctx = canvasEl.getContext("2d");
		ctx.clearRect(0, 0, canvasEl.width, canvasEl.height);
		ctx.beginPath();
		$(blkEls).each(function(){
			$("li", this).each(function(){
				var li = $(this);
				if (li.attr("rel")) {
					var tgt, src, srcOffset = li.offset();
               var links = li.attr("rel").split(/ /);
               
               for (var l in links) {
                  var targetLi = $("#"+links[l]);
                  
                  if (targetLi.length) {
                     var tgtOffset = targetLi.offset();

                     src = { 
                              left: (srcOffset.left - cOffset.left), 
                              top: (srcOffset.top - cOffset.top),
                              cx: (((tgtOffset.left - cOffset.left) - (srcOffset.left - cOffset.left)) * .25),
                              cy: -(((tgtOffset.top - cOffset.top) - (srcOffset.top - cOffset.top)) * .25)
                           };
                     tgt = { 
                              left: (tgtOffset.left - cOffset.left),
                              top: (tgtOffset.top - cOffset.top),
                              cx: -(((tgtOffset.left - cOffset.left) - src.left) * .25),
                              cy: (((tgtOffset.top - cOffset.top) - src.top) * .25)
                           };
                     ctx.moveTo(src.left, src.top);
                     ctx.bezierCurveTo(src.left + src.cx, src.top + src.cy, tgt.left + tgt.cx, tgt.top + tgt.cy, tgt.left, tgt.top);
                     // ctx.lineTo(tgtOffset.left - cOffset.left, tgtOffset.top - cOffset.top + tgtMidHeight);
                  }
               }
				}
			});
		});
      ctx.lineWidth = 4;
      ctx.strokeStyle = "#09c";
      ctx.shadowOffsetX = 2;
      ctx.shadowOffsetY = 2;
      ctx.shadowBlur = 3;
      ctx.shadowColor = "rgba(0,0,0,.5)";

		ctx.stroke();
		ctx.closePath();
	}
	
	$(document).ready(function() {
      $(".blk").each(function() {
         $(this).dialog({autoOpen: false, title:$("h1", this).html()});
         $(this).dialog('open');
         updateCanvas($("#canvas"), $(this));
      });
      $(".ui-draggable").draggable({
         drag: function() {
            updateCanvas($("#canvas"), $(".blk"));
         }
      });
   });
	
	</script>
</head>
<body>
    <div id="blk-a" class="blk">

		<h1>Object 1</h1>
		<ul>
			<li id="a" rel="c">Item A</li>
			<li id="b" rel="e">Item B</li>
			<!--<li id="g" rel="e d">Item G</li>-->
		</ul>
	</div>
   <div id="blk-b" class="blk">

		<h1>Object 2</h1>
		<ul>
			<li id="c">Item C</li>
			<li id="d">Item D</li>
		</ul>
	</div>
   <div id="blk-c" class="blk">
		<h1>Object 3</h1>
		<ul>
			<li id="e">Item E</li>
			<li rel="a d" id="f">Item F</li>
		</ul>
	</div>
	<canvas id="canvas"></canvas>

</body>
</html>
