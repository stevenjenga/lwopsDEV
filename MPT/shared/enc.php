<?php
define("DIRECTACESS", "true");
require_once("shared.php");
$enc = "";
if(isset($_POST["user"]))
$test_user = trim($_POST["user"]);
else
$test_user = "";

if(isset($_POST["email"]))
$test_email = trim($_POST["email"]);
else
$test_email = "";


if(isset($_POST["submit"]))
{
    
    if(!isset($_POST["encValue"])||empty($_POST["encValue"]) || empty($test_user) || empty($test_email))
    {
        $enc = "User name, email and the text to be encrypted can't be empty";
    }
    else{
    
       $value = trim($_POST["encValue"]);
	   
	   if(!valid_username($test_user) || !valid_email($test_email)){
	   $enc .= "Not a Valid UserName or email, please enter your regestered Username and email address ";	   
	   }
       
        else if(strstr($value," ")){ //password shouldn't include empty
         $enc .= "Spaces are not allowed ";
        }
        
        else if(preg_match('/[^a-z0-9_]/i', $value) != false){
            //password shouldn't include special chars
            $enc .= "Special Characters are nor allowed";
        }
        
          else if(preg_match('/[ \/\\\]/i', $value) || strlen($value) < 8 || !preg_match('/[a-z]+/', $value) || !preg_match('/[A-Z]+/', $value) || !preg_match('/[0-9]+/', $value)){
            //password sehouldn't include special chars
            $enc .= "text must be at least 8  alphanumeric characters with upper and lower case letters";
        }
        
        else{
		    $salt = createSalt($username);  
                    $enc = hash("sha256",$value.$salt);
            
        }
    }
						
}



?>
<html>
    <head>
     <meta name="robots" content="noindex, nofollow">
        <meta name="googlebot" content="noindex" />
    </head>
    <body>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]?>">
 <table cellpadding="0" cellspacing="0" border="1" bordercolor="navy" align="center">
    <tbody><tr><td>
    <table align="center" cellspacing="3">
        <tbody><tr>
            <td colspan="2" bgcolor="navy" align="center">
                <font color="white" size="+1" face="verdana">
                    Text Encryption Helper 
                </font>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <font color="red" size="-1" face="verdana"><b>
                               <?php echo $enc ?>  &nbsp;   </b></font>
            </td>
        </tr>
		<tr>
            <td align="right">
                <font color="navy" size="-1" face="verdana">
                  Registered User Name *
                </font>
            </td>
            <td width="250">
                <input type="text" name="user" size="30">
            </td>
        </tr>
		<tr>
            <td align="right">
                <font color="navy" size="-1" face="verdana">
                   Registered Email Address *
                </font>
            </td>
            <td width="250">
                <input type="text" name="email" size="30"/>
            </td>
        </tr>

        <tr>
            <td align="right">
                <font color="navy" size="-1" face="verdana">
                   Text To be Encrypted *
                </font>
            </td>
            <td width="250">
                <input type="password" name="encValue" size="30"/>
            </td>
        </tr>

        

        <tr>
            <td colspan="2" align="center">
                <input id="submit" name="submit" type="submit" value="submit"/>
            </td>
        </tr>

        <tr>
            <td colspan="2" width="350">
                <font color="black" size="-2" face="verdana">
                _______________________________________________________________________</br/>
                This page displays an encryption value for alphanumeric texts only .
                </font>
            </td>
        </tr>
    </tbody></table>
    </td></tr></tbody></table>   
    </form>
    
</html>



