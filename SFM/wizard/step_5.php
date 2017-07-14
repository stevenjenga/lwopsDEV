<?php
/**
 *   PHP MYSQL Form Maker 
 *   version 3.1.0
 *   All copyrights are preserved to StarSoft
 */
define("DIRECTACESS", "true");
 require_once("check.php");

require_once '../shared.php';
require_once("lib.php");



@$continue= $_POST["continue_x"];
$layouts = array('Columner','Justified','Tabular','master_details','Mobile');


$table_detail = isset($_SESSION['sfm_f314_details_table']) ? $_SESSION['sfm_f314_details_table'] : '';
$column_detail = isset($_SESSION['sfm_f314_details_column']) ? $_SESSION['sfm_f314_details_column'] : '';

if(isset($_POST['style_name'])) {

	$style_name = $_POST['style_name'];
	if(!empty($style_name)) $_SESSION['sfm_f314_style_name'] = $style_name;
}


if(!isset ($_SESSION["sfm_f314_layout"]))
    $_SESSION["sfm_f314_layout"] = $layouts[0];
 if(!empty($continue))
 {
   $_SESSION["sfm_f314_layout"] = $_POST["layout"];
   if($_SESSION["sfm_f314_layout"] == 'master_details')
       header("location: details_form_step.php");
   else
   {
       unset ($_SESSION['details_table']);
       unset ($_SESSION['details_column']);
       header("location: step_7.php");
   }
 }
 
 function print_styles_names()

{

	global $style_name;

	$style_name = get_default_value('style_name');

	

	$d = dir("styles");

	$i=0;

	

	while (false != ($entry = $d->read())) {

		if($entry!="."  & $entry!="..")

		{

			$formatted_css_name = substr( $entry,0,strlen($entry)-4) ;

			if($i==0 &&empty($style_name))

			{

				$style_name  = $formatted_css_name;

			}

		

			if($style_name == $formatted_css_name)

	   				echo "<option selected>" . $formatted_css_name. "</option>";			

			else	

	   				echo "<option>" . $formatted_css_name. "</option>";

					

			$i++;

		}

	}

	$d->close();	

}

//get default value for each form field

function get_default_value($var)
{		

		//echo "var name is" . $var;

		//echo "session is " . $_SESSION[$var];
                    if($var == 'style_name') $s_var = 'sfm_f314_style_name';
		if(!empty($_POST[$var]))

		{

			return $_POST[$var];

		}

		else if(!empty($_SESSION[$s_var]))

		{

			return $_SESSION[$s_var];

		}
                else if($var == 'style_name')
                    return 'blue';

}

?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Form Layout</title>
<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">
    #select_options{
       
        float: left;
    }
    #select_options div
    {
        margin: 0px;
        text-align: left;
        padding:10px;
    }
</style><SCRIPT language="JavaScript1.2" src="main.js" type="text/javascript"></SCRIPT>  
<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('.layout').click(function(){
        
            $('#layout_preview').attr('src', 'images/'+$(this).val()+'.png');
            if($(this).val() == 'master_details')
            {  
                $('#btnSave_Rel').removeAttr('disabled');
                    $('#pop_layout2').show();
                    //$('#pop_div2').css('margin-top','-200px');
                    $('#pop_container').fadeIn('medium', function(){
                                 // $('#pop_div2').animate({'margin-top':'150px'}, '300');
                     });
            }
        });   
        
           $('#btnCancel_Rel').click(function(){
                    //$('#pop_div,#pop_div2').animate({'margin-top':'-250px'}, '300',function(){
                                $('#pop_container').fadeOut();
                                $('#pop_layout,#pop_layout2').fadeOut();
                  //  });
                 });
            
            $('#select_table').change(function(){
                $('#select_text').empty();
                $.post('step_5_ajax.php', {'get_columns':$(this).val()}, function(data){
                    data = eval(data);
                    $.each(data, function(index,val){
                         $('#select_text').append('<option value="'+val+'">'+val+'</option>');
                    });
                });
            });
            
            
            
         if($('#select_table').val() !== '0') $('#select_table').trigger('change');
            
       $('#btnSave_Rel').click(function(e){
               $(this).attr('disabled',true);
               if($('#select_table').val() == '0')
               {
                   $.post('step_5_ajax.php', {'remove_details':'true'},function(){
                       $('#btnCancel_Rel').click();
                   });
               }
               else
               {
                    var table = $('#select_table').val();
                    var field = $('#select_text').val();
                    var pri = $('#select_table').children('option[value="'+table+'"]').attr('pri');
                  
                    $.post('step_5_ajax.php', {'table':table,'field':field,'pri':pri}, function(data){
                    if(data == 'true')
                    {

                        $('#btnCancel_Rel').click();
                    }
                    else
                        alert('Error ocuured! try again...!')
                });
               }
           });  
    });
