<?php 
include("/simple/lib/auth.php");
$in = $_REQUEST;

if (isset($in['pid'])) {
    $payment = $boss->getObjectRelated("Payment", $in['pid']);
}
if (isset($in['invids'])) {
    $invids = preg_split("/,/", $in['invids']);
    $invoices = [];
    $jobs = [];
    foreach ($invids as $invid) {
        $inv = $boss->getObjectRelated("Invoice", $invid);

        if ($inv && $inv->JobID) {
            $job = $boss->getObjectRelated("Job", $inv->JobID);
        }
        $invoices[] = $inv;
        $jobs[] = $job;
    }
}

if (isset($in['bid'])) {
    $business = $boss->getObjectRelated("Business", $in['bid']);
}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>D Harris Tours Trip Notification</title>
<style>
* {
    margin: 0;
    padding: 0;
}

* {
    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
}

img {
    max-width: 100%;
}

.collapse {
    margin: 0;
    padding: 0;
}

body {
    -webkit-font-smoothing: antialiased;
    -webkit-text-size-adjust: none;
    width: 100% !important;
    height: 100%;
}

a {
    color: #2BA6CB;
}

.btn {
    text-decoration: none;
    color: #FFF;
    background-color: #666;
    padding: 10px 16px;
    font-weight: bold;
    margin-right: 10px;
    text-align: center;
    cursor: pointer;
    display: inline-block;
}

p.callout {
    padding: 15px;
    background-color: #ECF8FF;
    margin-bottom: 15px;
}

.callout a {
    font-weight: bold;
    color: #2BA6CB;
}

table.social {
    background-color: #ebebeb;
}

.social .soc-btn {
    padding: 3px 7px;
    font-size: 12px;
    margin-bottom: 10px;
    text-decoration: none;
    color: #FFF;
    font-weight: bold;
    display: block;
    text-align: center;
}

a.fb {
    background-color: #3B5998 !important;
}

a.tw {
    background-color: #1daced !important;
}

a.gp {
    background-color: #DB4A39 !important;
}

a.ms {
    background-color: #000 !important;
}

.sidebar .soc-btn {
    display: block;
    width: 100%;
}

table.head-wrap {
    width: 100%;
}

.header.container table td.logo {
    padding: 15px;
}

.header.container table td.label {
    padding: 15px;
    padding-left: 0px;
}

table.body-wrap {
    width: 100%;
}

table.footer-wrap {
    width: 100%;
    clear: both !important;
}

.footer-wrap .container td.content p {
    border-top: 1px solid rgb(215, 215, 215);
    padding-top: 15px;
}

.footer-wrap .container td.content p {
    font-size: 10px;
    font-weight: bold;
}

h1,
h2,
h3,
h4,
h5,
h6 {
    font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
    line-height: 1.1;
    margin-bottom: 15px;
    color: #000;
}

h1 small,
h2 small,
h3 small,
h4 small,
h5 small,
h6 small {
    font-size: 60%;
    color: #6f6f6f;
    line-height: 0;
    text-transform: none;
}

h1 {
    font-weight: 200;
    font-size: 44px;
}

h2 {
    font-weight: 200;
    font-size: 37px;
}

h3 {
    font-weight: 500;
    font-size: 27px;
}

h4 {
    font-weight: 500;
    font-size: 23px;
}

h5 {
    font-weight: 900;
    font-size: 17px;
}

h6 {
    font-weight: 900;
    font-size: 14px;
    text-transform: uppercase;
    color: #444;
}

.collapse {
    margin: 0 !important;
}

p,
ul {
    margin-bottom: 10px;
    font-weight: normal;
    font-size: 14px;
    line-height: 1.6;
}

p.lead {
    font-size: 17px;
}

p.last {
    margin-bottom: 0px;
}

ul li {
    margin-left: 5px;
    list-style-position: inside;
}

ul.sidebar {
    background: #ebebeb;
    display: block;
    list-style-type: none;
}

ul.sidebar li {
    display: block;
    margin: 0;
}

ul.sidebar li a {
    text-decoration: none;
    color: #666;
    padding: 10px 16px;
    margin-right: 10px;
    cursor: pointer;
    border-bottom: 1px solid #777777;
    border-top: 1px solid #FFFFFF;
    display: block;
    margin: 0;
}

ul.sidebar li a.last {
    border-bottom-width: 0px;
}

ul.sidebar li a h1,
ul.sidebar li a h2,
ul.sidebar li a h3,
ul.sidebar li a h4,
ul.sidebar li a h5,
ul.sidebar li a h6,
ul.sidebar li a p {
    margin-bottom: 0 !important;
}

.container {
    display: block !important;
    max-width: 600px !important;
    margin: 0 auto !important;
    clear: both !important;
}

.content {
    padding: 15px;
    max-width: 600px;
    margin: 0 auto;
    display: block;
}

.content table {
    width: 100%;
}

.column {
    width: 300px;
    float: left;
}

.column tr td {
    padding: 15px;
}

.column-wrap {
    padding: 0 !important;
    margin: 0 auto;
    max-width: 600px !important;
}

.column table {
    width: 100%;
}

.social .column {
    width: 280px;
    min-width: 279px;
    float: left;
}

.clear {
    display: block;
    clear: both;
}

@media only screen and (max-width: 600px) {
    a[class="btn"] {
        display: block !important;
        margin-bottom: 10px !important;
        background-image: none !important;
        margin-right: 0 !important;
    }

    div[class="column"] {
        width: auto !important;
        float: none !important;
    }

    table.social div[class="column"] {
        width: auto !important;
    }
}

