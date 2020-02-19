<?php
   require_once("../../lib/boss_class.php");
   $boss = new boss();

   $obj = $boss->db;
   $in =& $_REQUEST;
   $rsc = $in['rsc'] = (!$in['rsc']) ? 'Nav' : $in['rsc'];

   $obj->addResource($in['rsc']);
   $cond = array();

   if ($in['NavID']) $cond[] = 'NavID='.$in['NavID'];
   if ($in['ParentID']) $cond[] = 'ParentID='.$in['ParentID'];
   
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

         $opts .= "<div id='{$name}ID_".$rec->$key."' onclick=\"parent.select$name(event, '".$rec->$key."')\" class=listRow'><span class='$s'>".$rec->$val."</span><span class='itemID'>[".$rec->$key."]</span></div>\n";
      }
      return $opts;
   }

?>
<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<html>
   <head>
      <title><?php print $in['rsc']; ?> Form</title>
      <link rel='stylesheet' type='text/css' href='finder.css' />
   </head>
   <body>
      <div class='heading'><?php print $in['rsc']; ?></div>
      <div id='formWrap'>
         <?php print $list; ?>
      </div>
      <div class='footer'>
         <form name='localButtons' id='localButtons' onsubmit='return false;'>
            <input type='button' value='New <?php print $in['rsc']; ?>' onclick="parent.doNew('<?php print $in['rsc']; ?>')" class='footerButton' />
            <input type='button' value='Delete <?php print $in['rsc']; ?>' onclick="parent.doDelete('<?php print $in['rsc']; ?>')" class='footerButton' />
         </form>
      </div>
   </body>
</html>
