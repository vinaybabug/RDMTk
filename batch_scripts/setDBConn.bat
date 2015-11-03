@echo off &setlocal

REM WMU Server Specific Configuation
 set "db_host_r=localhost"
 set "db_user_r=root"
 set "db_pass_r=password"  
 set "db_name_r=rdmtoolkit" 
 set "url_r=http://localhost/nirnayitoolkit" 

REM WMU Server Specific Configuation
rem  set "db_host_r=dbase.cs.wmich.edu"
rem  set "db_user_r=rdmtoolkit"
rem  set "db_pass_r=aakashgcbartapp"  
rem  set "db_name_r=rdmtoolkit" 
rem  set "url_r=http://behaviourtasks.dataanalysis.wsn.cs.wmich.edu/NirnayiToolkit" 


REM Configuration place holder's
set "db_host_c=DBHOST"  
set "db_user_c=DBUSER"  
set "db_pass_c=DBPASS"  
set "db_name_c=DBNAME"
set "url_c=APPURL"
set "RDM=C:\wamp\www\NirnayiToolkit"

REM Configuration Files 

REM BART

mkdir %CD%\BART\temp
copy %CD%\BART\oe_databasemanager.php %CD%\BART\temp\oe_databasemanager.php

echo Configuring: BART  oe_databasemanager.php

call jrepl "\b%db_host_c%\b" %db_host_r%  /f %CD%\BART\temp\oe_databasemanager.php /o -
call jrepl "\b%db_user_c%\b" %db_user_r%  /f %CD%\BART\temp\oe_databasemanager.php /o -
call jrepl "\b%db_pass_c%\b" %db_pass_r%  /f %CD%\BART\temp\oe_databasemanager.php /o -
call jrepl "\b%db_name_c%\b" %db_name_r%  /f %CD%\BART\temp\oe_databasemanager.php /o -

move %CD%\BART\temp\oe_databasemanager.php %RDM%\public\tasks\BART\include\class\oe_databasemanager.php

echo Configuring: BART  storedata.php

copy %CD%\BART\storedata.php %CD%\BART\temp\storedata.php

call jrepl "\b%db_host_c%\b" %db_host_r%  /f %CD%\BART\temp\storedata.php /o -
call jrepl "\b%db_user_c%\b" %db_user_r%  /f %CD%\BART\temp\storedata.php /o -
call jrepl "\b%db_pass_c%\b" %db_pass_r%  /f %CD%\BART\temp\storedata.php /o -
call jrepl "\b%db_name_c%\b" %db_name_r%  /f %CD%\BART\temp\storedata.php /o -

move %CD%\BART\temp\storedata.php %RDM%\public\tasks\BART\storedata.php

rd /S /Q %CD%\BART\temp

REM END BART

REM DelayD

mkdir %CD%\DelayD\temp
copy %CD%\DelayD\oe_databasemanager.php %CD%\DelayD\temp\oe_databasemanager.php

echo Configuring: DelayD  oe_databasemanager.php

call jrepl "\b%db_host_c%\b" %db_host_r%  /f %CD%\DelayD\temp\oe_databasemanager.php /o -
call jrepl "\b%db_user_c%\b" %db_user_r%  /f %CD%\DelayD\temp\oe_databasemanager.php /o -
call jrepl "\b%db_pass_c%\b" %db_pass_r%  /f %CD%\DelayD\temp\oe_databasemanager.php /o -
call jrepl "\b%db_name_c%\b" %db_name_r%  /f %CD%\DelayD\temp\oe_databasemanager.php /o -

move %CD%\DelayD\temp\oe_databasemanager.php %RDM%\public\tasks\DelayD\include\class\oe_databasemanager.php

rd /S /Q %CD%\DelayD\temp

REM END DelayD

REM CUPS

mkdir %CD%\CUPS\temp
copy %CD%\CUPS\oe_databasemanager.php %CD%\CUPS\temp\oe_databasemanager.php

