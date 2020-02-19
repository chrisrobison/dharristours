      <div id='dbDialog' title="Create Table" style='display:none'>
         <form id='newtblform' method='post'>
            <input type='hidden' name='x' value='newtable'>
            <label for='tblname'>Table Name:</label><input type='text' name='newtable' id='newtable' size='30'><br>
            <div id='makeToolWrap'><input type='checkbox' checked='checked' name='makeTool' id='makeTool'><label for='ModuleID'>Create Component in</label>
            <select name='ModuleID' id='ModuleID'>
               <?php print $opts; ?>
            </select></div>
            <input type='hidden' name='Icon' id='Icon' value='' />
            Select Icon: <span id='iconPreview' class='simpleIcon'> </span><br>
            <div id="icons">
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

