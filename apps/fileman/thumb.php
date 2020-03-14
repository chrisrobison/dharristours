<?php
   require_once('common.php');
   $in['img'] = $base . $in['img'];

   $in['x'] = (!$in['x']) ? 125 : $in['x'];
   $in['y'] = (!$in['y']) ? 125 : $in['y'];

   if ($in['img']) {
      $mimetype = mime_content_type($in['img']);

      if (preg_match("/^image/", $mimetype)) {
         $type = preg_replace("/^image\//", '', $mimetype);
         thumb($in['img'], $type, $in['x'], $in['y']);
      }
   }

   function thumb($img, $type, $maxX=0, $maxY=0) {
      $maxX = (!$maxX) ? $maxY : $maxX;
      $maxY = (!$maxY) ? $maxX : $maxY;

      $maxX = (!$maxX) ? 50 : $maxX;
      $maxY = (!$maxY) ? 50 : $maxY;
      
      $size = scale($img, $maxX, $maxY);

      if (function_exists("imagecreatefrom$type")) {
         eval("\$src = imagecreatefrom$type('$img');");
      }

      $dst = imagecreatetruecolor($size['newwidth'], $size['newheight']);
      imagealphablending($dst, false);
      imagesavealpha($dst, true);
      imagecopyresampled($dst, $src, 0, 0, 0, 0, $size['newwidth'], $size['newheight'], $size['width'], $size['height']);
      
      header("Content-type: image/png"); // . $type);

      imagepng($dst);

      imagedestroy($src);
      imagedestroy($dst);
   }
   
   function scale($img, $maxX=0, $maxY=0) {
      $new = array();
      
      $attr = getimagesize($img);

      if ($attr[0] < $attr[1]) {
         $wscale = $attr[0] / $maxX;
        
         $new['newwidth'] = $attr[0] * $wscale;
         $new['newheight'] = $attr[1] * $wscale;
      } else {
         $hscale = $attr[1] / $maxY;
         
         $new['newwidth'] = $attr[0] * $hscale;
         $new['newheight'] = $attr[1] * $hscale;
      }
      
      // $new['newwidth'] = ($wscale < 1) ? $attr[0] * $wscale : $attr[0] / $wscale;
      // $new['newheight'] = ($hscale < 1) ? $attr[1] * $hscale : $attr[1] / $hscale;
      $new['width'] = $attr[0];
      $new['height'] = $attr[1];

      return $new;
   }
   
?>
