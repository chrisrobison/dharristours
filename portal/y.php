<?php
    include("/simple/lib/boss_class.php");

    //print date("Y-m-d", strtotime("30 days ago"))."\n";
    $boss = new boss("dharristours.simpsf.com");

    $x = $boss->getObjectRelated("Invoice", "Balance>0 and InvoiceDate<'2023-07-01' and InvoiceDate>'2023-01-01'");
    print_r($x);
?>
