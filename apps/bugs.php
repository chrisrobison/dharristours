<table width='100%' border='0' cellpadding='0' cellspacing='0'>
   <tr>
      <td class='cvsHead cvsHeadLeft'>Date</td>
      <td class='cvsHead'>By</td><td class='cvsHead'>Owner</td><td class='cvsHead'>Status</td><td class='cvsHead cvsHeadRight'>Details</td>
   </tr>
   <?php 
      require_once('boss_class.php');
      $boss = new boss();
      $boss->db->dbobj->execute('select * from Bug where datediff(now(), LastModified) < 14 order by LastModified desc');
      $flop = 1;
      while ($bug = $boss->db->dbobj->fetch_object()) {
         $flop ^= 1;
   ?>
   <tr>
      <td class='cvsCell cvs<?php print $flop; ?> cvsCellLeft'><?php print date("m/d/Y g:i a", strtotime($bug->LastModified)); ?></td>
      <td class='cvsCell cvs<?php print $flop; ?> cvsCenter'><?php print ($bug->AssignedBy) ? preg_replace("/\@.*/", '', $bug->AssignedBy) : 'Unassigned'; ?></td>
      <td class='cvsCell cvs<?php print $flop; ?> cvsCenter'><?php print ($bug->Owner) ? preg_replace("/\@.*/", '', $bug->Owner) : 'Unassigned'; ?></td>
      <td class='cvsCell cvs<?php print $flop; ?> cvsCenter'><?php print ucfirst($bug->Status); ?></td>
      <td class='cvsCell cvsHeadLeft cvsCellRight cvs<?php print $flop; ?>'>
         <div class='reportTitle'><b>Title:</b> <?php print $bug->Title; ?></div>
         <div class='reportBug'><b>Bug:</b> <?php print $bug->Bug; ?></div>
         <div class='reportText'><b>Notes:</b> <?php print nl2br($bug->Notes); ?></div>
      </td>
   </tr>
   <?php
      }
   ?>
</table>
