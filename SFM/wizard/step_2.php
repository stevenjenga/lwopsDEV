<?php
/**
*   PHP MYSQL Form Maker 
*   version 3.1.0
*   All copyrights are preserved to StarSoft
*/
define("DIRECTACESS", "true");
error_reporting(0);	
ini_set('session.use_only_cookies', 1);	
	session_start();
	session_regenerate_id();
require_once '../shared.php';
require_once 'helpers/DatabaseHandler.php';

if(isset ($_GET['new']))
{
    $host_name = $_SESSION['sfm_f314_host'];
    $user_name = $_SESSION['sfm_f314_user'];
    $password = $_SESSION['sfm_f314_pass'];
    foreach($_SESSION as $key=>$val)
        $_SESSION[$key] = NULL;

    session_destroy();
    session_start();
    $_SESSION['sfm_f314_host'] = $host_name;
    $_SESSION['sfm_f314_user'] = $user_name;
    $_SESSION['sfm_f314_pass'] = $password;
}

//get form variables
//buttons
if(isset($_POST['btn_cont_x'])) $btn_continue = $_POST['btn_cont_x'];
if(isset($_POST['btn_back_x'])) $btn_back = $_POST['btn_back_x'];
if(isset($_POST['btn_connect_x'])) $btn_connect = $_POST['btn_connect_x'];
//input fields
if(isset($_POST['host_name'])) $host_name = $_POST['host_name'];
if(isset($_POST['DBuser_name'])) $user_name = $_POST['DBuser_name'];
$password = (isset($_POST['DbPassword']) && $_POST['DbPassword'] !== '') ? base64_encode($_POST['DbPassword']) : ((isset($_SESSION['sfm_f314_pass'])) ? $_SESSION['sfm_f314_pass'] : ''); //--
if(isset($_POST['database_name'])) $database_name = clean_input($_POST['database_name']);
$_db = isset($_SESSION['sfm_f314_db']) ? $_SESSION['sfm_f314_db'] :  clean_input($_POST['database_name']);

if(isset($_POST['selected_table'])) $selected_table = clean_input($_POST['selected_table']);
if(isset($_POST['auto_detect_rel'])) $autodetect = '0';// $_POST['auto_detect_rel'];
//vars
$data_source = 'table';    
$_SESSION['sfm_f314_data_source'] = $data_source;

$is_form_valid = 1;
$page_errors = '';

$database_cmb_names = '';

$DD_tables = '';
$insert = false;
$update = false;
$delete = false;


if(isset ($_SESSION['sfm_f314_autodetect']))
   $autodetect =  $_SESSION['sfm_f314_autodetect'];
else
    $autodetect = "0";

if(!empty($database_name))
    $_SESSION['sfm_f314_db'] = clean_input($database_name);

if(!empty ($_SESSION['sfm_f314_permission']))
{
  $permission = $_SESSION['sfm_f314_permission'];
  $insert = substr($permission, 0, 1) == '1'?true:false;
  $update = substr($permission, 1, 1) == '1'?true:false;
  $delete = substr($permission, 2, 1) == '1'?true:false;
}

