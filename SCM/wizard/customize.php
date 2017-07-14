<?php
/**
 * Smart Chart Maker 
 * @author		StarSoft
 * @copyright	Copyright (c) 2011 - 2014, StarSoft, Inc.
 * @link		http://mysqlreports.com
 * 
 * 
 */
 //require_once("shared.php");
 // require_once("check.php");
 // just for test
require_once("check.php");
error_reporting(E_ERROR  | E_PARSE); 
require_once 'default_value.php';
require_once 'clean_input_array.php';
require_once 'bootstrap_popup.php';
// this function to receive user inputs and put it in session 
if(isset($_POST) && isset($_POST['preview']) && $_POST['preview'] === 'preview_chart')
{
	// here clean user input by clean_input_array from clean_input_array.php
	$XPost = clean_input_array($_POST);
	foreach($XPost as $key => $value)
	{
		// here handle position of the legend
		if($key !== 'legend_position_1' && $key !== 'legend_position_2')
		{
			if($key === 'legend_position_3')
			{
				$key = 'legend_position';
				$value = $XPost['legend_position_1'] . ' ' . $XPost['legend_position_2'] . ' ' .  $XPost['legend_position_3'];
				if($XPost['legend_position_2'] === 'bottom')
				{
					if($XPost['legend_position_3'] === 'left') $value .= ' 3 -3';
					else if($XPost['legend_position_3'] === 'right') $value .= ' -3 -3';
				}
				else if($XPost['legend_position_2'] === 'top')
				{
					if($XPost['legend_position_3'] === 'left') $value .= ' 3 3';
					else if($XPost['legend_position_3'] === 'right') $value .= ' -3 3';
				}
			}
			// here handle dashed is true to  7px width then 2px space so on
			if(preg_match('/dash/', $key))
			{
				if($value === 'true') $value = '7,2';
			}
			// handle tooltip if user need to use it or not
			if($key === 'show_tooltips')
			{
				if($value === 'on') $value = 'true';
				else $value = 'false';
			}
			$_SESSION['cu_'.$key] = $value;
		}
	}
	if(!isset($_SESSION['cu_show_tooltips']) || !isset($XPost['show_tooltips'])) // handle tooltip if don't need to use it
	{
		$_SESSION['cu_show_tooltips'] = 'false';
	}
	$_SESSION['cu_graph_title_font_weight'] = 'bold'; // set title of the graph bold
	$_SESSION['cu_XPost'] = $XPost; // we use it in default values that we get it from session

	echo 'success';
	exit();
}

$array_of_chartTypes = array('0', '1', '3', '4', '5', '6', '7', '8', '9', '10');
if(isset($_SESSION["ks_chartType"]) && in_array($_SESSION["ks_chartType"], $array_of_chartTypes))
{ 
	$chartType=$_SESSION["ks_chartType"]; 
}
else
{
    header("location: Chart1.php");
}



 

