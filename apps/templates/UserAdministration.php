<style>
   .tree { list-style-type: none; padding:1em; margin:0px;}
   .module-children { padding: .25em 2.25em; list-style-type: none; }
   .children { margin-left:1em; }
</style>
<script language='Javascript' type='text/javascript' src='/lib/js/sha1.js'> </script>
<script language='Javascript' type='text/javascript' src='/lib/js/default.js'> </script>
<?php 
   if (!$boss) $boss = new boss();
   $boss->db->addResource('Module');
   $boss->db->Module->getlist('Access>0 order by Sequence');
   
   $nav =& $boss->db->Module->Module;
   $jsobj = array();

   for ($n=0; $n<count($nav); $n++) {
      $jsobj[$nav[$n]->Module] = $nav[$n];
      $jsobj[$nav[$n]->Module]->_children = array();

      $boss->db->addResource('Process');
      $boss->db->Process->getlist("Access>0 && ModuleID=".$nav[$n]->ModuleID.' order by Sequence');

      foreach ($boss->db->Process->Process as $proc) {
         $jsobj[$nav[$n]->Module]->_children[] = $proc;
      }
   }

   $jsout = 'var sitetree = ' . json_encode($jsobj) . ";\n";

   $user = $boss->getObject('Login', $in['ID']);
   $jsuser = 'var user = ' . json_encode($user) . ";\n";
?>
<script language='Javascript' type='text/javascript'>
   <?php
      print $jsout;
      print $jsuser; 
   ?>
function buildModuleTree(root, data, user) { return buildAccessTree('#' + root, data, user); doSelect(simpleConfig.id); }
function buildAccessTree(root, data, user) {
   var root = $(root), out = '<ul class="tree">', me, modbox, procbox, checked; 
   
   for (var i in data) {
      if (data.hasOwnProperty(i)) {
         me = data[i];
         checked = (parseInt(me.Access) & parseInt(user.Access)) ? " checked='checked'" : "";
         modbox = "<input type='checkbox' id='Mod" + me.ModuleID + "' rel='mod" + me.Access + "'" + checked + " class='modbox' onclick='upMod(this)'>";
         out += "<li id='Module" + me.ModuleID + "' class='module' rel='" + me.Access + "'><span class='toggler branch_closed'></span>" + modbox + i;
         if (me._children) {
            out += "<ul id='Module" + me.ModuleID + "_children' class='module-children' style='display:none'>";
            for (var j in me._children) {
               pr = me._children[j];
               checked = (parseInt(pr.Access) & parseInt(user.ProcessAccess)) ? " checked='checked'" : "";
               procbox = "<input type='checkbox' id='Proc" + pr.ProcessID + "' rel='proc" + pr.Access + "'" + checked + " class='procbox' onclick='upProc(this)'>";
               out += "<li id='Process" + pr.ProcessID + "' rel='" + pr.Access + "'>" + procbox + pr.Process + "</li>";
            }
            out += "</ul>";
         }
         out += "</li>";
      }
   }
   out += "</ul>";

   root.html(out);
}

function upProc(who) {
   var access = 0,
       checked = $(who).is(":checked"),
       bit = parseInt($(who).attr("rel").replace(/^proc/, ''));
   
   $("input[rel='proc" + bit + "']").attr("checked", checked);

   // loop through each module, adding each elements 'rel' value to access only if NOT BITWISE AND
   $(".procbox").each(function() {
      checked = $(this).is(":checked");
      bit = parseInt($(this).attr("rel").replace(/^proc/, ''));

      if (checked) {
         if (!(access & bit)) {
            console.log("Process "+$(this).attr('id')+" checkbox CHECKED with unflagged bit.  Setting bit: "+bit+ ".  Access now at "+(access+bit));
            access = access + bit;
         } else {
            console.log("Process "+$(this).attr('id')+" checkbox CHECKED with already flagged bit: "+bit+ ".  Access remains at "+(access));
         }
      } else {
         if ((access & bit)) {
            console.log("Process "+$(this).attr('id')+" checkbox *UNCHECKED* with flagged bit.  Unsetting bit: "+bit+ ".  Access now at "+(access-bit));
            access = access - bit;
         } else {
            console.log("Process "+$(this).attr('id')+" checkbox *UNCHECKED* with already unflagged bit: "+bit+ ".  Access remains at "+(access));
         }
      }
   });

   $("#ProcessAccess").val(access);
   doModify($("#ProcessAccess"));
   return access;
}

