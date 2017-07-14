<?php
//code below is simplified - in real app you will want to have some kins session based autorization and input value checking
error_reporting(E_ALL ^ E_NOTICE);

//include db connection settings
require_once('../../common/config.php');
require_once('../../common/config_dp.php');
global $con;

print_r($_REQUEST);

function checkRowExist(){
global $con;

$sql= "select * from samples_grid where gr_id='".$_GET['gr_id']."' ";

   $result= $con->query($sql);

  return  $result->num_rows;

$con->close();

}


function get_row(){
global $con;

$sql= "select * from samples_grid where gr_id='".$_GET['gr_id']."' ";

   $result= $con->query($sql);

  return  $row = $result->fetch_assoc();
  $con->close();

}




function add_row(){
	global $con,$newId;

	// echo $newId;

	// die;

	$sql = "INSERT INTO samples_grid(sales,title,author,price,instore,shipping,bestseller,gr_id)
			VALUES ('".$_GET["c0"]."','".addslashes($_GET["c1"])."','".addslashes($_GET["c2"])."','".$_GET["c3"]."','".$_GET["c4"]."','".$_GET["c5"]."','".$_GET["c6"]."','".$_GET['gr_id']."')";
	$con->query($sql);
	//set value to use in response
	$newIdDb = $con->insert_id;
	return array('inserted',$newId,$newIdDb);
}

function update_row(){


	global $con;
	$grid= $_GET["gr_id"];
	$sql = 	"UPDATE samples_grid SET  sales='".$_GET["c0"]."',
				title=		'".addslashes($_GET["c1"])."',
				author=		'".addslashes($_GET["c2"])."',
				price=		'".$_GET["c3"]."',
				instore=	'".$_GET["c4"]."',
				shipping=	'".$_GET["c5"]."',
				bestseller=	'".$_GET["c6"]."'
			WHERE gr_id='$grid' ";

			echo $sql;
	
	$con->query($sql);
		$data= get_row();
	$newId= $data["gr_id"];
	$newIdDb= $data["id"];
	return array('updated',$newId,$newIdDb);
}

function delete_row(){
	global $con;
	$grid= $_GET["gr_id"];
	$d_sql = "DELETE FROM samples_grid WHERE gr_id='$grid' ";
	$resDel = $con->query($d_sql);
	return "delete";	
}


//include XML Header (as response will be in xml format)
header("Content-type: text/xml");
//encoding may differ in your case
echo('<?xml version="1.0" encoding="iso-8859-1"?>'); 


$mode = $_GET["!nativeeditor_status"]; //get request mode
$rowId = $_GET["gr_id"]; //id or row which was updated 
$newId = $_GET["gr_id"]; //will be used for insert operation

if(checkRowExist() > 0)
{
	$action = update_row();

}else
{

$action = add_row();

}

/*switch($mode=checkRowExist()){
	case "inserted":
		//row adding request
		$action = add_row();
	break;
	case "deleted":
		//row deleting request
		$action = delete_row();
	break;
	default:
		//row updating request
		$action = update_row();
	break;
}*/


//output update results
echo "<data>";
echo "<action type='".$action[0]."' sid='".$action[1]."' tid='".$action[2]."'/>";
echo "</data>";

?>