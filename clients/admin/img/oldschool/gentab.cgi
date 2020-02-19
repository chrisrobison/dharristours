#!/usr/bin/perl
#
# mktab -   Formerly a CGI program to write text on existing GIF image and 
# 	    output the whole thing as a new GIF to client, now just generates 
# 	    a GIF image based on command line arguments. Allows for a very 
#	    consistant look and easy add-on of new button and tab names.
#
#           Requires: GD.pm - GIF manipulation module for perl
#                     Two GIF images (one for 'UP', one for 'DOWN')
#                     A beer (optional)
#
#           Syntax:   mktab -tab TEXT [-state STATE]
#
#		      TEXT is the text to appear on the tab. Send spaces as
#		      plus signs(+) and they will be converted to spaces.
#
#                     STATE is the [optional] tab state (up or down). 
#		      If no tab state is specified, defaults to down.
use GD;
$images = "./templates";
   

# Set defaults (so we always output an image, not an error)
$tabname = "Error Making Tab";
while ($key = shift @ARGV) {
   if ($key =~ /^\-\-?(.*)/) {
      $arg = $1;
      if ($arg =~ /(.+?)=(.*)/) {
         $in{$1} = $2;
         next;
      } elsif ($ARGV[0] !~ /^\-/) {	 
         $val = shift @ARGV;
         $in{$arg} = $val;
	 next;
      } else {
         $in{$arg} = 1;
	 next;
      }	 
   } else {
      push(@tabs, $key);
   }
}

# Content-type not needed any longer since we are no longer a CGI
# left here for posterity
if (($ENV{'HTTP_HOST'}) && ($in{'disk'} ne "1")) {
   $| = 1; print "Content-type: image/gif\n\n"; 
   ($in{'tab'}, $state) = split(/\&/, $ENV{'QUERY_STRING'});
   $in{'tab'} =~ s/\+/ /g;
} else {
   $in{'tab'} = shift @tabs if ((!$in{'tab'}) && ($#tabs > -1));
}
$tabname = $in{'tab'} if ($in{'tab'});
$tabname =~ s/\+/ /g;

$state = $in{'state'} if ($in{'state'});
$state =~ s/_//g;
$state = "down" if ((!$state) || ($state eq "dwn"));

if ($state eq "up") {
   $width = 7;
   $font = "gdMediumBold";
} elsif ($state eq "down") {
   $width = 7;
   $font = "gdMediumBold";
}
$tablen = ((length($tabname) * $width) + 20);
$tab = new GD::Image($tablen, 32);

$white = $tab->colorAllocate(255,255,255);
$black = $tab->colorAllocate(0,0,0);
$blue = $tab->colorAllocate(0,0,255);
$grey = $tab->colorAllocate(204,204,204);
$grey1 = $tab->colorAllocate(153,153,153);
$grey2 = $tab->colorAllocate(103,103,103);
$tab->fill(1,1,$blue);
$tab->transparent($blue);

open(TAB, "$images/tab-${state}-left.gif") || die "Error opening tab-${state}-left.gif";
   $tableft = newFromGif GD::Image(TAB) || die "Error creating gif from file.";
close TAB;

open(TAB, "$images/tab-${state}-right.gif") || die "Error opening tab-${state}-right.gif";
   $tabright = newFromGif GD::Image(TAB) || die "Error creating gif from file.";
close TAB;
open(TAB, "$images/tab-${state}-middle.gif") || die "Error opening tab-${state}-mid.gif";
   $tabmid = newFromGif GD::Image(TAB) || die "Error creating gif from file.";
close TAB;
$tableftblue = $tableft->colorAllocate(0,0,255);
$tabmidblue = $tabmid->colorAllocate(0,0,255);
$tabrightblue = $tabright->colorAllocate(0,0,255);
$tableft->transparent($tableftblue);
$tabmid->transparent($tabmidblue);
$tabright->transparent($tabrightblue);

$rite = $tablen - 10;
$stretch = $tablen - 18;
$tab->copy($tableft,0,0,0,0,10,32);
$tab->copy($tabright,$rite,0,0,0,10,32);
$tab->copyResized($tabmid,10,0,0,0,$stretch,32,10,32);
$white = $tab->colorAllocate(255,255,255);

$center = ($tablen / 2) - ((int(length($tabname) / 2) * $width)) - 1;

#$tab->interlaced(1);		# cool venetian blinds effect
if ($state eq "up") {
   $tab->string(gdMediumBoldFont,11,11,"$tabname",$white);
#   $tab->string(gdMediumBoldFont,9,9,"$tabname",$black);
   $tab->string(gdMediumBoldFont,10,10,"$tabname",$black); 
} else {
#   $tab->string(gdSmallFont,11,13,"$tabname",$white);
   $tab->string(gdMediumBoldFont,11,13,"$tabname",$white);
   $tab->string(gdMediumBoldFont,10,12,"$tabname",$black);
}
$in{'state'} = $in{'state'};
#$in{'state'} = "" if ($in{'state'} =~ /down/gi);
$in{'tab'} =~ s/\s+/_/g;
print $tab->gif if (($ENV{'HTTP_HOST'}) && ($in{'disk'} ne "1"));

open(TAB, ">./tab_$in{'tab'}$in{'state'}.gif");
   print TAB $tab->gif;
close TAB;
chmod "./tab_$in{'tab'}$in{'state'}.gif", 0644;



sub readTemplate {
   my($images, $state, $section) = @_ if @_;
   my($tpl);

   open(TAB, "$images/tab-${state}-$section.gif") or die "Error opening tab_${state}-$section.gif";
      $tpl = newFromGif GD::Image(TAB) or die "Error creating gif from file.";
   close TAB;

   return $tpl;
}
