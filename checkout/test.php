<?php
   $s = $_SERVER;

   include((($s['DOCUMENT_ROOT']) ? $s['DOCUMENT_ROOT'] : '..') . '/lib/boss_class.php');
   include((($s['DOCUMENT_ROOT']) ? $s['DOCUMENT_ROOT'] : '..') . '/checkout/checkout_class.php');
   $boss = new boss("api.simpsf.com");

   chdir((($s['DOCUMENT_ROOT']) ? $s['DOCUMENT_ROOT'] : '..') . "/checkout");
   require_once('library/googleresponse.php');
   require_once('library/googlemerchantcalculations.php');
   require_once('library/googleresult.php');
   require_once('library/googlerequest.php');

    
   define('RESPONSE_HANDLER_ERROR_LOG_FILE', 'googleerror.log');
   define('RESPONSE_HANDLER_LOG_FILE', 'googlemessage.log');

   // $merchant_id = "353124695651838";   // production id
   $merchant_id = "736721936226616";   // sandbox id
   // $merchant_key = "E0zoomAR89jkXxWHJIzT0A";   // production Key
   $merchant_key = "T9DQADKHuBYJF66qcqowKA";   // sandbox key
   $server_type = "sandbox";   // change this to go live
   $currency = 'USD';   // set to GBP if in the UK
   $certificate_path = "/simple/lib/cacert.pem"; // set your SSL CA cert path
   
   $Gresponse = new GoogleResponse($merchant_id, $merchant_key);

   $Grequest = new GoogleRequest($merchant_id, $merchant_key, $server_type, $currency);
   $Grequest->SetCertificatePath($certificate_path);

   //Setup the log file
   $Gresponse->SetLogFiles(RESPONSE_HANDLER_ERROR_LOG_FILE, 
                                                            RESPONSE_HANDLER_LOG_FILE, L_ALL);

   // Retrieve the XML sent in the HTTP POST request to the ResponseHandler
   $xml_response = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : file_get_contents("new-order-example.xml");
    
   list($root, $data) = $Gresponse->GetParsedXML($xml_response);
   print_r($data);
   // $Gresponse->SetMerchantAuthentication($merchant_id, $merchant_key);

   // $status = $Gresponse->HttpAuthentication();
   // if(! $status) { die('authentication failed'); }

   /* Commands to send the various order processing APIs
    * Send charge order : $Grequest->SendChargeOrder($data[$root]['google-order-number']['VALUE'], <amount>);
    * Send process order : $Grequest->SendProcessOrder($data[$root]['google-order-number']['VALUE']);
    * Send deliver order: $Grequest->SendDeliverOrder($data[$root]['google-order-number']['VALUE'], <carrier>, <tracking-number>, <send_mail>);
    * Send archive order: $Grequest->SendArchiveOrder($data[$root]['google-order-number']['VALUE']);
    *
    */

   $json = json_encode($data[$root]);
   // file_put_contents('/tmp/' . $data[$root]['google-order-number']['VALUE']."\n", $json, FILE_APPEND);
   $obj = parseCheckout($data[$root]);
   print_r($obj);

    /* Returns true if a given variable represents an associative array */
   function is_associative_array( $var ) {
      return is_array( $var ) && !is_numeric( implode( '', array_keys( $var ) ) );
   }

   function logger($file, $event) {
         if (!preg_match("/^\//", $file)) $file = $_SERVER['DOCUMENT_ROOT'] . '/' . $file;
         if (!file_exists($file)) { touch($file); }
         $now = date("Y-m-d H:i:s");
         // file_put_contents($file, $now . ": " . $event . "\n", FILE_APPEND);
   }
  
?> 
