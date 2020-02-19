<?php
   require_once("../../lib/boss_class.php");

   $boss = new boss("mediaplex.dev.sscsf.com");
   
   if ($argv) {
      $cmd = true;
      while (count($argv)) {
         $arg = array_shift($argv);
         if (preg_match("/^\-\-(\w+)=([^\s]+)/", $arg, $match)) {
            $in[$match[1]] = $match[2];
            next;
         }
      }
   } else {
      $in = $_REQUEST;
   }

   $in['ID'] = ($in['ID']) ? $in['ID'] : 1;
   
   $boss->db->addResource("Creative");
   $boss->db->Creative->get($in['ID']);
   $creative = $boss->db->Creative->Creative[0];
   
   $boss->db->addResource("Component");
   $boss->db->Component->getlist("CreativeID=".$creative->CreativeID);
   $creative->Components = $boss->db->Component->Component;

   //$creative = $boss->getObject("Creative", $in['ID']);
   // $creative = $boss->cleanObject($creative, true);
   
   $out = new stdClass();
   foreach ($creative as $key=>$val) {
      if (is_array($val)) {
         $out->{$key} = array();
         foreach ($val as $idx=>$aval) {
            $out->{$key}[$idx] = $aval;
         }
      } else if (preg_match("/^\s*\{/", $val)) {
         $jstmp = json_decode($val);
         $out->{$key} = $jstmp;
      } else {
         $out->{$key} = $val;
      }
   }

   if ($in['out'] == 'xml') {
      $xml = buildXMLData($out);
      if (!$cmd) header("Content-type: text/xml"); 
      print $xml."\n";
   }

   if ($in['out'] == 'json') {
      if (!$cmd) header("Content-type: application/x-javascript");
      print json_encode($out)."\n";
   }
   
   /**
    * Build A XML Data Set
    *
    * @param array $data Associative Array containing values to be parsed into an XML Data Set(s)
    * @param string $startElement Root Opening Tag, default fx_request
    * @param string $xml_version XML Version, default 1.0
    * @param string $xml_encoding XML Encoding, default UTF-8
    * @return string XML String containig values
    * @return mixed Boolean false on failure, string XML result on success
    */
   function buildXMLData($data, $startElement = 'ad', $xml_version = '1.0', $xml_encoding = 'UTF-8') {
     if(!is_array($data) && !is_object($data)){
        $err = 'Invalid variable type supplied, expected array not found on line '.__LINE__." in Class: ".__CLASS__." Method: ".__METHOD__;
        trigger_error($err);
        if($this->_debug) echo $err;
        return false; //return false error occurred
     }
     $xml = new XmlWriter();
     $xml->openMemory();
     $xml->startDocument($xml_version, $xml_encoding);
     $xml->startElement($startElement);

     /**
      * Write XML as per Associative Array
      * @param object $xml XMLWriter Object
      * @param array $data Associative Data Array
      */
     function write(XMLWriter $xml, $data, $parent=''){
        foreach($data as $key => $value){
            if(is_array($value) || is_object($value)){
               if (is_int($key)) { 
                  $key = preg_replace("/s$/", '', $parent); 
                  $xml->startElement($key);
               } else {
                  $xml->startElement($key);
               }
               write($xml, $value, $key);
               $xml->endElement();
               continue;
            }
            $xml->writeElement($key, $value);
         }
     }
     write($xml, $data, $startElement);

     $xml->endElement();//write end element
     //Return the XML results
     return $xml->outputMemory(true); 
   }

?>
