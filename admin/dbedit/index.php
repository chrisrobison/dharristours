<?php
   require_once('head.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
   <head>
      <title>Visual DB Schema Editor</title>
      <!-- compliance patch for microsoft browsers -->
      <!--[if lt IE 7]><script src="lib/ie7/ie7-standard-p.js" type="text/javascript"></script><![endif]-->
      <link rel="stylesheet" type="text/css" href="lib/default.css" />
      <script type='text/javascript' language="JavaScript" src="lib/ui.js"> </script>
      <script type='text/javascript' language="JavaScript" src="lib/schema.js"> </script>
      <script type="text/javascript" language="JavaScript">
         <?php print $js; ?>
      </script>
   </head>
   <body onload="init(schema)">
      <form name='dbtool' id='dbtool' action='index.php' method='post'>
         <div id='tblbtn'><input type='button' value='New Table' class='newtbl' onclick='newTable();'></div>
         <input type='hidden' name='tableName' value=''/>
         <input type='hidden' name='fieldName' value=''/>
         <input type='hidden' name='x' value='add'/>
         <input type='hidden' name='newtable' value=''/>
         <input type='hidden' name='db' value='<?php print $db; ?>'/>
         <h1><?php print $db; ?></h1>
         <div id='coltypes'><input onclick='return doAdd();' type='image' name='save' id='save' src='img/save.png' style='float:left;top:1px;padding-right:1px;position:relative;'><input onchange="doChange();" type='text' name='colname' id='colname'><select name='coltype' id='coltype' class='typelist' onchange="doChange();">
            <?php 
               foreach ($types as $type=>$extra) {
                  print "<option value='$type'>".strtolower($type)."</option>";
               }
            ?>
         </select><input type='text' onchange='doChange();' name='colattr' id='colattr'></div>
         <div id='schemas'> </div>
         <div id='debug'> </div>
      </form>
   </body>
</html>
