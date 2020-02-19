<?php
   require($_SERVER['DOCUMENT_ROOT'] . '/lib/boss_class.php');
   $in = $_REQUEST;
   $boss = new boss();
   $boss->db->dbobj->execute("SS_System");
   $boss->db->addResource("App");

   $dbh = $boss->db->App->execute("select * from App where Host='" . preg_replace("/\W/", '', $in['d']) . "'");
   $me = mysql_fetch_object($dbh);
   if (!$in['n']) $in['n'] = 'simpsf.com';
   $secure = ($in['n'] == 'simpsf.com') ? "https://" : "http://";
?>
<!DOCTYPE html> 
<html>
   <head>
      <meta charset="utf-8">
      <title>Simple Welcome</title>
      <link href='//fonts.googleapis.com/css?family=Nothing+You+Could+Do' rel='stylesheet' type='text/css'>
      <link href='//fonts.googleapis.com/css?family=Ubuntu+Mono:400,700' rel='stylesheet' type='text/css'>
      <link href='/lib/css/core.css' rel='stylesheet' type='text/css'>
      <style>
         body { background-color:#f0f0f0; }
         #core { width: 900px; margin: 2em auto 2em auto; padding:1em; line-height:2em; background-color:#fff; box-shadow: .25em .5em 1em rgba(0,0,0,.6); border-radius:1em; border: 1px solid transparent; }
         .link { text-decoration:underline; color:#0000cc; }
         .mono { font-family: "Ubuntu Mono", mono; font-size:1.3em; }
         strong { font-weight: 100; }
         blockquote { margin-left: 10em; } 
         p { padding: 0 3em; }
         #sig { font-family: 'Nothing You Could Do', cursive; font-size:1.8em; }
      </style>
  </head>
   <body>
      <div id='core'>
         <img src='/img/simple_banner.png' style='width:418px;height:150px;display:block;'>
         <h1>Congratulations!</h1>
         <p>Your new Simple Software Web Application has been setup and is ready for 
         you to login and begin managing your domains and information immediately.  Your application is located at:</p>
         <blockquote>
            Simple Workspace: <strong><a class='link mono' href="<?php print $secure . preg_replace("/\W/", '', $me->Host) . "." . $in['n']; ?>/"><?php print $secure . preg_replace("/\W/", '', $me->Host) . '.' . $in['n']; ?></a></strong>
         </blockquote>
         <p>
         Use the following account information to login to your workspace:</p>
         <blockquote>Username: <strong class='mono'><?php print $me->Email; ?></strong><br>
         Password: <strong class='mono'><?php print $me->Passwd; ?></strong> <br>
         </blockquote>
         <p>Click the 'Login' button and your Simple Workspace will load and is ready to use.
         </p>
         <p>
         Explore your Simple Workspace and fire up some of the components 
         included.  Try creating new data stores and forms with the DB Tool.
         Manage or create data using the auto-generated custom application
         that has been tailored for your needs. Transform your data into 
         information by relating it to other data.  And be sure to tell 
         everyone how "Simple" data management can be! 
         </p>
         <p>Please contact us at <a class='link' href='mailto:support@simplesoftwaresf.com'>support@simplesoftwaresf.com</a> if you have any 
         questions or comments.  </p><br>
         <hr>
         <p style='text-align:right;'><span id='sig'>The Simple Software Team</span><br>
         <a class='link' href="mailto:support@simpsf.com">support@simpsf.com</a><br>
         </p>
      </div>
      <br><br><br>
   </body>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type='text/javascript'>
      $(document).ready(function() {
         var rnd = Math.floor(Math.random() * 20) + 1;         
         $("body").css("background-image", "url(/landing/bg/bg" + rnd + ".jpg)");
      });
   </script>
</html>
