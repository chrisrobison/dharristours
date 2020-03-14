<?php
   $recname = 'Contact[' . ( ($in['ContactID']) ? $in['ContactID'] : 'new1' ) . ']';
   if ($in['ContactID']) {
      $current = $boss->getObject('Contact', $in['ContactID']);
   }
?>
<form name='form1' id='form1' method='post' action='app.php'>
<input type='hidden' id='Contact' name='<?php print $recname; ?>' value='<?php print $current->Contact; ?>'/>
<input type='hidden' name='x' value='save'/>
<input type='hidden' id='rsc' name='rsc' value='Contact'/>
<input type='hidden' id='id' name='ContactID' value='<?php print ($in['ContactID']) ? $in['ContactID'] : 'new1'; ?>'/>

<div class='detailWrap'>
   <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td class='dataLabel'>Contact ID</td>
        <td class='dataValue'><?php print $current->ContactID; ?></td>
      </tr>
      <tr>
        <td class='dataLabel'>Company</td>
        <td class='dataValue'><input type='text' name='<?php print $recname . '[Company]'; ?>' value='<?php print $current->Company; ?>' id='Company' size='25' onchange="update('form1',this.id, this.value)" /></td>
      </tr>
      <tr>
        <td class='dataLabel'>Last Name</td>
        <td class='dataValue'><input type='text' name='<?php print $recname . '[LastName]'; ?>' value='<?php print $current->LastName; ?>' id='LastName' size='25' onchange="update('form1',this.id, this.value)"/></td>
      </tr>
      <tr>
        <td class='dataLabel'>First Name</td>
        <td class='dataValue'><input type='text' name='<?php print $recname . '[FirstName]'; ?>' value='<?php print $current->FirstName; ?>' id='FirstName' size='25' onchange="update('form1',this.id, this.value)"/></td>
      </tr>
      <tr>
        <td class='dataLabel'>Email</td>
        <td class='dataValue'><input type='text' name='<?php print $recname . '[Email]'; ?>' value='<?php print $current->Email; ?>' id='Email' size='25' onchange="update('form1',this.id, this.value)"/></td>
      </tr>
      <tr>
        <td class='dataLabel'>Phone</td>
        <td class='dataValue'><input type='text' name='<?php print $recname . '[Phone]'; ?>' value='<?php print $current->Phone; ?>' id='Phone' size='15' onchange="fixPhone(this);update('form1',this.id, this.value)"/></td>
      </tr>
      <tr>
        <td class='dataLabel'>Work</td>
        <td class='dataValue'><input type='text' name='<?php print $recname . '[Work]'; ?>' value='<?php print $current->Work; ?>' id='Work' size='15' onchange="fixPhone(this);update('form1',this.id, this.value)"/></td>
      </tr>
      <tr>
        <td class='dataLabel'>Cell</td>
        <td class='dataValue'><input type='text' name='<?php print $recname . '[Cell]'; ?>' value='<?php print $current->Cell; ?>' id='Cell' size='15' onchange="fixPhone(this);update('form1',this.id, this.value)"/></td>
      </tr>
      <tr>
        <td class='dataLabel' style='vertical-align:top;'>Notes</td>
        <td class='dataValue'><textarea name='<?php print $recname . '[Notes]'; ?>' id='Notes' rows='5' cols='60' onchange="update('form1',this.id, this.value)"><?php print $current->Notes; ?></textarea></td>
      </tr>
   </table>
</div>
</form>
