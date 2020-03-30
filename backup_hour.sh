#!/bin/bash

/usr/bin/mysqldump --routines --events --opt --single-transaction SS_DHarrisTours > /root/ss_dharristours_dailydump_`date +%H%P`.sql
/usr/bin/gzip /root/ss_dharristours_dump_`date +%H%P`.sql
/usr/bin/scp -i /root/.ssh/id_rsa /root/ss_dharristours_dump_`date +%H%P`.sql.gz patrick@admin.simpsf.com:/home/patrick/sql_backup

