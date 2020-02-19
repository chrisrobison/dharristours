#!/usr/bin/perl
#@(#) srs-perltoolkitapi_d13.6.0.2 11/04/09 11:30:26 certify.pl NSI
######################################################################
## 
## certify.pl
##
##      Test script to be used for running the certification test
##
## Legal Disclaimers:
##
## COPYRIGHT 2001 TLDS, INC.
##
## This program may be distributed only in its entirety unless
## the written permission of the copyright holders has been
## granted.
##
## ALL CONTENT, INCLUDING THE SOFTWARE AND THE API ARE PROVIDED 
## AS-IS.  WE EXPRESSLY DISCLAIM ALL WARRANTIES AND/OR CONDITIONS, 
## EXPRESS OR IMPLIED, INCLUDING, WITHOUT LIMITATION REPRESENTATION 
## WARRANTIES OR TERMS AND CONDITIONS OF MERCHANTABILITY, SATISFACTORY
## QUALITY OR FITNESS FOR A PARTICULAR PURPOSE BUT ONLY TO THE 
## EXTENT PERMITTED BY LAW.
##
##
## Author: MSC
##
## Revision History
## v1.0      4/11/01  -  MSC   Created 
######################################################################

use lib qw ( /usr/local/www/perl-libs ); #change as necessary
use DotSRS_Client;

# create the client object
$srs_client = new DotSRS_Client;

###################################
#
# Test AccountBalance
#
###################################
print "Starting AccountBalance test...\n";

($status, $ref) = $srs_client->account_balance('com');

unless ($status){
    die "AccountBalance test failed (status=$status)\n";
}

unless ( $ref->{'STORED VALUE'} ){
    die "Unexpected result.  No STORED VALUE.\n";
}

foreach $key (keys %{ $ref }) {
    print "\t$key : ", $ref->{$key},"\n";
}

print "PASSED AccountBalance test\n\n";

###################################
#
# Test DomainInfo
#
###################################
print "Starting DomainInfo test...\n";

($ref) = $srs_client->domain_info( 'testdomain', 'com');

unless( $ref ){
    die "Unexpected result.  Undef returned.\n";
}

foreach $key (keys %{ $ref }) {
    print "\t$key : ", $ref->{$key},"\n";
}

print "PASSED DomainInfo test\n\n";

###################################
#
# Test MultiDomainInfo
#
###################################
print "Starting MultiDomainInfo test...\n";

$domain_ref = {	'DOMAIN 1' => 'domain-to-check1',
		'TLD 1'    => 'com',
		'DOMAIN 2' => 'domain-to-check2',
		'TLD 2'    => 'com'
		};

($ref) = $srs_client->multidomain_info($domain_ref);

unless( $ref ){
    die "Unexpected result.  Undef returned.\n";
}

foreach $key (keys %{ $ref }) {
    print "\t$key : ", $ref->{$key},"\n";
}

print "PASSED MultiDomainInfo test\n\n";

###################################
#
# Test MultidomainauthcodeInfo
#
###################################
print "Starting MultiDomainAuthcodeInfo test...\n";

$domain_ref = {	'DOMAIN 1' => 'prakash.narasimha',
		'TLD 1'    => 'name',
		'DOMAIN 2' => 'testingmultiple1',
		'TLD 2'    => 'com'
		};

($ref) = $srs_client->multidomainauthcode_info ($domain_ref);

unless( $ref ){
    die "Unexpected result.  Undef returned.\n";
}

foreach $key (keys %{ $ref }) {
    print "\t$key : ", $ref->{$key},"\n";
}

 print "PASSED MultiDomainAuthcodeInfo test\n\n";


###################################
#
# Test CreateContact
#
###################################
print "Starting CreateContact test...\n";

$contact_ref = {
    'TLD' => 'com',
    'FNAME' => 'John',
    'LNAME' => 'Public',
    'ORGANIZATION' => 'John Q. Public Co.',
    'EMAIL' => 'johnq@public.com',
    'ADDRESS1' => '123 Main St.',
    'ADDRESS2' => 'Suite 100',
    'CITY'  => 'Metropolis',
    'PROVINCE' => 'CA',
    'POSTAL CODE' => '90024',
    'COUNTRY' => 'US',
    'PHONE' => '(310)555-1212'
};

($contact_id, $request_id) = $srs_client->create_contact( 1, $contact_ref );

if ($contact_id) {
    print "\tCONTACTID:  $contact_id\n";
    print "\tREQUESTID:  $request_id\n";
    print "PASSED CreateContact test.\n\n";
}
else{
    print "\tError(s) creating contact:\n";
    print $srs_client->{'error'};
    print "\n";
    print "FAILED CreateContact test.\n\n";
}

###################################
#
# Test GetContact
#
###################################
print "Starting GetContact test...\n";

$ref = $srs_client->get_contact_info( {'CONTACTID' => $contact_id } );
    
