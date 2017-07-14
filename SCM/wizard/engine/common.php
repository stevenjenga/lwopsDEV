<?php
/**
* Smart Chart Maker 
* @author		StarSoft
* @copyright	Copyright (c) 2011 - 2014, StarSoft, Inc.
* @link		http://mysql charts.com
* 
* 
*/
require_once("../check.php");
require_once("../shared.php");

//replacing any single qoute with a double qoute 
if(isset($_SESSION["ks_tables_Y_axis"]))
{
	$tempArr = array();
	foreach($_SESSION["ks_tables_Y_axis"] as $v) 
	{
		$v = str_replace("'", '"', $v);
		$v = stripcslashes($v);
		$tempArr[] = $v;
	} 
	$_SESSION["ks_tables_Y_axis"] = $tempArr;
}

//print_array($_SESSION);    
@$chartType = $_SESSION["ks_chartType"];

//creating the generated chart folder
function RecursiveMkdir($path)
{
	if (!file_exists($path))
	{
		RecursiveMkdir(dirname($path));
		mkdir($path, 0755);
	}
}

$GUID = time(); 
$file_name = "ch".$GUID;
$file_name = str_replace(" ","",$file_name);
$folder_name = str_replace(".php","",$file_name);
$chart_path = "../../charts/$folder_name";


RecursiveMkdir($chart_path);

//if(isset($_SESSION["chartsettings"]))
// session_unset("chartsettings");

//regarding the statistical fields
if (isset($_SESSION["ks_tables_x_axis"])&& !empty($_SESSION["ks_tables_x_axis"])&&isset($_SESSION["ks_tables_Y_axis"])&& !empty($_SESSION["ks_tables_Y_axis"]))
{
	//CHANGING THE FIELDS ARRAY
	$flds = $_SESSION["ks_tables_Y_axis"];
	$xfld =  $_SESSION["ks_tables_x_axis"];
	$new_flds = array();  
	$pieces = explode(",", $xfld[0]);
	//  echo "piecies <br/>";
	// print_array($pieces);
	$new_flds[]= $pieces[0]; 
	if( $pieces[1]==true)
	{
		//echo "grouped_by<br/>" ;
		$_SESSION["ks_group_by"]=$pieces[0];
		// print_array($_SESSION["group_by"]);
	}
 
	$_SESSION["ks_fields"]=array();

	foreach($flds as $f)
	{
		$pieces = explode(",", $f); 
		$new_flds[]=$pieces[1]."(".$pieces[0].")";
	}
	$_SESSION["ks_fields"] = $new_flds;
	// echo "new fields array <br/>";
	// print_array($new_flds);
}


//creating the config.php

$date_create = date("Y M D H:i:s");
$title = $_SESSION['cu_graph_title'];
$fp=fopen($chart_path."/config.php","w+");
fwrite($fp,'<?php'."\n");
fwrite($fp,"//$title,$date_create\n");
//intializing the customization array
fwrite($fp,'$'."settings=array();"."\n");

