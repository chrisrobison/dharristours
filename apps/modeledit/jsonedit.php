<?php
   require($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');
   
   $in['pid'] = ($in['pid'])? $in['pid'] : 1;
    
   $process = $boss->getObject('Process', $in['pid']);
   
   if (!$in['mid'] && $in['pid']) {
      $model = $boss->getModel($in['pid']);
   } else if ($in['mid']) {
      $model = $boss->getObject('Model', $in['mid']);
   } 
   
   $models = $boss->getObject('Model', '1=1 ORDER BY Model');
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
      <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
      <link rel='stylesheet' type='text/css' href='jsonedit.css' />
      <link rel='stylesheet' type='text/css' href='contextmenu.css' />
  </head>
   <body>
      <form id='gridform'>
         <label for='mid'>Models</label><select name='mid' id='mid'><?php print $sel; ?></select>
         <div class='btn' id='save'>Save</div>
         <div class='btn' id='view'>Refresh</div>
         <div class='btn' id='compact' style='display:none'>Compact</div>
         <div class='btn' id='expand' style='display:none'>Expand</div>
         <br>
         <h3>Model: <span id='model'><?php print $model->Model . " [". $model->ModelID . "]"; ?></span></h3>
         <div style='position:absolute;bottom:0px;right:0px;width:50em;height:20em;overflow:scroll;'><textarea id='jsondata' name='jsondata' style="width:50em;height:20em;" cols='80' rows='30'><?php print $model->Config; ?></textarea></div>
         <div id='main'>
            
         </div>
      </form>
   </body>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
   <script type="text/javascript" src="json2.min.js"></script>
   <script type="text/javascript" src="jquery.contextmenu.js"></script>
   <script type="text/javascript" src="jquery.scrollintoview.min.js"></script>
   <script type="text/javascript" src="/lib/js/jsbeautify.js"></script>
   <script type="text/javascript" src="jsonedit.js?ver=1.86"></script>
   <script type="text/javascript" src="ui.js"> </script>
</html>
