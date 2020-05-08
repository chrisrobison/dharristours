#!/usr/bin/perl
#
#
use DBI;
use CDR::DB;
open(STDERR, ">&STDOUT");
# Setup client headers and input if we are in HTTP environment
$| = 1; print "Content-type: text/html\n\n" if ($ENV{'HTTP_HOST'});    
*in = getInput();
%in = (%in, %ENV);

$in{'section'} = "EmailDomains" if (!$in{'section'});
$in{'table'} = "domain" if (!$in{'table'});
$in{'currentTab'} = '0' if (!$in{'currentTab'});

#$in{'type_display'} = "detail" if ($in{'table'} !~ /_/);
%dat = %in;

# Setup database connection info
my %dbconf = (	'user'    => 'pimp',
               'passwd'  => 'pimpin',
               'host'    => 'localhost',
               'dbdrv'   => 'mysql',
               'db'      => 'mail'
	     );	
$dbconf{'driver'} = "dbi:$dbconf{'dbdrv'}:host=$dbconf{'host'}:database=$dbconf{'db'}";
#$conf = read_conf("db.conf");

# Connect to our db server 
$dbh = DBI->connect($dbconf{'driver'}, $dbconf{'user'}, $dbconf{'passwd'}) 
	or die "Error connecting to $dbconf{'driver'} DB server on '$dbconf{'host'}' as '$dbconf{'user'}': $!";

my $data = new CDR::DB($dbh);
my ($curKey, $curID);
$in{'curKey'} = $dat{'curKey'} = $curKey = $in{'table'}.'ID';
$in{'curID'} = $dat{'curID'} = $curID = $in{$curKey};

if ($in{'table'} =~ /([a-zA-Z0-9]+)_([a-zA-Z0-9]+)/i) {
   do_link($1, $2);
} else {
   if ($in{'exec'} eq "new") {
      $in{$curKey} = '';
      $data->new_record($in{'table'}, \%in);
      $dat{$curKey} = $in{$curKey} = $curID = $data->{id};
   } elsif ($in{'exec'} eq	"update") {
      $data->update_record($in{'table'}, $curID, \%in);
   } elsif ($in{'exec'} eq "delete") {
      $data->delete_record($in{'table'}, $curID, \%in);
      $in{$curKey} = $dat{$curKey} = '';
   }
#   if ($in{'view'} eq 'my') {
      $cond = " AND client='$in{'REMOTE_USER'}'";
#   }   
   if ($in{'section'} eq "EmailDomains") {
      $dat{'domains'} = build_Options('domain', 'domainID', ' where domain=parent '.$cond, 'domain');
   }
   if ($in{'section'} eq "Accounts") {
      $dat{'domains'} = build_Options('domain','domainID', ' where domain=parent '.$cond,'domain');
      $dat{'users'} = build_Options('user', 'userID', " where domain='$dat{'domain'}'", 'user', 'name');
   }
   if ($in{'section'} eq "Aliases") {
      $dat{'domains'} = build_Options('domain','domainID', ' where domain=parent '.$cond,'domain');
      $dat{'aliases'} = build_Options('alias', 'aliasID', " where domain='$dat{'domain'}'".$cond, 'alias', 'routeto');
   }   
}
if ($dat{'active'} =~ /true|1/) {
   $dat{'active'} = ' CHECKED';
}
if ($dat{'virus'} =~ /true|1/i) {
   $dat{'virus'} = ' CHECKED';
}   
 
$dat{'fields'} = "'".join("','", $data->get_fields($in{'table'}))."'";

#$dat{'dbtables'} = $data->build_select($data->{'tables'}, $in{'table'});
$dat{'REMOTE_USER'} = $ENV{'REMOTE_USER'} if (!$dat{'REMOTE_USER'});
$in{'page'} = "main.html" if (!$in{'page'});

open(SECT, $in{'section'}.'.html') or die "Error opening $in{'section'} for reading: $!";
   while (my $html = <SECT>) {
      $html =~ s/\#(\w+)\#/$dat{$1}/gi;
      $dat{'formUI'} .= $html;
   }
close SECT;

open(HTML, $in{'page'}) or die "Error opening $in{'page'} for reading: $!";
   while ($html = <HTML>) {
      $html =~ s/\#(\w+)\#/$dat{$1}/gi;
      $html =~ s/\#(\w+)\#/$dat{$1}/gi;
      print $html;
   }
close HTML;

exit 0;

