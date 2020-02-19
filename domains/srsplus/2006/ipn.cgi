#!/usr/bin/perl
use DBI;
use CDR::DB;
use CDR::Input;

# Setup client headers and input if we are in HTTP environment
$| = 1; print "Content-type: text/html\n\n";

# Collect any form input passed in
*in = getInput() if (($ENV{'HTTP_HOST'}) || (@ARGV));

logIPN(\%in);
if ($in{'custom'} =~ /\=/) {
   my @c = split(/\&/, $in{'custom'});
   foreach my $i (@c) {
      my ($k, $v) = split(/\=/, $i);
      $in{$k} = $v;
   }
}

%dat = %in;

# Setup database connection info
my %dbconf = ( 'user'    => 'pimp',
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
$data->new_record('Paypal', \%in);

if ($in{'payment_status'} =~ /completed/i) {
   $data->update_record('Signup',$in{'SignupID'}, { 'DoSetup' => '1' } );
}


exit 0;


#
# IPN returned fields [Incoming]
#
@transaction_fields = ('invoice','custom','memo','payment_status','pending_reason','reason_code','payment_date','txn_id','txn_type','payment_type');

@currency_fields = ('mc_gross','mc_fee','mc_currency','settle_amount','settle_currency','exchange_rate','payment_gross','payment_fee');

@payer_fields = ('first_name','last_name','payer_business_name','address_name','address_street','address_city','address_state','address_zip','address_country','address_status','payer_email','payer_id','payer_status');


sub logIPN {
   my $obj = shift @_;

   open(TMP, ">>/tmp/paypalipn.log");
      print TMP "_"x78,"\n";
      print TMP scalar(localtime())."\n";
      foreach $i (keys %{$obj}) {
         print TMP "$i: $obj->{$i}\n";
      }
   close TMP;

   return 1;
}
