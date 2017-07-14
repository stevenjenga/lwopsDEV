<?php
$enc = "";


if(isset($_POST["submit"]))
{
    
    if(!isset($_POST["text"])||empty($_POST["text"]))
    {
        $enc = "Text can't be empty";
    }
    else{
    
       $value = trim($_POST["text"]);
       
        if(strstr($value," ")){ //password shouldn't include empty
         $enc .= "Spaces are not allowed ";
        }
        
        else if(preg_match('/[^a-z0-9_]/i', $value) != false){
            //password shouldn't include special chars
            $enc .= "Special Characters are nor allowed";
        }
        
        else{
            $enc = md5($value);
            
        }
    }
						
}



?>
<html>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
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
                   Text
                </font>
            </td>
            <td width="250">
                <input type="text" name="text" size="30">
            </td>
        </tr>

        

        <tr>
            <td colspan="2" align="center">
                <input name="submit" type="submit" value="Go">
            </td>
        </tr>

        <tr>
            <td colspan="2" width="350">
                <font color="black" size="-2" face="verdana">
                ___________________________________________________<br>
                This page displays an encryption value for alphanumeric texts only .
                </font>
            </td>
        </tr>
    </tbody></table>
    </td></tr></tbody></table>   
    </form>
    
</html>



