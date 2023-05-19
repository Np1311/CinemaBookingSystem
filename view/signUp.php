<?php
require('header.html');
session_start();
$_SESSION['profile']='customer';


?>

<html>
    <head>
        <style>
            .h1 {
                font-family: Arial;
                background-color: #e7dbd0;
            }

            .formContainer {
                margin-top: 100px;
            }

            form {
                margin: 0 auto;
                max-width: 400px;
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
            textarea,
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

            .password-input {
                position: relative;
                display: inline-block;
                width: 100%;
            }

            .password-input input[type="password"],
            .password-input input[type="text"] {
                width: 100%;
                padding: 10px;
                box-sizing: border-box;
                margin-bottom: 20px;
                font-size: 16px;
            }

            .password-toggle {
                position: absolute;
                right: 20px;
                top: 10px;
                cursor: pointer;
            }

            .btn-primary {
                background-color: #bd9a7a;
                border: 2px solid white;
                color: white;
                padding: 15px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                border-radius: 8px;
                width: 100%;
                margin-top: 2%;
            }

            .btn-primary:hover {
                background-color: #fff;
                color: #bd9a7a;
                border: 2px solid;
            }
        </style>
<<<<<<< Updated upstream

        <div class="formContainer">
            <h1 style=" text-align: center;">Sign Up Form</h1>
=======
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </head>
    <body>
        <div class = 'formContainer'>
>>>>>>> Stashed changes
            <form method="post">
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" placeholder="Enter First Name"><br>

                <label for="lname">Last Name:</label>
                <input type="text" id="lname" name="lname" placeholder="Enter Last Name"><br>

                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter Phone Number"><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter Email"><br>

                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob"><br>

                <label for="password">Password:</label>
                <div class="password-input">
<<<<<<< Updated upstream
                    <input type="password" id="password" name="password" placeholder="Enter Password" required>
                    <span class="password-toggle" onclick="togglePasswordVisibility('password')">Show</span><br><br>
=======
                    <input type="password" id="password" name="password" required>
                    <span class="password-toggle" onclick="togglePasswordVisibility('password')"><i class="fas fa-eye"></i></span><br><br>
>>>>>>> Stashed changes
                </div>

                <label for="confirm-password">Confirm Password:</label>
                <div class="password-input">
<<<<<<< Updated upstream
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Enter Confirm Password" required>
                    <span class="password-toggle" onclick="togglePasswordVisibility('confirm-password')">Show</span><br>
                    <span id="password-error" style="color: red;"></span><br>
                </div>

                <button class="btn-primary" type="submit" name="submit" value="submit">Submit</button>
                <button type="button" class="btn-primary" onclick="window.location.href = 'index.php'">Back</button>
=======
                    <input type="password" id="confirm-password" name="confirm-password" required>
                    <span class="password-toggle" onclick="togglePasswordVisibility('confirm-password')"><i class="fas fa-eye"></i></span><br>
                    <span id="password-error" style="color: red;"></span><br>
                </div>
                
                <button class="btn-primary" type="submit" name='submit' value="submit">Submit</button>
>>>>>>> Stashed changes
            </form>
        </div>
        <?php
        require ('../controller/signUp_controller.php');
        ?>
        <script>
            function togglePasswordVisibility(id) {
                var input = document.getElementById(id);
                var icon = event.target;

                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                } else {
                    input.type = "password";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
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
        <?php
            if (isset($_POST['submit'])){
                $profile = 'customer';
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $dob = $_POST['dob'];
                $password = $_POST['password'];
                $controller = new signUp_controller;
            
                if ($controller -> createAccount($profile,$fname,$lname,$phone,$email,$password,$dob)){
                    echo '<script>alert("Sign up succesful")</script>'; 
                    echo" <script>window.location='index.php';</script>";
                }
            }
        ?>
    </body>
</html>