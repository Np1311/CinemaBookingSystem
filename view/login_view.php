<?php
session_start();

$_SESSION['profile'] = $_GET['profile'];
require('header.html')


?>

<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript">
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password-input');
        const showPasswordIcon = document.querySelector('.show-password-icon');

        if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        showPasswordIcon.classList.remove('fa-eye-slash');
        showPasswordIcon.classList.add('fa-eye');
        } else {
        passwordInput.type = 'password';
        showPasswordIcon.classList.remove('fa-eye');
        showPasswordIcon.classList.add('fa-eye-slash');
        }
    }
    </script>
    <title>Admin Login</title>
    <style>
        .login-form{
            margin-top : 100px;
        }
        body {
            font-family: Arial;
            background-color: #e7dbd0;
        }
        h2 {
            text-align: center;
            
        }
        form {
            width: 400px;
            margin: 0 auto;
            background-color: #FFFFFF;
            padding: 20px;
            margin-top : 30px;
            border-radius: 5px;
            box-shadow: 0px 2px 5px #666666;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #CCCCCC;
            margin-bottom: 20px;
            box-sizing: border-box;
        }
        /* input[type="submit"] {
            background-color: #4CAF50;
            color: #FFFFFF;
            padding: 10px 20px;
            border-radius: 3px;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #3e8e41;
        } */
        .btn-primary{
                background-color: #bd9a7a; 
                border: 2px solid white;
                color: white;
                padding: 15px ;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                border-radius: 8px;
                width: 400px;
                /* margin-left: 100px; */
        }
        .btn-primary:hover {
                background-color: #fff;
                color: #bd9a7a;
                border: 2px solid;
            } 
        .password-container {
            position: relative;
        }
        .show-password-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            }
        
    </style>
</head>
<body>
    
    <div class ='login-form' ><h2>Login</h2>
        <form method='post' >
            </br></br>
                
                    
                <div class="signIn" style="text-align:left;"> 
                <span class="input-group-text" id="phone-label" >Phone Number</span> <!--New things 06/05-->
                <input class="form-control" type="text" name="phone" id="phone" required placeholder="Enter Phone Number">
                                
            </br></br>
                            
                <div class="password-container">
                <span class="input-group-text" id="basic-addon1">Password</span>
                <input type="password" placeholder="Enter Password" id="password-input" name = 'pass'>
                <i class="show-password-icon fa fa-eye-slash" aria-hidden="true" onclick="togglePasswordVisibility()"></i>
                </div>
            </div>
                </br>
                <button class="btn-primary" type ='submit' name='submit' value='submit'> Log in </button>
                <button class="btn-primary" type="button" onclick="window.location.href = 'index.php'">Back</button>
            </form>
    </div>
    <script>
            function myFunction(type) {
            var x = document.getElementById(type);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    <?php
    require('../controller/login_controller.php');
    if (isset($_POST['submit'])){
        $phone = $_POST['phone'];
        $pass = $_POST['pass'];
        if(isset($_SESSION['profile'])== null){
            $_SESSION['profile'] = 'customer';
        }
        echo $_SESSION['profile'];
        
        $controller = new login_controller();
        
        $controller->validateLogin($_SESSION['profile'],$phone,$pass);
            
        
    }
    ?>
</body>
</html>
