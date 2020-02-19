<?php
require_once('Spreadsheet/Excel/Writer.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/payroll_class.php');

$in = $_REQUEST;

if ($in['payperiod']) {
   $period = preg_split("/\:/", $in['payperiod']);
   $start = strtotime($period[0]);
   $end = strtotime($period[1]);
} else { 
   $start = (!$start) ? time() - (86400 * 14) : $start;
   $end = (!$end) ? $start + 1209600 : $end;
   
   if (date("d", $start) > 20) {
      $start = strtotime(date("Y-m-21", (time() - (1209600))));
      $end = strtotime(date("Y-m-5", time() + 1213200));
      $in['payperiod'] = date("Y-m-21", $start) . ':' . date("Y-m-5", $start + 1209600);
   } else {
      $end = strtotime(date("Y-m-20", time()));
      $start = strtotime(date("Y-m-06", time()));
      $in['payperiod'] = date("Y-m-06", $start) . ':' . date("Y-m-20", $start);
   }
}

$dates = preg_split("/\:/", $in['payperiod']);
$dates['start'] = date("m/d/Y", strtotime($dates[0]));
$dates['end'] = date("m/d/Y", strtotime($dates[1]));
if (date("d", strtotime($dates[1])) > 15) {
   $dates['payday'] = date("m/t/Y", strtotime($dates[1]));
} else {
   $dates['payday'] = date("m/15/Y", strtotime($dates[0]) + 1213200);
}

