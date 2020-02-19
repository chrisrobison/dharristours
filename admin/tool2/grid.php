<?php
   include_once($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');

   if ($_REQUEST['pid'] || $_REQUEST['ProcessID']) {
      $in['pid'] = ($_REQUEST['pid'])?$_REQUEST['pid']:$_REQUEST['ProcessID'];
      if ($in['pid']) {
         $process = $boss->getObject("Process", $in['pid']);
         if (!$in['rsc']) $in['rsc'] = $process->Resource;
      }
   }
   
   $rsc = $in['rsc'] = $in['rsc'] ? $in['rsc'] : 'App';
  
   $sys = new obj('SS_System', 'pimp', 'pimpin', 'localhost');
   $sys->addResource($rsc);
   $defs = $sys->{$rsc}->execute("desc `".mysql_real_escape_string($rsc)."`");

   $excl = preg_split("/\,\s*/", $in['no']);
   if ($in['only']) $only = preg_split("/\,\s*/", $in['only']);
   
   $fields = array();
   while ($row = mysql_fetch_object($defs)) {
      $obj = new stdClass;
      foreach ($row as $key=>$val) {
         $obj->{$key} = $val;
      }
      $obj->Length = preg_replace("/\w*\((.*)\)/", "$1", $obj->Type);
      $obj->Type = preg_replace("/\(.*\)/", "", $obj->Type);

      $fields[$obj->Field] = $obj;
   }

   if ($process->OverviewQuery) {
      $dbq = $sys->{$rsc}->execute($process->OverviewQuery." limit 1");
      $results[] = mysql_fetch_object($dbq);
   } else {
      $sys->{$rsc}->getlist("1=1 limit 1");
      $results = $sys->$rsc->$rsc;
   }
   
   $model = array(
                  $rsc."ID"=>array("hidden"=>false, "editable"=>false),
                  "Passwd"=>array("hidden"=>true, "editable"=>false),
                  "DBUser"=>array("hidden"=>true, "editable"=>false),
                  "DBPwd"=>array("hidden"=>true, "editable"=>false),
                  "Notes"=>array("hidden"=>true, "editable"=>false),
                  "CSS"=>array("hidden"=>true, "editable"=>false),
                  "Logo"=>array("hidden"=>true, "editable"=>false),
                  "AnimatedLogo"=>array("hidden"=>true, "editable"=>false),
                  "ClientID"=>array("hidden"=>true, "editable"=>false),
                  "LoginCount"=>array("hidden"=>true, "editable"=>false),
                  "DBHost"=>array("hidden"=>true, "editable"=>false),
                  "Phone"=>array("hidden"=>true, "editable"=>false),
                  "Created"=>array("hidden"=>true, "editable"=>false),
                  "Active"=>array("hidden"=>true, "editable"=>false),
                  "SourceIP"=>array("hidden"=>true, "editable"=>false),

                  "LastModified"=>array("hidden"=>true, "editable"=>false)
               );

   $grid = new stdClass;
   $colnames = array();
   $colmodel = array();
   $cnt = 0;
   foreach ($results[0] as $key=>$val) {
      $colnames[] = preg_replace("/([a-z])([A-Z])/", "$1 $2", $key);
      $field = new stdClass;
      $field->name = $key;
      $field->index = $key;
      $field->editable = ($model[$key]["editable"]===false) ? $model[$key]["editable"] : true;
      $field->sortable = true;

      if ($model[$key]["hidden"] || in_array($key, $excl)) {
         $field->hidden = true;
      }
      if ($in['only'] && !in_array($key, $only)) {
         $field->hidden = true;
      }
      if ($fields[$key]->Type=="tinyint") {
         $field->edittype = "checkbox";
         $field->editoptions->value = "true:false";
      } else if ($fields[$key]->Type=="text") {
         $field->edittype = "textarea";
         $field->editoptions->rows = "4";
         $field->editoptions->cols = "30";
      } else if ($fields[$key]->Type=="int") {
         $field->editrules->integer = true;
         $field->align = 'right';
         $field->width = 10;
         $field->formatter = 'integer';
         $field->formatoptions->thousandsSeparator = '';
      } else if ($fields[$key]->Type=="date") {
         $field->editrules->date = true;
      } else if ($fields[$key]->Type=="time") {
         $field->editrules->time = true;
      } else {
         $field->editoptions->size = 30;
         $field->editoptions->maxlength = $fields[$key]->Length;
      }
      $colmodel[] = $field;
   }
   $gurl = "ctl.php?rsc=".$rsc;
   $gurl .= $in['pid'] ? '&pid='.$in['pid'] : '';
   $gurl .= $in['id'] ? '&id='.$in['id'] : '';

   $grid->url = $gurl;
   $grid->datatype = "json";
   $grid->colNames = $colnames;
   $grid->colModel = $colmodel;
   $grid->rowNum = 100;
   $grid->mtype = "GET";
   $grid->rowList = array(50,100,250,500,1000);
   $grid->autowidth = true;
   $grid->pager = '#pagernav';
   $grid->sortname = $rsc;
   $grid->viewrecords = true;
   $grid->gridview = true;
   $grid->sortorder = "asc";
   $grid->jsonReader->repeatitems = false;
   $grid->jsonReader->id = "0"; 
   $grid->caption = $process->Process;
   $grid->editurl = "ctl.php?x=edit&rsc=".$rsc."&";
   $grid->height = $in['h'] ? $in['h'] : 200;
   if ($config->scroll || $in['scroll']) $grid->scroll = true;

   $json = json_encode($grid);

   function showForm($boss, $process) {
      if (!$process || !is_string($process->Process)) {
         $pform = ($_REQUEST['form']) ? $_REQUEST['form'] : 'templates/'.preg_replace("/\W/", '', $_REQUEST['rsc']).'.php';;
         $rsc = $_REQUEST['rsc'];
      } else {
         $pform = ($process->Form) ? $process->Form : 'templates/' .  preg_replace("/\W/", '', $process->Process) .  '.php';
         $rsc = $process->Resource;
      }
      $pform = $boss->getPath($pform);
      if (($_REQUEST['dynamic']!=1) && $pform && file_exists($pform) && !is_dir($pform) && (!$_REQUEST['genform'])) {
         include($pform); 
      } else {
         $template = $boss->buildForm($rsc, $current, 1);
         if (is_writable(dirname($pform)) && !$in['dynamic']) {
            $fh = fopen($pform, 'w');
            if (!fwrite($fh, $template)) print "<h1>Error writing to file templates/$file</h1>";
            fclose($fh);
            include($pform);
         } else {  
            $curform = $boss->buildForm($rsc, $current);
            print eval("?>".$curform);
         
            $upd = array('ProcessID'=>$in['ProcessID'], 'Form'=>$form);
            $boss->db->addResource('Process');
            $boss->db->Process->update($in['ProcessID'], $upd);
         }
      }
   }
?>

