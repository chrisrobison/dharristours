<script language='JavaScript' type='text/javascript'>
   function redir() {
      if (parent) {
         parent.document.location.href = '/login.php?logout=yes';
      } else {
         document.location.href = '/login.php?logout=yes';
      }
   }
   window.onload = redir;

</script>
