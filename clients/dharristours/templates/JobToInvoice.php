<?php
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");

   $in['Resource'] = "Job";
   $in['ID'] = $in['ID'] ? $in['ID'] : 1;
   $record = $current = $boss->getObjectRelated($in['Resource'], $in['ID']);

   $business = $boss->getObjectRelated("Business", $current->BusinessID);

   // Call a stored procedure passing in the ID of the record just created
   $boss->db->Job->execute("CALL JobToInvoice({$in['ID']},'{$_SESSION['Login']->Email}',@InvoiceID)");//QuoteToJob($id,$_SESSION['Login']->Email,$results['JobID']);
   $boss->db->Job->execute("SELECT @InvoiceID");
   
   $result = $boss->db->Job->fetch_array();
   $InvID = $result[0];
   if ($result[0] == 0) {
      print "Multiple Invoices exist!";
   } 

   $base = (($_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
   $url =  $base . '/files/templates/print/InvoiceReport.php?ID='.$InvID; 

   $invoice = file_get_contents($url);
   
   $path = $_SERVER['DOCUMENT_ROOT'] . $boss->app->Assets .'/invoices/';
   $file = $InvID.'.html';
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

   $static = $base . '/files/invoices/' . $file;
?>

Invoice ID: <?php print $result[0]; ?><br>
<a href='<?=$static ?>' target='_blank'>View Invoice</a><br>
<form action='/emailurl.php'>
  <input type='hidden' name='Subject' value='[Invoice] <?php print $current->Job; ?>'>
  <input type='hidden' name='Url' value='<?=$static ?>'>
  <input type='hidden' name='Cc' value='juanaharrisdht@att.net'> 
  Email Invoice to: <input type='text' name='To' id='To' value='<?php print $business->Email; ?>'><button>Send</button>
</form>
