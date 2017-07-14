<?php
require_once('functions.php');
require_once('functions_hort.php');

$mode = $_GET["!nativeeditor_status"];
$rowId = $_GET["gr_id"];

header("Content-type: text/xml");
echo('<?xml version="1.0" encoding="iso-8859-1"?>');

switch ($mode) {
    case "inserted":
        logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
        $action = add_produceDetail();
        logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
        break;
    case "deleted":
        logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
        $action = delete_produceDetail($rowId);
        logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
        break;
    default:
        logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
        $action = update_produceDetail($rowId);
        logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
        break;
}
/* output update results */
echo "<data>";
echo "<action type='" . $action[0] . "' sid='" . $action[1] . "' tid='" . $action[2] . "'>" . $action[3] . "</action>";
echo "</data>";
?>