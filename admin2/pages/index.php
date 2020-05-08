<?php  
    if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");

    include("head.html");
    include("nav.php");
    include("content-wrapper.html");
    include("footer.html");
    include("scripts.html");
    include("end.html");

?>
<script>
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
         a = event.target.href;
      }
      if (a.href) {
         clearClass('active');
         a.className += ' active';
         document.querySelector("#content").href = a.href;

      }
      console.dir(event.target.parentElement);
      console.dir(event);
      return false;
   });
</script>
