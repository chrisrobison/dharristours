<?php 
class Payroll {
   public $boss;
   function getTimeclock($start, $end, $id='', $emp=false) { 
      $boss = new boss();

      if ($start > $end) {
         $x = $end;
         $end = $start;
         $start = $x;
      }
      if (preg_match("/\-/", $start)) {
         $date['start'] = $start;
         $date['end'] = $end;
      } else {
         $date['start'] = date("Y-m-d", $start);
         $date['end']   = date("Y-m-d", $end);
      }
      $userid = (!$id) ? '' : 'EmployeeID=' . $id . ' AND ';
      $sql = "SELECT * FROM Timeclock WHERE $userid Date>='".$date['start']."' AND Date<='".$date['end']."'";

      // print $sql."<br />\n";

      $dh = $boss->db->dbobj->execute($sql);
      $employee = array();
      while ($row = mysql_fetch_object($dh)) {
         $dates = preg_split("/\-/", $row->Date);
         if ($id) {
            if (!$employee[$row->EmployeeID]) {
               $employee[$row->EmployeeID] = $boss->getObject('Employee', $row->EmployeeID);
               $out['Employee'][$row->EmployeeID] = $employee[$row->EmployeeID];
            }

            if ($emp==true) {
               $out['Employee'][$id]->Timeclock[$dates[0]][$dates[1]][$dates[2]][$row->Punch] = date("H:i:s", strtotime($row->Date.' '.$row->Time));
               if ($row->ModifiedBy) $out['Employee'][$id]->Timeclock[$dates[0]][$dates[1]][$dates[2]][$row->Punch.'_modified'] = 1;
               $out['Employee'][$id]->Timeclock[$dates[0]][$dates[1]][$dates[2]][$row->Punch.'ID'] = $row->TimeclockID;
            } else {
               $out[$dates[0]][$dates[1]][$dates[2]][$row->Punch] = date("h:i a", strtotime($row->Date.' '.$row->Time));
               if ($row->ModifiedBy) $out[$dates[0]][$dates[1]][$dates[2]][$row->Punch.'_modified'] = 1;
               $out[$dates[0]][$dates[1]][$dates[2]][$row->Punch.'ID'] = $row->TimeclockID;
            }
         } else {
            $out['Employee'][$row->EmployeeID]->Timeclock[$dates[0]][$dates[1]][$dates[2]][$row->Punch] = date("H:i:s", strtotime($row->Date.' '.$row->Time));
            if ($row->ModifiedBy) $out['Employee'][$row->EmployeeID]->Timeclock[$dates[0]][$dates[1]][$dates[2]][$row->Punch.'_modified'] = 1;
            $out['Employee'][$row->EmployeeID]->Timeclock[$dates[0]][$dates[1]][$dates[2]][$row->Punch.'ID'] = $row->TimeclockID;
         }
      }
      return $out;
   }
   
