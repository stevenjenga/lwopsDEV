<?php
session_start();
session_regenerate_id(); //protection against session hijacking
error_reporting(E_ERROR  | E_PARSE);
if (! defined('DIRECTACESS')) exit('No direct script access allowed');
require_once("config.php");
require_once("../helpers/DatabaseHandler.php");
require_once("../helpers/safeValue.php");
$possible_attack = false;
$flush = false; //flag to send the logging data , it turns to true when the log message is complete
$used_extension = "";
$report_key = sha1(str_replace(" ", "_", $file_name) . "secure_login");
$report_token = md5(str_replace(" ", "_", $file_name) . $db . loginedin_code_1701);
$_GET = remove_unexpected_superglobals($_GET, array("debug_mode_6","start","print",'export'));
$_POST = remove_unexpected_superglobals($_POST, array("search_field","keyWord","keyWord2","btnSearch","HdSearchval","txtordnary_search","btnordnary_search","btnShowAll","btnShowAll2"));
$_COOKIE = array();
if (isset($security)) {
    if ($security == "enabled" || $members == "enabled" || !empty($security) || !empty($members)) {
        if (!isset($_SESSION[$report_key]) || $_SESSION[$report_key] != $report_token){
            header("location: login.php");
            Die("<center> Access Denied! </center>");
        }
    }
}




if (is_exist($_GET["debug_mode_6"])) {
    $url_param = $_GET["debug_mode_6"
            . ""];
}



debug("## Data Sent to report : \n");
debug("\n   - The Post array \n");
log_array($_POST);
debug("\n   - The Get array \n");
log_array($_GET);
//debug("\n   - The SESSION array \n");
//log_array($_SESSION);
debug("\n## Cleaning data sent to the report :  \n");
debug("\n cleaning Post array \n");

$_POST = clean_input_array($_POST);
log_array($_POST);
debug("\n   - cleaning Get array : \n");
$_GET = clean_input_array($_GET);
log_array($_GET);
debug(" ## End of Data Cleaning \n");

function check_debug_mode() {
    // check for debug mode
    global $maintainance_email, $security, $sec_pass, $sec_user, $sec_Username, $url_param, $testing;


    //2 screen debuging + email debuging (shouldn't exist in live version
    //1 email debugging only
    //0 No debugging at all
    if (is_exist($url_param) && $url_param == "1701") {
        if (is_exist($maintainance_email) && (filter_var($maintainance_email, FILTER_VALIDATE_EMAIL))) {

            return 1;
        }
    } else {

        return 0;
    }
}

function debug($str, $flush = false) {
    global $maintainance_email, $debug_message;
    if (check_debug_mode() == 1) {

        logging($str);
    } else {
        return false;
    }
}

$pass = decode($pass);
if ($datasource == 'sql' || !isset($table)) {
    $table = array();
    $result = query($sql, "Lib Get Tables");
    while ($i < count($result)) {
        //echo "Information for column $i:<br />\n";
        $meta = $result[$i];
        if (in_array($meta->table, $table) == false)
            $table[] = $meta->table;
        $i++;
    }
}


if (!isset($tables_filters) || empty($tables_filters))
    $tables_filters = array();
if (!isset($relationships) || empty($relationships))
    $relationships = array();
if (!isset($table) || empty($table))
    $table = array();
if (!isset($fields) || empty($fields))
    $fields = array();
if (!isset($fields2) || empty($fields2))
    $fields2 = array();
if (!isset($group_by) || empty($group_by))
    $group_by = array();
if (!isset($sort_by) || empty($sort_by))
    $sort_by = array();

if (!isset($chkSearch))
    $chkSearch = 'Yes';
if (empty($chkSearch) || $chkSearch != 'Yes')
    $chkSearch = 'Yes';


//get lables

$labels = unserialize($labels);
if (is_exist($affected_column)) {
    $labels = h_aggregation_arr($labels);
}

