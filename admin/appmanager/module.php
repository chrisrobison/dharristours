<?php
 if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
   $obj = $boss->db;
   $in = $_POST + $_GET;
   $in['tab'] = (!$in['tab']) ? 'Modules' : $in['tab'];
   $in['rsc'] = 'Module';

   $in['rsc'] = (!$in['rsc']) ? 'Module' : $in['rsc'];
   if ($in['x']) {
      if ($in['rsc']) {
         $obj->addResource($in['rsc']);
         $data =& $obj->{$in['rsc']};

         switch ($in['x']) {
            case 'new':
               $in['x'] = 'add';
               break;
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
            case 'delete'.$in['rsc']:
               if ($in[$in['rsc'].'ID']) {
                  $data->remove($in[$in['rsc'].'ID']);
               
                  $js .= "alert('Successfully removed record ID ".$in[$in['rsc'].'ID']." from the ".$in['rsc']." table.');\n";
                  $js .= "parent.doRefresh('".$in['rsc']."');\n";
               
               }
               break;
            case 'lookup':
               $data->get($in[$in['rsc'].'ID'], $in['rsc'].'ID');

               break;
         }
      }
   }

   $obj->addResource('Module');
   $obj->Module->getlist();
   if ($in['x']!='add') $current = $boss->getObject('Module', $in['ModuleID']);

   function genTableSelect($tbl) {
      global $obj;

      $tmptbls = $obj->dbobj->list_tables($boss->app->DB);
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

?>
<!DOCTYPE html>
<html>
   <head>
      <title><?php print $in['rsc']; ?> Form</title>
      <script language="JavaScript" type='text/javascript' src='/lib/js/cookies.js'>  </script>
      <script language="JavaScript" type='text/javascript'>
         var tblmap = new Object();
         tblmap['Modules'] = 'Module';
         tblmap['Processes'] = 'Process';
         // tblmap['ProcessResources'] = 'ProcessResource';
         
         function $$(who) {
            return document.getElementById(who);
         }

         function updateFields(who) {
            // $$('Template').value = "";
            var proc = $$('Process') || $$('Module');
            if (proc && proc.value=='') { proc.value = who; }
            var btn = $$('Buttons').value;
            btn = '15';
            var acc = $$('Access').value;
            acc = '15';
         }

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
      <link href="/lib/css/Aristo/jquery-ui-1.8.5.custom.css" type="text/css" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="/lib/css/icons48.css" />
      <link rel="stylesheet" type="text/css" href="/lib/css/icons24.css" />
      <link rel="stylesheet" type="text/css" href="/lib/css/core.css" />
      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
      <script>
      // increase the default animation speed to exaggerate the effect
      $.fx.speeds._default = 1000;
      $(function($) {
         $("#advOpen").click(function() {
            eraseCookie("AdvancedModule");
            $(this).hide();
            $("#advClosed").show();
            $("#advancedWrap").hide('fast');
         });
         $("#advClosed").click(function() {
            setCookie("AdvancedModule", true, 1);
            $(this).hide();
            $("#advOpen").show();
            $("#advancedWrap").show('fast');
         });
         $("#opener").click(function(e) {
            parent.$("#smallDialog").dialog("open");
            e.stopPropagation();
            e.preventDefault();
            return false;
         });
});
      </script>
      <style>
         #dialog {
            width:300px;
            height:250px;
            overflow:auto;
         }
         #advanced {
            margin-left: 2.2em;
         }
         #advOpen, #advClosed {
            pointer:default;
         }
         .footer {
            position:fixed;
         }
         #opener {
            clear:left;
         }
         #iconPreview {
            float:right;
            position:relative;
            top:1em;
         }
          input.data {
            width: 15em;
         }
         .simpleButton {
             -moz-border-radius: 2em 2em 2em 2em;
             background: -moz-linear-gradient(center top , #D0D0D0 0%, #FFFFFF 50%, #E0E0E0 51%, #A0A0A0 100%) repeat scroll 0 0 transparent;
             border-color: #EEEEFF #999999 #999999 #EEEEFF;
             border-style: solid;
             border-width: 1px;
             color: #000000;
             cursor: default;
             display: inline-block;
             float: left;
             height: 1.7em;
             margin: 4px 2px 0;
             outline: medium none;
             padding: 1px 0.6em 3px;
             text-decoration: none;
             font-size:14px;
             font-family: "Helvetica Neue",Optima,'Gill Sans','Gill Sans MT',Verdana,Arial,Helvetica,sans-serif;
         }
      </style>
   </head>
   <body onload="document.getElementById('<?php print $in['rsc']; ?>').focus()">
      <div class='heading'><?php print $in['rsc']; ?> Editor</div>
         <div id="mainWrap">
            <form name='mainform' id='mainform' action='module.php' method='post'>
               <input type='hidden' name='x' value='<?php print $in['x']; ?>' />
               <input type='hidden' name='rsc' value='Module' />
               <div id='recordForm'><input type='hidden' name='ModuleID' value='<?php print $in['ModuleID']; ?>'>
               
               <div id='iconPreview'><span style='margin-right:1em;border:2px ridge #bbb;box-shadow:1px 1px 3px rgba(0,0,0,.4)' id="iconSpan" class="<?php if (!preg_match("/\.(png|jpg|gif|svg|bmp|ico)/", $current->ClassName)) print "smallIcon small-".$current->ClassName; ?>"><?php if (preg_match("/\.(png|jpg|gif|svg|bmp|ico)/", $current->ClassName)) { ?><img src="<?php print $boss->app->Assets.$current->ClassName; ?>" width='24' height='24' border="0"><?php } ?></span></div>
               
               <div class='formrow'><span class="label">Module</span><input type='text' dbtype='varchar(15)' name='Module' id='Module' value='<?php print $current->Module; ?>' size='15' class='data' /></div>
               <div class='formrow'><span class="label">Icon</span><input type='text' dbtype='varchar(50)' name='ClassName' id='ClassName' value='<?php print $current->ClassName; ?>' size='15' class='data' /><button id="opener">Icons</button></div>

               <div id='advanced'><span id='advClosed' style="<?php if ($_COOKIE['AdvancedModule']) print "display:none"; ?>">&#x25BA;</span><span id='advOpen' style="<?php if (!$_COOKIE['AdvancedModule']) print "display:none"; ?>">&#x25BC;</span> Advanced</div>
               <div id='advancedWrap' style="<?php if (!$_COOKIE['AdvancedModule']) print "display:none"; ?>">
                  <div class='formrow'><span class="label">Resource</span><select name='Resource' id='Resource' onchange='updateFields(this.options[this.selectedIndex].value)' class='dataList'>
                     <option value=''>--Select One--</option>
                     <?php
                        print genTableSelect($current->Resource);
                     ?>
                     </select>
                  </div>
                  <div class='formrow'><span class="label">Module ID</span><input type='text' size='10' name='ModuleID' id='ModuleID' value='<?php print $current->ModuleID; ?>' disabled="disabled" class='data' /></div>
                  <div class='formrow'><span class="label">URL</span><input type='text' dbtype='varchar(200)' name='URL' id='URL' value='<?php print $current->URL; ?>' size='25' class='data' /></div>
                  <div class='formrow'><span class="label">Template</span><input type='text' dbtype='varchar(100)' name='Template' id='Template' value='<?php print $current->Template; ?>' size='25' class='data' /></div>
                  <div class='formrow'><span class="label">Form</span><input type='text' dbtype='varchar(100)' name='Form' id='Form' value='<?php print $current->Form; ?>' size='25' class='data' /></div>
                  <div class='formrow'><span class="label">Help</span><input type='text' dbtype='varchar(100)' name='Help' id='Help' value='<?php print $current->Help; ?>' size='25' class='data' /></div>

                  <div class='formrow'><span class="label">Target</span><input type='text' dbtype='varchar(50)' name='Target' id='Target' value='<?php print $current->Target; ?>' size='25' class='data' /></div>
                  <div class='formrow'><span class="label">JS</span><input type='text' dbtype='varchar(200)' name='JS' id='JS' value='<?php print $current->JS; ?>' size='25' class='data' /></div>
                  <div class='formrow'><span class="label">Submit Handler</span><input type='text' dbtype='varchar(100)' name='SubmitHandler' id='SubmitHandler' value='<?php print $current->SubmitHandler; ?>' size='25' class='data' /></div>
                  <div class='formrow'><span class="label">Overview Query</span><input type='text' dbtype='varchar(200)' name='OverviewQuery' id='OverviewQuery' value='<?php print $current->OverviewQuery; ?>' size='25' class='data' /></div>
                  <div class='formrow'><span class="label">Overview Function</span><input type='text' dbtype='varchar(200)' name='OverviewFunction' id='OverviewFunction' value='<?php print $current->OverviewFunction; ?>' size='25' class='data' /></div>
                  <!--
                  <div class='formrow'><span class="label">Pre Condition</span><input type='text' dbtype='varchar(75)' name='PreCondition' id='PreCondition' value='<?php print $current->PreCondition; ?>' size='25' class='data' /></div>
                  <div class='formrow'><span class="label">Pre Action</span><input type='text' dbtype='varchar(75)' name='PreAction' id='PreAction' value='<?php print $current->PreAction; ?>' size='25' class='data' /></div>
                  <div class='formrow'><span class="label">Pre Fail</span><input type='text' dbtype='varchar(75)' name='PreFail' id='PreFail' value='<?php print $current->PreFail; ?>' size='25' class='data' /></div>
                  <div class='formrow'><span class="label">Post Condition</span><input type='text' dbtype='varchar(75)' name='PostCondition' id='PostCondition' value='<?php print $current->PostCondition; ?>' size='25' class='data' /></div>

                  <div class='formrow'><span class="label">Post Action</span><input type='text' dbtype='varchar(75)' name='PostAction' id='PostAction' value='<?php print $current->PostAction; ?>' size='25' class='data' /></div>
                  <div class='formrow'><span class="label">Post Fail</span><input type='text' dbtype='varchar(75)' name='PostFail' id='PostFail' value='<?php print $current->PostFail; ?>' size='25' class='data' /></div>
                  -->
                  <div class='formrow'><span class="label">Access</span><input type='text' dbtype='int(10) unsigned' name='Access' id='Access' value='<?php print $current->Access; ?>' size='10' class='data' /></div>
                  <div class='formrow'><span class="label">Buttons</span><input type='text' dbtype='int(11)' name='Buttons' id='Buttons' value='<?php print $current->Buttons; ?>' size='11' class='data' /></div>
                  <div class='formrow'><span class="label">Sequence</span><input type='text' dbtype='int(3)' name='Sequence' id='Sequence' value='<?php print $current->Sequence; ?>' size='3' class='data' /></div>
               </div>
         </form>
      </div>
   </div>
      <div class='footer'>
         <form name='localButtons' id='localButtons' onsubmit='return false'>
            <!-- 
            <input type='button' class='btn' value='New Module' onclick='addModule()'>
            <input type='button' class='btn' value='New Process' onclick='addProcess()'>
            <input type='button' class='btn' value='New ProcessResource' onclick='addProcessResource()'>
            <input type='button' class='footerButton' value='New <?php print $in['rsc']; ?>' onclick="parent.doNew('<?php print $in['rsc']; ?>')" />
            <input type='button' class='simpleButton' value='Delete' onclick='deleteRecord()' />
            -->
            <input type='button' class='simpleButton' value='Save' onclick='saveRecord()' />

         </form>
      </div>
      <div id='debug'>

      </div>
   </body>
</html>
