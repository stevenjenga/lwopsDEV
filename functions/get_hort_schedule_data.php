<?php
require_once('../functions/functions.php');
global $db;
global $logger;
global $errorLogger;
include ('../dhtmlxGantt_v4.1.0/codebase/connector/db_mysqli.php');
include ('../dhtmlxGantt_v4.1.0/codebase/connector/gantt_connector.php');

$dropSql = "DROP TABLE tempScheduleTable";
$rows = $db->query($dropSql);
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $db->trace);

$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME)."[GET]", $_GET);
$sql = "CREATE TABLE tempScheduleTable AS SELECT * FROM hortSchedule_vw ";
if(isset($_GET['ptOid'])){
	$produceTypeOid = $_GET['ptOid'];
	$sql.= "WHERE produceTypeOid = $produceTypeOid";
}
$rows = $db->query($sql);
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $db->trace);
			
$dbtype = 'MySQL';
$res = mysql_connect('localhost', 'root', '');
mysql_select_db('ladywoodopsdb');
$gantt = new JSONGanttConnector($res, $dbtype);
$gantt->mix("open", 1);

$gantt->render_table("tempScheduleTable","oid","start_date,duration,bedName,progress","");
$gantt->render_links("gantt_links", "id", "source,target,type");
// $gantt->render_table("gantt_tasks","id","start_date,duration,text,progress,sortorder,parent","");
?>