   function tallyPunches($start='', $end='', $id='') {
      $start = (!$start) ? time() - (date('w', time()) * 86400) : $start;
      $startDate = date("Y-m-d", $start);

      $end = (!$end) ? $start + (60 * 60 * 24 * 30) : $end;
      $endDate = date("Y-m-d", $end);
      
      $boss = new boss();
      $boss->db->addResource('Timecard');
      $tc = $boss->db->Timecard;
     
      $timeclock = $this->getTimeclock($start, $end, $id, true);
      
      if ($timeclock && $timeclock['Employee']) {
         // First loop through each employee
         foreach ($timeclock['Employee'] as $id=>$rec) {
            // Now through timeclock entries, starting with the year
            foreach ($rec->Timeclock as $year=>$months) {
               // Now through the months
               foreach ($months as $month=>$days) {
                  // Now through the days
                  foreach ($days as $day=>$punches) {
                     $weeknum = date('W', strtotime($year.'-'.$month.'-'.$day));
                     if (!$week[$weeknum]) $week[$weeknum] = 0;
                     
                     // Now tally the punches
                     $seconds['in'] = $this->convertSeconds($punches['in']);
                     $seconds['lunch'] = $this->convertSeconds($punches['lunch']);
                     $seconds['return'] = $this->convertSeconds($punches['return']);
                     $seconds['out'] = $this->convertSeconds($punches['out']);
                  
                     $total = 0;
                     if ($seconds['lunch'] && $seconds['in'] && $seconds['out'] && $seconds['return']) {
                        $total = sprintf("%02.2f", (($seconds['lunch'] - $seconds['in']) / 3600) + (($seconds['out'] - $seconds['return']) / 3600));
                     } else if (($seconds['in'] && $seconds['out']) && (!$seconds['lunch'] || !$seconds['return'])) {
                        $total = sprintf("%02.2f", ($seconds['out'] - $seconds['in']) / 3600);
                     } else if ($seconds['in'] && $seconds['out'] && !$seconds['return'] && !$seconds['lunch']) {
                        $total = sprintf("%02.2f", ($seconds['out'] - $seconds['in']) / 3600);
                     } else if ($seconds['in'] && $seconds['lunch'] && !$seconds['out'] && $seconds['return']) {
                        $total = sprintf("%02.2f", ($seconds['lunch'] - $seconds['in']) / 3600);
                     } else if ($seconds['in'] && $seconds['lunch'] && !$seconds['out'] && !$seconds['return']) {
                        $total = sprintf("%02.2f", ($seconds['lunch'] - $seconds['in']) / 3600);
                     }
                     $upd = array();
                     $out['Timecard']['new1'] = array();
                     $new =& $out['Timecard']['new1'];
                     $new['EmployeeID'] = $id;
                     $new['Date'] = $year.'-'.$month.'-'.$day;
                     $new['Total'] = sprintf("%02.2f", $total);
                     $new['Regular'] = $new['Doubletime'] = $new['Overtime'] = 0;
                     
                     if ($new['Total'] <= 8) {
                        if ($week[$weeknum] <= 40) {
                           $new['Regular'] = $new['Total'];
                           $week[$weeknum] += $new['Regular'];
                        } else {
                           $new['Regular'] = '0.0';
                           $new['Overtime'] = $new['Total'];
                           $week[$weeknum] += $new['Total'];
                        }
                     } else if ((($new['Total'] > 8) && ($new['Total'] <= 12))) {
                        
                        if ($week[$weeknum] <= 40) {
                           $new['Regular'] = sprintf("%02.2f", 8);
                           $new['Overtime'] = sprintf("%02.2f", ($new['Total'] - 8));
                        } else {
                           $new['Regular'] = sprintf("%02.2f", 0);
                           $new['Overtime'] = sprintf("%02.2f", $new['Total']);
                        }
                     } else if ($new['Total'] > 12) {
                        $subt = 0;
                        if ($week[$weeknum] <= 40) {
                           $new['Regular'] = sprintf("%02.2f", 8);
                           $subt = -8;
                        }
                        $new['Overtime'] = sprintf("%02.2f", 12 + $subt);
                        $new['Doubletime'] = sprintf("%02.2f", $new['Total'] - 12);
                     }

                     $totals['Regular'] += $new['Regular'];
                     $totals['Overtime'] += $new['Overtime'];
                     $totals['Doubletime'] += $new['Doubletime'];
                     
                     // Check for existing timecard entries for this date and employee
                     $tc->get("$year-$month-$day", 'Date', "EmployeeID='$id'");
                     
                     // Perform update if existing timecard entries exist, otherwise create new entry
                     if (count($tc->Timecard)) {
                        $upd['Timecard'][$tc->Timecard[0]->TimecardID] = $new;
                        $boss->storeObject($upd, 'Timecard');
                     } else {
                        $boss->storeObject($out, 'Timecard');
                     }
                  }
               }
            }
         }
      }
      return $totals;
   }
   
   function getTimecard($start, $end, $id='', $tally='') {
      $boss = new boss();
      if ($start > $end) {
         $x = $end;
         $end = $start;
         $start = $x;
      }
      $date['start'] = date("Y-m-d", $start);
      $date['end']   = date("Y-m-d", $end);
      
      $userid = (!$id) ? '' : 'EmployeeID=' . $id . ' AND ';
      
      if ($tally) $this->tallyPunches($start, $end, $id);

      $sql = "SELECT * FROM Timecard WHERE $userid Date>='".$date['start']."' AND Date<='".$date['end']."' order by EmployeeID, Date";

      $boss->db->dbobj->execute($sql);
      $employee = array();
      while ($row = $boss->db->dbobj->fetch_object()) {
         $dates = preg_split("/\-/", $row->Date);
         if ($id) {
            /* if (!$employee[$row->EmployeeID]) {
               $employee[$row->EmployeeID] = $boss->getObject('Employee', $row->EmployeeID);
               $out['Employee'][$row->EmployeeID] = $employee[$row->EmployeeID];
            } */
            
            $out[$dates[0]][$dates[1]][$dates[2]] = $row;
         } else {
            if (!$employee[$row->EmployeeID]) {
               $employee[$row->EmployeeID] = $boss->getObject('Employee', $row->EmployeeID);
               $out['Employee'][$row->EmployeeID] = $employee[$row->EmployeeID];
            }
          $out['Employee'][$row->EmployeeID]->Timecard[$dates[0]][$dates[1]][$dates[2]] = $row;
         }
         // $out[] = $row;
      }
      return $out;
   }
   
