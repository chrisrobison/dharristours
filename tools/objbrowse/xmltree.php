<?php
 require_once($_SERVER['DOCUMENT_ROOT']."/lib/boss_class.php");
// require_once("../../lib/xmltree_class.php");

// $obj = new xmltree('library.xml');
$boss = new boss();
$obj = $boss->getObject('Process');
list($output, $jstree) = dump($obj->Process, 1, 1);

function dump($obj, $lvl, $parent) {
   foreach ($obj as $key=>$val) {
      ++$id;
      $html .= str_repeat("\t", $lvl);
      if ((is_object($val)) || (is_array($val))) {
         if (count((array)$val)) {
            $jstree .= "tree['node_{$parent}_$id'] = 0;\n";
            $html .= "<div id='node_{$parent}_$id' class='node branchClosedEnd' onclick=\"toggleTree('node_{$parent}_$id');\">".$key ." <div class='val'>[".(is_object($val)?'OBJECT':(is_array($val)?'ARRAY':$val))."]</div></div>\n";
            $html .= str_repeat("\t", ($lvl+1));
            $html .= "<div id='node_".$parent.'_'.$id."_children' class='nodeParent' style='display:none;'>\n";
            list($newhtml, $js) = dump($val, ($lvl+1), $parent.'_'.$id);
            $html .= $newhtml;
            $jstree .= $js;
            $html .= str_repeat("\t", ($lvl+1));
            $html .= "</div>\n";
         }
      } else {
         $html .= "<div id='node_{$parent}_$id' class='node nodeClosed'>".$key." <div class='val'>[$val]</div></div>\n";
      }
   }
   return array($html, $jstree);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" /> 
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<html>
   <head>
      <title>PHP Object Browser</title>
      <script language='JavaScript' type='text/javascript'>
         var tree = new Array();
         <?php print $jstree; ?>
         function toggleTree(who) {
            var parnt = document.getElementById(who);
            var node = document.getElementById(who+'_children');
            if (!tree[who+'_children']) tree[who+'_children'] = 0;

            if (who) {
               tree[who+'_children'] ^= 1;
               if (tree[who+'_children']) {
                  parnt.className = 'node branchOpen';
                  node.style.display ='block';
               } else {
                  parnt.className = 'node branchClosed';
                  node.style.display = 'none';
               }
            }
            return false;
         }
         function init() {
            var winheight = getInsideWindowHeight();
            var tree = document.getElementById('tree');
            if (tree) {
               tree.style.height = winheight + 'px';
            }
            var srccode = document.getElementById('srccode');
            if (srccode) {
               srccode.style.top = '0px';
               srccode.style.left = '500px';
               srccode.style.height = winheight + 'px';
               srccode.style.width = '100%';
            }
         }
         
         function getInsideWindowHeight() {
             if (window.innerHeight) {
                 return window.innerHeight;
             } else if (document.all) {
                 // measure the html element's clientHeight
                 return document.body.parentElement.clientHeight
             } else if (document.body && document.body.clientHeight) {
                 return document.body.clientHeight;
             }
             return 0;
         }
         window.onresize = init;
      </script>
      <link rel='stylesheet' type='text/css' href='tree.css' />
   </head>
   <body onload='init();'>
      <div id='tree'>
      <?php 
         print $output;
      ?>
      </div>
      <div id='srccode'>
         <?php 
            highlight_file("eg.phps");
         ?>
      </div>
   </body>
</html>
