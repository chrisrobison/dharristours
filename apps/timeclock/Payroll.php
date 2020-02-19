<?php
   //require_once('lib/auth.php');
   require_once($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');
   require_once($_SERVER['DOCUMENT_ROOT'].'/lib/payroll_class.php');

   // $times = $boss->utility->getTimecard(time(), (time() - (86400 * 14)), $_SESSION['Employee']->EmployeeID);
   if ($in['payperiod']) {
      list($in['periodstart'], $in['periodend']) = preg_split("/\:/", $in['payperiod']);
      $start = strtotime($in['periodstart']);
      $end = strtotime($in['periodend']);
   } else { 
      $start = (!$start) ? time() - (date('w', time()) * 86400) : $start;
      $end = (!$end) ? $start + (60 * 60 * 24 * 7) : $end;
      
      if (date("d", time()) > 15) {
         $start = strtotime(date("Y-m-16", time()));
         $end = strtotime(date("Y-m-t", time()));
         $in['payperiod'] = date("Y-m-16", $start) . ':' . date("Y-m-t", $start);
         $in['periodstart'] = date("Y-m-16", $start);
      } else {
         $start = strtotime(date("Y-m-01", time()));
         $end = strtotime(date("Y-m-15", time()));
         $in['payperiod'] = date("Y-m-01", $start) . ':' . date("Y-m-15", $start);
         $in['periodstart'] = date("Y-m-01", $start);
      }
   }
   
   // $boss->utility->tallyPunches($start, $end, $_SESSION['Employee']->EmployeeID);
   
   $start2 = $start + (60 * 60 * 24 * 8);
   $end2 = $start + (60 * 60 * 24 * 15);
   
   if ($in['x'] == 'update') $boss->storeObject($_REQUEST, 'Payroll'); // Only needed if editing is allowed

   $tally = (preg_match("/payroll/i", $in['x'])) ? true : '';

   if ($in['x'] == 'Export') {
      header("Content-type: text/plain");
      header("Content-Disposition: attachment; filename=Payroll_".(date("Y-m-d", $start)).".txt");
      $hourlytxt = $boss->payroll->exportPayroll($start, $end2, '', $tally);
      print $hourlytxt;
      exit;
   } else {
      $hourly = $boss->payroll->exportPayroll($start, $end2, true, $tally);
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
         <h1 style='font-size:18px;padding-left:4px;'>Payroll for Salaried Employees: 
         <?php 
            print date("F d, Y", $start) . ' - ';
            $day = date("d", $start);
            if ($day == 1) {
              print date("F 15, Y", $start);
            } else {
              print date("F t, Y", $start);
            }
         ?></h1>
         <hr/>
 <form name='mainform' id='mainform' method='post' action='Payroll.php'>
         <input type='hidden' name='x' value='' />
         <span style='padding: 2px 1em 2px 1em;font-size:12px;font-weight:bold;'>Pay period:</span><select onchange="document.mainform.submit();" name='payperiod' id='payperiod'>
            <?php
               $sixago = strtotime("6 months ago");
               $sixagoDate = date('Y-m-1', $sixago);
               $sixago = strtotime($sixagoDate);

               $now = time();
               for ($i=0; $i<12; $i++) {
                  $val = date("Y-m-01", $sixago);
                  $val .= date(":Y-m-15", $sixago);
                  
                  $val2 = date("Y-m-16", $sixago);
                  $val2 .= date(":Y-m-t", $sixago);
                  
                  $s = ($val == $in['payperiod']) ? ' SELECTED' : '';
                  $out .= "<option value='$val'$s>".date("F 1, Y", $sixago).' - '.date("F 15, Y", $sixago)."</option>\n";
                  
                  $s = ($val2 == $in['payperiod']) ? ' SELECTED' : '';
                  $out .= "<option value='$val2'$s>".date("F 16, Y", $sixago).' - '.date("F t, Y", $sixago)."</option>\n";

                  $sixago += (date("t", $sixago)*86400);
               }
               print $out;
            ?>
         </select>
         <input type='submit' name='x' value='Do Payroll' class='btn' style='position:relative;z-index:99999;float:none;border:1px outset #909090;'/>
         <input type='submit' name='x' value='Export' class='btn' style='position:relative;z-index:99999;float:none;border:1px outset #909090;'/>
         <br clear='left'/>
         <hr/>
         <table border='0' cellpadding='0' cellspacing='0' class='ts_table' style='margin-left:auto;margin-right:auto;'>
            <?php 
               print $hourly;
            ?>
         </table>
         </form>
      </div>
      <hr/>
      <div class='instructions'>
         <p>The table above describes the payroll for salaried employees for the selected pay period (defaults to the current pay period).
         This table is special in that you may edit any of the cells simply by clicking in it.  To save your changes, simply
         press the <code>Enter</code> key, to discard them press <code>Escape [ESC]</code>.</p>
      </div>
   </body>
</html>
