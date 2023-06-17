<?php
   require($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');
   
   if ($in['rsc'] && $in['id']) {
      $current = $boss->getObject($in['rsc'], $in['id']);
   }
?>
<!DOCTYPE html> 
<html>
   <head>
      <meta charset="utf-8">
      <title></title>
      <link href='//fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
      <link href='/lib/css/core.css' rel='stylesheet' type='text/css'>
      <link href="<?php print $boss->app->Assets . "/" . $boss->app->CSS; ?>" rel="stylesheet" type="text/css" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script defer="true" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
      <style>
         input { border:0px; }
        #main {
            background-color:#eee;
        }
      </style>
  </head>
   <body>
      <div id='main'>
         <?php 
            // $boss->showForm($process); 
            include($boss->getPath("templates/toolbar.php"));
            include($boss->getPath($process->Form));
         ?>
      </div>
   </body>
   <script type='text/javascript'>
      var simpleConfig = {
         resource:"<?php print $in['rsc']; ?>",
         pid: <?php print $in['pid'] ? $in['pid'] : "''"; ?>,
         process: <?php print json_encode($process); ?>,
         record: <?php print json_encode($current); ?>, // { "<?=$rsc?>ID": "new1" },
         <?php if ($process->Actions) { ?>actions: <?php print $process->Actions; ?>,<?php } ?>
         <?php if ($model->LoginID==$_SESSION['LoginID']) { ?>ModelID: <?php print $model->ModelID; ?>,<?php } ?>
         viewstate: 1,
         gridstate: 0,
         action: "new",
         id: null,
         grids: [],
         userEmail: "<?php print $_SESSION['Email']; ?>",
         init: "<?php print ($in['do']) ? $in['do'] : $process->JS; ?>",
         current: <?php print json_encode($current); ?>
      };
</script>
   <script type='text/javascript'>
      (function() {
         var current = <?php print json_encode($current); ?>;
         let id = '<?php print (array_key_exists('id', $in)) ? $in['id'] : ''; ?>';

         if (id) {
            realUpAll('<?php print $in['id']; ?>');
        }
         
      })();
   </script>
</html>
