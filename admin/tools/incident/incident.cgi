#!/usr/bin/perl
#
#
use DBI;
use CDR::Input;

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
%dat = %in;

if ($in{'exec'} eq 'send') {
   my $msg = '';
   open(TPL, "htmlmail.tpl");
      while ($tpl = <TPL>) {
         $tpl =~ s/\#(\w+)\#/$in{$1}/gsi;
	 $msg .= $tpl;
      }
   close TPL;
   
   open(MAIL, "|/usr/lib/sendmail -t");
      select(MAIL);  $| = 1;
      print MAIL $msg;
   close MAIL;
   select(STDOUT);  $| = 1;
   $dat{'alert'} = "alert('Incident report email sent');";
}

if ($in{'exec'} eq 'new') {
   my $sth = $dbh->prepare("select * from incident limit 1");
   $sth->execute();
   my @tmpfields = @{$sth->{NAME}};
   my @vals = ();
   foreach my $f (@tmpfields) {
      next if ($f eq 'incidentID');
      if ($f eq 'Created') {
         push(@fields, $f);
	 push(@vals, 'now()');
	 next;
      }	 
      push(@fields, $f);
      if ($in{$f}) {
         push(@vals, $dbh->quote($in{$f}));
      } else {
         push(@vals, "''");
      }	 
   }
   $insert = "insert into incident (".join(',', @fields).") values (".join(',', @vals).")";
#   print "<h2>$insert</h2>";
   $dbh->do($insert) or print "<h1 style='color: red;'>".$dbh->errstr()."</h1>";
   $in{'incidentID'} = $dat{'incidentID'} = $dbh->{'mysql_insertid'};

} elsif ($in{'exec'} eq 'update') {
   my $sth = $dbh->prepare("select * from incident where incidentID='$in{'incidentID'}'");
   $sth->execute();
   
   if ($sth->rows) {
      my %current = %{$sth->fetchrow_hashref};
      my @fields = @{$sth->{NAME}};
      my @vals = ();
   
      foreach my $f (@fields) {
         next if ($f =~ /incidentID/);
         if (($in{$f} ne $current{$f}) && ($in{$f} =~ /\w/)) {
            push(@vals, "$f=".$dbh->quote($in{$f}));
         }
      }
      if (@vals) {
         $dbh->do("update incident set ".join(", ", @vals)." where incidentID='$in{'incidentID'}'");
      }
   }   
}

$sth = $dbh->prepare("select * from incident");
$sth->execute();

while (%rec = %{$sth->fetchrow_hashref}) {
   if ($in{'incidentID'} eq $rec{'incidentID'}) {
      %dat = (%dat, %rec);
      $selected = ' SELECTED';
   } else {
      $selected = '';
   }   
   my $incident = $rec{'Incident'};
   if (length $incident > 40) {
      $incident = substr($incident, 0, 38).'...';
   }	 
   $dat{'incidents'} .= "<option value='$rec{'incidentID'}'$selected>$incident</option>";
}

open(HTML, "incident.html");
   while ($html = <HTML>) {
      $html =~ s/\#(\w+)\#/$dat{$1}/g;
      print $html;
   }
close HTML;

$dbh->disconnect;

exit 0;

