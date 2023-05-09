<?php
require('header_login.php');

require('../controller/admin_controller.php');
session_start();

$admin_controller = new admin_controller;


?>

<html>
    <head>
        <style>
            .formContainer{
                margin-top: 100px;
            }
            form {
            margin: 0 auto;
            width: 400px;
            font-family: Arial;
            }

            label {
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
            font-weight: bold;
            }

            input[type="text"],
            input[type="email"],
            input[type="tel"],
            input[type="date"],
            textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 20px;
            font-size: 16px;
            }

            select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 20px;
            font-size: 16px;
            }

            input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            }

            input[type="submit"]:hover {
            background-color: #45a049;
            }

            input[type="submit"]:active {
            background-color: #3e8e41;
            }

            input[type="submit"]:focus {
            outline: none;
            }

            .password-toggle {
			display: inline-block;
			margin-left: 10px;
			cursor: pointer;
		    }
        </style>
        
    </head>
    <body>
        <div class = 'formContainer'>
            <form method="post">
                <label for="profile">Profile:</label>
                <select name="profile">
                    <?php
                        $admin_controller->showProfile();
                    ?>
                </select>
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" placeholder="Enter First Name"><br>

                <label for="lname">Last Name:</label>
                <input type="text" id="lname" name="lname" placeholder="Enter Last Name"><br>

                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter Phone Number"><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter Email"><br>

                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" ><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
                <span class="password-toggle" onclick="togglePasswordVisibility('password')">Show</span><br><br>
                
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password"  placeholder="Enter Confirm Password" required>
                <span class="password-toggle" onclick="togglePasswordVisibility('confirm-password')">Show</span><br>
                <span id="password-error" style="color: red;"></span><br>
                
               

                

                <input type="submit" name='submit' value="Create Account">
            </form>
        </div>
        <?php
        if (isset($_POST['submit'])){
            require('../controller/signUp_controller.php');
            $controller = new signUpController;
            $profile = $_POST['profile'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $dob = $_POST['dob'];
            $password = $_POST['password'];
            
        
            if ($controller -> createAccount($profile,$fname,$lname,$phone,$email,$password,$dob)){
                echo '<script>alert("Create Account Succesful")</script>'; 
                echo" <script>window.location='../view/admin_home_view.php';</script>";
            }
        }
    
        ?>
        <script>
            function togglePasswordVisibility(id) {
                var input = document.getElementById(id);
                if (input.type === "password") {
                    input.type = "text";
                    event.target.textContent = "Hide";
                } else {
                    input.type = "password";
                    event.target.textContent = "Show";
                }
            }
            
            document.querySelector("form").addEventListener("submit", function(event) {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm-password").value;
            var passwordError = document.getElementById("password-error");

            if (password != confirmPassword) {
                passwordError.textContent = "Passwords do not match.";
                event.preventDefault();
            } else {
                passwordError.textContent = "";
            }
            });

        </script>
    </body>
</html>