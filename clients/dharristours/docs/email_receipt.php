<?php
include("/simple/lib/boss_class.php");

$boss = new boss("dharristours.simpsf.com");

$in = $_REQUEST;
$in['pid'] = 5;

if (isset($in['pid'])) {
    $payment = $boss->getObjectRelated("Payment", $in['pid']);
}
/*
InvoiceID JobID Name Email Phone Date JobDate PaymentDate Business QuoteAmount Amount Balance ADA RoundTrip Pax Shuttle Text
*/
$out = new stdClass();

$business = $boss->getObject("Business", $payment->BusinessID);

$out->Name = $business->AttnTo;
$out->Email = $business->Email;
$out->Phone = $business->Phone;
$out->PaymentDate = $payment->PaymentDate;
$out->Business = $business->Business;
$out->InvoiceIDs = preg_replace("/,/", ', ', $payment->InvoiceIDs);
$out->Amount = $payment->Amount;
$out->ADA = '';
$out->RoundTrip = '';
$out->Pax = '';
$out->Shuttle = '';
$out->Text = '';
$out->Balance = 0;

if ($payment->related_Invoice) {
    $tbl = <<<EOT
  <table class="tbl-details" style="font-size:14px;width:100%;margin-left:auto;margin-right:auto;border:2px solid #ccc;background-color:#eee;border-collapse:collapse;">
    <thead>
        <tr>
            <th class="tbl-head" style="background:#333;color:#fff;padding:0.25em;">Invoice ID</th>
            <th class="tbl-head" style="background:#333;color:#fff;padding:0.25em;">Job ID</th>
            <th class="tbl-head" style="background:#333;color:#fff;padding:0.25em;">Job</th>
            <th class="tbl-head" style="background:#333;color:#fff;padding:0.25em;">Due</th>
            <th class="tbl-head" style="background:#333;color:#fff;padding:0.25em;">Paid</th>
            <th class="tbl-head" style="background:#333;color:#fff;padding:0.25em;">Balance</th>
        </tr>
    </thead>
    <tbody>
EOT;
$rowtpl = <<<EOT
<tr>
    <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.5em;background-color:#fff;border-left:1px solid #0003;border-bottom:1px solid #0003;">{{InvoiceID}}</td>
    <td class="tbl-value" style="vertical-align:top;border-bottom:1px solid #0003;border-left:1px solid #0003;padding:0.5em;background-color:#fff;">{{JobID}}</td>
    <td class="tbl-label" style="text-align:left;vertical-align:top;padding:0.5em;background-color:#fff;border-left:1px solid #0003;border-bottom:1px solid #0003;">{{Job}}</td>
    <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.5em;background-color:#fff;border-left:1px solid #0003;border-bottom:1px solid #0003;">\${{InvoiceAmt}}</td>
    <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.5em;background-color:#fff;border-left:1px solid #0003;border-bottom:1px solid #0003;color:#900;">-\${{PaidAmt}}</td>
    <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.5em;background-color:#fff;border-left:1px solid #0003;border-bottom:1px solid #0003;">\${{Balance}}</td>
</tr>
EOT;
    $totpaid = 0; $totdue = 0; $totbal = 0;
    foreach ($payment->related_Invoice as $inv) {
        $job = $boss->getObject("Job", $inv->JobID);
        $inv->Job = $job->Job;
        $inv->JobDate = $job->JobDate;
        $inv->PaymentDate = $payment->PaymentDate;
        $totdue += $inv->InvoiceAmt;
        $totpaid += $inv->PaidAmt;
        $totbal += $inv->Balance;

        $tbl .= preg_replace_callback("/\{\{(\w+)\}\}/", function ($m) {
            global $inv;
            if (isset($inv->{$m[1]}) || ($inv->{$m[1]} == 0)) {
                if (preg_match("/Balance|PaidAmt|InvoiceAmt|Amount/", $m[1])) {
                return number_format($inv->{$m[1]}, 2);
                } else {
                    return $inv->{$m[1]};
                }
            } else {
                return "";
            }
        }, $rowtpl);

    }
    $out->TotalBalance = '$' .number_format($totbal, 2);
    $out->TotalDue = '$' .number_format($totdue, 2);
    $out->TotalPaid = '$' . number_format($totpaid, 2);

    $tbl .= preg_replace_callback("/\{\{(\w+)\}\}/", function($m) {
        global $out;
        if (isset($out->{$m[1]})) {
            return $out->{$m[1]};
        } else {
            return "";
        }
    }, "</tbody><tbody><tr><td colspan='3' style='text-align:right;font-size:16px;font-weight:bold;padding:0.5em'>Totals</td><td style='padding:0.5em;text-align:right;'>{{TotalDue}}</td><td style='padding:0.5em;text-align:right;'>{{TotalPaid}}</td><td style='padding:0.5em;text-align:right;'>{{TotalBalance}}</td></tbody></table>");
    $out->InvoiceList = $tbl;
}

$tpl = file_get_contents("email_receipt.html");

$tpl = preg_replace_callback("/\{\{(\w+)\}\}/", function($m) {
    global $out;
    if (isset($out->{$m[1]})) {
        if ($m[1] == "Amount") {
            return number_format($out->{$m[1]}, 2);
        } else {
            return $out->{$m[1]};
        }
    } else {
        return '';
    }
}, $tpl);
print $tpl;
?>
