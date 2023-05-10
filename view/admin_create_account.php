<?php
require('header_login.php');
require('../controller/admin_controller.php');
session_start();
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
            background-color: #bd9a7a;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: white;
            color: #bd9a7a;
            border: 2px solid;
        }

        input[type="submit"]:focus {
            outline: none;
        }

        .password-input {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .password-input input[type="password"] {
            width: calc(100% ); 
            padding: 10px;
        }

        .password-toggle {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }


    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="formContainer">
        <form method="post">
            <label for="profile">Profile:</label>
            <select name="profile">
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


            <input type="submit" name="submit" value="Create Account">
        </form>
</div>
<?php
if (isset($_POST['submit'])) {
    require('../controller/signUp_controller.php');
    $controller = new signUp_controller;
    $profile = $_POST['profile'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];

    if ($controller->createAccount($profile, $fname, $lname, $phone, $email, $password, $dob)) {
        echo '<script>alert("Create Account Successful")</script>';
        echo ' <script>window.location="../view/admin_home_view.php";</script>';
    }
}
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

        if (password !== confirmPassword) {
            passwordError.textContent = "Passwords do not match.";
            event.preventDefault();
        } else {
            passwordError.textContent = "";
        }
    });
</script>
</body>
</html>