<?php
   require_once("obj_class.php");
   require_once("js_serialize.php");

   $in =& $_REQUEST;
   $obj = new obj('cdrmail2', 'pimp', 'pimpin');
   $obj->addResource('doc');
   
   if ((($in['node']) && ($in['outliner_id'])) || ($in['id'])) {
      if (!$in['id']) {
         $obj->doc->get($in['node'], 'node', "outliner_id='".$in['outliner_id']."' ORDER BY version desc");
      } else {
         $obj->doc->get($in['id'], 'id');
      }
      $doc = $obj->doc->doc[0];

      if (($in['x'] == 'save') && (isset($doc->id)) && ($doc->id!='undefined')) {
         $in['version'] = (!$doc->version) ? 1 : ($doc->version + .1);
         $in['last_modified'] = 'now()';
         $in['content'] = html_entity_decode($in['content']);

         $obj->doc->update($in['id'], $in);
      } else if ($in['x'] == 'save') {
         $in['last_modified'] = 'now()';
         $in['created'] = 'now()';
         $in['content'] = html_entity_decode($in['content']);

         $obj->doc->add($in);
      }
   }


   if ($in['newnode']) {
      $obj->doc->get($in['newnode'], 'node', "outliner_id='".$in['outliner_id']."' ORDER BY version desc");
      $doc = $obj->doc->doc[0];
      $in['node'] = $in['newnode'];
      unset($in['newnode']);
   }
   
   $jsdoc = "var content = ".js_serialize($doc, true).";\nwindow.opener.updateDocument(content);\n";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
   <head>
      <title>CDRMail Outliner</title>
      <script language="JavaScript" type='text/javascript'>
         <?php
            print $jsdoc;
         ?>
      </script>
   </head>
   <body>
      <pre>
         <?php print_r($in); print_r($obj); ?>
      </pre>
   </body>
</html>
