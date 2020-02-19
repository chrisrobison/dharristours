<?php
   require_once($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');
   require_once("../lib/boss_class.php");

   $boss = new boss("admin.dev.sscsf.com");

   $tables = $boss->getTables();
   $tbloptions = '';
   foreach ($tables as $tbl) {
      $s = ($tbl == $in['rsc']) ? ' SELECTED' : ''; 

      $tbloptions .= "<option$s>".$tbl."</option>\n";
   }
?>
<div id='relateDialog' style='display:none'>
   <form id="relate" name="relate">
      <h1 class="boxHeading">Process Model: <select name="tables" id="tables"><?php print $tbloptions; ?></select></h1>
      <table id="relateGrid"> </table>
      <div id="relateNav"> </div>
      
      <script>
         var relateGrid = $("#relateGrid");
         
         relateGrid.data('config', simpleConfig);
         relateGrid.jqGrid(<?php print $json; ?>);
         $("#relateNav").jqGrid('navGrid','#relateNav', {add:false,del:false,edit:false,refresh:true,search:true,view:false}, {}, {}, {}, {} ); 
         
      </script>

   </form>
</div>

