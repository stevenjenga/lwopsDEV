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
require_once("check.php");
require_once("lib.php");
require_once 'bootstrap_popup.php';
//error_reporting(E_ERROR  | E_PARSE);
$next = "customize.php";

$chartType = $_SESSION["ks_chartType"];

$continue= '';
$left_table = '';
$left_tableY = '';
$left_field = '';
$left_fieldY = '';
$tables_x_axis = '';
$tables_Y_axis = '';
$error = '';
$numericFieldsCount = 0;
   
if(isset($_POST["continue_x"]))
{
  $continue= $_POST["continue_x"];
  $left_table = $_POST['left_table'];  //table of X axis
  $left_tableY = $_POST['left_tableY']; //table in Y axis 
  $left_field = $_POST['left_field']; //column in X axis
  $left_fieldY = $_POST['left_fieldY']; //column in Y axis
  if(isset($_POST['tables_x_axis'])) $tables_x_axis = $_POST['tables_x_axis']; 
  if(isset($_POST['tables_Y_axis'])) $tables_Y_axis = $_POST['tables_Y_axis'];
}

if(isset($_POST['left_table']) && isset($_POST['ajax_x']))
{
  $left_table = $_POST['left_table'];  //table of X axis
  $left_field = $_POST['left_field']; //column in X axis
  print_fields_names('left_field',1);
  exit();
}

if(isset($_POST['left_tableY']) && isset($_POST['ajax_y']))
{
  $left_tableY = $_POST['left_tableY']; //table in Y axis
  $left_fieldY = $_POST['left_fieldY']; //column in Y axis
  print_fields_names('left_fieldY',2);
  exit();
}

if(empty($left_table)){
  foreach($_SESSION["ks_table"] as $key=>$val)
  {
      if($key==0)
      {
      $left_table = $val;
          if(empty($left_tableY)||!isset($left_tableY))
           {     
               $left_tableY = $left_table;
           }
      }
   }

  $result = sql("SHOW COLUMNS FROM `$left_table`");

  $rowC=0;
  while($row=mysql_fetch_row($result))
  {
    if($rowC==0)
    {
      $left_field= $row[0];
      if(empty($left_tableY)||!isset($left_tableY))
      {
        $left_fieldY = $left_field;
      }
    }
    $rowC=1;
  }
}




if(!empty($continue))
{
  if(!empty($tables_x_axis)&&!empty($tables_Y_axis))
  {

    $_SESSION["ks_tables_x_axis"]=$tables_x_axis;
 
    $_SESSION["ks_tables_Y_axis"]=$tables_Y_axis;
     
    header("location: $next");
  }else
  {
      $error = "Please make sure you added at least one sieries in each axis";
  }
}

 

//print tables names in Both X and Y axis for user to select a table 
function print_tables_names($field_name, $type)
{
    if($type==1)
    {
    global $left_table;

    foreach($_SESSION["ks_table"] as $key=>$val)
    {
    if($key==0 && empty($left_table))
    {
      $left_table = $val;
    }

    if(isset($_POST[$field_name]) && $_POST[$field_name] ==$val)
    echo "<option value='$val' selected>$val</option>";
    else
    echo "<option value='$val'>$val</option>";
    }
        }
        else
        {
        global $left_tableY;

            foreach($_SESSION["ks_table"] as $key=>$val)
            {
                if($key==0 && empty($left_tableY))
                {
                $left_table = $val;
                }

                if(isset($_POST[$field_name]) && $_POST[$field_name] ==$val)
                    echo "<option value='$val' selected>$val</option>";
                else
                    echo "<option value='$val'>$val</option>";
            }

        }
}


 
//populate fields in both Axis
function print_fields_names($field_name,$type,$function = "COUNT")
{
    global $left_table, $left_tableY,$numericFieldsCount; 
        
     if($type==1)
     {

       
        //if left field then get fields of left table
        if($field_name=='left_field')
        {
            $req_table = $left_table;
        }

            $result = sql("SHOW COLUMNS FROM `$req_table`");
            while($row=mysql_fetch_row($result))
            {
                if(isset($_POST[$field_name]) && $_POST[$field_name] == $row[0])
                echo "<option value=$row[0] selected>$row[0]</option>";
                else
                echo "<option value=$row[0] >$row[0]</option>";
            }
     }
     else
     {

          
        //if left field then get fields of left table
             $com= 'DESCRIBE `'. $left_tableY . '`';         

             $g= query($com);

        if($field_name=='left_fieldY')
        {
        $req_table = $left_tableY;
        }
           $numericFields = 0;
            while($rows = mysql_fetch_array($g,MYSQL_ASSOC))
            { 
                if($function == "COUNT"){
                     echo "<option value=".$rows["Field"]." >".$rows["Field"]."</option>";
                     $numericFields++;

                }

                else 
                {    
                      $numericFields++;
                      if(isset($_POST[$field_name]) && $_POST[$field_name] == $rows["Field"]){

                          echo "<option value=".$rows["Field"]." selected>".$rows["Field"]."</option>";
                                   }
                     else{

                         echo "<option value=".$rows["Field"]." >".$rows["Field"]."</option>";

                     }
                }



             }
              if($numericFields==0) echo "<option value='None' > No Numeric Fields</option>";        
         } 

}

