<?php
   if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
   if ($in['x'] == 'save') {
      $store = $boss->cleanObject($in);
      $ids = $boss->storeObject($store);
   } else if ($in['x'] == 'delete') {
      if ($in['Resource'] && $in[$in['Resource'].'ID']) {
         $sql = "delete from " . $in['Resource'] . " where " . $in['Resource'] . "ID = " . $boss->db->dbobj->sql_quote($in[$in['Resource'].'ID']);
         $in[$in['Resource'].'ID'] = '';
         $boss->db->dbobj->execute($sql);
      }
   } else if ($in['x'] == 'chpass') {
      
   }

   $id = $in['id'] ? $in['id'] : $in[$in['Resource'].'ID'];
   if ($in['pid']) $process = $boss->getObject("Process", $in['pid']);
   
   $rsc = $in['rsc'] ? $in['rsc'] : $in['Resource'];
   if (!$rsc) $rsc = $in['rsc'] = $process->Resource;
   
   if (!$in['t']) $in['t'] = $process->Form;
   
   if ($rsc && $id) {
      $current = $boss->getObject($rsc, $id);
      $js = $boss->utility->js_serialize($current);
   }
   if ($in['x'] == 'new') {
      unset($current);
      unset($js);
   }

   if ($in['f']!=1) {
?>
<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
      <title></title>
      <link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/dojo/1/dijit/themes/claro/claro.css" />
      <link href="/lib/css/ui.jqgrid.css" type="text/css" rel="stylesheet" />
      <link href="/lib/css/Aristo/jquery-ui-1.8.5.custom.css" type="text/css" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="/lib/css/icons48.css" />
      <link rel="stylesheet" type="text/css" href="/lib/css/icons-small.css" />
      <link rel="stylesheet" type="text/css" href="/lib/css/icons24.css" />
      <link rel="stylesheet" type="text/css" href="/lib/css/core.css" />
      <style>
         .dijitAccordionText, ul.nav li a.nav { font-family: Quicksand, "Helvetica Neue", Optima, Verdana, sans-serif; }
      </style>
      <link rel="stylesheet" type="text/css" href="<?php print $boss->app->Assets . "/" . $boss->app->CSS; ?>" />
      <script language='JavaScript' type='text/javascript' src='/lib/js/default.js' ></script>
      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
   </head>
   <body>
      <form name='simpleForm' id='simpleForm' method='post' action='/grid/ctl.php'>
      <input type='hidden' name='x' id='send_X' value='save' />
      <input type='hidden' name='pid' id='pid' value='<?php print $in['pid']; ?>' />
      <input type='hidden' name='rsc' id='rsc' value='<?php print $in['rsc']; ?>' />
      <input type='hidden' name='From' value='<?php $in['From']; ?>'/>
      <input type='hidden' name='t' id='t' value='<?php $in['t']; ?>'/>
      <input type='hidden' name='callback' id='callback' value='parent.parent.$("#formDialog").dialog("close")' />
      <div class='contentWrap'>
<?php 
   }

      $dest = urldecode($in['t']);
      $fullpath = $boss->getFilePath($dest);
      $dest = preg_replace("|".$_SERVER['DOCUMENT_ROOT']."\/|", '', $fullpath);
      if ((preg_match("/^\//", $dest)) || (preg_match("/^http:\/\//", $dest))) {
         ?><iframe class='framed' src="<?php print $dest; ?>" border="0" scrolling="<?php print (preg_match("/dbtool/", $dest)) ? 'auto' : 'no'; ?>"></iframe>
<?php
      } else {
         include($_SERVER['DOCUMENT_ROOT'].'/'.$dest); 
      } 
      if ($in['f']!=1) {
      ?>
      </div>
      </form>
   </body>
   <script type='text/javascript'>
      <?php
         if ($js) {
            print "var current = $js;\n";
         }
      ?>
      $(function() {
         $(".formHeading").css("display", "none");
      });
   </script>
</html>
<?php
   }
?>
