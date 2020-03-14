<?php
   $current = $obj->getObject('Report', $in['ReportID']);
   
   $obj->db->dbobj->execute($current->Query);
   while ($row = $obj->db->dbobj->fetch_object()) {
      $rows[] = $row;
   }
   print_r($rows);
?>
<table width='100%' cellpadding='4' cellspacing='0' border='0' style='border: 1px solid #a0a0a0;'>
<tr>
   <td class='headRow'>Bug</td>
   <td class='headRow'>Total</td>
</tr>
<?php
   
   $obj->db->dbobj->execute("select DISTINCT(ResourceID) from Track where Resource='Bug' order by ResourceID");
   $ids = array();
   while ($rec = $obj->db->dbobj->fetch_object()) {
      $ids[] = $rec->ResourceID;
   }
   $obj->db->addResource('Bug');
   $row = 1;
   foreach ($ids as $id) {
      $row ^= 1;
      $obj->db->Bug->get($id, 'BugID');
      print "<tr>\n\t<td class='tblCell row$row'>$id</td>\n\t<td class='tblCell row$row'>".$obj->db->Bug->Bug[0]->Title."</td>\n\t";
      $sum = 0;
      foreach ($staff as $user) {
         $obj->db->dbobj->execute("select sum(Quantity) as Time, sum(FormTime) as FormTime from Track where Resource='Bug' and ResourceID='$id' and Email='$user'");
         while ($rec = $obj->db->dbobj->fetch_object()) {
            $sum += $rec->Time;
            print "<td class='tblCell row$row'>".$rec->Time."</td>\n\t";
         }
      }
      print "<td class='tblCell row$row'>$sum</td>\n</tr>\n";
   }
?>
</table>
