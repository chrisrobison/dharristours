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
GD::Image->trueColor(1);
$images = "./img/tabs";
open(STDERR, ">&STDOUT");
use CDR::Input;

*in = getInput();
# Set defaults (so we always output an image, not an error)

if (($ENV{'HTTP_HOST'}) && ($in{'disk'} ne "1")) {
   $| = 1; print "Content-type: image/png\n\n"; 
}
$tabname = $in{'tab'} || "Example Tab";
$tabname =~ s/[\+_]/ /g;

$in{'state'} = "down" if ((!$in{'state'}) || ($in{'state'} =~ /dwn|down|0/i));
$in{'name'} = $in{'tab'} if (!$in{'name'});  # Set filename to save as if no name passed in
$in{'style'} = 'alt4' if (!$in{'style'});

if ($in{'state'} =~ /down/i) {
   $txtsize = 9;
} else {
   $txtsize = 10;
}

$font = $in{'font'} || "/export/home/cdr/fonts/tahoma.ttf";

#
# Call genText() to generate our text overlay and grab the image size attributes
# so we know how big to make our tab later
#
($txtimg, @txtbounds) = genText($tabname, $txtsize, 300, 100, $font, 'black');

@tabs = ('left', 'mid', 'right');

foreach $subtab (@tabs) { 
   $tab{$subtab} = readTemplate($images, $in{'state'}, $subtab, $style, $color); 
   ($width{$subtab}, $height{$subtab}) = $tab{$subtab}->getBounds();
   print "$subtab: $width{$subtab} x $height{$subtab}\n" if $debug;
}

#
# Calculate width of tab using the size of our generated image text plus the 
# width of both the right and the left tab templates + 5 pixels for padding
#
$tablen = (($txtbounds[4] - $txtbounds[6]) + $width{'left'} + $width{'right'}) + 5;

# Create our image to build tab and text on with our calculated height and width
$tab = new GD::Image($tablen, $height{'left'});

# Turn off alphaBlending and turn on saveAlpha to retain alpha layer information
$tab->alphaBlending(0);
$tab->saveAlpha(1);

# Calculate where to place right tab template
$rite = $tablen - $width{'right'};

# Calculate amount to stretch middle tab chunk based on generated image text width
$stretch = $tablen + ($txtbounds[4] - $txtbounds[6]);

#
# Copy left, middle, and right tab template pieces onto our output image using
# the values calculated above
#
$tab->copy($tab{'left'}, 0, 0, 0, 0, $width{'left'}, $height{'left'});
$tab->copyResized($tab{'mid'}, $width{'left'}, 0, 0, 0, $stretch, $height{'left'}, $width{'left'}, $height{'left'});
$tab->copy($tab{'right'}, $rite, 0, 0, 0, $width{'right'}, $height{'right'});

# Define Y offset for placement of the generated image text 
#     ('up' tab text is placed 5 pixels higher)
$offset = $in{'state'} eq 'up' ? - 5 : 0;

# Calculate Y coordinate for top of text image overlay
$top = ( int( $height{'left'} / 2 ) + $offset ) + 1;

if ($in{'state'} eq "up") {
   $tab->copyMerge($txtimg, ($width{'left'} + 2), $top, $txtbounds[6], $txtbounds[7], ($txtbounds[4] - $txtbounds[6]), ($txtbounds[3] - $txtbounds[7], '100%'));
} else {
   $tab->copyMerge($txtimg, ($width{'left'} + 3), ($top - 1), $txtbounds[6], $txtbounds[7], ($txtbounds[4] - $txtbounds[6]), ($txtbounds[3] - $txtbounds[7], '100%'));
}

$in{'tab'} =~ s/\s+/_/g;
($name = $in{'name'}) =~ s/\s+/_/g;
print $tab->png if (($ENV{'HTTP_HOST'}) && ($in{'disk'} ne "1") && (!$in{'show'}));

if (!-e "./img/tab-$in{'tab'}-$in{'state'}.png") {
   $in{'state'} .= "-$in{'action'}" if ($in{'action'});
   $in{'name'} =~ s/\s/\_/g;
   open(TAB, ">./img/tab-$in{'tab'}-$in{'state'}.png");
      print TAB $tab->png;
   close TAB;
   chmod "./img/tab-$in{'tab'}-$in{'state'}.png", 0644;
}

#print $height{'left'} if ($ENV{'HTTP_HOST'});
exit 0;

sub readTemplate {
   my($images, $state, $subtab, $style, $color) = @_ if @_;
   my($tpl, $tabname);
   
   $tabname = "$images/";
#   $tabname .= "$color\-" if ($color);
   $tabname .= 'alt4-'.$state."\-".$subtab."\.png";

   open(TAB, "$tabname") or die "Error opening $tabname";
      $tpl = newFromPng GD::Image(TAB) or die "Error creating gif from file.";
   close TAB;

   return $tpl;
}

#
# genText(TABTEXT, TEXTSIZE, MAX_X, MAX_Y, TTF_FONT, COLOR)
#
sub genText {
   my $txtstring = shift @_ || "Example";
   my $txtsize = shift @_ || 11;
   my $width = shift @_ || 200;
   my $height = shift @_ || 100;
   my $font = shift @_ || "arial.ttf";
   my $txtcolor = shift @_ || "black";
   my $bgcolor = shift @_ || "#909090";
   my $directory = "/export/home/cdr/fonts"; # shift || FONT_DIRECTORY;

   my $im = new GD::Image($width, $height);
   my %colors = ();
   
   $colors{'white'} = $im->colorAllocate(255, 255, 255);
   $colors{'black'} = $im->colorAllocate(0, 0, 0);
   $colors{'grey'} = $im->colorAllocate(204, 204, 204);
   
   $im->transparent($colors{'grey'});
   $im->fill(100, 100, $colors{'grey'});
   my ($x, $y) = (20, 50);
   my $max_x = 0;

   my $fontpath = $directory."/arial.ttf";
   my ($font_name) = $fontpath =~ /([^\\\/]+)$/;
   
   $txtcolor = 'black' if (!$colors{$txtcolor});
   (my @h = $im->stringTTF($colors{$txtcolor}, $fontpath, $txtsize, 0.0, $x, $y, $txtstring)) || next;

   return $im, @h;
}

sub setColors {
   $black = $tab->colorAllocate(1, 1, 1);
   $white = $tab->colorAllocate(255, 255, 255);
   $yellow = $tab->colorAllocate(255, 255, 0);
   $green = $tab->colorAllocate(255, 0, 0);
   $red = $tab->colorAllocate(255, 0, 0);
   $blue  = $tab->colorAllocate(0, 0, 255);
   $grey  = $tab->colorAllocate(128, 128, 128);
   $grey1 = $tab->colorAllocate(92, 92, 92);
   $grey2 = $tab->colorAllocate(192, 192, 192);
}

sub addColor {
   my $img = shift @_;
   my $clr = shift @_;
   
   if ($clr =~ /^\#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})/) {
      my $r = $1;
      my $g = $2;
      my $b = $3;
   } else {
      return 0;
   }
   return($img->colorAllocate(hex($r), hex($g), hex($b)));
}
