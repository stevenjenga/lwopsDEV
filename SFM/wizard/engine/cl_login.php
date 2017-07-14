<?php
/**
 *   PHP MYSQL Form Maker 
 *   version 3.1.0
 *   All copyrights are preserved to StarSoft
 */
if (!defined('DIRECTACESS'))
    exit('No direct script access allowed');
if (file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php"))
    require_once('config.php');

class Login {

    private $username, $password;

    public function decode($encoded) {
        return unserialize(base64_decode($encoded));
    }

    public function __construct() {
        /*
          Make user logged out after 1 hour if no action was presented.
         */

        if (file_exists('config.php')) {

            global $form_username, $form_password;

            $this->username = $this->decode($form_username);
            $this->password = $this->decode($form_password);
        }
    }

    /*
      Check if user have logged  in or not, RETURN true || false
     */

    public function is_loggedin() {

        if (file_exists('config.php')) {
            if (isset($_SESSION['tmp_Login_username']) && isset($_SESSION['tmp_Login_password'])) {
                $session_username = $_SESSION['tmp_Login_username'];
                $session_password = $_SESSION['tmp_Login_password'];

                if ($session_username == $this->username && $session_password == $this->password . md5($_SERVER['HTTP_USER_AGENT']) && $_SESSION['tmp_Login_validLogin'] == sha1("tmp_1701 logged in") . md5($_SERVER['REMOTE_ADDR']))
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

    public function headerTo($isLoggedin = false) {
        if ($this->is_loggedin() === $isLoggedin)
            header("location: login.php");
    }

    /*
      this function to confirm login process
      params: USER INPUTS [POST] username, password
     */

    public function confirm($username, $password) {

        if (!file_exists('config.php')) { // check if security.php file is not exists so User must Sign up first
            return 'do_not_have_account';
        } else {
            // User inputs: $username, $password
            $salt = createSalt($username);
            $md5_password = hash("sha256", $password . $salt);





            // validation:: check if username and password valid formats
            //     if ((preg_match('/[^a-z0-9_]/i', $username)  || is_numeric($username[0]) || $username[0] == '_') || (preg_match('/[ \/\\\]/i', $password) || strlen($password) < 8 || !preg_match('/[a-z]+/', $password) || !preg_match('/[A-Z]+/', $password) || !preg_match('/[0-9]+/', $password) ))
            if (((preg_match('/[\\\"\';&|<>\/ ]/i', $password) || strlen($password) < 8 || strlen($password) > 12)) || ((preg_match('/[^a-z0-9_]/i', $username) || strlen($username) < 4 || strlen($username) > 12)))
                return 'wrong_usernamewrong_password';
            else {
                // if username and password is valid then check if username and password correct
                if ($username != $this->getUsername() || $md5_password != $this->getPassword()) {
                    return 'wrong_usernamewrong_password';
                } else {
                    // if username and password correct then set Login Session
                    $_SESSION['tmp_Login_username'] = $username;
                    $_SESSION['tmp_Login_password'] = $md5_password . md5($_SERVER['HTTP_USER_AGENT']);
                    $_SESSION['tmp_Login_validLogin'] = sha1("tmp_1701 logged in") . md5($_SERVER['REMOTE_ADDR']);

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

    public function is_public_form() {


        global $form_username, $form_password, $form_allow_security;
        if (!isset($form_username) && !isset($form_password) && $form_allow_security != 1) {

            return true;
        } else {

            return false;
        }
    }

}

?>