function print_X_Axies()
{
    global $tables_x_axis;

    if(!isset($_POST['left_table']) && isset($_SESSION['ks_tables_x_axis']))
    {
        $tables_x_axis = $_SESSION['ks_tables_x_axis'];
    }
    if(!isset($_POST['tables_x_axis']))
    {

     @$_SESSION["ks_tables_x_axis"]=$tables_x_axis;
    }
    if(is_array($tables_x_axis))
    {
      foreach($tables_x_axis as $key=>$val)
      {
           $newVal=  str_replace("\\", " ", $val);
          echo "<option value='$newVal'>$newVal</option>";
      }
    }
    
}

function print_Y_Axies()
{
    global $tables_Y_axis;

    if(!isset($_POST['left_tableY']) && isset($_SESSION['ks_tables_Y_axis']))
    {
        $tables_Y_axis = $_SESSION['ks_tables_Y_axis'];
    }
    if(!isset($_POST['tables_Y_axis']))
    {

         @$_SESSION["ks_tables_Y_axis"]=$tables_Y_axis;
     }

     if(is_array($tables_Y_axis))
    {
    foreach($tables_Y_axis as $key=>$val) 
    {
         $newVal=  str_replace("\\", " ", $val);
          echo "<option value='$newVal'>$newVal</option>";
    }
  }
}
// this function to extract tables name from relationships array and extract it in new array
function parse_relation($relationships)
{
  $relArr = array();
  $_relArr = array();
  $lastArray = array();
  $_lastArray = array();
  foreach($relationships as $key => $value) $relArr[] = explode('=', $value);
  foreach($relArr as $key => $value) $_relArr = array_merge($_relArr, $value);
  foreach($_relArr as $key => $value) $lastArray[] = explode('.', $value);
  foreach($lastArray as $key => $value) foreach($value as $k => $v) if($k === 0) $_lastArray[] = trim($v);
  $_lastArray = array_map('strtolower', $_lastArray);
  $_lastArray = array_unique($_lastArray);
  return $_lastArray;
}
if(isset($_SESSION['ks_relationships'])) $tablesOfRels = parse_relation($_SESSION['ks_relationships']);

// ---------------  here's handle DISTINCT without AJAX --------------
// SELECT `COLUMN_NAME` FROM `information_schema`.`COLUMNS` WHERE `TABLE_NAME` = '$tableName' AND (`COLUMN_KEY` = 'PRI' OR `COLUMN_KEY` = 'UNI')
if(isset($_SESSION["ks_table"]))
{
	$arr_of_PRI_UNI = array();
	foreach($_SESSION["ks_table"] as $key => $val)
	{
		$tableName = $val;
		$result = query("SHOW INDEX FROM $tableName where key_name = 'PRIMARY' || non_unique = 0");
		while($row = mysql_fetch_row($result)) $arr_of_PRI_UNI[$tableName][] = $row[4];
	}
	// var_dump( $arr_of_PRI_UNI );
}
// ------------------------------------------------------------

?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252"/>
<title> Axis Options</title>
<?php if($use_old_help_msg === false) { ?>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <?php } ?>
<link href="style.css" rel="stylesheet" type="text/css"/>
<!--
<link rel="stylesheet" media="screen" type="text/css" href="colorpicker.css" />
-->
<script  type="text/javascript"  src="jquery-1.6.3.min.js" type="text/javascript"></script>
 
  <script src="jquery-1.9.1.js"></script>
 <script type="text/javascript" src="jscolor/jscolor.js"></script>
  <script type="text/javascript" src="eye.js"></script> 
    <script type="text/javascript" src="utils.js"></script>
    
  <?php if($use_old_help_msg === false) { ?>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  <?php } ?>
   
<style>
*{-webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
	-moz-box-sizing: border-box;    /* Firefox, other Gecko */
	box-sizing: border-box;  }

