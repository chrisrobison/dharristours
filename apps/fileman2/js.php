<?php
function js_serialize($var, $recursed = false) {
   if (is_null($var) || is_resource($var)) return 'null';
   
   $js = '';
   
   // Handle object or hash
   if (is_object($var) || is_hash($var)) {
       // Force cast our data as an array in case we're passed an object
       $props = (array)$var;

      // Loop through array and append key/value pairs to js string
      foreach($props as $k=>$v) {
         // Prefix index values with 'idx_'.  Assumes any integer keys are indexes
         if (is_int($k)) $k = "idx_$k";

         // Ensure safe characters in our keyname
         $js .= "'".htmlspecialchars($k, ENT_QUOTES)."':".js_serialize($v, true).",";
      }
      
      // If we have data, clean it up and ready it for js consumption
      if (count($props))
         $js = substr($js, 0, strlen($js) - 1);    // Lose trailing comma
         $js = '{' . $js . "}";                    // Wrap in js object def brackets

         // Finalize js string if not recursing
         if (!$recursed) {
            $js = "($js)";  
         }
      } elseif (is_array($var)) {   // Handle numerically indexed arrays
         foreach ($var as $v) {
            $js .= js_serialize($v, true).",";
         }
         
         // Chop off trailing comma
         if (count($var)) $js = substr($js, 0, strlen($js) - 1);
      
         // and wrap it all in js array def brackets [...]
         $js = "[$js]";
   } elseif (is_string($var)) {  // Handle strings
      // Escape and ready the string for JS consumption
      $var = htmlspecialchars($var, ENT_QUOTES);   // Fix quotes and other HTML problem chars
      $var = str_replace( array('"', "\n", "\r"), array('\\"', '\\n'), $var );   // Escape newlines
      $js = $recursed ? "\"$var\"" : "(new String(\"$var\"))"; // Assign to our js string
   
   } elseif (is_bool($var)) {    // Handle booleans
       $var = ($var) ? 'true' : 'false';
       $js = $recursed ? $var : "(new Boolean($var))";

   } else {    // If we reached here, we should have an int or a float in theory       
       $js = $recursed ? $var : "(new Number($var))";
   }

   return $js;
}
// Helper function that returns true if an array is hashed or associative
function is_hash($var) {
   // False if not an array or empty
   if (!is_array($var) || !count($var)) return false;
  
   // Loop through array keys and return true (we have hash) on first non-integer key
   foreach($var as $k=>$v) {
      if (!is_int($k)) return true;
   }

   return false;
}
?>
