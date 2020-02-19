#!/usr/bin/perl
&getInput;

print "Content-type: text/html\n\n";
chomp($me = `whoami`);

print "<html><head><title>CGI Environment at $ENV{'HTTP_HOST'}</title></head><body><h1>CGI Environment Dump for $ENV{'HTTP_HOST'}</h1><hr>";
print "<h2>This script is being executed by: <font color='red'><b>$me</b></font></h2><hr>";

print "<h1>ENV</h1><blockquote>";
print "<table border=2 cellpadding=2 cellspacing=1><tr bgcolor=\"#000099\"><td align=center><font color='#ffffff' size=+1><b>Key</b></font></td><td align=center><font color='#ffffff' size=+1><b>Value</b></font></td></tr>";

foreach $i (sort(keys(%ENV))) {
   print "<tr><td align=right bgcolor=\"#cccccc\"><b>$i</b>:&nbsp;</td><td>&nbsp;$ENV{$i}</td></tr>\n";
}

print "</table></blockquote><hr><h1>in</h1><blockquote>";
print "<table border=2 cellpadding=2 cellspacing=1><tr bgcolor=\"#000099\"><td align=center><font color='#ffffff' size=+1><b>Key</b></font></td><td align=center><font color='#ffffff' size=+1><b>Value</b></font></td></tr>";

foreach $i (sort(keys(%in))) {
   print "<tr><td align=right bgcolor=\"#cccccc\"><b>$i</b>:&nbsp;</td><td>&nbsp;$in{$i}</td></tr>\n";
}

print "</table></blockquote><form action=\"env.cgi\" method=GET><input type=TEXT name=\"test\"><input type=SUBMIT></form></body></html>";

exit 0;

# getInput: 
# Reads form data passed from client and returns in %in
sub getInput {
   local (*in) = @_ if @_;
   local ($i, $loc, $key, $val);

   if ($ENV{'REQUEST_METHOD'} eq "GET") {
      $in = $ENV{'QUERY_STRING'};
   }
   elsif ($ENV{'REQUEST_METHOD'} eq "POST") {
      read(STDIN,$in,$ENV{'CONTENT_LENGTH'});
   }
   @in = split(/&/,$in);
   while ($k = shift @in) {
      $k =~ s/\+/ /g;
      ($key, $value) = split(/=/,$k,2);
      $key =~ s/%(..)/pack("c",hex($1))/ge;
      $value =~ s/%(..)/pack("c",hex($1))/ge;
      $in{$key} .= "\0" if (defined($in{$key})); # \0 is the multiple separator
      $in{$key} .= $value;
   }
   return(1); 
}