#target
{
position: absolute;
top: 4px;
left: 35px;
width:100px;
height:100px;
border: 1px solid #696;
padding: 60px 0;
text-align: center;
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
-webkit-box-shadow: #666 0px 2px 3px;
-moz-box-shadow: #666 0px 2px 3px;
box-shadow: #666 0px 2px 3px;
background: red;
background: -webkit-gradient(linear, 0 0, 0 bottom, from(red), to(yellow));
background: -webkit-linear-gradient(red, yellow);
background: -moz-linear-gradient(red, yellow);
background: -ms-linear-gradient(red, yellow);
background: -o-linear-gradient(red, yellow);
background: linear-gradient(red, yellow);

}
</style>	
<script language="JavaScript" type="text/javascript">

<?php $isset_rels = (isset($_SESSION['ks_relationships'])) ? 'true' : 'false' ;?>
var arr_of_PRI_UNI = new Array();
<?php
	foreach($arr_of_PRI_UNI as $key => $value)
	{
		echo "arr_of_PRI_UNI['$key'] = new Array();\r\n";
		foreach($value as $k => $val) echo "arr_of_PRI_UNI['$key'][$k] = '$val';\r\n";
	}
?>
// alert(arr_of_PRI_UNI['orders'][0]);
if(<?php echo $isset_rels; ?>)
{
  var relationships = <?php echo 'new Array("' . implode('", "', $_SESSION['ks_relationships']) . '")'?>;
  var numberOfRels = relationships.length;
  var tablesOfRels = <?php echo 'new Array("' . implode('", "', $tablesOfRels) . '")'?>;
}
$(document).ready(function(){

  // this to reset to first option when back to it
 $("option:first-child").attr("selected", true);
//intializing colors
if($("#enable_gredient").is(':checked'))
{
$("#colorx").val("#FF0000");
$("#colorx").css("background","#FF0000");
$("#colory").val("#F8FF26");
$("#colory").css("background","#F8FF26");
}

//make sure field is numeric
  $("#Aggregate").click(function(){
        if($(this).val()!= "COUNT"){
            $("#err").text("Please note that this function requires a numeric field");
            
        }
        
        else{
           $("#err").text("");  
        }
                 
    });

//changing color text box
$(".color").change(function(){       
   var colorX = $("#colorx").val();
   var colorY = $("#colory").val();
   var direction = $("#direction").val();      
   adjust_color_preview(direction,colorX,colorY);
});


//gradient enable/disable
$("#enable_gredient").click(function(){
  if($(this).is(':checked'))
  {
    
    set_gradient_direction();
	//show bottom color and gradient direction and preview
    $("#bottom_color").show();
	$(".direction").show();
	$("#target").show();
	
  }
  else
  {    
    disable_gradient();
	//hide bottom color and gradient direction and preview
	$("#bottom_color").hide();
	$(".direction").hide();
	$("#target").hide();
  }
});
$("#direction").click(function(){
    set_gradient_direction();
   var colorX = $("#colorx").val();
   var colorY = $("#colory").val();
   var direction = $(this).val();      
   adjust_color_preview(direction,colorX,colorY);
    
    });
    
  



<?php 
 if($chartType==10){
 
 ?>
 $('[data-display]').each(function(){
  $(this).hide();
 });
disable_gradient();

<?php } ?>

});

function adjust_color_preview (direction, color1, color2)
{
   
 
  //direction  horizontal
  if(direction == "vertical"){
	$("#target").css("background", "-webkit-gradient(linear, 0 0, 0 bottom, from("+ color1 + "), to(" + color2 + "))");
	$("#target").css("background", "-webkit-linear-gradient("+ color1 + ", " + color2 + ")");
	$("#target").css("background", "-moz-linear-gradient("+ color1 + ", " + color2 + ")");
	$("#target").css("background", "-ms-linear-gradient("+ color1 + ", " + color2 + ")");
	$("#target").css("background", "-o-linear-gradient("+ color1 + ", " + color2 + ")");
	$("#target").css("background","linear-gradient("+ color1 + "," + color2 + ")"); 
  }
  else{
  $("#target").css("background", "-webkit-gradient(linear, 0 0, 0 bottom, from("+ color1 + "), to(" + color2 + "))");
	$("#target").css("background", "-webkit-linear-gradient(to right,"+ color1 + ", " + color2 + ")");
	$("#target").css("background", "-moz-linear-gradient(to right,"+ color1 + ", " + color2 + ")");
	$("#target").css("background", "-ms-linear-gradient(to right,"+ color1 + ", " + color2 + ")");
	$("#target").css("background", "-o-linear-gradient(to right,"+ color1 + ", " + color2 + ")");
  $("#target").css("background","linear-gradient(to right,"+ color1 + "," + color2 + ")");
  }

}