   function convertSeconds($time) {
      $t = preg_split("/\:/", $time);
      if (count($t)>2) $sec = $count[2];
      $sec += ($t[1] * 60); 
      $sec += ($t[0] * 60 * 60);
      
      return $sec;
   }
   
   function buildHourTable($start='', $end='', $id='', $manage='', $nototals='', $periodstart='', $periodend='') {
      $start = (!$start) ? time() - (date('w', time()) * 86400) : $start;
      $startDate = date("Y-m-d", $start);

      $end = (!$end) ? $start + (60 * 60 * 24 * 7) : $end;
      $endDate = date("Y-m-d", $end);
      $id = (!$id) ? $_SESSION['Employee']->EmployeeID : $id;
      $boss = new boss();
      $emp = $boss->getObject('Employee', $id);

      // Grab timecard object for start/end dates for EmployeeID
      $times = $this->getTimecard($start, $end, $id);
      
      // Define our row names
      if ($emp->PayStatus=='hourly') {
         $fields = array('Total', 'Regular', 'Overtime', 'Doubletime');
      } else {
         $fields = array('Total');
      }
      
      // Setup each row with the field name associated with that row
      foreach ($fields as $field) { $rows[$field] = "<tr><td class='ts_cell ts_label'>$field</td>"; }
      
      // Loop for 7 days, appending to each relevent row table cell containing 
      // the calculated work time and tracking a sum for each pay type
      for ($i=$start; $i<=$end; $i+=86400) {
         $nowdays = date("Y-m-d-D", $i);

         if (!$seen[$nowdays]) {
            $seen[$nowdays] = 1;

            $nows = preg_split("/\-/", $nowdays);
            $now = $times[$nows[0]][$nows[1]][$nows[2]];
            $xtraBase = (!$now->Regular) ? 1 : '';
            
            $flop = 0;
            foreach ($fields as $field) {
               $xtra = $xtraBase;
               if (($periodstart && $periodend) && (($i < $periodstart) || ($i > $periodend))) {
                  $xtra .= ' notnow'.$flop;
               }
               if (($periodstart && $periodend) && (($i >= $periodstart) && ($i <= $periodend))) {
                  $totals[$field] += $now->$field;
               }
               $rows[$field] .= "<td class='ts_cell ts_row$flop$xtra'>" . $now->$field . "</td>\n";
               $flop ^= 1;
            }
         } else {
            $end += 86400;
            $periodend += 86400;
         }
      }
      if (!$nototals) {
         $flop = 0;
         foreach ($fields as $field) {
            $rows[$field] .= "<td class='ts_cell ts_row{$flop} right'>".sprintf("%01.2f", $totals[$field])."</td><td class='ts_cell ts_label'>$field</td></tr>\n";
            $flop ^= 1;
         }
      } else {
         foreach ($fields as $field) { $rows[$field] = "<td class='ts_cell ts_label'>$field</td></tr>"; }
      }
      $out = $rows['Total'] . $rows['Regular'] . $rows['Overtime'] . $rows['Doubletime'];
      // $out =  $rows['Regular'] . $rows['Overtime'] . $rows['Doubletime'] . $rows['Total'];
      
      if ($nototals) {
         return $out;
      } else {
         return array($out, $totals);
      }
   }
   function buildPunchTable($start='', $end='', $id='', $manage='', $nototals=0, $periodstart='', $periodend='') {
      $start = (!$start) ? time() - (date('w', time()) * 86400) : $start;
      $end = (!$end) ? $start + (60 * 60 * 24 * 6) : $end;
      
      $startDate = date("Y-m-d", $start);
      $endDate = date("Y-m-d", $end);
      $id = (!$id) ? $_SESSION['Employee']->EmployeeID : $id;
      $times = $this->getTimeclock($start, $end, $id);
//    print_r($times); 
      $rows = array( 'head'=>"<tr><th class='ts_head'>&nbsp;</th>",
                     'in'=>"<tr><td class='ts_cell ts_label'>In</td>",
                     'lunch'=>"<tr><td class='ts_cell ts_label'>Lunch</td>",
                     'return'=>"<tr><td class='ts_cell ts_label'>Return</td>",
                     'out'=>"<tr><td class='ts_cell ts_label'>Out</td>"
                     );
      
      $cnt = 0;
      for ($i=$start; $i<=$end; $i+=86400) {
         $nowdays = date("Y-m-d-D", $i);
         if (!$seen[$nowdays]) {
            $seen[$nowdays] = 1;

            $nows = preg_split("/\-/", $nowdays);
            $now = $times[$nows[0]][$nows[1]][$nows[2]];
            $weeknum = date('W', strtotime($nows[0].'-'.$nows[1].'-'.$nows[2]));
            $rows['head'] .= "<th class='ts_head'>".preg_replace("/^0/", '', $nows[1])."/".preg_replace("/^0/", '', $nows[2])."<br/>".$nows[3]."</th>\n";
            $xtraBase = (!count($now)) ? '1' : '';

            if (($periodstart && $periodend) && ($i > $periodend)) $xtraBase .= ' notnow';
            
            // In
            $cnt++;
            $xtra = $xtraBase.'0';
            if ($now['in_modified']) $xtra .= ' punchModified0';
            $click = (!$manage) ? '' : " onclick=\"editPunch(this, 'Timeclock[" . ((!$now['inID']) ? 'new'.$cnt : $now['inID']) . "]','{$nows[0]}-{$nows[1]}-{$nows[2]}', '{$id}', 'in')\" ondoubleclick=\"return false;\"";
            $rows['in'] .= "<td id='in_{$nows[0]}{$nows[1]}{$nows[2]}' name='in_" . ((!$now['inID']) ? 'new'.$cnt : $now['inID']) . "_{$id}' class='ts_cell ts_row0$xtra'$click>" . $now['in'] . "</td>\n";
            
            // Lunch
            $cnt++;
            $xtra = $xtraBase.'1';
            if ($now['lunch_modified']) $xtra .= ' punchModified1';
            $click = (!$manage) ? '' : " onclick=\"editPunch(this, 'Timeclock[".((!$now['lunchID'])?'new'.$cnt:$now['lunchID'])."]','{$nows[0]}-{$nows[1]}-{$nows[2]}', '{$id}', 'lunch')\" ondoubleclick=\"return false;\"";
            $rows['lunch'] .= "<td id='lunch_{$nows[0]}{$nows[1]}{$nows[2]}' name='lunch_" . ((!$now['lunchID']) ? 'new'.$cnt : $now['lunchID']) . "_{$id}' class='ts_cell ts_row1$xtra'$click>" . $now['lunch'] . "</td>\n";
            
            // Return
            $cnt++;
            $xtra = $xtraBase.'0';
            if ($now['return_modified']) $xtra .= ' punchModified0';
            $click = (!$manage) ? '' : " onclick=\"editPunch(this, 'Timeclock[" . ((!$now['returnID']) ? 'new'.$cnt : $now['returnID']) . "]','{$nows[0]}-{$nows[1]}-{$nows[2]}', '{$id}', 'return')\" ondoubleclick=\"return false;\"";
            $rows['return'] .= "<td id='return_{$nows[0]}{$nows[1]}{$nows[2]}' name='return_" . ((!$now['returnID']) ? 'new'.$cnt : $now['returnID']) . "_{$id}' class='ts_cell ts_row0$xtra'$click>" . $now['return'] . "</td>\n";
            
            // Out
            $cnt++;
            $xtra = $xtraBase.'1';
            if ($now['out_modified']) $xtra .= ' punchModified1';
            $click = (!$manage) ? '' : " onclick=\"editPunch(this, 'Timeclock[" . ((!$now['outID']) ? 'new'.$cnt : $now['outID']) . "]','{$nows[0]}-{$nows[1]}-{$nows[2]}', '{$id}', 'out')\" ondoubleclick=\"return false;\"";
            $rows['out'] .= "<td id='out_{$nows[0]}{$nows[1]}{$nows[2]}' name='out_" . ((!$now['outID']) ? 'new'.$cnt : $now['outID']) . "_{$id}' class='ts_cell ts_row1$xtra'$click>" . $now['out'] . "</td>\n";
         } else {
            $end += 86400;
            $periodend += 86400;
         }
      }
      if (!$nototals) {
         $rows['head']  .= "<th class='ts_head'>Totals</th><th class='ts_head'></th></tr>";
      } else {
         $rows['head']  .= "<th class='ts_head'></th></tr>";
      } 

      $rows['in']    .= '</tr>';
      $rows['lunch'] .= '</tr>';
      $rows['return'].= '</tr>';
      $rows['out']   .= '</tr>';

      $out =   $rows['head']  . "\n" . 
               $rows['in']    . "\n" . 
               $rows['lunch'] . "\n" . 
               $rows['return']. "\n" . 
               $rows['out']   . "\n";

      return $out;
   }
   
