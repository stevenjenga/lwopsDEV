<?php
/**
 * Smart Chart Maker 
 * @author		StarSoft
 * @copyright	Copyright (c) 2011 - 2014, StarSoft, Inc.
 * @link		http://mysqlreports.com
 * 
 * 
 */

error_reporting(E_ERROR  | E_PARSE);
//delete report if rep_path var is set
$ch_path = $_GET['ch_path'];



$path = "charts" ;
$d = dir($path) ;
$charts=array(array());
$chortid = -1;  //report number
while (false !== ($entry = $d->read()))
{
  if($entry != "." && $entry != ".." && $entry!="pdf" )
  {

   //$fp = fopen("charts/$entry/config.php","r+");
     $chortid++; //new report
     $charts[$chortid]["path"]= "charts/$entry/";
     $charts[$chortid]["folder"]= "charts/$entry";	 
     if(file_exists("charts/$entry/config.php"))
     {
             $fp = fopen("charts/$entry/config.php","r+");
             $count = 0;
             while ($count <2) {


            $buffer = fgets($fp);
            if(strstr($buffer,"//"))
            {
              $buffer = str_replace("//","",$buffer);
              $arr = explode(",",$buffer);
              if(count($arr)>1)
              {
                  $charts[$chortid]["title"]= $arr[0];
                  $charts[$chortid]["date"]= $arr[1];
              }


            }
            $count ++;
            }

        }

  }
}
$d->close();

//function for deleting folders
function recursive_remove_directory($directory, $empty=FALSE)
 {
     // if the path has a slash at the end we remove it here
     if(substr($directory,-1) == '/')
     {
         $directory = substr($directory,0,-1);
     }
  
     // if the path is not valid or is not a directory ...
     if(!file_exists($directory) || !is_dir($directory))
     {
         // ... we return false and exit the function
        return FALSE;
  
     // ... if the path is not readable
     }elseif(!is_readable($directory))
     {
         // ... we return false and exit the function
         return FALSE;
  
     // ... else if the path is readable
     }else{
  
         // we open the directory
         $handle = opendir($directory);
  
         // and scan through the items inside
         while (FALSE !== ($item = readdir($handle)))
         {
             // if the filepointer is not the current directory
             // or the parent directory
             if($item != '.' && $item != '..')
             {
                 // we build the new path to delete
                 $path = $directory.'/'.$item;
  
                 // if the new path is a directory
                 if(is_dir($path)) 
                 {
                     // we call this function with the new path
                     recursive_remove_directory($path);
  
                 // if the new path is a file
                 }else{
                     // we remove the file
                     unlink($path);
                 }
             }
         }
         // close the directory
         closedir($handle);
  
         // if the option to empty is not set to true
         if($empty == FALSE)
         {
             // try to delete the now empty directory
             if(!rmdir($directory))
             {
                 // return false if not possible
                 return FALSE;
             }
         }
         // return success
         return TRUE;
     }
 }

