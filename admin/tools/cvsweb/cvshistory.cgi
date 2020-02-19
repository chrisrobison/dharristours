#!/usr/local/bin/python

# CVSHistory -- A cvsweb/viewcvs-integrating CVS history 
# browsing script/web frontend/thingie.

# Jamie Turner <jamwt@jamwt.com>

##### USER EDITABLE SECTION #####
CONFIGFILE = "/www/admin.interactivate.com/htdocs/tools/cvsweb/cvshistory.conf"
# END OF USER EDITABLE SECTION!


##### LICENSE #####

# Modified BSD
# ------------
# 
# All of the documentation and software included in this software 
# is copyrighted by Jamie Turner <jamwt@jamwt.com>
# 
# Copyright 2004 Jamie Turner.  All rights reserved.
# 
# Redistribution and use in source and binary forms, with or without
# modification, are permitted provided that the following conditions
# are met:
# 1. Redistributions of source code must retain the above copyright
#    notice, this list of conditions and the following disclaimer.
# 2. Redistributions in binary form must reproduce the above copyright
#    notice, this list of conditions and the following disclaimer in the
#    documentation and/or other materials provided with the distribution.
# 3. The name of the author may not be used to endorse or promote products 
#    derived from this software without specific prior written permission.
# 
# THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR 
# IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES 
# OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.  
# IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, 
# SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED 
# TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR 
# PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF 
# LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING 
# NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,
# EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

# ViewCVS Look & feel modeled after the ViewCVS project
# viewcvs.sourceforge.net

# CVSweb Look & feel modeled after the FreeBSD CVSweb project
# www.freebsd.org/projects/cvsweb.html

##### CODE #####

# Integration mode constants.
INT_NONE    = 0 # don't edit
INT_VIEWCVS = 1 # don't edit
INT_CVSWEB  = 2 # don't edit

# Predefined time formats.
USTIME      = "%m-%d-%Y %H:%M"
WORLDTIME   = "%d-%m-%Y %H:%M"

# Performance mode constants.
MODE_FAST   = 1
MODE_SLOW   = 2

# Load configuration.

execfile(CONFIGFILE)

# let's handle the options above
# first, formatting

# we default to ViewCVS layout, with no integration.  it's prettier!
if INTEGRATION == INT_NONE or INTEGRATION == INT_VIEWCVS:
	_SORTEDCOL = "88ff88"
	_REGCOL = "cccccc"
	_ROWS = ["ffffff","ccccee"]
	_TABLETOP = '<table width="100%%" border=0 cellspacing=1 cellpadding=2>'

else:
	_SORTEDCOL = "ffcc66"
	_REGCOL = "ffffcc"
	_ROWS = ["ffffff","ffffff"]
	_TABLETOP = '<table style="border-width: 0; background-color: #cccccc" width="100%" cellspacing="1" cellpadding="2">'

	_SCRIPT = SCRIPTPATH

	_LOGO = "&nbsp;"
	_ICON = '<img src="/icons/dir.gif" alt="[DIR]" border="0" width="20" height="22">'

if INTEGRATION == INT_VIEWCVS:

	_SCRIPT = SCRIPTPATH

	_LOGO = '<img src="/icons/apache_pb.gif" alt="(logo)" border=0 width=259 height=32>'
	_ICON = '<img src="/icons/small/dir.gif" alt="(dir)" border=0 width=16 height=16>'

elif INTEGRATION == INT_NONE:
	_LOGO = ''
	_ICON = ''

	
	


# dependencies
import time
import os
import urllib
import urlparse
import cgi
import re
import xml.sax.saxutils


_VERSION = "2.2"
# basic fields:
# Operation Type(Operation Date)|username|<ignore>|directory|revision|fn

_OPTYPES = {
"O" : "Checkout" ,
"F" : "Release" ,
"T" : "RTag",
"W" : "Delete on update",
"U" : "Update",
"P" : "Update by patch",
"G" : "Merge on update",
"C" : "Conflict on update",
"M" : "Commit",
"A" : "Addition",
"R" : "Removal",
"E" : "Export",
}

def op2text(op):
	return _OPTYPES.get(op, "Unknown (%s)" % op)

_SELF_URL = os.environ['SCRIPT_NAME']

