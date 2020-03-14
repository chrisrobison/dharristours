<?php
   require_once($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');
   require_once($_SERVER['DOCUMENT_ROOT'].'/lib/payroll_class.php');

   $boss->payroll = new Payroll();

   // $times = $boss->payroll->getTimecard(time(), (time() - (86400 * 14)), $_SESSION['Employee']->EmployeeID);
   if ($in['payperiod']) {
      $period = preg_split("/\:/", $in['payperiod']);
      $start = strtotime($period[0]);
      $end = strtotime($period[1]);
   } else { 
      $start = (!$start) ? time() - (date('w', time()) * 86400) : $start;
      $end = (!$end) ? $start + (60 * 60 * 24 * 7) : $end;
      
      if (date("d", time()) > 19) {
         $start = strtotime(date("Y-m-21", time()));
         $end = strtotime(date("Y-m-5", time() + 1209600));
         $in['payperiod'] = date("Y-m-21", $start) . ':' . date("Y-m-5", $end);
      } else {
         $start = strtotime(date("Y-m-06", time()));
         $end = strtotime(date("Y-m-20", time()));
         $in['payperiod'] = date("Y-m-06", $start) . ':' . date("Y-m-20", $end);
      }
   }
   
   $periodstart = $start;
   $startday = date("w", $start);
   $start -= ($startday * 86400);
   
   $start2 = $start + (7 * 86400);
   $start3 = $start + (14 * 86400);
   $start4 = $start + (21 * 86400);
   
   $endtmp = date("d", $start);
   $end2 = ($endtmp==1) ? strtotime(date("Y-m-20", $start)) : strtotime(date("Y-m-5", $start + 1209600));

   $boss->payroll->tallyPunches($start, $end2, $_SESSION['Employee']->EmployeeID);
   $employee = $boss->getObject('Employee', $_SESSION['Employee']->EmployeeID);
   $punches = $boss->payroll->buildPunchTable($start, ($start2 - 60), $_SESSION['Employee']->EmployeeID, 1, 0, $periodstart, $end);
   list($hours, $totals) = $boss->payroll->buildHourTable($start, ($start2 - 60), $_SESSION['Employee']->EmployeeID, 1, 0, $periodstart, $end);

   $punches2 = $boss->payroll->buildPunchTable($start2, ($start3 - 60), $_SESSION['Employee']->EmployeeID, 1, 0, $periodstart, $end);
   list($hours2, $totals2) = $boss->payroll->buildHourTable($start2, ($start3 - 60), $_SESSION['Employee']->EmployeeID, 1, 0, $periodstart, $end);
   
   $punches3 = $boss->payroll->buildPunchTable($start3, ($start4 - 60), $_SESSION['Employee']->EmployeeID, 1, 0, $periodstart, $end);
   list($hours3, $totals3) = $boss->payroll->buildHourTable($start3, ($start4 - 60), $_SESSION['Employee']->EmployeeID, 1, 0, $periodstart, $end);

 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title></title>
      <link rel='stylesheet' type='text/css' href='local.css' />
      <script language='JavaScript' type='text/javascript' src='default.js' ></script>
   </head>
   <body onload="document.mainform.payperiod.focus();">
      <div class='contentWrap' style='margin-top:8px;'>
         <form name='mainform' id='mainform' method='post' action='timecard.php'>
         <span style='padding: 2px 1em 2px 1em;font-size:12px;font-weight:bold;'>Pay period:</span><select onchange="document.mainform.submit();" name='payperiod' id='payperiod'>
            <?php
               $sixago = strtotime("6 months ago");
               $sixagoDate = date('Y-m-6', $sixago);
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
                  $out .= "<option value='$val2'$s>".date("F 21, Y", $sixago).' - '.date("F 5, Y", $sixago + 1209600)."</option>\n";

                  $sixago += (date("t", $sixago)*86400);
               }
               print $out;
            ?>
         </select>
         <input type='submit' value='View' class='btn' style='float:none;border:1px outset #909090;'/>
         <br clear='left'/>
         <hr/>
          <div class='instructions'>
             <p>To view your timecard for any given pay period, select the desired timeframe from the drop-box labeled 
             <b>'Pay Period'</b> above.  
             </p>
          </div>
          <hr/>
         <h1 style='font-size:18px;padding-left:4px;'><?php print $_SESSION['Employee']->FirstName . ' ' . $_SESSION['Employee']->LastName . (!preg_match("/s$/", $_SESSION['Employee']->LastName) ? "'s" : "'"); ?> Timecard for <?php print date("m/d/Y", $periodstart) . ' - ' . date("m/d/Y", $end); ?></h1>

         <table border='0' cellpadding='0' cellspacing='0' class='ts_table' style='margin-left:auto;margin-right:auto;'>
            <?php 
               print $punches;
            ?>
         <tr><td colspan='10' style='border-bottom:1px solid #606060;height:2px;position:relative;'></td></tr>
         <?php
               print $hours;
         ?>
         </table>
         <br/>
          <table border='0' cellpadding='0' cellspacing='0' class='ts_table' style='margin-left:auto;margin-right:auto;'>
            <?php 
               print $punches2;
            ?>
         <tr><td colspan='10' style='border-bottom:1px solid #606060;height:2px;position:relative;'></td></tr>
         <?php
               print $hours2;
         ?>
         </table>
         <br/>
         <table border='0' cellpadding='0' cellspacing='0' class='ts_table' style='margin-left:auto;margin-right:auto;'>
         <?php
               print $punches3;
            ?>
         <tr><td colspan='10' style='border-bottom:1px solid #606060;height:2px;position:relative;'></td></tr>
         <?php
               print $hours3;
         ?>
         <tr><td colspan='10' style='border-top:1px solid #000000;background-color:#f0f0f0;'>
            <table border='0' cellpadding='0' cellspacing='0' style='float:right;border-left:1px solid #000000;'>
               <tr><th colspan='2' class='ts_head'>Total Hours</th></tr>
            <?php
               $r = 0;
               foreach ($totals as $key=>$val) {
                  $tot = $totals[$key] + $totals2[$key] + $totals3[$key];
                  print "<tr><td class='ts_total bold right ts_row$r'>$key</td><td class='ts_total ts_row$r'>".sprintf("%1.2f", $tot)."</td></tr>\n";
                  $r ^= 1;
               }
            ?>
            </table>
            </td>
         </tr>
         </table>
       </div>
         </form>
   </body>
</html>
