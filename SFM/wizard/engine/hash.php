<?php
/**
 *   PHP MYSQL Form Maker 
 *   version 3.1.0
 *   All copyrights are preserved to StarSoft
 */
require_once("config.php");
$enc = "";
if (isset($_POST["user"]))
    $test_user = trim($_POST["user"]);
else
    $test_user = "";

function valid_username($username) {
    global $form_username;
    if (base64_encode(serialize($username)) == $form_username) {
        return true;
    } else
        return false;
}

function createSalt($userinfo) {
    $string = sha1(substr($userinfo, intval(strlen($userinfo) / 2), strlen($userinfo) - 1));
    return substr($string, 0, 3);
}

if (isset($_POST["submit"])) {

    if (!isset($_POST["encValue"]) || empty($_POST["encValue"]) || empty($test_user)) {
        $enc = "User name and the text to be encrypted can't be empty";
    } else {

        $value = trim($_POST["encValue"]);

        if (!valid_username($test_user)) {
            $enc .= "Not a Valid UserName  please enter your regestered Username ";
        } else if (strstr($value, " ")) { //password shouldn't include empty
            $enc .= "Spaces are not allowed ";
        } else if (preg_match('/[^a-z0-9_]/i', $value) != false) {
            //password shouldn't include special chars
            $enc .= "Special Characters are nor allowed";
        } else if (preg_match('/[ \/\\\]/i', $value) || strlen($value) < 8 || !preg_match('/[a-z]+/', $value) || !preg_match('/[A-Z]+/', $value) || !preg_match('/[0-9]+/', $value)) {
            //password sehouldn't include special chars
            $enc .= "text must be at least 8  alphanumeric characters with upper and lower case letters";
        } else {
            $salt = createSalt($test_user);
            $enc = "<Font color='back'> encrypted Text : </b></font><br/><br/>";
            $enc .= base64_encode(serialize(hash("sha256", $value . $salt)));
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
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>">
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

                                    <tr align="center">
                                        <td colspan="2">
                                            <font color="red" size="-1" face="verdana"><b>
                                                &nbsp;   </b></font>

                                        </td>
                                    </tr>
                                    <tr align="center">
                                        <td >
                                            <font color="navy" size="-1" face="verdana">
                                            Registered User Name *
                                            </font>
                                        </td>
                                        <td width="250">
                                            <input type="text" name="user" size="30">
                                        </td>
                                    </tr>


                                    <tr align="center" >
                                        <td align="center">
                                            <font color="navy" size="-1" face="verdana">
                                            Text To be Encrypted *
                                            </font>
                                        </td>
                                        <td width="250" align="center">
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
    <center> <font color="red" size="-1" face="verdana"><b>
<?php echo $enc ?>  &nbsp;   </b></font> </center>

</html>