class ReverseReadline:
	def __init__(self,fd,BUFSIZ=262144):
		self.fd = fd
		self.ind = 0
		self.BUFSIZ = BUFSIZ
		self.fd.seek(0,2) 
		self.siz = self.fd.tell()
		self.buff = ""
		self.ind = 0
		self.scount = -1
		self.eof = 0
		self.first = 1

	def readline(self):
		# find the start index
		nind = self.buff.rfind("\n",0,self.ind-1)
		if nind != -1 and self.ind != 0:
			ret = self.buff[nind+1:self.ind+1]
			self.ind = nind
			return ret
		# oops.. outta newlines

		# keep the existing data
		old = self.buff[:self.ind+1]

		# can't seek backward anymore?
		if self.eof:
			self.buff = ""
			return old

		# seek to the right location
		sksiz = self.BUFSIZ * self.scount
		if sksiz * -1 > self.siz:
			sksiz = self.siz * -1
			self.eof = 1
			rd = self.siz - ( ( (self.scount * -1) - 1) * self.BUFSIZ)
		else:
			rd = self.BUFSIZ 

		self.fd.seek(sksiz,2) 

		self.buff = self.fd.read(rd)

		if self.first:
			self.ind = rd - 1
			self.first = 0
		else:
			self.ind = rd 

		self.scount -= 1

		rl = self.readline()
		if rl[-1] == "\n":
			return old + rl
		else:
			return rl + old

# fast mode, for big servers.  No sorting!
def get_history_fast(conds,opts):
	reader = ReverseReadline(open(HISTORY[opts["cvsroot"]]))

	# datelimit
	lasttime = time.time()
	if LIMITDAYS:
		ltm  = lasttime
		ltm -= (86400 * LIMITDAYS)
	else:
		ltm = 0

	offset = 0
	if opts.has_key("offset"):
		offset = int(opts["offset"])

	data = []
	skip = 0

	line = reader.readline()

	while len(data) < PERPAGE and line and lasttime > ltm:
		cur = line.strip().split("|",5) # maxsplit @ 5

		# we play a little game here.  we don't care about the data 
		# at index two, so we'll put the time there
		
		lasttime = get_time(cur[0][1:])
		cur[2] = lasttime
		cur[0] = cur[0][0] # the op code

		failed = 0
		for cond in conds:
			if not cond.test(cur):
				failed = 1
				break

		if not failed and skip < offset:
			skip += 1
		elif not failed and lasttime > ltm:
			data.append(cur)

		line = reader.readline()

	return data


# this is a bit uneasy for especially large logs, but.. 
# we'll worry about that later.
def get_history(opts):

	# datelimit
	lasttime = time.time()
	if LIMITDAYS:
		ltm  = lasttime
		ltm -= (86400 * LIMITDAYS)
	else:
		ltm = 0

	fd = open(HISTORY[opts["cvsroot"]],"r")

	data = []

	line = fd.readline()
	while line:
		cur = line.strip().split("|",5)

		# we play a little game here.  we don't care about the data 
		# at index two, so we'll put the time there
		
		lasttime = get_time(cur[0][1:])
		cur[2] = lasttime
		cur[0] = cur[0][0] # the op code

		if lasttime > ltm:
			data.append(cur)

		line = fd.readline()

	fd.close()

	# data is:
	# <string>op:<string>user:<int>time:dir:revision:file/module
	#  * number of entries
	data.reverse()

	return data 

_OTYPE_CHECKBOX = 1
_OTYPE_TEXT     = 2
_OTYPE_SELECT   = 3

def opt_pre(opts,type,opt,opt2=None):
	if type == _OTYPE_CHECKBOX:
		if opts.has_key(opt) and opts[opt] == "on":
			return "CHECKED"
	elif type == _OTYPE_TEXT:
		if opts.has_key(opt) and opts[opt].strip() != "":
			return "value=\"%s\"" % opts[opt]
	elif type == _OTYPE_SELECT:
		if opts.has_key(opt) and opts[opt] == opt2:
			return "SELECTED"
	return ""
	
def get_time(hextime):
	tm = 0
	ht_len =  len(hextime)

	for x in xrange(0,ht_len):
		d = ord(hextime[x]) - 48
		if d > 9:
			d -= 39
		tm += d * (16 ** (ht_len - x - 1 ) )

	return tm

_COLUMNS = ["Date","User","Operation","Directory","File","Revision"]


def get_script_absolute_url ():

	port = ""
	if os.environ.get('HTTPS') or os.environ['SERVER_PROTOCOL'][:5] == 'HTTPS':
		url = 'https://'
		if os.environ['SERVER_PORT'] != '443':
                        port = os.environ['SERVER_PORT']
	else:
		url = 'http://'
		if os.environ['SERVER_PORT'] != '80':
			port = os.environ['SERVER_PORT']
	
	url += os.environ['SERVER_NAME']
	
	if port: url += ':' + port
	
	url += _SELF_URL
	
	return url
	
def pretty_print_rss(data,options):
	
	cvsHistoryURL = get_script_absolute_url ()
	
	print 'Content-Type: text/xml; charset=iso-8859-1'
	print
	print \
