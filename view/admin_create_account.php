<?php
// Include the header file
require('header.html');
// Include the admin controller
require('../controller/admin_controller.php');
// Start the session
session_start();
// Create an instance of the admin controller
$admin_controller = new admin_controller;
?>

<html>
<head>
    <style>
        .formContainer {
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
            width: 420px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        textarea,
        select {
            width: 400px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .password-input {
            position: relative;
            display: inline-block;
            width: 400px;
        }

        .password-input input[type="password"],
        .password-input input[type="text"] {
            width: calc(400px);
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
            width: 400px;
            margin-top: 2%;
        }

        .btn-primary:hover {
            background-color: #fff;
            color: #bd9a7a;
            border: 2px solid;
        }

     /* Create form to fill in details to create account */
    </style>
    <title>Create an Account</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<div class="formContainer">
    <form method="post">
        <label for="profile">Profile:</label>
        <select name="profile" required>
            <option value="" disabled selected >-- Choose a Profile --</option>
            <?php
            $admin_controller->showProfile();
            ?>
        </select>
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" placeholder="Enter First Name" required><br>

        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="lname" placeholder="Enter Last Name" required><br>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter Phone Number" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter Email" required><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required><br>

        <label for="password">Password:</label>
        <div class="password-input">
            <input type="password" id="password" name="password" placeholder="Enter Password" required>
            <span class="password-toggle" onclick="togglePasswordVisibility('password')"><i class="fas fa-eye"></i></span>
        </div><br>

        <label for="confirm-password">Confirm Password:</label>
        <div class="password-input">
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Enter Confirm Password" required>
            <span class="password-toggle" onclick="togglePasswordVisibility('confirm-password')"><i class="fas fa-eye"></i></span>
        </div><br>
        <span id="password-error" class="error-message"></span><br>

        <button class="btn-primary" type='submit' name='submit' value='Create Account'>Create Account</button>
        <button class="btn-primary" type="button" onclick="window.location.href = 'admin_home_view.php'">Back</button>
    </form>
</div>

<?php
// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Create an instance of the sign-up controller
    require('../controller/signUp_controller.php');
    $controller = new signUp_controller;
    // Retrieve form data
    $profile = $_POST['profile'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];

    // Call the createAccount method of the sign-up controller
    if ($controller->createAccount($profile, $fname, $lname, $phone, $email, $password, $dob)) {
        echo '<script>alert("Create Account Successful")</script>';
        echo ' <script>window.location="../view/admin_home_view.php";</script>';
    }
}
?>

<script>
    // Function to toggle password visibility
    function togglePasswordVisibility(id) {
        var input = document.getElementById(id);
        var icon = event.target;

        // Check the input type and toggle between text and password
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
    // Form submit event listener
    document.querySelector("form").addEventListener("submit", function(event) {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm-password").value;
        var passwordError = document.getElementById("password-error");
        // Check if the passwords match
        if (password !== confirmPassword) {
            passwordError.textContent = "Passwords do not match.";
            event.preventDefault(); // Prevent form submission
        } else {
            passwordError.textContent = "";
        }
    });
</script>
</body>
</html>