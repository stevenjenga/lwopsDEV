<?php
/**
 *   PHP MYSQL Form Maker 
 *   version 3.1.0
 *   All copyrights are preserved to StarSoft
 */
ini_set('session.use_only_cookies', 1);
session_start();
session_regenerate_id();
if (!defined('DIRECTACESS'))
    exit('No direct script access allowed');
require_once 'cl_login.php';
$login = new Login();
if ($login->is_public_form() == false)
    $login->headerTo(false);

function createSalt($userinfo) {
    $string = sha1(substr($userinfo, intval(strlen($userinfo) / 2), strlen($userinfo) - 1));
    return substr($string, 0, 3);
}

$_GET = remove_unexpected_superglobals($_GET, array("index", "p", 'msg'));
//$_SESSION = remove_unexpected_superglobals_by_inKey($_SESSION, array('selected_style', 'username', 'password', 'column_for_search', 
//'search_keyword', '__searchType', 'orderBy', 'ordinaryType'));
$_POST = remove_unexpected_superglobals_by_inKey($_POST, array('myform', 'column_for_search', 'search_keyword', 'selected_style', 'searchBtn', 'showAllBtn', 'save',
    'number', 'insert', 'update', 'delete', 'cancel', 'first', 'orderBy', 'ordinaryType', 'deletebtn', 'prev', 'before', 'next', 'last',
    'delete_details', 'insert_details', 'update_details', 'deletebtn_details', 'save_details', 'cancel_details', 'first_details',
    'prev_details', 'next_details', 'last_details', '09_sfm_x8_', 'username', 'password'));
//$_COOKIE = array();


foreach ($_POST as $key => $val) {
    $_POST[str_replace('09_sfm_x8_', 'form_', $key)] = $val;
    if (strstr($key, '09_sfm_x8_'))
        unset($_POST[$key]);
}
// check  if user log in or not
$user_login = false;

$allow_security = unserialize(base64_decode($form_allow_security));
$fileName = unserialize(base64_decode($file_name));
$form_prefix = str_replace(' ', '', $fileName);

if ($allow_security === 1 && isset($form_username) && isset($form_password)) {
    $username = unserialize(base64_decode($form_username));
    $password = unserialize(base64_decode($form_password));
    if (isset($_SESSION[$form_prefix . 'username']) && isset($_SESSION[$form_prefix . 'password'])) {
        $session_username = $_SESSION[$form_prefix . 'username'];
        $session_password = $_SESSION[$form_prefix . 'password'];
        if ($session_username === $username && $session_password === $password)
            $user_login = true;
    }
}

function remove_unexpected_superglobals($superGlobal, $allowedKeys) {
    // this function removes any Unexpected keys from super globals 
    foreach ($superGlobal as $key => $val) {
        if (!in_array($key, $allowedKeys))
            unset($superGlobal[$key]);
    }
    return $superGlobal;
}

// $_SESSION, $_POST remove unexpected superglobals
function remove_unexpected_superglobals_by_inKey($superGlobal, $inKey) {
    foreach ($superGlobal as $key => $value) {
        $acceptIt = false;
        foreach ($inKey as $k => $val) {
            if (strstr($key, $val) !== false) {
                $acceptIt = true;
                break;
            }
        }
        if (!$acceptIt)
            unset($superGlobal[$key]);
    }
    return $superGlobal;
}

?>