<?php
require('../controller/admin_controller.php');

require('header.html');
$admin = new admin_controller;

// $admin->displayUser('system_admin');
// $admin->displayUser('customer');
?>
<html>
    <head>
    <style>
    /* General styles */
    body {
        background-color: #e7dbd0;
        font-family: Arial;
    }

    /* Profile add form */
    form {
        height:150px;
        width: 500px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    /* Sign-in section */
    .signIn {
        display: flex;
        flex-direction: column;
        margin-bottom: 10px;
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
        margin-top: 20px;
    }

    /* Buttons */
    button {
        width:247px;
        background-color: #bd9a7a;
        color: #ffff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 20px;
    }

    button:hover {
        background-color: #fff;
        color: #bd9a7a;
        border: 2px solid;
    }
</style>
<title>Add Profile</title>
    </head>
    <body>
        <form method='post'>
            <div class="signIn">
                <label for="addProfile">Profile Name</label>
                <input type="text" name="addProfile" id="addProfile" required placeholder="Enter New Profile">
            </div>
            <button type="submit" name="submit" value="submit">Submit</button>
            <button type="button" onclick="window.location.href = 'admin_home_view.php'">Back</button>
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