'''<?xml version="1.0" encoding="ISO-8859-1"?>
<rss version="2.0">
	<channel>
		<title>CVSHistory</title>
		<link>%s</link>
		<description>CVS Changelog History</description>
		<docs>http://blogs.law.harvard.edu/tech/rss</docs>
		<generator>CVSHistory</generator>
		<webMaster>%s</webMaster>
		<language>en</language>
''' % (cvsHistoryURL, SITE_ADMIN)
	
	for row in data:
		fileName = row[5]
		dirName  = row[3]
		author   = row[1]
		revision = row[4]
		op = op2text(row[0])
		
		if fileName == dirName:
			link = '%s/%s/' % (_SCRIPT, dirName)
		else:
			link = '%s/%s/%s' % (_SCRIPT, dirName, fileName)
		
		link = urlparse.urljoin (cvsHistoryURL, link)
		
		title = fileName
		
		description = '''%s: %s %s (%s)''' % (author, op, revision, dirName)
		
		milliseconds = row[2]
		
		date = time.strftime ('%a, %d %b %Y %H:%M:%S %Z', time.localtime (milliseconds))
		
		print \
'''	<item>
		<title>%s</title>
		<description>%s</description>
		<link>%s</link>
		<category>%s</category>
		<pubDate>%s</pubDate>
		<guid>%s</guid>''' % (
	xml.sax.saxutils.escape (title),
	xml.sax.saxutils.escape (description),
	xml.sax.saxutils.escape (link),
	op,
	date,
	author + '/' + op + '/' + fileName + '/' + str (milliseconds)
	)
		if AUTHOR_EMAIL_DOMAIN:
			print "		<author>%s@%s (%s)</author>" % (author, AUTHOR_EMAIL_DOMAIN, author)
		print '	</item>'
	
	print \
'''	</channel>
</rss>
'''

def pretty_print(data,options):
	if options.has_key("rss"):
		pretty_print_rss(data,options)
		return
	
	# set up paging
	offset = 0
	if options.has_key("offset"):
		try:
			offset = int(options["offset"])
		except:
			offset = 0

	pstr = ""
	nstr = ""

	if PERFORMANCE == MODE_SLOW:
		sortby = "Date"
		if options.has_key("sortby"):
			sortby = options["sortby"]



		nend = PERPAGE

		if len(data) - offset - PERPAGE < PERPAGE:
			nend = len(data) - offset - PERPAGE

		if offset - PERPAGE >= 0:
			pstr = '<td><font size="2"><a href="%s?%s">( Previous %s )</a></font></td>' % (
				_SELF_URL,getstring(options,["offset","%d" % (offset - PERPAGE)]),PERPAGE)
		if offset + PERPAGE < len(data):
			nstr = '<td><font size="2"><a href="%s?%s">( Next %s )</a></font></td>' % (
				_SELF_URL,getstring(options,["offset","%d" % (offset + PERPAGE)]),nend)

		cend = offset + PERPAGE
		if cend > len(data):
			cend = len(data)
		ofstr = " of <b>%s</b>" % len(data)
		srange = offset
		erange = cend
	elif PERFORMANCE == MODE_FAST:
		if offset >= PERPAGE:
			pstr = '<td><font size="2"><a href="%s?%s">( Newer Entries )</a></font></td>' % (
				_SELF_URL,getstring(options,["offset","%d" % (offset - PERPAGE)]))

		nstr = '<td><font size="2"><a href="%s?%s">( Older Entries )</a></font></td>' % (
				_SELF_URL,getstring(options,["offset","%d" % (offset + PERPAGE)]))
		cend = offset + PERPAGE
		if cend - offset > len(data):
			cend = len(data) + offset

		ofstr = ""
		srange = 0
		erange = len(data)
	 
	rssURL =  get_script_absolute_url ()
	
	rssURL += '?'
	
	form = cgi.FieldStorage()
	for paramName in form.keys():
		paramValue = form[paramName].value
		if type(paramValue) == type([]):
			paramValue = paramValue[0]
		rssURL += paramName + '=' + urllib.quote (paramValue) + '&'
	
	rssURL += 'rss=1'

	print \
