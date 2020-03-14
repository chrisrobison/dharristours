<?php
   require($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');
   
//   $in['pid'] = $ProcessID.val();
   //$in['pid'] = ($in['pid'])? $in['pid'] : 237;
    
   $process = $boss->getObject('Process', $in['pid']);
   
   if (!$in['mid'] && $in['pid']) {
      $model = $boss->getModel($in['pid']);
   } else if ($in['mid']) {
      $model = $boss->getObject('Model', $in['mid']);
   } 
   
   $models = $boss->getObject('Model', 'LoginID=0 ORDER BY Model');
   if (!$model) {
      $model = $models->Model[0];
      $in['mid'] = $model->ModelID;
   }

   foreach ($models->Model as $k=>$m) {
      if ($k != '_ids') {
         if ($m->Model && !$s[$m->ProcessID]) {
            $s[$m->ProcessID] = $m->Model;
         }
         if (!$m->Model) {
            $m->Model = $s[$m->ProcessID];
         }
         $x = ($model->ModelID == $m->ModelID) ? " SELECTED" : '';
         $sel .= "\t<option value='{$m->ModelID}'$x>[{$m->ModelID}] {$m->Model} (PID: {$m->ProcessID}, LoginID: {$m->LoginID})</option>\n";
      }
   }
?>
<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title>Model Editor</title>
      <link rel='stylesheet' type='text/css' href='jsonedit.css' />
      <link rel='stylesheet' type='text/css' href='contextmenu.css' />
  </head>
   <body>
         <div class='contentField'><span class='fieldLabel'>Process</span>
            <select name='[ProcessID]' id='ProcessID'>
               <?php 
                  $procs = $boss->getObject("Process");
                  print "<option value='NULL'>[Select]</option>"; //PMP added to reset to default dashboard
                  foreach ($procs->Process as $key=>$proc) {
                     $s = ($proc->ProcessID == $current->InitialProcess) ? " SELECTED" : "";
                     print "<option value='{$proc->ProcessID}'$s>[{$proc->ProcessID}] {$proc->Process}</option>";
                  }
               ?>
            </select>
         </div>
      <form id='gridform'>
         <label for='mid'>Models</label><select name='mid' id='mid'><?php print $sel; ?></select>
         <div class='btn' id='save'>Save</div>
         <div class='btn' id='view'>Refresh</div>
         <div class='btn' id='compact' style='display:none'>Compact</div>
         <div class='btn' id='expand' style='display:none'>Expand</div>
         <br>
         <h3>Model: <span id='model'><?php print $model->Model . " [". $model->ModelID . "]"; ?></span></h3>
         <div style='position:absolute;width:100px;height:100px;overflow:hidden;'><textarea id='jsondata' name='jsondata' style="float:left;" cols='60' rows='30'><?php print $model->Config; ?></textarea></div>
         <div id='main'>
            
         </div>
      </form>
   </body>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
   <script type="text/javascript" src="json2.js"></script>
   <script type="text/javascript" src="jquery.contextmenu.js"></script>
   <script type="text/javascript" src="/lib/js/jsbeautify.js"></script>
   <script type="text/javascript" src="jsonedit.js"></script>
   <script type='text/javascript'>
      var obj;
      $(document).ready(function() {
         $("#main").on("click", "th.label", function(e) {
            $(this).addClass("editing");
            $(this).get(0).contentEditable = true;
            $(this).focus();
         });
         $("#ProcessID").change(function() {
           document.location.href="/apps/modeledit/?pid="+$(this).val();
         });
         $("#main").on("click", ".collapsible", function(e) { 
            $(this).siblings(".summary").toggle();
            $(this).toggleClass("closed").toggleClass("open").closest("tr").next().toggleClass("hidden", 200);
            return false;
         });
         $("#gridform").submit(function(e) { 
            var jsondata = $("#jsondata").val();
            obj = JSON.parse( jsondata ); 
            $("#jsondata").val(js_beautify(jsondata));
            renderJSON(obj);
            
            return false;
         });
         $("#compact").click(function(e) {
            $("#jsondata").val(JSON.stringify(obj));
         });
         
         $("#expand").click(function(e) {
            $("#jsondata").val(js_beautify(JSON.stringify(obj)));
         });
         
         $("#view").click(function(e) { 
            var jsondata = $("#jsondata").val();
            obj = JSON.parse( jsondata ); 
            $("#jsondata").val(js_beautify(jsondata));
            renderJSON(obj);

            $("table").dblclick(function() {
               $(this).append("<tr><td></td><th class='label key' contenteditable='true'>New Key</th><td><input type='text' class='val' value='New Value'></td></tr>");
            });
            $(".summary").after($("<span/>").addClass('delete').text("x").css("display","none")).after($("<span/>").addClass('add').text("+").css("display","none"));
            
            return false;
         });
         $("#save").click(function(e) {
            $('#jsondata').val(js_beautify(JSON.stringify(obj))); 
            return false; 
         });
         $("#main").change(function() {
            $('#jsondata').val(js_beautify(JSON.stringify(obj))); 
            return false; 
         });

         $("#main").on("focus", "input.val", function() { $(this).addClass("focus", 200); }).on("blur", "input.val", function() { $(this).removeClass("focus", 200); });
         $(".btn").mousedown(function() { $(this).css({"position":"relative","top":"4px"}); }).mouseup(function() { $(this).css({"position":"relative","top":"0px"}); });
         $("#main").keydown(function(e) {
            console.log("Keydown: " + e.which);
         });

         $("#main").on("focusout", "th.label", function(e) {
            $(this).change();
            // $("label", $(this)).html($("input.key", $(this)).val());
            // $("input.key").hide();
         });
         
         $("#main").on("mouseenter", "tr", function() { 
            $(".hover").removeClass("hover");
            $(this).addClass("hover");
//            $(".delete", $(this)).first().show();
//            $(".add", $(this)).first().show();
         }).on("mouseleave", "tr", function() {
//            $(".delete,.add", $(this)).hide();
         }).on("click", ".delete", function() {
            var data = $("input", $(this).parent()).data("val");
            delete data['obj'][data['key']];
            $(this).parents("tr").first().remove();
         });
         // $("#jsonurl").change(function(e) { $.post("get.php", {"url":$(this).val() }, function(data) { }); });
         
         var jsdata = $("#jsondata").val();
         if (jsdata) {
            obj = JSON.parse( jsdata ); 
            $("#jsondata").val(js_beautify(jsdata));
            renderJSON(obj);
         }

         $("#mid").change(function() {
            var newmid = $(this).val();
            $.getJSON("/model.php?full=1&mid="+newmid, function(data) {
              obj = data;
              $("#model").html(obj['Model'] + '[' + newmid + ']');
              $("#jsondata").val(js_beautify(JSON.stringify(data)));
              renderJSON(obj);
            });
            // location.href = location.href.replace(/\?.*/, '') + '?mid=' + $(this).val();
         });
   });
   </script>
</html>
