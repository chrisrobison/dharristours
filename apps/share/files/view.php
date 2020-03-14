<?php
require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
   // $util = new utility();
   if (!function_exists('mime_content_type')) {
      function mime_content_type($f) {
         $f = escapeshellarg($f);
         return trim( `file -bi $f` );
      }
   }
   $inpath = $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets . '/share/';
   $in = $_REQUEST;
//   print_r($inpath); 
   if (!$in['path']) {
      $in['path'] = $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets . '/share/';
      // $in['path'] = preg_replace("/\/view.php/", '', $_SERVER['SCRIPT_NAME']);
      // $in['fullpath'] = preg_replace("/\/view.php/", '', $_SERVER['PATH_TRANSLATED']);
   }
   $in['page'] = $in['page'] ? $in['page'] : 1;
   $in['oempath'] = $in['path'];
   $in['fullpath'] = preg_replace("|/files/view.php.*|", '', $_SERVER['SCRIPT_FILENAME']).$in['path'];
   $in['path'] = preg_replace("|/files/view.php.*|", '', $_SERVER['SCRIPT_NAME']).$in['path'];
   if (!preg_match("/^\//", $in['path'])) $in['path'] = '/'.$in['path'];
   if (!preg_match("/\/$/", $in['path'])) $in['path'] .= '/';
   $in['relpath'] = preg_replace("|//|", '/', $in['path']);
   $in['path'] = preg_replace("|//|", '/', $in['fullpath']);
   // $in['path'] = $_SERVER['DOCUMENT_ROOT'].$in['relpath']; //preg_replace("|//|", '/', preg_replace("|".$_SERVER['PHP_SELF']."|", '', $_SERVER['PATH_TRANSLATED'])).preg_replace("/\/?\~\w+\//", '', $in['relpath']);
   
   
   
   print "<!--";
   print_r($in);
   print_r($_SERVER);
   print "-->";
    
?>
<!DOCTYPE html>
<html>
   <head>
      <title><?php print $in['path']; ?></title>
      <style>
         body { font-family: sans-serif; }
         .icon {
            float: left;
            border: 1px solid rgba(0,0,0,.5);
            min-height: 50px;
            min-width: 50px;
            width: 125px;
            padding: 4px;
            margin: .5em;
            text-align: center;
            overflow: hidden;
            background-color: #ffffff;
         }
         .icon a:focus {
            background-color: #ffff99;
         }
         .shadow {
            box-shadow: 3px 5px 6px #818181;
            -webkit-box-shadow: 3px 5px 6px #818181;
            -moz-box-shadow: 3px 5px 6px #818181;
            filter: progid:DXImageTransform.Microsoft.dropShadow(color=#818181, offX=5, offY=3, positive=true);
         }
         A {
            text-align: center;
            color: #333;
            font-size: 10px;
            font-family: sans-serif;
            white-space:nowrap;
            text-decoration: none;
         }
         IMG.iconImage {
            margin-left: auto;
            margin-right: auto;
            border: 0px;
            width: auto;
            height: 100px;
            max-height: 200px;
            max-width: 200px;
            margin-bottom: 4px;
            /*
            -webkit-transform: scale(.25);
            -moz-transform: scale(.25);
            */
         }
         IMG.iconImage:hover {
            /*
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            */
         }
         #pageNav {
            clear:left;
            font-size:1.4em;
            position:fixed;
            bottom:0px;
            height:24px;
            padding:4px;
            color:#fff;
            background-color:rgba(0,0,0,.65);
            -moz-box-shadow: 0px -4px .75em rgba(0,0,0,.35);
            border-top:solid 1px #fff;
            font-weight:bold;
            text-align:right;
            left:0px;
            right:0px;
            font-family: Optima;
         }
         #pageNav a {
            color: #ddd;
            font-size:1.0em;
            font-weight:normal;
            font-family: Optima;
            text-decoration: underline;
            padding:0 2px;
         }
      </style>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
      <script type='text/javascript'>
         $(document).ready(function() {

            $(".icon").hover(function(){$(this).css({'backgroundColor':'#ffff99'})},function(){$(this).css({'backgroundColor':'white'})});
         });
      </script>
   </head>
   <body>
