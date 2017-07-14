<?php
	error_reporting(E_ALL ^ E_NOTICE);
	
  	header("Content-type:text/xml");
	require_once('../functions/functions.php');
	global $db;
	global $logger;
	print("<?xml version=\"1.0\"?>");

	if (!isset($_REQUEST["pos"])) $_REQUEST["pos"]=0;

	$sql = "SELECT `oid`, `description` FROM `expensecategory` ORDER BY description";

	print("<complete>");
	
	$categoryObj =  $db->query($sql);
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME)."[***]", $db->trace);
	if($categoryObj){
		foreach($categoryObj as $row){
			print("<option value=\"".$row["oid"]."\">");
			
			print($row["description"]);
			print("</option>");
		}
	}
	print("</complete>");

?>
