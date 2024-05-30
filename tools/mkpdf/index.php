<?php
   session_start();
// wkhtmltopdf -s Letter https://dharristours.simpsf.com/clients/dharristours/templates/InvoiceReport.php?z=SUQ9MjIyNDcjSW52b2ljZVJlcG9ydA== 14840.pdf
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/boss_class.php");

   $srvName = ($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : "admin.dev.sscsf.com";
   
   $boss = new boss($srvName);
   $boss->docroot = $_SERVER['DOCUMENT_ROOT'] . $boss->app->Assets;

   $in = $_REQUEST;
   
   if ($in['z']) {
      $qs = base64_decode($in['z']);

      $parts = explode('&', $qs);
      $cnt = count($parts);

      for ($i=0; $i < $cnt; $i++) {
          list($key, $val) = preg_split("/=/", $parts[$i]);
          $in[urldecode($key)] = preg_replace("/\#.*/", '', urldecode($val));
      }
   }
   if ($in['saveto']) {
      $m = "";
      if (isset($in['type'])) {
         if ($in['type'] == "MasterInvoice") {
            $m = "M";
         } else if ($in['type'] == "Confirmation") {
            $m = "C";
         }
      }
      $save = $boss->docroot . '/' . $in['saveto'] . $in['ID'] . $m . '.pdf';
   }
   $url = [];
   if (isset($in['pages'])) {
      $pages = preg_split("/,/", $in['pages']);
      foreach ($pages as $page) {
         $url[] = escapeshellarg("https://dharristours.simpsf.com/files/templates/InvoiceReport.php?ID=".$page);
      }
   }
   $in['url'] = escapeshellarg($in['url']);

   $cmd = "/usr/local/bin/wkhtmltopdf -q --print-media-type -L 5mm -R 5mm -T 5mm -B 5mm -s Letter " . $in['url'] . " " . join(" ", $url)." $save";

   $results = `$cmd`;
   file_put_contents("/tmp/mkpdf.log", "---------------------\n". $cmd."\n". $results."\n-------------------\n", FILE_APPEND);
?>
<!doctype html>
<html>
<head>
   <style>
      body { font-family: "Helvetica Neue", "Helvetica", sans-serif; font-size: 18px; text-align:center; background-color:#fff;}
      .iconText { display:inline-block; width:200px; font-size:1.5em; color:#eee; text-shadow:1px 1px 2px rgba(0,0,0,.4);}
      h1, h2, h3 { color: #eee; text-shadow:2px 2px 2px rgba(0,0,0,.4); }
      a { text-decoration: none; color: #eee; font-size:1.5em; font-weight: 500; }
      a:hover { text-decoration: underline; color:#aaf; }
      .icon { display:inline-block; width:200px; }
      .result {
         background-color:#3F51B5; 
         display:inline-block;
         width: 32rem;
         border-radius: 1em; 
         padding:1em;
      }
   </style>
</head>
<body>

<?php
      $m = "";
      if (isset($in['type'])) {
         if ($in['type'] == "MasterInvoice") {
            $m = "M";
         } else if ($in['type'] == "Confirmation") {
            $m = "C";
         }
      }
    $link = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/files/" . $in['saveto'] .  $in['ID'] . $m .'.pdf';
   print "<div class='result'><h1>Created  {$in['type']} ".$in['ID'].$m.".pdf</h1>";
   print "<a class='icon' href='$link'><img src='/tools/mkpdf/view.png' height='100' width='100' border='0' alt='View'></a>";
//   print "&nbsp;|&nbsp;";
   print "<a class='icon' download href='$link'><img src='/tools/mkpdf/download.png' height='100' width='100' border='0' alt='Download'></a>";
   print "<br>";
   print "<span class='iconText'><a href='$link'>View</a></span><span class='iconText'><a download href='$link'>Download</a></span><br></div>";

?>
</body>
</html>
