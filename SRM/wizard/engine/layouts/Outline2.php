<?php
define("DIRECTACESS", "true");
error_reporting(E_ERROR | E_PARSE);
require_once("lib.php");
/**
 * Generated by Smart Report Maker
 * All copyrights are preserved to StarSoft
 * http://mysqlreports.com/
 *
 */
if (is_exist($_GET['start'])) {
    if (is_numeric($_GET['start']) && is_clean($_GET['start'], true, true) && $_GET['start'] > -1) {
        $_startRecord_index = intval($_GET['start']);
    } else {
        $_GET['start'] = 0;
        $_startRecord_index = 0;
    }
} else {
    $_startRecord_index = 0;
}

if (is_exist($_GET['print'])) {
    if ($_GET['print'] == 1 || $_GET['print'] == 2) {
        $_print_option = $_GET['print'];
    } else {
        $_print_option = 0;
        $_GET['print'] = 0;
    }
} else {
    $_print_option = 0;
}

$_export_option_options = array("pdf", "pdf1", "csv", "csv1", "xml", "xml1");
if (is_exist($_GET['export'])) {
    if (in_array($_GET['export'], $_export_option_options)) {
        $_export_option = $_GET['export'];
    } else {
        $_export_option = "";
        $_GET['export'] = "";
    }
} else {
    $_export_option = "";
}

if (check_debug_mode() == 1) {
    if (strstr("?", $_SERVER['REQUEST_URI'])) {
        $link_home = $_SERVER["PHP_SELF"] . "&&debug_mode_6=1701";
    } else {
        $link_home = $_SERVER["PHP_SELF"] . "?debug_mode_6=1701";
    }
} else {
    $link_home = $_SERVER["PHP_SELF"];
}


$levels = count($group_by);
//*************************create sql statement  ******************* $$$

if ($datasource == 'sql') {

    $sql = Prepare_QSql();
} else {

    $sql = Prepare_TSql();
}


$result = query($sql[0], "LayOut : Prepare SQL", $sql[1], $sql[2]);

// $result = query($sql, "LayOut : Prepare SQL");


$nRecords = count($result); //$$$	



/* begin of export section*********** */

//Exporting section
//export data

if ($_export_option == 'csv') {

    export_csv($sql, false, 0, 10);

    exit;
} elseif ($_export_option == 'csv1') {

    export_csv($sql, true, $_startRecord_index, $records_per_page);

    exit;
} else if ($_export_option == 'xml') {

    export_xml($sql, false, 0, 10);

    exit;
} elseif ($_export_option == 'xml1') {

    export_xml($sql, true, $_startRecord_index, $records_per_page);

    exit;
} else if ($_export_option == 'pdf1') {

    if (count($fields) > 8)
        get_pdf($sql, 'a4', 'landscape', 10, 10, 10, 10, 780, 800, 10, 11, true, $_startRecord_index, $records_per_page);
    else
        get_pdf($sql, 'a4', 'portrait', 10, 10, 10, 10, 490, 500, 9, 10, true, $_startRecord_index, $records_per_page);

    exit;
}

else if ($_export_option == 'pdf') {

    if (count($fields) > 8)
        get_pdf($sql, 'a4', 'landscape', 10, 10, 10, 10, 780, 800, 10, 11, false, $_startRecord_index, $records_per_page);
    else
        get_pdf($sql, 'a4', 'portrait', 10, 10, 10, 10, 490, 500, 9, 10, false, $_startRecord_index, $records_per_page);

    exit;
}

//exporting links

$link_pdf_current = $_SERVER["PHP_SELF"] . "?export=pdf1&&start=$_startRecord_index";

$link_csv_current = $_SERVER["PHP_SELF"] . "?export=csv1&&start=$_startRecord_index";

$link_xml_current = $_SERVER["PHP_SELF"] . "?export=xml1&&start=$_startRecord_index";



$link_csv_all = $_SERVER["PHP_SELF"] . "?export=csv";

$link_xml_all = $_SERVER["PHP_SELF"] . "?export=xml";

$link_pdf_all = $_SERVER["PHP_SELF"] . "?export=pdf";

// ********************************************/
//**************************print links****************************** $$$

$link_print1 = $_SERVER["PHP_SELF"] . "?print=1&&start=$_startRecord_index";

