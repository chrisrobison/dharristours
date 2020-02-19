<?php
   include($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');

   $boss = new boss();
   $obj = $boss->getObject('OfficeSpace', $in['ID']);
   
?>
<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
     <title></title>
     <style>
         td { vertical-align: top; padding:1em;}
     </style>
  </head>
   <body>
      <div id='main'>
   <table border='1'>
<?php
   foreach ($obj->OfficeSpace['_ids'] as $key=>$id) {
      print "<tr>";
      foreach ($obj->OfficeSpace[$id] as $key=>$val) {
         if (preg_match("/^http:/", $val)) {
            $val = "<a href='$val'>$val</a>";
         }
         print "<td>".$val."</td>";   
      }
      print "</tr>";
   }
     ?>    
     </table>
      </div>
   </body>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type='text/javascript'>
      $(document).ready(function() {
         
      });
   </script>
</html>