'''Content-Type: text/html\r
\r
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head><title>CVSHistory</title>
	<!-- CVSHistory: Jamie Turner, jamwt@jamwt.com -->
	<link rel="alternate" type="application/rss+xml" title="RSS" href="%s">
	</head>
	<body bgcolor="#ffffff" text="#000000">
	<table width="100%%" border=0 cellspacing=0 cellpadding=0>
	<tr>
	<td rowspan=2><h1>CVSHistory</h1></td>
	<td align=right>%s</td>
	</tr>

	</table>

<hr noshade size="1">
	<table>
	<tr><td>
	<form action="%s" method="get">
	<table>
	<tr>
		<td valign="top" width="100">User:</td>
		<td valign="top"><input type="text" name="usearch" %s><br>
		<font size="2">Regular expression?&nbsp;&nbsp;<input type="checkbox" name="usearchre" %s></font></td>
		<td width="50">&nbsp;</td>
		<td valign="top">Revision:
		<br><select name="revsel1">
				<option value="na" %s>(No Restriction)</option>
				<option value="eq" %s>Equal to</option>
				<option value="gt" %s>Greater than</option>
				<option value="lt" %s>Less than</option>
			</select>
			<input type="text" name="revval1" size="6" %s>
			<select name="revsel2">
				<option value="na" %s>(No Restriction)</option>
				<option value="eq" %s>Equal to</option>
				<option value="gt" %s>Greater than</option>
				<option value="lt" %s>Less than</option>
			</select>
			<input type="text" name="revval2" size="6" %s>
		</td>

	</tr>
	<tr>
		<td valign="top" width="100">File:</td>
		<td><input type="text" name="fsearch" %s><br>
		<font size="2">Regular expression?&nbsp;&nbsp;<input type="checkbox" name="fsearchre" %s></font></td>
		<td width="50">&nbsp;</td>
		<td valign="top">Date:
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<font size="2"><i>format: %s or %s</i></font>
		<br><select name="datesel1">
				<option value="na" %s>(No Restriction)</option>
				<option value="eq" %s>On/At</option>
				<option value="gt" %s>On/After</option>
				<option value="lt" %s>Before</option>
			</select>
			<input type="text" name="dateval1" size="30" %s>
		</td>

	</tr>
	<tr>
		<td valign="top" width="100">Directory:</td>
		<td><input type="text" name="dsearch" %s><br>
		<font size="2">Regular expression?&nbsp;&nbsp;<input type="checkbox" name="dsearchre" %s></font><br>
		<font size="2">Include subdirectories?&nbsp;&nbsp;<input type="checkbox" name="dsearchsub" %s></font></td>
		<td width="50">&nbsp;</td>
		<td valign="top">
			<select name="datesel2">
				<option value="na" %s>(No Restriction)</option>
				<option value="eq" %s>On/At</option>
				<option value="gt" %s>On/After</option>
				<option value="lt" %s>Before</option>
			</select>
			<input type="text" name="dateval2" size="30" %s>
		</td>
	</tr>
	<tr>
	<td valign="top">Operations:</td>
	<td colspan="3">
		<select name="selop">
			<option value="na" %s>(No Restriction)</option>
			<option value="in" %s>Include</option>
			<option value="out" %s>Exclude</option>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;
		Addition&nbsp;<input type="checkbox" name="opA" %s>&nbsp;&nbsp;&nbsp;&nbsp;
		Checkout&nbsp;<input type="checkbox" name="opO" %s>&nbsp;&nbsp;&nbsp;&nbsp;
		Commit&nbsp;<input type="checkbox" name="opM" %s>&nbsp;&nbsp;&nbsp;&nbsp;
		Conflict on update&nbsp;<input type="checkbox" name="opC" %s>
		<br>
		Delete on update&nbsp;<input type="checkbox" name="opW" %s>&nbsp;&nbsp;&nbsp;&nbsp;
		Merge on update&nbsp;<input type="checkbox" name="opG" %s>&nbsp;&nbsp;&nbsp;&nbsp;
		Release&nbsp;<input type="checkbox" name="opF" %s>&nbsp;&nbsp;&nbsp;&nbsp;
		Removal&nbsp;<input type="checkbox" name="opR" %s>&nbsp;&nbsp;&nbsp;&nbsp;
		Rtag&nbsp;<input type="checkbox" name="opT" %s>&nbsp;&nbsp;&nbsp;&nbsp;
		Update&nbsp;<input type="checkbox" name="opU" %s>&nbsp;&nbsp;&nbsp;&nbsp;
		Update&nbsp;by&nbsp;patch&nbsp;<input type="checkbox" name="opP" %s>&nbsp;&nbsp;&nbsp;&nbsp;
	</td>
	<tr><td colspan="4" align="center"><input type="submit" value="Limit History">
	<a href="%s">(Reset/View All)</a></td></tr>
	</table>
	<input type="hidden" name="limit" value="1">
	%s
	</form>
	
	</td></tr>
	</table>

	<hr noshade>
	<table align="center" cellpadding="10"><tr><td>Showing records <b>%s-%s</b>%s</td>
	%s%s</tr></table>

	%s
	<tr>''' % (cgi.escape(rssURL), _LOGO, _SELF_URL,
	opt_pre(options,_OTYPE_TEXT,"usearch"),
	opt_pre(options,_OTYPE_CHECKBOX,"usearchre"),
	opt_pre(options,_OTYPE_SELECT,"revsel1","na"),
	opt_pre(options,_OTYPE_SELECT,"revsel1","eq"),
	opt_pre(options,_OTYPE_SELECT,"revsel1","gt"),
	opt_pre(options,_OTYPE_SELECT,"revsel1","lt"),
	opt_pre(options,_OTYPE_TEXT,"revval1"),
	opt_pre(options,_OTYPE_SELECT,"revsel2","na"),
	opt_pre(options,_OTYPE_SELECT,"revsel2","eq"),
	opt_pre(options,_OTYPE_SELECT,"revsel2","gt"),
	opt_pre(options,_OTYPE_SELECT,"revsel2","lt"),
	opt_pre(options,_OTYPE_TEXT,"revval2"),
	opt_pre(options,_OTYPE_TEXT,"fsearch"),
	opt_pre(options,_OTYPE_CHECKBOX,"fsearchre"),

	#date break...	
	time.strftime(TIMEFORMAT,time.localtime(time.time())),
				time.strftime(TIMEFORMAT[:-6],time.localtime(time.time())) ,

	opt_pre(options,_OTYPE_SELECT,"datesel1","na"),
	opt_pre(options,_OTYPE_SELECT,"datesel1","eq"),
	opt_pre(options,_OTYPE_SELECT,"datesel1","gt"),
	opt_pre(options,_OTYPE_SELECT,"datesel1","lt"),
	opt_pre(options,_OTYPE_TEXT,"dateval1"),
	opt_pre(options,_OTYPE_TEXT,"dsearch"),
	opt_pre(options,_OTYPE_CHECKBOX,"dsearchre"),
	opt_pre(options,_OTYPE_CHECKBOX,"dsearchsub"),
	opt_pre(options,_OTYPE_SELECT,"datesel2","na"),
	opt_pre(options,_OTYPE_SELECT,"datesel2","eq"),
	opt_pre(options,_OTYPE_SELECT,"datesel2","gt"),
	opt_pre(options,_OTYPE_SELECT,"datesel2","lt"),
	opt_pre(options,_OTYPE_TEXT,"dateval2"),
	opt_pre(options,_OTYPE_SELECT,"selop","na"),
	opt_pre(options,_OTYPE_SELECT,"selop","in"),
	opt_pre(options,_OTYPE_SELECT,"selop","out"),
	opt_pre(options,_OTYPE_CHECKBOX,"opA"),
	opt_pre(options,_OTYPE_CHECKBOX,"opO"),
	opt_pre(options,_OTYPE_CHECKBOX,"opM"),
	opt_pre(options,_OTYPE_CHECKBOX,"opC"),
	opt_pre(options,_OTYPE_CHECKBOX,"opW"),
	opt_pre(options,_OTYPE_CHECKBOX,"opG"),
	opt_pre(options,_OTYPE_CHECKBOX,"opF"),
	opt_pre(options,_OTYPE_CHECKBOX,"opR"),
	opt_pre(options,_OTYPE_CHECKBOX,"opT"),
	opt_pre(options,_OTYPE_CHECKBOX,"opU"),
	opt_pre(options,_OTYPE_CHECKBOX,"opP"),

	# so we submit to the same place!
	not options["cvsroot"] and _SELF_URL or 
	(_SELF_URL + ("?cvsroot=%s" % options["cvsroot"])),

	# so we submit to the same place!
	not options["cvsroot"] and "" or (
	'<input type="hidden" name="cvsroot" value="%s" />' % options["cvsroot"]),

	# paging
	offset + 1, cend, ofstr, pstr,nstr, 
	_TABLETOP,
		)
	options["offset"] = "%d" % offset

	for x in xrange(0,len(_COLUMNS)):
		if ( (PERFORMANCE == MODE_SLOW and _COLUMNS[x] == sortby) or
			(PERFORMANCE == MODE_FAST and _COLUMNS[x] == "Date") ):
			print '''<th align=left bgcolor="#%s"
	>%s</th> ''' % (_SORTEDCOL, _COLUMNS[x])
		elif PERFORMANCE == MODE_FAST:
			print '''<th align=left bgcolor="#%s"
	>%s</th> ''' % (_REGCOL, _COLUMNS[x])
		else:
			print '''<th align=left bgcolor="#%s"
	><a href="%s?%s">%s</a></th> ''' % (_REGCOL, _SELF_URL,
		getstring(options,["sortby",_COLUMNS[x]]),_COLUMNS[x])


	print "</tr>\n"


	for x in xrange(srange,erange):
		fn = data[x][5]
		dn = data[x][3]
		if fn == dn:
			fn = "<i>N/A</I>"
		elif INTEGRATION:
			fn = '<a href="%s/%s/%s">%s</a>' % (
				_SCRIPT, dn ,fn,fn )
		if INTEGRATION:
			dn = '<a href="%s/%s/">%s%s</a>' % (
				_SCRIPT,dn,_ICON,dn )



		rev = data[x][4]
		if rev == '':
			rev = "<i>N/A</I>"

		print \
