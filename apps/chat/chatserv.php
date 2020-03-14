<?php
   $user = preg_replace("/\@.*/", '', $_SESSION['Email']);

   require_once("../../lib/boss_class.php");

   $boss = new boss();
   $in = $_REQUEST;

   $start = time();
   
   $boss->db->addResource('Chat');
   $chat = $boss->db->Chat;
   
   $connectTime = ($in['first']) ? 1 : 10;
   if ($in['Recipient'] && $in['msg']) {
      $add = array('UserID'=>$in['Recipient'], 'Chat'=>$in['msg'], 'SenderID'=>$user, 'ContentType'=>'text/html');
      $chat->add($add);
      outJS(array("parent.showMessage($add);"));
      exit;
   } else {
      if ($in['start']) outJS(array("alert('Connected to chat as $user')"));
      outJS(array('var msg = new Array();'));
      
      while ((time() - $start) < $connectTime) {
         $chat->getlist("UserID=".$boss->db->dbobj->sql_quote($user));
         
         if (count($chat->Chat)) {
            foreach ($chat->Chat as $idx=>$msg) {
               $msg->Time = date('h:ia', strtotime($msg->LastModified));
               sendMessage($msg);
               $chat->remove($msg->ChatID);
               sleep(1);
            }
         }
      }
   }

   outJS(array("setTimeout(\"self.location.href='/apps/chat/chatserv.php?Email=$user'\", 1000);"));
   exit;

   function sendMessage($msg) {
      global $boss;
      outJS(array('msg[msg.length] = '.$boss->utility->js_serialize($msg, true).';', 'parent.showMessage(msg[msg.length-1]);'));
   }

   function outJS($js) {
      if (!is_array($js)) {
         $tmp = $js;
         $js = array($tmp);
      }
      print "<script language='Javascript' type='text/javascript'>\n";
      print join("\n", $js); 
      print "</script>\n";
      flush();
   }
?>
