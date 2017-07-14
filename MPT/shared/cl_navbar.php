<?php
	/*
		this class will handle navbar status [Login || Not Login] and use print_navbar() to print correct navbar
	*/
if (! defined('DIRECTACESS')) exit('No direct script access allowed');
	class Navbar
	{
		private $login;

		public function __construct() {
			global $login;
			$this->login = $login;
		}

		/*
			this function to print navbar
			params: 
				tableName: will be basename(__DIR__) if used from generated tables else (for wizard) false

		*/
		public function print_navbar($tableName = false)
		{
			if($tableName === false) {
				echo // echo navbar and logo [for wizard]
				'<div class="container" id="cal">
					<div class="header">
						<img id="logo-cs" src="../tables/common/img/app-logo.png" alt="app-logo" />
					</div>
				</div>
				<nav class="navbar navbar-default navbar-static-top" role="navigation">
					<div class="container-fluid">
					
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header" style="position: relative;z-index: 100000;">
						  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						  </button>
						</div>
						
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="navbar-collapse">
							<ul class="nav navbar-nav navbar-right" style="margin-right: 20px;">
								<li><a href="#">Welcome <strong>'. $this->login->getUsername() .'</strong></a></li>
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</div><!-- .navbar-collapse -->
				  </div><!-- .container-fluid -->
				</nav>';
			} else { // echo just navbar [for generated tables]
				$navbarBtns = "";
				if($this->login->is_loggedin()) {
					$navbarBtns = 
					'<ul class="nav navbar-nav">
						<li><a href="../../wizard/setconfig.php" style="font-size: 14px;font-weight: 700;"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;Manage tables</a></li>
						<li><a href="#" id="php-to-excel" onclick="return false;" style="font-size: 14px;font-weight: 700;"><img src="../common/img/excel-icon.png" width="22" height="22" /> <span style="display: inline-block;position: relative; bottom: 7px;">Export to excel</span></a></li>
					</ul>	
					<ul class="nav navbar-nav navbar-right" style="margin-right: 20px;">
						<li><a href="#" style="font-size: 14px;">Welcome <strong>'. $this->login->getUsername() .'</strong></a></li>
						<li><a href="../../wizard/logout.php" style="font-size: 14px;">Logout</a></li>
					</ul>';
				} else {
					$navbarBtns = 
					'<ul class="nav navbar-nav">
						<li><a href="#" id="php-to-excel" onclick="return false;" style="font-size: 14px;font-weight: 700;"><img src="../common/img/excel-icon.png" width="22" height="22" /> <span style="display: inline-block;position: relative; bottom: 7px;">Export to excel</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right" style="margin-right: 20px;">
						<li><a href="../../wizard/login.php?from=table&path='. $tableName .'">Login</a></li>
						<!-- <li><a href="../../wizard/signup.php">Signup</a></li> -->
					</ul>';
				}
				echo
				'<nav class="navbar navbar-default navbar-static-top" role="navigation">
					<div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
						  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						  </button>
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="navbar-collapse">
							'. $navbarBtns .'
						</div><!-- /.navbar-collapse -->
				  </div><!-- /.container-fluid -->
				</nav>';
			}
		}
	}
	$navbar = new Navbar();