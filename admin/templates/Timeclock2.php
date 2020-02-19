<?php
   require_once('../lib/boss_class.php');
   session_start();

   $in =& $_REQUEST;
   $boss = new boss();
   
   if (($in['x'] == 'update') && ($_SESSION['UserID'])) {
      $out['Timeclock']['new1']['Date'] = 'now()';
      $out['Timeclock']['new1']['Time'] = 'now()';
      $out['Timeclock']['new1']['Punch'] = $in['p'];
      $out['Timeclock']['new1']['Type'] = (($in['p'] == 'lunch') || ($in['p'] == 'out')) ? 'out' : 'in';
      $out['Timeclock']['new1']['EmployeeID'] = $_SESSION['UserID'];

      $boss->storeObject($out, 'Timeclock');
   }
 
   $user = $boss->getObject('Employee', $_SESSION['UserID']);
   $times = $boss->utility->getTimeclock($boss);
   
   $lastSundaySec = time() - (date('w', time()) * 86400);
   $lastSunday = date("Y-m-d", $lastSundaySec);
   $sundays = preg_split("/\-/", $lastSunday);
   $rows = array();

   for ($i=0; $i<7; $i++) {
      $nowsec = $lastSundaySec + ($i * 86400);
      $nowdays = date("Y-m-d-D", $nowsec);
      $nows = preg_split("/\-/", $nowdays);
      $now = $times[$nows[0]][$nows[1]][$nows[2]];
      
      $head .= "<th class='ts_head'>".preg_replace("/^0/", '', $nows[1])."/".preg_replace("/^0/", '', $nows[2])."<br/>".$nows[3]."</th>\n";
      $rows['in'] .= "<td class='ts_cell ts_row0'>" . $now['in'] . "</td>\n";
      $rows['lunch'] .= "<td class='ts_cell ts_row0'>" . $now['lunch'] . "</td>\n";
      $rows['return'] .= "<td class='ts_cell ts_row0'>" . $now['return'] . "</td>\n";
      $rows['out'] .= "<td class='ts_cell ts_row0'>" . $now['out'] . "</td>\n";
   }

  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title>CatBank</title>
      <link rel='stylesheet' type='text/css' href='/lib/css/ui.css' />
      <link rel='stylesheet' type='text/css' href='/lib/css/default.css' />
      <script language='JavaScript' type='text/javascript' src='/lib/js/default.js' ></script>
   </head>
   <body>
      <div class='main'>

<div id='timeclock'>
   <div class='panelRight'> </div>
   <div class='panelLeft'>
      <div class='clockButtons'>
         <a href='/timeclock.php?x=update&p=in'><img src='/img/btn_in.png' border='0' onmouseover="this.src='/img/btnx_in.png';" onmouseout="this.src='/img/btn_in.png';" onmousedown="this.style.top='2px';" onmouseup="this.style.top='0px';" /></a><br/>
         <a href='/timeclock.php?x=update&p=lunch'><img src='/img/btn_out-lunch.png' border='0' onmouseover="this.src='/img/btnx_out-lunch.png';" onmouseout="this.src='/img/btn_out-lunch.png';" onmousedown="this.style.top='2px';" onmouseup="this.style.top='0px';" /></a><br/>
         <a href='/timeclock.php?x=update&p=return'><img src='/img/btn_in-lunch.png' border='0' onmouseover="this.src='/img/btnx_in-lunch.png';" onmouseout="this.src='/img/btn_in-lunch.png';" onmousedown="this.style.top='2px';" onmouseup="this.style.top='0px';" /></a><br/>
         <a href='/timeclock.php?x=update&p=out'><img src='/img/btn_out.png' border='0' onmouseover="this.src='/img/btnx_out.png';" onmouseout="this.src='/img/btn_out.png';" onmousedown="this.style.top='2px';" onmouseup="this.style.top='0px';" /></a><br/>
      </div>
   </div>
   <div class='panelCenter'>
      <div id='timesheet'>
         <table border='0' cellpadding='0' cellspacing='0' class='ts_table'>
            <tr>
               <th class='ts_head'>&nbsp;</th>
               <?php print $head; ?>
            </tr>
            <tr>
               <td class='ts_cell ts_label'>In</td>
               <?php print $rows['in']; ?>
            </tr>
            <tr>
               <td class='ts_cell ts_label'>Lunch</td>
               <?php print $rows['lunch']; ?>
            </tr>
            <tr>
               <td class='ts_cell ts_label'>Return</td>
               <?php print $rows['return']; ?>
            </tr>
            <tr>
               <td class='ts_cell ts_label'>Out</td>
               <?php print $rows['out']; ?>
            </tr>
         </table>
      </div>
      <div id='clockWrap'>
         <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width='150' height='150' id="clockObject">
            <param name="movie"   value="relog.swf"/>
            <param name="quality" value="high"/>
            <param name="bgcolor" value="#ffffff"/>
            <param name="wmode"   value="transparent"/>
            <param name="menu"    value="false"/>
            <embed src="relog.swf" quality="high" bgcolor="#ffffff"  width="150" height="150" wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" menu="false" id='clockBody2'> </embed>
         </object>
      </div>
      <div id='timeWrap'>
         <div id='clockDate'>January 5, 2006</div>
         <div id='clockTime0' class='clockTime'>12:00:00 AM</div>
         <div id='clockTime1' class='clockTime'>12:00:00 AM</div>
      </div>
   </div>
</div>
<script language='JavaScript' type='text/javascript'>
   updateDate('clockDate');
   updateTime('clockTime');
</script>
