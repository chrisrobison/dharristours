<style>
   label { width:auto;min-width:6em; margin-top:4px; }
   select { border:1px solid #666; border-radius:0px; font-family:"Open Sans",sans-serif; margin-top:4px; }
</style>
<script>
   $(function() {
      $("#Type").change(function(e) {
         var val = $(this).val();

         switch(val) {
            case "text":
               $("#Url").parent().hide();
               $("#Icon").parent().hide();
               $("#Content").parent().show();
               $("#Description").parent().show();
               break;
            case "image":
               $("#Url").parent().show();
               $("#Icon").parent().hide();
               $("#Content").parent().hide();
               $("#Description").parent().hide();
               break;
            case "iframe":
               $("#Url").parent().show();
               $("#Icon").parent().hide();
               $("#Content").parent().hide();
               $("#Description").parent().hide();
               break;
            case "link":
               $("#Url").parent().show();
               $("#Icon").parent().show();
               $("#Content").parent().hide();
               $("#Description").parent().hide();
               break;
            default:

         }
      });
   });
</script>
   <script type='text/javascript'>
      $(function() {
         $( "#dialog" ).dialog({
            autoOpen: false,
            width: 500,
            maxHeight: 400,
            height: 400,
            buttons: {
               "OK": function() {
                  $( this ).dialog( "close" );
               },
               Cancel: function() {
                  $( this ).dialog( "close" );
               }
            }
         });

         $( "#smallDialog" ).dialog({
            autoOpen: false,
            width: 400,
            maxHeight: 500,
            height: 400,
            buttons: {
               "OK": function() {
                  $( this ).dialog( "close" );
               },
               Cancel: function() {
                  $( this ).dialog( "close" );
               }
            }
         });

         $(".simpleIcon").click(function(e) {
            $(".selectedIcon").removeClass("selectedIcon");
            $(this).addClass("selectedIcon");
            $("#Icon").val($(this).attr('title')).change();
            setIcon($(this).attr('title'));
            $("#dialog").dialog("close");
         });
         $(".smallIcon").click(function(e) {
            $(".selectedIcon").removeClass("selectedIcon");
            $(this).addClass("selectedIcon");
            $("#Icon").val($(this).attr('title')).change();
            setIcon($(this).attr('title'));
            $("#smallDialog").dialog("close");
         });

         $("#opener").click(function(e) {
            $("#dialog").dialog("open");
            e.stopPropagation(); e.preventDefault(); return false;
         });
      });

      function mySelect(id) {
         setIcon(simpleConfig.record['Icon']);
      }

      function myNew() {
         $("#iconSpan").removeClass().addClass("simpleIcon");

      }

      function setIcon(ico) {
         console.log("Setting icon to " + ico);
         $("#iconSpan").removeClass().addClass("simpleIcon icon-" + ico);
      }
   </script>
   
   <style>
      .selectedIcon {
         background-color: #aaddff;
      }
      #dialog {
         width:300px;
         height:250px;
         overflow:auto;
      }
      #advanced {
         margin-left: 2.2em;
      }
      #advOpen, #advClosed {
         pointer:pointer;
      }
      .footer {
         position:fixed;
      }
      #iconSpan {
            display:inline-block;
            height:48px;
            width:48px;
            outline: none;
         }
      .simpleIcon:hover { background-color:#fff; }
      input,button { vertical-align:top; }
   </style>
   <link rel='stylesheet' type='text/css' href='/admin/appmanager/finder.css?ver=1.2' />
   <link rel="stylesheet" type="text/css" href="/lib/css/icons48.css" />
<div class='tableGroup'>
   <div class='formHeading'>Dashboard ID: <?php print $current->DashboardID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn2'>
         <div class='contentField'><label>Type</label>
            <select name='Dashboard[<?php print $current->DashboardID; ?>][Type]' id='Type'>
               <option value='text'>Text</option>
               <option value='image'>Image</option>
               <option value='iframe'>Iframe</option>
               <option value='link'>Link</option>
            </select>
            <label style='width:8em'>Category Seq</label>
            <select name='Dashboard[<?php print $current->DashboardID; ?>][CategorySequence]' id='CategorySequence'>
               <?php for ($x=1; $x<100; $x++) { 
                        print "<option value='$x'>$x</option>";
                     }
               ?>
            </select>
            <label style='width:6em'>Sequence</label>
            <select name='Dashboard[<?php print $current->DashboardID; ?>][Sequence]' id='Sequence'>
               <?php for ($x=1; $x<100; $x++) { 
                        print "<option value='$x'>$x</option>";
                     }
               ?>
            </select>
            
            <label style='width:4em'>Label</label>
            <select name='Dashboard[<?php print $current->DashboardID; ?>][Class]' id='Class'>
               <option value='closed'>No</option>
               <option value='header'>Yes</option>
            </select>

            <label style='width:4em'>State</label>
            <select name='Dashboard[<?php print $current->DashboardID; ?>][State]' id='State'>
               <option value='0'>Closed</option>
               <option value='1'>Open</option>
            </select>
         </div>
      <hr>
         <div class='fieldcolumn fieldfloater'>
         <div class='contentField'><label>Category</label><input type='text' dbtype='varchar(100)' name='Dashboard[<?php print $current->DashboardID; ?>][Category]' id='Category' value='<?php print $current->Category; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Entry Title</label><input type='text' dbtype='varchar(100)' name='Dashboard[<?php print $current->DashboardID; ?>][Dashboard]' id='Dashboard' value='<?php print $current->Dashboard; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Description</label><input type='text' dbtype='varchar(200)' name='Dashboard[<?php print $current->DashboardID; ?>][Description]' id='Description' value='<?php print $current->Description; ?>' size='50' class='boxValue' /></div>
      </div>
      <div class='fieldcolumn'>
         <div class='contentField'><label>Url</label><input type='text' dbtype='varchar(100)' name='Dashboard[<?php print $current->DashboardID; ?>][Url]' id='Url' value='<?php print $current->Url; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><label>Icon</label><span id='iconSpan'></span><input type='text' size='15' name='Dashboard[<?php print $current->DashboardID; ?>][Icon]' id='Icon' value='<?php print $current->Icon; ?>' class='boxValue' style='width:12em;' /><button class='button' id="opener">Browse Icons</button>
</div>
 <div id="dialog" title="Choose an Icon" style='display:none'>
<?php 
   $file = file($_SERVER['DOCUMENT_ROOT']."/lib/css/icons48.txt");
   
   $row = 0; $col = 0;
   $small = "";
   foreach ($file as $icon) {
      if (preg_match("/^\d+\-([^\.]*)\.png/", $icon)) {
         $icon = $match[1];
      }
      print "<span class='simpleIcon icon-".$icon."' title='".$icon."'></span>";
      $small .= "<span class='smallIcon small-".$icon."' title='".$icon."'></span>";
      ++$col;
      if ($col==10) {
         ++$row; $col = 0;
      }
   }
 
?>
</div>
      </div>
      <div class='contentField'><label>Content</label><textarea dbtype='text' name='Dashboard[<?php print $current->DashboardID; ?>][Content]' id='Content' class='textBox'><?php print $current->Content; ?></textarea></div>
      <div class='contentField' style='clear:left'><label>Notes</label><textarea dbtype='text' name='Dashboard[<?php print $current->DashboardID; ?>][Notes]' id='Notes' class='textBox'></textarea></div>
   </div>
</div>
