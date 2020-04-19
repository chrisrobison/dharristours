<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title>JSON Editor</title>
      <link rel='stylesheet' type='text/css' href='/lib/css/jsonedit.css' />
  </head>
   <body>
      <form id='gridform'>
         <textarea id='jsondata' name='jsondata' style="float:left;" cols='60' rows='10'></textarea>
         <textarea id='jsonresults' name='jsondata' cols='60' rows='10'></textarea>
         <div id='main'>
            
         </div>
         <div class='btn' id='doserial'>Serialize</div>
         <div class='btn' id='view'>View JSON</div>
      </form>
   </body>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
   <script type="text/javascript" src="/lib/js/json2.js"></script>
   <script type="text/javascript" src="/lib/js/jsonedit.js"></script>
   <script type='text/javascript'>
      var obj;
      $(document).ready(function() {
         $("#main").on("click", "th.collapsible", function() { 
            $(this).toggleClass("closed").toggleClass("open", 200); 
            $(this).closest("tr").next().toggleClass("hidden", 200);
         });
         $("#gridform").submit(function(e) { 
            obj = JSON.parse( $("#jsondata").val() ); 
            renderJSON(obj);
            return false;
         });
         $("#view").click(function(e) { 
            obj = JSON.parse( $("#jsondata").val() ); 
            renderJSON(obj);
            return false;
         });
         $("#doserial").click(function(e) {
            $('#jsonresults').val(JSON.stringify(obj)); 
            return false; 
         });
         $("#main").on("focus", "input.val", function() { $(this).addClass("focus", 200); }).on("blur", "input.val", function() { $(this).removeClass("focus", 200); });
         $(".btn").mousedown(function() { $(this).css({"position":"relative","top":"4px"}); }).mouseup(function() { $(this).css({"position":"relative","top":"0px"}); });
         
         $("#main").on("click", "th.label", function(e) {
            $("span", $(this)).css("display", "inline-block");
            var w = $(this).width();
            $("input.key").hide();
            $("input.key", $(this)).css({"width": w, "float":"right"}).show().focus();
         });
         $("#main").on("focusout", "th.label", function(e) {
            $("input.key", $(this)).change();
            $("span", $(this)).html($("input.key", $(this)).val());
            $("input.key").hide();
         });

   });
   </script>
</html>
