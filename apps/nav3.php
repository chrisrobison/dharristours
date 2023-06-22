<?php
   if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");

   $boss->addModule();

   $modules = $boss->boss->Modules;
   $boss->addResource("Process");
   foreach ($modules as $idx=>$mod) {
   
      if (($_SESSION['Login']->ModulePref && ($_SESSION['Login']->ModulePref & $mod->Access)) || (!$_SESSION['Login']->ModulePref)) {
         $acc = ($_SESSION['Login']->ProcessPref) ? " & ".$_SESSION['Login']->ProcessPref : "";
         $arr = $boss->db->Process->getlist("ModuleID='".$mod->ModuleID."' AND ParentID=0 AND (Access & ".$_SESSION['ProcessAccess'].$acc.") order by Sequence");
         $modules[$idx]->Processes = $arr;

         $target = ($mod->Target) ? " target='".$mod->Target."'" : "";
         $ico = ($mod->ClassName) ? "dijitEditorIcon dijitEditorIconSave smallIcon small-" . $mod->ClassName : "";
         print "<div class='module' id='Module_{$mod->ModuleID}' dojoType='dijit.layout.ContentPane' onShow='loadModule(\"{$mod->URL}\", \"{$mod->ModuleID}\", \"{$mod->Module}\")' iconClass='$ico' title='" . $mod->Module . "'>\n";
         
         print "\t<ul id='mid_" . $mod->ModuleID . "' class='nav' >\n";
         //print "<h3><a rel='nav'$target href='".$mod->URL."'>".$mod->Module."</a></h3>\n<div>\n";

         if (count($arr)) {
            foreach ($arr as $pidx=>$proc) {
               $url = ($proc->URL) ? $proc->URL : "/grid/?pid=".$proc->ProcessID;
               if ($proc->Settings) $url .= '&'.$proc->Settings;
               $target = ($proc->Target) ? " target='".$proc->Target."'" : "";
               if (!$proc->ClassName) { $proc->ClassName = "nav"; }
               $js = ($proc->JS) ? " onclick='".$proc->JS.";return false;'" : "";
               $rel = ($js) ? 'noload' : 'nav';
               $url = ($js) ? "javascript:".$proc->JS : $url;

               print "\t\t<li id='pid_" . $proc->ProcessID . "'><a rel='$rel'$target data-module='{$proc->ModuleID}' title='" . $proc->Process . "' href='" . $url . "'$js class='" . $proc->ClassName . "'>";
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
               if ($proc->IsNew) {
                  print "<img class='new-badge' src='/img/new.svg'>";
               }
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

                  print "</ul>";
               }
               print "</li>\n";
            }
         }
         print "</ul></div>\n";
      }
   }
print "<script>\n\tvar modules = ";
print json_encode($modules);
print ";\n</script>";
 ?>