function set_gradient_direction()
{
  
   if($("#direction").val()=="vertical")
   {
     $('#display_gradient').text("Top Colour");
	 $("#b_color").text("Bottom Colour");
	 
   }
   else
   {
     $('#display_gradient').text("Left Colour");
	 $('#b_color').text("Right Colour");
     
   }

}

function disable_gradient()
{

  $('#display_gradient').text("Colour");
}
 <?php
  if($chartType!=0 && $chartType!=1 && $chartType!=9)
      {
	  
	  ?>
	  
     $(".color").css('backgroundColor', $(".color").val()); 

     	 
     



$(".color").change(function (hsb, hex, rgb) {
$(".color").css('backgroundColor', '#' + hex);


});
 

<?php } ?>

 


function add_fil() {
$("#tdError").html("");
var left_table = $("#left_table").val();	 
var left_field =  $("#left_field").val();
var groupBy = document.myform.groupBy.checked; 
if(myform.tables_Y_axis.length>0){
 var opt=( "`"+left_table+"`.`"+left_field+"`").toLowerCase();

for (i=0;i<myform.tables_Y_axis.length;i++)
 {
          
var optf = myform.tables_Y_axis.options[i].text.split(',')[0].toLowerCase();
 
             if(opt==optf )
 	{
 	alert('X Axis could not be like Y Axis!');
 	return;
 	}

 } }
 


if( myform.tables_x_axis.length>0)
{
$("#tdError").html("You can add only one X Sieries");  
return false;
}
addOption = new Option( "`"+left_table+"`.`"+left_field+"`,"+groupBy);

numItems = document.myform.tables_x_axis.length;
document.myform.tables_x_axis.options[numItems] = addOption;
         $("#txtLabel").val("");
return true;
}



