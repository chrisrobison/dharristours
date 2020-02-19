<?php
require_once("boss_class.php");
session_start();

$in = $_REQUEST;
$boss = new boss();

$__this_site = "ODA CMS";
$__this_section = "Login";
$url = $_REQUEST['url'];
if (!$url || $url=='%2F') $url = "/admin/index.php";

$msg = "";

if ($_REQUEST['logout'] == 'yes') {	
   $boss->utility->logout($boss);
   // header("Location: /index.php");
   print "<script language='Javascript' type='text/javascript'>\nparent.location.href='/index.php';\n</script>\n";
   exit;
} else if (isset($_REQUEST['submitted'])) {
	if ($in['email'] && $in['password']) {
		if ($boss->utility->login($boss, $_REQUEST)) {
         header("Location: $url");
			exit;
		} else {
		   $msg = "<div class='formError' style='padding:5px 5px 5px 5px'>Log in failed. Invalid username and/or password.</div>";
  		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
   <head>
      <title>Login</title>
      <link rel='stylesheet' type='text/css' href='/lib/css/default.css' />
   </head>
   <body onload="<?php if ($dosubmit==1) print 'document.forms[0].submit();'; ?>">
      <?php if ($msg) echo $msg; ?>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
         <div class='centered'>
            <img id='logo' src="/site/images/netoasis_logo.gif" style='border:15px solid #fff;border-left:30px solid #fff;border-right:30px solid #fff;'/>
            <div id='loginDialog'>
               <div id='loginTitle' onmousedown="dragStart(event, 'dialogmain');">Login</div>
               <div id='loginBody'>
                  <div class='loginRow' style='white-space:nowrap;'>
                     <span class='fieldLabel3' style='white-space:nowrap;'>Email Address:</span>
                     <input type="text" name="email" size="30" value="<?php echo $_REQUEST['email']; ?>" class='fieldLabel'  style='width:13em;text-align:left;'/>
                  </div>
                  <div class='loginRow'>
                     <span class='fieldLabel3'>Password:</span>
                     <input name="password" type="password" size="30" value="<?php echo $_REQUEST['email']; ?>" class='fieldLabel' style='width:13em;text-align:left;'/>
                  </div>
               <div class='loginRow'>
                   <input name="login" type="submit" id="login" value="Login" class='toolbarButton' style='position:relative;z-index:9999999;' />
                </div>
               <div class='loginRow'>
                Forgot your <a href="#" style='color:#b0d0ff;'> password?</a>
                </div>
             </div>
         </div>
         <input type="hidden" name="submitted" value="true">
         <input type="hidden" name="url" value="<?php echo $url; ?>">
      </form>
   </body>
</html>