//check which button was clicked
if(!empty($btn_continue)) //continue
{

	if(empty($host_name) || $host_name === '')
	{
		$page_errors = "* Please enter host name.";
		$is_form_valid = 0;
	}
	if(empty($user_name) || $user_name === '')
	{
		if(!empty($page_errors))
			$page_errors .= "<br>";
		$page_errors .= "* Please enter user name." ;
		$is_form_valid = 0;
	}
	if(empty($database_name) || $database_name === '')
	{
		if(!empty($page_errors))
			$page_errors .= "<br>";
		$page_errors .="* Please select database name.";
		$is_form_valid = 0;
	}
    if(empty($selected_table) || $selected_table === '')
	{
		if(!empty($page_errors))
			$page_errors .= "<br>";
		$page_errors .="* Please select Table.";
		$is_form_valid = 0;
	}
    if(isset ($_POST['permission']))
    {
        $permission = '';
        $permission .= IsChecked('permission','insert') ? '1' : '0';
        $permission .= IsChecked('permission','update') ? '1' : '0';
        $permission .= IsChecked('permission','delete') ? '1' : '0';
        $_SESSION['sfm_f314_permission'] = $permission;
    }else{
		$is_form_valid = 0;
		$page_errors .= "<br>";
		$page_errors .="* One of select form actions required.";
	}if($is_form_valid && $_SESSION['sfm_f314_permission'] != '100')
	{
		
		$host_name = $_SESSION['sfm_f314_host'];
		$user_name = $_SESSION['sfm_f314_user'];
		$password = $_SESSION['sfm_f314_pass'];
		$unique = array();     
		$dbHandler  = new DatabaseHandler($host_name, $user_name, base64_decode($password), $_db);
		if(!$dbHandler || $dbHandler->is_connection_failed())
		{
			if(!empty($page_errors)) $page_errors .= "<br>";
			$page_errors .="* Unable to connect. Please enter valid host name, user name and password";
			$is_form_valid = 0;
		}else{
			$__db = $dbHandler->select_database($_SESSION['sfm_f314_db']);
			if(!$__db)
			{
				if(!empty($page_errors)) $page_errors .= "<br>";
				$page_errors .="* Database doesn't exists.";
				$is_form_valid = 0;
			}else{
				$query = "SHOW COLUMNS FROM `$selected_table`";
                               
				$columns = $dbHandler->query($query, 'ASSOC');
                                
				foreach($columns as $key => $field)
				{
					if((strtoupper($field['Key']) == "PRI" || strtoupper($field['Key']) == "UNI") && $field['Type'] !== 'bigint(20) unsigned') //get unique keys and avoid serial data type
						$unique[] = $field['Field'];  
				}
				if(count($unique) == 0)
				{
					$page_errors .= "* The table must have a primary or unique key in update<br/> or delete actions." ;
					$is_form_valid = 0;
					//load_table_dd_data();
				}
				else
					$_SESSION['sfm_f314_unique'] = $unique;

			}
		}
	}
	if($is_form_valid)
	{
		/*
		$dbHandler  = new DatabaseHandler($host_name, $user_name, base64_decode($password), $_db);
		$_select_db = $dbHandler->select_database($_db);
		if(!$dbHandler || $dbHandler->is_connection_failed() || !$_select_db )
		{
			if(!empty($page_errors)) $page_errors .= "<br>";
			$page_errors .="* Unable to connect. Please enter valid host name, user name, password and database.";
			$is_form_valid = 0;
		}else{
			$databases = $dbHandler->query('SHOW DATABASES WHERE  `Database` LIKE "information_schema"');
	
			$information_schema = false;
			foreach($databases as $key => $row)
			{
				if($row[0] == 'information_schema')
				{  $information_schema = true; break;}
			}
			if($_POST['auto_detect_rel'] == "1" && !$information_schema)
			{
				$page_errors .= "<br/>* Your database engine does not allow relationship detection." ;
				$is_form_valid = 0;
				//load_table_dd_data();
			}
		}
		*/
		if($selected_table != $_SESSION['sfm_f314_table']) //handle old relations
			$_SESSION['sfm_f314_desc'] = NULL;
			$_SESSION['sfm_f314_table'] = clean_input($selected_table); 
					
			$_SESSION['sfm_f314_sql'] = '';
			$_SESSION['sfm_f314_autodetect'] = $_POST['auto_detect_rel'];
			//$_SESSION['sfm_f314_unique'] = $unique;
		
			header("Location:step_3.php");
	}else{
		//load_table_dd_data();
		
	}
}
else if(!empty($btn_back)) //back
{
	header("Location:step_1.php");
	exit;
}
else if(!empty($btn_connect)  || !empty($_SESSION['sfm_f314_host'])) //connect or back
{
	if(!empty($_SESSION['sfm_f314_host']) && empty($btn_connect)) //back
	{
	  	$host_name = $_SESSION['sfm_f314_host'];
		$user_name = $_SESSION['sfm_f314_user'];
		$password = $_SESSION['sfm_f314_pass'];
		$database_name = $_SESSION['sfm_f314_db'];
	}

	if(empty($host_name))
	{
		$form_errors = "* Please enter host name.";
		$is_form_valid = 0;
	}
	if(empty($user_name))
	{
		$page_errors .= "* Please enter user name." ;
		$is_form_valid = 0;
	}
	if(empty($database_name))
	{
		if(!empty($page_errors))
			$page_errors .= "<br>";
		$page_errors .="* Please select database name.";
		$is_form_valid = 0;
	}
	if($is_form_valid ==1)
	{
		$dbHandler  = @new DatabaseHandler($host_name, $user_name, base64_decode($password), $database_name);
		if(!$dbHandler || $dbHandler->is_connection_failed())
		{
			if(!empty($page_errors)) $page_errors .="<br>";
			$page_errors .= "* Unable to connect. Please enter valid host name, user name and password";
			$is_form_valid = 0;
		}else{
		
			$db_selection = $dbHandler->select_database($database_name);
			if(!$db_selection){
				if(!empty($page_errors))
					$page_errors .= "<br>";
				$page_errors .="Database doesn't exists.";
				$is_form_valid = 0;
			}else
			{
				//save data in the sessions
				if(!empty($btn_connect)) // only in case of connect
				{
					$_SESSION['sfm_f314_host'] = $host_name;
					$_SESSION['sfm_f314_user'] = $user_name;
					$_SESSION['sfm_f314_pass'] = $password;
					$_SESSION['sfm_f314_db'] = clean_input($database_name);
					$_SESSION["sfm_f314_connected"]=md5("connected_successfully");
					
				}
				load_table_dd_data();
			} 
		}
	}
}
//functions 
function load_table_dd_data()
{
    global $database_cmb_names,$DD_tables, $dbHandler, $database_name;

	// $query = "show databases";
	// $result = $dbHandler->query($query);
	
	$tmp_db = '';
	//get the default value
	if(isset($database_name))
		$default_db=$database_name;
	else
		$default_db=@$_SESSION['sfm_f314_db'];	
	// flag = true;
	$database_cmb_names = $default_db;
	/*
	foreach ($result as $key => $row)
	{
		if(!($row[0] == 'information_schema' || $row[0] == 'performance_schema' || $row[0] == 'mysql'))
		{
			if($flag)
			{
				$tmp_db = $row[0];
			}
			$flag = false;
			if($default_db==$row[0])
				$database_cmb_names .= "<option selected>";	
			else
				$database_cmb_names .= "<option >";

			$database_cmb_names .= $row[0];
			$database_cmb_names .= "</option>\r\n";
		}
	}
	*/				   
	if(!isset($database_name) && !isset ($_SESSION['sfm_f314_db']))
		$default_db = $tmp_db;
	$dbHandler->select_database($default_db);
	// mysql_free_result($result); 
	$query = "show tables";
	$result = $dbHandler->query($query);
							  
	//get the default value
	if(isset($selected_table))
		$default_tbl=$selected_table;
	else
		$default_tbl=@$_SESSION['sfm_f314_table'];
							  
	foreach ($result as $key => $row)
	{
			  
		if($default_tbl==$row[0])
			$DD_tables .= "<option selected>";
		else
			$DD_tables .= "<option >";

		$DD_tables .= $row[0];
		$DD_tables .= "</option>\r\n";
	
	}

}
function IsChecked($chkname,$value)
{
	if(!empty($_POST[$chkname]))
	{
		foreach($_POST[$chkname] as $chkval)
		{
			if($chkval == $value)
			{
				return true;
			}
		}
	}
	return false;
}

