<?php
require_once($_SERVER['DOCUMENT_ROOT']."/lib/boss_class.php");

$boss = new boss();
$in = $_REQUEST;

if ($in['pid']) {
   $process = $boss->getObject("Process", $in['pid']);
   $procname = preg_replace("/([a-z])([A-Z])/", "$1 $2", $process->Process);
   $sql = ($process->OverviewQuery) ? $process->OverviewQuery : "select * from ".$process->Resource;
   if ($in['ID']) {
      $sql .= " where ".$process->Resource."ID='".mysql_real_escape_string($in['ID'])."'";
   }
   $sql .= " order by ".$process->Resource."ID desc"; 
   $obj = $boss->db->dbobj->execute($sql);
   
   $arr = array();
   while ($row = $boss->db->dbobj->fetch_object( )) { 
      $arr[] = $row; 
   }
   $date = date('r');

$out = <<<EOT
<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">
<channel>
   <title>{$procname} Feed</title>"
   <description>This is the RSS feed for {$procname}</description>
   <link>http://{$_SERVER['HTTP_HOST']}/apps/</link>
   <lastBuildDate>{$date}</lastBuildDate>
   <pubDate>{$date}</pubDate>
EOT;
   
   for ($x=0; $x<15; $x++) {
      $item = $arr[$x];
      $url = preg_replace("/&/", "&amp;", "http://".$_SERVER['HTTP_HOST']."/apps/index.php?pid=".$in['pid']."&id=".$item->{$process->Process.'ID'});
      $subject = preg_replace("/\&/", "&amp;", $item->{$process->Resource});
      $desc = ($item->Notes) ? nl2br($item->Notes) : $item->{$process->Resource};
      $guid = uniqid();
      $date = date('m/d/Y h:ia', strtotime($item->LastModified));
if ($subject && $desc) {
   $out .= <<<EOT
<item>
   <title>{$subject}</title>
   <description>{$desc}</description>
   <link>{$url}</link>
   <guid>{$guid}</guid>
   <pubDate>{$date}</pubDate>
</item>
EOT;
}
   }
   $out .= "</channel></rss>";

//   header("Content-type: application/rss+xml");
   header("Content-type: text/xml");

   print $out;
}

                         
?>
