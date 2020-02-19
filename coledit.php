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
      <title></title>
      <style>
         #main { position:relative;width:35em; }
         .value { color:#cc0000; }
         .children { color:#006600; }
         .summary { color:#006600; }
         .boolean { color:#0000cc; }
         ul { padding:0;margin:0 1em;list-style-type:none; }
         li { padding: .25em 0 0 0; }
         label { display:inline-block; width:6em; text-align:right;margin-right:.25em; }
         .toggleArrow { margin-right:.5em;float:left;cursor:pointer;position:relative;top:-3px;}
         .type { font-size:.8em; }
         tr th { text-align:right; padding-right:1em; white-space:nowrap;font-weight:normal;vertical-align:top; padding-left:1.95em;}
         tr th th { text-align:right; padding-right:1em; white-space:nowrap;font-weight:normal;vertical-align:top; padding-left:1.95em;}
         th.collapsible { padding-left:.75em; }
         th th.collapsible { padding-left:.75em; }
         table tr td { padding-left:.5em; padding-right:.5em; vertical-align:top;}
         table table { font-size:.9em; }
         table table th { padding-left:0px; }
      </style>
  </head>
   <body>
      <form id='gridform'>
      <div id='main'>
         
      </div>
      <button id='doserial'>Serialize</button>
      </form>
   </body>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
   <script type="text/javascript" src="/lib/js/json.js"></script>
   <script type='text/javascript'>
      var model = <?php print $model->Config; ?>;
      

      function genform(model) {
         var mtype, out = "<table border='0'>";
         for (var i in model) {
            mtype = typeof model[i];
            if ((mtype=="string" && ( model[i] == "true" || model[i] == "false")) || (mtype=="boolean")) {
               out += "<tr><th>"+i+"</th>";
               out += "<td><input type='checkbox' id='"+i+"' name='"+i+"' value='"+model[i]+"'"+((model[i]==true)?" checked='checked' ": '')+"></td></tr>";
            } else if ((mtype !== "object") && (mtype !== "array")) {
               out += "<tr><th>"+i+"</th>";
               out += "<td><input type='text' id='"+i+"' size='20' name='"+i+"' value='"+model[i]+"'></td></tr>";
            } else if (mtype === "object") {
               out += "<tr><th id='"+i+"' class='collapsible'><span class='toggleArrow'>&#9656;</span><span class='toggleArrow' style='display:none'>&#9662;</span> "+i+"</th>";
               out += "<td><span class='summary'>"+summerize(model[i])+"</span></td></tr>";
               out += "<tr id='content-"+i+"' style='display:none;'><td></td><td>"+genform(model[i])+"</td></tr>";
            }
         }
         out += "</table>";
         return out;
      }

      function isNumber(n) { return !isNaN(parseFloat(n)) && isFinite(n); }
      function isBoolean(n) { return typeof n === 'boolean'; }

      function summerize(obj) {
         var xtra = cnt = 0, out='';

         if ($.isArray(obj)) {
            out = '[ ';
            for (var i=0; i<3; i++) {
               if (isNumber(obj[i]) || isBoolean(obj[i])) {
                  out += "<span class='boolean'>" + obj[i] + '</span>, ';
               } else if (!$.isArray(obj[i]) && typeof obj[i] === "object") {
                  out += '<span class="children">'+summerize(obj[i]) + '</span>, ';
               } else {
                  out += '<span class="value">"'+obj[i]+'"</span>, ';
               }
            }
            out += (obj.length - 3) + " more... ]";
         } else {
            out = "<span class='object'>{ ";
            for (var i in obj) {
               if (obj.hasOwnProperty(i)) {
                  if (cnt < 3) {
                     if (isNumber(obj[i]) || isBoolean(obj[i])) {
                        out += i + '=<span class="boolean">' + obj[i] + '</span>, ';
                     } else if (!$.isArray(obj[i]) && typeof obj[i] === "object") {
                        out += '<span class="children">' + summerize(obj[i]) + '</span>, ';
                     } else {
                        out += i + '=<span class="value">"' + obj[i] + '"</span>, ';
                     }
                  } else {
                     xtra++;
                  }
                  cnt++;
               }
            }
            if (xtra) out += xtra + " more...";
            out = out.replace(/,\s*$/, '');
            out += " }</span>";
         }

         return out;
      }
      $(document).ready(function() {
         var out = genform(model); 
         $("#main").append(out);
         $("span.toggleArrow").click(function() { 
            $("span.toggleArrow", $(this).parent()).toggle(); 
            var id = $(this).parent().attr('id');
            $("#content-"+id).toggle();
         });
         $("#doserial").click(function() { myjson = $('#gridform').serialize(); alert(myjson); });
      });
   </script>
</html>
