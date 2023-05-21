<?php
require('../controller/user_update_controller.php');


require('header.html');
$curProfile = $_GET['curProfile'];
$oldPhone = $_GET['updateID'];
$userAccount = new user_update_controller;
$arr = $userAccount -> showUpdate($curProfile,$oldPhone);


// print_r($curProfile);
// print_r($userID);

// $arr = $admin->getProfile($curProfile,$userID);
// print_r($arr);

?>
<html>
    <head>
    <style>

    .profile {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center; /* Center the form vertically */
        margin: 0 auto;
        max-width: 500px;
        padding: 20px;
        background-color: #ffffff; /* Set the background color to white */
        border-radius: 5px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
        margin-top: 100px;
        /* margin-bottom: 50px; */
    }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }


        body {
        background-color: #e7dbd0 !important;
        height: 100%;
        font-family: arial;
        }

        
        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"], input[type="email"], input[type="date"], select {
            width: 100%;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
            font-size: 16px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        select {
            height: 40px;
        }

         input[type="submit"] {
            background-color: #bd9a7a;
            color: #fff;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
                background-color: #fff;
                color: #bd9a7a;
                border: 2px solid;
        } 

            button {
                background-color: #bd9a7a;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;
                margin-right: 10px;
                margin-left: 10px;
            }
            
            button:hover {
                background-color: #fff;
                color: #bd9a7a;
                border: 2px solid;
            } 
            .button-container {
                display: flex;
                justify-content: space-between;
                width: 105%;
            }

            .button-container button {
                flex-basis: 100%; /* Adjust the width as needed */
            }
        
        
    </style>
    <title>Account Update</title>
    </head>
    <body>
    <?php
    echo "<div class='profile'>";
    echo "<h1>Account Update</h1>";
    echo "<form method='post'>";
    echo "<label for='first_name'>First Name:</label>";
    echo "<input type='text' name='first_name' id='first_name' value=".$arr['fname']."><br><br>";
    echo '<label for="last_name">Last Name:</label>';
    echo "<input type='text' name='last_name' id='last_name' value=".$arr['lname']."><br><br>";
    echo '<label for="email">Email:</label>';
    echo "<input type='email' name='email' id='email' value=".$arr['email']."><br><br>";
    echo '<label for="date_of_birth">Date of Birth:</label>';
    echo "<input type='date' name='date_of_birth' id='date_of_birth' value=".$arr['dob']."><br><br>";
    echo '<label for="phone">Phone Number:</label>';
    echo "<input type='text' name='phone' id='phone' value=".$arr['phone']."><br><br>";
    echo '<label for="pass">Password:</label>';
    echo "<input type='text' name='pass' id='pass' value=".$arr['password']."><br><br>";
    echo '<label for="status">Status:</label>';
    echo '<select class="form-control" name="status">';
    if ($arr['status'] == 'active') {
        echo '<option value="active" SELECTED> active </option>';
        echo '<option value="suspend"> suspend </option>';
    } else {
        echo '<option value="active"> active </option>';
        echo '<option value="suspend" SELECTED> suspend </option>';
    }
    echo '</select><br><br>';
    
    echo "<div class='button-container'>";
    echo "<input type='submit' name='submit' value='Save Changes'>";
    echo "<button type='button' onclick=\"window.location.href = 'admin_home_view.php'\">Back</button>";
    echo "</div>";
    
    echo "</form>";
    echo "</div>";
    
    if (isset($_POST['submit'])) {
        $fname = $_POST['first_name'];
        $lname = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $dob = $_POST['date_of_birth'];
        $status = $_POST['status'];
        $password = $_POST['pass'];
        if ($userAccount->validateUser($profile, $fname, $lname, $phone, $email,$password,$dob, $status, $oldPhone)) {
            echo " <script>window.location='../view/admin_home_view.php';</script>";
        }
    }
    ?>
</body>
</html>
