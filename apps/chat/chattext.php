<?php
   require_once("../../lib/boss_class.php");

   $boss = new boss();
   $in = $_REQUEST;

   $boss->db->addResource('Chat');
   $chat = $boss->db->Chat;
   
   $in['s'] = preg_replace("/\@.*/", '', $in['s']);
   $in['r'] = preg_replace("/\@.*/", '', $in['r']);
   $in['msg'] = preg_replace("/(http:\/\/[^\s]*)/", "<a href='$1' target='_blank'>$1</a>", $in['msg']);
   $add = array('UserID'=>$in['r'], 'Chat'=>$in['msg'], 'SenderID'=>$in['s']);
   $id = $chat->add($add);

   $add['Time'] = date('h:ia');
   outJS(array("var msg = ".$boss->utility->js_serialize($add).";", "parent.showMessage(msg);"));

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
