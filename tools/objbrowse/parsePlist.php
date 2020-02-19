<?php
$data = file_get_contents("boss-All.graffle");
$xsl = new DOMDocument($data);
print_r($xsl);
$inputdom = new DomDocument();
$inputdom->load("boss-All.graffle");
$proc = new XsltProcessor();
$proc->registerPhpFunctions();
$xsl = $proc->importStylesheet($xsl);
$newdom = $proc->transformToDoc($inputdom);
$sxe = simplexml_import_dom($newdom);
print('<pre>');
print_r($sxe->dict);
print('</pre>');


function plist_to_array ($domnode, &$array, $name) {
   $array_ptr = &$array;
   $domnode = $domnode->firstChild;
   while (!is_null($domnode)) {
       if (! (trim($domnode->nodeValue) == "") ) {
           switch ($domnode->nodeName)
           {
           case "dict": {
               if ($name != "")
                   $array_ptr = &$array[$name][];
               break;
           }
           case "key": {
               if ($domnode->nodeValue != $name)
                   $name = $domnode->nodeValue;
               break;
           }
           case "string": {
               $array_ptr[$name] = $domnode->nodeValue;
               break;
           }
           }
           if ( $domnode->hasChildNodes() ) {
               plist_to_array ($domnode, $array_ptr, $name);
           }
       }
       $domnode = $domnode->nextSibling;
   }
}
?>


