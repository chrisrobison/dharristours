<?php
   move_uploaded_file($_FILES['myFile']['tmp_name'], '../photos/' . $_REQUEST['AnimalID'] . '.jpg');

   /** 
    * getimagesize returns array with the following structure:
    *    0 - width
    *    1 - height
    *    2 - type flag [1=GIF,2=JPG,3=PNG,4=SWF,5=PSD,6=BMP,7=TIFF(Big-endian),8=TIFF(Little-endian/Mac),
                        9=JPC,10=JP2,11=JPX,12=JB2,13=SWC,14=IFF,15=WBMP,16=XBM]
    *    3 - string for use in HTML <IMG...> tag ("height='xxx' width='xxx'")
    **/
   $sz = getimagesize('../photos/' . $_REQUEST['AnimalID'] . '.jpg');
  
   $max = 200;
   $width  = $sz[0];
   $height = $sz[1];

   // Handle landscape thumbnail generation
   if ($sz[0] > $sz[1]) {
      $newwidth = round(($max / $sz[0]) * $sz[0]);
      $newheight = round(($max / $sz[0]) * $sz[1]);

   // Handle portrait thumbnail generation
   } else {
      $newwidth = round(($max / $sz[1]) * $sz[0]);
      $newheight = round(($max / $sz[1]) * $sz[1]);

   }

   system("/usr/local/bin/djpeg -pnm ../photos/" . $_REQUEST['AnimalID'] . '.jpg' . " | /usr/local/bin/pnmscale -xsize $newwidth -ysize $newheight | /usr/local/bin/cjpeg -outfile ../photos/thumbs/" . $_REQUEST['AnimalID'] . '.jpg');
   /*
      if (move_uploaded_file($_FILES['myFile']['tmp_name'], '../photos/' . $_REQUEST['AnimalID'] . '.jpg')) {
         if ($_FILES['myFile']['type'] == 'image/jpeg') {
         $imageName = '../photos/'.$_REQUEST['AnimalID'].'_thumb.jpg';
         $myImage = imagecreatefromjpeg('../photos/'.$_REQUEST['AnimalID'].'.jpg');            

         // Set a maximum height and width
         $width = 200;
         $height = 200;

         // Get new dimensions
         list($width_orig, $height_orig, $type, $attr) = getimagesize($imageName);

         if ($width && ($width_orig < $height_orig)) {
            $width = ($height / $height_orig) * $width_orig;
         } else {
            $height = ($width / $width_orig) * $height_orig;
         }

         // Resample
         $image_p = imagecreatetruecolor($width, $height);
         $image = imagecreatefromjpeg($imageName);
         imagecopyresized($image_p, $myImage, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

         // Output
         imagejpeg($image_p, $imageName, 100);
       
      }
   }
*/
      
   
?>

<script language='JavaScript' type='text/javascript'>
   if (window.opener && window.opener.document && window.opener.document.location && window.opener.document.location.reload) {
      window.opener.document.location.reload();
   }
   setTimeout("self.close()", 1000);
</script>
