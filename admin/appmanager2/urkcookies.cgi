#!/usr/bin/perl
#
#
&getInput;
&getCookies;

print "Content-type: text/html\n";
foreach $key (%cookie) {
   &urkCookie($key);
}
print "\n";

print "<h1>Your cookies have been urked.</h1>";
foreach $key (%cookie) {
   print "$key was urked.\n";
}

exit 0;


# getInput: 
# Reads form data passed from client and returns in %in
sub getInput {
   local (*in) = @_ if @_;
   local ($i, $key, $val);

   if ($ENV{'REQUEST_METHOD'} eq "GET") {
      $in = $ENV{'QUERY_STRING'};
   }
   elsif ($ENV{'REQUEST_METHOD'} eq "POST") {
      read(STDIN,$in,$ENV{'CONTENT_LENGTH'});
   }
   @in = split(/&/,$in);
   while ($i = shift @in) {
      $i =~ s/\+/ /g;
      ($key, $value) = split(/=/,$i,2);
      $key =~ s/%(..)/pack("c",hex($1))/ge;
      $value =~ s/%(..)/pack("c",hex($1))/ge;
      $in{$key} .= "\0" if (defined($in{$key})); # \0 is the multiple separator
      $in{$key} .= $value;
   }
   return(1); 
}

#
# getCookies()
#     Reads any browser cookies into %cookie, keyed by the cookie key
#
sub getCookies {
   local(*cookie) = @_ if @_;
   local(@all, $i, @temp);

   @all = split(/\; /, $ENV{'HTTP_COOKIE'});
   while (@temp = split(/\=/, shift @all, 2)) { $cookie{$temp[0]} = $temp[1]; }
}

#
# urkCookie(KEY, VALUE)
#     Sends formatted HTTP header erasing a cookie in the clients browser
#     equal to the KEY NOTE: This routine must be called
#     before two \n's are output, but after the 'Content-type:'
#
sub urkCookie {
   local($key) = @_ if @_;

   $expdate = "Thursday, 09-Nov-89 23:39:50 GMT";
   print "Set-Cookie: $key=URKED; path=/; expires=$expdate\n";

   return 1;
}

#
# setCookie(KEY, VALUE)
#     Sends formatted HTTP header setting a cookie in the clients browser
#     equal to the KEY and VALUE passed. NOTE: This routine must be called
#     before two \n's are output, but after the 'Content-type:'
#
sub setCookie {
   local($key, $value) = @_ if @_;
   local($expdate);

   $expdate = "Wednesday, 09-Nov-99 23:39:50 GMT";
   print "Set-Cookie: $key=$value; path=/; expires=$expdate\n";

   return 1;
}


