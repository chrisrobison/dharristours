<?php
   include_once($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');
   include("grid.php");
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Simple Software: Data Tool</title>
      <!--<link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/smoothness/jquery-ui.css" type="text/css" rel="stylesheet" />-->
      <link href="/lib/css/ui.jqgrid.css" type="text/css" rel="stylesheet" />
      <link href="/lib/css/Aristo/jquery-ui-1.8.5.custom.css" type="text/css" rel="stylesheet" />
      <link href="/lib/css/core.css" type="text/css" rel="stylesheet" />
      <link href="<?php print $boss->app->Assets . '/' . $boss->app->CSS; ?>" type="text/css" rel="stylesheet" />
      <style>
     </style>
  </head>
   <body>
      <div id='main'>
         <table id="mygrid"></table>
         <?php if ($in['pager']) { ?><div id="pagernav"></div><?php } ?>
         <?php include($boss->getPath("templates/toolbar.php")); ?>
         <div id='formContainer'>
            <form id="simpleForm" name="simpleForm" onsubmit="return false;">
               <input type="hidden" id="cmd" name='x' value='get' />
               <input type="hidden" id="simpleID" name='ID' value='' />
            <?php 
               showForm($boss, $process);
            ?>
            </form>
         </div>
      </div>
   </body>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
   <script type="text/javascript" src="/lib/js/i18n/grid.locale-en.js"></script>
   <script type="text/javascript" src="/lib/js/jquery.jqGrid.min.js"></script>

   <script type='text/javascript'>
      var simpleConfig = {
         resource:"<?php print $rsc; ?>", 
         process: <?php print json_encode($process); ?>, 
         viewstate: 1 
      };
      $(document).ready(function($) {
         var grid = $("#mygrid");
         grid.data('config', simpleConfig);
         grid.jqGrid(<?php print $json; ?>);
      });
   </script>
   <script type="text/javascript" src="grid.js"></script>
</html>
