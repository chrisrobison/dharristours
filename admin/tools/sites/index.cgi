#!/usr/bin/perl
#
#
open(STDERR, ">&STDOUT");                       # Redirect all errors to standard output
$| = 1; print "Content-type: text/html\n\n";    # Unbuffer STDOUT and send client our default header

use DBI;
use CDR::Input;

# Connect to our db server 
$dbh = DBI->connect('dbi:mysql:host=localhost:database=sys','mail','activate') or die "Error connecting to sys db on localhost";

# Collect any form input passed in 
*in = getInput();  
%dat = %in;	# Duplicate passed in data into our output hash

# Grab field names from Domain table
@fields = grep !/DomainID/, @{$dbh->selectcol_arrayref("desc Domain")};

$user = getUser($ENV{'REMOTE_USER'});
$dat{'user_home'} = $user->{'dir'};
$dat{'user'} = $user;

my %defaults = (
      'Domain' 	   => '',
		'Host'	      => 'www',
      'ServerRoot'   => "$user->{'dir'}/domains/$in{'Domain'}/$in{'Host'}".
		'user'		   => 'pimp',
		'ServerType'   => 'standard',
      'DocumentRoot' => 'www',
		'IP'		      => '*',
		'Port'		   => '80',
		'ScriptAlias'	=> '',
		'Active'	      => '1',
		'CustomLog'	   => 'logs/access_log',
		'ErrorLog'	   => 'logs/error_log',
		'LogType'	   => 'combined',
		'ServerAdmin'	=> 'webmaster@pimp.net'
               );

if ($in{'exec'} =~ /new/i) {
   
   # Perform some basic sanity checks on required data
   if (((!$in{'Host'}) && (!$in{'Domain'})) || (!$in{'Domain'}) || (!$in{'ServerRoot'}) || ($in{'CustomLog'} =~ /HOSTNAME/i)) {
      $in{'exec'} = 'lookup';
   } else {
      # Check for existing host.Domain in db
      $cth = $dbh->prepare("select * from Domain where Host='$in{'Host'}' and Domain='$in{'Domain'}'");
      $cth->execute();
      
      # Stuff alert with error if Domain exists, otherwise create new site
      if ($cth->rows) {
         $dat{'alert'} = "alert('The website \\'$in{'Host'}.$in{'Domain'}\\' already exists. \\nNot creating new site.');";
      } else {   
         my @vals = ();
	 my $val = '';
    
    $in{'ServerAdmin'} = 'webmaster@'.$in{'Domain'};
    $in{'IP'} = '*';
	 # Prepare data for insert, use default if no data provided.  
	 # Use DBI quote utility to make values safe for insert
    foreach my $f (@fields) {
	    $val = ($in{$f} !~ /\w/) ? $default{$f} : $in{$f};
	    if ($val) {
	       push(@vals, $dbh->quote($val));
	    } else {
	       push(@vals, "''");
	    }   
         }
         $insert = "insert into Domain (".join(", ", @fields).") values (".join(", ", @vals).")";
         $dbh->do($insert) or $dat{'alert'} = "alert('Error creating record for $in{'Host'}.$in{'Domain'}:\\n".$dbh->errstr."\\n');" and $err = 1;
	 
	 if (!$err) {
	    # Record new DomainID
            $in{'DomainID'} = $dbh->{'mysql_insertid'};

            # If Host provided, add alias for just the Domain
	    if ($in{'Host'}) {
               $dbh->do("insert into server_alias (DomainID, alias) values ($in{'DomainID'}, '$in{'Domain'}')");
	    }   
       flagUpdate();
         }	 
      }
   }   
} elsif ($in{'exec'} =~ /update/) {
   my $sth = $dbh->prepare("select * from Domain where DomainID=$in{'DomainID'}");
   $sth->execute();
   my %Domain = %{$sth->fetchrow_hashref};
   
   my @vals = ();
   foreach $field (@fields) {
      if (($Domain{$field} ne $in{$field}) && ($in{$field} =~ /\w/)) {
         push(@vals, "$field=".$dbh->quote($in{$field}));
      }
   }
   
   if (@vals) {
      $dbh->do("update Domain set ".join(", ", @vals)." where DomainID=$in{'DomainID'}");
      $dat{'alert'} = "alert('Updated record for \\'$in{'Host'}\\' with the following details:\\n\\n\\t".join("\\n\\t", @vals)."\\n');";
      flagUpdate();
   }
} elsif ($in{'exec'} =~ /delete/) {
   if ($in{'DomainID'}) {
      $sth = $dbh->prepare("select * from Domain where DomainID=$in{'DomainID'}");
      $sth->execute();
      $fields = $sth->{NAME};
      $vals = $sth->fetchrow_arrayref;
      open(SAVE, ">archive/$in{'Host'}-$in{'DomainID'}");
         print SAVE join("\t", @{$fields})."\n";
         print SAVE join("\t", @{$vals})."\n";
      close SAVE;
      $dbh->do("delete from Domain where DomainID=$in{'DomainID'}");
      flagUpdate();
   }

   $dat{'alert'} = "alert('Deleted httpd records for \\'$in{'Host'}.$in{'Domain'}\\'.\\n\\nThe files have NOT been removed.\\n\\nPlease archive the files in $in{'ServerRoot'} and\\nremove from the server.');";
   $in{'DomainID'} = $dat{'Host'} = $dat{'DomainID'} = $dat{'ServerRoot'} = $dat{'DocumentRoot'} = $dat{'ScriptAlias'} = $dat{'CustomLog'} = $dat{'ErrorLog'} = undef;
}

