#!/usr/bin/perl
######################################################################
## 
## DotSRS_Client
##
## Client library for dotTV's SRS client implementation
## This will be useful for talking with the registry 
## by outside registrars
##
## NOTE: It is essential that your server's time is set to the 
##       atomic clocks since it is possible that someone might be
##       able to intercept the SSL transmission and replay them
##       Time should not be more than 20 seconds from where 
##       our servers believe it is.
##
## Legal Disclaimers:
##
## COPYRIGHT 2001,2002 TLDS, INC.
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
## Author: SC
##
## Revision History
## v1.0      6/29/00  -  SC   Created 
## v1.17    11/30/01  -  SC   Modification
## v1.18     1/13/02  -  SC   Transfer Fix
## v11.2.100 04/04/07 -  PV Support added for .MOBI
######################################################################
use strict;
use Data::Dumper;

# Load the global perl libraries which we will use to make
# this work
use IO::Handle;
# gnupg interface has some bad code so it needs to be up here
use GnuPG::Interface;

# make us be in a package
package DotSRS_Client;

## Global variables --- CONFIGURATION INFORMATION
my $passphrase = 'your-password';               #set your password here
my $gpg_dir = '/home/username/.gnupg';           #set your GnuPG directory here
my $registrar_email = 'registrar@somedomain.com'; #set your email address here
my $registrar_id = 0;                      #set your registrarID (number) here
my $protocol_version = '1.1';

# in test_mode? (0: not testmode -or- 1: testmode)
my $test_mode = 0;

# my vars
my ($registry_server,$srs_id);

if( $test_mode ){
    $registry_server = "testsrs.srsplus.com";
    $srs_id = '83254FDB';
} else {
    $registry_server = "srs.srsplus.com";
    $srs_id = '415202CC';
}
print $registry_server;
print " USING SRS ID $srs_id\n";
my $fields_7bit_safe = 1;

# global libraries
use HTTP::Request::Common qw(POST);
use LWP::UserAgent;
use HTTP::Status;

######################################################################
##
## new
##
## Definition:
##     new initializes an object and blesses itself as a member of
##     the DotSRS_Client class.  It also takes any variables which it wants
##     passed and puts it into the local object
##
## Args:
##     None
##
## Return:
##     $self - The blessed object refering to this package
##
## Revision History:
## 6/29/00  Created    SC
##
######################################################################
sub new {
    my ($class) = @_;

    my $self = bless {}, $class;

    return $self;
}


########################
## Registrar informative
########################
######################################################################
##
## query_rejected_transfer
##
## Definition:
##     We want to see why an inbound transfer was rejected
##
## Args:
##     $transaction_id - The unique transaction that the user generates
##     $transfer_id    - the rejected transfer's id
##
## Return:
##     $response_ref - { "TRANSFER INFO" => '...',
##                       "TRANSFER STATUS" => '...',
##                       "TRANSFER DATE" => '...',
##                           ...... }
##
## Revision History:
## 12/20/04  Created    AC
##
######################################################################
sub query_rejected_transfer {
    my ($self, $transaction_id, $transfer_id) = @_;

    # prepare the request
    my $action = 'QUERY REJECTED TRANSFER';
    my $message = $self->_sign_client( $self->_build_query( $action, $transaction_id, { "TRANSFERID" => $transfer_id } ) );

    my $response = $self->_send_message( $message );
    
    # return the request_id if we succeeded
    if( $response && $response->{'header'}->{'STATUS'} eq 'SUCCESS' ){
	return( $response->{'body'} );
    }
     
    # we failed
    $self->{'error'} = $response->{'body'}->{'ERROR'} if $response;
    return (undef);
}

######################################################################
##
## query_transfer_id
##
## Definition:
##     We want to see all info on a transfer
##
## Args:
##     $transaction_id - The unique transaction that the user generates
##     $transfer_id    - the rejected transfer's id
##
## Return:
##     $response_ref - { "TRANSFER INFO 1" => '...',
##                       "TRANSFER TYPE 1" => '...',
##                       "TRANSFER DATE 1" => '...',
##                       "TRANSFER STATUS" => '...',
##                           ...... }
##
## Revision History:
## 12/20/04  Created    AC
##
######################################################################
sub query_transfer_id {
    my ($self, $transaction_id, $transfer_id) = @_;

    # prepare the request
    my $action = 'QUERY TRANSFERID';
    my $message = $self->_sign_client( $self->_build_query( $action, $transaction_id, { "TRANSFERID" => $transfer_id } ) );

    my $response = $self->_send_message( $message );
    
    # return the request_id if we succeeded
    if( $response && $response->{'header'}->{'STATUS'} eq 'SUCCESS' ){
	return( $response->{'body'} );
    }
     
    # we failed
    $self->{'error'} = $response->{'body'}->{'ERROR'} if $response;
    return (undef);
}


sub resend_transfer_authorization {
    my ($self, $transaction_id, $transfer_id) = @_;

    # prepare the request
    my $action = 'RESEND TRANSFER AUTHORIZATION';
    my $message = $self->_sign_client( $self->_build_query( $action, $transaction_id, { "TRANSFERID" => $transfer_id } ) );

    my $response = $self->_send_message( $message );
    
    # return the request_id if we succeeded
    if( $response && $response->{'header'}->{'STATUS'} eq 'SUCCESS' ){
	return( $response->{'body'} );
    }
     
    # we failed
    $self->{'error'} = $response->{'body'}->{'ERROR'} if $response;
    return (undef);
}




######################################################################
##
## account_balance
##
## Definition:
##     This query goes out and check the availible account balances on
##     the server and returns the amount to the registrar.
##
## Args:
##     $tld - The top level domain we are querying
##
## Return:
##     $status - Success or failure
##     $balance_ref - a hash that contains the following
##                     BUYING POWER - amount
##                     STORED VALUE - amount
##                     UNPAID CHARGES - amount
##
## Revision History:
## 6/29/00  Created    SC
##
######################################################################
sub account_balance {
    my ($self,$tld) = @_;

    $tld ||= 'com';
    my ($action);
    
    $action = "QUERY ACCOUNT BALANCE";
    
    my $message = $self->_sign_client( $self->_build_query( $action, undef, { 'TLD' => $tld } ) );

    my $response = $self->_send_message( $message );
    if( $response->{'header'}->{'STATUS'} ne 'SUCCESS' ){
	return (0,undef);
    }

    # else we have a something
    return ( 1,$response->{'body'});
}


