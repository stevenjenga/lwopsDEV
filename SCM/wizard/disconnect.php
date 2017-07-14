<?php
	error_reporting(E_ERROR  | E_PARSE);
	session_start();
	unset($_SESSION);
	session_destroy();
	header("location: step_2.php");