function add_Y_fil() {
//adding a new Y  sieries


$("#tdYError").html("");
var left_table = $("#left_tableY").val();	 
var left_field =  $("#left_fieldY").val();
var aggregate =  $("#Aggregate").val(); 
var rel = '';

<?php  if($chartType!=0 && $chartType!=1  && $chartType!=9)
      {?>
              //check data type
            
            
                
   var title = $("#title").val(); 
        var colorx =  $("#colorx").val();
         
if($.trim(colorx)=="")
{ 
alert('You must select the series color !');
 	return;
}

if($("#enable_gredient").is(':checked')&&$.trim($("#colory").val())=="")
{
    { 
        alert('Please select the two colours of the colour gradient');
 	return;
     }

}

if($.trim(title)=="")
{ 
alert('Please add a title ');
 	return;
}
<?php } ?>
if( myform.tables_x_axis.length>0)
{
 
var opt=( "`"+left_table+"`.`"+left_field+"`").toLowerCase();
          
 var optf = myform.tables_x_axis.options[0].text.split(',')[0].toLowerCase();
             if(opt==optf )
 	{
 	alert(' the Y axis could not be the same as the X Axis, please select a different field or table');
 	return;
 	} 
}
else
{
 
alert('You need to set the options of the X axis first'); 
return false;
} 

for (i=0;i<myform.tables_Y_axis.length;i++)
 {
            var opt=( "`"+left_table+"`.`"+left_field+"`").toLowerCase();
            var optf = myform.tables_Y_axis.options[i].text.split(',')[0].toLowerCase();
            var aggregatef= myform.tables_Y_axis.options[i].text.split(',')[1].toLowerCase();
             if(opt==optf && aggregate.toLowerCase() == aggregatef )
 	{
 	alert('A sieries with the same properties already exists');
 	return;
 	}

 } 
 
// system to handle relationships gone here ------------------------------------------------
var distinct = 'NOT_DISTINCT';
if(<?php echo $isset_rels; ?>)
{
  if( myform.tables_x_axis.length>0)
  {
    var tableX = myform.tables_x_axis.options[0].text.split(',')[0].toLowerCase().split('.')[0];
    var tableY = ("`"+left_table+"`").toLowerCase();
    if(tableX == tableY){
      rel = '';
      for(var i = 0; i < numberOfRels; i++)
      {
        var break_rels = relationships[i].split('=');
        for(var x = 0; x < break_rels.length; x++) break_rels[x] = break_rels[x].trim().split('.')[0];
        if(break_rels[0] == break_rels[1]) rel += i+'|';
      }
      rel = (rel !== '') ? ','+rel.substring(0, rel.length - 1) : ',';
    }
    else if(tableX != tableY && numberOfRels == 1)
    {
      rel = ',0';
      alert(relationships[0] + "\r\n" + 'this relationship will be used in this series');
    }
    else if(tableX != tableY && numberOfRels > 1)
    {
      rel = '';
      for(var i = 0; i < numberOfRels; i++)
      {
        var break_rels = relationships[i].split('=');
        for(var x = 0; x < break_rels.length; x++)
        {
          break_rels[x] = break_rels[x].trim().split('.')[0];
        }
        if((break_rels[0] == tableX && break_rels[1] == tableY) || (break_rels[0] == tableY && break_rels[1] == tableX))
        {
          rel += i+'|';
          alert(relationships[i] + "\r\n" + 'this relationship will be used in this series');
        }
      }

      

      if(rel == '')
      {
        
        $(".relationshipsForEachItem").each(function(){
          if ($(this).is(":checked"))
          {   
            rel += $(this).val();
            rel += '|';
          }
        });
		
		// here's we handle using DISTINCT or not
		tableName = left_table.trim();
		columnName = left_field.trim();
		
		if($.inArray(columnName, arr_of_PRI_UNI[tableName]) > -1){
			$('#useDistinctContainer').css('display', 'none');
			distinct = "DISTINCT";
		}else{
			$('#useDistinctContainer').css('display', 'block');
			if($("#useDistinct").is(":checked"))
			{
				distinct = $("#useDistinct").val();
			}
		}
		$('#select_rels').show('slow');
		
		
		
        if(rel == '') {
          alert('System couldn\'t determine which relationships to use for this series, So you must use the check boxes and select the right ones');
          return false;
        }
			
      }
	  
      rel = (rel !== '') ? ','+rel.substring(0, rel.length - 1) : ',';

    }

  }
}else{
	rel = ',';
}
		
	rel = ',' + distinct + rel;
// ----------------------------------------------------------------------
 
<?php  if($chartType!=0 && $chartType!=1 && $chartType!=9)
      {?>
              if($("#enable_gredient").is(':checked'))
              {
                  // gradient support
                  var colorY;
                  colorY = $("#colory").val();
                  if(colorY.indexOf("#")===-1) colorY = "#" + colorY;
                  if(colorx.indexOf("#")===-1) colorx = "#" + colorx;
                  //vertical and horizontal gredient
                  if($("#direction").val()=="vertical")
                  addOption = new Option( "`"+left_table+"`.`"+left_field+"`,"+aggregate+',array("'+colorx+'"*"'+colorY+'"*"v"),'+title+rel);
                  else
                  addOption = new Option( "`"+left_table+"`.`"+left_field+"`,"+aggregate+',array("'+colorx+'"*"'+colorY+'"*"h"),'+title+rel);
                  
              }
              else
              {
                    addOption = new Option( "`"+left_table+"`.`"+left_field+"`,"+aggregate+","+colorx+","+title+rel);
                    
              }
              //$(".color").val("");                    
              //$(".color").css('backgroundColor', '' );
              $("#title").val("");
	
<?php } else {?>
addOption = new Option( "`"+left_table+"`.`"+left_field+"`,"+aggregate+rel);
<?php } ?>
numItems = document.myform.tables_Y_axis.length;
document.myform.tables_Y_axis.options[numItems] = addOption;
        $("#txtYLabel").val("");	 

        $('#select_rels').hide('slow');
		$('#useDistinctContainer').hide('slow');
		$('#useDistinct').prop('checked', true);
		$('.relationshipsForEachItem').prop('checked', false);
return true;
}

 function remove_rel()
 {
 	var i=0;
var length = myform.tables_x_axis.options.length;
for (i=length-1;i>=0;i--)
 {
var current = document.myform.tables_x_axis.options[i];
 
 document.myform.tables_x_axis.options[i] = null; 
 }
if(i>0)
{
 document.myform.tables_x_axis.options[i-1].selected=true;
}
 }

function remove_Y_rel()
 {
 	var i=0;
var length = myform.tables_Y_axis.options.length;
for (i=length-1;i>=0;i--)
 {
var current = document.myform.tables_Y_axis.options[i];
if (current.selected)
{
 document.myform.tables_Y_axis.options[i] = null;
}
 }
if(i>0)
{
 document.myform.tables_Y_axis.options[i-1].selected=true;
}
 }
/*
 *select all list items
 */
