<?php 
   require($_SERVER['DOCUMENT_ROOT'] . '/lib/boss_class.php'); 
   
   $boss= new boss($_SERVER['HTTP_HOST']);
   $in = $_REQUEST;
?>
<!DOCTYPE html> 
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title></title>
      <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet" type="text/css">
      <style>
         body { margin:0;padding:0;font-size:12px;font-family:"Open Sans","Helvetica Neue",Optima,Verdana,sans-serif; background-color:#eee;}
         a { text-decoration:none;color:#00c; }
         a:hover { text-decoration:underline; }
         a:visited { color:#006; }
         a:active { color:#e00;display:inline-block;top:2px; }
         #main { margin:1em; }
         a.addPhone { text-decoration:none;display:inline-block;width:12px;border:2px outset #ccc; padding:0px 3px 3px 3px; text-align:center;background-color:#ddd; }
         a.addPhone:active { position:relative; top:3px; }
         label { display:inline-block;width:7em;vertical-align:top; text-align:right;}
         label:after { content: ":"; }
         input[type=text],textarea { border:1px solid #ccc; padding: .25em; line-height:1.5em; margin-top:-.25em;border-radius:.25em; width:50em; font-family:"Open Sans",sans-serif; }
         input[type=text]:focus,textarea:focus { box-shadow: .25em .5em 1em rgba(0,0,0,.35); font-size:1.3em; width:30em; font-family:"Open Sans",sans-serif; }
         select { font-family:"Open Sans",sans-serif; }
         * { -webkit-transition: all .5s ease; }
         #callername, #name, #phone { width:15em; }
         #maxattempts { width:3em; text-align:center;}
         fieldset { border: 1px solid #aaa; margin:2em; }
      </style>
  </head>
   <body>
      <blockquote>
         <h2>Phone a Message</h2>
         <hr>
         <p>This tool allows a message to be delivered to any number of recipients via telephone.  Your message is converted into speech taking advantage of the many recent advances made in text-to-speech technologies and is read to each recipient.  You may optionally request a response for which the message recipient will be able to reply using their telephone keypad.  You define the available responses using the following format: [0-9]=TEXT FOR OPTION. Multiple options are specified by separating each option by a comma.  For example, to request a response of "yes" or "no" by pressing "1" or "2" you would use a "Choices" value of "1=Yes,2=No".  
         </p>
      </blockquote>
      <form action='makecall.php' method='POST' id='main'>
         <fieldset>
            <legend>Message</legend>
            <p><label for='callername'>Caller Name</label> <input type='text' id='callername' name='Notify[new1][CallerName]' value='' /></p>
            <p><label for='msg'>Message</label> <textarea rows='5' cols='80' id='msg' name='Notify[new1][Notify]'>This is an automated message.</textarea></p>
            <p><label for='choice'>Choices</label> <input type='text' id='choice' name='Notify[new1][Choice]' value='1=Yes I accept,2=No I decline'></p>
            <p><label for='maxattempts'>Max Attempts</label> <input type='text' size='3' id='maxattempts' name='Notify[new1][MaxAttempts]' value='1'></p>
         </fieldset>
         <fieldset>
            <legend>Recipients</legend>
            <div>
               <ol id='recipients'>
                  <li id='tmpl'>
                     <label for='name'>Name</label> <input type='text' id='name' name='Notify[new1][Name]' value=''>
                     <label for='phone'>Phone #</label> <input type='text' id='phone' name='Notify[new1][Voice]' value=''>
                  </li>
               </ol>
            </div>
            <a class='addPhone' href="#add">+</a>
         </fieldset>
<input type='hidden' id='host' name='Notify[new1][Host]' value='<?php print ($_SERVER['HTTP_HOST']); ?>'>
<input type='hidden' id='when' name='Notify[new1][When]' value='<?php print time(); ?>'>
<input type='hidden' id='CreatedBy' name='Notify[new1][CreatedBy]' value='<?php print htmlspecialchars($_SESSION['Email'], ENT_QUOTES); ?>'>
<input type='hidden' id='LastModifiedBy' name='Notify[new1][LastModifiedBy]' value='<?php print htmlspecialchars($_SESSION['Email'], ENT_QUOTES); ?>'>
         <button>Send Message</button><hr/>
      </form>
   </body>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type='text/javascript'>
      function addPhone() {
         $("#main div").get(0).clone().appendTo("#main");
         return false;
      }

      $(document).ready(function() {
         var simpleConfig = { "recordCount": 1 };
         $("#main").on("click", ".addPhone", function(e) {
            var clone = $("#tmpl").clone();
            $("input", clone).each(function() {
               $(this).attr("name", $(this).attr("name").replace(/new(\d+)/, "new" + (parseInt(simpleConfig.recordCount) + 1)));
            });
            $("#recipients").append(clone);
            e.stopPropagation();
            e.preventDefault();
            return false;
         });
      });
   </script>
</html>