unless ($ref){
    die "Unexpected result.  Undef returned.\n";
}

foreach $key (keys %{ $ref }) {
	print "\t$key : ", $ref->{$key},"\n";
}

###################################
#
# Test EditContact
#
###################################
print "Starting EditContact test...\n";

$contact_ref = {	
    'CONTACTID' => $contact_id,
    'EMAIL' => 'jqp@public.com',
    'ADDRESS2' => 'Suite 200',
};

($contact_id, $request_id) = $srs_client->edit_contact( 1, $contact_ref );

if ($contact_id) {
    print "\tCONTACTID:  $contact_id\n";
    print "\tREQUESTID:  $request_id\n";
    print "PASSED EditContact test.\n\n";
}
else{
    print "\tError(s) creating contact:\n";
    print $srs_client->{'error'};
    print "\n";
    print "FAILED EditContact test.\n\n";
}

###################################
#
# Test RegisterDomain
#
###################################
print "Starting RegisterDomain test...\n";

$attempts = 0;
while ( $attempts < 20 ){
    $domain = "testdomain".$attempts;
    ($ref) = $srs_client->domain_info( $domain, 'com');
    unless ($ref){
	die "Unexpected result.  Undef returned.\n";
    }
    #make sure it's available
    if( $ref->{'DOMAIN STATUS'} eq 'FIXED'){
	#get the price
	$price = $ref->{'PRICE'};
	#break out of loop
	last;
    }
    $attempts++;
}

if( $attempts >= 20 ){
    die "FAILED RegisterDomain test (#attempts exceeded)\n\n";
}
#
# at this point $domain, $contact_id and $price are OK
#
$domain_ref = {   
    'DOMAIN' => $domain,
    'TLD'    => 'com',
    'TERM YEARS' => 1,
    'RESPONSIBLE PERSON' => $contact_id,
    'TECHNICAL CONTACT' => 0,
    'PRICE'             => $price
    };

($request_id, $ref) = $srs_client->register_domain( 1, $domain_ref );

if ( !$request_id ){
    print "\tError(s) registering domain:\n";
    print $srs_client->{'error'};
    print "\n";
    print "FAILED RegisterDomain test.\n\n";
}
else{
    print "\tREQUESTID:  $request_id\n";
    
    foreach $key (keys %{ $ref }) {
	print "\t$key : ", $ref->{$key},"\n";
    }
    print "PASSED RegisterDomain\n\n";
}
###################################
#
# Test Whois
#
###################################
print "Starting Whois test...\n";

($ref) = $srs_client->whois( $domain, 'com');

unless( $ref ){
	die "Unexpected result.  Undef returned.\n";
}

foreach $key (keys %{ $ref }) {
	print "\t$key : ", $ref->{$key},"\n";
}

#save the price for the RenewDomain test
$price = $ref->{'PRICE'};
unless( $ref ){
    die "Unexpected result.  No PRICE.\n";
}

print "PASSED Whois test.\n\n";

###################################
#
# Test RenewDomain
#
###################################
print "Starting RenewDomain test...\n";

$domain_ref = { 
    'DOMAIN' => $domain,
    'TLD' => 'com',
    'TERM YEARS' => 2,
    'PRICE' => $price
    };

($request_id,$ref) = $srs_client->renew_domain( 1, $domain_ref );

if ( !$request_id ){
    print "\tError(s) renewing domain:\n";
    print $srs_client->{'error'};
    print "\n";
    print "FAILED RenewDomain test.\n\n";
}
else{
    print "\tREQUESTID:  $request_id\n";
    foreach $key (keys %{ $ref }) {
	    print "\t$key : ", $ref->{$key},"\n";
	    }
    print "PASSED RenewDomain\n\n";
}

###################################
#
# Test RegisterNameServer
#
###################################
print "Starting RegisterNameServer test...\n";

$ns_ref = { 
    'DNS SERVER NAME' => 'ns1.'.$domain.'.com',
    'DNS SERVER IP' => '216.168.229.190' 
};

$request_id = $srs_client->register_nameserver( 1, $ns_ref );

if( $request_id ){
    print "\tREQUESTID:  $request_id\n";
    print "PASSED RegisterNameServer test\n\n";
}
else{
    print "FAILED RegisterNameServer test\n\n";
}

###################################
#
# Test NameServerInfo
#
###################################
print "Starting NameServerInfo test...\n";

$ns_ref = { 'DNS SERVER NAME' => 'ns1.'.$domain.'.com' };

$ref = $srs_client->get_nameserver_info( 1, $ns_ref );

if( $ref ){
    foreach $key (keys %{ $ref }) {
	print "\t$key : ", $ref->{$key},"\n";
    }
}
else{
    die "Unexpected result.  Undef returned.\n";
}

print "PASSED NameServerInfo test.\n\n";

