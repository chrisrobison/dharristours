#!/usr/bin/perl
#
#
use DBI;
use CDR::Input;

# Setup client headers and input if we are in HTTP environment
$| = 1; print "Content-type: text/html\n\n" if ($ENV{'HTTP_HOST'});

# Collect any form input passed in
*in = getInput() if ($ENV{'HTTP_HOST'});

# Setup database connection info
my %dbconf = (	'user'    => 'mail',
		'passwd'  => 'activate',
		'host'    => 'localhost',
		'dbdrv'   => 'mysql',
		'db'      => 'unity');

# Build DBI driver string
$dbconf{'driver'} = "dbi:$dbconf{'dbdrv'}:host=$dbconf{'host'}:database=$dbconf{'db'}";

# Connect to our db server
$dbh = DBI->connect($dbconf{'driver'}, $dbconf{'user'}, $dbconf{'passwd'})
	or die "Error connecting to $dbconf{'driver'} DB server on '$dbconf{'host'}' as '$dbconf{'user'}': $!";


$sth = $dbh->prepare("show tables");
$sth->execute();

while ($rec = $sth->fetchrow_arrayref) {
   if (($in{'table'} eq $rec->[0]) || (!$in{'table'})) {
      $in{'table'} = $rec->[0];
      $s = " SELECTED";
   } else {
      $s = '';
   }
   $dat{'tables'} .= "<option value='$$rec[0]'$s>$$rec[0]</option>\n";
}

$in{'page'} = "main.html" if ((!$in{'page'}) || ($in{'page'} =~ /^\//));

open(HTML, $in{'page'}) or die "Error opening $in{'page'} for reading: $!";
   while ($html = <HTML>) {
      $html =~ s/\#(\w+)\#/$dat{$1}/gi;
      print $html;
   }
close HTML;

exit 0;