$group_by_source = $group_by;
$fields_source = $fields;
$actual_fields_source = array_values(array_diff($fields_source, $group_by_source));

/* Logging configuarations
 * *****************************************************************************************
 */


debug("\n ## Data Source : $datasource\n ");
debug("\n ## Table(s) : \n");
debug(implode($table, "  \n   ") . "\n");
debug("\n ## Filter(s) : \n");
debug(implode($tables_filters, "\n") . "\n");
debug("\n ## Relations(s) : \n");
debug(implode($relationships, "\n") . "\n");
debug("\n ## Fields(s) : \n");
debug(implode($fields, "\n") . "\n");
debug("\n ## Extension : $db_extension \n");
debug("\n ## Search : $chkSearch \n");

//debug("*********************************** \n ");


/* Serching
 * *****************************************************************************************
 */

function secure_var($var) {
    // this function is used to secure any search parameters from both CSS and Sql injection
    $dbHandler = connect();
    $var = trim(clean_input($var));
    $var = $dbHandler->sanitize_values($var);
    $dbHandler->close_connection();
    return $var;
}

function get_param_type($var) {
    // this function should be used with numeric parameters to decide wether it is an integer or double
    $int_var = (int) $var;

    if ($var == $int_var) {
        return "i";
    } else {
        return "d";
    }
}

function advanced_search($_dataType, $_field, $_keyword, $_keyWord2 = "") {
    /*
     *  this function is called only from within the prepare_search_statment function
      it handles the advanced search with different data types */
    Global $_SESSION,$report_key;

    $results = array();
    if ($_dataType === "int" && is_numeric($_keyword)) {

        if (!empty($_keyWord2) && is_numeric($_keyWord2)) {
            // $results["sql"]= "$_field >= $_keyword and $_field <= $_keyWord2 ";
            $results["sql"] = "$_field >= ? and $_field <= ? ";
            $results["parameters"] = array($_keyword, $_keyWord2);

            $results["types"] = get_param_type($_keyword);
            $results["types"] .= get_param_type($_keyWord2);
            return $results;
        } else {
            // $results["sql"]= "$_field >= $_keyword ";
            $results["sql"] = "$_field >= ? ";
            $results["parameters"] = array($_keyword);
            $results["types"] = get_param_type($_keyword);
            // $_SESSION["srm_temp_search".$report_key] = $results;            
            return $results;
        }
    } elseif ($_dataType === "date" && is_date($_keyword)) {

        if (!empty($_keyWord2) && is_date($_keyWord2)) {
            // $results["sql"] = "$_field >= '$_keyword' and $_field <= '$_keyWord2' ";
            $results["sql"] = "$_field >= ? and $_field <= ? ";
            $results["parameters"] = array($_keyword, $_keyWord2);
            $results["types"] = "ss";
            return $results;
        } else {
            // $results["sql"] = "$_field >= $_keyword ";
            $results["sql"] = "$_field >= ? ";
            $results["parameters"] = array($_keyword);
            $results["types"] = "s";
            return $results;
        }
    } elseif ($_dataType === "string") {
        // $results["sql"] = "CONCAT( ". $_field . ") like '%" . $_keyword ."%'";
        $results["sql"] = "CONCAT( " . $_field . ") like ? ";
        $results["parameters"] = array("%" . $_keyword . "%");
        $results["types"] = "s";
        return $results;
    } elseif ($_dataType === "bool" && (is_bool($_keyword) || $_keyword == 1 || $_keyword == 0)) {
        // $results["sql"] = "$_field = $_keyword";
        $results["sql"] = "$_field = ?";
        $results["parameters"] = array($_keyword);
        $results["types"] = "i";
        return $results;
    } else {
        return false;
    }
}

