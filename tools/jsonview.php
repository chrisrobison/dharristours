<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title>JSON Editor</title>
      <link rel='stylesheet' type='text/css' href='jsonedit.css' />
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
   <script type="text/javascript" src="json2.js"></script>
   <script type="text/javascript" src="jsonedit.js"></script>
   <script type='text/javascript'>
      var obj;
      $(document).ready(function() {
         $("#main").on("click", "label", function(e) {
            $(this).css("display", "inline-block");
            var w = $(this).width();
            $("input.key").hide();
            $("input.key", $(this).parent()).css({"width": w, "float":"right"}).show().focus();
         });
         $("#main").on("click", "span.collapsible", function() { 
            $(this).toggleClass("closed").toggleClass("open"); 
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

            $("table").dblclick(function() {
               $(this).append("<tr><th><input type='text' class='key' value='New Key'><label>New Key</label></th><td><input type='text' class='val' value='New Value'></td></tr>");
            });

            return false;
         });
         $("#doserial").click(function(e) {
            $('#jsonresults').val(JSON.stringify(obj)); 
            return false; 
         });
         $("#main").on("focus", "input.val", function() { $(this).addClass("focus", 200); }).on("blur", "input.val", function() { $(this).removeClass("focus", 200); });
         $(".btn").mousedown(function() { $(this).css({"position":"relative","top":"4px"}); }).mouseup(function() { $(this).css({"position":"relative","top":"0px"}); });
         
         $("#main").on("focusout", "th.label", function(e) {
            $("input.key", $(this)).change();
            $("label", $(this)).html($("input.key", $(this)).val());
            $("input.key").hide();
         });

         $("#main").on("mouseenter", "tr", function() { 
            $(this).find(".delete").first().show();
         }).on("mouseleave", "tr", function() {
            $(this).find(".delete").first().hide();
         }).on("click", ".delete", function() {
            var data = $("input", $(this).parent()).data("val");
            delete data['obj'][data['key']];
            $(this).parents("tr").first().remove();
         });
         
   });
   </script>
</html>
