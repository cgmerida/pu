echo off

for /f "tokens=1-3 delims=/" %%i in ("%date%") do (
     set d=%%i
     set m=%%j
     set y=%%k
)
set datestr=%d%-%m%-%y%

set folder=%~dp0%m%-%y%

echo %folder%

if not exist %folder% mkdir %folder%

mysqldump -hlocalhost -uroot pu > %folder%/backup_pu_%datestr%.sql

exit