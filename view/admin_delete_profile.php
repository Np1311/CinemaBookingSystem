<?php
require('../controller/admin_controller.php');
$controller =  new admin_controller;
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
                <input type="submit" name='submit' value="submit">
            </form>
        </div>
        <?php

            if(isset($_POST['deleteProfile'])){
                $deleteProfile = $_POST['deleteProfile'];
                echo $deleteProfile;
                if($controller->susProfile($deleteProfile)){
                    echo" <script>window.location='../view/admin_home_view.php';</script>";
                    // return true;
                }
            }
        ?>
    </body>
</html>