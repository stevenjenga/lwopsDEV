<?php
/**
 *   PHP MYSQL Form Maker 
 *   version 3.1.0
 *   All copyrights are preserved to StarSoft
 */
$is_log = false;
$log = ""; /* ----------------------------- */

function clean_input($str, $allowSingleQoute = false) {
    logging('############################ Start clean_input function ############################');
    logging('## Input for clean ## ' . $str);
    $str = strip_tags($str);
    $str = ($allowSingleQoute) ? preg_replace('/[\\\";&|<>\/]/i', '', $str) : preg_replace('/[\\\"\';&|<>\/]/i', '', $str);
    $specials = array("\x00", "\0", "\n", "\r", "\x1a");
    foreach ($specials as $key => $value)
        $str = str_replace($value, '', $str);
    $str = trim($str);
    logging('## cleaned input ## ' . $str);
    logging('############################ Start clean_input function ############################' . "\r\n");
    return $str;
}

function clean_array($arr, $allowSingleQoute = false) {
    $cleaned_array = array();
    foreach ($arr as $key => $value) {
        if (is_array($value))
            $cleaned_array[clean_input($key, $allowSingleQoute)] = clean_array($value, $allowSingleQoute);
        else
            $cleaned_array[clean_input($key, $allowSingleQoute)] = clean_input($value, $allowSingleQoute);
    }
    return $cleaned_array;
}

/* ----------------------------- */

function is_clean($str, $no_space = false, $only_alphanumeric = true) {
    //No attacks and No special characters and No spaces
    if ($no_space)
        $_no_space = 'true';
    else
        $_no_space = 'false';
    if ($only_alphanumeric)
        $_only_alphanumeric = 'true';
    else
        $_only_alphanumeric = 'false';
    logging("## check variable : $str, check include spaces : $_no_space, check only alphanumeric : $_only_alphanumeric ");
    $str = strtolower($str);
    // dangrous special characters

    $specials = array("\x00", '\\', "\0", "\n", "\r", "'", '"', "\x1a", "<", ">");
    foreach ($specials as $val) {
        if (strstr($str, $val)) {
            logging("## result Invalid reason : string $str includes harmful special characters");
            return false;
        }
    }

    //No speacial chracters except the members existed in the $allowed array
    if ($only_alphanumeric == true) {
        $edited_str = $str;
        $allowed = array("-", "_", "@", ".", ",", "#", " ", "-", "/", "|c");
        foreach ($allowed as $v) {
            $edited_str = str_replace($v, "", $edited_str);
        }

        if (ctype_alnum($edited_str) != true) {
            logging("## result Invalid reason :  string $str includes special characters");
            return false;
        }
    }

    // No spaces
    if (strstr($str, " ") && $no_space == true) {
        logging("## result Invalid reason : string $str contains spaces");
        return false;
    }
    logging("## string $str valid");
    return true;
}

function is_exist($var) {
    if (isset($var) && !empty($var))
        return true;
    else
        return false;
}

function array_row_count($arr) {
    if (function_exists(array_column)) {
        return array_column($arr);
    } else {
        return count($arr[0]);
    }
}

function is_date($str) {
    $stamp = strtotime($str);
    if (!is_numeric($stamp))
        return FALSE;
    $month = date('m', $stamp);
    $day = date('d', $stamp);
    $year = date('Y', $stamp);
    if (checkdate($month, $day, $year))
        return TRUE;
    return FALSE;
}

function logging($str, $type = "") {
    global $log, $is_log;
    if ($is_log) {
        $log .= $str;
    //   $fp = fopen("mail.txt", "a");
    //    fwrite($fp, $str . " \n");
    //    fclose($fp);
    }
}