############################
## Domain informative
############################

######################################################################
##
## domain_info
##
## Definition:
##     This query is against the live database to find the available
##     information about a domain's ability to be sold.  It will either
##     give that it is a fixed price and the price, the auction and the
##     next bid and whether it has started, if the domain is
##     owned, or on reserve it will return unavailable.
##
## Args:
##     $domain - The domain that we want to look at
##     $tld    - the top level domain that we want to look at this
##               registry for.
##     $encoding - Allowed, must be ut8 or nothing
##
## Return:
##     On success it will return the ref to the body of the message
##     I.E. it will have the following fields:
##     DOMAIN STATUS: (AUCTION|FIXED|UNAVAILABLE)
##     PRICE: (The price of either bidding next or buying)
##     EXPECTED END DATE: (Only on auction as to when the auction will end)
##
## Revision History:
## 6/29/00  Created    SC
##
######################################################################
sub domain_info {
    my ($self, $domain, $tld, $encoding) = @_;
    
    my ($action);
    $action = 'GET DOMAIN INFO';

    # make domain and tld lc
    $domain =~ tr/A-Z/a-z/;
    $tld =~ tr/A-Z/a-z/;

    # default the tld if it is not there
    $tld ||= 'com';

    # make sure domain looks like something we want to talk about
    return undef if ( $domain !~ /^[a-zA-Z0-9][a-zA-Z0-9\-]*/ && $domain !~/[a-zA-Z0-9\-]*[a-zA-Z0-9]/ );
    
    # check the tld form
    return undef if $tld !~ /^[a-zA-Z\.]*$/;

    my $message = $self->_sign_client( $self->_build_query( $action, undef,{'DOMAIN' => $domain, 'TLD' => $tld,'ENCODING' => $encoding } ) );

    my $response = $self->_send_message( $message );
    
    if( $response->{'header'}->{'STATUS'} ne 'SUCCESS' ){
	return undef;
    }

    return $response->{'body'};
}



######################################################################
##
## multidomain_info
##
## Definition:
##     This query is against the live database to find the available
##     information about group of domains ability to be sold.  It will either
##     give that it is a fixed price and the price, the auction and the
##     next bid and whether it has started, if the domain is
##     owned, or on reserve it will return unavailable.
##
## Args:
##      $query_ref - { 'DOMAIN 1..n' => 'asd',
##                     'TLD 1..n'    => 'com',
##                     'ENCODING 1..n' => 'ut8'} (optional)
## Return:
##     On success it will return the ref to the body of the message
##     I.E. it will have the following fields:
##     DOMAIN STATUS 1..n: (AUCTION|FIXED|UNAVAILABLE)
##     PRICE 1..n: (The price of either bidding next or buying)
##     EXPECTED END DATE 1..n: (Only on auction as to when the auction will end)
##
## Revision History:
## 6/29/00  Created    SC
##
######################################################################
sub multidomain_info {
    my ($self, $query_ref) = @_;

    my ($action);
    $action = 'GET MULTIDOMAIN INFO';

    my $message = $self->_sign_client( $self->_build_query( $action, undef,$query_ref ) );

    my $response = $self->_send_message( $message );
    
    if( $response->{'header'}->{'STATUS'} ne 'SUCCESS' ){
	return undef;
    }

    return $response->{'body'};
}

######################################################################
##
## multiauthcode_info
##
## Definition:
##     This query is against the Registry to find the authcode 
##     information about group of domains.  
##     
##     
##     
##
## Args:
##      $query_ref - { 'DOMAIN 1..n' => 'asd',
##                     'TLD 1..n'    => 'com',
##                     'ENCODING 1..n' => 'ut8'} (optional)
## Return:
##     On success it will return the ref to the body of the message
##     I.E. it will have the following fields:
##     DOMAIN AUTHCODE 
##     
##     
##
## Revision History:
## 08/05/06  Created    vln
##
######################################################################
sub multidomainauthcode_info {
    my ($self, $query_ref) = @_;

    my ($action);
    $action = 'GET MULTIAUTHCODE INFO';

    my $message = $self->_sign_client( $self->_build_query( $action, undef,$query_ref ) );

    my $response = $self->_send_message( $message );
    
    if( $response->{'header'}->{'STATUS'} ne 'SUCCESS' ){
	return undef;
    }

    return $response->{'body'};
}


######################################################################
##
## get_contact_info
##
## Definition:
##      This is a query against a contact id looking for information
##      on a contact
##
## Args:
##      $query_ref - { 'CONTACTID' => $contact_id ' }
##
## Return: a ref containing the following
##        FNAME: <first name of contact>
##        LNAME: <last name fo contact>
##        ORGANIZATION: < the organization of contact>
##        PHONE: <phone of contact>
##        ADDRESS1: <first line of address of contact
##        ADDRESS2: <second line of address of contact
##        CITY: <city of contact>
##        PROVINCE: <province of contact>
##        POSTAL CODE: <post code of contact>
##        COUNTRY: <country of contact>
##        EMAIL: <email address of contact>
##
##
## Revision History:
## 10/10/00  Created    SC
##
######################################################################
sub get_contact_info {
    my ($self, $query_ref) = @_;
    my $action = 'GET CONTACT INFO';
    
    my $message = $self->_sign_client( $self->_build_query( $action, undef, $query_ref ) );
    
    my $response = $self->_send_message( $message );
    
    if( $response->{'header'}->{'STATUS'} ne 'SUCCESS' ){
	return undef;
    }

    return $response->{'body'};
}

