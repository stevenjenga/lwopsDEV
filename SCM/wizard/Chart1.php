<?php
/**
 * Smart Chart Maker 
 * @author		StarSoft
 * @copyright	Copyright (c) 2011 - 2014, StarSoft, Inc.
 * @link		http://mysqlreports.com 
 */
require_once 'check.php';
require_once 'bootstrap_popup.php';

$next = "Chart2.php";

// to remove all session items of key with prefix cu_***
if(isset($_SESSION["ks_chartType"]) && isset($_POST["Chart"]) && $_SESSION["ks_chartType"] !== $_POST["Chart"])
{
	if(isset($_SESSION['cu_preview']))
	{
		if(isset($_SESSION["cu_XPost"]))
		{
			foreach($_SESSION["cu_XPost"] as $k => $v) unset($_SESSION["cu_".$k]);
			unset($_SESSION["cu_XPost"]);
		}
		if(isset($_SESSION['cu_legend_position'])) unset($_SESSION["cu_legend_position"]);
		if(isset($_SESSION['cu_graph_title_font_weight'])) unset($_SESSION["cu_graph_title_font_weight"]);

		unset($_SESSION['cu_preview']);
	}
}

$continue = '';
if(isset($_POST["continue_x"])) $continue= $_POST["continue_x"];
 
if(!empty($continue) && $continue != '' && isset($_POST["Chart"]))
{ 
	$chartType= $_POST["Chart"];
    if(is_numeric($chartType) && intval($chartType) < 11) $_SESSION["ks_chartType"]=$chartType; 
	header("location: $next"); 
}
 

function get_default_value()
{	
	if(isset($_SESSION["ks_chartType"])) return $_SESSION["ks_chartType"];
	else if(isset($_POST['Chart'])) return $_POST['Chart'];
	else return '5';
}
  
?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252"/>
<title>Select Chart Type</title>
<?php if($use_old_help_msg === false) { ?>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<?php } ?>
<link href="style.css" rel="stylesheet" type="text/css"/>

	<script src="jquery-1.9.1.js"></script>
	<?php if($use_old_help_msg === false) { ?>
		<script src="bootstrap/js/bootstrap.min.js"></script>
	<?php } ?>
	<script>
	$(document).ready(function(){
		
		$('input:radio').each(function(){
			if($(this).val() != <?php echo get_default_value(); ?>) 
			{
				$(this).prop('checked', false);
			}else{
				$(this).prop('checked', true);
			}
		});
	});
	</script>
</head>

<body>

<div id="TipLayer" style="visibility:hidden;position:absolute;z-index:1000;top:-100;"></div>
<script language="JavaScript1.2" src="style.js" type="text/javascript"></script>
<?php if($use_old_help_msg === false) { ?>
		<script src="popup_handler.js"></script>  
	<?php } ?> 
