#!/bin/sh

/usr/bin/rsync -e ssh -avz $* --exclude=*.sql --exclude=archive --exclude=.htaccess --exclude=.env --exclude=spool --exclude=incoming --exclude=.svn --exclude=CVS --exclude=log --exclude=clients --exclude=*.swp --progress /home/cdr/newsimple/* cdr@cloud.simpsf.com:/home/cdr/simple/

# /usr/local/bin/rsync -e ssh -avz $* --filter=:C --exclude=.htaccess --exclude=.svn --exclude=CVS --exclude=log --exclude=clients --exclude=*.swp --progress cdr@cdr2.com:./base.dev/ ~/simple/

