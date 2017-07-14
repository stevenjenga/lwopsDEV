<?php
require_once('../functions/functions.php');
global $db;
global $logger;
global $errorLogger;

if(isset($_GET['date'])){
	$date= $_GET['date'];
	$convertedDate= date('Y-m-d', strtotime($date));
	$sql = "SELECT D1.oid, prodDate, name, amVolume, mdVolume, pmVolume 
			FROM dairyproduction D1 
			INNER JOIN dairycowname D2 ON (D2.oid=D1.DairyCowNameOid)
			WHERE prodDate = '$convertedDate' 
			ORDER BY name";
}
else {
	$sql = "SELECT D1.oid, prodDate, name, amVolume, mdVolume, pmVolume 
			FROM dairyproduction D1 
			INNER JOIN dairycowname D2 ON (D2.oid=D1.DairyCowNameOid) ORDER BY prodDate, name";
}
$rows = $db->query($sql);
$logger->debug('get_dairyproduction_data_xml', $db->trace);

// build cow names list
$dairycownameObj=  $db->query("SELECT * FROM dairycowname");
$cowNamesList= '';
if($dairycownameObj){
	foreach($dairycownameObj as $value){
		$id=$value["oid"];
		$businessName=$value["name"];
		$cowNamesList.="<option value='".$id."'>".$value['name']."</option>";
	}
}

header("Content-type: text/xml");
echo('<?xml version="1.0" encoding="utf-8"?>'); 

/* start output of data */
echo '<rows id="0">';
echo  '	<head>
		<column width="120" type="dhxCalendar" align="left" sort="str">Production Date</column>
		<column width="120*" type="coro"  text="some text" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1" >Name'.$cowNamesList.'</column>
		<column width="100" type="ed" align="right" sort="str">Morning</column>
		<column width="100" type="ed" align="right" sort="str">Midday</column>
		<column width="100" type="ed" align="right" sort="str">Evening</column>
	</head>';
	
if($rows){
	foreach($rows as $row){
		echo ("<row id='".$row['oid']."'>");
		print("<cell><![CDATA[".date('M.d.Y', strtotime($row['prodDate']))."]]></cell>");
		print("<cell><![CDATA[".$row['name']."]]></cell>");
		print("<cell><![CDATA[".$row['amVolume']."]]></cell>");
		print("<cell><![CDATA[".$row['mdVolume']."]]></cell>");
		print("<cell><![CDATA[".$row['pmVolume']."]]></cell>");
		print("</row>");
	}
}
echo '</rows>';

?>