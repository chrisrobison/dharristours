<?php
   /**
    *  Usage: $newobj = parseCheckout( $PHPObjectOrArray );
    *
    **/
   function parseCheckout($obj, $level=1) {
      if ($obj) {
         $newobj = array();

         foreach ($obj as $key=>$val) {
            $key = preg_replace("/Id$/", 'ID', preg_replace("/\-([a-z])/e", "strtoupper($1)", preg_replace("/^([a-z])/e", "strtoupper($1)", $key)));
            if (is_string($val)) {
               $newobj[$key] = $val;
            } else if (is_object($val) && property_exists(get_class($val), 'VALUE')) {
               $newobj[$key] = $val->VALUE;
            } else if (is_array($val) && array_key_exists('VALUE', $val)) {
               $newobj[$key] = $val['VALUE'];
            } else {
               $newobj[$key] = parseCheckout($val, $level++);
            }
         }
      }
      return $newobj;
   }

   function newOrder($obj) {
      $boss = new boss("api.simpsf.com");
      if ($obj) {
         $email = $obj['BuyerBillingAddress']['Email'];
         
         $obj['MerchantData'] = $obj['ShoppingCart']['MerchantPrivateData'];
         $obj['Cart'] = json_encode($obj['ShoppingCart']);
         $obj['BuyerAddress'] = json_encode($obj['BuyerBillingAddress']);

         // First, lookup or create a new customer record
         $users = $boss->getObject('Customer', "Email=".$boss->q($email));
         $user = $users->Customer[0];
         
         if (!$user || !$user->SRSID) {
            $o = $obj['BuyerBillingAddress'];
            $parts = preg_split("/\s/", $o['ContactName'], 2);

            $srs = array(  "--TLD"=>"tv", 
                           "--FNAME"=>$parts[0], 
                           "--LNAME"=>$parts[1],
                           "--ORGANIZATION"=>'"'.$o['CompanyName'].'"',
                           "--EMAIL"=>'"'.$o['Email'].'"',
                           "--ADDRESS1"=>'"'.$o['Address1'].'"',
                           "--ADDRESS2"=>'"'.$o['Address2'].'"',
                           "--CITY"=>'"'.$o['City'].'"',
                           "--PROVINCE"=>'"'.$o['Region'].'"',
                           "--POSTAL CODE"=>$o['PostalCode'],
                           "--COUNTRY"=>'"'.$o['CountryCode'].'"',
                           "--PHONE"=>'"'.$o['Phone'].'"'
            );
            // TODO: Add call to new-contact
            $results = `{$_SERVER['DOCUMENT_ROOT']}/domains/srsplus/create-contact {$args}`;
            $srs = json_decode($results);

            if ($user->CustomerID) {
               $upd['Customer'][$user->CustomerID]['SRSID'] = $srs->SRSID;
               $ids = $boss->storeObject($upd);
            } else {

               // Email, ContactName, CompanyName, Address1, Address2, Phone, Fax, CountryCode, City, Region, PostalCode
               $new = array(
                  'Customer'=>array(
                     'new1'=>array(
                        'SRSID'        => $srs->SRSID,
                        'Email'        => $o['Email'],
                        'Customer'     => $o['ContactName'],
                        'CompanyName'  => $o['CompanyName'],
                        'Address1'     => $o['Address1'],
                        'Address2'     => $o['Address2'],
                        'Phone'        => $o['Phone'],
                        'Fax'          => $o['Fax'],
                        'Country'      => $o['CountryCode'],
                        'City'         => $o['City'],
                        'State'        => $o['Region'],
                        'ZipCode'      => $o['PostalCode']
                     )
                  )
               );
               
               $ids = $boss->storeObject($new);
               $user = $boss->getObject('Customer', $ids[0]);
            }
         }
            logger("/tmp/user.log", var_export($user, true));
         $domstr = preg_replace("/^domains:/", '', $obj['ShoppingCart']['MerchantPrivateData']);
         
         $obj['Checkout'] = "Domain Registration: " . preg_replace("/,/", ", ", $domstr);
         $obj['SRSID'] = $user->SRSID; 

         $new['Checkout']['new1'] = $obj;
         $cids = $boss->storeObject($new);
         $checkout = $boss->getObject('Checkout', $cids[0]);
         $checkoutID = $cids[0];

         $doms = explode(",", $domstr);
         
         // Now loop through each domain, creating an app workspace for each
         foreach ($doms as $dnsname) {
            // http://simpsf.com/site/wp-content/themes/simple/new.php?nomail=1&x=newapp&App=cdr50d.com&Name=Chris+Robison&Phone=415-555-1212&Email=cdr@cdr2.com&Client=Simple+Software&Password=qwerty&simple=1
            $c = $obj['BuyerBillingAddress'];
            $url = "http://simpsf.com/site/wp-content/themes/simple/new.php?nomail=1&seed=DNS&simple=1&x=newapp&App={$dnsname}&Name=";
            $url .= urlencode($c['ContactName']) . "&Phone=" . urlencode($c['Phone']) . "&Email=" . urlencode($c['Email']) . "&Client=" . urlencode($c['Company']) . "&Password=" . urlencode($c['PostalCode']) . "&Address=" . urlencode($c['Address1']) . "&Address2=" . urlencode($c['Address2']) . "&City=" . urlencode($c['City']) . "&Country=".urlencode($c['CountryCode'])."&Zip=".urlencode($c['PostalCode'])."&State=".urlencode($c['Region']);
            $results = file_get_contents($url);
            $appID = preg_replace("/^\w+\:/", '', $results);
            
            $cs = $boss->getObject("Checkout", "GoogleOrderNumber=" . $boss->q($obj['GoogleOrderNumber']));
            $c = $cs->Checkout[0];
            $newID = $c->AppID;
            if ($newID) $newID .= ",";
            $newID .= $appID;

            $upd2 = array();
            $upd2['Checkout'][$c->CheckoutID]['AppID'] = $newID;
            $boss->storeObject($upd2);
            logger("/tmp/updates.log", var_export($upd2, true));
            if (!file_exists('/mnt/simple/home/cdr/domains/dev.sscsf.com/base/clients/'.$dnsname)) {
               file_put_contents("/mnt/simple/hosts/.sysupdate/simple.ns", $appname."\n", FILE_APPEND);
            }
         }
      }
   }
?>
