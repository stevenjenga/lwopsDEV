<?php
require_once('../functions/functions.php');
global $db;

if(isset($_REQUEST['date']) ){
$date=$_REQUEST['date'];	
}else{
	$date=date('Y-m-d');
}

$sql = "select horticultureproducetype.oid AS pOid, horticultureproducebed.oid AS bOid, horticultureproducebed.bedOid, horticultureproduceparent.name AS produceNm, horticultureproducetype.brand, horticultureproducetype.variety, horticultureproducebed.plantedDt, horticultureproducebed.harvestDt, horticultureproducebed.endDt, (to_days(horticultureproducebed.endDt) - to_days(horticultureproducebed.plantedDt)) AS duration, ROUND(((to_days( curdate() ) - to_days(horticultureproducebed.endDt)) / (to_days(horticultureproducebed.plantedDt) - to_days(horticultureproducebed.endDt)))*100,0) AS progress, to_days(horticultureproducebed.endDt) - to_days(curdate()) AS daysToHarvest, horticultureproducetype.harvestDurationDays 
from horticultureproducebed 
inner join horticultureproducetype on horticultureproducetype.oid = horticultureproducebed.produceTypeOid 
inner join horticultureproduceparent on horticultureproduceparent.oid = horticultureproducetype.parent_oid 
order by produceNm, brand, variety";
$rows = $db->query($sql);
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $db->trace);

$bedNbrObj =  $db->query("SELECT oid, identifier, type FROM horticulturebed ORDER BY identifier");
$bedNbrList = '';
if($bedNbrObj){
	foreach($bedNbrObj as $value){
		$id = $value['oid'];
		$bedNbr = $value['identifier']."-".$value['type'];
		$bedNbrList.="<option value='".$id."'>".$bedNbr."</option>";
	}
}

header("Content-type: text/xml");
echo('<?xml version="1.0" encoding="utf-8"?>'); 

/* start output of data */
echo '<rows id="0">';
echo  '	<head>
		<column width="120" type="ro" align="left" sort="str">Produce</column>
		<column width="50" type="coro" filter="true" align="middle" editable="false" auto="true"  sort="str" xmlcontent="1" >Bed Nbr'.$bedNbrList.'</column>
		<column width="125" type="ro" align="left" sort="str">Brand</column>
		<column width="125" type="ro" align="left" sort="str">Variety</column>		
		<column width="80" type="ro" align="middle" sort="str">Planted</column>
		<column width="60" type="ro" align="middle" sort="str">Growth Duration (Days)</column>
		<column width="60" type="ro" align="right" sort="str">Progress</column>
		<column width="60" type="ro" align="right" sort="str">Days to Maturity (Days)</column>
		<column width="80" type="ro" align="right" sort="str">Harvest Date</column>
		<column width="60" type="ro" align="right" sort="str">Harvest Duration (Days)</column>
		<column width="100" align="middle" type="viewCropGanttBtn" sort="str">View Gantt</column>
		<column width="100" align="middle" type="plantNewProduceBtn" sort="str">Plant New</column>	
		<column width="0" align="middle" type="ro" sort="str">bOid</column>
		<column width="0" align="middle" type="ro" sort="str">pOid</column>
	</head>';
	
if($rows){
	foreach($rows as $row){
		echo ("<row id='".$row['bOid']."'>");
		print("<cell><![CDATA[".$row['produceNm']."]]></cell>");
	    print("<cell><![CDATA[".$bedNbr."]]></cell>");
	    print("<cell><![CDATA[".$row['brand']."]]></cell>");
		print("<cell><![CDATA[".$row['variety']."]]></cell>");
		print("<cell><![CDATA[".date('M.d.Y', strtotime($row['plantedDt']))."]]></cell>");
	    print("<cell><![CDATA[".$row['duration']."]]></cell>");
		$progress = $row["progress"]."%";
		print("<cell><![CDATA[".$progress."]]></cell>");
	    print("<cell><![CDATA[".$row['daysToHarvest']."]]></cell>");
		print("<cell><![CDATA[".date('M.d.Y', strtotime($row['harvestDt']))."]]></cell>");		
		print("<cell><![CDATA[".$row['harvestDurationDays']."]]></cell>");
		print("<cell><![CDATA[".''."]]></cell>");
		print("<cell><![CDATA[".''."]]></cell>");		
		print("<cell><![CDATA[".$row['bOid']."]]></cell>");
		print("<cell><![CDATA[".$row['pOid']."]]></cell>");	
		print("</row>");
	}
}
else{}
echo '</rows>';

?>