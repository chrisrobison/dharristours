<?php
   include($_SERVER['DOCUMENT_ROOT'] . '/lib/auth.php');

   if ($in['mid']) {
      $module = $boss->getObject("Module", $in['mid']);
      $acc = ($_SESSION['Login']->ProcessPref) ? " & ".$_SESSION['Login']->ProcessPref : "";
      $processes = $boss->getObject("Process", "ModuleID=" . $boss->q($in['mid']) . " AND ParentID=0 AND (Access & {$_SESSION['ProcessAccess']}{$acc}) ORDER BY Sequence");
   }
?>
<!DOCTYPE html> 
<html>
   <head>
      <meta charset="utf-8">
      <title></title>
      <link href='//fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" type="text/css" href="/lib/css/icons48.css" />
      <link rel="stylesheet" type="text/css" href="/lib/css/icons-small.css" />
      <link rel='stylesheet' type='text/css' href='/lib/css/core.css'>
      <link rel="stylesheet" type="text/css" href="<?php print $boss->app->Assets . "/" . $boss->app->CSS; ?>" />
      <style>
         body { margin:0;padding:0;font-size:14px;font-family:Georgia, Times, serif; }
         h1, h2, h3, h4, h5, a { font-family: Quicksand, "Helvetica Neue", Optima, Verdana, sans-serif; }
         a { text-decoration:none;color:#555; }
         a:hover { text-decoration:underline; color:#00a; }
         a:visited { color:#333; }
         a:active { color:#e00;display:inline-block;top:2px; }
         #main { padding:1em; }
         ul.nav {
            margin-left:2em;
            width:20em;
            float:left;
         }
         ul.nav li { margin-top: 1em; margin-bottom: 1em; }
         ul.nav li a { font-size:1.5em; }
         .navNoIcon {
            margin-right:.5em;
            padding:.35em .13em .2em .15em;
            border-radius: 1em; -webkit-border-radius: 1em; -moz-border-radius: 1em;
            text-shadow:2px 2px 0px #fff;
            font-size: 2.5em;
            vertical-align: middle;
            font-family: Quicksand, "Helvetica Neue", Optima, Verdana, sans-serif; 
         }
          .navIcon {
            margin-right:.5em;
            padding:.2em .25em .4em .2em;
            border-radius: 1em; -webkit-border-radius: 1em; -moz-border-radius: 1em;
            font-family: Quicksand, "Helvetica Neue", Optima, Verdana, sans-serif; 
         }
         .navNoIcon:hover, .navIcon:hover {
            background-color:#ffc;
         }
      </style>
   </head>
   <body>
      <div id='main'>
         <?php
            print "<h1>" . $module->Module . "</h1>\n";
            print "<ul class='nav'>\n";
            $cnt = 0;
            $count = count($processes->Process['_ids']);
            for ($i=0; $i<$count; $i++) {
               $proc = $processes->Process[$i];
               $url = ($proc->URL) ? $proc->URL : "/grid/?pid=".$proc->ProcessID;
               if ($proc->Settings) $url .= '&'.$proc->Settings;
               $target = ($proc->Target) ? " target='".$proc->Target."'" : "";
               if (!$proc->ClassName) { $proc->ClassName = "nav"; }
               $js = ($proc->JS) ? " onclick='".$proc->JS.";return false;'" : "";
               $rel = ($js) ? 'noload' : 'nav';
               $url = ($js) ? "javascript:".$proc->JS : $url;

               print "\t\t<li id='pid_" . $proc->ProcessID . "'><a rel='$rel'$target title='" . $proc->Process . "' href='" . $url . "'$js class='" . $proc->ClassName . "'>";
               if ($proc->Icon) {
                  if (preg_match("/\.(png|jpg|gif|ico|bmp|svg)$/", $proc->Icon)) {
                     $icon = (file_exists($_SERVER['DOCUMENT_ROOT'].$boss->app->Assets.$proc->Icon)) ? $boss->app->Assets.$proc->Icon : $proc->Icon;
                     if (!file_exists($_SERVER['DOCUMENT_ROOT'].$icon)) {
                        print "<div class='navNoIcon'>".preg_replace("/^(\w).*/", "$1", $proc->Process)."</div>";
                     } else {
                        print "<div class='navIcon'><img src='".$icon."' border='0' /></div>";
                     }
                  } else {
                     print "<div class='navIcon'><span class='simpleIcon icon-".$proc->Icon."'> </span></div>";
                  }
               } else {
                  print "<div class='navNoIcon'>".preg_replace("/^(\w).*/", "$1", $proc->Process)."</div>";
               }
               print $proc->Process."</a>";
               
               // Check for process children and output accordingly
               $childs = $boss->db->Process->getlist("ParentID!=0 AND ParentID=" . $proc->ProcessID);
               if (count($childs)) {
                  print "<span class='arrow'>&#9656;</span><span class='arrow' style='display:none;'>&#9662;</span>";
                  print "<ul id='mid-" . $mod->ModuleID . "_pid-" . $proc->ProcessID . "' class='nav child' style='display:none'>\n";
                  foreach ($childs as $child) {
                     $url = ($child->URL) ? $child->URL : "/grid/?pid=".$child->ProcessID;
                     $cname = $child->ClassName ? $child->ClassName : "childnav";

                     print "\t\t<li class='$cname' id='pid_" . $child->ProcessID . "'><a rel='nav' title='" . $child->Process . "' href='" . $url . "' class='" . $cname . "'>" . $child->Process . "</a></li>\n";
                  }

                  print "</ul>\n";
               }
               print "</li>\n";
               ++$cnt;
               if ($cnt == 4) {
                  $cnt = 0;
                  print "</ul><ul class='nav'>";
               }
            }
            print "</ul>";
         ?>
      </div>
   </body>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type='text/javascript'>
      $(document).ready(function() {
         $("a[rel=nav]").click(function(e) {
            top.loadUrl($(this).attr("href"), $(this).text());
            e.stopPropagation();
            e.preventDefault();
            return false;
         });
         $("span.arrow").click(function() { 
            $("ul.child", $(this).parent()).toggle(); 
            $(this).siblings("span.arrow").toggle();
            $(this).toggle();
         });
 
      });
   </script>
</html>