######################################################################
## 
## whois
##
## Definition:
##     This makes a query to the sites live database to get 
##     whois information as to the owner of the domain, who is the
##     various contacts (FNAME, LNAME, ORGANIZATION).  If the registrar 
##     controlls the domain then it sends that more extensive 
##     information including the email address and contacts and the expiration.
##
##
## Args:
##     $domain - The domain that we want to look at
##     $tld    - the top level domain that we want to look at this
##               registry for.
##
## Return:
##
##  NORMAL:
##   TLD
##   FNAME RESPONSIBLE PERSON
##   LNAME RESPONSIBLE PERSON
##   ORGANIZATION RESPONSIBLE PERSON
##   FNAME TECHNICAL CONTACT
##   LNAME TECHNICAL CONTACT
##   REGISTRATION DATE
##   DNS SERVER NAME 1...n
##   DNS SERVER IP 1...n
## 
## EXTENDED:  Everything NORMAL plus
##   ADDRESS1 RESPONSIBLE PERSON
##   ADDRESS2 RESPONSIBLE PERSON
##   CITY RESPONSIBLE PERSON
##   PROVINCE RESPONSABLE PERSON
##   POSTAL CODE RESPONSIBLE PERSON
##   COUNTRY RESPONSIBLE PERSON
##   PHONE RESPONSIBLE PERSON
##   EMAIL RESPONSIBLE PERSON   
##   ADDRESS1 TECHNICAL CONTACT
##   ADDRESS2 TECHNICAL CONTACT
##   CITY TECHNICAL CONTACT
##   PROVINCE RESPONSABLE PERSON
##   POSTAL CODE TECHNICAL CONTACT
##   COUNTRY TECHNICAL CONTACT
##   PHONE TECHNICAL CONTACT
##   EMAIL TECHNICAL CONTACT   
##   AUTOCHARGE
##
## Revision History:
## 6/29/00  Created    SC
##
######################################################################
sub whois {
    my ($self, $domain, $tld) = @_;
    
    my ($action);
    $action = 'WHOIS';

    # make domain and tld lc
    $domain =~ tr/A-Z/a-z/;
    $tld =~ tr/A-Z/a-z/;

    # default the tld if it is not there
    $tld ||= 'com';
    
    # make sure domain looks like something we want to talk about
    return undef if ( $domain !~ /^[a-zA-Z0-9][a-zA-Z0-9\-]*/ && $domain !~ /[a-zA-Z0-9\-]*[a-zA-Z0-9]/ );

    # check the tld form
    return undef if $tld !~ /^[a-zA-Z\.]*$/;

    my $message = $self->_sign_client( $self->_build_query( $action, undef, {'DOMAIN' => $domain, 'TLD' => $tld } ) );

    my $response = $self->_send_message( $message );
    
    if( $response->{'header'}->{'STATUS'} ne 'SUCCESS' ){
	return undef;
    }

    return $response->{'body'};    
}

########################
## Contact Manipulation
########################

######################################################################
##
## create_contact
##
## Definition:
##     This creates a contact handle which the registrar will use to 
##     reference the responsable person and technical contact.  This
##     function works by passing in the contact ref name value pair
##     and passing the results onto the registry.  There are no
##     no difference between Technical and RP contacts.
##
## Args:
##     $transaction_id - The unique transaction that the user generates
##     $contact_ref - The reference to the contact information holding
##                    name value pairs.
## TLD
## FNAME
## LNAME
## ORGANIZATION
## EMAIL
## ADDRESS1
## ADDRESS2
## CITY
## PROVINCE
## COUNTRY
## PHONE
##
## Return:
##     On success it will return the # of the new contact
##     on a failure it will return 0 and the error value will
##     be available in $self->{'error'}.  The second value is the
##     new request_id developed on our server.
##
## Revision History:
## 6/29/00  Created    SC
##
######################################################################
sub create_contact {
    my ($self, $transaction_id, $contact_ref) = @_;

    # the action we want the server to take
    my $action = 'CREATE CONTACT';

    # create the message
    my $message = $self->_sign_client( $self->_build_query( $action, $transaction_id, $contact_ref) );

    # send signed message
    my $response = $self->_send_message( $message );
    
    if( $response->{'header'}->{'STATUS'} ne 'SUCCESS' ){
	my ($key, @error_array);
	foreach $key ( %{ $response->{'body'} } ){
	    if( $key =~ m/^error/i ){
	       push(@error_array, $response->{'body'}->{$key});
	    }
	}
	$self->{'error'} = join( "\t", @error_array );

	return (0,0);
    }
    
    return ($response->{'body'}->{'CONTACTID'} || 0, 
	    $response->{'body'}->{'REQUESTID'} || 0 );
}

######################################################################
##
## edit_contact
##
## Definition:
##     This function is the edit functionality for a contact.  Basically
##     any change except for the FNAME LNAME EMAIL is allowed in this.
##     you put in a partial list and it makes the change on the server 
##     for the tag.  Of course this only allows changes by the controller
##     of the domain (i.e. the registrar).
##
## Args:
##     $transaction_id - The unique transaction that the user generates
##     $contact_ref - The reference to the contact information holding
##                    some of the following name value pairs.
##
## TLD
## CONTACTID
## ORGANIZATION
## ADDRESS1
## ADDRESS2
## CITY
## PROVINCE
## COUNTRY
## PHONE
##
## Return:
##         On success it will return the contactid it modified in the first
##         slot.  On failure 0 will be returned as well as the error value
##         being availible.  The second string will be the request_id
##         that has been generated by the system.
##
## Revision History:
## 6/29/00  Created    SC
##
######################################################################
sub edit_contact {
    my ($self, $transaction_id, $contact_ref) = @_;

    my $action = 'EDIT CONTACT';
    my $message = $self->_sign_client( $self->_build_query( $action, $transaction_id, $contact_ref) );
    
    my $response = $self->_send_message( $message );
    
    if( $response->{'header'}->{'STATUS'} ne 'SUCCESS' ){
	my ($key, @error_array);
	foreach $key ( %{ $response->{'body'} } ){
	    if( $key =~ m/^error/i ){
	       push(@error_array, $response->{'body'}->{$key});
	    }
	}
	$self->{'error'} = join( "\t", @error_array );
	
	return (0,0);
    }
    
    return ($response->{'body'}->{'CONTACTID'} || 0, 
	    $response->{'body'}->{'REQUESTID'} || 0 );
}

