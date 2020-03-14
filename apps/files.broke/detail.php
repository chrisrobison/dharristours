<?php
   require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/auth.php");
   require("fileutil.php");

   $in = $_GET;
   $in['path'] = preg_replace("/\/$/", '', $in['path']);
   $in['relpath'] = $boss->app->Assets . $in['path'];
   $in['path'] = $_SERVER['DOCUMENT_ROOT'] . $boss->app->Assets . $in['path'];
   
   if (is_dir($in['path'])) {
      $files = listFiles($in['path']);
   }
   
   $keys  = array('icon', 'file', 'versions', 'size', 'mdate', 'cdate', 'perms');
   $types = array('img','string','string','string','datetime','datetime','string');

   $json = "{cols:[";
   $json .= "  {id: 'icon', label: '*', type: 'string'},";
   $json .= "  {id: 'file', label: 'Filename', type: 'string'},";
   $json .= "  {id: 'versions', label: 'Revisions', type: 'string'},";
   $json .= "  {id: 'size', label: 'Size', type: 'number'},";
   $json .= "  {id: 'mdate', label: 'Last Modified', type: 'datetime'},";
   $json .= "  {id: 'cdate', label: 'Created', type: 'date'},";
   $json .= "  {id: 'perms', label: 'Perms', type: 'string'}";
   $json .= "],rows:["; 
   $filejson = "[";
   foreach ($files as $file=>$attr) {
      $shortfile = preg_replace("|".$_SERVER['DOCUMENT_ROOT'].$boss->app->Assets."|", '', $file);
      $filejson .= "'".$shortfile."',";
      $vals = array();
      $vals[] = (is_dir($file)) ? "/img/folder.png" : '/img/icon_page.png';
      $vals[] = basename($file);

      $select = "<select id='rev_".preg_replace("/\W/", '_', basename($file))."' rel='$shortfile' onchange=\"doDownload('$shortfile', this.options[this.selectedIndex].value)\" class='revisions'><option>--Revisions--</option><option value='HEAD'>LATEST</option>";
      if (count($attr['version']['revisions'])) {
         foreach ($attr['version']['revisions'] as $rev) {
            $select .= "<option title='".preg_replace("/\n/", "\\n", $rev['message'])."' value='".$rev['revision']."'>Rev. ".$rev['revision']." [".$rev['date']."]</option>";
         }
      }
      $select .= "<option value='1.1'>BASE</option></select>";

      $vals[] = (is_dir($file)) ? "" : $select;
      $vals[] = $attr['stats']['size'];
      $vals[] = "new Date(".($attr['stats']['mtime'] * 1000).")";
      $vals[] = "new Date(".($attr['stats']['ctime'] * 1000).")";
      $vals[] = $attr['stats']['perms'];

     $json .= "{c:[";
      for ($i=0; $i<=count($keys); $i++) {
         if ($types[$i] == "string") {
            $json .= "{v:\"".preg_replace("/\"/", '\"', $vals[$i])."\"},";
         } else if ($types[$i] == "img") {
            $json .= "{v:\"<img src='".$vals[$i]."' border='0' id='img_".$vals[1]."' />\"},"; 
         } else if ($vals[$i]) {
            $json .= "{v:".$vals[$i]."},";
         } else {
            $json .= "{v:''},";
         }
      }
      $json = preg_replace("/,$/", '', $json);
      $json .= "]},";
   }
   $filejson = preg_replace("/,$/", '', $filejson)."]";
   $json = preg_replace("/,$/", '', $json);
   $json .= "]}";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
   <title>
     File Browser
   </title>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
   <script type="text/javascript" src="http://www.google.com/jsapi"></script>
   <script type="text/javascript">
     google.load('visualization', '1', {packages: ['table']});
   </script>
   <script type="text/javascript">
      var files = <?php print json_encode($files); ?>;
      var filepaths = <?php print $filejson; ?>;
      $(function() {
      });
      
      function doDownload(file, rev) {
         uri = "download.php?rev=";
         uri += rev + "&file=" + file;
         $("#helper").attr("src", uri);
      }

      function drawVisualization() {
        // Create and populate the data table.
        JSONObject = <?php print $json; ?>;   
        var data = new google.visualization.DataTable(JSONObject, 0.6);
        
        // Create and draw the visualization.
        visualization = new google.visualization.Table(document.getElementById('table'));
        visualization.draw(data, {'allowHtml': true});
        // Add our selection handler.
        google.visualization.events.addListener(visualization, 'select', selectHandler);
      }

      // The selection handler.
      // Loop through all items in the selection and concatenate
      // a single message from all of them.
      var lastClick = 0;
      function selectHandler(evt) {
        thisClick = new Date().getTime();
        var selection = visualization.getSelection();
        visualization.setSelection(selection[0].row);
        if ((thisClick - lastClick) < 500) {
           var message = '';
           for (var i = 0; i < selection.length; i++) {
             var item = selection[i];
             if (item.row != null) {
               var selected = filepaths[item.row];
               document.location = 'download.php?file='+selected; 
             }
           }
         }
         lastClick = thisClick;
         return false;
      }

      google.setOnLoadCallback(drawVisualization);
   </script>
   <style>
     body { padding:0; margin:0; font-size: 9px;font-family:Tahoma,Helvetica,sans-serif; }
     #helper { position: absolute:height:0px;width:0px;border:none;}
     .revisions { position:relative;width:110px; font-size: 9px; }
     .google-visualization-table-td-center, .google-visualization-table-td { white-space:nowrap; }
   </style>
  </head>
  <body>
    <div id="table"></div>
    <iframe id="helper"> </iframe>
  </body>
</html>
