<?php
	defined('SYSTEM_CONTROL') or die (header('location: ../wizard'));
	require_once("lib.php");
	require_once 'checkSession.php';
	require_once 'helpers/safeValue.php';
	if(sessionBe4Step4() === false) 
	{
		header("location: $url?id=1");
		exit();
	}else if(sessionBe4Step5() === false)
	{
		header("location: $url?id=2");
		exit();
	}
	$_SESSION['srm_f62014_page_key'] = "step_6";
	require_once 'activePages.php';
	
	
	// set layout and images associated with it
	$layout = isset($_SESSION["srm_f62014_layout"]) ? $_SESSION["srm_f62014_layout"] : 'AlignLeft2';
	if($layout == 'AlignLeft1') $image = 'layout_align_left1.gif';
	else if($layout == 'Mobile') $image = 'mob-layout.png';
	else if($layout == 'AlignLeft2') $image = 'layout_align_left2.gif';
	else if($layout == 'Stepped') $image = 'layout_stepped.gif';
	else if($layout == 'Block') $image = 'layout_block.gif';
	else if($layout == 'Outline1') $image = 'layout_outline1.gif';
	else if($layout == 'Outline2') $image = 'layout_outline2.gif';

	$layout = strtolower($layout);
	// set styles
	$styles = "";

	if(isset($_SESSION['srm_f62014_style_name']) && !empty($_SESSION['srm_f62014_style_name'])) $style_name = $_SESSION['srm_f62014_style_name'];
	else $style_name = 'GreyScale';

	// read styles from styles directory
	$dir = dir("styles");
	while(false !== ($entry = $dir->read())) 
	{
		if($entry !== "." && $entry !== "..")
		{
			if(isset($_SESSION['srm_f62014_layout']) 
				&& (($_SESSION['srm_f62014_layout'] === 'Mobile' && $entry !== 'mobile.css' ) || ($_SESSION['srm_f62014_layout'] !== 'Mobile' && $entry === 'mobile.css')))
					continue;
					
			$formatted_css_name = substr($entry, 0, strlen($entry)-4);
			if($style_name === $formatted_css_name) 
				$styles .= "<option value='$formatted_css_name' selected>" . $formatted_css_name. "</option>";			
			else 
				$styles .= "<option value='$formatted_css_name'>" . $formatted_css_name . "</option>";
		}
	}
	$dir->close();
	
	// get tables and columns for security panel
	$mydb = clean_input($_SESSION["srm_f62014_db"]);
	$tables = $dbHandler->query("show tables from `$mydb`");
	
	$securityTablesInfo = array();
	foreach ($tables as $table)
	{
		$columns = $dbHandler->query("show columns from `".$table[0]."`");
		foreach ($columns as $column) $securityTablesInfo[$table[0]][] = $column[0];
	}
	// this display option in select elements
	function display_options($string)
	{
		global $_SESSION, $tables;
		echo "<option value='NoValue'> Please select a value </option>";
		if($string === "sec_table")
		{
			foreach($tables as $row)
			{  
				if (isset($_SESSION["srm_f62014_sec_table"]) && $row[0] === $_SESSION["srm_f62014_sec_table"]) $selected = "selected";
				echo "<option $selected value='".$row[0]."'>". $row[0] . "</option>" ;
				$selected = "" ;
			}
		}
		else if(CheckVar($_SESSION["srm_f62014_sec_table"]) && $string === "sec_Username_Field")
		{
			if(CheckVar($_SESSION["srm_f62014_sec_Username_Field"])) LoadFields($_SESSION["srm_f62014_sec_Username_Field"]);
			else LoadFields("");
		}else if(CheckVar($_SESSION["srm_f62014_sec_table"]) && $string === "sec_pass_Field")
		{
			if(CheckVar($_SESSION["srm_f62014_sec_pass_Field"])) LoadFields($_SESSION["srm_f62014_sec_pass_Field"]);
			else LoadFields("");
		}
		
	}
	// check string is not expected value or not
	function CheckVar($str)
	{
		if(isset($str))
		{
			if(empty($str) || $str === "NoValue" || $str === "Please select a value") return false;
			else return true;
		}else return false;
	}
	// set columns for select elements
	function LoadFields($selectedField)
	{
		global $securityTablesInfo;
		$fields = $securityTablesInfo[$_SESSION["srm_f62014_sec_table"]];
		foreach ($fields as $key => $field)
		{
			if($field == $selectedField) $selected = "selected";
			else $selected = "";
			echo "<option $selected value='".$field."'>". $field . "</option>" ;
		}
	}
	
	$json = json_encode($securityTablesInfo); // send data(tables and columns) to client side to make less loading
	
	// get default value for titles
	function get_default_value($var)
	{	
		if(!isset($_SESSION["srm_f62014_records_per_page"])) $_SESSION["srm_f62014_records_per_page"] = 25;
	
		if($var == 'txt_report_title') $s_var = 'srm_f62014_title';
		else if($var == 'txt_report_header') $s_var = 'srm_f62014_header';
		else if($var == 'txt_report_footer') $s_var = 'srm_f62014_footer';
		else if($var == 'txt_report_name') $s_var = 'srm_f62014_file_name';
		else if($var == 'txt_records_per_page') $s_var = 'srm_f62014_records_per_page';
		
		if(isset($_SESSION[$s_var]) && !empty($_SESSION[$s_var])) return $_SESSION[$s_var];
		else return "";
	}
