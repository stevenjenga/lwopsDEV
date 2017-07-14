<?php
define("DIRECTACESS", "true");
	require_once('../shared/shared.php');
	$login->headerTo(false, "login.php?from=setconfig");
	require_once '../tables/common/bll/Mobile_Detect.php';
	require_once '../tables/common/bll/helpers/DatabaseHandler.php'; 
	require_once '../shared/engine.php';
	$detect = new Mobile_Detect;
?>
<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<title>Pivot Table</title>
          <meta name="robots" content="noindex, nofollow">
        <meta name="googlebot" content="noindex" />
	
	<link type='text/css' rel='stylesheet' href='../tables/common/bootstrap/css/bootstrap.min.css' />
	<link rel="stylesheet" href="../tables/common/alertify/themes/alertify.default.css" />
	<link rel="stylesheet" href="../tables/common/alertify/themes/alertify.core.css" />
	<!--<link href="../tables/common/style.css" rel="stylesheet" type="text/css" />-->
	<link href="../tables/common/css/custom-theme/jquery-ui-1.10.3.custom.css" rel="stylesheet">
	<link href="../shared/resources/css/wizard_main.css" rel="stylesheet" />
	
	<script src="../tables/common/js/jquery-1.9.1.js"></script>
	<script src="../tables/common/js/jquery-ui-1.10.3.custom.js"></script>
	<script>
		$(function() {
			$( "#parentTabs" ).tabs();
			$( "#tabs" ).tabs();
			$( "#Xtabs" ).tabs();
		});
	</script>

	</head>
	<body>
		<?php $navbar->print_navbar(); ?>
		
		<?php if(file_exists("signup.php")): ?>
		<div style="padding: 0px; margin:0px; position: relative;top: 5px;width: 100%;z-index: 1000;">
			<div class="col-xs-12">
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<p><strong>Note: </strong>Please delete sign up page <strong>( which is located at: <?php echo realpath("signup.php") ?> )</strong> for security reason.</p>
				</div>
			</div>
		</div>
		<?php endif; ?>

		<div class="container" style="margin-top: 55px;">
			<ul class="nav nav-tabs" style="margin: 10px 0px 1px 0px;font-size: 16px;">
				<li class="active"><a id="tableSettingBtn" href="#"><span class="glyphicon glyphicon-cog"></span> Manage tables</a></li>
				<li><a id="userSettingBtn" href="#"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
			</ul>
			
			<div id="tableSetting" class="create-pivot">
				<div id="tabs">
					<ul>
					<?php if (!$detect->isMobile()) { ?>
						<li><a href="#tabs-1" style="outline: none;"><span class="glyphicon glyphicon-link"></span> DB Connection</a></li>
						<li><a id="tabs-control-2" href="#tabs-2" style="outline: none;"><span class="glyphicon glyphicon-plus"></span> Create new table</a></li>
						<!-- <li><a href="#tabs-3" style="outline: none;"><span class="glyphicon glyphicon-refresh"></span> Generate table</a></li>-->
						<li><a href="#tabs-4" style="outline: none;"><span class="glyphicon glyphicon-list-alt"></span> Existing tables</a></li>
					<?php }else{ ?>
						<li><a href="#tabs-1" style="outline: none;"><span class="glyphicon glyphicon-link"></span></a></li>
						<li><a href="#tabs-2" style="outline: none;"><span class="glyphicon glyphicon-plus"></span></a></li>
						<!--<li><a href="#tabs-3" style="outline: none;"><span class="glyphicon glyphicon-refresh"></span></a></li>-->
						<li><a href="#tabs-4" style="outline: none;"><span class="glyphicon glyphicon-list-alt"></span></a></li>
					<?php } ?>
					</ul>
				
					<div id="tabs-1">
						<?php
							if(isset($_SESSION['PT_temp_dbConnected']) && $_SESSION['PT_temp_dbConnected'] = 'pt_con_verify')
							{
								echo '
								<div id="confirmationMsg" class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 10px 10px 0px 10px; margin-bottom:10px;">
									<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
									<strong>Status:</strong> Connected</p>
								</div>';
							}else{
								echo '
								<div id="confirmationMsg" class="ui-state-error ui-corner-all" style="margin-top: 20px; padding: 10px 10px 0px 10px; margin-bottom:10px;">
									<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
									<strong>Alert:</strong> Please create database Connection before making table setting.</p>
								</div>';
							}
						?>						
						
						<form class="form-horizontal" onsubmit="return false;">
						
							<div class="row">
								<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 form-group">
									<label class="control-label col-lg-4 col-md-4 col-sm-4 col-xs-12 lbl-bold" for="dbHost">Host name / IP</label>
									<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
										<input id='dbHost' class="form-control" type="text" value="<?php if(isset($_SESSION['pt_str_host'])){ echo $_SESSION['pt_str_host'];}else{ echo 'localhost';} ?>" placeholder="Enter Your Host Name"/>
									</div>
								</div>
								<div class="col-lg-6 col-md-4 col-sm-4 hidden-xs">
									<span id='dbHostPopover' data-container="body" data-toggle="popover" data-placement="right" class="glyphicon glyphicon-question-sign"></span>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 form-group">
									<label class="control-label col-lg-4 col-md-4 col-sm-4 col-xs-12 lbl-bold" for="dbUser">User</label>
									<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
										<input id='dbUser' class="form-control" value="<?php if(isset($_SESSION['pt_str_user'])) echo $_SESSION['pt_str_user']; ?>" type="text" placeholder="Database Username Here" />
									</div>
								</div>
								<div class="col-lg-6 col-md-4 col-sm-4 hidden-xs"></div>
							</div>
							
							<div class="row">
								<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 form-group">
									<label class="control-label col-lg-4 col-md-4 col-sm-4 col-xs-12 lbl-bold" for="dbPass">Password</label>
									<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
										<input id='dbPass' class="form-control" type="password" placeholder="Enter Your Database Password" />
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
							</div>
							
							<div class="row">
								<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 form-group">
									<label class="control-label col-lg-4 col-md-4 col-sm-4 col-xs-12 lbl-bold"  for="dbName">Database</label>
									<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
										<input id='dbName' class="form-control" value="<?php if(isset($_SESSION['pt_str_db'])) echo $_SESSION['pt_str_db']; ?>"  type="text" placeholder="Database Name Here" />
									</div>
								</div>
								<div class="col-lg-6 col-md-4 col-sm-4 hidden-xs"></div>
							</div>
							
						</form>
						
						<div style="text-align:center;padding:10px;">
							<button <?php if(isset($_SESSION['PT_temp_dbConnected']) && $_SESSION['PT_temp_dbConnected'] = 'pt_con_verify') echo "style='display: none;'"; ?> id="confirmConnectionBtn" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
								<span class="ui-button-text">Connect</span>
							</button>
							
							<button id="disconnectBtn" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
								<span class="ui-button-text">Disconnect</span>
							</button>
						</div><!-- -->
						
					</div><!-- #tab-1 -->
			
			
					<div id="tabs-2">

						<?php if (!$detect->isMobile()) { ?>
						<div class="row">
						<div class="col-xs-12" style="text-align: right;">
							<span style="color: #99CCFF;cursor: pointer;" id='generalHelp'>
								<span style="text-decoration: underline;">Example</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-question-sign"></span>
							</span>
						</div>
						</div>
						<?php } ?>
						<div id="connectionStatus">
						<?php
							if(isset($_SESSION['PT_temp_dbConnected']) && $_SESSION['PT_temp_dbConnected'] = 'pt_con_verify')
							{
								echo '
								<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 10px 10px 0px 10px; margin-bottom:10px;">
									<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
									<strong>Status:</strong> Connected</p>
								</div>';
							}else{
								echo '
								<div class="ui-state-error ui-corner-all" style="margin-top: 20px; padding: 10px 10px 0px 10px; margin-bottom:10px;">
									<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
									<strong>Alert:</strong> Please create database Connection before making this step.</p>
								</div>';
							}
						?>
						</div>
						<form onsubmit="return false;" class="form-horizontal">
						<div class="panel-group" id="accordion">
						
						<div class="panel panel-default">
							<div class="panel-heading">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									<h4 class="panel-title"><!--Initial-->General Settings</h4>
								</a>
							</div>
							<div id="collapseOne" class="panel-collapse collapse in">
							<div class="panel-body">
						
							<div class="row">
								<div class="col-lg-6 col-md-9 col-sm-10 col-xs-12 form-group">
									<label class="control-label col-lg-5 col-md-5 col-sm-6 col-xs-12 lbl-bold"  for="tableName">
										<span style='color: red;font-size: 16px;'>* </span>Title
									</label>
									<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
										<input id='tableName' class="form-control" type="text" />
									</div>
									
								</div>
								<div class="col-lg-6 col-md-3 col-sm-2 hidden-xs">
									<span id='tableNamePop' data-container="body" data-toggle="popover" data-placement="right" class="glyphicon glyphicon-question-sign"></span>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-6 col-md-9 col-sm-10 col-xs-12 form-group">
									<label class="control-label col-lg-5 col-md-5 col-sm-6 col-xs-12 lbl-bold"  for="protected">
										<span style='color: red;font-size: 16px;'>* </span>Protected
									</label>
									<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
										<select id='protected' class="form-control">
											<option value='true' selected>True</option>
											<option value='false'>False</option>
										</select>
									</div>
									
								</div>
								<div class="col-lg-6 col-md-3 col-sm-2 hidden-xs">
									<span id='protectedPop' data-container="body" data-toggle="popover" data-placement="right" class="glyphicon glyphicon-question-sign"></span>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-6 col-md-9 col-sm-10 col-xs-12 form-group">
									<label class="control-label col-lg-5 col-md-5 col-sm-6 col-xs-12 lbl-bold"  for="isNumeric">
										<span style='color: red;font-size: 16px;'>* </span>Is numeric
									</label>
									<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
										<select id='isNumeric' class="form-control">
											<option value='true' selected>True</option>
											<option value='false'>False</option>
										</select>
									</div>
									
								</div>
								<div class="col-lg-6 col-md-3 col-sm-2 hidden-xs">
									<span id='isNumericPop' data-container="body" data-toggle="popover" data-placement="right" class="glyphicon glyphicon-question-sign"></span>
								</div>
							</div>
							
							</div>
							</div>
							</div>

							<div class="panel panel-default">
							<div class="panel-heading">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
									<h4 class="panel-title">Column Labels</h4>
								</a>
							</div>
							<div id="collapseTwo" class="panel-collapse collapse">
							<div class="panel-body">
							
							
							<div class="row">
								<div class="col-lg-6 col-md-9 col-sm-10 col-xs-12 form-group">
									<label class="control-label col-lg-5 col-md-5 col-sm-6 col-xs-12 lbl-bold"  for="colsTable">
										<span style='color: red;font-size: 16px;'>* </span>Table
									</label>
									<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
										<select id='colsTable' class="form-control">
											<option value="" selected></option>
										</select>
									</div>
									
								</div>
								<div class="col-lg-6 col-md-3 col-sm-2 hidden-xs">
									<span id='colsTablePop' data-container="body" data-toggle="popover" data-placement="right" class="glyphicon glyphicon-question-sign"></span>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-6 col-md-9 col-sm-10 col-xs-12 form-group">
									<label class="control-label col-lg-5 col-md-5 col-sm-6 col-xs-12 lbl-bold"  for="colsField">
										<span style='color: red;font-size: 16px;'>* </span>Field
									</label>
									<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
										<select id='colsField' class="form-control">
											<option value="" selected></option>
										</select>
									</div>
									
								</div>
								<div class="col-lg-6 col-md-3 col-sm-2 hidden-xs">
									<span id='colsFieldPop' data-container="body" data-toggle="popover" data-placement="right" class="glyphicon glyphicon-question-sign"></span>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-6 col-md-9 col-sm-10 col-xs-12 form-group">
									<label class="control-label col-lg-5 col-md-5 col-sm-6 col-xs-12 lbl-bold"  for="colsAlias">
										Alias
									</label>
									<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
										<input id='colsAlias' class="form-control" type="text" />
									</div>
									
								</div>
								<div class="col-lg-6 col-md-3 col-sm-2 hidden-xs">
									<span id='colsAliasPop' data-container="body" data-toggle="popover" data-placement="right" class="glyphicon glyphicon-question-sign"></span>
								</div>
							</div>
							
							<div class="row" id="colsFuncRow" style="display: none;">
								<div class="col-lg-6 col-md-9 col-sm-10 col-xs-12 form-group">
									<label class="control-label col-lg-5 col-md-5 col-sm-6 col-xs-12 lbl-bold"  for="colsFunc">
										Function
									</label>
									<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
										<select id='colsFunc' class="form-control">
											<option value="" selected></option>
											<option value="year">Year</option>
											<option value="month">Month</option>
										</select>
									</div>
									
								</div>
								<div class="col-lg-6 col-md-3 col-sm-2 hidden-xs">
									<span id='colsFuncPop' data-container="body" data-toggle="popover" data-placement="right" class="glyphicon glyphicon-question-sign"></span>
								</div>
							</div>
							
							</div>
							</div>
							</div>
							<div class="panel panel-default">
							<div class="panel-heading">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
									<h4 class="panel-title">Row Labels</h4>
								</a>
							</div>
							<div id="collapseThree" class="panel-collapse collapse">
							<div class="panel-body">
							
							<div class="row">
								<div class="col-lg-6 col-md-9 col-sm-10 col-xs-12 form-group">
									<label class="control-label col-lg-5 col-md-5 col-sm-6 col-xs-12 lbl-bold"  for="rowsTable">
										<span style='color: red;font-size: 16px;'>* </span>Table
									</label>
									<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
										<select id='rowsTable' class="form-control">
											<option value="" selected></option>
										</select>
									</div>
									
								</div>
								<div class="col-lg-6 col-md-3 col-sm-2 hidden-xs">
									<span id='rowsTablePop' data-container="body" data-toggle="popover" data-placement="right" class="glyphicon glyphicon-question-sign"></span>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-6 col-md-9 col-sm-10 col-xs-12 form-group">
									<label class="control-label col-lg-5 col-md-5 col-sm-6 col-xs-12 lbl-bold"  for="rowsField">
										<span style='color: red;font-size: 16px;'>* </span>Field
									</label>
									<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
										<select id='rowsField' class="form-control">
											<option value="" selected></option>
										</select>
									</div>
									
								</div>
								<div class="col-lg-6 col-md-3 col-sm-2 hidden-xs">
									<span id='rowFieldPop' data-container="body" data-toggle="popover" data-placement="right" class="glyphicon glyphicon-question-sign"></span>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-6 col-md-9 col-sm-10 col-xs-12 form-group">
									<label class="control-label col-lg-5 col-md-5 col-sm-6 col-xs-12 lbl-bold"  for="rowsAlias">
										Alias
									</label>
									<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
										<input id='rowsAlias'class="form-control" type="text" />
									</div>
									
								</div>
								<div class="col-lg-6 col-md-3 col-sm-2 hidden-xs">
									<span id='rowsAliasPop' data-container="body" data-toggle="popover" data-placement="right" class="glyphicon glyphicon-question-sign"></span>
								</div>
							</div>
							
							</div>
							</div>
							</div>
							<div class="panel panel-default">
							<div class="panel-heading">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
									<h4 class="panel-title">Values</h4>
								</a>
							</div>
							<div id="collapseFour" class="panel-collapse collapse">
							<div class="panel-body">
							
							<div class="row">
								<div class="col-lg-6 col-md-9 col-sm-10 col-xs-12 form-group">
									<label class="control-label col-lg-5 col-md-5 col-sm-6 col-xs-12 lbl-bold"  for="gridTable">
										<span style='color: red;font-size: 16px;'>* </span>Table
									</label>
									<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
										<select id='gridTable' class="form-control">
											<option value="" selected></option>
										</select>
									</div>
									
								</div>
								<div class="col-lg-6 col-md-3 col-sm-2 hidden-xs">
									<span id='gridTablePop' data-container="body" data-toggle="popover" data-placement="right" class="glyphicon glyphicon-question-sign"></span>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-6 col-md-9 col-sm-10 col-xs-12 form-group">
									<label class="control-label col-lg-5 col-md-5 col-sm-6 col-xs-12 lbl-bold"  for="gridField">
										<span style='color: red;font-size: 16px;'>* </span>Field
									</label>
									<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
										<select id='gridField' class="form-control">
											<option value="" selected></option>
										</select>
									</div>
									
								</div>
								<div class="col-lg-6 col-md-3 col-sm-2 hidden-xs">
									<span id='gridFieldPop' data-container="body" data-toggle="popover" data-placement="right" class="glyphicon glyphicon-question-sign"></span>
								</div>
							</div>							
							
							<div class="row" id="gridFunc-row">
								<div class="col-lg-6 col-md-9 col-sm-10 col-xs-12 form-group">
									<label class="control-label col-lg-5 col-md-5 col-sm-6 col-xs-12 lbl-bold"  for="gridFunc">
										Function
									</label>
									<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
										<select id='gridFunc' class="form-control">
											<option value='' selected></option>
											<option value='sum'>Sum</option>
											<option value='count'>Count</option>
											<option value='avg'>Average</option>
											<option value='min'>Minimum</option>
											<option value='max'>Maximum</option>
										</select>
									</div>
									
								</div>
								<div class="col-lg-6 col-md-3 col-sm-2 hidden-xs">
									<span id='gridFuncPop' data-container="body" data-toggle="popover" data-placement="right" class="glyphicon glyphicon-question-sign"></span>
								</div>
							</div>
							
							</div>
							</div>
							</div>
							<div class="panel panel-default" id="rel-panel" style="display: none;">
							<div class="panel-heading">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
									<h4 class="panel-title">Relationships</h4>
								</a>
							</div>
							<div id="collapseFive" class="panel-collapse collapse">
							<div class="panel-body">
							
							<div class="row">
								<div class="row">
									<div class="col-xs-4"></div>
									<div class="col-xs-4"></div>
									<div class="col-xs-4">
										<span id='relsHelp' style="float: right;" data-container="body" data-toggle="popover" data-placement="bottom" class="glyphicon glyphicon-question-sign"></span>
									</div>
								</div>
								<div class="row" style="margin: 0px 5px;">
									<div class="col-md-1"></div>
									<div class="col-md-5 form-group">
										<label class="control-label col-md-5 lbl-bold"  for="relLeftTable">
											Left table
										</label>
										<div class="col-md-7">
											<select id='relLeftTable' class="form-control">
												<option value='' selected></option>
											</select>
										</div>
									</div>
									<div class="col-md-5 form-group">
										<label class="control-label col-md-5 lbl-bold"  for="relRightTable">
											Right table
										</label>
										<div class="col-md-7">
											<select id='relRightTable' class="form-control">
												<option value='' selected></option>
											</select>
										</div>
									</div>
									<div class="col-md-1"></div>
								</div>
								<div class="row" style="margin: 0px 5px;">
									<div class="col-md-1"></div>
									<div class="col-md-5 form-group">
										<label class="control-label col-md-5 lbl-bold"  for="relLeftField">
											Left field
										</label>
										<div class="col-md-7">
											<select id='relLeftField' class="form-control">
												<option value='' selected></option>
											</select>
										</div>
									</div>
									<div class="col-md-5 form-group">
										<label class="control-label col-md-5 lbl-bold"  for="relRightField">
											Right field
										</label>
										<div class="col-md-7">
											<select id='relRightField' class="form-control">
												<option value='' selected></option>
											</select>
										</div>
									</div>
									<div class="col-md-1"></div>
								</div>
								
								<div class="row" style="margin: 0px 5px;">
									<div class="col-md-3"></div>
									<div class="col-md-6" style="text-align: center;">
										<button style="margin: 5px 0px;" id="addRel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
											<span class="ui-button-text">Add relationship</span>
										</button>
											
										<button id="removeRel" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
											<span class="ui-button-text">Remove relationship</span>
										</button>
									</div>
									<div class="col-md-3"></div>
								</div>
								
								<div class="row" style="margin: 10px 0px;">
									<div class="col-md-1"></div>
									<div class="col-md-10">
										<select id='relContainer' multiple class='form-control' style='height: 90px;overflow-y: scroll;resize: none;padding: 2px;text-align: left;' ></select>
									</div>
									<div class="col-md-1"></div>
								</div>
								
							</div>
							
							</div>
							</div>
							</div>
							<div class="panel panel-default">
							<div class="panel-heading">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
									<h4 class="panel-title">Pagination</h4>
								</a>
							</div>
							<div id="collapseSix" class="panel-collapse collapse">
							<div class="panel-body">
							
							<div class="row">
								<div class="col-lg-6 col-md-9 col-sm-10 col-xs-12 form-group">
									<label class="control-label col-lg-6 col-md-6 col-sm-6 col-xs-12 lbl-bold"  for="allowRowsPagination">
										<span style='color: red;font-size: 16px;'>* </span>Allow rows pagination
									</label>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<select id='allowRowsPagination' class="form-control">
											<option value='true'>True</option>
											<option value='false' selected>False</option>
										</select>
									</div>
									
								</div>
								<div class="col-lg-6 col-md-3 col-sm-2 hidden-xs">
									<span id='arpPop' data-container="body" data-toggle="popover" data-placement="right" class="glyphicon glyphicon-question-sign"></span>
								</div>
							</div>
							
							<div class="row" id="recordPerPageContainer" style="display: none;">
								<div class="col-lg-6 col-md-9 col-sm-10 col-xs-12 form-group">
									<label class="control-label col-lg-6 col-md-6 col-sm-6 col-xs-12 lbl-bold"  for="recordPerPage">
										<span style='color: red;font-size: 16px;'>* </span>Record per page
									</label>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<input id='recordPerPage' class="form-control" type="text" />
									</div>
									
								</div>
								<div class="col-lg-6 col-md-3 col-sm-2 hidden-xs">
									<span id='rppPop' data-container="body" data-toggle="popover" data-placement="right" class="glyphicon glyphicon-question-sign"></span>
								</div>
							</div>
							<!--
							<div class="row">
								<div class="col-xs-6 form-group">
									<label class="control-label col-xs-6 lbl-bold"  for="maxRecordsPerPage">
										Max records per page
									</label>
									<div class="col-xs-6">
										<input id='maxRecordsPerPage' class="form-control" type="text" value="1000" disabled />
									</div>
									
								</div>
								<div class="col-xs-6">
									<span id='mrppPop' data-container="body" data-toggle="popover" data-placement="right" class="glyphicon glyphicon-question-sign"></span>
								</div>
							</div>
							-->
							
							<div class="row">
								<div class="col-lg-6 col-md-9 col-sm-10 col-xs-12 form-group">
									<label class="control-label col-lg-6 col-md-6 col-sm-6 col-xs-12 lbl-bold"  for="allowColsPagination">
										<span style='color: red;font-size: 16px;'>* </span>Allow columns pagination
									</label>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<select id='allowColsPagination' class="form-control">
											<option value='true'>True</option>
											<option value='false' selected>False</option>
										</select>
									</div>
									
								</div>
								<div class="col-lg-6 col-md-3 col-sm-2 hidden-xs">
									<span id='acpPop' data-container="body" data-toggle="popover" data-placement="right" class="glyphicon glyphicon-question-sign"></span>
								</div>
							</div>
							
							<div class="row" id="colPerPageContainer" style="display: none;">
								<div class="col-lg-6 col-md-9 col-sm-10 col-xs-12 form-group">
									<label class="control-label col-lg-6 col-md-6 col-sm-6 col-xs-12 lbl-bold"  for="colPerPage">
										<span style='color: red;font-size: 16px;'>* </span>Columns per page
									</label>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<input id='colPerPage' class="form-control" type="text" />
									</div>
									
								</div>
								<div class="col-lg-6 col-md-3 col-sm-2 hidden-xs">
									<span id='cppPop' data-container="body" data-toggle="popover" data-placement="right" class="glyphicon glyphicon-question-sign"></span>
								</div>
							</div>
							<!--
							<div class="row">
								<div class="col-xs-6 form-group">
									<label class="control-label col-xs-6 lbl-bold"  for="maxCols">
										Max columns at all
									</label>
									<div class="col-xs-6">
										<input id='maxCols' class="form-control" type="text" value="100" disabled />
									</div>
									
								</div>
								<div class="col-xs-6">
									<span id='mcPop' data-container="body" data-toggle="popover" data-placement="right" class="glyphicon glyphicon-question-sign"></span>
								</div>
							</div>
							-->
							</div>
							</div>
							</div>
							
						</div>
						</form>
						
						<div style="text-align:center;padding:10px;">
							<button id='confirmSettingBtn' class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
								<span class="ui-button-text">Generate</span>
							</button>
						</div>
						
					</div><!-- #tab-2 -->
					
					<!--
					<div id="tabs-3">
						<h5 class="text-primary">Click Generate or press <kbd>Enter</kbd> to create table and display it.</h5>
						<div style="text-align:center;padding:10px;">
							<button id="generateBtn" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
								<span class="ui-button-text" id="generate-table-btn">Generate</span>
							</button>
						</div>
					</div><!-- #tabs-3 -->
					
					<div id="tabs-4">
						<div class="row">
						<div class="col-xs-1"></div>
						<div class="col-xs-10">
						<table class="table" style='letter-spacing: 2px;'>
						<tr>
							<th>Table name</th>
							<th>View</th>
							<?php if(!$detect->isMobile()) { ?><th>Delete</th><?php } ?>
						</tr>
						<?php
							$objects = scandir('../tables');
							if(is_array($objects))
							{
								$tdNum = 0;
								foreach ($objects as $key => $entry) {
									if($entry !== 'common' && $entry !== '.' && $entry !== '..' && $entry !== ' ')
									{	
										if(filetype("../tables/$entry") === 'dir' && !$detect->isMobile())
										{
											echo "<tr id='td-".$tdNum."'>
													<td style='width: 50%;font-size: 14px;font-weight: 900;'>".preg_replace('/_/', ' ', $entry)."</td>
													<td style='width: 25%;'><a href='../tables/$entry' class='btn btn-success btn-block'><span class='glyphicon glyphicon-file'></span> View</a></td>
													<td style='width: 25%;'><a href='#' onmousedown='rm_table(\"$entry\", \"#td-".$tdNum."\")' class='btn btn-warning btn-block'><span class='glyphicon glyphicon-trash'></span> Delete</a></td>
												</tr>";
											
											$tdNum++;
										}else if(filetype("../tables/$entry") === 'dir' && $detect->isMobile()){
											echo "<tr id='td-".$tdNum."'>
													<td style='width: 55%;font-size: 14px;font-weight: 900;'>".preg_replace('/_/', ' ', $entry)."</td>
													<td style='width: 45%;'><a href='../tables/$entry' class='btn btn-success btn-block'><span class='glyphicon glyphicon-file'></span> View</a></td>
												</tr>";
										}
									}
								}
							}
						?>
						</table>
						</div>
						<div class="col-xs-1"></div>
						</div>
					</div>
				</div><!-- .tabs -->
			</div><!-- .create-pivot -->
			<div id="userSetting" style="display:none;">
				<div id="Xtabs">
					<ul>
						<li><a href="#Xtabs-1"><span class="glyphicon glyphicon-lock"></span> Security Setting</a></li>
					</ul>
				
					<div id="Xtabs-1">
						<ul class="nav nav-pills nav-stacked">
							<li><a href='changepass.php' target="_blank">Change your password</a></li>
							<li><a href='changemail.php' target="_blank">Change your email</a></li>
						</ul>
						
					</div><!-- #tab-1 -->
				</div><!-- .tabs -->
			</div><!-- .create-pivot -->
			<!--</div>-->
		</div><!-- .container -->
		
		<div class="helper-option">
			<div class="shadow"></div>
			<div class="helper-container">
				<button class="close helper-close" aria-hidden="true">&times;</button>
				<div id="helperHeader"><h3>Note - <small>Pivot table elements and structure!</small></h3></div>
			</div>
		</div>
		<?php if (!$detect->isMobile()) { ?>
		<div class="loading-option">
			<div class="shadowX"></div>
			<div class="loading-container">
				<img src="helper_img/loading.gif" style="width: 127;height: 88;margin-left: auto;" id="helperImg" alt="loading"/>
			</div>
		</div>
		<?php } ?>
		<script src='../tables/common/bootstrap/js/bootstrap.min.js'></script>
		<script src="../tables/common/alertify/lib/alertify.min.js"></script>
		<script src="help_msg.js"></script>
		<script>
			function prepare_name(name)
			{
				name = name.trim();
				var preparedName = name;
				if(name.charAt(0) !== '`') preparedName = '`' + name;
				if(name[name.length-1] !== '`') preparedName += '`';
				return preparedName;
			}
			var relLineNum = 0;
			$(document).ready(function(){
				
				help_msg('setconfig');
				
				
				$('.loading-option').show();
				$('.shadowX').mousedown(function(){ alertify.log('wait for loading ...'); });
				$("body").css("overflow", "hidden");
								
				$.post("tablesandcolsinfo.php", function(json){
					if(json != '')
					{
						append_columns_name('colsTable', json);
						append_fields_name('colsTable', 'colsField', json);
											
						append_columns_name('rowsTable', json);
						append_fields_name('rowsTable', 'rowsField', json);
											
						append_columns_name('gridTable', json);
						append_fields_name('gridTable', 'gridField', json);
											
						append_columns_name('relLeftTable', json);
						append_fields_name('relLeftTable', 'relLeftField', json);
											
						append_columns_name('relRightTable', json);
						append_fields_name('relRightTable', 'relRightField', json);
						
						$('.loading-option').hide();
						$("body").css("overflow", "auto");
					}else{
						alert('1');
						$('.loading-option').hide();
						$("body").css("overflow", "auto");
					}
				}, "json").fail(function() { $('.loading-option').hide();$("body").css("overflow", "auto"); });
				
				
				$("#colsTable").change(function(){
					mk_relationships();
				});
				$("#rowsTable").change(function(){
					mk_relationships();
				});
				$("#gridTable").change(function(){
					mk_relationships();
				});
				
				$('#isNumeric').change(function(){
					if($(this).val() === 'true') $('#gridFunc-row').show();
					else $('#gridFunc-row').hide();
				});
				
				//allowColsPagination colPerPageContainer
				$("#allowColsPagination").change(function(){
					if($(this).val() === 'true') $('#colPerPageContainer').show();
					else $('#colPerPageContainer').hide();
				});
				//recordPerPageContainer allowRowsPagination
				$("#allowRowsPagination").change(function(){
					if($(this).val() === 'true') $('#recordPerPageContainer').show();
					else $('#recordPerPageContainer').hide();
				});
			
				$('#tableSettingBtn').mousedown(function(){
					$('#userSettingBtn').parent().removeClass('active');
					$('#tableSettingBtn').parent().addClass('active');
					
					$('#tableSetting').show();
					$('#userSetting').hide();
				});
				
				$('#userSettingBtn').mousedown(function(){
					$('#tableSettingBtn').parent().removeClass('active');
					$('#userSettingBtn').parent().addClass('active');
					$('#userSetting').show();
					$('#tableSetting').hide();
				});

				// generalHelp
				$('#generalHelp').click(function(){
					$('.helper-option').show();
					$('.close').show();
					$('#helperHeader').show();
					$('.helper-container').css('text-align', 'left');
					$('.helper-container').append('<img id="helperImg" class="img-thumbnail" src="helper_img/tb.gif" alt="help info" />');
					$("body").css("overflow", "hidden");
				});
				
				$('.close').mousedown(function(){
					$('.helper-option').hide();
					$('#helperImg').remove();
					$("body").css("overflow", "auto");
				});
				$('.shadow').mousedown(function(){
					$('.helper-option').hide();					
					$('#helperImg').remove();
					$("body").css("overflow", "auto");
				});
				
				
				
				$("#addRel").mousedown(function(){
					// check is everything required set before add new relation
					
					var left_table = $('#relLeftTable').val(); 
					var right_table = $('#relRightTable').val(); 		 
					var left_field = $('#relLeftField').val(); 		 
					var right_field = $('#relRightField').val(); 		 		 		 

					if(("`"+left_table+"`.`"+left_field+"`") === ("`"+right_table+"`.`"+right_field+"`"))
					{
						alertify.error('Not valid relationship!');
						return;
					}else if(left_table !== '' && left_field !== '' && right_table !== '' && right_table !== '')
					{
					
						var newRels =  "`"+left_table+"`.`"+left_field+"` = `"+right_table+"`.`"+right_field+"`";
						
						var relationships = new Array();
						var count = 0;
						$("#relContainer option").each(function()
						{
							relationships[count] = $(this).text();
						});
						
						//check if this relation exists
						if(relationships !== null && relationships !== "" && $.isArray(relationships))
						{
							for (i = 0; i < relationships.length; i++)
							{
								if(relationships[i].trim() === newRels)
								{
									alertify.error('Relation could not be duplicated!');
									return;
								}
							}
						}
					
						var newOption = "<option value='"+prepare_name(left_table)+"."+prepare_name(left_field)+" = "+prepare_name(right_table)+"."+prepare_name(right_field)+"'>"+prepare_name(left_table)+"."+prepare_name(left_field)+" = "+prepare_name(right_table)+"."+prepare_name(right_field)+"</option>";
						$("#relContainer").append(newOption);
					}else{
					
						alertify.error('Fill out relationship fields!');
					}
				});
				
				$("#removeRel").mousedown(function(){
					$("#relContainer option:selected").remove();
				});					
				
				$('#colsField').change(function(){
					is_column_date();
				});
				
				$('#disconnectBtn').mousedown(function(){
					$.ajax({
						url: 'setconfig.php',
						type: 'POST',
						data: 'connection='+false,
						success: function(data){
							if(data === 'error_in_disconnect'){
								alertify.error('Can\'t make disconnect');
							}
							else if(data === 'success_in_disconnect'){
								alertify.success('Disconnect success');
								
								$('#connectionStatus').empty();
								$('#connectionStatus').append('<div class="ui-state-error ui-corner-all" style="margin-top: 20px; padding: 10px 10px 0px 10px; margin-bottom:10px;">'+
									'<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>'+
									'<strong>Alert:</strong> Please create database Connection before making this step.</p>'+
								'</div>');
								
								$('#confirmationMsg').remove();
								$('#tabs-1').prepend('<div id="confirmationMsg" class="ui-state-error ui-corner-all" style="margin-top: 20px; padding: 10px 10px 0px 10px; margin-bottom:10px;">'+
									'<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>'+
									'<strong>Alert:</strong> Please create database Connection before making table setting.</p>'+
								'</div>');
								
								$("#confirmConnectionBtn").css('display', 'inline-block');
							}
						},
						error: function(){
							alert('error :> disconnect btn');
						}
					});
				
				});
			
			
				$('#confirmConnectionBtn').mousedown(function(){
				
					var dbName = $('#dbName').val();
					var dbUser = $('#dbUser').val();
					var dbPass = $('#dbPass').val();
					var dbHost = $('#dbHost').val();
					
					if(dbHost === '') dbHost = 'localhost';
					
					if(dbName !== '' && dbUser !== '' && dbHost !== '')
					{
						$.ajax({
							url: 'setconfig.php',
							type: 'POST',
							data: 'dbName='+dbName+'&dbUser='+dbUser+'&dbPass='+dbPass+'&dbHost='+dbHost,
							success: function(data)
							{
								if(data === 'empty_data') alertify.error('Fill out database name & user & password');
								else if(data === 'error_connection')
								{
									$('#confirmationMsg').remove();
									$('#tabs-1').prepend('<div id="confirmationMsg" class="ui-state-error ui-corner-all" style="margin-top: 20px; padding: 10px 10px 0px 10px; margin-bottom:10px;">'+
															'<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>'+
															'<strong>Alert:</strong> Problem Creating Mysql Connection - check database name & user & password & host</p>'+
														'</div>');
									alertify.error('check database name & user & password & host');
								}
								else if(data === 'connection_success')
								{
									$('.loading-option').show();
									$("body").css("overflow", "hidden");
									
									$.post("tablesandcolsinfo.php", function(json){
										append_columns_name('colsTable', json);
										append_fields_name('colsTable', 'colsField', json);
										
										append_columns_name('rowsTable', json);
										append_fields_name('rowsTable', 'rowsField', json);
										
										append_columns_name('gridTable', json);
										append_fields_name('gridTable', 'gridField', json);
										
										append_columns_name('relLeftTable', json);
										append_fields_name('relLeftTable', 'relLeftField', json);
										
										append_columns_name('relRightTable', json);
										append_fields_name('relRightTable', 'relRightField', json);
										
										$('.loading-option').hide();
										$("body").css("overflow", "auto");
								
										$('#confirmationMsg').remove();
										$('#tabs-1').prepend('<div id="confirmationMsg" class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 10px 10px 0px 10px; margin-bottom:10px;">'+
																'<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>'+
																'<strong>Status:</strong> Connected</p>'+
															'</div>');
										
										$('#connectionStatus').empty();
										$('#connectionStatus').append('<div id="confirmationMsg" class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 10px 10px 0px 10px; margin-bottom:10px;">'+
																'<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>'+
																'<strong>Status:</strong> Connected</p>'+
															'</div>');
										
										alertify.success('Database connection success');
										$("#tabs-control-2").trigger('click');
										
										$("#confirmConnectionBtn").css('display', 'none');
									}, "json");


								}
							},
							error: function()
							{
							
								alert('error');
							
							}			
						});
					}else{
					
						if(dbName === '') alertify.error('Please enter database name');
						if(dbUser === '') alertify.error('Please enter database user');
						// if(dbPass === '') alertify.error('Please enter database password');
					
					}
				
				});
				
				$(document).keydown(function(e){
					var key = e.which;
					if(key === 13) $('#confirmSettingBtn').mousedown();
				});

				$('#confirmSettingBtn, #generate-table-btn').mousedown(function(){
				
					var tableName = $('#tableName').val(); // required
					var Protected = $('#protected').val(); // required
					var levels = "single";//$('#levels').val(); // required
					
					var colsTable = $('#colsTable').val(); // required
					var colsField = $('#colsField').val(); // required
					var colsAlias = $('#colsAlias').val();
					var colsFunc = $('#colsFunc').val();
					
					var rowsTable = $('#rowsTable').val(); // required
					var rowsField = $('#rowsField').val(); // required
					var rowsAlias = $('#rowsAlias').val();
					
					var gridTable = $('#gridTable').val(); // required
					var gridField = $('#gridField').val(); // required
					var gridFunc = $('#gridFunc').val();
					
					$('#relContainer option').prop("selected", true);
					var relationship = $('#relContainer').val();
					relationship = (relationship !== null) ? relationship.join() : 'null';
					
					var isNumeric = $('#isNumeric').val(); // required
					
					var allowRowsPagination = $('#allowRowsPagination').val(); // required
					
					var recordPerPage = $('#recordPerPage').val();
					var maxRecordsPerPage = $('#maxRecordsPerPage').val();
					
					var allowColsPagination = $('#allowColsPagination').val(); // required
					var columnPerPage = $('#colPerPage').val();
					var maxCols = $('#maxCols').val();
					
					if( (allowRowsPagination === 'true' && recordPerPage === '') ||
						(allowColsPagination === 'true' && columnPerPage === '') )
					{
					
						alertify.error('Fill out required fields');
						return;
					}
					
					if(tableName !== '' && Protected !== '' && levels !== '' && colsTable !== '' && colsField !== '' && rowsTable !== '' &&
						rowsField !== '' && gridTable !== '' && gridField !== '' && isNumeric !== '' && allowRowsPagination !== '' &&
						allowColsPagination !== '')
					{
						$.ajax({
						
							url: 'setconfig.php',
							type: 'POST',
							data: 'tableName='+tableName+'&protected='+Protected+'&levels='+levels+'&colsTable='+colsTable+
							'&colsField='+colsField+'&colsAlias='+colsAlias+'&colsFunc='+colsFunc+'&rowsTable='+rowsTable+'&rowsField='+rowsField+
							'&rowsAlias='+rowsAlias+'&gridTable='+gridTable+'&gridField='+gridField+'&gridFunc='+gridFunc+'&isNumeric='+isNumeric+
							'&allowRowsPagination='+allowRowsPagination+'&recordPerPage='+recordPerPage+'&maxRecordsPerPage='+maxRecordsPerPage+
							'&allowColsPagination='+allowColsPagination+'&columnPerPage='+columnPerPage+'&maxCols='+maxCols+'&relationship='+relationship,
							success: function(data)
							{
								//alert(data);
								if(data === 'empty_data') alertify.error('Fill out required fields');
								else if(data === 'error_connection')
								{
									alertify.error('Please create database connection!');
								}
								else if(data === 'table_already_exists') alertify.error('You can\'t create two table with the same name, or this table already exists!');
								else if(data === 'error_file') alertify.error('Can\'t create config.php file.');
								else if(data === 'error_folder') alertify.error('Please make sure that the table folder is writeable');
								else if(data === 'verified_data')
								{
									alertify.success('table Setting created successfully');
									
									valideTableName = tableName.replace(/ /gi, '_');
									valideTableName = valideTableName.replace(/[^a-z0-9_]/gi, '');
									window.location.replace('../tables/'+valideTableName);
								}
							},
							error: function()
							{
							
								alert('error');
							
							}			
						});
					}else{
					
						alertify.error('Fill out required fields');
						
					}
				
				});
			});
			
			
			function mk_relationships()
			{
				var colsTable = $('#colsTable').val();
				var rowsTable = $('#rowsTable').val();
				var gridTable = $('#gridTable').val();
				if(colsTable !== rowsTable || rowsTable !== gridTable || colsTable !== gridTable) $("#rel-panel").show();
				else if(colsTable === rowsTable && rowsTable === gridTable) $("#rel-panel").hide();
			}
			
			
			function rm_table(folderName, id)
			{
                                                    alertify.confirm("Are you sure you want to delete this table?", function (e) {
                            if (e) {
                                $.ajax({

                                                                url: 'setconfig.php',
                                                                type: 'POST',
                                                                data: 'folderName='+folderName,
                                                                success: function(data){
                                                                        alertify.success('Delete table success');
                                                                        $(id).remove();
                                                                },
                                                                error: function() {
                                                                        alertify.error('Delete table field');
                                                                }
                                                        });
                            } 
                        });

			
			}
			
			function append_columns_name(id, json)
			{
				var tables = json.tables;
				$('#'+ id +' > option').remove();
				$('#'+ id).append("<option value='' selected></option>");
				if($.isArray(tables))
				{
					for(var i = 0; i < tables.length; i++)
					{
						$('#'+ id).append("<option value='"+ tables[i] +"'>"+ tables[i] +"</option>");
					}
				}
			}
			
			function append_fields_name(id_controller, id, json)
			{
				var columns = json.columns;
				$('#'+ id +' > option').remove();
				
				$("#"+ id_controller).change(function() {
					var tableName = $(this).val();
					$('#'+ id +' > option').remove();
					if(tableName !== '')
					{
						var column = columns[tableName];
						if($.isArray(column))
						{
							for(var x = 0; x < column.length; x++)
							{
								$('#'+ id).append("<option value='"+ column[x] +"'>"+ column[x] +"</option>");
							}
						}
						is_column_date();
					}
				});
			
			}
			
			function is_column_date()
			{
				var table = $('#colsTable').val();
				var column = $('#colsField').val();
				if(table !== '' && column !== '')
				{
					$.ajax({
						url: 'setconfig.php',
						type: 'post',
						data: 'table='+table+'&column='+column,
						success: function(data){
							if(data.trim() === 'date') $('#colsFuncRow').show();
							else $('#colsFuncRow').hide();
						},
						error: function(){
						
						}
					});
				}
			}
			
		</script>
	</body>
</html>