   function doPayroll($start, $end, $tally='') {
      $boss = new boss();
      
      $start = (!$start) ? time() - (date('w', time()) * 86400) : $start;
      $startDate = date("Y-m-d", $start);

      $end = (!$end) ? $start + (60 * 60 * 24 * 30) : $end;
      $endDate = date("Y-m-d", $end);
      $split = preg_split("/\-/", $startDate);
      
      $times = $this->getTimecard($start, $end, '', $tally);
      $boss->db->addResource('Payroll');

      foreach ($times['Employee'] as $employee=>$obj) {
         if ($obj->PayStatus=='salary') {
          // print_r($obj); 
            $emp = $boss->getObject('Employee', $employee);
            $out[$employee] = $emp;
            foreach ($obj->Timecard[$split[0]][$split[1]] as $day) {
               if ($day->Total) $out[$employee]->Payroll['new1']['TotalHours'] += $day->Total;
            }
            $out[$employee]->Payroll['new1']['PeriodStart'] = $startDate;
            $out[$employee]->Payroll['new1']['PeriodEnd'] = $endDate;
            $out[$employee]->Payroll['new1']['EmployeeID'] = $employee;
            $out[$employee]->Payroll['new1']['Name'] = $emp->LastName.', '.$emp->FirstName;
            
            $boss->db->Payroll->get($employee, 'EmployeeID', "PeriodStart='".$startDate."'");
            if (count($boss->db->Payroll->Payroll)) {
               if ($boss->db->Payroll->Payroll[0]->VacationHours==0) $out[$employee]->Payroll['new1']['VacationHours'] = $this->getVacation($emp);
               $id = $boss->db->Payroll->Payroll[0]->PayrollID;
            } else {
               $out[$employee]->Payroll['new1']['VacationHours'] = $this->getVacation($emp);
               $id = 'new1';
            }
            $upd['Payroll'][$id] = $out[$employee]->Payroll['new1'];

            $res = $boss->storeObject($upd);
            
         }
      }

   }

