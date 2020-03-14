<?php
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
?>
<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title></title>
      <link rel='stylesheet' type='text/css' href='//ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/smoothness/jquery-ui.css' />
      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
      <script src="ajaxupload.js" type="text/javascript"></script>
      <script src="jquery.easing.js" type="text/javascript"></script>
      <script src="jqueryFileTree.js" type="text/javascript"></script>
      <script src="/lib/js/default.js" type="text/javascript"></script>
      <link href="jqueryFileTree.css" rel="stylesheet" type="text/css" media="screen" />
      <style type="text/css">
         body { padding:0px;margin:0px;font-size:10px; font-family: Tahoma, sans-serif;}
         #main { position:absolute;top:0px;bottom:0px;left:0px;right:0px; }
         #toolbar { position:fixed;top:0px;height:2.5em;width:400px;white-space:nowrap;overflow-x:auto;overflow-y:hidden;padding:2px;background:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAAsCAMAAACT+SJTAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAGBQTFRFAgICREREBAMDBgYGEhMTTU5NT1BQHR0eCAgJFRUVMzQ0UlJSAQIBLi4uERARDQwMCgoLNjY2Dw4OJSUkPT09QUBBODg5HR0dISAhKioqS0pLGhoaU1NTVFRUSEhIGBgYPzFKlAAAAEpJREFUeNoMy1sSgjAURMEWFPEFQgQTjbL/XXLr/E312HydZUnxcLV6WRz8fZx0bqpfVGOZQpSQKXz2jufm4mgwGz312qjBfRdgAJM2AwGJNoxsAAAAAElFTkSuQmCC") repeat-x scroll 0 -6px transparent; box-shadow: 0px 2px 3px rgba(0,0,0,.35);}
         #fileTree { position:absolute;top:2.75em;bottom:0px;left:0px;width:380px;padding:10px;border-right:outset 3px #666666; overflow-x:auto;overflow-y:scroll; }
         #browser { position:absolute;top:0px;bottom:4px;left:405px;right:4px;border-left:outset 2px #cccccc; background-color: #eeeeee; }
         #browserFrame { position:absolute;top:0px;bottom:4px;left:0px;right:4px;background-color:#fff; }
         #toolbar ul { list-style: none;margin:0;padding:0;}
         #toolbar li { float:left;height:25px; min-width:50px; padding-top:10px;vertical-align:middle;text-align:center;}
         #toolbar a { font-weight: bold; font-size:1.2em; color:#dedede; cursor: pointer;}
         #toolbar li:hover, .hover { cursor: pointer; outline: 1px outset #b0b0b0; }
         .tool { position: relative; padding: 1em;height: 45px; width: 50px; cursor: pointer; }
         #curpath { font-size:1.25em; color:#eee; margin-top:.25em; margin-left:.5em; display:inline-block; }
      </style>
<?php
   $full = $base = $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets . "/share";   // Replace with real account homedir once authentication is setup
   $shortpath = $boss->app->Assets . "/share";

   if ($in['dir']) {
      $base .= '/' . $in['dir'];
      $shortpath .= '/' . $in['dir'];
   }
   if ($in['path']) {
      $base .= $in['path']; 
      $shortpath .= $in['path'];
   }
   if ($in['up']) {
      $in['up'] = preg_replace("/^node/", '', $in['up']); 
      $base .= $in['up']; 
   }
?>
      <script type="text/javascript">
         var config = {
            docroot: '<?php print '/share/' . $in['dir']; ?>',
            file: '<?php print $in['file']; ?>'
         }

         function view(filename) {

         }
         var currentPath;
         $(document).ready( function() {
            $("#curpath").html('/<?php print $in['dir']; ?>');
            $('#fileTree').fileTree({ root: '<?php print '/share/' . $in['dir']; ?>', script: 'filetree.php' }, function(filename) { 
            console.log(filename);
               var ftype = $("li a[rel='"+filename+"']").attr('type');
               var shortpath = filename.split(config.docroot)[1];
               setCookie("path", shortpath, 1);
               config.file = shortpath;
               if (ftype != "dir") {
                  $("#browserFrame").attr("src", "/files/" + filename);
               } else {
                  $("#curpath").html('/<?php print $in['dir']; ?>' + shortpath).attr("title", '/<?php print $in['dir']; ?>' + shortpath);
                  $("#browserFrame").attr("src", "detail.php?path="+filename);
               }            
            });
         });
      </script>
   </head>
   <body>
      <div id="toolbar">
         <span id='curpath'></span>
      </div>
      <div id="fileTree">

      </div>
      <div id="browser">
         <iframe id="browserFrame" name="browserFrame" src="detail.php?path=/<?php print $in['dir']; ?>" height="100%" width="100%" scrolling="yes">

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

