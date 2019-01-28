echo off
mysqldump -hlocalhost -uroot pu > c:/xampp/htdocs/pu/database/backups/backup_pu_%Date:~6,4%-%Date:~3,2%-%Date:~0,2%.sql
exit