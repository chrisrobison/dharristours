#!/bin/sh

$COMMAND = "/usr/local/bin/rsync -e ssh -avz $* --filter=:C --exclude=.htaccess --exclude=.svn --exclude=CVS --exclude=log --exclude=clients --exclude=*.swp --progress cdr@cdr2.com:./base.dev/ ~/simple/"
echo $COMMAND
$COMMAND

# /usr/local/bin/rsync -e ssh -avz $* --filter=:C --exclude=.htaccess --exclude=.svn --exclude=CVS --exclude=log --exclude=clients --exclude=*.swp --progress cdr@cdr2.com:./base.dev/ ~/simple/

