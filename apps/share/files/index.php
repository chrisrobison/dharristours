<?php
 require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title></title>
      <script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAAB4Tz-wcF9vqMlgFlZ1il0RRjbVG5Y4s0r_l_MDg4lsqUuQtFaxSRYSm5z_5XxygiqdC08tzpJofuOQ"></script>
      <script type="text/javascript">
         google.load("jquery", "1");
      </script>
      <script src="jquery.easing.js" type="text/javascript"></script>
      <script src="files.js" type="text/javascript"></script>
      <link href="files.css" rel="stylesheet" type="text/css" media="screen" />
      <style type="text/css">
         body { padding:0px;margin:0px;font-size:9px; }
         #main { position:absolute;top:0px;bottom:0px;left:0px;right:0px; }
         #fileTree { position:absolute;top:0px;bottom:0px;left:0px;width:380px;padding:10px;border-right:outset 3px #666666; overflow-x:auto;overflow-y:scroll; }
         #browser { position:absolute;top:0px;bottom:4px;left:405px;right:4px;border-left:outset 2px #cccccc; background-color: #eeeeee; }
         #browserFrame { position:absolute;top:0px;bottom:4px;left:0px;right:4px;overflow:scroll; }
      </style>
      <script type="text/javascript">
         var config = {
            docroot: '<?php print "/share". $in['dir'] ? '/'.$in['dir'].'/':'/'; ?>'
         }

         function view(filename) {

         }

         $(document).ready( function() {
            $('#fileTree').fileTree({ root: '/', script: 'files.php' }, function(filename) { 
               var path = ($("li a[rel='"+filename+"']").attr('type') != "dir") ? '/files/share' + filename : 'view.php?path=/files/share'+filename;
               $("#browserFrame").attr("src", path);
            });
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

