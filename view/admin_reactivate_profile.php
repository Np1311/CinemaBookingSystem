<?php
require('../controller/admin_controller.php');
require('header_login.php');
$controller = new admin_controller;
?>
<html>
<head>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial;
            background-color: #e7dbd0;
        }

        .formContainer {
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

        .btn-primary {
            background-color: #bd9a7a;
            border: 2px solid white;
            color: white;
            padding: 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 8px;
            width: 100%;
            margin-top: 10px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #fff;
            color: #bd9a7a;
            border: 2px solid;
        }
    </style>
</head>

<body>
<div class='formContainer'>
    <form method="post">
        <label for="profile">Profile:</label>
        <select name="reactivate">
            <?php
            $controller->showProfile();
            ?>
        </select>
        <button class="btn-primary" type='submit' name='submit' value='Submit'>Submit</button>
        <button class="btn-primary" type="button" onclick="window.location.href = 'admin_home_view.php'">Back</button>
    </form>
</div>
<?php

if (isset($_POST['reactivate'])) {
    $reactivateProfile = $_POST['reactivate'];
    echo $reactivateProfile;
    if ($controller->reactivateProfile($reactivateProfile)) {
        echo '<script>alert("' . $reactivateProfile . ' activated")</script>';
        echo " <script>window.location='../view/admin_home_view.php';</script>";
    }
}
?>
</body>
</html>