if ($in['x'] == "generate") {
   // Creating a workbook
   $workbook = new Spreadsheet_Excel_Writer();

   // sending HTTP headers
   $workbook->send('payroll.xls');

   // Creating a sheet
   $sheet =& $workbook->addWorksheet(date("m_d_Y", $start).'-'.date("m_d_Y", $end)." Payroll");

   $format = (object)array();
   $format->title =& $workbook->addFormat(array('size' => '16', 'bold' => '1'));
   $format->label =& $workbook->addFormat(array('size' => '12', 'bold' => '1', 'align' => 'right'));
   $format->bold =& $workbook->addFormat(array('bold' => '1'));
   $format->center =& $workbook->addFormat(array('align' => 'center'));
   $format->boldcenter =& $workbook->addFormat(array('bold' => '1', 'align' => 'center'));
   $format->heading =& $workbook->addFormat(array('border' => '2', 'align' => 'center', 'bold' => '1', 'valign' => 'vcenter'));
   $format->nameheading =& $workbook->addFormat(array('border' => '2', 'align' => 'right', 'bold' => '1', 'valign' => 'vcenter', 'color' => 'blue'));
   $format->money =& $workbook->addFormat(array('NumFormat' => '$#.00;[Red]($#.00)', 'align' => 'right', 'align' => 'vcenter', 'border' => '1', 'locked' => '1'));
   $format->cell =& $workbook->addFormat(array('border' => '1', 'align' => 'vcenter'));
   $format->name =& $workbook->addFormat(array('valign' => 'vcenter', 'border' => '1', 'align' => 'right'));
   $format->hours =& $workbook->addFormat(array('NumFormat' => '0.00', 'align' => 'right', 'align' => 'vcenter', 'border' => '1', 'locked' => '1'));
   $format->total =& $workbook->addFormat(array('NumFormat' => '#.00', 'align' => 'center', 'align' => 'vcenter', 'border' => '2', 'bold' => '1', 'locked' => '1'));
   $format->boldtotal =& $workbook->addFormat(array('NumFormat' => '#.00', 'align' => 'center', 'align' => 'vcenter', 'right' => '2', 'top' => '1', 'bottom' => '1', 'left' => '2', 'bold' => '1', 'locked' => '1'));
   $format->totallabel =& $workbook->addFormat(array('size' => '12', 'bold' => '1', 'align' => 'right', 'border' => '2'));
   $format->date =& $workbook->addFormat(array('border' => '1', 'align' => 'center', 'valign' => 'vcenter', 'bold' => '1', 'top' => '1', 'bottom' => '1', 'left' => '2', 'right' => '2'));

   $format->time =& $workbook->addFormat(array("NumFormat" => "h:mm am/pm", 'border' => '1', 'align' => 'center', 'valign' => 'vcenter', 'top' => '1', 'bottom' => '1', 'left' => '1', 'right' => '1'));

   // Setup title and adjust column A width
   $sheet->setColumn(0, 0, 30);
   $sheet->setColumn(1, 12, 10);
   $sheet->write(0, 0, 'Simple Software Inc. / Payroll', $format->title);
   $sheet->mergeCells(0, 0, 0, 8);

   // Output the pay period
   $sheet->write(2, 0, 'Pay Period:', $format->label);
   $sheet->write(2, 1, $dates['start']);
   $sheet->write(2, 2, 'To', $format->boldcenter);
   $sheet->write(2, 3, $dates['end']);

   // Output pay date
   $sheet->write(3, 0, 'Pay Date:', $format->label);
   $sheet->write(3, 1, $dates['payday']);

   // ADP info
   $sheet->write(4, 0, "", $format->label);
   $sheet->mergeCells(4, 0, 4, 3);

   // Payroll Overview Table
   $sheet->write(6, 0, 'Employee', $format->heading);
   $sheet->write(6, 1, 'Reg. Hrs', $format->heading);
   $sheet->write(6, 2, 'Reg. Pay', $format->heading);
   $sheet->write(6, 3, 'OT Hrs', $format->heading);
   $sheet->write(6, 4, 'OT Pay', $format->heading);
   $sheet->write(6, 5, 'Vac. Hrs', $format->heading);
   $sheet->write(6, 6, 'Vac. Pay', $format->heading);
   $sheet->write(6, 7, 'Salary Pay', $format->heading);
   $sheet->write(6, 8, 'Other Pay', $format->heading);
   $sheet->write(6, 9, 'Gross Pay', $format->heading);
   $sheet->write(6, 10, 'Advances', $format->heading);
   $sheet->setRow(6, 20);

   $row = $startrow = 7;

   // Output employee payroll overview data
   $search['Employee']['search']['Active'] = 1;
   $emp = $boss->searchObject('Employee', $search, '', '', 'EmployeeID');
   
   foreach ($emp as $id) {
      // First output employees name
      $employee = $boss->getObject('Employee', $id);
      $sheet->setRow($row, 17);

      $punches = $boss->payroll->getTimecard($start, $end, $id, true);
      $overview[$employee->EmployeeID]['row'] = $row;
// print_r($punches);

      if (count($punches)) {
         $time = Array();
         $time['Regular'] = 0;
         $time['Overtime'] = 0;
         $time['Doubletime'] = 0;

         $sheet->write($row, 0, $employee->Employee, $format->name);

         foreach ($punches as $year=>$months) {
            foreach ($months as $month=>$days) {
               foreach ($days as $day=>$punches) {
                  $time['Regular'] += $punches->Regular;
                  $time['Overtime'] += $punches->Overtime;
                  $time['Doubletime'] += $punches->Doubletime;
               }
               // $sheet->write($row, 1, $time['Total'], $format->hours);
               
               $hrscell = Spreadsheet_Excel_Writer::rowcolToCell($row, 1);
               $sheet->writeFormula($row, 2, "=(" . $hrscell . "*" . $employee->Rate . ")", $format->money);

               $addup1 = Spreadsheet_Excel_Writer::rowcolToCell($row, 2); 
               $addup2 = Spreadsheet_Excel_Writer::rowcolToCell($row, 8); 
               
               for ($i=3; $i<9; $i++) {
                  $sheet->writeBlank($row, $i, $format->money);
               }
               
               $addup1 = Spreadsheet_Excel_Writer::rowcolToCell($row, 2); 
               $addup2 = Spreadsheet_Excel_Writer::rowcolToCell($row, 4); 
               $addup3 = Spreadsheet_Excel_Writer::rowcolToCell($row, 6); 
               $addup4 = Spreadsheet_Excel_Writer::rowcolToCell($row, 7); 
               $addup5 = Spreadsheet_Excel_Writer::rowcolToCell($row, 8); 
               
               $sheet->writeFormula($row, 9, "=$addup1+$addup2+$addup3+$addup4+$addup5", $format->money);
          
               // $sheet->writeFormula($row, 9, "=SUM(" . $addup1 . ":" . $addup2 . ")", $format->money);
               $sheet->write($row, 10, '0', $format->money);
            }
         }
      } else {
         $sheet->write($row, 0, $employee->Employee, $format->name);

         for ($i=1; $i<9; $i++) {
            $sheet->writeBlank($row, $i, $format->money);
         }
         
         $addup1 = Spreadsheet_Excel_Writer::rowcolToCell($row, 2); 
         $addup2 = Spreadsheet_Excel_Writer::rowcolToCell($row, 4); 
         $addup3 = Spreadsheet_Excel_Writer::rowcolToCell($row, 6); 
         $addup4 = Spreadsheet_Excel_Writer::rowcolToCell($row, 7); 
         $addup5 = Spreadsheet_Excel_Writer::rowcolToCell($row, 8); 
         
         $sheet->writeFormula($row, 9, "=$addup1+$addup2+$addup3+$addup4+$addup5", $format->money);
         $sheet->write($row, 10, '0', $format->money);
      }
      $row++;   
   }

   // Output overview totals
   $sheet->write($row, 0, "Totals: ", $format->totallabel);
   for ($i=1; $i<11; $i++) {
      $addup1 = Spreadsheet_Excel_Writer::rowcolToCell($startrow, $i);
      $addup2 = Spreadsheet_Excel_Writer::rowcolToCell($row - 1, $i);

      $sheet->writeFormula($row, $i, "=SUM(" . $addup1 . ":" . $addup2 . ")", $format->total);
   }

   $row += 2;

   foreach ($emp as $id) {
      $empID[] = $id;
   }
   $startrow = $row;

   for ($e=0; $e<count($empID); $e++) {
      $id = $empID[$e];
      $employee = $boss->payroll->getTimeclock(strtotime($dates['start']), strtotime($dates['end']), $id, true);
       // print "Start: $start - " . date("m/d/Y", $start)."\n";
       // print "End: $end - " . date("m/d/Y", $end)."\n";
       // print_r($employee);
      $punches = $employee['Employee'][$id]->Timeclock;
// print_r($punches);
      if ($employee['Employee'][$id]->Employee) {
         $sheet->writeBlank($row, 1, $format->heading);
         $sheet->writeBlank($row, 2, $format->total);
         $sheet->write($row, 3, $employee['Employee'][$id]->Employee, $format->nameheading);
         $sheet->writeBlank($row, 4, $format->heading);
         $sheet->writeBlank($row, 5, $format->heading);
         $sheet->writeBlank($row, 6, $format->heading);
         $sheet->mergeCells($row, 3, $row, 6);

         $row++;
         $sheet->writeBlank($row, 1, $format->heading);
         $sheet->writeBlank($row, 2, $format->heading);
         $sheet->write($row, 3, 'Start', $format->heading);
         $sheet->write($row, 4, 'End', $format->heading);
         $sheet->write($row, 5, 'Lunch', $format->heading);
         $sheet->write($row, 6, 'Total', $format->heading);
         
         $row++;
         $myrow = $toprow = $row;

         $timecard = $boss->payroll->getTimecard($start, $end, $id, true);

         for ($i=$start; $i<=$end; $i+=86400) {
            $yr = date('Y', $i);
            $mo = date('m', $i);
            $dy = date('d', $i);
            $mon = date('M', $i);
            $day = date('D', $i);

            $dd = date('m/d', $i);
            
            // Convert normal time to metric time by stripping out the minutes 
            $today = $punches[$yr][$mo][$dy];
            
            $x = preg_split("/:/", $today['in']);
            $y = preg_split("/:/", $today['out']);
            
            $sheet->write($myrow, 1, $dd, $format->date);
            $sheet->write($myrow, 2, $day, $format->date);
            
            if ($today['lunch'] && $today['return']) {
               $lunchtime = (strtotime($today['return']) - strtotime($today['lunch'])) / 60;               
            } else {
               $lunchtime = 0;
            }

            if ($x[0] || $x[1]) {
               $xmin =  round($x[1] * 1.6667);
               if ($xmin < 10) {
                  $inhun = $x[0] .'.0'. $xmin;
               } else {
                  $inhun = $x[0] .'.'. $xmin;
               }
               $intime = $x[0].':'.$x[1];
            } else {
               $inhun = $intime = '';
            }
            // $intime = $inhun; // Comment this out for regular time
            
            if ($y[0] || $y[1]) {
               $ymin =  round($y[1] * 1.6667);
               if ($ymin < 10) {
                  $outhun = $y[0] .'.0'.  $ymin;
               } else {
                  $outhun = $y[0] .'.'.  $ymin;
               }
               $out = $y[0].':'.$y[1];
            } else {
               $out = '';
            }
            // $out = $outhun;   // Comment this out for regular time
            
            if ($intime) {
               $sheet->write($myrow, 3, $intime, $format->time);
            } else {
               $sheet->writeBlank($myrow, 3, $format->time);
            }

            if ($out) {
               $sheet->write($myrow, 4, $out, $format->time);
            } else {
               $sheet->writeBlank($myrow, 4, $format->time);
            }

            if ($lunchtime) {
               if ($lunchtime > 60) {
                  $h = round($lunchtime / 60);
                  $lunchtime = "$h:" . ($lunchtime - ($h * 60));
               } else {
                  $lunchtime = "0:" . $lunchtime;
               }
               $sheet->write($myrow, 5, $lunchtime, $format->time);
            } else {
               $sheet->writeBlank($myrow, 5, $format->hours);
            }

            $addup1 = Spreadsheet_Excel_Writer::rowcolToCell($myrow, 4); 
            $addup2 = Spreadsheet_Excel_Writer::rowcolToCell($myrow, 3); 
            $lunch = Spreadsheet_Excel_Writer::rowcolToCell($myrow, 5); 
            
            // $sheet->write($myrow, 5, $timecard[$yr][$mo][$dy]->Total, $format->boldtotal);

            $sheet->writeFormula($myrow, 6, '=((' . $addup1 . '-' . $addup2 . ') - ' . $lunch . ') * 24', $format->boldtotal);
            
            $dailies[date("Ymd", $i)][] = Spreadsheet_Excel_Writer::rowcolToCell($myrow, 6); 

            $myrow++;
         }
         
         $row = $myrow;
         
         $cellid = Spreadsheet_Excel_Writer::rowcolToCell($row, 6); 
         $sheet->writeFormula($overview[$id]['row'], 1, '=' . $cellid, $format->hours);
         
         $sheet->writeBlank($row, 1, $format->total);
         $sheet->writeBlank($row, 2, $format->total);
         $sheet->writeBlank($row, 3, $format->total);
         $sheet->writeBlank($row, 4, $format->total);
         $sheet->mergeCells($row, 1, $row, 5);
         $sheet->write($row, 5, 'Total: ', $format->totallabel);

         $addup1 = Spreadsheet_Excel_Writer::rowcolToCell($toprow, 6); 
         $addup2 = Spreadsheet_Excel_Writer::rowcolToCell($row - 1, 6); 
         
         $sheet->writeFormula($row, 6, "=SUM(".$addup1.":".$addup2.")", $format->total);

         $row += 2;
      } else {
         $sheet->writeBlank($overview[$id]['row'], 1, $format->hours);
      }
   }

   /*
   $sheet->write($startrow, 0, "Daily", $format->heading);
   $sheet->write($startrow + 1, 0, "Totals", $format->heading);
   $startrow += 2;
   $startcell = Spreadsheet_Excel_Writer::rowcolToCell($startrow, 0);

   if ($dailies) {
      foreach ($dailies as $daily) {
         $sheet->writeFormula($startrow, 0, "=".implode('+', $daily), $format->hours);
         $startrow++;
      }
   }
   $endcell = Spreadsheet_Excel_Writer::rowcolToCell($startrow-1, 0);
   $sheet->writeFormula($startrow, 0, "=SUM($startcell:$endcell)", $format->total);

   $sheet->writeBlank($startrow, 1, $format->total);
   */

   // Let's send the file
   $workbook->close();
} else { 

?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title>Payroll</title>
      <link rel='stylesheet' type='text/css' href='/lib/css/core.css' />
      <script language='JavaScript' type='text/javascript'>
         var employeeID = '<?php print $_SESSION['Employee']->EmployeeID; ?>';
         var keyDefs = [];
         keyDefs[9] = { cmd:'doTab(evt)' };
         keyDefs[27] = { cmd:'doEscape(evt)' };
          
         document.onkeypress = function(e) {  };
      </script>
   </head>
   <body>
       <div class='contentWrap'>
         <h1 style='font-size:1.6em;padding-left:4px;background-color:#ddd;margin:0;padding:.25em 0 .25em'>Timecard Manager</h1>
         <form name='mainform' id='mainform' method='post' action='doPayroll.php'>
         <input type='hidden' name='x' value='generate'/>
         <div id='toolbar'>
            <div id='period' style='margin-right:1em;float:left;color:#fff;padding-top:.25em;'>
               <span style='padding: 2px .5em 2px 1em;font-weight:bold;'>Pay period:</span><select style='padding:.5em;' onchange="document.mainform.submit();" name='payperiod' id='payperiod'>
                  <?php
                     print $boss->payroll->buildPayperiodSelect($in['payperiod']);
                  ?>
               </select>
            </div>
            <a href="#Generate Payroll" class='simpleButton' style='padding:4px 1em 0px 1em;margin-top:5px;' onclick='document.mainform.submit();'>Generate Payroll</a>
         </div>
         <br clear='left'/>
      </div>
   </body>
</html>
<?php

}

?>
