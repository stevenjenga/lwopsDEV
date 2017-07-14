<?php
/**
 *   PHP MYSQL Form Maker 
 *   version 3.1.0
 *   All copyrights are preserved to StarSoft
 */
error_reporting(E_ERROR | E_PARSE);
require_once '../../helpers/DatabaseHandler.php';
require_once '../../helpers/safeValue.php';
if (!defined('DIRECTACESS'))
    exit('No direct script access allowed');
if (isset($_GET['index']))
    $_GET['index'] = intval(clean_input($_GET['index']));
if (isset($_GET['p']))
    $_GET['p'] = intval(clean_input($_GET['p']));
if (isset($_GET['msg']))
    $_GET['msg'] = clean_input($_GET['msg']);

$extension = (isset($extension)) ? $extension : '';

$allow_notification = decode($allow_notification);
$notification_email = decode($notification_email);
$notification_insert = decode($notification_insert);
$notification_update = decode($notification_update);
$notification_delete = decode($notification_delete);
$notification_search = decode($notification_search);

// Use this function to send notification by mail
function send_notification($url, $userName, $action, $result, $result_not_valid_reason = '', $data = '', $key = '', $numOfRows = 0) {
    global $allow_notification, $notification_email, $form_prefix;
    if ($allow_notification == 1) {
        if ($userName == '')
            $userName = 'Some visitor';
        else
            $userName = "Username: $userName";
        $ip = $_SERVER['REMOTE_ADDR'];
        $datetime = date("d-M-Y H:i:s") . ' - ' . date_default_timezone_get();
        // $action = Insert/Update/delete/search;
        if ($result == 'success' && $action != 'search')
            $result = "succeed $action, It's return " . $numOfRows . " records";
        else if ($result == 'success' && $action == 'search')
            $result = "succeed $action.";
        else if ($result == 'not_valid')
            $result = "Failed $action, Data wasn't accepted because $result_not_valid_reason";
        else if ($result == 'failed')
            $result = 'Database error';
        $_data = '';
        if ($action == 'insert' || $action == 'update')
            $_data = "- Submitted data:\r\n";
        if ($action == 'delete')
            $_data = "- Primary key of deleted records ($numOfRows records):\r\n";
        if ($action == 'search')
            $_data = "- Search data: \r\n";
        if (is_array($data)) {
            $i = 0;
            foreach ($data as $k => $val) {
                if ($i == count($key))
                    $i = 0;
                $_data .= "	" . $key[$k] . ": " . $val . "\r\n";
                $i++;
            }
        }else {
            $_data .= $data;
        }
        if ($_data != '')
            $data = $_data;
        $msg = "
- Form URL: $url
\r\n
- $userName 
\r\n
- IP: $ip
\r\n
- Date/Time: $datetime
\r\n
- Action: $action
\r\n
* Results: $result
\r\n
$data
";
        if (isset($notification_email))
            @mail($notification_email, "Smart Report Maker Notifications - " . $form_prefix . " - " . $action, $msg);
    }
}

function get_user_inputs($desc, $i = false, $last_i = false) {
    $user_input_array = array();
    $user_input_array[0] = array();
    $user_input_array[1] = array();
    if ($i == false) {
        $_prefix = 'form_';
        foreach ($desc as $key => $val) {
            $prefix = $_prefix . $key;
            if (isset($_POST[$prefix])) {
                $user_input_array[0][] = $_POST[$prefix];
                $user_input_array[1][] = $key;
            }
        }
    } else {
        for ($i; $i <= $last_i; $i++) {
            $_prefix = $i . '_form_';
            foreach ($desc as $key => $val) {
                $prefix = $_prefix . $key;
                if (isset($_POST[$prefix])) {
                    $user_input_array[0][] = $_POST[$prefix];
                    $user_input_array[1][] = $key;
                }
            }
        }
    }
    return $user_input_array;
}

/* --------------------- Database handler functions ----------------------------- */
/*
 * connect()
 * query()
 * command()
 * close_connection()
 */
$dbHandler = null;

