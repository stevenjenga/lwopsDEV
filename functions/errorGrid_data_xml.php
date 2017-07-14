<?php
require_once('../functions/functions.php');
global $db;

header("Content-type: text/xml");
echo('<?xml version="1.0" encoding="utf-8"?>'); 

/* start output of data */
echo '<rows id="0">';
echo  '	<head>
			<column width="500" type="ro" align="left" sort="str" >MESSAGE</column>
		</head>';
echo ("<row id='".$row['oid']."'>");
print("<cell><![CDATA[".'$errorMsg'."]]></cell>");
print("</row>");
echo '</rows>';

?>