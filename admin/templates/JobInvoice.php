<?php
   require_once("../lib/boss_class.php");
   require_once("calc_class.php");

   $boss = new boss('SS_PeninsulaTour');
   $in = $_REQUEST;
   
   if (!$in['rsc']) $in['rsc'] = 'JobInvoice';

   $query = '';
   if ($in['cond'] && $in['field'] && $in['value']) 
      $query .= $boss->_quote($in['field'], '`') . ' ' . $cond . ' ' . $boss->_quote($in['value']);
   if ($in['sort']) 
      $query .= ' ORDER BY ' . $in['sort'] . ' ' .$in['dir'];
   if (!$query) $query = '1=1';

   $records = $boss->getObject($in['rsc'], $query); 
   $recordFields = $boss->db->dbobj->fetch_fields($in['rsc']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title></title>
     <link rel='stylesheet' type='text/css' href='/lib/css/ui.css' />
      <link rel='stylesheet' type='text/css' href='/lib/css/dbedit.css' />
   </head>
   <body>
      <script type='text/javascript'>
         var srcFields = <?php print json_encode($recordFields); ?>;
      </script>
      <script type='text/javascript' src='/lib/js/dbedit.js'> </script>
       <div id='resultDisplay'> </div>
      <table border='0' cellpadding='0' cellspacing='0' style='border: 1px solid #666;width:100%;'>
         <thead>
            <tr>
            <?php 
               foreach ($recordFields as $idx=>$recordField) {
                  if (!preg_match("/(LastModified|Created)/", $recordField)) print "\t\t<th class='editHeading'>{$recordField}</th>\n";
               }
            ?>
            </tr>
         </thead>
         <tbody>
      <?php
         $flop = 0;
         foreach ($records->{$in['rsc']} as $item) {
            $id = $item->{$in['rsc'].'ID'};     // Assign id to use for this item
            $class = 'editCell editRow'.$flop;
            print "\t\t<tr id='{$in['rsc']}_$id'>\n";
            foreach ($recordFields as $idx=>$recordField) {
               if (!preg_match("/(LastModified|Created)/", $recordField)) {
                  print "\t\t\t<td id='{$in['rsc']}_{$id}_{$recordField}' ";
                  print "class='$class'>{$item->$recordField}</td>\n";
               }
            }
            print "\t\t</tr>\n";
            $flop ^= 1;
         }
      ?>
         </tbody>
      </table>
   </body>
</html>
