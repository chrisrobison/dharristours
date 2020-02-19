<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title></title>
      <link rel='stylesheet' type='text/css' href='/lib/css/default.css' />
      <style>
         .rssItem { padding:1em 0px 1em 1em; margin:1em; border:1px solid #999; -moz-border-radius:1em;-webkit-border-radius:1em;border-radius:1em;max-width:400px;}
         .rssItem h2 { margin:0;padding:0; }
         .rssItem p.description { margin:.5em;padding:.5em; width:auto;}
         .rssItem p.description a { margin-left:1em; }
         .rssItem:hover { -moz-box-shadow:0px 0px 8px rgba(0,0,0,.4); -webkit-box-shadow:0px 0px 8px rgba(0,0,0,.4);box-shadow:0px 0px 8px rgba(0,0,0,.4);}
         .readMore { float:right; font-size:.8em;}
      </style>
  </head>
   <body>
      <div id='feed'>
         
      </div>
   </body>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type="text/javascript" src="/lib/js/getRSS.js"></script>
   <script type='text/javascript'>
      $(document).ready(function() {
         <?php
   $in = $_REQUEST;
   if ($in['z']) {
      $qs = base64_decode($in['z']);

      $parts = explode('&', $qs);
      $cnt = count($parts);

      for ($i=0; $i < $cnt; $i++) {
          list($key, $val) = preg_split("/=/", $parts[$i]);
          $in[urldecode($key)] = urldecode($val);
      }
   }


   $pid = $in['ProcessID'] = $in['pid'] = ($in['pid']) ? $in['pid'] : $in['ProcessID'];
            $url = ($in['pid']) ? 'rss.php?pid='.$in['pid'] : $in['feed'];
         ?>
         getRSS('<?php print $url ?>', $('#feed'));
      });
   </script>
</html>
