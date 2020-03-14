<?php require_once('../lib/core.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
   <head>
      <title>My Web 2.0 Application</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"> </script>
      <script src='/lib/js/default.js'> </script>
      <script type="text/javascript"><?php echo $objJS; ?></script>
      <link rel='stylesheet' type='text/css' href='/lib/css/default.css' />
   </head>
   <body onload="<?php if ($in['type']!='Module') print "initFrame();"; ?><?php print $jsalert.';'; ?><?php if ($obj->Process->Processes[0]->JS)  print $obj->Process->Processes[0]->JS.';';  ?>">
      <?php print $errors; ?>
		<div id='main'>
         <form id='mainform' name='mainform' method='post' action='content.php' onchange='doModify()' onsubmit="<?php print ($obj->Process->Processes[0]->SubmitHandler) ? "return ".$obj->Process->Processes[0]->SubmitHandler : "return submitForm();" ?>">
            <input type='hidden' name='x' value='get' />
            <input type='hidden' name='modified' value='' />
            <input type='hidden' name='type' value='<?php print $in['type']; ?>' />
            <input type='hidden' name='ModuleID' value='<?php print $in['ModuleID']; ?>' />
            <input type='hidden' name='ProcessID' value='<?php print $in['ProcessID']; ?>' />
            <input type='hidden' name='Resource' value='<?php print $in['Resource'] ?>' />
            <input type='hidden' name='ID' value='<?php print $in['ID']; ?>' />
            <input type='hidden' name='Sort' value='<?php print $in['Sort']; ?>' />
            <input type='hidden' name='SortDir' value='<?php print $in['SortDir']; ?>' />
            <input type='hidden' name='FormStart' value='<?php print time(); ?>' />
            <input type='hidden' name='Object' value='<?php unset($in['Object']); print htmlspecialchars(serialize($in), ENT_QUOTES); ?>' />
               <?php 
                  $type = $in['type'];
                  if (!$in['type'] && $in['ID']) {
                     $type = $in['type'] = 'Module';
                  }
                  if ($in['ID']) $area = $obj->getObject($type, $in['ID']);
                  if ($area->Template) { require($area->Template); }
               ?>
         </form>
		</div>
      <div id='transporter'><iframe name='transport' id='transport' class='transport'> </iframe></div>
   </body>
</html>
