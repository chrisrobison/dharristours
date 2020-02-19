<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/boss_class.php");
session_start();

$in = $_REQUEST;
$boss = new boss();

if ($in['z']) {
   $qs = base64_decode($in['z']);

   $parts = explode('&', $qs);
   $cnt = count($parts);

   for ($i=0; $i < $cnt; $i++) {
       list($key, $val) = preg_split("/=/", $parts[$i]);
       $in[urldecode($key)] = urldecode($val);
   }
}

if ($in['k']) {
   $results = $boss->getObject("Login", "sha1(concat(Passwd, Email)) = '{$in['k']}'");
   $user = $results->Login[0];
   $email = $user->Email;
}

if ($in['chpass'] && $user && $in['password'] && ($in['password'] == $in['verify'])) {
   $out['Login'][$user->LoginID]['Passwd'] = sha1($in['password']);
   $upd = $boss->storeObject($out);
   $updated = 1;
}

if ($_REQUEST['sendforgot']) {
   $all = $boss->getObject("Login", "Email=" . $boss->q($in['email']));
   $user = $all->Login[0];
   $email = $user->Email;
   $date = date("r");
   $key = sha1($user->Passwd . $user->Email);
   $prot = ($_SERVER['SERVER_PORT'] != 443) ? "http://" : "https://";
   $url = $prot . $_SERVER['SERVER_NAME'] . "/pw/?z=" . base64_encode("k=$key&f=1");

$emsg = <<<EOT
Date: $date
To: $email
From: Simple Software System <support@simpsf.com>
Subject: Forgot / Reset Password Request

Greetings!

We have recently received a request to allow the password for this account to be changed 
without the existing password.  This is usually due to a forgotten password or account that 
has been locked out. 

If you made this request you may follow the link below to reset your forgotten password.
If you did *NOT* make this request, simply ignore this email and no changes will be made to 
your account. 

$url 

Feel free to email support@simpsf.com with any further questions or comments.

Good luck!


The Simple Software Automated Support System

EOT;

   $boss->utility->sendMail($emsg);

}

