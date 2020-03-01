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
   if ($in['z']) {
      $qs = base64_decode($in['z']);
      
      $qs = preg_replace("/#.*/", "", $qs);
      $parts = explode('&', $qs);
      $cnt = count($parts);

      for ($i=0; $i < $cnt; $i++) {
          list($key, $val) = preg_split("/=/", $parts[$i]);
          $in[urldecode($key)] = urldecode($val);
      }
   }
   
   $in['Resource'] = "Job";
   $in['ID'] = $in['ID'] ? $in['ID'] : 1;
 
   $boss->addResource("Job");
   $boss->db->Job->execute("SELECT JobID, Job from Job where JobID='{$in['ID']}'"); // ((JobDate > CURDATE()) or (JobDate < (CURDATE() + INTERVAL 2 MONTH))) or JobID not in (select JobID from Invoice) OR (JobID='{$in['ID']}') order by LastModified desc");

   $job = mysql_fetch_assoc($boss->db->Job->result); 

   if ($in['x'] == "create") {
      // Call a stored procedure passing in the ID of the record just created
      $boss->db->Job->execute("CALL JobToInvoice({$in['ID']},'{$_SESSION['Login']->Email}',@InvoiceID)");//QuoteToJob($id,$_SESSION['Login']->Email,$results['JobID']);
      $boss->db->Job->execute("SELECT @InvoiceID");
   }

   $record = $current = $boss->getObjectRelated('Job', $in['ID']);
   $business = $boss->getObjectRelated("Business", $current->BusinessID);
   if ($current->EmployeeID) $employee = $boss->getObjectRelated("Employee", $current->EmployeeID);

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

   $static = $base . '/files/invoices/?z=' . base64_encode("ID=" . $InvID);
