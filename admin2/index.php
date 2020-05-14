<?php  
    if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
?>
<!DOCTYPE html>
<html lang='en'>
<head>
  <base href="/admin2/">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/png" href="<?php print ($boss->app->Favicon) ? $boss->app->Favicon : '/favicon.ico'; ?>">
  <title><?php print $boss->app->App . ' - Simple Software'; ?></title>
<?php
    include("head.html");
    include("nav.php");
    include("content-wrapper.php");
    include("footer.html");
    include("scripts.html");

?>
<script>
   function updateStatus(msg) {
      console.log(msg);
   }

   function clearClass(cls) {
      var all = document.querySelectorAll("a.active");
      var re = new RegExp(cls + '\s*', "g");

      for (var i=0; i<all.length; i++) {
         all[i].className = all[i].className.replace(re, '');
      }
   }

   document.addEventListener("click", (event) => {
      event.preventDefault();
      event.returnValue = '';
      var a;
      if (!event.target.href) {
         a = event.target.parentElement;
      } else {
         a = event.target;
      }
      
      if (a.href && a.href != "#") {
         clearClass('active');
         a.className += ' active';
         document.querySelector("#content").src = a.href;

      }
      console.dir(event.target.parentElement);
      console.dir(event);
      return false;
   });
</script>
<?php
    include("end.html");
?>
