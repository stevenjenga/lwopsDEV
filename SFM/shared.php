<?php
/**
 *   PHP MYSQL Form Maker 
 *   version 3.1.0
 *   All copyrights are preserved to StarSoft
 */
ob_start();
define('IN_DEV', TRUE);
error_reporting(0);
require_once 'helpers/safeValue.php';
function decode($encoded) {
    return unserialize(base64_decode($encoded));
}
?>