.tbl-label {
    text-align: right;
    vertical-align: top;
    padding: .25em;
    background-color: #eee;
}

.tbl-value {
    vertical-align: top;
    border-top: 1px solid #aaa;
    border-left: 1px solid #aaa;
    padding: .25em;
    background-color: #fff;
}

.tbl-details {
    width: 90%;
    margin-left: auto;
    margin-right: auto;
    border: 1px solid #ccc;
    background-color: #eee;
}

h4 {
    margin-bottom: .25em;
    padding: 0;
}
</style>
</head>

<body bgcolor="#FFFFFF">
  <table class="head-wrap" bgcolor="#999999" style="width:100%;background-color:#999;">
    <tr>
      <td></td>
      <td class="header container">
        <div class="content" style="padding:15px;margin:0 auto;display:block;width:100vw;">
          <table style="width:100%;background-color:#999;" bgcolor="#999999">
            <tr>
              <td><img src="https://dharristours.simpsf.com/files/img/logo-24.png" /></td>
              <td align="right" style="text-align:right;">
                <h2 style="text-shadow:1px 1px 0px black;color:#ffffff;text-transform:uppercase;font-weight:bold;margin:0;padding:0;">Subject</h2>
              </td>
            </tr>
          </table>
        </div>
      </td>
      <td></td>
    </tr>
  </table>
  <table class="body-wrap" style="width:100%">
    <tr>
      <td></td>
      <td class="container" bgcolor="#FFFFFF" style="display:block;max-width:600px;margin:0 auto;clear:both;">
        <div class="content" style="padding:15px;max-width:600px;margin:0 auto;display:block;">
          <table style="width:100%">
            <tr>
              <td>
                <h3>Main Title</h3>
                <p style="font-size:17px;" class="lead">REPLACE THIS TEXT WITH YOUR MESSAGE.</p>
                <p style="font-size:17px;" class="lead">If you have any questions, feedback or concerns, feel free to contact us anytime. We'd love to hear from you!</p>
                <p>
                  <hr>
                  <h4 style="font-size:23px;font-weight:500;margin-bottom:0.25em;padding:0;color:#000;">Customer</h4>
                  <table class="tbl-details" style="width:100%;margin-left:auto;margin-right:auto;border:1px solid #ccc;background-color:#eee;">
                    <tr>
                      <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Business</td>
                      <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid #aaa;padding:0.25em;background-color:#fff;">{{Business}}</td>
                    </tr>
                    <tr>
                      <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Contact</td>
                      <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid #aaa;padding:0.25em;background-color:#fff;">{{Name}}</td>
                    </tr>
                    <tr>
                      <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Email</td>
                      <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid #aaa;padding:0.25em;background-color:#fff;">{{Email}}</td>
                    </tr>
                    <tr>
                      <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Phone</td>
                      <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid #aaa;padding:0.25em;background-color:#fff;">{{Phone}}</td>
                    </tr>
                  </table><br>
                  <h4 style="font-size:23px;font-weight:500;margin-bottom:0.25em;padding:0;color:#000;">Trip</h4>
                  <table class="tbl-details" style="width:100%;margin-left:auto;margin-right:auto;border:1px solid #ccc;background-color:#eee;">
                    <tr>
                      <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Trip Date</td>
                      <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid #aaa;padding:0.25em;background-color:#fff;">{{Date}}</td>
                      <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Pax</td>
                      <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid #aaa;padding:0.25em;background-color:#fff;">{{Pax}}</td>
                    </tr>
                    <tr>
                      <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Pickup</td>
                      <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid #aaa;padding:0.25em;background-color:#fff;">{{Start}}</td>
                      <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Drop Off</td>
                      <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid #aaa;padding:0.25em;background-color:#fff;">{{End}}</td>
                    </tr>
                    <tr>
                      <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Pickup Location</td>
                      <td colspan="3" class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid #aaa;padding:0.25em;background-color:#fff;">{{SplitPickup}}</td>
                    </tr>
                    <tr>
                      <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Drop Off Location</td>
                      <td colspan="3" class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid #aaa;padding:0.25em;background-color:#fff;">{{SplitDestination}}</td>
                    </tr>
                    <tr>
                      <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Round Trip</td>
                      <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid #aaa;padding:0.25em;background-color:#fff;">{{RoundTrip}}</td>
                      <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Shuttle</td>
                      <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid #aaa;padding:0.25em;background-color:#fff;">{{Shuttle}}</td>
                    </tr>
                    <tr>
                      <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">ADA</td>
                      <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid #aaa;padding:0.25em;background-color:#fff;">{{ADA}}</td>
                      <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Text</td>
                      <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid #aaa;padding:0.25em;background-color:#fff;">{{Text}}</td>
                    </tr>
                  </table><br>
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
                              2294 Vista del Rio St<br>
                              Crockett, CA 94525
                            </p>
                            <p>Phone: <strong>(415) 902-8542</strong><br />
                              Email: <strong><a href="mailto:juanaharrisdht@att.net">juanaharrisdht@att.net</a></strong></p>
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
                  <a href="#">Terms</a> &nbsp; | &nbsp;
                  <a href="#">Privacy</a> &nbsp; | &nbsp;
                  <a href="https://dharristours.simpsf.com/files/unsub.php?email={{Email}}">
                    <unsubscribe>Unsubscribe</unsubscribe>
                  </a>
                </p>
              </td>
            </tr>
          </table>
        </div>
      </td>
      <td></td>
    </tr>
  </table>
</body>

</html>
