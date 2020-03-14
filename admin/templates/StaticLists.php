<div style="float:right;position:relative;z-index:99999;width:45%;height:99%;border-left: 1px solid #909090;overflow:scroll;overflow:-moz-scrollbars-vertical;">
   <div class='boxHeading'>List Items</div>
   <table id='subtable' class='boxTable' cellpadding='0' cellspacing='0' border='0' width='45%'>
      <tr class='subtableHeading'>
         <td class='subtableHeadCell' style='width:3em;text-align:center;'>ID</td>
         <td class='subtableHeadCell'>Caption</td>
         <td class='subtableHeadCell'>Value</td>
         <td class='subtableHeadCell'>Sequence</td>
      </tr>
      <?php
         $fields = array('StaticListItemID'=>array('display'=>'ID', 'width'=>'4em'), 'Caption'=>array('display'=>'Caption', 'width'=>'15em'), 'Value'=>array('display'=>'Value', 'width'=>'3em'), 'Sequence'=>array('display'=>'Sequence','width'=>'3em'));
         $flop = 1;
         if ($current->StaticListItem) {
            foreach ($current->StaticListItem as $idx=>$item) {
               $flop ^= 1;
               
               if (!$eg) $doeg = 1;
               
               print "<tr>";
//               if ($doeg) $eg .= "<tr id='newrecord'>";
               
               foreach ($fields as $key=>$val) {
                  $sz = $val->width;
                  if (!$sz) $sz = (preg_match("/^\d+$/", $item->$key)) ? (strlen($item->$key) + 1) . 'em' : '20em';
                  print "<td class='NB_boxRow$flop".((preg_match("/ID$/", $key)) ? ' center' : '')."' style='width:{$sz}em;'>";
                  if ($doeg) $eg .= "<td class='NB_boxRow$flop".((preg_match("/ID$/", $key)) ? ' center' : '')."'>";
                  
                  if (!preg_match("/ID$/", $key)) {
                     print "<input class='NB_boxRow{$flop} boxValue4' type='text' name='StaticList[{$current->StaticListID}][StaticListItem][{$item->StaticListItemID}][{$key}]' size='$sz' style='width:{$sz};' value='{$item->$key}' />";
                     if ($doeg) $eg .= "<input class='NB_boxRow{$flop} boxValue4' type='text' name='StaticList[{$current->StaticListID}][StaticListItem][new1][{$key}]' size='$sz' style='width:{$sz};' value='' id='new1' />";
                  } else {
                     print "<div style='position:relative;width:{$sz};'>".$item->$key."</div>";
                     if ($doeg) $eg .= "<div style='position:relative;width:{$sz};'>New</div>";
                  }
                  print "</td>";
                  if ($doeg) $eg .= "</td>";
               }
               print "</tr>\n";
               if ($doeg) {
                  // $eg .= "</tr>";
                  $doeg = 0;
               }
            }
         } else {
            foreach ($fields as $key=>$val) {
               $sz = (preg_match("/^\d+$/", $item->$key)) ? (strlen($item->$key) + 1) . 'em' : '15em';
               $eg .= "<td class='NB_boxRow$flop".((preg_match("/ID$/", $key)) ? ' center' : '')."'>";
               
               if (!preg_match("/ID$/", $key)) {
                  $eg .= "<input class='NB_boxRow{$flop} boxValue4' type='text' name='StaticList[{$current->StaticListID}][StaticListItem][new1][{$key}]' size='$sz' style='width:{$sz};' value='' id='new1' />";
               } else {
                  $eg .= "<div style='position:relative;width:{$sz};'>New</div>";
               }
               $eg .= "</td>";
            }
 
         }
         // print $eg;
         print "\n<script language='Javascript' type='text/javascript'>var tableEntry = \"$eg\";</script>\n";
      ?>
   </table>
   <div id='newcontrol'>
      <div onclick="return showNewRecord(event, tableEntry)" class='tblButton'><span class='tblButtonText'>+</span></div>
      <a href='javascript:void(null)' onclick='showNewRecord(event, tableEntry)'>Add new list item</a>
   </div>
</div>
<div class='tableGroup' style='height:99%;'>
   <div class='boxHeading'>List ID: <?php print $current->StaticListID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Name</span><input type='text' name='StaticList[<?php print $current->StaticListID; ?>][Name]' id='Name' value='<?php print $current->Name; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Default Value</span><input type='text' name='StaticList[<?php print $current->StaticListID; ?>][DefaultValue]' id='DefaultValue' value='<?php print $current->DefaultValue; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Description</span><textarea name='StaticList[<?php print $current->StaticListID; ?>][Description]' id='Description' class='textBox' style='width:25em;height:5em;'><?php print $current->Description; ?></textarea></div>
      </span>
   </div>
</div>

