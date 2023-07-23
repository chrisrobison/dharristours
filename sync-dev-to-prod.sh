#!/bin/sh

/usr/bin/rsync -e ssh -avz $* --exclude=.htaccess --exclude=.env --exclude=spool --exclude=incoming --exclude=.svn --exclude=CVS --exclude=log --exclude=clients --exclude=*.swp --progress cdr@cdr2.com:./simple/* cdr@cloud.simpsf.com:./simple/

# /usr/local/bin/rsync -e ssh -avz $* --filter=:C --exclude=.htaccess --exclude=.svn --exclude=CVS --exclude=log --exclude=clients --exclude=*.swp --progress cdr@cdr2.com:./base.dev/ ~/simple/