function prepare_search_statment() {
    // this function prepare the search statment of all types of search

    global $_POST, $_SESSION, $possible_attack, $fields,$report_key,$table;

    $results = array();

    if (is_exist($_POST['btnSearch']))
        $_btnSearch = $_POST['btnSearch'];
    if (is_exist($_POST['btnShowAll']))
        $_btnShowAll = $_POST['btnShowAll'];
    if (is_exist($_POST['btnordnary_search']))
        $_btnordnary_search = $_POST['btnordnary_search'];
    if (is_exist($_POST['btnShowAll2']))
        $_btnShowAll2 = $_POST['btnShowAll2'];


    if (is_exist($_btnordnary_search)) {

        debug("************Ordinary  Search*************");
        $conditions = array();
        if (!is_clean($_POST['txtordnary_search'], false, true)) {
            $possible_attack = true;
            $_SESSION["srm_temp_search".$report_key] = array();
            return $results;
        } else {
            $_txtordnary_search_ = secure_var($_POST['txtordnary_search']);
        }
        foreach ($fields as $key => $val) {
            $field = '';

            if (!strstr($val, "(")) {
                if (count($table) == 1) {

                    $fildval = "`" . $val . "`";
                } else {
                    $field = explode('.', $val);

                    $fildval = "`" . $field[0] . "`." . "`" . $field[1] . "`";
                }
            }

            // $conditions[] = 'CONCAT(' . $fildval . ') like \'%' . $_txtordnary_search_ . '%\'';
            $conditions[] = 'CONCAT(' . $fildval . ') like ? ';
        }
        if (count($conditions) > 0)
            $conditions = '(' . implode(' OR ', $conditions) . ')';
        // var_dump($conditions);
        // $_SESSION['srm_search_searchquery'] = $conditions;
        $_SESSION["srm_temp_search".$report_key] = array();
        $results["sql"] = $conditions;
        $results["types"] = "";
        $results["parameters"] = array();
        for ($i = 0; $i < count($fields); $i++) {
            $results["parameters"][$i] = '%' . $_txtordnary_search_ . '%';
            $results["types"].="s";
        }
        $_SESSION["srm_temp_search".$report_key] = $results;
        return $results;
    } elseif (!empty($_btnSearch)) {
        //$_SESSION["srm_temp_search".$report_key] = "";
        $_keyWord2 = "";
        $_dataType = "string";
        if (is_exist($_POST["keyWord"]))
            $_keyword = $_POST["keyWord"];
        if (is_exist($_POST["search_field"]))
            $_field = $_POST["search_field"];
        if (is_exist($_POST["keyWord2"]))
            $_keyWord2 = $_POST["keyWord2"];
        $dataTypes = array("int", "string", "bool", "date");
        if (is_exist($_POST["HdSearchval"]) && in_array($_POST["HdSearchval"], $dataTypes))
            $_dataType = $_POST["HdSearchval"];


        debug("************ Advanced Search *************");
        debug("Search Parameters : \n keyword : $_keyword \n Second KeyWord : $_keyWord2 \n Data Type : $_dataType ");


        $_edited_field = str_replace("`", "", $_field);

        if (!is_clean($_keyword, false, true) || !is_clean($_keyWord2, false, true) || !in_array($_edited_field, $fields) || !is_clean($_dataType, true, true)) {
            $possible_attack = true;
            $_SESSION["srm_temp_search".$report_key] = array();
            return $results;
        } else {
            $_keyword = secure_var($_keyword);
            $_keyWord2 = secure_var($_keyWord2);
            $_field = secure_var($_field);
            $result = advanced_search($_dataType, $_field, $_keyword, $_keyWord2);
            $_SESSION["srm_temp_search".$report_key] = $result;
            return $result;
        }
    } elseif (!empty($_btnShowAll)) {
        //$_SESSION['srm_search_searchquery'] = "";
        $_SESSION["srm_temp_search".$report_key] = array();
        return $results;
    } elseif (!empty($_btnShowAll2)) {
        //$_SESSION['srm_search_searchquery'] = "";
        $_SESSION["srm_temp_search".$report_key] = array();
        return $results;
    } else {
        //$_SESSION["srm_temp_search".$report_key] = ""; 
        return $results;
    }
}

