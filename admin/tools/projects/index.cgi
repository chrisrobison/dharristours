#!/usr/bin/perl
#
#
use DBI;
use CDR::Input;
use CDR::DB;
open(STDERR, ">&STDOUT");
# Setup client headers and input if we are in HTTP environment
$| = 1; print "Content-type: text/html\n\n" if ($ENV{'HTTP_HOST'});    
*in = getInput();

$in{'table'} = "project" if (!$in{'table'});
$in{'type_display'} = "detail" if ($in{'table'} !~ /_/);
%dat = %in;

# Setup database connection info
my %dbconf = (	'user'    => 'mail',
		         'passwd'  => 'activate',
		         'host'    => 'dev',
		         'dbdrv'   => 'mysql',
		         'db'      => 'admin'
      	     );	
$dbconf{'driver'} = "dbi:$dbconf{'dbdrv'}:host=$dbconf{'host'}:database=$dbconf{'db'}";

# Connect to our db server 
$dbh = DBI->connect($dbconf{'driver'}, $dbconf{'user'}, $dbconf{'passwd'}) 
	or die "Error connecting to $dbconf{'driver'} DB server on '$dbconf{'host'}' as '$dbconf{'user'}': $!";

my $data = new CDR::DB($dbh);
my ($curKey, $curID);
$in{'curKey'} = $dat{'curKey'} = $curKey = $in{'table'}.'ID';
$in{'curID'} = $dat{'curID'} = $curID = $in{$curKey};

# First handle linked tables if that's what we're viewing
if ($in{'table'} =~ /([a-zA-Z0-9]+)_([a-zA-Z0-9]+)/i) {
   do_link($1, $2);
# Otherwise, handle single table functions
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

   my $sth = $dbh->prepare("select * from $in{'table'}");
   $sth->execute();
   my @tblfields = @{$sth->{NAME}};
   shift @tblfields;
   $dat{'fields'} = "'".join("','", @tblfields)."'";

   my ($current, $s);
   while (%rec = %{$sth->fetchrow_hashref}) {
      $curID = $rec{$curKey} if (!$curID);

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
         $val = $rec{$in{'table'}};
         $val = $rec{ucfirst($in{'table'})} if (!$val);
      }   
      $dat{'records'} .= "<option value='$rec{$in{'table'}.'ID'}'$s>\[".$rec{$in{'table'}.'ID'}."\] - ".$val."</option>\n";
   }
   $dat{'Table'} = ucfirst($dat{'table'});
   $dat{'record_detail'} = build_form($in{'table'}, \%current);
   $dat{'buttons'} = "BTNS";
}

$dat{'REMOTE_USER'} = $ENV{'REMOTE_USER'} if (!$dat{'REMOTE_USER'});
$in{'page'} = "main.html" if (!$in{'page'});

open(SECT, $in{'type_display'}.'.html') or die "Error opening $in{'type_display'} for reading: $!";
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
         $newline = "<tr>\n\t<td align='right' valign='top' class='FIELD'><span class='FIELD'>".$rec{'Field'}.":</span></td>\n\t<td valign='top' class='MAIN'><textarea cols='70' rows='4' name='".$rec{'Field'}."' size='$size' class='DATA' onChange='doChange();'>".$record->{$rec{'Field'}}."</textarea></td>\n</tr>\n";
      } else {
         $newline = "<tr>\n\t<td align='right' valign='top' class='FIELD'><span class='FIELD'>".$rec{'Field'}.":</span></td>\n\t<td class='MAIN'><input type='text' name='".$rec{'Field'}."' size='$size' value='".$record->{$rec{'Field'}}."' class='DATA' onChange='doChange();'>$link</td>\n</tr>\n";
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
   
   my $sth = $dbh->prepare("select * from $link{'src_table'}");
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
