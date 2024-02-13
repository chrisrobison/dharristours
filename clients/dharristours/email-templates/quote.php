<?php
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/.env');

    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");

    if (array_key_exists("id", $in)) {
        $sql = "select * from Request where RequestID='{$in['id']}'";
        $results = mysqli_query($link, $sql);
        $updates = array();

        $current = mysqli_fetch_object($results);
    }        
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>D Harris Tours Trip Notification</title>
    <link rel="stylesheet" href="main.css" />
</head>

<body bgcolor="#FFFFFF" style="">
    <table class="head-wrap" bgcolor="#999999" style="width:40rem;margin:0 auto;background-color:#999;">
        <tr>
            <td></td>
            <td class="header container">
                <div class="content" style="padding:15px;margin:0 auto;display:block;width:100vw;">
                    <table style="width:100%;background-color:#999;" bgcolor="#999999">
                        <tr>
                            <td><img src="https://dharristours.simpsf.com/files/img/logo-24.png" /></td>
                            <td align="right" style="text-align:right;">
                                <h2 style="text-shadow:1px 1px 0px black;color:#ffffff;text-transform:uppercase;font-weight:bold;margin:0;padding:0;">Quote</h2>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
            <td></td>
        </tr>
    </table>
    <table class="body-wrap" style="width:40rem;margin:0 auto;border:2px solid #ccc;background-color:#fff;">
        <tr>
            <td style="background:#fff">&nbsp;</td>
            <td class="container" bgcolor="#FFFFFF" style="display:block;max-width:600px;margin:0 auto;clear:both;">
                <div class="content" style="background:#fff;padding:15px;max-width:600px;margin:0 auto;display:block;">
                    <table style="width:100%">
                        <tr>
                            <td>
                                <h3>Quote for Trip on {{Date}}</h3>
                                <!-- From {{Pickup}} to {{Destination}} -->
                                <p style="font-size:17px;" class="lead">Please review your trip information and
                                    quote amount then confirm your reservation. </p>
                                <p>
                                    <hr>
                                    <h4 style="font-size:23px;font-weight:500;margin-bottom:0.25em;padding:0;color:#000;">Customer</h4>
                                    <table class="tbl-details" style="width:100%;margin-left:auto;margin-right:auto;border:1px solid #ccc;background-color:#eee;">
                                        <tr>
                                            <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Business</td>
                                            <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid $aaa;padding:0.25em;background-color:#fff;">{{Business}}</td>
                                        </tr>
                                        <tr>
                                            <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Contact</td>
                                            <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid $aaa;padding:0.25em;background-color:#fff;">{{Name}}</td>
                                        </tr>
                                        <tr>
                                            <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Email</td>
                                            <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid $aaa;padding:0.25em;background-color:#fff;">{{Email}}</td>
                                        </tr>
                                        <tr>
                                            <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Phone</td>
                                            <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid $aaa;padding:0.25em;background-color:#fff;">{{Phone}}</td>
                                        </tr>
                                    </table><br>
                                    <h4 style="font-size:23px;font-weight:500;margin-bottom:0.25em;padding:0;color:#000;">Trip</h4>
                                    <table class="tbl-details" style="width:100%;margin-left:auto;margin-right:auto;border:1px solid #ccc;background-color:#eee;">
                                        <tr>
                                            <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Trip Date</td>
                                            <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid $aaa;padding:0.25em;background-color:#fff;">{{Date}}</td>
                                            <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Pax</td>
                                            <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid $aaa;padding:0.25em;background-color:#fff;">{{Pax}}</td>
                                        </tr>
                                        <tr>
                                            <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Pickup</td>
                                            <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid $aaa;padding:0.25em;background-color:#fff;">{{Start}}</td>
                                            <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Drop Off</td>
                                            <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid $aaa;padding:0.25em;background-color:#fff;">{{End}}</td>
                                        </tr>
                                        <tr>
                                            <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Pickup Location</td>
                                            <td colspan="3" class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid $aaa;padding:0.25em;background-color:#fff;">{{SplitPickup}}</td>
                                        </tr>
                                        <tr>
                                            <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Drop Off Location</td>
                                            <td colspan="3" class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid $aaa;padding:0.25em;background-color:#fff;">{{SplitDestination}}</td>
                                        </tr>
                                        <tr>
                                            <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Round Trip</td>
                                            <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid $aaa;padding:0.25em;background-color:#fff;">{{RoundTrip}}</td>
                                            <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Shuttle</td>
                                            <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid $aaa;padding:0.25em;background-color:#fff;">{{Shuttle}}</td>
                                        </tr>
                                        <tr>
                                            <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">ADA</td>
                                            <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid $aaa;padding:0.25em;background-color:#fff;">{{ADA}}</td>
                                            <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Text</td>
                                            <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid $aaa;padding:0.25em;background-color:#fff;">{{Text}}</td>
                                        </tr>
                                    </table><br>
                                    <h4 style="font-size:23px;font-weight:500;margin-bottom:0.25em;padding:0;color:#000;">Quote</h4>
                                    <table class="tbl-details" style="border-collapse:collapse;width:100%;margin-left:auto;margin-right:auto;border:1px solid #ccc;background-color:#eee;">
                                        {{QuoteTable}}
                                    </table>
                                </p>
                                <p class="callout" style="text-align:center;padding:15px;background-color:#ecf8ff;margin-bottom:15px;max-width:600px;">
                                    <a style="font-size:1.5em;text-transform:uppercase;font-weight:bold;color:#2BA6CB;"
                                        href="https://dharristours.simpsf.com/files/confirm.php?z={{zquery}}">Click
                                        here to confirm your reservation</a><br>or visit:<br>
                                    <span style="margin-left:3em;">
                                        <a href="https://dharristours.simpsf.com/files/confirm.php?z={{zquery}}">https://dharristours.simpsf.com/files/confirm.php?z={{zquery}}</a>
                                    </span><br>
                                    in a web browser.
                                </p>
                                <table class="social" width="100%" style="background-color:#ebebeb;width:100%;">
                                    <tr>
                                        <td style="vertical-align:top;">
                                            <table align="left" class="column" style="width:280px;min-width:279px;float:left;">
                                                <tr>
                                                    <td>
                                                        <h5 style="font-weight:900;font-size:17px" class="">Visit Us Online:</h5>
                                                        <p class=""><a style="background-color:#1daced;padding: 3px 7px;font-size: 12px;margin-bottom: 10px;text-decoration: none;color: #FFF;font-weight: bold;display: block;text-align: center;" href="http://www.dharristours.com"
                                                                class="soc-btn tw">Website</a>
                                                            <a style="background-color:#1daced;padding: 3px 7px;font-size: 12px;margin-bottom: 10px;text-decoration: none;color: #FFF;font-weight: bold;display: block;text-align: center;" href="https://dharristours.simpsf.com/portal/"
                                                                class="soc-btn tw">Customer
                                                                Portal</a> <a style="background-color:#3b5998;padding: 3px 7px;font-size: 12px;margin-bottom: 10px;text-decoration: none;color: #FFF;font-weight: bold;display: block;text-align: center;" href="https://www.linkedin.com/company/dharristours/"
                                                                class="soc-btn fb">LinkedIn</a></p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table align="left" class="column" style="width:280px;min-width:279px;float:left;">
                                                <tr>
                                                    <td>
                                                        <h5 style="font-weight:900;font-size:17px" class="">Contact Info:</h5>
                                                        <p>
                                                            D Harris Tours, Inc.<br>
                                                            153 Utah Ave<br>
                                                            South San Francisco, CA 94080
                                                        </p>
                                                        <p>Phone: <strong>415.902.8542</strong><br />
                                                            Email: <strong><a href="emailto:juanaharrisdht@att.net">juanaharrisdht@att.net</a></strong></p>
                                                        <p>CA 273437<br>
                                                            TCP 017270-B</p>
                                                    </td>
                                                </tr>
                                            </table>
                                            <span class="clear"></span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
            <td></td>
        </tr>
    </table>
    <table class="footer-wrap" style="min-width:608px;">
        <tr>
            <td></td>
            <td class="container" style="width:100%">
                <div class="content" style="width:100%">
                    <table style="width:100%">
                        <tr>
                            <td align="center" style="text-align:center;">
                                <p>
                                    <a href="https://dharristours.simpsf.com/tos.html">Terms</a> &nbsp; | &nbsp;
                                    <a href="https://dharristours.simpsf.com/privacy.html">Privacy</a> &nbsp; | &nbsp;
                                    <a href="https://dharristours.simpsf.com/files/unsub.php?email={{Email}}">
                                        <unsubscribe>Unsubscribe</unsubscribe>
                                    </a>
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
            <td style="background:#fff">&nbsp;</td>
        </tr>
    </table>
</body>

</html>