$link_print2 = $_SERVER["PHP_SELF"] . "?print=2";

$link_print_real = $_SERVER['PHP_SELF'] . "?print=3&start=$_startRecord_index";



//*************************next and prev links ********************* $$$

$next_start = $_startRecord_index + $records_per_page;

if ($next_start >= $nRecords)
    $next_start = $_startRecord_index;

if (check_debug_mode() == 1) {
    $link_next = $_SERVER["PHP_SELF"] . "?start=$next_start&&debug_mode_6=1701";
} else {
    $link_next = $_SERVER["PHP_SELF"] . "?start=$next_start ";
}
$prev_start = $_startRecord_index - $records_per_page;


if ($prev_start < 0)
    $prev_start = 0;

if (check_debug_mode() == 1) {
    $link_prev = $_SERVER["PHP_SELF"] . "?start=$prev_start&&debug_mode_6=1701";
} else {
    $link_prev = $_SERVER["PHP_SELF"] . "?start=$prev_start";
}



//initiaize vars

$cur_row = 0;

$toggle_row = 0;



//previous link

$prev_record = $_startRecord_index - $records_per_page;


if ($prev_record >= 0) {
    if (check_debug_mode() == 1) {
        $prev_link = $_SERVER['PHP_SELF'] . "?start=$prev_record&&debug_mode_6=1701";
    } else {
        $prev_link = $_SERVER['PHP_SELF'] . "?start=$prev_record";
    }
} else {
    $prev_link = '';
}



//create new sql includes the start and end limits except in case print all

if ($_print_option != 2) {
    if (check_numeric_parameter($_startRecord_index) && check_numeric_parameter($records_per_page)) {

        if ($used_extension == "mysqli" || $used_extension == "mysql") {
            $sql[0] .= " limit ?,?";
            array_push($sql[1], intval($_startRecord_index), intval($records_per_page));
            $sql[2].="ii";
        } else {
            $_startRecord_index = intval($_startRecord_index);
            $records_per_page = intval($records_per_page);

            $sql[0] .= " limit $_startRecord_index,$records_per_page";
        }
        $result = query($sql[0], "Layout: pager", $sql[1], $sql[2]);
    }
}




$cur_group_ar = array();  // the current group 

$last_group_ar = array();   //the newest grou by fields

$actual_fields = array_diff($fields, $group_by);   //actual columns which will be shown without group by fields

$actual_columns_count = count($actual_fields);     //number of columns to be shown
$columns = count($fields);

$span = "colspan='" . $columns . "'";
$group_by_count = count($group_by);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

        <script  type="text/javascript"  src="../../Js/jquery-1.6.3.min.js"  ></script>
        <title><?php echo $title ?></title>

        <link href="<?php
        if ($_print_option != 0) {

            echo "print.css";
        } else {

            echo $style_name . ".css";
        }
        ?>" rel="stylesheet" type="text/css" />



    </head>


    <body class="MainPage">
        <?php include 'menu.php'; ?>

        <table  border="0"

                <?php
//width of report

                if ($print != 0)
                    echo "width='500'";
                else
                    echo "width ='100%'";
                ?>





                align="center" cellpadding="2" cellspacing="0" class="MainTable">

<?php
if (!empty($header)) {
    ?>

                <tr>

                    <td <?php echo $span; ?>  valign="top"  ><?php echo $header; ?></td>

                </tr>

                <tr>

                    <td <?php echo $span; ?>  valign="top" class="Separator" ></td>

                </tr>

    <?php
}
?>

            <!-- ******************** end custom header ******************** !-->


<?php if (trim($title) != '') { ?>
                <tr>

                    <td <?php echo $span; ?> height="33" valign="top" class="Title"><?php echo $title; ?></td>

                </tr>
            <?php } ?>


<?php
if ($possible_attack === true) {
    if (check_debug_mode() == 1) {
        send_log_info($maintainance_email);
    }
    die("<tr><td style=\"text-align: left;padding-left: 39px;\" $span class='MainGroup'>No Special characters allowed for security reasons </td></tr>");
    exit;
}

