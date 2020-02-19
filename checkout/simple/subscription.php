<?php

  chdir($_SERVER['DOCUMENT_ROOT'] . "/checkout");
  
  require_once('library/googlecart.php');
  require_once('library/googleitem.php');
  require_once('library/googlesubscription.php');

    
  GoogleSubscription();
  
  function GoogleSubscription() {
    $merchant_id = "736721936226616";  // Your Merchant ID
    $merchant_key = "T9DQADKHuBYJF66qcqowKA";  // Your Merchant Key
    $server_type = "sandbox";  // or production
    $currency = "USD";
    
    $cart = new GoogleCart($merchant_id, $merchant_key, $server_type, $currency);
    
    $item = new GoogleItem("Simple Software Application Setup", "Setup fee for your Simple Software Application & Workspace", 1, 200.00);
    
    $subscription_item = new GoogleSubscription("google", "MONTHLY", 250.00, 12);
    $recurrent_item = new GoogleItem("fee", "recurring fee", 1, 250.00);
    
    $subscription_item->SetItem($recurrent_item);
    
    $item->SetSubscription($subscription_item);
    
    $cart->AddItem($item);
    // print $cart->GetXML();
    echo $cart->CheckoutButtonCode("SMALL");
    
  }
?>