function get_default_value($var) {
    global $_POST;
    if (!empty($_POST[$var]) || is_numeric($_POST[$var])) {
        return $_POST[$var];
    }
}

/* Sending Queries
 * *****************************************************************************************
 */

function connect() {
    global $host, $user, $pass, $db, $db_extension, $used_extension;
    $extensions = array("pdo", "mysqli", "mysql");
    if (is_exist($db_extension) && in_array(strtolower($db_extension), $extensions)) {
        $extension = $db_extension;
    } else {
        $extension = "";
    }

    if (check_debug_mode() == 1) {
        $dbHandler = new DatabaseHandler($host, $user, $pass, $db, true, $extension);
    } else {
        $dbHandler = new DatabaseHandler($host, $user, $pass, $db, false, $extension);
    }
    if (!$dbHandler || $dbHandler->is_connection_failed()) {
        Die("Internal System Error");
        return false;
    }
    $used_extension = $dbHandler->get_used_extension();
    debug("\n Used Extension : $used_extension \n");
    return $dbHandler;
}

function query($query, $stacktrace = "query", $params = array(), $paramsType = "") {
    global $possible_attack, $flush, $maintainance_email,$report_key;
    if ($possible_attack === true)
        return array();
    debug("\n *** New Request  at: " . date('Y-m-d H:i:s') . " -----------------------------------------------------> \n \n");
    debug("\n ## calling function : $stacktrace  \n");

    $dbHandler = connect();


    if (empty($params)) {
        $params = array();
        $paramsType = '';
        debug("\n No parameters passed ");
    } else {

        debug("\n  <Parameters> :  " . implode("\n  * parameter: ", $params));
        debug("\n  <parameter types> : $paramsType");

        //protection against XSS
        $params = clean_input_array($params);
        debug("\n  <Cleaned Parameters> :  " . implode("\n  * parameter: ", $params));

        // protection against SQL injection
        $params = $dbHandler->sanitize_array($params);

        debug("\n  <sanitized parameters> :  " . implode("\n  * parameter: ", $params));
    }

    if (!$dbHandler || $dbHandler->is_connection_failed()) {
        if ($flush && check_debug_mode() == 1)
            send_log_info($maintainance_email);
        // debug("\n  Connection error :  ");
        return false;
    }


    debug("\n ## Sql query : $query  \n   ");
    if (!$result = @$dbHandler->query($query, "ASSOC", $params, $paramsType)) {

        //debug("##$stacktrace :  $query  <br\>   **Invalid query : Error# " . mysql_errno() . ": " . mysql_error()."\n \n ");
        if ($flush && check_debug_mode() == 1)
            send_log_info($maintainance_email);
        return false;
    }
    $dbHandler->close_connection();
    debug("\n \n*** End of the request at: " . date('Y-m-d H:i:s') . "\n");
    if ($flush && check_debug_mode() == 1)
        send_log_info($maintainance_email);
    //  debug ("array returned ". count($result). rows);
    return $result;
}

/* SPrepare Data source for reports based on tables
 * *****************************************************************************************
 */

