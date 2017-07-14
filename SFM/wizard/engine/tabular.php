<?php
/**
 *   PHP MYSQL Form Maker 
 *   version 3.1.0
 *   All copyrights are preserved to StarSoft
 */
define("DIRECTACESS", "true");

require_once 'loginstatus.php';
require_once 'config.php';

require_once '../../styles/styles.php'; // to handle change styles - start session 

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url = (strpos($url, '?')) ? substr($url, 0, strpos($url, '?')) : $url;
$login_username = (isset($_SESSION[$form_prefix . 'username'])) ? $_SESSION[$form_prefix . 'username'] : '';

require_once 'lib.php';

if (isset($_POST['selected_style']) && in_array($_POST['selected_style'], $style_array))
    $_SESSION[$form_prefix . 'selected_style'] = $_POST['selected_style'];

// --- deserialization general variables
$message = '';
$error = false;
$in_insert = $_REQUEST['p'] == '-1' ? true : false;
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
//------------------------------------------------------------
//get permissions insert,update and delete
$insert = $permission[0] == '1' ? true : false;
$update = $permission[1] == '1' ? true : false;
$delete = $permission[2] == '1' ? true : false;

//////////////////////////////////////////////////////////////////////////////////////////
/* search & order system */
$arrayOfLabels = array();
foreach ($desc as $key => $val)
    $arrayOfLabels[$val['Label']] = $key;

$arrayOfLabelsVals = array();
foreach ($desc as $key => $val)
    $arrayOfLabelsVals[] = $val['Label'];
/* order system */
$orderBy = '';
if (isset($_POST['orderBy']) && in_array($_POST['orderBy'], $arrayOfLabelsVals)) {
    $_SESSION[$form_prefix . 'orderBy'] = $_POST['orderBy'];
    $_SESSION[$form_prefix . 'ordinaryType'] = (in_array($_POST['ordinaryType'], array('', 'DESC'))) ? $_POST['ordinaryType'] : '';
    $orderBy = ' ORDER BY `' . $arrayOfLabels[$_SESSION[$form_prefix . 'orderBy']] . '` ' . $_SESSION[$form_prefix . 'ordinaryType'];
} else if (isset($_SESSION[$form_prefix . 'orderBy']) && in_array($_SESSION[$form_prefix . 'orderBy'], $arrayOfLabelsVals) && isset($arrayOfLabels[$_SESSION[$form_prefix . 'orderBy']])) {
    $orderBy = ' ORDER BY `' . clean_input($arrayOfLabels[$_SESSION[$form_prefix . 'orderBy']], true) . '` ' . clean_input($_SESSION[$form_prefix . 'ordinaryType'], true);
}

/* search */
search($arrayOfLabels);
///////////////////////////////////////////////////////////////

$count = query("SELECT COUNT(*) FROM `$table` $__search $orderBy", 'NUM', $__searchValue, $__searchType, 'Get number of rows to make pagination.'); // get all fields count
$count = $count[0][0];
$pages = ceil($count / $records_per_page);

if ($count == 0 && (isset($_SESSION[$form_prefix . 'search_keyword']) && isset($arrayOfLabels[$_SESSION[$form_prefix . 'column_for_search']])))
    $in_insert = false;
if ($__s_sp !== '')
    $in_insert = false;


//---- to avoid MYSQL keywords----------------
$select_fields = implode(array_keys($desc), ', ');
$temp_arr = clean_array(explode(',', $select_fields), true);
$select_fields = array();
$select_fields_insert = array();
foreach ($temp_arr as $key) {
    $select_fields_insert[] = "`" . $table . "`.`" . trim($key) . "`";
    if (strpos($desc[trim($key)]['Type'], 'bit') === false)
        $select_fields[] = "`" . $table . "`.`" . trim($key) . "`";
    else//to handle MYSqL BUG http://bugs.mysql.com/bug.php?id=43670
        $select_fields[] = "`" . $table . "`.`" . trim($key) . '`+0 as `' . $key . "`";
}
$select_fields = implode($select_fields, ', ');
$select_fields_insert = implode($select_fields_insert, ', ');
//------------------------------------------

/* handle $_GET values */
if (($insert_only && $_GET['p'] != '-1') || (isset($_POST['insert']) && $count == 0 && $insert && !$in_insert)) {

    header("Location: index.php?p=-1");
}

if (!$insert && $count == 0)
    die('<div style="padding:10px; border:1px dotted red; color:red; margin:20px auto; font-family:Tahoma; font-size:12px; text-align:center; width:500px;">Table is empty and you don\'t have insert action permission!</div>');

