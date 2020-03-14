<table width='100%' cellpadding='4' cellspacing='0' border='0' style='border: 1px solid #a0a0a0;'>
<tr>
   <td class='headRow'>BugID</td>
   <td class='headRow'>Bug</td>
<?php

   require_once("boss_class.php");
   
   $obj = new boss();

   $obj->db->dbobj->execute("select DISTINCT(Email) from Track where Resource='Bug'");
   
   $staff = array();
   while ($rec = $obj->db->dbobj->fetch_object()) {
      $show = preg_replace("/\@.*/", '', $rec->Email);
      print "\t<td class='headRow'>$show</td>\n";
      $staff[] = $rec->Email;
   }
?>
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
   $developer = array();
   foreach ($ids as $id) {
      $row ^= 1;
      $obj->db->Bug->get($id, 'BugID');
      print "<tr>\n\t<td class='tblCell row$row center listItemCell'>$id</td>\n\t<td class='tblCell row$row listItemCell'>".$obj->db->Bug->Bug[0]->Title."</td>\n\t";
      $sum = 0;
      foreach ($staff as $user) {
         if (!$developer[$user]) $developer[$user] = 0;

         $obj->db->dbobj->execute("select sum(Quantity) as Time, sum(FormTime) as FormTime from Track where Resource='Bug' and ResourceID='$id' and Email='$user'");
         while ($rec = $obj->db->dbobj->fetch_object()) {
            $sum += $rec->Time;
            $developer[$user] += $rec->Time;
            $total += $rec->Time;
            print "<td class='tblCell row$row reportNumber'>".$rec->Time."</td>\n\t";
         }
      }
      print "<td class='tblCell row$row reportNumber'>$sum</td>\n</tr>\n";
   }
   $row ^= 1;
   print "<tr><td class='tblCell row$row'>&nbsp;</td><td class='tblCell row$row'>&nbsp;</td>";
   foreach ($staff as $user) {
      print "<td class='tblCell reportSum row$row'>".$developer[$user]."</td>";
   }
   print "<td class='tblCell reportTotal row$row'>".$total."</td></tr>";
?>
</table>
