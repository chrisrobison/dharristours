<?php
//   include("navbar.php");
?><!-- Main Sidebar Container -->
<a style="float:right;color:#333;padding-right:1rem;padding-top:1rem;" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
<aside id='mainNav' class="main-sidebar sidebar-dark-primary elevation-4">
<!-- Brand Logo -->
<a href="index3.html" class="brand-link">
  <img src="/img/bus-white.png"
       alt="Logo"
       class="brand-image img-circle elevation-3"
       style="opacity: .8">
  <span class="brand-text font-weight-bold"><?php
   print $boss->app->App;
  ?></span>
</a>
<!-- Sidebar -->
<div class="sidebar">
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="<?php
         print $_SESSION['Login']->Picture; 
      ?>" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <a href="#" class="d-block"><?php
        print $_SESSION['Login']->FirstName . ' ' . $_SESSION['Login']->LastName;
      ?></a>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
<?php
   $boss->addModule();

   $modules = $boss->boss->Modules;
   $boss->addResource("Process");
   $first = 1;
   foreach ($modules as $idx=>$mod) {
   
      if (($_SESSION['Login']->ModulePref && ($_SESSION['Login']->ModulePref & $mod->Access)) || (!$_SESSION['Login']->ModulePref)) {
         $acc = ($_SESSION['Login']->ProcessPref) ? " & ".$_SESSION['Login']->ProcessPref : "";
         $arr = $boss->db->Process->getlist("ModuleID='".$mod->ModuleID."' AND ParentID=0 AND (Access & ".$_SESSION['ProcessAccess'].$acc.") order by Sequence");
         $modules[$idx]->Processes = $arr;

         $target = ($mod->Target) ? " target='".$mod->Target."'" : "";
         $ico = ($mod->Icon) ? "<i class='nav-icon " . $mod->Icon ."'></i>  &nbsp; " : "";
         if ($mod->ClassName) {
            //$ico .= "<i class='simpleIcon {$mod->ClassName}'></i>";
         }
         if (!$first) {
            $first = 1;
            $xtra = " menu-open";
            $xtra2 = " active";
         } else {
            $xtra = "";
            $xtra2 = "";
         }
         print '<li class="nav-item has-treeview'.$xtra.'"><a href="/apps/module.php?mid=' . $mod->ModuleID . '" class="nav-link'.$xtra2.'">'.$ico.' <p> ' . $mod->Module . ' </p></a>';

         print "\t<ul id='mid_" . $mod->ModuleID . "' class='nav nav-treeview' >\n";
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
               
               if (!$proc->URL) { 
                  $proc->URL = "/grid/?pid=" . $proc->ProcessID;
               }
               print "\t\t<li class='nav-item' id='pid_" . $proc->ProcessID . "'>";
               // <a rel='$rel'$target data-module='{$proc->ModuleID}' title='" . $proc->Process . "' href='" . $url . "'$js class='nav-link " . $proc->ClassName . "'>";
               if ($proc->Icon) {
                  if (preg_match("/\.(png|jpg|gif|ico|bmp|svg)$/", $proc->Icon)) {
                     $icon = (file_exists($_SERVER['DOCUMENT_ROOT'].$boss->app->Assets.$proc->Icon)) ? $boss->app->Assets.$proc->Icon : $proc->Icon;
                     if (!file_exists($_SERVER['DOCUMENT_ROOT'].$icon)) {
                        print "<a href='{$proc->URL}'{$target} class='nav-link'> <span class='simpleIcon icon-".$proc->Icon."'> ";
                     } else {
                        print "<a href='{$proc->URL}'{$target} class='nav-link'><img src='{$icon}' border='0'> <span class='simpleIcon icon-".$proc->Icon."'> ";
                     }
                  } else {
                     print "<a href='{$proc->URL}'{$target} class='nav-link'> <span class='simpleIcon icon-".$proc->Icon."'> ";
                  }
               } else {
                  print "<a href='{$proc->URL}'{$target} class='nav-link'> <span class='simpleIcon icon-".$proc->Icon."'> ";
               }
               print "</span>".$proc->Process."</a>";
               
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
         print "</ul></li>\n";
      }
   }
?>
   <li class="nav-item"><a href="/login.php?logout=1" class="nav-link"><i class="fa-solid fa-arrow-right-from-bracket"></i><p>Logout</p></a></li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