// preparing the datasource
function Prepare_TSql() {
    global $fields,$report_key, $table, $sort_by, $_SESSION, $group_by, $affected_column, $groupby_column, $relationships, $tables_filters;

    $funcations_arr = array("sum(", "avg(", "min(", "max(", "count(");

    $sql = "select ";
    $c = 0;
    foreach ($fields as $f) {
        if (count($table) != 1) {
            //check if this is a function field
            $isFunction = 0;
            foreach ($funcations_arr as $key => $val) {
                if (strstr($f, $val)) {
                    $isFunction = 1;
                    break;
                }
            }

            $temp = explode(".", $f);
            $t = $temp[0];
            $f = $temp[1];
            if ($isFunction == 1) {
                $sql .= "$t`.`$f ";
                $sql .= " as '" . substr($f, 0, strlen($f) - 2) . "'";
            } else {
                $sql .= "`$t`.`$f` ";
                $sql .= " as '$f'";
            }
        } else {
            $isFunction = 0;
            foreach ($funcations_arr as $key => $val) {
                if (strstr($f, $val)) {
                    $isFunction = 1;
                    break;
                }
            }
            if ($isFunction == 0)
                $sql .= "`$f`";
            else
                $sql .= "$f";
        }
        if ($c < (count($fields) - 1))
            $sql .= ",";
        $c++;
    }

    //add tables names
    $sql .= " from ";
    foreach ($table as $key => $val)
        $sql .= "`$val`,";
    $sql = substr($sql, 0, strlen($sql) - 1);

    //add relations
    if (!empty($relationships) && count($relationships) > 0) {
        $sql .= " where";
        foreach ($relationships as $key => $val) {
            $sql .= " $val" . " and";
        }
        $sql = substr($sql, 0, strlen($sql) - 3);
    }



    if (count($tables_filters) > 0) {
        if (count($relationships) > 0) {
            $sql .= " and";
        } else {
            $sql .= " where";
        }

        foreach ($tables_filters as $key => $val) {

            $newVal = str_replace("\\", " ", $val);


            $newVal = str_replace("<->", " ", $newVal);
            $newVal = str_replace("\\", "", $newVal);
            $sql .= "( $newVal)" . " and";
        }
        $sql = substr($sql, 0, strlen($sql) - 3);
    }


    // echo "search criteria = $x";


    $search_array = prepare_search_statment();
    if (!empty($_SESSION["srm_temp_search".$report_key])) {
        $search_array = $_SESSION["srm_temp_search".$report_key];
    }

    if (is_exist($search_array)) {
        if (is_array($search_array)) {
            $search_sql = $search_array["sql"];
            $parameters = $search_array["parameters"];
            $types = $search_array["types"];
        } else {
            $search_sql = $search_array;
        }
        if (!empty($relationships) || count($tables_filters) > 0) {
            $sql .=" and " . $search_sql;
        } else {
            $sql .= " where " . $search_sql;
        }
    }


    //group by in case of statistics
    if (!empty($groupby_column)) {

        $grp_ar = explode(".", $groupby_column);

        if (count($grp_ar) > 1) {
            $sql .= " group by (`" . $grp_ar[0] . "`.`" . $grp_ar[1] . "`) ";
        } else {
            $sql .= " group by (`" . $grp_ar[0] . "`) ";
        }
    }

    if (count($sort_by) > 0 || count($group_by) > 0)
        $sql .= " order by ";

    $group_by_sort = array();
    foreach ($group_by as $g) {
        $flag = 0;
        $i = 0;

        foreach ($sort_by as $arr) {
            if ($g == $arr[0]) {
                $group_by_sort[] = array($arr[0], $arr[1]);
                $flag = 1;
                $sort_by[$i][0] = '~xxx~';
                break;
            }
            $i++;
        }
        if ($flag == 0) {
            $group_by_sort[] = array($g, '0');
        }
    }

    foreach ($sort_by as $arr_sort) {
        if ($arr_sort[0] != '~xxx~') {
            $group_by_sort[] = array($arr_sort[0], $arr_sort[1]);
        }
    }
    $i = 0;
    foreach ($group_by_sort as $arr) {
        if (count($table) != 1) {
            $dummy = explode(".", $arr[0]);
            $sql .= "`" . $dummy[0] . "`.`" . $dummy[1] . "`";
        } else {
            $sql .= "`" . $arr[0] . "`";
        }

        if ($arr[1] == '1')
            $sql.= "desc";
        if ($i < (count($group_by_sort) - 1)) {
            $sql .=",";
        }
        $i++;
    }

    $new_fields = array();
    $new_sort_by = array();
    $new_group_by = array();

    //fields
    foreach ($fields as $key => $val) {
        //check if it's function field
        $isFunction = 0;
        foreach ($funcations_arr as $key1 => $val1) {
            if (strstr($val, $val1)) {
                $isFunction = 1;
                break;
            }
        }

        $temp = explode(".", $val);
        $t = $temp[0];
        $f = $temp[1];
        if ($isFunction == 1) {
            $new_fields[] = substr($f, 0, strlen($f) - 2);
        } else {
            $new_fields[] = $f;
        }
    }
    if (count($table) != 1)
        $fields = $new_fields;

    //sort_by

    foreach ($sort_by as $key => $arr) {
        $temp = explode(".", $arr[0]);
        $t = $temp[0];
        $f = $temp[1];

        $new_sort_by[] = array($f, $arr[1]);
    }
    if (count($table) != 1)
        $sort_by = $new_sort_by;


    //group_by
    foreach ($group_by as $key => $val) {
        $temp = explode(".", $val);
        $t = $temp[0];
        $f = $temp[1];

        $new_group_by[] = $f;
    }
    if (count($table) != 1)
        $group_by = $new_group_by;

    if (is_exist($parameters) && is_exist($types)) {
        $arr_sql[0] = $sql;
        $arr_sql[1] = $parameters;
        $arr_sql[2] = $types;
        return $arr_sql;
    } else {
        $arr_sql[0] = $sql;
        $arr_sql[1] = array();
        $arr_sql[2] = "";
        return $arr_sql;
    }
}

