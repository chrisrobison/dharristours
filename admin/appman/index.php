<?php  
   if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
   
   $in = $_REQUEST;
   $boss = new boss();
   $nav = $boss->utility->buildNav($boss);

   function listNav($obj, $top=false) {
      $out = "<ul class='menu'".(($top)?" id='original'":"").">";
      foreach ($obj as $key=>$val) {
         $liclass = ($obj->{$key."_children"}) ? "expanded" : "leaf";
         $out .= "<li class='$liclass'><a href='#'>".$val->Name."</a>";
         if ($obj->{$key."_children"}) {
            $out .= "<br />";
            $out .= listNav($obj->{$key."_children"});
         }
         $out .= "</li>";
      }
      $out .= "</ul>";
      return $out;
   }
?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title>Navigation Browser</title>
      <link rel="stylesheet" type="text/css" href="/lib/css/main.css" />
   </head>
   <body>
      <div id='toolbar'>
         <div id='add' class='toolbtn'>+</div>
         <div id='remove' class='toolbtn'>-</div>
      </div>
      <div id='finder'>
         <?php print listNav($nav, true); ?>
      </div>
      <div id='edit'>
         <iframe id="editFrame" border="0" src="edit.php?rsc=Nav" width="100%" height="100%"> </iframe>
      </div>
   </body>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type="text/javascript" src="/lib/js/jquery.columnview.js"></script>
   <script type='text/javascript'>
      var navData = <?php print json_encode($nav); ?>;
   </script>
   <script type='text/javascript'>
      $(document).ready(function() {
         $('#original').columnview();
      });
   </script>  
</html>
