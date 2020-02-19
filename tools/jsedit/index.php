<?php
   include(($_SERVER['DOCUMENT_ROOT'] ? $_SERVER['DOCUMENT_ROOT'].'/': '')."lib/auth.php");
   
   $in['pid'] = ($in['pid'])? $in['pid'] : 237;
   
   $boss = new boss('admin.dev.sscsf.com');
   $process = $boss->getObject('Process', $in['pid']);
   $model = $boss->getModel($in['pid']);

?>
<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title></title>
      <style>
         #main { position:relative;width:25em;border:1px solid #666; }
         fieldset { margin:0;padding:0;position:relative; left:0; }
         fieldset.collapsed { padding:0;margin:0; height:0px;border-width:1px 0 0 0;}
         fieldset legend { margin:0;padding:0;cursor:default; width:6em; position:relative;}
         ul { padding:0;margin:0 1em;list-style-type:none; }
         li { padding: .25em 0 0 0; }
         label { display:inline-block; width:6em; text-align:right;margin-right:.25em; }
         .toggleArrow { margin-right:.5em; }
      </style>
  </head>
   <body>
      <form id='gridform' onsubmit='return false;'>
      <div id='main'>
         
      </div>
      <textarea id='jsonstring' name='jsonstring' cols='80' rows='10'></textarea><br>
      <button id='dotree'>Edit JSON</button>
      <button id='doserial'>Serialize</button>
      </form>
   </body>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
   <script type="text/javascript" src="/lib/js/jquery.collapsible.js"></script>
   <script type='text/javascript'>

      function genform(model) {
         var mtype, out = "<ul class='jsonForm'>";
         for (var i in model) {
            mtype = typeof model[i];
            if ((mtype=="string" && ( model[i] == "true" || model[i] == "false")) || (mtype=="boolean")) {
               out += "<li><label>"+i+"</label><input type='checkbox' id='"+i+"' name='"+i+"' value='"+model[i]+"'"+((model[i]==true)?" checked='checked' ": '')+"></li>";
            } else if ((mtype !== "object") && (mtype !== "array")) {
               out += "<li><label>"+i+"</label><input type='text' id='"+i+"' size='20' name='"+i+"' value='"+model[i]+"'></li>";
            } else if ((typeof model[i] === "object") || (typeof model[i] === "array")) {
               out += "<li><fieldset title='"+i+"' class='collapsible'><legend><span class='toggleArrow'>&#x229E;</span><span class='toggleArrow' style='display:none'>&#x229F;</span> "+i+"</legend> "+genform(model[i])+"<br></fieldset></li>";
            }
         }
         out += "</ul>";
         return out;
      }
      
      $(document).ready(function() {
         $("fieldset.collapsible").collapse( { closed: true } );
         $("span.toggleArrow").click(function() { $("span.toggleArrow", $(this).parent()).toggle("fast"); });
         $("#doserial").click(function() { myjson = $('#gridform').serialize(); alert(myjson); return false;});
         $("#dotree").click(function() { 
               var data = eval($('#jsonstring').val());
               debugger;
               var markup = genform(data);
               $("#main").append(markup);
               return false;  
         });
      });
   </script>
</html>