function connect() {
    global $host, $user, $pass, $db, $dbHandler, $extension;
    logging('############################ Start connect function ############################');
    $dbHandler = new DatabaseHandler(decode($host), decode($user), decode($pass), decode($db), true, $extension);
    if (!$dbHandler || $dbHandler->is_connection_failed()) {
        logging('## Connection failed, check host, username, password and Database');
        die("<center><B>Couldn't connect to MySQL</B></center>");
    }
    logging('## Connection success');
    logging('############################ End connect function ############################' . "\r\n");
}

function query($sql, $type = "NUM", $params = array(), $paramsType = '', $log = '') {
    global $dbHandler;
    logging('############################ Start query function ############################');
    if ($log != '')
        logging('## Log ## ' . $log);
    $result = $dbHandler->query($sql, $type, $params, $paramsType);
    if ($result !== false)
        logging('## Query success ## ');
    else
        logging('## Query failed ## ');
    logging('############################ End query function ############################' . "\r\n");
    return $result;
}

function command($sql, $params = array(), $paramsType = '', $log = '') {
    global $dbHandler;
    logging('############################ Start command function ############################');
    if ($log != '')
        logging('## Log ## ' . $log);
    $result = $dbHandler->command($sql, $params, $paramsType);
    if ($result !== false)
        logging('## Command success ## ');
    else
        logging('## Command failed ## ');
    logging('############################ End command function ############################' . "\r\n");
    return $result;
}

function close_connection() {
    global $dbHandler;
    logging('############################ Start close_connection function ############################');
    $dbHandler->close_connection();
    logging('## Connection closed ## ');
    logging('############################ End close_connection function ############################' . "\r\n");
}

/* ------------------------------------------------------------------------------------------------------------------------- */

/* security */

function secure_var($var, $allowSingleQoute = false) {
    global $dbHandler;
    // this function is used to secure any search parameters from both XSS and Sql injection
    logging('############################ Start secure_var function ############################');
    logging('## Input for securing ## ' . $var);
    $var = trim(clean_input($var, $allowSingleQoute));
    $var = $dbHandler->sanitize_values($var);
    logging('## Secured input ## ' . $var);
    logging('############################ End secure_var function ############################' . "\r\n");
    return $var;
}

function decode($encoded) {
    return unserialize(base64_decode($encoded));
}

/* ------------------------------------------------------------------------------------------------------------------------- */

/* search */
$__s_sp = '';
$operator = '=';
$search = '';
$__search = '';
$__searchValue = array();
$__searchType = '';

