<script language='JavaScript' type='text/javascript'>
   function redir() {
      document.location.href = '<?php print (($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].'/sales/'; ?>';
   }
   window.onload = redir;

</script>