echo Configuring: CUPS  oe_databasemanager.php

call jrepl "\b%db_host_c%\b" %db_host_r%  /f %CD%\CUPS\temp\oe_databasemanager.php /o -
call jrepl "\b%db_user_c%\b" %db_user_r%  /f %CD%\CUPS\temp\oe_databasemanager.php /o -
call jrepl "\b%db_pass_c%\b" %db_pass_r%  /f %CD%\CUPS\temp\oe_databasemanager.php /o -
call jrepl "\b%db_name_c%\b" %db_name_r%  /f %CD%\CUPS\temp\oe_databasemanager.php /o -

move %CD%\CUPS\temp\oe_databasemanager.php %RDM%\public\tasks\CUPS\include\class\oe_databasemanager.php

echo Configuring: CUPS  score.php

copy %CD%\CUPS\score.php %CD%\CUPS\temp\score.php

call jrepl "\b%db_host_c%\b" %db_host_r%  /f %CD%\CUPS\temp\score.php /o -
call jrepl "\b%db_user_c%\b" %db_user_r%  /f %CD%\CUPS\temp\score.php /o -
call jrepl "\b%db_pass_c%\b" %db_pass_r%  /f %CD%\CUPS\temp\score.php /o -
call jrepl "\b%db_name_c%\b" %db_name_r%  /f %CD%\CUPS\temp\score.php /o -

move %CD%\CUPS\temp\score.php %RDM%\public\tasks\CUPS\score.php

rd /S /Q %CD%\CUPS\temp

REM END CUPS

REM IGT

mkdir %CD%\IGT\temp
copy %CD%\IGT\oe_databasemanager.php %CD%\IGT\temp\oe_databasemanager.php

echo Configuring: IGT  oe_databasemanager.php

call jrepl "\b%db_host_c%\b" %db_host_r%  /f %CD%\IGT\temp\oe_databasemanager.php /o -
call jrepl "\b%db_user_c%\b" %db_user_r%  /f %CD%\IGT\temp\oe_databasemanager.php /o -
call jrepl "\b%db_pass_c%\b" %db_pass_r%  /f %CD%\IGT\temp\oe_databasemanager.php /o -
call jrepl "\b%db_name_c%\b" %db_name_r%  /f %CD%\IGT\temp\oe_databasemanager.php /o -

move %CD%\IGT\temp\oe_databasemanager.php %RDM%\public\tasks\IGT\include\class\oe_databasemanager.php

echo Configuring: IGT  score.php

copy %CD%\IGT\score.php %CD%\IGT\temp\score.php

call jrepl "\b%db_host_c%\b" %db_host_r%  /f %CD%\IGT\temp\score.php /o -
call jrepl "\b%db_user_c%\b" %db_user_r%  /f %CD%\IGT\temp\score.php /o -
call jrepl "\b%db_pass_c%\b" %db_pass_r%  /f %CD%\IGT\temp\score.php /o -
call jrepl "\b%db_name_c%\b" %db_name_r%  /f %CD%\IGT\temp\score.php /o -

move %CD%\IGT\temp\score.php %RDM%\public\tasks\IGT\score.php

rd /S /Q %CD%\IGT\temp

REM END IGT

REM NBACK

mkdir %CD%\NBACK\temp
copy %CD%\NBACK\oe_databasemanager.php %CD%\NBACK\temp\oe_databasemanager.php

echo Configuring: NBACK  oe_databasemanager.php

call jrepl "\b%db_host_c%\b" %db_host_r%  /f %CD%\NBACK\temp\oe_databasemanager.php /o -
call jrepl "\b%db_user_c%\b" %db_user_r%  /f %CD%\NBACK\temp\oe_databasemanager.php /o -
call jrepl "\b%db_pass_c%\b" %db_pass_r%  /f %CD%\NBACK\temp\oe_databasemanager.php /o -
call jrepl "\b%db_name_c%\b" %db_name_r%  /f %CD%\NBACK\temp\oe_databasemanager.php /o -

