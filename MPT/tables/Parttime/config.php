<?php
if (! defined("DIRECTACESS")) exit("No direct script access allowed"); 
$host = "localhost";
$user = "root";
$pass = "";
$db = "ladywoodopsdbv300";
$protected = false;
$Levels = "single";
$Ctable = "attendance";
$Cfield = "DATE(attendanceDt)";
$Calias = "";
$CfieldFunction = "";
$Rtable = "employee";
$Rfield = "lastName";
$Ralias = "";
$IsNumeric = true;
$Gtable = "parttimedetail";
$Gcol = "hours";
$Gfunc = "sum";
$relationships = array("`employee`.`oid` = `attendance`.`employeeOid`", "`attendance`.`oid` = `parttimedetail`.`attendanceOid`");
$AllowRowsPagination = true;
$recordPerPage = 50;
$maxRecordPerPage = 1000;
$AllowColsPagination = false;
$columnPerPage = 0;
$maxColumns = 200;
$maintainance_email = "";
?>