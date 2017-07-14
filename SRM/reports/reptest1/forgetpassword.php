<?php
/**
* Smart Report Maker
* Author : StarSoft 
*All copyrights are preserved to StarSoft
*http://mysqlreports.com/
*
*/
define("DIRECTACESS","true");
error_reporting(E_ERROR  | E_PARSE);
require_once("config.php");
//die if the forget password is disabled
require_once("../helpers/DatabaseHandler.php");
require_once("../helpers/safeValue.php");
$err = "";
// username and password sent from form 

$_GET = array();
//$_SESSION = array();
$_COOKIE = array();
$_POST = remove_unexpected_superglobals($_POST, array("member_user","Submit"));
//$_POST = clean_input_array($_POST);
$_FILES = array();
if(empty($sec_email))Die("<Center> The 'Forgot Password' feature is disabled for this report! </center>");


Function ForgetPassword($member_user)
{

   global $host, $user, $pass, $db,$sec_Username,$sec_Username_Field,$sec_table,$sec_pass_Field,$err,$sec_email;
     //case static data
    
    	if($member_user==$sec_Username)
    	{
    		
    		$err = "Please check the user guide pdf , you should find the exact steps of resetting the administrator  password under 'security settings'";
                return true;
    	}
		
	// Member case
	if(is_exist($sec_table)&& is_exist($sec_Username_Field)&& is_exist($sec_pass_Field))
      {
         
                if(is_clean($member_user,true,true))
                {

                        $dbHandler = new DatabaseHandler($host, $user, decode($pass), $db);
                         if(!$dbHandler || $dbHandler->is_connection_failed()) 
                            {
                                    $err = "Internal System error";              
                                    return false;
                            }
                        $member_user = $dbHandler->sanitize_values($member_user);                   
                        $params = array($member_user);
                        $sql = "select `$sec_Username_Field` from `$sec_table` where `$sec_Username_Field`= ? " ;
                        $results = $dbHandler->query($sql, 'ASSOC', $params, 's');
                        if($dbHandler->get_num_rows()==1) {
                        $dbHandler->close_connection();
                        $messqage = "Password change  request from the following username : $member_user \n **This message was sent automatically from Smart Report Maker which is installed on your own Server, and was sent because you activated the ' Change Member Password' option in the security page of Smart Report Maker.  ";
                        @mail($sec_email,"Password Change Request",$messqage);
                        $err =  "Your request has been sent to the  administrator";
                         return true;
                        }
                        else
                        {
                      // member dosn't exist
                        $dbHandler->close_connection();
                        $err =  "User name is not correct";
                        return false;
                        }

                    
                }
                else
                {                    
                    $err =  "User name is not correct";
                     return false;
                    
                }
                    
      }
    $err =  "User name is not correct";
    
    return false;
    
  }



if(isset($_POST["Submit"]))
  {	
  
   //$version = explode('.', PHP_VERSION);
  
   $My_User = $_POST["member_user"];
   
		if(!is_clean($My_User,true,true)|| !is_clean_username($My_User))
		{
                    
	            $err = "User name  is not secure, please contact the database administrator";
                    
		  
		}
		else
		{
                  
		  ForgetPassword($My_User);
		
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



		 
							  <form name="form1" method="post" action="<?PHP echo $_SERVER["PHP_SELF"] ?>">


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

						<u><b><strong>Please enter the user name  </b></u>

						<div align="center">

&nbsp;<table  width="434" id="table3"  height="31" >

							  
 

<tr>
<td>User Name</td>
<td>:</td>
<td><input name="member_user" type="text" id="member_user"></td>

</tr>

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Send"></td>
</tr> 
<tr>
<td colspan="3">

<?php 

  echo "<center><font color='red'>$err</font></center>" ;

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

 