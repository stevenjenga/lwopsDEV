<?php
if (! defined("DIRECTACESS")) exit("No direct script access allowed"); 
$host = "localhost";
$user = "root";
$pass = "";
$db = "ladywoodopsdbv300";
$protected = false;
$Levels = "single";
$Ctable = "attendance";
$Cfield = "attendanceDt";
$Calias = "";
$CfieldFunction = "month";
$Rtable = "employee";
$Rfield = "lastName";
$Ralias = "";
$IsNumeric = true;
$Gtable = "parttimedetail";
$Gcol = "hours";
$Gfunc = "sum";
$relationships = array("`employee`.`oid` = `attendance`.`employeeOid`", "`attendance`.`oid` = `parttimedetail`.`attendanceOid`");
$AllowRowsPagination = false;
$recordPerPage = 0;
$maxRecordPerPage = 1000;
$AllowColsPagination = true;
$columnPerPage = 14;
$maxColumns = 100;
$maintainance_email = "";
?>