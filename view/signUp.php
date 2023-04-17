<?php
require('header.html');
session_start();

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
            font-family: Arial, sans-serif;
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
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" ><br>

                <label for="lname">Last Name:</label>
                <input type="text" id="lname" name="lname" ><br>

                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" ><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" ><br>

                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" ><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <span class="password-toggle" onclick="togglePasswordVisibility('password')">Show</span><br><br>
                
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
                <span class="password-toggle" onclick="togglePasswordVisibility('confirm-password')">Show</span><br>
                <span id="password-error" style="color: red;"></span><br>
                
               

                

                <input type="submit" name='submit' value="submit">
            </form>
        </div>
        <?php
        require ('controller/signUp_controller.php');
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