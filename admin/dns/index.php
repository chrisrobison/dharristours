<?php  
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php"); 

   $sys = new obj('sys', 'pimp', 'pimpin', 'localhost');
   $boss->db = $sys;
   $dh = $sys->dbobj->execute("select distinct Zone from DNSRecord");
   while ($row = mysql_fetch_object($dh)) {
      $domains[] = $row->Zone;
      $domopts .= "<option>".$row->Zone."</option>";
   }
   
   $model = $boss->genTableModel("DNSRecord");
   $config = json_decode($model->Config);
   $config->grouping = true;
   $config->groupingView->groupField[] = 'Zone';
   $config->groupingView->groupColumnShow[] = true;
   $config->groupingView->groupText[] = '<b>{0} - {1} Entries</b>';
   $config->groupingView->groupCollapse = true;
   $config->caption = "DNS Records";
   $config->url = 'ctl.php?rsc=DNSRecord';
   $config->editurl = 'ctl.php?x=edit&rsc=DNSRecord';

?>
<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title></title>
      <link href="/lib/css/ui.jqgrid.css" type="text/css" rel="stylesheet" />
      <link href="/lib/css/Aristo/jquery-ui-1.8.5.custom.css" type="text/css" rel="stylesheet" />
      <link href="/lib/css/core.css" type="text/css" rel="stylesheet" />
  </head>
   <body>
      <div id='main'>
         <table id="mygrid"></table> 
         <div id="pagernav"></div> 
      </div>
   </body>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
   <script type="text/javascript" src="/lib/js/ui.multiselect.js"></script>
   <script type="text/javascript" src="/lib/js/i18n/grid.locale-en.js"></script>
   <script type="text/javascript" src="/lib/js/jquery.jqGrid.min.js"></script>

   <script type='text/javascript'>
      var simpleConfig = {
         resource:"<?php print $in['rsc']; ?>",
         pid: <? print $in['pid'] ? $in['pid'] : "''"; ?>,
         viewstate: 1,
         action: "new",
         id: null,
         grids: []
      };
      jQuery(function($) {
         var grid = $("#mygrid");
         grid.data('config', simpleConfig);
         grid.jqGrid(<?php print json_encode($config); ?>);
         grid.jqGrid('navGrid','#pagernav', {add:true,del:true,edit:true,refresh:true,search:true,view:true}, {}, {}, {}, {} ); 
      });
   </script>
   <script type="text/javascript" src="/lib/js/grid.js"></script>
</html>