?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="X-UA-Compatible" content="chrome=1">
      <title>Simple Workspace: <?php print $boss->app->App; ?></title>
      <link rel='stylesheet' type='text/css' href='/lib/css/default.css' />
      <link href="/lib/css/Aristo/jquery-ui-1.8.5.custom.css" type="text/css" rel="stylesheet" />
      <link rel="shortcut icon" href="/favicon.ico?v=2.3" />
      <link rel='stylesheet' type='text/css' href='/lib/css/core.css' />
      <style>
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
            .loginRow { height:auto; margin:.25em; }
            .fieldLabel3 { float:none; display:inline-block; }
            .fieldLabel { float:none; }
            #loginDialog { width: 35em; }
            #loginDialog input { background-color:#f0f0f0; border:1px solid #aaa; width:13em; }
            #loginDialog input:focus { background-color:#ffffff; border:1px solid #777; font-size:1.2em; box-shadow:.25em .25em .5em rgba(0,0,0,.35); -webkit-focus-ring: transparent; outline: none; width:9em; }
            h3 { margin: 0px; }
            .centered, #loginDialog input { 
               transition: all .25s;
               -moz-transition: all .25s;
               -webkit-transition: all .25s;
               -o-transition: all .25s;
            }
            a { color:#0000cc; }
            a:visited { color:#000077; }
            .dialogTitlebar {
               background: #2a2c2d;
               background: -moz-linear-gradient(top,  #2a2c2d 0%, #383d3b 50%, #0a0e0a 55%, #0a0809 100%);
               background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#2a2c2d), color-stop(50%,#383d3b), color-stop(55%,#0a0e0a), color-stop(100%,#0a0809));
               background: -webkit-linear-gradient(top,  #2a2c2d 0%,#383d3b 50%,#0a0e0a 55%,#0a0809 100%);
               background: -o-linear-gradient(top,  #2a2c2d 0%,#383d3b 50%,#0a0e0a 55%,#0a0809 100%);
               background: -ms-linear-gradient(top,  #2a2c2d 0%,#383d3b 50%,#0a0e0a 55%,#0a0809 100%);
               background: linear-gradient(to bottom,  #2a2c2d 0%,#383d3b 50%,#0a0e0a 55%,#0a0809 100%);
               filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#2a2c2d', endColorstr='#0a0809',GradientType=0 );
            }
      </style>
      <link rel='stylesheet' type='text/css' href='<?php print $boss->app->Assets . '/' . $boss->app->CSS; ?>' />
   </head>
   <body>
   <?php 
      if ($msg) print $msg; 
      if ($in['f']) { 
   ?>
      <form id="chpassForm" action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="no">
         <input type='hidden' name='k' id='k' value='<?php print $in['k']; ?>'>
         <div class='centered'>
            <div id='appLogo'><img id='logoImage' src="<?php print $boss->app->Assets . "/" . $boss->app->Logo; ?>" border="0" /></div>
            <h1 class='appTitle'><?php print $boss->app->App; ?></h1>
            <div id='loginDialog'>
               <div id='loginTitle' class='dialogTitlebar'>Change Password</div>
                  <div id='loginBody'>
                     <div class='loginRow'>
                        <span class='fieldLabel3'>Email: </span>
                     <?php if (!$in['f']) { ?>
                        <input type="text" id="email" name="email" size="30" value="<?php print $email; ?>" class='fieldLabel'  style='text-align:left;' autocomplete="no" />
                     <?php } else { ?>
                        <span style='text-align:left;background-color:#f0f0ef;border:1px solid #aaa;border-radius:.5em;padding:.25em;' class='fieldLabel'><?php print $email; ?></span>
                     <?php } ?>
                     </div>
                     <?php if (!$in['f']) { ?>
                     <div class='loginRow'>
                        <span class='fieldLabel3'>Old Password:</span>
                        <input type="password" id="password" name="password" size="30" value="" class='fieldLabel'  style='text-align:left;' autocomplete="no" />
                     </div>
                     <?php } ?>
                     <div class='loginRow'>
                        <span class='fieldLabel3'>New Password:</span>
                        <input type="password" id="password" name="password" size="30" value="" class='fieldLabel'  style='text-align:left;' autocomplete="no" />
                     </div>
                     <div class='loginRow'>
                        <span class='fieldLabel3'>Verify Password:</span>
                        <input type="password" name="verify" id="verify" size="30" value="" class='fieldLabel' style='text-align:left;' autocomplete="no" />
                     </div>
                     <hr>
                     <div class='loginRow' style='height:auto;text-align:left;padding:0 1em;'>
                        To change your password, enter <?php if (!$in['f']) { ?>your login email address and existing password with <?php } ?>your new password in the form above.  When you are done, click the 'Change Password' button to have your password updated.
                     </div>
                     <hr>
                     <div class='loginRow ctl' style='margin-top:0px;'>
                        <input name="chpass" type="submit" id="chpass" value="Change Password" class='ui-state-default simpleButton' style='width:10em;height:2em;margin-bottom:1em;float:right;' /><br>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <input type="hidden" name="submitted" value="true">
         <input type="hidden" name="url" value="<?php print $url; ?>">
      </form>
      <?php
            $js = "$('#password').focus().select();";
         } else if ($in['sendforgot']) {

      ?>
      <form id="sentForm" action="<?php print $_SERVER['PHP_SELF']; ?>" onsubmit="return doLogin('<?php print $_SESSION['token']; ?>')" method="post" autocomplete="no">
         <div class='centered'>
            <div id='appLogo'><img id='logoImage' src="<?php print $boss->app->Assets . "/" . $boss->app->Logo; ?>" border="0" /></div>
            <h1 class='appTitle'><?php print $boss->app->App; ?></h1>
            <div id='loginDialog'>
               <div id='loginTitle' class='dialogTitlebar'>Password Reset</div>
                  <div id='loginBody'>
                     <div class='loginRow' style='height:auto;text-align:left;padding:0 1em;'>
                        <h3>Password Reset Instructions Sent</h3>
                        <hr>
                        Instructions on how to reset your password have been sent to <?php print $email; ?>.  Follow the link and instructions provided in the email and your password will be changed in no time.
                     </div>
                     <div class='loginRow ctl' style='margin-top:0px;'>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <input type="hidden" name="submitted" value="true">
         <input type="hidden" name="url" value="<?php print $url; ?>">
      </form>
      <?php
         } else if ($updated) {
      ?>
      <form id="updatedForm" action="<?php print $_SERVER['PHP_SELF']; ?>" onsubmit="return doLogin('<?php print $_SESSION['token']; ?>')" method="post" autocomplete="no">
         <div class='centered'>
            <div id='appLogo'><img id='logoImage' src="<?php print $boss->app->Assets . "/" . $boss->app->Logo; ?>" border="0" /></div>
            <h1 class='appTitle'><?php print $boss->app->App; ?></h1>
            <div id='loginDialog'>
               <div id='loginTitle' class='dialogTitlebar'>Password Changed</div>
                  <div id='loginBody'>
                     <div class='loginRow' style='height:auto;text-align:left;padding:0 1em;'>
                        <h3>Your password has been changed.</h3>
                        <hr>
                        The password for the account '<?php print $email; ?>' has been successfully changed.  You may <a href='/login.php'>login</a> with your new password immediately. 
                     </div>
                     <div class='loginRow ctl' style='margin-top:0px;'>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <input type="hidden" name="submitted" value="true">
         <input type="hidden" name="url" value="<?php print $url; ?>">
      </form>
      <?php
         }
      ?>
  <!--[if IE]>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js"></script>
    <style>
     .chromeFrameInstallDefaultStyle {
       margin-top:-250px;
       border: 5px solid black;
     }
    </style>
    <div id="prompt">
      <h1>This application requires installation of the Google chrome frame plugin.</h1>
    </div>
    <script>
     // The conditional ensures that this code will only execute in IE,
     // Therefore we can use the IE-specific attachEvent without worry
     window.attachEvent("onload", function() {
       CFInstall.check({
         mode: "inline", // the default
         node: "prompt"
       });
     });
    </script>
  <![endif]-->
   </body>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
   <script type='text/javascript'>
      function doLogin(token) {
         // Something could go here to massage login info before being submitted to the server
      }
      $(function() {
         <?php if ($dosubmit==1) print '$("#loginForm").submit();'; ?>
         // $("input[name='email']").focus();
         <?php print $js; ?>
         $("#forgot").click(function() { 
            
         });
      });
   </script>
</html>