################################
## DOMAIN MANIPULATION
################################
######################################################################
##
## register_domain
##
## Definition:
##     This allows a registry to register a domain (assuming they have
##     enough credit left on their account.
##
## Args:
##     $transaction_id - The unique transaction that the user generates
##     $domain_info_ref: 
##         DOMAIN  - The domain that we want to look at
##         TLD    - the top level domain that we want to look at this
##               registry for.
##         TERM YEARS         - only 1 & 2 are supported at this time
##         RESPONSIBLE PERSON - The responsible person contactid
##         TECHNICAL CONTACT  - The technical person contactid (if it is the registry
##                      leave as 0
##
##         DNS TYPE - PARKED, YOUSERVE, WESERVE
##       PARKED - no options
##       YOUSERVE:
##         DNS SERVER NAME 1..n
##       WESERVE:
##         DNS RECORD TYPE 1..n     A MX CNAME
##         DNS RECORD LEFT 1..n
##         DNS RECORD RIGHT 1..n
##         DNS RECORD PRIORITY 1..n        for MX records
##
##         PRICE              - The price the registrar expects to pay
##
## Note:if you don't pass a DNS TYPE but do pass other records
##      it will default in orderYOUSERVE, WESERVE, PARKED
##
## Return:
##     $request_id - The request ID returned by the server
##     On success it will return the ref to the body of the message
##     I.E. it will have the following fields:
##     PRICE: (The price of either bidding next or buying)
##     EXPIRATION DATE
##
## Revision History:
## 6/29/00  Created    SC
##
######################################################################
sub register_domain {
    my ($self, $transaction_id, $domain_ref)  = @_;

    my $action = 'REGISTER DOMAIN';
    my $message = $self->_sign_client( $self->_build_query( $action, $transaction_id, $domain_ref) );
    
    my $response = $self->_send_message( $message );
    
    if( $response->{'header'}->{'STATUS'} ne 'SUCCESS' ){
	my ($key, @error_array);
	foreach $key ( %{ $response->{'body'} } ){
	    if( $key =~ m/^error/i ){
	       push(@error_array, $response->{'body'}->{$key});
	    }
	}
	$self->{'error'} = join( "\t", @error_array );
	
	return (0,undef);
    }
    
    return ( $response->{'body'}->{'REQUESTID'} || 0,
	     $response->{'body'}
	     );
}

######################################################################
##
## change_domain
##
## Definition:
##     This allows a registry to change a domain
##
## Args:
##     $transaction_id - The unique transaction that the user generates
##     $domain_info_ref: 
##         DOMAIN             - The domain name
##         TLD                - the TLD its in
##         RESPONSIBLE PERSON - The responsible person contactid
##         TECHNICAL CONTACT  - The technical person contactid (if it is the registry
##                      leave as 0
##
##         DNS TYPE - PARKED, YOUSERVE, WESERVE
##       PARKED - no options
##       YOUSERVE:
##         DNS SERVER NAME 1..n
##       WESERVE:
##         DNS RECORD TYPE 1..n     A MX CNAME
##         DNS RECORD LEFT 1..n
##         DNS RECORD RIGHT 1..n
##         DNS RECORD PRIORITY 1..n        for MX records
##
##         AUTOCHARGE - 1 or 0 whether autocharge was on or off
##         DOMAIN PROTECT - 1 or 0 whether we want domain protect or not
##
## Note:if you don't pass a DNS TYPE but do pass other records a
##      it will complete if they are of the same type.  Otherwise a
##      NOTE will occur stating that this requires a DNS TYPE
##
## Return:
##     $request_id - The request ID returned by the server if failure 0
##
## Revision History:
## 6/29/00  Created    SC
##
######################################################################
sub change_domain {
    my ($self, $transaction_id, $domain_info_ref) = @_;

    my $action = 'ALTER DOMAIN';
    my $message = $self->_sign_client( $self->_build_query( $action, $transaction_id, $domain_info_ref) );
    
    my $response = $self->_send_message( $message );
    
    if( $response->{'header'}->{'STATUS'} ne 'SUCCESS' ){
	my ($key, @error_array);
	foreach $key ( %{ $response->{'body'} } ){
	    if( $key =~ m/^error/i ){
	       push(@error_array, $response->{'body'}->{$key});
	    }
	}
	$self->{'error'} = join( "\t", @error_array );
	
	return (0);
    }
    
    return ( $response->{'body'}->{'REQUESTID'} || 0);
}

######################################################################
##
## renew_domain
##
## Definition:
##     This allows a registry to renew a domain
##
## Args:
##     $transaction_id - The unique transaction that the user generates
##     $domain_info_ref: 
##         DOMAIN             - The domain name
##         TLD                - the TLD its in
##         TERM YEARS         - only 1 & 2 are supported at this time
##
## Return:
##     $request_id - The request ID returned by the server if failure 0
##     On success it returns a ref of the body of the message
##     including 
##        EXPIRATION DATE
##        PRICE
##
## Revision History:
## 6/29/00  Created    SC
##
######################################################################
sub renew_domain {
    my ($self, $transaction_id, $domain_info_ref) = @_;
    
    my $action = 'RENEW DOMAIN';

    my $message = $self->_sign_client( $self->_build_query( $action, $transaction_id, $domain_info_ref) );
    
    my $response = $self->_send_message( $message );
    
    if( $response->{'header'}->{'STATUS'} ne 'SUCCESS' ){
	my ($key, @error_array);
	foreach $key ( %{ $response->{'body'} } ){
	    if( $key =~ m/^error/i ){
	       push(@error_array, $response->{'body'}->{$key});
	    }
	}
	$self->{'error'} = join( "\t", @error_array );

	return (0,undef);
    }
    
    return ( $response->{'body'}->{'REQUESTID'} || 0,
	     $response->{'body'});
}

######################################################################
##
## release_domain
##
## Definition:
##     This allows a registry to release a domain
##
## Args:
##     $transaction_id - The unique transaction that the user generates
##     $domain_info_ref: 
##         DOMAIN             - The domain name
##         TLD                - the TLD its in
##
## Return:
##     $request_id - The request ID returned by the server if failure 0
##
## Revision History:
## 6/29/00  Created    SC
##
######################################################################
sub release_domain {
    my ($self, $transaction_id, $domain_ref) = @_;

    my $action = 'RELEASE DOMAIN';
    my $message = $self->_sign_client( $self->_build_query( $action, $transaction_id, $domain_ref) );
    
    my $response = $self->_send_message( $message );
    
    if( $response->{'header'}->{'STATUS'} ne 'SUCCESS' ){
	my ($key, @error_array);
	foreach $key ( %{ $response->{'body'} } ){
	    if( $key =~ m/^error/i ){
	       push(@error_array, $response->{'body'}->{$key});
	    }
	}
	$self->{'error'} = join( "\t", @error_array );	

	return (0);
    }
    
    return ( $response->{'body'}->{'REQUESTID'} || 0 );
}