'''<tr bgcolor="#%s">

<td>%s</td>
<td>%s</td>
<td>%s</td>
<td>%s</td>
<td>%s</td>
<td>%s</td>

</tr>
''' % (_ROWS[x % 2],  # background color
		time.strftime(TIMEFORMAT,time.localtime(data[x][2])), #Date
		data[x][1], # user
		op2text(data[x][0]), # operation
		dn, # directory
		fn,  # file/module
		rev, # revision
	 )
	
	print \
'''</table><hr noshade>
<table width="100%%" border=0 cellpadding=0 cellspacing=0><tr>
<td align=left valign="top">
	<a href="%s">RSS</a>''' % cgi.escape(rssURL)
	
	if PUBLIC_SERVER:
		print '	<a href="http://purl.org/net/syndication/subscribe/?rss=%s">Subscribe</a>' % urllib.quote (rssURL)
		
	print \
'''</td>
<td align=right>
Powered by<br><a href="http://www.jamwt.com/CVSHistory/">CVSHistory %s</a>
</td></tr></table>
</body></html>''' % _VERSION



def getstring(options,add=None,ignore=[]):

	if add:
		options[add[0]] = add[1]

	gs = []
	for k in options.keys():
		if not k in ignore:
			gs.append("%s=%s"  % (k,urllib.quote_plus(options[k])))


	return cgi.escape("&".join(gs), 1)
	
	
