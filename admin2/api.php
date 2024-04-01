<?php  
    if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php"); 
    $boss->addModule();

    $modules = $boss->boss->Modules;
    $boss->addResource("Process");
    $first = 1;
    $out = array("sidemenu"=>array());

    foreach ($modules as $idx=>$mod) {
    
        if (($_SESSION['Login']->ModulePref && ($_SESSION['Login']->ModulePref & $mod->Access)) || (!$_SESSION['Login']->ModulePref)) {
            $navitem = array();
            $acc = ($_SESSION['Login']->ProcessPref) ? " & ".$_SESSION['Login']->ProcessPref : "";
            $arr = $boss->db->Process->getlist("ModuleID='".$mod->ModuleID."' AND ParentID=0 AND (Access & ".$_SESSION['ProcessAccess'].$acc.") order by Sequence");
            $modules[$idx]->Processes = $arr;

            $navitem['link'] = "/apps/module.php?mid={$mod->ModuleID}";
            $navitem['title'] = $mod->Module;
            if ($mod->Target) $navitem['target'] = $mod->Target;
            $navitem['icon'] = $mod->Icon;

            // Now iterate through this module's processes
            if (count($arr)) {
                $navitem['_children'] = array();
                foreach ($arr as $pidx=>$proc) {
                    $navchild = array();

                    $url = ($proc->URL) ? $proc->URL : "/grid/?pid=".$proc->ProcessID;
                    
                    $navchild['title'] = $proc->Process;
                    $navchild['link'] = $url;
                    $navchild['icon'] = ($proc->Icon) ? 'simpleIcon simpleIconWhite icon-' . $proc->Icon : "far fa-circle nav-icon";
                    $navchild['ProcessID'] = $proc->ProcessID;

                    // Check for process children and output accordingly
                    $childs = $boss->db->Process->getlist("ParentID!=0 AND ParentID=" . $proc->ProcessID);
                    if (count($childs)) {
                        $navchild['_children'] = array();
                        foreach ($childs as $child) {
                            $url = ($child->URL) ? $child->URL : "/grid/?pid=".$child->ProcessID;
                            $cname = $child->ClassName ? $child->ClassName : "childnav";
                            
                            $navchildchild = array();
                            $navchildchild['title'] = $child->Process;
                            $navchildchild['link'] = $url;
                            $navchildchild['icon'] = $child->Icon ? 'simpleIcon simpleIconWhite icon-' . $child->Icon : 'far fa-circle nav-icon';
                            $navchildchild['ProcessID'] = $child->ProcessID;
                            $navchildchild['ParentID'] = $child->ParentID;

                            $navchild['_children'][] = $navchildchild;
                        }

                    }
                    $navitem['_children'][] = $navchild;   
                }

            }
            $out['sidemenu'][] = $navitem;
        }
    }

    header("Content-Type: application/javascript");
    print json_encode($out);
?>
