<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title></title>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
      <script src="jquery.easing.js" type="text/javascript"></script>
      <script src="jqueryFileTree.js" type="text/javascript"></script>
      <link href="jqueryFileTree.css" rel="stylesheet" type="text/css" media="screen" />
      <style type="text/css">
         body { padding:0px;margin:0px;font-size:9px; }
         #main { position:absolute;top:0px;bottom:0px;left:0px;right:0px; }
         #fileTree { position:absolute;top:0px;bottom:0px;left:0px;width:380px;padding:10px;border-right:outset 3px #666666; overflow-x:auto;overflow-y:scroll; }
         #browser { position:absolute;top:0px;bottom:4px;left:405px;right:4px;border-left:outset 2px #cccccc; background-color: #eeeeee; }
         #browserFrame { position:absolute;top:0px;bottom:4px;left:0px;right:4px;overflow:scroll; }
      </style>
      <script type="text/javascript">
         var config = {
            docroot: '<?php print $_SERVER['DOCUMENT_ROOT']; ?>',
            loadfile: '<?php print $_REQUEST['load']; ?>'
         }

         function view(filename) {
            var ftype = $("li a[rel='"+filename+"']").attr('type');
            var shortpath = filename.split(config.docroot)[1];
            if (top.updateStatus)  top.updateStatus('Path: /files/'+shortpath);
            if (ftype != "dir") {
               $("#browserFrame").attr("src", shortpath);
            } else {
               $("#browserFrame").attr("src", "view.php?path="+shortpath);
            }            
         }

         $(document).ready( function() {
            $('#fileTree').fileTree({ root: '<?php print $_SERVER['DOCUMENT_ROOT']; ?>/', script: 'connectors/jqueryFileTree.php' }, function(filename) {view(filename);});
            if (config.loadfile) {
               view(loadfile);
            }
         });
      </script>
   </head>
   <body>
      <div id="fileTree">

      </div>
      <div id="browser">
         <iframe id="browserFrame" name="browserFrame" height="100%" width="100%" scrolling="yes">

         </iframe>
      </div>
   </body>
</html>