move %CD%\NBACK\temp\oe_databasemanager.php %RDM%\public\tasks\NBACK\include\class\oe_databasemanager.php

echo Configuring: NBACK  score.php

copy %CD%\NBACK\final_main.php %CD%\NBACK\temp\final_main.php

call jrepl "\b%db_host_c%\b" %db_host_r%  /f %CD%\NBACK\temp\final_main.php /o -
call jrepl "\b%db_user_c%\b" %db_user_r%  /f %CD%\NBACK\temp\final_main.php /o -
call jrepl "\b%db_pass_c%\b" %db_pass_r%  /f %CD%\NBACK\temp\final_main.php /o -
call jrepl "\b%db_name_c%\b" %db_name_r%  /f %CD%\NBACK\temp\final_main.php /o -

move %CD%\NBACK\temp\final_main.php %RDM%\public\tasks\NBACK\final_main.php

rd /S /Q %CD%\NBACK\temp

REM END NBACK

REM STROOP

mkdir %CD%\STROOP\temp
copy %CD%\STROOP\oe_databasemanager.php %CD%\STROOP\temp\oe_databasemanager.php

echo Configuring: STROOP  oe_databasemanager.php

call jrepl "\b%db_host_c%\b" %db_host_r%  /f %CD%\STROOP\temp\oe_databasemanager.php /o -
call jrepl "\b%db_user_c%\b" %db_user_r%  /f %CD%\STROOP\temp\oe_databasemanager.php /o -
call jrepl "\b%db_pass_c%\b" %db_pass_r%  /f %CD%\STROOP\temp\oe_databasemanager.php /o -
call jrepl "\b%db_name_c%\b" %db_name_r%  /f %CD%\STROOP\temp\oe_databasemanager.php /o -

move %CD%\STROOP\temp\oe_databasemanager.php %RDM%\public\tasks\STROOP\include\class\oe_databasemanager.php

echo Configuring: STROOP  score.php

copy %CD%\STROOP\final_main.php %CD%\STROOP\temp\final_main.php

call jrepl "\b%db_host_c%\b" %db_host_r%  /f %CD%\STROOP\temp\final_main.php /o -
call jrepl "\b%db_user_c%\b" %db_user_r%  /f %CD%\STROOP\temp\final_main.php /o -
call jrepl "\b%db_pass_c%\b" %db_pass_r%  /f %CD%\STROOP\temp\final_main.php /o -
call jrepl "\b%db_name_c%\b" %db_name_r%  /f %CD%\STROOP\temp\final_main.php /o -

move %CD%\STROOP\temp\final_main.php %RDM%\public\tasks\STROOP\final_main.php

rd /S /Q %CD%\STROOP\temp

REM END STROOP

REM LARAVEL
mkdir %CD%\LARAVEL\temp
copy %CD%\LARAVEL\app.php %CD%\LARAVEL\temp\app.php

echo Configuring: LARAVEL  app.php

call jrepl "\b%url_c%\b" %url_r%  /f %CD%\LARAVEL\temp\app.php /o -

move %CD%\LARAVEL\temp\app.php %RDM%\app\config\app.php

echo Configuring: LARAVEL  database.php

copy %CD%\LARAVEL\database.php %CD%\LARAVEL\temp\database.php

call jrepl "\b%db_host_c%\b" %db_host_r%  /f %CD%\LARAVEL\temp\database.php /o -
call jrepl "\b%db_user_c%\b" %db_user_r%  /f %CD%\LARAVEL\temp\database.php /o -
call jrepl "\b%db_pass_c%\b" %db_pass_r%  /f %CD%\LARAVEL\temp\database.php /o -
call jrepl "\b%db_name_c%\b" %db_name_r%  /f %CD%\LARAVEL\temp\database.php /o -

move %CD%\LARAVEL\temp\database.php %RDM%\app\config\database.php

rd /S /Q %CD%\LARAVEL\temp

REM END LARAVEL