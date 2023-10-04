<?php
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/.env');
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/lib/boss_class.php');

    $boss = new boss("dharristours.simpsf.com");

    $in = $_REQUEST;
    $out = array();
    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");
    session_start();

    if (array_key_exists("invoices", $in)) {
        $invoice_ids = preg_split("/\,/", $in['invoices']);
        
        $tot = 0;
        $lineitems = array();

        foreach ($invoice_ids as $id) {
            $invoice = $boss->getObject("Invoice", $id);
            $job = $boss->getObject("Job", $invoice->JobID);

            if ($invoice) {
                $invoices[] = $invoice;
                $amt = $invoice->Balance * 100;
                $inv = $invoice->Invoice;
                $title = $job->Job;
                $all = "[".$id."] ". ' ' . $title;

                $lineitem = "{\"name\": \"{$all}\", \"quantity\": \"1\", \"base_price_money\": { \"amount\": {$amt}, \"currency\": \"USD\" }}";
                $lineitem = new stdClass();
                $lineitem->name = $all;
                $lineitem->quantity = "1";
                $lineitem->base_price_money = new stdClass();
                $lineitem->base_price_money->amount = $amt;
                $lineitem->base_price_money->currency = "USD";


                $lineitems[] = $lineitem;
                $tot += $invoice->Balance;
            }
        }
        $tot *= 100;
        if ($tot > 0) {
            $uid = uniqid();
            $txt = "Transportation Services";
            // $li = join(",", $lineitems);

            // Quick pay / 1 item version
            // $json_results = `curl -s https://connect.squareupsandbox.com/v2/online-checkout/payment-links -X POST -H 'Square-Version: 2023-08-16' -H 'Authorization: Bearer EAAAED7CKByFBqyR1MXInO4l-iPbZc0H9bfgX-xpRgs9WQzRbWAKA_OJywV-XwIM' -H 'Content-Type: application/json' -d '{ "idempotency_key": "{$uid}", "quick_pay": { "name": "{$txt}", "price_money": { "amount": $tot, "currency": "USD" }, "location_id": "LVR1SE093GTP9" } }'`;
            
            // Quick pay with Line items (uses ad hoc order items; can use square catalog)
            //$json_results = `curl -s https://connect.squareupsandbox.com/v2/online-checkout/payment-links -X POST -H 'Square-Version: 2023-08-16' -H 'Authorization: Bearer EAAAED7CKByFBqyR1MXInO4l-iPbZc0H9bfgX-xpRgs9WQzRbWAKA_OJywV-XwIM' -H 'Content-Type: application/json' -d '{ "idempotency_key": "{$uid}", "order": { "location_id": "LVR1SE093GTP9", "line_items": [ {$li} ] }, "pre_populated_data": { "buyer_address": { "address_line_1": "{$_SESSION['Business']->Address1}", "country": "US", "administrative_district_level_1": "{$_SESSION['Business']->State}", "locality": "{$_SESSION['Business']->City}", "postal_code": "{$_SESSION['Business']->Zip}" }, "buyer_email": "{$_SESSION['Email']}", "buyer_phone_number": "{$_SESSION['Login']->Phone}" } }'`;

            $obj = new stdClass();
            $obj->idempotency_key = $uid;
            $obj->order = new stdClass();
            $obj->order->location_id = "LVR1SE093GTP9";
            $obj->order->line_items = $lineitems;
            
            $obj->pre_populated_data = new stdClass();
            $obj->pre_populated_data->buyer_email = $_SESSION['Email'];
            $obj->pre_populated_data->buyer_phone = $_SESSION['Login']->Phone;
            $obj->pre_populated_data->buyer_address = new stdClass();
            $obj->pre_populated_data->buyer_address->first_name = $_SESSION["FirstName"];
            $obj->pre_populated_data->buyer_address->last_name = $_SESSION["LastName"];

            $js = str_replace("'", '', json_encode($obj, JSON_UNESCAPED_SLASHES));
            $url = "https://connect.squareupsandbox.com/v2/online-checkout/payment-links -X POST -H 'Square-Version: 2023-08-16' -H 'Authorization: Bearer EAAAED7CKByFBqyR1MXInO4l-iPbZc0H9bfgX-xpRgs9WQzRbWAKA_OJywV-XwIM' -H 'Content-Type: application/json' -d '$js'";
            $json_results = `curl -s $url`;
            $results = json_decode($json_results);
            if ($results->payment_link) {
                header("Location: ".$results->payment_link->url);
//                print "Location: ".$results->payment_link->url."\n";
            }
        }
    }
    
?>
