<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title>Object Tree</title>
      <link rel='stylesheet' type='text/css' href='/lib/css/core.css'>
  </head>
   <body>
      <div id='main'>
         <div id='treeWrap'>

         </div>
      </div>
   </body>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type='text/javascript'>
      $(document).ready(function() {
         function buildTree(data, tgt) {
            var cont,el,par,x,i, html;
            tgt.append("<ul>");
            for (i in data) {
               if (data.hasOwnProperty(i)) {
                  tgt.append("<li>" + i + ": " + data[i]);
                  if ((typeof(data[i])=='object') || (typeof(data[i])=='array')) {
                     buildTree(data[i], tgt);
                  } 
                  tgt.append("</li>");
               }
            }
            tgt.append("</ul>");
            return html;
         }

$.getJSON("/model.php?pid=235", function(data) {
            buildTree(data, $('#treeWrap'));
         });
      });
   </script>
</html>
