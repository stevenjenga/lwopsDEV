<?php
define("DIRECTACESS", "true");
	require_once('../shared/shared.php');
	$login->headerTo(false, "login.php?from=setconfig");
	// this will check if security.php not exists AND display Don't have account message to user.
	if(!file_exists('../shared/security.php'))
	{
		echo '
			<link href="../tables/common/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
			<script src="../tables/common/js/jquery-1.9.1.js"></script>
			<script src="../tables/common/bootstrap/js/bootstrap.js"></script>
			<div class="container" style="position: relative;top: 10px;">
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<div>
						<strong>You don\'t have an account!</strong> <a class="alert-link" href="signup.php">click here to create one</a>
					</div>
				</div>
			</div>';
		exit();
	
	}
	// retriving data via ajax
	if( isset($_POST['oldPass']) && isset($_POST['newPass']) )
	{
                 $oldPass = $_POST['oldPass'];
                 $salt = createSalt($login->getUsername());
                 $hashed_old_pass = hash("sha256", $oldPass . $salt);
		
		$newPass = $_POST['newPass'];
		
		
		
		if($hashed_old_pass == $login->getPassword())
		{
			 if (preg_match('/[ \/\\\]/i', $newPass) || strlen($newPass) < 8 || !preg_match('/[a-z]+/', $newPass) || !preg_match('/[A-Z]+/', $newPass) || !preg_match('/[0-9]+/', $newPass) )
			{
                            
				echo 'wrong_new_password';
				exit();
			}
			
			$hashNewPass = hash("sha256", $newPass . $salt);
		
			if(is_writable('../shared'))
			{
				$filePath = '../shared/security.php';
				$str_fileContent = file_get_contents($filePath);
				
				$new_fileContent = str_replace($login->getPassword(), $hashNewPass, $str_fileContent);
				
				$file = fopen($filePath, 'w') or exit("Unable to open file!");
				if ($file) {
					fwrite($file, $new_fileContent);
					fclose($file);
				} else {
					echo 'error_file';
					exit();
				}
			} else {
				echo 'error_folder';
				exit();
			}

			echo 'changePass_success';
                        send_profile_change_notification("password");
			$_SESSION = array();
			session_destroy();
			exit();
		} else {
			echo 'wrong_old_password';
			exit();
		}
	}
