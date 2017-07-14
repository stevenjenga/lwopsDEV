<?php
/**
 *   PHP MYSQL Form Maker 
 *   version 3.1.0
 *   All copyrights are preserved to StarSoft
 */
define("DIRECTACESS", "true");
require_once("check.php");
require 'lib.php';
require_once 'helpers/safeValue.php';
if (isset($_POST['remove_details']) && $_POST['remove_details'] == 'true') {
    unset($_SESSION['sfm_f314_details_table']);
    unset($_SESSION['sfm_f314_details_column']);
    unset($_SESSION['sfm_f314_details_unique']);
    echo "true";
} else if (isset($_POST['get_columns'])) {
    $table = $_POST['get_columns'];

    $result = $dbHandler->query("show columns from `$table`", 'ASSOC');
    $arr = array();
    foreach ($result as $key => $row) {
        $arr[] = $row['Field'];
    }
    echo json_encode($arr);
} else if (isset($_POST['table']) && isset($_POST['field']) && isset($_POST['pri'])) {
    $_POST = clean_array($_POST);
    $_SESSION['sfm_f314_details_table'] = $_POST['table'];
    $_SESSION['sfm_f314_details_column'] = $_POST['field'];
    $_SESSION['sfm_f314_details_unique'] = $_POST['pri'];
    echo "true";
} else {
    echo "false";
}
?>