   function getVacation($emp) {
      $hired = strtotime($emp->HireDate);
      $onboard = time() - $hired;
      $years = round($onboard / 31536000) + 1;
      $boss = new boss();
      $vacation = $boss->getObject('Vacation', $years);
      return $vacation->HoursPerPeriod;
   }

   function doPayrollHourly($start, $end, $tally='') {
      $boss = new boss();
      
      $start = (!$start) ? time() - (date('w', time()) * 86400) : $start;
      $startDate = date("Y-m-d", $start);

      $end = (!$end) ? $start + (60 * 60 * 24 * 30) : $end;
      $endDate = date("Y-m-d", $end);
      $split = preg_split("/\-/", $startDate);
      
      $boss->db->addResource('Employee');
      $boss->db->Employee->getlist("PayStatus='hourly'");
      $employees = $boss->db->Employee->Employee;

      // $times = $this->getTimecard($start, $end, '', $tally);
      $boss->db->addResource('PayrollHourly');
      foreach ($employees as $obj) {
         if ($obj->PayStatus=='hourly') {
            
            $times = $this->getTimecard($start, $end, $obj->EmployeeID, $tally);
            // $emp = $boss->getObject('Employee', $employee);
            $employee = $obj->EmployeeID;
            $out[$obj->EmployeeID] = $obj;

            if ($times[$split[0]][$split[1]]) {
               foreach ($times[$split[0]][$split[1]] as $day) {
                  if ($day->Regular) $out[$employee]->PayrollHourly['new1']['RegHours'] += $day->Regular;
                  if ($day->Overtime) $out[$employee]->PayrollHourly['new1']['OvertimeHours'] += $day->Overtime;
                  if ($day->Doubletime) $out[$employee]->PayrollHourly['new1']['DoubletimeHours'] += $day->Doubletime;
               }
            }
            $upd = array();
            
            $boss->db->PayrollHourly->get($obj->EmployeeID, 'EmployeeID', "PeriodStart='".$startDate."'");
            if (count($boss->db->PayrollHourly->PayrollHourly)>1) {
               $boss->db->dbobj->execute("delete from PayrollHourly where EmployeeID={$obj->EmployeeID} AND PeriodStart='{$startDate}'");
               $boss->db->PayrollHourly->PayrollHourly = array();
            }
            if (count($boss->db->PayrollHourly->PayrollHourly)) {
               $out[$employee]->PayrollHourly['new1']['PeriodStart'] = $startDate;
               $out[$employee]->PayrollHourly['new1']['PeriodEnd'] = $endDate;
               $out[$employee]->PayrollHourly['new1']['EmployeeID'] = $employee;
               $out[$employee]->PayrollHourly['new1']['Name'] = $obj->LastName.', '.$obj->FirstName;
               
               if ($boss->db->PayrollHourly->PayrollHourly[0]->VacationHours==0) $out[$employee]->PayrollHourly['new1']['VacationHours'] = $this->getVacation($obj);
               $id = $boss->db->PayrollHourly->PayrollHourly[0]->PayrollHourlyID;
               $out[$employee]->PayrollHourly['new1']->PayrollHourlyID = $id;
            } else {
               $out[$employee]->PayrollHourly['new1']['PeriodStart'] = $startDate;
               $out[$employee]->PayrollHourly['new1']['PeriodEnd'] = $endDate;
               $out[$employee]->PayrollHourly['new1']['EmployeeID'] = $employee;
               $out[$employee]->PayrollHourly['new1']['VacationHours'] = $this->getVacation($obj);
               $id = 'new1';
            }
            if ($out[$employee]->PayrollHourly['new1']) $upd['PayrollHourly'][$id] = $out[$employee]->PayrollHourly['new1'];

            if (count($upd['PayrollHourly'])) $res = $boss->storeObject($upd);
            
         }
      }
   }
   