</script>


<style type="text/css">
    .tbl_alias
    {
        font-size: 11px;
        border:1px solid #e3e3e3;
        border-collapse: collapse;
        text-align: center;
    }
    .tbl_alias tbody tr  td{border: 1px solid #e3e3e3;}
    .tbl_alias tbody tr th,.tbl_alias tbody tr td{padding: 3px;}
    .tbl_alias thead tr.header{background: #FDC643; height: 31px;}
    .tbl_alias tbody tr:hover{
        background: #e3e3e3;
    }
    #pop_close,#pop_close2
    {
        display: block;
        width: 25px;
        height: 25px;
        background: url(images/popup-close.png) no-repeat 0px -28px;
        position: relative;
        top: -14px;
        left: 365px;
    }
    #pop_close,#pop_close2:hover
    {
        background: url(images/popup-close.png) no-repeat;
    }
    #pop_container{display: none;margin:0px;top:0px; left: 0px; right: 0px; bottom: 0px; 
                   position:  absolute;height: 100%; 
                   background: url(images/bg_opacity.png);
				   z-index: 1;
                   width: 105%; height: 105%;}
 
</style>

</head>

<body>

     <div id="pop_container"></div>
      <div id="pop_layout2" style="display: none; position: absolute; width: 100%; height: 100%; margin: -9px; text-align: center;z-index: 2;">
     
     <div id="pop_div2" style="width: 400px; background: #e3e3e3; margin: 150px auto; border-radius:5px;">
         <a  id="pop_close2"></a>
         <div style=" padding: 10px;">
             <table style="width:100%;" class="tbl_alias">
                 <thead>
                      <tr class="header"> 
                         <th>Details form data source<a href="" onMouseOver="stm(Step_5[1],Style);" onClick="return false;" onMouseOut="htm()"> <img src="images/Help.png" border="0"></a></th>
                         <th>Foreign Key <a href="" onMouseOver="stm(Step_5[2],Style);" onClick="return false;" onMouseOut="htm()"> <img src="images/Help.png" border="0"></a></th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
                         <td>
                            <select to_select="<?php echo $table_detail; ?>" style="width: 100px;" id="select_table">
                                <option value="0">Select Table</option>
                                <?php 
                                    $tables = $dbHandler->query('show tables');
                                    
                                    foreach($tables as $key => $table)
                                    {
                                        $table = $table[0];
                                        $columns = $dbHandler->query("show columns from `$table`", 'ASSOC');
                                        $has_pri = FALSE;
                                        $pri = '';
                                        foreach($columns as $key => $column)
                                        {
                                            if($column['Key'] == 'PRI')
                                            {
                                                $has_pri = TRUE; 
                                                $pri =  $column['Field'];
                                                break;
                                                
                                           }
                                        }
                                        IF($has_pri)
                                            echo '<option pri="'.$pri.'" value="'.$table.'">'.$table.'</option>';
                                    }
                                ?>
                            </select>
                             
                         </td>
                         <td><select to_select="<?php echo $column_detail; ?>" style="width: 100px;" id="select_text"></select></td>
                     </tr>
                 </tbody>
             </table>
             <hr/>
             <div style="text-align: right;">
                 <input type="button" id="btnCancel_Rel" value="Cancel"  />
                 <input type="button" id="btnSave_Rel" value="Save" />
             </div>
         </div>
     </div>
 </div>
    
<DIV id="TipLayer" style="visibility:hidden;position:absolute;z-index:1000;top:-100;"></DIV>
<SCRIPT language="JavaScript1.2" src="style.js" type="text/javascript"></SCRIPT>           
<center>
<form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post">
<table border="0"  height="494" cellspacing="0" cellpadding="0" width="732">
	<tr>
		<td align="center" width="64" height="20" background="images/topleft.jpg" style="background-repeat: no-repeat" >
           
      <td align="center" width="614" height="20" background="images/top.jpg" style="background-repeat: x">
           
      <td align="center" width="48" height="20" background="images/topright.jpg" style="background-repeat: no-repeat">
           
    </tr>
	<tr>
		<td align="center" width="64" style="background-repeat: y" valign="top" background="images/leftadd.jpg">
           
            <img border="0" src="images/left.jpg"><td rowspan="2" align="center" valign="top" >
           
			<p><img border="0" src="images/logo.png" width="369" height="71"></p>
			<table width="100%" height="333" border="0" align="center" id="table8">
				<tr>
					<td height="18" colspan="2" class="step_title">Please select the form layout
					<button id="exit" style="position: relative;left: 215px;font-size: 11px;cursor: pointer;" onclick="return false;">Disconnect &amp; Exit</button></td>
				</tr>
				<tr>
					<td colspan="2" height="271" valign="top">					  <table width="501" height="311" border="0" align="center" cellpadding="0" cellspacing="0" id="table11">
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
					        <table width="394" border="0" align="center" id="table12">
                                                              <div id="select_options">
                                                                  <?php foreach ($layouts as $layout) {?>
                                                                  <div><label><input class="layout" name="layout" value="<?php echo $layout ?>" type="radio" <?php if($_SESSION["sfm_f314_layout"] == $layout) echo 'checked' ?> /> <?php echo ($layout == 'master_details')?'Master/Details':$layout ?></label></div>
                                                                  <?php }?>
                                                                  
                                                              </div>
                                                              <div>
                                                                  <img id="layout_preview" src="images/<?php echo $_SESSION["sfm_f314_layout"] ?>.png" />
                                                              </div>
															  <tr><td colspan="2"><hr /></td></tr>
															  <tr>
						 
						  <td width="49" height="31"><strong>Style</strong></td>
                                                            <td><select name="style_name" id="style_name" onChange="refresh()">
                                  <?php  print_styles_names(); ?>
                                </select>
                              <a href="" onMouseOver="stm(Step_6[0],Style);" onClick="return false;" onMouseOut="htm()"><img src="images/Help.png" border="0"></a></td>
                              
						</tr>
				            </table>			  		      </td>
						    <td width="38" background="images/cright.jpg" style="background-repeat: y">&nbsp;</td>
					    </tr>
					    <tr>
					      <td width="27" height="37">
					        <img border="0" src="images/cdownleft.jpg" width="38" height="37"></td>
						    <td width="425" height="37" background="images/cdown.jpg" style="background-repeat: x">								</td>
						    <td width="38">
					        <img border="0" src="images/cdownright.jpg" width="38" height="37"></td>
					    </tr>
				      </table></td></tr>
				<tr>
					<td align="center">
					<a style="color: #0029a3; text-decoration: none" href="step_4.php"><img 
                  src="images/03.jpg" border=0 width="170" height="34"></a></td>
					<td align="center">
					<INPUT name=continue type=image id="continue" 
                  src="images/04.jpg" width="166" height="34"></td>
				</tr>
			</table>
			<td  align="center" width="48" style="background-repeat: y" valign="top" height="388" background="images/rightadd.jpg">
           
            <img border="0" src="images/right.jpg"></tr>
	<tr>
		<td width="64" height="13" align="center" background="images/leftadd.jpg" style="background-repeat: y">
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
<script src="disconnect.js"></script>

</html>