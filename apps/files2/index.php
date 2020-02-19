<?php
   require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/auth.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Tree</title>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script type="text/javascript" src="/lib/js/jquery.cookie.js"></script>
	<script type="text/javascript" src="/lib/js/jquery.hotkeys.js"></script>
	<script type="text/javascript" src="/lib/js/ajaxupload.js"></script>
	<script type="text/javascript" src="jquery.jstree.js"></script>
	<link type="text/css" rel="stylesheet" href="themes/apple/style.css"/>
	<link type="text/css" rel="stylesheet" href="/lib/css/core.css"/>
	<link type="text/css" rel="stylesheet" href="filetree.css"/>
   <style>
      body { overflow-x: hidden; }
      div#files {
         background-color:#fefefe;
         overflow-y: scroll;
         overflow-x: auto;
         width: 345px;
         position:absolute;
         top:32px;
         left:0px;
         bottom:0px;
      }
      input[type=button] { display:block; float:left; }
      input.right { float:right; }
      div#contents { position:absolute;top:32px;bottom:0px;left:350px;right:0px; }
      input#copy { float: left; }
      #spinner{
      position:absolute;
      width:150px;
      height:186px;
      top:30%;
      left:40%;
      }

      .blockG{
      position:absolute;
      background-color:#transparent;
      width:24px;
      height:58px;
      -moz-border-radius:20px 20px 0 0;
      -webkit-border-radius:20px 20px 0 0;
      -webkit-transform:scale(0.4);
      -webkit-animation-name:fadeG;
      -webkit-animation-duration:1.04s;
      -webkit-animation-iteration-count:infinite;
      -webkit-animation-direction:linear;
      -moz-transform:scale(0.4);
      -moz-animation-name:fadeG;
      -moz-animation-duration:1.04s;
      -moz-animation-iteration-count:infinite;
      -moz-animation-direction:linear}

      #rotateG_01{
      -webkit-transform:rotate(-90deg);
      -moz-transform:rotate(-90deg);
      left:0;
      top:68px;
      -webkit-animation-delay:0.39s;
      -moz-animation-delay:0.39s}

      #rotateG_02{
      -webkit-transform:rotate(-45deg);
      -moz-transform:rotate(-45deg);
      left:19px;
      top:24px;
      -webkit-animation-delay:0.52s;
      -moz-animation-delay:0.52s}

      #rotateG_03{
      -webkit-transform:rotate(0deg);
      -moz-transform:rotate(0deg);
      left:63px;
      top:7px;
      -webkit-animation-delay:0.65s;
      -moz-animation-delay:0.65s}

      #rotateG_04{
      -webkit-transform:rotate(45deg);
      -moz-transform:rotate(45deg);
      right:19px;
      top:24px;
      -webkit-animation-delay:0.78s;
      -moz-animation-delay:0.78s}

      #rotateG_05{
      -webkit-transform:rotate(90deg);
      -moz-transform:rotate(90deg);
      right:0;
      top:68px;
      -webkit-animation-delay:0.9099999999999999s;
      -moz-animation-delay:0.9099999999999999s}

      #rotateG_06{
      -webkit-transform:rotate(135deg);
      -moz-transform:rotate(135deg);
      right:19px;
      bottom:17px;
      -webkit-animation-delay:1.04s;
      -moz-animation-delay:1.04s}

      #rotateG_07{
      -webkit-transform:rotate(180deg);
      -moz-transform:rotate(180deg);
      bottom:0;
      left:63px;
      -webkit-animation-delay:1.1700000000000002s;
      -moz-animation-delay:1.1700000000000002s}

      #rotateG_08{
      -webkit-transform:rotate(-135deg);
      -moz-transform:rotate(-135deg);
      left:19px;
      bottom:17px;
      -webkit-animation-delay:1.3s;
      -moz-animation-delay:1.3s}

      @-webkit-keyframes fadeG{
      0%{
      background-color:#000000}

      100%{
      background-color:#transparent}

      }

      @-moz-keyframes fadeG{
      0%{
      background-color:#000000}

      100%{
      background-color:#transparent}

      }
      #modal {
         position:absolute;
         top:0px;
         left:0px;
         right:0px;
         bottom:0px;
         opacity:.4;
         background-color:#000;
      }
   </style>
</head>
<body id="demo_body">
<div id="container">
   <div id="description">
      <div id="mmenu" style="height:30px; overflow:auto;">
         <input type="button" id="add_folder" value="add folder" />
         <input type="button" id="add_default" value="add file" />
         <input type="button" id="rename" value="rename" />
         <input type="button" id="remove" value="remove" />
         <input type="button" id="cut" value="cut" />
         <input type="button" id="copy" value="copy" />
         <input type="button" id="paste" value="paste" />
         <input type="button" id="upload" value="upload" />
         <input type="button" class='right' id="clear_search" value="clear" />
         <input type="button" class='right' id="search" value="search" />
         <input type="text" class='right' id="text" value="" />
      </div>

      <!-- the tree container (notice NOT an UL node) -->
      <div id='fileTree'>
         <div id="files" class="files"></div>
         <div id='toggleFilePane' class='simpleButton' title="Toggle filetree">&#9664;</div>
      </div>
      <div id="contents">
         <iframe id="browserFrame" name="browserFrame" src="detail.php?path=/" height="100%" width="100%" scrolling="yes">

         </iframe>
      </div>
<div id="bottomToolbar" style="display:none;height:30px; text-align:center;">
	<input type="button" style='width:170px; height:24px; margin:5px auto;' value="reconstruct" onclick="$.get('./ctl.php?reconstruct', function () { $('#files').jstree('refresh',-1); });" />
	<input type="button" style='width:170px; height:24px; margin:5px auto;' id="analyze" value="analyze" onclick="$('#alog').load('./ctl.php?analyze');" />
	<input type="button" style='width:170px; height:24px; margin:5px auto;' value="refresh" onclick="$('#files').jstree('refresh',-1);" />
</div>
<div id='alog' style="border:1px solid gray; padding:5px; height:100px; margin-top:15px; overflow:auto; font-family:Monospace;display:none;"></div>
<!-- JavaScript neccessary for the tree -->
<script type="text/javascript">
$(function () {
   new Ajax_upload('upload', {
      action: 'upload.php',
      onSubmit : function(file , ext){
         this.disable();
         spinner();
      },
      onComplete : function(file){
         this.enable();
         spinner(true);
         treeClick(config.current, config.path);
      }     
   });   

$("#files")
	.bind("before.jstree", function (e, data) {
		// $("#alog").append(data.func + "<br />");
	})
	.jstree({ 
		"plugins" : [ 
			"themes","json_data","ui","crrm","cookies","dnd","search","types","hotkeys","contextmenu" 
		],

		"json_data" : { 
			"ajax" : {
				"url" : "./ctl.php",
				"data" : function (n) { 
					return { 
						"x" : "get_children", 
						"id" : n.attr ? n.attr("id").replace("node_","") : "-_-" 
					}; 
				}
			}
		},
		"search" : {
			"ajax" : {
				"url" : "./ctl.php",
				"data" : function (str) {
					return { 
						"x" : "search", 
						"search_str" : str 
					}; 
				}
			}
		},
		// Using types - most of the time this is an overkill
		// read the docs carefully to decide whether you need types
		"types" : {
			"max_depth" : -2,
			"max_children" : -2,
			"valid_children" : [ "drive", "folder", "default" ],
			"types" : {
				"default" : {
					"valid_children" : "none",
					"icon" : {
						"image" : "/img/icons/file.png"
					}
				},
				"folder" : {
					"valid_children" : [ "default", "folder" ],
					"icon" : {
						"image" : "/img/icons/folder.png"
					}
				},
				"drive" : {
					"valid_children" : [ "default", "folder" ],
					"icon" : {
						"image" : "/img/icons/root.png"
					},
					"start_drag" : false,
					"move_node" : false,
					"delete_node" : false,
					"remove" : false
				}
			}
		},
		"ui" : {
			"initially_select" : [ "node_home" ]
		},
		"core" : { 
			"initially_open" : [ "node_home" ] 
		}
	})
	.bind("create.jstree", function (e, data) {
		$.post(
			"./ctl.php", 
			{ 
				"x" : "create", 
				"id" : data.rslt.parent.attr("id").replace("node_",""), 
				"position" : data.rslt.position,
				"title" : data.rslt.name,
				"type" : data.rslt.obj.attr("rel")
			}, 
			function (r) {
				if (r.status) {
					$(data.rslt.obj).attr("id", "node_" + r.id);
				} else {
					$.jstree.rollback(data.rlbk);
				}
			}
		);
	})
	.bind("remove.jstree", function (e, data) {
		data.rslt.obj.each(function () {
			$.ajax({
				async : false,
				type: 'POST',
				url: "./ctl.php",
				data : { 
					"x" : "remove", 
					"id" : this.id.replace("node_","")
				}, 
				success : function (r) {
					if (!r.status) {
						data.inst.refresh();
					}
				}
			});
		});
	})
	.bind("rename.jstree", function (e, data) {
		$.post("./ctl.php", { 
				"x" : "rename", 
				"id" : data.rslt.obj.attr("id").replace("node_",""),
				"title" : data.rslt.new_name
			}, 
			function (r) {
				if (!r.status) {
					$.jstree.rollback(data.rlbk);
				}
			}
		);
	})
	.bind("move_node.jstree", function (e, data) {
		data.rslt.o.each(function (i) {
			$.ajax({
				async : false,
				type: 'POST',
				url: "./ctl.php",
				data : { 
					"x" : "move", 
					"id" : $(this).attr("id").replace("node_",""), 
					"ref" : data.rslt.cr === -1 ? "-_-" : data.rslt.np.attr("id").replace("node_",""), 
					"position" : data.rslt.cp + i,
					"title" : data.rslt.name,
					"copy" : data.rslt.cy ? 1 : 0
				},
				success : function (r) {
               if (!r.status) {
						$.jstree.rollback(data.rlbk);
					} else {
						$(data.rslt.oc).attr("id", "node_" + r.id);
						if (data.rslt.cy && $(data.rslt.oc).children("UL").length) {
							data.inst.refresh(data.inst._get_parent(data.rslt.oc));
						}
					}
					$("#analyze").click();
				}
			});
		});
	})
   .bind("select_node.jstree", function(event, data) {
      var file = data.rslt.obj.attr("id").replace(/\-_\-/g, "/");
      
      if ($(data.rslt.obj[0]).attr("rel") == "folder") {
         $("#browserFrame").attr("src", "detail.php?path=" + file);
      } else if (file.match(/\.(txt|sh|xml|json|php|jsp|asp|cgi|pl|rb|py|js|css)$/i)) {
         $("#browserFrame").attr("src", "edit.php?path=" + file);
      } else if (file.match(/\.(png|jpg|jpeg|gif|bmp|ico|svg|swf)$/i)) {
         $("#browserFrame").attr("src", "view.php?file=" + file);
      } else if (file.match(/\.(htm|html)$/)) {
         $("#browserFrame").attr("src", "/apps/edit/?file=" + file);
      } else {
         $("#browserFrame").attr("src", "download.php?file=" + file);
      }
      
      console.log(file);

   });
   setTimeout(function() { spinner(true); }, 1000);
});
</script>
<script type="text/javascript" class="source below">
// Code for the menu buttons
$(function () { 
	$("#mmenu input").click(function () {
		switch(this.id) {
			case "add_default":
			case "add_folder":
				$("#files").jstree("create", null, "last", { "attr" : { "rel" : this.id.toString().replace("add_", "") } });
				break;
			case "search":
				$("#files").jstree("search", document.getElementById("text").value);
				break;
			case "text": break;
			default:
				$("#files").jstree(this.id);
				break;
		}
	});
});

function spinner(hide) {
   if (hide) {
      $("#spinner").hide();
      $("#modal").hide();
   } else {
      $("#spinner").show();
      $("#modal").show();
   } 
}


</script>
</div>

</div>
      <div id="modal"></div>
      <div id="spinner">
         <div class="blockG" id="rotateG_01"> </div>
         <div class="blockG" id="rotateG_02"> </div>
         <div class="blockG" id="rotateG_03"> </div>
         <div class="blockG" id="rotateG_04"> </div>
         <div class="blockG" id="rotateG_05"> </div>
         <div class="blockG" id="rotateG_06"> </div>
         <div class="blockG" id="rotateG_07"> </div>
         <div class="blockG" id="rotateG_08"> </div>
      </div>

</body>
</html>