?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>     <?php echo $CartName; ?> Settings
</title>
	<?php if($use_old_help_msg === false) { ?>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<?php } ?>
	<link href="style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="jquery-ui.css" />
	<!--<link rel="stylesheet" media="screen" type="text/css" href="colorpicker.css" />-->
	<style type="text/css" >
		.tab{
		   text-align:left !important;
		    
		}
		.group-container{
			margin: 10px 0px 25px 0px;
			padding: 10px 0px;
			border: 2px solid #dfdfdf;
			border-radius: 5px;
		}
		.group-container-header{
			position: relative;
			top: -21px;
			text-align: left;
			padding-left: 5px;
		}
		.group-container-header > span{
			background: white;
			font-weight: bold;
			font-size: 14px;
		}
		.group-container > h4{
			text-align: left;
			text-decoration: underline;
			margin-left: 10px;
			margin-top:0px;
			margin-bottom:5px;
		}

		.group-container-body{
			padding-left: 10px;
			text-align: left;
			margin: 3px 0px;
			display: inline-block;
		}

		.group-container-body > label{
			margin: 5px 0px;
			width: 130px;
			display: inline-block;
			float: left;
		}
		.group-container-body > input, .group-container-body > select{
			width: 200px;
		}
		.inline-form{
			float: left;
		}
		.group-container-body > .inline-form-control{
			width: auto;
			border-radius: 5px;
			max-width: 35px;
		}
		.group-container-body > .inline-form-label{
			width: auto;
			margin: 5px;
		}
		.group-container-body > .inline-control{
			width: auto;
			border-radius: 5px;
			max-width: 80px;
		}
		.group-container-body > .inline-label{
			width: 100px;
		}
		.first-header{
			text-decoration: underline;
			margin-left: 5px;
		}
		.angle-deg{
			max-width: 130px;
		}
		.angle-desc{
			display: inline-block;
			margin-left: 15px;
		}
	</style>
	<script src="jquery-1.9.1.js"></script>
 	<script type="text/javascript" src="jscolor/jscolor.js"></script>
	<!--
  	<script type="text/javascript" src="eye.js"></script> 
    <script type="text/javascript" src="utils.js"></script>
    <script type="text/javascript" src="layout.js?ver=1.0.2"></script>
	-->
	<script src="jquery-ui.js"></script>
	
	<?php if($use_old_help_msg === false) { ?>
		<script src="bootstrap/js/bootstrap.min.js"></script>
	<?php } ?>


	<script language="JavaScript" type="text/javascript">
	
		function desc_angle(textInputId, AngleDescId)
		{
			deg = $('#'+textInputId).val();
			if(deg === '') deg = 0;
			$('#'+AngleDescId).css('-o-transform', 'rotate('+deg+'deg)');
			$('#'+AngleDescId).css('-ms-transform', 'rotate('+deg+'deg)');
			$('#'+AngleDescId).css('-moz-transform', 'rotate('+deg+'deg)');
			$('#'+AngleDescId).css('-webkit-transform', 'rotate('+deg+'deg)');
			$('#'+AngleDescId).css('transform', 'rotate('+deg+'deg)');
		}

		$(document).ready(function(){
			$(function() {
			    $( "#tabs" ).tabs();
			});

			$('#axis_text_angle_v').focus(function(){
				$('#by_axis_text_angle_h').css('visibility', 'hidden');
			});
			$('#axis_text_angle_h').focus(function(){
				$('#by_axis_text_angle_v').css('visibility', 'hidden');
			});
			
			$('#axis_text_angle_v').blur(function(){
				$('#by_axis_text_angle_h').css('visibility', 'visible');
			});
			$('#axis_text_angle_h').blur(function(){
				$('#by_axis_text_angle_v').css('visibility', 'visible');
			});
			
			$('#axis_text_angle_v').keyup(function(){
				desc_angle('axis_text_angle_v', 'by_axis_text_angle_v');
			});
			$('#axis_text_angle_h').keyup(function(){
				desc_angle('axis_text_angle_h', 'by_axis_text_angle_h');
			});

			$('#show_tooltips').change(function(){
				if($(this).prop('checked')){
					$('#tooltip-properties').show('slow');
				}else{
					$('#tooltip-properties').hide('slow');
				}
			});

			if($('#show_tooltips').prop('checked')){
				$('#tooltip-properties').show('fast');
			}else{
				$('#tooltip-properties').hide('fast');
			}

			$('#show_subdivisions').change(function(){
				if($(this).val() === 'true'){
					$('#subdivision_v_container').show();
					$('#subdivision_h_container').show();
				}else{
					$('#subdivision_v_container').hide();
					$('#subdivision_h_container').hide();
				}
			});

			$('#btn_cont').mousedown(function(){
                            //checking title
                            if($("#graph_title").val()=="")
                                {                                
                                    alert("Please enter a title for your chart in the 'General' tab");
                                    return;
                                }
                            
                            var formEntries = $('#setting-form').serialize();
                            $.ajax({
                             url: 'customize.php',
                             data: formEntries+'&preview=preview_chart',
                             type: 'post',
                             success: function(data){
                                //alert(data);
                                //header("location: ");
                                if(data === 'success') location.assign('engine/common.php');
                               }
                             
                            });
                        });
		});
 
 	</script>
