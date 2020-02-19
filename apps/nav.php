<?php
   if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");

   $nav = $boss->utility->buildNav($boss, 0);
   $navItems = array();
   foreach ($nav as $navItem=>$navFields) {
      if (!preg_match("/_children/", $navItem)) {
         $navItems[] = $navItem;
      }
   }
   foreach ($navItems as $navItem) {
      print "<div dojoType=\"dijit.layout.ContentPane\" title=\"$navItem\"><ul class='nav'>";
      
      if ($nav->{$navItem."_children"}) {
         foreach ($nav->{$navItem."_children"} as $navChild=>$navKey) {
            print "<li><a rel='nav' title='".$navKey->Nav."' href='".$navKey->URL."' class='".$navKey->ClassName."'><img src='".$navKey->Icon."' class='navIcon' border='0' />".$navKey->Nav."</a></li>";
         }
      }
      print "</ul></div>";
    }
 ?>