sub build_form {
   my $table = shift @_;
   my $record = shift @_;
   my ($form, $size, $link);
   
   $sth = $dbh->prepare("desc $table");
   $sth->execute() or die "Error: ".$dbh->errstr;
   
   while (%rec = %{$sth->fetchrow_hashref}) {
      if ($rec{'Type'} =~ /(\d+)/) {
         $size = $1;
      } elsif ($rec{'Type'} =~ /date/) {
         $size = 15;
      } 
      
      $size = 70 if ($size > 70);
      next if ($rec{'Field'} =~ /${table}ID/);
      if ($rec{'Field'} =~ /(\w+)ID/) {
         my $lntbl = $1;
         my $linkref = get_links($lntbl, $rec{'Field'}, $record->{$rec{'Field'}});
	 my @link = (); my @keys = keys %{$linkref};
	 foreach my $k (@keys) {
	    push(@link, ucfirst($linkref->{$k}));
	 } 
	 $link = '[ '.$lntbl.': <a href="index.cgi?table='.$lntbl.'&'.$rec{'Field'}.'='.$keys[0].'">'.join(", ", @link).'</a>]';
      } else {
         $link = '';
      }	 
      if ($rec{'Type'} =~ /text/) {
         $newline = "<tr><td align='right' valign='top' class='FIELD'><span class='FIELD'>".$rec{'Field'}.":</span></td><td valign='top' class='MAIN'><textarea cols='70' rows='4' name='".$rec{'Field'}."' size='$size' class='DATA' onChange='doChange();'>".$record->{$rec{'Field'}}."</textarea>\&nbsp;\&nbsp;$link\&nbsp;\&nbsp;\&nbsp;</td></tr>\n";
      } else {
         $newline = "<tr><td align='right' valign='top' class='FIELD'><span class='FIELD'>".$rec{'Field'}.":</span></td><td class='MAIN'><input type='text' name='".$rec{'Field'}."' size='$size' value='".$record->{$rec{'Field'}}."' class='DATA' onChange='doChange();'>\&nbsp;\&nbsp;$link\&nbsp;\&nbsp;\&nbsp;</td></tr>\n";
      }	 
      $form .= $newline;
   }
   
   return $form;
}

sub get_links {
   my $table = shift @_;
   my $key = shift @_;
   my $id = shift @_;

   my $sth = $dbh->prepare("select ${table}ID, ".ucfirst($table)." from $table where ${table}ID='$id'");
   $sth->execute() or die "Error: ".$dbh->errstr;
   
   my %record;
   while ($rec = $sth->fetchrow_arrayref) {
      $record{$rec->[0]} = $rec->[1];
   }

   return(\%record);
}

