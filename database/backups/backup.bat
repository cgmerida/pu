echo off
for /f "tokens=1-4 delims=/ " %%i in ("%date%") do (
     set dow=%%i
     set d=%%j
     set m=%%k
     set y=%%l
)
set datestr=%d%_%m%_%y%

set folder="c:/xampp/htdocs/pu/database/backups/"%m%-%y%

if not exist %folder% mkdir %folder%

mysqldump -hlocalhost -uroot pu > %folder%/backup_pu_%datestr%.sql

exit