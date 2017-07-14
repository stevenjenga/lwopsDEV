<?php
/**
 *   PHP MYSQL Form Maker 
 *   version 3.1.0
 *   All copyrights are preserved to StarSoft
 */
define("DIRECTACESS", "true");
require_once 'loginstatus.php'; // to check if user login or not
require_once 'config.php';
// if user not login this line will header to login page
require_once '../../styles/styles.php'; // to handle change styles - start session 
// use this to set url in send_notification function
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url = (strpos($url, '?')) ? substr($url, 0, strpos($url, '?')) : $url;
$login_username = (isset($_SESSION[$form_prefix . 'username'])) ? $_SESSION[$form_prefix . 'username'] : '';

require_once 'lib.php';
// here check if user change style or not and apply it
if (isset($_POST['selected_style']) && in_array($_POST['selected_style'], $style_array))
    $_SESSION[$form_prefix . 'selected_style'] = $_POST['selected_style'];


/* ------------------------------------------------------------------------------------------------------------------------------------------ */
// --- serialization general variables - decode all variable
$message = '';
$in_insert = $_REQUEST['index'] == '-1' ? true : false;
$host = decode($host);
$user = decode($user);
$pass = decode($pass);
$insert_only = decode($permission) == "100" ? true : false;
$permission = str_split(decode($permission));
$unique = clean_array(decode($unique));
$db = clean_input(decode($db));
$table = clean_input(decode($table));
$fields = clean_array(decode($fields));
$desc = decode($desc);
$layout = decode($layout);
$style_name = (isset($_SESSION[$form_prefix . 'selected_style'])) ? $_SESSION[$form_prefix . 'selected_style'] : decode($style_name);
$_SESSION[$form_prefix . 'selected_style'] = $style_name;
$title = decode($title);
$form_desc = decode($form_desc);
$date_created = decode($date_created);
$file_name = decode($file_name);
$records_per_page = decode($records_per_page);
$sql = decode($sql);
$data_source = decode($data_source);
//------------------------------------------------------------
//get permissions insert,update and delete
$insert = $permission[0] == '1' ? true : false;
$update = $permission[1] == '1' ? true : false;
$delete = $permission[2] == '1' ? true : false;

/* search */
$arrayOfLabels = array(); // labels as key
foreach ($desc as $key => $val)
    $arrayOfLabels[$val['Label']] = $key;
search($arrayOfLabels); // this function will prepare and execute search functionality
/* ------------------------------------------------------------------------------------------------------------------------------------ */

$count = query("SELECT COUNT(*) FROM `$table` $__search", 'NUM', $__searchValue, $__searchType, 'Get number of rows to make pagination.'); // get all fields count
$count = $count[0][0];

// this will handle if there is no result in search
if ($count == 0 && (isset($_SESSION[$form_prefix . 'search_keyword']) && isset($arrayOfLabels[$_SESSION[$form_prefix . 'column_for_search']])))
    $in_insert = false;
if ($__s_sp !== '')
    $in_insert = false;


/* handle $_GET and current row */
if ($insert_only && $_GET['index'] != '-1')
    header("Location: index.php?index=-1");

if (!$insert && $count == 0)
    die('<div style="padding:10px; border:1px dotted red; color:red; margin:20px auto; font-family:Tahoma; font-size:12px; text-align:center; width:500px;">Table is empty and you don\'t have insert action permission!</div>');

/* handle $_GET values */
if ((isset($_POST['insert']) && $insert) || ($count == 0 && $_GET['index'] != '-1')) // go to insert mode
    header("Location: index.php?index=-1");
//security from sql injections
if ((isset($_POST['first']) || !isset($_GET['index']) || empty($_GET['index'])) || ((!is_numeric($_GET['index']) || intval($_GET['index']) > $count || intval($_GET['index']) < -1 || intval($_GET['index']) == 0) && $count != 0))   //got to main page
    header("Location: index.php?index=1");
if (isset($_POST['next'])) //got to next recore
    header("Location: index.php?index=" . (intval($_GET['index']) + 1));
if (isset($_POST['before'])) //got to previous recore
    header("Location: index.php?index=" . (intval($_GET['index']) - 1));
if (isset($_POST['last'])) // go to last index
    header("Location: index.php?index=" . ($count));

if (isset($_POST['cancel']) && $in_insert) // canceled insert mode
    header("Location: index.php?index=1");
else if (isset($_POST['cancel']) && $_GET['index'] != '-1') // to remove messages if usr click cancel
    header("Location: index.php?index=" . $_GET['index']);

$index = 0;

if (isset($_REQUEST['index']) && !$in_insert)
    $index = intval($_REQUEST['index']) - 1;