   function exportPayrollHourly($start, $end, $html='', $tally='') {
      $boss = new boss();
      
      $start = (!$start) ? time() - (date('w', time()) * 86400) : $start;
      $startDate = date("Y-m-d", $start);

      $end = (!$end) ? $start + (60 * 60 * 24 * 30) : $end;
      $endDate = date("Y-m-d", $end);

      $this->doPayrollHourly($start, $end, $tally);
      $boss->db->addResource('PayrollHourly');
      $prfields = "PayrollHourly.EmployeeID,Name,PayNum,TaxFreq,CancelPay,RegHours,OvertimeHours,DoubletimeHours,PayrollHourly.VacationHours,PayrollHourly.SickHours,PayrollHourly.BonusEarnings,PayrollHourly.HolidayEarnings,PayrollHourly.RetroEarnings,PayrollHourly.BereavementEarnings,PayrollHourly.MedicalRemitEarnings,PayrollHourly.MealPenaltiesHours,PayrollHourly.AdjustParking,PayrollHourly.PeriodStart";
      $boss->db->dbobj->execute("select $prfields from PayrollHourly, Employee where PeriodStart='{$startDate}' and PayrollHourly.EmployeeID=Employee.EmployeeID and Employee.PayStatus='hourly'");
      $out = '';
      $fields = '';
      
      while ($row = $boss->db->dbobj->fetch_array()) {
         if (!$fields) {
            foreach ($row as $field=>$val) {
               if (preg_match("/\D/", $field) && (!preg_match("/PayrollHourlyID|LastModified|Created/", $field))) {
                  $fields[] = preg_replace("/([a-z])([A-Z])/", '$1 $2', $field); 
               }
            }
            if ($html) {
               $out .= "<tr><th class='ts_head'>".join("</th><th class='ts_head'>", $fields)."</th></tr>\n";
            } else {
               $out .= join("\t", $fields)."\n";
            }
         }
         if (!$seen[$row['EmployeeID']]) {
            $vals = array();
            foreach ($row as $key=>$val) {
               if (preg_match("/\D/", $key) && (!preg_match("/PayrollHourlyID|LastModified|Created/", $key))) {
                  $vals[$key] = $val;
               }
            }
            if ($html) {
               $out .= "<tr>";
               foreach ($vals as $idx=>$val) {
   //               $click = " onclick=\"editPayroll(this, 'Payroll[{$vals['PayrollID']}][{$idx}]')\" ondoubleclick='return false;'";
                  $right = (preg_match("/[a-zA-Z]/", $val)) ? '' : ' right';
                  $out .= "<td class='ts_cell$right'$click>".$val."</td>";
               }
               $out .= "</tr>\n";
            } else {
               $out .= join("\t", $vals)."\n";
            }
         }
         $seen[$row['EmployeeID']] = 1;
      }
      return $out;
   }
   
