<?php
function js_serialize($var, $recursed = false) {
   
   if (is_null($var) || is_resource($var)) return false;

   $js = '""';
  
   // Handle objects & hashes
   if (is_object($var) || is_assoc_array($var)) {
       //typecast to array in the case it could be an object
       $props = (array)$var;
       $js = ''; 
       foreach($props as $k=>$v) {
           //index values are preffixed with 'idx_'
           if (is_int($k)) $k = "idx_$k";
           $js .= "'".$k."':".(($k=='default') ? "'".$v."'" : js_serialize($v, true)).",";
       }
       if (count($props))
             $js = substr($js, 0, strlen($js)-1);
        
         $js = '{'.$js.'}';
         if (! $recursed) $js = "($js)";
            
   } elseif (is_array($var)) {
       foreach($var as $v)
           $js .= js_serialize($v, true).",";
       if (count($var))
           $js = substr($js, 0, strlen($js)-1);
       $js = "[$js]";
      
   } elseif (is_string($var)) {
       //escape the string
       $var = str_replace( array('"', "\n", "\r"), array('\\"', '\\n'), $var );
       $js = $recursed ? "\"$var\"" : "(new String(\"$var\"))";
  
   } elseif (is_bool($var)) {

       $var = ($var)?'true':'false';

       $js = $recursed ? $var : "(new Boolean($var))";
  
   } elseif ((!$var) || (is_null($var))) {
       $js = '""';
   } else { //should be an int or a float in theory       
       
       $js = $recursed ? "'$var'" : "(new Number($var))";
   }

   return $js;
}
//helper function, returns true if the array is associative
function is_assoc_array( $var ) {
   //false if not an array or empty
   if ( (!is_array($var)) || (!count($var)) ) return false;
  
   foreach($var as $k=>$v)
       if (! is_int($k)) return true;
      
   return false;
}
?> 