################################
## NAMESERVER MANIPULATION
################################
######################################################################
##
## register_nameserver
##
## Definition:
##     This allows a registrar to register nameservers for its users
##     in the .com domain
##
## Args:
##     $transaction_id - The unique transaction that the user generates
##     $nameserver_info_ref: 
##	DNS SERVER NAME: <Full name server name>
##	DNS SERVER IP: <NAME SERVER IP>
##
## Return:
##     $request_id - The request ID returned by the server if failure 0
##
## Revision History:
## 6/29/00  Created    SC
##
######################################################################
sub register_nameserver {
    my ($self, $transaction_id, $nameserver_ref) = @_;

    my $action = 'REGISTER NAMESERVER';
    my $message = $self->_sign_client( $self->_build_query( $action, $transaction_id, $nameserver_ref) );
    
    my $response = $self->_send_message( $message );
    
    if( $response->{'header'}->{'STATUS'} ne 'SUCCESS' ){
	my ($key, @error_array);
	foreach $key ( %{ $response->{'body'} } ){
	    if( $key =~ m/^error/i ){
	       push(@error_array, $response->{'body'}->{$key});
	    }
	}
	$self->{'error'} = join( "\t", @error_array );

	return (0);
    }
    
    return ( $response->{'body'}->{'REQUESTID'} || 0 );
}

######################################################################
##
## modify_nameserver
##
## Definition:
##     This allows modification of existing glue records
##
## Args:
##     $transaction_id - The unique transaction that the user generates
##     $nameserver_info_ref: 
##	DNS SERVER NAME: <Full name server name>
##	DNS SERVER IP: <NAME SERVER IP>
##
## Return:
##     $request_id - The request ID returned by the server if failure 0
##
## Revision History:
## 10/04/04  Created    SC
##
######################################################################
sub modify_nameserver {
    my ($self, $transaction_id, $nameserver_ref) = @_;

    my $action = 'MODIFY NAMESERVER';
    my $message = $self->_sign_client( $self->_build_query( $action, $transaction_id, $nameserver_ref) );
    
    my $response = $self->_send_message( $message );
    
    if( $response->{'header'}->{'STATUS'} ne 'SUCCESS' ){
	my ($key, @error_array);
	foreach $key ( %{ $response->{'body'} } ){
	    if( $key =~ m/^error/i ){
	       push(@error_array, $response->{'body'}->{$key});
	    }
	}
	$self->{'error'} = join( "\t", @error_array );

	return (0);
    }
    
    return ( $response->{'body'}->{'REQUESTID'} || 0 );
}

######################################################################
##
## release_nameserver
##
## Definition:
##     This releases a registered nameserver
##
## Args:
##     $transaction_id - The unique transaction that the user generates
##     $nameserver_info_ref: 
##         DNS SERVER NAME: <Full name server name>
##
## Return:
##     $request_id - The request ID returned by the server if failure 0
##
## Revision History:
## 6/29/00  Created    SC
##
######################################################################
sub release_nameserver {
    my ($self, $transaction_id, $nameserver_ref) = @_;

    my $action = 'RELEASE NAMESERVER';
    my $message = $self->_sign_client( $self->_build_query( $action, $transaction_id, $nameserver_ref) );
    
    my $response = $self->_send_message( $message );
    
    if( $response->{'header'}->{'STATUS'} ne 'SUCCESS' ){
	my ($key, @error_array);
	foreach $key ( %{ $response->{'body'} } ){
	    if( $key =~ m/^error/i ){
	       push(@error_array, $response->{'body'}->{$key});
	    }
	}
	$self->{'error'} = join( "\t", @error_array );

	return (0);
    }
    
    return ( $response->{'body'}->{'REQUESTID'} || 0 );
}

######################################################################
##
## get_nameserver_info
##
## Definition:
##     get some information on the nameserver
##
## Args:
##     $transaction_id - The unique transaction that the user generates
##     $nameserver_info_ref: 
##          DNS SERVER NAME: <Full name server name>
##
## Return:
##     $nameserver_info_hash - Hash of nameserver information
##
## Revision History:
## 6/29/00  Created    SC
##
######################################################################
sub get_nameserver_info {
    my ($self, $transaction_id, $nameserver_ref) = @_;

    my $action = 'GET NAMESERVER INFO';
    my $message = $self->_sign_client( $self->_build_query( $action, $transaction_id, $nameserver_ref) );
    
    my $response = $self->_send_message( $message );
    
    if( $response->{'header'}->{'STATUS'} ne 'SUCCESS' ){
	my ($key, @error_array);
	foreach $key ( %{ $response->{'body'} } ){
	    if( $key =~ m/^error/i ){
	       push(@error_array, $response->{'body'}->{$key});
	    }
	}
	$self->{'error'} = join( "\t", @error_array );

	return (0);
    }

    return $response->{'body'};    
}