if (((isset($_POST['insert']) && $insert) || ($count == 0 && $_GET['p'] != '-1')) && $count != 0) // go to insert mode
    header("Location: index.php?p=-1");

//security from sql injections
if ((isset($_POST['first']) || !isset($_GET['p']) || empty($_GET['p'])) || ((!is_numeric($_GET['p']) || intval($_GET['p']) > $count || intval($_GET['p']) < -1 || intval($_GET['p']) == 0) && $count != 0))   //got to main page
    header("Location: index.php?p=1");
if (isset($_POST['next'])) //got to next recore
    header("Location: index.php?p=" . (intval($_GET['p']) + 1));
if (isset($_POST['prev'])) //got to previous recore
    header("Location: index.php?p=" . (intval($_GET['p']) - 1));
if (isset($_POST['last'])) // go to last index
    header("Location: index.php?p=" . ($pages));

if (isset($_POST['cancel']) && $in_insert)
    header("Location: index.php?p=1");
else if (isset($_POST['cancel'])) // cancel
    header("Location: index.php?p=" . (intval($_GET['p'])));

$p = intval($_GET['p']);
$navigate = ($p - 1) * $records_per_page;

////////////////////////// delete /////////////////////////////////////////
if (isset($_POST['deletebtn']) && !empty($_POST['deletebtn'])) {
    $indexes_to_delete = $_POST['delete'];
    $selected_records = count($indexes_to_delete);
    $delete_items_arr = array();
    if ($selected_records > 0) {
        $data = query("SELECT $select_fields FROM `$table` $__search $orderBy LIMIT $navigate,$records_per_page", 'ASSOC', $__searchValue, $__searchType, 'Get current rows data to delete exactly what user chose from it');
        $i = $navigate;
        foreach ($data as $row) {
            $i++;
            if (in_array($i, $indexes_to_delete))
                foreach ($unique as $key)
                    $delete_items_arr[$key][] = $row[$key];
        }

        $delete_statemet_arr = array();
        $notification_keys = array();
        $notification_values = array();
        foreach ($delete_items_arr as $key => $val) {
            $notification_values = $val;
            foreach ($notification_values as $v)
                $notification_keys[] = $key;
            if ($desc[$key]['Type'] == 'float' || strpos($desc[$key]['Type'], 'int') > -1 || $desc[$key]['Type'] == 'double' || $desc[$key]['Type'] == 'real')
                $delete_statemet_arr[] = "CONCAT(`$table`.`$key`) IN('" . implode('\', \'', $val) . "')";
            else
                $delete_statemet_arr[] = "`$table`.`$key` IN('" . implode('\', \'', $val) . "')";
        }
        $delete = command("Delete from `$table` where " . implode(' AND ', $delete_statemet_arr) . " limit $selected_records", array(), '', 'to Delete current row');
        //echo "Delete from $table where ".implode(' AND ',$delete_statemet_arr)." limit 1";
        $affected_rows = $dbHandler->get_num_rows();
        if ($delete && $affected_rows > 0) {
            if ($notification_delete)
                send_notification($url, $login_username, 'delete', 'success', '', $notification_values, $notification_keys, $dbHandler->get_num_rows());
            $error = false;
            $case_row = 'row';
            if ($affected_rows > 1)
                $case_row = 'rows';
            $message = "$affected_rows $case_row Deleted Successfully."; //deleted successfully
        }
        else {
            if ($notification_delete)
                send_notification($url, $login_username, 'delete', 'failed', '', $notification_values, $notification_keys, 0);
            $error = true;
            $message = 'No rows affected.';
        }
    }else {
        if ($notification_delete)
            send_notification($url, $login_username, 'delete', 'not_valid', "No rows selected.");
        $error = true;
        $message = "No rows selected.";
    }
}

