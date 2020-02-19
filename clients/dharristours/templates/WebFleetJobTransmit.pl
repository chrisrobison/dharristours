#!/usr/bin/perl -Ilib -w
use strict;
use DBI;
use WEBFLEET::Connect;
my $dbh = DBI->connect('dbi:mysql:SS_DHarrisTours','webfleet','W3bFleet');
my $wfc = new WEBFLEET::Connect(
  account=>'harris-tours',
  username=>'dharrisconnect',
  password=>'Iadhlmi1!'
);
# insert into webfleet from view 
my $insertsth = $dbh->prepare('insert into webfleet(JobID, Job, jobsent, ttobject) select JobID, Job, 0,"001" from webfleet_jobs where JobID not in (select JobID from webfleet)');
$insertsth->execute;
# fetch all pending jobs from database
my $sth = $dbh->prepare('select * from webfleet where jobsent = 0');
$sth->execute;
my @webfleet_jobs;
while (my $h = $sth->fetchrow_hashref) {
  push @webfleet_jobs, {%$h};
}
# send pending jobs and update state in database
$sth = $dbh->prepare('update webfleet set jobsent=true where jobid = ?');
foreach my $h (@webfleet_jobs) {
  my $r = $wfc->sendOrder(
    objectno=>$h->{ttobject},
    orderno=>$h->{jobid},
    ordertext=>$h->{jobtext}
  );
  $sth->execute($h->{jobid}) if ($r->is_success);
}
