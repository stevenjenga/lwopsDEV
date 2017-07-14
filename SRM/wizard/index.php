<?php 
ob_start();
error_reporting(E_ERROR  | E_PARSE);
	session_start(); 
	define("SYSTEM_CONTROL", true);
	// pages that's represent navigation
	$pagesName = array(
		"step_2", // connect
		"data_source", // data source
		"step_4", // columns
		"step_5", // group by
		"step_6" // settings
	);
	// this to handler current page
	if(isset($_GET['id']))
	{
		$id = preg_replace("/[^0-9]/", "", $_GET['id']); // validate id > numeric only
		if(isset($pagesName[$id])) $_SESSION['srm_f62014_page_key'] = $pagesName[$id]; // set current page in session for navigation reason
		else $_SESSION['srm_f62014_page_key'] = "step_2"; // if wrong id return to **step2 or not found 404
	}
	
	if(isset($_POST['lastActivePage']) && $_POST['lastActivePage'] === "clear" 
		&& isset($_SESSION['srm_f62014_active_pages']) && is_array($_SESSION['srm_f62014_active_pages']))
			unset($_SESSION['srm_f62014_active_pages']);
	
	// this to get url for this site without referring to page name just directory like www.sitename.com/dir/
	$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$url = (strpos($url, '?')) ? substr($url, 0, strpos($url, '?')) : $url;
	$url = ($url[strlen($url) - 1] !== '/') ? $url+'/' : $url;
	
	// this to set current page
	if(isset($_SESSION['srm_f62014_page_key']) && in_array($_SESSION['srm_f62014_page_key'], $pagesName)) $currentPage = $_SESSION['srm_f62014_page_key'];
	else $currentPage = "step_2";
	
	// this to detect last active page
	if(isset($_SESSION['srm_f62014_active_pages']) && is_array($_SESSION['srm_f62014_active_pages'])) 
		$lastActivePage = $_SESSION['srm_f62014_active_pages'][COUNT($_SESSION['srm_f62014_active_pages']) - 1];
	else $lastActivePage = "step_2";
	
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Connect</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="designLayer/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="designLayer/alertify/themes/alertify.default.css" />
		<link rel="stylesheet" href="designLayer/alertify/themes/alertify.core.css" />
		<?php if(isset($_SESSION['srm_f62014_datasource']) && $_SESSION['srm_f62014_datasource'] === "sql" && $currentPage === "data_source") { ?>
		<link rel="stylesheet" href="designLayer/jquery-ui-ligthness/jquery-ui.css" />
		<?php } else { ?>
		<link href="designLayer/jquery-ui/css/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
		<?php } ?>
		<link rel="stylesheet" href="designLayer/css/main.css" />
		
	
		<script>
			// set currenrtURL, currentPage, lastActivePage in client side
			var currentURL = "<?php $url ?>";
			var currentPage = "<?php echo $currentPage; ?>";
			var lastActivePage = "<?php echo $lastActivePage; ?>";
		</script>
		<script src="designLayer/js/jquery.js"></script>
		<script src="designLayer/js/jquery-ui-1.10.4.custom.min.js"></script>
		<script src="designLayer/bootstrap/js/bootstrap.min.js"></script>
		<script src="designLayer/alertify/lib/alertify.min.js"></script>
		<script src="designLayer/js/lib.js"></script>
	</head>
	<body>
		<div class="container-index">
			<div id="parent-container">
				<div class="header-bar"></div>
				<div id="header" class="row col-xs-12">
					<div style="height: 65px;">
					<p id="logo" style="float: left;"><img border="0" src="designLayer/images/01.jpg" width="369" height="71"></p><!--   style="text-align: right;" -->
					<div id="page-header"></div>
					</div>
					<hr style="width: 650px;margin-left: 75px; border: 1px solid #FFBF00" />
				</div>
				<div id="exit-container" class=""><a id="exit" class="cr-hand btn btn-primary btn-xs" ><img style="position: relative; left: -3px;top: -1px;" width="16" height="16" src="designLayer/images/exit.png" class="glyphicon">Disconnect &amp; Exit</a></div> 
				<div class="row" id="child-container">	
					<div class="col-xs-3">
						<div id="nav-switch">
							<ul id="nav-inner-switch" class="nav nav-pills nav-stacked">
								<li id="nav-header">Steps</li>
								<li class="">
									<a id="step_2">
										<span class="glyphicon glyphicon-link"></span> Connect
									</a>
								</li>
								<li class="">
									<a id="data_source">
										<span class="glyphicon glyphicon-dashboard"></span> Data Source
									</a>
								</li>
								<li class="">
									<a id="step_4" >
										<span class="glyphicon glyphicon-th-large"></span> Columns
									</a>
								</li>
								<li class="">
									<a id="step_5" >
										<span class="glyphicon glyphicon-pushpin"></span> Groups
									</a>
								</li>
								<li class="">
									<a id="step_6" >
										<span class="glyphicon glyphicon-cog"></span> Settings
									</a>
								</li>
								<li class="">
									<a id="finish" >
										<span class="glyphicon glyphicon-ok"></span> Finish
									</a>
								</li>
							</ul>
							
						</div>
					</div>
					<div id="container" class="col-xs-9">
						
						<?php require_once $currentPage.'.php'; ?>
	
		<script id="script">
			// this array hold title of pages when we going throw navigation
			var titleOfPages = {
				"step_2": "Connect",
				"data_source": "Data Source",
				"step_4": "Choose Columns",
				"step_5": "Groups & Sorts Setting",
				"step_6": "General Setting"
			};
			
		
			$(document).ready(function(){
				// set title for every page
				$("title").text(titleOfPages[currentPage]);
				// handle navigate between pages
				$("#"+lastActivePage).parent().nextAll().addClass( "disabled-now" );
				$("#"+lastActivePage).parent().prevAll().children().attr("href", "#");
				$("#"+lastActivePage).attr("href", "#");
				$("#"+currentPage).parent().addClass( "active-now" );
				// set icons
				$("#"+currentPage).append( "<span id='switchStatus' style='position: absolute;right: 0px;top: 10px;' class='glyphicon glyphicon-play invert-direction'></span>" );
				// set icons
				$("#"+currentPage).parent().prevAll().children().append( "<span style='position: absolute;right: 0px;top: 10px;' class='glyphicon glyphicon-ok switchStatus'></span>" );
				// execute navigation process
				$("#nav-inner-switch > li").each(function(){
					var id  = $(this).children().attr("id");
					var next = id+".php";
					setNavProcess(id);
				});
				
				// remove outline from buttons
				$("button").css("outline", "none");
				
				$("#exit").mousedown(function(){
					//location.replace("server/disconnect.php");
                                        $.ajax({
                                            type: "POST",
                                            url: "server/disconnect.php"
                                        }).done(function(){
                                            location.replace("../wizard/?id=0");
                                        });
				});
			});
			// set navigation process
			function setNavProcess(id)
			{
				id = "#"+id;
				$(id).click(function(e){
					e.preventDefault();
					if(!$(this).parent().hasClass("active-now") && $(this).attr("href") === "#"){
						if($(this).attr("id") === "step_2") location.replace(currentURL+"?id="+0);
						if($(this).attr("id") === "data_source") location.replace(currentURL+"?id="+1);
						if($(this).attr("id") === "step_4") location.replace(currentURL+"?id="+2);
						if($(this).attr("id") === "step_5") location.replace(currentURL+"?id="+3);
						if($(this).attr("id") === "step_6") location.replace(currentURL+"?id="+4);
					}
				});
			}
		</script>
		<script src="help.js"></script>
	</body>
</html>