// Keys that we don't want to convert into settings
$arrRemove = array('preview','cu_XPost','cu_preview','XPost');
foreach($_SESSION as $k=>$val)
{ 
	if(!empty($k) &&  !in_array($k, $arrRemove))
	{
		$temp = "$";
		
		if(strstr($k,"cu_"))
		{
			$k = str_replace("cu_", "", $k);
			if($k != "width" && $k != "height") $temp .= "settings['".$k."'] =";
			else $temp .= "$k=";  
		}else if(strstr($k,"ks_")){
			$k = str_replace("ks_", "", $k);
			if($k != "width" && $k != "height") $temp .= "$k=";
			else $temp .= "$k="; 
		}else continue;
		
		$array_kays = array("group_by","table","tables_x_axis","tables_Y_axis","fields","tables_filters","relationships");
		if(empty($val))
		{
		  if(in_array($k,$array_kays )) $temp .= "array()"; 
		  else $temp .= "''";

		}
		elseif($k == "pass")
		{
			$temp .= "'" . encode($val) . "'";  
		}
		elseif(is_array($val) && $k== "tables_Y_axis" )
		{
		 $temp .= "array(";
		 $Colo = "$";
		 if($chartType!=0 && $chartType!=1 && $chartType!=9)
			{
			  if(!strstr($Colo,"array"))
			  $Colo .= "color=array(";
		   //   echo "$Colo <br/>";
			}
			 $countColo=0;
			 foreach($val as $v)
			 { 
				 
				  $temp .= "'$v',";
							 
								//Not charts like pie, 3d pie or scattered 
							   if($chartType!=0 && $chartType!=1 && $chartType!=9)
							  {
								if($countColo == 0 ||( $countColo != 0 && $chartType!=2 && $chartType!=3&& $chartType!=6 && $chartType!=9))
								{
									 // allow multi siereies
									   //echo "<br/>loop: $v";
										$fcolo= explode(",", $v); 
										//print_r($fcolo);
										 //field title
										$title=str_replace("'" ,"",$fcolo[3]);
										//field color
										$fclr=str_replace("'" ,"",$fcolo[2]);
										//case of gradient
										$fclr=str_replace("*" ,",",$fcolo[2]);
										$mapkey[]= $title;
										
										if(strstr($fclr,"array"))
										//case of gradient
												
										$Colo .= "$fclr,";
									   
									   // case of one color
										else
										$Colo .= "'$fclr',"; 
										
										
									   // echo "loop added $Colo <br/>";
								}				
							  }
							  $countColo =$countColo+1;
			 }
			 
			$temp .= ")" ;
			//removing last comma
			$temp = str_replace(",)" ,")",$temp);
				 if($chartType!=0 && $chartType!=1 && $chartType!=9)
							  {
				$Colo .= ")" ;
				$Colo = str_replace(",)" ,")",$Colo);
			 //   echo "$Colo <br/>";
				$temp .=";\n".$Colo.";\n";
				}
				else
				{
				 $temp .=";\n";
				}
				
				//writting legend
		if(!empty($mapkey)){
					$temp .= '$'."settings['"."legend_entries'"."] = array(";
					$titles = "";
					foreach($mapkey as $v)
					{

						$titles .= "'". $v . "'," ;
					}
					$titles .= ")";
					$titles = str_replace(",)", ")",$titles );
					$temp .= $titles;// . ";\n";
				}
				
		}
		elseif(is_array($val) )
		{
		   $temp .= "array(";
			 foreach($val as $v)
			 {

				  if(is_array($v))
				  {
					$temp .= "array(";
					foreach($v as $v1)
					{
					  $temp .= "'$v1',";
					}
					$temp .= "),";
					//removin last comma
					$temp = str_replace(",)",")",$temp);
				  }
				  else
				  {
					
					 $temp .= "'$v',";
				  }
			 }
			$temp .= ")" ;
			//removing last comma
			$temp = str_replace(",)" ,")",$temp);


		}
	  
		else
		{
		  if(is_numeric($val) || $val == "true" || $val == "false") $temp .= $val ;
		  else
		  $temp .= "'$val'" ;
		}

		
	   

		$temp .= ";\n";
		
		//$temp .= '//------------------------------------------------------------------------------------------'."\n";
		
		fwrite($fp,$temp);
	}
}
fwrite($fp,'?>');
fclose($fp);

copy("lib.php",$chart_path."/lib.php");


//move images
copy("tri.gif",$chart_path."/tri.gif");

copy("01.jpg",$chart_path."/01.jpg");
copy("tridown.gif",$chart_path."/tridown.gif");
copy("trileft.gif",$chart_path."/trileft.gif");

@copy("bg_table.gif",$chart_path."/bg_table.gif");

copy_directory("../SVGGraph",$chart_path."/SVGGraph"); 
copy("../Default.php","$chart_path/Default.php");
$myFile = "../htchart.html";
copy("../htchart.html","$chart_path/index.html");
$fh = fopen($myFile, 'r');
$theData = fread($fh, filesize($myFile));

fclose($fh);
$theData=str_replace("{Title}",$title ,$theData);
$theData=str_replace("{Description}",$description ,$theData);
$theData=str_replace("{URL}", str_replace("wizard/engine/common.php","charts/ch$title/",curPageURL()) ,$theData);
$theData=str_replace("{IMG}",str_replace("wizard/engine/common.php","charts/ch$title/",curPageURL())."01.jpg" ,$theData);
$theData=str_replace("{Host}",$_SERVER["SERVER_NAME"] ,$theData); 
$theData=str_replace("{Width}",$_SESSION["cu_width"] ,$theData); 
$theData=str_replace("{Height}",$_SESSION["cu_height"] ,$theData);
//$theData=str_replace("{mapkey}",$mapkey ,$theData);

$myFile = "$chart_path/index.html";
$fh = fopen($myFile, 'w') or die("can't open file");  
fwrite($fh, $theData);
fclose($fh); 

unset($_SESSION);
session_destroy();
//redirection to the chart folder
header("location: $chart_path/");


function curPageURL() {
$pageURL = 'http';
if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
$pageURL .= "://";
if ($_SERVER["SERVER_PORT"] != "80") {
$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
} else {
$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
}
return strtolower($pageURL);
}



function copy_directory( $source, $destination ) {
if (is_dir( $source )) {
	@mkdir( $destination );
	$directory = dir( $source );
	while ( FALSE !== ( $readdirectory = $directory->read() ) ) {
		if ( $readdirectory == '.' || $readdirectory == '..' ) {
			continue;
		}
		$PathDir = $source . '/' . $readdirectory; 
		if ( is_dir( $PathDir ) ) {
			copy_directory( $PathDir, $destination . '/' . $readdirectory );
			continue;
		}
		copy( $PathDir, $destination . '/' . $readdirectory );
	}

	$directory->close();
}else { 
	copy( $source, $destination );
}
}




?>
