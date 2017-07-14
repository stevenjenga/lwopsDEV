<?php

require_once 'gridExcelGenerator.php';
require_once 'gridExcelWrapper.php';
require_once('../../../logger-php-master/src/Logger.php');
use SurrealCristian\Logger;
$logger = new Logger('NAME', "excelGenerator.log", 'debug');

$debug = false;
$error_handler = set_error_handler("PDFErrorHandler");

if (get_magic_quotes_gpc()) {
	$xmlString = stripslashes($_POST['grid_xml']);
} else {
	$xmlString = $_POST['grid_xml'];
}
$xmlString = urldecode($xmlString);
if ($debug == true) {
	error_log($xmlString, 3, 'debug_'.date("Y_m_d__H_i_s").'.xml');
}

$xml = simplexml_load_string($xmlString);
//--------------------------------------------------------------------------8<---------my code
// Get URL params
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['REQUEST'=>$_REQUEST['filename']]);
if(isset($_REQUEST['filename']) ){$excel = new gridExcelGenerator($_REQUEST['filename']);$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ExcelFileName'=>$excel->fileName]);}
else {$excel = new gridExcelGenerator('grid');}


//--------------------------------------------------------------------------8<---------my code
$excel->printGrid($xml);

function PDFErrorHandler ($errno, $errstr, $errfile, $errline) {
	global $xmlString;
	if ($errno < 1024) {
		error_log($xmlString, 3, 'error_report_'.date("Y_m_d__H_i_s").'.xml');
//		exit(1);
	}
}

?>