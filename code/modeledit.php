<?php
   include(($_SERVER['DOCUMENT_ROOT'] ? $_SERVER['DOCUMENT_ROOT'].'/': '')."lib/auth.php");
   
   $in['pid'] = ($in['pid'])? $in['pid'] : 237;
   
   $boss = new boss();
   $process = $boss->getObject('Process', $in['pid']);
   $model = $boss->getModel($in['pid']);

?>
<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title>Column Model Editor</title>
      <link rel='stylesheet' type='text/css' href='/lib/css/jsonedit.css' />
  </head>
   <body>
      <form id='gridform'>
         <textarea id='jsondata' name='jsondata' style="float:left;" cols='80' rows='10'></textarea>
         <textarea id='jsonresults' name='jsondata' cols='80' rows='10'></textarea>
         <div id='main'>
            
         </div>
         <div class='btn' id='doserial'>Serialize</div>
      </form>
   </body>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
   <script type="text/javascript" src="/lib/js/json2.js"></script>
   <script type="text/javascript" src="/lib/js/jsonedit.js"></script>
   <script type='text/javascript'>
      $(document).ready(function() {
         var obj = <?php print $model->Config; ?>; 
         
         $("#main").on("click", "th.collapsible", function() { 
            $(this).toggleClass("closed").toggleClass("open"); 
            $(this).closest("tr").next().toggleClass("hidden");
         });
         
         $("#gridform").submit(function(e) { return renderJSON(e, obj); });
         
         $("#doserial").click(function() { $('#jsonresults').val(JSON.stringify(obj)); return false; });
         
         $("#main").on("focus", ":input", function() { $(this).addClass("focus", 200); }).on("blur", ":input", function() { $(this).removeClass("focus", 200); });
         
         $(".btn").mousedown(function() { $(this).css({"position":"relative","top":"4px"}); }).mouseup(function() { $(this).css({"position":"relative","top":"0px"}); });
         
         renderJSON(obj);
      });
   </script>
</html>
