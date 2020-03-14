<?php
   $util = new utility();
   if (!function_exists('mime_content_type')) {
      function mime_content_type($f) {
         $f = escapeshellarg($f);
         return trim( `file -bi $f` );
      }
   }
   $in = $_REQUEST;
   
   if (!$in['path']) {
      $in['path'] = '/';
      // $in['path'] = preg_replace("/\/view.php/", '', $_SERVER['SCRIPT_NAME']);
      // $in['fullpath'] = preg_replace("/\/view.php/", '', $_SERVER['PATH_TRANSLATED']);
   }
   if (!preg_match("/^\//", $in['path'])) $in['path'] = '/'.$in['path'];
   if (!preg_match("/\/$/", $in['path'])) $in['path'] .= '/';
   $in['relpath'] = preg_replace("|//|", '/', $in['path']);
   $in['path'] = $_SERVER['DOCUMENT_ROOT'].$in['relpath']; //preg_replace("|//|", '/', preg_replace("|".$_SERVER['PHP_SELF']."|", '', $_SERVER['PATH_TRANSLATED'])).preg_replace("/\/?\~\w+\//", '', $in['relpath']);
   
  /* 
   print "<pre>";
   print_r($in);
   print_r($_SERVER);
   print "</pre>";
  */ 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
   <head>
      <title><?php print $in['path']; ?></title>
      <style>
         .icon {
            float: left;
            border: 1px solid rgba(0,0,0,.5);
            min-height: 130px;
            min-width: 135px;
            width: 140px;
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
            font-family: Optima,"Gill Sans","Gill Sans MT",sans-serif;
            text-decoration: none;
         }
         IMG.iconImage {
            margin-left: auto;
            margin-right: auto;
            border: 0px;
            width: 100px;
            height: 100px;
            max-height: 300px;
            max-width: 300px;
            margin-bottom: 4px;
         }

      </style>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
      <script type="text/javascript" src="jquery.magnifier.js"> </script>
      <script type='text/javascript'>
         $(document).ready(function() {

            $(".icon").hover(function(){$(this).css({'backgroundColor':'#ffff99'})},function(){$(this).css({'backgroundColor':'white'})});
         });
      </script>
   </head>
   <body>
<?php
   $limit = ($in['limit']) ? $in['limit'] : 25;
   $start = ($in['start']) ? $in['start'] : 0;
   $count = 0;

   if (is_dir($in['path'])) {
      $dh = opendir($in['path']);
      while ($file = readdir($dh)) {
         $icon = '';
         if ((!preg_match("/^\./", $file)) && (!preg_match("/CVS|\.bak|\.old|\.sw?/", $file))) {
            if (($count < $limit) && ($count >= $start)) {
               if (preg_match("/(jpg|png|gif)$/", $file)) {
                  $imgs[] = $in['path'].'/'.$file;
                  $parts = preg_split("/\./", $file);
                  $ext = array_pop($parts);
                  $thumbFile = join('.', $parts).'.png';
                  $href = $icon = $in['relpath'] .'/'. $file;
                  $tgt = "target='_blank'";
               } else if (is_dir($in['path'].'/'.$file)) {
                  $icon = 'http://net2-dev.netoasis.net/img/aqua_folder_48.png'; 
                  $href = preg_replace("|//|", '/', 'view.php?path=' . $in['relpath'] . '/' . $file);
                  $tgt = '';
               } else {
                  $mime = preg_replace("/\//", '-', mime_content_type($in['path'].'/'.$file));
                  $icon = (file_exists("/home/cdr/net2/img/mimetypes/$mime.png")) ? "http://net2-dev.netoasis.net/img/mimetypes/$mime.png" : 'http://net2-dev.netoasis.net/img/mimetypes/text.png';
               }
               $idpath = preg_replace("/\W/", "_", $href);
               $rel = ($idpath) ? "rel='magnify[$idpath]' " : "";
               if ($icon) print "<div class='icon shadow'><a $tgt $rel href='$href' class='iconLink'><img id='$idpath' src='$icon' class='iconImage' title='$href' /><br/>$file</div>\n";
               $count++;
            }
         }
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