//////////////////////////////////////////////////////////////////////////////
//inser & update
if (isset($_POST['save']) && !empty($_POST['save']) && $_POST['save'] == 'Save') {

    /* validation system before insert */
    //////////////////////////////////// insert ///////////////////////////////////
    if ($in_insert) { //insert
        validate_inputs($desc);
        $message = implode(', ', $__msg);
        if ($error === true) {
            $user_inputs = get_user_inputs($desc);
            if ($notification_insert)
                send_notification($url, $login_username, 'insert', 'not_valid', $not_valid_reason, $user_inputs[0], $user_inputs[1], $dbHandler->get_num_rows());
        }
        if ($error !== true) {
            $values = array();
            $params_type = '';
      
            foreach ($desc as $key => $val) {
                if(strstr($key,' '))
                 $posted_key = str_replace(" ","_",$key);
                else
                 $posted_key = $key;
                //get data from submitted form
                if ($val['Type'] == 'bit(1)') {
                    //handling the space issue in post arrays
                    
                   
                    $value = isset($_POST['form_' . $posted_key]) ? '1' : '0';
                    array_push($values, "b'" . $value . "'");
                } else{
                    array_push($values, secure_var($_POST['form_' . $posted_key], true));
                  
                    $x = secure_var($_POST['form_' . $posted_key ],true);
                
                    
                }

                if (stripos($val['Type'], 'int') !== false)
                    $params_type .= 'i';
                else if (stripos($val['Type'], 'decimal') !== false || stripos($val['Type'], 'real') !== false || stripos($val['Type'], 'float') !== false || stripos($val['Type'], 'double') !== false)
                    $params_type .= 'd';
                else
                    $params_type .= 's';
            }

            /* using parametric query in insert */
            $params = $values;
            $place_holders = implode(',', array_fill(0, count($params), '?'));
            $sql = "INSERT INTO `$table`($select_fields_insert) Values($place_holders)";
            $values = implode(', ', $values);
            $insert = command($sql, $params, $params_type, 'to insert new row.');
            //echo "INSERT INTO $table($select_fields) Values('$values')";
            $notification_keys = explode(', ', $select_fields_insert);
            if ($insert && $dbHandler->get_num_rows() > 0) {
                if ($notification_insert)
                    send_notification($url, $login_username, 'insert', 'success', '', $params, $notification_keys, $dbHandler->get_num_rows());
                header("Location: index.php?p=$pages&msg=saved"); //go to last page
            }else {//error
                if ($notification_insert)
                    send_notification($url, $login_username, 'insert', 'failed', '', $params, $notification_keys, $dbHandler->get_num_rows());
                $error = true;
                $message = 'Insert failed';
            }
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////// update /////////////////////////////////////
    else { //update
        $i = $navigate;
        $data = query("SELECT $select_fields FROM `$table` $__search $orderBy LIMIT $navigate,$records_per_page", 'ASSOC', $__searchValue, $__searchType, 'Get current rows data to update it exactly');

        foreach ($data as $row) {
            $i++;
            /* validation system before update */
            validate_inputs($desc, $i);
        }
        $message = implode(', ', $__msg);
        $user_inputs = get_user_inputs($desc, $navigate, $i);
        if ($error === true) {
            if ($notification_update)
                send_notification($url, $login_username, 'update', 'not_valid', $not_valid_reason, $user_inputs[0], $user_inputs[1], $dbHandler->get_num_rows());
        }
        if ($error !== true) {
            $i = $navigate;
            $__params = array();
            $numOfUpdatedRows = 0;
            foreach ($data as $row) {
                $numOfUpdatedRows++;
                $i++;
                $values = array();
                $conditions = array();

                foreach (array_keys($row) as $key) {
                    if (in_array($key, $unique) && !is_numeric($key)) {
                        // if($desc[$key]['Type'] == 'float' || $desc[$key]['Type'] == 'double' || $desc[$key]['Type'] == 'real')
                        $conditions[] = 'CONCAT(`' . $table . '`.`' . $key . '`) = \'' . $row[$key] . '\'';
                        //   else
                        //     $conditions[] = "$table.`".$key."` = '".$row[$key]."'";
                    }
                }
                $params = array();
                $params_type = '';
                foreach ($desc as $key => $val) {
                    if(strstr($key," "))
                        $posted_key = str_replace(" ","_",$key);
                    else
                        $posted_key = $key;
                   
                    if ($val['Extra'] != 'auto_increment') {
                        if ($val['Type'] == 'bit(1)') {
                            $value = isset($_POST[$i . '_form_' . $posted_key]) ? '1' : '0';
                            $values[] .= '`' . $key . '` = ?';
                            $params[] = "b'" . $value . "'";
                        } else {
                            $values[] .= '`' . $key . '` = ?';
                            $params[] = secure_var($_POST[$i . '_form_' . $posted_key], true);
                        }

                        if (stripos($val['Type'], 'int') !== false)
                            $params_type .= 'i';
                        else if (stripos($val['Type'], 'decimal') !== false || stripos($val['Type'], 'real') !== false || stripos($val['Type'], 'float') !== false || stripos($val['Type'], 'double') !== false)
                            $params_type .= 'd';
                        else
                            $params_type .= 's';
                    }
                }
                foreach ($params as $key => $val)
                    $__params[] = $val;
                $sql = "UPDATE `$table` SET " . implode(', ', $values) . " where " . implode(' AND ', $conditions);
                $update = command($sql, $params, $params_type, 'to update current rows');
                // echo "UPDATE $table SET ".  implode(', ', $values)." where ".implode(' AND ', $conditions);
            }
            if (!$update) {
                if ($notification_update)
                    send_notification($url, $login_username, 'update', 'failed', '', $__params, $user_inputs[1], $numOfUpdatedRows);
                $error = true;
                $message = 'Update failed';
            }else {

                if ($notification_update)
                    send_notification($url, $login_username, 'update', 'success', '', $__params, $user_inputs[1], $numOfUpdatedRows);
                header("Location: index.php?p=$p&msg=updated");
            }
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////
}

$data = query("SELECT $select_fields FROM `$table` $__search $orderBy LIMIT $navigate,$records_per_page", 'NUM', $__searchValue, $__searchType, 'Get current rows data to display it to user.');
//echo "SELECT $select_fields FROM $table LIMIT $navigate,$records_per_page";
// exit;
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
            .error_border{border:  2px solid red !important ;}
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
                $('input[data_type=dt], input[data_type=d], input[data_type=ts], input[data_type=t]').focus(function(e) {
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
                            var type = new String($(this).attr('data_type'));
                            var value = $(this).val();
                            var obj = $(this);

                            if (($(this).attr('null') == '0' || $(this).attr('null') == '1') && $.trim($(this).val()) == '' && !($(this).attr('extra') == 'auto_increment'))
                            {
                                $(this).addClass('error_border');
                                if (valid)
                                    alert('There are some fields required!');
                                valid = false;
                            }

                            // validation allowed special characters
                            if ($(this).attr('special_char') && $(this).attr('special_char') != 'none' && $(this).attr('extra') != 'auto_increment' && $(this).attr('type') != 'radio' && $(this).attr('relation') != 'yes')
                            {
                                // --------------------------------
                                if ($(this).attr('data_type') == 'd') {
                                    if (value.search(/[^a-z0-9 -]/ig) != -1)
                                    {

                                        $(this).addClass('error_border');
                                        if (valid)
                                            alert(obj.attr('msg'));
                                        valid = false;
                                    }
                                } else if ($(this).attr('data_type') == 't') {
                                    if (value.search(/[^a-z0-9 :]/ig) != -1)
                                    {

                                        $(this).addClass('error_border');
                                        if (valid)
                                            alert(obj.attr('msg'));
                                        valid = false;
                                    }
                                } else if ($(this).attr('data_type') == 'dt') {
                                    if (value.search(/[^a-z0-9 :-]/ig) != -1)
                                    {

                                        $(this).addClass('error_border');
                                        if (valid)
                                            alert(obj.attr('msg'));
                                        valid = false;
                                    }
                                } else if (Contains(type, 'numx'))
                                {
                                    if (value.search(/[^a-z0-9\. ]/ig) != -1)
                                    {

                                        $(this).addClass('error_border');
                                        if (valid)
                                            alert(obj.attr('msg'));
                                        valid = false;
                                    }
                                } else {
                                    if (value.search(/[^a-z0-9 ]/ig) != -1)
                                    {

                                        $(this).addClass('error_border');
                                        if (valid)
                                            alert(obj.attr('msg'));
                                        valid = false;
                                    }
                                }
                                // --------------------------------

                            }
                            //regular expresssion  validation
                            if ($.trim($(this).val()) != '' && $(this).attr('regx') && $(this).attr('type') != 'radio' && $(this).attr('relation') != 'yes')
                            {
                                if (!(new RegExp($(this).attr('regx'), 'g').test($(this).val())) && $(this).parent().children('span').length == 0)
                                {
                                    $(this).addClass('error_border');
                                    if (valid)
                                        alert(obj.attr('msg'));
                                    valid = false;
                                }
                            }

                            if ((parseFloat($(this).val()) < parseFloat($(this).attr('from'))
                                    || parseFloat($(this).val()) > parseFloat($(this).attr('to'))) && $(this).attr('type') != 'radio' && $(this).attr('relation') != 'yes'
                                    )
                            {
                                if (!Contains(type, 'd'))
                                {
                                    $(this).addClass('error_border');
                                    if (valid)
                                        alert(obj.attr('msg'));
                                    valid = false;
                                }
                            }

                            if (Contains(type, 'vc') && $(this).attr('extra') != 'auto_increment' && $(this).attr('type') != 'radio' && $(this).attr('relation') != 'yes')
                            {
                                //alert(type);
                                type = parseInt(type.substr(type.indexOf(',') + 1).replace(' ', ''));
                                if ($(this).val().length > type)
                                {
                                    $(this).addClass('error_border');
                                    if (valid)
                                        alert(obj.attr('msg'));
                                    valid = false;
                                }
                            }

                            if (Contains(type, 'y') && $(this).attr('extra') != 'auto_increment' && $(this).attr('type') != 'radio' && $(this).attr('relation') != 'yes')
                            {
                                var patt = /^[12][0-9][0-9][0-9]$/g;
                                if (!(patt.test($(this).val())))
                                {
                                    $(this).addClass('error_border');
                                    if (valid)
                                        alert(obj.attr('msg'));
                                    valid = false;
                                }
                            }


                            if ($(this).attr('extra') != 'auto_increment' && $(this).attr('type') != 'radio' && $(this).attr('relation') != 'yes' &&
                                    (
                                            Contains(type, 'num')
                                            || Contains(type, 'numx')
                                            )) {

                                if (isNaN($(this).val()))
                                {
                                    $(this).addClass('error_border');
                                    if (valid)
                                        alert(obj.attr('msg'));
                                    valid = false;
                                }
                            }



                        });


                        $('select[relation=yes]').each(function() {
                            if (($(this).attr('null') == '0' || $(this).attr('null') == '1') && $(this).val() == '0') //validate refrenced table relationship
                            {

                                $(this).addClass('error_border');
                                if (valid)
                                    alert('There are some fields required!');
                                valid = false;

                            }

                        });
                    } catch (exception) {

                    }

                    if (!valid)
                        e.preventDefault();
                });

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

            function check_all(obj)
            {
                $('td input[name="delete[]"]').attr('checked', obj.checked);
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

                $('td input[name="delete[]"]').click(function() {
                    $('#checkAll').attr('checked', false);
                });
            });
        </script>
    </head>
    <body>
        <form  id="myform" name="myform" method="post">
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
                <div style="overflow-x: auto;">
                        <?php if ((($search !== '' && $count > 0) || $search === '' ) && $__s_sp === "") { ?>
                        <table class="form-grid" style="width: 100%;" border="0" cellspacing="2" cellpadding="1">
                            <?php
                            //header
                            $new_desc = change_schema($desc);
                            $str = '<tr>';
                            if ($delete && !$in_insert)
                                $str .= '<td class="red-lbl"><div style="width:37px;"><input id="checkAll" onclick="check_all(this)"   type="checkbox"  />#</div></td>';
                            foreach ($desc as $key => $val) {
                                $str .= '<td class="red-lbl"><a href="" class="order-control" onclick="return false;" style="text-decoration: none;color: inherit;display: inline-block;width: 100%;">' . $val['Label'] . '<span class="" style="float: right;margin-right: 5px;"></span></a></td>';
                            }

                            $str .= '</tr>';


                            //data
                            if ($in_insert) {
                                //insert row
                                $str .= '<tr>';
                                foreach ($desc as $key => $val) {
                                    $attr = 'msg="' . $val['validation']['msg'] . '"';
                                    $attr .= 'from="' . $val['validation']['from'] . '"';
                                    $attr .= 'to="' . $val['validation']['to'] . '"';
                                    $attr .= 'special_char="' . $desc[$val]['validation']['special_char'] . '"';
                                    $attr .= 'regx="' . $val['validation']['regx'] . '"';
                                    $attr .= 'data_type="' . $new_desc[$key]['Type'] . '"';
                                    $attr .= 'null="' . $val['Null'] . '"';
                                    $attr .= 'extra="' . $val['Extra'] . '"';
                                    $attr .= 'key="' . $val['Key'] . '"'; //&quot;
                                    $value = htmlspecialchars($_POST['form_' . $key]);
                                    if ($val['Extra'] == 'auto_increment')
                                        $str .= '<td class="input-td" style="text-align:center;">(Auto)</td>';
                                    else if (array_key_exists('REFERENCED_TABLE_NAME', $val)) {
                                        $tbl_name = secure_var($val['REFERENCED_TABLE_NAME']);
                                        $joinedtabledate = query("select * from $tbl_name", 'ASSOC');
                                        $str_td = '<select relation="yes" ' . $attr . ' name="09_sfm_x8_' . $key . '">';
                                        $str_td .= '<option style="width:156px;" value="0">Select</option>';
                                        foreach ($joinedtabledate as $row_tbl) {
                                            if ($value == $row_tbl[$val['REFERENCED_COLUMN_NAME']])
                                                $str_td.= '<option selected value="' . $row_tbl[$val['REFERENCED_COLUMN_NAME']] . '">' . $row_tbl[$val['TextField']] . '</option>';
                                            else
                                                $str_td.= '<option  value="' . $row_tbl[$val['REFERENCED_COLUMN_NAME']] . '">' . $row_tbl[$val['TextField']] . '</option>';
                                        }
                                        $str_td .= '</select>';
                                        $str .= '<td>' . $str_td . '</td>';
                                    }
                                    else if (strpos($val['Type'], 'set') > -1 || strpos($val['Type'], 'enum') > -1) {
                                        $items = '';
                                        if (strpos($val['Type'], 'set') > -1)
                                            $items = substr($val['Type'], 4, count($val['Type']) - 2);
                                        else
                                            $items = substr($val['Type'], 5, count($val['Type']) - 2);
                                        $items = explode(',', $items);

                                        $str_select = '<td><select ' . $attr . ' name="' . $i . '_09_sfm_x8_' . $val . '">';
                                        foreach ($items as $item) {
                                            $item = str_replace("'", "", $item);
                                            $selected = ($item == $value) ? 'selected' : '';
                                            $str_select .= "<option $selected  value=\"$item\">$item</option>";
                                        }
                                        $str .= $str_select . '</select></td>';
                                    } else if ($val['Type'] == 'bit(1)') {
                                        $str_td = '<td style="text-align:center;">';
                                        $checked = ($value == '1') ? 'checked' : '';
                                        $str_td .= '<input type="checkbox" name="09_sfm_x8_' . $key . '" ' . $checked . ' />';
                                        $str .= $str_td . '</td>';
                                    } else if ($val['Type'] == 'tinyint(1)') {
                                        $str_td = '<td>';

                                        $str_td .= '<select name="09_sfm_x8_' . $key . '"><option ';
                                        if ($value == '0')
                                            $str_td .= 'selected ';
                                        $str_td .= 'value="0">False</option><option value="1" ';

                                        if ($value == '1')
                                            $str_td .= 'selected ';

                                        $str_td .= '>True</option></select></td>';
                                        $str .= $str_td;
                                    }
                                    /* else if(stristr($val['Type'], 'blob'))
                                      $str_td .= '<input '.$attr.' value=\''.$value.'\' name="'.$form_name.'" />'; */
                                    else {
                                        $str .= '<td class="input-td"><input ' . $attr . ' name="09_sfm_x8_' . $key . '" class="txtbox" style=" font-family:Tahoma;" value="' . $value . '" /></td>';
                                    }
                                }
                                $str .= '</tr>';
                            } else {//update show  (text fields)
                                $i = $navigate;
                                foreach ($data as $row) {
                                    $i++;
                                    $str .= '<tr>';
                                    if ($delete)
                                        $str .= '<td class="red-lbl"><input name="delete[]" type="checkbox" value="' . $i . '" />' . $i . '</td>';

                                    foreach (array_keys($desc) as $key => $val) {
                                        if ($update) {
                                            $attr = 'msg="' . $desc[$val]['validation']['msg'] . '"';
                                            $attr .= 'from="' . $desc[$val]['validation']['from'] . '"';
                                            $attr .= 'to="' . $desc[$val]['validation']['to'] . '"';
                                            $attr .= 'special_char="' . $desc[$val]['validation']['special_char'] . '"';
                                            $attr .= 'regx="' . $desc[$val]['validation']['regx'] . '"';
                                            $attr .= 'data_type="' . $new_desc[$val]['Type'] . '"';
                                            $attr .= 'null="' . $desc[$val]['Null'] . '"';
                                            $attr .= 'extra="' . $desc[$val]['Extra'] . '"';
                                            $attr .= 'key="' . $desc[$val]['Key'] . '"';
                                            $value = htmlspecialchars($row[$key]);
                                            if ($desc[$val]['Extra'] == 'auto_increment')
                                                $str .= '<td class="input-td" style="text-align:center;">' . $value . '</td>';
                                            else if (array_key_exists('REFERENCED_TABLE_NAME', $desc[$val])) {
                                                $tbl_name = secure_var($desc[$val]['REFERENCED_TABLE_NAME']);
                                                $joinedtabledate = query("select * from $tbl_name", 'ASSOC');
                                                $str_td = '<select relation="yes" ' . $attr . ' name="' . $i . '_09_sfm_x8_' . $val . '">';
                                                $str_td .= '<option style="width:156px;" value="0">Select</option>';
                                                foreach ($joinedtabledate as $row_tbl) {
                                                    if ($row[$key] == $row_tbl[$desc[$val]['REFERENCED_COLUMN_NAME']] && !$in_insert)
                                                        $str_td.= '<option selected value="' . $row_tbl[$desc[$val]['REFERENCED_COLUMN_NAME']] . '">' . $row_tbl[$desc[$val]['TextField']] . '</option>';
                                                    else
                                                        $str_td.= '<option  value="' . $row_tbl[$desc[$val]['REFERENCED_COLUMN_NAME']] . '">' . $row_tbl[$desc[$val]['TextField']] . '</option>';
                                                }
                                                $str_td .= '</select>';
                                                $str .= '<td>' . $str_td . '</td>';
                                            }
                                            else if (strpos($desc[$val]['Type'], 'set') > -1 || strpos($desc[$val]['Type'], 'enum') > -1) {
                                                $items = '';
                                                if (strpos($desc[$val]['Type'], 'set') > -1)
                                                    $items = substr($desc[$val]['Type'], 4, count($desc[$val]['Type']) - 2);
                                                else
                                                    $items = substr($desc[$val]['Type'], 5, count($desc[$val]['Type']) - 2);
                                                $items = explode(',', $items);

                                                $str_select = '<td><select ' . $attr . ' name="' . $i . '_09_sfm_x8_' . $val . '">';
                                                foreach ($items as $item) {
                                                    $item = str_replace("'", "", $item);
                                                    $selected = ($item == $value) ? 'selected' : '';
                                                    $str_select .= "<option $selected  value=\"$item\">$item</option>";
                                                }
                                                $str .= $str_select . '</select></td>';
                                            } else if ($desc[$val]['Type'] == 'bit(1)') {
                                                $str_td = '<td>';
                                                $checked = ($value == '1') ? 'checked' : '';
                                                $str_td .= '<input type="checkbox" name="' . $i . '_09_sfm_x8_' . $val . '" ' . $checked . ' />';
                                                $str .= $str_td . '</td>';
                                            } else if ($desc[$val]['Type'] == 'tinyint(1)') {
                                                $str_td = '<td>';

                                                $str_td .= '<select name="' . $i . '_09_sfm_x8_' . $val . '"><option ';
                                                if ($value == '0')
                                                    $str_td .= 'selected ';
                                                $str_td .= 'value="0">False</option><option value="1" ';

                                                if ($value == '1')
                                                    $str_td .= 'selected ';

                                                $str_td .= '>True</option></select></td>';
                                                $str .= $str_td;
                                            }
                                            else {
                                                $str .= '<td class="input-td"><input ' . $attr . ' name="' . $i . '_09_sfm_x8_' . $val . '" class="txtbox" style=" font-family:Tahoma;" value="' . $value . '" /></td>';
                                            }
                                        } else {
                                            $text = $row[$key];
                                            if (strlen($text) > 50)
                                                $text = substr($text, 0, 50) . '...';
                                            $str .= '<td class="input-td" title="' . $row[$key] . '"><input name="' . $i . '_09_sfm_x8_' . $val . '" class="txtbox" readonly style="font-family:Tahoma;" value="' . $row[$key] . '" /></td>';
                                        }
                                    }

                                    $str .= '</tr>';
                                }
                            }

                            echo $str;
                            ?>

                        </table>
                    </div>
                    <table class="form-grid" width="100%" border="0" cellspacing="2" cellpadding="1">    
                        <tr>
                            <td colspan="6" align="center">
                                <div id="controls"><?php if ($insert) { ?>
                                        <input id="btnInsert" type="submit" value="Insert"  class="btn"  name="insert" />
                            <?php } ?>
                            <?php if ($update) { ?>
                                        <input id="btnUpdate" type="button" value="Update" class="btn"  name="update" /> 
                            <?php } ?>
                            <?php if ($delete) { ?>
                                        <input  id="btnDelete" type="submit" value="Delete" onclick="return  confirm('Are you sure that you want to delete the row?');" class="btn"  name="deletebtn" /> 
                            <?php } ?></div>
                                <div id="actions" style="display: none;" >

                                    <input id="btnSave" type="submit" value="Save"  class="btn"  name="save" />  
                                    <input id="btnCancel"  type="submit" value="Cancel"  class="btn"  name="cancel" /> 
                                </div>
                            </td>
                        </tr>
                        <tr <?php if ($insert_only) echo 'style="display:none;"'; ?>>
                            <td colspan="5" >
                                <div class="pager">
                                    <input type="submit" name="first" class="pager-btn" <?php if ($p == 1) echo 'disabled'; ?> value="<<" />
                                    <input type="submit" name="prev" class="pager-btn" <?php if ($p == 1) echo 'disabled'; ?> value="<" />
                                    <input id="record" type="text" class="pager-records" value="<?php if ($in_insert) echo '*';
                        else echo $p; ?>"/>
                                    <input type="submit" name="next" class="pager-btn" <?php if ($p == $pages) echo 'disabled'; ?> value=">" />
                                    <input type="submit" name="last" class="pager-btn" <?php if ($p == $pages) echo 'disabled'; ?> value=">>" />   
                                    Of <?php echo $pages; ?>

                                </div>

                            </td>
                        </tr>
                    </table>
    <?php
    if (isset($_GET['msg']) && !$error && $message == '') {
        if ($_GET['msg'] == 'saved')
            $message = 'Row Inserted Successfully.';
        else if ($_GET['msg'] == 'deleted')
            $message = 'Row Deleted Successfully.';
        else if ($_GET['msg'] == 'updated')
            $message = 'Data Updated Successfully.';
    }

    if ($message != '') {
        ?>
                        <div class="err <?php if ($error) echo 'error';
        else echo 'success'; ?>-message"><?php echo $message; ?></div>
    <?php } ?>
<?php }else { ?>
    <?php if ($__s_sp == "") { ?>
                        <div style="font-size: 16px;font-weight: 400;padding: 10px; margin: 10px;">Search result: There is no result found, please click Show All button.</div>
    <?php } else { ?>
                        <div style="font-size: 16px;font-weight: 400;padding: 10px; margin: 10px;">Search result: No special characters allowed, for security reason.</div>
                    <?php } ?>
                <?php } ?>
            </div>
            <input type="hidden" value="<?php if (isset($_SESSION[$form_prefix . 'orderBy'])) echo $_SESSION[$form_prefix . 'orderBy']; ?>" name="orderBy" id="orderBy">
                <input type="hidden" value="<?php if (isset($_SESSION[$form_prefix . 'ordinaryType'])) echo $_SESSION[$form_prefix . 'ordinaryType']; ?>" name="ordinaryType" id="ordinaryType">
                    </form>
                    <script type="text/javascript">
                        var __desc = <?php echo $__desc ?>;
                        var count = <?php echo $pages; ?>;
                        var index = '<?php if ($in_insert) echo '*';
                else echo $p; ?>';
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
                                        window.location = 'index.php?p=' + val;
                                }

                            });

                            $('#selected_style').val('<?php echo $style_name; ?>');

                            $('.order-control > span').addClass('glyphicon glyphicon-play up');
