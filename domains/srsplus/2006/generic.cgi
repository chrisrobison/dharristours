#!/usr/bin/perl
#
#
use DBI;
use CDR::Input;
use CDR::DB;
open( STDERR, ">&STDOUT" );

# Setup client headers and input if we are in HTTP environment
if ( $ENV{'HTTP_HOST'} ) {
   $| = 1;
   print "Content-type: text/html\n\n";
}
*in = getInput();
%dat = %in;

# Setup database connection info
my %dbconf = (
    'user'   => 'pimp',
    'passwd' => 'pimpin',
    'host'   => 'localhost',
    'dbdrv'  => 'mysql',
    'db'     => 'wizard'
);

$dbconf{'driver'} = "dbi:$dbconf{'dbdrv'}:host=$dbconf{'host'}:database=$dbconf{'db'}";

# Connect to our db server
$dbh = DBI->connect( $dbconf{'driver'}, $dbconf{'user'}, $dbconf{'passwd'} )
        or die "Error connecting to $dbconf{'driver'} DB server on '$dbconf{'host'}' as '$dbconf{'user'}': $!";

my $data = new CDR::DB($dbh);
my ( $curKey, $curID );
$in{'curKey'} = $dat{'curKey'} = $curKey = $in{'table'} . 'ID';
$in{'curID'}  = $dat{'curID'}  = $curID  = $in{$curKey};

if ( $in{'table'} =~ /([a-zA-Z0-9]+)_([a-zA-Z0-9]+)/i ) {

# Call messy code to perform table linking [needs to be moved into CDR::DB class]
    do_link( $1, $2 );
}
else {
    if ( $in{'exec'} eq "new" )
    {    # Clear current ID and create new record with form data
        $in{$curKey} = undef;
        $data->new_record( $in{'table'}, \%in );
        $dat{'curID'} = $dat{$curKey} = $in{$curKey} = $curID = $data->{'id'};
    }
    elsif ( $in{'exec'} eq "update" )
    {    # Update current record with form data sent
        $data->update_record( $in{'table'}, $curID, \%in );
    }
    elsif ( $in{'exec'} eq "delete" ) {    # Delete current record from table
        $data->delete_record( $in{'table'}, $curID, \%in );
        $in{$curKey} = $dat{$curKey} = $curID = undef;
    }
    elsif ( $in{'exec'} eq "change_table" ) {
        $in{$curKey} = $dat{$curKey} = $curID = undef;
    }
    %dat = ( %dat, %{$data} );

    my $sth = $dbh->prepare("select * from $in{'table'}");
    $sth->execute();
    my @tblfields = @{ $sth->{NAME} };
    shift @tblfields;
    $dat{'fields'} = "'" . join ( "','", @tblfields ) . "'";

    my ( $current, $s );
    while ( %rec = %{ $sth->fetchrow_hashref } ) {
        if ( $in{'table'} =~ /user/i ) {
            if ( length( $rec{'Passwd'} ) != 16 ) {
                $dbh->do( "update $in{'table'} set Passwd=password("
                      . $dbh->quote( $rec{'Passwd'} )
                      . ") where $in{'table'}ID="
                      . $rec{"$in{'table'}ID"} );
            }
        }
        $curID = $in{$curKey} = $dat{$curKey} = $dat{'curID'} = $rec{$curKey}
          if ( !$dat{$curKey} );

        if ( $rec{$curKey} == $curID ) {
            $s       = " SELECTED";
            %dat     = ( %dat, %rec );
            %current = %rec;
        }
        else {
            $s = '';
        }
        $dat{'records'} .= "<option value='$rec{$in{'table'}.'ID'}'$s>\["
          . $rec{ $in{'table'} . 'ID' } . "\] - "
          . $rec{ ucfirst( $in{'table'} ) }
          . "</option>\n";
    }
    $dat{'Table'}         = ucfirst( $dat{'table'} );
    $dat{'record_detail'} = build_form( $in{'table'}, \%current );
    $dat{'buttons'}       = "BTNS";
}

# $data->get_tables($dbconf{'db'});
# $dat{'dbtables'} = $data->build_select(\%tbl, $in{'table'});
my $tth =
  $dbh->prepare("select Section, DisplayName from section order by Priority");
