<?php
error_reporting(E_ERROR  | E_PARSE);
session_start();
/**
 * Smart Chart Maker 
 * @author		StarSoft
 * @copyright	Copyright (c) 2011 - 2014, StarSoft, Inc.
 * @link		http://mysqlreports.com
 * 
 * 
 */ 
require_once 'shared.php';
require_once 'bootstrap_popup.php';

$database_cmb_names = '';
//get submitted form variables

//buttons
if(isset($_POST['btn_cont_x'])) $btn_continue = clean($_POST['btn_cont_x']);
if(isset($_POST['btn_back_x'])) $btn_back = clean($_POST['btn_back_x']);
if(isset($_POST['btn_connect_x'])) $btn_connect = clean($_POST['btn_connect_x']);
//input fields
if(isset($_POST['host_name'])) $host_name = trim($_POST['host_name']);
if(isset($_POST['user_name'])) $user_name = trim($_POST['user_name']);
if(isset($_POST['password'])) $password = (isset($_SESSION['ks_pass'])) ? $_SESSION['ks_pass'] : trim($_POST['password']);
if(isset($_POST['database_name'])) $database_name = clean($_POST['database_name']);
 
//Form validation Flags
$is_form_valid = 1;
$page_errors = '';
 
//check which button was clicked
if(!empty($btn_continue)) //continue
{
	if(empty($host_name))
	{
		$page_errors = "* Please enter host name.";
		$is_form_valid = 0;
	}
	if(empty($user_name))
	{
		if(!empty($page_errors)) $page_errors .= "<br>";
		$page_errors .= "* Please enter user name." ;
		$is_form_valid = 0;
	}
	if(empty($database_name))
	{
		if(!empty($page_errors)) $page_errors .= "<br>";
		$page_errors .="* Please select database name.";
		$is_form_valid = 0;
	}
	if (!@mysql_select_db($database_name, mysql_connect($host_name, $user_name, $password))) {
		$page_errors = "* Database Not Found (doesn't exists!).";
		$is_form_valid = 0;
	}
	if($is_form_valid)
	{
		$_SESSION['ks_db'] = $database_name;
		header("Location:step_3.php"); 
	}
}
else if(!empty($btn_back)) //back
{
	header("Location:step_1.php");
	exit;
}
else if(!empty($btn_connect)  || !empty($_SESSION['ks_host'])) //connect or back
{
	if(!empty($_SESSION['ks_host']) && empty($btn_connect)) //back
	{
	  	$host_name = $_SESSION['ks_host'];
		$user_name = $_SESSION['ks_user'];
		$password = $_SESSION['ks_pass'];
	}

	if(empty($host_name))
	{
		$page_errors = "* Please enter host name.";
		$is_form_valid = 0;
	}
	if(empty($user_name))
	{
		$page_errors .= "* Please enter user name." ;
		$is_form_valid = 0;
	}
	if(!validate($user_name)||!validate($host_name))
	{ 
	   $page_errors= "* One of the connection parameters is not in a valid formats";
		$is_form_valid = 0;	
	}
	
	if(!validate_pass($password))
	{
		$page_errors = "* password can't contain spaces";
		$is_form_valid = 0;	
	}
	
	
	if($is_form_valid ==1)
	{
	    
		if(@!mysql_connect($host_name, $user_name, $password))
		{
			if(!empty($page_errors))
			{
				$page_errors .="<br>";
			}
			$page_errors .= "* Unable to connect. Please enter valid host name, user name and password";
		}
		else
		{ 
		     
        	// save data in the sessions
            if(!empty($btn_connect)) // only in case of connect
            {
	        	$_SESSION['ks_host'] = $host_name;
	        	$_SESSION['ks_user'] = $user_name;
	        	$_SESSION['ks_pass'] = $password;
				$_SESSION['ks_chv2_Login_key'] = "1701Abbb Connect Success";
            }

			//get the default value
			if(isset($database_name)) $default_db=$database_name;
			else $default_db = (isset($_SESSION['ks_db'])) ? $_SESSION['ks_db'] : '';			
				
			$database_cmb_names .= $default_db;
		}
	}

}
//get default valu for each form field
function get_default_value($var, $s_var)
{
	if(isset($_POST[$var])) return $_POST[$var];
	else if(isset($_SESSION[$s_var])) return $_SESSION[$s_var];
	else
	{
		if ($var=='host_name') return 'localhost';
	}
}

?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Select table</title>
<?php if($use_old_help_msg === false) { ?>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<?php } ?>
<link href="style.css" rel="stylesheet" type="text/css">
<script src="jquery-1.9.1.js"></script>
<?php if($use_old_help_msg === false) { ?>
	<script src="bootstrap/js/bootstrap.min.js"></script>
<?php } ?>
</head>

<body>
<SCRIPT language="JavaScript1.2" src="style.js" type="text/javascript"></SCRIPT> 
<?php if($use_old_help_msg === false) { ?>
	<script src="popup_handler.js"></script>  
<?php } ?>          

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
           
			<p><img border="0" src="images/01.jpg" width="369" height="71"></p>
			<table border="0" width="100%" id="table8" height="333">
				<tr>
					<td height="18" colspan="2" class="step_title">Please enter MySQL database 
					parameters
					<button id="exit" style="position: relative;left: 120px;font-size: 11px;cursor: pointer;" onclick="return false;">Disconnect &amp; Exit</button>
					</td>
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
										<td width="30%" align="right" class="control_label">Host 
										name</td>
									  <td width="68%" valign="middle">
										<input name="host_name" type="text" id="host_name" value="<?php echo get_default_value('host_name', 'ks_host')?>" size="21" />
										<a href="" onMouseOver="stm(Step_2[0],Style,  this);" onClick="return false;" onMouseOut=""> <img src="images/Help.png" border="0"></a></td>
									</tr>
									<tr>
										<td width="30%" align="right" class="control_label">
										Username</td>
									  <td width="68%" valign="middle">
										<input name="user_name" type="text" id="user_name" size="21" value="<?php echo get_default_value('user_name', 'ks_user') ?>">
										<a href="" onMouseOver="stm(Step_2[1],Style,  this);" onClick="return false;" onMouseOut=""><img src="images/Help.png" border="0"></a></td>
									</tr>
									<tr>
										<td width="30%" align="right" class="control_label">
										Password</td>
									  <td width="68%" valign="middle">
										<input type="password" name="password" id="password" size="21">
										<a href="" onMouseOver="stm(Step_2[2],Style,  this);" onClick="return false;" onMouseOut=""><img src="images/Help.png" border="0"></a></td>
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
									<tr <?php if(!isset($_SESSION['ks_chv2_Login_key']) || $_SESSION['ks_chv2_Login_key'] !== "1701Abbb Connect Success") { ?>style="display: none;" <?php }?>>
										<td width="30%" align="right" class="control_label">Select 
										Database</td>
									  <td width="68%">
										<input type="text" name="database_name" size="21" id="database_name"
											value="<?php echo($database_cmb_names); ?>" />
										<a href="" onMouseOver="stm(Step_2[3],Style,  this);" onClick="return false;" onMouseOut=""><img src="images/Help.png" border="0"></a></td>
									</tr>
									 
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
					<td align="center"><INPUT name=btn_cont type=image id="btn_cont" 
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
</body>
<script>
	$("#exit").mousedown(function(){
		location.replace("disconnect.php");
	});
</script>
</html>