?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Select table</title>
<link href="medi2.css" rel="stylesheet" type="text/css">
<script>
	function confirm_delete()
	{
		val = confirm('Are you sure you want to delete this chart?');
		if(val)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
</script>
</head>

<body>
<center>
<table border="0"  height="477" cellspacing="0" cellpadding="0" width="738">
	<tr>
		<td align="center" width="55" height="20" background="wizard/images/topleft.jpg" style="background-repeat: no-repeat" >

            <td align="center" width="629" height="20" background="wizard/images/top.jpg" style="background-repeat: x">

            <td align="center" width="54" height="20" background="wizard/images/topright.jpg" style="background-repeat: no-repeat">

            <img border="0" src="wizard/images/topright.jpg" width="51" height="23"></tr>
	<tr>
		<td align="center" width="55" background="wizard/images/leftadd.jpg" style="background-repeat: y" valign="top">

            <img border="0" src="wizard/images/left.jpg" width="64" height="403"><td align="center" rowspan="2" >

			<p><img border="0" src="wizard/images/01.jpg" width="369" height="71"></p>
			<p>
			<A
                  href="wizard/step_2.php" style="color: #0029a3; text-decoration: none">
					<IMG
                  src="wizard/images/b1.jpg" border=0></A>&nbsp;&nbsp;&nbsp;

			<form>

				<table border="0" cellpadding="0" cellspacing="0" width="501" id="table1" height="178">
					<tr>
						<td width="27" height="16">
						<img border="0" src="wizard/images/ctopleft.jpg" width="38" height="37"></td>
						<td width="425" height="16" background="wizard/images/ctop.jpg" style="background-repeat: x"></td>
						<td width="38" height="16">
						<img border="0" src="wizard/images/ctopright.jpg" width="38" height="37"></td>
					</tr>
					<tr>
						<td width="27" height="104" background="wizard/images/cleft.jpg" style="background-repeat: y">&nbsp;</td>
						<td width="425" valign="top" bgcolor="#F9F9F9">
						<u><b>Existing Charts</b></u>
						<div align="center">
&nbsp;<table border="1" cellpadding="2" cellspacing="0" width="434" id="table3" bordercolor="#000000" height="31" >
							  <tr>
									
								  <td width="250" bgcolor="#FDC643" height="18" align="center">
								<font size='2' color="#000080">	<b><I>Chart Title</b></i></font> </td>
								  <td bgcolor="#FDC643" height="18" align="center">
								<font size='2' color="#000080"><I>	<b>Date created</b></i></font></td>
								
							  </tr>
	<?php
	//adding charts *******************
	foreach($charts as $chart)
   {

     //foreach($chart as $k=>$v)
     //{
        if(count($chart)>0)
		{
	     echo "<tr>" ;
	     echo "<td ><font size = '2'><a href='".$chart['path']."'>".$chart['title']."</a></font></td >";		 	 
	     echo "<td><font size = '2'><a href='".$chart['path']."'>".$chart['date']."</a></font></td ></tr>";	
		 
		 	 	 		}
		 /*
		 
       if($k != "path")
       if(!empty($v))
        echo "<center><font size = '2'><a href='".$chart['path']."'>$v</a></font></center></td >";
        else
        echo "<td ><center><font size = '2'>&nbsp;</font></center></td >";
     }
     
     
     echo "</tr>";
*/

   //}


}

     ?>
     
     
     

						  </table>
						</div>					  </td>
						<td width="38" background="wizard/images/cright.jpg" style="background-repeat: y">&nbsp;</td>
					</tr>
					<tr>
						<td width="27" height="18">
						<img border="0" src="wizard/images/cdownleft.jpg" width="38" height="37"></td>
						<td width="425" height="18" background="wizard/images/cdown.jpg" style="background-repeat: x"></td>
						<td width="38">
						<img border="0" src="wizard/images/cdownright.jpg" width="38" height="37"></td>
					</tr>
			    </table>
				<table border="0" cellpadding="0" cellspacing="0" width="100%" id="table2">
				<tr>
					<td align="center">
					<p align="center">
					</td>
					<td align="center">
					<p align="center">
					</td>
				</tr>
			</table>
			</form>
			<td  align="center" width="54" background="wizard/images/rightadd.jpg" style="background-repeat: y" valign="top" height="388">

            <img border="0" src="wizard/images/right.jpg"></tr>
	<tr>
		<td align="center" width="55" background="wizard/images/leftadd.jpg" style="background-repeat: y">

            <td  align="center" width="54" background="wizard/images/rightadd.jpg" style="background-repeat: y" valign="top">

            </tr>
	</tr>
	<tr>
		<td align="center" width="55" height="29" background="wizard/images/downleft.jpg" style="background-repeat: no-repeat">

            <img border="0" src="wizard/images/downleft.jpg"><td align="center" width="629" height="29" background="wizard/images/down.jpg" style="background-repeat: x">

            <td align="center" width="54" height="29" background="downright.jpg" style="background-repeat: no-repeat" >

            <img border="0" src="wizard/images/downright.jpg" width="52" height="30"></tr>
	</tr>
</body>

</html>
