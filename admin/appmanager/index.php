<?php
   session_start();
   
   if (!isset($_SESSION["Valid"])) {
      print "<script language='JavaScript' type='text/javascript'>\ndocument.location.href='/login.php?url=" . urlencode(preg_replace("/\/$/", '', $_SERVER['REQUEST_URI'])) . "';\n</script>";
      exit;
      // header ("Location: /login.php?url=".urlencode($_SERVER['REQUEST_URI']));
      return;
   }
?>
<html>
<head>
   <title>BPM Browser</title>
   <link href="/lib/css/Aristo/jquery-ui-1.8.5.custom.css" type="text/css" rel="stylesheet" />
   <link rel="stylesheet" href="css/fontawesome.min.css" />
   <link rel="stylesheet" href="css/all.min.css" />
   <link rel="stylesheet" href="css/solid.min.css" />
   <link rel="stylesheet" href="css/brands.min.css" />
   <link rel="stylesheet" href="css/v4-shims.min.css" />
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
   <script language='JavaScript' type='text/javascript' src='finder.js'> </script>
   <script type='text/javascript'>
      $(function() {
         $( "#dialog" ).dialog({
            autoOpen: false,
            width: 500,
            maxHeight: 400,
            height: 400,
            buttons: {
               "OK": function() {
                  $( this ).dialog( "close" );
               },
               Cancel: function() {
                  $( this ).dialog( "close" );
               }
            }
         });

         $( "#smallDialog" ).dialog({
            autoOpen: false,
            width: 400,
            maxHeight: 500,
            height: 400,
            buttons: {
               "OK": function() {
                  $( this ).dialog( "close" );
               },
               Cancel: function() {
                  $( this ).dialog( "close" );
               }
            }
         });

         $(".simpleIcon").click(function(e) {
            $(".selectedIcon").removeClass("selectedIcon");
            $(this).addClass("selectedIcon");
            $("#EditFrame")[0].contentDocument.forms[0].Icon.value = $(this).attr('title');           
            $("#EditFrame")[0].contentDocument.getElementById("iconSpan").setAttribute("class", "simpleIcon icon-"+$(this).attr('title'));
         });
         $(".smallIcon").click(function(e) {
            $(".selectedIcon").removeClass("selectedIcon");
            $(this).addClass("selectedIcon");
            $("#EditFrame")[0].contentDocument.forms[0].ClassName.value = $(this).attr('title');           
            $("#EditFrame")[0].contentDocument.getElementById("iconSpan").setAttribute("class", "smallIcon small-"+$(this).attr('title'));
         });
      });
   </script>
   
   <link rel="stylesheet" type="text/css" href="/lib/css/icons48.css" />
   <link rel="stylesheet" type="text/css" href="/lib/css/icons24.css" />
   
   <style>
      .small {
         width: 24px;
         height: 24px;
         display: inline-block;
         color: #000;
         font-size: 18px;
         text-align: center;
      }
      .simple {
         width: 48px;
         height: 48px;
         display: inline-block;
         color: #000;
         font-size:32px;
         text-align: center;
      }

      .selectedIcon {
         background-color: #aaddff;
      }
      #dialog {
         width:300px;
         height:250px;
         overflow:auto;
      }
      #advanced {
         margin-left: 2.2em;
      }
      #advOpen, #advClosed {
         pointer:pointer;
      }
      .footer {
         position:fixed;
      }
   </style>
 
   <link rel='stylesheet' type='text/css' href='finder.css?ver=1.2' />
</head>
<body>
   <div id='finder'>
      <span id='Module' class='panel'><iframe name='ModuleFrame' id='ModuleFrame' src='/admin/appmanager/browse.php?rsc=Module' class='framed'> </iframe></span>
      <span id='Process' style='width:300px;' class='panel'><iframe name='ProcessFrame' id='ProcessFrame' src='/admin/appmanager/blank.html' class='framed'> </iframe></span>
      <span id='ProcessResource' style='display:none;' class='panel'><iframe name='ProcessResourceFrame' id='ProcessResourceFrame' src='/admin/appmanager/blank.html' class='framed'> </iframe></span>
      <span id='Edit' class='panel'><iframe name='EditFrame' id='EditFrame' src='/admin/appmanager/blank.html' class='framed'> </iframe></span>
      </div>
<div id="dialog" title="Choose an Icon" style='display:none'>
<?php 
   $file = file("fontawesome.txt");
   
   $row = 0; $col = 0;
   $small = "";
   foreach ($file as $icon) {
      $icon = trim($icon);
      if (preg_match("/^\d+\-([^\.]*)\.png/", $icon)) {
         $icon = $match[1];
      }
      print "<span class='simple fa fa-".$icon."' title='".$icon."'></span>";
      $small .= "<span class='small fa fa-".$icon."' title='".$icon."'></span>";
      ++$col;
      if ($col==10) {
         ++$row; $col = 0;
      }
   }
   
   $file = file($_SERVER['DOCUMENT_ROOT']."/lib/css/icons48.txt");
   $row = 0; $col = 0;   
   foreach ($file as $icon) {
      if (preg_match("/^\d+\-([^\.]*)\.png/", $icon)) {
         $icon = $match[1];
      }
      print "<span class='simpleIcon icon-".$icon."' title='".$icon."'></span>";
      $small .= "<span class='smallIcon small-".$icon."' title='".$icon."'></span>";
      ++$col;
      if ($col==10) {
         ++$row; $col = 0;
      }
   }
 
?>
</div>
   <div id="smallDialog" title="Choose an Module Icon" style='display:none'>
      <?php print $small; ?>
   </div>
</body>
</html>
