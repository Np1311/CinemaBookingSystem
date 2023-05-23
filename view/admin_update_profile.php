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
    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    }

    body {
        background-color: #e7dbd0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        font-family: arial;
    }

    label {
        margin: 10px 0 5px;
        font-weight: bold;
    }

    select,
    input[type="text"]{
        /* padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%; */

        width: 100%;
      padding: 8px;
      border-radius: 4px;
      border: 1px solid #ccc;
      font-size: 16px;
      box-sizing: border-box;
    }
    input[type="submit"],
    button[type="button"] {
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 45%;
    }

    select,
    input[type="text"] {
        margin-bottom: 10px;
        border: 1px solid #ccc;
    }

    input[type="submit"],
    button[type="button"] {
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

    /* Style for Submit button to match Back button */
    input[type="submit"] {
        background-color: #bd9a7a;
        color: white;
        transition: background-color 0.3s;
        margin-right: 10px;
    }

    input[type="submit"]:hover {
        background-color: #fff;
        color: #bd9a7a;
        border: 2px solid;
    }
</style>
</head>

<body>
    <div class="formContainer">
        <form method="post">
            <label for="profile">Profile:</label>
            <select name="updateProfile" required>
                <option value="" disabled selected>-- Choose a Profile --</option>
                <?php
                    $controller->showProfile();
                ?>
            </select>
            <input type="text" name="updateValue" placeholder="Enter New Profile Name" required>
            <div style="display: flex; justify-content: space-between; margin-top: 20px;">
                <input type="submit" name="submit" value="Submit">
                <button type="button" onclick="window.location.href = 'admin_home_view.php'">Back</button>
            </div>
        </form>
    </div>
    <?php
        if(isset($_POST['submit'])){
            // Retrieve the profile and updated value from the form
            $updateProfile = $_POST['updateProfile'];
            $updateValue = $_POST['updateValue'];
            // Call the updateProfileController method of the controller and check if it returns true
            if($controller->updateProfileController($updateProfile,$updateValue)){
                echo '<script>alert("'.$updateProfile.' is updated")</script>'; 
                echo "<script>window.location='../view/admin_home_view.php';</script>";
            }
        }
    ?>
</body>
</html>
