<?php
   require_once($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');
   require_once($_SERVER['DOCUMENT_ROOT'].'/lib/payroll_class.php');
   $boss->payroll = new Payroll();

   if ($in['payperiod']) {
      $period = preg_split("/\:/", $in['payperiod']);
      $start = strtotime($period[0]);
      $end = strtotime($period[1]);
   } else { 
      $start = (!$start) ? time() - (date('w', time()) * 86400) : $start;
      $end = (!$end) ? $start + ((60 * 60 * 24 * 7) + (3600)) : $end;
      
      if (date("d", time()) > 19) {
         $start = strtotime(date("Y-m-20", time()));
         $end = strtotime(date("Y-m-5", time() + 1209600));
         $in['payperiod'] = date("Y-m-21", $start) . ':' . date("Y-m-5", $start + 1209600);
      } else {
         $start = strtotime(date("Y-m-06", time()));
         $end = strtotime(date("Y-m-20", time()));
         $in['payperiod'] = date("Y-m-06", $start) . ':' . date("Y-m-20", $start);
      }
   }
   
   if ($in['x'] == 'update') {
      if ($in['Timeclock']) {
         foreach ($in['Timeclock'] as $key=>$change) {
            $in['Timeclock'][$key]['ModifiedBy'] = $_SESSION['Email'];
            $time = $in['Timeclock'][$key]['Time'];
            if ($time) {
               // Fix up time, converting to military time format
               $raw = preg_replace("/\D/", '', $time);   // Stuff $raw with #'s only
               // if ($raw <= 12) $raw *= 100;              // Allow things like '6p'
               // print "Raw: $raw<br />\n";
               if (preg_match("/p/i", $time) && ($raw<1200)) $raw += 1200; // Add 1200 if 'PM' (or varient) is specified
               $hr = floor($raw * .01);
               $min = abs((($raw * .01) - $hr) * 60);
               if ($min < 10) {
                  $min = "0$min";
               }
               // print "Hour: $hr\n<br />Min: $min\n<br />";
               $raw = $hr.$min;
               $raw = preg_replace("/(\d\d?)(\d\d)/", "$1:$2", $raw);      // Final formatting of time into hh:mm format
               // print "Raw: $raw<br />\n";
               $in['Timeclock'][$key]['Time'] = $raw;    // Replace time entry with new, clean time
            }
         }
         $in = $boss->cleanObject($in);
         $boss->storeObject($in, 'Timeclock');
      }
   }
   
   $periodstart = $start;

      /**
       * Calculate beginning of week (last Sunday) for requested period date
       * by subtracting the day of the week for our period (0=Sun,1=Mon, etc) 
       * multiplied by the # of seconds in a day (86400) from $start
       *
       **/
      $startday = date("w", $start);
      $start -= ($startday * 86400);
      
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title>Timecards</title>
      <link rel='stylesheet' type='text/css' href='local.css' />
      <script language='JavaScript' type='text/javascript' src='default.js' ></script>
      <script language='JavaScript' type='text/javascript'>
         var employeeID = '<?php print $_SESSION['Employee']->EmployeeID; ?>';
         
         keyDefs[9] = { cmd:'doTab(evt)' };
         keyDefs[27] = { cmd:'doEscape(evt)' };
          
         document.onkeypress = doKeypress;
      </script>
   </head>
   <body>
      <div class='contentWrap' style='margin-top:8px;'>
         <h1 style='font-size:18px;padding-left:4px;'>Timecard Manager</h1>
         <hr/>
         <form name='mainform' id='mainform' method='post' action='timecards.php'>
         <input type='hidden' name='x' value=''/>
         <div id='period' style='position:relative;margin-right:2em;padding-right:2em;float:right;'>
         <span style='padding: 2px 1em 2px 1em;font-size:12px;font-weight:bold;'>Pay period:</span><select onchange="document.mainform.submit();" name='payperiod' id='payperiod'>
            <?php
               print $boss->payroll->buildPayperiodSelect($in['payperiod']);
            ?>
         </select>
         <input type='submit' value='View' class='btn' style='float:none;border:1px outset #909090;'/>
         <!-- <input type='button' value='Recalculate' class='btn' style='float:none;border:1px outset #909090;' onclick="document.mainform.x.value='update';setTimeout('document.mainform.submit()',250);"/> -->
         </div>
         <div id='employee' style='position:relative;float:left;'>
            <span style='padding: 2px 1em 2px 1em;font-size:12px;font-weight:bold;'>Employee: </span>
            <select onchange="document.mainform.submit();" name='EmployeeID' id='EmployeeID'>
               <option value=''>-- Choose Employee --</option>
               <option value='all'<?php print ($in['EmployeeID']=='all') ? ' SELECTED' : ''; ?>>All Employees</option>
            <?php 
               print $boss->payroll->listEmployees($in['EmployeeID']);
            ?>
            </select>
         </div>
         <br clear='left'/><hr/>
         <?php
            $boss->db->addResource('Employee');    // Attach 'Employee' table
            
            // Setup condition to pass to getlist if specific ID is available
            $cond = ($in['EmployeeID'] != 'all') ? "EmployeeID='{$in['EmployeeID']}' ORDER BY LastName" : '1=1 ORDER BY LastName';
            
            $boss->db->Employee->getlist($cond);   // Grab list from Employee
            
            if (count($boss->db->Employee->Employee)) {
               // Loop through employees, generating and displaying punch and hour tables
               foreach ($boss->db->Employee->Employee as $employee) {
                  $times = $boss->payroll->getEmployeeTime($employee->EmployeeID, $periodstart);
         ?>
         
         <h1 class='ts_employee'>
         <?php print $employee->FirstName.' '.$employee->LastName.(!preg_match("/s$/", $employee->LastName)?"'s":"'"); ?> 
         Timecard for <?php print date("m/d/Y", $periodstart) . ' - ' . date("m/d/Y", $end); ?></h1>
         
         <?php
            for ($i=0; $i<3; $i++) {
         ?>
               <table border='0' cellpadding='0' cellspacing='0' class='ts_table'>
                  <?php print $times['Punches'][$i]; ?>
                  <tr><td colspan='10' class='ts_space'></td></tr>
                  <?php print $times['Hours'][$i]; ?>
               </table><br/>
         <?php 
            }
         ?>
         <table border='0' cellpadding='0' cellspacing='0' class='ts_table'>
            <tr>
               <td colspan='10' class='ts_bottom'>
                  <table border='0' cellpadding='0' cellspacing='0' class='ts_totalhours'>
                     <tr><th colspan='2' class='ts_head'>Total Hours</th></tr>
                     <?php
                        $r = 0;
                        foreach ($times['Totals'][0] as $key=>$val) {
                           $tot = $times['Totals'][0][$key] + $times['Totals'][1][$key] + $times['Totals'][2][$key];
                           print "<tr><td class='ts_total bold right ts_row$r'>$key</td><td class='ts_total ts_row$r'>".sprintf("%1.2f", $tot)."</td></tr>\n";
                           $r ^= 1;
                        }
                     ?>
                  </table>
               </td>
            </tr>
         </table><hr/>  
         <?php
               }
            }
         ?>
         </form>
      </div>
      <div class='instructions'>
         <p>This tool allows managers and finance staff to review and modify the timecards for their employees.  
         To view an employee's timecard, select the employee from the <b>'Employee'</b> drop-down above.  To view a particular 
         pay period other than the current pay period, you may select one from the <b>'Pay Period'</b> select box.</p>
         <p>This timecard table is special in that you may edit any of the 'clock-in/out' cells simply by clicking in it 
         (the actual hours are calculated from the punch times).  To save your changes, simply
         press the <code>Enter</code> key, to discard them press <code>Escape [ESC]</code>.</p>
      </div>
   </body>
</html>
