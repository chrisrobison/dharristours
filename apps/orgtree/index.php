<?php
   require($_SERVER['DOCUMENT_ROOT'] . "/lib/auth.php");
?>
<!DOCTYPE html> 
<html>
   <head>
      <meta charset="utf-8">
      <title></title>
      <link href='//fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
      <link href='//fonts.googleapis.com/css?family=Open+Sans:300,400,700,800' rel='stylesheet' type='text/css'>
      <style>
         body { margin:0;padding:0;font-size:14px;font-family:"Open Sans","Helvetica Neue",Helvetica,Arial,sans-serif; background-color:#223; color:#fff;}
         h1, h2, h3, h4, h5 { font-family: Quicksand, "Helvetica Neue", Optima, Verdana, sans-serif; }
         a { text-decoration:none;color:#00c; }
         a:hover { text-decoration:underline; }
         a:visited { color:#006; }
         a:active { color:#e00;display:inline-block;top:2px; }
         #main { margin:1em; }
         #visframe { 
            position: absolute;
            border: none;
            top:3em;
            bottom:0px;
            left:0px;
            right:0px;
         }
      </style>
  </head>
   <body>
      <div id='main'>
         <form>
            Visualization Style: 
            <select id='vis-style'>
               <option value='spacetree'>SpaceTree</option>
               <option value='hypertree'>HyperTree</option>
               <!-- <option value='rgraph'>RGraph</option> -->
            </select>
         </form>
      </div>
      <iframe id='visframe' name='visframe' height='100%' width='100%' src='spacetree.php?id=<?php print $in['id']; ?>'></iframe>
   </body>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type='text/javascript'>
      $(document).ready(function() {
         $("#vis-style").change(function(e) {
            $("#visframe").attr("src", $(this).val() + ".php?id=<?php print $in['id']; ?>");
         });
      });
   </script>
</html>