?>
<!DOCTYPE html> 
<html>
   <head>
      <meta charset="utf-8">
      <title></title>
      <link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
      <style>
         body { margin:0;padding:0;font-size:14px;font-family:"Open Sans",sans-serif; }
	.flex-container {
  	display: flex;
  	flex-direction: column;
  	min-height: 100vh;
	}
	section.content {  flex: 1; background-color:#3F51B5; color:#fff; padding:.5em .5em;}
         h1, h2, h3, h4, h5 { font-family: "Open Sans","Helvetica Neue", Optima, Verdana, sans-serif; }
         a { text-decoration:none;color:#00c; }
         a:hover { text-decoration:underline; }
         a:visited { color:#006; }
         a:active { color:#e00;display:inline-block;top:2px; }
         #main { margin:1em; }
         #toolbar { position:absolute; float:top; top:0px; left:0px; width:100%; height:3em; background-color:#000; color:#fff; font-size:1.3em; padding:.5em 0; }
         #viewWrap { position:absolute; top:5.25em; left:0px; width:100%; bottom:0px; right:0px; }
         button,input,select,option { font-family: "Open Sans",sans-serif; font-size:1em; }
      </style>
   </head>
   <body>
     <div  class="flex-container">
      <section class="content">
         <form method='post'>
            <span style='float:left;padding:0 .125em;'><label>Job ID: </label><span class='val'>
               <input type='text' id="joblist" style='width:5em' value='<?php print $in['ID']; ?>'><button id='lookup'>Lookup</button> <span class='val'><?php print $job['Job']; ?></span>
               </span></span>
               <span id='emailWrap' style='float:right;'<?php if (!$InvID) print " disabled='true'"; ?>>
                  <!-- Email fields -->
                  <input type='hidden' id='x' name='x' value=''>
                  <input type='hidden' id='Subject' name='Subject' value='[Invoice] <?php print $current->Job; ?>'>
                  <input type='hidden' id='Url' name='Url' value='<?=$static ?>'>
                  <input type='hidden' id='Cc' name='Cc' value='juanaharrisdht@att.net'> 
                  <span>Email to: <input type='text' name='To' id='To' style='width:15em;' value='<?php print $business->Email; ?>'>
                     <button class='sendmsg'>Send</button></span>
               </span>
            <div style='clear:left'>
               Doc: 
               <select id='what' style='width:10em'>
                  <option value=''>--Select Document--</option>
                  <option <?php if (!$InvID) print " disabled='true'"; ?> value='InvoiceReport'>Invoice</option>
                  <option value='DriverLog'>Driver Trip</option>
                  <option value='Confirmation'>Confirmation</option>
                  <option value='DriverLogExternal'>Subcontractor Log</option>
               </select>
               <button class='view' style='margin-right:2em;'>View</button>
               
               <span style='padding-left:1em;'>
            <span style='padding:0 2em;'><label>Invoice: </label><span class='val'><?php print $current->related_Invoice[0]->InvoiceID; ?></span></span>
                  <button class='geninvoice'><?php print ($InvID) ? "Update" : "Create"; ?> Invoice</button>
               </span>
               <span style='padding-left:1em;'>
                  <button class='print'>Print</button>
               </span>
                  <button class='print sendmsg'>Print&Email</button>
               </span>
            </div>
         </form>
      </div>
      </section>
      <div id='viewWrap'>
         <iframe id='viewer' width='100%' height='100%'></iframe>
      </div>
   </body>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type='text/javascript'>
      var simple = {};
      $(document).ready(function() {
         simple = {
            current: <?php 
            if ($current) {
               print json_encode($current); 
            } else {
               print "{JobID: ''}";
            }
            ?>,
            <?php if ($employee) print "employee: " . json_encode($employee) .",\n"; ?>
            <?php if ($business) print "business: " . json_encode($business) .",\n"; ?>
            InvoiceID: "<?php print $InvID; ?>",
            InvoiceUrl: "<?=$static?>"
         };
         simple.options = {
               InvoiceReport: {
                  href: "InvoiceReport.php?z=" + btoa("ID=" + simple.InvoiceID),
                  email: (simple.business) ? simple.business.Email : ""
               },
               Confirmation: {
                  href: "Confirmation.php?z=" + btoa("ID=" + simple.current.JobID),
                  email: (simple.business) ? simple.business.Email : ""
               },
               DriverLog: {
                  href: "DriverLog.php?z=" + btoa("ID=" + simple.current.JobID),
                  email: (simple.employee) ? simple.employee.Email : ""
               },
               DriverLogExternal: {
                  href: "DriverLogExternal.php?z=" + btoa("ID=" + simple.current.JobID),
                  email: (simple.employee) ? simple.employee.Email : ""
               }
         };
         

         $("form").submit(function(e) {
            
         });
         
         $("#joblist").change(function(e) { document.location.href = "/files/templates/JobToPrint.php?z=" + btoa("ID=" + $(this).val()); });
         $("#lookup").click(function(e) { document.location.href = "/files/templates/JobToPrint.php?z=" + btoa("ID=" + $("#joblist").val()); });

         $("#what").change(function(e) {
            var curdoc = $(this).val();
            $("#Url").val("https://" + location.host + "/files/templates/" + simple.options[curdoc].href);
            $("#Subject").val('[' + curdoc + '] ' + simple.current['Job']);
            $("#To").val(simple.options[curdoc].email);
            localStorage.setItem('curdoc', curdoc);
            window.location.hash = "#" + curdoc;
            viewDoc(curdoc);
         });
         
         $("button.geninvoice").click(function(e) {
            $("#x").val("create");
         });
         
         $("button.sendmsg").click(function(e) {
            if (confirm("Email URL " + $("#Url").val() + " to " + $("#To").val() + "?")) {
               var frm = $("form").serialize();
               $.post("/emailurl.php", frm, function(data) {
                  //alert("Email sent to " + $("#To").val() + " for URL " + $("#Url").val());
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

         function viewDoc(what) {
            if (!what) {
               what = $("#what").val();
            } 
            var id;
            
            if (what == "InvoiceReport") {
               id = "<?=$InvID?>";
            } else {
               id = "<?=$in['ID']?>";
            }
            url = "/files/templates/" + what + ".php?z=" + btoa("ID=" + id);
            $("#viewer").attr("src", url);
         }
      });
   </script>
</html>