?>
<div id="tabs" class="container col-xs-12"><!-- -->
	<!-- Nav tabs nav nav-tabs -->
	<ul class="" style="font-size: 12px;">
		<li class="active"><a id="layout-nav" href="#layout" data-toggle="tab"><span class="glyphicon glyphicon-list"></span> Appearance</a></li>
		<li class="active"><a id="security-nav" href="#securityPanel" data-toggle="tab"><span class="glyphicon glyphicon-lock"></span> Security</a></li>
		<li class="active"><a id="titles-nav" href="#titlesPanel" data-toggle="tab"><span class="glyphicon glyphicon-pencil"></span> Titles</a></li>
	</ul>
	<!-- Tab panes -->
	<div class="tab-content">
		<div class="tab-pane active" id="layout">
			<form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="return false;">
				<!-- Please select the report layout -->
				<div class="row">
					<div class="col-xs-1"></div>
					<div id="layout-error-container" class="col-xs-10"></div>
					<div class="col-xs-1"></div>
				</div>
				<div class="row">
					<div class="col-xs-1"></div>
					<div class="col-xs-3" style="margin: 0px;padding: 0px;border-bottom: 1px solid #dfdfdf;">Layout</div>
					<div class="col-xs-8"></div>
				</div>
				<div class="row">
					<div class="col-xs-1"></div>
					<div class="col-xs-3">
						<div class="row">
							<div class="radio">
								<label>
								<input type="radio" name="option" id="mobile" value="Mobile" />
								Mobile <span style="color: red; font-size: 10px;">(new)*</span><!--onclick="document['img_layout'].src= 'images/mob-layout.png';"-->
								</label>
							</div>
						</div>
						<div class="row">
							<div class="radio">
								<label>
								<input type="radio" name="option" id="alignleft1" value="AlignLeft1" />
								Align Left 1
								</label>
							</div>
						</div>
						<div class="row">
							<div class="radio">
								<label>
								<input type="radio" name="option" id="alignleft2" value="AlignLeft2" />
								Align Left 2
								</label>
							</div>
						</div>
						<div class="row">
							<div class="radio">
								<label>
								<input type="radio" name="option" id="stepped" value="Stepped" />
								Stepped
								</label>
							</div>
						</div>
						<div class="row">
							<div class="radio">
								<label>
								<input type="radio" name="option" id="block" value="Block" />
								Block
								</label>
							</div>
						</div>
						<div class="row">
							<div class="radio">
								<label>
								<input type="radio" name="option" id="outline1" value="Outline1" />
								Outline 1
								</label>
							</div>
						</div>
						<div class="row">
							<div class="radio">
								<label>
								<input type="radio" name="option" id="outline2" value="Outline2" />
								Outline 2
								</label>
							</div>
						</div>
					</div>
					<div class="col-xs-6">
						<img src="designLayer/images/<?php echo $image; ?>" width="233" height="210" id="img_layout" name="img_layout" class="img-thumbnail"/>
			
					</div>
					<div class="col-xs-2">
						<a href="" id="layoutHelp" onclick="return false;">
							<img src="designLayer/images/help.png" width="15" height="15" border="0">
						</a>
					</div>
				</div>
				
				<hr />
				
				<div class="row" style="margin-top: -10px;">
					<div class="col-xs-1" style="margin-left: -10px;"></div>
					<div class="form-group col-xs-5">
						<label for="style_name">Styles</label>
						<div class="left-inner-addon">
							<i class="glyphicon glyphicon-fire"></i>
							<select id="style_name" name="style_name" class="form-control"><!--  onChange="refresh()" -->
								<?php echo $styles; ?>
							</select>
						</div>
					</div>
					<div class="help-container-i col-xs-6">
						<a href="" id="styleHelp" onClick="return false;">
							<img src="designLayer/images/help.png" width="15" height="15" border="0">
						</a>
					</div>
				</div>	<!-- .row (style_name) -->
				
			</form>
		</div>
		<div class="tab-pane" id="securityPanel" style="min-height: 250px;">
			<form name="secForm" id="secForm" role="form"  action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="return false;">
				<div class="row">
					<div class="col-xs-1"></div>
					<?php if(isset($_SESSION["srm_f62014_layout"]) && $_SESSION["srm_f62014_layout"] === 'Mobile'): ?>
					<div class='alert alert-danger'>- Security Options, Forget password and Members login are not supported for the mobile layout.</div>
					<?php endif; ?>
					<div id="error-container" class="col-xs-10"></div>
					<div class="col-xs-1"></div>
				</div>
			
				<!-- -->
				<div class="row">
					<a class="cr-hand" id="secOptions-controller"><span id="status-icon" class="glyphicon glyphicon-play font-xs"></span>
						<span class="glyphicon glyphicon-lock"></span> Security Options</a>
				</div>
				<div class="row" id="secOptions" style="display: none;">
					<div class="row">
						<div class="col-xs-1"></div>
						<div class="col-xs-11">
							<div class="checkbox">
								<label>
									<input type="checkbox" id="security" name ="security" class="security" checked
										<?php if(((isset($_SESSION["srm_f62014_security"]) && $_SESSION["srm_f62014_security"] === "enabled") || !isset($_SESSION["srm_f62014_security"])) && (!isset($_SESSION["srm_f62014_layout"]) || (isset($_SESSION["srm_f62014_layout"]) && $_SESSION["srm_f62014_layout"] === 'Mobile'))) echo "checked"; ?> /> Password protect generated report 
								</label>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-xs-1"></div>
						<div class="form-group col-xs-6">
							<label for="security">Admin User Name</label>
							<div class="left-inner-addon">
								<i class="glyphicon glyphicon-user"></i>
								<input type="text" data-disable-controller="security" class="form-control" value="<?php if(isset($_SESSION["srm_f62014_sec_Username"])) echo $_SESSION["srm_f62014_sec_Username"]; ?>" name="sec_Username" id="sec_Username" ?>
							</div>
						</div>
						<div class="help-container col-xs-5">
							<a href="" id="adminUserHelp" onClick="return false;">
								<img src="designLayer/images/help.png" width="15" height="15" border="0">
							</a>
						</div>
					</div>
					
					<div class="row">
						<div class="col-xs-1"></div>
						<div class="form-group col-xs-6">
							<label for="sec_pass">Admin Password</label>
							<div class="left-inner-addon">
								<i class="glyphicon glyphicon-lock"></i>
								<input type="password" data-disable-controller="security" class="form-control" value="<?php // if(isset($_SESSION["srm_f62014_sec_pass"])) echo $_SESSION["srm_f62014_sec_pass"]; ?>" name="sec_pass" id="sec_pass" ?>
							</div>
						</div>
						<div class="help-container col-xs-5">
							<a href="" id="adminPassHelp" onClick="return false;">
								<img src="designLayer/images/help.png" width="15" height="15" border="0">
							</a>
						</div>
					</div>
				</div>
				<hr />
				<!--  -->
				
				<div class="row">
					<a  class="cr-hand" id="memberLogin-controller"><span id="status-icon1" class="glyphicon glyphicon-play font-xs"></span>
						<span class="glyphicon glyphicon-user"></span> Members Login</a>
				</div>
				<div class="row" id="memberLogin" style="display: none;">
					<div class="row">
						<div class="col-xs-1"></div>
						<div class="col-xs-11">
							<div class="checkbox">
								<label>
									<input type="checkbox" id="members" name="members" data-disable-controller="security" class="security" 
										<?php if(isset($_SESSION["srm_f62014_members"]) && $_SESSION["srm_f62014_members"] === "enabled") echo "checked"; ?> />Allow members to login to the generated report 
								</label>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-xs-1"></div>
						<div class="form-group col-xs-6">
							<label for="sec_table">Members Table</label>
							<div class="left-inner-addon">
								<i class="glyphicon glyphicon-list-alt"></i>
								<select data-disable-controller="members" class="form-control" id="sec_table" name="sec_table" >
									<?php display_options("sec_table"); ?>
								</select>
							</div>
						</div>
						<div class="help-container col-xs-5">
							<a href="" id="memberTableHelp" onClick="return false;">
								<img src="designLayer/images/help.png" width="15" height="15" border="0">
							</a>
						</div>
					</div>	
					
					<div class="row">
						<div class="col-xs-1"></div>
						<div class="form-group col-xs-6">
							<label for="sec_Username_Field">UserName Field</label>
							<div class="left-inner-addon">
								<i class="glyphicon glyphicon-user"></i>
								<select data-disable-controller="members" class="form-control" id="sec_Username_Field"  name="sec_Username_Field">
									<?php display_options("sec_Username_Field"); ?>
								</select>
							</div>
						</div>
						<div class="help-container col-xs-5">
							<a href="" id="memberUserHelp" onClick="return false;">
								<img src="designLayer/images/help.png" width="15" height="15" border="0">
							</a>
						</div>
					</div>	
					
					<div class="row">
						<div class="col-xs-1"></div>
						<div class="form-group col-xs-6">
							<label for="sec_pass_Field">Password Field</label>
							<div class="left-inner-addon">
								<i class="glyphicon glyphicon-lock"></i>
								<select data-disable-controller="members" class="form-control" id="sec_pass_Field" name="sec_pass_Field">
									<?php display_options("sec_pass_Field"); ?>
								</select>
							</div>
						</div>
						<div class="help-container col-xs-5">
							<a href="" id="memberPassHelp" onClick="return false;">
								<img src="designLayer/images/help.png" width="15" height="15" border="0">
							</a>
						</div>
					</div>
					
					<div class="row">
						<div class="col-xs-1"></div>
						<div class="form-group col-xs-6">
							<label for="sec_pass_hash_type">Password Hash Type</label>
							<div class="left-inner-addon">
								<i class="glyphicon glyphicon-lock"></i>
								<select data-disable-controller="members" class="form-control" id="sec_pass_hash_type" name="sec_pass_hash_type">
									<option value="none" <?php if($_SESSION["srm_f62014_sec_pass_hash_type"] === 'none') echo 'selected'; ?>>None</option>
									<option value="md5" <?php if($_SESSION["srm_f62014_sec_pass_hash_type"] === 'md5') echo 'selected'; ?>>MD5</option>
									<option value="sha1" <?php if($_SESSION["srm_f62014_sec_pass_hash_type"] === 'sha1') echo 'selected'; ?>>SHA1</option>
									<option value="crypt" <?php if($_SESSION["srm_f62014_sec_pass_hash_type"] === 'crypt') echo 'selected'; ?>>crypt</option>
								</select>
							</div>
						</div>
						<div class="help-container col-xs-5">
							<a href="" id="memberPassHashTypeHelp" onClick="return false;">
								<img src="designLayer/images/help.png" width="15" height="15" border="0">
							</a>
						</div>
					</div>
					
					<div class="row" id="note">
						<div class="col-xs-1"></div>
						<div class="form-group col-xs-10">
							<div class="alert alert-info" style="margin-bottom: 0px;">
							** To Enable Members login please enable the security options first.
							</div>
						</div>
						<div class="col-xs-1"></div>
					</div>
				</div>
				<hr />
				
				
				<!--  -->
				<div class="row" style="margin-bottom: 20px;">
					<a id="forgetPass-controller" class="cr-hand"><span id="status-icon2" class="glyphicon glyphicon-play font-xs"></span>
						<span class="glyphicon glyphicon-envelope"></span> Change Member Password</a>
				</div>
				<div class="row" id="forgetPass" style="display: none;margin-bottom: 20px;">
					<div class="row">
						<div class="col-xs-1"></div>
						<div class="col-xs-11">
							<div class="checkbox">
								<label>
									<input type="checkbox" id="Forget_password"  data-disable-controller="security" name="Forget_password" class="security" 
										<?php if(isset($_SESSION["srm_f62014_Forget_password"]) && $_SESSION["srm_f62014_Forget_password"] === "enabled") echo "checked"; ?> />
										Allow member password retrieval via Admin email
								</label>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-xs-1"></div>
						<div class="form-group col-xs-6">
							<label for="sec_email">Admin Email</label>
							<div class="left-inner-addon">
								<i class="glyphicon glyphicon-envelope"></i>
								<input type="text" data-disable-controller="Forget_password" class="form-control" 
									value="<?php if(isset($_SESSION["srm_f62014_sec_email"])) echo $_SESSION["srm_f62014_sec_email"]; ?>" id="sec_email" name ="sec_email"  ?>
							</div>
						</div>
						<div class="help-container col-xs-5">
							<a href="" id="adminEmailHelp" onClick="return false;">
								<img src="designLayer/images/help.png" width="15" height="15" border="0">
							</a>
						</div>
					</div>	
				</div>
			</form>
		</div>
		<div class="tab-pane" id="titlesPanel">
		
			<form id="titlesForm" name="titlesForm" action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="return false;">
				<!-- Report Settings -->
				<div class="row">
					<div class="col-xs-1"></div>
					<div id="titles-error-container" class="col-xs-10"></div>
					<div class="col-xs-1"></div>
				</div>
				<div class="row">
					<div class="col-xs-1"></div>
					<div class="form-group col-xs-10" style="margin-top: -10px;">
						<label for="txt_report_title">Report Title</label>
						<div class="left-inner-addon">
							<i class="glyphicon glyphicon-edit"></i>
							<input name="txt_report_title" class="form-control" type="text" id="txt_report_title" value="<?php echo get_default_value('txt_report_title')?>"/>
						</div>
					</div>
					<div class="help-container-i col-xs-1">
						<a href="" id="rTitleHelp" onClick="return false;">
							<img src="designLayer/images/help.png" width="15" height="15" border="0">
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-1"></div>
					<div class="form-group col-xs-10" style="margin-top: -10px;">
						<label for="txt_report_footer">Report Footer</label>
						<div class="left-inner-addon">
							<i class="glyphicon glyphicon-edit"></i>
							<textarea name="txt_report_footer" class="form-control" rows="2" id="txt_report_footer"><?php echo get_default_value('txt_report_footer') ?></textarea>
						</div>
					</div>
					<div class="help-container-i col-xs-1">
						<a href="" id="rFooterHelp" onClick="return false;">
							<img src="designLayer/images/help.png" width="15" height="15" border="0" align="absmiddle">
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-1"></div>
					<div class="form-group col-xs-10" style="margin-top: -10px;">
						<label for="txt_report_header">Report Header</label>
						<div class="left-inner-addon">
							<i class="glyphicon glyphicon-edit"></i>
							<textarea name="txt_report_header" class="form-control" rows="2" id="txt_report_header"><?php echo get_default_value('txt_report_header')?></textarea>
						</div>
					</div>
					<div class="help-container-i col-xs-1">
						<a href="" id="rHeaderHelp" onClick="return false;">
							<img src="designLayer/images/help.png" width="15" height="15" border="0">
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-1"></div>
					<div class="form-group col-xs-10" style="margin-top: -10px;">
						<label for="txt_report_name">Report name</label>
						<div class="left-inner-addon">
							<i class="glyphicon glyphicon-edit"></i>
							<input name="txt_report_name" type="text" id="txt_report_name" class="form-control" value="<?php  echo get_default_value('txt_report_name') ?>" />
						</div>
					</div>
					<div class="help-container-i col-xs-1">
						<a href="" id="rNameHelp" onClick="return false;">
							<img src="designLayer/images/help.png" width="15" height="15" border="0">
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-1"></div>
					<div class="form-group col-xs-10" style="margin-top: -10px;">
						<label for="txt_records_per_page">Records per page</label>
						<div class="left-inner-addon">
							<i class="glyphicon glyphicon-edit"></i>
							<input name="txt_records_per_page" type="text" id="txt_records_per_page" class="form-control" value="<?php echo get_default_value('txt_records_per_page')?>">
						</div>
					</div>
					<div class="help-container-i col-xs-1">
						<a href="" id="rPPHelp" onClick="return false;">
							<img src="designLayer/images/help.png" width="15" height="15" border="0">
						</a>
					</div>
				</div>
			</form>

		</div>
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-4">
				<button name="btn_back" id="btn_back" class="btn btn-sunny btn-block">
					<span class="icon glyphicon glyphicon-backward"></span><span class="separator"></span> Back
				</button>
			</div>
			<div class="col-xs-3"></div>
			<div class="col-xs-4">
				<button name="continue" id="btn_cont" class="btn btn-sunny btn-block" >
					<span class="icon glyphicon glyphicon-flag"></span><span class="separator"></span> Finish
				</button>
			</div>
		</div><!-- .row (navigation buttons) -->
	</div>
		<!-- to complete index tags -->
		</div>
		
	</div>
