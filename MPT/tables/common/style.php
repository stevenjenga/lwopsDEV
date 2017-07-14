<?php
define("DIRECTACESS", "true");
ini_set('session.use_only_cookies', 1);	
$cookieParams = session_get_cookie_params();
session_set_cookie_params($cookieParams["lifetime"],$cookieParams["path"],$cookieParams["domain"],$cookieParams["secure"],true);
session_start();
session_regenerate_id();
$path = "";
if(isset($_SESSION["PT_Login_Folder_name"])&& !empty($_SESSION["PT_Login_Folder_name"])){
$path = $_SESSION["PT_Login_Folder_name"];
}
else
    $path = "?from=setconfig";
require_once("../../shared/cl_login.php");
$login = new Login();
$login->headerTo(false, "../../wizard/login.php".$path);

	if(isset($_POST['css']))
	{
		$_SESSION['css'] = $_POST['css'];
		echo 'success';
		exit();
	}
  ?>