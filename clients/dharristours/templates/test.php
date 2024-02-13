<?php
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/.env');
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/lib/auth.php');

    $in = $_REQUEST;
    $out = array();
    $boss = new boss("dharristours.simpsf.com");
$recurse = new stdClass();
$recurse->Invoice = array();
$recurse->Invoice[] = 
    $y = $boss->getObjectRelated("Job", 32132);
print_r($y);
    $x = $boss->getObjectRelated("Invoice", 18730);
print_r($x);
    $out = $boss->getObjectRelated("InvoiceParent", 14);
    print "Hello";
    print_r($out);

?>