def get_options():
	form = cgi.FieldStorage()
	opts = {}

	for o in form.keys():
		d = form[o].value
		if type(d) == type([]):
			d = d[0]
		opts[o] = d
	if not opts.has_key("cvsroot") or not HISTORY.has_key(opts["cvsroot"]):
		opts["cvsroot"] = ""

	return opts

def sm_user(a,b):
	if a[1].upper() < b[1].upper():
		return -1
	if a[1].upper() == b[1].upper():
		return 0
	return 1

def sm_op(a,b):
	oa = op2text(a[0])
	ob = op2text(b[0])
	if oa < ob:
		return -1
	if oa == ob:
		return 0
	return 1

def sm_dir(a,b):
	if a[3].upper() < b[3].upper():
		return -1
	if a[3].upper() == b[3].upper():
		return 0
	return 1

def sm_fn(a,b):
	if a[3] == a[5]:
		return 1
	if a[5].upper() < b[5].upper():
		return -1
	if a[5].upper() == b[5].upper():
		return 0
	return 1

def str_to_float(a):
	if a == '':
		return 0.0
	return float(a)

def cmp_rev(a,b):
	al = map(str_to_float, a.split('.'))
	bl = map(str_to_float, b.split('.'))
	if al > bl:
		return 1
	if al < bl:
		return -1
		return 0

def sm_rev(a,b):
	return cmp_rev(a[4],b[4])

_SORTMETHODS = {
	"User" : sm_user,
	"Operation" : sm_op,
	"Directory" : sm_dir,
	"File" : sm_fn,
	"Revision" : sm_rev,
}

#conds = [

_CTYPE_MATCH 				= 1
_CTYPE_REMATCH 				= 2
_CTYPE_DATE 				= 3
_CTYPE_REV 					= 4
_CTYPE_OPS 					= 5

_ARG2_OUT                   = 0
_ARG2_IN                    = 1

_ARG2_EQ                    = 2
_ARG2_GT                    = 3
_ARG2_LT                    = 4

_ARG2_SEQ                    = 5
_ARG2_NUM_GT                = 6
_ARG2_NUM_LT                = 7

