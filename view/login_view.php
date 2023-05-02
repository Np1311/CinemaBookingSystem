<?php
session_start();

$_SESSION['profile'] = $_GET['profile'];
require('header_login.html')


?>

<html>
<head>
    <title>Admin Login</title>
    <style>
        .login-form{
            margin-top : 100px;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #F8F8F8;
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
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: #FFFFFF;
            padding: 10px 20px;
            border-radius: 3px;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #3e8e41;
        }
        .btn-primary{
                background-color: blue; 
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
    </style>
</head>
<body>
    
    <div class ='login-form' ><h2>Login</h2>
        <form method='post' >
            </br></br>
                
                    <span class="input-group-text" id="phone">Phone</span>
                    <input class="form-control" type="text" name="phone" id="phone" required>
                    
                    
                    </br></br>
                   
                    <span class="input-group-text" id="basic-addon1">Password</span>
                    <input class="form-control" type="password" name="pass" id="pass" required>
                    
                    <input  style="font-size: 10px;" class="form-check-input mt-0" type="checkbox" onclick="myFunction('pass')"> &nbspShow Password</input>
                
                </br>
                <button class="btn-primary" type ='submit' name='submit' value='submit'> Submit </button>
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