//get default valu for each form field
function get_default_value($var)
{
	$s_var = $var;
	if($var =='user_name') $s_var = 'sfm_f314_user';
	if($var=='password') $s_var = 'sfm_f314_pass';
	if($var=='host_name') $s_var = 'sfm_f314_host';
	if($var=='data_source') $s_var = 'sfm_f314_datasource';		

	if(isset($_POST[$var]))
	{
		return $_POST[$var];
	}
	else if(@isset($_SESSION[$s_var]))
	{
		return @$_SESSION[$s_var];
	}
	else
	{
		if ($var=='host_name')
		{
			return 'localhost';
		}
	}
}

?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Select table</title>
<link href="style.css" rel="stylesheet" type="text/css">
<SCRIPT language="JavaScript1.2" src="../js/jquery-1.7.2.min.js" type="text/javascript"></SCRIPT>  
<SCRIPT language="JavaScript1.2" src="main.js" type="text/javascript"></SCRIPT>  
<script>
    $(function(){
        $('#select_ds').change(function(){
            if($(this).val() == 'table')
                $('#tr_table').show();
            else
                $('#tr_table').hide(); 
        });
        $('#select_ds').change();
		
    });
</script>
</head>

<body>
<DIV id="TipLayer" style="visibility:hidden;position:absolute;z-index:1000;top:-100;"></DIV>
<SCRIPT language="JavaScript1.2" src="style.js" type="text/javascript"></SCRIPT>           

