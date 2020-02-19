<?php
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
?>
<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title></title>
      <link rel='stylesheet' type='text/css' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/smoothness/jquery-ui.css' />
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
      <script src="lib/ajaxupload.js" type="text/javascript"></script>
      <script src="lib/jquery.easing.js" type="text/javascript"></script>
      <script src="lib/jqueryFileTree.js" type="text/javascript"></script>
      <script src="/lib/js/default.js" type="text/javascript"></script>
      <link href="jqueryFileTree.css" rel="stylesheet" type="text/css" media="screen" />
      <link href="lib/filetree.css" rel="stylesheet" type="text/css" media="screen" />
      <style type="text/css">
         body { padding:0px;margin:0px;font-size:10px; font-family: Tahoma, sans-serif;}
         #main { position:absolute;top:0px;bottom:0px;left:0px;right:0px; }
         #toolbar { position:fixed;top:0px;height:50px;width:400px;padding:2px;background:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAAsCAMAAACT+SJTAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAGBQTFRFAgICREREBAMDBgYGEhMTTU5NT1BQHR0eCAgJFRUVMzQ0UlJSAQIBLi4uERARDQwMCgoLNjY2Dw4OJSUkPT09QUBBODg5HR0dISAhKioqS0pLGhoaU1NTVFRUSEhIGBgYPzFKlAAAAEpJREFUeNoMy1sSgjAURMEWFPEFQgQTjbL/XXLr/E312HydZUnxcLV6WRz8fZx0bqpfVGOZQpSQKXz2jufm4mgwGz312qjBfRdgAJM2AwGJNoxsAAAAAElFTkSuQmCC") repeat-x scroll 0 0 transparent;}
         #fileTree { position:absolute;top:50px;bottom:0px;left:0px;width:380px;padding:10px;border-right:outset 3px #666666; overflow-x:auto;overflow-y:scroll; }
         #browser { position:absolute;top:0px;bottom:4px;left:405px;right:4px;border-left:outset 2px #cccccc; background-color: #eeeeee; }
         #browserFrame { position:absolute;top:0px;bottom:4px;left:0px;right:4px;background-color:#fff; }
         #toolbar ul { list-style: none;margin:0;padding:0;}
         #toolbar li { float:left;height:25px; min-width:50px; padding-top:10px;vertical-align:middle;text-align:center;}
         #toolbar a { font-weight: bold; font-size:1.2em; color:#dedede; cursor: pointer;}
         #toolbar li:hover, .hover { cursor: pointer; outline: 1px outset #b0b0b0; }
         .tool { position: relative; padding: 1em;height: 45px; width: 50px; cursor: pointer; }
      </style>
      <script type="text/javascript">
         var config = {
            docroot: '<?php print $boss->app->Assets; ?>',
            file: '<?php print $in['file']; ?>',
            path: '/'
         }

         function view(filename) {

         }
         var currentPath;
         $(document).ready( function() {
            $('#fileTree').fileTree({ root: '/', script: 'filetree.php' }, function(filename) { 
               var ftype = $("li a[rel='"+filename+"']").attr('type');
               var re = new RegExp(config.docroot);
               var shortpath = filename.replace(re, '');
               
               debugger;
               
               setCookie("path", shortpath, 1);
               config.file = shortpath;

               if (ftype != "dir") {
                  $("#browserFrame").attr("src", filename);
               } else {
                  $("#browserFrame").attr("src", "detail.php?path="+shortpath);
               }
            });
            $("#folderBtn").click(function() { 
               var newdir = prompt("New folder name:");
               if (!newdir) return true;
               $.ajax({url:"cmd.php",data:{x:"mkdir",name:newdir},success:function(data) { alert("success! "+data); }});
            });
            $("#deleteBtn").click(function() { 
               if (!config.file) return false;
               if (!confirm("Are you sure you want to delete the file:\n" + config.file.replace(/\/$/,'') ) ) {
                  return true;
               }
               $.ajax( { url: "cmd.php", data: { 
                     "x": "delete", "name": config.file.replace(/\/$/,'') 
                  }, success: function(data) { 
                     alert("Results: "+data); 
                  }
               });
            });


            new Ajax_upload('uploadBtn', {
               action: 'upload.php',
               onSubmit : function(file , ext){
                  this.setData({'path':config.file});
                  this.disable();
               },
               onComplete : function(file){
                  this.enable();
               }     
            });   

         });
      </script>
   </head>
   <body>
      <div id="toolbar">
         <ul>
            <li><a id="uploadBtn" class="tool">Upload</a></li>
            <li><a id="copyBtn" style="display:none" class="tool">Copy</a></li>
            <li><a id="moveBtn" style="display:none" class="tool">Move</a></li>
            <li><a id="deleteBtn" class="tool">Delete</a></li>
            <li><a id="folderBtn" class="tool">New Folder</a></li>
         </ul>
      </div>
      <div id="fileTree">

      </div>
      <div id="browser">
         <iframe id="browserFrame" name="browserFrame" src="detail.php?path=/" height="100%" width="100%" scrolling="yes">

         </iframe>
      </div>
      <div id="dialog" style="display:none;" title="File Upload">
         <p>Click the "Upload File" button below to select a file to upload.</p>
         <p>Uploaded files:</p>
         <ol class="files"></ol>
         <button id="sendFile">Upload File</button>
      </div>
   </body>
</html>

