<?php
require_once('../functions/functions.php');
global $db;

$sql = "SELECT horticultureproducestock.oid, produceTypeOid, CONCAT(produceName,' - ',brand,' - ', variety) AS fullProduceName, stockDate, qty 
FROM horticultureproducestock 
INNER JOIN horticultureproducetype ON horticultureproducetype.oid = horticultureproducestock.produceTypeOid ";

if(isset($_REQUEST['date']) ){
	$date = $_REQUEST['date'];
	$sql.= " WHERE stockDate = '$date'";
}



$rows = $db->query($sql);
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $db->trace);

$produceTypesObj =  $db->query("SELECT oid, CONCAT(produceName,' - ',brand,' - ', variety) AS fullProduceName FROM horticultureproducetype ORDER BY fullProduceName ASC");
$produceTypesList = '';
if($produceTypesObj){
	foreach($produceTypesObj as $value){
		$id = $value['oid'];
		$produceTypesList.="<option value='".$id."'>".$value['fullProduceName']."</option>";
	}
}

header("Content-type: text/xml");
echo('<?xml version="1.0" encoding="utf-8"?>'); 

echo '<rows id="0">';
echo  '	<head>
		<column width="75" type="dhxCalendar" align="middle" sort="str" >Stock Date</column>
		<column width="320" type="coro" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1" >Produce Name'.$produceTypesList.'</column>		
		<column width="60" type="ed" align="right" sort="str" >Quantity (grams)</column>
	</head>';
	
if($rows){
	foreach($rows as $row){
		echo ("<row id='".$row['oid']."'>");
		print("<cell><![CDATA[".date('M.d.Y', strtotime($row['stockDate']))."]]></cell>");
	    print("<cell><![CDATA[".$row['fullProduceName']."]]></cell>");
	    print("<cell><![CDATA[".$row['qty']."]]></cell>");	
		print("</row>");
	}
}
else{}
echo '</rows>';

?>