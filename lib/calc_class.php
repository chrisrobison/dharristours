<?php
require_once('boss_class.php');
class Calc {
   
   function Calc($obj) {
      $this->obj = $obj;
      $boss = new boss();
      
      if ($this->obj->LenderID) {
         $this->obj->Lender = $boss->getObject('Lender', $this->obj->LenderID);
      }

      if ($this->obj->ServicerID) {
         $this->obj->Servicer = $boss->getObject('Servicer', $this->obj->ServicerID);
      }

      $boss->db->addResource('BDForm');
      $boss->db->BDForm->getlist("1=1 order by BDNumber");
      
      $this->BDForm = $boss->db->BDForm->BDForm;
      $this->BD = array();
      $this->Result = array();
      $this->Calculated = new stdClass();
   }

   function execute() {
      
      foreach ($this->BDForm as $bdkey=>$bditem) {
         if (preg_match("/^=/", $bditem->Calculation)) {
            $this->BD[$bditem->BDNumber] = $this->parseCalculation($bditem->Calculation);
            $this->Result[$bditem->BDFormID] = $this->BD[$bditem->BDNumber];
            if ($bditem->Name) {
               $this->Calculated->{$bditem->Name} = $this->BD[$bditem->BDNumber];
            }
         } else if (preg_match("/\./", $bditem->SourceField)) {
            $fitems = preg_split("/\./", $bditem->SourceField);
            
            $this->BD[$bditem->BDNumber] = $this->obj->{$fitems[0]}->{$fitems[1]};
            $this->Result[$bditem->BDFormID] = $this->obj->{$fitems[0]}->{$fitems[1]};
            $this->Calculated->{$bditem->Name} = $this->obj->{$fitems[0]}->{$fitems[1]};
         } else {
            if ($bditem->SourceField) {
               $this->BD[$bditem->BDNumber] = $this->obj->{$bditem->SourceField};
               $this->Result[$bditem->BDFormID] = $this->obj->{$bditem->SourceField};
               $this->Calculated->{$bditem->Name} = $this->obj->{$bditem->SourceField};
            }
         }
      }
   }
   
   function parseCalculation($calc) {
      $calc = preg_replace("/^=/", '', $calc);
      $calc = preg_replace("/\s\s+/s", '', $calc);
 //    print "========\n\n".$calc."\n"; 
      $calcItems = preg_split("/(\W)/", $calc, -1, PREG_SPLIT_DELIM_CAPTURE);
//print_r($calcItems);
      foreach ($calcItems as $idx=>$citem) {
         $citem = preg_replace("/\n/", '', $citem);
         if ($citem) {
            if (!preg_match("/\W/", $citem) && ($this->obj->{$citem})) {
               $out[] = (preg_match("/\D/", $this->obj->{$citem})) ? "'".htmlspecialchars($this->obj->{$citem}, ENT_QUOTES)."'" : $this->obj->{$citem};
               $map->$citem = $this->obj->{$citem};
            } else if (preg_match("/[\+\-\*\/\.]/", $citem)) {
               $out[] = $citem;
            } else if (preg_match("/^BD(\d+)/", $citem, $match)) {
               $tmp = $this->BD[$match[1]];
               if (preg_match("/$/", $tmp)) $tmp = preg_replace("/[^0-9\.]/", '', $tmp);
               if ($tmp) {
                  $out[] = $tmp;
               } else {
                  if (is_array($out) && count($out)) array_pop($out);
               }
            } else if (preg_match("/[\"\'](.+?)[\"\']/", $citem, $match)) {
               $out[] = $citem;           
            } else if (preg_match("/(\w+)\((.*?)\)/", $citem, $match)) {
               if ($this->{$match[1]}) {
                  $out[] = $this->{$match[1]}($match[2]);
               } else {
                  $out[] = $citem;
               }
            } else {
               if (!$citem) $citem = 0;
               $out[] = $citem;
            }
         }
      }
      if (count($out)) {
         $str = '$result = '. join('', $out).';';
         @eval($str);
      }
      return($result);

   }
   
   function PRODUCT($key) {
      global $current;
      $sum = 0;
      foreach ($current as $idx=>$val) {
         if (preg_match("/^".$key."/", $idx)) {
            $tmp = preg_replace("/[^0-9\.]*/", '', $val);
            if (is_numeric($tmp)) $sum *= $tmp;
         }
      }
      return $sum;
   }
   function SUM($key) {
      global $current;
      $sum = 0;
      foreach ($current as $idx=>$val) {
         if (preg_match("/^".$key."/", $idx)) {
            $tmp = preg_replace("/[^0-9\.]*/", '', $val);
            if (is_numeric($tmp)) $sum += $tmp;
         }
      }
      return $sum;
   }
   
   function DIFF($key) {
      global $current;
      $sum = 0;
      foreach ($current as $idx=>$val) {
         if (preg_match("/^".$key."/", $idx)) {
            $tmp = preg_replace("/[^0-9\.]*/", '', $val);
            if (($sum==0) && ($tmp)) { 
               $sum = $tmp;
            } else {
               if (is_numeric($tmp)) $sum -= $tmp;
            }
         }
      }
      return $sum;
   }
   
   function AVG($key) {
      global $current;
      $sum = 0;
      $cnt = 0;
      foreach ($current as $idx=>$val) {
         if (preg_match("/^".$key."/", $idx)) {
            $tmp = preg_replace("/[^0-9\.]*/", '', $val);
            if (is_numeric($tmp)) {
               $sum += $tmp;
               ++$cnt;
            }
         }
      }
      return ($sum / $cnt);
   }

   function GETLOWESTBDAY($key) {
      global $current;
      $max = 10;
      foreach ($current as $idx=>$val) {
         if (preg_match("/^DateOfBirth/", $idx)) {
            if ($val && preg_match("/(\d+)\D(\d+)\D(\d+)/", $val)) {
               $chk = strtotime(preg_replace("/(\d+)\D(\d+)\D(\d+)/", '$3$1$2',$val));
               if ($chk > $max) $max = $chk;
            }
         }
      }

      return $max;
   }

   function young($plus){
      global $current;
      $m = min(strtotime($current->DateOfBirth1), strtotime($current->DateOfBirth2), strtotime($current->DateOfBirth3));
      $date = date('F-d-Y',$m);
      list($month, $day, $year) = split('[/.-]', $date);

      $num = $year+$plus;

      $young = "$month $day, $num <br />\n";
      return $young;
   }

   function location($current,$pre){
      eval("\$result = \$current->$pre;");
      return $result;
   }

}

?>
