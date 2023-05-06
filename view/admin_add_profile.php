<?php
require('../controller/admin_controller.php');
$admin = new admin_controller;

// $admin->displayUser('system_admin');
// $admin->displayUser('customer');
?>
<html>
    <head>
        <style>
            body {
                background-color: #e7dbd0;
                font-family: Arial;
            }
            
            /* Style for the profile add form */
            form {
                max-width: 500px;
                margin: auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            }
            
            .signIn {
                display: flex;
                flex-direction: column;
                margin-bottom: 20px;
            }
            
            .signIn label {
                margin-bottom: 5px;
                font-weight: bold;
            }
            
            .signIn input {
                padding: 10px;
                border-radius: 5px;
                border: none;
                background-color: #f2f2f2;
            }
            
            button {
                background-color: #bd9a7a;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;
            }
            
            button:hover {
                background-color: #fff;
                color: #bd9a7a;
                border: 2px solid;
            }
        </style>
    </head>
    <body>
        <form method='post'>
            <div class="signIn">
                <label for="addProfile">Profile Name</label>
                <input type="text" name="addProfile" id="addProfile" required>
            </div>
            <button type="submit" name="submit" value="submit">Submit</button>
        </form>
        <?php
            if(isset($_POST['submit'])){
                $newProfile = $_POST['addProfile'];
                if($admin -> validateProfile($newProfile)){
                    echo" <script>window.location='admin_home_view.php';</script>";
                }else{
                    echo '<script>alert("profile already listed")</script>';
                }
            }
        ?>
    </body>
</html>