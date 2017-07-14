<?php
//Untitled Report,01-Jan-2017 21:26:12
if (! defined("DIRECTACESS")) exit("No direct script access allowed"); 
$host='localhost';
$user='root';
$pass='';
$db_extension='mysqli';
$view='parttimepay_vw';
$db='ladywoodopsdb';
$datasource='sql';
$sql='select concat(`employee`.`firstName`," ",`employee`.`lastName`) AS `employeeName`,`employee`.`oid` AS `empOid`,`parttimedetail`.`hours` AS `hours`,`parttimedetail`.`workDescription` AS `workDescription`,`lineofbusiness`.`department` AS `department`,`salary`.`amount` AS `amount`,(`salary`.`amount` / 8) AS `PayRate`,(`parttimedetail`.`hours` * (`salary`.`amount` / 8)) AS `Pay` from ((((`parttimedetail` join `attendance` on((`attendance`.`oid` = `parttimedetail`.`attendanceOid`))) join `lineofbusiness` on((`lineofbusiness`.`oid` = `parttimedetail`.`lineOfBussinessOid`))) join `employee` on((`parttimedetail`.`employeeOid` = `employee`.`oid`))) join `salary` on((`salary`.`employeeOid` = `employee`.`oid`))) where (`parttimedetail`.`hours` > 0)';
$fields=array('employeeName','empOid','hours','workDescription','department','amount','PayRate','Pay');
$fields2=array('employeeName','empOid','hours','workDescription','department','amount','PayRate','Pay');
$labels=$labels = 'a:8:{s:12:"employeeName";s:12:"employeeName";s:6:"empOid";s:6:"empOid";s:5:"hours";s:5:"hours";s:15:"workDescription";s:15:"workDescription";s:10:"department";s:10:"department";s:6:"amount";s:6:"amount";s:7:"PayRate";s:7:"PayRate";s:3:"Pay";s:3:"Pay";}';;
$group_by=array('employeeName','department');
$sort_by=array(array('employeeName','0'),array('department','0'));
$records_per_page='25';
$layout='AlignLeft1';
$style_name='GreyScale';
$date_created='01-Jan-2017 21:26:12';
$title='';
$header='Part Time Pay';
$footer='';
$file_name='test1';
$chkSearch='';
$security='';
$sec_Username='';
$sec_pass='';
$members='';
$sec_table='';
$sec_Username_Field='';
$sec_pass_Field='';
$sec_pass_hash_type='';
$Forget_password='';
$sec_email='';
$is_mobile='';
$maintainance_email = '';
 ?>