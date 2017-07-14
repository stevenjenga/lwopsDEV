<?php
/**
 *   PHP MYSQL Form Maker 
 *   version 3.1.0
 *   All copyrights are preserved to StarSoft
 */
define("DIRECTACESS", "true");
session_start();
$_SESSION = array();
$params = session_get_cookie_params();
//delete the actual cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}
session_destroy();
unset($_SESSION);

if (isset($_SESSION[$form_prefix . 'username'])) {
    echo '
			<link href="../../layout/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
			<script src="../../js/jquery-1.7.2.min.js"></script>
			<script src="../../layout/bootstrap/js/bootstrap.js"></script>
			<div class="container" style="position: relative;top: 10px;">
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<div>
						<strong>Error in logout!</strong> Browser can\'t logout, so please close browser to logout
					</div>
				</div>
			</div>';
    exit();
} else {
    header('location: login.php');
}
?>