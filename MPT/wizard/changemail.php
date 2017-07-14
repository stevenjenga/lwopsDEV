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
	if( isset($_POST['oldEmail']) && isset($_POST['newEmail']) )
	{
	
		$oldEmail = $_POST['oldEmail'];
		$newEmail = $_POST['newEmail'];
		
		if($oldEmail === $login->getEmail())
		{
			if( !filter_var($newEmail, FILTER_VALIDATE_EMAIL) )
			{
				echo 'wrong_new_email';
				exit();
			}
		
			if(is_writable('../shared')) {
				$filePath = '../shared/security.php';
				$str_fileContent = file_get_contents($filePath);
				
				$new_fileContent = str_replace($login->getEmail(), $newEmail, $str_fileContent);
				
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
			
			echo 'changeMail_success';
                        send_profile_change_notification("email");
                        
			exit();
			
		} else {
			
			echo 'wrong_old_email';
			exit();
		
		}
	}
?>
<!DOCTYPE html>
<html>

	<head>
	
		<meta charset='UTF-8'/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>Pivot table</title>
                  <meta name="robots" content="noindex, nofollow">
        <meta name="googlebot" content="noindex" />
		
		<link type='text/css' rel='stylesheet' href='../tables/common/bootstrap/css/bootstrap.min.css' />
		
		<link rel="stylesheet" href="../tables/common/alertify/themes/alertify.default.css" />
		<link rel="stylesheet" href="../tables/common/alertify/themes/alertify.core.css" />
		<link href="../shared/resources/css/change_mail_main.css" rel="stylesheet" />
		
		
		
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
							<div id='oldEmailContainer' class="left-inner-addon">
								<i class="glyphicon glyphicon-envelope"></i>
								<input type="email" class="form-control" id="oldEmail" placeholder="Old email">
								<span id="oldEmailFeedback"></span>
							</div>
						</div>
						<div class="col-lg-4 col-md-3 col-sm-2 hidden-xs"></div>
					</div>
					<div class='row'>
						<div class="col-lg-4 col-md-3 col-sm-2 hidden-xs"></div>
						<div class="form-group col-lg-4 col-md-6 col-sm-8 col-xs-12">
							<div id='newEmailContainer' class="left-inner-addon">
								<i class="glyphicon glyphicon-envelope"></i>
								<input type="email" class="form-control" id="newEmail" placeholder="New email">
								<span id="newEmailFeedback"></span>
							</div>
						</div>
						<div class="col-lg-4 col-md-3 col-sm-2 hidden-xs"></div>
					</div>
					<div class='row'>
						<div class="col-lg-4 col-md-3 col-sm-2 hidden-xs"></div>
						<div id='changeEmailBtnContainer' class="col-lg-4 col-md-6 col-sm-8 col-xs-12">
							<button id='changeEmailBtn' class='btn btn-primary btn-lg btn-block'>Change email</button>
						</div>
						<div class="col-lg-4 col-md-3 col-sm-2 hidden-xs"></div>
					</div>
				</form>
			</div>			
		<div><!-- container -->
		
		
		<script src='../tables/common/js/jquery-1.9.1.js'></script>
		<script src='../tables/common/bootstrap/js/bootstrap.min.js'></script>
		<script src="../tables/common/alertify/lib/alertify.min.js"></script>
		<script>
				
			var email_ok = false;
			
			function validate_email(id)
			{
			
				var _id = $(id).attr('id');
				
				var feedback = "";
				var container = "";
				
				if(_id === "oldEmail")
				{
					feedback = "oldEmailFeedback";
					container = "oldEmailContainer";
				
				}else if(_id === "newEmail"){
					feedback = "newEmailFeedback";
					container = "newEmailContainer";
				}
				var email = $(id).val();
					
                var wrongRegExp = email.match(/[' "><]/gi);
					
                var arrOfAT = email.match(/@+/gi);
					
				var arrOfDot = email.match(/\.+/gi);
					
				$('#'+feedback).removeClass();
				$('#'+container).removeClass();
					
				if (email == "") 
				{
					$('#'+container).addClass('left-inner-addon has-warning has-feedback');
					$('#'+feedback).addClass('glyphicon glyphicon-warning-sign form-control-feedback');
					email_ok = false;
                }
                else if ( wrongRegExp || arrOfAT === 'undefined' || arrOfAT === null || arrOfAT.length === 0 || arrOfAT.length > 1 ||
						arrOfAT[0] !== '@' || arrOfDot === 'undefined' || arrOfDot === null || arrOfDot.length === 0 || email.search("@") <= 2 ||
						email.lastIndexOf('.') < (email.indexOf('@') + 2) || email.lastIndexOf('.') === (email.length - 1) ||
						email.charAt(email.indexOf("@") - 1) === '.' || email.charAt(email.indexOf("@") + 1) === '.' ||
						email.lastIndexOf(".") === (email.length - 2) || email.charAt(0) === '.'
						) 
				{
					$('#'+container).addClass('left-inner-addon has-error has-feedback');
					$('#'+feedback).addClass('glyphicon glyphicon-remove form-control-feedback');
					email_ok = false;
                }else {
					$('#'+container).addClass('left-inner-addon has-success has-feedback');
					$('#'+feedback).addClass('glyphicon glyphicon-ok form-control-feedback');
					email_ok = true;
                }
			}
			
			
			$(document).ready(function(){
			
				
				$('#oldEmail').blur(function(){
					validate_email(this);
				});
				
				$('#newEmail').blur(function(){
					validate_email(this);
				});
				
				$('#changeEmailBtn').mousedown(function(){
				
					var oldEmail = $('#oldEmail').val();
					var newEmail = $('#newEmail').val();
					
					validate_email('#oldEmail');
					validate_email('#newEmail');
					
					if( email_ok ){
					
						$.ajax({
						
							url: 'changemail.php',
							type: 'POST',
							data: 'oldEmail='+oldEmail+'&newEmail='+newEmail,
							success: function(data)
							{
								if(data === 'wrong_old_email') 
								{
									alertify.error('wrong email');
									
									$('#oldEmailFeedback').removeClass();
									$('#oldEmailContainer').removeClass();
									
									$('#oldEmailContainer').addClass('left-inner-addon has-error has-feedback');
									$('#oldEmailFeedback').addClass('glyphicon glyphicon-remove form-control-feedback');
								}
								else if(data === 'wrong_new_email') alertify.error('Not valid password');
								else if(data === 'error_file') alertify.error('Can\'t open security.php file.');
								else if(data === 'error_folder') alertify.error('Please make sure that the shared folder is writeable');
								else if(data === 'changeMail_success') {
								
									alertify.success('change email success');
									
									$('#oldEmailFeedback').removeClass();
									$('#oldEmailContainer').removeClass();
									
									$('#oldEmailContainer').addClass('left-inner-addon has-success has-feedback');
									$('#oldEmailFeedback').addClass('glyphicon glyphicon-ok form-control-feedback');
									
									$('#changeEmailBtn').css('display', 'none');
									$('#changeEmailBtnContainer').append('<div class="alert alert-success alert-dismissable">'+
									  '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
									  '<strong>Change email Success! </strong>'+
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