######################################################################
##
## request_transfer
##
## Definition:
##     Here we want to request a transfer from another registrar to
##     our registrar in the name of our SRS registrar
##
## Args:
##     $transaction_id - The unique transaction that the user generates
##     $req_hash - 
##     {
##        DOMAIN - domain name of requested domain
##        TLD - The tld of the domain
##        CURRENT ADMIN EMAIL - The admin email we require
##        RESPONSIBLE PERSON - optional RESPONSIBLE PERSON ID
##        TECHNICAL CONTACT - optional TECHNICAL CONTACT ID
##        ADMIN CONTACT    - optional ADMIN CONTACT ID
##        BILLING CONTACT  - optinal BILLING CONTACT ID
##     }
##
## Return:
##     $request_id - The request tracking number
##
## Revision History:
## 8/1/01  Created    SC
##
######################################################################
sub request_transfer {
    my ($self, $transaction_id, $req_hash) = @_;

    my $action = 'REQUEST TRANSFER';
    my $message = $self->_sign_client( $self->_build_query( $action, $transaction_id, $req_hash ) );

    my $response = $self->_send_message( $message );

    # return the request_id if we succeeded
    if( $response && $response->{'header'}->{'STATUS'} eq 'SUCCESS' ){
	return( $response->{'body'}->{'REQUESTID'} );
    }
     
    # we failed
    $self->{'error'} = $response->{'body'}->{'ERROR'} if $response;
    return (undef);
}
#Added as part of Re-submitting a transfer.
######################################################################
##
## resubmit_transfer
##
## Definition:
##     Here we want to request a transfer from another registrar to
##     our registrar in the name of our SRS registrar
##
## Args:
##     $transaction_id - The unique transaction that the user generates
##     $req_hash - 
##     {
##        TRANSFER ID - transferid of transfer to be re-submitted.
##        CURRENT ADMIN EMAIL - optional The admin email we require
##        RESPONSIBLE PERSON - optional RESPONSIBLE PERSON ID
##        TECHNICAL CONTACT - optional TECHNICAL CONTACT ID
##        ADMIN CONTACT    - optional ADMIN CONTACT ID
##        BILLING CONTACT  - optinal BILLING CONTACT ID
##     }
##
## Return:
##     $request_id - The request tracking number
##
## Revision History:
## 8/1/01  Created    SC
##
######################################################################
sub resubmit_transfer {
    my ($self, $transaction_id, $req_hash) = @_;

    my $action = 'RESUBMIT TRANSFER';
    my $message = $self->_sign_client( $self->_build_query( $action, $transaction_id, $req_hash ) );

    my $response = $self->_send_message( $message );

    # return the request_id if we succeeded
    if( $response && $response->{'header'}->{'STATUS'} eq 'SUCCESS' ){
	return( $response->{'body'} );
    }
     
    # we failed
    $self->{'error'} = $response->{'body'}->{'ERROR'} if $response;
    return (undef);
}

######################################################################
##
## outbound_transfer_response
##
## Definition:
##     Here we want to respond to someother registrar transfering
##     a domain from us.  It may either be accept or deny.
##
## Args:
##     $transaction_id - The unique transaction that the user generates
##     $domain - domain name of requested domain
##     $tld - The tld of the domain
##     $response_string - string for of 'ACCEPT' or 'DENY'
##
## Return:
##     $request_id - The request tracking number
##
## Revision History:
## 8/1/01  Created    SC
##
######################################################################
sub outbound_transfer_response {
    my ($self, $transaction_id, $domain, $tld, $response_string) = @_;

    # prepare the request
    my $action = 'OUTBOUND TRANSFER RESPONSE';
    my $message = $self->_sign_client( $self->_build_query( $action, $transaction_id, { 'DOMAIN' => $domain||'', 'TLD' => $tld, 'TRANSFER RESPONSE' => $response_string } ) );

    my $response = $self->_send_message( $message );
    
    # return the request_id if we succeeded
    if( $response && $response->{'header'}->{'STATUS'} eq 'SUCCESS' ){
	return( $response->{'body'}->{'REQUESTID'} );
    }
     
    # we failed
    $self->{'error'} = $response->{'body'}->{'ERROR'} if $response;
    return (undef);
}

######################################################################
##
## view_pending_transfers
##
## Definition:
##     We want to see what transfers involving us are pending
##
## Args:
##     $transaction_id - The unique transaction that the user generates
##     $transfer_type - "INBOUND" or "OUTBOUND"
##
## Return:
##     $response_ref - { "DOMAIN 1" => '...',
##                       "TLD 1" => '...',
##                       "DATE LOGGED 1" => '...',
##                           ...... }
##
## Revision History:
## 8/1/01  Created    SC
##
######################################################################
sub view_pending_transfers {
    my ($self, $transaction_id, $transfer_type) = @_;

    # prepare the request
    my $action = 'VIEW PENDING TRANSFERS';
    my $message = $self->_sign_client( $self->_build_query( $action, $transaction_id, { "TRANSFER TYPE" => $transfer_type } ) );

    my $response = $self->_send_message( $message );
    
    # return the request_id if we succeeded
    if( $response && $response->{'header'}->{'STATUS'} eq 'SUCCESS' ){
	return( $response->{'body'} );
    }
     
    # we failed
    $self->{'error'} = $response->{'body'}->{'ERROR'} if $response;
    return (undef);
}

######################################################################
##
## buy_vas
##
## Definition:
##     We would like to buy a VAS
##
## Args:
##     $vas_action_ref
##               { "DOMAIN" => '...',
##                 "TLD"    => '...',
##                 "VAS TYPE"   => (PRIVATE REG)
##                 "TERM"   => (years|-1 for till domain expires)
##               }
##
## Return:
##     $vas_id - Reference id for VAS
##
## Revision History:
## 11/12/04  Created    SC
##
######################################################################
sub buy_vas {
    my ($self, $transaction_id, $vas_action_ref) = @_;

    $vas_action_ref->{'VAS ACTION'} = 'BUY';
    my $response = $self->_manipulate_vas( $transaction_id, $vas_action_ref );

    if( !defined( $response ) || $response->{'VAS ID'} == 0){
	return undef;
    }

    return ($response->{'VAS ID'}, $response);
}

######################################################################
##
## query_vas
##
## Definition:
##     We want to know what VAS is on a domain
##
## Args:
##     $vas_action_ref
##               { "DOMAIN" => '...',
##                 "TLD"    => '...'
##               }
##
## Return:
##               { 'VAS ID 1' => vas_id
##                 'VAS TYPE 1' => vas type,
##                 'VAS DATE CREATED 1' => creation of vas
##                 'VAS EXPIRATION DATE 1' => expiration date
##                 'VAS OTHER DATA 1' => other relevant data
##                 ...
##               } 
##
## Revision History:
## 11/12/04  Created    SC
##
######################################################################
sub query_vas {
    my ($self, $transaction_id, $vas_action_ref) = @_;
    $vas_action_ref->{'VAS ACTION'} = 'QUERY';
    return $self->_manipulate_vas( $transaction_id, $vas_action_ref );
}

