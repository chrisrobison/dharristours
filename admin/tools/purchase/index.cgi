#!/usr/bin/perl
#
#
use DBI;
use CDR::Input;
use CDR::DB;
open(STDERR, ">&STDOUT");

# Setup client headers and input if we are in HTTP environment
if ($ENV{'HTTP_HOST'}) {
   # Unbuffer STDOUT and send client our default header
   $| = 1; print "Content-type: text/html\n\n" if ($ENV{'HTTP_HOST'});    
   # Collect any form input passed in
   *in = getInput() if ($ENV{'HTTP_HOST'});
}

# Setup database connection info
my %dbconf = (	'user'    => 'mail',
		'passwd'  => 'activate',
		'host'    => 'localhost',
		'dbdrv'   => 'mysql',
		'db'      => 'sys'
	     );	
$dbconf{'driver'} = "dbi:$dbconf{'dbdrv'}:host=$dbconf{'host'}:database=$dbconf{'db'}";

# Connect to our db server 
$dbh = DBI->connect($dbconf{'driver'}, $dbconf{'user'}, $dbconf{'passwd'}) 
	or die "Error connecting to $dbconf{'driver'} DB server on '$dbconf{'host'}' as '$dbconf{'user'}': $!";


$data = new CDR::DB($dbh);

if ($in{'exec'} eq "new") {
   $data->new_record('purchase', \%in);
   $dat{'purchaseID'} = $in{'purchaseID'} = $data->{id};
} elsif ($in{'exec'} eq	"update") {
   $data->update_record('purchase', $in{'purchaseID'}, \%in);
} elsif ($in{'exec'} eq "delete") {
   $data->delete_record('purchase', $in{'purchaseID'}, \%in);
}   

$sth = $dbh->prepare("select * from purchase");
$sth->execute();

while (%rec = %{$sth->fetchrow_hashref}) {
   $in{'purchaseID'} = $rec{'purchaseID'} if (!$in{'purchaseID'});
   if ($in{'purchaseID'} == $rec{'purchaseID'}) {
      $select = " SELECTED";
      %dat = (%dat, %rec);
   } else {
      $select = '';
   }
   $dat{'purchases'} .= "<option value='$rec{'purchaseID'}'$select>$rec{'purchase'}</option>\n";
}
$dat{'REMOTE_USER'} = $ENV{'REMOTE_USER'} if (!$dat{'REMOTE_USER'});
$dat{'approved'} = " CHECKED" if ($dat{'approved'});
$in{'page'} = "purchase.html" if (!$in{'page'});

open(HTML, $in{'page'}) or die "Error opening $in{'page'} for reading: $!";
   while ($html = <HTML>) {
      $html =~ s/\#(\w+)\#/$dat{$1}/gi;
      print $html;
   }
close HTML;

exit 0;