//---- to avoid SQL keywords----------------
$select_fields = implode(array_keys($desc), ', ');
$temp_arr = clean_array(explode(',', $select_fields));
$select_fields = array();
$select_fields_insert = array();
foreach ($temp_arr as $key) {
    $select_fields_insert[] = "`".$table . "`.`" . trim($key)."`";
    if (strpos($desc[trim($key)]['Type'], 'bit') === false)
        $select_fields[] = '`' . $table . "`.`" . trim($key) . '`';
    else//to handle MYSqL BUG http://bugs.mysql.com/bug.php?id=43670
        $select_fields[] = '`' . $table . "`.`" . trim($key) . '`+0 as `' . $key ."`";
}
$select_fields = implode($select_fields, ', ');
$select_fields_insert = implode($select_fields_insert, ', ');
//------------------------------------------
////////////////////////////////////// delete /////////////////////////////////////////////
if (isset($_POST['delete']) && $_POST['delete'] == 'Delete') {
    $data = query("SELECT $select_fields FROM `$table` $__search LIMIT $index,1", 'ASSOC', $__searchValue, $__searchType, 'Get current row data to delete it exactly'); //get the current row
    $row = $data[0]; // fetch the record
    $keys = array_keys($row);
    $conditions = array();
    $notification_keys = array();
    $notification_values = array();
    foreach ($unique as $key) {
        $notification_keys[] = $key;
        $notification_values[] = $row[$key];
        if ($desc[$key]['Type'] == 'float' || $desc[$key]['Type'] == 'double' || $desc[$key]['Type'] == 'real')
            $conditions[] = 'CONCAT(`' . $table . '`.`' . $key . '`) = \'' . $row[$key] . '\'';
        else
            $conditions[] = '`' . $table . '`.`' . $key . '` = \'' . $row[$key] . '\'';
    }
    $result = command("delete from `$table` where " . implode(' and ', $conditions) . " limit 1", array(), '', 'to Delete current row');
    if ($result) {
        if ($notification_delete)
            send_notification($url, $login_username, 'delete', 'success', '', $notification_values, $notification_keys, $dbHandler->get_num_rows());
        $index++;
        if ($index == $count)
            $index = $count - 1;
        header("Location: index.php?index=$index&msg=deleted");
    }
    else {
        if ($notification_delete)
            send_notification($url, $login_username, 'delete', 'failed', '', $notification_values, $notification_keys);
        $error = true;
        $message = 'No rows affected.';
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
/* Insert and update */
if (isset($_POST['save']) && !empty($_POST['save']) && $_POST['save'] == 'Save') {
    validate_inputs($desc);
    $message = implode(', ', $__msg);
    //////////////////////////////////// Insert ////////////////////////////////////
    if ($in_insert) {// insert
        if ($error === true) {
            $user_inputs = get_user_inputs($desc);
            if ($notification_insert)
                send_notification($url, $login_username, 'insert', 'not_valid', $not_valid_reason, $user_inputs[0], $user_inputs[1], $dbHandler->get_num_rows());
        }
        if ($error !== true) {
            $values = array();
            $params_type = '';
            foreach ($desc as $key => $val) {
                //handles the post spaces
                if(strstr($key," ")){
                    $posted_key = str_replace(' ',"_",$key);
                }
                else{
                    $posted_key = $key;
                }
                if ($val['extra'] != 'auto_increment') {
                    if ($val['Type'] == 'bit(1)') {
                        $value = isset($_POST['form_' . $posted_key]) ? '1' : '0';
                        array_push($values, "b'" . $value . "'");
                    } else
                        array_push($values, secure_var($_POST['form_' . $posted_key], true)); // addslashes(secure_var($_POST['form_'.$key], true))

                    if (stripos($val['Type'], 'int') !== false)
                        $params_type .= 'i';
                    else if (stripos($val['Type'], 'decimal') !== false || stripos($val['Type'], 'real') !== false || stripos($val['Type'], 'float') !== false || stripos($val['Type'], 'double') !== false)
                        $params_type .= 'd';
                    else
                        $params_type .= 's';
                }
            }
            /* using parametric query in insert */
            $params = $values;
            $place_holders = implode(',', array_fill(0, count($params), '?'));
            $sql = "INSERT INTO `$table`($select_fields_insert) Values($place_holders)";
            $values = implode(', ', $values);
            $insert = command($sql, $params, $params_type, 'to insert new row.');
            $notification_keys = explode(', ', $select_fields_insert);
            if ($insert && $dbHandler->get_num_rows() > 0) {
                if ($notification_insert)
                    send_notification($url, $login_username, 'insert', 'success', '', $params, $notification_keys, $dbHandler->get_num_rows());
                if ($insert_only)
                    header("Location: index.php?index=-1&msg=saved");
                else
                    header("Location: index.php?index=" . ($count + 1) . "&msg=saved");
            }else {
                if ($notification_insert)
                    send_notification($url, $login_username, 'insert', 'failed', '', $params, $notification_keys, $dbHandler->get_num_rows());
                $error = true;
                $message = 'Insert failed';
            }
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////// update //////////////////////////////////////////////////
    else { // update
        $user_inputs = get_user_inputs($desc);
        if ($error === true) {
            if ($notification_update)
                send_notification($url, $login_username, 'update', 'not_valid', $not_valid_reason, $user_inputs[0], $user_inputs[1], $dbHandler->get_num_rows());
        }
        if ($error !== true) {
            $params = array();
            $values = array();
            $params_type = '';

            foreach ($desc as $key => $val) {
                 if(strstr($key," ")){
                    $posted_key = str_replace(' ',"_",$key);
                }
                else{
                    $posted_key = $key;
                }
                if ($val['Extra'] != 'auto_increment') {
                    if ($val['Type'] == 'bit(1)') {
                        $value = isset($_POST['form_' . $posted_key]) ? '1' : '0';
                        $values[] .= '`' . $table . '`.`' . $key . '` = ?';
                        $params[] = "b'" . $value . "'";
                    } else {
                        $values[] .= '`' . $table . '`.`' . $key . '` = ?';
                        $params[] = secure_var($_POST['form_' . $posted_key], true);
                    }

                    if (stripos($val['Type'], 'int') !== false)
                        $params_type .= 'i';
                    else if (stripos($val['Type'], 'decimal') !== false || stripos($val['Type'], 'real') !== false || stripos($val['Type'], 'float') !== false || stripos($val['Type'], 'double') !== false)
                        $params_type .= 'd';
                    else
                        $params_type .= 's';
                }
            }
            $data = query("SELECT $select_fields FROM `$table` $__search LIMIT $index,1", 'ASSOC', $__searchValue, $__searchType, 'Get current row data to update it exactly'); //get the current row
            $row = $data[0]; // fetch the record
            $keys = array_keys($row);
            $conditions = array();
            foreach ($unique as $key) {
                if ($desc[$key]['Type'] == 'float' || $desc[$key]['Type'] == 'double' || $desc[$key]['Type'] == 'real')
                    $conditions[] = 'CONCAT(`' . $table . '`.`' . $key . '`) = \'' . $row[$key] . '\'';
                else
                    $conditions[] = '`' . $table . '`.`' . $key . '` = \'' . $row[$key] . '\'';
            }
            $sql = "UPDATE `$table` SET " . implode(', ', $values) . " where  " . implode(' and ', $conditions) . " limit 1";
            $update = command($sql, $params, $params_type, 'to update current row');
            if (!$update) {
                if ($notification_update)
                    send_notification($url, $login_username, 'update', 'failed', '', $params, $user_inputs[1], $dbHandler->get_num_rows());
                $error = true;
                $message = 'Update failed';
            }
            else {
                if ($notification_update)
                    send_notification($url, $login_username, 'update', 'success', '', $params, $user_inputs[1], $dbHandler->get_num_rows());
                $index++;
                header("Location: index.php?index=$index&msg=updated");
            }
        }
    }
    //////////////////////////////////////////////////////////////////////////////////
}
$data = query("SELECT $select_fields FROM `$table` $__search LIMIT $index,1", 'ASSOC', $__searchValue, $__searchType, 'Get current row data to display it to user.'); //get the current row
$row = $data[0]; // fetch the record
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $title; ?></title>
        <link href="<?php echo '../../styles/styles/' . $style_name; ?>.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../../js/jquery-1.7.2.min.js"></script>

        <script type="text/javascript" src="../../js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="../../js/jquery.ui.core.min.js"></script>
        <script type="text/javascript" src="../../js/jquery.ui.datepicker.min.js"></script>
        <script type="text/javascript" src="../../js/jquery-ui-timepicker-addon.js"></script>
        <link rel="stylesheet" type="text/css" href="../../js/ui-lightness/jquery.ui.all.css" />
        <link rel="stylesheet" type="text/css" href="../../js/ui-lightness/jquery.ui.datepicker.css" />
        <link rel="stylesheet" type="text/css" href="../../styles/bootstrap/css/bootstrap.css" />

        <style>
            .error_border{border:  1px solid red !important ;}
            /* css for timepicker */
            .ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
            .ui-timepicker-div dl { text-align: left; }
            .ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
            .ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }
            .ui-timepicker-div td { font-size: 90%; }
            .ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }
            .ui-slider { position: relative; text-align: left; }
            .ui-slider .ui-slider-handle { position: absolute; z-index: 2; width: 1.2em; height: 1.2em; cursor: default; }
            .ui-slider .ui-slider-range { position: absolute; z-index: 1; font-size: .7em; display: block; border: 0; background-position: 0 0; }

            .ui-slider-horizontal { height: .8em; }
            .ui-slider-horizontal .ui-slider-handle { top: -.3em; margin-left: -.6em; }
            .ui-slider-horizontal .ui-slider-range { top: 0; height: 100%; }
            .ui-slider-horizontal .ui-slider-range-min { left: 0; }
            .ui-slider-horizontal .ui-slider-range-max { right: 0; }

            .ui-slider-vertical { width: .8em; height: 100px; }
            .ui-slider-vertical .ui-slider-handle { left: -.3em; margin-left: 0; margin-bottom: -.6em; }
            .ui-slider-vertical .ui-slider-range { left: 0; width: 100%; }
            .ui-slider-vertical .ui-slider-range-min { bottom: 0; }
            .ui-slider-vertical .ui-slider-range-max { top: 0; }
            #logout{
                text-decoration: none;
                color: inherit;
            }
            #logout:hover{
                text-decoration: underline;
            }
        </style>
        <script type="text/javascript">
            $(function() {
                $('input[data_type=dt]').focus(function(e) {
                    e.preventDefault();
                });

                //        $('.err').click(function(){
                //            $(this).slideUp('slow');
                //        });

                $('input[data_type=dt], input[data_type=d], input[data_type=ts], input[data_type=t]').each(function() {
                    $(this).attr('autocomplete', 'off');
                    var arr_from = '';
                    var arr_to = '';
                    if ($(this).attr('from') != 'undefined')
                        arr_from = $(this).attr('from').split('/');

                    if ($(this).attr('to') != 'undefined')
                        arr_to = $(this).attr('to').split('/');
                    arr_from[0]--;
                    arr_to[0]--;
                    if ($(this).attr('data_type') == 't')
                        $(this).timepicker({showSecond: true, timeFormat: 'hh:mm:ss'});
                    else
                    {
                        if (arr_from != '' && arr_to != '')
                        {
                            if ($(this).attr('data_type') == 'd')
                                $(this).datepicker({changeMonth: true, changeYear: true, minDate: new Date(arr_from[2], arr_from[0], arr_from[1]), maxDate: new Date(arr_to[2], arr_to[0], arr_to[1]), dateFormat: 'yy-mm-dd'});
                            else
                                $(this).datetimepicker({showSecond: true, timeFormat: 'hh:mm:ss', changeMonth: true, changeYear: true, minDate: new Date(arr_from[2], arr_from[0], arr_from[1]), maxDate: new Date(arr_to[2], arr_to[0], arr_to[1]), dateFormat: 'yy-mm-dd'});
                        }
                        else if (arr_from != '')
                        {
                            if ($(this).attr('data_type') == 'd')
                                $(this).datepicker({changeMonth: true, changeYear: true, minDate: new Date(arr_from[2], arr_from[0], arr_from[1]), dateFormat: 'yy-mm-dd'});
                            else
                                $(this).datetimepicker({showSecond: true, timeFormat: 'hh:mm:ss', changeMonth: true, changeYear: true, minDate: new Date(arr_from[2], arr_from[0], arr_from[1]), dateFormat: 'yy-mm-dd'});
                        }
                        else if (arr_to != '')
                        {
                            if ($(this).attr('data_type') == 'd')
                                $(this).datepicker({changeMonth: true, changeYear: true, maxDate: new Date(arr_to[2], arr_to[0], arr_to[1]), dateFormat: 'yy-mm-dd'});
                            else
                                $(this).datetimepicker({showSecond: true, timeFormat: 'hh:mm:ss', changeMonth: true, changeYear: true, maxDate: new Date(arr_to[2], arr_to[0], arr_to[1]), dateFormat: 'yy-mm-dd'});
                        }
                        else
                        {
                            if ($(this).attr('data_type') == 'd')
                                $(this).datepicker({changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd'});
                            else
                                $(this).datetimepicker({showSecond: true, timeFormat: 'hh:mm:ss', changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd'});

                        }
                    }



                });


                var remove_error = function() {
                    if ($.trim($(this).val()) != '')
                    {
                        $(this).removeClass('error_border');
                        $(this).parent().children('span').remove();
                    }
                }
                $('select[relation=yes]').change(remove_error);
                $('input[name*=09_sfm_x8_],textarea').keyup(remove_error);
                $('input[name*=09_sfm_x8_]').change(remove_error);


                //save
                $('#btnSave').click(function(e) {
                    //e.preventDefault();

                    $('input[name*=09_sfm_x8_],textarea[name*=09_sfm_x8_]').removeClass('error_border');
                    $('input[name*=09_sfm_x8_],textarea[name*=09_sfm_x8_]').parent().children('span').remove();
                    var valid = true;
                    try {
                        $('input[name*=09_sfm_x8_],textarea[name*=09_sfm_x8_]').each(function() {
                            var value = $(this).val();
                            var obj = $(this);
                            var type = new String($(this).attr('data_type'));
                            if (($(this).attr('null') == '0' || $(this).attr('null') == '1') && $.trim($(this).val()) == '' && !($(this).attr('extra') == 'auto_increment'))
                            {
                                valid = false;
                                $(this).addClass('error_border');
                                $(this).parent().append('<span style="color:red;">required!</span>');
                            }

                            // validation allowed special characters
                            if ($(this).attr('special_char') && $(this).attr('extra') != 'auto_increment' && $(this).attr('type') != 'radio' && $(this).attr('relation') != 'yes')
                            {


                                if ($(this).attr('special_char') != 'none')
                                {

                                    if ($(this).attr('data_type') == 'd') {
                                        if (value.search(/[^a-z0-9 -]/ig) != -1)
                                        {
                                            obj.parent().append('')
                                            valid = false;
                                            obj.addClass('error_border');
                                            obj.parent().append('<span style="color:red;"><br />' + obj.attr('msg') + '</span>');
                                        }
                                    } else if ($(this).attr('data_type') == 't') {
                                        if (value.search(/[^a-z0-9 :]/ig) != -1)
                                        {
                                            obj.parent().append('')
                                            valid = false;
                                            obj.addClass('error_border');
                                            obj.parent().append('<span style="color:red;"><br />' + obj.attr('msg') + '</span>');
                                        }
                                    } else if ($(this).attr('data_type') == 'dt') {
                                        if (value.search(/[^a-z0-9 :-]/ig) != -1)
                                        {
                                            obj.parent().append('')
                                            valid = false;
                                            obj.addClass('error_border');
                                            obj.parent().append('<span style="color:red;"><br />' + obj.attr('msg') + '</span>');
                                        }
                                    } else if (Contains(type, 'numx'))
                                    {
                                        if (value.search(/[^a-z0-9\. ]/ig) != -1)
                                        {
                                            obj.parent().append('')
                                            valid = false;
                                            obj.addClass('error_border');
                                            obj.parent().append('<span style="color:red;"><br />' + obj.attr('msg') + '</span>');
                                        }
                                    } else {
                                        if (value.search(/[^a-z0-9 ]/ig) != -1)
                                        {
                                            obj.parent().append('')
                                            valid = false;
                                            obj.addClass('error_border');
                                            obj.parent().append('<span style="color:red;"><br />' + obj.attr('msg') + '</span>');
                                        }
                                    }
                                }
                            }
                            //regular expresssion  validation
                            if ($.trim($(this).val()) != '' && $(this).attr('regx') && $(this).attr('type') != 'radio' && $(this).attr('relation') != 'yes')
                            {
                                if (!(new RegExp($(this).attr('regx'), 'g').test($(this).val())) && $(this).parent().children('span').length == 0)
                                {

                                    valid = false;
                                    obj.addClass('error_border');
                                    obj.parent().append('<span style="color:red;"><br />' + obj.attr('msg') + '</span>');
                                }
                            }


                            if ((parseFloat($(this).val()) < parseFloat($(this).attr('from'))
                                    || parseFloat($(this).val()) > parseFloat($(this).attr('to'))) && $(this).attr('type') != 'radio' && $(this).attr('relation') != 'yes'
                                    )
                            {
                                if (!Contains(type, 'd'))
                                {
                                    valid = false;
                                    obj.addClass('error_border');
                                    if ($(this).parent().children('span').length == 0)
                                        obj.parent().append('<span style="color:red;"><br />' + obj.attr('msg') + '</span>');
                                }
                            }


                            if (Contains(type, 'vc') && $(this).attr('extra') != 'auto_increment' && $(this).attr('type') != 'radio' && $(this).attr('relation') != 'yes')
                            {
                                //alert(type);
                                type = parseInt(type.substr(type.indexOf(',') + 1).replace(' ', ''));
                                if ($(this).val().length > type)
                                {
                                    valid = false;
                                    $(this).addClass('error_border');
                                    if ($(this).parent().children('span').length == 0)
                                        $(this).parent().append('<span style="color:red;"><br />' + obj.attr('msg') + '</span>');
                                }
                            }

                            if (Contains(type, 'y') && $(this).attr('extra') != 'auto_increment' && $(this).attr('type') != 'radio' && $(this).attr('relation') != 'yes')
                            {
                                var patt = /^[12][0-9][0-9][0-9]$/g;
                                if (!(patt.test($(this).val())))
                                {
                                    valid = false;
                                    $(this).addClass('error_border');
                                    if ($(this).parent().children('span').length == 0)
                                        $(this).parent().append('<span style="color:red;"><br />' + obj.attr('msg') + '</span>');
                                }
                            }


                            if ($(this).attr('extra') != 'auto_increment' && $(this).attr('type') != 'radio' && $(this).attr('relation') != 'yes' &&
                                    (Contains(type, 'num') || Contains(type, 'numx')))
                            {

                                if (isNaN($(this).val()))
                                {
                                    valid = false;
                                    $(this).addClass('error_border');
                                    if ($(this).parent().children('span').length == 0)
                                        $(this).parent().append('<span style="color:red;"><br />' + obj.attr('msg') + '</span>');
                                }
                            }



                        });


                        $('select[relation=yes]').each(function() {
                            if (($(this).attr('null') == '0' || $(this).attr('null') == '1') && $(this).val() == '0') //validate refrenced table relationship
                            {

                                valid = false;
                                $(this).addClass('error_border');
                                if ($(this).parent().children('span').length == 0)
                                    $(this).parent().append('<span style="color:red;">required!</span>');

                            }

                        });
                    } catch (exception) {
                    }


                    if (!valid)
                        e.preventDefault();
                });
                //$(this).datepicker({changeMonth: true,changeYear: true,minDate:new Date($(this).attr('min').split('/')[0] , 1 - 1, 1)});
                //$('input[data_type=datetime]').datepicker({changeMonth: true,changeYear: true});
                if (getParameterByName('index') == '-1')
                {
                    $('input[extra=auto_increment]').val('auto increment(*)');
                    $('input[data_type=dt]').val('');
                }
            });
            function getParameterByName(name)
            {
                var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
                return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
            }

            function Contains(main, str)
            {
                if (main != undefined)
                {
                    main = main.toString();
                    if (main.indexOf(str) == -1)
                        return false;
                    else
                        return true;
                }
                else
                    return false;
            }
            $(function() {
                var show_action = function() {
                    $('#actions').show();
                    $('#controls').hide();
                }
                var in_insert = <?php $str = $in_insert == true ? 'true' : 'false';
echo $str; ?>;
                if (in_insert)
                    show_action();
                $('#btnUpdate').click(show_action);
            });
        </script>
    </head>
    <body>
        <form id="myform" name="myform" method="post">
            <div class="container">
                <div class="form-title">
                    <div style="position: relative;overflow-x: hidden;display: inline-block;width: 15%;margin: 0px 10px 5px 0px;">

                        <h3><?php echo $title; ?></h3>
                        <h6><?php echo $form_desc; ?></h6>

                    </div>
                    <div style="position: relative;overflow-x: hidden;display: inline-block;width: 55%;margin: 0px 0px 5px 0px;">
                        <?php $__desc = array();
                        if (!$insert_only && !$in_insert) { ?>
                            <div style="position: relative;overflow-x: hidden;display: inline-block;width: 30%;margin: 0px 5px 0px 0px;">
                                <select class="form-control" id="column_for_search" name="column_for_search">
                                    <?php
                                    foreach ($desc as $key => $val) {
                                        $__desc[$val['Label']] = $val['Type'];
                                        if (isset($_SESSION[$form_prefix . 'column_for_search']) && $val['Label'] === $_SESSION[$form_prefix . 'column_for_search'])
                                            $selected_col = 'selected';
                                        else
                                            $selected_col = '';

                                        echo "<option value='" . addslashes($val['Label']) . "' $selected_col >" . $val['Label'] . "</option>";
                                    }
                                    $__desc = json_encode($__desc);
                                    ?>
                                </select>
                            </div>

                            <div style="position: relative;overflow-x: hidden;display: inline-block;width: 30%;margin: 0px 0px 0px 0px;">
                                <div class="left-inner-addon">
                                    <i class="glyphicon glyphicon-search"></i>
                                    <input class="form-control" id="search_keyword" name="search_keyword" value="<?php if (isset($_SESSION[$form_prefix . 'search_keyword'])) {
                                        $sk = (!is_numeric($_SESSION[$form_prefix . 'search_keyword'])) ? substr($_SESSION[$form_prefix . 'search_keyword'], 2, -2) : $_SESSION[$form_prefix . 'search_keyword'];
                                        echo $sk;
                                    } else {
                                        echo '';
                                    } ?>" type="text"/>

                                    <input style="position: absolute; width: 0px; height: 0px; border: 0px; outline: none;padding: 0px;margin: 0px;" type="text" id="tp"/>
                                    <input style="position: absolute; width: 0px; height: 0px; border: 0px; outline: none;padding: 0px;margin: 0px;" type="text" id="dp"/>
                                    <input style="position: absolute; width: 0px; height: 0px; border: 0px; outline: none;padding: 0px;margin: 0px;" type="text" id="dtp"/>

                                </div>
                            </div>

                            <div style="position: relative;top:-1px;overflow-x: hidden;display: inline-block;width: 30%;margin: 0px 0px 0px 0px;">

                                <div style="position: relative;overflow-x: hidden;display: inline;margin:0px 4px;float: left;">
                                    <button style="width: 70px;" id="searchBtn" name="searchBtn" class="bootstrap-btn bootstrap-btn-default bootstrap-btn-xs" onclick="this.form.submit();">Search</button>
                                </div>
                                <div style="position: relative;overflow-x: hidden;display: inline;margin: 0px;float: left;">
                                    <button style="width: 70px;"  id="showAllBtn" name="showAllBtn" class="bootstrap-btn bootstrap-btn-default bootstrap-btn-xs"  onclick="this.form.submit();">Show All</button>
                                </div>
                            </div>
<?php } ?>
                    </div>

                    <div style="position: relative;top: -3px;left: -40px;overflow-x: hidden;display: inline-block;width: 19%;margin: 5px 5px 5px 0px;overflow: hidden;text-align: right;">
                        <!--
                        <div style="position: relative;overflow-x: hidden;display: inline-block;margin: 4px 5px 0px 3px;float: left;color: inherit;font-size: 12px;">
                                Change Style
                        </div>
                        -->
                        <div style="position: relative;overflow-x: hidden;display: inline-block;width: 90%;margin: 0px;">
                            <div class="left-inner-addon" style="overflow: hidden;">
                                <i style="top: -3px;left: 0px;"><img src="../../styles/images/palette.png" width="20" height="20"></i>
                                <select class="form-control" name="selected_style" id="selected_style" onchange="this.form.submit();" placeholder=' -- Change Style -- '>
                                    <optgroup label=" -- Change Style -- ">
<?php print_styles_names(); ?>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div style="position: relative;top: -7px;overflow-x: hidden;display: inline-block;width: 5%;margin: 5px 10px 5px 0px;overflow: hidden;text-align: right;font-size: 12px;">
                        <?php if ($login->is_public_form() == false) { ?> <a id='logout' href='logout.php?form_prefix=<?php echo $form_prefix; ?>'>Logout</a> <?php } ?>
                    </div>
                </div>
                        <?php if ((($search !== '' && $count > 0) || $search === '' ) && $__s_sp === "") { ?>
                    <table class="form-grid" width="100%" border="0" cellspacing="1" cellpadding="1">
                        <tr>
                            <?php
                            $i = -1;
                            $new_desc = change_schema($desc);
                            foreach ($desc as $key => $val) {
                                $i++;
                                if ($i == 2) {
                                    $i = 0;
                                    echo '</tr><tr>';
                                }
                                $form_name = "09_sfm_x8_$key";
                                $attr = 'msg="' . $val['validation']['msg'] . '"';
                                $attr .= 'from="' . $val['validation']['from'] . '"';
                                $attr .= 'to="' . $val['validation']['to'] . '"';
                                $attr .= 'special_char="' . $val['validation']['special_char'] . '"';
                                $attr .= 'regx="' . $val['validation']['regx'] . '"';
                                $attr .= 'data_type="' . $new_desc[$key]['Type'] . '"';
                                $attr .= 'null="' . $val['Null'] . '"';

                                $attr .= 'extra="' . $val['Extra'] . '"';
                                $attr .= 'key="' . $val['Key'] . '"';
                                //$msg = $val['Val'];
                                $value = $in_insert ? '' : htmlspecialchars($row[$key]);

                                if (!empty($_POST['form_' . $key]) && !isset($_POST['cancel']) && $search === '' && !isset($_POST['showAllBtn']))
                                    $value = $_POST['form_' . $key];

                                $str_td = '<td class="red-lbl">' . $val['Label'] . '</td>';
                                $str_td .= '<td style="width:1%;">:</td>';
                                $str_td .= '<td class="input-td">';
                                if ($val['Extra'] == 'auto_increment')
                                    $str_td .= '<input type="text" ' . $attr . ' style="background:#e3e3e3;" disabled value="' . $value . '" name="' . $form_name . '" />';
                                else if (array_key_exists('REFERENCED_TABLE_NAME', $val)) {
                                    $tbl_name = secure_var($val['REFERENCED_TABLE_NAME']);
                                    $joinedtabledate = query("select * from $tbl_name", 'ASSOC');
                                    $str = '<select relation="yes" ' . $attr . ' name="' . $form_name . '">';
                                    $str .= '<option style="width:156px;" value="0">Select</option>';
                                    foreach ($joinedtabledate as $row_tbl) {
                                        if ($row[$key] == $row_tbl[$val['REFERENCED_COLUMN_NAME']] && !$in_insert)
                                            $str.= '<option selected value="' . $row_tbl[$val['REFERENCED_COLUMN_NAME']] . '">' . $row_tbl[$val['TextField']] . '</option>';
                                        else
                                            $str.= '<option  value="' . $row_tbl[$val['REFERENCED_COLUMN_NAME']] . '">' . $row_tbl[$val['TextField']] . '</option>';
                                    }
                                    $str .= '</select>';
                                    $str_td .= $str;
                                }
                                else if (strpos($val['Type'], 'set') > -1 || strpos($val['Type'], 'enum') > -1) {
                                    $items = '';
                                    if (strpos($val['Type'], 'set') > -1)
                                        $items = substr($val['Type'], 4, count($val['Type']) - 2);
                                    else
                                        $items = substr($val['Type'], 5, count($val['Type']) - 2);
                                    $items = explode(',', $items);

                                    $str = '<select ' . $attr . ' name="' . $form_name . '">';
                                    foreach ($items as $item) {
                                        $item = str_replace("'", "", $item);
                                        $selected = ($item == $value) ? 'selected' : '';
                                        $str .= "<option $selected value=\"$item\">$item</option>";
                                    }
                                    $str_td .= $str . '</select>';
                                } else if ($val['Type'] == 'text' || $val['Type'] == 'longtext')
                                    $str_td .= '<textarea ' . $attr . ' style="width: 328px;height: 52px;" name="' . $form_name . '">' . $value . '</textarea>';
                                else if ($val['Type'] == 'bit(1)') {
                                    $checked = ($value == '1') ? 'checked' : '';
                                    $str_td .= '<input type="checkbox" name="' . $form_name . '" ' . $checked . ' />';
                                } else if ($val['Type'] == 'tinyint(1)') {
                                    if ($value == '1')
                                        $str_td .= '<label><input  value="1" checked type="radio" name="' . $form_name . '" /> True</label>  <label><input value="0" type="radio" name="' . $form_name . '" /> False</label>';
                                    else
                                        $str_td .= '<label><input value="1" type="radio" name="' . $form_name . '" /> True</label>  <label><input checked value="0" type="radio" name="' . $form_name . '" /> False </label>';
                                }
                                else if (stristr($val['Type'], 'blob'))
                                    $str_td .= '<input ' . $attr . ' value=\'' . $value . '\' name="' . $form_name . '" />';
                                else
                                    $str_td .= '<input ' . $attr . ' value="' . $value . '" name="' . $form_name . '" />';

                                $str_td .= '</td>';
                                echo $str_td;
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="6" align="center">
                                <div id="controls"><?php if ($insert) { ?>
                                        <input id="btnInsert" type="submit" value="Insert"  class="btn"  name="insert" />
    <?php } ?>
    <?php if ($update) { ?>
                                        <input id="btnUpdate" type="button" value="Update" class="btn"  name="update" /> 
    <?php } ?>
                                    <?php if ($delete) { ?>
                                        <input  id="btnDelete" type="submit" value="Delete" onclick="return  confirm('Are you sure that you want to delete the row?');" class="btn"  name="delete" /> 
                                    <?php } ?></div>
                                <div id="actions" style="display: none;" >

                                    <input id="btnSave" type="submit" value="Save"  class="btn"  name="save" />  
                                    <input id="btnCancel"  type="submit" value="Cancel"  class="btn"  name="cancel" /> 
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <div class="pager" <?php if ($insert_only) echo 'style="display:none;"'; ?> >
                                    <input type="submit" class="pager-btn" name="first" value="<<" <?php if ($index == 0) echo 'disabled'; ?> />
                                    <input type="submit" class="pager-btn" name="before" value="<" <?php if ($index == 0) echo 'disabled'; ?> />
                                    <input type="text" id="record" class="pager-records" name="number" value="<?php if ($_REQUEST['index'] == '-1') echo '*';
                                else echo $index + 1; ?>" />
                                    <input type="submit" class="pager-btn" value=">" name="next" <?php if ($index + 1 == $count || $in_insert) echo 'disabled'; ?> />
                                    <input type="submit" class="pager-btn" value=">>"   <?php if ($index + 1 == $count || $in_insert) echo 'disabled'; ?>  name="last" />
                                    Of <?php echo $count; ?>

                                </div>

                            </td>
                        </tr>

                    </table>
    <?php
    if (isset($_GET['msg']) && !$error) {
        if ($_GET['msg'] == 'saved')
            $message = 'Row Inserted Successfully.';
        else if ($_GET['msg'] == 'deleted')
            $message = 'Row Deleted Successfully.';
        else if ($_GET['msg'] == 'updated')
            $message = 'Row Updated Successfully.';
    }

    if ($message != '') {
        ?>
                        <div class="err <?php if ($error) echo 'error';
                else echo 'success'; ?>-message"><?php echo $message; ?></div>

                    <?php } ?>

                <?php }else { ?>

    <?php if ($__s_sp === "") { ?>
                        <div style="font-size: 16px;font-weight: 400;padding: 10px; margin: 10px;">Search result: There is no result found, please click Show All button.</div>
                    <?php } else { ?>
                        <div style="font-size: 16px;font-weight: 400;padding: 10px; margin: 10px;">Search result: No special characters allowed, for security reason.</div>
                    <?php } ?>

                <?php } ?>


            </div>
        </form>
        <script type="text/javascript">
            var __desc = <?php echo $__desc ?>;
            var count = <?php echo $count; ?>;
            var index = '<?php if ($in_insert) echo '*';
                else echo $index + 1; ?>';
            var picker;
            $(function() {
                $('html').bind('keypress', function(e)
                {
                    if (e.keyCode == 13)
                    {
                        $('#record').change();
                        return false;
                    }
                });
                $('#record').change(function() {
                    if (isNaN($(this).val()))
                        $(this).val(index);
                    else
                    {
                        var val = parseInt($(this).val());
                        if (val > count || val <= 0)
                            $(this).val(index);
                        else
                            window.location = 'index.php?index=' + val;
                    }

                });

                $('#selected_style').val('<?php echo $style_name; ?>');

                picker = $('#search_keyword');

                $('#column_for_search').change(function() {
                    picker.val('');
                });

                $('#tp').timepicker({showSecond: true, timeFormat: 'hh:mm:ss'});
                $('#dp').datepicker({changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd'});
                $('#dtp').datetimepicker({showSecond: true, timeFormat: 'hh:mm:ss', changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd'});

                var old = $.datepicker._hideDatepicker;
                picker.mousedown(function(e) {
                    $('#tp').val('');
                    $('#dp').val('');
                    $('#dstp').val('');
                    var type = __desc[$('#column_for_search').val()];
                    if (type.search('datetime') > -1 || type.search('date') > -1 || type.search('timestamp') > -1 || type.search('time') > -1) {
                        if (type == 'time') {
                            // $('#tp').trigger('click');
                            // $.datepicker._showDatepicker($('#tp')[0]);
                            $('#tp').trigger('focus');
                        } else {
                            if (type == 'date') {
                                $('#dp').trigger('focus');
                            } else {
                                $('#dtp').trigger('focus');
                            }
                        }
                    }
                    $.datepicker._hideDatepicker = function(input) {
                    };
                });

                picker.click(function() {
                    $.datepicker._hideDatepicker = function(input) {
                        old.apply(this, arguments);
                    };
                });

                $('#tp').change(function() {
                    picker.val($(this).val());
                });
                $('#dp').change(function() {
                    picker.val($(this).val());
                });
                $('#dtp').change(function() {
                    picker.val($(this).val());
                });
            });
        </script>
    </body>
</html>
<?php close_connection(); ?>