</head>

<body>

	<DIV id="TipLayer" style="visibility:hidden;position:absolute;z-index:1000;top:-100;"></DIV>
	<SCRIPT language="JavaScript" src="style.js" type="text/javascript"></SCRIPT>

	<?php if($use_old_help_msg === false) { ?>
		<script src="popup_handler.js"></script>  
	<?php } ?>         
	<center>
	<form id="setting-form" action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="return false;">
 

	<table width="732"  height="467" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td align="center" width="64" height="20" background="images/topleft.jpg" style="background-repeat: no-repeat" >
           
      	<td align="center" width="614" height="20" background="images/top.jpg" style="background-repeat: x">
           
      	<td align="center" width="48" height="20" background="images/topright.jpg" style="background-repeat: no-repeat">
    </tr>
	<tr>
		<td align="center" width="64" style="background-repeat: y" valign="top" background="images/leftadd.jpg">
	        <img border="0" src="images/left.jpg"><td rowspan="2" align="center" valign="top" >
           	<p><img border="0" src="images/01.jpg" width="369" height="71"></p>
			<table width="100%" height="337" border="0" align="center" id="table8">
			<tr>
				<td colspan="2" height="22"><span class="step_title">Graph Settings</span>
					<button id="exit" style="position: relative;left: 325px;font-size: 11px;cursor: pointer;" onclick="return false;">Disconnect &amp; Exit</button>
					</td>
			</tr>
			<tr>
				<td colspan="2" height="266" valign="top">	
               	<table width="501" height="248" border="0" align="center" cellpadding="0" cellspacing="0" id="table11">
   				<tr>
			     	<td width="27" height="16">
			       	<img border="0" src="images/ctopleft.jpg" width="38" height="37"/></td>
			   		<td width="425" height="16" background="images/ctop.jpg" style="background-repeat: x">&nbsp;</td>
			   		<td width="38" height="16">
			       		<img border="0" src="images/ctopright.jpg" width="38" height="37"/></td>
			   	</tr>
  				<tr>
     				<td width="27" background="images/cleft.jpg" style="background-repeat: y">&nbsp;</td>
     				<td width="425" bgcolor="#F9F9F9" align="center">    
	   <!-- tabs -->

		<div id="tabs">
	   
			<ul>
				<li><a href="#tabs-1">General</a></li>
				<?php if($chartType == '0' || $chartType == '1') { ?> <li><a href="#tabs-2">Style</a></li>
				<li><a href="#tabs-3">Legend</a></li>
				<li><a href="#tabs-4">Tool tip</a></li>
				<?php } else { ?>
				<li><a href="#tabs-2">Axes</a></li>
				<li><a href="#tabs-3">Scale</a></li>
				<li><a href="#tabs-4">Legend</a></li>
				<li><a href="#tabs-5">Tool tip</a></li>
				<?php } ?>
			</ul>
			
			<div id="tabs-1">
			
				
				<div class="group-container">
					<div class="group-container-header"><span>&nbsp;&nbsp;Title&nbsp;&nbsp;</span></div>
					<div class="group-container-body">
						<label for="graph_title">title</label><input name="graph_title" id="graph_title" type="text" value="<?php default_value('graph_title'); ?>" />
						<a href="" onmouseover="stm(Tabs['graph_title'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="graph_title_position">title position</label>
						<select name="graph_title_position" id="graph_title_position">
							<?php default_value('graph_title_position'); ?>
						</select>
						<a href="" onmouseover="stm(Tabs['graph_title_position'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div><!--  default bottom -->
					<!--  in php session $settings['graph_title_font_weight'] = "bold"; for title by default -->
					<div class="group-container-body">
						<label for="graph_title_colour">title color</label><input name="graph_title_colour" id="graph_title_colour" type="text" value="<?php default_value('graph_title_colour'); ?>" class="color {hash:true}" />
						<a href="" onmouseover="stm(Tabs['graph_title_colour'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
				</div>
				
				<div class="group-container">
					<div class="group-container-header"><span>&nbsp;&nbsp;Dimensions&nbsp;&nbsp;</span></div>
					<div class="group-container-body">
						<label for="width">width</label><input name="width" id="width" type="text" value="<?php default_value('width'); ?>"/>
						<a href="" onmouseover="stm(Tabs['width'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="height">height</label><input name="height" id="height" type="text" value="<?php default_value('height'); ?>" />
						<a href="" onmouseover="stm(Tabs['height'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<h4>padding
					<a href="" onmouseover="stm(Tabs['graph_padding'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a></h4>
					<div class="group-container-body inline-form">
						<label for="pad_top" class="inline-form-label">top</label>
						<input name="pad_top" id="pad_top" type="text" class="inline-form-control" value="<?php default_value('pad_top'); ?>"/>
					</div>
					<div class="group-container-body inline-form">
						<label for="pad_bottom" class="inline-form-label">bottom</label>
						<input name="pad_bottom" id="pad_bottom" type="text" class="inline-form-control" value="<?php default_value('pad_bottom'); ?>"/>
					</div>
					<div class="group-container-body inline-form">
						<label for="pad_left" class="inline-form-label">left</label>
						<input name="pad_left" id="pad_left" type="text" class="inline-form-control" value="<?php default_value('pad_left'); ?>" />
					</div>
					<div class="group-container-body inline-form">
						<label for="pad_right" class="inline-form-label">right</label>
						<input name="pad_right" id="pad_right" type="text" class="inline-form-control"  value="<?php default_value('pad_right'); ?>" />
					</div>
					<div style="clear: both"></div>
				</div>
				
				<div class="group-container">
					<div class="group-container-header"><span>&nbsp;&nbsp;Colors and borders&nbsp;&nbsp;</span></div>
					<?php if($chartType !== '10' && $chartType !== '9') { ?>
					
					<div class="group-container-body">
						<label for="stroke_colour">border color</label>
						<input name="stroke_colour" id="stroke_colour" type="text" value="<?php default_value('stroke_colour'); ?>" class="color {hash:true}"/>
						<a href="" onmouseover="stm(Tabs['stroke_colour'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="stroke_width">border width</label>
						<input name="stroke_width" id="stroke_width" type="text" value="<?php default_value('stroke_width'); ?>" />
						<a href="" onmouseover="stm(Tabs['stroke_width'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					
					<?php } ?>
					
					<div class="group-container-body">
						<label for="back_colour">background color</label>
						<input name="back_colour" id="back_colour" type="text"  value="<?php default_value('back_colour'); ?>" class="color {hash:true}" />
						<a href="" onmouseover="stm(Tabs['back_colour'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="back_round">rounded corner</label>
						<input name="back_round" id="back_round" type="text"  value="<?php default_value('back_round'); ?>" />
						<a href="" onmouseover="stm(Tabs['back_round'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="back_stroke_width">border width</label>
						<input name="back_stroke_width" id="back_stroke_width" type="text"  value="<?php default_value('back_stroke_width'); ?>" />
						<a href="" onmouseover="stm(Tabs['back_stroke_width'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="back_stroke_colour">border color</label>
						<input name="back_stroke_colour" id="back_stroke_colour" type="text" value="<?php default_value('back_stroke_colour'); ?>" class="color  {hash:true}"/>
						<a href="" onmouseover="stm(Tabs['back_stroke_colour'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
				</div>
			</div>
			<?php if($chartType == '0' || $chartType == '1') { ?>
			<div id="tabs-2">
				<?php 
					if($chartType == '0' || $chartType == '1') require_once 'pie_graph.php';
				?>
			</div>
			<?php }else{ ?>
			<div id="tabs-2">
				<?php require_once 'general_grid_based_axes.php'; ?>
			</div>
			<div id="tabs-3">
				<?php require_once 'general_grid_based_scale.php'; ?>
			</div>
			<?php } ?>
			
			<?php if($chartType == '0' || $chartType == '1') { ?>
			<div id="tabs-3">
			<?php }else{ ?>
			<div id="tabs-4">
			<?php } ?>
				<!-- we assume the legend_entries generated in php code -->
				<div class="group-container">
					<div class="group-container-header"><span>&nbsp;&nbsp;Title&nbsp;&nbsp;</span></div>
					<div class="group-container-body">
						<label for="legend_title">title</label>
						<input name="legend_title" id="legend_title" type="text" value="<?php default_value('legend_title'); ?>"/>
						<a href="" onmouseover="stm(Tabs['legend_title'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<!--  in php session $settings['graph_title_font_weight'] = "bold"; for title by default -->
					<div class="group-container-body">
						<label for="legend_title_colour">title color</label><input name="legend_title_colour" id="legend_title_colour" type="text" value="<?php default_value('legend_title_colour'); ?>" class="color {hash:true}"/>
						<a href="" onmouseover="stm(Tabs['legend_title_colour'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="legend_title_font">font type</label>
						<select name="legend_title_font" id="legend_title_font">
							<?php default_value('legend_title_font'); ?>
						</select>
						<a href="" onmouseover="stm(Tabs['legend_title_font'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="legend_title_font_size">font size</label>
						<input name="legend_title_font_size" id="legend_title_font_size" type="text" value="<?php default_value('legend_title_font_size'); ?>"/>
						<a href="" onmouseover="stm(Tabs['legend_title_font_size'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="legend_title_font_weight">font weight</label>
						<select name="legend_title_font_weight" id="legend_title_font_weight">
							<?php default_value('legend_title_font_weight'); ?>
						</select>
						<a href="" onmouseover="stm(Tabs['legend_title_font_weight'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>			
				</div>
				<div class="group-container">
					<div class="group-container-header"><span>&nbsp;&nbsp;Style&nbsp;&nbsp;</span></div>
					<div class="group-container-body">
						<label for="legend_text_side">text side</label>
						<select name="legend_text_side" id="legend_text_side">
							<?php default_value('legend_text_side'); ?>
						</select>
						<a href="" onmouseover="stm(Tabs['legend_text_side'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="legend_draggable">is draggable</label>
						<select name="legend_draggable" id="legend_draggable">
							<?php default_value('legend_draggable'); ?>
						</select>
						<a href="" onmouseover="stm(Tabs['legend_draggable'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="legend_autohide">auto hide</label>
						<select name="legend_autohide" id="legend_autohide">
							<?php default_value('legend_autohide'); ?>
						</select>
						<a href="" onmouseover="stm(Tabs['legend_autohide'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>

					<div class="group-container-body">
						<label for="legend_position_1" class="inline-label">positon</label>
						<select name="legend_position_1" id="legend_position_1" class="inline-control">
							<?php default_value('legend_position_1'); ?>
						</select>
						<select name="legend_position_2" id="legend_position_2" class="inline-control">
							<?php default_value('legend_position_2'); ?>
						</select>
						<select name="legend_position_3" id="legend_position_3" class="inline-control">
							<?php default_value('legend_position_3'); ?>
						</select>
						<a href="" onmouseover="stm(Tabs['legend_position'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="legend_padding">padding</label>
						<input name="legend_padding" id="legend_padding" type="text" value="<?php default_value('legend_padding'); ?>" />
						<a href="" onmouseover="stm(Tabs['legend_padding'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="legend_entry_width">entry width</label>
						<input name="legend_entry_width" id="legend_entry_width" type="text" value="<?php default_value('legend_entry_width'); ?>"/>
						<a href="" onmouseover="stm(Tabs['legend_entry_width'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="legend_entry_height">entry height</label>
						<input name="legend_entry_height" id="legend_entry_height" type="text" value="<?php default_value('legend_entry_height'); ?>"/>
						<a href="" onmouseover="stm(Tabs['legend_entry_height'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					
					<div class="group-container-body">
						<label for="legend_font">font type</label>
						<select name="legend_font" id="legend_font">
							<?php default_value('legend_font'); ?>
						</select>
						<a href="" onmouseover="stm(Tabs['legend_font'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="legend_font_size">font size</label>
						<input name="legend_font_size" id="legend_font_size" type="text" value="<?php default_value('legend_font_size'); ?>"/>
						<a href="" onmouseover="stm(Tabs['legend_font_size'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="legend_font_weight">font weight</label>
						<select name="legend_font_weight" id="legend_font_weight">
							<?php default_value('legend_font_weight'); ?>
						</select>
						<a href="" onmouseover="stm(Tabs['legend_font_weight'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>

					<div class="group-container-body">
						<label for="legend_colour">font color</label>
						<input name="legend_colour" id="legend_colour" type="text" value="<?php default_value('legend_colour'); ?>" class="color {hash:true}" />
						<a href="" onmouseover="stm(Tabs['legend_colour'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="legend_back_colour">background color</label>
						<input name="legend_back_colour" id="legend_back_colour" type="text" value="<?php default_value('legend_back_colour'); ?>" class="color {hash:true}"/>
						<a href="" onmouseover="stm(Tabs['legend_back_colour'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="legend_round">rounded corner</label>
						<input name="legend_round" id="legend_round" type="text" value="<?php default_value('legend_round'); ?>"/>
						<a href="" onmouseover="stm(Tabs['legend_round'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="legend_stroke_colour">border color</label>
						<input name="legend_stroke_colour" id="legend_stroke_colour" type="text" value="<?php default_value('legend_stroke_colour'); ?>" class="color {hash:true}"/>
						<a href="" onmouseover="stm(Tabs['legend_stroke_colour'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="legend_stroke_width">border width</label>
						<input name="legend_stroke_width" id="legend_stroke_width" type="text" value="<?php default_value('legend_stroke_width'); ?>"/>
						<a href="" onmouseover="stm(Tabs['legend_stroke_width'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="legend_shadow_opacity">shadow opacity</label>
						<select name="legend_shadow_opacity" id="legend_shadow_opacity">
							<?php default_value('legend_shadow_opacity'); ?>
						</select>
						<a href="" onmouseover="stm(Tabs['legend_shadow_opacity'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
				</div>	
				
			</div>
			
			<?php if($chartType == '0' || $chartType == '1') { ?>
			<div id="tabs-4">
			<?php }else{ ?>
			<div id="tabs-5">
			<?php } ?>
				<div class="group-container-body">
					<div style="text-align: center;padding: 5px;">
						<input type="checkbox" style="" name="show_tooltips" id="show_tooltips" <?php default_value('show_tooltips'); ?>/>
						<label for="show_tooltips" style="padding: 0px;margin: 0px;position: relative; top: -2px;left: -3px;margin-right: 15px;">show tool tips</label>
						<a href="" onmouseover="stm(Tabs['show_tooltips'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
				</div>
				<div class="group-container" id="tooltip-properties">
					<div class="group-container-header"><span>&nbsp;&nbsp;Style&nbsp;&nbsp;</span></div>
					
					<div class="group-container-body">
						<label for="tooltip_font">font type</label>
						<select name="tooltip_font" id="tooltip_font">
							<?php default_value('tooltip_font'); ?>
						</select>
						<a href="" onmouseover="stm(Tabs['tooltip_font'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="tooltip_font_size">font size</label>
						<input name="tooltip_font_size" id="tooltip_font_size" type="text" value="<?php default_value('tooltip_font_size'); ?>"/>
						<a href="" onmouseover="stm(Tabs['tooltip_font_size'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="tooltip_font_weight">font weight</label>
						<select name="tooltip_font_weight" id="tooltip_font_weight">
							<?php default_value('tooltip_font_weight'); ?>
						</select>
						<a href="" onmouseover="stm(Tabs['tooltip_font_weight'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>			

					<div class="group-container-body">
						<label for="tooltip_colour">text/border color</label>
						<input name="tooltip_colour" id="tooltip_colour" type="text" value="<?php default_value('tooltip_colour'); ?>" class="color {hash:true}"/>
						<a href="" onmouseover="stm(Tabs['tooltip_colour'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="tooltip_stroke_width">border width</label>
						<input name="tooltip_stroke_width" id="tooltip_stroke_width" value="<?php default_value('tooltip_stroke_width'); ?>"  type="text"/>
						<a href="" onmouseover="stm(Tabs['tooltip_stroke_width'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="tooltip_round">rounded corner</label>
						<input name="tooltip_round" id="tooltip_round" type="text" value="<?php default_value('tooltip_round'); ?>"  />
						<a href="" onmouseover="stm(Tabs['tooltip_round'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="tooltip_back_colour">background color</label>
						<input name="tooltip_back_colour" id="tooltip_back_colour" type="text" value="<?php default_value('tooltip_back_colour'); ?>"  class="color {hash:true}" />
						<a href="" onmouseover="stm(Tabs['tooltip_back_colour'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>

					<div class="group-container-body">
						<label for="tooltip_padding">padding</label>
						<input name="tooltip_padding" id="tooltip_padding" type="text" value="<?php default_value('tooltip_padding'); ?>"/>
						<a href="" onmouseover="stm(Tabs['tooltip_padding'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
					<div class="group-container-body">
						<label for="tooltip_shadow_opacity">shadow opacity</label>
						<select name="tooltip_shadow_opacity" id="tooltip_shadow_opacity">
							<?php default_value('tooltip_shadow_opacity'); ?>
						</select>
						<a href="" onmouseover="stm(Tabs['tooltip_shadow_opacity'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
					</div>
				</div>
			</div>
	   
		</div> <!--End #tabs-->

    		</td>
   			<td width="38" background="images/cright.jpg" style="background-repeat: y">&nbsp;</td>
   		</tr>
   		<tr>
     		<td width="27" height="18">
       		<img border="0" src="images/cdownleft.jpg" width="38" height="37"></td>
   			<td width="425" height="18" background="images/cdown.jpg" style="background-repeat: x">	</td>
  			<td width="38">
       		<img border="0" src="images/cdownright.jpg" width="38" height="37"></td>
   		</tr>
    </table>
    </td>
    </tr>
	<tr>
		<td align="center"><a href="Chart2.php" style="color: #0029a3; text-decoration: none">
		<img src="images/03.jpg" border=0 width="170" height="34"/></a></td>
		<td align="center">
			<button name="continue" id="btn_cont" type="button" class="btn btn-info btn-xs btn-block" style="position: relative;top: -2px;width: 166px;font-size: 15px;font-weight: bold;border-radius: 20px;outline: none">
			Finish</button>
		</td>
	</tr>
	</table>
	<td  align="center" width="48" style="background-repeat: y" valign="top" height="388" background="images/rightadd.jpg">
        <img border="0" src="images/right.jpg"></tr>
	<tr>
	<td width="64" height="12" align="center" background="images/leftadd.jpg" style="background-repeat: y">
      	<td  align="center" width="48" background="images/rightadd.jpg" style="background-repeat: y" valign="top">
    </tr>
	</tr>
	<tr>
		<td align="center" width="64" height="30" style="background-repeat: no-repeat">
        <img border="0" src="images/downleft.jpg" width="64" height="30"><td align="center" width="614" height="30" background="images/down.jpg" style="background-repeat: x">
        <td align="center" width="48" height="30" background="images/downright.jpg" style="background-repeat: no-repeat" >
        <img border="0" src="images/downright.jpg" width="53" height="30"></tr>
		<td height="2"></tr>
  	</table>
</form>
</body>
<script>
	$("#exit").mousedown(function(){
		location.replace("disconnect.php");
	});
</script>
</html>