function upMod(who) {
   var access = 0,
       checked = $(who).is(":checked"),
       bit = parseInt($(who).attr("rel").replace(/^mod/, ''));
   $("input[rel='mod"+bit+"']").attr("checked", checked);

   // loop through each module, adding each elements 'rel' value to access only if NOT BITWISE AND
   $(".modbox").each(function() {
      checked = $(this).is(":checked");
      bit = parseInt($(this).attr("rel").replace(/^mod/, ''));

      if (checked) {
         if (!(access & bit)) {
            console.log("Module "+$(this).attr('id')+" checkbox CHECKED with unflagged bit.  Setting bit: "+bit+ ".  Access now at "+(access+bit));
            access = access + bit;
         } else {
            console.log("Module "+$(this).attr('id')+" checkbox CHECKED with already flagged bit: "+bit+ ".  Access remains at "+(access));
         }
      } else {
         if ((access & bit)) {
            console.log("Module "+$(this).attr('id')+" checkbox *UNCHECKED* with flagged bit.  Unsetting bit: "+bit+ ".  Access now at "+(access-bit));
            access = access - bit;
         } else {
            console.log("Module "+$(this).attr('id')+" checkbox *UNCHECKED* with already unflagged bit: "+bit+ ".  Access remains at "+(access));
         }
      }
   });

   $("#Access").val(access);
   doModify($("#Access"));

   return access;
}
   $(function() { 
     $("#tree").on("click", ".toggler", function(e) {
         $(this).toggleClass("branch_open").toggleClass("branch_closed");
         var who = $(this).parent().attr('id'),
             children = $("#"+who+"_children");
         if (children.length) {
            children.toggle();
         }
     });
     $("#LastName").change(function() { 
         var login = $("#Login"), fname = $("#FirstName"), lname = $("#LastName");
         if (login.val() == "") {
            login.val(fname.val().toLowerCase() + '.' + lname.val().toLowerCase());
         }
     });
     
   });
</script>
<div class='formHeading'> Login ID: <span id='mainID'><?php print $current->LoginID; ?></span></div>
<div class='tableGroup' style='width:500px;position:relative;float:left;'>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>First Name</span><input type='text' name='Login[<?php print $current->LoginID; ?>][FirstName]' id='FirstName' value='<?php print $current->FirstName; ?>' size='30' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Last Name</span><input type='text' name='Login[<?php print $current->LoginID; ?>][LastName]' id='LastName' value='<?php print $current->LastName; ?>' size='30' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Email</span><input autocomplete='off' type='text' name='Login[<?php print $current->LoginID; ?>][Email]' id='Email' value='<?php print $current->Email; ?>' size='30' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Password</span><input autocomplete='off' type='password' name='Login[<?php print $current->LoginID; ?>][Passwd]' onblur='this.value = (this.value.length<40) ? SHA1(this.value) : this.value;' id='Passwd' value='<?php print $current->Passwd; ?>' size='30' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Phone</span><input type='text' name='Login[<?php print $current->LoginID; ?>][Phone]' id='Phone' value='<?php print $current->Phone; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Home</span><input type='text' name='Login[<?php print $current->LoginID; ?>][HomePhone]' id='HomePhone' value='<?php print $current->HomePhone; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Login</span><input type='text' name='Login[<?php print $current->LoginID; ?>][Login]' id='Login' value='<?php print $current->Login; ?>' size='15' style='width:15em;' class='boxValue' /> [optional]</div>
         <?php
            if ($_SESSION['Login']->Admin) {
         ?>
               <div class='contentField'><span class='fieldLabel'>Administrator</span><input type='checkbox' name='Login[<?php print $current->LoginID; ?>][Admin]' id='Admin' value='true' class='boxValue' checked='<?php if ($current->Admin) print "checked"; ?>'/></div>
         <?php
            }
         ?>
         <div class='contentField'><span class='fieldLabel'>Dashboard Process</span>
            <select name='Login[<?php print $current->LoginID; ?>][InitialProcess]' id='InitialProcess'>
               <?php 
                  $procs = $boss->getObject("Process");
                  print "<option value='NULL'>[Default]</option>"; //PMP added to reset to default dashboard
                  foreach ($procs->Process as $key=>$proc) {
                     $s = ($proc->ProcessID == $current->InitialProcess) ? " SELECTED" : "";
                     print "<option value='{$proc->ProcessID}'$s>[{$proc->ProcessID}] {$proc->Process}</option>";
                  }
               ?>
            </select>
         </div>
         <div class='contentField'><span class='fieldLabel'>Module Access</span><input type='text' name='Login[<?php print $current->LoginID; ?>][Access]' id='Access' value='<?php print $current->Access; ?>' size='25' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Process Access</span><input type='text' name='Login[<?php print $current->LoginID; ?>][ProcessAccess]' id='ProcessAccess' value='<?php print $current->ProcessAccess; ?>' size='25' class='boxValue' /></div>
      </span><br style="clear:left"/>
      <div class='contentField' style='display:none'><span class='fieldLabel'>Notes</span><textarea name='Login[<?php print $current->LoginID; ?>][Notes]' id='Notes' class='textBox' style='width:45em;height:5em;'><?php print $boss->app->AppID; ?></textarea></div>
   </div>
</div>
<div class='accessTree' style="float:left;"><h2>Simple Access</h2>
   <div id='tree'></div>
</div>
