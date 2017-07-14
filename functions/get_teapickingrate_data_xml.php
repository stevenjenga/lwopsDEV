<?php
require_once('functions.php');
global $db;
global $logger;

$rows = $db->query("select * from  teapickingrate ");

header("Content-type: text/xml");
echo('<?xml version="1.0" encoding="utf-8"?>'); 

/* start output of data */
echo '<rows id="0">';
echo  '	<head>
        <column width="100" type="kenyaCurrency" align="left" sort="str" >Rate</column>
        <column width="100" type="dhxCalendar" align="left" sort="str">Effective Date</column>        
        <column width="100" type="ro" align="left" sort="str" >End Date</column>
    </head>';
	
if($rows){
	foreach($rows as $row){	
		if($row['endDt']!=NULL){
			$endDate = date('M.d.Y', strtotime($row['endDt']));
		}else{
			$endDate="";
		}
		
			
		echo ("<row id='".$row['oid']."'>");	
		print("<cell><![CDATA[".number_format($row['rate'],2)."]]></cell>");
		print("<cell><![CDATA[".date('M.d.Y', strtotime($row['startDt']))."]]></cell>");
		print("<cell><![CDATA[".$endDate."]]></cell>");
		print("</row>");
	}
}else{
}
echo '</rows>';

?>