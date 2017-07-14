<?php
/**
* Smart Report Maker
* Author : StarSoft 
*All copyrights are preserved to StarSoft
*http://mysqlreports.com/
*
*/
session_start();
session_regenerate_id();
define("DIRECTACESS","true");
error_reporting(E_ERROR  | E_PARSE);
require_once("config.php");
require_once("../helpers/DatabaseHandler.php");
require_once("../helpers/safeValue.php");


$report_key = sha1(str_replace(" ", "_", $file_name)."secure_login");
$report_token = md5(str_replace(" ", "_", $file_name).$db.loginedin_code_1701) ;
$valid = 1; // if 0 errors will be shown in a span 
$err = "";

$_GET = array();
//$_SESSION = remove_unexpected_superglobals($_SESSION,array($report_key));
$_COOKIE = array();
$_POST = remove_unexpected_superglobals($_POST, array('myusername','mypassword',"Submit"));
$_FILES = array();
$err = "";

// validating Admin
function validate_admin($user,$pass){
    
    global  $sec_Username,$sec_pass;
    if(is_exist($sec_Username)&& is_exist($sec_pass))
    {
        if(is_clean($user,true,true)&&is_clean($pass,true,true))
        {
            if($user==$sec_Username && md5($pass)==$sec_pass){
                
                return true;
            }
            else{
               
                return false;
            }
        }
        else
        {   // input is not secure
            
            return false;
        }    
    }
    else
    {
        
       return false;    
     }      
    
}


function validate_member($member_user,$member_pass)
{
   
  global $host, $user, $pass, $db, $sec_table,$sec_Username_Field,$sec_pass_Field,$sec_pass_hash_type;
  $pass = decode($pass);
   
  
    
       
      if(is_exist($sec_table)&& is_exist($sec_Username_Field)&& is_exist($sec_pass_Field))
      {
          if(is_clean($member_user,true,true) && is_clean($member_pass,true,false))
          {
              
              $dbHandler = new DatabaseHandler($host, $user, $pass, $db);
              if(!$dbHandler || $dbHandler->is_connection_failed()) 
                            {
                                    $err = "Internal System error";              
                                    return false;
                            }
             $member_user = $dbHandler->sanitize_values($member_user);
              switch($sec_pass_hash_type)
              {
                  case "md5":
                      $member_pass = md5($member_pass);
                     $member_pass = $dbHandler->sanitize_values($member_pass);
                      break;
                  case "sha1":
                      $member_pass = sha1($member_pass);
                      $member_pass = $dbHandler->sanitize_values($member_pass);
                      break;
                  case "crypt":
                      $member_pass = crypt($member_pass);
                      $member_pass = $dbHandler->sanitize_values($member_pass);
                      break;
                  //further encryption methods could be added here 
                  default :
                      $member_pass = $dbHandler->sanitize_values($member_pass);
                  
              }
              
              $params = array($member_user,$member_pass);
              $sql = "select`$sec_pass_Field` from `$sec_table` where `$sec_Username_Field`=? and $sec_pass_Field = ?" ;
              $results = $dbHandler->query($sql, 'ASSOC', $params, 'ss');
              if(!$results) return false; //invalid sql query
              if($dbHandler->get_num_rows()==1)
              {
                  $dbHandler->close_connection();
                  return true;
              }
              else
              {
                  // member dosn't exist
                  $dbHandler->close_connection();
                  return false;
              }
          }
          else
          {
              // parameters not secure
              
              return false;
          }
          
      }
      else
      {
          // members login is disabled
         
          return false;
      }
      
      return false;	
}





if(isset($_POST["Submit"]))
  {	

 
                
		$_MyUser= trim($_POST['myusername']); 
		$_MyPass=trim($_POST['mypassword']); 
 
       if(is_clean_username($_MyUser)&& is_clean($_MyPass,true,true) && is_clean($_MyPass,true,false) &&  is_exist($_MyUser) && is_exist($_MyPass))
       {  
                //$_MyUser= clean_input($_MyUser);
       
		if(validate_admin($_MyUser,$_MyPass) || validate_member($_MyUser,$_MyPass))
		{ 
                  
		  $_SESSION[$report_key]= $report_token;
                 
		  header("location: rep".$file_name.".php"); 
		}
		else
		{   
			$valid = 0;
                      
			$err = "<font color='red'> Incorrect username or password </font>";
		}
       }
	else
	{
	        $valid = 0;
                
			$err = "<font color='red'> User name or password is  not secure, please contact the database administrator </font>";
	}


 } 
 
 


