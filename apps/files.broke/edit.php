<?php 
   require($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php'); 
   
   $path = ($_GET['path']) ? $_GET['path'] : $_POST['path'];

   if ($path) {
      $fullpath = $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets.$path;
      $syntax = preg_replace("/[^\.]*\./", '', $path); 
   }
  
?>
<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title></title>
   </head>
   <body>
      <form method='post'>
         <input type='hidden' name='path' id='path' value='<?php print $path; ?>' />
         <textarea id='editcontent' name='editcontent'><?php
            if ($path) {
               $code = file_get_contents($fullpath);
               print htmlspecialchars($code);
            }
         ?></textarea>
      </form>
   </body>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
   <script language="Javascript" type="text/javascript" src="/lib/js/edit_area/edit_area_full.js"></script>
   <script type='text/javascript'>
      function doSave(id, content) {
         $.post("cmd.php", {"x":"save","path":"<?php print $path; ?>","content":content }, function(data) { 
            if (top && top.updateStatus) top.updateStatus(data['result']); 
            self.location.href = "detail.php?path=<?php print dirname($path); ?>";
         });

      }

      $(document).ready(function($) {
          editAreaLoader.init({
               id: "editcontent", // id of the textarea to transform      
               start_highlight: true,
               allow_resize: "both",
               allow_toggle:false,
               fullscreen:true,
               language: "en",
               syntax: "<?php print $syntax; ?>",
               toolbar: "new_document, save, search, go_to_line, |, undo, redo, |, select_font, word_wrap, |, syntax_selection, |, change_smooth_selection, highlight, reset_highlight, |, help",
               syntax_selection_allow: "txt,css,html,js,php,python,vb,xml,c,cpp,sql,basic",
               save_callback: "doSave",
               show_line_colors: true
          });
      });
   </script>
</html>
