<?php
	/*
		shared.php
		handles all requests sent 
	*/
        if (! defined('DIRECTACESS')) exit('No direct script access allowed');
        error_reporting(0);
	ini_set('session.use_only_cookies', 1);	
	$cookieParams = session_get_cookie_params();
	session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $cookieParams["secure"],
        true);
	session_start();
	session_regenerate_id();	
	
	require_once "lib.php";
	require_once "cl_login.php";
        $login = new Login();
     
	require_once "cl_navbar.php";
	
	//creates a 3 character sequence
function createSalt($userinfo)
{ 
    
    $string = sha1(substr($userinfo, intval(strlen($userinfo)/2), strlen($userinfo)-1));
    return substr($string, 0, 3);	
}

function valid_username($tested_username){
    global $login;
    	if(preg_match('/[^a-z0-9_]/i', $tested_username) || strlen($tested_username) < 5 || is_numeric($tested_username[0]) || $tested_username[0] === '_'){
	
            return false;
          
	}

	else if($tested_username == $login->getUsername()){
	return true;

	}
	else{
            $x = $login->getUsername();
      
	  return false;
          
	}
}

function valid_email($tested_email){
    global $login;

   if( !filter_var($tested_email, FILTER_VALIDATE_EMAIL) )
   {
     return false;
   }
   else if($tested_email == $login->getEmail()){
     return true;
   }
   else{
    return false;
   }
}


function send_profile_change_notification($change_type){
    
    global $login,$_SERVER;
    $server = $_SERVER['SERVER_NAME'];
    $ip = $_SERVER["REMOTE_ADDR"];
    $message = "This is an automatic notification \n";
    if($change_type=="password"){
        $message .= "Please be informed that your MySQL Pivot table generator password was changed based on your request. This action was taken place through the 'Change Password' section of the MySQL Pivot table generator version which is installed on your server   $server  . The Ip address used for the request was : $ip\n";
        mail($login->getEmail(), "Password change Notification",$message);
    }
    else{
        $message .= "Please be informed that the Admin Email address of your installed version of MySQL Pivot table generator was changed  based on your request. This action was taken place through the 'Change Email' section of  MySQL Pivot table generator  at your server   $server . The Ip address used for the request was $ip : \n";
        mail($login->getEmail(), "Profile change Notification",$message);
        
    }
}

	/*
		Allowed keys for [POST], [GET], [SESSION]
	*/
	$post_keys = array("table", "column", "connection", "dbName", "dbUser", "dbPass", "dbHost", "tableName", "protected"
		, "levels", "colsTable", "colsField", "colsAlias", "colsFunc", "rowsTable", "rowsField", "rowsAlias", "gridTable"
		, "gridField", "gridFunc", "isNumeric", "allowRowsPagination", "recordPerPage", "maxRecordsPerPage"
		, "allowColsPagination", "columnPerPage", "maxCols", "relationship", "folderName", "username", "password", "email"
		, "retrievePassEmail", "oldPass", "newPass", "oldEmail", "newEmail", "pageNum", "location", "style", "func","user","encValue","submit");

	$get_keys = array("from", "path", "debug_mode_6");

	$session_keys = array("PT_Login_discard_after", "PT_Login_validLogin", "PT_Login_password", "PT_Login_username","PT_Login_Folder_name", "PT_temp_dbConnected", "PT_folder_setting_tableName",
		"pt_str_host", "pt_str_user", "pt_str_pass", "pt_str_db",
		"pt_bool_protected", "pt_str_Levels", "pt_str_Ctable", "pt_str_Cfield", "pt_str_Calias", "pt_str_CfieldFunction",
		"pt_str_Rtable", "pt_str_Rfield", "pt_str_Ralias", "pt_bool_IsNumeric", "pt_str_Gtable", "pt_str_Gcol", "pt_str_Gfunc",
		"pt_arr_relationships", "pt_bool_AllowRowsPagination", "pt_int_recordPerPage", "pt_int_maxRecordPerPage",
		"pt_bool_AllowColsPagination", "pt_int_columnPerPage", "pt_int_maxColumns",
		"location", "totals", "style", "debug_mode_6", "css");

	/*
		To Make sure that requestes to server limited to what you want (Allowed keys).
	*/
	unset($_COOKIE);
	$_COOKIE = array();
	$_POST = clean_super_register($_POST, $post_keys);
	$_GET = clean_super_register($_GET, $get_keys);
	$_SESSION = clean_super_register($_SESSION, $session_keys);