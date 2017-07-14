<?php
require_once('functions.php');
include_once 'get_picked_data_grid.php';
global $db;
global $logger;
global $errorLogger;;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    $logger->debug("GET", $_GET);
    loadTeaPickData(true);
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorGrid("<b>" . $e->getMessage() . " [" . $e->getLine() . "]</b>");
}
