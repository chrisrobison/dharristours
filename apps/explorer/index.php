<?php
   require($_SERVER['DOCUMENT_ROOT'] . "/lib/auth.php");
?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <title>Employee Organization Tree</title>

      <!-- CSS Files -->
      <link type="text/css" href="css/base.css" rel="stylesheet" />
      <link type="text/css" href="css/spacetree.css" rel="stylesheet" />
      <link type="text/css" href="//fonts.googleapis.com/css?family=Quicksand:400,700" rel="stylesheet" />
      <link href='//fonts.googleapis.com/css?family=Open+Sans:300,400,700,800' rel='stylesheet' type='text/css'>
      <style>
         div#colorSwatches { width: 75%; padding:1em; margin:1em; text-align:center;}
         div#colorSwatches div {
            width:5%;  height: 1em; margin-right: 0px; margin-bottom: 0px; float:left;text-align:center;
         }
      </style>
      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
      <!--[if IE]><script language="javascript" type="text/javascript" src="excanvas.js"></script><![endif]-->
      <script language="javascript" type="text/javascript" src="jit-yc.js"></script>
      <script language="javascript" type="text/javascript" src="spacetree.js"></script>
   </head>

   <body onload="init(<?php print ($in['id']) ? $in['id'] : 1; ?>);">
      <div id="container">
         <div id="left-container"> 
            <h4>Tree Orientation</h4>
            <table>
                <tr>
                    <td><label for="r-left">Left </label></td>
                    <td><input type="radio" id="r-left" name="orientation" value="left" /></td>
                </tr>
                <tr>
                     <td><label for="r-top">Top </label></td>
                     <td><input type="radio" id="r-top" name="orientation" checked="checked" value="top" /></td>
                </tr>
                <tr>
                     <td><label for="r-bottom">Bottom </label></td>
                     <td><input type="radio" id="r-bottom" name="orientation" value="bottom" /></td>
                </tr>
                <tr>
                      <td><label for="r-right">Right </label></td> 
                      <td><input type="radio" id="r-right" name="orientation" value="right" /></td>
                </tr>
            </table>
         </div>
         
         <div id="center-container"><div id="infovis"></div></div>

         <div id="right-container">
            <form>
               <div><label>Created:</label> <input type='text' id='Created' ></div>
               <div><label>Employee:</label> <input type='text' id='Employee' ></div>
               <div><label>First Name:</label> <input type='text' id='FirstName' ></div>
               <div><label>Last Name:</label>  <input type='text' id='LastName' ></div>
               <div><label>Title:</label> <input type='text' id='Title'></div>
               <div><label>Phone:</label> <input type='text' id='Phone' ></div>
               <div><label>Email:</label>  <input type='text' id='Email' ></div>
               <div><label>Location:</label>  <input type='text' id='Location' ></div>
               <div><label>Supervisor:</label> <input type='text' id='Supervisor_EmployeeID' ></div>
               <div style='display:none'><label>Pay Status:</label> <select id="PayStatus">
                                                <option value="salary">Salary</option>
                                                <option value='hourly'>Hourly</option>
                                             </select></div>
               <!--<div><label>Hire Date:</label>  <span id='HireDate' ></div>-->
               <!--<div><label>Termination Date:</label>  <input type='text' id='TermDate' ></div>-->
               <!--<div><label>Employee #:</label> <span class='value' id='EmployeeNum' ></div>-->
               <!--<div><label>Employee ID:</label> <span class='value' id='EmployeeID'></span></div>-->
               <!--<div><label>Active:</label> <input type='checkbox' value='1' checked='checked' id='Active' ></div>-->
            </form>
   <h3>Color Legend</h3>
   <div id="colorSwatches">
      <div class="ColorSwatch" title="0 #d05be5" style="background-color: rgb(208, 91, 229);"></div>
      <div class="ColorSwatch" title="1 #ad5be5" style="background-color: rgb(173, 91, 229); "></div>
      <div class="ColorSwatch" title="2 #895be5" style="background-color: rgb(137, 91, 229); "></div>
      <div class="ColorSwatch" title="3 #665be5" style="background-color: rgb(102, 91, 229); "></div>
      <div class="ColorSwatch" title="4 #5b73e5" style="background-color: rgb(91, 115, 229); "></div>
      <div class="ColorSwatch" title="5 #5b97e5" style="background-color: rgb(91, 151, 229); "></div>
      <div class="ColorSwatch" title="6 #5bbae5" style="background-color: rgb(91, 186, 229); "></div>
      <div class="ColorSwatch" title="7 #5bdde5" style="background-color: rgb(91, 221, 229); "></div>
      <div class="ColorSwatch" title="8 #5be5ca" style="background-color: rgb(91, 229, 202); "></div>
      <div class="ColorSwatch" title="9 #5be5a7" style="background-color: rgb(91, 229, 167); "></div>
      <div class="ColorSwatch" title="10 #5be584" style="background-color: rgb(91, 229, 132);"></div>
      <div class="ColorSwatch" title="11 #5be561" style="background-color: rgb(91, 229, 97); "></div>
      <div class="ColorSwatch" title="12 #79e55b" style="background-color: rgb(121, 229, 91);"></div>
      <div class="ColorSwatch" title="13 #9ce55b" style="background-color: rgb(156, 229, 91);"></div>
      <div class="ColorSwatch" title="14 #bfe55b" style="background-color: rgb(191, 229, 91);"></div>
      <div class="ColorSwatch" title="15 #e2e55b" style="background-color: rgb(226, 229, 91);"></div>
      <div class="ColorSwatch" title="16 #e5c55b" style="background-color: rgb(229, 197, 91);"></div>
      <div class="ColorSwatch" title="17 #e5a25b" style="background-color: rgb(229, 162, 91);"></div>
      <div class="ColorSwatch" title="18 #e57e5b" style="background-color: rgb(229, 126, 91);"></div>
      <div class="ColorSwatch" title="19 #e55b5b" style="background-color: rgb(229, 91, 91); "></div><br>
      <span style="float:left">1</span>
      <span>10</span>
      <span style="float:right">20</span>
      <div style='width:100%;font-size:.75em;color:#fff'>Colors represent the number of direct reports</div>
   </div>
         </div>
         <div id="log"></div>
      </div>
      <script>
         $(function() {
            $("#" + <?php print $_GET['id']; ?>).click();
         });
      </script>
   </body>
</html>
