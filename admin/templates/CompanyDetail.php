<?php
   $recname = 'Company[' . ( ($in['CompanyID']) ? $in['CompanyID'] : 'new1' ) . ']';
   if ($in['CompanyID']) {
      $current = $boss->getObject('Company', $in['CompanyID']);
   }
?>
<form name='form1' id='form1' method='post' action='app.php'>
<input type='hidden' id='Company' name='<?php print $recname; ?>' value='<?php print $current->Company; ?>'/>
<input type='hidden' name='x' value='save'/>
<input type='hidden' name='rsc' value='Company'/>

<div class='detailWrap'>
   <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td class='dataLabel'>Company ID</td>
        <td class='dataValue' style='border:1px inset #a0a0a0;background-color:#f0f0f0;color:#909090;'><?php print $current->CompanyID; ?></td>
      </tr>
      <tr>
        <td class='dataLabel'>Company</td>
        <td class='dataValue'><input type='text' name='<?php print $recname . '[Company]'; ?>' value='<?php print $current->Company; ?>' id='Company' size='25'/></td>
      </tr>
      <tr>
        <td class='dataLabel'>Notes</td>
        <td class='dataValue'><textarea name='<?php print $recname . '[Notes]'; ?>' id='Notes' rows='5' cols='60'><?php print $current->Notes; ?></textarea></td>
      </tr>
   </table>
</div>
</form>