/* SPrepare Data source for reports based on tables
 * *****************************************************************************************
 */

function Prepare_QSql() {
    global $sql, $fields, $group_by, $sort_by, $group_by, $groupby_column;

    $new_sql = $sql;

    $i = 0;


    // if statestical options (removed from query data source
    /*
      if (!empty($groupby_column))
      $new_sql .=  " group by (`".$groupby_column ."`) ";

     */



    if (count($sort_by) > 0 || count($group_by) > 0) {

        $new_sql .= " order by ";
    }

    $group_by_sort = array();

    foreach ($group_by as $g) {
        $flag = 0;
        $i = 0;

        foreach ($sort_by as $arr) {
            if ($g == $arr[0]) {
                $group_by_sort[] = array($arr[0], $arr[1]);
                $flag = 1;
                $sort_by[$i][0] = '~xxx~';
                break;
            }
            $i++;
        }

        if ($flag == 0) {
            $group_by_sort[] = array($g, '0');
        }
    }

    //************* dump ****************
    //foreach($group_by_sort as $arr)
    ///{
    //echo ">>>>>>>>" .$arr[0] . "\n ";
    ///}
    //**************************************


    foreach ($sort_by as $arr_sort) {
        if ($arr_sort[0] != '~xxx~') {
            $group_by_sort[] = array($arr_sort[0], $arr_sort[1]);
        }
    }

    $i = 0;

    foreach ($group_by_sort as $arr) {


        $new_sql .= "`$arr[0]` ";

        if ($arr[1] == '1')
            $new_sql.= "desc";

        if ($i < (count($group_by_sort) - 1)) {
            $new_sql .=",";
        }
        $i++;
    }

    //	echo $new_sql;
    $arr_sql = array();
    $arr_sql[0] = $new_sql;
    $arr_sql[1] = array();
    $arr_sql[2] = "";
    return $arr_sql;
}

function grouping_diff_index($arr1, $arr2) {
    $i = 0;

    foreach ($arr1 as $key => $val) {
        if ($val != $arr2[$key]) {
            //echo "i=".$i."\n ";
            return $i;
        }

        $i++;
    }

    return -1;
}

/* Exporting Data from reports
 * *****************************************************************************************
 */

