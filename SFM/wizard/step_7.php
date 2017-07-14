<?php
/**
 *   PHP MYSQL Form Maker 
 *   version 3.1.0
 *   All copyrights are preserved to StarSoft
 */
define("DIRECTACESS", "true");
 require_once("check.php");
 require_once '../shared.php';
 require_once 'helpers/safeValue.php';
 //print_r($_SESSION);
 
//if(!array_key_exists('sfm_f314_table',$_SESSION))
   //  Header("Location: ../index.php");

// 
	 
	function createSalt($userinfo)
{     
    $string = sha1(substr($userinfo, intval(strlen($userinfo)/2), strlen($userinfo)-1));
    return substr($string, 0, 3);	
}
	
//form vars
if (isset($_POST['btn_generate_form_x']))  $btn_generate_form  = $_POST['btn_generate_form_x'];
if (isset($_POST['btn_back_x']))  $btn_back  = $_POST['btn_back_x'];
if (isset($_POST['txt_form_title']))  $txt_form_title = $_POST['txt_form_title'];
if (isset($_POST['form_desc']))  $txt_form_desc = $_POST['form_desc'];

if(isset($_POST['txt_records_per_page']))  $txt_records_per_page  = $_POST['txt_records_per_page'];
if(isset($_POST['txt_form_name']))  $txt_form_name  = $_POST['txt_form_name'];

//other vars
$page_errors = array();
$is_form_valid = 1;

@$continue= $_POST["continue_x"];
 if(!empty($continue))
 {

      if(empty($txt_form_title))
	{
		$page_errors['titles'][] = "Please enter form title.";
		$is_form_valid = 0;
	}
	if(empty($txt_form_name))
	{
		$page_errors['titles'][] = "Please enter form name.";
		$is_form_valid = 0;
	}
          if(empty($txt_form_desc))
	{
		$page_errors['titles'][] = "Please enter form description";
		$is_form_valid = 0;
                   
	}    
	/* ------------------------------------------------------------------------------------ */
	
	if(isset($_POST['allow-security']))
	{
		$_SESSION['sfm_f314_form_allow_security'] = 1;
		
		$username = $_POST['username'];
		$pass = $_POST['pass'];
		
		$is_security_valid = 1;
		
		unset($_SESSION['sfm_f314_form_username']);
		if(preg_match('/[^a-z0-9_]/i', $username) || strlen($username) < 4 || strlen($username) > 12)
		{
			$page_errors['security'][] = "Not valid Username, you must use only 4-12 alphabetic characters, numbers and underscore";
			$is_form_valid = 0;
		}else $_SESSION['sfm_f314_form_username'] = $username;
		
		if($pass === '' && isset($_SESSION['sfm_f314_form_password'])){
			// use password from session
		}else{
			unset($_SESSION['sfm_f314_form_password']);
			if(preg_match('/[\\\"\';&|<>\/ ]/i', $pass) || strlen($pass) < 8 || strlen($pass) > 12)
			{
				$page_errors['security'][] = "Not valid Password, you must enter 8-12 characters without any of these [\\ / ' \" ; & | < > or spaces]";
				$is_form_valid = 0;
				$is_security_valid = 0;
			}
			
			if(preg_match('/[a-z]/', $pass) && preg_match('/[A-Z]/', $pass) && preg_match('/[0-9]/', $pass)){
				// valid and strong password
			}else{
				$page_errors['security'][] = "Your password must contain a mix of upper and lower case letters.";
				$is_form_valid = 0;
				$is_security_valid = 0;			
			}
			
			if($is_security_valid == 1) $_SESSION['sfm_f314_form_password'] = hash("sha256", $pass . createSalt($username));
		}
	}else{
		$_SESSION['sfm_f314_form_allow_security'] = 0;
		unset($_SESSION['sfm_f314_form_username'], $_SESSION['sfm_f314_form_password']);
	}
	
	if(isset($_POST['allow-notification']))
	{
		$_SESSION['sfm_f314_allow_notification'] = 1;
		unset($_SESSION['sfm_f314_notification_email'], $_SESSION['sfm_f314_notification_insert'],
				$_SESSION['sfm_f314_notification_update'], $_SESSION['sfm_f314_notification_delete'], $_SESSION['sfm_f314_notification_search']);
		$email = $_POST['mail'];
		$insert = isset($_POST['insert']) ? 1 : 0;
		$update = isset($_POST['update']) ? 1 : 0;
		$delete = isset($_POST['delete']) ? 1 : 0;
		$search = isset($_POST['search']) ? 1 : 0;
		if( !filter_var($email, FILTER_VALIDATE_EMAIL) || preg_match('/[\\\"\';&|<>\/ ]/i', $email))
		{
			$page_errors['notification'][] = "Not valid Email address, please enter valid email address.";
			$is_form_valid = 0;
		}else{
			$_SESSION['sfm_f314_notification_email'] = $email;
		}
		
		if($insert === 0 && $update === 0 && $delete === 0 && $search === 0){
			$page_errors['notification'][] = "You must chose at least one process.";
			$is_form_valid = 0;
		}else{
			$_SESSION['sfm_f314_notification_insert'] = $insert;
			$_SESSION['sfm_f314_notification_update'] = $update;
			$_SESSION['sfm_f314_notification_delete'] = $delete;
			$_SESSION['sfm_f314_notification_search'] = $search;
		}
	}else{
		$_SESSION['sfm_f314_allow_notification'] = 0;
		unset($_SESSION['sfm_f314_notification_email'], $_SESSION['sfm_f314_notification_insert'],
				$_SESSION['sfm_f314_notification_update'], $_SESSION['sfm_f314_notification_delete'], $_SESSION['sfm_f314_notification_search']);
	}
	/* ------------------------------------------------------------------------------------ */      
	if($is_form_valid==1)
	{	
		$_POST = clean_array($_POST);
		$_SESSION['sfm_f314_title'] = $txt_form_title;
		$_SESSION['sfm_f314_date_created']=date("d-M-Y H:i:s");
		$_SESSION['sfm_f314_form_desc'] = $txt_form_desc;
		$_SESSION['sfm_f314_file_name'] = $txt_form_name;
                    if(empty($txt_records_per_page))
                        $_SESSION['sfm_f314_records_per_page'] = '';
                        else
		$_SESSION['sfm_f314_records_per_page'] = $txt_records_per_page;	
                        
		//generate form code goes here
       header("location: engine/common.php");

	}
}
else if(!empty($btn_back))
{
	header("location: step_5.php");
}

