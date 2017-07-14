<?php
require_once('../functions/functions.php');
global $db;
global $logger;

if(isset($_REQUEST['date']) ){
	$date=$_REQUEST['date'];	
}else{
	$date=date('Y-m-d');
}

//get data
$sql = "SELECT D1.oid, D1.expenseDate, D1.payee, D1.narration, D1.activityOid, D1.lineOfBusinessOid, 
ROUND(D1.amount,2) AS amount, D2.activity,D3.department, D1.categoryOid, expensecategory.description
FROM expenses D1 
INNER JOIN expenseactivity D2 ON(D2.oid=D1.activityOid) 
INNER JOIN lineOfBusiness D3 ON(D3.oid=D1.lineOfBusinessOid) 
INNER JOIN expensecategory ON expensecategory.oid = D1.categoryOid ";

if(isset($_REQUEST['date']) ){
	$sql .= "WHERE DATE(D1.expenseDate)='$date'";
}
$rows = $db->query($sql);
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME)."[sql1]", $db->trace);

// get LOB list
$lineofBusinessObj =  $db->query("select * from lineOfBusiness");
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME)."[sql2]", $db->trace);
$lineOfBusinessNameList = '';
if($lineofBusinessObj){
	foreach($lineofBusinessObj as $value){
		$id=$value["oid"];	
		$lineOfBusinessNameList.="<option value='".$id."'>".$value['department']."</option>";		
	}
}

//get expense Activity list
$activityObj=  $db->query("select * from expenseactivity");
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME)."[sql3]", $db->trace);
$expenseActivityList= '';
if($activityObj){
	foreach($activityObj as $value){
		$id=$value['oid'];
		$expenseActivityList.="<option value='".$id."'>".$value['activity']."</option>";
	}
}

//get expense Category list
$categoryObj=  $db->query("SELECT `oid`, `description` FROM `expensecategory` ORDER BY description");
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME)."[sql4]", $db->trace);
$expenseCategoryList= '';
if($categoryObj){
	foreach($categoryObj as $value){
		$id=$value['oid'];
		$expenseCategoryList.="<option value='".$id."'>".$value['description']."</option>";
	}
}

header("Content-type: text/xml");
echo('<?xml version="1.0" encoding="utf-8"?>'); 

/* start output of data */
echo '<rows id="0">';
echo  '	<head>
		<column width="120" type="dhxCalendar"  align="left" sort="str" >Expense Date</column>	
		<column width="120" type="ed" align="left" sort="str">Payee</column>
		<column width="150" type="ed" align="left" sort="str">Narration</column>
		<column width="125" type="coro"  text="" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1">Activity'.$expenseActivityList.'</column>
		<column width="200" type="coro"  text="" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1">Department'.$lineOfBusinessNameList.'</column>
		<column width="100" type="kenyaCurrency" align="right" sort="str">Amount</column>
		<column width="200" type="coro"  text="" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1">Category'.$expenseCategoryList.'</column>
        <column width="90" type="dbDeleteRowBtn" align="middle" sort="str">Delete?</column>
            
	</head>';
	
if($rows){
	foreach($rows as $row){
		
		/* create xml tag for grid's row */
		
		echo ("<row id='".$row['oid']."'>");
		print("<cell><![CDATA[".date('M.d.Y', strtotime($row['expenseDate']))."]]></cell>");
		print("<cell><![CDATA[".$row['payee']."]]></cell>");
		print("<cell><![CDATA[".$row['narration']."]]></cell>");
		print("<cell><![CDATA[".$row['activity']."]]></cell>");
		print("<cell><![CDATA[".$row['department']."]]></cell>");
		print("<cell><![CDATA[".$row['amount']."]]></cell>");
		print("<cell><![CDATA[".$row['description']."]]></cell>");
        print("<cell><![CDATA[".''."]]></cell>");
		print("</row>");
	}
}else{
}
echo '</rows>';

?>