function select_all()
{
 for (i=0;i<myform.tables_x_axis.length;i++)
 {
myform.tables_x_axis.options[i].selected = true;
 }
       for (i=0;i<myform.tables_Y_axis.length;i++)
 {
myform.tables_Y_axis.options[i].selected = true;
 }
}
//myform.submit();

$(document).ready(function(){
	
  $('#left_table').change(function(){
  
    $('#left_field').empty();
    //alert( $('#myform').serialize() );
    $.ajax({
      url: 'Chart2.php',
      type: 'post',
      data: $('#myform').serialize()+'&ajax_x=',
      success: function(data){
        //$('#left_field').empty();
        $('#left_field').append(data);

        //alert('success'+data);
      },
      error: function(){
        alert('error');
      }
    });
  });

//myform.submit();
  $('#left_tableY').change(function(){
	
    $('#left_fieldY').empty();
    //alert( $('#myform').serialize() );
    $.ajax({
      url: 'Chart2.php',
      type: 'post',
      data: $('#myform').serialize()+'&ajax_y=',
      success: function(data){
        //$('#left_fieldY').empty();
        $('#left_fieldY').append(data);
		
        $('#select_rels').hide('slow');
		$('#useDistinctContainer').css('display', 'none');
		$('.relationshipsForEachItem').prop('checked', false);
      },
      error: function(){
        alert('error');
      }
    });
  });
  
  $('#left_fieldY').change(function(){
	$('#select_rels').hide('slow');
	$('#useDistinctContainer').css('display', 'none');
	$('.relationshipsForEachItem').prop('checked', false);
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
<form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post" name="myform" id="myform">
<table style="width:732px;height:537px;" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr>
<td align="center" style="width:64px; height:20px; background-image:url(images/topleft.jpg); background-repeat: no-repeat" ></td>

      <td align="center" style="width:614px;height:20px;background-image:url(images/top.jpg);background-repeat: x"></td>

      <td align="center" width="48" height="20" background="images/topright.jpg" style="background-repeat: no-repeat"></td>

    </tr>
<tr>
<td align="center" width="64" style="background-repeat: y" valign="top" background="images/leftadd.jpg">

            <img border="0" src="images/left.jpg"/><td rowspan="2" align="center" valign="top" >

<p><img border="0" src="images/01.jpg" width="369" height="71"></p>
<table border="0" width="100%" id="table8" height="333">
<tr>
<td colspan="2" height="18"><b class="step_title">X axis Options  </b>
					<button id="exit" style="position: relative;left: 365px;font-size: 11px;cursor: pointer;" onclick="return false;">Disconnect &amp; Exit</button>
					</td>
</tr>
<tr>
<td colspan="2" height="200" valign="top">
<div align="center">

<table border="0" cellpadding="0" cellspacing="0" width="501" id="table11" height="200">

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
 <table border="0">
                                    <tr >
                                        <td height="20" colspan="5" align="left"  id="tdError" valign="top"  nowrap="nowrap" class="error">
                                        <?php echo $error; ?></td>
                                    </tr>
                                    <tr >
                                      <td width="124" height="24" align="right" valign="top"  nowrap="nowrap"> Table                                        </td>
                                      <td width="73" valign="top"  nowrap="nowrap" ><select name="left_table" id="left_table" >
                                        <?php print_tables_names('left_table',1); ?>
                                      </select></td>
                                      <td height="26" align="right"  nowrap="nowrap">
                                         Field                                      </td>
                                      <td height="26"  nowrap="nowrap">
                                        <select name="left_field" id="left_field"  >
                                          <?php print_fields_names('left_field',1); ?>
                                        </select>                                      </td>
                                      <td width="23" valign="top">  </td>
                                    </tr>	 
<tr>
                                       <td width="124" height="24" align="right" valign="top"  nowrap="nowrap">    Group By
                                                                             </td>
                                      <td width="73" valign="top"  nowrap="nowrap" > 
 <input type="checkbox" checked="checked"  id="groupBy" name="groupBy" />
 </td>
                                      <td height="26" align="right"  nowrap="nowrap">
                                                                                </td>
                                      <td height="26" nowrap="nowrap">
 
                                                                             </td>
                                      <td width="23" align="left" valign="top"> 
 
  </td>
                                    </tr>
 <tr>
                                      <td colspan="5" align="right"><hr/></td>
                                    </tr>
                                   
                                   
                                    
                                    <tr>
                                      <td colspan="5" align="center"><input name="btn_add" type="button" id="btn_add" value="Update" onClick="add_fil();" >
                                      <a href="" onmouseover="stm(tables_relations[2],Style,  this);" onclick="return false;" onmouseout=""></a></td>
                                    </tr>
                                    <tr>
                                      <td colspan="5" align="center">
                                      <select name="tables_x_axis[]" size="3" multiple id="tables_x_axis" style=" height:40;width:450;" >
 <?php print_X_Axies();?>
                                      </select></td>
                                    </tr>
                                    <tr>
                                      <td  colspan="8" align="center"><input name="btn_remove" type="button" id="btn_remove" value=" Remove " onClick="remove_rel();">
                                      <a href="" onmouseover="stm(tables_relations[3],Style,  this);" onclick="return false;" onmouseout=""></a></td>
                                    </tr>
                                    
                                  </table>
         </td>
<td width="38" background="images/cright.jpg" style="background-repeat: y">&nbsp;</td>
</tr>
<tr>
<td width="27" height="18">
<img border="0" src="images/cdownleft.jpg" width="38" height="37"/></td>
<td width="425" height="18" background="images/cdown.jpg" style="background-repeat: x">	</td>
<td width="38">
<img border="0" src="images/cdownright.jpg" width="38" height="37"/></td>
</tr>

 </table>
 </div>

     </td>
</tr>
<tr>
<td colspan="2" height="18"><b class="step_title">Y axis Options ( can include multiple series) </b></td>
</tr>
<tr>
<td colspan="2" height="200" valign="top">
<div align="center">

<table border="0" cellpadding="0" cellspacing="0" width="501" id="table11" height="200">

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
 <table border="0">
                                    <tr >
                                        <td height="20" colspan="8" align="left"  id="tdYError" valign="top"  nowrap="nowrap" class="error"><span id="err"><?php echo $error?></span></td>
                                    </tr>
                                    <tr >
                                      <td width="50" height="24" align="right" valign="top"  nowrap="nowrap"> Table </td>
                                      <td width="50" valign="top"  nowrap="nowrap" ><select name="left_tableY" id="left_tableY">
                                        <?php print_tables_names('left_tableY',2); ?>
                                      </select></td>
									   
                                    

                                       <td width="50" height="26" align="right"  nowrap="nowrap">Function
                                                                             </td>
                                      <td width="50" valign="top"  nowrap="nowrap" > 
<select name="Aggregate" id="Aggregate"  ">
                                          <option value="COUNT" >COUNT</option>
 <option value="SUM" >SUM	</option>	 
 <option value="AVG" >AVG</option>
 <option value="MAX" >MAX</option>
 <option value="MIN" >MIN</option> 	 
  	 
 
                                        </select> 

 </td>
                                      <td width="50" height="26" align="right"  nowrap="nowrap">
                                         Field                                      </td>
                                      <td height="26"  nowrap="nowrap">
                                        <select name="left_fieldY" id="left_fieldY" style="width:95px;" >
                                        <?php print_fields_names('left_fieldY',2); ?>
                                        </select>                                      </td>
										</tr>
<!--Bars Panel **********************************************************************************************-->
										<tr data-display = "bars">
                                     
 
<?php  if($chartType!=0 && $chartType!=1 && $chartType!=9)
      { ?>
	
	 
	  <td width="5" height="26" align="right"  nowrap="nowrap"> <input type="checkbox" name="enable_gredient" value="true" id="enable_gredient" checked></td>
	  <td width="50" height="26" align="left"  nowrap="nowrap">Gradient</td>
	  <td width="50" height="26" align="right"  nowrap="nowrap" class="direction" >Direction</td>
	         <td width="50" valign="top"  nowrap="nowrap" class="direction" > 
<select name="direction" id="direction" >
                                          
 <option value="vertical" >Vertical	</option>	 
 <option value="horizontal" >Horizontal</option>
 
                                        </select> 

 </td>
 <td > <div id="container" style="position:relative;"> <div  id="target">
            preview
        </div>
		</div>
  </td>
 </tr>
 <tr >
                                      <td height="26" align="right"  nowrap="nowrap" >
   <span id="display_gradient">Top Colour</span>
                                                                                </td>
                                      <td width="100" height="26"  nowrap="nowrap">
  <input style="width:50;" type="text" class="color" name="colorx" id="colorx" MyReadOnlyAttr="false">
                                                                             </td>
																			 <tr/>
																			 <tr data-display = "bars" id="bottom_color">
                                  
        <td height="26" align="right"  nowrap="nowrap"><span id="b_color">Bottom Colour </span>
                                                                                </td>
                                      <td width="100" height="26"  nowrap="nowrap">
  <input style="width:50;" type="text" class="color" name="colory" id="colory" MyReadOnlyAttr="false">
                                                                             </td>
                                      <td width="23" align="left" valign="top">  
 
  </td>
                                    </tr>
									
	<!--End of Bars Panel **********************************************************************************************-->
									
<tr>
 <td style="width:50;" height="24" align="right" valign="top"  nowrap="nowrap">    
                                                 Title                            </td>
                                      <td width="150
									  " valign="top"  nowrap="nowrap" > 
 
<input style="width:150;" type="text" name="title" id="title" >
                                      
 </td>
 <?php } ?>
                                      <td height="26" align="right"  nowrap="nowrap">
 
                                                                                </td>
                                      <td height="26"  nowrap="nowrap">
                                       </td>
                                      <td width="23" align="left" valign="top"> 
 
  </td>
</tr>
 <?php if(isset($_SESSION['ks_relationships']) && count($_SESSION['ks_relationships']) > 1) { ?>
<tr id="select_rels" style="display: none;vertical-align: top;">
  <td style="padding-top: 5px;text-decoration: underline;">Relationship:</td>
  <td colspan="5" style="padding-top: 8px;padding-bottom: 8px;">
  <div id="useDistinctContainer" style="display: none;">
	<input type="checkbox" id="useDistinct" value="DISTINCT" checked/><label for="useDistinct">Use Distinct</label>
	<a href="" onmouseover="stm(Chart2[0],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
  </div>
<?php
  for($i = 0; $i < count($_SESSION['ks_relationships']); $i++)
  {
    echo '<br />';
    echo '<input type="checkbox" id="rel_'.$i.'" class="relationshipsForEachItem" value="'.$i.'"/><label for="rel_'.$i.'">'.$_SESSION['ks_relationships'][$i].'</label>';
  }
?>
  </td>
</tr>
<?php } ?>

 
                                   
                                    
                                    
                                    <tr>
                                      <td colspan="8" align="center"><input name="btn_Y_add" type="button" id="btn_Y_add" value="   Add Series   " onClick="add_Y_fil();" >
                                      <a href="" onmouseover="stm(tables_relations[2],Style,  this);" onclick="return false;" onmouseout=""></a></td>
                                    </tr>
                                    <tr>
                                      <td colspan="8" align="center">
                                      
                                      <select name="tables_Y_axis[]" size="3" multiple id="tables_Y_axis" style=" height:100px;width:450px;" >
 <?php print_Y_Axies();?>
                                      
                                      </select></td>
                                    </tr>
                                    <tr>
                                      <td  colspan="8" align="center"><input name="btn_Y_remove" type="button" id="btn_Y_remove" value=" Remove Series " onClick="remove_Y_rel();">
                                      <a href="" onmouseover="stm(tables_relations[3],Style,  this);" onclick="return false;" onmouseout=""></a></td>
                                    </tr>
                                    
                                  </table>
         </td>
<td width="38"  style="background-image:url(images/cright.jpg); background-repeat: y">&nbsp;</td>
</tr>
<tr>
<td width="27" height="18">
<img border="0" src="images/cdownleft.jpg" width="38" height="37" /></td>
<td width="425" height="18" style="background-image: url(images/cdown.jpg); background-repeat: x">	</td>
<td width="38">
<img border="0" src="images/cdownright.jpg" width="38" height="37" /></td>
</tr>

 </table>
 </div>

     </td>
</tr>

<tr>

<td align="center"><a
                  href="Chart1.php" style="color: #0029a3; text-decoration: none"><img
                  src="images/03.jpg" border=0 width="170" height="34"></a></td>
<td align="center">
<input  name="continue" type="image" id="btn_cont"
                  src="images/04.jpg" style=" width:166px; height:34px;" onclick="select_all();" /></td>
</tr>
</table>
<td  align="center" width="48" style="background-repeat: y" valign="top" height="388" background="images/rightadd.jpg">

            <img border="0" src="images/right.jpg"></tr>
<tr>
<td width="64" height="14" align="center" background="images/leftadd.jpg" style="background-repeat: y">
      <td  align="center" width="48" background="images/rightadd.jpg" style="background-repeat: y" valign="top">

    </tr>
<td height="2"></tr>
<tr>
<td align="center" width="64" height="30" style="background-repeat: no-repeat">

            <img border="0" src="images/downleft.jpg" width="64" height="30"><td align="center" width="614" height="30" background="images/down.jpg" style="background-repeat: x">

            <td align="center" width="48" height="30" background="images/downright.jpg" style="background-repeat: no-repeat" >


            <img border="0"   src="images/downright.jpg" width="53" height="30"></tr>
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