$tth->execute() or warn "DB ERROR: " . $dbh->errstr;
while ( my $rec = $tth->fetchrow_hashref ) {
    $s = '';
    $s = ' SELECTED' if ( $in{'table'} eq $rec->{'Section'} );
    $dat{'dbtables'} .= "<option value='"
      . $rec->{'Section'} . "'$s>"
      . $rec->{'DisplayName'}
      . "</option>";
}

$dat{'REMOTE_USER'} = $ENV{'REMOTE_USER'} if ( !$dat{'REMOTE_USER'} );
$in{'page'}         = "main.html"         if ( !$in{'page'} );

open( SECT, $in{'type_display'} . '.html' )
  or die "Error opening $in{'type_display'} for reading: $!";
while ( my $html = <SECT> ) {
    $html =~ s/\#(\w+)\#/$dat{$1}/gi;
    $dat{'formUI'} .= $html;
}
close SECT;

open( HTML, $in{'page'} ) or die "Error opening $in{'page'} for reading: $!";
while ( $html = <HTML> ) {
    $html =~ s/\#(\w+)\#/$dat{$1}/gi;
    $html =~ s/\#(\w+)\#/$dat{$1}/gi;
    print $html;
}
close HTML;

exit 0;

sub build_form {
    my $table  = shift @_;
    my $record = shift @_;
    my ( $form, $size, $link );

    my $sth = $dbh->prepare("desc $table");
    $sth->execute() or die "Error: " . $dbh->errstr;

    while ( %rec = %{ $sth->fetchrow_hashref } ) {
        if ( $rec{'Type'} =~ /(\d+)/ ) {
            $size = $1;
        }
        elsif ( $rec{'Type'} =~ /date/ ) {
            $size = 15;
        }

        $size = 70 if ( $size > 70 );
        next if ( $rec{'Field'} =~ /${table}ID/ );
        if ( $rec{'Field'} =~ /(\w+)ID/ ) {
            my $lntbl   = $1;
            my $linkref =
              get_links( $lntbl, $rec{'Field'}, $record->{ $rec{'Field'} } );
            my @link = ();
            my @keys = keys %{$linkref};
            $link = undef;

            my $kth = $dbh->prepare("select * from $lntbl");
            $kth->execute() or warn "DB Error: " . $dbh->errstr;

            while ( my $k = $kth->fetchrow_hashref ) {
                if ( $k->{ $rec{'Field'} } eq $record->{ $rec{'Field'} } ) {
                    $s = ' SELECTED';
                }
                else {
                    $s = '';
                }
                $link .= "<option value='"
                  . $k->{ $lntbl . 'ID' }
                  . "'$s>\["
                  . $k->{ $lntbl . 'ID' } . "\] "
                  . $k->{ ucfirst($lntbl) }
                  . "</option>\n\t\t";
            }

#	 $link = '[ '.$lntbl.': <a href="index.cgi?table='.$lntbl.'&'.$rec{'Field'}.'='.$keys[0].'">'.join(", ", @link).'</a>]';
            $rec{'Type'} = "select" if ($link);
        }
        else {
            $link = '';
        }
        $newline =
"<tr>\n\t<td align='right' valign='top' class='MAIN'><span class='FIELD'>"
          . $rec{'Field'}
          . ":</span></td>\n\t";
        if ( $rec{'Type'} =~ /text/ ) {
            $newline .=
"<td valign='top' class='MAIN'><textarea cols='70' rows='4' name='"
              . $rec{'Field'}
              . "' size='$size' class='DATA' onChange='doChange();'>"
              . $record->{ $rec{'Field'} }
              . "</textarea></td></tr>\n";
        }
        elsif ( $rec{'Type'} eq "select" ) {
            $newline .= "<td class='MAIN'><select name='"
              . $rec{'Field'}
              . "' class='DATA' onChange='doChange();'>\n\t\t$link\n</select></td></tr>\n";
        }
        elsif ( $rec{'Field'} =~ /^passwd$/i ) {
            $newline .= "<td class='MAIN'><input type='password' name='"
              . $rec{'Field'}
              . "' size='$size' value='"
              . $record->{ $rec{'Field'} }
              . "' class='DATA' onChange='doChange();'></td></tr>\n";
        }
        else {
            $newline .= "<td class='MAIN'><input type='text' name='"
              . $rec{'Field'}
              . "' size='$size' value='"
              . $record->{ $rec{'Field'} }
              . "' class='DATA' onChange='doChange();'></td></tr>\n";
        }
        $form .= $newline;
    }

    return $form;
}

