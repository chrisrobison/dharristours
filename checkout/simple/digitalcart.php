<?php
/**
 * Copyright (C) 2007 Google Inc.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *      http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

 chdir("..");
// Include all the required files
require_once('library/googlecart.php');
require_once('library/googleitem.php');
require_once('library/googlesubscription.php');
require_once('library/googleshipping.php');
require_once('library/googletax.php');

basicSetup();
function basicSetup() {
  $certificate_path = "/simple/lib/cacert.pem"; // set your SSL CA cert path
  $merchant_id = "736721936226616";             // Your Merchant ID
  $merchant_key = "T9DQADKHuBYJF66qcqowKA";     // Your Merchant Key
  $hostname = preg_replace("/\..*/", '', $_SERVER['HTTP_HOST']);  
  $cart = new GoogleCart($merchant_id, $merchant_key, "sandbox", "USD");
  $total_count = 1;
  
//  Key/URL delivery
  $item_1 = new GoogleItem("Simple Software Setup Fee",      // Item name
                           "Setup and support for Simple Software.", // Item description
                           1, // Quantity
                           99.99); // Unit price
  $item_1->SetURLDigitalContent('https://' . $hostname . '.simpsf.com/app', 'S/N: ' . md5(time()), "Launch your Simple Software Web Application Workspace");
  $cart->AddItem($item_1);
//  Email delivery 
  $subscription_item = new GoogleSubscription("google", "MONTHLY", 200.00, 12);
  
  $item_2 = new GoogleItem("Simple Software Subscription - 10 Users",      // Item name
                           "Monthly subscription to the Simple Software Online Application and Workspace", // Item description
                           $total_count, // Quantity
                           129.00); // Unit price
  $item_2->SetEmailDigitalDelivery('true');
  
  $subscription_item->SetItem($item_2);
  $item_1->SetSubscription($item_2);

  $cart->AddItem($item_2);
// print $cart->GetXML();

  // Add tax rules
  $tax_rule = new GoogleDefaultTaxRule(0.05);
  $tax_rule->SetStateAreas(array("MA", "FL", "CA"));
  $cart->AddDefaultTaxRules($tax_rule);
  
  // Specify <edit-cart-url>
  $cart->SetEditCartUrl("https://admin.dev.sscsf.com/cart.php");
  
  // Specify "Return to xyz" link
  $cart->SetContinueShoppingUrl("https://admin.dev.sscsf.com/");
  
  // Request buyer's phone number
  $cart->SetRequestBuyerPhone(true);

// Add analytics data to the cart if its setted
  if(isset($_POST['analyticsdata']) && !empty($_POST['analyticsdata'])){
    $cart->SetAnalyticsData($_POST['analyticsdata']);
  }
// This will do a server-2-server cart post and send an HTTP 302 redirect status
// This is the best way to do it if implementing digital delivery
// More info http://code.google.com/apis/checkout/developer/index.html#alternate_technique
  list($status, $error) = $cart->CheckoutServer2Server('', $certificate_path);
  // if i reach this point, something was wrong
  echo "An error had ocurred: <br />HTTP Status: " . $status. ":";
  echo "<br />Error message:<br />";
  echo $error;
//
}
?>
