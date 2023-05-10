<?php
require('../controller/admin_controller.php');
require('header.html');
$controller =  new admin_controller;
?>
<html>
    <head>
        <style>
            .formContainer {
                margin: auto;
                width: 30%;
                padding: 10px;
                background-color: #f2f2f2;
                border-radius: 5px;
            }

            /* form {
                display: flex;
                flex-direction: column;
            } */

            form {
                /* max-width: 500px;
                margin: auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); */
                
                max-width: 500px; /*New things */
                margin: 0 auto; /* Set left and right margin to auto */
                background-color: #fff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
                position: absolute; /* Position the form absolutely */
                top: 50%; /* Set the top position to 50% of the screen height */
                left: 50%; /* Set the left position to 50% of the screen width */
                transform: translate(-50%, -50%); /* Use the transform property to center the form */
            }

            body{
              background-color: #e7dbd0;
            }

            label {
                margin-top: 10px;
                margin-bottom: 5px;
            }

            select {
                padding: 5px;
                margin-bottom: 10px;
                border-radius: 5px;
                border: 1px solid #ccc;
            }

            input[type="submit"] {
                padding: 10px;
                border: none;
                background-color: #bd9a7a;
                color: white;
                border-radius: 5px;
                cursor: pointer;
            }

            button[type="button"] {
            background-color: #bd9a7a;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            }

            button[type="button"]:hover {
            background-color: white;
            color: #bd9a7a;
            border: 2px solid;
            }
            input[type="submit"]:hover {
                background-color: white;
                color: #bd9a7a;
                border: 2px solid;
            }
        </style>
    </head>

    <body>
        <div class = 'formContainer'>
            <form method="post">
                <label for="profile">Profile:</label>
                <select name="updateProfile">
                    <?php
                        $controller->showProfile();
                    ?>
                </select>
                <input type = 'text' name = 'updateValue' placeholder="Enter New Profile Name" required></input>
                <input type="submit" name='submit' value="Submit">
                <!-- <button type="button" onclick="window.history.back()">Back</button> -->
                <button type="button" onclick="window.location.href = 'admin_home_view.php'">Back</button>

            </form>
        </div>
        <?php

            if(isset($_POST['submit'])){
                $updateProfile = $_POST['updateProfile'];
                $updateValue = $_POST['updateValue'];
                
                if($controller->updateProfileController($updateProfile,$updateValue)){
                    echo '<script>alert("'.$updateProfile.' is updated")</script>'; 
                    echo" <script>window.location='../view/admin_home_view.php';</script>";
                    // return true;
                }
            }
        ?>
    </body>
</html>