######################################################################
##
## renew_vas
##
## Definition:
##     We want to renew a domain's VAS
##
## Args:
##     $vas_action_ref
##               { "DOMAIN" => '...',
##                 "TLD"    => '...',
##                 "VAS ID" => '...',
##                 "TERM"   => '...'
##               }
##
## Return:
##     $request_id
##
## Revision History:
## 11/12/04  Created    SC
##
######################################################################
sub renew_vas {
    my ($self, $transaction_id, $vas_action_ref) = @_;
    $vas_action_ref->{'VAS ACTION'} = 'RENEW';
    my $response = $self->_manipulate_vas( $transaction_id, $vas_action_ref );

    if( defined( $response ) && $response->{'REQUESTID'} != 0 ){
	return ($response->{'REQUESTID'}, $response);
    }

    return undef;
}

######################################################################
##
## modify_vas
##
## Definition:
##     We want to modify a VAS, note that this is VAS specific and 
##     at this time the there is no options for private registraion
##
## Args:
##     $vas_action_ref
##               { "DOMAIN" => '...',
##                 "TLD"    => '...',
##                 "MODIFY OPTIONS" => ....
##               }
##
## Return:
##     $response
##
## Revision History:
## 11/12/04  Created    SC
##
######################################################################
sub modify_vas {
    my ($self, $transaction_id, $vas_action_ref) = @_;
    $vas_action_ref->{'VAS ACTION'} = 'MODIFY';
    return $self->_manipulate_vas( $transaction_id, $vas_action_ref );
}

######################################################################
##
## cancel_vas
##
## Definition:
##     We want to cancel a domain's VAS
##
## Args:
##     $vas_action_ref
##               { "DOMAIN" => '...',
##                 "TLD"    => '...',
##                 "VAS ID" => '...',
##               }
##
## Return:
##     $request_id
##
## Revision History:
## 11/12/04  Created    SC
##
######################################################################
sub cancel_vas {
    my ($self, $transaction_id, $vas_action_ref) = @_;
    $vas_action_ref->{'VAS ACTION'} = 'CANCEL';

    my $response = $self->_manipulate_vas( $transaction_id, $vas_action_ref );

    if( defined( $response ) && $response->{'REQUESTID'} != 0 ){
	return ($response->{'REQUESTID'}, $response);
    }

    return $response;
}

######################################################################
##
## _manipulate_vas
##
## Definition:
##     We want to manipulate the VAS associated with a domain
##     the actions are:
##       BUY   - Buy a VAS
##       QUERY - Query a domain to get the associated VAS and VAS_ID
##       NEW - renew a VAS you can renew past the expiration of domain
##       MODIFY - Change options for VAS
##       CANCEL - Cancel a VAS 
##
## Args:
##     $vas_action_ref
##               { "DOMAIN" => '...',
##                 "TLD"    => '...',
##                 "VAS ACTION" => (BUY|QUERY|RENEW|MODIFY|CANCEL)
##                 "VAS ID"     => the VAS ID for RENEW MODIFY CANCEL commands
##                 "VAS TYPE"   => (PRIVATE REG)
##                 "TERM"   => (years|-1 for till domain expires)
##               }
##
## Return:
##     $response_ref - { "DOMAIN 1" => '...',
##                       "TLD 1" => '...',
##                       "DATE LOGGED 1" => '...',
##                           ...... }
##
## Revision History:
## 11/12/04  Created    SC
##
######################################################################
sub _manipulate_vas {
    my ($self, $transaction_id, $vas_action_ref) = @_;

    # prepare the request
    my ($action) = 'MANIPULATE VAS';
    
    my $message = $self->_sign_client( $self->_build_query( $action, $transaction_id, $vas_action_ref ) );

    my $response = $self->_send_message( $message );

    if( $response && $response->{'header'}->{'STATUS'} eq 'SUCCESS' ){
	return( $response->{'body'} );
    }

    # we failed
    $self->{'error'} = $response->{'body'}->{'ERROR'} if $response;
    return (undef);
}

######################################################################
######################################################################
##  Here be internal helper functions
######################################################################
######################################################################

######################################################################
##
## _send_message
##
## Definition:
##     This takes a message and makes it suitable to send to the 
##     server. It then gets back the responses and parses them
##     until it returns it the the higher level functions.  This
##     function  also runs the verifier that will be needed
##     to make sure the response is from the SRS server and not
##     some sham.
##
## Args:
##     $message - Here is the signed message that we want to pass to 
##                the server
##
## Return:
##     $ref - A reference to the header and the body of the
##            server message
##
## Revision History:
## 6/29/00  Created    SC
##
######################################################################
sub _send_message {
    my ($self, $message) = @_;

    my ($encoded_mes, $ua, $req, $ret_string, $rc, $response, $ref);
    # we need to send this in total
    $encoded_mes = unpack("H*", $message);
    # create new user agent
    $ua = new LWP::UserAgent;

    $req = POST 'https://'.$registry_server.'/cgi-bin/registry.cgi',
	[  'PAYLOAD' => $encoded_mes ];

    # we want to make sure we get some useful debugging information
    $rc = $ua->request( $req );
    
    return undef if $self->_server_response_error( $rc );
    $ret_string = $rc->content;

    my ($status, $payload) = $self->_verify_srs( $ret_string );
    if( ! $status ){
	warn "Warning: no status!\n";
	return undef;
    }

    my ( $ref_head, $ref_body ) = $self->_parse_response($payload);

    $ref->{'header'} = $ref_head;
    $ref->{'body'} = $ref_body;

    if($ref_head->{'STATUS'} ne 'SUCCESS'){
	$self->{'error'} ||= $ref_head->{'ERROR DESCRIPTION'};
    }

    return $ref;
}