sub do_link {
   my %link;
   my $table = $in{'table'};
   
   $link{'src_table'} = shift @_;
   $link{'dest_table'} = shift @_;
   $link{'dest_table'} =~ s/s$//i;
   $in{'type_display'} = $dat{'type_display'} = "links";
   $in{'Dest_table'} = $dat{'Dest_table'} = ucfirst($link{'dest_table'});
   $in{'Table'} = $dat{'Table'} = ucfirst($link{'src_table'});
   $dat{'src_table'} = $link{'src_table'};
   $curKey = $in{'curKey'} = $dat{'curKey'} = $link{'src_table'}.'ID';
   $curID = $in{'curID'} = $dat{'curID'} = $in{$curKey};
   
   my $linkKey = $link{'dest_table'}.'ID';
   my $linkTable = $link{'dest_table'};
   my %got;

   if ($in{'exec'} =~ /save|update/i) {
      my @ids = split(/\,/, $in{'my_ids'});
      my %ids = ();
      
      foreach (@ids) { $ids{$_} = $_; }

      my $sth = $dbh->prepare("select * from $table where $curKey='$curID'");
      $sth->execute();
      
      while (my %rec = %{$sth->fetchrow_hashref}) {
         if (defined $ids{$rec{$linkKey}}) {
	    $ids{$rec{$linkKey}} = undef;
	    $got{$rec{$linkKey}} = 1;
	    next;
	 } else {
	    my $delete = "delete from $table where $curKey='$curID' and $linkKey='$rec{$linkKey}'";
	    $dbh->do("$delete");
	    next;
	 }
      }
      foreach my $k (keys %ids) {
         next if ($got{$k} == 1);
         my $insert = "insert into $table ($curKey, $linkKey) values ('$curID', '$k')";
	 $dbh->do($insert);
      }
   }
   
   my $sth = $dbh->prepare("select * from $link{'src_table'} where user='$in{'REMOTE_USER'}'");
   $sth->execute();
   
   my ($current, $s);
   while (%rec = %{$sth->fetchrow_hashref}) {
      $curID = $in{$curKey} = $dat{$curKey} = $rec{$curKey} if (!$curKey);

      if ($rec{$curKey} == $curID) {
         $s = " SELECTED";
         %dat = (%dat, %rec);
         %current = %rec;
      } else {
         $s = '';
      }
      my $val = '';
      if ($in{'display'}) {
         $val = $in{'display'};
         $val =~ s/\#(\w+)\#/$rec{$1}/g;
      }
      if ($val !~ /\w/) {
         $val = $dat{$in{'src_table'}} = $rec{$in{'src_table'}};
         $val = $dat{ucfirst($in{'src_table'})} = $rec{ucfirst($in{'src_table'})} if (!$val);
      }   
      $dat{'records'} .= "<option value='$rec{$curKey}'$s>\[".$rec{$curKey}."\] - ".$val."</option>\n";
   }
   my $sth = $dbh->prepare("select * from $in{'table'} where $curKey='$in{$curKey}'");
   $sth->execute();

   while (%myvals= %{$sth->fetchrow_hashref}) {
      $seen{$myvals{$linkKey}} = 1;
   }   
   
   my $sth = $dbh->prepare("select * from $link{'dest_table'}");
   $sth->execute();

   while (%allvals= %{$sth->fetchrow_hashref}) {
      if (defined $seen{$allvals{$linkKey}}) {
         $dat{'my_values'} .= "<option value='$allvals{$linkKey}'>\[$allvals{$linkKey}\] $allvals{$linkTable}</option>";
      } else {
         $dat{'all_values'} .= "<option value='$allvals{$linkKey}'>\[$allvals{$linkKey}\] $allvals{$linkTable}</option>";
      }	 
   }   
   $dat{'buttons'} = "NOBTNS";


}

sub build_Options {
   my $tbl = shift @_;
   my $key = shift @_;
   my $where = shift @_;
   my @display = @_;
   
   my $xth = $dbh->prepare("select * from $tbl $where order by $tbl");
   $xth->execute();
   my $opt = '';
   my $sel = '';
   while (my $rec = $xth->fetchrow_hashref) {
      $in{$key} =~ s/\0.*//g if ($in{$key} =~ /\0/);
      $in{$key} = $rec->{$key} if (!$in{$key});
      
      if ($rec->{$key} eq $in{$key}) {
         $sel = ' SELECTED';
         %dat = (%dat, %{$rec});
      } else {
         $sel = '';
      }   
      $opt .= "<option value='".$rec->{$key}."'$sel>";
      foreach my $d (@display) {
         $opt .= $rec->{$d}." - ";
      }
      $opt =~ s/\s\-\s$//;
      $opt .= "</option>\n";
   }
   return $opt;
}

sub getInput {
   local(*in) = @_ if @_;
   my($i, $loc, $key, $val, $req, $in, @in, $arg, $k, %keys, @dup);

   #
   # First find out where our input's coming from
   #
   $req = $ENV{'REQUEST_METHOD'};
   $req = 'tty' if (!$req);

   if ($req ne "tty") {
      if ($req eq "GET") {
         $in = $ENV{'QUERY_STRING'};
      }
      elsif ($req eq "POST") {
         read(STDIN,$in,$ENV{'CONTENT_LENGTH'});
      }

      @in = split(/&/,$in);
   } else {
      if (($#ARGV < 0) && (!$in{'noargs'})) {
         print <<EOT;
No command arguments found. Enter any switches or arguments needed
below.  One assignment per line, should follow KEY=VALUE format.
Type a blank line to continue (press ENTER twice without extra characters)
EOT
         print "> ";
         while ($in !~ /\n\n/gm) {
            $in .= <STDIN>;
            print "> ";
         }
         print "\n";
         @in = split(/\n/, $in);
      } else {
         @in = readArgs(@ARGV);
      }
   }
   @dup = @in;
   while ($i = shift @dup) {
      $i =~ s/\+/ /g;
      ($key, $val) = split(/=/,$i,2);
      $key =~ s/%(..)/pack("c",hex($1))/ge;
      $val =~ s/%(..)/pack("c",hex($1))/ge;
      $in{$key} .= "\0" if (defined $in{$key}); # \0 is the multiple separator
      $in{$key} .= $val;
   }
   return(*in);
}

