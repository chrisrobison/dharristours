#!/usr/local/bin/php
<?php
   require_once("boss_class.php");

   $boss = new boss('sys');

   $prog = array_shift($argv);
   $success = 0;

   while (count($argv)) {
      $domain = array_shift($argv);
      
      if (preg_match("/^\-\-(\w+)=([^\s]+)/", $domain, $match)) {
         $in[$match[1]] = $match[2];
         next;
      }
      $parts = preg_split("/\./", $domain);
      if (count($parts) > 2) {
         $host = array_shift($parts);
      } else {
         $host = "www";
      }
      $parent = join('.', $parts);
      if (preg_match("/(\w+)\-(\w+)/", $host, $match)) {
         $client = $match[1];
         $user = (($match[2] == 'dev') || (!$match[2]) || ($match[2]=="")) ? 'cdr' : $match[2];
      }
      if ($in['user']) $user = $in['user'];
      if (!$user) $user = 'cdr';

      if (!$parent) $parent = 'simpsf.com';

      if (preg_match("/^\-\-([^=]*)=(.*)/", $domain, $match)) {
         
      } else if (!preg_match("/^[a-z]/", $domain) || preg_match("/[^a-z0-9\-\.]/", $domain)) {
         print "*** Error -  Invalid domain name:  '$domain'\n\n";
         print "Usage: $prog HOSTNAME [HOSTNAME2...]\n\n";
         exit;
      } else {
         $boss->db->addResource('dns');
         $boss->db->dns->getlist("Zone='$parent'");
         
         if (count($boss->db->dns->dns)>2) {
            print "DNS records already exist for $parent.\n";
         } else {
            print "Creating DNS records for $parent...\n";
            $ph = popen("./newzone.php $parent", 'r');
            while ($line = fgets($ph, 4096)) {
               print "\t".$line;
            }
            pclose($ph);
            print "Created DNS records for $parent\n";
         }

         $boss->db->addResource('Domain');
         $boss->db->Domain->getlist("Domain='$parent' AND Host='$host'");
         
         if (count($boss->db->Domain->Domain)) {
            print "*** Error:  Host '$domain' already exists.  Skipping...\n";
         } else {
            $tmp['Domain'] = $parent;
            $tmp['Host'] = $host;
            $tmp['user'] = $user;
            $tmp['Client'] = $client;
            $tmp['Type'] = 'standard';
            $tmp['IP'] = '*';
            $tmp['Port'] = '80';
            $tmp['ServerType'] = 'standard';
            $tmp['ServerRoot'] = '/home/'.$user.'/domains/'.$parent;
            $tmp['DocumentRoot'] = $host;
            $tmp['LogType'] = 'combined';
            $tmp['CustomLog'] = 'logs/'.$host.'-access.log';
            $tmp['ErrorLog'] = 'logs/'.$host.'-error.log';
            $tmp['ServerAdmin'] = 'webmaster@'.$parent;
            $tmp['Modified'] = '1';
            $tmp['CVS'] = 'sites/'.$client.'-dev';
            $tmp['Verify'] = '0';
            $tmp['Active'] = '1';
            $tmp['Created'] = time;
            $tmp['LastModified'] = time;
            $tmp['MagicQuotes'] = '0';
            $tmp['DAV'] = '1';
            $tmp['DNS'] = '1';
            $tmp['Mail'] = '0';
            $tmp['Web'] = '1';
            $tmp['CMS'] = '1';
            $new['Domain']['new1'] = $tmp;

            $ids = $boss->storeObject($new);
            $tvals = array_values($ids);

            if (count($tvals)) {
               print "Created Apache entry for '$domain' assigned to '$user'.\n";
               ++$success;
            } else {
               print ">>>Warning:  No new record ID's were returned.  Something is very wrong somewhere.\n";
            }
         }
      }
   }

   if ($success) {
      print "Successfully updated httpd configuration.\n\nRegenerating configuration file and restarting apache...\n";
      system("touch /www/.sysupdate/httpd.ns");
   }
?>