?>

  









 


<html>



<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<title>Select table</title>

<link href="medi2.css" rel="stylesheet" type="text/css">

 

</head>



<body>

<center>

<table border="0"  height="477" cellspacing="0" cellpadding="0" width="738">

	<tr>

		<td align="center" width="55" height="20" background="../../wizard/images/topleft.jpg" style="background-repeat: no-repeat" >



            <td align="center" width="629" height="20" background="../../wizard/images/top.jpg" style="background-repeat: x">



            <td align="center" width="54" height="20" background="../../wizard/images/topright.jpg" style="background-repeat: no-repeat">



            <img border="0" src="../../wizard/images/topright.jpg" width="51" height="23"></tr>

	<tr>

		<td align="center" width="55" background="../../wizard/images/leftadd.jpg" style="background-repeat: y" valign="top">



            <img border="0" src="../../wizard/images/left.jpg" width="64" height="403"><td align="center" rowspan="2" >



			<p><img border="0" src="../../wizard/images/01.jpg" width="369" height="71"></p>

			<p>

			&nbsp;&nbsp;&nbsp;



		 
							  <form name="form1" method="post" action="login.php">


				<table border="0" cellpadding="0" cellspacing="0" width="501" id="table1" height="178">

					<tr>

						<td width="27" height="16">

						<img border="0" src="../../wizard/images/ctopleft.jpg" width="38" height="37"></td>

						<td width="425" height="16" background="../../wizard/images/ctop.jpg" style="background-repeat: x"></td>

						<td width="38" height="16">

						<img border="0" src="../../wizard/images/ctopright.jpg" width="38" height="37"></td>

					</tr>

					<tr>

						<td width="27" height="104" background="../../wizard/images/cleft.jpg" style="background-repeat: y">&nbsp;</td>

						<td width="425" valign="top" bgcolor="#F9F9F9">

						<u><b><strong>Member Login </strong></b></u>

						<div align="center">

&nbsp;<table  width="434" id="table3"  height="31" >

							  
 
<tr>
<td width="78">Username</td>
<td width="6">:</td>
<td width="294"><input name="myusername" type="text" id="myusername"></td>
</tr>
<tr>
<td>Password</td>
<td>:</td>
<td><input name="mypassword" type="password" id="mypassword"></td>

</tr>
<?php
if(isset($Forget_password))
{
	if($Forget_password=="enabled")
	{
	echo "<tr> <td colspan='3'><font color='blue'><u><a href='forgetpassword.php'>Forgot password</a></u></font></td> 
	</tr>";
   }
}
?>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Login"></td>
</tr> 
<tr>
<td colspan="3">

<?php 
if( $valid==0)
{
  echo $err;
}
?>
</td>
</tr>


						  </table> 

						</div>					  </td>

						<td width="38" background="../../wizard/images/cright.jpg" style="background-repeat: y">&nbsp;</td>

					</tr>

					<tr>

						<td width="27" height="18">

						<img border="0" src="../../wizard/images/cdownleft.jpg" width="38" height="37"></td>

						<td width="425" height="18" background="../../wizard/images/cdown.jpg" style="background-repeat: x"></td>

						<td width="38">

						<img border="0" src="../../wizard/images/cdownright.jpg" width="38" height="37"></td>

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

			<td  align="center" width="54" background="../../wizard/images/rightadd.jpg" style="background-repeat: y" valign="top" height="388">



            <img border="0" src="../../wizard/images/right.jpg"></tr>

	<tr>

		<td align="center" width="55" background="../../wizard/images/leftadd.jpg" style="background-repeat: y">



            <td  align="center" width="54" background="../../wizard/images/rightadd.jpg" style="background-repeat: y" valign="top">



            </tr>

	</tr>

	<tr>

		<td align="center" width="55" height="29" background="../../wizard/images/downleft.jpg" style="background-repeat: no-repeat">



            <img border="0" src="../../wizard/images/downleft.jpg"><td align="center" width="629" height="29" background="../../wizard/images/down.jpg" style="background-repeat: x">



            <td align="center" width="54" height="29" background="downright.jpg" style="background-repeat: no-repeat" >



            <img border="0" src="../../wizard/images/downright.jpg" width="52" height="30"></tr>

	</tr>

</body>



</html>

 