?>
<!DOCTYPE html>
<html>

	<head>
	
		<meta charset='UTF-8'/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>MySQL Pivot table Generator</title>
                 <meta name="robots" content="noindex, nofollow">
        <meta name="googlebot" content="noindex" />
		
		<link type='text/css' rel='stylesheet' href='../tables/common/bootstrap/css/bootstrap.min.css' />
		
		<link rel="stylesheet" href="../tables/common/alertify/themes/alertify.default.css" />
		<link rel="stylesheet" href="../tables/common/alertify/themes/alertify.core.css" />
		<link rel="stylesheet" href="../shared/resources/css/change_pass_main.css" />
		
		<style>
		
		</style>
		
		
	</head>

	<body>
	
		<div class='container'>
		
			<div class="header">
				<div style="text-align:center">
					<img src="../tables/common/img/app-logo.png" class="app-logo" alt='Logo picture'/>
				</div>
			</div><!-- .header -->
			
			
			<div id='formContainer'>
				<form role="form" onsubmit='return false;'>
					<div class='row'>
						<div class="col-lg-4 col-md-3 col-sm-2 hidden-xs"></div>
						<div class="form-group col-lg-4 col-md-6 col-sm-8 col-xs-12">
							<div id='oldPassContainer' class="left-inner-addon">
								<i class="glyphicon glyphicon-lock"></i>
								<input type="password" class="form-control" id="oldPass" placeholder="Old password" data-container="body" data-toggle="popover" data-placement="right">
								<span id="oldPassFeedback"></span>
							</div>
						</div>
						<div class="col-lg-4 col-md-3 col-sm-2 hidden-xs"></div>
					</div>
					<div class='row'>
						<div class="col-lg-4 col-md-3 col-sm-2 hidden-xs"></div>
						<div class="form-group col-lg-4 col-md-6 col-sm-8 col-xs-12">
							<!-- <label for="password">Password</label> -->
							<div id='newPassContainer' class="left-inner-addon">
								<i class="glyphicon glyphicon-lock"></i>
								<input type="password" class="form-control" id="newPass" placeholder="New password" data-container="body" data-toggle="popover" data-placement="right">
								<span id="newPassFeedback"></span>
							</div>
						</div>
						<div class="col-lg-4 col-md-3 col-sm-2 hidden-xs"></div>
					</div>
					<div class='row' style='margin-bottom: 10px;'>
						<div class="col-lg-4 col-md-3 col-sm-2 hidden-xs"></div>
						<div class="form-group col-lg-4 col-md-6 col-sm-8 col-xs-12">
							<!-- <label for="confirmNewPassword">Confirm password</label> -->
							<div id='confirmPassContainer' class="left-inner-addon">
								<i class="glyphicon glyphicon-lock"></i>
								<input type="password" class="form-control" id="confirmNewPassword" placeholder="Confirm new password" data-container="body" data-toggle="popover" data-placement="right">
								<span id="confirmPassFeedback"></span>
							</div>
						</div>
						<div class="col-lg-4 col-md-3 col-sm-2 hidden-xs"></div>
					</div>
					<div class='row'>
						<div class="col-lg-4 col-md-3 col-sm-2 hidden-xs"></div>
						<div id='changePassBtnContainer' class="col-lg-4 col-md-6 col-sm-8 col-xs-12">
							<button id='changePassBtn' class='btn btn-primary btn-lg btn-block'>Change password</button>
						</div>
						<div class="col-lg-4 col-md-3 col-sm-2 hidden-xs"></div>
					</div>
				</form>
			</div>			
		<div><!-- container -->
		
		
		<script src='../tables/common/js/jquery-1.9.1.js'></script>
		<script src='../tables/common/bootstrap/js/bootstrap.min.js'></script>
		<script src="../tables/common/alertify/lib/alertify.min.js"></script>
		<script src="help_msg.js"></script>
		<script>
				
			var password_ok = false;
			var confirmPass_ok = false;
			
			function validate_password(id)
			{
			
				var password = $(id).val();
					
				var wrongRegExp = password.match(/[ \/\\]/gi);
					
				$('#newPassFeedback').removeClass();
				$('#newPassContainer').removeClass();
					
                if (password === '') {
                    $('#newPassContainer').addClass('left-inner-addon has-warning has-feedback');
					$('#newPassFeedback').addClass('glyphicon glyphicon-warning-sign form-control-feedback');
					password_ok = false;
                }
                else if (password.length < 8 || password.match(/\d+/gi) === null || password.match(/[a-z]+/gi) === null || wrongRegExp) {
					$('#newPassContainer').addClass('left-inner-addon has-error has-feedback');
					$('#newPassFeedback').addClass('glyphicon glyphicon-remove form-control-feedback');
					password_ok = false;
                }else{
					$('#newPassContainer').addClass('left-inner-addon has-success has-feedback');
					$('#newPassFeedback').addClass('glyphicon glyphicon-ok form-control-feedback');
					password_ok = true;
				}
			}
			
			function validate_confirmPass(id)
			{
			
				var password = $('#newPass').val();
				var confirmPass = $(id).val();
					
				$('#confirmPassFeedback').removeClass();
				$('#confirmPassContainer').removeClass();
					
				if( confirmPass === ''){
					$('#confirmPassContainer').addClass('left-inner-addon has-warning has-feedback');
					$('#confirmPassFeedback').addClass('glyphicon glyphicon-warning-sign form-control-feedback');
					confirmPass_ok = false;
				}else if( confirmPass !== password){
					$('#confirmPassContainer').addClass('left-inner-addon has-error has-feedback');
					$('#confirmPassFeedback').addClass('glyphicon glyphicon-remove form-control-feedback');
					confirmPass_ok = false;
				}else{
					$('#confirmPassContainer').addClass('left-inner-addon has-success has-feedback');
					$('#confirmPassFeedback').addClass('glyphicon glyphicon-ok form-control-feedback');
					confirmPass_ok = true;
				}
			}
			
			$(document).ready(function(){

				help_msg('changePass');

				$('#newPass').blur(function(){
					validate_password(this);
				});
				
				$('#confirmNewPassword').blur(function(){
					validate_confirmPass(this);
				});
				
				$('#changePassBtn').mousedown(function(){
				
					var oldPass = $('#oldPass').val();
					var newPass = $('#newPass').val();
					var confirmPass = $('#confirmNewPassword').val();
					
					validate_password('#newPass');
					validate_confirmPass('#confirmNewPassword');
					
					if( password_ok && confirmPass_ok ){
					
						$.ajax({
						
							url: 'changepass.php',
							type: 'POST',
							data: 'oldPass='+oldPass+'&newPass='+newPass,
							success: function(data)
							{
								if(data === 'wrong_old_password') 
								{
									alertify.error("The password dosn't match the one on file. Please enter the old password");
									
									$('#oldPassFeedback').removeClass();
									$('#oldPassContainer').removeClass();
									
									$('#oldPassContainer').addClass('left-inner-addon has-error has-feedback');
									$('#oldPassFeedback').addClass('glyphicon glyphicon-remove form-control-feedback');
								}
								else if(data === 'wrong_new_password') alertify.error('New password is not strong enough');
								else if(data === 'error_file') alertify.error('Can\'t open security.php file.');
								else if(data === 'error_folder') alertify.error('Please make sure that the shared folder is writeable');
								else if(data === 'changePass_success') {
								
									alertify.success('change password success');
									
									$('#oldPassFeedback').removeClass();
									$('#oldPassContainer').removeClass();
									
									$('#oldPassContainer').addClass('left-inner-addon has-success has-feedback');
									$('#oldPassFeedback').addClass('glyphicon glyphicon-ok form-control-feedback');
									
									$('#changePassBtn').css('display', 'none');
									$('#changePassBtnContainer').append('<div class="alert alert-success alert-dismissable">'+
									  '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
									  '<strong>Change password Success! </strong><a class="alert-link" href="login.php">Login now</a>'+
									  '</div>');
								}
							},
							error: function()
							{
							
								alert('You get some trouble');
							
							}
						});
						
					}else{
						alertify.error('Enter valid data!');
					}
				
				});
			
			});
			
			
		
		</script>
		
		
	</body>

</html>