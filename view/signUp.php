<?php
require('header.php');
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

            .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
            }
        </style>

    </head>
    <body>
        <div class = 'formContainer'>
            <form action="controler/signup_controller.php" method="post">
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" required><br>

                <label for="lname">Last Name:</label>
                <input type="text" id="lname" name="lname" required><br>

                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" required><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>

                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required></br>

                    
                <input class="form-check-input" type="checkbox" onclick="myFunction('password')">&nbspShow Password</input></br></br>
                   
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" required></br>
                    
                <input  style="font-size: 10px;" class="form-check-input" type="checkbox" onclick="myFunction('confirm-password')"> &nbspShow Password</input>
                
                <div > <span id = 'password-message'></span></div>


                <label for="membership">Membership Type:</label>
                <select id="membership" name="membership">
                    <option value="basic">Basic</option>
                    <option value="premium">Premium</option>
                    <option value="vip">VIP</option>
                </select><br>

                <input type="submit" value="Submit">
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
            let slideIndex = 1;
            showSlides(slideIndex);

            function plusSlides(n) {
            showSlides(slideIndex += n);
            }

            function currentSlide(n) {
            showSlides(slideIndex = n);
            }

            function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}    
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";  
            dots[slideIndex-1].className += " active";
            }
            const password = document.getElementById("password");
            const confirmPassword = document.getElementById("confirm-password");
            const passwordMessage = document.getElementById("password-message");

            // Function to check if passwords match
            function checkPasswords() {
            if (password.value !== confirmPassword.value) {
                passwordMessage.innerHTML = "Passwords do not match.";
            } else {
                passwordMessage.innerHTML = "";
            }
            }

            // Listen for changes to the password and confirm password fields
            password.addEventListener("input", checkPasswords);
            confirmPassword.addEventListener("input", checkPasswords);

            const form = document.querySelector('form');
            form.addEventListener('submit', (event) => {
                // Prevent form submission if passwords do not match
                if (password.value !== confirmPassword.value) {
                    event.preventDefault();
                    passwordMessage.innerHTML = "Passwords do not match.";
                }
            });
        </script>
    </body>
</html>