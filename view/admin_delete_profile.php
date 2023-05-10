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

            form {
                max-width: 1000px; /*New things */
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
                transition: background-color 0.3s;
            }

            input[type="submit"]:hover {
                background-color: white;
                color: #bd9a7a;
                border: 2px solid;
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


            body {
                background-color: #e7dbd0;
            }
        </style>
    </head>

    <body>
        <div class = 'formContainer'>
            <form method="post">
                <label for="profile">Profile:</label>
                <select name="deleteProfile">
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
                $deleteProfile = $_POST['deleteProfile'];
                echo $deleteProfile;
                if($controller->susProfile($deleteProfile)){
                    echo '<script>alert("good to go")</script>'; 
                    echo" <script>window.location='admin_home_view.php';</script>";
                    // return true;
                }
            }
        ?>
    </body>
</html>