function export_csv($sql, $limits, $start, $duration) {
    global $fields, $used_extension;
    if ($start < 0)
        $start = 0;
    if ($duration < 10)
        $duration = 10;
    //if ($limits == true && check_numeric_parameter($start) && check_numeric_parameter($duration) )
    // $sql.=" limit $start,$duration";

    if ($limits == true && check_numeric_parameter($start) && check_numeric_parameter($duration) && $duration > 0) {
        if ($used_extension == "mysqli" || $used_extension == "mysql") {
            $sql[0].=" limit ?,?";
            array_push($sql[1], intval($start), intval($duration));
            $sql[2].= "ii";
        } else {
            $start = intval($start);
            $duration = intval($duration);
            $sql[0].=" limit $start, $duration";
        }
    }


    //adjust header to send the file
    $html = "";

    //output CSV HTTP headers ...
    header("Cache-control: private");
    header("Content-type: application/force-download");

    if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE"))
        header("Content-Disposition: filename=data.csv"); // For IE
    else
        header("Content-Disposition: attachment; filename=data.csv"); // For Other browsers







        
//start getting data from the sql statement
    if (!empty($sql[1]))
        $result = query($sql[0], "Lib export csv", $sql[1], $sql[2]);
    else
        $result = query($sql[0], "Lib export csv");

    $fields_count = count($fields);

    for ($i = 0; $i < $fields_count; $i++) {
        $field = $fields[$i];
        $header .= str_replace(',', ';', $field) . ',';
    }
    $header = substr($header, 0, strlen($header) - 1);

    // output CSV field names
    $html .= $header . "\r\n";
    echo $html;
    $k = 0;
    $records = '';
    foreach ($result as $row) {

        // $i++;
        //  $field_data = "";
        foreach ($row as $key => $val) {
            $field_data = $val;
            $field_data = str_replace("\r\n", ' ', $field_data);
            $field_data = str_replace(',', ';', $field_data);
            $field_data = str_replace("\n", ' ', $field_data);

            $field_data .= ',';

            $records .= $field_data;
        }

        $records .= "\r\n";
    }
    echo $records;
}

/*
 * Export XML
 */

function export_xml($sql, $limits, $start, $duration) {
    //adjust header to send the file

    global $fields, $used_extension;
    if ($start < 0)
        $start = 0;
    if ($duration < 10)
        $duration = 10;
    if ($limits == true && check_numeric_parameter($start) && check_numeric_parameter($duration) && $duration > 0) {
        if ($used_extension == "mysqli" || $used_extension == "mysql") {
            $sql[0].=" limit ?,?";
            array_push($sql[1], intval($start), intval($duration));
            $sql[2].= "ii";
        } else {
            $start = intval($start);
            $duration = intval($duration);
            $sql[0].=" limit $start, $duration";
        }
    }
    $html = "";
    $fields_arr = array();
    // output CSV HTTP headers ...
    header("Cache-control: private");
    header("Content-type: application/force-download");

    if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE"))
        header("Content-Disposition: filename=data.xml"); // For IE
    else
        header("Content-Disposition: attachment; filename=data.xml"); // For Other browsers







        
//start getting data from the sql statement
    if (!empty($sql[1]))
        $result = query($sql[0], "Lib export csv", $sql[1], $sql[2]);
    else
        $result = query($sql[0], "Lib export csv");

    $fields_count = count($fields);
    $tags = array();

    //add fields names to the array
    for ($i = 0; $i < $fields_count; $i++) {
        $field = $fields[$i];
        $field_name = str_replace(']]>', ']>', $field);
        //removing invalid characters from field name
        $chars = array("(", ")");
        foreach ($chars as $v) {
            $field_name = str_replace($v, "", $field_name);
        }

        $field_name = str_replace(' ', '_', $field_name);
        array_push($tags, $field_name);
    }


    //xml header
    echo "<?xml version=\"1.0\"  encoding=\"utf-8\" ?>\r\n";
    echo "<RECORDS>\r\n";
    //iterate through rows
    $html = '';
    foreach ($result as $row) {

        echo "<RECORD>\r\n";
        $i = 0;
        foreach ($row as $k => $v) {
            // if (true) { //numeric
            $html .= "<" . $tags[$i] . ">" . $v . "</" . $tags[$i] . ">\r\n";
            // } else {
            //     $html .= "<" . $tags[$i] . "><![CDATA[" . $v . "]]></" . $tags[$i] . ">\r\n";
            // }
            $i++;
        }

        echo $html;
        echo "</RECORD>\r\n";
    }
    echo "</RECORDS>";
}

