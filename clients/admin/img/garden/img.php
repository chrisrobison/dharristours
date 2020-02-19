<?php
$util = new utility();
if (!function_exists('mime_content_type')) {
   function mime_content_type($f) {
      $f = escapeshellarg($f);
      return trim( `file -bi $f` );
   }
}
$in = $_REQUEST;
$in['path'] = preg_replace("/img.php/", '', $_SERVER['SCRIPT_FILENAME']);

   $in['relpath'] = preg_replace("/".preg_quote($_SERVER['DOCUMENT_ROOT'], '/')."/", '', $in['path']);
   $in['path'] = $_SERVER['DOCUMENT_ROOT'].$in['relpath'];

   if (is_dir($in['path'])) {
      $dh = opendir($in['path']);
      while ($file = readdir($dh)) {
         $icon = '';
         if ((!preg_match("/^\./", $file)) && (!preg_match("/CVS|\.bak|\.old|\.sw?/", $file))) {
            if (preg_match("/(jpg|png|gif)$/", $file)) {
               $imgs[] = $in['path'].'/'.$file;
               $parts = preg_split("/\./", $file);
               $ext = array_pop($parts);
               $thumbFile = join('.', $parts).'.png';
               $icon = $in['relpath'] .'/.thumbs/'.$thumbFile;
            } else if (is_dir($in['path'].'/'.$file)) {
               $icon = 'http://net2-dev.netoasis.net/img/aqua_folder_48.png'; 
            } else {
               // $mime = preg_replace("/\//", '-', mime_content_type($in['path'].'/'.$file));
               // $icon = (file_exists($_SERVER['DOCUMENT_ROOT']."/img/mimetypes/$mime.png")) ? "/img/mimetypes/$mime.png" : '/img/mimetypes/text.png';
            }
            if ($icon) print "<div style='float:left;border:1px solid #ccc;height:5em;width:5em;padding:4px;margin:1em;text-align:center;' class='fileIcon'><a style='text-decoration:none;color:#606060;text-align:center;font-size:9px;' target='_blank' href='{$in['relpath']}{$file}' class='iconLink' id='{$in['path']}/$file'><img src='$icon' height='48' width='48' border='0' style='margin-left:auto;margin-right:auto;'/><br/>$file</div>\n";
         }
      }
      closedir($dh);
      if (count($imgs)) { 
         $util->checkThumbs($imgs, $in['path'].'/.thumbs');
      }
   }

class utility {
   function checkThumbs($arr, $path, $type='png') {
      if (!file_exists($path)) mkdir($path, 0775);

      $spath = preg_replace("/\//", '\\/', $_SERVER['DOCUMENT_ROOT']);
      $webpath = preg_replace("/$spath/", '', $path);

      foreach ($arr as $idx=>$file) {
         $paths = preg_split("/\//", $file);
         $tmp = array_pop($paths);
         $tmp2 = preg_split("/\./", $tmp);
         $ext = array_pop($tmp2);
         $fn = join('.', $tmp2);
         $fn .= '.' . $type;

         if (!file_exists($path.'/'.$fn)) {
            $this->makeThumb($file, $path.'/'.$fn, 48, 48, 80);
         }
         $thumbs[$idx] = $webpath . '/' . $fn;
      }
      return $thumbs;
   }

   function makeThumb($src, $dest, $width, $height, $quality) {
      $size = getimagesize($src, $info);
      
      $types = array('', 'gif', 'jpeg', 'png');

      $type = $types[$size[2]];
      if ($type) {
         if ($type == 'jpeg' || $type='jpg') {
            $source = imagecreatefromjpeg($src);
         } else if ($type=='gif') {
            $source = imagecreatefromgif($src);
         } else if ($type='png') {
            $source = imagecreatefrompng($src);
         }
         
         if (($size[0] > $width) || ($size[1] > $height)) {
               
            if ($width && ($size[0] > $width) && ($size[0] > $size[1])) {
               $r = ($width / $size[0]);
               $width  = $r * $size[0];
               $height = $r * $size[1];
            } else if ($height && ($size[1] > $height) && ($size[1] > $size[0])) {
               $r = ($height / $size[1]);
               $width  = $r * $size[0];
               $height = $r * $size[1];
            } else {
               $width = $size[0];
               $height = $size[1];
            }
            
            if ($width && $height) {
               $thumb = $this->imagecreatetransparent($width, $height);
            }
            
            if ($thumb) {
               imagecopyresampled($thumb, $source, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
               imagepng($thumb, $dest, $quality);
            }
         } else {
            copy($src, $dest);
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
