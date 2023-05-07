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