<center>
<form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post">
<table border="0"  height="468" cellspacing="0" cellpadding="0" width="732">
	<tr>
		<td align="center" width="64" height="20" background="images/topleft.jpg" style="background-repeat: no-repeat" >
           
      <td align="center" width="614" height="20" background="images/top.jpg" style="background-repeat: x">
           
      <td align="center" width="48" height="20" background="images/topright.jpg" style="background-repeat: no-repeat">
           
    </tr>
	<tr>
		<td align="center" width="64" style="background-repeat: y" valign="top" background="images/leftadd.jpg">
           
            <img border="0" src="images/left.jpg"><td rowspan="2" align="center" valign="top" >
           
			<p><img border="0" src="images/logo.png" width="369" height="71"></p>
			<table border="0" width="100%" id="table8" height="333">
				<tr>
                                          <td height="18" colspan="2" class="step_title">Please enter MySQL database parameters
										  <button id="exit" style="position: relative;left: 115px;font-size: 11px;cursor: pointer;" onclick="return false;">Disconnect &amp; Exit</button></td>
				</tr>
				<tr>
					<td colspan="2" height="271" valign="top">
					<div align="center">
						<table border="0" cellpadding="0" cellspacing="0" width="501" id="table11" height="248">
							<tr>
								<td width="27" height="16">
								<img border="0" src="images/ctopleft.jpg" width="38" height="37"></td>
								<td width="425" height="16" background="images/ctop.jpg" style="background-repeat: x">&nbsp;</td>
								<td width="38" height="16">
								<img border="0" src="images/ctopright.jpg" width="38" height="37"></td>
							</tr>
							<tr>
								<td width="27" background="images/cleft.jpg" style="background-repeat: y">&nbsp;</td>
								<td width="425" bgcolor="#F9F9F9" align="center">
								<table border="0" width="118%" id="table12" height="136">
									<tr>
									<?php
										if(!empty($page_errors))
										{
                                                                                                        echo "<td align='left' colspan='2' height='26' valign='top' class='error'>$page_errors</td>";
										}
									?>
									</tr>
									<tr>
										<td width="30%" align="right" class="control_label">Hostname</td>
									  <td width="68%" valign="middle">
										<input name="host_name" type="text" id="host_name" value="<?php echo get_default_value('host_name')?>" size="21" />
										<a href="" onMouseOver="stm(Step_2[0],Style);" onClick="return false;" onMouseOut="htm()"> <img src="images/Help.png" border="0"></a></td>
									</tr>
									<tr>
										<td width="30%" align="right" class="control_label">
										Username</td>
									  <td width="68%" valign="middle">
										<input name="DBuser_name" type="text" id="DBuser_name" size="21" value="<?php echo get_default_value('user_name') ?>">
										<a href="" onMouseOver="stm(Step_2[1],Style);" onClick="return false;" onMouseOut="htm()"><img src="images/Help.png" border="0"></a></td>
									</tr>
									<tr>
										<td width="30%" align="right" class="control_label">
										Password</td>
									  <td width="68%" valign="middle">
										<input name="DbPassword" type="password" id="DbPassword" size="21">
										<a href="" onMouseOver="stm(Step_2[2],Style);" onClick="return false;" onMouseOut="htm()"><img src="images/Help.png" border="0"></a></td>
									</tr>
									<tr>
										<td width="30%" align="right" class="control_label">
										Database</td>
									  <td width="68%">