   function exportPayroll($start, $end, $html='', $tally='') {
      $boss = new boss();
      
      $start = (!$start) ? time() - (date('w', time()) * 86400) : $start;
      $startDate = date("Y-m-d", $start);

      $end = (!$end) ? $start + (60 * 60 * 24 * 30) : $end;
      $endDate = date("Y-m-d", $end);

      $this->doPayroll($start, $end, $tally);
      $boss->db->addResource('Payroll');
      $prfields = "Payroll.EmployeeID,Name,PayNum,TaxFreq,CancelPay,Payroll.TotalHours,Payroll.RegEarnings,Payroll.VacationHours,Payroll.SickHours,Payroll.BonusEarnings,Payroll.HolidayEarnings,Payroll.RetroEarnings,Payroll.BereavementEarnings,Payroll.MedicalRemitEarnings,Payroll.AdjustParking,Payroll.PeriodStart";
      $boss->db->dbobj->execute("select $prfields from Payroll, Employee where PeriodStart='{$startDate}' and Payroll.EmployeeID=Employee.EmployeeID and Employee.PayStatus='salary' order by Employee.LastName");
      $out = '';
      $fields = '';
      while ($row = $boss->db->dbobj->fetch_array()) {
         if (!$fields) {
            foreach ($row as $field=>$val) {
               if (preg_match("/\D/", $field) && (!preg_match("/PayrollID|LastModified|Created/", $field))) {
                  $fields[] = preg_replace("/([a-z])([A-Z])/", '$1 $2', $field); 
               }
            }
            if ($html) {
               $out .= "<tr><th class='ts_head'>".join("</th><th class='ts_head'>", $fields)."</th></tr>\n";
            } else {
               $out .= join("\t", $fields)."\n";
            }
         }
         if (!$seen[$row['EmployeeID']]) {
            $vals = array();
            foreach ($row as $key=>$val) {
               if (preg_match("/\D/", $key) && (!preg_match("/PayrollID|LastModified|Created/", $key))) {
                  $vals[$key] = $val;
               }
            }
            if ($html) {
               $out .= "<tr>";
               foreach ($vals as $idx=>$val) {
   //               $click = " onclick=\"editPayroll(this, 'Payroll[{$vals['PayrollID']}][{$idx}]')\" ondoubleclick='return false;'";
                  $right = (preg_match("/[a-zA-Z]/", $val)) ? '' : ' right';
                  $out .= "<td class='ts_cell$right'$click>".$val."</td>";
               }
               $out .= "</tr>\n";
            } else {
               $out .= join("\t", $vals)."\n";
            }
         }
         $seen[$row['EmployeeID']] = 1;
      }
      return $out;
   }
   /*
   function exportPayroll($start, $end, $html='', $tally) {
      $boss = new boss();
      
      $start = (!$start) ? time() - (date('w', time()) * 86400) : $start;
      $startDate = date("Y-m-d", $start);

      $end = (!$end) ? $start + (60 * 60 * 24 * 30) : $end;
      $endDate = date("Y-m-d", $end);

      $this->doPayroll($start, $end, $tally);
      $boss->db->addResource('Payroll');
      $boss->db->dbobj->execute("select * from Payroll where PeriodStart>='{$startDate}'");
      $out = '';
      $fields = '';
      while ($row = $boss->db->dbobj->fetch_array()) {
         if (!$fields) {
            foreach ($row as $field=>$val) {
               if (preg_match("/\D/", $field) ) {
                  $fields[] = preg_replace("/([a-z])([A-Z])/", '$1 $2', $field); 
               }
            }
            if ($html) {
               $out .= "<tr><th class='ts_head2'>".join("</th><th class='ts_head2'>", $fields)."</th></tr>\n";
            } else {
               $out .= join("\t", $fields)."\n";
            }
         }
         $vals = array();
         foreach ($row as $key=>$val) {
            if (preg_match("/\D/", $key)) {
               $vals[$key] = $val;
            }
         }
         if ($html) {
            $out .= "<tr>";
            foreach ($vals as $idx=>$val) {
//               $click = " onclick=\"editPayroll(this, 'Payroll[{$vals['PayrollID']}][{$idx}]')\"";
               $right = (preg_match("/[a-zA-Z]/", $val)) ? '' : ' right';
               $out .= "<td class='ts_cell$right'$click>".$val."</td>";
            }
            $out .= "</tr>\n";
         } else {
            $out .= join("\t", $vals)."\n";
         }
      }
      return $out;
   }
*/
   function listEmployees($id) {
      $boss = new boss();
      $searchEmployee['Employee'];
      $employeeID = $boss->searchObject('Employee', $searchEmployee, '', '', 'LastName');
      $out = '';
      foreach ($employeeID as $value) {
         $employee = $boss->getObject('Employee', $value);
         $out .= '<option' .  ($id == $employee->EmployeeID ? ' SELECTED' : '' ) . ' value="' . $employee->EmployeeID . '">' . $employee->LastName.', ' . $employee->FirstName . '</option>';
      }
      return $out;
   }
   function generatePassword ($length = 10) {
     // start with a blank password
     $password = "";

     // define possible characters
     $possible = '0123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ!@#$%^&'; 
       
     // set up a counter
     $i = 0; 
       
     // add random characters to $password until $length is reached
     while ($i < $length) { 

       // pick a random character from the possible ones
       $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
           
       // we don't want this character if it's already in the password
       if (!strstr($password, $char)) { 
         $password .= $char;
         $i++;
       }

     }

     // done!
     return $password;
   }
   
