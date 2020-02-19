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
      <script src='/lib/js/core.js'> </script>
      <script type="text/javascript">
         <?php echo $bossJS; ?>
         $(function() {
            $("input,textarea").change(function() { 
               if ($(this).attr('id') != 'searchValue') {
                  doModify();
               }
            });
            <?php 
               print $jsalert.';'; 
               if ($boss->Process->Processes[0]->JS)  print $boss->Process->Processes[0]->JS.';';  
            ?>
         });
      </script>
   </head>
   <body>
      <?php print $errors; ?>
		<div id='main'>
         <form id='mainform' name='mainform' method='post' action='form.php' onsubmit="<?php print ($boss->Process->Processes[0]->SubmitHandler) ? "return ".$boss->Process->Processes[0]->SubmitHandler : "return submitForm();" ?>">
            <input type='hidden' name='x' value='get' />
            <input type='hidden' name='modified' value='' />
            <input type='hidden' name='pid' value='<?php print $in['ProcessID']; ?>' />
            <input type='hidden' name='Resource' value='<?php print $in['Resource'] ?>' />
            <input type='hidden' name='ID' value='<?php print $in['ID']; ?>' />
            <input type='hidden' name='FormStart' value='<?php print time(); ?>' />
            <input type='hidden' name='Object' value='<?php unset($in['Object']); print htmlspecialchars(serialize($in), ENT_QUOTES); ?>' />
               <?php    
                  $rsc = $in['Resource'];
                  $type = $in['type'];
                  $db = $boss->db;
                  if (!$in['type'] && $in['ID']) { $type = $in['type'] = 'Process'; }
                  if ($in[$type.'ID']) $area = $boss->getObject($type, $in[$type.'ID']);
                  $form = $area->Form ? $area->Form : 'templates/'.preg_replace("/\W/", "", $area->Process).".php";

                  $pform = $boss->getPath($form);
                  if (($pform) && (file_exists($pform)) && (!is_dir($pform)) && (!$in['genform'])) {
                     include($pform); 
                  } else {
                     if (!file_exists($pform) || $in['genform']) {
                        $template = $boss->buildForm($rsc, $current, 1);
                        
                        if (is_writable(dirname($pform))) {
                           $fh = fopen($pform, 'w');
                           if (!fwrite($fh, $template)) print "<h1>Error writing to file templates/$file</h1>";
                           fclose($fh);
                           include($pform);
                        } else {  
                           print "<h1>Not writable!</h1>";
                           $curform = $boss->buildForm($rsc, $current);
                           print eval("?>".$form);
                        }
                     }

                     $upd = array($in['type'].'ID'=>$in[$in['type'].'ID'], 'Form'=>$form);
                     $db->addResource($in['type']);
                     $db->Process->update($in[$in['type'].'ID'], $upd);
                  }

               ?>
        </form>
		</div>
      <div id='transporter'><iframe name='transport' id='transport' class='transport'> </iframe></div>
   </body>
</html>
