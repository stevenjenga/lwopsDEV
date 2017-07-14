<?php
	defined('SYSTEM_CONTROL') or die (header('location: ../wizard'));
	$_SESSION['srm_f62014_page_key'] = "step_2";
	require_once 'activePages.php';

	$host_name = (isset($_SESSION['srm_f62014_host'])) ? $_SESSION['srm_f62014_host'] : 'localhost';
	$user_name = (isset($_SESSION['srm_f62014_user'])) ? $_SESSION['srm_f62014_user'] : '';
	$password = (isset($_SESSION['srm_f62014_pass'])) ? $_SESSION['srm_f62014_pass'] : '';
	$database_name = (isset($_SESSION['srm_f62014_db'])) ? $_SESSION['srm_f62014_db'] : '';
	$data_source = (isset($_SESSION['srm_f62014_datasource'])) ? $_SESSION['srm_f62014_datasource'] : 'table';

?>
<!--
<html>
	<head>
		<title>Select table</title>
	</head>
	<body>
-->
		<div class="container col-xs-12" ><!-- style="border: 1px solid black;" -->
			<form id="myForm" name="myForm" action="<?php echo($_SERVER['PHP_SELF']); ?>" role="form" method="post" onsubmit="return false;">
				
				<div class="row">
					<div class="col-xs-10">
						
					</div>
					<div class="col-xs-2"></div>
				</div><!-- .row (title) -->

				<div class="row">
					<div class="col-xs-1"></div>
					<div id="error-container" class="col-xs-10">
						<!-- .alert -->
					</div>
					<div class="col-xs-1"></div>
				</div><!-- .row (error) -->
					
				<div class="row">
					<div class="col-xs-1"></div>
					<div class="form-group col-xs-10">
						<label for="host_name">Host name</label>
						<div class="left-inner-addon">
							<i class="glyphicon glyphicon-tasks"></i>
							<input name="host_name" class="form-control font-size-lg" type="text" id="host_name" placeholder="Host name" 
								value="<?php echo $host_name; ?>" />
						</div>
					</div>
					<div class="help-container col-xs-1">
						<a href="" onClick="return false;" id="hostHelp">
							<img src="designLayer/images/help.png" width="15" height="15" border="0">
						</a>
					</div>
				</div>	<!-- .row (host name) -->
				
				<div class="row">
					<div class="col-xs-1"></div> 
					<div class="form-group col-xs-10">
						<label for="user_name">Username</label>
						<div class="left-inner-addon">
							<i class="glyphicon glyphicon-user"></i>
							<input name="host_name" class="form-control font-size-lg" type="text" id="user_name" placeholder="Username" 
								value="<?php echo $user_name; ?>" />
								
						</div>
					</div>
					<div class="help-container col-xs-1">
						<a href="" id="userHelp" onClick="return false;">
							<img src="designLayer/images/help.png" width="15" height="15" border="0">
						</a>
					</div>
				</div><!-- .row (user name) -->
				
				<div class="row">
					<div class="col-xs-1"></div> 
					<div class="form-group col-xs-10">
						<label for="password">Password</label>
						<div class="left-inner-addon">
							<i class="glyphicon glyphicon-lock"></i>
							<input name="password" class="form-control font-size-lg" type="password" id="password" placeholder="Password" />
						</div>
					</div>
					<div class="help-container col-xs-1">
						<a href=""  id="passHelp" onClick="return false;">
							<img src="designLayer/images/help.png" width="15" height="15" border="0">
						</a>
					</div>
				</div><!-- .row (password) -->
				
					
					
				<div class="row">
					<div class="col-xs-4"></div>
					<div class="col-xs-4">
						<button name="btn_connect" class="btn btn-sunny btn-block" id="btn_connect" >
							<span class="icon glyphicon glyphicon-link"></span><span class="separator"></span> Connect</button/> 
					</div>
					<div class="col-xs-4"></div>
				</div><!-- .row (connect btn) -->
				
				<div id="form-two"
					<?php if(!isset($_SESSION['srm_f62014_validate_key']) || 
						(isset($_SESSION['srm_f62014_validate_key']) && $_SESSION['srm_f62014_validate_key'] !== md5("srm_f62014_valid_1010"))) echo "style='display: none;'"?>>
					
					<div class="row">
						<div class="col-xs-1"></div> 
						<div class="form-group col-xs-10">
							<label for="database_name">Database</label>
							<div class="left-inner-addon">
								<i class="glyphicon glyphicon-floppy-disk"></i>
								<input type="text" name="database_name" placeholder="Database" class="form-control font-size-lg" id="database_name" value="<?php echo $database_name; ?>">
							</div>
						</div>
						<div class="help-container col-xs-1">
							<a href="" id="dbHelp" onClick="return false;">
								<img src="designLayer/images/help.png" width="15" height="15" border="0">
							</a>
						</div>
					</div><!-- .row (select database) -->
					
					
					
					<div class="row">
						<div class="col-xs-1"></div> 
						<div class="form-group col-xs-10">
							<label for="cmb_data_source">Data Source</label>
							<div class="left-inner-addon">
								<i class="glyphicon glyphicon-dashboard"></i>
								<select name="data_source" class="form-control font-size-lg" id="cmb_data_source">
									<option value="table" <?php if($data_source === 'table') echo 'selected'?>>Table</option>
									<option value="sql" <?php if($data_source === 'sql') echo 'selected'?>>SQL Query</option>
								</select>
							</div>
						</div>
						<div class="help-container col-xs-1">
							<a href="" id="dsHelp" onClick="return false;">
								<img src="designLayer/images/help.png" width="15" height="15" border="0">
							</a>
						</div>
					</div><!-- .row (select data source) -->
					
					
					
					<div class="row" style="">
						<div class="col-xs-4">
							<!-- back button -->
						</div>
						<div class="col-xs-4"></div>
						<div class="col-xs-4">
							<button name="btn_cont" id="btn_cont" class="btn btn-sunny btn-block">
								<span class="icon glyphicon glyphicon-forward"></span><span class="separator"></span> Next</button>
						</div>
					</div><!-- .row (navigation buttons) -->
				</div>
		
			</form>
		</div><!-- .container (end of this page) -->
		
		<!-- to complete index tags -->
		</div>
		
	</div>
