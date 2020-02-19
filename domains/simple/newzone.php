#!/usr/local/bin/php
<?php
   require_once("/simple.dev/lib/boss_class.php");

   $boss = new boss("api.dev.sscsf.com");

   $prog = array_shift($argv);
   
   while (count($argv)) {
      $domain = array_shift($argv);
      
      if (preg_match("/^\-\-(\w+)/", $domain, $match)) {

      } else if (!preg_match("/^[a-z0-9]/", $domain) || preg_match("/[^a-z0-9\-\.]/", $domain)) {
         print "*** Error -  Invalid zone domain name:  '$domain'\n\n";
         print "Usage: $prog ZONE [ZONE2...]\n\n";
         exit;
      } else {
         $boss->db->addResource('DNS');
         $boss->db->DNS->getlist("Zone='$domain'");
         
         if (count($boss->db->DNS->DNS)) {
            print "*** Error:  Domain '$domain' already exists.  Skipping...\n";
         } else {
            $new = buildZone($domain);     
            $ids = $boss->storeObject($new);
            $tvals = array_values($ids);

            if (count($tvals)) {
               print "Created ".count($tvals)." new records in the dns for '$domain'\n";
            } else {
               print ">>>Warning:  No new record ID's were returned.  Something is very wrong somewhere.\n";
            }
         }
      }
   }


   function buildZone($domain) {
      $new['DNS']['new1'] = array(  Zone => $domain,
                                          Name => '@',
                                          Type => 'SOA',
                                          Data => 'ns.netoasis.net. support '.date("YmdH", time()).' 14400 3600 604800 28800',
                                          Owner=> 'simple');
      $new['DNS']['new2'] = array(  Zone => $domain,
                                          Name => '@',
                                          Type => 'NS',
                                          Data => 'ns.netoasis.net.',
                                          Owner=> 'simple');
      $new['DNS']['new3'] = array(  Zone => $domain,
                                          Name => '@',
                                          Type => 'NS',
                                          Data => 'ns2.netoasis.net.',
                                          Owner=> 'simple');
      $new['DNS']['new4'] = array(  Zone => $domain,
                                          Name => '@',
                                          Type => 'MX',
                                          Data => 'mail.'.$domain.'.',
                                          Owner=> 'simple',
                                          MXPriority => 10);
      $new['DNS']['new5'] = array(  Zone => $domain,
                                          Name => '@',
                                          Type => 'A',
                                          Data => '66.181.7.2',
                                          Owner=> 'simple');
      $new['DNS']['new6'] = array(  Zone => $domain,
                                          Name => 'www',
                                          Type => 'A',
                                          Data => '66.181.7.2',
                                          Owner=> 'simple');
      $new['DNS']['new7'] = array(  Zone => $domain,
                                          Name => 'mail',
                                          Type => 'A',
                                          Data => '66.181.7.2',
                                          Owner=> 'simple');
    
      return $new;   
   }

?>
