<?php
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
  function write(XMLWriter $xml, $data){
      foreach($data as $key => $value){
          if(is_array($value) || is_object($value)){
             if (is_int($key)) { $key = "idx_$key"; }
              $xml->startElement($key);
              write($xml, $value);
              $xml->endElement();
              continue;
          }
          $xml->writeElement($key, $value);
      }
  }
  write($xml, $data);

  $xml->endElement();//write end element
  //Return the XML results
  return $xml->outputMemory(true); 
}
?>
