<?php
session_start();

$_SESSION['profile'] = 'admin';
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
    </style>
</head>
<body>
    
    <div class ='login-form' ><h2>Login</h2>
        <form action="login.php" method="post">
            <label for="username">Phone:</label>
            <input type="text" id="phone" name="phone"><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password"><br><br>
            <input  style="font-size: 10px;" class="form-check-input mt-0" type="checkbox" onclick="myFunction('password')"> &nbspShow Password</input>
            <input type="submit" value="Login">
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
</body>
</html>
