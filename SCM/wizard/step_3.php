<?php
/**
 * Smart Chart Maker 
 * @author		StarSoft
 * @copyright	Copyright (c) 2011 - 2014, StarSoft, Inc.
 * @link		http://mysqlreports.com
 * 
 * 
 */
require_once("check.php");
require_once("shared.php");
require_once 'bootstrap_popup.php';
require_once("lib.php");

 
$next = "tables_relations.php";
$error = '';

$continue = (isset($_POST["continue_x"])) ? $_POST["continue_x"] : '';


if(!empty($continue))
{
	$table1 = (isset($_POST["table1"])) ? $_POST["table1"] : '';
    if(!empty($table1))
    {
		if(isset($_SESSION["ks_table"]))
		{
			//there is a change in the tables
			$diff = array_diff($table1, $_SESSION["ks_table"]); 
			if(count($diff) > 0) {
				if(isset($_SESSION['ks_relationships'])) unset($_SESSION['ks_relationships']);
				if(isset($_SESSION["ks_tables_x_axis"])) unset($_SESSION["ks_tables_x_axis"]);
				if(isset($_SESSION["ks_tables_Y_axis"])) unset($_SESSION["ks_tables_Y_axis"]);
			}
			$diff = array_diff($_SESSION["ks_table"], $table1); 
			if(count($diff) > 0) {
				if(isset($_SESSION['ks_relationships'])) unset($_SESSION['ks_relationships']);
				if(isset($_SESSION["ks_tables_x_axis"])) unset($_SESSION["ks_tables_x_axis"]);
				if(isset($_SESSION["ks_tables_Y_axis"])) unset($_SESSION["ks_tables_Y_axis"]);
			}
		}
		
		$_SESSION["ks_table"]=$table1;
		if(count($table1)==1) $next = "tables_filters.php";

		header("location: $next");
			 
    }else{
		$error .= "* please select a table";
    }
}

$mydb = $_SESSION["ks_db"];
$result = sql("show tables from `$mydb`");
while($raw = mysql_fetch_array($result) )
{
    $tables[]= $raw[0];
}

?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Select table</title>
	<?php if($use_old_help_msg === false) { ?>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<?php } ?>
<link href="style.css" rel="stylesheet" type="text/css">

	<script src="jquery-1.9.1.js"></script>
	<?php if($use_old_help_msg === false) { ?>
		<script src="bootstrap/js/bootstrap.min.js"></script>
	<?php } ?>
</head>

<body>
<DIV id="TipLayer" style="visibility:hidden;position:absolute;z-index:1000;top:-100;"></DIV>
<SCRIPT language="JavaScript1.2" src="style.js" type="text/javascript"></SCRIPT>
<?php if($use_old_help_msg === false) { ?>
		<script src="popup_handler.js"></script>  
	<?php } ?>
