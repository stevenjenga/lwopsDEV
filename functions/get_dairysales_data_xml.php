<?php
require_once('../functions/functions.php');
global $db;

if(isset($_REQUEST['date']) ){
	$date=$_REQUEST['date'];	
}
else{
	$date=date('Y-m-d');
}

if(isset($_REQUEST['date']) ){
	$sql = "SELECT dairysales.oid, salesDt, customerOid, volume, ROUND(pricePerLiter,2) As pricePerLiter, businessName, storeNameNbr 
FROM dairysales 
INNER JOIN customer ON customer.oid = dairysales.customerOid
WHERE dairysales.salesDt = '$date' ";
}
else{
	$sql = "SELECT dairysales.oid, salesDt, customerOid, volume, ROUND(pricePerLiter,2) As pricePerLiter, businessName, storeNameNbr 
FROM dairysales 
INNER JOIN customer ON customer.oid = dairysales.customerOid";
}
$rows = $db->query($sql);
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $db->trace);

$customerObj=  $db->query("SELECT oid, businessName,storeNameNbr FROM customer ");
$createOptionBusinessName= '';
if($customerObj){
	foreach($customerObj as $value){ 
		$id=$value["oid"];
		$customerNm = $value["businessName"]." -".$value["storeNameNbr"];
		$createOptionBusinessName.="<option value='".$id."'>".$customerNm."</option>";
	}
}

header("Content-type: text/xml");
echo('<?xml version="1.0" encoding="utf-8"?>'); 

echo '<rows id="0">';
echo  '	<head>
		<column width="100" type="dhxCalendar" align="left" sort="str" >Sales Date</column>
		<column width="250" type="coro" text="some text" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1" >Business/Customer Name'.$createOptionBusinessName.'
		</column>	
		<column width="150" type="ed" align="right" sort="str">Volume (lts)</column>
		<column width="100" type="kenyaCurrency" align="right" sort="str">Price Per Liter</column>
	</head>';

	
if($rows){
	foreach($rows as $row){		
		echo ("<row id='".$row['oid']."'>");
		print("<cell><![CDATA[".date('M.d.Y', strtotime($row['salesDt']))."]]></cell>");
		$customerNm = $row["businessName"]." - ".$row["storeNameNbr"];
		print("<cell><![CDATA[".$customerNm."]]></cell>");
		print("<cell><![CDATA[".number_format($row['volume'],2)."]]></cell>");
	    print("<cell><![CDATA[".$row['pricePerLiter']."]]></cell>");
		print("</row>");
	}
}
echo '</rows>';

?>