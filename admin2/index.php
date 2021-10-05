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
//    include("footer.html");
    include("scripts.html");

?>
<script>
   function updateStatus(msg) {
      console.log(msg);
   }
   
   function toggleSidebar() {
      if (document.body.className.match(/sidebar\-mini/)) {
         document.body.className.replace(/\s?(sidebar\-mini|sidebar\-collapse)\s?/g, '');
      } else {
         document.body.className += " sidebar-mini sidebar-collapse";
      }
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
      
      if (a.dataWidget == "pushmenu") {
         toggleSidebar();
      } else if (a.href && a.href != "#") {
         document.querySelector("#content").src = a.href;
      }
      if (a.href) {
         a.classList.toggle('active');
      }
      console.dir(event.target.parentElement);
      console.dir(event);
      return false;
   });
   
   function init() {
      document.querySelector("section.content").style.height = window.innerHeight + 'px';
   }

   if (document.readyState === "loading") {
      document.addEventListener("DOMContentLoaded", init);
   } else {
      init();
   }
</script>
<?php
    include("end.html");
?>
