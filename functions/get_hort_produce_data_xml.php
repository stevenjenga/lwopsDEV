<?php
require_once('../functions/functions.php');
global $db;

if(isset($_REQUEST['date']) ){
$date=$_REQUEST['date'];	
}else{
	$date=date('Y-m-d');
}

$sql = "SELECT horticultureproducetype.oid AS hOid, horticultureproduceparent.oid AS pOid, horticultureproduceparent.name AS produceName, variety, brand, directPlanting, nurseryDuration, avgMaturityDays, harvestDurationDays FROM horticultureproducetype INNER JOIN horticultureproduceparent on horticultureproduceparent.oid = horticultureproducetype.parent_oid
ORDER BY produceName";
$rows = $db->query($sql);
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $db->trace);

$produceParentObj =  $db->query("SELECT name FROM horticultureproduceparent ORDER BY name");
$produceParentNameList='';
if($produceParentObj){
	foreach($produceParentObj as $value){
		$id = $value['name'];
		$produceParentNameList.="<option value='".$id."'>".$value['name']."</option>";
	}
}


$produceBrandObj =  $db->query("SELECT name FROM horticultureproducebrand ORDER BY name");
$produceBrandNameList='';
if($produceBrandObj){
	foreach($produceBrandObj as $value){
		$id = $value['name'];
		$produceBrandNameList.="<option value='".$id."'>".$value['name']."</option>";
	}
}

header("Content-type: text/xml");
echo('<?xml version="1.0" encoding="utf-8"?>'); 

/* start output of data */
echo '<rows id="0">';
echo  '	<head>
		<column width="120" type="coro" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1" >Brand'.$produceParentNameList.'</column>
		<column width="120" type="ed" align="left" sort="str">Variety</column>
		<column width="120" type="coro" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1" >Brand'.$produceBrandNameList.'</column>		
		<column width="60" type="ed" align="middle" sort="str" >Direct Plant?</column>
		<column width="60" type="ed" align="right" sort="str">Nursery Duration (Days)</column>
		<column width="60" type="ed" align="right" sort="str">Days to Maturity (Days)</column>
		<column width="60" type="ed" align="right" sort="str">Harvest Duration (Days)</column>
		<column width="100" align="middle" type="plantProduceBtn" sort="str">New Crop</column>	
		<column width="0" align="middle" type="ro" sort="str">hOid</column>		
	</head>';
	
if($rows){
	foreach($rows as $row){
		echo ("<row id='".$row['hOid']."'>");
		print("<cell><![CDATA[".$row['produceName']."]]></cell>");
	    print("<cell><![CDATA[".$row['variety']."]]></cell>");
	    print("<cell><![CDATA[".$row['brand']."]]></cell>");		
		print("<cell><![CDATA[".$row['directPlanting']."]]></cell>");
	    print("<cell><![CDATA[".$row['nurseryDuration']."]]></cell>");
	    print("<cell><![CDATA[".$row['avgMaturityDays']."]]></cell>");
		print("<cell><![CDATA[".$row['harvestDurationDays']."]]></cell>");	
		print("<cell><![CDATA[".$row['hOid']."]]></cell>");
		print("<cell><![CDATA[".$row['pOid']."]]></cell>");		
		print("</row>");
	}
}
else{}
echo '</rows>';

?>