function search($arrayOfLabels) {
    global $__s_sp, $operator, $search, $__search, $__searchValue, $__searchType, $form_prefix, $notification_search, $url, $login_username;
    // preparing
    if (isset($_POST['searchBtn']) && !empty($_POST['column_for_search']) && !empty($_POST['search_keyword'])) {
        logging('############################ Start search function ############################');
        $column4Search = $_POST['column_for_search'];
        $searchKeyword = $_POST['search_keyword'];
        logging('## search before validation ## ' . $searchKeyword);
        if (is_clean($searchKeyword, false, false)) {
            $searchKeyword = secure_var($searchKeyword, true);
            logging('## search after validation ## ' . $searchKeyword);

            $_SESSION[$form_prefix . 'column_for_search'] = $column4Search;

            $_SESSION[$form_prefix . 'search_keyword'] = "'%" . $searchKeyword . "%'";
            $operator = 'LIKE';
            $_SESSION[$form_prefix . '__searchType'] = 's';

            logging('## search done.');
            if ($notification_search == 1)
                send_notification($url, $login_username, 'search', 'success', '', $column4Search . ' contain/equal ' . $searchKeyword);
            header("Location: index.php");
        }else {
            if ($notification_search == 1)
                send_notification($url, $login_username, 'search', 'not_valid', "you mustn't use special characters for security reason.", $column4Search . ' contain/equal ' . $searchKeyword);
            unset($_SESSION[$form_prefix . 'column_for_search'], $_SESSION[$form_prefix . 'search_keyword']);
            $__s_sp = '!SpecialCharacters#';
            logging('## search refused.');
        }
        logging('############################ End search function ############################' . "\r\n");
    } else {
        if (isset($_POST['searchBtn']) && isset($_POST['search_keyword']) && empty($_POST['search_keyword'])) {
            if ($notification_search == 1)
                send_notification($url, $login_username, 'search', 'not_valid', "Search keyword can't be empty.", $column4Search . ' contain/equal ' . $searchKeyword);

            $__s_sp = '!Empty';
            logging('## search empty.');
        }
    }
    if (isset($_POST['showAllBtn'])) {
        unset($_SESSION[$form_prefix . 'column_for_search'], $_SESSION[$form_prefix . 'search_keyword']);
        header("Location: index.php");
    }

    // execute
    if (isset($_SESSION[$form_prefix . 'search_keyword'])) {
        $operator = 'LIKE';
        if (isset($arrayOfLabels[$_SESSION[$form_prefix . 'column_for_search']])) {
            $__search = " WHERE `" . clean_input($arrayOfLabels[$_SESSION[$form_prefix . 'column_for_search']]) . "` $operator ?";
            $__searchValue = array(
                        /* (!is_numeric($_SESSION[ $form_prefix . 'search_keyword']))
                          ?
                          clean_input(substr($_SESSION[ $form_prefix . 'search_keyword'], 1, -1), true)
                          :
                          clean_input($_SESSION[ $form_prefix . 'search_keyword'], true) */
                        clean_input(substr($_SESSION[$form_prefix . 'search_keyword'], 1, -1), true)
            );
            $__searchType = $_SESSION[$form_prefix . '__searchType'];
            $search = " WHERE `" . clean_input($arrayOfLabels[$_SESSION[$form_prefix . 'column_for_search']]) . "` $operator " . clean_input($_SESSION[$form_prefix . 'search_keyword'], true) . " ";
        } else {
            if ($notification_search == 1)
                send_notification($url, $login_username, 'search', 'not_valid', "Label name doesn't exists or not secure.", $column4Search . ' contain/equal ' . $searchKeyword);

            $__s_sp = '!labelExists';
            logging('## search Label doesn\'t exists.');
        }

        // var_dump($search);
    }
}

/* ------------------------------------------------------------------------------------------------------------------------- */

/* validation system before insert or update */
$__msg = array();
$error = false;

function __set__msg($str) {
    global $__msg;
    if (!in_array($str, $__msg))
        $__msg[] = $str;
}

$not_valid_reason = "\r\n";
$not_valid_num = 1;

function __logging__error__msg($key, $prefix, $str) {
    global $not_valid_reason, $not_valid_num;
    if ($not_valid_reason == '')
        $not_valid_reason .= $str;
    else {
        if (strstr($not_valid_reason, $str) == false)
            $not_valid_reason .= "	($not_valid_num) " . $str . "\r\n";
    }
    logging('## ' . $key . ' ## ' . $_POST[$prefix] . ' ## error ## ' . $str);
    $not_valid_num++;
}