######################################################################
##
## _parse_response
##
## Definition:
##     This function takes the payload of the message and parses it
##     into the header fields and the body fields.  It will also 
##     if it is eight bit clean decode them from HEX
##
## Args:
##     $payload - Here is the payload from the server after it has
##                been decrypted
##
## Return:
##     $ref_head -  A reference to the head of the message
##     $ref_body -  A reference to the body of the message
##
## Revision History:
## 6/29/00  Created    SC
##
######################################################################
sub _parse_response {
    my ($self, $payload) = @_;

    my ($line,$test,$ref_head,$ref_body);
    
    foreach $line ( split(/\n/, $payload) ){

	# trim it
	$line =~ s/\s+$//;
	$line =~ s/^\s+//;
	next if $line eq ''; 
	
	if( !$test ){
	    if( $line =~ /^-----END HEADER-----$/i ){
		$test = 1;
		next;
	    }
	    my ($key, $val) = split(/\s*:\s*/, $line,2 );
	    
	    if( $key ne '' && $val ne '' ){
		$ref_head->{$key} = $val;
	    }
	} else {
	    my ($key, $val) = split(/\s*:\s*/, $line,2 );
	    
	    if( $key ne '' && $val ne '' ){
		if( $ref_head->{'SAFE CONTENTS'} ){
		    $ref_body->{$key} = $val;
		} else {
		    $ref_body->{$key} = pack("H*",$val);
		}
	    }
	}
    }

    if( $ref_head->{'STATUS'} eq '' || $ref_head->{'PROTOCOL VERSION'} eq '' ){
	# we did not get a properly formed query so bomb
	$self->{'error'} = "Did not get properly formatted request from server";
	return (undef,undef);
    }
    return ($ref_head, $ref_body);
}

######################################################################
##
## _server_response_error
##
## Definition:
##     An error function to determin if there was an error in the server
##     if there is log it
##
## Args:
##     $card_id  - the card we want to charge
##     $auth_id  - the id that we authed on
##
## Return:
##     auth_id - the authization code
##
## Revision History:
## 5/19/00  Created    SC
##
######################################################################
sub _server_response_error {
    my ($self, $rc) = @_;

    # check to make sure it is an error and if it is log it and get out
    if( &is_error( $rc ) ){
        # we have errored
        $self->{'error'} = "Got an invalid method from server";
        return 1;
    }

    # there was no error
    return 0;
}

######################################################################
##
## _build_query
##
## Definition:
##     Here we want to build the query from its components
##
## Args:
##     $action   - The action that we want to take
##     $transaction_id - What transaction the user is talking about
##     $request_ref    - The information about the request
##
## Return:
##     $message - The complete message that we will want to 
##                sign and pass to the server
##
## Revision History:
## 6/29/00  Created    SC
##
######################################################################
sub _build_query {
    my ($self, $action, $transaction_id, $request_ref) = @_;

    my (@query,$key);
    push( @query, "REGISTRAR: $registrar_id");
    push( @query, "REGISTRAR EMAIL: $registrar_email" );
    push( @query, "PROTOCOL VERSION: $protocol_version");  
    push( @query, "TIME: $^T");
    push( @query, "ACTION: $action" );
    push( @query, "TRANSACTION ID: $transaction_id" );
    push( @query, "PLATFORM: perl $]");

    # if this is not set we need to hexify the value part of the body
    push( @query, "SAFE CONTENTS: $fields_7bit_safe") ;
    push( @query, "-----END HEADER-----\n" );
    
    foreach $key ( keys %{ $request_ref } ){
	if( $fields_7bit_safe ){
	    push( @query, sprintf("%s: %s", $key, $request_ref->{$key}) );
	} else {
	    push( @query, sprintf("%s: %s", $key, unpack("H*", $request_ref->{$key}) ) );
	}
    }

    return join("\n", @query);
}

######################################################################
##
## _verify_srs
##
## Definition:
##     Here we want to verify the message the the registry
##     has send to us
##
## Args:
##     $response - The response from the server
##
## Return:
##     $message - The unshelled message that we have verified
##
## Revision History:
## 6/29/00  Created    SC
##
######################################################################
sub _verify_srs {
    my ($self, $response) = @_;

    # local my variables
    my ($gnupg, $input, $output, $error, $handles, @response,
	$check, $id);

    # setup the gnupg
    $gnupg = GnuPG::Interface->new();
    $gnupg->options->hash_init( armor   => 1,
				homedir => $gpg_dir,
				extra_args => '--no-secmem-warning'
			      );

    $gnupg->options->meta_interactive( 0 );

    # how we create some handles to interact with gnupg
    $input   = IO::Handle->new();
    $output  = IO::Handle->new();
    $error   = IO::Handle->new();
  
    $handles = GnuPG::Handles->new( stdin  => $input,
				    stdout => $output,
				    stderr => $error
				  );
    
    # this sets up the communication
    $gnupg->decrypt( handles => $handles );

    # send in the clones
    print $input $response;
    close $input;
    
    my (@signed_message) = <$output>;
    @response = <$error>;
    close $output;
    close $error;

    # make sure that all buffers are flushed
    wait;
   
    # make sure we have a good signature and that it is from the srs
    foreach ( @response ){
	if( $_ =~ /^gpg: Good signature from/ ){
	    $check = 1;
	}
	if($_ =~ /key ID (.{8})$/i ){
	    $id = $1;
	}
    }
    
    return ($check,join("",@signed_message) ) ;
    # return 1 if it is the srs, undef for bad or mistaken signatures
    return ($check,join("",@signed_message) ) if $id eq $srs_id;
    return (undef, undef);
}

######################################################################
##
## _sign_client
##
## Definition:
##     Here we sign the client message that we want to send to the
##     server for authentication that the registrar is who they 
##     say
##
## Args:
##     $message - The message we want to sign
##
## Return:
##     $signed_message - The signed message
##
## Revision History:
## 6/29/00  Created    SC
##
######################################################################
sub _sign_client {
    my ($self, $message) = @_;

    # local my variables
    my ($gnupg, $input, $output, $handles, @signed);
    
    # setup the GnuPG
    $gnupg = GnuPG::Interface->new();

    $gnupg->options->hash_init( armor   => 1,
				default_key => $registrar_email,
				homedir => $gpg_dir,
				extra_args => '--no-secmem-warning'
			      );
    $gnupg->options->meta_interactive( 0 );
    
    # how we create some handles to interact with GnuPG
    $input   = IO::Handle->new();
    $output  = IO::Handle->new();
    $handles = GnuPG::Handles->new( stdin  => $input,
				    stdout => $output );
  
    # set the passphrase
    $gnupg->passphrase( $passphrase );

    # set the handle
    $gnupg->clearsign( handles => $handles );

    # drop the message
    print $input $message;
    
    # close the filehandle
    close $input;
    
    @signed = <$output>;
    close $output;

    # we want to make sure all buffers are flushed
    wait;

    return join( '', @signed );
}

1;
