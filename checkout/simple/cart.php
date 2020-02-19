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

  // Point to the correct directory
  chdir("..");
  // Include all the required files
  require_once('library/googlecart.php');
  require_once('library/googleitem.php');
  require_once('library/googleshipping.php');
  require_once('library/googletax.php');

  // Invoke any of the provided use cases
  DigitalUsecase();
  
// The idea of this usecase is to show how to implement Server2Server
// Checkout API Requests
// http://code.google.com/apis/checkout/developer/index.html#alternate_technique
// It will only display the GC button, and when you click on it it will redirect
// to a script ('digitalCart.php') that will create the cart, send it to google 
// Checkout and redirect the buyer to the corresponding page
  function DigitalUsecase() {
    echo "<h2>Server 2 Server Checkout Request</h2>";   
    $merchant_id = "736721936226616";  // Your Merchant ID
    $merchant_key = "T9DQADKHuBYJF66qcqowKA";  // Your Merchant Key
    $server_type = "sandbox";
    $currency = "USD";
    $cart = new GoogleCart($merchant_id, $merchant_key, $server_type,$currency);

    echo $cart->CheckoutServer2ServerButton('digitalcart.php');
  }

?>