function validate_inputs($desc, $i = false) {
    global $error;
    logging('############################ Start validate_inputs function ############################');
    if ($i == false)
        $_prefix = 'form_';
    else
        $_prefix = $i . '_form_';

    foreach ($desc as $key => $val) {
        $prefix = $_prefix . $key;
        if (isset($_POST[$prefix])) {
            if ($_POST[$prefix] != '') {
                $post[0] = $_POST[$prefix]; // for date
                $post[1] = $_POST[$prefix]; // for time
                if (strpos($val['Type'], 'datetime') !== false)
                    $post = explode(' ', $_POST[$prefix]);
                if (strpos($val['Type'], 'time') !== false) {
                    $time_arr = explode(':', $post[1]);
                    foreach ($time_arr as $k => $v)
                        $time_arr[$k] = intval($v);
                    if (count($time_arr) != 3 && ($time_arr[0] > 24 || $time_arr[0] < 0) || ($time_arr[1] > 60 || $time_arr[1] < 0) || ($time_arr[2] > 60 || $time_arr[2] < 0)) {
                        $error = true;
                        __set__msg($val['validation']['msg']);
                        __logging__error__msg($key, $prefix, 'Invalid time');
                    }
                }
                if (strpos($val['Type'], 'date') !== false) {
                    $checkdate = explode('-', $post[0]);
                    foreach ($checkdate as $k => $v)
                        $checkdate[$k] = intval($v);
                    if (count($checkdate) != 3 && checkdate($checkdate[1], $checkdate[2], $checkdate[0]) == false) {
                        $error = true;
                        __set__msg($val['validation']['msg']);
                        __logging__error__msg($key, $prefix, 'Invalid date');
                    }

                    $date_arr = array_reverse($checkdate);
                    if (count($date_arr) == 3)
                        $date = mktime(0, 0, 0, $date_arr[0], $date_arr[1], $date_arr[2]);
                    else {
                        $error = true;
                        __set__msg($val['validation']['msg']);
                        __logging__error__msg($key, $prefix, 'Invalid date');
                    }

                    if ($val['validation']['from'] != '') {
                        $from_arr = explode('/', $val['validation']['from']);
                        foreach ($from_arr as $k => $v)
                            $from_arr[$k] = intval($v);
                        if (count($from_arr) == 3) {
                            $from_date = mktime(0, 0, 0, $from_arr[1], $from_arr[0], $from_arr[2]);
                            if ($date < $from_date) {
                                $error = true;
                                __set__msg($val['validation']['msg']);
                                __logging__error__msg($key, $prefix, 'Out of range');
                            }
                        } else {
                            $error = true;
                            __set__msg($val['validation']['msg']);
                            __logging__error__msg($key, $prefix, 'Invalid date');
                        }
                    }
                    if ($val['validation']['to'] != '') {
                        $to_arr = explode('/', $val['validation']['to']);
                        foreach ($to_arr as $k => $v)
                            $to_arr[$k] = intval($v);
                        if (count($to_arr) == 3) {
                            $to_date = mktime(0, 0, 0, $to_arr[1], $to_arr[0], $to_arr[2]);
                            if ($date > $to_date) {
                                $error = true;
                                __set__msg($val['validation']['msg']);
                                __logging__error__msg($key, $prefix, 'Out of range');
                            }
                        } else {
                            $error = true;
                            __set__msg($val['validation']['msg']);
                            __logging__error__msg($key, $prefix, 'Invalid date');
                        }
                    }
                }
                // validation allowed special characters
                if ($val['validation']['special_char'] != '' && $val['Extra'] != 'auto_increment' && $val['Type'] != 'radio' && !array_key_exists('REFERENCED_TABLE_NAME', $val)) {
                    if ($val['validation']['special_char'] != 'none') { //  && $val['validation']['special_char'] != 'true'
                        //----------------------------------------------------------------------------
                        // to prevent special character 
                        if (strpos($val['Type'], 'datetime') !== false) {
                            if (preg_match("/[^a-z0-9 :-]/i", $_POST[$prefix])) {
                                $error = true;
                                __set__msg($val['validation']['msg']);
                                __logging__error__msg($key, $prefix, 'Special character not allowed');
                            }
                        } else if (strpos($val['Type'], 'date') !== false) {
                            if (preg_match("/[^a-z0-9 -]/i", $_POST[$prefix])) {
                                $error = true;
                                __set__msg($val['validation']['msg']);
                                __logging__error__msg($key, $prefix, 'Special character not allowed');
                            }
                        } else if (strpos($val['Type'], 'time') !== false) {
                            if (preg_match("/[^a-z0-9 :]/i", $_POST[$prefix])) {
                                $error = true;
                                __set__msg($val['validation']['msg']);
                                __logging__error__msg($key, $prefix, 'Special character not allowed');
                            }
                        } else if (strpos($val['Type'], 'decimal') !== false || strpos($val['Type'], 'double') !== false || strpos($val['Type'], 'real') !== false || strpos($val['Type'], 'float') !== false) {
                            if (preg_match("/[^a-z0-9\. ]/i", $_POST[$prefix])) {
                                $error = true;
                                __set__msg($val['validation']['msg']);
                                __logging__error__msg($key, $prefix, 'Special character not allowed');
                            }
                        } else {
                            if (preg_match("/[^a-z0-9 ]/i", $_POST[$prefix])) {
                                $error = true;
                                __set__msg($val['validation']['msg']);
                                __logging__error__msg($key, $prefix, 'Special character not allowed');
                            }
                        }
                        //-------------------------------------------------------------------------------------------	
                    }
                }
                //regular expresssion  validation 
                if (trim($_POST[$prefix]) != '' && $val['validation']['regx'] != '' && $val['Type'] != 'radio' && !array_key_exists('REFERENCED_TABLE_NAME', $val)) {
                    if (preg_match('/' . $val['validation']['regx'] . '/', trim($_POST[$prefix])) == false) {
                        $error = true;
                        __set__msg($val['validation']['msg']);
                        __logging__error__msg($key, $prefix, 'Wrong Regular Expression');
                    }
                }

                if (($val['validation']['from'] != '' && floatval($_POST[$prefix]) < floatval($val['validation']['from'])) || ($val['validation']['to'] != '' && floatval($_POST[$prefix]) > floatval($val['validation']['to'])) && $val['Type'] != 'radio' && !array_key_exists('REFERENCED_TABLE_NAME', $val)) {
                    if (strpos($val['Type'], 'date') === false) {
                        $error = true;
                        __set__msg($val['validation']['msg']);
                        __logging__error__msg($key, $prefix, 'Out of range');
                    }
                }
                if (strpos($val['Type'], 'varchar') !== false && $val['Extra'] != 'auto_increment' && $val['Type'] != 'radio' && !array_key_exists('REFERENCED_TABLE_NAME', $val)) {
                    $typeLen = intval(str_replace(')', '', substr($val['Type'], strrpos($val['Type'], '(') + 1)));
                    if (strlen($_POST[$prefix]) > $typeLen) {
                        $error = true;
                        __set__msg($val['validation']['msg']);
                        __logging__error__msg($key, $prefix, 'Invalid string/varchar, Length greater than expected');
                    }
                }
                if (strpos($val['Type'], 'year') !== false && $val['Extra'] != 'auto_increment' && $val['Type'] != 'radio' && !array_key_exists('REFERENCED_TABLE_NAME', $val)) {
                    if (preg_match('/^[12][0-9][0-9][0-9]$/', $_POST[$prefix]) == false) {
                        $error = true;
                        __set__msg($val['validation']['msg']);
                        __logging__error__msg($key, $prefix, 'Invalid year');
                    }
                }
                if ($val['Extra'] != 'auto_increment' && $val['Type'] != 'radio' && !array_key_exists('REFERENCED_TABLE_NAME', $val) &&
                        ( strpos($val['Type'], 'int') !== false || strpos($val['Type'], 'decimal') !== false || strpos($val['Type'], 'double') !== false || strpos($val['Type'], 'real') !== false || strpos($val['Type'], 'float') !== false )) {
                    if (!is_numeric($_POST[$prefix])) {
                        $error = true;
                        __set__msg($val['validation']['msg']);
                        __logging__error__msg($key, $prefix, 'Invalid number');
                    }
                }

                if (stripos($val['Type'], '(')) {
                    $str = str_replace(')', '', substr($val['Type'], strrpos($val['Type'], '(') + 1));
                    if (stristr($str, ',') !== false) {
                        $str = explode(',', $str);
                        $typeLen = intval($str[0]) + 1;
                    } else
                        $typeLen = intval($str);
                    if (strlen($_POST[$prefix]) > $typeLen) {
                        $error = true;
                        __set__msg($val['validation']['msg']);
                        __logging__error__msg($key, $prefix, 'Length greater than expected');
                    }
                }
            }
            if (trim($_POST[$prefix]) == '' && $val['Extra'] !== 'auto_increment') {
                if ($val['Null'] == '0' || $val['Null'] == '1') {
                    $error = true;
                    __set__msg($val['validation']['msg']);
                    __logging__error__msg($key, $prefix, 'Null value not allowed');
                }
            } else if (array_key_exists('REFERENCED_TABLE_NAME', $val) && //validate referenced table relationship
                    trim($_POST[$prefix]) == '0') {
                if ($val['Null'] == '0' || $val['Null'] == '1') {
                    $error = true;
                    __set__msg($val['validation']['msg']);
                    __logging__error__msg($key, $prefix, 'Mustn\'t be null value');
                }
            }
        }
    }
    logging('############################ End validate_inputs function ############################');
}