$dat{'REMOTE_USER'} = $ENV{'REMOTE_USER'} if (!$dat{'REMOTE_USER'});

# 
# Build list of Domains and populate values for selected record
#
$sth = $dbh->prepare("select * from Domain order by Host, Domain");
$sth->execute();

while (%rec = %{$sth->fetchrow_hashref}) {
   $in{'DomainID'} = $rec{'DomainID'} if (!$in{'DomainID'});
   if ($rec{'DomainID'} eq $in{'DomainID'}) {
      %dat = (%dat, %rec);
      $selected = " SELECTED";
      if (-e $rec{'ServerRoot'}."/".$rec{'DocumentRoot'}) {
         $dat{'status'} = "<span style='font-size:12px; font-weight:bold; color:#00aa00;'>Available</span>";
      } else {
         $dat{'status'} = "<span style='font-size:12px; font-weight:bold; color:#aa0000;'>Pending</span>";
      }
   } else {
      $selected = "";
   }
   $secure = '';
   $secure = '*' if ($rec{'type'} eq 'secure');
   $rec{'Host'} .= '.' if ($rec{'Host'} =~ /\w/);
   $dat{'sites'} .= "<option value='$rec{'DomainID'}'$selected>$rec{'Host'}$rec{'Domain'}$secure</option>";
}
#$dat{'Host'} .= '.' if ($dat{'Host'} =~ /\w$/);
$urltype = 'http://';
$urltype = 'https://' if ($dat{'type'} =~ /secure/i);

$dat{'URL'} = $urltype.$dat{'Host'}.'.'.$dat{'Domain'};
$in{'page'} = "sites.html" if (!$in{'page'});

$dat{'Active'} = " CHECKED" if ($dat{'Active'} eq '1');

open(HTML, "$in{'page'}") or die "Error opening $in{'page'} for reading: $!";
   while ($html = <HTML>) {
      $html =~ s/\#([\w\.]+)\#/$dat{$1}/gi;
      print $html;
   }
close HTML;

exit 0;

sub getUser {
   my $user = shift @_;
   my @fields = ('name','passwd','uid','gid','quota','comment','gcos','dir','shell','expire');
   my @values = getpwnam($user);
   my %usr;
               
   foreach (0..$#fields) {
      $usr{$fields[$_]} = $values[$_];
   }
   return \%usr;
}

sub flagUpdate {

   open(FLAG, ">/tmp/.sysupdate/httpd") or die "Error creating /tmp/.sysupdate/httpd"; 
      print FLAG "$$";
   close FLAG;

}
1;
