<?php

/*
  this class to handle login confirmation and login status
 */
if (! defined('DIRECTACESS')) exit('No direct script access allowed');
if (file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . "security.php")) 
 require_once "security.php";
class Login {

    private $username, $email, $password, $securityFullPath;

    public function __construct() {
        /*
          Make user logged out after 1 hour if no action was presented.
         */
        $this->securityFullPath = dirname(__FILE__) . DIRECTORY_SEPARATOR . "security.php";
        if (file_exists($this->securityFullPath)) {
           
            global $email, $username, $password;
            $this->email = $email;
            $this->username = $username;
            $this->password = $password;
        }
    }

    /*
      Check if user have logged  in or not, RETURN true || false
     */

    public function is_loggedin() {
        if (file_exists($this->securityFullPath)) {


            if (isset($_SESSION['PT_Login_username']) && isset($_SESSION['PT_Login_password'])) {
                $session_username = $_SESSION['PT_Login_username'];
                $session_password = $_SESSION['PT_Login_password'];
          
                if ($session_username == $this->username && $session_password == $this->password . md5($_SERVER['HTTP_USER_AGENT']) && $_SESSION['PT_Login_validLogin'] == sha1("PT_1701 logged in").md5($_SERVER['HTTP_USER_AGENT']))
                    return true;
                else
                    return false;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /*
      this function to handle redirect in action if is user logged in true or false.
      AND this function it must recently used ..
      params:
      isLoggedin: set to false if you want to redirect user to [PARAM: location] if not logged in (default: login.php)
      else set to true if you want to redirect user to [PARAM: location] if logged in
      location: ..
     */

    public function headerTo($isLoggedin = false, $location = "login.php") {
        if ($this->is_loggedin() === $isLoggedin)
            header("location: {$location}");
    }

    /*
      this function to confirm login process
      params: USER INPUTS [POST] username, password
     */

    public function confirm($username, $password) {
       
        if (!file_exists($this->securityFullPath)) { // check if security.php file is not exists so User must Sign up first
            return 'do_not_have_account';
        } else {
            // User inputs: $username, $password
            $salt = createSalt($username);
            $md5_password = hash("sha256", $password . $salt);

            // validation:: check if username and password valid formats
            if ((preg_match('/[^a-z0-9_]/i', $username) || strlen($username) < 5 || is_numeric($username[0]) || $username[0] == '_') || (preg_match('/[ \/\\\]/i', $password) || strlen($password) < 8 || !preg_match('/[a-z]+/', $password) || !preg_match('/[A-Z]+/', $password) || !preg_match('/[0-9]+/', $password) ))
                return 'wrong_usernamewrong_password';
            /* else if(preg_match('/[^a-z0-9_]/i', $username) || strlen($username) < 5 || is_numeric($username[0]) || $username[0] === '_')
              return 'wrong_username';
              else if(preg_match('/[ \/\\\]/i', $password) || strlen($password) < 8 || !preg_match('/[a-z]+/', $password) || !preg_match('/[A-Z]+/', $password) || !preg_match('/[0-9]+/', $password))
              return 'wrong_password'; */
            else {
                // if username and password is valid then check if username and password correct
                if ($username != $this->getUsername() || $md5_password != $this->getPassword()) {
                    return 'wrong_usernamewrong_password';
                    // else if($username !== $this->getUsername())
                    // 	return 'wrong_username';
                    // else if($md5_password !== $this->getPassword())
                    // 	return 'wrong_password';
                } else {
                    // if username and password correct then set Login Session
                    $_SESSION['PT_Login_username'] = $username;
                    $_SESSION['PT_Login_password'] = $md5_password.md5($_SERVER['HTTP_USER_AGENT']);
                    $_SESSION['PT_Login_validLogin'] = sha1("PT_1701 logged in").md5($_SERVER['HTTP_USER_AGENT']);

                    return 'done';
                }
            }
        }
    }

    /*
      to get username out side this class
     */

    public function getUsername() {
        return $this->username;
    }

    /*
      to get password out side this class
     */

    public function getPassword() {
        return $this->password;
    }

    /*
      to get email out side this class
     */

    public function getEmail() {
        return $this->email;
    }

}

?>