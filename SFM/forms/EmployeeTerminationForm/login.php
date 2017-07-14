<?php
define("DIRECTACESS", "true");
error_reporting(0);
ini_set('session.use_only_cookies', 1);
$cookieParams = session_get_cookie_params();
session_start();
session_regenerate_id();
function createSalt($userinfo) {
    $string = sha1(substr($userinfo, intval(strlen($userinfo) / 2), strlen($userinfo) - 1));
    return substr($string, 0, 3);
}

require_once 'cl_login.php';
$login = new Login();

if (isset($_POST['username']) && isset($_POST['password'])) {
    echo $login->confirm($_POST['username'], $_POST['password']);
    exit();
}
?>
<!DOCTYPE html>
<html>

    <head>

        <meta charset='UTF-8'/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Smart Form Maker Login Page</title>

        <link type='text/css' rel='stylesheet' href='../../layout/bootstrap/css/bootstrap.min.css' />

        <link rel="stylesheet" href="../../layout/alertify/themes/alertify.default.css" />
        <link rel="stylesheet" href="../../layout/alertify/themes/alertify.core.css" />

        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 12px;
                color: #000;
                direction: ltr;
                /* background-image: url(../../layout/images/cream_pixels.png); */
                background-repeat: repeat;
            }
            .img {max-width:100%;
                  height: auto;}

            #tabs-2{position:relative;}
            .wizard-tbl {
                position:relative;
            }

            .wizard-tbl td{
                height:42px;
                padding-left: 5px;
            }

            .app-logo {
                margin-top: 5px;
                margin-right: auto;
                margin-bottom: 5px;
                margin-left: auto;
                max-width:100%;
                height: auto;
            }
            #formContainer
            {

                margin-top: 40px;

            }

            .left-inner-addon 
            {
                position: relative;
            }
            .left-inner-addon input 
            {
                height: 40px;
                padding-left: 30px;    
            }
            .left-inner-addon i 
            {
                position: absolute;
                padding: 13px 12px;
                pointer-events: none;
            }
            .popover-content
            {

                color: #4e4e4e;
                font-size: 14px;
                font-family: "Lobster", Georgia, Times, serif;
                letter-spacing: 1px;
            }
            #forgetPass
            {

                margin-top: 25px;

            }
            #usernameFeedback, #passwordFeedback, #retrievePassFeedback{

                top: 3px;

            }
        </style>


    </head>

    <body>

        <div class='container'>

            <div class="header">
                <div style="text-align:center">
                    <img src="../../layout/images/logo.png" class="app-logo" alt='Logo picture'/>
                </div>
            </div><!-- .header -->


            <div id='formContainer'>
                <form role="form" onsubmit='return false;'>
                    <div class='row'>
                        <div class="col-lg-4 col-md-3 col-sm-2 hidden-xs"></div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-8 col-xs-12">
                            <!-- <label for="username">User name</label> -->
                            <div id='usernameContainer' class="left-inner-addon">
                                <i class="glyphicon glyphicon-user"></i>
                                <input type="text" class="form-control" id="username" placeholder="Username">
                                <span id="usernameFeedback"></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-2 hidden-xs"></div>
                    </div>
                    <div class='row' style='margin-bottom: 10px;'>
                        <div class="col-lg-4 col-md-3 col-sm-2 hidden-xs"></div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-8 col-xs-12">
                            <!-- <label for="password">Password</label> -->
                            <div id='passwordContainer' class="left-inner-addon">
                                <i class="glyphicon glyphicon-lock"></i>
                                <input type="password" class="form-control" id="password" placeholder="Password">
                                <span id="passwordFeedback"></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-2 hidden-xs"></div>
                    </div>
                    <div class='row'>
                        <div class="col-lg-4 col-md-3 col-sm-2 hidden-xs"></div>
                        <div class="col-lg-4 col-md-6 col-sm-8 col-xs-12">
                            <button id='loginBtn' class='btn btn-info btn-lg btn-block'>Login</button>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-2 hidden-xs"></div>
                    </div>
                </form>
            </div>


            <div class='row'>
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <hr style='height: 1px; background: #dfdfdf;'/>
                </div>
                <div class="col-lg-1"></div>
            </div>
            <div><!-- container -->


                <script src='../../js/jquery-1.7.2.min.js'></script>
                <script src='../../layout/bootstrap/js/bootstrap.min.js'></script>
                <script src="../../layout/alertify/lib/alertify.min.js"></script>
                <script>

                    $('#loginBtn').mousedown(function() {

                        var username = $('#username').val();
                        var password = $('#password').val();

                        $.ajax({
                            url: 'login.php',
                            type: 'POST',
                            data: 'username=' + username + '&password=' + password,
                            success: function(data)
                            {
                                if (data == 'wrong_username')
                                {
                                    wrong_username();
                                    valid_password();
                                    alertify.error('wrong username');
                                }
                                else if (data == 'wrong_password') {
                                    valid_username();
                                    wrong_password();
                                    alertify.error('wrong password');
                                }
                                else if (data == 'wrong_usernamewrong_password') {
                                    wrong_username();
                                    wrong_password();
                                    alertify.error('wrong username & password');
                                }
                                else if (data == 'do_not_have_account')
                                {
                                    wrong_username();
                                    wrong_password();
                                    alertify.error('you don\'t have an account.');
                                }


                                if (data == 'done')
                                {

                                    alertify.success('login success');

                                    window.location.replace("index.php");
                                }
                            },
                            error: function()
                            {

                                alert('error -> ajax');

                            }
                        });

                    });

                    function wrong_username()
                    {

                        $('#usernameFeedback').removeClass();
                        $('#usernameContainer').removeClass();
                        $('#usernameContainer').addClass('left-inner-addon has-error has-feedback');
                        $('#usernameFeedback').addClass('glyphicon glyphicon-remove form-control-feedback');

                    }
                    function valid_username()
                    {

                        $('#usernameFeedback').removeClass();
                        $('#usernameContainer').removeClass();
                        $('#usernameContainer').addClass('left-inner-addon has-success has-feedback');
                        $('#usernameFeedback').addClass('glyphicon glyphicon-ok form-control-feedback');

                    }

                    function wrong_password()
                    {

                        $('#passwordFeedback').removeClass();
                        $('#passwordContainer').removeClass();
                        $('#passwordContainer').addClass('left-inner-addon has-error has-feedback');
                        $('#passwordFeedback').addClass('glyphicon glyphicon-remove form-control-feedback');

                    }
                    function valid_password()
                    {

                        $('#passwordFeedback').removeClass();
                        $('#passwordContainer').removeClass();
                        $('#passwordContainer').addClass('left-inner-addon has-success has-feedback');
                        $('#passwordFeedback').addClass('glyphicon glyphicon-ok form-control-feedback');

                    }
                </script>

                </body>

                </html>