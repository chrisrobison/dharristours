<?php
   require_once($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');
   $user = $_SESSION['Email'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
   <head>
      <title>Simple Chat</title>
      <script language="JavaScript" type='text/javascript'>
         var chatuser = "<?php print $user; ?>";
         var chatters = new Array();
         function Chat(sender) {
            this.color = 'rgb('+rand(0,255)+','+rand(0,255)+','+rand(0,255)+')';
            this.sender = sender;
         }
         function rand(start, count) {
            start = (start) ? start : 0;
            count = (count) ? count : 255;
            
            return (Math.round(Math.random() * count) + start);
         }
         function cleanMessage(txt) {
            if (txt) {
               txt = txt.replace(/\&gt\;/, '>');
               txt = txt.replace(/\&lt\;/, '<');
               txt = txt.replace(/\&amp\;/, '&');
               txt = txt.replace(/\&quot\;/, "'");
            }   
            return txt; 
         }

         function showTyping(who) {
            var chat = document.getElementById('chat');
            var chatTyping = document.getElementById(who + '_typing');
            if (chatTyping) chatTyping.parentNode.removeChild(chatTyping);
            if (chat) chat.innerHTML += "<div id='" + who + "_typing' class='typing'>" + who + ' is typing...</div>';
         }
         
         function showMessage(msg) {
            if (msg) {
               var out = '';
               var sender = msg['SenderID'].replace(/\@.*/, '');
               msg['Chat'] = cleanMessage(msg['Chat']);
               
               if (!chatters[sender]) chatters[sender] = new Chat(sender);

               var chatTyping = document.getElementById(sender + '_typing');
               if (chatTyping) chatTyping.parentNode.removeChild(chatTyping);
               
               var chat = document.getElementById('chat');
               
               if (chat) {
                  chat.innerHTML += "["+ msg['Time'] +"]<span style='font-weight:bold;color:" + chatters[sender].color + ";'>" + sender +":</span> " + msg['Chat'] + "<br/>\n";
               }

               playSound('/lib/sounds/beep9.wav');
               if (parseInt(chat.clientHeight) < parseInt(chat.scrollHeight)) {
                  chat.scrollTop = parseInt(chat.scrollHeight) - parseInt(chat.clientHeight);
               }
            }
         }

         function sendMessage() {
            var frm = document.getElementById('chatForm');
            var msg = escape(frm.msg.value);
            var rcpt = frm.Recipient.options[frm.Recipient.selectedIndex].value;
            var url = '/apps/chat/chattext.php?r='+rcpt+'&s=<?php print $user; ?>&msg='+msg;
            frm.msg.value = '';

            document.getElementById('transporter2').src = url;
            frm.msg.focus();
         }
         
         function doKeypress(evt) {
            evt = evt ? evt : ((event) ? event : null);
            if (evt) {
               var doit = '';
               var key = (!evt.keyCode) ? evt.charCode : evt.keyCode;
               shifted = evt.shiftKey;
               
               // setStatus('[keypress] '+key+((evt.ctrlKey)?' ctrl':'')+((evt.altKey)?' alt':'')+((evt.shiftKey)?' shift':''));
               if (keyDefs[key]) {
                  // KEY (no modifier keys)
                  if (keyDefs[key].cmd) doit = keyDefs[key].cmd;
                  // SHIFT-KEY
                  if ((evt.shiftKey) && (keyDefs[key].shiftKey)) doit = keyDefs[key].shiftKey;
                  // CTRL-KEY
                  if ((evt.ctrlKey) && (keyDefs[key].ctrlKey)) doit = keyDefs[key].ctrlKey;
                  // META-KEY
                  if ((evt.metaKey) && (keyDefs[key].metaKey)) doit = keyDefs[key].metaKey;
                  // SHIFT-META-KEY
                  if ((evt.shiftKey) && (evt.metaKey) && (keyDefs[key].shiftmetaKey)) doit = keyDefs[key].shiftmetaKey;
                  // SHIFT-CTRL-KEY
                  if ((evt.shiftKey) && (evt.ctrlKey) && (keyDefs[key].shiftctrlKey)) doit = keyDefs[key].shiftctrlKey;
                  // ALT-KEY
                  if ((evt.altKey) && (keyDefs[key].altKey)) doit = keyDefs[key].altKey;
                  // SHIFT-ALT-KEY
                  if ((evt.shiftKey) && (evt.altKey) && (keyDefs[key].shiftaltKey)) doit = keyDefs[key].shiftaltKey;
         //         setStatus('[keypress] '+key+' code: '+doit+'   '+((evt.ctrlKey)?' ctrl':'')+((evt.altKey)?' alt':'')+((evt.shiftKey)?' shift':''));
                  
                  if (doit) {
                     try {
                        eval(doit);
                     } catch(e) { 
                        errorHandler(e, 'doKeypress'); 
                     }

                     return blockEvent(evt);
                  } 
               } 
            }
         }
         
         function playSound(url) {
            var sndFrame = document.getElementById('snd');
            sndFrame.src = "about:blank";
            sndFrame.src = url;
            setTimeout("stopSound()", 2000);
         }

         function stopSound() {
            var sndFrame = document.getElementById('snd');
            sndFrame.src = "about:blank"; //so refresh won't replay sound
         }

         function doEnter(evt) { 
            evt = (evt) ? evt : window.event;
            if (!evt.shiftKey) {
               playSound('/sounds/beep12.wav');
               sendMessage();
            }
            return blockEvent(evt);
         }
         
         function blockEvent(evt) {
            evt = (evt) ? evt : event;
            evt.cancelBubble = true;
            if (!document.all) evt.stopPropagation();
            return false;
         }
         
         var keyDefs = new Array();
         /* Key definitions */
         // Enter
         keyDefs[13] = { cmd:'doEnter(evt)'};

         document.onkeypress = doKeypress;
      </script>
      <style type="text/css">
            BODY {
               font-size: 12px;
               font-family: Optima,"Gill Sans","Gill Sans MT",Verdana,Arial,Helvetica,SansSerif;
               color: #000000;
            }
            .FIXED {
               font-size:10px;
               font-family:Courier New,Courier,LucidaConsole,Fixedsys;
               color:#000000;
            }
            TEXTAREA {
               font-family: Optima,"Gill Sans","Gill Sans MT",Verdana,Arial,Helvetica,SansSerif;
               font-size: 12px;
               width: 100%;
               height: 28px;
            }
            SELECT {
               font-family: Optima,"Gill Sans","Gill Sans MT",Verdana,Arial,Helvetica,SansSerif;
               font-size: 12px;
            }
            INPUT {
               font-family: Optima,"Gill Sans","Gill Sans MT",Verdana,Arial,Helvetica,SansSerif;
               font-size: 12px;
            }
            #console {
               position: absolute;
               top: 0px;
               left: 0px;
               width: 242px;
               height: 50px;
            }
            #chat {
               position:absolute;
               left:0px;
               width:100%;
               top:50px;
               bottom:4px;
               overflow: scroll;
               overflow-y: scroll;
               overflow: -moz-scrollbars-vertical;
            }
            #transport {
               position:absolute;
               left:-25px;
               top:-25px;
               height: 20px;
               width: 20px;
               background-color: #ccccFF;
            }
            #transport2 {
               position:absolute;
               left:-25px;
               top:-25px;
               height: 20px;
               width: 20px;
               background-color: #ffffcc;
            }
            #transporter {
               border: 2px inset #a0a0a0;
               width: 100%;
               height: 100%;
            }
            #transporter2 {
               border: 2px inset #a0a0a0;
               width: 100%;
               height: 100%;
            }
            #msg {
               height: 20px;
               width: 98%;
            }
            #msg:focus {
               background-color: #ffffdd;
            }
            #sndWrap {
               position: absolute;
               top: -50px;
               left: -50px;
               height: 25px;
               width: 25px;
            }
            #snd {
               position: absolute;
               top: 0px;
               left: 0px;
               width: 1px;
               height: 1px;
               border: 0px;
            }
            .chatter1 { background-color: #990000; }
            .chatter2 { background-color: #009999; }
            .chatter3 { background-color: #009900; }
            .chatter4 { background-color: #000099; }
            .chatter5 { background-color: #009900; }
      </style>
   </head>
   <body onload="document.chatForm.msg.focus();">
      <form name='chatForm' id='chatForm' method='post' action='/apps/chat/chattext.php' target='transporter2'>
      <div id='console'>
         Chat with:          
         <?php 
            $login = $boss->getObject('Login');
            foreach ($login->Login as $idx=>$rec) {
               $show = preg_replace("/\@.*/", '', $rec->Email);
               $options .= "<option value='".$rec->Email."'>".$show."</option>\n";
            }
         ?>
        <select name='Recipient' id='Recipient'><?php print $options; ?></select><input type='button' value='Send' onclick='sendMessage();' />
         <textarea name='msg' id='msg' rows='2' cols='100'> </textarea>
      </div>
      <div id='chat'>
         Logged in as <?php print $user; ?><br/>
      </div>
      <div id='transport'><iframe src='/apps/chat/chatserv.php?first=1&Email=<?php print $user; ?>' name='transporter' id='transporter'> </iframe></div>
      <div id='transport2'><iframe name='transporter2' id='transporter2'> </iframe></div>
      <div id='soundWrap'><iframe name='snd' id='snd'> </iframe></div>
      </form>
   </body>
</html>