sub get_links {
    my $table = shift @_;
    my $key   = shift @_;
    my $id    = shift @_;

    my $sth =
      $dbh->prepare( "select ${table}ID, "
          . ucfirst($table)
          . " from $table where ${table}ID='$id'" );
    $sth->execute() or die "Error: " . $dbh->errstr;

    my %record;
    while ( $rec = $sth->fetchrow_arrayref ) {
        $record{ $rec->[0] } = $rec->[1];
    }

    return ( \%record );
}

sub do_link {
    my %link;
    my $table = $in{'table'};
    $link{'src_table'}  = shift @_;
    $link{'dest_table'} = shift @_;
    $link{'dest_table'} =~ s/s$//i;
    $in{'type_display'} = $dat{'type_display'} = "links";
    $in{'Dest_table'}   = $dat{'Dest_table'}   = ucfirst( $link{'dest_table'} );
    $in{'Table'}        = $dat{'Table'}        = ucfirst( $link{'src_table'} );
    $dat{'src_table'}   = $link{'src_table'};
    $curKey = $in{'curKey'} = $dat{'curKey'} = $link{'src_table'} . 'ID';
    $curID  = $in{'curID'}  = $dat{'curID'}  = $in{$curKey};
    my $linkKey   = $link{'dest_table'} . 'ID';
    my $linkTable = ucfirst( $link{'dest_table'} );
    my %got;

    if ( $in{'exec'} =~ /save|update/i ) {
        my @ids = split ( /\,/, $in{'my_ids'} );
        my %ids = ();
        foreach (@ids) { $ids{$_} = $_; }

        my $sth = $dbh->prepare("select * from $table where $curKey='$curID'");
        $sth->execute();

        while ( my %rec = %{ $sth->fetchrow_hashref } ) {
            if ( defined $ids{ $rec{$linkKey} } ) {
                $ids{ $rec{$linkKey} } = undef;
                $got{ $rec{$linkKey} } = 1;
                next;
            }
            else {
                my $delete =
"delete from $table where $curKey='$curID' and $linkKey='$rec{$linkKey}'";
                $dbh->do("$delete");
                next;
            }
        }
        foreach my $k ( keys %ids ) {
            next if ( $got{$k} == 1 );
            my $insert =
              "insert into $table ($curKey, $linkKey) values ('$curID', '$k')";
            $dbh->do($insert);
        }
    }

    my $sth = $dbh->prepare("select * from $link{'src_table'}");
    $sth->execute();

    my ( $current, $s );
    while ( %rec = %{ $sth->fetchrow_hashref } ) {
        $curID = $in{$curKey} = $dat{$curKey} = $rec{$curKey} if ( !$curKey );

        if ( $rec{$curKey} == $curID ) {
            $s       = " SELECTED";
            %dat     = ( %dat, %rec );
            %current = %rec;
        }
        else {
            $s = '';
        }
        $dat{'records'} .= "<option value='$rec{$curKey}'$s>\["
          . $rec{$curKey} . "\] - "
          . $rec{ ucfirst( $link{'src_table'} ) }
          . "</option>\n";
    }
    my $sth =
      $dbh->prepare("select * from $in{'table'} where $curKey='$in{$curKey}'");
    $sth->execute();

    while ( my %myvals = %{ $sth->fetchrow_hashref } ) {
        $seen{ $myvals{$linkKey} } = 1;
    }

    my $sth = $dbh->prepare("select * from $link{'dest_table'}");
    $sth->execute();

    while ( %allvals = %{ $sth->fetchrow_hashref } ) {
        if ( defined $seen{ $allvals{$linkKey} } ) {
            $dat{'my_values'} .=
"<option value='$allvals{$linkKey}'>\[$allvals{$linkKey}\] $allvals{$linkTable}</option>";
        }
        else {
            $dat{'all_values'} .=
"<option value='$allvals{$linkKey}'>\[$allvals{$linkKey}\] $allvals{$linkTable}</option>";
        }
    }
    $dat{'buttons'} = "NOBTNS";

    return 1;
}