function print_page_errors($tab_name)
{
	global $page_errors;
	if($tab_name === 'security') $_page_errors = $page_errors['security'];
	else if($tab_name === 'notification') $_page_errors = $page_errors['notification'];
	else $_page_errors = $page_errors['titles'];
	if(count($_page_errors)>0)
		echo "<td colspan=2 class='error'>";
	foreach($_page_errors as $key=>$value)
	{
		echo '* ' . $value . "<br>";
	}
	if(count($_page_errors)>0)
		echo "</td>";	
}


//get default valu for each form field
function get_default_value($var)
{	
		if($var == 'txt_form_title') $s_var = 'sfm_f314_title';
		if($var == 'txt_form_name') $s_var = 'sfm_f314_file_name';
		if($var == 'records_per_page') $s_var = 'sfm_f314_records_per_page';
                    if($var == 'form_desc') $s_var = 'sfm_f314_form_desc';
								
		if($var =='user_name') $s_var = 'sfm_f314_user';
		if($var=='password') $s_var = 'sfm_f314_pass';
		if($var=='host_name') $s_var = 'sfm_f314_host'; 
		
		if(!empty($_POST[$var]))
		{
			return $_POST[$var];
		}
		else if(@!empty($_SESSION[$s_var]))
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

function default_notification_option($option_name)
{
	if($option_name === 'allow_notification')
	{
		if(isset($_SESSION['sfm_f314_allow_notification']) && $_SESSION['sfm_f314_allow_notification'] === 1) echo 'checked';
	}else if($option_name === 'email')
	{
		if(isset($_SESSION['sfm_f314_notification_email'])) echo 'value="' . $_SESSION['sfm_f314_notification_email'] . '"'; 
		elseif((isset($_SESSION['sfm_f314_allow_notification']) && $_SESSION['sfm_f314_allow_notification'] !== 1) || !isset($_SESSION['sfm_f314_allow_notification'])) echo 'disabled';
	}else if($option_name === 'insert'){
		if(isset($_SESSION['sfm_f314_notification_insert']))
		{ 
			if($_SESSION['sfm_f314_notification_insert'] === 1) echo 'checked';
		}elseif((isset($_SESSION['sfm_f314_allow_notification']) && $_SESSION['sfm_f314_allow_notification'] !== 1) || !isset($_SESSION['sfm_f314_allow_notification'])) echo 'disabled';
	}else if($option_name === 'update'){
		if(isset($_SESSION['sfm_f314_notification_update']))
		{ 
			 if($_SESSION['sfm_f314_notification_update'] === 1) echo 'checked'; 
		}elseif((isset($_SESSION['sfm_f314_allow_notification']) && $_SESSION['sfm_f314_allow_notification'] !== 1) || !isset($_SESSION['sfm_f314_allow_notification'])) echo 'disabled';
	}else if($option_name === 'delete'){
		if(isset($_SESSION['sfm_f314_notification_delete']))
		{ 
			 if($_SESSION['sfm_f314_notification_delete'] === 1) echo 'checked'; 
		}elseif((isset($_SESSION['sfm_f314_allow_notification']) && $_SESSION['sfm_f314_allow_notification'] !== 1) || !isset($_SESSION['sfm_f314_allow_notification'])) echo 'disabled';
	}else if($option_name === 'search'){
		if(isset($_SESSION['sfm_f314_notification_search']))
		{ 
			 if($_SESSION['sfm_f314_notification_search'] === 1) echo 'checked'; 
		}elseif((isset($_SESSION['sfm_f314_allow_notification']) && $_SESSION['sfm_f314_allow_notification'] !== 1) || !isset($_SESSION['sfm_f314_allow_notification'])) echo 'disabled';
	}
}

function default_security_option($option_name)
{
	if($option_name === 'allow_security')
	{
		if(isset($_SESSION['sfm_f314_form_allow_security']) && $_SESSION['sfm_f314_form_allow_security'] === 1) echo 'checked'; 
		else if(!isset($_SESSION['sfm_f314_form_allow_security']))
		{
			$_SESSION['sfm_f314_form_allow_security'] = 1;
			echo 'checked'; 
		}
	}else if($option_name === 'username')
	{
		if(isset($_SESSION['sfm_f314_form_username'])) echo 'value="' . $_SESSION['sfm_f314_form_username'] . '"'; 
		else if((isset($_SESSION['sfm_f314_form_allow_security']) && $_SESSION['sfm_f314_form_allow_security'] === 0) || !isset($_SESSION['sfm_f314_form_allow_security'])) 
			echo 'disabled';
	}else if($option_name === 'pass'){
		if(isset($_SESSION['sfm_f314_form_password'])) echo 'value=""'; 
		else if((isset($_SESSION['sfm_f314_form_allow_security']) && $_SESSION['sfm_f314_form_allow_security'] === 0) || !isset($_SESSION['sfm_f314_form_allow_security'])) 
			echo 'disabled';
	}
}
?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Form Global Settings</title>
<link href="style.css" rel="stylesheet" type="text/css">
<link href="jquery-ui/css/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
<link href="../styles/bootstrap/css/bootstrap.css" rel="stylesheet">

<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
<script src="jquery-ui/jquery-ui-1.10.4.custom.min.js"></script>
<SCRIPT language="JavaScript1.2" src="main.js" type="text/javascript"></SCRIPT>  
</head>
<body>
<DIV id="TipLayer" style="visibility:hidden;position:absolute;z-index:1000;top:-100;"></DIV>
<SCRIPT language="JavaScript1.2" src="style.js" type="text/javascript"></SCRIPT>           
<center>
<form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post">
<table width="732"  height="467" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td align="center" width="64" height="20" background="images/topleft.jpg" style="background-repeat: no-repeat" >
           
      <td align="center" width="614" height="20" background="images/top.jpg" style="background-repeat: x">
           
      <td align="center" width="48" height="20" background="images/topright.jpg" style="background-repeat: no-repeat">
           
    </tr>
	<tr>
		<td align="center" width="64" style="background-repeat: y" valign="top" background="images/leftadd.jpg">
           
            <img border="0" src="images/left.jpg"><td rowspan="2" align="center" valign="top" >
           
			<p><img border="0" src="images/logo.png" width="369" height="71"></p>
			<table width="100%" height="337" border="0" align="center" id="table8">
				<tr>
					<td colspan="2" height="22"><span class="step_title">Form Global Settings </span>
					<button id="exit" style="position: relative;left: 305px;font-size: 11px;cursor: pointer;" onclick="return false;">Disconnect &amp; Exit</button></td>
				</tr>
				<tr>
					<td colspan="2" height="266" valign="top">					  <table width="501" height="248" border="0" align="center" cellpadding="0" cellspacing="0" id="table11">
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
					           
							<!--
							
							here
							
							
							-->
							<div id="tabs">
								<ul>
									<li><a id='security-nav' href="#security"><span class='glyphicon glyphicon-lock'></span> Security</a></li>
									<li><a id='notification-nav' href="#notifications"><span class='glyphicon glyphicon-envelope'></span> Notifications</a></li>
									<li><a id='titles-nav' href="#titles"><span class='glyphicon glyphicon-pencil'></span> Titles</a></li>
								</ul>
								<div id="security">
									<table width="466" height="102" border="0" align="center">
										<tr><?php echo  print_page_errors('security');?></tr>
										<tr>
											<td colspan="3"><label for='allow-security'><input type='checkbox' name='allow-security' id='allow-security' <?php default_security_option('allow_security'); ?> /> Allow security</label></td>
										</tr>
										<tr>
											<td width="16%;"><label for='username'>&nbsp;Username</label></td>
											<td><input type='text' name='username' id='username' <?php default_security_option('username'); ?> /></td>
											<td></td>
										</tr>
										<tr>
											<td width="16%;"><label for='pass'>&nbsp;Password</label></td>
											<td><input type='password' name='pass' id='pass' <?php default_security_option('pass'); ?> /></td>
											<td></td>
										</tr>
									</table>
								</div>
								<div id="notifications">
									<table width="466" height="102" border="0" align="center">
										<tr><?php echo  print_page_errors('notification');?></tr>
										<tr>
											<td colspan="3"><label for='allow-notification'><input type='checkbox' name='allow-notification' id='allow-notification' <?php default_notification_option('allow_notification'); ?> /> Allow mail notification</label></td>
										</tr>
										<tr>
											<td width="22%;"><label for='mail'>&nbsp;Email address</label></td>
											<td><input type='text' name='mail' id='mail' <?php default_notification_option('email'); ?> /></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="3"><label for='insert'><input type='checkbox' name='insert' id='insert'  <?php default_notification_option('insert'); ?> /> Insert</label></td>
										</tr>
										<tr>
											<td colspan="3"><label for='update'><input type='checkbox' name='update' id='update'  <?php default_notification_option('update'); ?>  /> Update</label></td>
										</tr>
										<tr>
											<td colspan="3"><label for='delete'><input type='checkbox' name='delete' id='delete'  <?php default_notification_option('delete'); ?>  /> Delete</label></td>
										</tr>
										<tr>
											<td colspan="3"><label for='search'><input type='checkbox' name='search' id='search'  <?php default_notification_option('search'); ?>  /> Search</label></td>
										</tr>
									</table>
								</div>
								<div id="titles">
								<table width="466" height="192" border="0" align="center">
									<tr><?php echo  print_page_errors('titles');?></tr>
									<tr>
										<td width="132" height="23" nowrap class="control_label">Form Title </td>
                                                                                <td width="410"><input name="txt_form_title" type="text" id="txt_form_title" size="40" value="<?php echo get_default_value('txt_form_title')?>" /><span id="max-txt_form_title"></span></td>
										<td width="410"><a href="" onMouseOver="stm(Step_7[0],Style);" onClick="return false;" onMouseOut="htm()"><img src="images/Help.png" border="0" align="absmiddle"></a></td>
									</tr>
									<tr>
										<td class="control_label">Form Name </td>
										<td><input name="txt_form_name" type="text" id="txt_form_name" size="40" value="<?php  echo get_default_value('txt_form_name') ?>" /></td>
										<td valign="middle"><a href="" onMouseOver="stm(Step_7[3],Style);" onClick="return false;" onMouseOut="htm()"><img src="images/Help.png" border="0" align="absmiddle"></a></td>
									</tr>
									<tr>
										<td class="control_label">Form Description </td>
										<td><textarea style="margin: 2px;height: 108px;width: 340px;" name="form_desc" type="text" id="txt_form_desc" ><?php  echo get_default_value('form_desc') ?></textarea><span id="max-txt_form_desc"></span></td>
										<td valign="middle"><a href="" onMouseOver="stm(Step_7[3],Style);" onClick="return false;" onMouseOut="htm()"><img src="images/Help.png" border="0" align="absmiddle"></a></td>
									</tr>
									<?php if($_SESSION["sfm_f314_layout"] == 'Tabular') {?>
										<tr>
											<td class="control_label">Records per page </td>
                                                                                        <td><input name="txt_records_per_page" type="text" id="txt_records_per_page" size="40" value="<?php echo get_default_value('txt_records_per_page')?>"></td>
											<td valign="middle"><a href="" onMouseOver="stm(Step_7[4],Style);" onClick="return false;" onMouseOut="htm()"><img src="images/Help.png" border="0" align="absmiddle"></a></td>
										</tr> 
									<?php } ?>
								</table>
								</div>
							</div>
							
							
							</td>
						    <td width="38" background="images/cright.jpg" style="background-repeat: y">&nbsp;</td>
					    </tr>
					    <tr>
					      <td width="27" height="18">
					        <img border="0" src="images/cdownleft.jpg" width="38" height="37"></td>
						    <td width="425" height="18" background="images/cdown.jpg" style="background-repeat: x">								</td>
						    <td width="38">
					        <img border="0" src="images/cdownright.jpg" width="38" height="37"></td>
					    </tr>
				            </table></td></tr>
				<tr>
					<td align="center"><a 
                  href="<?php if(isset($_SESSION['sfm_f314_details_table'])){echo 'details_form_step.php';}else{echo 'step_5.php';} ?>" style="color: #0029a3; text-decoration: none"><img 
                  src="images/03.jpg" border=0 width="170" height="34"></a></td>
					<td align="center"><INPUT name=continue type=image id="btn_cont" 
                  src="images/04finish.jpg" width="166" height="34" ></td>
				</tr>
			</table>
			<td  align="center" width="48" style="background-repeat: y" valign="top" height="388" background="images/rightadd.jpg">
           
            <img border="0" src="images/right.jpg"></tr>
	<tr>
		<td width="64" height="12" align="center" background="images/leftadd.jpg" style="background-repeat: y">
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
<script>
	$(function(){ 
		$( "#tabs" ).tabs(); 

		$('#allow-security').change(function(){
			$('#username').prop('disabled', $(this).prop('checked') !== true);
			$('#pass').prop('disabled', $(this).prop('checked') !== true);
		});

		$('#allow-notification').change(function(){
			$('#mail').prop('disabled', $(this).prop('checked') !== true);
			$('#insert').prop('disabled', $(this).prop('checked') !== true);
			$('#update').prop('disabled', $(this).prop('checked') !== true);
			$('#delete').prop('disabled', $(this).prop('checked') !== true);
			$('#search').prop('disabled', $(this).prop('checked') !== true);
		});
		
                $('#txt_form_title').keyup(function() {
                    var length = $(this).val().length;
                    if(length <= 10)
                        $('#max-txt_form_title').text('remains ' + (10 - length) + '.');
                    else
                        $('#txt_form_title').val($(this).val().substr(0, 10));
                });
                
                $('#txt_form_desc').keyup(function() {
                    var length = $(this).val().length;
                    if(length <= 20)
                        $('#max-txt_form_desc').text('remains ' + (20 - length) + '.');
                    else
                        $('#txt_form_desc').val($(this).val().substr(0, 20));
                });
                
		// $('#allow-security').prop('checked', true);

		<?php if(isset($page_errors['security'])){ ?>
			$('#security-nav').trigger('click');
		<?php }else if(isset($page_errors['notification'])){ ?>
			$('#notification-nav').trigger('click');
		<?php }else if(isset($page_errors['titles'])){ ?>
			$('#titles-nav').trigger('click');
		<?php } ?>

	});
	
</script>
<script src="disconnect.js"></script>
</body>

</html>