class Condition:
	def __init__(self,type,dfield,arg,arg2=None):
		self.dfield = dfield
		self.error = None

		if type == _CTYPE_MATCH:
			self.arg = arg.strip()
			self.test = self.MATCH_test
		elif type == _CTYPE_REMATCH:
			try:
				self.arg = re.compile(arg)
				self.test = self.REMATCH_test
			except:
				self.error = "invalid regular expression"

		elif type == _CTYPE_DATE:
			try:
				arg = arg.strip()
				arg = re.sub(" +"," ",arg)
				if arg.count(" "):
					self.arg = time.mktime(time.strptime(arg,TIMEFORMAT))
					longdate = 1
				else:
					self.arg = time.mktime(time.strptime(arg,TIMEFORMAT[:-6]))
					longdate = 0
				self.test = self.COMP_test	
			except:
				self.error = "invalid date"
			if arg2 == "eq":
				if longdate:
					self.arg2 = _ARG2_EQ
				else:
					self.arg2 = _ARG2_SEQ
			elif arg2 == "gt":
				self.arg2 = _ARG2_GT
			elif arg2 == "lt":
				self.arg2 = _ARG2_LT
			else:
				self.error = "unexpected comparison specification for date"

		elif type == _CTYPE_REV:
			self.arg = arg
			self.test = self.COMP_test
			if arg2 == "eq":
				self.arg2 = _ARG2_EQ
			elif arg2 == "gt":
				self.arg2 = _ARG2_NUM_GT
			elif arg2 == "lt":
				self.arg2 = _ARG2_NUM_LT
			else:
				self.error = "unexpected comparison specification for revisions"
		elif type == _CTYPE_OPS:
			self.arg = arg
			self.test = self.OPS_test
			if arg2 == "in":
				self.arg2 = _ARG2_IN
			elif arg2 == "out":
				self.arg2 = _ARG2_OUT
			else:
				self.error = "unexpected argument for operation exclusion/inclusion"




	def MATCH_test(self,dataitem):
		if dataitem[self.dfield] == self.arg:
			return 1
		return 0

	def REMATCH_test(self,dataitem):
		if self.arg.search(dataitem[self.dfield]):
			return 1
		return 0

	def COMP_test(self,dataitem):
		if self.arg2 == _ARG2_SEQ:
			# we have a date...
			dt = time.localtime(dataitem[self.dfield])
			mt = dt[:3] + (0,0,0) + dt[6:]
			if time.mktime(mt) == self.arg:
				return 1
			return 0
		elif self.arg2 == _ARG2_EQ:
			if dataitem[self.dfield] == self.arg:
				return 1
			return 0
		elif self.arg2 == _ARG2_GT:
			if dataitem[self.dfield] > self.arg:
				return 1
			return 0
		elif self.arg2 == _ARG2_LT:
			if dataitem[self.dfield] < self.arg:
				return 1
			return 0
		elif self.arg2 == _ARG2_NUM_GT:
			if cmp_rev(dataitem[self.dfield], self.arg) == 1:
				return 1
			return 0
		elif self.arg2 == _ARG2_NUM_LT:
			if cmp_rev(dataitem[self.dfield], self.arg) == -1:
				return 1
			return 0
		return 0


	def OPS_test(self,dataitem):
		if dataitem[self.dfield] in self.arg:
			return 1 * self.arg2  # will 0 out if OUT
		return 1 - self.arg2 # inverse
		




def get_conds(opts):
	conds = []
	if not HISTORY.get(opts["cvsroot"]):
		return "Error: unknown cvsroot: '%s'" % opts["cvsroot"]
	for opt in opts.keys():
		# username
		madecond = 0
		if opt == "usearch" and opts[opt].strip() != "":
			madecond = 1
			if opts.has_key("usearchre") and opts["usearchre"] == "on":
				conds.append(Condition(_CTYPE_REMATCH,1,opts["usearch"]) )
			else:
				conds.append(Condition(_CTYPE_MATCH,1,opts["usearch"]) )
		if opt == "fsearch" and opts[opt].strip() != "":
			madecond = 1
			if opts.has_key("fsearchre") and opts["fsearchre"] == "on":
				conds.append(Condition(_CTYPE_REMATCH,5,opts["fsearch"]) )
			else:
				conds.append(Condition(_CTYPE_MATCH,5,opts["fsearch"]) )
		elif opt == "dsearch" and opts[opt].strip() != "":
			madecond = 1
			if opts.has_key("dsearchre") and opts["dsearchre"] == "on":
				conds.append(Condition(_CTYPE_REMATCH,3,opts["dsearch"]) )
			else:
				conds.append(Condition(_CTYPE_MATCH,3,opts["dsearch"]) )
		elif opt == "dsearch" and opts[opt].strip() != "":
			madecond = 1
			if opts.has_key("dsearchre") and opts["dsearchre"] == "on":
				conds.append(Condition(_CTYPE_REMATCH,3,opts["dsearch"]) )
			else:
				conds.append(Condition(_CTYPE_MATCH,3,opts["dsearch"]) )
		elif opt == "revsel1" and opts[opt].strip() != "na":
			madecond = 1
			if not opts.has_key("revval1") or opts["revval1"].strip() == "":
				return "Error processing revision: please include revision value"
			conds.append(Condition(_CTYPE_REV,4,opts["revval1"],opts["revsel1"]) )
		elif opt == "revsel2" and opts[opt].strip() != "na":
			madecond = 1
			if not opts.has_key("revval2") or opts["revval2"].strip() == "":
				return "Error processing revision: please include revision value"
			conds.append(Condition(_CTYPE_REV,4,opts["revval2"],opts["revsel2"]) )
		elif opt == "datesel1" and opts[opt].strip() != "na":
			madecond = 1
			if not opts.has_key("dateval1") or opts["dateval1"].strip() == "":
				return "Error processing date: please include date value"
			conds.append(Condition(_CTYPE_DATE,2,opts["dateval1"],opts["datesel1"]) )
		elif opt == "datesel2" and opts[opt].strip() != "na":
			madecond = 1
			if not opts.has_key("dateval2") or opts["dateval2"].strip() == "":
				return "Error processing date: please include date value"
			conds.append(Condition(_CTYPE_DATE,2,opts["dateval2"],opts["datesel2"]) )

		elif opt == "selop" and opts["selop"] != "na":
			madecond = 1
			ops_arg = []
			for inkey in opts.keys():
				if inkey[:2] == "op" and opts[inkey] == "on":
					ops_arg.append(inkey[2])
			conds.append(Condition(_CTYPE_OPS,0,"".join(ops_arg),opts["selop"]) )


		if madecond and conds[-1].error:
			return "Error processing form input: " + conds[-1].error

	return conds
	