<?php

   if (is_dir($in['path'])) {
      $all = glob($in['path']."/*");
      $limit = ($in['limit']) ? $in['limit'] : 25;
      $total = count($all);
      $pages = round($total / $limit);
      $page = ($in['page']) ? $in['page'] : 1;
      $start = ($in['start']) ? $in['start'] : (($page - 1) * $limit);
      $done = $count = 0;
      $dh = opendir($in['path']);
      while ($file = readdir($dh)) {
         $icon = '';
         if ((!preg_match("/^\./", $file)) && (!preg_match("/CVS|\.bak|\.old|\.sw?/", $file))) {
            if (($done < $limit) && ($count >= $start)) {
               if (preg_match("/\.(jpg|png|gif)$/i", $file) && (!is_dir($in['path'].'/'.$file))) {
                  // $imgs[] = $in['relpath'].'/'.$file;
                  $parts = preg_split("/\./", $file);
                  $ext = array_pop($parts);
                  $thumbFile = join('.', $parts).'.png';
                  $href = $icon = preg_replace("|//|", '/', $in['relpath'] .'/'. $file);
                  $tgt = "target='_blank'";
               } else if (preg_match("/svg$/", $file)) {
                  $svg = $href = preg_replace("|//|", '/', $in['relpath'] .'/'. $file);
               } else if (is_dir($in['path'].'/'.$file)) {
                  //$icon = 'http://cdr2.com/img/aqua_folder_48.png'; 
                  $icon = 'http://cdr2.com/img/icons2/Futurosoft%20Icons%200.5.1/128x128/filesystems/folder.png';
                  $href = preg_replace("|//|", '/', 'view.php?path=' . $in['oempath'] . '/' . $file);
                  $tgt = '';
               } else {
                  if (is_readable($in['path'].'/'.$file)) $mime = preg_replace("/\//", '-', mime_content_type($in['path'].'/'.$file));
                  $icon = (file_exists("http://cdr2.com/img/mimetypes/$mime.png")) ? "http://cdr2.com/img/mimetypes/$mime.png" : 'http://cdr2.com/img/mimetypes/text.png';
               }
               $idpath = preg_replace("/\W/", "_", $href);
               //$rel = ($idpath) ? "rel='magnify[$idpath]' " : "";
               if ($icon) print "<div class='icon shadow'><a $tgt $rel href='$href' class='iconLink'><img id='$idpath' src='$icon' class='iconImage' title='".basename($href)."' /><br/>$file</a></div>\n";
               if ($svg) print "<div class='icon shadow'><a $tgt $rel href='$href' class='iconLink'><embed id='$idpath' src='$svg' class='iconImage' height='200' width='200' title='".basename($href)."'></embed><br/>$file</a></div>\n";
               ++$done;
            }
         }
         $count++;
      }
      if ($pages > 1) {
         print "<div id='pageNav'>";
         if ($page > 1) {
            print "<div style='float:left;'>Total files: {$total}  Viewing: $start - ".($start + $limit)."</div> <a href='{$_SERVER['REQUEST_URI']}&page=1'>&lt;&lt;</a> ";
            print " <a href='{$_SERVER['REQUEST_URI']}&page=".($page - 1)."'>&lt;</a> ";
         }
         for ($i = 0; $i<$pages+1; $i++) {
            if (($i+1) != $page) {
               print " <a href='{$_SERVER['REQUEST_URI']}&page=".($i+1)."'>".($i+1)."</a> ";
            } else {
               print " ".($i+1)." ";
            }
         }
         if ($page < $pages) {
            print " <a href='{$_SERVER['REQUEST_URI']}&page=".($page + 1)."'>&gt;</a> ";
            print " <a href='{$_SERVER['REQUEST_URI']}&page=".($pages + 1)."'>&gt;&gt;</a> ";
         }
         print "</div>";
      }
      closedir($dh);
/*      if (count($imgs)) {
         if (is_writable($in['path'])) {
            $util->checkThumbs($imgs, $in['path'].'/.thumbs');
         }
      }
*/
   }
?>
   </body>
</html>


<?php

class utility {
   function checkThumbs($arr, $path, $type='png') {
      if (!file_exists($path)) {
         @mkdir($path, 0775);
      }
      $spath = preg_replace("/\//", '\\/', $_SERVER['DOCUMENT_ROOT']);
      $webpath = preg_replace("/$spath/", '', $path);

      foreach ($arr as $idx=>$file) {
         $paths = preg_split("/\//", $file);
         $tmp = array_pop($paths);
         $tmp2 = preg_split("/\./", $tmp);
         $ext = array_pop($tmp2);
         $fn = join('.', $tmp2);
         $fn .= '.' . $type;
         $path = preg_replace("/\/$/", '', $path);

         if (!file_exists($path.'/'.$fn)) {
            $this->makeThumb($file, $path.'/'.$fn, 48, 48, 7);
         }
         $thumbs[$idx] = $webpath . '/' . $fn;
      }
      return $thumbs;
   }

   function makeThumb($src, $dest, $width, $height, $quality) {
      $buffer = mime_content_type($src);
      $mimeparts = preg_split("/\//", $buffer);
      
      $app = $mimeparts[0];
      $type = $mimeparts[1];
      
      if ($app == 'image') {
         $imginfo = getimagesize($src, $info);

         if ($type) {
            if (($type == 'jpeg' || $type=='jpg') || (preg_match("/\.jpg$/", $src))) {
               $source = @imagecreatefromjpeg($src);
            } else if (($type=='gif') || preg_match("/\.gif$/", $src)) {
               $source = @imagecreatefromgif($src);
            } else if (($type=='png') || preg_match("/\.png$/", $src)) {
               $source = @imagecreatefrompng($src);
            }

            if (!$source) {
               //print ("Error creating graphic from file: $src");
               return false;
            }

            if (($imginfo[0] > $width) || ($imginfo[1] > $height)) {
                  
               if ($width && ($imginfo[0] > $width) && ($imginfo[0] > $imginfo[1])) {
                  $r = ($width / $imginfo[0]);
                  $width  = $r * $imginfo[0];
                  $height = $r * $imginfo[1];
               } else if ($height && ($imginfo[1] > $height) && ($imginfo[1] > $imginfo[0])) {
                  $r = ($height / $imginfo[1]);
                  $width  = $r * $imginfo[0];
                  $height = $r * $imginfo[1];
               } else {
                  $width = $imginfo[0];
                  $height = $imginfo[1];
               }
               
               if ($width && $height) {
                  $thumb = $this->imagecreatetransparent($width, $height);
               }
               
               if ($thumb) {
                  @imagecopyresampled($thumb, $source, 0, 0, 0, 0, $width, $height, $imginfo[0], $imginfo[1]);
                  @imagepng($thumb, $dest, $quality);
               }
            } else {
               @copy($src, $dest);
            }
         }
      }
      return true;
   }

   function imagecreatetransparent($x, $y) {
      $out   = @imagecreatetruecolor($x, $y);
      if ($out) {
         imagesavealpha($out, true);
         imagealphablending($out, false);
         $tlo = imagecolorallocatealpha($out, 220, 220, 220, 127);
         imagefill($out, 0, 0, $tlo);
      }
      
      return $out;
   }
}
?>
