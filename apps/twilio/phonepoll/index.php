<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title></title>
      <style>
         body { margin:0;padding:0;font-size:12px;font-family:"Helvetica Neue",Optima,Verdana,sans-serif; background-color:#eee;}
         a { text-decoration:none;color:#00c; }
         a:hover { text-decoration:underline; }
         a:visited { color:#006; }
         a:active { color:#e00;display:inline-block;top:2px; }
         #main { margin:1em; }
         a.addPhone { text-decoration:none;display:inline-block;width:12px;border:2px outset #ccc; padding:0px 3px 3px 3px; text-align:center;background-color:#ddd; }
         a.addPhone:active { position:relative; top:3px; }
      </style>
  </head>
   <body>
      <form action='makecall.php' method='POST' id='main'>
         <button>Start Poll</button><hr/>
         <div>Phone #: <input type='text' name='phone[]' value='' /><a class='addPhone' href="#add">+</a><br/></div>
      </form>
   </body>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type='text/javascript'>
      function addPhone() {
         $("#main div").get(0).clone().appendTo("#main");
         return false;
      }

      $(document).ready(function() {
         $("#main").on("click", ".addPhone", function(e) {
            var clone = $(this).parent().clone();
            $("#main").append(clone);
            e.stopPropagation();
            e.preventDefault();
            return false;
         });
      });
   </script>
</html>