if (count($result) < 1 || empty($result)) {
    if (check_debug_mode() == 1) {
        send_log_info($maintainance_email);
    }
    die("<tr><td style=\"text-align: left;padding-left: 39px;\" $span class='MainGroup'>No Data Found</td></tr>");
}
?>
            <?php
            if (!empty($group_by)) {
                ?>





                <tr>

                    <td <?php echo $span; ?> class="Separator">&nbsp</td>

                </tr>



                <?php
            }



            $cur_grouped = array();

            $saved_grouped = array();

            $records = 0;

            $state = true; //flag for toggling

            foreach ($result as $row) {



            //$row = mysql_fetch_array($link,MYSQL_ASSOC);



                //filling array with current grouping vals

                foreach ($group_by as $val) {

                    $cur_grouped[$val] = $row[$val];
                }

                //checking the variations

                if (count($saved_grouped) != 0) {

                    $index = grouping_diff_index($cur_grouped, $saved_grouped);
                } else {



                    if ($records == 0) {

                        $index = 0; //intialize the structure
                    } else {

                        $index = -1; //No grouping and the structure is intialized
                    }
                }





                if ($index != -1) {

                    //things that done only when there is variations
                    // if($records != 0 )echo"</table></td></tr>";

                    if (!empty($group_by)) {

                        for ($i = $index; $i < $levels; $i++) {

                            if ($i == 0 && $index == 0) {

                                //main grouping
                                echo "<tr><td $span class='MainGroup'>" . $labels[$group_by_source[0]] . " : " . $row[$group_by[0]] . "</td></tr>";
                            } else {

                                //sub grouping



                                $step_length = 3 * $i;

                                $step = str_repeat("&nbsp", $step_length);

                                echo "<tr><td $span class='SubGroup'>$step" . $labels[$group_by_source[$i]] . " : " . $row[$group_by[$i]] . "</td></tr>";
                            }
                        }
                    }





                    //columns and table head



                    echo"<tr><td height='15' $span class='TableHeader'></td>

	  </tr>";

                    //echo"<tr><td><table width='100%'  cellspacing='0' cellpadding='10'>";

                    echo"<tr>";

                    //drawing the fields  head

                    foreach ($actual_fields_source as $key => $val) {

                        $temp = explode('.', $val);
                        $field_ = (count($table) == 0) ? $val : $temp[1];
                        if (in_array($field_, $group_by))
                            continue;
                        else {

                            echo"<td  align='center' class='ColumnHeader'>$labels[$val]</td>";
                        }
                    }



                    echo "</tr>";

                    //that's all the things that done only when there is variation in grouping array
                }



// things that should be done weather or not there is a variations
                //adding a data row

                echo"<tr>";



                foreach ($fields as $f) {

                    if (empty($row[$f]))
                        $row[$f] = "&nbsp";

                    if (in_array($f, $group_by)) {

                        continue;
                    } else {

                        if ($state)
                            echo"<td align='center' class='AlternateTableCell'>$row[$f]</td>";
                        else
                            echo"<td align='center' class='AlternateTableCell'>$row[$f]</td>";
                    }

                   
                }
                 $state = !$state;
                echo"</tr>";



                //updating saved array

                foreach ($group_by as $v) {

                    $saved_grouped[$v] = $row[$v];
                }





                $records++;
            } //ending of main while loop
// echo"</table></td></tr>";
            ?>

            <!--*****************************-->

            <!-- ******************** start custom footer ******************** !-->

            <?php
            if (!empty($footer)) {

                echo "<tr><td $span > $footer</td></tr>";
            }
            ?>

            <!-- ******************** end custom footer ******************** !-->





            <!--Footer of report******************-->

            <tr>

                <td <?php echo $span; ?> class="TableFooter">&nbsp;</td>

            </tr>

        </table>

        <!-- ************************* Show print Dialog **************************** !-->

            <?php
//show print dialog in case of print mode $$$

            if ($print == 3) {
                ?>

            <script>

                window.print();

            </script>

                <?php
            }
            ?>

        <!-- ************************* End Of Show print Dialog ********************* !-->
        <script>
            $(document).ready(function() {
                var datasource = <?php echo "'" . $datasource . "';"; ?>
                if (datasource == 'sql') {
                    $("#txtordnary_search").css('visibility', 'hidden');
                    $(".srch-btn").css('visibility', 'hidden');
                    $("#search_advanced").css('visibility', 'hidden');

                }


            });


        </script>

    </body>

</html>
