#!/usr/local/bin/php
<?php
   include("/simple.dev/lib/boss_class.php");
   $boss = new boss("admin.dev.sscsf.com");
   $boss->db->dbobj->execute("use SS_System");
   $boss->db->dbobj->db = "SS_System";
   
   // $sys = new obj('SS_System', 'pimp', 'pimpin', 'localhost');
   // $sys->addResource("App");
   
   $prog = array_shift($argv);

   while ($id = array_shift($argv)) {
      if (!is_numeric($id)) {
         $allapps = $boss->getObject("App", "Host=".$boss->q($id));
         $id = $allapps->App[0]->AppID;
         $apps = $allapps->App[0];
         print_r($apps);
         print "Found App `{$apps->App}` [AppID: $id]\n";
      } else {
     
         $apps = $boss->getObject("App", $id);
         // $sys->App->get($id);
      }

      if ($apps->AppID == $id) {
         // First backup record into logfile
         $bak = $apps;
         file_put_contents("/simple.dev/log/simpledb_deleted.log", date("Y-m-d H:i:s")."|App Record `".$bak->App." [ID:$id] removed from `App` table by ".$_SESSION['Email'].'|'.json_encode($bak)."\n", FILE_APPEND);
         // Then remove the record
         $boss->db->dbobj->execute("delete from App where AppID='$id'");
         print "Removed App `".$bak->App."` [ID: ".$id."] from the `App` table (".json_encode($bak).")\n";
      }
   }
?>
