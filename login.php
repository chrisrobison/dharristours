<?php
/*
if ($_SERVER['SERVER_PORT'] != 443) {
   header("Location: https://".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
   exit;
}
*/
require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/boss_class.php");
session_start();

	
$in = $_REQUEST;
$boss = new boss();

$url = $_REQUEST['url'];
if (!$url || $url=='%2F') $url = "/apps/index.php";

$msg = "";
if (file_exists($boss->app->Assets . "/login.php")) {
   print "<script language='Javascript' type='text/javascript'>\nlocation.href='//{$_SERVER['SERVER_NAME']}{$boss->app->Assets}/login.php';\n</script>\n";
   exit;
}

if (isset($_COOKIE['email'])) {
     unset($_COOKIE['email']);
     unset($_SESSION['email']);
     setcookie('email', null, -1, '/');
}

if ($_REQUEST['logout']) {	
   $boss->utility->logout($boss);
   // header("Location: /index.php");
   print "<script type='text/javascript'>\ntop.location.href='/login.php?url=/apps/';\n</script>\n";
   exit;
} else if (isset($_REQUEST['submitted'])) {
	if ($in['email'] && $in['password']) {
		if ($boss->utility->login($boss, $_REQUEST)) {
         if (array_key_exists("goto", $in)) {
            if (array_key_exists("savedest", $in) && array_key_exists('Login', $_SESSION)) {
               $_SESSION['Login']->StartURL = $in['goto'];
               setcookie("StartURL", $in['goto'], time() + 88473600);   // Set to 1024 days in the future
               $_COOKIE['StartURL'] = $in['goto'];
            }
            $url = $in['goto'];
         } else if ($_SESSION['Login']->StartURL) {
            $url = $_SESSION['Login']->StartURL;
         } else if (array_key_exists('url', $in)) {
            $url = $in['url'];
         }
         setcookie("email", $in['email']);
         setcookie("name", $_SESSION['FirstName'] . ' ' . $_SESSION['LastName']);
         header("Location: $url");
			exit;
		} else {
		   $msg = "<div class='formError' style='padding:5px 5px 5px 5px'>Log in failed. Invalid username and/or password.</div>";
  		}
	}
}
?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="D Harris Tours">
    <link rel="apple-touch-icon" href="touch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/portal/assets/touch-icon-152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/portal/assets/touch-icon-180.png">
    <link rel="apple-touch-icon" sizes="167x167" href="/portal/assets/touch-icon-167.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/portal/assets/touch-icon-120.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/portal/assets/touch-icon-114.png">
      <link rel="apple-touch-icon" sizes="87x87" href="/portal/assets/touch-icon-87.png">
      <link rel="apple-touch-icon" sizes="80x80" href="/portal/assets/touch-icon-80.png">

      <title><?php print $boss->app->App; ?> - Simple Workplace</title>
      <link rel='stylesheet' type='text/css' href='/lib/css/default.css' />
      <link href="/lib/css/Aristo/jquery-ui-1.8.5.custom.css" type="text/css" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="/lib/css/core.css" />
      <?php
         $favicons = array(
             $boss->app->Assets . '/favicon.ico', 
             $boss->app->Assets . '/favicon.png',
             $boss->app->Assets . '/img/favicon.ico', 
             $boss->app->Assets . '/img/favicon.png'
         );

         foreach ($favicons as $path) {
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $path)) { 
               print '<link rel="icon" type="image/'. substr($path, -3) .'" href="' . $path . '">';
               break;
            } 
         }
      ?>
       <style>
         * { box-sizing: border-box; }
         body { background-color: #306090; color:#ffffff; }
         #loginForm .centered .simpleButton {
            float:right;
             -moz-border-radius: 2em 2em 2em 2em;
             -moz-box-shadow: 3px 3px 5px rgba(0,0,0,.5);
             background: -moz-linear-gradient(center top , #D0D0D0 0%, #FFFFFF 50%, #E0E0E0 51%, #A0A0A0 100%) repeat scroll 0 0 transparent;
             border-color: #99bbcc #555 #555 #99bbcc;
             border-style: solid;
             border-width: 1px;
             color: #000000;
             cursor: default;
             display: inline-block;
             height: 2em;
             margin: 4px 2px 0;
             outline: medium none;
             padding: 1px 0.6em 3px;
             text-decoration: none;
             font-size:14px;
             font-family: "Helvetica Neue",Optima,'Gill Sans','Gill Sans MT',Verdana,Arial,Helvetica,sans-serif;
         }
         h1 { font-size:43px;margin:0;
            -moz-text-shadow:0 1px 0 #909090, 0 2px 0 #999999, 0 3px 0 #808080, 0 4px 0 #888888, 0 5px 0 #666666, 0 6px 1px rgba(0, 0, 0, 0.1), 0 0 5px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.3), 0 3px 5px rgba(0, 0, 0, 0.2), 0 5px 10px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.2), 0 20px 20px rgba(0, 0, 0, 0.15);
            -webkit-text-shadow:0 1px 0 #909090, 0 2px 0 #999999, 0 3px 0 #808080, 0 4px 0 #888888, 0 5px 0 #666666, 0 6px 1px rgba(0, 0, 0, 0.1), 0 0 5px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.3), 0 3px 5px rgba(0, 0, 0, 0.2), 0 5px 10px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.2), 0 20px 20px rgba(0, 0, 0, 0.15);
            text-shadow:0 1px 0 #909090, 0 2px 0 #999999, 0 3px 0 #808080, 0 4px 0 #888888, 0 5px 0 #666666, 0 6px 1px rgba(0, 0, 0, 0.1), 0 0 5px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.3), 0 3px 5px rgba(0, 0, 0, 0.2), 0 5px 10px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.2), 0 20px 20px rgba(0, 0, 0, 0.15);
            } 
            #appLogo { margin-top:3em; }
            /* #prompt { position: absolute; top: 0px; bottom:0px; left:0px; right:0px; width:100%; height:100%; z-index:99999;} */
            input { -webkit-focus-ring: transparent; }
            .fieldLabel3 { width:5em; }
            #loginDialog { border-radius: 0; font-size: 18px; width: 600px; }
            .newlabel { text-align: right; width: 8rem;padding-right: 1rem; padding-top: 4px;}
            .loginRow { height: auto; display: flex; flex-direction: row; }
            #loginDialog .loginRow input { font-size: 18px; border-radius:0; border:0; width: 22rem;}
            #loginForm .centered .simpleButton { 
    width: 9rem;
    font-size: 24px;
    text-transform: uppercase;
    font-weight: 300;
    color: #fff;
    background: #000;
    margin: 0 auto;
    text-shadow:0;
    font-family: "Helvetica",sans-serif;
    border-radius: 0;
            }
            #loginDialog div.dialogTitlebar { height: 3rem; }
            .loginRow3 { text-align: center; }
            @media  only screen and (max-width:450px) {
               body { font-size: 18px; }
               #loginDialog {
                  font-size: 22px; width: 100vw;
               }
               #loginDialog div.dialogTitlebar { height: 4rem; }
               .loginRow { height: auto; display: flex; flex-direction: column; margin: 0.5rem 0; padding: 0; }
               #loginDialog .loginRow input { font-size: 24px; border-radius:0; border:0; width: 80vw;}
               .newlabel { text-align: left; width: auto; padding-top: 0; padding-right: 0; }         
               .loginRow3 { display: flex; flex-direction: column; }
            }
            select {
               font-size: 16px;
               border: 0;
               height: 2.4rem;
               width: 22rem;
            }
      </style>
      <link rel='stylesheet' type='text/css' href='<?php print $boss->app->Assets . '/' . $boss->app->CSS; ?>' />
   </head>
   <body>
   <?php if ($msg) print $msg; ?>
      <form id="loginForm" action="<?php print $_SERVER['PHP_SELF']; ?>" onsubmit="return doLogin('<?php print $_SESSION['token']; ?>')" method="post" autocomplete="no">
         <div class='centered'>
            <div id='appLogo'><img id='logoImage' src="<?php print $boss->app->Assets . "/" . $boss->app->Logo; ?>" border="0" /></div>
            <!-- <img id='logo' src="<?php print $boss->app->Assets . "/" . $boss->app->Logo; ?>" /><br /> -->
            <h1 class='appTitle'><?php print $boss->app->App; ?></h1>
            <div id='loginDialog'>
               <div id='loginTitle' class='dialogTitlebar'>Login</div>
                  <div id='loginBody'>
                     <div class='loginRow'>
                        <div class='newlabel' style='white-space:nowrap;'>Email</div>
                        <input type="text" id='loginEmail' name="email" size="30" value="<?php print $_REQUEST['email']; ?>" class='fieldLabel'  style='text-align:left;' autocomplete="no" />
                     </div>
                     <div class='loginRow'>
                        <div class='newlabel'>Password</div>
                        <input name="password" type="password" size="30" value="" class='fieldLabel' style='text-align:left;' autocomplete="no" />
                     </div>
                     <div class='loginRow'>
                        <div class='newlabel'>Go To</div>
                        <select id="goto" name="goto">
                        <?php 
