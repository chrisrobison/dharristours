#!/bin/sh

/usr/bin/rsync -e ssh -avz $* --exclude=*.sql --exclude=archive --exclude=incoming --exclude=spool --exclude=.env --exclude=node_modules --exclude=archive --exclude=.htaccess --exclude=.svn --exclude=CVS --exclude=log --exclude=*.swp --progress cdr@cloud.simpsf.com:/home/cdr/simple/* /home/cdr/newsimple/

# /usr/local/bin/rsync -e ssh -avz $* --filter=:C --exclude=.htaccess --exclude=.svn --exclude=CVS --exclude=log --exclude=clients --exclude=*.swp --progress cdr@cdr2.com:./base.dev/ ~/simple/

