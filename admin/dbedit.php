<?php
   require_once("boss_class.php");

   $boss = new boss();
   $in = $_REQUEST;
   
   if (!$in['rsc']) $in['rsc'] = 'Bug';

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
      <script type='text/javascript'>
         var srcFields = <?php print json_encode($recordFields); ?>;
      </script>
      <script type='text/javascript' src='/lib/js/dbedit.js'> </script>
      <link rel='stylesheet' type='text/css' href='/lib/css/ui.css' />
      <link rel='stylesheet' type='text/css' href='/lib/css/dbedit.css' />
   </head>
   <body>
      <div id='resultDisplay'> </div>
      <table id='tbl_<?=$in['rsc']?>' class='edit'>
         <thead>
            <tr>
            <?php 
               $newRecord = "";
               foreach ($recordFields as $idx=>$recordField) {
                  if (!preg_match("/(LastModified|Created)/", $recordField)) {
                     print "\t\t<th class='editHeading'>{$recordField}</th>\n";
                     $newRecord .= "\t\t\t<td id='{$in['rsc']}_new1_{$recordField}'></td>\n";
                  }
               }
            ?>
            </tr>
         </thead>
         <tbody>
            <?php
               $rowclass = array('oddRow', 'evenRow');
               $flop = 0;
               foreach ($records->{$in['rsc']} as $key=>$item) {
                  if (strpos("_", $key)) next;

                  $id = $item->{$in['rsc'].'ID'};     // Assign id to use for this item
                  $class = 'editCell';
                  print "\t\t<tr id='{$in['rsc']}_$id' class='editRow ".$rowclass[$flop]."'>\n";
                  foreach ($recordFields as $idx=>$recordField) {
                     if (!preg_match("/(LastModified|Created)/", $recordField)) {
                        print "\t\t\t<td id='{$in['rsc']}_{$id}_{$recordField}'>{$item->$recordField}</td>\n";
                     }
                  }
                  print "\t\t</tr>\n";
                  $flop ^= 1;
               }
            ?>
            <tr class='editRow'>
               <?php
                  print $newRecord;
               ?>
            </tr>
         </tbody>
      </table>
   </body>
</html>
