#!/usr/bin/perl

use DBI;
use CDR::Input;
use DotSRS_Client;
use Data::Dumper;

my $debug = 0;

open(STDERR, ">>/tmp/srsplus-err.log");
$| = 1; print "Content-type: text/html\n\n" if $debug;

# Setup database connection info
my %dbconf = (  'user'    => 'pimp',
               'passwd'  => 'pimpin',
               'host'    => 'localhost',
               'dbdrv'   => 'mysql',
               'db'      => 'hosting');

# Build DBI driver string
$dbconf{'driver'} = "dbi:$dbconf{'dbdrv'}:host=$dbconf{'host'}:database=$dbconf{'db'}";

# Connect to our db server
$dbh = DBI->connect($dbconf{'driver'}, $dbconf{'user'}, $dbconf{'passwd'})
        or die "Error connecting to $dbconf{'driver'} DB server on '$dbconf{'host'}' as '$dbconf{'user'}': $!";

# Collect any form input passed in
*in = getInput() if (($ENV{'HTTP_HOST'}) || (@ARGV));
%dat = %in;

my $domain;
my $results = {};
my $isodate = isodate();

if ($in{'n'} =~ /\w/) {
   print "<h1>$in{'n'}</h1>" if $debug;

   if ($in{'n'} =~ /[^a-z0-9\-\.]/) {
      $dat{'signal'} = "img/led_red_dim.gif";
   } else {
      ($domain, $tld) = split(/\./, $in{'n'});
      $result = checkDomainQuick("$domain.$tld");
      
      $results->{'DOMAIN STATUS'} = $result->{"$domain.$tld"};

      print "<h1>Domain: $domain</h1><h2>TLD: $tld</h2><h2>Quick Check:".Dumper($result)."</h2>" if $debug;
#      $cached = $dbh->selectrow_hashref("select * from Cache where Domain='$domain' and TLD='$tld'");
#      
#      if ((!$cached->{'Lookup'}) || (($isodate - $cached->{'Lookup'}) > 5000)) {
#        #$dbh->do("delete from Cache where Domain='$domain' and TLD='$tld'");    # Remove outdated entry
#         #$results = checkDomain($domain, $tld);
#         #$domain = checkDomainQuick("$domain.$tld");
#         $results->{'DOMAIN STATUS'} = $domain->{"$domain.$tld"};
#
#         $dbh->do("insert into Cache (CacheID, Domain, TLD, Price, Cost, Status, Lookup) values (null, '$domain', '$tld', '$results->{'PRICE'}', '$results->{'EFFECTIVE PRICE'}', '$results->{'DOMAIN STATUS'}', null)");
#      } else {
#         $results = {'DOMAIN STATUS'   => $cached->{'Status'},
#                     'PRICE'           => $cached->{'Price'},
#                     'EFFECTIVE PRICE' => $cached->{'Cost'}
#                     };
#      }
#
      print Dumper($results) if $debug;

      if (($results->{'DOMAIN STATUS'} =~ /UNAVAILABLE/) || (!$results->{'DOMAIN STATUS'})) {
         $dat{'signal'} ="img/red_led_ani.gif";
      } else { 
         $dat{'signal'} = "img/green_led_ani.gif";
      }
   }
}   

$dat{'signal'} = "img/grey.png" if (!$dat{'signal'});
($filepath, $ext) = split(/\./,$dat{'signal'});

# Setup client headers and input if we are in HTTP environment
$| = 1; print "Content-type: image/$ext\n\n" if ($ENV{'HTTP_HOST'});

open(IMG, $dat{'signal'}) or die "Error opening $dat{'signal'} for reading: $!";
   while ($img = <IMG>) {
      print $img;
   }
close IMG;

exit 0;

sub checkDomain {
   my $domain = shift @_;
   my $tld = shift @_;
   my(@dom, $srs_client, $ref);

   if (($domain =~ /\./) && (!$tld)) {
      @dom = split(/\./, $domain);
      $tld = pop @dom;
      $domain = join('.', @dom);
   }
   $tld =~ s/^\.//;

   my $srs_client = new DotSRS_Client;
   my $ref = $srs_client->domain_info($domain, $tld);
   
   return $ref;
}

sub checkDomainQuick {
   my $domain = shift @_;
   my $response;
   use Net::DLookup;

   my @result = ('AVAILABLE', 'UNAVAILABLE');

   #
   # Initialize Net::DLookup object
   #
   my $lookup = Net::DLookup->new;
   my $domains = {};

   #
   # Check domain name validity and assign it to the object
   #
   @errors = $lookup->IsValid($domain);

   #
   # Store availability in hashref
   #
   @response = $lookup->DoWhois(0);
   $domains->{$domain} = $result[$response[0]];

   return $domains;
}

sub isodate {
   my @t = localtime;
   ++$t[4]; $t[5] += 1900;

   return(sprintf('%04d%02d%02d%02d%02d%02d', reverse(splice(@t, 0, 6))));
}

__END__


