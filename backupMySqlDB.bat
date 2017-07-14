REM cmd.exe /c start /min myfile.bat ^& exit
@ECHO OFF
xcopy C:\xampp\mysql\data\dev_ladywoodopsdbv350 C:\temp\dev_ladywoodopsdbv350  /Y /i /e /j
CD C:\temp\
REM for /f "tokens=1-5 delims=/ " %%d in ("%date%") do rename "dev_ladywoodopsdbv350" dev_ladywoodopsdbv350.%%e-%%f-%%g
REM for /f "tokens=1-5 delims=:" %%d in ("%time%") do rename "hope.txt" %%d-%%e.txt
REM set "str1=%str1% DOS %str2%"
for /f "tokens=1-5 delims=/ " %%d in ("%date%") do  set "str1=%%e-%%f-%%g"
for /f "tokens=1-5 delims=:" %%d in ("%time%") do  set "str2=%%d-%%e"
rename "dev_ladywoodopsdbv350" dev_ladywoodopsdbv350.%str1%.%str2%