</div>
</div>
<!-- end index tags -->
		<script>
			/* step_2.php
			 * myForm
			 * host_name
			 * user_name
			 * password
			 * database_name
			 * cmb_data_source
			 */
			$(document).ready(function(){
				$("#page-header").empty();
				$("#page-header").append('<div id="img-container"><img src="designLayer/images/mysql-icon.png" width="70" height="70"/></div>');
				$("#page-header").append('<div id="text-container"><h4>Connect to MySQL</h4>Please enter MySQL database parameters</div>');
				 
				 
				$("#btn_connect").mousedown(function(e){
					e.preventDefault();
					
					var host = $("#host_name").val();
					var user = $("#user_name").val();
					var pass = $("#password").val();
					$.ajax({
						url: "server/step_2.php",
						type: "post",
						data: "host="+host+"&user="+user+"&pass="+pass,
						success: function(data){
							$("#error-container").empty();
							if(data === "success")
							{
								alertify.success("Connect success");
								$("#form-two").show("slow");
							}
							else {
								if(data === '') $("#error-container").append("<div class='alert alert-danger'>Connection failed</div>");
								else $("#error-container").append("<div class='alert alert-danger'>"+data+"</div>");
								$("#form-two").hide("slow");
							}
						},
						error: function(){
							
						}
					});				
				});
				
				
				$("#btn_cont").mousedown(function(e){
					e.preventDefault();
					
					var db = $("#database_name").val();
					var dataSource = $("#cmb_data_source").val();
					$.ajax({
						url: "server/step_2.php",
						type: "post",
						data: "db="+db+"&dataSource="+dataSource,
						success: function(data){
							$("#error-container").empty();
							if(data === "success"){
								 nextToPage("1");
								SwitchStatusDone();
							}else {
								if(data === '') $("#error-container").append("<div class='alert alert-danger'>Can't proceed to next step, So check inserted data</div>");
								else $("#error-container").append("<div class='alert alert-danger'>"+data+"</div>");
								SwitchStatusError();
							}
						},
						error: function(){
							
						}
					});
				});
			});
		</script>
<!--
	</body>
</html>
-->
