#!/usr/bin/perl
#
#
use DBI;
use CDR::DB;
use CDR::Input;

my $debug = 0;

# Setup client headers and input if we are in HTTP environment
$| = 1; print "Content-type: text/html\n\n";

# Collect any form input passed in
*in = getInput() if (($ENV{'HTTP_HOST'}) || (@ARGV));
$in{'SignupID'} = $in{'u'} if (!$in{'SignupID'});
%dat = %in;

# Setup database connection info
my %dbconf = (	'user'    => 'pimp',
               'passwd'  => 'pimpin',
               'host'    => 'localhost',
               'dbdrv'   => 'mysql',
               'db'      => 'hosting');

# Build DBI driver string
$dbconf{'driver'} = "dbi:$dbconf{'dbdrv'}:host=$dbconf{'host'}:database=$dbconf{'db'}";

# Connect to our db server
$dbh = DBI->connect($dbconf{'driver'}, $dbconf{'user'}, $dbconf{'passwd'})
	or die "Error connecting to $dbconf{'driver'} DB server on '$dbconf{'host'}' as '$dbconf{'user'}': $!";

$data = new CDR::DB($dbh);
use Data::Dumper;

if ($in{'WizardID'}) {
   # Update any new or modified data passed in if we have a SignupID (which we should always have)
   $data->update_record('Signup', $in{'SignupID'}, \%in) if ($in{'SignupID'});

   # Get current signup record and dupe into output hash
   my $signup = $data->get_record('Signup', $in{'SignupID'}, { 'key' => 'SignupID' } );
   %dat = (%dat, %{$signup});
   
   # Retrieve record for wizard page we just returned from
   $wizard = $data->get_record('Wizard', $in{'WizardID'}, { 'key' => 'WizardID' } );

   # Execute custom code for this wizard page, if any
   process($wizard->{'PostCode'}) || print "<!-- Error: $data->{'error'} -->" if ($wizard->{'PostCode'});

   # Handle navigation setting WizardID to either NextID or PreviousID
   if ( ( $in{'Choice'} eq 'next' ) || ( !$in{'Choice'} ) ) {
      $in{'WizardID'} = $wizard->{'NextID'} ;
   } elsif ( ( $in{'Choice'} eq 'back') && ( $wizard->{'PreviousID'} != 0 ) ) {
      $in{'WizardID'} = $wizard->{'PreviousID'} ;
   }
} 

# Set default wizard page if no WizardID given
$in{'WizardID'} = $dat{'WizardID'} = '1' if (!$in{'WizardID'});

# Retrieve record from wizard page we are going to
my $next = $data->get_record('Wizard', $in{'WizardID'}, { 'key' => 'WizardID'} );

# Process any 'PreCode' code specific to this wizard step
process($next->{'PreCode'}) if ($next->{'PreCode'});

%dat = (%dat, %{$next});         # Dupe current wizard record info into output hash: %dat

# Fill 'Form' and 'Desc' content from file, if it exists, or the text from the db, 
# if field contents do not refer to an existing file
$dat{'Form'} = (-e $next->{'Form'})?parsePage($next->{'Form'}):$next->{'Form'};

if (!$dat{'Description'}) {
   $dat{'Desc'} = (-e $next->{'Desc'}) ? parsePage($next->{'Desc'}):$next->{'Desc'};
} else {
   $dat{'Desc'} = $dat{'Description'};
}

# Output main wizard page with current wizard step content
print parsePage('wizard.html');

# All good programs exit 0
exit 0;

#
# parsePage(FILENAME) - Retrieves FILENAME and parses contents, replacing #KEY# tokens
#                       with the value contained in %dat for KEY (where KEY is any 
#                       valid hash key).  Tokens which refer to non-existing hash
#                       elements are replaced, but with no content.  
#                       Returns parsed text.
sub parsePage {
   my $page = shift @_;
   my $html = '';
   my $out = '';

   open(HTML, $page) or die "Error opening $page for reading: $!";
      while ($html = <HTML>) {
         $html =~ s/\#([\w\.]+)\#/$dat{$1}/gi;
         $html =~ s/\#([\w\.]+)\#/$dat{$1}/gi;
         $out .= $html;
      }
   close HTML;

   return $out; 
}

sub checkDomain {
   my $domain = shift @_;
   my $tld = shift @_;

   ($domain, $tld) = split(/\./, $domain) if ($domain =~ /\./);
   $tld =~ s/^\.//;

   my $srs_client = new DotSRS_Client;
   
   my $ref = $srs_client->domain_info($domain, $tld);
   
   return $ref;
}

sub process {
   my $code = shift @_;

   eval {
      if (-e $code) {
         require($code);
      } else {
         eval($code);
      }
   };

   if ($@) {
      $data->{'error'} = $@;
      return 0;
   } else {   
      return 1;
   }
}

sub getInfo {
   use Net::Telnet ();
   my $domain = shift @_;
   my $tld = shift @_;
   my @results = ();

   eval {
      my $whois = $dbh->selectrow_hashref("select * from TLD where TLD like '\%$tld'");
      die "No whois server known for extension $tld" if ($whois->{'WhoisServer'} !~ /\w/);

      my $session = new Net::Telnet (Timeout => 20, Port => 43); 
      $session->open($whois->{'WhoisServer'});
      
      die "Error opening connection to port 43 on $whois->{'WhoisServer'}" if (!$session);
      
      @results = $session->cmd("$domain.$tld");
   };

   if ($@) {
      return($@);
   } else {
      return(@results);
   }
}
