<div class='tableGroup'>
   <div class='formHeading'>Customer ID: <?php print $current->CustomerID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Customer</label><textarea dbtype='text' name='Customer[<?php print $current->CustomerID; ?>][Customer]' id='Customer' class='textBox'><?php print $current->Customer; ?></textarea></div>
<?php print $current->Notes; ?>
         <div class='contentField'><label>Contact Name</label><input type='text' dbtype='varchar(100)' name='Customer[<?php print $current->CustomerID; ?>][ContactName]' id='ContactName' value='<?php print $current->ContactName; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>new</label><input type='text' dbtype='varchar(100)' name='Customer[<?php print $current->CustomerID; ?>][new]' id='new' value='<?php print $current->new; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Phone</label><input type='text' dbtype='int(15)' name='Customer[<?php print $current->CustomerID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='15' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Email</label><input type='text' dbtype='varchar(100)' name='Customer[<?php print $current->CustomerID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>website</label><input type='text' dbtype='varchar(100)' name='Customer[<?php print $current->CustomerID; ?>][website]' id='website' value='<?php print $current->website; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Category</label><textarea dbtype='text' name='Customer[<?php print $current->CustomerID; ?>][Category]' id='Category' class='textBox'><?php print $current->Category; ?></textarea></div>
</div>
         <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Customer[<?php print $current->CustomerID; ?>][Notes]' id='Notes' style='width:48em;' class='textBox'></textarea></div></div>
</div>