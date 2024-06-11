<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/lib/auth.php");
$boss = new boss($_SERVER['SERVER_NAME']);
/** 
 * JobToPrint.php
 *
 * Tool to view and email invoices, driver logs, confirmations, and sub logs
 * 
 * The following options may be passed via query string parameters:
 *
 *    ID [int]          - JobID to work with (REQUIRED)
 *    create [0|1]      - Generate static invoice file
 *    force  [0|1]      - Force saving of invoice file, even if one exists
 *
 **/
if ($in['z']) {
   $qs = base64_decode($in['z']);

   $qs = preg_replace("/#.*/", "", $qs);
   $parts = explode('&', $qs);
   $cnt = count($parts);

   for ($i = 0; $i < $cnt; $i++) {
      list($key, $val) = preg_split("/=/", $parts[$i]);
      $in[urldecode($key)] = urldecode($val);
   }
}
$arrContextOptions = array(
   "ssl" => array(
      "verify_peer" => false,
      "verify_peer_name" => false,
   )
);

$in['Resource'] = "Job";
$in['ID'] = $in['ID'] ? $in['ID'] : 0;
$boss->addResource("Job");
if ($in['x'] == "massinvoice") {
   $out = array("results" => array(), "_ids" => array());
   if (isset ($in['JobIDs'])) {
      $ids = json_decode($in['JobIDs']);
      foreach ($ids as $id) {
         $boss->db->Job->execute("CALL JobToInvoice({$id}, '{$_SESSION['Login']->Email}', @InvoiceID)");
         $boss->db->Job->execute("SELECT @InvoiceID");
         $rec = $boss->getObjectRelated('Job', $id);
         $invID = $rec->related_Invoice[0]->InvoiceID;
         $parent_id = $rec->related_Invoice[0]->InvoiceParentID;

         if ($invID) {
            $obj = new stdClass();
            $obj->JobID = $id;
            $obj->InvoiceID = $invID;
            $obj->InvoiceParentID = $parent_id;

            $out["_ids"][] = $obj;
         }
         $base = (($_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
         $url = $base . '/files/templates/print/InvoiceReport.php?ID=' . $invID;
         $file = $invID . '.html';

         $invoice = file_get_contents($url, false, stream_context_create($arrContextOptions));
         $path = $_SERVER['DOCUMENT_ROOT'] . $boss->app->Assets . '/invoices/';
         $save = $path . $file;
         $cnt = 0;
         while (file_exists($save)) {
            ++$cnt;
            $file = $invID . '-' . $cnt . '.html';
            $save = $path . $file;

         }

         if (!file_exists($save) || $in['force']) {
            file_put_contents($save, $invoice);
            $showname = preg_replace("|/home/cdr/simple/clients/dharristours/|", '/files/', $save);

            $out["results"][] = "Invoice generated for Invoice ID {$id} [$showname]";

         }

      }
   }
   header("Content-Type: application/json");
   print json_encode($out);
   exit;
}

if ($in['ID']) {
   $boss->db->Job->execute("SELECT JobID, Job from Job where JobID='{$in['ID']}'"); // ((JobDate > CURDATE()) or (JobDate < (CURDATE() + INTERVAL 2 MONTH))) or JobID not in (select JobID from Invoice) OR (JobID='{$in['ID']}') order by LastModified desc");
   $job = mysql_fetch_assoc($boss->db->Job->result);
   if ($in['x'] == "create") {
      // Call a stored procedure passing in the ID of the record just created
      $boss->db->Job->execute("CALL JobToInvoice({$in['ID']},'{$_SESSION['Login']->Email}',@InvoiceID)");//QuoteToJob($id,$_SESSION['Login']->Email,$results['JobID']);
      $boss->db->Job->execute("SELECT @InvoiceID");

   }

   $record = $current = $boss->getObjectRelated('Job', $in['ID']);
   $business = $boss->getObjectRelated("Business", $current->BusinessID);
   if ($current->EmployeeID)
      $employee = $boss->getObjectRelated("Employee", $current->EmployeeID);

   $InvID = $current->related_Invoice[0]->InvoiceID;
   $parent_id = $current->related_Invoice[0]->InvoiceParentID;

   $base = (($_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
   $url = $base . '/files/templates/print/InvoiceReport.php?ID=' . $InvID;
   $file = $InvID . '.html';

   if ($in['x'] == "create") {
      $invoice = file_get_contents($url, false, stream_context_create($arrContextOptions));
      $path = $_SERVER['DOCUMENT_ROOT'] . $boss->app->Assets . '/invoices/';
      $save = $path . $file;
      $cnt = 0;
      if (file_exists($save)) {
         if (!is_link($save) && (!file_exists($path . $InvID . '-1.html'))) {
            $new = $path . $InvID . '-1.html';
            rename($save, $new);
            symlink($new, $save);
            $save = $new;
         }
   
         while (file_exists($save)) {
            ++$cnt;
            $file = $InvID . '-' . $cnt . '.html';
            $save = $path . $file;
         }
         if (is_link($path . $InvID . '.html')) {
            unlink($path . $InvID . '.html');
            symlink($save, $path . $InvID . '.html');
         }
      }

      if (!file_exists($save) || $in['force']) {
         file_put_contents($save, $invoice);
      }
   }

   $static = $base . '/files/invoices/' . $InvID . '.html';
}
?>
<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <title></title>
   <link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
   <style>
      body {
         margin: 0;
         padding: 0;
         font-size: 18px;
         font-family: "Open Sans", sans-serif;
      }

      .flex-container {
         display: flex;
         flex-direction: column;
         min-height: 100vh;
      }

      section.content {
         flex: 1;
         background-color: #3F51B5;
         color: #fff;
         padding: .5em .5em;
      }

      h1,
      h2,
      h3,
      h4,
      h5 {
         font-family: "Open Sans", "Helvetica Neue", Optima, Verdana, sans-serif;
      }

      a {
         text-decoration: none;
         color: #00c;
      }

      a:hover {
         text-decoration: underline;
      }

      a:visited {
         color: #006;
      }

      a:active {
         color: #e00;
         display: inline-block;
         top: 2px;
      }

      #main {
         margin: 1em;
      }

      #toolbar {
         position: absolute;
         float: top;
         top: 0px;
         left: 0px;
         width: 100%;
         height: 3em;
         background-color: #000;
         color: #fff;
         font-size: 1.3em;
         padding: .5em 0;
      }

      #viewWrap {
         background: #fff;
         position: absolute;
         top: 6.25rem;
         left: 0px;
         width: 100%;
         bottom: 0px;
         right: 0px;
      }

      button,
      input,
      select,
      option {
         font-family: "Open Sans", sans-serif;
         font-size: 1em;
      }

      th.field {
         white-space: nowrap;
      }

      .alertText {
         background: rgb(153, 0, 0);
         color: rgb(255, 255, 255);
      }

      label {
         width: 9rem;
         text-align: right;
         display: inline-block;
      }
      .invoice-icon {
         display: inline-block;
            height: 1rem;
            width: 1rem;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: 0px 0px;
            content: " ";
      }
      button {
         color: #333;
      }
   </style>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
   <div class="flex-container">
      <section class="content">
         <form method='post'>
            <span style='float:left;padding:0 .125em;'><label>Job ID: </label>
               <span class='val'>
                  <input type='text' id="ID" style='width:5em' value='<?php print $in['ID']; ?>'><button onclick="location.href='/files/templates/JobToPrint.php?ID='+document.querySelector('#ID').value;return false;" id='lookup'>Lookup</button> <span id='job-title' class='val'>
                     <?php print $job['Job']; ?>
                  </span>
               </span>
            </span>
            <span id='emailWrap' style='float:right;' <?php if (!$InvID) print " disabled='true'"; ?>>
               <!-- Email fields -->
               <input type='hidden' id='x' name='x' value=''>
               <input type='hidden' id='Subject' name='Subject' value='[Invoice] <?php print $current->Job; ?>'>
               <input type='hidden' id='Url' name='Url' value='<?= $static ?>'>
               <input type='hidden' id='InvoiceID' name='InvoiceID'
                  value='<?= $current->related_Invoice[0]->InvoiceID ?>'>
               <input type='hidden' id='InvoiceParentID' name='InvoiceParentID' value='<?= $current->related_Invoice[0]->InvoiceParentID ?>'>
               <input type='hidden' id='Cc' name='Cc' value='juanaharrisdht@att.net'>
               <input type='hidden' id='type' name='type' value=''>
               <span>Send to: <input type="text" autocomplete="off" id="To" name="To" style='width:15em;'
                     value="<?php 
                     print (isset($business->BillEmail)) ? $business->BillEmail : $business->Email; ?>">
                  <button class='sendpdf'><i class="fa-solid fa-file-pdf"></i> Email PDF</button>
                  <button class='sendmsg'>Email Link</button>
               </span>
            </span>
            <div style='clear:left'>
               <label>Document: </label>
               <select id='what' name="what" style='width:10em'>
                  <option value=''>--Select Document--</option>
                  <option data-id='<?= $parent_id ?>' data-type='MasterInvoice' <?php if (!$parent_id) print " disabled='true'"; ?> value='MasterInvoice'>Master Invoice [ <?= $parent_id ?>] </option>
                  <option data-id='<?= $InvID ?>' data-type='InvoiceReport' <?php if (!$InvID) print " disabled='true'"; ?> value='InvoiceReport'>Invoice [ <?= $InvID ?>] </option>
                  <option value='DriverLog'>Driver Trip</option>
                  <option value='Confirmation'>Confirmation</option>
                  <option value='DriverLogExternal'>Subcontractor Log</option>
               </select>
               <button class='view' style='margin-right:2em;'>View</button>

            </div>
            <span style='padding-left:1em;'>
               <span style='padding:0 2em;'><label id="doctype">
                     <?php

                     ?>Invoice:
                  </label> <span id="docval" class='val'>
                     <?php print $current->related_Invoice[0]->InvoiceID; ?>
                  </span> 
               </span>
               <button class='geninvoice'>
                  <i class="fa-solid fa-file-invoice-dollar"></i>
                  <span id="curdoc"></span>
               </button>
               <button class='print'><i class="fa-solid fa-print"></i> Print</button>
               <button class='print sendmsg'>Print &amp; Email</button>
               <button id='mkpdf'><i class="fa-solid fa-file-pdf"></i> Make PDF</button>
            </span>
         </form>
   </div>
   </section>
   <div id='viewWrap'>
      <iframe id='viewer' width='100%' height='100%'></iframe>
   </div>
</body>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js" integrity="sha512-01CJ9/g7e8cUmY0DFTMcUw/ikS799FHiOA0eyHsUWfOetgbx/t6oV4otQ5zXKQyIrQGTHSmRVPIgrgLcZi/WMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type='text/javascript'>
   var session = <?php print json_encode($_SESSION); ?>;
   var simple = {};
   $(document).ready(function () {
      simple = {
         current: <?php
         if ($current) {
            print json_encode($current, JSON_INVALID_UTF8_IGNORE | JSON_PARTIAL_OUTPUT_ON_ERROR);
         } else {
            print "{JobID: ''}";
         }
         ?>,
         <?php if ($employee)
            print "employee: " . json_encode($employee) . ",\n"; ?>
            <?php if ($business)
               print "business: " . json_encode($business) . ",\n"; ?>
            InvoiceID: "<?php print $InvID; ?>",
         InvoiceParentID: "<?php print $parent_id; ?>",
         InvoiceUrl: "<?= $static ?>",
         Url: "<?= $url ?>"
      };
      simple.options = {
         MasterInvoice: {
            href: "MasterInvoice.php?z=" + btoa("ID=" + simple.InvoiceParentID),
            email: (simple.business && simple.business.BillEmail) ? simple.business.BillEmail : simple.business.Email
         },
         InvoiceReport: {
            href: "InvoiceReport.php?z=" + btoa("ID=" + simple.InvoiceID),
            email: (simple.business && simple.business.BillEmail) ? simple.business.BillEmail : simple.business.Email
         },
         Confirmation: {
            href: "Confirmation.php?z=" + btoa("ID=" + simple.current.JobID),
            email: (simple.business && simple.business.BillEmail) ? simple.business.BillEmail : simple.business.Email
         },
         DriverLog: {
            href: "DriverLog.php?z=" + btoa("ID=" + simple.current.JobID),
            email: (simple.employee && simple.employee.Email) ? simple.employee.Email : ""
         },
         DriverLogExternal: {
            href: "DriverLogExternal.php?z=" + btoa("ID=" + simple.current.JobID),
            email: (simple.employee && simple.employee.Email) ? simple.employee.Email : ""
         }
      };


      $("form").submit(function (e) {
         e.preventDefault();
         e.stopPropagation();
         return false;
      });

      $("#ID").change(function (e) { document.location.href = "/files/templates/JobToPrint.php?z=" + btoa("ID=" + $("#ID").val()); });
      $("#lookup").click(function (e) { document.location.href = "/files/templates/JobToPrint.php?z=" + btoa("ID=" + $("#ID").val()); });

      $("#what").change(function (e) {
         var curdoc = $(this).val() || "InvoiceReport";
         let showdoc = curdoc.replace(/([a-z])([A-Z])/g, "$1 $2");
         $("#Url").val("https://" + location.host + "/files/templates/" + simple.options[curdoc].href);
         $("#Subject").val('[' + showdoc + '] ' + simple.current['Job']);

         let m;
         
         let sendto = [ simple.options[curdoc].email.replace(/\s/g, '') ];
         if (simple.current.sendInvoiceTo) {
            sendto.push(simple.current.sendInvoiceTo);
         }
         if (simple.current.SpecialInstructions && (m = simple.current.SpecialInstructions.match(/(\S*@\S*)/))) {
            if (!sendto.includes(m[1])) sendto.push(m[1]);
         }

         if (simple.current.Description && (m = simple.current.Description.match(/(\S*@\S*)/))) {
            if (!sendto.includes(m[1])) sendto.push(m[1]);
         }

         if (m = simple.current.ContactEmail.match(/(\S*\@\S*)/)) {
            if (!sendto.includes(simple.current.ContactEmail.replace(/\s*/g,''))) {
               sendto.push(simple.current.ContactEmail);
            }
         }
         document.querySelector("#curdoc").innerHTML = "Update " + showdoc;
         $("#To").val(sendto.join(","));

         localStorage.setItem('curdoc', curdoc);
         window.location.hash = "#" + curdoc;
         viewDoc(curdoc);
      });

      $("#mkpdf").click(function (e) {
         let what = document.querySelector("#what").value;
         let id;

         if (what === "MasterInvoice") {
            genPDF("MasterInvoice", $("#InvoiceParentID").val());
         } else if (what === "InvoiceReport") {
            genPDF("InvoiceReport", $("#ID").val());
         } else if (what === "Confirmation") {
            genPDF("Confirmation", $("#ID").val());
         } else {
            genPDF(what, document.querySelector("#ID").value);
         }
         e.stopPropagation();
         e.preventDefault();
         return false;
      });

      $("button.geninvoice").click(function (e) {
         $("#x").val("create");
         var frm = $("form").serialize();
         $.post("/files/templates/JobToPrint.php?ID=" + $("#ID").val(), frm, function (data) {
            console.log("geninvoice results");
            console.dir(data);
            let ty = (simple.InvoiceID) ? "UPDATED " : "CREATED ";

            alert("Invoice " + ty + "for [" + $("#ID").val() + "] " + document.querySelector("#job-title").innerHTML + ".");
            let what = document.querySelector("#what").value;
            let conf = simple.options[what];

            document.location.reload();
         })
      });

      $("button.sendmsg").click(function (e) {
         if (confirm("Email URL " + $("#Url").val() + " to " + $("#To").val() + "?")) {
            var frm = $("form").serialize();
            $.post("/emailurl.php", frm, function (data) {
               //alert("Email sent to " + $("#To").val() + " for URL " + $("#Url").val());
            });
         }
         e.preventDefault();
         e.stopPropagation();
         return false;
      });

      $("button.sendpdf").click(function (e) {
         let doc = document.querySelector("#what").value;
         switch (doc) {
            case "InvoiceReport":
               genPDF("InvoiceReport", $("#InvoiceID").val());
               document.querySelector("#type").value = "InvoiceReport";
               if (confirm("Email INVOICE " + $("#InvoiceID").val() + ".pdf to " + $("#To").val() + "?")) {
                  var frm = $("form").serialize();
                  console.dir(frm);
                  fetch("/emailpdf.php", {
                     method: "POST",
                     headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                     },
                     redirect: "follow",
                     body: frm
                  }).then(r => r.json()).then(data => {
                     console.log(`sendpdf fetch complete`);
                     console.dir(data);

                     alert("Email sent to " + $("#To").val() + " and Invoice ID " + $("#InvoiceID").val() + " marked as sent.");
                     markInvoiceSent($("#InvoiceID").val());

                  });
               }
               break;
            case "MasterInvoice":
               document.querySelector("#type").value = "MasterInvoice";
               genPDF("MasterInvoice", $("#InvoiceParentID").val());
               if (confirm("Email MASTER INVOICE M" + $("#InvoiceParentID").val() + ".pdf to " + $("#To").val() + "?")) {
                  var frm = $("form").serialize();
                  console.dir(frm);
                  fetch("/emailpdf.php", {
                     method: "POST",
                     headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                     },
                     redirect: "follow",
                     body: frm
                  }).then(r => r.json()).then(data => {
                     console.log(`sendpdf fetch complete`);
                     console.dir(data);

                     alert(`Master Invoice ID ${$('#InvoiceParentID').val()} emailed to ${$("#To").val()}`);

                  });
               }
                break;
 
            case "Confirmation":
               document.querySelector("#type").value = "Confirmation";
               genPDF("Confirmation", $("#ID").val());
               if (confirm("Confirmation: Send " + $("#ID").val() + "C.pdf to " + $("#To").val() + "?")) {
                  var frm = $("form").serialize();
                  console.dir(frm);
                  fetch(`/emailpdf.php?ID=${document.querySelector('#ID').value}`, {
                     method: "POST",
                     headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                     },
                     redirect: "follow",
                     body: frm
                  }).then(r => r.json()).then(data => {
                     console.log(`sendpdf fetch complete`);
                     console.dir(data);

                     alert(`Confirmation: DL${$('#ID').val()}.pdf emailed to ${$("#To").val()}`);

                  });
               }
                break;
             case "DriverLog":
               document.querySelector("#type").value = "DriverLog";
               genPDF("DriverLog", $("#ID").val());
               if (confirm("Email Driver Log: DL" + $("#ID").val() + ".pdf to " + $("#To").val() + "?")) {
                  var frm = $("form").serialize();
                  console.dir(frm);
                  fetch("/emailpdf.php", {
                     method: "POST",
                     headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                     },
                     redirect: "follow",
                     body: frm
                  }).then(r => r.json()).then(data => {
                     console.log(`sendpdf fetch complete`);
                     console.dir(data);

                     // alert(`Driver Log: DL${$('#ID').val()}.pdf emailed to ${$("#To").val()}`);

                  });
               }
                break;
             case "DriverLogExternal":
               document.querySelector("#type").value = "DriverLogExternal";
               genPDF("DriverLogExternal", $("#ID").val());
               if (confirm("Email 'Contractor Driver Log': " + $("#ID").val() + "-CL.pdf to " + $("#To").val() + "?")) {
                  var frm = $("form").serialize();
                  console.dir(frm);
                  fetch("/emailpdf.php", {
                     method: "POST",
                     headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                     },
                     redirect: "follow",
                     body: frm
                  }).then(r => r.json()).then(data => {
                     console.log(`sendpdf fetch complete`);
                     console.dir(data);

                     // alert(`Driver Log: DL${$('#ID').val()}.pdf emailed to ${$("#To").val()}`);

                  });
               }
                break;
          }
         e.preventDefault();
         e.stopPropagation();
         return false;
      });

      $("button.view").click(function (e) {
         viewDoc();
         e.stopPropagation();
         e.preventDefault();
         return false;
      });

      $("button.print").click(function (e) {
         document.querySelector("#viewer").contentWindow.print();

         e.stopPropagation();
         e.preventDefault();
         return false;
      });

      if (location.hash) {
         var curdoc = location.hash.replace(/#/, '');
         localStorage.setItem('curdoc', curdoc);
         $("#what").val(curdoc).change();
      }

      var chkdoc = localStorage.getItem('curdoc');
      if (chkdoc) {
         $("#what").val(chkdoc);
         viewDoc(chkdoc);
      }
      async function genPDF(what = "InvoiceReport", id) {
         if (id) {
            let query, arg;

            switch (what) {

               case "MasterInvoice":
                  let resp = await fetch(`/portal/api.php?type=getMasterInvoice&id=${id}`);
                  let json = await resp.json();

                  let invoice_ids = json.InvoiceIDs.split(/,/);
                  console.log(`Job IDs: ${json.JobIDs}  InvoiceIDs: ${json.InvoiceIDs}        `);
                  arg = document.location.origin + "/files/templates/MasterInvoice.php?ID=" + id;
                  arg = encodeURIComponent(arg);
                  query = "type=MasterInvoice&saveto=invoices/&ID=" + id + "&url=" + arg +"&pages=" + invoice_ids.join(',');
                  
                  break;
               case "InvoiceReport":
                  arg = document.location.origin + "/files/templates/InvoiceReport.php?ID=" + simple.InvoiceID;
                  arg = encodeURIComponent(arg);
                  query = "type=InvoiceReport&saveto=invoices/&ID=" + simple.InvoiceID + "&url=" + arg;
                  
                  break;
               case "Confirmation":
                  arg = document.location.origin + "/files/templates/Confirmation.php?ID=" + document.querySelector("#ID").value;
                  arg = encodeURIComponent(arg);
                  query = "type=Confirmation&saveto=confirmations/&ID=" + id + "&url=" + arg;
                  
                  break;
               case "DriverLog":
                  arg = document.location.origin + "/files/templates/DriverLog.php?ID=" + document.querySelector("#ID").value;
                  arg = encodeURIComponent(arg);
                  query = "type=DriverLog&saveto=driver-logs/DL&ID=" + id + "&url=" + arg;

                  break;
               case "DriverLogExternal":
                  arg = document.location.origin + "/files/templates/" + simple.options.DriverLogExternal.href;
                  arg =encodeURIComponent(arg);
                  query = "type=DriverLogExternal&saveto=driver-logs/DL&ID=" + id + "&url=" + arg;
                  break;
            }
            let url = `/tools/mkpdf/?${query}`;
            console.log("Generating PDF with following url: "+url);
            document.querySelector("#viewer").src = url;

            /* 
            fetch(url).then(r => r.text()).then(text => {
               console.log("genPDF results");
               // console.dir(text);
               document.querySelector("#viewer").src = "about:blank";
               let viewer = document.querySelector("#viewer").contentWindow.document;
               viewer.open();
               viewer.write(text);
               viewer.close();
            });
            */      
         }
      }

      function viewDoc(what) {
         if (!what) {
            what = $("#what").val();
         }
         var id;
      
         let showdoc = what.replace(/([a-z])([A-Z])/g, "$1 $2");
         if (what == "InvoiceReport") {
            document.querySelector("#doctype").innerHTML = "Invoice: &nbsp;";
            document.querySelector("#docval").innerHTML = "<?= $InvID ?>";
            id = "<?= $InvID ?>";
         } else if (what == "MasterInvoice") {
            document.querySelector("#doctype").innerHTML = "Master Invoice: &nbsp;";
            document.querySelector("#docval").innerHTML = "<?= $parent_id ?>";

            id = "<?= $parent_id ?>";
         } else {
            document.querySelector("#doctype").innerHTML = showdoc + ': &nbsp;';
            document.querySelector("#docval").innerHTML = "<?= $in['ID'] ?>";
            id = "<?= $in['ID'] ?>";
         }
         //url = "/files/templates/" + what + ".php?z=" + btoa("ID=" + id);
         //url = "/files/templates/" + what + ".php?ID=" + id;
         url = "/files/templates/" + simple.options[what].href;
         $("#viewer").attr("src", url);

      }

      async function markMasterInvoiceSent(id) {
         const raw = await fetch(`/api.php?rsc=Invoice&id=${id}`);
         const json = await raw.json();
         const now = new Date();
         let out = { "InvoiceParent": [{ InvoiceParentID: `${id}`, InvoiceSent: 1, Notes: `${json.Notes}\nPDF of Master Invoice #${id} emailed by ${session.Login.Email} on ${now.toLocaleDateString()} ${now.toLocaleTimeString()}` }] };

         let qs = encodeURIComponent(JSON.stringify(out));
         let url = `/grid/ctl.php?x=save&rsc=InvoiceParent&ID=${id}&InvoiceParentID=${id}&json=${qs}`;
         console.log(`url: ${url}`);
         fetch(url).then(r => r.json()).then(data => {
            console.log("success markMasterInvoiceSent");
            console.dir(data);
         });

      }
      async function markInvoiceSent(id) {
         const raw = await fetch(`/api.php?rsc=Invoice&id=${id}`);
         const json = await raw.json();
         const now = new Date();
         const mofmt = new Intl.DateTimeFormat("en-US", { month: "2-digit" });
         const dayfmt = new Intl.DateTimeFormat("en-US", { day: "2-digit" });
         const timefmt = new Intl.DateTimeFormat("en-US", { hour: "2-digit", minute: "2-digit", second: "2-digit", hour12: false });
         
         let senton = now.getFullYear() + '-' + mofmt.format(now) + '-' + dayfmt.format(now) + ' ' + timefmt.format(now);
         let out = { 
            "Invoice": [
               { 
                  InvoiceID: `${id}`,
                  InvoiceSent: 1,
                  SentOn: senton,
                  SentTo: document.querySelector("#To").value,
                  Notes: `${json.Notes}\nInvoice PDF emailed to ${document.querySelector("#To").value} by ${session.Login.Email} on ${now.toLocaleDateString()} at ${now.toLocaleTimeString()}` }
            ]
/*            "Sent": {
               "new1": {
                  Sent: 
               }
            }
*/            
         };

         let qs = encodeURIComponent(JSON.stringify(out));
         let url = `/grid/ctl.php?x=save&rsc=Invoice&ID=${id}&InvoiceID=${id}&json=${qs}`;
         console.log(`url: ${url}`);
         fetch(url).then(r => r.json()).then(data => {
            console.log("success markinvoicesent");
            console.dir(data);
         });

      }
   });
</script>

</html>
