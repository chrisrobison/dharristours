<?php
include("/simple/lib/boss_class.php");
$boss = new boss("dharristours.simpsf.com");

$json = '{"Payment": { "7": { "Payment": "Test Payment - Ignore", "Invoice": { "19455": { "InvoiceID": 19455, "Description":"Testing" } } } } }';

$x = json_decode($json);


print_r($x);

$result = $boss->storeObject($x);
print_r($result);

$obj = $boss->getObjectRelated("Payment", 7);
print_r($obj);

