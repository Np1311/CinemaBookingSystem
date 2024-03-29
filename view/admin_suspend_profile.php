<?php
// Include the admin controller
require('../controller/admin_controller.php');
// Include the header file
require('header.html');
// Create an instance of the admin controller
$controller =  new admin_controller;
?>
<html>
    <head>
    <style>
    .formContainer {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        width: 300px;
        max-width: 100%;
    }

    body {
        background-color: #e7dbd0;
        font-family: arial;
    }

    label {
        margin: 10px 0 5px;
        font-weight: bold;
    }

    select,
    input[type="text"] {
        width: 100%;
        padding: 8px;
        border-radius: 4px;
        border: 1px solid #ccc;
        font-size: 16px;
        box-sizing: border-box;
        margin-bottom: 10px;
    }

    input[type="submit"],
    button[type="button"] {
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 49%;
        background-color: #bd9a7a;
        color: white;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover,
    button[type="button"]:hover {
        background-color: white;
        color: #bd9a7a;
        border: 2px solid;
    }
</style>
    <title>Suspend a Profile</title>
    </head>

    <body>
        <div class = 'formContainer'>
            <form method="post">
                <label for="profile">Suspend a Profile Name:</label></br></br>
                <select name="deleteProfile" required>
                <option value="" disabled selected>-- Choose a Profile --</option>
                    <?php
                        $controller->showProfile();
                    ?>
                </select>
                <input type="submit" name='submit' value="Submit">
                <button type="button" onclick="window.location.href = 'admin_home_view.php'">Back</button>
            </form>
        </div>
        <?php

            if(isset($_POST['deleteProfile'])){
                // Retrieve the profile to suspend from the form
                $suspendProfile = $_POST['deleteProfile'];
                echo $suspendProfile;
                // Call the susProfile method of the controller and check if it returns true
                if($controller->susProfile($suspendProfile)){
                    echo '<script>alert("'.$suspendProfile.' is suspend")</script>'; 
                    echo" <script>window.location='admin_home_view.php';</script>";
                    // return true;
                }
            }
        ?>
    </body>
</html>