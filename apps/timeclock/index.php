<?php
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/payroll_class.php");
   
   if (($in['x'] == 'update') && ($_SESSION['UserID'])) {
      $boss->db->addResource('Timeclock');
      $tc = $boss->db->Timeclock;
      $tc->getlist("Date='".date("Y-m-d", time())."' AND Punch='{$in['p']}' AND EmployeeID='{$_SESSION['Employee']->EmployeeID}'");
      if (!count($tc->Timeclock) ) {
         $out['Timeclock']['new1']['Date'] = date("Y-m-d", time());
         $out['Timeclock']['new1']['Time'] = date("H:i:s", time());
         $out['Timeclock']['new1']['Punch'] = $in['p'];
         $out['Timeclock']['new1']['Type'] = (($in['p'] == 'lunch') || ($in['p'] == 'out')) ? 'out' : 'in';
         $out['Timeclock']['new1']['EmployeeID'] = $_SESSION['Employee']->EmployeeID;
         
         if (!$in['auto']) {
            $boss->storeObject($out, 'Timeclock');
         } else if ($in['auto'] && $_SESSION['Employee']->AutoLogin) {
            $js = "alert('You have been automatically clocked-in.');";
            $boss->storeObject($out, 'Timeclock');
         }
      } else {
         if (!$in['auto']) {
            $js = "alert('Invalid request for time punch.\\n Requested punch type,{$in['p']}, has already been completed at {$tc->Timeclock[0]->Time}.\\n\\nTimeclock punch has NOT been recorded.');";
         }
      }
   }
   $boss->payroll = new Payroll();

   $timechart = $boss->payroll->buildPunchTable('', '', $_SESSION['Employee']->EmployeeID, '', 1);
   
   $today = $boss->payroll->getTimeclock(time(), time(), $_SESSION['Employee']->EmployeeID);
   $nowdays = date("Y-m-d-D", time());
   $nows = preg_split("/\-/", $nowdays);
   $now = $today[$nows[0]][$nows[1]][$nows[2]];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title>MyPunchcard.com Timeclock</title>
      <link rel='stylesheet' type='text/css' href='/lib/css/core.css' />
      <link rel='stylesheet' type='text/css' href='local.css' />
      <script language='JavaScript' type='text/javascript' src='/lib/js/default.js' ></script>
      <script language='JavaScript' type='text/javascript' >
         var workflop = 0;
         function calcTime() {
            var punches = mypunches;
            var now = new Date();
            var times = new Array();
            if (punches['in']) times['in'] = parseTime(punches['in']);
            if (punches['lunch']) times['lunch'] = parseTime(punches['lunch']);
            if (punches['return']) times['return'] = parseTime(punches['return']);
            if (punches['out']) times['out'] = parseTime(punches['out']);

            var total = 0;

            if (punches['in'] && !punches['lunch'] && !punches['return'] && !punches['out']) {
               total = now.getTime() - times['in'].getTime();
            } else if (punches['in'] && punches['lunch'] && !punches['return'] && !punches['out']) {
               total = times['lunch'].getTime() - times['in'].getTime();
            } else if (punches['in'] && punches['lunch'] && punches['return'] && !punches['out']) {
               total = (times['lunch'].getTime() - times['in'].getTime()) + (now.getTime() - times['return'].getTime());
            } else if (punches['in'] && punches['lunch'] && punches['return'] && punches['out']) {
               total = (times['lunch'].getTime() - times['in'].getTime()) + (times['out'].getTime() - times['return'].getTime());
            } else if (punches['in'] && !punches['lunch'] && !punches['return'] && punches['out']) {
               total = times['out'].getTime() - times['in'].getTime();
            }
            var timeCnt = document.getElementById('workedTime' + workflop);
            if (total < 0) total = 1;
            if (timeCnt) {
               timeCnt.innerHTML = prettyTime(total);
               timeCnt.style.width = '250px';
               timeCnt.style.display = 'block';

               setTimeout(function() { calcTime(punches); }, 10000);
               setTimeout("document.getElementById('" + ('workedTime' + (workflop ^ 1)) + "').style.display = 'none';", 50);
            }
         }

         var mytime;
         function prettyTime(mytime) {
            mytime = mytime / 1000;
            var hrs = parseInt(mytime / 3600);
            mytime -= (hrs * 3600);
            var min = parseInt(mytime / 60);
            mytime -= (min * 60);
            var sec = mytime;

            return ((hrs<10) ? '0' + hrs : hrs) + ':' + ((min < 10) ? '0' + min : min); // + ':' + ((sec<10) ? '0' + sec : sec);
         }
         
         function parseTime(mytime) {
            var hrs = mytime.replace(/^(\d\d*)\:.*/, '$1');
            var min = mytime.replace(/(\d\d*):(\d\d*).*/, '$2');
            hrs = hrs.replace(/^0/, '');
            hrs = parseInt(hrs);
            min = min.replace(/^0/, '');
            min = parseInt(min);
            if (mytime.match(/p/i) && hrs!=12) hrs += 12;
            if (mytime.match(/a/i) && hrs==12) hrs = 0;

            var mydate = new Date();
            mydate.setHours(hrs);
            mydate.setMinutes(min);

            return mydate;
         }
         <?php 
            print $js; 
            print "/*\n";
            print_r($now);
            print "\n*/\n";
            print "var mypunches = " . json_encode($now) . ";\n";
         ?>
         setTimeout("calcTime();", 500);
      </script>
   </head>
   <body>
         <div id='titlebarFrame'>
            <div id='titlebarStripe1'> </div>
            <div id='titlebarStripe2'> </div>
            <div id='titlebarStripe3'> </div>
         </div>

