      <div id='newimportDialog' title="Create Table from Import" style='display:none' class='dialog'>
         <form action='cmd.php' id='newimportform' name='newimportform' method='post' target='importFrame' enctype='multipart/form-data'>
            <input type='hidden' name='x' value='newimport'>
            <label for='newimport'>Table Name:</label><input type='text' name='newimport' id='newimport' size='30'><br><br>
            <label for='newimportFile'>Upload File to Import:</label> <input type='file' name='newimportFile' id='newimportFile'>
            <div id='importmakeToolWrap'><input type='checkbox' checked='checked' name='importMakeTool' id='importMakeTool'><label for='importModuleID'>Create Component in:</label>
            <select name='importModuleID' id='importModuleID'>
               <?php print $opts; ?>
            </select></div>
            <input type='hidden' name='importIcon' id='importIcon' value='' />
            Select Icon: <span id='importIconPreview' class='simpleIcon iconPreview'> </span><br>
            <div id="importIcons">
            <?php 
               $file = file($_SERVER['DOCUMENT_ROOT']."/lib/css/icons.txt");
               
               $row = 0; $col = 0;
               foreach ($file as $icon) {
                  preg_match("/\d*-(.+?)\.png/", $icon, $match);

                  print "<span class='simpleIcon icon-".$match[1]."' title='".$match[1]."'></span>";
                  ++$col;
                  if ($col==10) {
                     ++$row; $col = 0;
                  }
               }
            ?>
            </div>
         </form>
      </div>

