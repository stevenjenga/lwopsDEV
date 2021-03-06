; Script generated by the Inno Setup Script Wizard.
; SEE THE DOCUMENTATION FOR DETAILS ON CREATING INNO SETUP SCRIPT FILES!

#define MyAppName "LWOPS200"
#define MyAppVersion "2.0.0"
#define MyAppPublisher "Ladywood Inv."
#define MyAppURL "http://localhost:8080/LWOPS200"

[Setup]
; NOTE: The value of AppId uniquely identifies this application.
; Do not use the same AppId value in installers for other applications.
; (To generate a new GUID, click Tools | Generate GUID inside the IDE.)
AppId={{9E804472-CEEB-4D20-9B04-C6841438DDCB}
AppName={#MyAppName}
AppVersion={#MyAppVersion}
;AppVerName={#MyAppName} {#MyAppVersion}
AppPublisher={#MyAppPublisher}
AppPublisherURL={#MyAppURL}
AppSupportURL={#MyAppURL}
AppUpdatesURL={#MyAppURL}
DefaultDirName=C:\xampp\htdocs\{#MyAppName}
DisableDirPage=yes
DefaultGroupName={#MyAppName}
DisableProgramGroupPage=yes
OutputBaseFilename=setupLWOPSv2.0.0
Compression=lzma
SolidCompression=yes

[Languages]
Name: "english"; MessagesFile: "compiler:Default.isl"

[Files]
Source: "C:\xampp\htdocs\lwopsDEV\comp.html"; DestDir: "{app}"; Flags: ignoreversion
Source: "C:\xampp\htdocs\lwopsDEV\custom.css"; DestDir: "{app}"; Flags: ignoreversion
Source: "C:\xampp\htdocs\lwopsDEV\favicon.ico"; DestDir: "{app}"; Flags: ignoreversion
Source: "C:\xampp\htdocs\lwopsDEV\hort.html"; DestDir: "{app}"; Flags: ignoreversion
Source: "C:\xampp\htdocs\lwopsDEV\hortSchedule.php"; DestDir: "{app}"; Flags: ignoreversion
Source: "C:\xampp\htdocs\lwopsDEV\hostSchedule.html"; DestDir: "{app}"; Flags: ignoreversion
Source: "C:\xampp\htdocs\lwopsDEV\index.html"; DestDir: "{app}"; Flags: ignoreversion
Source: "C:\xampp\htdocs\lwopsDEV\functions\*"; DestDir: "{app}\functions"; Flags: ignoreversion recursesubdirs createallsubdirs
Source: "C:\xampp\htdocs\lwopsDEV\codebase\*"; DestDir: "{app}\codebase"; Flags: ignoreversion recursesubdirs createallsubdirs
Source: "C:\xampp\htdocs\lwopsDEV\codebase_calendar\*"; DestDir: "{app}\codebase_calendar"; Flags: ignoreversion recursesubdirs createallsubdirs
Source: "C:\xampp\htdocs\lwopsDEV\database\*"; DestDir: "{app}\database"; Flags: ignoreversion recursesubdirs createallsubdirs
Source: "C:\xampp\htdocs\lwopsDEV\dhtmlxMenu\*"; DestDir: "{app}\dhtmlxMenu"; Flags: ignoreversion recursesubdirs createallsubdirs
; NOTE: Don't use "Flags: ignoreversion" on any shared system files

[Icons]
Name: "{group}\{cm:ProgramOnTheWeb,{#MyAppName}}"; Filename: "{#MyAppURL}"

