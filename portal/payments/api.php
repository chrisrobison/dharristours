<?php
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/.env');
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/lib/auth.php');

    $in = $_REQUEST;
    $out = array();
    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");

    session_start();

    /* check connection */
    if (mysqli_connect_errno()) {
         printf("Connect failed: %s\n", mysqli_connect_error());
         exit();
    }

    $busID = (array_key_exists('busID', $in)) ? $in['busID'] : $_SESSION['Login']->BusinessID;

    if (array_key_exists("BusinessID", $_SESSION)) {
        $busID = $_SESSION['BusinessID'];
    }

    if (array_key_exists('x', $in) {
        switch($in['x']) {
            case "regCust":
                $out = registerCustomer($in);
                break;
        }
    }

/*

Example JSON to create new Square Customer:
  {
    "given_name": "Amelia",
    "family_name": "Earhart",
    "email_address": "Amelia.Earhart@example.com",
    "address": {
      "address_line_1": "500 Electric Ave",
      "address_line_2": "Suite 600",
      "locality": "New York",
      "administrative_district_level_1": "NY",
      "postal_code": "10003",
      "country": "US"
    },
    "phone_number": "+1-212-555-4240",
    "reference_id": "YOUR_REFERENCE_ID",
    "note": "a customer"
  }
*/
    function registerCustomer() {
        global $in;
        global $link;
        global $boss;
        
        var $obj;

        if (array_key_exists("BusinessID", $in)) {
            $obj = $boss->getObject("Business", $in['BusinessID']);
            $parts = preg_split("/\s/", $obj->Contact, 2);
            $obj->FirstName = $parts[0];
            $obj->LastName = $parts[1];
            $obj->_origin = "Business";
            $obj->id = $obj->BusinessID;
        }

        if ($obj) {
            $out = new stdClass();

            $out->given_name = $obj->FirstName;
            $out->family_name = $obj->LastName;
            $out->email_address = $obj->Email;
            $out->address = new stdClass();
            $out->address->address_line_1 = $obj->Address1;
            $out->address->address_line_2 = $obj->Address2;
            $out->address->locality = $obj->City;
            $out->address->administrative_district_level_1 = $obj->State;
            $out->address->postal_code = $obj->Zip;
            $out->address->country = "US";
            $out->phone_number = "+1"+ preg_replace("/\D/", "", $obj->Phone);
            $out->reference_id = $obj->_origin . ":" . $obj->id;

            print_r($out);
        }
    }

    /*
    '{
    "query": {
      "filter": {
        "email_address": {
          "exact": "user@example.com"
        },
        "creation_source": {
          "values": [
            "THIRD_PARTY"
          ],
          "rule": "INCLUDE"
        }
      },
      "sort": {
        "field": "CREATED_AT",
        "order": "ASC"
      }
    },
    "limit": 2
  }'
  */
    function searchCustomer($email="", $phone="", $id="") {
        global $in;
        global $link;
        global $boss;

        $out = new stdClass();
        $out->query = new stdClass();
        $out->query->filter = new stdClass();

        if ($email) {
            $out->query->filter->email_address = new stdClass();
            $out->query->filter->email_address->exact = $email;
        } else if ($phone) {
            $out->query->filter->phone_number = new stdClass();
            $out->query->filter->phone_number->exact = $phone;
        } else if ($id) {
            $out->query->filter->reference_id = new stdClass();
            $out->query->filter->reference_id->exact = $id;
        }

        $out->query->sort = new stdClass();
        $out->query->sort->field = "CREATED_AT";
        $out->query->sort->order = "ASC";
        $out->limit = 2;
        
        $json = escapeshellarg(json_encode($out, JSON_UNESCAPED_SLASHES));

        $json_results = `curl -s https://connect.squareup.com/v2/customers/search -X POST -H 'Square-Version: 2023-08-16' -H 'Authorization: Bearer EAAAED7CKByFBqyR1MXInO4l-iPbZc0H9bfgX-xpRgs9WQzRbWAKA_OJywV-XwIM' -H 'Content-Type: application/json' -d $json`;
        $results = json_decode($json_results);
        print_r($results);

        file_put_contents("/tmp/searchcust.log", $json_results);
    }
?>
