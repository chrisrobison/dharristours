<?php
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title></title>
      <link href='/lib/css/core.css' rel='stylesheet' type='text/css' />
      <link href='/lib/css/Aristo/jquery-ui-1.8.5.custom.css' rel='stylesheet' type='text/css' />
      <link href='lib/filetree.css' rel='stylesheet' type='text/css' />
      <script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js'></script>
      <script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js'></script>
      <script src='lib/filetree.js' type='text/javascript'></script>
      <script src='/lib/js/default.js' type='text/javascript'></script>
      <script type='text/javascript'>
         var config = {
            docroot: '<?php print $boss->app->Assets; ?>',
            file: '<?php print $in['file']; ?>',
            path: '/',
            view: "list"
         }

         function view(filename) {

         }
         function treeClick(el, filename) { 
            var item = config.current = $(el), br = $("#browser"), mf = $("#mainPane");
            config.path = filename;

            // var item = config.current = $("li a[rel='"+filename+"']");
            var ftype = item.attr('type');
            $('.selected').removeClass('selected');
            item.addClass('selected');
            var re = new RegExp(config.docroot);
            var shortpath = filename.replace(re, '');
            if (top && top.updateStatus) {
               top.updateStatus('Path: /files'+shortpath);
            }
            if (ftype != "dir") {
               config.file = shortpath;
               if (!filename.match(/\.(php|js|css|html|txt|jsp|py|cgi|shtml|htm)$/)) {
                  $("#browserFrame").attr("src", config.docroot + filename);
               } else {
                  if (filename.match(/\.(htm|html|shtml|asp|jsp)$/)) {
                     $("#browserFrame").attr("src", "/apps/edit/?file="+shortpath);
                  } else {
                     $("#browserFrame").attr("src", "edit.php?path="+shortpath);
                  }
               }
            } else {
               config.path = shortpath;
               config.file = '';
               setCookie("path", shortpath, 1);
               $("#browserFrame").attr("src", config.view + ".php?path="+shortpath);
            }
            return false;
         }         
         
         var currentPath;
         
         $(document).ready( function() {
            $("#treeRoot").click(function() {
                  config.path = '/';
                  config.file = '';
                  setCookie("path", '/', 1);
            });
            spinner(true);
            eraseCookie('path');
            $('#fileTreeFiles').fileTree({ root: '/', script: 'filetree.php' }, function(el, filename) { treeClick(el, filename); });
            
            $("#folderBtn").click(function() { 
               var newdir = prompt("New folder name:");
               if (!newdir) return true;
               var newpath = config.path + newdir;
               debugger;
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
               $("#mainPane").toggleClass("open", 250).toggleClass("closed", 250);
               $("#browser").toggleClass("open", 250).toggleClass("closed", 250);
               $("#toggleFilePane").toggleClass("open", 250).toggleClass("closed", 250);
               /*
               if (!$("#mainPane").data("open")) {
                  $("#mainPane").animate({"width":"360px"}, 250).data("open", true);
                  $("#browser").animate({"left":"365px"}, 250);
                  $(this).html("&#9664;").css({"right":"1px"});
               } else {
                  //$("#mainPane").animate({"width":"0px"}, 250).data("open", false);
                  $("#browser").animate({"left":"0px"}, 250);
                  $(this).html("&#9654;").css({"right":"-16px"});
               }
               */
            });
            
            var tmpview = getCookie("view");
            if (tmpview) config.view = tmpview;
            $("#browserFrame").attr("src", config.view + ".php?path="+config.path);
            $(".active").removeClass("active");
            $("#" + config.view + "View").addClass("active");
            $("#mainPane").data("open", true);

            new Ajax_upload('uploadBtn', {
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
            $(".view").click(function() {
               var me = $(this), vid = me.attr("id").replace(/View/gi, '');
               $(".active").toggleClass("active");
               me.addClass("active");
                     
               setCookie("view", vid, 99999);
               $("#browserFrame").attr("src", vid + ".php?path="+config.path);
               config.view = vid;
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
   </head>
   <body>
      <div id="mainPane">
         <div id="buttons">
            <div id='toggleFilePane' class='simpleButton' title="Toggle filetree">&#9664;</div>
            <ul class=''>
               <li><a id="uploadBtn" class="button"><span class="ui-icon ui-icon-arrowthickstop-1-n"> </span>Upload</a></li>
               <!-- <li><a id="copyBtn" class="tool">Copy</a></li> -->
               <!-- <li><a id="moveBtn" class="tool">Move</a></li> -->
               <li><a id="folderBtn" title='New Folder' class="button"><span class="ui-simple ui-add-folder"> </span></a></li>
               <li>
                  <a id="iconView" title='Icon View' class="view button left"><span class="ui-simple ui-icon-view"> </span></a>
                  <!--<a id="imageView" title='Image View' class="view button middle"><span class="ui-simple ui-image-view"> </span></a>-->
                  <a id="listView" title='List View' class="view button right"><span class="ui-simple ui-list"> </span></a>
                  <!-- <a id="folderBtn" title='Tree View' class="button right"><span class="ui-simple ui-tree-view"> </span></a> -->
               </li>
               <li style='margin-right:2em;float:right;'><a id="deleteBtn" title='Delete' class="button"><span class="ui-simple ui-trash"> </span></a></li>
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
      <style>
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

