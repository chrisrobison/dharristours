<?php
   require_once("../../lib/boss_class.php");
   $boss = new boss(); 
   $obj = $boss->db;
   $in =& $_REQUEST;
   $in['tab'] = (!$in['tab']) ? 'Modules' : $in['tab'];

   if ($in['x']) {
      if ($in['rsc']) {
         $obj->addResource($in['rsc']);
         $data =& $obj->{$in['rsc']};

         switch ($in['x']) {
            case 'add':
               $in['Created'] = $in['LastModified'] = 'now()';
               $newid = $in[$in['rsc'].'ID'] = $data->add($in);
               $data->get($in[$in['rsc'].'ID'], $in['rsc'].'ID');
               
               $js .= "parent.doRefresh('".$in['rsc']."');\n";
               
               break;
            case 'update':
               $in['LastModified'] = 'now()';
               $data->update($in[$in['rsc'].'ID'], $in);
               $data->get($in[$in['rsc'].'ID'], $in['rsc'].'ID');
               
               //$js .= "alert('Successfully updated record ID ".$in[$in['rsc'].'ID']." in the ".$in['rsc']." table.');\n";

               break;
            case 'delete':
               if ($in[$in['rsc'].'ID']) {
                  $data->remove($in[$in['rsc'].'ID']);
               
                  // $js .= "alert('Successfully removed record ID ".$in[$in['rsc'].'ID']." from the ".$in['rsc']." table.');\n";
                  $js .= "parent.doRefresh('".$in['rsc']."');\n";
               
               }
               break;
            case 'lookup':
               $data->get($in[$in['rsc'].'ID'], $in['rsc'].'ID');

               break;
         }
      }
   }
   $in['rsc'] = (!$in['rsc']) ? 'Module' : $in['rsc'];

   $obj->addResource('Module');
   $obj->Module->getlist();
   $form = genForm($obj, $in['rsc'], $in[$in['rsc'].'ID']);
   
   function genTableSelect($tbl) {
      global $obj;

      $tmptbls = $obj->dbobj->list_tables('pd');
      $tables = '';

      foreach ($obj->dbobj->tables as $idx=>$table) {
         $s = ($tbl==$table) ? ' SELECTED' : '';
         $tables .= "<option value='".$table."'$s>".$table."</option>\n";
      }
      return $tables;
   }
   
   function genSelect($data, $name, $key, $val, $id='') {
      $opts = '';
      $pkey = $name.'ID';
      foreach ($data as $idx=>$rec) {
         if ($rec->$pkey == $id) {
            $s = ' SELECTED';
         } else { 
            $s = '';
         }

         $opts .= "<option value='".$rec->$key."'$s>".$rec->$val."</option>\n";
      }
      return $opts;
   }

   function genForm(&$obj, $table) {
      global $in;
      $obj->addResource($table);
      
      $cond = '';
      
      if ($in[$table.'ID']) {
         $tmpconf = $cond;
         if ($tmpcond) $tmpcond .= " AND ";
         $tmpcond .= $table.'ID='.$in[$table.'ID']; 
         $obj->$table->get($in[$table.'ID'], $table.'ID', $tmpcond);
         $current = $obj->$table->{$table}[0];
      }

      $obj->$table->getlist($cond);
      $opts = genSelect($obj->$table->$table, $table, $table.'ID', $table, $in[$table.'ID']);
      $obj->dbobj->fetch_fields($table);
      
      $fields = $obj->dbobj->fields;
      $fcnt = count($fields);
      $tab = $in['tab'];
      $x = ($in['x'] == 'new') ? 'add' : 'update';
      $form = <<<EOT
<form name='mainform' id='mainform' action='edit.php' method='post'>
<input type='hidden' name='x' value='$x' />
<input type='hidden' name='tab' value='$tab' />
<input type='hidden' name='rsc' value='$table' />
<div id='recordForm'>
EOT;
      for ($f=0; $f<$fcnt; $f++) {
         if (!preg_match("/Created|LastModified|ModuleID|ProcessID|ProcessResourceID|Resource/", $fields[$f]->Field)) {
            if (preg_match("/(\w+)\((\d+)\)/", $fields[$f]->Type, $matches)) {
               $type = strtolower($matches[1]);
               $size = $matches[2];
               $showsize = ($size < 25) ? $size : 25;
               
               if ($type == 'tinyint') {
                  $form .= "<div class='formrow'><span class='chkbox'><input type='checkbox' name='".$fields[$f]->Field."' id='".$fields[$f]->Field."' class='check' value='1'".(($current->{$fields[$f]->Field}==1) ? 'CHECKED' : '')." /> ".$fields[$f]->Field."</span></div>\n";
               } else {
                  $form .= "<div class='formrow'><span class='label'>".$fields[$f]->Field."</span><input type='text' size='$showsize' name='".$fields[$f]->Field."' id='".$fields[$f]->Field."' value='".$current->{$fields[$f]->Field}."' class='data' /></div><br />\n";
               }
            } elseif ($fields[$f]->Type == 'text') {
               $showsize = 28;
               $form .= "<div class='formrow'><span class='label'>".$fields[$f]->Field."</span><textarea rows='3' cols='".($showsize - 1)."' name='".$fields[$f]->Field."' id='".$fields[$f]->Field."' class='data'>".$current->{$fields[$f]->Field}."</textarea></div><br />\n";
            }
         } elseif (preg_match("/ModuleID|ProcessID|ProcessResourceID/", $fields[$f]->Field)) {
            $form .= "<input type='hidden' name='".$fields[$f]->Field."' value='".(($in[$fields[$f]->Field]) ? $in[$fields[$f]->Field] : $current->{$fields[$f]->Field})."'>\n";
         } elseif ($fields[$f]->Field == 'Resource') {
            $form .= "<div class='formrow'><span class='label'>".$fields[$f]->Field."</span><select name='".$fields[$f]->Field."' id='".$fields[$f]->Field."' class='dataList'>".genTableSelect($current->{$fields[$f]->Field})."</select></div>\n";

         }
      }
      $form .= "</div></form>\n";
      return $form;
   }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<html>
   <head>
      <title><?php print $in['rsc']; ?> Form</title>
      <script language="JavaScript" type='text/javascript' src='default.js'>  </script>
      <script language="JavaScript" type='text/javascript'>
         var tblmap = new Object();
         tblmap['Modules'] = 'Module';
         tblmap['Processes'] = 'Process';
         tblmap['ProcessResources'] = 'ProcessResource';

         function saveRecord() {
            var frm = document.mainform;

            if (frm) {
               if (frm.x.value != 'add') frm.x.value = 'update';
               setTimeout("document.mainform.submit()", 150);
            }
         }

         function newRecord() {
            var frm = document.mainform;
            
            if (frm) {
               frm.x.value = 'new';
               
               for (var i in frm) {
                  if ((frm[i]) && (frm[i].type == 'TEXT')) {
                     frm[i].value = '';
                  }
               }
            }
            var rsc = frm.rsc.value;
            frm[rsc].focus();
         }

         function updateRecord() {
            var frm = document.mainform;

            if (frm) {
               frm.x.value = 'save';
               setTimeout('document.mainform.submit()', 150);
            }
         }
         <?php print $js; ?>
      </script>
      <link rel='stylesheet' type='text/css' href='finder.css' />
   </head>
   <body onload="document.getElementById('<?php print $in['rsc']; ?>').focus()">
      <div class='heading'><?php print $in['rsc']; ?> Editor</div>
      <div id='formWrap'>
         <?php print $form; ?>
      </div>
      <div class='footer'>
         <form name='localButtons' id='localButtons' onsubmit='return false'>
            <!-- 
            <input type='button' class='btn' value='New Module' onclick='addModule()'>
            <input type='button' class='btn' value='New Process' onclick='addProcess()'>
            <input type='button' class='btn' value='New ProcessResource' onclick='addProcessResource()'>
            <input type='button' class='footerButton' value='New <?php print $in['rsc']; ?>' onclick="parent.doNew('<?php print $in['rsc']; ?>')" />
            <input type='button' class='footerButton' value='Delete <?php print $in['rsc']; ?>' onclick='deleteRecord()' />
            -->
            <input type='button' class='footerButton' value='Save <?php print $in['rsc']; ?>' onclick='saveRecord()' />

         </form>
      </div>
      <div id='debug'>

      </div>
   </body>
</html>