def limit(data,conds):
	x = 0
	while x < len(data):
		for c in conds:
			if not c.test(data[x]):
				del data[x]
				x -= 1
				break
		x += 1

	return data

def correct_opts(opts):
	# revision
	if opts.has_key("revsel1") and opts["revsel1"] == "na":
		opts["revval1"] = ""
	if opts.has_key("revsel2") and opts["revsel2"] == "na":
		opts["revval2"] = ""
	if opts.has_key("datesel1") and opts["datesel1"] == "na":
		opts["dateval1"] = ""
	if opts.has_key("datesel2") and opts["datesel2"] == "na":
		opts["dateval2"] = ""
	if opts.has_key("selop") and opts["selop"] == "na":
		for ok in opts.keys():
			if ok[:2] == "op":
				opts[ok] = "off"

	return opts
	
def error(mess):
	print \
'''Content-Type: text/html\r
\r
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head><title>CVSHistory -- Error</title>
</head><body bgcolor="#ffffff">
<h2>Error</h2>
CVSHistory encountered an error on form input:<br>
<i>%s</i></body></html>''' % cgi.escape(mess)


def go_slow():
	opts = get_options()
	data = get_history(opts)

	# fix directory recursion
	if opts.has_key("dsearchsub") and opts["dsearchsub"] == "on":
		if not opts.has_key("dsearchre") or opts["dsearchre"] != "on":
			opts["dsearch"] = re.escape(opts["dsearch"])
			opts["dsearchre"] = "on"
		opts["dsearch"] = "^" + opts["dsearch"] + ".*"
		opts["dsearchsub"] = "off"

	printed = 0

	conds = None
	if opts.has_key("limit") and opts["limit"] == "1":
		conds = get_conds(opts)
		if type(conds) == type(""):
			error(conds)
			printed = 1
		else:
			opts = correct_opts(opts)
			data = limit(data,conds)

	# sorting
	if not printed:
		if opts.has_key("sortby") and opts["sortby"] != "Date":
			data.sort(_SORTMETHODS[opts["sortby"]])

		pretty_print(data,opts)

#fast mode
def go_fast():

	opts = get_options()

	# fix directory recursion
	if opts.has_key("dsearchsub") and opts["dsearchsub"] == "on":
		if not opts.has_key("dsearchre") or opts["dsearchre"] != "on":
			opts["dsearch"] = re.escape(opts["dsearch"])
			opts["dsearchre"] = "on"
		opts["dsearch"] = "^" + opts["dsearch"] + ".*"
		opts["dsearchsub"] = "off"
	printed = 0

	conds = []
	if opts.has_key("limit") and opts["limit"] == "1":
		conds = get_conds(opts)
		if type(conds) == type(""):
			error(conds)
			printed = 1
		else:
			opts = correct_opts(opts)

	if not printed:
		data = get_history_fast(conds,opts)
		pretty_print(data,opts)

if __name__ == "__main__":
	if PERFORMANCE == MODE_FAST:
		go_fast()
	if PERFORMANCE == MODE_SLOW:
		go_slow()
