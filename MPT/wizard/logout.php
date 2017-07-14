<?php 
define("DIRECTACESS", "true");
session_start();
$path = "";
if(isset($_SESSION["PT_Login_Folder_name"])&& !empty($_SESSION["PT_Login_Folder_name"])){
$path = $_SESSION["PT_Login_Folder_name"];
}
else
    $path = "?from=setconfig";
$_SESSION = array();
$params = session_get_cookie_params();
	//delete the actual cookie
if(isset($_COOKIE[session_name()])){
	setcookie(session_name(),
        '', time() - 42000, 
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]);
		}	
	session_destroy();
	
	/*
		Check if session is exists :: then :: Generate warning message ask user to close his browser and try to logout again
		:: ELSE :: it will header it to login.php
	*/
	if(isset($_SESSION['PT_Login_username']))
	{
		echo '
			<link href="../tables/common/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
			<script src="../tables/common/js/jquery-1.9.1.js"></script>
			<script src="../tables/common/bootstrap/js/bootstrap.js"></script>
			<div class="container" style="position: relative;top: 10px;">
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<div>
						<strong>Error in logout!</strong> Browser can\'t logout and destroy session, so please close browser to logout
					</div>
				</div>
			</div>';
		exit();
	} else {
		header('location: login.php'.$path);
	}
?>