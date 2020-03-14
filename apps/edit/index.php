<?php
   require_once($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');
   
   if (!$in['file']) {
      $ucnt = count(glob($_SERVER['DOCUMENT_ROOT'].$boss->app->Assets.'/untitled*'));
      $in['file'] = 'untitled' . ($ucnt + 1) . '.txt';
   }
   $file = $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets.'/'.$in['file'];
   if ($in['file']) {

      if (is_dir($file)) {
         header("Location: " . $_SERVER['HTTP_REFERER'] . "detail.php?path=" . $in['file']);
         exit;
      } if (file_exists($file)) {
         $contents = htmlspecialchars(file_get_contents($file));
      }
   }
?>
<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title></title>
      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
      <script type="text/javascript" src="ckeditor.js"></script>
      <link rel='stylesheet' type='text/css' href="/lib/css/Aristo/jquery-ui-1.8.5.custom.css" />
      <link rel="stylesheet" type="text/css" href="/lib/css/icons.css" />
      <link rel="stylesheet" type="text/css" href="/lib/css/core.css" />
      <link rel="stylesheet" type="text/css" href="<?php print $boss->app->Assets . "/" . $boss->app->CSS; ?>" />
   </head>
   <body>
      <div class='main'>
         <form method="POST" action="cmd.php">
            <input type='hidden' name='x' value='save'>
            <input type='hidden' name='path' value='<?php print $in['file']; ?>'>
            <textarea id='content' name='content' rows='10' cols='80'>
            <?php print $contents; ?>
            </textarea>
            <script type="text/javascript">
               CKEDITOR.replace( 'content', { fullPage : true, extraPlugins : 'docprops' });
               CKEDITOR.on('instanceReady',
                  function(evt) {
                     var editor = evt.editor;
                     editor.execCommand('maximize');
                  }
               );

               function maximize() {
                  var editor = CKEDITOR.instances.editor1;
                  editor.execCommand('maximize');
               }

               function doSave() {
                  var content = CKEDITOR.instances.editor1.getData();
                  $.post("cmd.php", {"x":"save","path":"<?php print $in['file']; ?>","content":content }, function(data) { 
                     if (top && top.updateStatus) top.updateStatus(data['result']); 
                     self.location.href = "/apps/files/detail.php?path=<?php print dirname($file); ?>";
                  });
               }
            </script>
         </form>
      </div>
   </body>
</html>
