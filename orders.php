<?php

   $s = $_SERVER;

   include((($s['DOCUMENT_ROOT']) ? $s['DOCUMENT_ROOT'] : '.') . '/lib/boss_class.php');
   include((($s['DOCUMENT_ROOT']) ? $s['DOCUMENT_ROOT'] : '.') . '/checkout/checkout_class.php');
   $boss = new boss("api.simpsf.com");

   chdir((($s['DOCUMENT_ROOT']) ? $s['DOCUMENT_ROOT'] : '.') . "/checkout");
   require_once('library/googleresponse.php');
   require_once('library/googlemerchantcalculations.php');
   require_once('library/googleresult.php');
   require_once('library/googlerequest.php');

    
   define('RESPONSE_HANDLER_ERROR_LOG_FILE', 'googleerror.log');
   define('RESPONSE_HANDLER_LOG_FILE', 'googlemessage.log');

   $merchant_id = "353124695651838";   // production id
   // $merchant_id = "736721936226616";   // sandbox id
   $merchant_key = "E0zoomAR89jkXxWHJIzT0A";   // production Key
   // $merchant_key = "T9DQADKHuBYJF66qcqowKA";   // sandbox key
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
   $xml_response = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : file_get_contents("php://input");
    
   logger($s['DOCUMENT_ROOT'] . '/log/google-xml.log', var_export($_SERVER, true) . "\n" . $xml_response);
   
   if (get_magic_quotes_gpc()) $xml_response = stripslashes($xml_response);
   
   list($root, $data) = $Gresponse->GetParsedXML($xml_response);
   $Gresponse->SetMerchantAuthentication($merchant_id, $merchant_key);

   $status = $Gresponse->HttpAuthentication();
   if(! $status) { die('authentication failed'); }

   /* Commands to send the various order processing APIs
    * Send charge order : $Grequest->SendChargeOrder($data[$root]['google-order-number']['VALUE'], <amount>);
    * Send process order : $Grequest->SendProcessOrder($data[$root]['google-order-number']['VALUE']);
    * Send deliver order: $Grequest->SendDeliverOrder($data[$root]['google-order-number']['VALUE'], <carrier>, <tracking-number>, <send_mail>);
    * Send archive order: $Grequest->SendArchiveOrder($data[$root]['google-order-number']['VALUE']);
    *
    */
   logger($s['DOCUMENT_ROOT'] . '/log/google-order.log', $root . "\n" . json_encode($data) . "\n===================\n");
   logger($s['DOCUMENT_ROOT'] . '/log/google/' . $root . '.log', json_encode($data[$root]));

   $json = json_encode($data[$root]);
   file_put_contents('/tmp/' . $data[$root]['google-order-number']['VALUE'], $json, FILE_APPEND);
   $obj = parseCheckout($data[$root]);
   
   // $obj = json_decode(json_encode($obj));
   
   logger("/tmp/checkout-test.log", json_encode($obj));
   if ($root == "new-order-notification") {
      newOrder($obj);
   }
   
   if ($root == "risk-information-notification") {
   
   }

   if ($root == "order-state-change-notification") {
      logger("/tmp/orders.log", json_encode($obj));
      $checkouts = $boss->getObject('Checkout', "GoogleOrderNumber=".$boss->q($obj['GoogleOrderNumber']));
      $checkout = $checkouts->Checkout[0];
      
      if ($checkout) {
         $out = array();
         $out['Checkout'][$checkout->CheckoutID]['FinancialOrderState'] = $obj['NewFinancialOrderState'];
         $out['Checkout'][$checkout->CheckoutID]['FulfillmentOrderState'] = $obj['NewFulfillmentOrderState'];
         $boss->storeObject($out);
         
         $sys = new boss();

         $sys->db->dbobj->execute("use SS_System");
         $sys->db->dbobj->db = "SS_System";
         
         if (($obj['NewFinancialOrderState'] == "CHARGED")  && ($obj['NewFulfillmentOrderState'] == "DELIVERED")) {
            if ($checkout->AppID) {
               $apps = preg_split("/\,/", $checkout->AppID);
               $domargs = preg_replace("/,/", ' ', preg_replace("/^domains:/", "", $checkout->MerchantData));
               
               file_put_contents("/mnt/simple/hosts/.sysupdate/deploy.ns", join($apps, " "), FILE_APPEND);
               file_put_contents("/mnt/simple/hosts/.sysupdate/zone.ns", $domargs, FILE_APPEND);
               file_put_contents("/mnt/simple/hosts/.sysupdate/zone.rtf", $domargs, FILE_APPEND);
               $results = `domains/srsplus/register-domain {$checkout->SRSID} $domargs`;
               logger("/tmp/register.log", $results);

               /*
               foreach ($apps as $app) {
                  logger("/tmp/deploy.log", "http://admin.dev.sscsf.com/admin/deploy/deploy.php?x=deploy&AppID=".$app);

                  if (!$checkout->Deployed) {
                     $results = file_get_contents("http://admin.dev.sscsf.com/admin/deploy/deploy.php?x=deploy&AppID=".$app);
                     $sys->db->dbobj->execute("update App set PayStatus='current' where AppID={$app}");
                     
                     $out = array('Checkout'=>array( $checkout->CheckoutID => array( 'Deployed'=>date("Y-m-d H:i:s"))));
                     $boss->storeObject($out);
                  }
               }
               */
            } else {
               // Do something when there is no AppID
            }
         }
      }
      $Gresponse->SendAck();
   }
    
   switch ($root) {
      case "request-received": {
         break;
      }
      case "error": {
         break;
      }
      case "diagnosis": {
         break;
      }
      case "checkout-redirect": {
         break;
      }
      case "new-order-notification": {
         logger('/tmp/' . $data[$root]['google-order-number']['VALUE'], json_encode($data[$root]));
         $Gresponse->SendAck();
         break;
      }
      case "order-state-change-notification": {
         $new_financial_state = $data[$root]['new-financial-order-state']['VALUE'];
         $new_fulfillment_order = $data[$root]['new-fulfillment-order-state']['VALUE'];
         $Gresponse->SendAck();

         switch($new_financial_state) {
            case 'REVIEWING': {
               break;
            }
            case 'CHARGEABLE': {
               //$Grequest->SendProcessOrder($data[$root]['google-order-number']['VALUE']);
               //$Grequest->SendChargeOrder($data[$root]['google-order-number']['VALUE'],'');
               break;
            }
            case 'CHARGING': {
               break;
            }
            case 'CHARGED': {
               
               break;
            }
            case 'PAYMENT_DECLINED': {
               break;
            }
            case 'CANCELLED': {
               break;
            }
            case 'CANCELLED_BY_GOOGLE': {
               //$Grequest->SendBuyerMessage($data[$root]['google-order-number']['VALUE'],
               //      "Sorry, your order is cancelled by Google", true);
               break;
            }
            default:
               break;
         }

         switch($new_fulfillment_order) {
            case 'NEW': {
               break;
            }
            case 'PROCESSING': {
               break;
            }
            case 'DELIVERED': {
               break;
            }
            case 'WILL_NOT_DELIVER': {
               break;
            }
            default:
               break;
         }
         break;
      }
      case "charge-amount-notification": {
         $Grequest->SendDeliverOrder($data[$root]['google-order-number']['VALUE'], "Online", "0123456789", true);
         
         //$Grequest->SendArchiveOrder($data[$root]['google-order-number']['VALUE'] );
         $Gresponse->SendAck();
         break;
      }
      case "chargeback-amount-notification": {
         $Gresponse->SendAck();
         break;
      }
      case "refund-amount-notification": {
         $Gresponse->SendAck();
         break;
      }
      case "risk-information-notification": {
         $Gresponse->SendAck();
         break;
      }
      default:
         $Gresponse->SendBadRequestStatus("Invalid or not supported Message");
         break;
   }
   /* In case the XML API contains multiple open tags
       with the same value, then invoke this function and
       perform a foreach on the resultant array.
       This takes care of cases when there is only one unique tag
       or multiple tags.
       Examples of this are "anonymous-address", "merchant-code-string"
       from the merchant-calculations-callback API
   */
   function get_arr_result($child_node) {
      $result = array();
      if(isset($child_node)) {
         if(is_associative_array($child_node)) {
            $result[] = $child_node;
         }
         else {
            foreach($child_node as $curr_node){
               $result[] = $curr_node;
            }
         }
      }
      return $result;
   }

   /* Returns true if a given variable represents an associative array */
   function is_associative_array( $var ) {
      return is_array( $var ) && !is_numeric( implode( '', array_keys( $var ) ) );
   }

   function logger($file, $event) {
         if (!preg_match("/^\//", $file)) $file = $_SERVER['DOCUMENT_ROOT'] . '/' . $file;
         if (!file_exists($file)) { touch($file); }
         $now = date("Y-m-d H:i:s");
         file_put_contents($file, $now . ": " . $event . "\n", FILE_APPEND);
   }
?>