/* ------------------------------------------------------------------------------------------------------------------------- */

// this function to change schema in browser console
function change_schema($desc) {

    $new_desc = $desc;
    foreach ($new_desc as $key => $val) {
        if (stristr($new_desc[$key]['Type'], '(') !== false)
            $pos = strpos($new_desc[$key]['Type'], '(');
        else
            $pos = strlen($new_desc[$key]['Type']);

        if (stristr($new_desc[$key]['Type'], 'datetime') !== false)
            $new_desc[$key]['Type'] = substr_replace($new_desc[$key]['Type'], 'dt', 0, $pos);
        else if (stristr($new_desc[$key]['Type'], 'date') !== false)
            $new_desc[$key]['Type'] = substr_replace($new_desc[$key]['Type'], 'd', 0, $pos);
        else if (stristr($new_desc[$key]['Type'], 'time') !== false)
            $new_desc[$key]['Type'] = substr_replace($new_desc[$key]['Type'], 't', 0, $pos);
        else if (stristr($new_desc[$key]['Type'], 'timestamp') !== false)
            $new_desc[$key]['Type'] = substr_replace($new_desc[$key]['Type'], 'ts', 0, $pos);

        else if (stristr($new_desc[$key]['Type'], 'decimal') !== false || stristr($new_desc[$key]['Type'], 'float') !== false ||
                stristr($new_desc[$key]['Type'], 'double') !== false || stristr($new_desc[$key]['Type'], 'real') !== false)
            $new_desc[$key]['Type'] = substr_replace($new_desc[$key]['Type'], 'numx', 0, $pos);

        else if (stristr($new_desc[$key]['Type'], 'int') !== false)
            $new_desc[$key]['Type'] = substr_replace($new_desc[$key]['Type'], 'num', 0, $pos);

        else if (stristr($new_desc[$key]['Type'], 'varchar') !== false)
            $new_desc[$key]['Type'] = substr_replace($new_desc[$key]['Type'], 'vc', 0, $pos);

        else if (stristr($new_desc[$key]['Type'], 'year') !== false)
            $new_desc[$key]['Type'] = substr_replace($new_desc[$key]['Type'], 'y', 0, $pos);
        else
            $new_desc[$key]['Type'] = substr_replace($new_desc[$key]['Type'], 'nn', 0, $pos);


        $new_desc[$key]['Type'] = str_ireplace('(', ',', $new_desc[$key]['Type']);
        $new_desc[$key]['Type'] = str_ireplace(')', ' ', $new_desc[$key]['Type']);
    }

    return $new_desc;
}

/* ------------------------------------------------------------------------------------------------------------------------- */

// this function to logging arrays like session, post, get, ...
function logging_array($arr, $arr_name = '', $tabs = '') {
    $i = $tabs;
    foreach ($arr as $key => $val) {
        if ($arr_name != '') {
            if (!is_array($val))
                logging('## $' . $arr_name . '[' . $key . '] = ' . $val);
            else {
                logging('## $' . $arr_name . '[' . $key . ']');
                logging_array($val, '', $i . '	');
            }
        } else {
            if (!is_array($val))
                logging($tabs . '## [' . $key . '] = ' . $val);
            else {
                logging($tabs . '## [' . $key . ']');
                logging_array($val, '', $i . '	');
            }
        }
    }
}

connect();