<?php if (isset($_SESSION[$form_prefix . 'orderBy'])) { ?>
                                $('.order-control').each(function() {
                                    if ($(this).text().trim() === "<?php echo trim($_SESSION[$form_prefix . 'orderBy']); ?>") {
                                        if ($('#ordinaryType').val() === 'DESC')
                                        {
                                            $(this).children().removeClass();
                                            $(this).children().addClass('glyphicon glyphicon-play up');
                                        } else {
                                            $(this).children().removeClass();
                                            $(this).children().addClass('glyphicon glyphicon-play down');
                                        }
                                    }
                                });
<?php } ?>

                            $('.order-control').mousedown(function(e) {
                                e.preventDefault();
                                $('#orderBy').val($(this).text().trim());

<?php if (isset($_SESSION[$form_prefix . 'orderBy'])) { ?>
                                    if ($(this).text().trim() === "<?php echo trim($_SESSION[$form_prefix . 'orderBy']); ?>")
                                    {
                                        if ($('#ordinaryType').val() === 'DESC')
                                        {
                                            $('#ordinaryType').val('');
                                        }
                                        else
                                        {
                                            $('#ordinaryType').val('DESC');
                                        }
                                    }
                                    else {
                                        $('#ordinaryType').val('');
                                    }
<?php } else { ?>
                                    $('#ordinaryType').val('');
<?php } ?>

                                $('#myform').trigger('submit');
                            });


<?php if (isset($_GET['p']) && $_GET['p'] < 0) { ?>
                                $('.order-control > span').removeClass();
<?php } ?>

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
