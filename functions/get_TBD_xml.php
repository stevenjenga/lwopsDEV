<?php
require_once('functions.php');
global $db;
global $logger;

$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $db->trace);
$msg = filter_input(INPUT_GET, 'msg', FILTER_SANITIZE_SPECIAL_CHARS);
if (strlen($msg) > 0){
    loadErrorGrid("<b>".$msg."</b>");
}
else {
    loadErrorGrid("<b>Under construction. Work in prpogress....</b>");
}

?>