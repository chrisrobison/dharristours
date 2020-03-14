<?php
   if (!$boss) require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");

   $obj = $boss->db;
   $in =& $_REQUEST;
   $rsc = $in['rsc'] = (!$in['rsc']) ? 'Module' : $in['rsc'];

   $obj->addResource($in['rsc']);
   
   $cond = array();

   if ($in['ModuleID']) $cond[] = 'ModuleID='.$in['ModuleID'];
   if ($in['ProcessID']) $cond[] = 'ProcessID='.$in['ProcessID'];
   // if ($in['ProcessResourceID']) $cond[] = 'ProcessResourceID='.$in['ProcessResourceID'];
   
   $query = '';
   if (count($cond)) {
      $query = join(' AND ', $cond);
      $query .= ' ORDER BY Sequence';
   } else {
      $query = '1=1 ORDER BY Sequence';
   }

   $obj->$rsc->getlist($query);
   $list = genList($obj->$rsc->$rsc, $rsc, $rsc.'ID', $rsc, $in[$rsc.'ID']);

   function genList($data, $name, $key, $val, $id='') {
      $opts = '';
      $pkey = $name.'ID';
      foreach ($data as $idx=>$rec) {
         if ($rec->$pkey == $id) {
            $s = 'selectedList';
         } else { 
            $s = 'listItem';
         }
         $class = ($rec->Access) ? "" : " disabled";
         $opts .= "<div id='{$name}ID_".$rec->$key."' onclick=\"parent.select$name(event, '".$rec->$key."')\" class='listRow$class'><span class='$s$class'>".$rec->$val."</span><span class='itemID'>[".$rec->$key."]</span></div>\n";
      }
      return $opts;
   }

?>
<!DOCTYPE html>
<html>
   <head>
      <title><?php print $in['rsc']; ?> Form</title>
      <link href="/lib/css/Aristo/jquery-ui-1.8.5.custom.css" type="text/css" rel="stylesheet" />
      <link rel='stylesheet' type='text/css' href='finder.css' />
      <link rel='stylesheet' type='text/css' href='/lib/css/core.css' />
   </head>
   <body>
      <div class='heading'><?php print $in['rsc']; ?></div>
      <div id='mainWrap'>
         <?php print $list; ?>
      </div>
      <div class='footer'>
         <form name='localButtons' id='localButtons' onsubmit='return false;'>
            <a href='#new' onclick="parent.doNew('<?php print $in['rsc']; ?>');return false;" class='simpleButton'><span class="ui-icon ui-icon-plus"> </span> New</a>
            <a href='#delete' onclick="parent.doDelete('<?php print $in['rsc']; ?>');return false;" class='simpleButton'><span class='ui-icon ui-icon-trash'> </span> Delete</a>
         </form>
      </div>
   </body>
</html>