$sel = false;
if (array_key_exists("url", $in)) {
$sel = true;
   print <<<EOT
<option value="{$in['url']}" SELECTED>My Destination [{$in['url']}]</option>
EOT;
}
?>
                           <option value="/apps/"<?php print ((($_COOKIE['StartURL'] == "/apps/") || ($_SESSION['Login']->StartURL=="/apps/")) && $sel!==true) ? " SELECTED" : ""; ?>>Workspace</option>
                           <option value="/admin2/"<?php print ((($_COOKIE['StartURL'] == "/admin2/") || ($_SESSION['Login']->StartURL=="/admin2/")) && ($sel !== true)) ? " SELECTED" : ""; ?>>Workspace, New UI (Beta)</option>
                           <option value="/portal/"<?php print ((($_COOKIE['StartURL'] == "/portal/") || ($_SESSION['Login']->StartURL=="/portal/")) && ($sel !== true)) ? " SELECTED" : ""; ?>>Customer Portal</option>
                        </select>
                     </div>
                      <div class='loginRow3' style="display:flex;flex-direction:row;align-items:center;justify-content:space-between;text-align:left;font-size:0.9em;padding-left:2rem;">
                        <div style="display:flex;flex-direction:column;">
                           <span><input name="remember" type="checkbox"  checked="checked" value="true" /> Remember me</span>
                           <span> <input name="savedest" type="checkbox" value="true" /> Save as Default</span>
                        </div>
                        <input name="login" type="submit" id="login" value="Login" style="margin:1rem" class='ui-state-default simpleButton' />
                     </div>
                     <div class='loginRow ctl'>
                      <a id="forgot" href="#ForgotPassword" style='display:inline-block;margin-top:1em;color:#0033aa;'>Forgot your password?</a>
                      </div>
                   </div>
               </div>
            </div>
         </div>
         <input type="hidden" name="submitted" value="true">
         <input type="hidden" name="url" value="<?php print $url; ?>">
      </form>
      <form id="forgotForm" action="/pw/" method="post" autocomplete="no" style="display:none">
         <div class='centered'>
            <div id='appLogo'><img id='logoImage' src="<?php print $boss->app->Assets . "/" . $boss->app->Logo; ?>" border="0" /></div>
            <!-- <img id='logo' src="<?php print $boss->app->Assets . "/" . $boss->app->Logo; ?>" /><br /> -->
            <h1 class='appTitle'><?php print $boss->app->App; ?></h1>
            <div id='loginDialog'>
               <div id='loginTitle' class='dialogTitlebar'>Forgot Password</div>
                  <div id='loginBody'>
                     <div class='loginRow'>
                        <span class='fieldLabel3' style='white-space:nowrap;'>Email</span>
                        <input type="text" id='forgotEmail' name="email" size="30" value="<?php print $_REQUEST['email']; ?>" class='fieldLabel'  style='width:18em;text-align:left;' autocomplete="no" />
                     </div>
                     <div class='loginRow' style='height:auto;text-align:left;padding:0 1em;'>
                        <!-- <span class='fieldLabel3'>Password</span>
                        <input name="password" type="password" size="30" value="" class='fieldLabel' style='width:13em;text-align:left;' autocomplete="no" />-->
                        <hr>
                        To reset your password, enter your login email address above and click the 'Forgot Password' button below.  An email will be sent to the email address provided with instructions on how to reset your password.
                        <hr>
                     </div>
                     <div class='loginRow ctl' style='margin-top:0px;'>
                        <input name="forgot" type="submit" id="forgot" value="Forgot Password" class='ui-state-default simpleButton' style='width:10em;height:2em;float:right;' />
                        <a id="backtologin" href="#Login" style='display:inline-block;margin-top:1em;color:#0033aa;'>&lt;&lt; Back to Login</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <input type="hidden" name="submitted" value="true">
         <input type="hidden" name="sendforgot" value="true">
      </form>
   </body>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
   <script type='text/javascript'>
      function doLogin(token) {
         // Something could go here to massage login info before being submitted to the server
      }
      $(function() {
         <?php if ($dosubmit==1) print '$("#loginForm").submit();'; ?>
         $("input[name='email']").focus();
         $("input[name='email']").select();
         $("#backtologin").click(function() { 
            $("#loginForm").show();
            $("#forgotForm").hide();
            $("#loginEmail").focus();
         });
         $("#forgot").click(function() { 
            $("#loginForm").hide();
            $("#forgotForm").show();
            $("#forgotEmail").focus().val($("#loginEmail").val());
         });
      });
   </script>
</html>