function get_pdf($sql, $pagesize, $oriantation, $top, $bottom, $left, $right, $width, $max_width, $font, $title_font, $limits, $start, $duration, $debug = 0) {

    if ($start < 0)
        $start = 0;
    if ($duration < 10)
        $duration = 10;
    set_time_limit(180);
    global $datasource, $title, $used_extension;

    header("Cache-control: private");
    header("Content-type: application/force-download");

    if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE"))
        header("Content-Disposition: filename=data.pdf"); // For IE
    else
        header("Content-Disposition: attachment; filename=data.pdf");

    // For Other browsers

    include ('../pdf/class.ezpdf.php');

    if ($limits == true && check_numeric_parameter($start) && check_numeric_parameter($duration) && $duration > 0) {
        if ($used_extension == "mysqli" || $used_extension == "mysql") {
            $sql[0].=" limit ?,?";
            array_push($sql[1], intval($start), intval($duration));
            $sql[2].= "ii";
        } else {
            $start = intval($start);
            $duration = intval($duration);

            $sql[0].=" limit $start, $duration";
        }
    }

    $pdf = new Cezpdf($pagesize, $oriantation);
    $pdf->ezSetMargins($top, $bottom, $left, $right);
    $pattern = 'Page {PAGENUM} of {TOTALPAGENUM}';
    if ($oriantation == "landscape")
        $pdf->ezStartPageNumbers($width - 20, 560, 10, '', $pattern, 1);
    else
        $pdf->ezStartPageNumbers($width - 20, 810, 9, '', $pattern, 1);


    $pdf->selectFont('../pdf/fonts/Helvetica.afm');
    if (!empty($sql[1]))
        $link = query($sql[0], "Lib export pdf", $sql[1], $sql[2]);
    else
        $link = query($sql[0], "Lib export pdf");
    $data = array(array());
    $i = -1;
    $prefrences = array(
        'justification' => 'center'
    );
    $pdf->ezText("<u>$title</u>", 15, $prefrences);
    $pdf->ezText("", 15, $prefrences);
    $pdf->ezText("", 15, $prefrences);
    foreach ($link as $row) {
        $i++;
        foreach ($row as $k => $v) {
            if ($i == 0) {
                $cols[$k]['justification'] = 'center';
                $col[$k] = "<b>$k</b>";
            }
            $data[$i][$k] = $v;
        }
    }


    //option array
    $options = array(
        'showLines' => 1,
        'showHeadings' => 1,
        'shaded' => 1,
        'shadeCol' => array(0.8, 0.8, 0.8),
        'fontSize' => $font,
        'titleFontSize' => $title_font,
        'rowGap' => 2,
        'colGap' => 2,
        'xPos' => 'center',
        'xOrientation' => 'center',
        'width' => $width,
        'maxWidth' => $max_width,
        'cols' => $cols);

    $pdf->ezTable($data, $col, "", $options);
    $pdf->ezStream();
    /*
      $pdfcode = $pdf->ezOutput();





      $report_name = "pdf".time();
      $fp=fopen("temp/$report_name.pdf",'w+');
      fwrite($fp,$pdfcode);
      fclose($fp);

      return "temp/$report_name.pdf";
     */
}

function h_aggregation_arr($arr) {
    //this function correct detect and fix statestical columns in arrays
    //  for example changes $arr["some column"] to $arr[sum(the same column)] if the column is an affectd one
    global $affected_column, $function;
    $editedArray = array();
    foreach ($arr as $key => $val) {
        if ($key == $affected_column) {
            $editedArray["$function(`$key`)"] = $val;
        } else {
            $editedArray[$key] = $val;
        }
    }
    return $editedArray;
}

?>
