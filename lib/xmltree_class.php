<?php
class xmltree {
   var $tree;

   function xmltree($xml) {
      $xml_parser = xml_parser_create();
      
      if (!preg_match("/<\?xml/", $xml)) {
         $this->tree = $this->get_xml_tree($xml, '');
      } else {
         $this->tree = $this->get_xml_tree('', $xml);
      }
   }

   function get_children($vals, &$i) { 
     $children = array();     // Contains node data
     
     /* Node has CDATA before it's children */
     if (isset($vals[$i]['value'])) 
       $children['VALUE'] = $vals[$i]['value']; 
     
     /* Loop through children */
     while (++$i < count($vals)) { 
       
       switch ($vals[$i]['type'])  { 
         
         /* Node has CDATA after one of it's children 
           (Add to cdata found before if this is the case) */
         case 'cdata': 
           
         if (isset($children['VALUE'])) {
            $children['VALUE'] .= $vals[$i]['value']; 
         } else {
            $children['VALUE'] = $vals[$i]['value']; 
         } 
            break;

         /* At end of current branch */ 
         case 'complete': 
           
           if (isset($vals[$i]['attributes'])) {
             
              $children[$vals[$i]['tag']][]['ATTRIBUTES'] = $vals[$i]['attributes'];
              $index = count($children[$vals[$i]['tag']])-1;

               if (isset($vals[$i]['value'])) {
                  $children[$vals[$i]['tag']][$index]['VALUE'] = $vals[$i]['value']; 
               } else {
                  $children[$vals[$i]['tag']][$index]['VALUE'] = '';
               }

            } else {

               if (isset($vals[$i]['value'])) {
                  $children[$vals[$i]['tag']][]['VALUE'] = $vals[$i]['value']; 
               } else {
                  $children[$vals[$i]['tag']][]['VALUE'] = ''; 
               }
            }

         break;

         /* Node has more children */
         case 'open': 

           if (isset($vals[$i]['attributes'])) {

             $children[$vals[$i]['tag']][]['ATTRIBUTES'] = $vals[$i]['attributes'];
             $index = count($children[$vals[$i]['tag']])-1;
             $children[$vals[$i]['tag']][$index] = array_merge(
                                                                  $children[$vals[$i]['tag']][$index],
                                                                  $this->get_children($vals, $i)
                                                               );
           } else {
             $children[$vals[$i]['tag']][] = $this->get_children($vals, $i);
           }

           break; 

         /* End of node, return collected data */
         case 'close': 

           return $children; 

       } 
     } 
   } 

   function get_xml_tree($xmlloc, $data) { 
      if ((!$data) && ($xmlloc)) {
         if (file_exists($xmlloc)) {
            $data = implode('', file($xmlloc)); 
         } else {
            $fp = fopen( $xmlloc,'r' );
            $data = fread( $fp, 100000000 );
            fclose($fp);
          }
      }
         
     if (!$data) die("ERROR: Invalid or no XML data to process [get_xml_tree()]");

     $parser = xml_parser_create('ISO-8859-1');
     xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
     xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1); 
     xml_parse_into_struct($parser, $data, $vals, $index); 
     xml_parser_free($parser); 

     $tree = $this->tree = array(); 
     $i = 0; 
     
     if (isset($vals[$i]['attributes'])) {
      
      $this->tree[$vals[$i]['tag']][]['ATTRIBUTES'] = $tree[$vals[$i]['tag']][]['ATTRIBUTES'] = $vals[$i]['attributes']; 
      $index = count($tree[$vals[$i]['tag']]) - 1;
      
      $this->tree[$vals[$i]['tag']][$index] = $tree[$vals[$i]['tag']][$index] =  
            array_merge($tree[$vals[$i]['tag']][$index], $this->get_children($vals, $i));

     } else {
       $tree[$vals[$i]['tag']][] = $this->get_children($vals, $i); 
     }

     return $tree; 
   } 
   
   function cleanXML($obj) {
      
      if (is_array($obj)) {
         
         $newobj = new stdClass();
         
         foreach ($obj as $idx=>$val) {
            if (is_string($val[0]['VALUE'])) {
               $newobj->$idx = $val[0]['VALUE'];
               // $newobj->$idx = $val[0]['VALUE'];
            } else if (count($val[0])) {
               $newobj->$idx = $this->cleanXML($val[0]);
            } else {
               $newobj->$idx = $val;
            }
         }

         return $newobj;
      }
   }
   
   function dump($obj, $lvl=0) {
      if ($lvl == 0) {
         $out = '<?xml version="1.0" encoding="utf-8"?>'."\r\n";
      }

      if (is_array($obj) || is_object($obj)) {
         foreach ($obj as $key=>$val) {
            if ($key != 'ATTRIBUTES') {
               $out .= str_repeat("  ", $lvl);
               if (is_array($val->ATTRIBUTES)) {
                  foreach ($val->ATTRIBUTES as $k=>$v) {
                     $attr[] = $k . '="' . $v . '"';
                  }
                  $attrTXT = (count($attr)) ? ' ' . join(' ', $attr) : '';
               }
               $out .= "<$key$attrTXT>";
               
               if (is_array($val) || is_object($val)) {
                  $out .= "\r\n" . $this->dump($val, $lvl+1);
                  $out .= str_repeat("  ", $lvl);
               } else {
                  $out .= ($val != '') ? $val : "\r\n" . str_repeat("  ", $lvl);
               }
               $out .= "</$key>\r\n";
            }
         }
      } else {
         $out = $obj;
      }
      return $out;
   }

   // Usage: 
   //   $tree = get_xml_tree('PATH/TO/FILE.xml', $XMLCONTENT);
}

?>
