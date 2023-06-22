<!doctype html>
<html>
<head>
<title>Driver Jobs</title>
</head>
<body>
<div>
<?php
    $out = array();
    $dates = array();
    $jobs = array();
    $files = array();
    for ($i=1; $i<25; $i++) {
        $num = sprintf("%03d", $i);

        $lines = file("$num.txt", FILE_IGNORE_NEW_LINES);

        foreach ($lines as $idx=>$line) {
            if (preg_match("/Driver\sName:\s*([a-zA-Z\s]*)\s*/", $line, $match)) {
                $driver = trim(preg_replace("/Date[:\s]*.*/", '', $match[1]));
                $out[$num] = $driver;
                if (($driver == "LarryM") || ($driver == "Larry MM")) {
                  $driver = "Larry M";
               }
                if ($driver && !$files[$driver]) {
                  $files[$driver]  = array();
                  $files[$driver][]  = $num.".pdf";
               } else if ($driver && !in_array($num.".pdf", $files[$driver])) {
                  $files[$driver][]  = $num.".pdf";
               }
            }
            if (preg_match("/Job\sNumber:\s*(\d+)/", $line, $match)) {
               $jobid = $match[1];
               if ($driver) {
                  if (!$jobs[$driver]) {
                     $jobs[$driver] = array();
                  }
                  if (!in_array($match[1], $jobs[$driver])) {
                     $jobs[$driver][] = $match[1];
                     sort($jobs[$driver], SORT_NUMERIC);
                  }
               }
            }  
        }

    }
    $newout = array_unique($out);
   
   foreach ($files as $driver=>$pdfs) {
      foreach ($pdfs as $idx=>$pdf) {
         print "<a href='$pdf' target='viewer'>".$driver." - " . $pdf . "</a><br>\n";
      }
   }
   print_r($jobs);
?>
</div>
<iframe width='900' height='900' name='viewer' id='viewer' style='float:left;'></iframe>
</body>
</html>
