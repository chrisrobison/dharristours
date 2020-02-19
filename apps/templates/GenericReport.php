<?php
   
   if ($report->Function) {
      $boss->utility->{$report->Function}();
   } else {
      $query = "select" . preg_replace("/^\s*select/i", "", $report->Query);
      $dh = $boss->db->dbobj->execute($query);

      print "<table cellpadding='.1em' cellspacing='0.5em' border='0' class='report'>\n\t";
      while ($row = mysql_fetch_object($dh)) {
         if (!$heading) {
            $heading = 1;
            print "<thead>\n\t\t<tr>"; 
            foreach ($row as $key=>$val) {
               $class = (is_numeric($val)) ? 'reportNumber' : 'listItemCell';
               $key = preg_replace("/([a-z0-9])([A-Z])/", "$1 $2", $key);
               print "<th class='$class'>{$key}</th>";
            }
            print "</tr>\n\t</thead>\n\t<tbody>\n";
         }

         print "\t\t<tr>\n";
         foreach ($row as $key=>$val) {
            $class = (is_numeric($val)) ? 'reportNumber' : 'listItemCell';
            if (preg_match("/(\d\d):(\d\d):\d\d/", $val, $matches)) {
               $min = $matches[2];
               $hr = preg_replace("/^0/", '', $matches[1]);
               $xm = "a";
               if ($matches[1] > 12) {
                  $xm = "p";
                  $hr -= 12;
               } 
               $val = $hr . ':' . $min . $xm;
               
            }
            print "<td class='$class'>{$val}</td>";
         }
         print "</tr>\n";
      }
      print "\t</tbody>\n</table>\n";
   }
?>
