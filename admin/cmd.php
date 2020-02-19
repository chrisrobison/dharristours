<?php
   require_once('auth.php');
print "<!--\n";
print_r($in);
print "\n-->\n";
   if ($in['x'] == 'update') {
      $store = $boss->cleanObject($in);
      $ids = $boss->storeObject($store);
   } else if ($in['x'] == 'delete') {
      if ($in['Resource'] && $in[$in['Resource'].'ID']) {
         $sql = "delete from " . $in['Resource'] . " where " . $in['Resource'] . "ID = " . $boss->db->dbobj->sql_quote($in[$in['Resource'].'ID']);
         $in[$in['Resource'].'ID'] = '';
         $boss->db->dbobj->execute($sql);
      }
   }
   if ($in['Resource'] && $in[$in['Resource'].'ID']) {
      $current = $boss->getObject($in['Resource'], $in[$in['Resource'].'ID']);
      $js = $boss->utility->js_serialize($current);
   }
   if ($in['x'] == 'new') {
      unset($current);
      unset($js);
   }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
      <title></title>
      <link rel='stylesheet' type='text/css' href='/lib/css/default.css' />
      <script language='JavaScript' type='text/javascript' src='/lib/js/default.js' ></script>
      <script language='JavaScript' type='text/javascript'>
         <?php
            if ($js) {
               print "var current = $js;\n";
            }
         ?>
      </script>
   </head>
   <body>
      <form name='form1' id='form1' method='post' action='/cmd.php'>
      <input type='hidden' name='From' value='<?php $in['From']; ?>'/>
      <div class='contentWrap'>
<?php if (preg_match("/^\//", $in['t'])) {
         ?><iframe src="<?php print $in['t']; ?>" height="600" width="100%" border="0" scrolling="yes" style="border:0px;"></iframe>
<?php
      } else {
      include("templates/".$in['t'].".php"); 
      } 
      ?>
      </div>
      </form>
   </body>
</html>
