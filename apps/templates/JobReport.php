<?php
   
   if ($report->Function) {
      $boss->utility->{$report->Function}();
   } else {
      $query = "select" . preg_replace("/^select/i", "", $report->Query);

      $dh = $boss->db->dbobj->execute($query);

      print "<table cellpadding='0' cellspacing='0' border='0' class='report'>\n\t";
      while ($row = mysql_fetch_object($dh)) {
         if (!$heading) {
            $heading = 1;
            print "<thead>\n\t\t<tr>";
            foreach ($row as $key=>$val) {
               $key = preg_replace("/([a-z0-9])([A-Z])/", "$1 $2", $key);
               print "<th>{$key}</th>";
            }
            print "</tr>\n\t</thead>\n\t<tbody>\n";
         }

         print "\t\t<tr>\n";
         foreach ($row as $key=>$val) {
            $class = (is_numeric($val)) ? 'reportNumber' : 'listItemCell';
            print "<td class='$class'>{$val}</td>";
         }
         print "</tr>\n";
      }
      print "\t</tbody>\n</table>\n";
   }
?>
