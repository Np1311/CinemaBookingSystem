<?php
require('../controller/admin_controller.php');
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
                display: flex;
                flex-direction: column;
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

            body {background-color: #e7dbd0 }
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