<center>
<form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post" name="myform">
<table width="732"  height="537" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td align="center" width="64" height="20" background="images/topleft.jpg" style="background-repeat: no-repeat" >
		</td>
      <td align="center" width="614" height="20" background="images/top.jpg" style="background-repeat: x">
	  </td>
      <td align="center"   height="20" background="images/topright.jpg" style="width:45px; background-position:-6px 0.9px; background-repeat: no-repeat;">
	  </td>

    </tr>
	<tr>
		<td align="center" width="64" style="background-repeat: y" valign="top" background="images/leftadd.jpg">

            <img border="0" src="images/left.jpg"><td rowspan="2" align="center" valign="top" >

			<p><img border="0" src="images/01.jpg" width="369" height="71"></p>
			<table border="0" width="100%" id="table8" height="333">
				<tr>
					<td colspan="2" height="18"><b class="step_title">Select Chart Type</b>
					<button id="exit" style="position: relative;left: 305px;font-size: 11px;cursor: pointer;" onclick="return false;">Disconnect &amp; Exit</button>
					</td>
				</tr>
				<tr>
					<td colspan="2" height="271" valign="top">
					<div align="center">

						<table border="0" cellpadding="0" cellspacing="0" width="501" id="table11" height="350">

							<tr>
								<td width="27" height="16">
								<img border="0" src="images/ctopleft.jpg" width="38" height="37"></td>
								<td width="425" height="16" background="images/ctop.jpg" style="background-repeat: x">&nbsp;</td>
								<td width="38" height="16">
								<img border="0" src="images/ctopright.jpg" width="38" height="37"></td>
							</tr>
							<tr>
								<td width="27" background="images/cleft.jpg" style="background-repeat: y">&nbsp;</td>
								<td width="425" align="center" valign="top" bgcolor="#F9F9F9">
								  <table border="0" width="100%">
								  
								  <tr >
								         <td  ><input type="radio" id="GroupedBarGraph"   name="Chart" value="5" /> <label for="GroupedBarGraph" > Bar Graphs</label></td>
                                         <td style="height:20px;" ><input type="radio" id="MultiLineGraph" value="10"   name="Chart" /> <label for="MultiLineGraph" >Line Graphs</label>  </td>
                                        
                                                                         
                                     
                                    </tr> 
									
									<tr >
                                       
                                      
									  
									  <td>
                                     <label for="GroupedBarGraph" >
									   <img border="0" src="images/GroupedBarGraph.png" style="width: 100px; height: 100px;"/>
									  </label>			   </td> 
									  
                                       
                                      <td  > 
                                      <label for="MultiLineGraph" >  <img border="0" src="images/2.png" style="width: 100px; height: 100px;"/> </label>
                                       </td>
                                     </td>
                                    </tr> 
									
									
								   
                                    <tr >
									
                                     
                                    
                                     
									   <td style="height:20px;" ><input type="radio" value="3"  id="Bar3DGraph"   name="Chart" /> <label for="Bar3DGraph" >3D bar Graphs</label>  </td>
									   <td style="height:20px;" ><input type="radio" value="4"  id="StackedBarGraph"   name="Chart" /> <label for="StackedBarGraph" >Stacked Bar Graphs</label>  </td>
                                    
                                    </tr> 
									<tr >
                                       
                                     
                                      
									   <td  > 
									   <label for="Bar3DGraph" >
									 <img border="0" src="images/bar-chart-icon.png" style="width: 100px; height: 100px;"/>
                                     </label>
                                       
                                     </td>
									 <td>
                                       <label for="StackedBarGraph" >
									   <img border="0" src="images/StackedBarGraph.jpg"  style="width: 100px; height: 100px;"/>
                                    </label>
									</td>
                                    </tr> 
									
									
                                     <tr >
                                       
                                      <td style="height:20px;" ><input type="radio" id="HorizontalBarGraph" value="6"   name="Chart" /> <label for="HorizontalBarGraph" >Horizontal Bar Graphs</label>  </td>
                                    
                                         
                                      <td style="height:20px;" ><input type="radio" id="HorizontalStackedBarGraph" value="7"   name="Chart" /> <label for="HorizontalStackedBarGraph" >Horizontal Stacked Bar Graphs</label>  </td>
                                    
                                       
                                    </tr> 
									 <tr >
                                       
                                      <td > 
                                       <label for="HorizontalBarGraph" >  <img border="0" src="images/5.png" style="width: 100px; height: 100px;"/> </label> </td>
									  <td>
                                       <label for="HorizontalStackedBarGraph" >  <img border="0" src="images/6.png" style="width: 100px; height: 100px;"/> </label> </td>
                                    </tr> 
                                     <tr >
                                       
                                      <td style="height:20px;" ><input type="radio" id="HorizontalGroupedBarGraph" value="8"   name="Chart" /> <label for="HorizontalGroupedBarGraph" >Grouped Bar Graphs</label>  </td>
                                    
                                         
                                    <td style="height:20px;" ><input type="radio" id="LineChart" value="9"   name="Chart" /> <label for="LineChart" >Scattered Graphs</label>  </td>
                                     
                                       
                                    </tr> 
									 <tr >
                                       
                                      <td > 
                                       <label for="HorizontalGroupedBarGraph" >  <img border="0" src="images/7.png" style="width: 100px; height: 100px;"/> </label> </td>
									   <td > 
                                       <label for="LineChart" >  <img border="0" src="images/1.png" style="width: 100px; height: 100px;"/> </label> </td>
									 </tr> 
									  
									
									<tr >
                                       
                                     
                                      <td style="height:20px;" ><input type="radio" value="0" 
                                         id="PieChart" name="Chart" /> <label for="PieChart" >Pie Graphs</label>  </td>
                                         <td style="height:20px;" ><input type="radio" value="1"     id="Pie3DGraph" name="Chart" /> <label for="Pie3DGraph" >3D Pie Graphs</label>  </td>
                                   
                                      
                                    </tr> 
									<tr >
                                       
                                     
                                      <td  ><label for="PieChart" > <img border="0" src="images/pie_chart_2d.png"  style="width: 150px; height: 120px;"/></label> 
									   </td> 
									   <td  > 
									   <label for="Pie3DGraph" >
									   <img border="0" src="images/pie_chart_3d.png"  style="width: 100px; height: 100px;"/>
                                       </label>
                                        </td>
                                    
                                       
                                     </td>
                                    </tr> 
                                      
									 
                                  </table>
						           </td>
								<td width="38" background="images/cright.jpg" style="background-repeat: y">&nbsp;</td>
							</tr>
							<tr>
								<td width="27" height="18">
								<img border="0" src="images/cdownleft.jpg" width="38" height="37"/></td>
								<td width="425" height="18" background="images/cdown.jpg" style="background-repeat: x">								</td>
								<td width="38">
								<img border="0" src="images/cdownright.jpg" width="38" height="37"></td>
							</tr>

					  </table>
					  </div>

			      </td>
				</tr>
				<tr>

					<td align="center">
                    	
                    <a <?php
				  
						  	echo "href='tables_filters.php'";
						?> style="color: #0029a3; text-decoration: none"><img
                  src="images/03.jpg" border=0 width="170" height="34"/></a></td>
					<td align="center">
					<INPUT name=continue type=image id="btn_cont"
                  src="images/04.jpg" width="166" height="34" onClick="select_all();"></td>
				</tr>
			</table>
			<td  align="center"   style="background-repeat: y; background-position:47px  bottom;width:45px;" valign="top" height="388" background="images/rightadd.jpg">

            <img border="0" src="images/right.jpg" width="45"></tr>
	<tr>
		<td width="64" height="14" align="center" background="images/leftadd.jpg" style="background-repeat: y">
      <td  align="center"   background="images/rightadd.jpg" style="background-repeat: y; background-position:47px  bottom;width:45px;" valign="top">

    </tr>
	 
	<tr>
		<td align="center" width="64" height="30" background="images/downleft.jpg" style="background-repeat: no-repeat;background-position:left top"></td>

             <td align="center" width="614" height="30" background="images/down.jpg" style="background-repeat: x">

            <td align="center"   height="30" background="images/downright.jpg" style=" background-repeat: no-repeat;width:45px; background-position:right top;" >
</tr>
	 
  </table>
</form>
</body>

<script>
	$("#exit").mousedown(function(){
		location.replace("disconnect.php");
	});
</script>
</html>