<div id='timeclock'>
   <div class='panelRight'> </div>
   <div class='panelLeft'>
      <div class='clockButtons'>
         <a href='timeclock.php?x=update&p=in' onclick="<?php print ($now['in']) ? 'return false;' : "doCheck('in')"; ?>"><img style='position:relative;' src='<?php print ($now['in']) ? '/img/btns/btn_clockin-disabled.png' : '/img/btns/btn_clockin.png'; ?>' border='0' onmouseover="if (this.className=='btnEnabled') this.src='/img/btns/btnx_clockin.png';" onmouseout="if (this.className=='btnEnabled') this.src='/img/btns/btn_clockin.png';" onmousedown="if (this.className=='btnEnabled') this.style.top='2px';" onmouseup="if (this.className=='btnEnabled') this.style.top='0px';" class='<?php print ($now['in']) ? 'btnDisabled' : 'btnEnabled'; ?>' /></a><br/>
         <a href='timeclock.php?x=update&p=lunch' onclick="<?php print ($now['in'] && !$now['lunch'] && !$now['out']) ? "doCheck('lunch')" : 'return false;' ; ?>"><img style='position:relative;' src='<?php print ($now['in'] && !$now['lunch']) ? '/img/btns/btn_lunch.png' : '/img/btns/btn_lunch-disabled.png'; ?>' border='0' onmouseover="if (this.className=='btnEnabled') this.src='/img/btns/btnx_lunch.png';" onmouseout="if (this.className=='btnEnabled') this.src='/img/btns/btn_lunch.png';" onmousedown="if (this.className=='btnEnabled') this.style.top='2px';" onmouseup="if (this.className=='btnEnabled') this.style.top='0px';" class='<?php print ($now['in'] && !$now['lunch'] && !$now['out']) ? 'btnEnabled' : 'btnDisabled'; ?>' /></a><br/>
         <a href='timeclock.php?x=update&p=return' onclick="<?php print ($now['lunch'] && !$now['return']) ? "doCheck('return')" : 'return false;'; ?>"><img style='position:relative;' src='<?php print ($now['lunch'] && !$now['return']) ? '/img/btns/btn_return.png' : '/img/btns/btn_return-disabled.png'; ?>' border='0' onmouseover="if (this.className=='btnEnabled') this.src='/img/btns/btnx_return.png';" onmouseout="if (this.className=='btnEnabled') this.src='/img/btns/btn_return.png';" onmousedown="if (this.className=='btnEnabled') this.style.top='2px';" onmouseup="if (this.className=='btnEnabled') this.style.top='0px';" class='<?php print ($now['lunch'] && !$now['return']) ? 'btnEnabled' : 'btnDisabled'; ?>' /></a><br/>
         <a href='timeclock.php?x=update&p=out' onclick="<?php print ($now['out'] || (!$now['in'] && !$now['return'])) ? 'return false;' : "doCheck('out')"; ?>"><img style='position:relative;' src='<?php print (!$now['out'] && $now['in']) ? '/img/btns/btn_clockout.png' : '/img/btns/btn_clockout-disabled.png'; ?>' border='0' onmouseover="if (this.className=='btnEnabled') this.src='/img/btns/btnx_clockout.png';" onmouseout="if (this.className=='btnEnabled') this.src='/img/btns/btn_clockout.png';" onmousedown="if (this.className=='btnEnabled') this.style.top='2px';" onmouseup="if (this.className=='btnEnabled') this.style.top='0px';" class='<?php print (!$now['out'] && ($now['in'] || $now['return'])) ? 'btnEnabled' : 'btnDisabled'; ?>' /></a><br/><br/><br/>
         <div class='myhours' id='VacationHours' style='display:none;'><div class='hoursLabel'>Vacation:</div> <?php print $_SESSION['Employee']->VacationHours; ?> hrs.</div>
         <div class='myhours' id='SickHours' style='display:none;'><div class='hoursLabel'>Sick Time:</div> <?php print $_SESSION['Employee']->SickHours; ?> hrs.</div>
      </div>
   </div>
   <div class='panelCenter'>
      <div id='clockDiv'>
         <img src='/img/timeclock.png' height='323' width='261' style='position:absolute;top:-40px;left:-35px;width:261px;height:323;z-index:99999;'/>
         <div id='clockWrap'>
            <iframe width='186' height='140' border='0' src='http://apps.eky.hk/css3clock/'></iframe>
         </div>
      </div>
      <div id='timesheet'>
         <table border='0' cellpadding='0' cellspacing='0' class='ts_table'>
               <?php print $timechart; ?>
         </table>
      </div>
      <div id='timeWrap'>
         <div id='clockDate'>January 5, 2006</div>
         <div id='clockLabel'>Current Time:</div>
         <div id='clockTime0' class='clockTime'>12:00:00 AM</div>
         <div id='clockTime1' class='clockTime'>12:00:00 AM</div>
         <div id='workedLabel'>Hours Worked:</div>
         <div id='workedTime0' class='workedTime' style='display:block;'>00:00</div>
         <div id='workedTime1' class='workedTime'>00:00</div>
      </div>
   </div>
</div>
<div class='instructions'>
<h1>Welcome to <i>Simple Software, Inc.</i> <u>Online Timeclock</u>!</h1>
<p> Notice the buttons on the left of the clock image. When begining your shift click on the <b>'In For Work'</b>
button to clock-in. When taking a lunch break & returning from break click on <b>'Out for Lunch'</b> & <b>'return'</b>. Finally, when your shift has ended click on <b>'Clock Out'</b>.</p>
<p> Each button will become available depending on the status of your clock-in's for the day.</p>
<p>You may view your timecard for any payperiod by selecting the <b>'Timecard'</b> entry located in the left navigation
pane.</p>
<p>Preferences and settings for your account, including the ability to change your password, is located in the <i>'Preferences'</i> entry in the left navigation.</p>
                                                                                              
                                                                                              </div>

<script language='JavaScript' type='text/javascript'>
   updateDate('clockDate');
   updateTime('clockTime', <?php print (time() * 1000); ?>);
</script>
</body>
</html>
