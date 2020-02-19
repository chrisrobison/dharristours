<?php
   require_once("boss_class.php");

   $obj = new boss();

   $in =& $_REQUEST;

   if (!$in['ReportID']) $in['ReportID'] = 6;

   $report = $obj->getObject('Report', $in['ReportID']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
   <head>
      <title><?php print $report->apps/templates/Report; ?></title>
      <link rel='stylesheet' type='text/css' href='lib/css/default.css' />
      <link rel='stylesheet' type='text/css' href='lib/css/ui.css' />
   </head>
   <body>
      <div class='report' style='margin: 2em;'>
      <h1><?php print $report->Report; ?></h1>
      <?php   
         if ($report->Template) include($report->Template);
      ?>
      </div>
   </body>
</html>