   function getEmployeeTime($empID, $start) {
      global $boss;
      $employee = $boss->getObject('Employee', $empID);
      
      // Save actual timeperiod start since we're going to munge $start
      $periodstart = $start;

      /**
       * Calculate beginning of week (last Sunday) for requested period date
       * by subtracting the day of the week for our period (0=Sun,1=Mon, etc) 
       * multiplied by the # of seconds in a day (86400) from $start
       *
       **/
      $startday = date("w", $start);
      $start -= ($startday * 86400);
      
      $start2 = $start + (7 * 86400);
      $start3 = $start + (14 * 86400);
      $start4 = $start + (21 * 86400);
      
      for ($i=0; $i < 4; $i++) {
         $week[$i] = $start + (($i * 7) * 86400);
      }

      $endtmp = date("d", $periodstart);
      $end = ($endtmp<20) ? strtotime(date("Y-m-20", $periodstart)) : strtotime(date("Y-m-5", $periodstart + 1209600));
      $boss->payroll->tallyPunches($start, $end, $empID);

      for ($i=0; $i<3; $i++) {
         $punches[$i] = $boss->payroll->buildPunchTable($week[$i], ($week[$i+1] - 60), $empID, 1, 0, $periodstart, $end);
         list($hours[$i], $totals[$i]) = $boss->payroll->buildHourTable($week[$i], ($week[$i+1] - 60), $empID, 1, 0, $periodstart, $end);
      }

      $out['Punches'] = $punches;
      $out['Hours'] = $hours;
      $out['Totals'] = $totals;

      return $out;
   }
   
   function buildPayperiodSelect($current) {
      // Build date selection box for 1 years worth of payperiods
      $sixago = strtotime("6 months ago");
      $sixagoDate = date('Y-m-1', $sixago);
      $sixago = strtotime($sixagoDate);
      $now = time();
      
      for ($i=0; $i<12; $i++) {
         $val = date("Y-m-06", $sixago);
         $val .= date(":Y-m-20", $sixago);
         
         $val2 = date("Y-m-21", $sixago);
         $val2 .= date(":Y-m-5", $sixago + 2768400);
         
         $s = ($val == $current) ? ' SELECTED' : '';
         $out .= "<option value='$val'$s>".date("F 6, Y", $sixago).' - '.date("F 20, Y", $sixago)."</option>\n";
         
         $s = ($val2 == $current) ? ' SELECTED' : '';
         $out .= "<option value='$val2'$s>".date("F 21, Y", $sixago).' - '.date("F 5, Y", $sixago + 2764800)."</option>\n";

         $sixago += ((date("t", $sixago) * 86400) + 86400);  // Additional day added to compensate for daylight savings hour
         $sixagoDate = date('Y-m-1', $sixago);
      }
      return $out;
   }

   function getMyEmployees($supID) {
      $search['Employee']['search']['SupervisorID'] = $supID;
      $boss = new boss();
      $ids = $boss->searchObject('Employee', $search, '', '', 'LastName');
      $out = array();

      if (count($ids)) {
         foreach ($ids as $id) {
            $emp = $boss->getObject('Employee', $id);

         }
      }

      return $out;
   }

   function getPayrollDates($start) {
      $start = (!$start) ? time() - (date('w', time()) * 86400) : strtotime($start);
      $end = (!$end) ? $start + (60 * 60 * 24 * 7) : $end;
      
      if (date("d", $start) > 19) {
         $out['start'] = strtotime(date("Y-m-20", $start));
         $out['end'] = strtotime(date("Y-m-5", $start + 1209600));
      } else {
         $out['start'] = strtotime(date("Y-m-06", $start));
         $out['end'] = strtotime(date("Y-m-20", $start));
      }
      
      return $out;
   }
}
if ($boss && !$boss->payroll) $boss->payroll = new Payroll();

?>
