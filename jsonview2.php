<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title></title>
      <style>
         #main { position:relative;border:1px solid red; min-width:400px; min-height:300px; }
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
         .btn {
            color: #4f4f4f;
            font-weight: normal;
            font-size: 14px;
            padding: .125em .75em .25em .25em;
            background: -moz-linear-gradient(
               top,
               #f0f0f0 0%,
               #e0e0e0 49%,
               #d5d5d5 51%,
               #d7d7d7);
            background: -webkit-gradient(
               linear, left top, left bottom, 
               from(#f0f0f0),
               color-stop(0.49, #e0e0e0),
               color-stop(0.51, #d5d5d5),
               to(#d7d7d7));
            border-radius: 5px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border: 1px solid #bbbbbb;
            -moz-box-shadow:
               0px 1px 1px rgba(000,000,000,0.5),
               inset 0px 2px 1px rgba(255,255,255,0.4);
            -webkit-box-shadow:
               0px 1px 1px rgba(000,000,000,0.5),
               inset 0px 2px 1px rgba(255,255,255,0.4);
            text-shadow:
               0px 0px 0px rgba(000,000,000,0),
               0px 1px 0px rgba(255,255,255,1);
            border-color: #EEEEFF #999999 #999999 #EEEEFF;
            border-width:1px;
            border-style: solid;
            cursor: default;
            text-decoration: none;
            display: inline-block;
            height: 1.4em;
            margin: 4px 2px 0;
            outline: medium none;
            float:left;
          }
      </style>
  </head>
   <body>
      <form id='gridform'>
         <textarea id='jsondata' name='jsondata' cols='80' rows='10'></textarea>
         <div id='main'>
            
         </div>
         <div class='btn' id='doserial'>Serialize</div>
         <div class='btn' id='view'>View JSON</div>
      </form>
   </body>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
   <script type="text/javascript" src="/lib/js/json2.js"></script>
   <script type='text/javascript'>

      function genform(obj, editable) {
         if (obj) {
            var mtype, out = "<table border='0'>", i;
            for ( i in obj ) {
               mtype = typeof obj[i];
               if ( ( mtype=="string" && ( obj[i] == "true" || obj[i] == "false" ) ) || ( mtype=="boolean" ) ) {
                  out += "<tr><th>" + i + "</th>";
                  out += "<td><input type='checkbox' id='" + i + "' name='" + i + "' value='" + obj[i] + "'";
                  out += ( ( obj[i] == true ) ? " checked='checked' ": '' ) + "></td></tr>";
               } else if ( ( mtype !== "object" ) && ( mtype !== "array" ) ) {
                  out += "<tr><th>" + i + "</th>";
                  out += "<td><span class='val'>" + obj[i] + "</span></td></tr>";
                  if (editable) out += "<td><input type='text' id='"+i+"' size='20' name='"+i+"' value='"+obj[i]+"'></td>";
                  out += "</tr>";
               } else if (mtype === "object") {
                  out += "<tr><th id='" + i + "' class='collapsible'><span class='toggleArrow'>&#9656;</span><span class='toggleArrow' style='display:none'>&#9662;</span> " + i + "</th>";
                  out += "<td><span class='summary'>" + summerize( obj[i] ) + "</span></td></tr>";
                  out += "<tr style='display:none;'><td></td><td>" + genform( obj[i] ) + "</td></tr>";
               }
            }
            out += "</table>";
            return out;
         }
      }

      function isNumber(n) { return !isNaN(parseFloat(n)) && isFinite(n); }
      function isBoolean(n) { return typeof n === 'boolean'; }

      function summerize(obj) {
         var xtra = cnt = 0, out='', type;

         if ($.isArray(obj)) {
            out = '[ ';
            for (var i=0; i<3; i++) {
               type = getType(obj[i]);
               if (type == "number" || type == "boolean") {
                  out += "<span class='boolean'>" + obj[i] + '</span>, ';
               } else if (type == "object") {
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
      function getType(obj) {
         type = typeof obj;
         if (isNumber(obj)) {
            type = "number";
         } else if (isBoolean(obj)) {
            type = "boolean";
         } else if (!$.isArray(obj) && typeof obj === "object") {
            type = "object";
         } else if ($.isArray(obj)) {
            type = "array";
         } else {
            type = "string";
         }
         return type; 
      }
      $(document).ready(function() {
         $("#main").on("click", "span.toggleArrow", function() { 
            $("span.toggleArrow", $(this).parent()).toggle(); 
            $(this).closest("tr").next().toggle();
         });
         $("#gridform").submit(function(e) {
            $("#main").html( genform( $("#jsondata").val()));
            e.stopPropagation(); e.preventDefault(); return false;
         });
         $("#main").on("click", ".val", function(e) {
            $(this).parent().append("<input type='text' value='" + $(this).html() + "' width='30'>");
            $(this).hide();
         });

         $("#doserial").click(function() { myjson = $('#gridform').serialize(); return false; });
         $("#view").click(function(e) { 
            var out = genform(JSON.parse($("#jsondata").val()));
            $("#main").html(out);
            e.preventDefault();
            e.stopPropagation();
            return false;
         });
      });
   </script>
</html>
