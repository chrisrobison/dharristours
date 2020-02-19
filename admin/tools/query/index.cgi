#!/usr/bin/perl
#
#
use DBI;
use CDR::Input;

# Setup client headers and input if we are in HTTP environment
$| = 1; print "Content-type: text/html\n\n" if ($ENV{'HTTP_HOST'});

# Collect any form input passed in
*in = getInput() if ($ENV{'HTTP_HOST'});
%dat = %in;

# Setup database connection info
my %dbconf = (	'user'    => 'mail',
		'passwd'  => 'activate',
		'host'    => 'localhost',
		'dbdrv'   => 'mysql',
		'db'      => 'query');

# Build DBI driver string
$dbconf{'driver'} = "dbi:$dbconf{'dbdrv'}:host=$dbconf{'host'}";
$dbconf{'driver2'} = "dbi:$dbconf{'dbdrv'}:host=$dbconf{'host'}:database=$dbconf{'db'}";

# Connect to our db server
$dbh = DBI->connect($dbconf{'driver'}, $dbconf{'user'}, $dbconf{'passwd'})
	or die "Error connecting to $dbconf{'driver'} DB server on '$dbconf{'host'}' as '$dbconf{'user'}': $!";
$qbh = DBI->connect($dbconf{'driver2'}, $dbconf{'user'}, $dbconf{'passwd'})
	or die "Error connecting to $dbconf{'driver'} DB server on '$dbconf{'host'}' as '$dbconf{'user'}': $!";

$in{'db'} = 'unity' if (!$in{'db'});
$in{'table'} = 'partition' if (!$in{'table'});

$dat{'tables'} = buildTables($in{'db'});
$dat{'fields'} = buildFields($in{'table'});
$dat{'fields_1'} = buildFields($in{'table'});
$dat{'fields_2'} = buildFields($in{'table'});

%cond = ( 'equals' => '=',
          'ne'     => '!=',
          'notlike'=> 'not like',
          'like'   => 'like',
	  'gt'     => '>',
	  'lt'     => '<',
	  'gte'    => '>=',
	  'lte'    => '<=');
      
foreach my $c (1..2) {   # Should be up to count of conditions
   foreach $k (keys %cond) {
      if ($in{"condition_$c"} eq $k) {
         $s = " SELECTED";
      } else {
         $s = "";
      }	 
      $dat{"condition_$c"} .= "<option value='$k'$s>$cond{$k}</option>\n";
   }
}

$in{'page'} = "main.html" if ((!$in{'page'}) || ($in{'page'} =~ /^\//));

open(HTML, $in{'page'}) or die "Error opening $in{'page'} for reading: $!";
   while ($html = <HTML>) {
      $html =~ s/\#(\w+)\#/$dat{$1}/gi;
      print $html;
   }
close HTML;

exit 0;

sub buildTables {
   my $db = shift @_;

   $dbh->do("use $db");
   my ($table, $s);
   my $sth = $dbh->prepare("show tables");
   $sth->execute();

   while ($rec = $sth->fetchrow_arrayref) {
      if (($in{'table'} eq $rec->[0]) || (!$in{'table'})) {
         $in{'table'} = $rec->[0];
         $s = " SELECTED";
      } else {
         $s = '';
      }
      $table .= "<option value='$$rec[0]'$s>$$rec[0]</option>\n";
   }   
   return $table;
}

sub buildFields {
   my $table = shift @_;
   my $match = shift @_;
   my $s;
   my $sth = $dbh->prepare("desc $table");
   $sth->execute();

   while ($rec = $sth->fetchrow_arrayref) {
      if ($match eq $rec->[0]) {
         $s = " SELECTED";
      } else {
         $s = '';
      }
      $fields .= "<option value='$$rec[0]'$s>$$rec[0]</option>\n";
   }   
   return $fields;
}
