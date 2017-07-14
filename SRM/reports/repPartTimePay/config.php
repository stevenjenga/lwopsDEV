<?php
//Part Time Pay,01-Jan-2017 18:57:22
if (! defined("DIRECTACESS")) exit("No direct script access allowed"); 
$host='localhost';
$user='root';
$pass='';
$db='ladywoodopsdb';
$db_extension='mysqli';
$datasource='table';
$table=array('employee','parttimedetail','salary','salarytype');
$tables_filters='';
$relationships=array('`employee`.`oid` = `parttimedetail`.`employeeOid`','`employee`.`oid` = `salary`.`employeeOid`','`salarytype`.`type` = `salary`.`employeetype`');
$fields=array('employee.firstName','employee.middleInitial','employee.lastName','parttimedetail.hours','parttimedetail.workDescription','parttimedetail.lineOfBussinessOid','salary.amount','salary.salarytype');
$fields2=array('employee.firstName','employee.middleInitial','employee.lastName','parttimedetail.hours','parttimedetail.workDescription','parttimedetail.lineOfBussinessOid','salary.amount','salary.salarytype');
$labels=$labels = 'a:8:{s:18:"employee.firstName";s:9:"firstName";s:22:"employee.middleInitial";s:13:"middleInitial";s:17:"employee.lastName";s:8:"lastName";s:20:"parttimedetail.hours";s:5:"hours";s:30:"parttimedetail.workDescription";s:15:"workDescription";s:33:"parttimedetail.lineOfBussinessOid";s:18:"lineOfBussinessOid";s:13:"salary.amount";s:6:"amount";s:17:"salary.salarytype";s:10:"salarytype";}';;
$group_by=array('employee.firstName','employee.lastName','parttimedetail.lineOfBussinessOid');
$sort_by=array();
$records_per_page='25';
$layout='Stepped';
$style_name='GreyScale';
$date_created='01-Jan-2017 18:57:22';
$title='Part Time Pay';
$header='Header';
$footer='Footer';
$file_name='PartTimePay';
$chkSearch='Yes';
$security='';
$members='';
$sec_table='';
$sec_Username_Field='';
$sec_pass_Field='';
$sec_pass_hash_type='';
$Forget_password='';
$sec_email='';
$sec_Username='';
$sec_pass='';
$is_mobile='';
$maintainance_email = '';
 ?>