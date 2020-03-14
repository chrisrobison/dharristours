<?php
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title></title>
      <link href='/lib/css/core.css' rel='stylesheet' type='text/css' />
      <link rel='stylesheet' type='text/css' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/smoothness/jquery-ui.css' />
      <link href='/lib/css/Aristo/jquery-ui-1.8.5.custom.css' rel='stylesheet' type='text/css' />
      <link href='lib/filetree.css' rel='stylesheet' type='text/css' />
      <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js'></script>
      <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js'></script>
      <script src="lib/ajaxupload.js" type="text/javascript"></script>
      <script src="lib/jquery.easing.js" type="text/javascript"></script>
      <script src="lib/jqueryFileTree.js" type="text/javascript"></script>
      <script src="/lib/js/default.js" type="text/javascript"></script>
       <!-- script src='/lib/js/default.js' type='text/javascript'></script -->
      <script type='text/javascript'>
         var config = {
            docroot: '<?php print $boss->app->Assets; ?>',
            file: '<?php print $in['file']; ?>',
            path: '/'
         }

         function view(filename) {

         }
         var currentPath;
         $(document).ready( function() {
            /* $("#treeRoot").click(function() {
                  config.path = '/';
                  config.file = '';
                  setCookie("path", '/', 1);
            }); */
            new Ajax_upload('uploadBtn', {
               action: 'upload.php',
               onSubmit : function(file , ext){
                  this.disable();
               },
               onComplete : function(file){
                  this.enable();
               }     
            });   

            eraseCookie('path');
            $('#fileTreeFiles').fileTree({ root: '/', script: 'filetree.php' }, function(el, filename) { 
               var item = config.current = $(el), br = $("#browser"), mf = $("#mainPane");

               // var item = config.current = $("li a[rel='"+filename+"']");
               var ftype = item.attr('type');
               $('.selected').removeClass('selected');
               item.addClass('selected');
               var re = new RegExp(config.docroot);
               var shortpath = filename.replace(re, '');

               if (ftype != "dir") {
                  config.file = shortpath;
                  if (!filename.match(/\.(php|js|css|html|txt|jsp|py|cgi|shtml|htm)$/)) {
                     $("#browserFrame").attr("src", config.docroot + filename);
                  } else {
                     if (filename.match(/\.(htm|html|shtml|asp|jsp)/)) {
                        $("#browserFrame").attr("src", "/apps/edit/?file="+shortpath);
                     } else {
                        $("#browserFrame").attr("src", "edit.php?path="+shortpath);
                     }
                  }
               } else {
                  config.path = shortpath;
                  config.file = '';
                  setCookie("path", shortpath, 1);
                  $("#browserFrame").attr("src", "detail.php?path="+shortpath);
               }
               return false;
            });
            $("#folderBtn").click(function() { 
               var newdir = prompt("New folder name:");
               if (!newdir) return true;
               var newpath = config.path + newdir;
               $.ajax({url:"cmd.php",data:{x:"mkdir",name:newpath},success:function(data) { 
                  var res = $.parseJSON(data);
                  alert("success! "+ res.result); }});
            });
            $("#deleteBtn").click(function() { 
               if (!config.file && !config.path) return false;
               if (!confirm("Are you sure you want to delete the "+((config.path && !config.file) ? "folder:" + config.path : "file" + config.file)+"?\n")) return true;
               $.ajax({url:"cmd.php",data:{x:"delete",name:((config.path && !config.file)?config.path:config.file.replace(/\/$/,''))},success:function(data) { 
                  config.current.remove();
                  alert("Results: "+data); 
               }});
               });
            $("#toggleFilePane").click(function(event) {
               if (!$("#mainPane").data("open")) {
                  $("#mainPane").animate({"width":"360px"}, 250).data("open", true);
                  $("#browser").animate({"left":"365px"}, 250);
                  $(this).html("&#9664;").css({"right":"1px"});
               } else {
                  $("#mainPane").animate({"width":"0px"}, 250).data("open", false);
                  $("#browser").animate({"left":"0px"}, 250);
                  $(this).html("&#9654;").css({"right":"-16px"});
               }
            });
            $("#mainPane").data("open", true);

         });
      </script>
   </head>
   <body>
      <div id="mainPane">
         <div id="toolbar">
            <div id='toggleFilePane' class='simpleButton' title="Toggle filetree">&#9664;</div>
            <ul>
               <li><a id="uploadBtn" class="simpleButton"><span class="ui-icon ui-icon-arrowthickstop-1-n"> </span>Upload</a></li>
               <!-- <li><a id="copyBtn" class="tool">Copy</a></li> -->
               <!-- <li><a id="moveBtn" class="tool">Move</a></li> -->
               <li><a id="deleteBtn" class="simpleButton"><span class="ui-icon ui-icon-closethick"> </span>Delete</a></li>
               <li><a id="folderBtn" class="simpleButton"><span class="ui-icon ui-icon-folder-open"> </span>New Folder</a></li>
            </ul>
         </div><br><br><br>
         <div id="fileTree">
            <ul id='treeRoot' class='filetree' rel='/'><li class='directory expanded'><a href='<?php print $_SERVER['REQUEST_URI']; ?>' type='dir' rel="<?php print $boss->app->Assets; ?>/">Home</a></li></ul>
            <div id="fileTreeFiles">
            </div>
         </div>
      </div>
      <div id="browser">
         <iframe id="browserFrame" name="browserFrame" src="detail.php?path=/" height="100%" width="100%" scrolling="yes">

         </iframe>
      </div>
      <div id="dialog" style="display:none;" title="Basic dialog with Upload button">
         <p>Click the "Upload File" button below to select a file to upload.</p>
         <p>Uploaded files:</p>
         <ol class="files"></ol>
         <button id="sendFile">Upload File</button>
      </div>
   </body>
</html>

