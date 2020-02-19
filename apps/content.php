<?php 
   if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
   // require_once($_SERVER['DOCUMENT_ROOT']."/lib/core.php");
?>
<!DOCTYPE html> 
<html>
   <head>
      <title>Simple Software</title>      
		<!--<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/smoothness/jquery-ui.css" />-->
      <link rel='stylesheet' type='text/css' href='/lib/css/Aristo/jquery-ui-1.8.5.custom.css' />
      <link rel='stylesheet' type='text/css' href='/lib/css/default.css' />
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"> </script>
      <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
      <script src='/lib/js/default.js'> </script>
      <script type="text/javascript">
         <?php echo $bossJS; ?>
         $(function() {
            $("input,textarea").change(function() { 
               if ($(this).attr('id') != 'searchValue') {
                  doModify();
               }
            });
         });
      </script>
   </head>
   <body onload="<?php if ($in['type']!='Module') print "initFrame();"; ?><?php print $jsalert.';'; ?><?php if ($boss->Process->Processes[0]->JS)  print $boss->Process->Processes[0]->JS.';';  ?>">
      <?php print $errors; ?>
		<div id='main'>
         <form id='mainform' name='mainform' method='post' action='content.php' onsubmit="<?php print ($boss->Process->Processes[0]->SubmitHandler) ? "return ".$boss->Process->Processes[0]->SubmitHandler : "return submitForm();" ?>">
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
                  if ($in[$type.'ID']) $area = $boss->getObject($type, $in[$type.'ID']);
                  if ($area->Template) { require($area->Template); }
               ?>
         </form>
		</div>
      <div id='transporter'><iframe name='transport' id='transport' class='transport'> </iframe></div>
   </body>
</html>