<input type="text" value="<?php echo($database_cmb_names); ?>"  name="database_name" size="21" id="database_name"  />
									
							
										<a href="" onMouseOver="stm(Step_2[3],Style);" onClick="return false;" onMouseOut="htm()"><img src="images/Help.png" border="0"></a></td>
									</tr>
                                                           
									<tr>
										<td colspan="2">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="2">
										<p align="center">
										<input name="btn_connect" type="image" id="btn_connect"  src="layout/button_connect.gif" /> 
										</td>
									</tr>                        
                                                                        
                                                            
                                                                        
                                                                                          <tr id="tr_table">
										<td width="30%" align="right" class="control_label">Select 
										Table</td>
									  <td width="68%">
                                                                                                <select id="selected_table" name="selected_table" style="width: 178px;">
										<?php echo $DD_tables; ?>;
										
										</select>
										<a href="" onMouseOver="stm(Step_2[4],Style);" onClick="return false;" onMouseOut="htm()"><img src="images/Help.png" border="0"></a></td>
									</tr>
                                                                                             <tr>
										<td width="30%" align="right" class="control_label">Select Form Actions</td>
									  <td width="68%">
                                                                                                <label><input type="checkbox" name="permission[]"  value="insert" <?php if(!empty ($_SESSION['sfm_f314_permission'])){if($insert) echo 'checked';} else{ echo 'checked';} ?>  /> Insert</label><a href="" onMouseOver="stm(Step_2[5],Style);" onClick="return false;" onMouseOut="htm()"><img src="images/Help.png" border="0"></a><br/>
                                                                                                <label><input type="checkbox" name="permission[]"  value="update" <?php if($update) echo 'checked'; ?> /> Update</label><a href="" onMouseOver="stm(Step_2[6],Style);" onClick="return false;" onMouseOut="htm()"><img src="images/Help.png" border="0"></a><br/>
                                                                                                <label><input type="checkbox" name="permission[]"  value="delete" <?php if($delete) echo 'checked'; ?> /> Delete</label><a href="" onMouseOver="stm(Step_2[7],Style);" onClick="return false;" onMouseOut="htm()"><img src="images/Help.png" border="0"></a><br/>
                                                                                            </td>
																							<!--
                                                                                             <tr>
									<td width="30%" align="right" class="control_label">Auto Detect Relations</td>
									  <td width="68%">
                                                                                                <label><input <?php if($autodetect == '1') echo 'checked'; ?> name="auto_detect_rel" type="radio" value="1" />Yes</label><label><input <?php if($autodetect == '0') echo 'checked'; ?> name="auto_detect_rel" type="radio" value="0" />No</label>
                                                                                                <a href="" onMouseOver="stm(Step_2[9],Style);" onClick="return false;" onMouseOut="htm()"><img src="images/Help.png" border="0"></a>
                                                                                            </td>
									</tr>
									-->
								</table></td>
								<td width="38" background="images/cright.jpg" style="background-repeat: y">&nbsp;</td>
							</tr>
							<tr>
								<td width="27" height="18">
								<img border="0" src="images/cdownleft.jpg" width="38" height="37"></td>
								<td width="425" height="18" background="images/cdown.jpg" style="background-repeat: x">								</td>
								<td width="38">
								<img border="0" src="images/cdownright.jpg" width="38" height="37"></td>
							</tr>
						</table></div>				  </td>
				</tr>
				<tr>
					<td align="center"><a href="../index.php"><img 
                  src="images/03.jpg" border=0 width="170" height="34"></a></td>
					<td align="center"><INPUT name="btn_cont" type="image" id="btn_cont" 
                  src="images/04.jpg" width="166" height="34"></td>
				</tr>
			</table>
			<td  align="center" width="48" style="background-repeat: y" valign="top" height="388" background="images/rightadd.jpg">
           
            <img border="0" src="images/right.jpg"></tr>
	<tr>
		<td width="64" height="13" align="center" background="images/leftadd.jpg" style="background-repeat: y">
      <td  align="center" width="48" background="images/rightadd.jpg" style="background-repeat: y" valign="top">
           
    </tr>
	</tr>
	<tr>
		<td align="center" width="64" height="30" style="background-repeat: no-repeat">
           
            <img border="0" src="images/downleft.jpg" width="64" height="30"><td align="center" width="614" height="30" background="images/down.jpg" style="background-repeat: x">
           
            <td align="center" width="48" height="30" background="images/downright.jpg" style="background-repeat: no-repeat" >
           
            <img border="0" src="images/downright.jpg" width="53" height="30"></tr>
	<td height="2"></tr>
  </table>
</form>
<script src="disconnect.js"></script>
</body>

</html>