</div>
</div>
<script>
	var layout = "<?php echo $layout; ?>";
	var stylesExceptMobile = ["blue", "coffe", "GreyScale", "olive"];
	var secTablesInfo = <?php echo $json; ?>;
	
	$(function(){
		$("#tabs").tabs();		
		
                
		$("#"+layout).prop("checked", true);
		
		$("#page-header").empty();
		$("#page-header").append('<div id="img-container"><img src="designLayer/images/appearance.png" width="70" height="70"/></div>');
		$("#page-header").append('<div id="text-container"><h4>Apperance</h4>Choose how report seem</div>');
		
		$("#layout-nav").click(function(){
		
			$("#page-header").empty();
			$("#page-header").append('<div id="img-container"><img src="designLayer/images/appearance.png" width="70" height="70"/></div>');
			$("#page-header").append('<div id="text-container"><h4>Apperance</h4>Choose how report seem</div>');
			
		});
		
		$("#security-nav").click(function(){
		
			$("#page-header").empty();
			$("#page-header").append('<div id="img-container"><img src="designLayer/images/security.png" width="70" height="70"/></div>');
			$("#page-header").append('<div id="text-container"><h4>Security</h4>Set Security options to your report</div>');
			
		});
		
		$("#titles-nav").click(function(){
		
			$("#page-header").empty();
			$("#page-header").append('<div id="img-container"><img src="designLayer/images/titles.png" width="70" height="70"/></div>');
			$("#page-header").append('<div id="text-container"><h4>Titles</h4>Set Titles for your report</div>');
			
		});
		// -------------------------------------- accordion in security panel-------------------------------
		$("#secOptions-controller").mousedown(function(){
			if($("#secOptions").css("display") === "none")
			{
				$("#status-icon").removeClass("glyphicon-play");
				$("#status-icon").addClass("caret");
				$("#secOptions").show();
				$("#status-icon1").removeClass("caret");
				$("#status-icon1").addClass("glyphicon-play");
				$("#memberLogin").hide();
				$("#status-icon2").removeClass("caret");
				$("#status-icon2").addClass("glyphicon-play");
				$("#forgetPass").hide();
			}else{
				$("#status-icon").removeClass("caret");
				$("#status-icon").addClass("glyphicon-play");
				$("#secOptions").hide();
			}
		});
		
		$("#secOptions-controller").trigger("mousedown");
		
		$("#memberLogin-controller").mousedown(function(){
			if($("#memberLogin").css("display") === "none")
			{
				$("#status-icon1").removeClass("glyphicon-play");
				$("#status-icon1").addClass("caret");
				$("#memberLogin").show();
				$("#status-icon").removeClass("caret");
				$("#status-icon").addClass("glyphicon-play");
				$("#secOptions").hide();
				$("#status-icon2").removeClass("caret");
				$("#status-icon2").addClass("glyphicon-play");
				$("#forgetPass").hide();
			}else{
				$("#status-icon1").removeClass("caret");
				$("#status-icon1").addClass("glyphicon-play");
				$("#memberLogin").hide();
			}
		});
		
		$("#forgetPass-controller").mousedown(function(){
			if($("#forgetPass").css("display") === "none")
			{
				$("#status-icon2").removeClass("glyphicon-play");
				$("#status-icon2").addClass("caret");
				$("#forgetPass").show();
				$("#status-icon").removeClass("caret");
				$("#status-icon").addClass("glyphicon-play");
				$("#secOptions").hide();
				$("#status-icon1").removeClass("caret");
				$("#status-icon1").addClass("glyphicon-play");
				$("#memberLogin").hide();
			}else{
				$("#status-icon2").removeClass("caret");
				$("#status-icon2").addClass("glyphicon-play");
				$("#forgetPass").hide();
			}
		});
		// -------------------------------------------------------------------------------
		
		$("#mobile").click(function(){
			$("#img_layout").attr("src", "designLayer/images/mob-layout.png");
			$("#style_name").empty();
			$("#style_name").append("<option value='mobile' selected>mobile</option>");
		});
		$("#alignleft1").click(function(){
			$("#img_layout").attr("src", "designLayer/images/layout_align_left1.gif");
			setStyleOptions();
		});
		$("#alignleft2").click(function(){
			$("#img_layout").attr("src", "designLayer/images/layout_align_left2.gif");		
			setStyleOptions();
		});
		$("#stepped").click(function(){
			$("#img_layout").attr("src", "designLayer/images/layout_stepped.gif");	
			setStyleOptions();			
		});
		$("#block").click(function(){
			$("#img_layout").attr("src", "designLayer/images/layout_block.gif");
			setStyleOptions();
		});
		$("#outline1").click(function(){
			$("#img_layout").attr("src", "designLayer/images/layout_outline1.gif");	
			setStyleOptions();
		});
		$("#outline2").click(function(){
			$("#img_layout").attr("src", "designLayer/images/layout_outline2.gif");		
			setStyleOptions();
		});
		
		if($("#security").prop('checked') === true) $("#note").hide()
		
		// disabled system in security panel
		$('[data-disable-controller]').each(function(){
			var controllerId = $(this).data("disableController");
			var element = $(this);
			//intial value
			$(this).prop("disabled", !($("#" + controllerId).prop('checked') === true));
			//disable and clear text
			$("#" + controllerId).click(function(){
				element.prop("disabled", !($(this).prop('checked') == true));
				if($(this).prop('checked') !== true ) element.val("");
				if(controllerId =="security")
				{
					if($("#security").prop('checked') == true ) $("#note").hide();				   
					else
					{
						$("#sec_table").val('NoValue');
						$("#sec_Username_Field").val('NoValue');
						$("#sec_pass_Field").val('NoValue');

						$("#sec_table").prop("disabled", true);
						$("#sec_Username_Field").prop("disabled", true);
						$("#sec_pass_Field").prop("disabled", true);
						
						$("#sec_email").prop("disabled", true);
						$("#note").show();
					}
				}
			});
		});
		
		$("#sec_table").bind("change",function()
		{
			var tableName = $(this).val();
			var columns = secTablesInfo[tableName];
			$("#sec_Username_Field").empty();
			$("#sec_pass_Field").empty();
			$("#sec_Username_Field").append("<option selected  value='NoValue'> Please select a value </option>");
			$("#sec_pass_Field").append("<option selected  value='NoValue'> Please select a value </option>");
			
			for (var i = 0; i < columns.length; i++) {
				$("#sec_Username_Field").append("<option value='"+columns[i]+"''>"+ columns[i] +"</option>");
				$("#sec_pass_Field").append("<option value='"+columns[i]+"''>"+ columns[i] +"</option>");
				
			};
		});
		
		// -------------------------------------------------------------------------------------------
		
		$("#btn_cont").mousedown(function(){
			var chosenLayout = $( "input[name=option]:radio:checked" ).val();
			var chosenStyle = $( "#style_name" ).val();
			var secValues = $("#secForm").serialize();
			var titlesValues = $("#titlesForm").serialize();
			$.ajax({
				url: "server/step_6.php",
				type: "post",
				data: "layout="+chosenLayout+"&style_name="+chosenStyle+"&"+secValues+"&"+titlesValues,
				success: function(data){
					$("#error-container").empty();
					$("#layout-error-container").empty();
					$("#titles-error-container").empty();
					if(data === "success"){
						location.assign("engine/common.php");
						SwitchStatusDone();
					}else{
						modifier = data.substring(0, 6);
						data = data.substring(6, data.length);
						if(modifier === "<1stT>"){
							$("#layout-nav").trigger("click");
							$("#layout-error-container").append("<div class='alert alert-danger'>"+data+"</div>");
						}else if(modifier === "<3stT>"){
							$("#titles-nav").trigger("click");
							$("#titles-error-container").append("<div class='alert alert-danger'>"+data+"</div>");
						}else{
							$("#security-nav").trigger("click");
							$("#error-container").append("<div class='alert alert-danger'>"+data+"</div>");
						}
						SwitchStatusError();
					}
				},
				error: function(){alertify.error("error");}
			});
		});
		
		$("#btn_back").mousedown(function(){
			backToPage("3");
		});
		
		
		$('input[name=option]').change(function(){
			if($(this).val() === 'Mobile')
			{
				$('#security').prop('checked', false);
				$('#security').prop('disabled', true);
				$('#members').prop('checked', false);
				$('#members').prop('disabled', true);
				$('#Forget_password').prop('checked', false);
				$('#Forget_password').prop('disabled', true);
				$('#sec_Username').prop('disabled', true);
				$('#sec_pass').prop('disabled', true);				
				$('#error-container').append("<div class='alert alert-danger'>- Security Options, Forget password and Members login are not supported for the mobile layout.</div>");
			}else{
				$('#security').prop('checked', true);
				$('#security').prop('disabled', false);
				$('#members').prop('checked', false);
				$('#members').prop('disabled', false);
				$('#Forget_password').prop('checked', false);
				$('#Forget_password').prop('disabled', false);
				$('#sec_Username').prop('disabled', false);
				$('#sec_pass').prop('disabled', false);	
				$('#error-container').empty();
			}
		});
		
		
                
	});
	
	function setStyleOptions()
	{
		var isSelected = "";
		$("#style_name").empty();
		for(var i = 0; i < stylesExceptMobile.length; i++) 
		{
			if(i === 2) isSelected = "selected";
			else isSelected = "";
			$("#style_name").append("<option value='"+stylesExceptMobile[i]+"'"+isSelected+">"+stylesExceptMobile[i]+"</option>");
		}
	}
	

</script>