###################################
#
# Test ChangeDomain
#
###################################
print "Starting ChangeDomain test...\n";

$domain_ref = { 
    'DOMAIN' => $domain,
    'TLD' => 'com',
    'DNS SERVER NAME 1' => 'ns1.'.$domain.'.com',
};

$request_id = $srs_client->change_domain( 1, $domain_ref );

if ( !$request_id ){
    print "\tError(s) changing domain:\n";
    print $srs_client->{'error'};
    print "\n";
    print "FAILED ChangeDomain test.\n\n";
}
else{
    print "\tREQUESTID:  $request_id\n";
    print "PASSED ChangeDomain\n\n";
}

#####################################
#
# Change Domain NS to srsplus default,
# to test ReleaseNameServer & ReleaseDomain
#
# ##########################################

print "Change Domain NS to srsplus default...\n";
$domain_ref = { 
    'DOMAIN' => $domain,
    'TLD' => 'com',
    'DNS SERVER NAME 1' => 'ns1-hosts.srsplus.com',
    'DNS SERVER NAME 2' => 'ns2-hosts.srsplus.com',
};
$request_id = $srs_client->change_domain( 1, $domain_ref );

if ( !$request_id ){
    print "\tError(s) changing domain:\n";
    print $srs_client->{'error'};
    print "\n";
    print "FAILED Change Domain NS to srsplus default.\n\n";
}
else{
    print "\tREQUESTID:  $request_id\n";
    print "PASSED Change Domain NS to srsplus default\n\n";
}

###################################
#
# Test ReleaseNameServer
#
###################################
print "Starting ReleaseNameServer test...\n";

$ns_ref = { 'DNS SERVER NAME' => 'ns1.'.$domain.'.com' };

$request_id = $srs_client->release_nameserver( 1, $ns_ref );
if ( !$request_id ){
    print "\tError releasing nameserver.\n";
    print $srs_client->{'error'};
    print "\n";
    print "FAILED ReleaseNameServer test.\n\n";
}
else{
    print "\tREQUESTID:  $request_id\n";
    print "PASSED ReleaseNameServer\n\n";
}

###################################
#
# Test ReleaseDomain
#
###################################
print "Starting ReleaseDomain test...\n";

$domain_ref = { 
    'DOMAIN' => $domain,
    'TLD' => 'com',
};

$request_id = $srs_client->release_domain( 1, $domain_ref );
if ( !$request_id ){
    print "\tError(s) releasing domain:\n";
    print $srs_client->{'error'};
    print "\n";
    print "FAILED ReleaseDomain test.\n\n";
}
else{
    print "\tREQUESTID:  $request_id\n";
    print "PASSED ReleaseDomain\n\n";
}


###################################
#
# Test RequestTransfer
#
###################################
#print "Starting RequestTransfer test...\n";
#
#$transfer_ref = { 
#    'DOMAIN' => 'xfer0000',
#    'TLD'    => 'com',
#    'CURRENT ADMIN EMAIL' => 'fake_person@somedomain.com'
#};
#
#$ref = $srs_client->request_transfer( 1, $transfer_ref );
#
#if( $ref ){
#    foreach $key (keys %{ $ref }) {
#	print "\t$key : ", $ref->{$key},"\n";
#    }
#}
#else{
#    print "RequestTransfer failed: Undef returned.\n";
#}

###################################
#
# Test RequestTransfer
#
###################################
#print "Starting RequestTransfer test...\n";

#$transfer_ref = { 
  # 'TRANSFER ID' =>  '1683709',
 #   'CURRENT ADMIN EMAIL' => 'fake@unknown.com',
#	'AUTH_CODE' => '123456'
#	};
#$ref = $srs_client->resubmit_transfer( 1, $transfer_ref );

#if( $ref ){
#    foreach $key (keys %{ $ref }) {
#	print "\t $key  : ", $ref->{$key},"\n";
#    }
#}
#else{
#    print "ResubmitTransfer failed: Undef returned.\n";
#}

###################################
#
# Test OutboundTransferResponse
#
###################################
#print "Starting OutboundTransferResponse test...\n";
#
#$ref = $srs_client->outbound_transfer_response( 1, 'testdomain', 'com', 'DENY' );
#
#if( $ref ){
#    foreach $key (keys %{ $ref }) {
#	print "\t$key : ", $ref->{$key},"\n";
#    }
#}
#else{
#    print "OutboundTransferResponse failed: Undef returned.\n";
#}

###################################
#
# Test ViewPendingTransfers
#
###################################
#print "Starting ViewPendingTransfers test...\n";
#
#$ref = $srs_client->view_pending_transfers( 1, 'OUTBOUND' );
#
#if( $ref ){
#    foreach $key (keys %{ $ref }) {
#	print "\t$key : ", $ref->{$key},"\n";
#    }
#}
#else{
#    print "ViewPendingTransfers failed: Undef returned.\n";
#}
















