<?php
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");

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
   $in['Resource'] = "Job";
   $in['ID'] = $in['ID'] ? $in['ID'] : 1;
  
   if ($in['x'] == "create") {
      // Call a stored procedure passing in the ID of the record just created
      $boss->addResource("Job");
      $boss->db->Job->execute("CALL JobToInvoice({$in['ID']},'{$_SESSION['Login']->Email}',@InvoiceID)");//QuoteToJob($id,$_SESSION['Login']->Email,$results['JobID']);
      $boss->db->Job->execute("SELECT @InvoiceID");
   }

   $record = $current = $boss->getObjectRelated('Job', $in['ID']);
   $business = $boss->getObjectRelated("Business", $current->BusinessID);

   $InvID = $current->related_Invoice[0]->InvoiceID;
   
   $base = (($_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
   $url =  $base . '/files/templates/print/InvoiceReport.php?ID='.$InvID; 
   $file = $InvID.'.html';

   if ($in['x'] == "create") {
      $invoice = file_get_contents($url);
      $path = $_SERVER['DOCUMENT_ROOT'] . $boss->app->Assets .'/invoices/';
      $save = $path . $file;
      $cnt = 0;
      while (file_exists($save)) {
         ++$cnt;
         $file = $InvID . '-' . $cnt . '.html';
         $save = $path . $file;
         
      }

      if (!file_exists($save) || $in['force']) {
         file_put_contents($save, $invoice);
      }
   }

   $static = $base . '/files/invoices/' . $file;
?>
<!DOCTYPE html> 
<html>
   <head>
      <meta charset="utf-8">
      <title></title>
      <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
      <style>
         body { margin:0;padding:0;font-size:14px;font-family:"Open Sans",sans-serif; }
         h1, h2, h3, h4, h5 { font-family: "Open Sans","Helvetica Neue", Optima, Verdana, sans-serif; }
         a { text-decoration:none;color:#00c; }
         a:hover { text-decoration:underline; }
         a:visited { color:#006; }
         a:active { color:#e00;display:inline-block;top:2px; }
         #main { margin:1em; }
         #toolbar { position:absolute; top:0px; left:0px; width:100%; height:3em; background-color:#000; color:#fff; font-size:1.3em; padding:.5em 1em; }
         #viewWrap { position:absolute; top:5.25em; left:0px; width:100%; bottom:0px; right:0px; }
         button,input,select,option { font-family: "Open Sans",sans-serif; font-size:.8em; }
      </style>
   </head>
   <body>
      <div id='toolbar'>
         <form method='post'>
            <span style='float:left;padding:0 .125em;'><label>Job ID: </label><span class='val'><?php print $in['ID']; ?></span></span>
            <span style='float:right;padding:0 2em;'><label>Invoice ID: </label><span class='val'><?php print $current->related_Invoice[0]->InvoiceID; ?></span></span><br>
            Document: 
            <select id='what'>
               <option value=''>--Select Document--</option>
               <option <?php if (!$InvID) print " disabled='true'"; ?> value='InvoiceReport'>Invoice</option>
               <option value='DriverLog'>Driver Trip</option>
               <option value='Confirmation'>Confirmation</option>
               <option value='DriverLogExternal'>Sub Contractor Log</option>
            </select>
            <button class='view' style='margin-right:2em;'>View</button>
            
            <span id='emailWrap' style='float:right;padding-right:2em;'<?php if (!$InvID) print " disabled='true'"; ?>>
               <!-- Email fields -->
               <input type='hidden' id='x' name='x' value=''>
               <input type='hidden' id='Subject' name='Subject' value='[Invoice] <?php print $current->Job; ?>'>
               <input type='hidden' id='Url' name='Url' value='<?=$static ?>'>
               <input type='hidden' id='Cc' name='Cc' value='juanaharrisdht@att.net'> 
               <span>Email to: <input type='text' name='To' id='To' style='width:20em;' value='<?php print $business->Email; ?>'>
                  <button class='sendmsg'>Send</button></span>
            </span>
            <span style='padding-left:5em;'>
               <button class='geninvoice'><?php print ($InvID) ? "Update" : "Create"; ?> Invoice</button>
               <button class='print'>Print</button>
            </span>
         </form>
      </div>
      <div id='viewWrap'>
         <iframe id='viewer' width='100%' height='100%'></iframe>
      </div>
   </body>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type='text/javascript'>
      var simple = {};
      $(document).ready(function() {
         simple = {
            current: <?php print json_encode($current); ?>,
            InvoiceID: "<?php print $InvID; ?>",
            InvoiceUrl: "<?=$static?>"
         };
         simple.options = {
               InvoiceReport: {
                  href: "InvoiceReport.php?z=" + btoa("ID=" + simple.InvoiceID)
               },
               DriverLog: {
                  href: "DriverLog.php?z=" + btoa("ID=" + simple.current.JobID)
               },
               Confirmation: {
                  href: "Confirmation.php?z=" + btoa("ID=" + simple.current.JobID)
               },
               DriverLogExternal: {
                  href: "DriverLogExternal.php?z=" + btoa("ID=" + simple.current.JobID)
               }
         };
         

         $("form").submit(function(e) {
            
         });
         
         $("#what").change(function(e) {
            $("#Url").val("http://" + location.host + "/files/templates/" + simple.options[$(this).val()].href);
            $("#Subject").val('[' + $(this).val() + '] ' + simple.current['Job']);
            viewDoc();
         });
         
         $("button.geninvoice").click(function(e) {
            $("#x").val("create");
         });
         
         $("button.sendmsg").click(function(e) {
            if (confirm("Email URL " + $("#Url").val() + " to " + $("#To").val() + "?")) {
               var frm = $("form").serialize();
               $.post("/emailurl.php", frm, function(data) {
                  alert("Email sent to " + $("#To").val() + " for URL " + $("#Url").val());
               });
            }
            e.preventDefault();
            e.stopPropagation();
            return false;
         });

         $("button.view").click(function(e) {
            viewDoc();
            e.stopPropagation();
            e.preventDefault();
            return false;
         });

         $("button.print").click(function(e) {
            $("#viewer")[0].contentWindow.print(); 

            e.stopPropagation();
            e.preventDefault();
            return false;
         });

         function viewDoc() {
            var what = $("#what").val(), id;
            
            if (what == "InvoiceReport") {
               id = "<?=$InvID?>";
            } else {
               id = "<?=$in['ID']?>";
            }
            url = "/files/templates/" + $("#what").val() + ".php?ID=" + id;
            $("#viewer").attr("src", url);
         }
      });
   </script>
</html>
