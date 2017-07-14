<?php
	error_reporting(E_ERROR  | E_PARSE);
	session_start();
	require_once "../helpers/safeValue.php";

	$allStyles = array(
		"mobile",
		"blue",
		"coffee",
		"GreyScale",
		"olive"		
	);

	$allLayouts = array(
		"Mobile",
		"AlignLeft1",
		"AlignLeft2",
		"Stepped",
		"Block",
		"Outline1",
		"Outline2"
	);

	$error = "";
	
	//set layout, style_name, titles, security options in session
	if(isset($_POST["layout"]) && isset($_POST["style_name"]))
	{
		$layout = clean_input($_POST["layout"]);
		$style = clean_input($_POST["style_name"]);
                if(!is_numeric($_POST['txt_records_per_page']))
                {
                    echo '<3stT>- Record per page must be numeric.';
                    exit();
                }
		$txt_report_title = (isset($_POST['txt_report_title'])) ? clean_input($_POST['txt_report_title']) : "";
		$txt_report_header = (isset($_POST['txt_report_header'])) ? clean_input($_POST['txt_report_header']) : "";
		$txt_report_footer = (isset($_POST['txt_report_footer']) ) ? clean_input($_POST['txt_report_footer']) : "";
		$txt_records_per_page = (isset($_POST['txt_records_per_page'])) ? clean_input($_POST['txt_records_per_page']) : "";
		$txt_report_name = (isset($_POST['txt_report_name'])) ? clean_input($_POST['txt_report_name']) : "";
		if(!in_array($layout, $allLayouts)) $error .= "<1stT>- Layout not found";
		else if(!in_array($style, $allStyles)) $error .= "<1stT>- Style not found";
		else if(($layout === "Mobile" && $style !== "mobile") || ($layout !== "Mobile" && $style === "mobile")) $error .= "<1stT>- Style AND Layout Not Match";
		else if(empty($txt_report_name) || $txt_report_name === "") $error .= "<3stT>- Please enter report name";
		else{
			$_SESSION["srm_f62014_layout"] = $layout;
			$_SESSION["srm_f62014_style_name"] = $style;
			
			$_SESSION['srm_f62014_date_created']=date("d-M-Y H:i:s");
			$_SESSION['srm_f62014_title'] = $txt_report_title;
			$_SESSION['srm_f62014_header'] = $txt_report_header;
			$_SESSION['srm_f62014_footer'] = $txt_report_footer;
			$_SESSION['srm_f62014_file_name'] = $txt_report_name;
			$_SESSION['srm_f62014_records_per_page'] = $txt_records_per_page;
			$_SESSION['srm_f62014_chkSearch'] = ($_SESSION["srm_f62014_datasource"] === 'table') ? "Yes" : "";
			
			$_SESSION["srm_f62014_security"] = adjust($_POST["security"]);
			if($_SESSION["srm_f62014_security"] !== "enabled")
			{
				$_SESSION["srm_f62014_sec_Username"] = "";
				$_SESSION["srm_f62014_sec_pass"] = "";
			}
			$_SESSION["srm_f62014_members"] = adjust($_POST["members"]); 
			if($_SESSION["srm_f62014_members"] !== "enabled")
			{
				$_SESSION["srm_f62014_sec_table"] = "";
				$_SESSION["srm_f62014_sec_Username_Field"] = "";
				$_SESSION["srm_f62014_sec_pass_Field"] = "";
				$_SESSION["srm_f62014_sec_pass_hash_type"] = "";
			}
			$_SESSION["srm_f62014_Forget_password"] = adjust($_POST["Forget_password"]);
			if($_SESSION["srm_f62014_Forget_password"] !== "enabled") $_SESSION["srm_f62014_sec_email"] = "";
			
			if($_SESSION["srm_f62014_layout"] === 'Mobile'){
				if(adjust($_POST["security"]) === "enabled" || adjust($_POST["Forget_password"]) === "enabled"|| adjust($_POST["members"]) === "enabled")
				$error .= "<br />- Security Options, Forget password and Members login are not supported for the mobile layout ";
			}else{
				//security enabled and user name and password is empty
				if(adjust($_POST["security"]) === "enabled")
				{
					if(!CheckVar($_POST["sec_Username"])|| !CheckVar($_POST["sec_pass"]))
						$error .= "<br />- Admin Username or password is empty";
					else if(!clean($_POST["sec_Username"])) // username  shouldn't have  attackers
						$error .= "<br />- Admin Username should not include any special characters or sql commands for security reasons";
                                        
                                        //Password must be at least 8 character
                                        else if(strlen($_POST["sec_pass"]) < 8 || strtolower($_POST["sec_pass"]) == $_POST["sec_pass"] || strtoupper($_POST["sec_pass"]) == $_POST["sec_pass"] || !preg_match('#[0-9]#',$_POST["sec_pass"]) )
						$error .= "<br />- Admin Password shouldn't be less than 8 alphanumeric characters and it must contain a combination of uppercase and lowercase letters, and numbers  ";
                                        
					else if(strstr($_POST["sec_pass"]," ")) //password shouldn't include empty
						$error .= "<br />- Admin Password should not include any spaces  for security reasons";
					else if(preg_match('/[^a-z0-9_]/i', $_POST["sec_pass"]) != false) //password shouldn't include special chars
						$error .= "<br />- Admin Password should not include any special characters just use alphabetical characters, numbers and underscore";
					else{						
						if($_SESSION["srm_f62014_security"] === "enabled")
						{
							$_SESSION["srm_f62014_sec_Username"] = clean_input($_POST["sec_Username"]);
							$_SESSION["srm_f62014_sec_pass"] = md5($_POST["sec_pass"]);
						}
					}
				}
				//members is enabled yet table, user name , password is missing 
				if(adjust($_POST["members"]) === "enabled")
				{
					if(adjust($_POST["security"]) !== "enabled")
						$error .= "<br />- To enable the members login, you must enable the security options first";
					else if(!CheckVar($_POST["sec_table"]) || !CheckVar($_POST["sec_Username_Field"]) || !CheckVar($_POST["sec_pass_Field"]))
						$error .= "<br />- Members Table, Username field or password field is empty";
					else {
						if($_SESSION["srm_f62014_members"] === "enabled")
						{
							$_SESSION["srm_f62014_sec_table"] = clean_input($_POST["sec_table"]);
							$_SESSION["srm_f62014_sec_Username_Field"] = clean_input($_POST["sec_Username_Field"]);
							$_SESSION["srm_f62014_sec_pass_Field"] = clean_input($_POST["sec_pass_Field"]);
							$_SESSION["srm_f62014_sec_pass_hash_type"] = clean_input($_POST["sec_pass_hash_type"]);
						}
					}
				}
				// email must be in valid email formats
				//forget password is enabled and email is empty 
				if(adjust($_POST["Forget_password"]) === "enabled")
				{
					if(!CheckVar($_POST["sec_email"])) $error .= "<br />- Admin Email is empty";
					else if(!clean($_POST["sec_email"]) || !strstr($_POST["sec_email"],"@") || !strstr($_POST["sec_email"],"."))
						$error .= "<br />- Admin email address is not valid";
					else if(adjust($_POST["security"]) !== "enabled") 
						$error .= "<br />- To enable the Forget Password, you must enable the security options first";
					else{
						if($_SESSION["srm_f62014_Forget_password"] === "enabled")
							$_SESSION["srm_f62014_sec_email"] = clean_input($_POST["sec_email"]);
					}
				}
			}
		}
		if($error !== "") echo $error;
		else echo "success";
		exit();
		
	}
	
	// check if string empty or equal to not expected value
	function CheckVar($str)
	{
		if(isset($str))
		{
			if(empty($str) || $str === "NoValue" || $str === "Please select a value") return false;
			else return true;
		}else return false;
	}
	// return enabled if checkbox checked
	function adjust($string)
	{   
		if(isset($string))
		{
			if(empty($string)) return "";
			else if($string === "1"||$string === "checked"||$string === "on") return "enabled";
			else return "";
		}else return "";
	}
	// this clean inserted (coming from session) values
	function clean($str){
		$str = strtolower($str);
		$attacks = array("'", '"', "$", "%", "drop", "insert", "update", "select", "alter", " or ", " and ", " ", ",", "*", "delete");
		foreach($attacks as $attack) if(strstr($str,$attack)) return false;
		return true;
	}