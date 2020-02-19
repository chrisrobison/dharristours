sub buildModuleList {
   my %modmap = ();
   my %module = ();

   open(CVS, "/usr/bin/cvs -d /cvsroot co -c |");
      my @mods = sort(<CVS>);
   close CVS;
   chomp(@mods);

   while (my $mod = shift @mods) {
      chomp $mod;
      if ($mod =~ /([\w\.\-]+)\s+\-a\s(.*)/) {
         $modmap{$2} = $1;
      } else {
         my($modnm, $modloc) = split(/\s+/, $mod);
         $module{$modnm} = $modloc;
      }  
   }

   foreach my $mod (sort(keys(%module))) {
      $dat{'modules'} .= "<option value='$mod'>\[$mod\] $modmap{$mod}</option>\n";
      $done{$mod} = 1;
   }

   foreach my $mod (sort(keys(%module))) {
      next if (defined $done{$mod});
      $dat{'modules'} .= "<option value='$mod'>$mod</option>\n";
   }


   return $dat{'modules'};
}

1;