<center>
<form action="<?php echo($_SERVER['PHP_SELF']);?>" method="post">
<table border="0"  height="467" cellspacing="0" cellpadding="0" width="732">
	<tr>
		<td align="center" width="64" height="20" background="images/topleft.jpg" style="background-repeat: no-repeat" >

      <td align="center" width="614" height="20" background="images/top.jpg" style="background-repeat: x">

      <td align="center" width="48" height="20" background="images/topright.jpg" style="background-repeat: no-repeat">

    </tr>
	<tr>
		<td align="center" width="64" style="background-repeat: y" valign="top" background="images/leftadd.jpg">

            <img border="0" src="images/left.jpg"><td rowspan="2" align="center" valign="top" >

			<p><img border="0" src="images/01.jpg" width="369" height="71"></p>
			<table border="0" width="100%" id="table8" height="333">
				<tr>
					<td colspan="2" height="18"><b class="step_title">Please select table(s)</b>
					<button id="exit" style="position: relative;left: 280px;font-size: 11px;cursor: pointer;" onclick="return false;">Disconnect &amp; Exit</button>
					</td>
				</tr>
				<tr>
					<td colspan="2" height="271" valign="top">
					<div align="center">
						<table border="0" cellpadding="0" cellspacing="0" width="501" id="table11" height="248">
							<tr>
								<td width="27" height="16">
								<img border="0" src="images/ctopleft.jpg" width="38" height="37"></td>
								<td width="425" height="16" background="images/ctop.jpg" style="background-repeat: x">&nbsp;</td>
								<td width="38" height="16">
								<img border="0" src="images/ctopright.jpg" width="38" height="37"></td>
							</tr>
							<tr>
								<td width="27" background="images/cleft.jpg" style="background-repeat: y">&nbsp;</td>
								<td width="425" bgcolor="#F9F9F9" align="center">
								<div align="center">
									<table width="78%" border="0" cellpadding="2"  id="table12" height="89" >
									
									<tr>
												    <td align="center"><?php echo $error; ?> </td>
												</tr>
									
										<tr>
											<td width="86%" valign="top">
											<div align="center">
												<table border="0" width="100%" id="table13">
													<tr>
														<td width="95" class="control_label">Select
														table</td>
														
														
													  <td width="196">
														<a href="" onMouseOver="stm(Step_3_sql[0],Style,  this);" onClick="return false;" onMouseOut=""></a>
														<select name="table1[]" size="<?php echo count($tables);    ?>" multiple style="width: 200 px ; Height: 100px;">



      <?php
		if(isset($tables) && is_array($tables))
		{
			foreach($tables as $val)
			{
				if (isset($_SESSION["ks_table"]) && in_array($val, $_SESSION["ks_table"]))
				{
					echo"<option selected>$val</option>";
				}else
				{
					echo "<option>$val</option>";
				}

			}
		}	
      ?>
													    </select></td>
													  <td width="19"><a href="" onMouseOver="stm(Step_3[0],Style,  this);" onClick="return false;" onMouseOut=""><img src="images/Help.png" border="0" align="absmiddle"></a></td>
													</tr>
												</table>
											</div>
											<font color="#FF0000">** Hold &quot;Ctrl&quot;
											and click to select more than one
											table (Recommended only for Related
											Tables)</font></td>
										</tr>
								  </table>
								</div>
								<p align="left">&nbsp; </td>
								<td width="38" background="images/cright.jpg" style="background-repeat: y">&nbsp;</td>
							</tr>
							<tr>
								<td width="27" height="18">
								<img border="0" src="images/cdownleft.jpg" width="38" height="37"></td>
								<td width="425" height="18" background="images/cdown.jpg" style="background-repeat: x">								</td>
								<td width="38">
								<img border="0" src="images/cdownright.jpg" width="38" height="37"></td>
							</tr>
						</table></div>				  </td>
				</tr>
				<tr>
					<td align="center"><a
                  href="step_2.php" style="color: #0029a3; text-decoration: none"><img
                  src="images/03.jpg" border=0 width="170" height="34"></a></td>
					<td align="center">
					<INPUT name=continue type=image id="btn_cont"
                  src="images/04.jpg" width="166" height="34"></td>
				</tr>
			</table>
			<td  align="center" width="48" style="background-repeat: y" valign="top" height="388" background="images/rightadd.jpg">

            <img border="0" src="images/right.jpg"></tr>
	<tr>
		<td width="64" height="14" align="center" background="images/leftadd.jpg" style="background-repeat: y">
            <td  align="center" width="48" background="images/rightadd.jpg" style="background-repeat: y" valign="top">

    </tr>
	</tr>
	<tr>
		<td align="center" width="64" height="30" style="background-repeat: no-repeat">

            <img border="0" src="images/downleft.jpg" width="64" height="30"><td align="center" width="614" height="30" background="images/down.jpg" style="background-repeat: x">

            <td align="center" width="48" height="30" background="images/downright.jpg" style="background-repeat: no-repeat" >

            <img border="0" src="images/downright.jpg" width="53" height="30"></tr>
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
