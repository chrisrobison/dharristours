<?php
   //require_once('lib/auth.php');
   require_once($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');
   require_once($_SERVER['DOCUMENT_ROOT'].'/lib/payroll_class.php');

   // $times = $boss->payroll->getTimecard(time(), (time() - (86400 * 14)), $_SESSION['Employee']->EmployeeID);
   if ($in['payperiod']) {
      $period = preg_split("/\:/", $in['payperiod']);
      $start = strtotime($period[0]);
      $end = strtotime($period[1]);
   } else { 
      $start = (!$start) ? time() - (date('w', time()) * 86400) : $start;
      $end = (!$end) ? $start + (60 * 60 * 24 * 7) : $end;
      
      if (date("d", time()) > 20) {
         $start = strtotime(date("Y-m-21", time()));
         $end = strtotime(date("Y-m-5", time() + 1209600));
         $in['payperiod'] = date("Y-m-16", $start) . ':' . $end;
      } else {
         $start = strtotime(date("Y-m-06", time()));
         $end = strtotime(date("Y-m-20", time()));
         $in['payperiod'] = date("Y-m-06", $start) . ':' . date("Y-m-20", $start);
      }
   }
   
   // $boss->payroll->tallyPunches($start, $end, $_SESSION['Employee']->EmployeeID);
   
   $start2 = $start + (60 * 60 * 24 * 8);
   $end2 = $start + (60 * 60 * 24 * 14);

   $tally = (preg_match("/payroll/i", $in['x'])) ? true : '';

   if ($in['x'] == 'Export') {
      header("Content-type: text/plain");
      header("Content-Disposition: attachment; filename=Payroll_".(date("Y-m-d", $start)).".txt");
      $hourlytxt = $boss->payroll->exportPayrollHourly($start, $end2, '', $tally);
      print $hourlytxt;
      exit;
   } else {
      $hourly = $boss->payroll->exportPayrollHourly($start, $end2, true, $tally);
   }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title></title>
      <link rel='stylesheet' type='text/css' href='/lib/css/default.css' />
      <script language='JavaScript' type='text/javascript' src='/timeclock/lib/js/default.js' ></script>
   </head>
   <body onload="document.mainform.payperiod.focus();">
      <div class='contentWrap'>
         <form name='mainform' id='mainform' method='post' action='PayrollHourly.php'>
         <span style='padding: 2px 1em 2px 1em;font-size:12px;font-weight:bold;'>Pay period:</span><select onchange="document.mainform.submit();" name='payperiod' id='payperiod'>
            <?php
               $sixago = strtotime("6 months ago");
               $sixagoDate = date('Y-m-1', $sixago);
               $sixago = strtotime($sixagoDate);

               $now = time();
               for ($i=0; $i<12; $i++) {
                  $val = date("Y-m-06", $sixago);
                  $val .= date(":Y-m-20", $sixago);
                  
                  $val2 = date("Y-m-21", $sixago);
                  $val2 .= date(":Y-m-5", $sixago + 2678400);
                  
                  $s = ($val == $in['payperiod']) ? ' SELECTED' : '';
                  $out .= "<option value='$val'$s>".date("F 6, Y", $sixago).' - '.date("F 20, Y", $sixago)."</option>\n";
                  
                  $s = ($val2 == $in['payperiod']) ? ' SELECTED' : '';
                  $out .= "<option value='$val2'$s>".date("F 21, Y", $sixago).' - '.date("F 5, Y", $sixago + 2678400)."</option>\n";

                  $sixago += (date("t", $sixago)*86400);
               }
               print $out;
            ?>
         </select>
         <input type='submit' name='x' value='Do Payroll' class='btn' style='float:none;border:1px outset #909090;'/>
         <input type='submit' name='x' value='Export' class='btn' style='float:none;border:1px outset #909090;'/>
         <br clear='left'/>
         </form>
         <table border='0' cellpadding='0' cellspacing='0' class='ts_table' style='margin-left:auto;margin-right:auto;'>
            <?php 
               print $hourly;
            ?>
         </table>
      </div>
      <div class='instructions'>
         <p>The table above describes the payroll for hourly employees for the selected pay period (defaults to the current pay period).
         </p>
      </div>
   </body>
</html>
